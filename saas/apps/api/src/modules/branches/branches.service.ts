import { Injectable, ConflictException, ForbiddenException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreateBranchDto {
  code: string;
  name: string;
  address: string;
  city: string;
  phone?: string;
}

@Injectable()
export class BranchesService {
  constructor(private readonly prisma: PrismaService) {}

  async findAll(tenantId: string) {
    return this.prisma.branch.findMany({
      where: { tenantId, isActive: true },
      include: {
        warehouses: true,
        posRegisters: {
          where: { closedAt: null },
        },
      },
      orderBy: { isMain: 'desc' },
    });
  }

  async create(tenantId: string, dto: CreateBranchDto) {
    // 1. Validar límite de sucursales según el plan del Tenant
    const tenant = await this.prisma.tenant.findUnique({
      where: { id: tenantId },
      include: {
        subscription: {
          include: { plan: true },
        },
      },
    });

    const maxBranches = tenant?.subscription?.plan?.maxBranches || 1;
    const currentBranchCount = await this.prisma.branch.count({
      where: { tenantId, isActive: true },
    });

    if (currentBranchCount >= maxBranches) {
      throw new ForbiddenException(
        `Ha alcanzado el límite máximo de ${maxBranches} sucursales de su plan. Por favor actualice su suscripción para abrir más sucursales.`
      );
    }

    // 2. Validar código único en la empresa
    const existing = await this.prisma.branch.findFirst({
      where: { tenantId, code: dto.code },
    });

    if (existing) {
      throw new ConflictException(`Ya existe una sucursal con el código "${dto.code}" en su empresa.`);
    }

    return this.prisma.$transaction(async (tx) => {
      const branch = await tx.branch.create({
        data: {
          tenantId,
          code: dto.code,
          name: dto.name,
          address: dto.address,
          city: dto.city,
          phone: dto.phone,
        },
      });

      // Crear almacén por defecto de la sucursal
      await tx.warehouse.create({
        data: {
          tenantId,
          branchId: branch.id,
          code: `ALM-${dto.code}`,
          name: `Almacén ${dto.name}`,
        },
      });

      return branch;
    });
  }
}
