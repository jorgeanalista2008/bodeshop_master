import { Controller, Get, Post, Body, Param, UseGuards } from '@nestjs/common';
import { TransfersService, CreateTransferDto } from './transfers.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('transfers')
export class TransfersController {
  constructor(private readonly transfersService: TransfersService) {}

  @Get()
  async findAll(@CurrentTenantId() tenantId: string) {
    return this.transfersService.findAll(tenantId);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreateTransferDto,
  ) {
    return this.transfersService.create(tenantId, user.userId, dto);
  }

  @Post(':id/complete')
  async complete(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Param('id') id: string,
  ) {
    return this.transfersService.complete(tenantId, user.userId, id);
  }
}
