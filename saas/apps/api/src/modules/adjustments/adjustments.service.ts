import { Injectable, BadRequestException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreateAdjustmentItemDto {
  productId: string;
  quantity: number;
  type: 'addition' | 'subtraction';
  serialNo?: string;
}

export interface CreateAdjustmentDto {
  warehouseId: string;
  note?: string;
  items: CreateAdjustmentItemDto[];
}

@Injectable()
export class AdjustmentsService {
  constructor(private readonly prisma: PrismaService) {}

  async create(tenantId: string, userId: string, dto: CreateAdjustmentDto) {
    if (!dto.items || dto.items.length === 0) {
      throw new BadRequestException('El ajuste debe contener al menos un producto.');
    }

    return this.prisma.$transaction(async (tx) => {
      // Generar referencia única de ajuste
      const count = await tx.adjustment.count({ where: { tenantId } });
      const referenceNo = `ADJ-${new Date().getFullYear()}-${String(count + 1).padStart(5, '0')}`;

      // Crear cabecera de Ajuste
      const adjustment = await tx.adjustment.create({
        data: {
          tenantId,
          warehouseId: dto.warehouseId,
          referenceNo,
          note: dto.note,
          createdById: userId,
        },
      });

      // Procesar cada ítem actualizando Stock y Kárdex
      for (const item of dto.items) {
        const delta = item.type === 'addition' ? item.quantity : -item.quantity;

        // Actualizar o crear WarehouseStock
        const currentStock = await tx.warehouseStock.findUnique({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: dto.warehouseId,
              productId: item.productId,
            },
          },
        });

        const currentQty = currentStock ? Number(currentStock.quantity) : 0;
        const newBalance = currentQty + delta;

        if (newBalance < 0 && item.type === 'subtraction') {
          const prod = await tx.product.findUnique({ where: { id: item.productId } });
          throw new BadRequestException(
            `No es posible restar ${item.quantity} unidades del producto ${prod?.name}. Stock actual: ${currentQty}`
          );
        }

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

        // Registrar en Kárdex
        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId: dto.warehouseId,
            productId: item.productId,
            type: 'ADJUSTMENT',
            quantityDelta: delta,
            balanceAfter: newBalance,
            unitCost: 0,
            referenceId: referenceNo,
            userId,
          },
        });

        // Registrar detalle del ajuste
        await tx.adjustmentItem.create({
          data: {
            tenantId,
            adjustmentId: adjustment.id,
            productId: item.productId,
            quantity: item.quantity,
            type: item.type,
            serialNo: item.serialNo,
          },
        });
      }

      return tx.adjustment.findUnique({
        where: { id: adjustment.id },
        include: {
          warehouse: true,
          items: { include: { product: true } },
          user: { select: { firstName: true, lastName: true, email: true } },
        },
      });
    });
  }

  async findAll(tenantId: string, warehouseId?: string) {
    const where: any = { tenantId };
    if (warehouseId) where.warehouseId = warehouseId;

    return this.prisma.adjustment.findMany({
      where,
      include: {
        warehouse: true,
        user: { select: { firstName: true, lastName: true, email: true } },
        items: { include: { product: true } },
      },
      orderBy: { createdAt: 'desc' },
      take: 50,
    });
  }
}
