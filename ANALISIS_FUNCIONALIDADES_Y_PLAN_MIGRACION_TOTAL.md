# Auditoría Funcional Exhaustiva y Plan de Migración Total
## De Monolito PHP (CodeIgniter 3) a Ecosistema SaaS B2B (NestJS + Next.js + PostgreSQL Multi-Tenant)

**Sistema Analizado:** Cristalería Latinoamericana / BodeShop Master (Stock Manager Advance 3.4.x)  
**Ubicación Legacy:** `C:\server\htdocs\www\cristaleria` / `d:\github\bodeshop_master`  
**Base de Datos Origen:** MySQL (`u646234231_cristal_gus`)  
**Arquitectura Destino:** Monorepo SaaS Multi-Tenant & Multi-Sucursal con PostgreSQL Row-Level Security (RLS)  
**Fecha:** 24 de Octubre de 2026  
**Auditor Responsable:** Analista de Sistemas Senior y Auditor de Arquitectura  

---

## 1. Mapeo Integral de Módulos y Funcionalidades del Sistema Legacy

Tras la inspección profunda de todos los controladores (`app/controllers/admin/`), modelos (`app/models/admin/`), librerías (`app/libraries/`) y submódulos satélites (`servicio/` y `tasa/`), se identifican los siguientes 8 macro-dominios de negocio:

```
                                  SISTEMA BOSHESHOP MASTER (SMA 3.4.x)
                                                  │
         ┌──────────────────┬─────────────────────┼─────────────────────┬──────────────────┐
         │                  │                     │                     │                  │
    [INVENTARIO]       [VENTAS / POS]         [COMPRAS]           [LOGÍSTICA]         [FINANZAS]
    - Catálogo         - POS Táctil           - Proveedores       - Traslados         - Gastos
    - Variantes        - Arqueos de Caja      - Órdenes Compra    - Tránsito          - Impuestos
    - Mermas           - Cuentas Suspendidas  - Devolución Compra - Kárdex            - Multi-Moneda
    - Auditoría Fís.   - Devolución Venta     - Costeo Promedio   - Despachos         - Utilidad / PnL
         │                  │                     │                     │                  │
         └──────────────────┴─────────────────────┼─────────────────────┴──────────────────┘
                                                  │
                                      [SUBMÓDULOS SATÉLITES]
                                      - Servicio Técnico (Órdenes de Trabajo)
                                      - Jorge Seguros (Pólizas / Siniestros)
```

---

### Módulo 1: Catálogo, Existencias y Costeo de Mercancía

* **Archivos Fuente:** `app/controllers/admin/Products.php`, `app/models/admin/Products_model.php`, `app/models/Site.php`.
* **Funcionalidades de Negocio:**
  1. **Tipos de Producto:**
     - `standard`: Producto físico simple con control estricto de existencias por almacén.
     - `combo`: Paquetes o kits integrados por múltiples productos estándar (`sma_combo_items`). Al venderse el combo, se descuentan las piezas hijas.
     - `service`: Ítems intangibles o servicios (mano de obra, flete) sin control de stock.
     - `digital`: Descargas o intangibles.
  2. **Atributos y Variantes (`sma_product_variants`):**
     - Manejo de tallas, colores o medidas con ajuste de costo y precio independiente (`additional_cost`, `additional_price`).
  3. **Métodos de Costeo y Valoración:**
     - *Promedio Ponderado Móvil (AVCO):* `new_avg_cost = ((current_qty * current_cost) + (received_qty * unit_cost)) / (current_qty + received_qty)`.
     - *Kárdex Histórico:* Registro de cada entrada y salida en `sma_costing`.
  4. **Ajustes de Inventario y Mermas (`sma_adjustments`):**
     - Salidas por daño, vencimiento o hurto (`subtraction`) y entradas extraordinarias (`addition`).
  5. **Conteos Físicos de Inventario (`sma_stock_counts`):**
     - Toma física de stock ciego o con libro teórico para conciliación de discrepancias.
  6. **Grupos de Precios Diferenciados (`sma_price_groups`):**
     - Escala de precios para Mayoristas, Distribuidores y Consumidor Final.

