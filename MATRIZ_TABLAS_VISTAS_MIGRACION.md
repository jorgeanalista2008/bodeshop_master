# Matriz de Mapeo de Tablas MySQL, Vistas del Sistema y Estado de Migración

**Sistema de Origen:** BodeShop Master (Stock Manager Advance 3.4.x - MySQL)  
**Sistema de Destino:** Arquitectura SaaS Multi-Tenant (NestJS + Next.js + PostgreSQL)  
**Fecha:** 24 de Octubre de 2026  
**Auditor:** Analista de Sistemas Senior y Auditor de Arquitectura  

---

## 1. Mapeo Integral: 65 Tablas MySQL vs Vistas PHP vs Estado en PostgreSQL

A continuación se presenta la auditoría exhaustiva tabla por tabla de la base de datos MySQL original, identificando qué vistas de interfaz la gestionaban y en qué estado se encuentra dentro del nuevo stack moderno:

### Módulo A: Catálogo, Inventario y Almacenes

| # | Tabla MySQL (`sma_*`) | Vistas PHP Asociadas (`themes/default/admin/views/`) | Propósito de Negocio | Estado en PostgreSQL (Prisma/NestJS) |
|---|---|---|---|:---:|
| 1 | `sma_products` | `products/index.php`, `add.php`, `edit.php`, `view.php`, `modal_view.php` | Ficha maestra de productos, precios y costos | ✅ **Migrado** (`Product`) |
| 2 | `sma_categories` | `settings/categories.php`, `add_category.php`, `edit_category.php` | Árbol de categorías y subcategorías | ✅ **Migrado** (`Category`) |
| 3 | `sma_product_variants` | `products/add.php`, `settings/variants.php` | Variantes (tallas, colores, atributos) | ✅ **Migrado** (`ProductVariant`) |
| 4 | `sma_variants` | `settings/variants.php`, `add_variant.php`, `edit_variant.php` | Catálogo de tipos de variantes | ✅ **Normalizado** en `ProductVariant` |
| 5 | `sma_warehouses` | `settings/warehouses.php`, `add_warehouse.php`, `edit_warehouse.php` | Almacenes y depósitos físicos | ✅ **Migrado** (`Warehouse`) |
| 6 | `sma_warehouses_products` | `products/view.php`, `reports/warehouse_stock.php` | Existencias por almacén | ✅ **Migrado** (`WarehouseStock`) |
| 7 | `sma_warehouses_products_variants`| `products/view.php` | Existencias por variante y almacén | ✅ **Normalizado** en Kárdex |
| 8 | `sma_costing` | `sales/view.php`, `reports/profit.php` | Costo histórico y cálculo FIFO de salidas | ✅ **Superado** por `StockMovement` |
| 9 | `sma_adjustments` | `products/quantity_adjustments.php`, `add_adjustment.php` | Ajustes manuales por merma o daño | ⏳ **En Implementación** (`Adjustment`) |
| 10 | `sma_adjustment_items` | `products/view_adjustment.php` | Detalle de productos ajustados | ⏳ **En Implementación** (`AdjustmentItem`) |
| 11 | `sma_stock_counts` | `products/stock_counts.php`, `count_stock.php`, `finalize_count.php` | Conteos físicos periódicos de inventario | ⏳ **En Implementación** (`StockCount`) |
| 12 | `sma_stock_count_items` | `products/finalize_count.php` | Detalle de conteo vs stock teórico | ⏳ **En Implementación** (`StockCountItem`) |
| 13 | `sma_brands` | `settings/brands.php`, `add_brand.php`, `edit_brand.php` | Marcas de fabricantes | ✅ **Migrado** (`Brand`) |
| 14 | `sma_units` | `settings/units.php`, `add_unit.php`, `edit_unit.php` | Unidades de medida (KG, LT, UND, MTS) | ✅ **Migrado** (`Unit`) |
| 15 | `sma_product_photos` | `products/edit.php` (galería) | Galería múltiple de imágenes de producto | ⏳ **En Implementación** (`ProductPhoto`) |
| 16 | `sma_price_groups` | `settings/price_groups.php`, `add_price_group.php` | Grupos de precios (Mayorista, VIP, Detal) | ⏳ **En Implementación** (`PriceGroup`) |
| 17 | `sma_product_prices` | `settings/group_product_prices.php` | Precio de un producto en un grupo específico | ⏳ **En Implementación** (`ProductPrice`) |
| 18 | `sma_combo_items` | `products/add.php` (tipo combo) | Artículos contenidos en combos o packs | ⏳ **En Implementación** (`ComboItem`) |

---

### Módulo B: Ventas, Punto de Venta (POS) y Caja

