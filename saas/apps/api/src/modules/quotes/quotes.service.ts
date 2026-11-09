import { Injectable, BadRequestException, NotFoundException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';
import { Decimal } from '@prisma/client/runtime/library';

export interface CreateQuoteItemDto {
  productId: string;
  quantity: number;
  unitPrice: number;
}

export interface CreateQuoteDto {
  branchId: string;
  customerId?: string;
  customerName?: string;
  items: CreateQuoteItemDto[];
  note?: string;
  validDays?: number;
}

@Injectable()
export class QuotesService {
  constructor(private readonly prisma: PrismaService) {}

  async findAll(tenantId: string) {
    return this.prisma.quote.findMany({
      where: { tenantId },
      include: {
        customer: true,
        items: { include: { product: true } },
      },
      orderBy: { createdAt: 'desc' },
    });
  }

  async create(tenantId: string, userId: string, dto: CreateQuoteDto) {
    if (!dto.items || dto.items.length === 0) {
      throw new BadRequestException('La cotización debe contener al menos un producto.');
    }

    return this.prisma.$transaction(async (tx) => {
      let customerId = dto.customerId;
      if (!customerId) {
        let customer = await tx.customer.findFirst({
          where: { tenantId, name: dto.customerName || 'Cliente Cotización' },
        });

        if (!customer) {
          customer = await tx.customer.create({
            data: {
              tenantId,
              name: dto.customerName || 'Cliente Cotización',
              taxId: `COT-${Date.now().toString().slice(-6)}`,
            },
          });
        }
        customerId = customer.id;
      }

      const count = await tx.quote.count({ where: { tenantId } });
      const referenceNumber = `COT-${String(count + 1).padStart(6, '0')}`;

      let grandTotal = 0;
      const quoteItems = [];

      for (const item of dto.items) {
        const subtotal = item.quantity * item.unitPrice;
        grandTotal += subtotal;
        quoteItems.push({
          tenantId,
          productId: item.productId,
          unitPrice: item.unitPrice,
          quantity: item.quantity,
          subtotal,
        });
      }

      const validUntil = new Date(Date.now() + (dto.validDays || 15) * 24 * 60 * 60 * 1000);

      return tx.quote.create({
        data: {
          tenantId,
          branchId: dto.branchId,
          customerId,
          userId,
          referenceNumber,
          grandTotal,
          validUntil,
          note: dto.note,
          status: 'PENDING',
          items: {
            create: quoteItems,
          },
        },
        include: {
          customer: true,
          items: { include: { product: true } },
        },
      });
    });
  }

  async convertToSale(tenantId: string, userId: string, quoteId: string, warehouseId: string, paymentMethod = 'CASH') {
    return this.prisma.$transaction(async (tx) => {
      const quote = await tx.quote.findFirst({
        where: { id: quoteId, tenantId, status: 'PENDING' },
        include: { items: true },
      });

      if (!quote) {
        throw new NotFoundException('Cotización no encontrada o ya convertida.');
      }

      // Validar y bloquear stock para cada producto de la cotización
      for (const item of quote.items) {
        const [lockedStock] = await tx.$queryRaw<Array<{ quantity: Decimal }>>`
          SELECT quantity FROM "WarehouseStock"
          WHERE "tenantId" = ${tenantId}::uuid
            AND "warehouseId" = ${warehouseId}::uuid
            AND "productId" = ${item.productId}::uuid
          FOR UPDATE
        `;

        if (!lockedStock || Number(lockedStock.quantity) < Number(item.quantity)) {
          const product = await tx.product.findUnique({ where: { id: item.productId } });
          const avail = lockedStock ? Number(lockedStock.quantity) : 0;
          throw new BadRequestException(
            `Stock insuficiente para convertir cotización. Producto: "${product?.name}". Requerido: ${item.quantity}, Disponible: ${avail}`
          );
        }

        const newStock = Number(lockedStock.quantity) - Number(item.quantity);

        await tx.warehouseStock.update({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId,
              productId: item.productId,
            },
          },
          data: { quantity: newStock },
        });

        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId,
            productId: item.productId,
            type: 'SALE',
            quantityDelta: -Number(item.quantity),
            balanceAfter: newStock,
            unitCost: 0,
            referenceId: quote.referenceNumber,
            userId,
          },
        });
      }

      // Generar Venta
      const salesCount = await tx.sale.count({ where: { tenantId, branchId: quote.branchId } });
      const invoiceNumber = `FAC-COT-${String(salesCount + 1).padStart(6, '0')}`;

      const sale = await tx.sale.create({
        data: {
          tenantId,
          branchId: quote.branchId,
          customerId: quote.customerId,
          userId,
          invoiceNumber,
          subtotal: quote.grandTotal,
          grandTotal: quote.grandTotal,
          paidAmount: quote.grandTotal,
          items: {
            create: quote.items.map((i) => ({
              tenantId,
              productId: i.productId,
              unitCost: 0,
              unitPrice: i.unitPrice,
              quantity: i.quantity,
              subtotal: i.subtotal,
            })),
          },
          payments: {
            create: [
              {
                tenantId,
                amount: quote.grandTotal,
                method: paymentMethod,
                reference: `Conversión desde ${quote.referenceNumber}`,
              },
            ],
          },
        },
      });

      // Actualizar estado de cotización a CONVERTED
      await tx.quote.update({
        where: { id: quote.id },
        data: { status: 'CONVERTED' },
      });

      return {
        message: '¡Cotización convertida exitosamente a Factura de Venta!',
        saleId: sale.id,
        invoiceNumber: sale.invoiceNumber,
        grandTotal: sale.grandTotal,
      };
    });
  }
}