* **Aprovechamiento y Portabilidad a NestJS / PostgreSQL:**
  - **Entidades Prisma:** `Product`, `ProductVariant`, `WarehouseStock`, `StockMovement`, `Adjustment`, `AdjustmentItem`, `PriceGroup`.
  - **Patrón Moderno:** En lugar de sincronizaciones manuales con updates sueltos (`$this->site->syncQuantity()`), se implementa un **Libro Mayor Inmutable de Kárdex (`StockMovement`)**, garantizando que el stock actual sea la suma determinista de las transacciones con **bloqueo pesimista (`FOR UPDATE`)**.

---

### Módulo 2: Punto de Venta (POS) y Gestión de Caja Registradora

* **Archivos Fuente:** `app/controllers/admin/Pos.php`, `app/models/admin/Pos_model.php`, `themes/default/admin/views/pos/`.
* **Funcionalidades de Negocio:**
  1. **Control de Turnos y Arqueos de Caja (`sma_pos_register`):**
     - *Apertura:* Registro del fondo inicial en efectivo (`cash_in_hand`).
     - *Operación:* Bloqueo de facturación si el cajero no tiene un turno abierto.
     - *Cierre Z:* Arqueo ciego donde el cajero cuenta el dinero físico, se compara con el saldo teórico acumulado (Efectivo + Tarjeta + Cheque + Transferencia) y se registra la diferencia (`difference`).
  2. **Cuentas Suspendidas / En Espera (`sma_suspended_bills`):**
     - Posibilidad de pausar una venta en mostrador (ej. cliente fue a buscar otro producto) y atender a otro cliente, recuperando la canasta posteriormente.
  3. **Impresión Térmica ESC/POS:**
     - Compatibilidad con impresoras de ticket de 80mm y 58mm mediante comandos RAW y apertura automática de gaveta de dinero.

* **Aprovechamiento y Portabilidad a NestJS / PostgreSQL:**
  - **Entidades Prisma:** `PosRegister`, `PosSession`, `SuspendedBill`, `SuspendedItem`.
  - **Servicios NestJS:** `PosService::openRegister()`, `PosService::closeRegister()`, `PosService::suspendBill()`.
  - **Interfaz Next.js:** Terminal táctil en `/pos` optimizada para teclado numérico, lector de código de barras USB y atajos rápidos (F1 para cobrar, F2 para suspender).

---

### Módulo 3: Facturación, Ventas y Devoluciones

* **Archivos Fuente:** `app/controllers/admin/Sales.php`, `app/models/admin/Sales_model.php`, `app/controllers/admin/Returns.php`.
* **Funcionalidades de Negocio:**
  1. **Motor de Impuestos Compuestos:**
     - Método 0 (*Tax Inclusive*): El precio final ya incluye el impuesto: `base = price / (1 + rate)`.
     - Método 1 (*Tax Exclusive*): El impuesto se suma sobre el precio: `tax = price * rate`.
  2. **Descuentos Escalonados:**
     - Descuento por ítem (porcentaje o fijo) + Descuento global sobre el subtotal de la factura.
  3. **Múltiples Formas de Pago (`sma_payments`):**
     - Efectivo, Tarjeta de Débito/Crédito, Transferencia, Tarjeta de Regalo (*Gift Card*) y Depósitos en cuenta corriente del cliente.
  4. **Devoluciones de Venta (`sma_returns`):**
     - Emisión de nota de crédito que reingresa el producto devuelto al almacén específico y descuenta los puntos de lealtad del cliente.
  5. **Guías de Despacho y Logística (`sma_deliveries`):**
     - Seguimiento del estado de entrega a domicilio: `pending` -> `packing` -> `delivering` -> `delivered`.

* **Aprovechamiento y Portabilidad a NestJS / PostgreSQL:**
  - **Entidades Prisma:** `Sale`, `SaleItem`, `Payment`, `SaleReturn`, `Delivery`.
  - **Garantía ACID:** Transacción `@prisma.$transaction` con **bloqueo pesimista de stock** para evitar que dos cajeros simultáneos vendan la última unidad existente.

---

### Módulo 4: Compras, Proveedores y Devoluciones a Fabricantes

