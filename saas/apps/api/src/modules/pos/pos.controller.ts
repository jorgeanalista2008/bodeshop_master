import { Controller, Get, Post, Delete, Body, Param, Query, UseGuards } from '@nestjs/common';
import { PosService, OpenRegisterDto, CloseRegisterDto, SuspendBillDto } from './pos.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('pos')
export class PosController {
  constructor(private readonly posService: PosService) {}

  @Get('active-register')
  async getActiveRegister(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Query('branchId') branchId: string,
  ) {
    return this.posService.getActiveRegister(tenantId, branchId, user.userId);
  }

  @Post('open-register')
  async openRegister(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: OpenRegisterDto,
  ) {
    return this.posService.openRegister(tenantId, user.userId, dto);
  }

  @Post('close-register')
  async closeRegister(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CloseRegisterDto,
  ) {
    return this.posService.closeRegister(tenantId, user.userId, dto);
  }

  @Post('suspend')
  async suspendBill(
    @CurrentTenantId() tenantId: string,
    @Body() dto: SuspendBillDto,
  ) {
    return this.posService.suspendBill(tenantId, dto);
  }

  @Get('suspended')
  async getSuspendedBills(
    @CurrentTenantId() tenantId: string,
    @Query('branchId') branchId: string,
  ) {
    return this.posService.getSuspendedBills(tenantId, branchId);
  }

  @Delete('suspended/:id')
  async deleteSuspendedBill(
    @CurrentTenantId() tenantId: string,
    @Param('id') id: string,
  ) {
    return this.posService.deleteSuspendedBill(tenantId, id);
  }
}
