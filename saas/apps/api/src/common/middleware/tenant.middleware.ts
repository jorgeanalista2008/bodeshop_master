import { Injectable, NestMiddleware, BadRequestException } from '@nestjs/common';
import { Request, Response, NextFunction } from 'express';
import { PrismaService } from '../../prisma/prisma.service';

export interface TenantRequest extends Request {
  tenantId?: string;
  branchId?: string;
  tenantSlug?: string;
}

@Injectable()
export class TenantMiddleware implements NestMiddleware {
  constructor(private readonly prisma: PrismaService) {}

  async use(req: TenantRequest, res: Response, next: NextFunction) {
    const host = req.headers.host || '';
    const parts = host.split('.');
    
    let tenantSlug: string | null = null;
    if (parts.length > 2) {
      tenantSlug = parts[0];
    }

    // Cabeceras alternativas para llamadas directas de API o desarrollo local
    const headerTenantId = req.headers['x-tenant-id'] as string;
    const headerBranchId = req.headers['x-branch-id'] as string;
    const headerTenantSlug = req.headers['x-tenant-slug'] as string;

    if (headerTenantId) {
      req.tenantId = headerTenantId;
    } else if (headerTenantSlug || tenantSlug) {
      const slug = headerTenantSlug || tenantSlug;
      if (slug && slug !== 'api' && slug !== 'app' && slug !== 'localhost') {
        const tenant = await this.prisma.tenant.findUnique({
          where: { slug },
          select: { id: true, slug: true, isActive: true },
        });

        if (tenant && tenant.isActive) {
          req.tenantId = tenant.id;
          req.tenantSlug = tenant.slug;
        }
      }
    }

    if (headerBranchId) {
      req.branchId = headerBranchId;
    }

    next();
  }
}
