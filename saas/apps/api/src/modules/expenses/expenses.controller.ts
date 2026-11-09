import { Controller, Get, Post, Body, UseGuards, Query } from '@nestjs/common';
import { ExpensesService, CreateExpenseDto } from './expenses.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId, CurrentUser } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('expenses')
export class ExpensesController {
  constructor(private readonly expensesService: ExpensesService) {}

  @Get()
  async findAll(
    @CurrentTenantId() tenantId: string,
    @Query('branchId') branchId?: string,
  ) {
    return this.expensesService.findAll(tenantId, branchId);
  }

  @Get('categories')
  async getCategories(@CurrentTenantId() tenantId: string) {
    return this.expensesService.getCategories(tenantId);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @CurrentUser() user: any,
    @Body() dto: CreateExpenseDto,
  ) {
    return this.expensesService.create(tenantId, user.userId, dto);
  }
}
