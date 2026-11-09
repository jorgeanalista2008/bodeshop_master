import { Controller, Get, Post, Body, Param, UseGuards } from '@nestjs/common';
import { ProductsService, CreateProductDto } from './products.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('products')
export class ProductsController {
  constructor(private readonly productsService: ProductsService) {}

  @Get()
  async findAll(@CurrentTenantId() tenantId: string) {
    return this.productsService.findAll(tenantId);
  }

  @Get(':id')
  async findOne(@CurrentTenantId() tenantId: string, @Param('id') id: string) {
    return this.productsService.findOne(tenantId, id);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreateProductDto,
  ) {
    return this.productsService.create(tenantId, dto, user.userId);
  }
}
