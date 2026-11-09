import { PrismaClient } from '@prisma/client';
import * as fs from 'fs';
import * as readline from 'readline';
import * as argon2 from 'argon2';

const prisma = new PrismaClient();

// Helper para parsear tuplas de VALUES de SQL
function parseSQLValues(sqlChunk: string): any[][] {
  const rows: any[][] = [];
  let inString = false;
  let escape = false;
  let currentVal = '';
  let currentRow: any[] = [];
  let inRow = false;

  for (let i = 0; i < sqlChunk.length; i++) {
    const c = sqlChunk[i];

    if (escape) {
      currentVal += c;
      escape = false;
      continue;
    }

    if (c === '\\') {
      escape = true;
      continue;
    }

    if (c === "'") {
      inString = !inString;
      continue;
    }

    if (inString) {
      currentVal += c;
      continue;
    }

    if (c === '(' && !inRow) {
      inRow = true;
      currentRow = [];
      currentVal = '';
      continue;
    }

    if (c === ')' && inRow) {
      inRow = false;
      const v = currentVal.trim();
      currentRow.push(v === 'NULL' ? null : v);
      rows.push(currentRow);
      currentVal = '';
      continue;
    }

    if (c === ',' && inRow) {
      const v = currentVal.trim();
      currentRow.push(v === 'NULL' ? null : v);
      currentVal = '';
      continue;
    }

    if (inRow) {
      currentVal += c;
    }
  }

  return rows;
}

async function extractTableData(filePath: string, targetTable: string): Promise<any[][]> {
  const rl = readline.createInterface({
    input: fs.createReadStream(filePath),
    crlfDelay: Infinity,
  });

  const allRows: any[][] = [];
  let capturing = false;
  let buffer = '';

  for await (const line of rl) {
    if (line.startsWith(`INSERT INTO \`${targetTable}\``)) {
      capturing = true;
      buffer = line;
      if (line.trim().endsWith(';')) {
        const valPart = buffer.substring(buffer.indexOf('VALUES') + 6);
        allRows.push(...parseSQLValues(valPart));
        capturing = false;
        buffer = '';
      }
      continue;
    }

    if (capturing) {
      buffer += ' ' + line;
      if (line.trim().endsWith(';')) {
        const valPart = buffer.substring(buffer.indexOf('VALUES') + 6);
        allRows.push(...parseSQLValues(valPart));
        capturing = false;
        buffer = '';
      }
    }
  }

  return allRows;
}