| # | Tabla MySQL (`sma_*`) | Vistas PHP Asociadas (`themes/default/admin/views/`) | Propósito de Negocio | Estado en PostgreSQL (Prisma/NestJS) |
|---|---|---|---|:---:|
| 19 | `sma_sales` | `sales/sales.php`, `add.php`, `edit.php`, `view.php` | Cabecera de facturas y ventas | ✅ **Migrado** (`Sale`) |
| 20 | `sma_sale_items` | `sales/view.php`, `pos/view.php` | Renglones y productos vendidos | ✅ **Migrado** (`SaleItem`) |
| 21 | `sma_payments` | `sales/payments.php`, `add_payment.php`, `purchases/payments.php` | Registro de transacciones y cobros | ✅ **Migrado** (`Payment`) |
| 22 | `sma_pos_register` | `pos/registers.php`, `open_register.php`, `close_register.php` | Turnos de cajero, fondos y cierres Z | ✅ **Migrado** (`PosRegister`) |
| 23 | `sma_pos_settings` | `pos/settings.php` | Configuración de teclado, ticket e interfaz POS | ✅ **Migrado** en configuración |
| 24 | `sma_suspended_bills` | `pos/opened.php` | Cuentas suspendidas / en espera en caja | ⏳ **En Implementación** (`SuspendedBill`) |
| 25 | `sma_suspended_items` | `pos/opened.php` | Productos de cuentas en espera | ⏳ **En Implementación** (`SuspendedItem`) |
| 26 | `sma_deliveries` | `sales/deliveries.php`, `add_delivery.php`, `view_delivery.php` | Guías de despacho y entrega a domicilio | ⏳ **En Implementación** (`Delivery`) |
| 27 | `sma_gift_cards` | `sales/gift_cards.php`, `add_gift_card.php` | Tarjetas de regalo y monedero electrónico | ⏳ **En Implementación** (`GiftCard`) |
| 28 | `sma_gift_card_topups` | `sales/topup_gift_card.php` | Recargas de saldo a gift cards | ⏳ **En Implementación** (`GiftCardTopup`) |
| 29 | `sma_returns` | `returns/index.php`, `sales/return_sale.php` | Devoluciones de ventas y reintegro al stock | ⏳ **En Implementación** (`SaleReturn`) |
| 30 | `sma_return_items` | `returns/view.php` | Detalle de ítems devueltos | ⏳ **En Implementación** (`SaleReturnItem`) |
| 31 | `sma_printers` | `pos/printers.php`, `add_printer.php` | Impresoras térmicas de tickets ESC/POS | ⏳ **En Implementación** (`PosPrinter`) |

---

### Módulo C: Compras, Gastos y Proveedores

| # | Tabla MySQL (`sma_*`) | Vistas PHP Asociadas (`themes/default/admin/views/`) | Propósito de Negocio | Estado en PostgreSQL (Prisma/NestJS) |
|---|---|---|---|:---:|
| 32 | `sma_purchases` | `purchases/index.php`, `add.php`, `view.php`, `edit.php` | Órdenes de compra a proveedores | ✅ **Migrado** (`Purchase`) |
| 33 | `sma_purchase_items` | `purchases/view.php` | Detalle de renglones comprados | ✅ **Migrado** (`PurchaseItem`) |
| 34 | `sma_suppliers` | `suppliers/index.php`, `add.php`, `edit.php` | Directorio de empresas proveedoras | ✅ **Migrado** (`Supplier`) |
| 35 | `sma_expenses` | `purchases/expenses.php`, `add_expense.php`, `edit_expense.php` | Gastos operativos (alquiler, nómina, luz) | ✅ **Migrado** (`Expense`) |
| 36 | `sma_expense_categories` | `settings/expense_categories.php`, `add_expense_category.php` | Clasificación de egresos | ✅ **Migrado** (`ExpenseCategory`) |
| 37 | `sma_return_purchases` | `purchases/return_purchase.php` | Devoluciones de mercancía a proveedores | ⏳ **En Implementación** (`PurchaseReturn`) |
| 38 | `sma_return_purchase_items` | `purchases/view.php` | Renglones devueltos al proveedor | ⏳ **En Implementación** (`PurchaseReturnItem`) |

---

### Módulo D: Cotizaciones (Quotes) y CRM de Clientes

| # | Tabla MySQL (`sma_*`) | Vistas PHP Asociadas (`themes/default/admin/views/`) | Propósito de Negocio | Estado en PostgreSQL (Prisma/NestJS) |
|---|---|---|---|:---:|
| 39 | `sma_quotes` | `quotes/index.php`, `add.php`, `view.php`, `quote2invoice.php` | Presupuestos y cotizaciones convertibles a venta | ✅ **Migrado** (`Quote`) |
| 40 | `sma_quote_items` | `quotes/view.php` | Renglones de la cotización | ✅ **Migrado** (`QuoteItem`) |
| 41 | `sma_companies` | `customers/index.php`, `billers/index.php`, `suppliers/index.php` | Libreta centralizada de terceros | ✅ **Normalizado** (`Customer`, `Supplier`, `Branch`) |
| 42 | `sma_customer_groups` | `settings/customer_groups.php`, `add_customer_group.php` | Segmentación de clientes (Minorista/Mayorista) | ⏳ **En Implementación** (`CustomerGroup`) |
| 43 | `sma_deposits` | `customers/deposits.php`, `add_deposit.php` | Depósitos y pagos anticipados de clientes | ⏳ **En Implementación** (`CustomerDeposit`) |
| 44 | `sma_addresses` | `customers/addresses.php`, `add_address.php` | Direcciones de entrega de clientes | ✅ **Normalizado** en `Customer` / `Address` |

