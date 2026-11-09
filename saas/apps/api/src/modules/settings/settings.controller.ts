import { Controller, Get, Post, Body, UseGuards } from '@nestjs/common';
import {
  SettingsService,
  CreateBrandDto,
  CreateUnitDto,
  CreateTaxRateDto,
  CreateCurrencyDto,
} from './settings.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('settings')
export class SettingsController {
  constructor(private readonly settingsService: SettingsService) {}

  // Brands
  @Get('brands')
  async getBrands(@CurrentTenantId() tenantId: string) {
    return this.settingsService.getBrands(tenantId);
  }

  @Post('brands')
  async createBrand(@CurrentTenantId() tenantId: string, @Body() dto: CreateBrandDto) {
    return this.settingsService.createBrand(tenantId, dto);
  }

  // Units
  @Get('units')
  async getUnits(@CurrentTenantId() tenantId: string) {
    return this.settingsService.getUnits(tenantId);
  }

  @Post('units')
  async createUnit(@CurrentTenantId() tenantId: string, @Body() dto: CreateUnitDto) {
    return this.settingsService.createUnit(tenantId, dto);
  }

  // Tax Rates
  @Get('tax-rates')
  async getTaxRates(@CurrentTenantId() tenantId: string) {
    return this.settingsService.getTaxRates(tenantId);
  }

  @Post('tax-rates')
  async createTaxRate(@CurrentTenantId() tenantId: string, @Body() dto: CreateTaxRateDto) {
    return this.settingsService.createTaxRate(tenantId, dto);
  }

  // Currencies
  @Get('currencies')
  async getCurrencies(@CurrentTenantId() tenantId: string) {
    return this.settingsService.getCurrencies(tenantId);
  }

  @Post('currencies')
  async createCurrency(@CurrentTenantId() tenantId: string, @Body() dto: CreateCurrencyDto) {
    return this.settingsService.createCurrency(tenantId, dto);
  }
}
