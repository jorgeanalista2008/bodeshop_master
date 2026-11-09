import { Injectable, NotFoundException, BadRequestException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

@Injectable()
export class SubscriptionsService {
  constructor(private readonly prisma: PrismaService) {}

  async getSubscriptionDetails(tenantId: string) {
    const tenant = await this.prisma.tenant.findUnique({
      where: { id: tenantId },
      include: {
        subscription: {
          include: { plan: true },
        },
      },
    });

    if (!tenant || !tenant.subscription) {
      throw new NotFoundException('Suscripción no encontrada');
    }

    // Calcular consumo actual de recursos
    const [branchCount, productCount, userCount] = await Promise.all([
      this.prisma.branch.count({ where: { tenantId, isActive: true } }),
      this.prisma.product.count({ where: { tenantId, isActive: true } }),
      this.prisma.user.count({ where: { tenantId, isActive: true } }),
    ]);

    const plan = tenant.subscription.plan;

    return {
      status: tenant.subscription.status,
      billingCycle: tenant.subscription.billingCycle,
      currentPeriodEnd: tenant.subscription.currentPeriodEnd,
      plan: {
        code: plan.code,
        name: plan.name,
        description: plan.description,
        priceMonthly: Number(plan.priceMonthly),
        priceYearly: Number(plan.priceYearly),
        quotas: {
          maxBranches: plan.maxBranches,
          usedBranches: branchCount,
          branchesAvailable: Math.max(0, plan.maxBranches - branchCount),

          maxProducts: plan.maxProducts,
          usedProducts: productCount,
          productsAvailable: Math.max(0, plan.maxProducts - productCount),

          maxUsers: plan.maxUsers,
          usedUsers: userCount,
        },
        features: {
          hasAdvancedReports: plan.hasAdvancedReports,
          hasApiAccess: plan.hasApiAccess,
        },
      },
    };
  }

  async getAllPlans() {
    return this.prisma.saaSPlan.findMany({
      orderBy: { priceMonthly: 'asc' },
    });
  }

  async upgradePlan(tenantId: string, planCode: string) {
    const targetPlan = await this.prisma.saaSPlan.findUnique({
      where: { code: planCode },
    });

    if (!targetPlan) {
      throw new BadRequestException(`El plan "${planCode}" no existe.`);
    }

    const updated = await this.prisma.subscription.update({
      where: { tenantId },
      data: {
        planId: targetPlan.id,
        status: 'ACTIVE',
        currentPeriodStart: new Date(),
        currentPeriodEnd: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000), // 30 días adicionales
      },
      include: { plan: true },
    });

    return {
      message: `¡Plan actualizado exitosamente al nivel ${targetPlan.name}!`,
      newPlan: targetPlan.name,
      maxBranches: targetPlan.maxBranches,
      maxProducts: targetPlan.maxProducts,
      periodEnd: updated.currentPeriodEnd,
    };
  }
}
