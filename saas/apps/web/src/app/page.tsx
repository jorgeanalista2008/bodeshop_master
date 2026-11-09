'use client';

import React, { useState } from 'react';
import Link from 'next/link';
import { Store, ShieldCheck, Layers, ArrowRight, CheckCircle2, Building2, User, KeyRound, Laptop, Sparkles } from 'lucide-react';

export default function HomePage() {
  const [activeTab, setActiveTab] = useState<'login' | 'register'>('login');
  const [tenantSlug, setTenantSlug] = useState('bodeshop');
  const [email, setEmail] = useState('admin@bodeshop.com');
  const [password, setPassword] = useState('BodeShop2026##');
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState<string | null>(null);

  // Switch de Entorno
  const deploymentEnv = process.env.NEXT_PUBLIC_DEPLOYMENT_ENV || 'local';

  const selectDemoTenant = (slug: string, mail: string, pass: string) => {
    setTenantSlug(slug);
    setEmail(mail);
    setPassword(pass);
  };

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setMessage(null);

    try {
      const res = await fetch('http://localhost:4000/auth/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          tenantSlug,
          email,
          password,
        }),
      });

      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Error al iniciar sesión');

      localStorage.setItem('token', data.accessToken);
      localStorage.setItem('tenant', JSON.stringify(data.tenant));
      localStorage.setItem('user', JSON.stringify(data.user));
      localStorage.setItem('branch', JSON.stringify(data.currentBranch));

      setMessage(`¡Bienvenido! Sesión iniciada en ${data.tenant.tradeName}. Redirigiendo a Console...`);
      setTimeout(() => {
        window.location.href = '/dashboard';
      }, 800);
    } catch (err: any) {
      setMessage(`❌ ${err.message}`);
    } finally {
      setLoading(false);
    }
  };

  return (
    <main className="min-h-screen flex flex-col bg-[#f7f9fb] text-[#273d56] font-sans antialiased">
      {/* Top Header - Mapbox Console Style */}
      <header className="bg-white border-b border-[#e1e7ec] px-8 py-3.5 flex items-center justify-between sticky top-0 z-30">
        <div className="flex items-center space-x-3">
          <div className="w-8 h-8 rounded-lg bg-[#4264fb] text-white flex items-center justify-center shadow-xs">
            <Store className="w-4 h-4" />
          </div>
          <div>
            <h1 className="font-bold text-sm tracking-tight text-[#1a2b3c]">BodeShop SaaS Console</h1>
            <p className="text-[11px] text-[#6b7c93]">Plataforma Multi-Empresa & Multi-Sucursal</p>
          </div>
        </div>

        {/* Master Switch Badge */}
        <div className="flex items-center space-x-2">
          <div className="flex items-center space-x-2 bg-[#edf2ff] border border-[#bac8ff] px-3 py-1 rounded-full text-xs">
            <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span className="text-[#475569]">Entorno:</span>
            <span className="font-mono font-bold uppercase text-[#4264fb]">
              {deploymentEnv === 'production' ? 'PRODUCCIÓN (Supabase & Vercel)' : 'LOCAL (PostgreSQL 18)'}
            </span>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <div className="flex-1 max-w-6xl w-full mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        {/* Left Column: Hero & Value Proposition */}
        <div className="lg:col-span-7 space-y-6">
          <div className="inline-flex items-center space-x-2 bg-[#edf2ff] text-[#4264fb] px-3 py-1 rounded-full text-xs font-bold border border-[#b3c7fb]">
            <ShieldCheck className="w-4 h-4" />
            <span>Aislamiento 100% Nativo con PostgreSQL RLS</span>
          </div>

          <h2 className="text-4xl font-extrabold tracking-tight text-[#1a2b3c] leading-tight">
            Vende en cualquier empresa sin tocar los datos de otra.
          </h2>

          <p className="text-sm text-[#475569] leading-relaxed">
            Arquitectura SaaS corporativa construida sobre <strong>NestJS</strong>, <strong>Next.js</strong> y <strong>PostgreSQL</strong> con esquema de sucursales aisladas, terminales POS en tiempo real y libro mayor Kárdex con bloqueos pesimistas contra la sobreventa.
          </p>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-2">
            <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex items-start space-x-3">
              <div className="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <CheckCircle2 className="w-4 h-4" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-[#1a2b3c]">Multi-Empresa Aislado</h4>
                <p className="text-[11px] text-[#6b7c93] mt-0.5">Catálogos, inventarios y clientes 100% segregados por RLS.</p>
              </div>
            </div>

            <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex items-start space-x-3">
              <div className="w-8 h-8 rounded-lg bg-[#edf2ff] text-[#4264fb] flex items-center justify-center shrink-0">
                <Layers className="w-4 h-4" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-[#1a2b3c]">Multi-Sucursal & Almacén</h4>
                <p className="text-[11px] text-[#6b7c93] mt-0.5">Sedes físicas independientes y transferencias internas auditadas.</p>
              </div>
            </div>

            <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex items-start space-x-3">
              <div className="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center shrink-0">
                <Laptop className="w-4 h-4" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-[#1a2b3c]">Punto de Venta POS</h4>
                <p className="text-[11px] text-[#6b7c93] mt-0.5">Terminal táctil con arqueos y turnos de caja integrados.</p>
              </div>
            </div>

            <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex items-start space-x-3">
              <div className="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <ShieldCheck className="w-4 h-4" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-[#1a2b3c]">Bloqueo Pesimista (ACID)</h4>
                <p className="text-[11px] text-[#6b7c93] mt-0.5">Cero sobreventa durante picos de compras simultáneas.</p>
              </div>
            </div>
          </div>
        </div>

        {/* Right Column: Sign In Card (Mapbox Console Style) */}
        <div className="lg:col-span-5 bg-white p-7 rounded-xl border border-[#e1e7ec] shadow-md space-y-5">
          <div>
            <h3 className="font-bold text-base text-[#1a2b3c]">
              Acceso a Empresa (Tenant)
            </h3>
            <p className="text-xs text-[#6b7c93] mt-1">
              Ingresa las credenciales de tu empresa para entrar a la consola:
            </p>
          </div>

          {/* Quick Tenant Switcher Badges */}
          <div>
            <p className="text-[11px] font-bold text-[#8a9ba8] uppercase tracking-wider mb-2">
              Empresas Sembradas para Prueba:
            </p>
            <div className="flex flex-wrap gap-2">
              <button
                type="button"
                onClick={() => selectDemoTenant('cristaleria', 'admin@cristaleria.com', 'Cristaleria2026##')}
                className={`text-[11px] font-bold px-2.5 py-1 rounded-md border transition-colors ${
                  tenantSlug === 'cristaleria'
                    ? 'bg-[#edf2ff] border-[#4264fb] text-[#4264fb]'
                    : 'bg-[#f7f9fb] border-[#d2dce6] text-[#475569] hover:bg-[#edf2ff]'
                }`}
              >
                💎 Cristalería Latinoamericana (Migrada)
              </button>

              <button
                type="button"
                onClick={() => selectDemoTenant('bodeshop', 'admin@bodeshop.com', 'BodeShop2026##')}
                className={`text-[11px] font-bold px-2.5 py-1 rounded-md border transition-colors ${
                  tenantSlug === 'bodeshop'
                    ? 'bg-[#edf2ff] border-[#4264fb] text-[#4264fb]'
                    : 'bg-[#f7f9fb] border-[#d2dce6] text-[#475569] hover:bg-[#edf2ff]'
                }`}
              >
                🏢 BodeShop Master
              </button>

              <button
                type="button"
                onClick={() => selectDemoTenant('calzados-madrid', 'admin@calzadosmadrid.com', 'SuperPassword123##')}
                className={`text-[11px] font-bold px-2.5 py-1 rounded-md border transition-colors ${
                  tenantSlug === 'calzados-madrid'
                    ? 'bg-[#edf2ff] border-[#4264fb] text-[#4264fb]'
                    : 'bg-[#f7f9fb] border-[#d2dce6] text-[#475569] hover:bg-[#edf2ff]'
                }`}
              >
                👞 Calzados Madrid
              </button>

              <button
                type="button"
                onClick={() => selectDemoTenant('farmacia-central', 'admin@farmaciacentral.com', 'SuperPassword123##')}
                className={`text-[11px] font-bold px-2.5 py-1 rounded-md border transition-colors ${
                  tenantSlug === 'farmacia-central'
                    ? 'bg-[#edf2ff] border-[#4264fb] text-[#4264fb]'
                    : 'bg-[#f7f9fb] border-[#d2dce6] text-[#475569] hover:bg-[#edf2ff]'
                }`}
              >
                💊 Farmacia Central
              </button>
            </div>
          </div>

          <form onSubmit={handleLogin} className="space-y-3.5 text-xs">
            <div>
              <label className="block font-bold text-[#475569] mb-1">
                Subdominio / Slug de la Empresa
              </label>
              <div className="relative">
                <Building2 className="w-4 h-4 text-[#8a9ba8] absolute left-3 top-2.5" />
                <input
                  type="text"
                  value={tenantSlug}
                  onChange={(e) => setTenantSlug(e.target.value)}
                  placeholder="ej. bodeshop"
                  required
                  className="w-full pl-9 pr-3 py-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none transition-colors"
                />
              </div>
            </div>

            <div>
              <label className="block font-bold text-[#475569] mb-1">
                Correo Electrónico
              </label>
              <div className="relative">
                <User className="w-4 h-4 text-[#8a9ba8] absolute left-3 top-2.5" />
                <input
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  placeholder="admin@tuempresa.com"
                  required
                  className="w-full pl-9 pr-3 py-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none transition-colors"
                />
              </div>
            </div>

            <div>
              <label className="block font-bold text-[#475569] mb-1">
                Contraseña
              </label>
              <div className="relative">
                <KeyRound className="w-4 h-4 text-[#8a9ba8] absolute left-3 top-2.5" />
                <input
                  type="password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                  className="w-full pl-9 pr-3 py-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none transition-colors"
                />
              </div>
            </div>

            {message && (
              <div
                className={`p-3 rounded-md text-xs font-semibold ${
                  message.startsWith('❌')
                    ? 'bg-rose-50 text-rose-700 border border-rose-200'
                    : 'bg-emerald-50 text-emerald-800 border border-emerald-200'
                }`}
              >
                {message}
              </div>
            )}

            <button
              type="submit"
              disabled={loading}
              className="w-full bg-[#4264fb] hover:bg-[#314ccd] text-white font-bold py-2.5 rounded-md text-xs transition-colors shadow-xs flex items-center justify-center space-x-2"
            >
              {loading ? (
                <span>Validando credenciales...</span>
              ) : (
                <>
                  <span>Ingresar a la Plataforma</span>
                  <ArrowRight className="w-4 h-4" />
                </>
              )}
            </button>
          </form>

          <div className="pt-2 border-t border-[#edf1f4] flex items-center justify-between text-xs text-[#6b7c93]">
            <span>¿Probar punto de venta directo?</span>
            <Link href="/pos" className="text-[#4264fb] font-bold hover:underline">
              Abrir POS →
            </Link>
          </div>
        </div>
      </div>
    </main>
  );
}
