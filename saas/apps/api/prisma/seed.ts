import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

async function main() {
  console.log('🌱 Sembrando planes SaaS en PostgreSQL...');

  // 1. Plan Inicial / Starter
  await prisma.saaSPlan.upsert({
    where: { code: 'starter' },
    update: {},
    create: {
      code: 'starter',
      name: 'Plan Starter (Microempresa)',
      description: 'Ideal para 1 sola tienda o comercio físico con 1 punto de venta.',
      priceMonthly: 19.99,
      priceYearly: 199.99,
      maxBranches: 1,
      maxWarehouses: 1,
      maxUsers: 2,
      maxProducts: 500,
      hasAdvancedReports: false,
      hasApiAccess: false,
    },
  });

  // 2. Plan Profesional
  await prisma.saaSPlan.upsert({
    where: { code: 'pro' },
    update: {},
    create: {
      code: 'pro',
      name: 'Plan Profesional (Multi-Sucursal)',
      description: 'Diseñado para empresas en crecimiento con múltiples sedes y cajas simultáneas.',
      priceMonthly: 49.99,
      priceYearly: 499.99,
      maxBranches: 5,
      maxWarehouses: 5,
      maxUsers: 10,
      maxProducts: 10000,
      hasAdvancedReports: true,
      hasApiAccess: false,
    },
  });

  // 3. Plan Enterprise
  await prisma.saaSPlan.upsert({
    where: { code: 'enterprise' },
    update: {},
    create: {
      code: 'enterprise',
      name: 'Plan Enterprise (Corporativo)',
      description: 'Sucursales ilimitadas, múltiples almacenes, auditoría total y acceso a API REST.',
      priceMonthly: 99.99,
      priceYearly: 999.99,
      maxBranches: 999,
      maxWarehouses: 999,
      maxUsers: 999,
      maxProducts: 999999,
      hasAdvancedReports: true,
      hasApiAccess: true,
    },
  });

  console.log('✅ Planes SaaS sembrados con éxito.');
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
