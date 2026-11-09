import { Injectable, NotFoundException, ConflictException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreateProductDto {
  code: string;
  name: string;
  slug?: string;
  cost: number;
  price: number;
  categoryId?: string;
  barcode?: string;
  unit?: string;
  alertQuantity?: number;
  initialStock?: number;
  warehouseId?: string;
}

@Injectable()
export class ProductsService {
  constructor(private readonly prisma: PrismaService) {}

  async findAll(tenantId: string) {
    return this.prisma.product.findMany({
      where: { tenantId, isActive: true },
      include: {
        category: true,
        warehouseStocks: {
          include: { warehouse: true },
        },
      },
      orderBy: { name: 'asc' },
    });
  }

  async findOne(tenantId: string, id: string) {
    const product = await this.prisma.product.findFirst({
      where: { id, tenantId, isActive: true },
      include: {
        category: true,
        variants: true,
        warehouseStocks: {
          include: { warehouse: true },
        },
      },
    });

    if (!product) {
      throw new NotFoundException('Producto no encontrado para esta empresa');
    }

    return product;
  }

  async create(tenantId: string, dto: CreateProductDto, userId: string) {
    // Validar código único por Tenant
    const existing = await this.prisma.product.findFirst({
      where: { tenantId, code: dto.code },
    });

    if (existing) {
      throw new ConflictException(`Ya existe un producto con el código "${dto.code}" en su empresa.`);
    }

    const slug = dto.slug || dto.name.toLowerCase().replace(/[^a-z0-9]+/g, '-');

    return this.prisma.$transaction(async (tx) => {
      // Si no especificó categoría, buscar o crear la general de la empresa
      let categoryId = dto.categoryId;
      if (!categoryId) {
        let defaultCategory = await tx.category.findFirst({
          where: { tenantId, code: 'GENERAL' },
        });

        if (!defaultCategory) {
          defaultCategory = await tx.category.create({
            data: {
              tenantId,
              code: 'GENERAL',
              name: 'General',
              slug: 'general',
            },
          });
        }
        categoryId = defaultCategory.id;
      }

      const product = await tx.product.create({
        data: {
          tenantId,
          categoryId,
          code: dto.code,
          name: dto.name,
          slug,
          cost: dto.cost,
          price: dto.price,
          unit: dto.unit || 'UND',
          alertQuantity: dto.alertQuantity || 5,
          barcode: dto.barcode,
        },
      });

      // Si se indicó stock inicial, registrar en almacén y Kárdex
      if (dto.initialStock && dto.initialStock > 0 && dto.warehouseId) {
        await tx.warehouseStock.create({
          data: {
            tenantId,
            warehouseId: dto.warehouseId,
            productId: product.id,
            quantity: dto.initialStock,
          },
        });

        await tx.stockMovement.create({
          data: {
            tenantId,
            warehouseId: dto.warehouseId,
            productId: product.id,
            type: 'ADJUSTMENT',
            quantityDelta: dto.initialStock,
            balanceAfter: dto.initialStock,
            unitCost: dto.cost,
            userId,
            referenceId: 'INVENTARIO_INICIAL',
          },
        });
      }

      return product;
    });
  }
}
