import { Controller, Get, Post, Body, Param, UseGuards } from '@nestjs/common';
import { PurchasesService, CreatePurchaseDto } from './purchases.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('purchases')
export class PurchasesController {
  constructor(private readonly purchasesService: PurchasesService) {}

  @Get()
  async findAll(@CurrentTenantId() tenantId: string) {
    return this.purchasesService.findAll(tenantId);
  }

  @Get(':id')
  async findOne(@CurrentTenantId() tenantId: string, @Param('id') id: string) {
    return this.purchasesService.findOne(tenantId, id);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreatePurchaseDto,
  ) {
    return this.purchasesService.create(tenantId, user.userId, dto);
  }
}