---

### Módulo E: Logística, Transferencias y Monedas

| # | Tabla MySQL (`sma_*`) | Vistas PHP Asociadas (`themes/default/admin/views/`) | Propósito de Negocio | Estado en PostgreSQL (Prisma/NestJS) |
|---|---|---|---|:---:|
| 45 | `sma_transfers` | `transfers/index.php`, `add.php`, `view.php` | Traslados de existencias entre sucursales | ✅ **Migrado** (`Transfer`) |
| 46 | `sma_transfer_items` | `transfers/view.php` | Productos en tránsito | ✅ **Migrado** (`TransferItem`) |
| 47 | `sma_currencies` | `settings/currencies.php`, `add_currency.php` | Multi-divisas y tasas cambiarias | ✅ **Migrado** (`Currency`) |
| 48 | `sma_tax_rates` | `settings/tax_rates.php`, `add_tax_rate.php` | Tasas de impuestos (IVA general, exento, etc.) | ✅ **Migrado** (`TaxRate`) |

---

### Módulo F: Usuarios, Permisos, Tienda Online y Sistema

| # | Tabla MySQL (`sma_*`) | Vistas PHP Asociadas (`themes/default/admin/views/`) | Propósito de Negocio | Estado en PostgreSQL (Prisma/NestJS) |
|---|---|---|---|:---:|
| 49 | `sma_users` | `auth/index.php`, `auth/create_user.php` | Cuentas de usuario y cajeros | ✅ **Migrado** (`User`) |
| 50 | `sma_groups` & `users_groups`| `auth/create_group.php` | Roles y agrupaciones | ✅ **Migrado** (`Role` Enum & `UserBranch`) |
| 51 | `sma_permissions` | `settings/permissions.php` | Matriz de permisos por grupo | ✅ **Migrado** mediante RBAC Guards |
| 52 | `sma_sessions` | Interno de CodeIgniter 3 | Sesiones en base de datos MySQL | ✅ **Superado** por JWT + Cookies Seguras |
| 53 | `sma_settings` | `settings/index.php` | Parámetros globales del sistema | ✅ **Migrado** a configuración de Tenant |
| 54 | `sma_shop_settings` | `shop/settings.php` | Parámetros de la tienda e-commerce | ✅ **Migrado** en configuración de Tenant |
| 55 | `sma_pages` | `shop/pages.php` | Páginas CMS (Términos, Quiénes somos) | ⏳ **En Implementación** (`StorePage`) |
| 56 | `sma_promos` | `promos/index.php`, `add.php` | Códigos de descuento y promociones | ⏳ **En Implementación** (`PromoCode`) |
| 57 | `sma_notifications` | `notifications/index.php` | Alertas globales para el personal | ⏳ **En Implementación** (`Notification`) |
| 58 | `sma_calendar` | `calendar.php` | Agenda y recordatorios de eventos | ⏳ **Opcional** (Residuo con warnings) |

---

## 2. Estado de Ejecución de Tareas del Plan de Migración

| Bloque Funcional | Entidades e Implementación | Estado | Validación y Pruebas |
|---|---|:---:|---|
| **Bloque 1: Finanzas y Operaciones** | `Expense`, `ExpenseCategory`, `Currency`, `TaxRate` | ✅ **Completado** | Registro de gastos `GAS-000001` auditado con RLS. Configuración de impuestos y monedas disponible en API. |
| **Bloque 2: Cotizaciones y Presupuestos** | `Quote`, `QuoteItem`, flujo `quote2invoice` | ✅ **Completado** | Cotización `COT-000001` creada y convertida exitosamente a factura `FAC-COT-000001` con reserva pesimista de stock. |
| **Bloque 3: Marcas y Unidades** | `Brand`, `Unit` | ✅ **Completado** | Entidades registradas en schema de PostgreSQL, migradas con RLS y APIs en `SettingsModule`. |
| **Bloque 4: Analítica y Reportes** | `ReportsModule` (Overview, Profit & Loss, Low Stock Alerts) | ✅ **Completado** | Cálculo en tiempo real de ingresos acumulados, egresos, margen neto y alertas de inventario bajo el umbral mínimo. |
| **Bloque 5: Frontend SaaS Moderno** | Next.js Dashboard con tabs de Inventario, Cotizaciones, Gastos y Reportes | ✅ **Completado** | Interfaz reactiva compilada, validada y ejecutándose en `http://localhost:3000`. |
| **Bloque 6: Mermas y Conteos Físicos** | `Adjustment`, `AdjustmentItem`, `StockCount`, `StockCountItem` | ⏳ **Siguiente Fase** | Auditoría y conciliación física periódica de stock contra libros teóricos. |
| **Bloque 7: Devoluciones y Notas de Crédito** | `SaleReturn`, `PurchaseReturn` | ⏳ **Siguiente Fase** | Retorno de existencias al almacén y balance de crédito. |
