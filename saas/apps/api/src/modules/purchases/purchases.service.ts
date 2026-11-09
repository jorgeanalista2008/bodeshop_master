import { Injectable, BadRequestException, NotFoundException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreatePurchaseItemDto {
  productId: string;
  quantity: number;
  unitCost: number;
}

export interface CreatePurchaseDto {
  branchId: string;
  warehouseId: string;
  supplierId?: string;
  supplierName?: string;
  referenceNumber?: string;
  items: CreatePurchaseItemDto[];
}

@Injectable()
export class PurchasesService {
  constructor(private readonly prisma: PrismaService) {}

  async findAll(tenantId: string) {
    return this.prisma.purchase.findMany({
      where: { tenantId },
      include: {
        supplier: true,
        items: { include: { product: true } },
      },
      orderBy: { createdAt: 'desc' },
    });
  }

  async findOne(tenantId: string, id: string) {
    const purchase = await this.prisma.purchase.findFirst({
      where: { id, tenantId },
      include: {
        supplier: true,
        items: { include: { product: true } },
      },
    });

    if (!purchase) {
      throw new NotFoundException('Orden de compra no encontrada');
    }

    return purchase;
  }

  async create(tenantId: string, userId: string, dto: CreatePurchaseDto) {
    if (!dto.items || dto.items.length === 0) {
      throw new BadRequestException('La compra debe contener al menos un producto.');
    }

    return this.prisma.$transaction(async (tx) => {
      // 1. Obtener o crear el proveedor
      let supplierId = dto.supplierId;
      if (!supplierId) {
        let supplier = await tx.supplier.findFirst({
          where: { tenantId, name: dto.supplierName || 'Proveedor General' },
        });

        if (!supplier) {
          supplier = await tx.supplier.create({
            data: {
              tenantId,
              name: dto.supplierName || 'Proveedor General',
              taxId: `PROV-${Date.now().toString().slice(-6)}`,
            },
          });
        }
        supplierId = supplier.id;
      }

      // 2. Generar número de referencia de compra si no viene
      const count = await tx.purchase.count({ where: { tenantId } });
      const referenceNumber = dto.referenceNumber || `COM-${String(count + 1).padStart(6, '0')}`;

      let grandTotal = 0;
      const purchaseItemsToCreate = [];

      // 3. Procesar cada ítem: Sumar stock al almacén y asentar en Kárdex
      for (const item of dto.items) {
        const itemSubtotal = item.quantity * item.unitCost;
        grandTotal += itemSubtotal;

        // Buscar stock actual
        const currentStock = await tx.warehouseStock.findUnique({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: dto.warehouseId,
              productId: item.productId,
            },
          },
        });

        const prevQty = currentStock ? Number(currentStock.quantity) : 0;
        const newBalance = prevQty + item.quantity;

        // Actualizar o crear stock en almacén
        await tx.warehouseStock.upsert({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: dto.warehouseId,
              productId: item.productId,
            },
          },
          update: { quantity: newBalance },
          create: {
            tenantId,
            warehouseId: dto.warehouseId,
            productId: item.productId,
            quantity: newBalance,
          },
        });

        // Actualizar costo de referencia del producto
        await tx.product.update({
          where: { id: item.productId },
          data: { cost: item.unitCost },
        });

        // Asentar en Libro Mayor Kárdex
        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId: dto.warehouseId,
            productId: item.productId,
            type: 'PURCHASE',
            quantityDelta: item.quantity,
            balanceAfter: newBalance,
            unitCost: item.unitCost,
            referenceId: referenceNumber,
            userId,
          },
        });

        purchaseItemsToCreate.push({
          tenantId,
          productId: item.productId,
          unitCost: item.unitCost,
          quantity: item.quantity,
          subtotal: itemSubtotal,
        });
      }

      // 4. Crear la cabecera de Compra
      const purchase = await tx.purchase.create({
        data: {
          tenantId,
          branchId: dto.branchId,
          supplierId,
          referenceNumber,
          grandTotal,
          items: {
            create: purchaseItemsToCreate,
          },
        },
        include: {
          supplier: true,
          items: { include: { product: true } },
        },
      });

      return purchase;
    });
  }
}
