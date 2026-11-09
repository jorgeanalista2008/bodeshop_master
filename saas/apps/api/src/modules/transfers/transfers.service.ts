import { Injectable, BadRequestException, NotFoundException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';
import { Decimal } from '@prisma/client/runtime/library';

export interface CreateTransferItemDto {
  productId: string;
  quantity: number;
}

export interface CreateTransferDto {
  fromWarehouseId: string;
  toWarehouseId: string;
  note?: string;
  items: CreateTransferItemDto[];
}

@Injectable()
export class TransfersService {
  constructor(private readonly prisma: PrismaService) {}

  async findAll(tenantId: string) {
    return this.prisma.transfer.findMany({
      where: { tenantId },
      include: {
        fromWarehouse: true,
        toWarehouse: true,
        items: { include: { product: true } },
      },
      orderBy: { createdAt: 'desc' },
    });
  }

  async create(tenantId: string, userId: string, dto: CreateTransferDto) {
    if (dto.fromWarehouseId === dto.toWarehouseId) {
      throw new BadRequestException('El almacén de origen y destino no pueden ser el mismo.');
    }

    if (!dto.items || dto.items.length === 0) {
      throw new BadRequestException('Debe incluir al menos un producto a transferir.');
    }

    return this.prisma.$transaction(async (tx) => {
      const count = await tx.transfer.count({ where: { tenantId } });
      const referenceNumber = `TRF-${String(count + 1).padStart(6, '0')}`;

      // 1. Bloquear y descontar en origen (TRANSFER_OUT)
      for (const item of dto.items) {
        const [originStock] = await tx.$queryRaw<Array<{ quantity: Decimal }>>`
          SELECT quantity FROM "WarehouseStock"
          WHERE "tenantId" = ${tenantId}::uuid
            AND "warehouseId" = ${dto.fromWarehouseId}::uuid
            AND "productId" = ${item.productId}::uuid
          FOR UPDATE
        `;

        if (!originStock || Number(originStock.quantity) < item.quantity) {
          const product = await tx.product.findUnique({ where: { id: item.productId } });
          const available = originStock ? Number(originStock.quantity) : 0;
          throw new BadRequestException(
            `Stock insuficiente en almacén de origen para "${product?.name}". Solicitado: ${item.quantity}, Disponible: ${available}`
          );
        }

        const newOriginQty = Number(originStock.quantity) - item.quantity;

        await tx.warehouseStock.update({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: dto.fromWarehouseId,
              productId: item.productId,
            },
          },
          data: { quantity: newOriginQty },
        });

        // Kárdex Salida por Transferencia
        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId: dto.fromWarehouseId,
            productId: item.productId,
            type: 'TRANSFER_OUT',
            quantityDelta: -item.quantity,
            balanceAfter: newOriginQty,
            unitCost: 0,
            referenceId: referenceNumber,
            userId,
          },
        });
      }

      // 2. Crear Registro de Transferencia en estado SENT
      return tx.transfer.create({
        data: {
          tenantId,
          fromWarehouseId: dto.fromWarehouseId,
          toWarehouseId: dto.toWarehouseId,
          referenceNumber,
          status: 'SENT',
          note: dto.note,
          createdById: userId,
          items: {
            create: dto.items.map((i) => ({
              tenantId,
              productId: i.productId,
              quantity: i.quantity,
            })),
          },
        },
        include: {
          items: { include: { product: true } },
          fromWarehouse: true,
          toWarehouse: true,
        },
      });
    });
  }

  async complete(tenantId: string, userId: string, transferId: string) {
    return this.prisma.$transaction(async (tx) => {
      const transfer = await tx.transfer.findFirst({
        where: { id: transferId, tenantId, status: 'SENT' },
        include: { items: true },
      });

      if (!transfer) {
        throw new NotFoundException('Transferencia no encontrada o ya completada.');
      }

      // Ingresar stock al almacén de destino (TRANSFER_IN)
      for (const item of transfer.items) {
        const destStock = await tx.warehouseStock.findUnique({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: transfer.toWarehouseId,
              productId: item.productId,
            },
          },
        });

        const currentQty = destStock ? Number(destStock.quantity) : 0;
        const newQty = currentQty + Number(item.quantity);

        await tx.warehouseStock.upsert({
          where: {
            tenantId_warehouseId_productId: {
              tenantId,
              warehouseId: transfer.toWarehouseId,
              productId: item.productId,
            },
          },
          update: { quantity: newQty },
          create: {
            tenantId,
            warehouseId: transfer.toWarehouseId,
            productId: item.productId,
            quantity: newQty,
          },
        });

        // Kárdex Entrada por Transferencia
        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId: transfer.toWarehouseId,
            productId: item.productId,
            type: 'TRANSFER_IN',
            quantityDelta: Number(item.quantity),
            balanceAfter: newQty,
            unitCost: 0,
            referenceId: transfer.referenceNumber,
            userId,
          },
        });
      }

      return tx.transfer.update({
        where: { id: transfer.id },
        data: { status: 'COMPLETED' },
        include: { items: true },
      });
    });
  }
}
