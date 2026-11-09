import { Controller, Get, Post, Body, Param, UseGuards } from '@nestjs/common';
import { QuotesService, CreateQuoteDto } from './quotes.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';
import { IsNotEmpty, IsOptional, IsString } from 'class-validator';

export class ConvertQuoteDto {
  @IsNotEmpty()
  @IsString()
  warehouseId: string;

  @IsOptional()
  @IsString()
  paymentMethod?: string;
}

@UseGuards(AuthGuard('jwt'))
@Controller('quotes')
export class QuotesController {
  constructor(private readonly quotesService: QuotesService) {}

  @Get()
  async findAll(@CurrentTenantId() tenantId: string) {
    return this.quotesService.findAll(tenantId);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreateQuoteDto,
  ) {
    return this.quotesService.create(tenantId, user.userId, dto);
  }

  @Post(':id/convert')
  async convertToSale(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Param('id') id: string,
    @Body() dto: ConvertQuoteDto,
  ) {
    return this.quotesService.convertToSale(
      tenantId,
      user.userId,
      id,
      dto.warehouseId,
      dto.paymentMethod || 'CASH',
    );
  }
}
