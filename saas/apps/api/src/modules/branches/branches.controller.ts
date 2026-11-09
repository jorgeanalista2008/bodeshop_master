import { Controller, Get, Post, Body, UseGuards } from '@nestjs/common';
import { BranchesService, CreateBranchDto } from './branches.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('branches')
export class BranchesController {
  constructor(private readonly branchesService: BranchesService) {}

  @Get()
  async findAll(@CurrentTenantId() tenantId: string) {
    return this.branchesService.findAll(tenantId);
  }

  @Post()
  async create(
    @CurrentTenantId() tenantId: string,
    @Body() dto: CreateBranchDto,
  ) {
    return this.branchesService.create(tenantId, dto);
  }
}
