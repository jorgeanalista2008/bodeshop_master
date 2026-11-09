'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  Settings,
  Plus,
  RefreshCw,
  Warehouse,
  Tags,
  DollarSign,
  Shield,
  Layers,
  CheckCircle,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function SettingsPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [activeTab, setActiveTab] = useState<'warehouses' | 'categories' | 'currencies' | 'taxes'>('warehouses');
  const [branches, setBranches] = useState<any[]>([]);
  const [categories, setCategories] = useState<any[]>([]);
  const [currencies, setCurrencies] = useState<any[]>([]);
  const [taxes, setTaxes] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const rawTenant = localStorage.getItem('tenant');
    if (!rawTenant) {
      window.location.href = '/';
      return;
    }
    const t = JSON.parse(rawTenant);
    setTenant(t);
    loadData(t.id);
  }, []);

  const loadData = async (tenantId: string) => {
    setLoading(true);
    const token = localStorage.getItem('token') || undefined;

    try {
      const [branchData, cats, currs, txs] = await Promise.all([
        apiFetch<any[]>('/branches', { token, tenantId }),
        apiFetch<any[]>('/products', { token, tenantId }).then((prods) => {
          // Extraer categorías únicas
          const map = new Map();
          prods?.forEach((p) => {
            if (p.category) map.set(p.category.id, p.category);
          });
          return Array.from(map.values());
        }),
        apiFetch<any[]>('/settings/currencies', { token, tenantId }).catch(() => []),
        apiFetch<any[]>('/settings/tax-rates', { token, tenantId }).catch(() => []),
      ]);

      setBranches(branchData || []);
      setCategories(cats || []);
      setCurrencies(currs || []);
      setTaxes(txs || []);
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const warehouses = branches.flatMap((b) => b.warehouses || []);

  return (
    <div className="min-h-screen bg-[#f7f9fb] text-[#273d56] font-sans">
      {/* Header */}
      <header className="bg-white border-b border-[#e1e7ec] px-8 py-4 flex items-center justify-between sticky top-0 z-20">
        <div className="flex items-center space-x-3">
          <Link
            href="/dashboard"
            className="w-8 h-8 rounded-lg bg-[#f0f4f8] text-[#475569] hover:bg-[#e1e7ec] flex items-center justify-center transition-colors"
          >
            <ArrowLeft className="w-4 h-4" />
          </Link>
          <div>
            <div className="flex items-center space-x-2">
              <h1 className="font-bold text-sm text-[#1a2b3c]">Configuración del Sistema y Parámetros</h1>
              <span className="bg-[#edf2ff] text-[#4264fb] font-mono text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#bac8ff]">
                SMA 3.4
              </span>
            </div>
            <p className="text-[11px] text-[#6b7c93]">
              {tenant?.tradeName} — Almacenes, categorías, multi-monedas y tasas fiscales
            </p>
          </div>
        </div>

        <button
          onClick={() => loadData(tenant?.id)}
          className="p-2 rounded-lg border border-[#d2dce6] bg-white hover:bg-[#f7f9fb] text-[#475569] text-xs flex items-center space-x-1.5 transition-colors"
        >
          <RefreshCw className="w-3.5 h-3.5" />
          <span>Refrescar</span>
        </button>
      </header>

      {/* Main Container */}
      <main className="max-w-7xl mx-auto px-8 py-6 space-y-5">
        {/* Tab Buttons */}
        <div className="flex items-center space-x-2 bg-white p-1.5 rounded-xl border border-[#e1e7ec] shadow-2xs">
          <button
            onClick={() => setActiveTab('warehouses')}
            className={`flex items-center space-x-2 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors ${
              activeTab === 'warehouses'
                ? 'bg-[#edf2ff] text-[#4264fb]'
                : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
            }`}
          >
            <Warehouse className="w-3.5 h-3.5" />
            <span>Almacenes & Sedes ({warehouses.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('categories')}
            className={`flex items-center space-x-2 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors ${
              activeTab === 'categories'
                ? 'bg-[#edf2ff] text-[#4264fb]'
                : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
            }`}
          >
            <Tags className="w-3.5 h-3.5" />
            <span>Categorías ({categories.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('currencies')}
            className={`flex items-center space-x-2 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors ${
              activeTab === 'currencies'
                ? 'bg-[#edf2ff] text-[#4264fb]'
                : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
            }`}
          >
            <DollarSign className="w-3.5 h-3.5" />
            <span>Monedas & Tasas ({currencies.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('taxes')}
            className={`flex items-center space-x-2 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors ${
              activeTab === 'taxes'
                ? 'bg-[#edf2ff] text-[#4264fb]'
                : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
            }`}
          >
            <Shield className="w-3.5 h-3.5" />
            <span>Impuestos & IVA ({taxes.length})</span>
          </button>
        </div>

        {/* Tab Content */}
        <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden p-5">
          {activeTab === 'warehouses' && (
            <div className="space-y-4">
              <h3 className="font-bold text-xs uppercase text-[#8a9ba8]">Sedes Físicas y Depósitos</h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {warehouses.map((w: any) => (
                  <div key={w.id} className="p-4 rounded-xl border border-[#e1e7ec] bg-[#fbfcfd] space-y-2">
                    <div className="flex items-center justify-between">
                      <span className="font-mono text-[10px] font-bold text-[#4264fb] bg-[#edf2ff] px-2 py-0.5 rounded">
                        Código: {w.code}
                      </span>
                      <span className="text-[11px] text-emerald-600 font-bold flex items-center space-x-1">
                        <CheckCircle className="w-3 h-3" />
                        <span>Activo</span>
                      </span>
                    </div>
                    <h4 className="font-bold text-sm text-[#1a2b3c]">{w.name}</h4>
                    <p className="text-xs text-[#6b7c93]">{w.address || 'Sin dirección registrada'}</p>
                  </div>
                ))}
              </div>
            </div>
          )}

          {activeTab === 'categories' && (
            <div className="space-y-4">
              <h3 className="font-bold text-xs uppercase text-[#8a9ba8]">Árbol de Categorías del Catálogo</h3>
              <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                {categories.map((c: any) => (
                  <div key={c.id} className="p-3 rounded-lg border border-[#e1e7ec] bg-[#fbfcfd]">
                    <span className="font-mono text-[10px] text-[#8a9ba8]">{c.code}</span>
                    <p className="font-bold text-xs text-[#1a2b3c] truncate">{c.name}</p>
                  </div>
                ))}
              </div>
            </div>
          )}

          {activeTab === 'currencies' && (
            <div className="space-y-4">
              <h3 className="font-bold text-xs uppercase text-[#8a9ba8]">Monedas de Facturación</h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {currencies.length === 0 ? (
                  <p className="text-xs text-[#8a9ba8]">No hay monedas adicionales configuradas.</p>
                ) : (
                  currencies.map((curr: any) => (
                    <div key={curr.id} className="p-4 rounded-xl border border-[#e1e7ec] bg-[#fbfcfd] flex justify-between items-center">
                      <div>
                        <span className="font-mono font-bold text-sm text-[#1a2b3c]">{curr.code}</span>
                        <p className="text-xs text-[#6b7c93]">{curr.name}</p>
                      </div>
                      <div className="text-right">
                        <span className="font-mono font-bold text-sm text-emerald-600">Tasa: {Number(curr.rate).toFixed(4)}</span>
                        {curr.isDefault && (
                          <span className="block text-[10px] text-[#4264fb] font-bold">Moneda Base</span>
                        )}
                      </div>
                    </div>
                  ))
                )}
              </div>
            </div>
          )}

          {activeTab === 'taxes' && (
            <div className="space-y-4">
              <h3 className="font-bold text-xs uppercase text-[#8a9ba8]">Tasas Fiscales / IVA</h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {taxes.length === 0 ? (
                  <div className="p-4 rounded-xl border border-[#e1e7ec] bg-[#fbfcfd] flex justify-between items-center">
                    <div>
                      <span className="font-mono font-bold text-sm text-[#1a2b3c]">IVA General</span>
                      <p className="text-xs text-[#6b7c93]">Impuesto al valor agregado estándar</p>
                    </div>
                    <span className="font-mono font-extrabold text-sm text-[#4264fb]">16.00%</span>
                  </div>
                ) : (
                  taxes.map((tx: any) => (
                    <div key={tx.id} className="p-4 rounded-xl border border-[#e1e7ec] bg-[#fbfcfd] flex justify-between items-center">
                      <div>
                        <span className="font-mono font-bold text-sm text-[#1a2b3c]">{tx.name}</span>
                        <p className="text-xs text-[#6b7c93]">{tx.code}</p>
                      </div>
                      <span className="font-mono font-extrabold text-sm text-[#4264fb]">
                        {Number(tx.rate).toFixed(2)}%
                      </span>
                    </div>
                  ))
                )}
              </div>
            </div>
          )}
        </div>
      </main>
    </div>
  );
}
