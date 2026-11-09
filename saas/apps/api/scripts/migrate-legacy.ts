import { PrismaClient, Role } from '@prisma/client';
import * as argon2 from 'argon2';

const prisma = new PrismaClient();

async function runMigration() {
  console.log('=====================================================');
  console.log('🚀 INICIANDO ETL DE MIGRACIÓN: LEGACY (SMA) -> POSTGRESQL SAAS');
  console.log('=====================================================');

  // 1. Crear o Asegurar Tenant Maestro de BodeShop
  console.log('\n[Paso 1] Creando Organización Maestra para BodeShop Master...');
  let enterprisePlan = await prisma.saaSPlan.findUnique({ where: { code: 'enterprise' } });
  if (!enterprisePlan) {
    enterprisePlan = await prisma.saaSPlan.create({
      data: {
        code: 'enterprise',
        name: 'Plan Enterprise BodeShop',
        priceMonthly: 0,
        priceYearly: 0,
        maxBranches: 999,
        maxWarehouses: 999,
        maxUsers: 999,
        maxProducts: 999999,
        hasAdvancedReports: true,
        hasApiAccess: true,
      },
    });
  }

  const tenant = await prisma.tenant.upsert({
    where: { slug: 'bodeshop' },
    update: {},
    create: {
      slug: 'bodeshop',
      legalName: 'BodeShop Master C.A.',
      tradeName: 'BodeShop Master',
      taxId: 'J-50012345-0',
      email: 'contacto@bodeshop.com',
      phone: '+58 212 555-0199',
      subscription: {
        create: {
          planId: enterprisePlan.id,
          status: 'ACTIVE',
          billingCycle: 'YEARLY',
          currentPeriodStart: new Date(),
          currentPeriodEnd: new Date(Date.now() + 365 * 24 * 60 * 60 * 1000),
        },
      },
    },
  });
  console.log(`✅ Tenant Creado/Asegurado: ${tenant.tradeName} (ID: ${tenant.id})`);

  // 2. Crear Sucursales Maestras (Sede Central y Sucursal Express)
  console.log('\n[Paso 2] Creando Sucursales y Almacenes de BodeShop...');
  const mainBranch = await prisma.branch.upsert({
    where: { tenantId_code: { tenantId: tenant.id, code: 'BODE-01' } },
    update: {},
    create: {
      tenantId: tenant.id,
      code: 'BODE-01',
      name: 'BodeShop Sede Principal',
      address: 'Av. Libertador, Edif. BodeShop',
      city: 'Caracas',
      isMain: true,
    },
  });

  const mainWarehouse = await prisma.warehouse.upsert({
    where: {
      tenantId_branchId_code: {
        tenantId: tenant.id,
        branchId: mainBranch.id,
        code: 'ALM-CENTRAL',
      },
    },
    update: {},
    create: {
      tenantId: tenant.id,
      branchId: mainBranch.id,
      code: 'ALM-CENTRAL',
      name: 'Almacén Central y Despacho',
    },
  });

  const expressBranch = await prisma.branch.upsert({
    where: { tenantId_code: { tenantId: tenant.id, code: 'BODE-02' } },
    update: {},
    create: {
      tenantId: tenant.id,
      code: 'BODE-02',
      name: 'BodeShop Tienda Express',
      address: 'Centro Comercial Sambil, Nivel Feria',
      city: 'Caracas',
      isMain: false,
    },
  });

  const expressWarehouse = await prisma.warehouse.upsert({
    where: {
      tenantId_branchId_code: {
        tenantId: tenant.id,
        branchId: expressBranch.id,
        code: 'ALM-EXPRESS',
      },
    },
    update: {},
    create: {
      tenantId: tenant.id,
      branchId: expressBranch.id,
      code: 'ALM-EXPRESS',
      name: 'Almacén Tienda Express',
    },
  });
  console.log(`✅ Sucursales configuradas: ${mainBranch.name} y ${expressBranch.name}`);

  // 3. Crear Usuario Administrador con Argon2
  console.log('\n[Paso 3] Creando Super Administrador de BodeShop...');
  const adminPassword = await argon2.hash('BodeShop2026##');
  const adminUser = await prisma.user.upsert({
    where: { tenantId_email: { tenantId: tenant.id, email: 'admin@bodeshop.com' } },
    update: {},
    create: {
      tenantId: tenant.id,
      email: 'admin@bodeshop.com',
      passwordHash: adminPassword,
      firstName: 'Administrador',
      lastName: 'BodeShop',
      role: Role.TENANT_OWNER,
      branchAccess: {
        create: [
          { branchId: mainBranch.id, isDefault: true },
          { branchId: expressBranch.id, isDefault: false },
        ],
      },
    },
  });
  console.log(`✅ Administrador Creado: ${adminUser.email} (Rol: ${adminUser.role})`);

  // 4. Migrar Categorías de SMA
  console.log('\n[Paso 4] Migrando Catálogo de Categorías...');
  const legacyCategories = [
    { code: 'CAT-BEB', name: 'Bebidas y Licores', slug: 'bebidas-y-licores' },
    { code: 'CAT-ALIM', name: 'Alimentos y Abarrotes', slug: 'alimentos-y-abarrotes' },
    { code: 'CAT-LIM', name: 'Cuidado Personal y Limpieza', slug: 'limpieza-personal' },
    { code: 'CAT-SNACK', name: 'Snacks y Golosinas', slug: 'snacks-golosinas' },
    { code: 'CAT-ELEC', name: 'Electrónica y Accesorios', slug: 'electronica-accesorios' },
  ];

  const categoryMap = new Map<string, string>();
  for (const cat of legacyCategories) {
    const createdCat = await prisma.category.upsert({
      where: { tenantId_code: { tenantId: tenant.id, code: cat.code } },
      update: {},
      create: {
        tenantId: tenant.id,
        code: cat.code,
        name: cat.name,
        slug: cat.slug,
      },
    });
    categoryMap.set(cat.code, createdCat.id);
  }
  console.log(`✅ ${categoryMap.size} Categorías migradas.`);

  // 5. Migrar Productos con Stock Inicial y Movimientos Kárdex
  console.log('\n[Paso 5] Migrando Productos y Existencias a Almacén Central...');
  const legacyProducts = [
    { code: 'PROD-001', name: 'Harina de Maíz Precocida 1kg', cost: 0.90, price: 1.45, stock: 150, cat: 'CAT-ALIM' },
    { code: 'PROD-002', name: 'Arroz Blanco Grano Entero 1kg', cost: 0.85, price: 1.30, stock: 200, cat: 'CAT-ALIM' },
    { code: 'PROD-003', name: 'Aceite Vegetal Comestible 1L', cost: 1.80, price: 2.75, stock: 90, cat: 'CAT-ALIM' },
    { code: 'PROD-004', name: 'Café Tostado y Molido 500g', cost: 2.50, price: 3.90, stock: 120, cat: 'CAT-ALIM' },
    { code: 'PROD-005', name: 'Refresco Cola Botella 2L', cost: 1.20, price: 2.10, stock: 80, cat: 'CAT-BEB' },
    { code: 'PROD-006', name: 'Agua Mineral Mineralizada 5L', cost: 1.00, price: 1.85, stock: 65, cat: 'CAT-BEB' },
    { code: 'PROD-007', name: 'Detergente en Polvo Multiuso 1kg', cost: 1.60, price: 2.60, stock: 110, cat: 'CAT-LIM' },
    { code: 'PROD-008', name: 'Jabón de Tocador Cremoso 3-pack', cost: 1.10, price: 1.95, stock: 140, cat: 'CAT-LIM' },
    { code: 'PROD-009', name: 'Papas Fritas Onduladas 150g', cost: 0.75, price: 1.50, stock: 95, cat: 'CAT-SNACK' },
    { code: 'PROD-010', name: 'Cable USB-C Carga Rápida 2m', cost: 2.10, price: 5.50, stock: 45, cat: 'CAT-ELEC' },
  ];

  for (const item of legacyProducts) {
    const categoryId = categoryMap.get(item.cat) || Array.from(categoryMap.values())[0];
    const slug = item.name.toLowerCase().replace(/[^a-z0-9]+/g, '-');

    const product = await prisma.product.upsert({
      where: { tenantId_code: { tenantId: tenant.id, code: item.code } },
      update: {},
      create: {
        tenantId: tenant.id,
        categoryId,
        code: item.code,
        name: item.name,
        slug,
        cost: item.cost,
        price: item.price,
        alertQuantity: 10,
        unit: 'UND',
      },
    });

    // Asignar Existencias en Almacén Central
    await prisma.warehouseStock.upsert({
      where: {
        tenantId_warehouseId_productId: {
          tenantId: tenant.id,
          warehouseId: mainWarehouse.id,
          productId: product.id,
        },
      },
      update: {},
      create: {
        tenantId: tenant.id,
        warehouseId: mainWarehouse.id,
        productId: product.id,
        quantity: item.stock,
      },
    });

    // Inyectar en Kárdex
    await prisma.stockMovement.create({
      data: {
        tenantId: tenant.id,
        warehouseId: mainWarehouse.id,
        productId: product.id,
        type: 'ADJUSTMENT',
        quantityDelta: item.stock,
        balanceAfter: item.stock,
        unitCost: item.cost,
        userId: adminUser.id,
        referenceId: 'MIGRACION_INICIAL_SMA',
      },
    });
  }
  console.log(`✅ ${legacyProducts.length} Productos importados con Kárdex inicial.`);

  console.log('\n=====================================================');
  console.log('🎉 MIGRACIÓN DE DATOS COMPLETADA CON ÉXITO');
  console.log('=====================================================');
  console.log(`Credenciales de acceso para BodeShop Master:`);
  console.log(`- Subdominio / Slug: bodeshop`);
  console.log(`- Correo: admin@bodeshop.com`);
  console.log(`- Contraseña: BodeShop2026##`);
}

runMigration()
  .catch((e) => {
    console.error('❌ Error en proceso ETL:', e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
