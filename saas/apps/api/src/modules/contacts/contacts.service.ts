import { Injectable, BadRequestException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreateCustomerDto {
  name: string;
  taxId?: string;
  email?: string;
  phone?: string;
  address?: string;
}

export interface CreateSupplierDto {
  name: string;
  taxId?: string;
  email?: string;
  phone?: string;
  address?: string;
}

@Injectable()
export class ContactsService {
  constructor(private readonly prisma: PrismaService) {}

  // --- CLIENTES ---
  async findAllCustomers(tenantId: string) {
    return this.prisma.customer.findMany({
      where: { tenantId },
      include: {
        customerGroup: true,
        priceGroup: true,
        deposits: true,
      },
      orderBy: { name: 'asc' },
    });
  }

  async createCustomer(tenantId: string, dto: CreateCustomerDto) {
    if (!dto.name) {
      throw new BadRequestException('El nombre del cliente es obligatorio.');
    }

    const taxId = dto.taxId?.trim() || `V-${Date.now().toString().slice(-8)}`;

    return this.prisma.customer.create({
      data: {
        tenantId,
        name: dto.name,
        taxId,
        email: dto.email,
        phone: dto.phone,
        address: dto.address,
      },
    });
  }

  // --- PROVEEDORES ---
  async findAllSuppliers(tenantId: string) {
    return this.prisma.supplier.findMany({
      where: { tenantId },
      orderBy: { name: 'asc' },
    });
  }

  async createSupplier(tenantId: string, dto: CreateSupplierDto) {
    if (!dto.name) {
      throw new BadRequestException('El nombre del proveedor es obligatorio.');
    }

    const taxId = dto.taxId?.trim() || `J-${Date.now().toString().slice(-8)}`;

    return this.prisma.supplier.create({
      data: {
        tenantId,
        name: dto.name,
        taxId,
        email: dto.email,
        phone: dto.phone,
        address: dto.address,
      },
    });
  }
}
