import { Injectable, BadRequestException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';
import { Decimal } from '@prisma/client/runtime/library';

export interface CreateSaleItemDto {
  productId: string;
  quantity: number;
  unitPrice: number;
}

export interface CreateSaleDto {
  branchId: string;
  warehouseId: string;
  customerId?: string;
  items: CreateSaleItemDto[];
  paymentMethod: string;
  paidAmount: number;
}

@Injectable()
export class SalesService {
  constructor(private readonly prisma: PrismaService) {}

  async createSaleWithPessimisticLock(tenantId: string, userId: string, dto: CreateSaleDto) {
    if (!dto.items || dto.items.length === 0) {
      throw new BadRequestException('La venta debe contener al menos un producto.');
    }

    return this.prisma.$transaction(async (tx) => {
      // 1. Obtener o crear cliente genérico de la empresa
      let customerId = dto.customerId;
      if (!customerId) {
        let genericCustomer = await tx.customer.findFirst({
          where: { tenantId, taxId: 'V-00000000' },
        });

        if (!genericCustomer) {
          genericCustomer = await tx.customer.create({
            data: {
              tenantId,
              taxId: 'V-00000000',
              name: 'Cliente General / Mostrador',
            },
          });
        }
        customerId = genericCustomer.id;
      }

      let subtotal = 0;
      const saleItemsToCreate = [];

      // 2. Iterar cada producto aplicando BLOQUEO PESIMISTA (FOR UPDATE)
      for (const item of dto.items) {
        // Bloquear la fila de stock del almacén en PostgreSQL
        const [lockedStock] = await tx.$queryRaw<Array<{ quantity: Decimal }>>`
          SELECT quantity FROM "WarehouseStock"
          WHERE "tenantId" = ${tenantId}::uuid
            AND "warehouseId" = ${dto.warehouseId}::uuid
            AND "productId" = ${item.productId}::uuid
          FOR UPDATE
        `;

        if (!lockedStock || Number(lockedStock.quantity) < item.quantity) {
          const product = await tx.product.findUnique({
            where: { id: item.productId },
            select: { name: true, code: true },
          });
          const available = lockedStock ? Number(lockedStock.quantity) : 0;
          throw new BadRequestException(
            `Stock insuficiente para el producto "${product?.name || item.productId}" (Código: ${product?.code}). Solicitado: ${item.quantity}, Disponible: ${available}`
          );
        }

        const newBalance = Number(lockedStock.quantity) - item.quantity;

        // Actualizar stock atómicamente
        await tx.warehouseStock.update({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: dto.warehouseId,
              productId: item.productId,
            },
          },
          data: { quantity: newBalance },
        });

        // Registrar en Kárdex
        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId: dto.warehouseId,
            productId: item.productId,
            type: 'SALE',
            quantityDelta: -item.quantity,
            balanceAfter: newBalance,
            unitCost: 0,
            userId,
          },
        });

        const itemSubtotal = item.quantity * item.unitPrice;
        subtotal += itemSubtotal;

        saleItemsToCreate.push({
          tenantId,
          productId: item.productId,
          unitCost: 0,
          unitPrice: item.unitPrice,
          quantity: item.quantity,
          subtotal: itemSubtotal,
        });
      }

      // 3. Generar número de factura único para esta sucursal
      const count = await tx.sale.count({
        where: { tenantId, branchId: dto.branchId },
      });
      const invoiceNumber = `FAC-${dto.branchId.slice(0, 4).toUpperCase()}-${String(count + 1).padStart(6, '0')}`;

      // 4. Crear la venta
      const sale = await tx.sale.create({
        data: {
          tenantId,
          branchId: dto.branchId,
          customerId,
          userId,
          invoiceNumber,
          subtotal,
          grandTotal: subtotal,
          paidAmount: dto.paidAmount,
          items: {
            create: saleItemsToCreate,
          },
          payments: {
            create: [
              {
                tenantId,
                amount: dto.paidAmount,
                method: dto.paymentMethod,
              },
            ],
          },
        },
        include: {
          items: {
            include: { product: true },
          },
          payments: true,
          customer: true,
        },
      });

      return sale;
    });
  }

  async findAll(tenantId: string, branchId?: string) {
    const where: any = { tenantId };
    if (branchId) {
      where.branchId = branchId;
    }

    return this.prisma.sale.findMany({
      where,
      include: {
        customer: true,
        user: { select: { firstName: true, lastName: true, email: true } },
        items: { include: { product: true } },
        payments: true,
      },
      orderBy: { createdAt: 'desc' },
      take: 50,
    });
  }
}
