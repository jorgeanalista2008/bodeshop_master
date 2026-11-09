const { PrismaClient } = require('@prisma/client');
const prisma = new PrismaClient();

async function check() {
  const tenant = await prisma.tenant.findUnique({ where: { slug: 'cristaleria' } });
  if (!tenant) {
    console.log('Tenant cristaleria no encontrado');
    return;
  }
  const pCount = await prisma.product.count({ where: { tenantId: tenant.id } });
  const stockCount = await prisma.warehouseStock.count({ where: { tenantId: tenant.id } });
  const catCount = await prisma.category.count({ where: { tenantId: tenant.id } });
  const brCount = await prisma.brand.count({ where: { tenantId: tenant.id } });
  const adjCount = await prisma.adjustment.count({ where: { tenantId: tenant.id } });
  const whCount = await prisma.warehouse.count({ where: { tenantId: tenant.id } });
  const custCount = await prisma.customer.count({ where: { tenantId: tenant.id } });
  const suppCount = await prisma.supplier.count({ where: { tenantId: tenant.id } });

  console.log('===========================================================');
  console.log('💎 CRISTALERÍA LATINOAMERICANA EN POSTGRESQL (MIGRADA)');
  console.log('===========================================================');
  console.log('Tenant ID:', tenant.id);
  console.log('Almacenes:', whCount);
  console.log('Productos en Catálogo:', pCount);
  console.log('Registros de Stock por Almacén:', stockCount);
  console.log('Categorías:', catCount);
  console.log('Marcas:', brCount);
  console.log('Clientes:', custCount);
  console.log('Proveedores:', suppCount);
  console.log('Ajustes de Inventario:', adjCount);
  console.log('===========================================================');

  await prisma.$disconnect();
}

check().catch(console.error);
