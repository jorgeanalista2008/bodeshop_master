# 🛒 BodeShop Master SaaS - Plataforma B2B Multi-Tenant & Multi-Sucursal

Plataforma SaaS moderna construida con **NestJS (Backend)**, **Next.js (Frontend)** y **PostgreSQL (Base de Datos)** con arquitectura Multinquilino (Multi-Tenant) y Multi-Sucursal (Multi-Branch).

---

## 🚀 Control Maestro de Entorno (Deployment Switch)

El sistema cuenta con una **variable maestra única** en el archivo `.env`:

```env
# ==============================================================================
# VARIABLE MAESTRA DE CONTROL DE ENTORNO (DEPLOYMENT SWITCH)
# Opciones permitidas: 'local' | 'production'
# ==============================================================================
DEPLOYMENT_ENV="local"
```

### 1. Modo Local (`DEPLOYMENT_ENV="local"`)
- **Base de Datos:** PostgreSQL 18 local (`127.0.0.1:5432/bodeshop_saas`).
- **Backend API:** `http://localhost:4000`.
- **Frontend Web:** `http://localhost:3000`.
- **CORS & Cookies:** Adaptados para entornos de desarrollo en `localhost`.

### 2. Modo Producción (`DEPLOYMENT_ENV="production"`)
- **Base de Datos:** Se conecta automáticamente al pooler de **Supabase** (`aws-0-[region].pooler.supabase.com:6543/postgres?pgbouncer=true`).
- **Frontend y API:** Enrutados automáticamente a los dominios productivos en **Vercel**.
- **Seguridad:** Cookies `HttpOnly; Secure; SameSite=Strict`, HSTS forzado y RLS activo.

---

## 🏢 Arquitectura Multi-Tenant & Multi-Sucursal

```
               [ PLATAFORMA SAAS ]
                 (Suscripciones)
                        │
         ┌──────────────┴──────────────┐
  [ EMPRESA A (Tenant) ]        [ EMPRESA B (Tenant) ]
   (Calzados Madrid)             (Farmacia Central)
         │                             │
    ┌────┴────┐                   ┌────┴────┐
[Sucursal 1] [Sucursal 2]     [Sucursal 1] [Sucursal 2]
(Almacén 1)  (Almacén 2)      (Almacén 1)  (Almacén 2)
```

1. **Aislamiento 100% Garantizado:**
   - Una empresa jamás puede visualizar o modificar productos, existencias, clientes ni ventas de otra empresa.
   - Cada consulta a la base de datos está protegida por **PostgreSQL Row-Level Security (RLS)** y filtros automáticos por `tenantId`.
2. **Control de Inventario sin Sobreventa (Pessimistic Locking):**
   - Las ventas en el POS ejecutan `SELECT ... FOR UPDATE` sobre la fila del almacén específico en PostgreSQL, evitando que ventas simultáneas generen saldos negativos.
3. **Libro Mayor Kárdex:**
   - Cada entrada y salida de mercancía se registra de forma inmutable en `StockMovement`.

---

## 🛠️ Comandos Rápidos de Inicio

### Backend (NestJS API - Puerto 4000)
```bash
cd saas/apps/api
npm install
npx prisma db push
npx ts-node prisma/seed.ts
npm run start:dev
```

### Frontend (Next.js - Puerto 3000)
```bash
cd saas/apps/web
npm install
npm run dev
```

### Endpoints Principales
- **Health Check:** `GET http://localhost:4000/health`
- **Registro de Nueva Empresa:** `POST http://localhost:4000/auth/register-tenant`
- **Login de Empresa:** `POST http://localhost:4000/auth/login`
- **Catálogo de Productos:** `GET / POST http://localhost:4000/products`
- **Venta POS con Bloqueo:** `POST http://localhost:4000/sales`
- **Sucursales:** `GET / POST http://localhost:4000/branches`