async function runETL() {
  const dumpPath = 'd:/github/bodeshop_master/u646234231_cristal_gus.sql';
  console.log('🚀 Iniciando proceso ETL desde:', dumpPath);

  // 1. Obtener o crear Tenant 'cristaleria'
  const tenantSlug = 'cristaleria';
  let tenant = await prisma.tenant.findUnique({ where: { slug: tenantSlug } });
  if (!tenant) {
    tenant = await prisma.tenant.create({
      data: {
        slug: tenantSlug,
        legalName: 'Cristalería Latinoamericana C.A.',
        tradeName: 'Cristalería Latinoamericana',
        taxId: 'J-12345678-9',
        email: 'contacto@cristalerialatinoamericana.com',
        phone: '0254-5670552',
        isActive: true,
      },
    });
    console.log('✅ Tenant creado:', tenant.tradeName, `(${tenant.id})`);
  } else {
    console.log('ℹ️ Usando Tenant existente:', tenant.tradeName);
  }

  // 2. Crear o verificar Sucursal Principal
  let branch = await prisma.branch.findFirst({
    where: { tenantId: tenant.id, isMain: true },
  });
  if (!branch) {
    branch = await prisma.branch.create({
      data: {
        tenantId: tenant.id,
        code: 'MAIN',
        name: 'Sede Principal - San Felipe',
        address: 'Av. Libertador con Calle 7',
        city: 'San Felipe',
        state: 'Yaracuy',
        isMain: true,
        isActive: true,
      },
    });
    console.log('✅ Sucursal Principal creada:', branch.name);
  }

  // 3. Crear Almacenes desde sma_warehouses
  const rawWarehouses = await extractTableData(dumpPath, 'sma_warehouses');
  const warehouseMap = new Map<string, string>(); // oldId -> newUuid

  for (const row of rawWarehouses) {
    const oldId = String(row[0]);
    const code = String(row[1]);
    const name = String(row[2]);
    const address = row[3] ? String(row[3]) : null;

    let w = await prisma.warehouse.findFirst({
      where: { tenantId: tenant.id, branchId: branch.id, code },
    });
    if (!w) {
      w = await prisma.warehouse.create({
        data: {
          tenantId: tenant.id,
          branchId: branch.id,
          code,
          name,
          address,
        },
      });
      console.log(`✅ Almacén creado: ${name} (Cod: ${code})`);
    }
    warehouseMap.set(oldId, w.id);
  }

  // Si no había en la tabla o fallback, asegurar un almacén default
  let defaultWarehouseId = warehouseMap.get('1') || warehouseMap.get('60') || Array.from(warehouseMap.values())[0];
  if (!defaultWarehouseId) {
    const defW = await prisma.warehouse.create({
      data: {
        tenantId: tenant.id,
        branchId: branch.id,
        code: 'ALM-1',
        name: 'Almacén Central',
      },
    });
    defaultWarehouseId = defW.id;
    warehouseMap.set('default', defW.id);
  }

  // 4. Migrar Unidades (sma_units)
  const rawUnits = await extractTableData(dumpPath, 'sma_units');
  const unitMap = new Map<string, string>(); // oldId -> newUuid

  for (const row of rawUnits) {
    const oldId = String(row[0]);
    const code = String(row[1]);
    const name = String(row[2]);

    let u = await prisma.unit.findFirst({
      where: { tenantId: tenant.id, code },
    });
    if (!u) {
      u = await prisma.unit.create({
        data: { tenantId: tenant.id, code, name },
      });
    }
    unitMap.set(oldId, u.id);
  }
  console.log(`✅ Unidades migradas: ${unitMap.size}`);

  // 5. Migrar Categorías (sma_categories)
  const rawCats = await extractTableData(dumpPath, 'sma_categories');
  const categoryMap = new Map<string, string>(); // oldId -> newUuid

  for (const row of rawCats) {
    const oldId = String(row[0]);
    const code = String(row[1] || `CAT-${oldId}`);
    const name = String(row[2] || 'Sin Nombre');
    const slug = (row[4] ? String(row[4]) : code.toLowerCase()).replace(/[^a-z0-9_-]/gi, '-');

    let cat = await prisma.category.findFirst({
      where: { tenantId: tenant.id, code },
    });
    if (!cat) {
      cat = await prisma.category.create({
        data: {
          tenantId: tenant.id,
          code,
          name,
          slug: `${slug}-${oldId}`,
        },
      });
    }
    categoryMap.set(oldId, cat.id);
  }
  console.log(`✅ Categorías migradas: ${categoryMap.size}`);

  // Fallback categoría si no hay
  let defaultCategoryId = Array.from(categoryMap.values())[0];
  if (!defaultCategoryId) {
    const defCat = await prisma.category.create({
      data: {
        tenantId: tenant.id,
        code: 'GENERAL',
        name: 'General',
        slug: 'general',
      },
    });
    defaultCategoryId = defCat.id;
  }

  // 6. Migrar Marcas (sma_brands)
  const rawBrands = await extractTableData(dumpPath, 'sma_brands');
  const brandMap = new Map<string, string>(); // oldId -> newUuid

  for (const row of rawBrands) {
    const oldId = String(row[0]);
    const code = String(row[1] || `BR-${oldId}`);
    const name = String(row[2] || 'Marca General');

    let br = await prisma.brand.findFirst({
      where: { tenantId: tenant.id, code },
    });
    if (!br) {
      br = await prisma.brand.create({
        data: { tenantId: tenant.id, code, name },
      });
    }
    brandMap.set(oldId, br.id);
  }
  console.log(`✅ Marcas migradas: ${brandMap.size}`);

  // 7. Migrar Productos (sma_products - 326 productos)
  const rawProducts = await extractTableData(dumpPath, 'sma_products');
  const productMap = new Map<string, string>(); // oldId -> newUuid
  let productsCreated = 0;

  for (const row of rawProducts) {
    const oldId = String(row[0]);
    const code = String(row[1] || `PROD-${oldId}`).trim();
    const name = String(row[2] || 'Producto sin nombre').trim();
    const unitOldId = row[3] ? String(row[3]) : null;
    const cost = Number(row[4]) || 0;
    const price = Number(row[5]) || 0;
    const alertQty = Number(row[6]) || 5;
    const catOldId = row[8] ? String(row[8]) : null;
    const barcode = row[21] ? String(row[21]) : 'code128';
    const brandOldId = row[47] ? String(row[47]) : null;
    const slugBase = (row[48] ? String(row[48]) : code.toLowerCase()).replace(/[^a-z0-9_-]/gi, '-');

    const categoryId = (catOldId && categoryMap.get(catOldId)) || defaultCategoryId;
    const brandId = brandOldId ? brandMap.get(brandOldId) : null;
    const unitId = unitOldId ? unitMap.get(unitOldId) : null;

    let p = await prisma.product.findFirst({
      where: { tenantId: tenant.id, code },
    });

    if (!p) {
      p = await prisma.product.create({
        data: {
          tenantId: tenant.id,
          code,
          name,
          slug: `${slugBase}-${oldId}`,
          barcode,
          cost,
          price,
          alertQuantity: alertQty,
          categoryId,
          brandId,
          unitId,
          isActive: true,
        },
      });
      productsCreated++;
    }
    productMap.set(oldId, p.id);
  }
  console.log(`✅ Productos procesados: ${productMap.size} (${productsCreated} nuevos creados)`);

  // 8. Migrar Existencias de Almacén (sma_warehouses_products - 815 registros)
  const rawStock = await extractTableData(dumpPath, 'sma_warehouses_products');
  let stockCreated = 0;

  for (const row of rawStock) {
    const prodOldId = String(row[1]);
    const whOldId = String(row[2]);
    const qty = Number(row[3]) || 0;

    const productId = productMap.get(prodOldId);
    const warehouseId = warehouseMap.get(whOldId) || defaultWarehouseId;

    if (productId && warehouseId) {
      await prisma.warehouseStock.upsert({
        where: {
          tenantId_warehouseId_productId: {
            tenantId: tenant.id,
            warehouseId,
            productId,
          },
        },
        update: { quantity: qty },
        create: {
          tenantId: tenant.id,
          warehouseId,
          productId,
          quantity: qty,
        },
      });
      stockCreated++;
    }
  }
  console.log(`✅ Registros de Stock en Almacenes migrados: ${stockCreated}`);

  // 9. Crear Usuario Administrador de Cristalería
  const adminEmail = 'admin@cristaleria.com';
  let adminUser = await prisma.user.findFirst({
    where: { tenantId: tenant.id, email: adminEmail },
  });

  if (!adminUser) {
    const passwordHash = await argon2.hash('Cristaleria2026##');
    adminUser = await prisma.user.create({
      data: {
        tenantId: tenant.id,
        email: adminEmail,
        passwordHash,
        firstName: 'Administrador',
        lastName: 'Cristalería',
        role: 'TENANT_ADMIN',
        isActive: true,
      },
    });

    await prisma.userBranch.create({
      data: {
        userId: adminUser.id,
        branchId: branch.id,
        isDefault: true,
      },
    });
    console.log(`✅ Usuario administrador creado: ${adminEmail} (Clave: Cristaleria2026##)`);
  }

  // 10. Migrar Clientes y Proveedores (sma_companies - 12 registros)
  const rawCompanies = await extractTableData(dumpPath, 'sma_companies');
  let customersCount = 0;
  let suppliersCount = 0;

  for (const row of rawCompanies) {
    const groupName = String(row[2] || '').toLowerCase(); // customer, supplier, biller
    const name = String(row[5] || row[6] || 'Empresa').trim();
    const taxId = row[7] ? String(row[7]).trim() : `RIF-${row[0]}`;
    const address = row[8] ? String(row[8]) : null;
    const phone = row[13] ? String(row[13]) : null;
    const email = row[14] ? String(row[14]) : `empresa${row[0]}@correo.com`;

    if (groupName.includes('customer')) {
      await prisma.customer.upsert({
        where: { tenantId_taxId: { tenantId: tenant.id, taxId } },
        update: {},
        create: {
          tenantId: tenant.id,
          name,
          taxId,
          address,
          phone,
          email,
        },
      });
      customersCount++;
    } else if (groupName.includes('supplier')) {
      await prisma.supplier.upsert({
        where: { tenantId_taxId: { tenantId: tenant.id, taxId } },
        update: {},
        create: {
          tenantId: tenant.id,
          name,
          taxId,
          address,
          phone,
          email,
        },
      });
      suppliersCount++;
    }
  }
  console.log(`✅ Contactos migrados: ${customersCount} clientes, ${suppliersCount} proveedores`);

  // 11. Migrar Monedas (sma_currencies) y Tasas
  const rawCurrencies = await extractTableData(dumpPath, 'sma_currencies');
  for (const row of rawCurrencies) {
    const code = String(row[1] || 'USD');
    const name = String(row[2] || code);
    const symbol = String(row[3] || '$');
    const rate = Number(row[4]) || 1;

    await prisma.currency.upsert({
      where: { tenantId_code: { tenantId: tenant.id, code } },
      update: { rate },
      create: {
        tenantId: tenant.id,
        code,
        name,
        symbol,
        rate,
        isDefault: code === 'USD',
      },
    });
  }
  console.log('✅ Monedas migradas exitosamente.');

  // 12. Migrar Ajustes de Inventario Históricos (sma_adjustments - 108 registros)
  const rawAdjustments = await extractTableData(dumpPath, 'sma_adjustments');
  const adjustmentMap = new Map<string, string>();

  for (const row of rawAdjustments) {
    const oldId = String(row[0]);
    const refNo = String(row[2] || `ADJ-${oldId}`);
    const whOldId = String(row[3]);
    const note = row[4] ? String(row[4]) : null;
    const warehouseId = warehouseMap.get(whOldId) || defaultWarehouseId;

    const adj = await prisma.adjustment.upsert({
      where: { tenantId_referenceNo: { tenantId: tenant.id, referenceNo: refNo } },
      update: {},
      create: {
        tenantId: tenant.id,
        warehouseId,
        referenceNo: refNo,
        note,
        createdById: adminUser.id,
      },
    });
    adjustmentMap.set(oldId, adj.id);
  }

  // Renglones de Ajustes (sma_adjustment_items - 112 registros)
  const rawAdjItems = await extractTableData(dumpPath, 'sma_adjustment_items');
  let adjItemsCount = 0;
  for (const row of rawAdjItems) {
    const adjOldId = String(row[1]);
    const prodOldId = String(row[2]);
    const qty = Number(row[4]) || 1;
    const type = String(row[7] || 'addition').toLowerCase();

    const adjustmentId = adjustmentMap.get(adjOldId);
    const productId = productMap.get(prodOldId);

    if (adjustmentId && productId) {
      await prisma.adjustmentItem.create({
        data: {
          tenantId: tenant.id,
          adjustmentId,
          productId,
          quantity: qty,
          type,
        },
      });
      adjItemsCount++;
    }
  }
  console.log(`✅ Ajustes de inventario migrados: ${adjustmentMap.size} cabeceras, ${adjItemsCount} ítems.`);

  console.log('\n======================================================');
  console.log('🎉 PROCESO ETL COMPLETADO CON ÉXITO');
  console.log(`Tenant: ${tenant.tradeName} (slug: ${tenant.slug})`);
  console.log(`Admin Login: ${adminEmail} | Clave: Cristaleria2026##`);
  console.log('======================================================');
}

runETL()
  .catch((err) => {
    console.error('❌ Error durante la migración ETL:', err);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
