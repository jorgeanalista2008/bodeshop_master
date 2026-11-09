import { Injectable, BadRequestException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreateBrandDto {
  name: string;
  code: string;
  image?: string;
}

export interface CreateUnitDto {
  name: string;
  code: string;
}

export interface CreateTaxRateDto {
  name: string;
  code: string;
  rate: number;
  type?: string;
}

export interface CreateCurrencyDto {
  name: string;
  code: string;
  rate: number;
  symbol: string;
  isDefault?: boolean;
}

@Injectable()
export class SettingsService {
  constructor(private readonly prisma: PrismaService) {}

  // ===================== BRANDS =====================
  async getBrands(tenantId: string) {
    return this.prisma.brand.findMany({
      where: { tenantId },
      orderBy: { name: 'asc' },
    });
  }

  async createBrand(tenantId: string, dto: CreateBrandDto) {
    return this.prisma.brand.create({
      data: {
        tenantId,
        name: dto.name,
        code: dto.code.trim().toUpperCase(),
        image: dto.image,
      },
    });
  }

  // ===================== UNITS =====================
  async getUnits(tenantId: string) {
    return this.prisma.unit.findMany({
      where: { tenantId },
      orderBy: { name: 'asc' },
    });
  }

  async createUnit(tenantId: string, dto: CreateUnitDto) {
    return this.prisma.unit.create({
      data: {
        tenantId,
        name: dto.name,
        code: dto.code.trim().toUpperCase(),
      },
    });
  }

  // ===================== TAX RATES =====================
  async getTaxRates(tenantId: string) {
    return this.prisma.taxRate.findMany({
      where: { tenantId },
      orderBy: { rate: 'asc' },
    });
  }

  async createTaxRate(tenantId: string, dto: CreateTaxRateDto) {
    return this.prisma.taxRate.create({
      data: {
        tenantId,
        name: dto.name,
        code: dto.code.trim().toUpperCase(),
        rate: dto.rate,
        type: dto.type || 'PERCENTAGE',
      },
    });
  }

  // ===================== CURRENCIES =====================
  async getCurrencies(tenantId: string) {
    return this.prisma.currency.findMany({
      where: { tenantId },
      orderBy: { isDefault: 'desc' },
    });
  }

  async createCurrency(tenantId: string, dto: CreateCurrencyDto) {
    if (dto.isDefault) {
      // Remover flag de otra moneda
      await this.prisma.currency.updateMany({
        where: { tenantId, isDefault: true },
        data: { isDefault: false },
      });
    }

    return this.prisma.currency.create({
      data: {
        tenantId,
        name: dto.name,
        code: dto.code.trim().toUpperCase(),
        rate: dto.rate,
        symbol: dto.symbol,
        isDefault: dto.isDefault ?? false,
      },
    });
  }
}
