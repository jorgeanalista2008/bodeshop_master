import { Controller, Get, Query, UseGuards } from '@nestjs/common';
import { ReportsService } from './reports.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('reports')
export class ReportsController {
  constructor(private readonly reportsService: ReportsService) {}

  @Get('overview')
  async getOverview(
    @CurrentTenantId() tenantId: string,
    @Query('branchId') branchId?: string,
  ) {
    return this.reportsService.getOverview(tenantId, branchId);
  }

  @Get('low-stock')
  async getLowStockAlerts(@CurrentTenantId() tenantId: string) {
    return this.reportsService.getLowStockAlerts(tenantId);
  }

  @Get('profit-loss')
  async getProfitAndLoss(
    @CurrentTenantId() tenantId: string,
    @Query('startDate') startDate?: string,
    @Query('endDate') endDate?: string,
  ) {
    return this.reportsService.getProfitAndLoss(tenantId, startDate, endDate);
  }
}
