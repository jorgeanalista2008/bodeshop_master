import { Controller, Get, Post, Body, UseGuards } from '@nestjs/common';
import { SubscriptionsService } from './subscriptions.service';
import { AuthGuard } from '@nestjs/passport';
import { CurrentTenantId } from '../../common/decorators/tenant.decorator';

@Controller('subscriptions')
export class SubscriptionsController {
  constructor(private readonly subscriptionsService: SubscriptionsService) {}

  @Get('plans')
  async getAllPlans() {
    return this.subscriptionsService.getAllPlans();
  }

  @UseGuards(AuthGuard('jwt'))
  @Get('my-plan')
  async getMyPlan(@CurrentTenantId() tenantId: string) {
    return this.subscriptionsService.getSubscriptionDetails(tenantId);
  }

  @UseGuards(AuthGuard('jwt'))
  @Post('upgrade')
  async upgradePlan(
    @CurrentTenantId() tenantId: string,
    @Body('planCode') planCode: string,
  ) {
    return this.subscriptionsService.upgradePlan(tenantId, planCode);
  }
}
