import { Injectable, UnauthorizedException, ConflictException } from '@nestjs/common';
import { JwtService } from '@nestjs/jwt';
import { PrismaService } from '../../prisma/prisma.service';
import * as argon2 from 'argon2';
import { LoginDto, RegisterTenantDto } from './dto/auth.dto';
import { Role } from '@prisma/client';

@Injectable()
export class AuthService {
  constructor(
    private readonly prisma: PrismaService,
    private readonly jwtService: JwtService,
  ) {}

  async registerTenant(dto: RegisterTenantDto) {
    // 1. Validar que no exista el slug de la empresa
    const existingTenant = await this.prisma.tenant.findUnique({
      where: { slug: dto.slug.toLowerCase().trim() },
    });

    if (existingTenant) {
      throw new ConflictException(`El subdominio/slug "${dto.slug}" ya se encuentra registrado.`);
    }

    const hashedPassword = await argon2.hash(dto.password);

    // 2. Transacción de creación de Empresa, Sucursal Inicial, Almacén y Usuario Propietario
    return this.prisma.$transaction(async (tx) => {
      // Plan por defecto
      let starterPlan = await tx.saaSPlan.findUnique({ where: { code: 'starter' } });
      if (!starterPlan) {
        starterPlan = await tx.saaSPlan.create({
          data: {
            code: 'starter',
            name: 'Plan Inicial',
            priceMonthly: 29.99,
            priceYearly: 299.99,
            maxBranches: 1,
            maxWarehouses: 1,
            maxUsers: 3,
            maxProducts: 1000,
          },
        });
      }

      const tenant = await tx.tenant.create({
        data: {
          slug: dto.slug.toLowerCase().trim(),
          legalName: dto.legalName,
          tradeName: dto.tradeName,
          taxId: dto.taxId,
          email: dto.email.toLowerCase().trim(),
          subscription: {
            create: {
              planId: starterPlan.id,
              status: 'ACTIVE',
              billingCycle: 'MONTHLY',
              currentPeriodStart: new Date(),
              currentPeriodEnd: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000), // 30 días
            },
          },
        },
      });

      // Crear Sucursal Principal
      const branch = await tx.branch.create({
        data: {
          tenantId: tenant.id,
          code: 'SUC-01',
          name: 'Sucursal Principal',
          address: 'Sede Principal',
          city: 'Principal',
          isMain: true,
        },
      });

      // Crear Almacén Principal
      await tx.warehouse.create({
        data: {
          tenantId: tenant.id,
          branchId: branch.id,
          code: 'ALM-01',
          name: 'Almacén Principal',
        },
      });

      // Crear Usuario Propietario
      const user = await tx.user.create({
        data: {
          tenantId: tenant.id,
          email: dto.email.toLowerCase().trim(),
          passwordHash: hashedPassword,
          firstName: dto.adminFirstName,
          lastName: dto.adminLastName,
          role: Role.TENANT_OWNER,
          branchAccess: {
            create: {
              branchId: branch.id,
              isDefault: true,
            },
          },
        },
      });

      const token = this.generateToken(user, tenant, branch.id);

      return {
        message: 'Empresa y cuenta creada exitosamente',
        tenant: {
          id: tenant.id,
          slug: tenant.slug,
          tradeName: tenant.tradeName,
        },
        user: {
          id: user.id,
          email: user.email,
          role: user.role,
        },
        branch: {
          id: branch.id,
          name: branch.name,
        },
        accessToken: token,
      };
    });
  }

  async login(dto: LoginDto) {
    const tenant = await this.prisma.tenant.findUnique({
      where: { slug: dto.tenantSlug.toLowerCase().trim() },
    });

    if (!tenant || !tenant.isActive) {
      throw new UnauthorizedException('Empresa no encontrada o inactiva.');
    }

    const user = await this.prisma.user.findUnique({
      where: {
        tenantId_email: {
          tenantId: tenant.id,
          email: dto.email.toLowerCase().trim(),
        },
      },
      include: {
        branchAccess: {
          include: { branch: true },
        },
      },
    });

    if (!user || !user.isActive) {
      throw new UnauthorizedException('Credenciales inválidas para esta empresa.');
    }

    const passwordMatches = await argon2.verify(user.passwordHash, dto.password);
    if (!passwordMatches) {
      throw new UnauthorizedException('Credenciales inválidas.');
    }

    const defaultBranch = user.branchAccess.find((b) => b.isDefault) || user.branchAccess[0];
    const branchId = defaultBranch ? defaultBranch.branchId : null;

    const token = this.generateToken(user, tenant, branchId);

    return {
      message: 'Inicio de sesión exitoso',
      tenant: {
        id: tenant.id,
        slug: tenant.slug,
        tradeName: tenant.tradeName,
      },
      user: {
        id: user.id,
        email: user.email,
        firstName: user.firstName,
        lastName: user.lastName,
        role: user.role,
      },
      currentBranch: defaultBranch ? defaultBranch.branch : null,
      branches: user.branchAccess.map((b) => b.branch),
      accessToken: token,
    };
  }

  private generateToken(user: any, tenant: any, branchId: string | null) {
    const payload = {
      sub: user.id,
      email: user.email,
      role: user.role,
      tenantId: tenant.id,
      tenantSlug: tenant.slug,
      branchId,
    };

    return this.jwtService.sign(payload);
  }
}
