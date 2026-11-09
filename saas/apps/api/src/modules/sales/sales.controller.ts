import { Controller, Get, Post, Body, UseGuards, Query } from '@nestjs/common';
import { SalesService, CreateSaleDto } from './sales.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('sales')
export class SalesController {
  constructor(private readonly salesService: SalesService) {}

  @Get()
  async findAll(
    @CurrentTenantId() tenantId: string,
    @Query('branchId') branchId?: string,
  ) {
    return this.salesService.findAll(tenantId, branchId);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreateSaleDto,
  ) {
    return this.salesService.createSaleWithPessimisticLock(tenantId, user.userId, dto);
  }
}