* **Archivos Fuente:** `app/controllers/admin/Purchases.php`, `app/models/admin/Purchases_model.php`.
* **Funcionalidades de Negocio:**
  1. **Recepción de Mercancía (`sma_purchases`):**
     - Estados de orden: `ordered` (compromiso sin stock), `pending` y `received` (incrementa stock y recalcula costo unitario).
  2. **Devoluciones a Proveedores (`sma_return_purchases`):**
     - Extracción de mercancía defectuosa del inventario con recargo o penalidad (`surcharge`).
  3. **Control de Pagos y Cuentas por Pagar:**
     - Registro de abonos parciales a facturas de proveedores.

* **Aprovechamiento y Portabilidad a NestJS / PostgreSQL:**
  - **Entidades Prisma:** `Purchase`, `PurchaseItem`, `PurchaseReturn`, `SupplierPayment`.
  - **Recálculo Automático:** Cada compra en estado `received` actualiza el costo base del producto para reportes de margen precisos.

---

### Módulo 5: Traslados y Logística Inter-Sucursal (Multi-Branch Transfers)

* **Archivos Fuente:** `app/controllers/admin/Transfers.php`, `app/models/admin/Transfers_model.php`.
* **Funcionalidades de Negocio:**
  1. **Ciclo de Vida del Traslado:**
     - `pending`: Traslado planificado, mercancía no se mueve.
     - `sent`: Mercancía sale del almacén de origen y entra en estado *In-Transit*.
     - `completed`: El almacén receptor confirma las cantidades y se acredita en su stock físico.
  2. **Costeo y Flete:**
     - Gastos de transporte prorrateados entre los ítems transferidos.

* **Aprovechamiento y Portabilidad a NestJS / PostgreSQL:**
  - **Entidades Prisma:** `Transfer`, `TransferItem`.
  - **Aislamiento Multi-Branch:** Trazabilidad estricta entre sedes físicas de una misma empresa, impidiendo que una sede modifique inventarios de otra sin permiso.

---

### Módulo 6: Presupuestos y Cotizaciones (Quotes)

* **Archivos Fuente:** `app/controllers/admin/Quotes.php`, `app/models/admin/Quotes_model.php`.
* **Funcionalidades de Negocio:**
  1. Emisión de cotizaciones formales con fecha de caducidad.
  2. **Conversión en 1 Clic a Factura de Venta (`quote2invoice`):** Sin tener que tipear nuevamente los ítems, validando disponibilidad de inventario en tiempo real.
  3. Conversión a Orden de Compra (`quote2purchase`) para reabastecimiento directo bajo pedido.

---

### Módulo 7: Finanzas, Gastos y Multi-Moneda

* **Archivos Fuente:** `app/controllers/admin/Purchases.php` (métodos de gastos), `app/controllers/admin/System_settings.php`.
* **Funcionalidades de Negocio:**
  1. **Gastos Operativos (`sma_expenses`):** Categorizados con centro de costos por sucursal.
  2. **Multi-Divisas (`sma_currencies`):** Manejo de tasa de cambio fija o dinámica (USD, EUR, Bolívares / Pesos) con conversión automática en el POS.
  3. **Tasas Impositivas (`sma_tax_rates`):** Exenciones fiscales (0%), IVA general (16%), retenciones.

---

### Módulo 8: Submódulos Satélites Integrados en el Repositorio

1. **Módulo de Servicio Técnico y Taller (`servicio/`):**
   - Sistema de Órdenes de Trabajo, recepción de equipos averiados, diagnósticos, repuestos consumidos y entregas con garantía.
2. **Módulo de Pólizas y Siniestros (`tasa/`):**
   - Sistema para corredurías de seguros (Jorge Seguros) con seguimiento de pólizas de automóviles, vencimientos y reclamos.

---

## 2. Matriz de Equivalencias: Código Legacy vs Arquitectura Moderna

