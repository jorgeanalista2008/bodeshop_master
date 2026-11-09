import { Controller, Get, Post, Body, Query, UseGuards } from '@nestjs/common';
import { AdjustmentsService, CreateAdjustmentDto } from './adjustments.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('adjustments')
export class AdjustmentsController {
  constructor(private readonly adjustmentsService: AdjustmentsService) {}

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreateAdjustmentDto,
  ) {
    return this.adjustmentsService.create(tenantId, user.userId, dto);
  }

  @Get()
  async findAll(
    @CurrentTenantId() tenantId: string,
    @Query('warehouseId') warehouseId?: string,
  ) {
    return this.adjustmentsService.findAll(tenantId, warehouseId);
  }
}
