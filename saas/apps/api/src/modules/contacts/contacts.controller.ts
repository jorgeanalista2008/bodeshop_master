import { Controller, Get, Post, Body, UseGuards } from '@nestjs/common';
import { ContactsService, CreateCustomerDto, CreateSupplierDto } from './contacts.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId } from '../../common/decorators/tenant.decorator';

@UseGuards(AuthGuard('jwt'))
@Controller('contacts')
export class ContactsController {
  constructor(private readonly contactsService: ContactsService) {}

  @Get('customers')
  async getCustomers(@CurrentTenantId() tenantId: string) {
    return this.contactsService.findAllCustomers(tenantId);
  }

  @Post('customers')
  async createCustomer(
    @CurrentTenantId() tenantId: string,
    @Body() dto: CreateCustomerDto,
  ) {
    return this.contactsService.createCustomer(tenantId, dto);
  }

  @Get('suppliers')
  async getSuppliers(@CurrentTenantId() tenantId: string) {
    return this.contactsService.findAllSuppliers(tenantId);
  }

  @Post('suppliers')
  async createSupplier(
    @CurrentTenantId() tenantId: string,
    @Body() dto: CreateSupplierDto,
  ) {
    return this.contactsService.createSupplier(tenantId, dto);
  }
}