| Dominio | Código Legacy (PHP / CodeIgniter 3) | Arquitectura Moderna (NestJS / Prisma) | Frontend Moderno (Next.js 15 / Mapbox Console) |
|---|---|---|---|
| **Catálogo** | `Products.php::add()`, `Products_model::addProduct()` | `ProductsService::create()`, `ProductsController` | Pestaña *Productos & Stock*, modal con validaciones Zod |
| **Kárdex & Stock** | `Site.php::syncQuantity()`, `sma_costing` | `WarehouseStock`, `StockMovement` (Transacción con `SELECT FOR UPDATE`) | Barra de existencias en tiempo real por almacén |
| **Arqueos POS** | `Pos.php::close_register()`, `Pos_model::closeRegister()` | `PosService::closeRegister()`, conciliación Z en `PosRegister` | Modal de Arqueo Ciego y reporte de diferencias |
| **Venta / Checkout** | `Sales.php::add()`, `Pos.php::add_sale()` | `SalesService::createSaleWithPessimisticLock()` | Terminal POS táctil con shortcuts (`/pos`) |
| **Cotizaciones** | `Quotes.php::add()`, `Quotes.php::quote2invoice()` | `QuotesService::create()`, `QuotesService::convertToSale()` | Pestaña *Presupuestos* con botón directo **Facturar** |
| **Transferencias** | `Transfers.php::add()`, `Transfers_model::addTransfer()` | `TransfersService::create()`, auditoría en `TransferItem` | Modal de traslados con almacén origen y destino |
| **Gastos** | `Purchases.php::add_expense()`, `sma_expenses` | `ExpensesService::create()`, `ExpensesController` | Formulario de comprobantes y categorías de egreso |
| **Analítica PnL** | `Reports.php::profit()`, consultas complejas SQL | `ReportsService::getProfitAndLoss()`, agregaciones nativas | Tarjetas estilo Mapbox Console con variación % |
| **Multi-Tenancy** | ❌ No existía (Monolito para 1 sola empresa) | ✅ **100% Nativo:** `TenantMiddleware`, RLS Policies en PostgreSQL | Switch rápido de empresa en login y aislamiento total |

---

## 3. Plan de Programación y Entrega por Fases

Para migrar la totalidad del código y aprovechar cada fórmula de negocio, la ejecución se estructura en las siguientes fases:

```
[FASE 1: NÚCLEO TRANSACCIONAL]  ===>  ✅ COMPLETADA
- Autenticación JWT y Argon2id con soporte Multi-Tenant.
- Esquema de Sucursales y Almacenes con cuotas por plan SaaS.
- Catálogo de Productos y Kárdex Inmutable.
- Checkout POS con Bloqueo Pesimista (ACID).
- Traslados Inter-Sucursal.
- Compras a Proveedores y Gastos Operativos.
- Cotizaciones con Facturación Automática en 1 Clic.
- Tablero Analítico estilo Mapbox Console con PnL.

[FASE 2: OPERACIONES AVANZADAS DE CAJA Y ALMACÉN]  ===>  ⏳ EN CURSO
- Mermas y Ajustes de Inventario (`Adjustment` y `AdjustmentItem`).
- Cuentas Suspendidas en el POS (`SuspendedBill`).
- Devoluciones de Venta con Nota de Crédito (`SaleReturn`).
- Devoluciones de Compra a Proveedores (`PurchaseReturn`).

[FASE 3: CRM DE CLIENTES Y CRÉDITO]
- Grupos de Clientes y Listas de Precios Mayoristas.
- Depósitos en Garantía y Pagos Anticipados.
- Despachos y Guías de Entrega a Domicilio (`Delivery`).

[FASE 4: SUBMÓDULO DE SERVICIO TÉCNICO]
- Órdenes de Trabajo y Reparaciones (`ServiceOrder`, `WorkTicket`) integradas al inventario de repuestos.
```

---

## 4. Conclusión y Garantía de Integridad

El código original de CodeIgniter 3 ha sido completamente auditado y desglosado. Todas sus fórmulas matemáticas (cálculo de impuestos inclusivos/exclusivos, descuentos, arqueos y márgenes) están siendo aprovechadas y reescritas bajo estándares de clase empresarial con TypeScript estricto, transacciones ACID seguras y aislamiento nativo por kernel mediante **PostgreSQL Row-Level Security**.
