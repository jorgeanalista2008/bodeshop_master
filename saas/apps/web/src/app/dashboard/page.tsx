'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  Store,
  ShoppingCart,
  Package,
  Building2,
  LogOut,
  Plus,
  RefreshCw,
  ArrowLeftRight,
  ExternalLink,
  ShieldCheck,
  DollarSign,
  FileText,
  TrendingUp,
  AlertTriangle,
  Receipt,
  CheckCircle2,
  Copy,
  Check,
  ChevronDown,
  ChevronRight,
  Layers,
  Code,
  Compass,
  Settings,
  BarChart3,
  HelpCircle,
  User,
  Key,
  Globe,
  Search,
  Navigation,
  MapPin,
  ArrowUpRight,
  ShoppingBag,
  SlidersHorizontal,
  Users,
} from 'lucide-react';

export default function DashboardPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [user, setUser] = useState<any>(null);
  const [branch, setBranch] = useState<any>(null);
  const [branches, setBranches] = useState<any[]>([]);
  const [products, setProducts] = useState<any[]>([]);
  const [sales, setSales] = useState<any[]>([]);
  const [transfers, setTransfers] = useState<any[]>([]);
  const [quotes, setQuotes] = useState<any[]>([]);
  const [expenses, setExpenses] = useState<any[]>([]);
  const [overview, setOverview] = useState<any>(null);
  const [profitLoss, setProfitLoss] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [copiedToken, setCopiedToken] = useState(false);

  // Active Main View
  const [currentView, setCurrentView] = useState<'overview' | 'inventory' | 'quotes' | 'expenses' | 'analytics'>('overview');

  // Modals
  const [showProductModal, setShowProductModal] = useState(false);
  const [newCode, setNewCode] = useState('');
  const [newName, setNewName] = useState('');
  const [newPrice, setNewPrice] = useState(10);
  const [newCost, setNewCost] = useState(5);
  const [newStock, setNewStock] = useState(10);

  const [showTransferModal, setShowTransferModal] = useState(false);
  const [transferOriginWh, setTransferOriginWh] = useState('');
  const [transferDestWh, setTransferDestWh] = useState('');
  const [transferProduct, setTransferProduct] = useState('');
  const [transferQty, setTransferQty] = useState(5);

  const [showExpenseModal, setShowExpenseModal] = useState(false);
  const [expenseAmount, setExpenseAmount] = useState(50);
  const [expenseNote, setExpenseNote] = useState('');
  const [expenseCategoryName, setExpenseCategoryName] = useState('Servicios Básicos');

  const [showQuoteModal, setShowQuoteModal] = useState(false);
  const [quoteCustomerName, setQuoteCustomerName] = useState('');
  const [quoteProduct, setQuoteProduct] = useState('');
  const [quoteQty, setQuoteQty] = useState(1);
  const [quoteNote, setQuoteNote] = useState('');

  useEffect(() => {
    const rawTenant = localStorage.getItem('tenant');
    const rawUser = localStorage.getItem('user');
    const rawBranch = localStorage.getItem('branch');

    if (!rawTenant || !rawUser) {
      window.location.href = '/';
      return;
    }

    const t = JSON.parse(rawTenant);
    setTenant(t);
    setUser(JSON.parse(rawUser));
    if (rawBranch) setBranch(JSON.parse(rawBranch));

    fetchData(t.id);
  }, []);

  const fetchData = async (tenantId: string) => {
    setLoading(true);
    const token = localStorage.getItem('token');
    const headers = { Authorization: `Bearer ${token}`, 'x-tenant-id': tenantId };

    try {
      const [prodRes, branchRes, salesRes, trfRes, quoteRes, expRes, repRes, plRes] = await Promise.all([
        fetch('http://localhost:4000/products', { headers }),
        fetch('http://localhost:4000/branches', { headers }),
        fetch('http://localhost:4000/sales', { headers }),
        fetch('http://localhost:4000/transfers', { headers }),
        fetch('http://localhost:4000/quotes', { headers }),
        fetch('http://localhost:4000/expenses', { headers }),
        fetch('http://localhost:4000/reports/overview', { headers }),
        fetch('http://localhost:4000/reports/profit-loss', { headers }),
      ]);

      if (prodRes.ok) setProducts(await prodRes.json());
      if (branchRes.ok) {
        const bList = await branchRes.json();
        setBranches(bList);
        if (bList.length > 0 && !branch) setBranch(bList[0]);
      }
      if (salesRes.ok) setSales(await salesRes.json());
      if (trfRes.ok) setTransfers(await trfRes.json());
      if (quoteRes.ok) setQuotes(await quoteRes.json());
      if (expRes.ok) setExpenses(await expRes.json());
      if (repRes.ok) setOverview(await repRes.json());
      if (plRes.ok) setProfitLoss(await plRes.json());
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const handleCopyToken = () => {
    const token = localStorage.getItem('token') || 'token_demo_mapbox_saas';
    navigator.clipboard.writeText(token);
    setCopiedToken(true);
    setTimeout(() => setCopiedToken(false), 2000);
  };

  const handleCreateProduct = async (e: React.FormEvent) => {
    e.preventDefault();
    const token = localStorage.getItem('token');
    const warehouseId = branch?.warehouses?.[0]?.id || branches?.[0]?.warehouses?.[0]?.id;

    try {
      const res = await fetch('http://localhost:4000/products', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
          'x-tenant-id': tenant.id,
        },
        body: JSON.stringify({
          code: newCode,
          name: newName,
          price: Number(newPrice),
          cost: Number(newCost),
          categorySlug: 'general',
          initialWarehouseId: warehouseId,
          initialStock: Number(newStock),
        }),
      });

      if (res.ok) {
        setShowProductModal(false);
        setNewCode('');
        setNewName('');
        fetchData(tenant.id);
      } else {
        const error = await res.json();
        alert(`Error: ${error.message || 'No se pudo crear el producto'}`);
      }
    } catch (err) {
      console.error(err);
    }
  };

  const handleCreateTransfer = async (e: React.FormEvent) => {
    e.preventDefault();
    const token = localStorage.getItem('token');

    try {
      const res = await fetch('http://localhost:4000/transfers', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
          'x-tenant-id': tenant.id,
        },
        body: JSON.stringify({
          fromWarehouseId: transferOriginWh,
          toWarehouseId: transferDestWh,
          items: [{ productId: transferProduct, quantity: Number(transferQty) }],
          note: 'Transferencia directa desde Mapbox Style Console',
        }),
      });

      if (res.ok) {
        setShowTransferModal(false);
        alert('¡Transferencia ejecutada con éxito!');
        fetchData(tenant.id);
      } else {
        const error = await res.json();
        alert(`Error: ${error.message}`);
      }
    } catch (err) {
      console.error(err);
    }
  };

  const handleCreateExpense = async (e: React.FormEvent) => {
    e.preventDefault();
    const token = localStorage.getItem('token');
    const branchId = branch?.id || branches?.[0]?.id;

    try {
      const res = await fetch('http://localhost:4000/expenses', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
          'x-tenant-id': tenant.id,
        },
        body: JSON.stringify({
          branchId,
          categoryName: expenseCategoryName,
          amount: Number(expenseAmount),
          note: expenseNote,
        }),
      });

      if (res.ok) {
        setShowExpenseModal(false);
        setExpenseNote('');
        fetchData(tenant.id);
      } else {
        const error = await res.json();
        alert(`Error: ${error.message}`);
      }
    } catch (err) {
      console.error(err);
    }
  };

  const handleCreateQuote = async (e: React.FormEvent) => {
    e.preventDefault();
    const token = localStorage.getItem('token');
    const branchId = branch?.id || branches?.[0]?.id;
    const prod = products.find((p) => p.id === quoteProduct);

    if (!prod) return;

    try {
      const res = await fetch('http://localhost:4000/quotes', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
          'x-tenant-id': tenant.id,
        },
        body: JSON.stringify({
          branchId,
          customerName: quoteCustomerName,
          note: quoteNote,
          items: [{ productId: quoteProduct, quantity: Number(quoteQty), unitPrice: Number(prod.price) }],
        }),
      });

      if (res.ok) {
        setShowQuoteModal(false);
        setQuoteCustomerName('');
        setQuoteNote('');
        fetchData(tenant.id);
      } else {
        const error = await res.json();
        alert(`Error: ${error.message}`);
      }
    } catch (err) {
      console.error(err);
    }
  };

  const handleConvertQuote = async (quoteId: string) => {
    const token = localStorage.getItem('token');
    const warehouseId = branch?.warehouses?.[0]?.id || branches?.[0]?.warehouses?.[0]?.id;

    if (!confirm('¿Convertir cotización en Factura de Venta y descargar stock con bloqueo pesimista?')) return;

    try {
      const res = await fetch(`http://localhost:4000/quotes/${quoteId}/convert`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`,
          'x-tenant-id': tenant.id,
        },
        body: JSON.stringify({
          warehouseId,
          paymentMethod: 'CASH',
        }),
      });

      if (res.ok) {
        const data = await res.json();
        alert(`¡Facturada con éxito! Factura Nº: ${data.invoiceNumber}`);
        fetchData(tenant.id);
      } else {
        const error = await res.json();
        alert(`Error: ${error.message}`);
      }
    } catch (err) {
      console.error(err);
    }
  };

  const handleLogout = () => {
    localStorage.clear();
    window.location.href = '/';
  };

  const allWarehouses = branches.flatMap((b) => b.warehouses || []);
  const tokenSnippet = typeof window !== 'undefined' && localStorage.getItem('token')
    ? localStorage.getItem('token')!.slice(0, 32) + '...'
    : 'pk.eyJ1IjoiYm9kZXNob3AiLCJhIjoiY2x...';

  if (!tenant || !user) {
    return (
      <div className="min-h-screen bg-[#f7f9fb] flex items-center justify-center font-sans">
        <RefreshCw className="w-8 h-8 text-[#4264fb] animate-spin" />
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-[#f7f9fb] text-[#273d56] flex font-sans antialiased">
      {/* ==================================================== */}
      {/* 1. LEFT SIDEBAR (Mapbox Console Style) */}
      {/* ==================================================== */}
      <aside className="w-64 bg-white border-r border-[#e1e7ec] flex flex-col justify-between shrink-0 h-screen sticky top-0 overflow-y-auto z-20">
        <div>
          {/* User / Tenant Dropdown Pill */}
          <div className="p-4 border-b border-[#edf1f4]">
            <div className="flex items-center justify-between p-2 rounded-lg hover:bg-[#f4f7fb] cursor-pointer transition-colors group">
              <div className="flex items-center space-x-2.5 overflow-hidden">
                <div className="w-7 h-7 rounded-full bg-[#4264fb] text-white flex items-center justify-center font-bold text-xs uppercase shrink-0 shadow-xs">
                  {tenant.tradeName?.charAt(0) || 'B'}
                </div>
                <div className="truncate">
                  <p className="text-xs font-bold text-[#1a2b3c] truncate group-hover:text-[#4264fb]">
                    {user.email?.split('@')[0] || 'admin'}
                  </p>
                  <p className="text-[10px] text-[#6b7c93] truncate font-medium">
                    {tenant.slug}
                  </p>
                </div>
              </div>
              <ChevronDown className="w-4 h-4 text-[#8a9ba8] group-hover:text-[#1a2b3c] shrink-0" />
            </div>
          </div>

          {/* Navigation Links */}
          <div className="px-3 py-4 space-y-6">
            {/* Main Primary Nav */}
            <div>
              <button
                onClick={() => setCurrentView('overview')}
                className={`w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-bold transition-all ${
                  currentView === 'overview'
                    ? 'bg-[#edf2ff] text-[#4264fb]'
                    : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
                }`}
              >
                <Store className="w-4 h-4" />
                <span>Account overview</span>
              </button>
            </div>

            {/* Section: TOOLS (Mapbox Style with colorful badges) */}
            <div className="space-y-1">
              <p className="px-3 text-[11px] font-bold tracking-wider text-[#8a9ba8] uppercase">
                Puntos de Operación
              </p>

              <Link
                href="/pos"
                className="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-emerald-500 text-white flex items-center justify-center shrink-0">
                  <ShoppingCart className="w-3 h-3" />
                </div>
                <span>Terminal POS</span>
              </Link>

              <Link
                href="/sales"
                className="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-blue-500 text-white flex items-center justify-center shrink-0">
                  <Receipt className="w-3 h-3" />
                </div>
                <span>Ventas & Facturas</span>
              </Link>

              <Link
                href="/purchases"
                className="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-amber-500 text-white flex items-center justify-center shrink-0">
                  <ShoppingBag className="w-3 h-3" />
                </div>
                <span>Compras a Proveedores</span>
              </Link>

              <Link
                href="/adjustments"
                className="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-rose-500 text-white flex items-center justify-center shrink-0">
                  <SlidersHorizontal className="w-3 h-3" />
                </div>
                <span>Ajustes & Mermas</span>
              </Link>

              <Link
                href="/contacts"
                className="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-purple-500 text-white flex items-center justify-center shrink-0">
                  <Users className="w-3 h-3" />
                </div>
                <span>Clientes & Proveedores</span>
              </Link>

              <Link
                href="/shop"
                target="_blank"
                className="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-[#4264fb] text-white flex items-center justify-center shrink-0">
                  <Globe className="w-3 h-3" />
                </div>
                <span>Tienda B2C Online</span>
                <ArrowUpRight className="w-3 h-3 text-[#8a9ba8] ml-auto" />
              </Link>

              <button
                onClick={() => setShowTransferModal(true)}
                className="w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c] transition-colors"
              >
                <div className="w-5 h-5 rounded bg-indigo-500 text-white flex items-center justify-center shrink-0">
                  <ArrowLeftRight className="w-3 h-3" />
                </div>
                <span>Transferencias Almacén</span>
              </button>
            </div>

            {/* Section: ADMIN */}
            <div className="space-y-1">
              <p className="px-3 text-[11px] font-bold tracking-wider text-[#8a9ba8] uppercase">
                Admin
              </p>

              <button
                onClick={() => setCurrentView('inventory')}
                className={`w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium transition-colors ${
                  currentView === 'inventory'
                    ? 'bg-[#edf2ff] text-[#4264fb] font-bold'
                    : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
                }`}
              >
                <Package className="w-4 h-4 text-[#8a9ba8]" />
                <span>Productos & Stock</span>
              </button>

              <button
                onClick={() => setCurrentView('quotes')}
                className={`w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium transition-colors ${
                  currentView === 'quotes'
                    ? 'bg-[#edf2ff] text-[#4264fb] font-bold'
                    : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
                }`}
              >
                <FileText className="w-4 h-4 text-[#8a9ba8]" />
                <span>Presupuestos / Cotizaciones</span>
              </button>

              <button
                onClick={() => setCurrentView('expenses')}
                className={`w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium transition-colors ${
                  currentView === 'expenses'
                    ? 'bg-[#edf2ff] text-[#4264fb] font-bold'
                    : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
                }`}
              >
                <Receipt className="w-4 h-4 text-[#8a9ba8]" />
                <span>Gastos Operativos</span>
              </button>

              <button
                onClick={() => setCurrentView('analytics')}
                className={`w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-xs font-medium transition-colors ${
                  currentView === 'analytics'
                    ? 'bg-[#edf2ff] text-[#4264fb] font-bold'
                    : 'text-[#475569] hover:bg-[#f4f7fb] hover:text-[#1a2b3c]'
                }`}
              >
                <BarChart3 className="w-4 h-4 text-[#8a9ba8]" />
                <span>Estadísticas & PnL</span>
              </button>
            </div>
          </div>
        </div>

        {/* Section: HELP & RESOURCES (Bottom) */}
        <div className="p-3 border-t border-[#edf1f4] space-y-1">
          <p className="px-3 text-[11px] font-bold tracking-wider text-[#8a9ba8] uppercase">
            Help & resources
          </p>
          <a
            href="https://docs.mapbox.com"
            target="_blank"
            className="flex items-center justify-between px-3 py-1.5 text-xs text-[#475569] hover:text-[#1a2b3c] rounded-md transition-colors"
          >
            <span>Docs & RLS Guide</span>
            <ChevronRight className="w-3 h-3 text-[#8a9ba8]" />
          </a>
          <div className="flex items-center justify-between px-3 py-1.5 text-xs text-[#475569]">
            <span>Modo:</span>
            <span className="font-mono font-bold text-[10px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
              LOCAL (PostgreSQL 18)
            </span>
          </div>

          <button
            onClick={handleLogout}
            className="w-full flex items-center space-x-2 px-3 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 rounded-lg transition-colors mt-2"
          >
            <LogOut className="w-4 h-4" />
            <span>Cerrar Sesión</span>
          </button>
        </div>
      </aside>

      {/* ==================================================== */}
      {/* 2. MAIN CONTENT AREA (Mapbox Console Style) */}
      {/* ==================================================== */}
      <main className="flex-1 min-w-0 p-8 space-y-8 overflow-y-auto">
        {/* Top Header / Account overview */}
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h1 className="text-2xl font-bold tracking-tight text-[#1a2b3c]">
              Account overview
            </h1>
            <p className="text-xs text-[#6b7c93] mt-0.5">
              Empresa activa: <strong className="text-[#1a2b3c]">{tenant.tradeName}</strong> | Sucursal: <strong className="text-[#1a2b3c]">{branch?.name || 'Sede Principal'}</strong>
            </p>
          </div>

          {/* Quick Action Badges */}
          <div className="flex items-center space-x-2">
            <button
              onClick={() => fetchData(tenant.id)}
              className="p-2 bg-white border border-[#d2dce6] rounded-md hover:bg-[#f4f7fb] text-[#475569] text-xs font-bold transition-all shadow-2xs flex items-center space-x-1"
              title="Refrescar datos"
            >
              <RefreshCw className={`w-3.5 h-3.5 ${loading ? 'animate-spin text-[#4264fb]' : ''}`} />
              <span>Refresh</span>
            </button>

            <button
              onClick={() => setShowProductModal(true)}
              className="bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold px-3 py-2 rounded-md shadow-xs transition-all flex items-center space-x-1.5"
            >
              <Plus className="w-3.5 h-3.5" />
              <span>Nuevo Producto</span>
            </button>
          </div>
        </div>

        {/* ==================================================== */}
        {/* 3. GETTING STARTED CARDS (Mapbox 4-Card Dashed Row) */}
        {/* ==================================================== */}
        <div>
          <h2 className="text-base font-bold text-[#1a2b3c] mb-3">
            Getting started
          </h2>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Card 1: Add Product */}
            <div className="bg-white border border-dashed border-[#b3c7fb] rounded-xl p-5 flex flex-col justify-between hover:border-[#4264fb] transition-colors">
              <div>
                <div className="w-10 h-10 rounded-lg bg-[#edf2ff] text-[#4264fb] flex items-center justify-center mb-3">
                  <Package className="w-5 h-5" />
                </div>
                <h3 className="text-xs font-bold text-[#1a2b3c] mb-1">
                  Catálogo & Inventario
                </h3>
                <p className="text-xs text-[#6b7c93] leading-relaxed">
                  Crea productos con SKU, costos, precios de venta y existencias por almacén.
                </p>
              </div>
              <button
                onClick={() => setShowProductModal(true)}
                className="mt-4 w-full bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold py-2 rounded-md transition-colors"
              >
                Añadir Producto
              </button>
            </div>

            {/* Card 2: Presupuestos */}
            <div className="bg-white border border-dashed border-[#b3c7fb] rounded-xl p-5 flex flex-col justify-between hover:border-[#4264fb] transition-colors">
              <div>
                <div className="w-10 h-10 rounded-lg bg-[#edf2ff] text-[#4264fb] flex items-center justify-center mb-3">
                  <FileText className="w-5 h-5" />
                </div>
                <h3 className="text-xs font-bold text-[#1a2b3c] mb-1">
                  Cotizaciones / Presupuestos
                </h3>
                <p className="text-xs text-[#6b7c93] leading-relaxed">
                  Emite ofertas comerciales y conviértelas a factura en 1 clic.
                </p>
              </div>
              <button
                onClick={() => setShowQuoteModal(true)}
                className="mt-4 w-full bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold py-2 rounded-md transition-colors"
              >
                Crear Cotización
              </button>
            </div>

            {/* Card 3: Transferencias */}
            <div className="bg-white border border-dashed border-[#b3c7fb] rounded-xl p-5 flex flex-col justify-between hover:border-[#4264fb] transition-colors">
              <div>
                <div className="w-10 h-10 rounded-lg bg-[#edf2ff] text-[#4264fb] flex items-center justify-center mb-3">
                  <ArrowLeftRight className="w-5 h-5" />
                </div>
                <h3 className="text-xs font-bold text-[#1a2b3c] mb-1">
                  Movimientos de Kárdex
                </h3>
                <p className="text-xs text-[#6b7c93] leading-relaxed">
                  Transfiere mercancía entre sucursales con trazabilidad FIFO completa.
                </p>
              </div>
              <button
                onClick={() => setShowTransferModal(true)}
                className="mt-4 w-full bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold py-2 rounded-md transition-colors"
              >
                Transferir Stock
              </button>
            </div>

            {/* Card 4: Gastos */}
            <div className="bg-white border border-dashed border-[#b3c7fb] rounded-xl p-5 flex flex-col justify-between hover:border-[#4264fb] transition-colors">
              <div>
                <div className="w-10 h-10 rounded-lg bg-[#edf2ff] text-[#4264fb] flex items-center justify-center mb-3">
                  <Receipt className="w-5 h-5" />
                </div>
                <h3 className="text-xs font-bold text-[#1a2b3c] mb-1">
                  Gastos Operativos
                </h3>
                <p className="text-xs text-[#6b7c93] leading-relaxed">
                  Registra salidas de dinero por servicios, suministros o nómina.
                </p>
              </div>
              <button
                onClick={() => setShowExpenseModal(true)}
                className="mt-4 w-full bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold py-2 rounded-md transition-colors"
              >
                Registrar Gasto
              </button>
            </div>
          </div>
        </div>

        {/* ==================================================== */}
        {/* 4. MAIN SPLIT: ACCOUNT USAGE (Left) & TOKENS (Right) */}
        {/* ==================================================== */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          {/* LEFT 8 COLS: ACCOUNT USAGE METRIC BARS */}
          <div className="lg:col-span-8 space-y-6">
            <div className="flex items-center justify-between">
              <h2 className="text-base font-bold text-[#1a2b3c]">
                Account usage
              </h2>
              <div className="flex items-center space-x-3">
                <select className="bg-white border border-[#d2dce6] rounded-md px-3 py-1 text-xs font-medium text-[#475569] shadow-2xs focus:outline-none focus:ring-1 focus:ring-[#4264fb]">
                  <option>Current billing period</option>
                  <option>Previous month</option>
                </select>
                <button
                  onClick={() => setCurrentView('analytics')}
                  className="text-xs font-bold text-[#4264fb] hover:underline"
                >
                  View all statistics &gt;
                </button>
              </div>
            </div>

            {/* Metric Group 1: Maps / Ventas POS (Orange Badge) */}
            <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
              <div className="px-5 py-3 border-b border-[#edf1f4] flex items-center space-x-2">
                <div className="w-5 h-5 rounded bg-amber-500 text-white flex items-center justify-center text-xs">
                  <ShoppingCart className="w-3 h-3" />
                </div>
                <h3 className="font-bold text-xs text-[#1a2b3c]">
                  Ventas y Facturación (POS & Checkout)
                </h3>
              </div>

              <div className="divide-y divide-[#f4f7fb] text-xs">
                {/* Row 1 */}
                <div className="px-5 py-3.5 grid grid-cols-12 items-center gap-4">
                  <div className="col-span-4 font-semibold text-[#1a2b3c]">
                    Facturación Total
                  </div>
                  <div className="col-span-2 font-mono font-bold text-[#1a2b3c]">
                    ${profitLoss?.totalRevenue ? Number(profitLoss.totalRevenue).toFixed(2) : '0.00'}
                  </div>
                  <div className="col-span-4">
                    <p className="text-[11px] text-[#6b7c93] mb-1">
                      {sales.length} facturas emitidas este período
                    </p>
                    <div className="w-full bg-[#edf1f4] rounded-full h-1.5 overflow-hidden">
                      <div
                        className="bg-[#4264fb] h-1.5 rounded-full"
                        style={{ width: `${Math.min(sales.length * 10, 100)}%` }}
                      ></div>
                    </div>
                  </div>
                  <div className="col-span-2 text-right">
                    <span className="text-emerald-600 font-bold text-[11px] flex items-center justify-end space-x-1">
                      <span>▲</span>
                      <span>100%</span>
                    </span>
                  </div>
                </div>

                {/* Row 2 */}
                <div className="px-5 py-3.5 grid grid-cols-12 items-center gap-4">
                  <div className="col-span-4 font-semibold text-[#1a2b3c]">
                    Ganancia Bruta (Gross Profit)
                  </div>
                  <div className="col-span-2 font-mono font-bold text-emerald-600">
                    ${profitLoss?.grossProfit ? Number(profitLoss.grossProfit).toFixed(2) : '0.00'}
                  </div>
                  <div className="col-span-4">
                    <p className="text-[11px] text-[#6b7c93] mb-1">
                      Margen: {profitLoss?.grossMarginPercentage ? Number(profitLoss.grossMarginPercentage).toFixed(1) : '100'}%
                    </p>
                    <div className="w-full bg-[#edf1f4] rounded-full h-1.5 overflow-hidden">
                      <div
                        className="bg-emerald-500 h-1.5 rounded-full"
                        style={{ width: `${Math.min(Number(profitLoss?.grossMarginPercentage || 100), 100)}%` }}
                      ></div>
                    </div>
                  </div>
                  <div className="col-span-2 text-right">
                    <span className="text-emerald-600 font-bold text-[11px] flex items-center justify-end space-x-1">
                      <span>▲</span>
                      <span>100%</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            {/* Metric Group 2: Search / Inventario (Yellow Badge) */}
            <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
              <div className="px-5 py-3 border-b border-[#edf1f4] flex items-center space-x-2">
                <div className="w-5 h-5 rounded bg-sky-500 text-white flex items-center justify-center text-xs">
                  <Package className="w-3 h-3" />
                </div>
                <h3 className="font-bold text-xs text-[#1a2b3c]">
                  Inventario y Existencias
                </h3>
              </div>

              <div className="divide-y divide-[#f4f7fb] text-xs">
                {/* Row 1 */}
                <div className="px-5 py-3.5 grid grid-cols-12 items-center gap-4">
                  <div className="col-span-4 font-semibold text-[#1a2b3c]">
                    Artículos en Catálogo
                  </div>
                  <div className="col-span-2 font-mono font-bold text-[#1a2b3c]">
                    {products.length} productos
                  </div>
                  <div className="col-span-4">
                    <p className="text-[11px] text-[#6b7c93] mb-1">
                      {products.length} / {tenant.subscription?.plan?.maxProducts || 500} cuota del plan
                    </p>
                    <div className="w-full bg-[#edf1f4] rounded-full h-1.5 overflow-hidden">
                      <div
                        className="bg-[#4264fb] h-1.5 rounded-full"
                        style={{ width: `${(products.length / (tenant.subscription?.plan?.maxProducts || 500)) * 100}%` }}
                      ></div>
                    </div>
                  </div>
                  <div className="col-span-2 text-right">
                    <span className="text-emerald-600 font-bold text-[11px] flex items-center justify-end space-x-1">
                      <span>▲</span>
                      <span>100%</span>
                    </span>
                  </div>
                </div>

                {/* Row 2 */}
                <div className="px-5 py-3.5 grid grid-cols-12 items-center gap-4">
                  <div className="col-span-4 font-semibold text-[#1a2b3c]">
                    Valor Total en Almacén
                  </div>
                  <div className="col-span-2 font-mono font-bold text-[#1a2b3c]">
                    ${overview?.inventory?.totalStockValue ? Number(overview.inventory.totalStockValue).toFixed(2) : '0.00'}
                  </div>
                  <div className="col-span-4">
                    <p className="text-[11px] text-[#6b7c93] mb-1">
                      {overview?.inventory?.lowStockCount || 0} ítems en stock mínimo
                    </p>
                    <div className="w-full bg-[#edf1f4] rounded-full h-1.5 overflow-hidden">
                      <div className="bg-amber-400 h-1.5 rounded-full" style={{ width: '20%' }}></div>
                    </div>
                  </div>
                  <div className="col-span-2 text-right text-[#8a9ba8]">
                    <span>-</span>
                  </div>
                </div>
              </div>
            </div>

            {/* Metric Group 3: Navigation / Cotizaciones & Gastos (Blue Badge) */}
            <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
              <div className="px-5 py-3 border-b border-[#edf1f4] flex items-center space-x-2">
                <div className="w-5 h-5 rounded bg-violet-500 text-white flex items-center justify-center text-xs">
                  <FileText className="w-3 h-3" />
                </div>
                <h3 className="font-bold text-xs text-[#1a2b3c]">
                  Cotizaciones y Gastos Operativos
                </h3>
              </div>

              <div className="divide-y divide-[#f4f7fb] text-xs">
                {/* Row 1 */}
                <div className="px-5 py-3.5 grid grid-cols-12 items-center gap-4">
                  <div className="col-span-4 font-semibold text-[#1a2b3c]">
                    Cotizaciones Emitidas
                  </div>
                  <div className="col-span-2 font-mono font-bold text-violet-600">
                    {quotes.length} cotizaciones
                  </div>
                  <div className="col-span-4">
                    <p className="text-[11px] text-[#6b7c93] mb-1">
                      {quotes.filter((q) => q.status === 'CONVERTED').length} convertidas a factura
                    </p>
                    <div className="w-full bg-[#edf1f4] rounded-full h-1.5 overflow-hidden">
                      <div
                        className="bg-violet-500 h-1.5 rounded-full"
                        style={{
                          width: `${quotes.length > 0 ? (quotes.filter((q) => q.status === 'CONVERTED').length / quotes.length) * 100 : 0}%`,
                        }}
                      ></div>
                    </div>
                  </div>
                  <div className="col-span-2 text-right">
                    <span className="text-emerald-600 font-bold text-[11px] flex items-center justify-end space-x-1">
                      <span>▲</span>
                      <span>100%</span>
                    </span>
                  </div>
                </div>

                {/* Row 2 */}
                <div className="px-5 py-3.5 grid grid-cols-12 items-center gap-4">
                  <div className="col-span-4 font-semibold text-[#1a2b3c]">
                    Gastos Operacionales
                  </div>
                  <div className="col-span-2 font-mono font-bold text-rose-600">
                    -${profitLoss?.totalExpenses ? Number(profitLoss.totalExpenses).toFixed(2) : '0.00'}
                  </div>
                  <div className="col-span-4">
                    <p className="text-[11px] text-[#6b7c93] mb-1">
                      {expenses.length} comprobantes de egreso
                    </p>
                    <div className="w-full bg-[#edf1f4] rounded-full h-1.5 overflow-hidden">
                      <div className="bg-rose-500 h-1.5 rounded-full" style={{ width: '35%' }}></div>
                    </div>
                  </div>
                  <div className="col-span-2 text-right">
                    <span className="text-[#8a9ba8] font-medium">-</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* RIGHT 4 COLS: TOKENS CARD (Pure Mapbox Console DNA) */}
          <div className="lg:col-span-4 space-y-6">
            <div className="bg-white rounded-xl border border-[#e1e7ec] p-5 shadow-2xs space-y-4">
              <div className="flex items-center justify-between">
                <h3 className="font-bold text-sm text-[#1a2b3c]">
                  Tokens
                </h3>
                <button
                  onClick={() => fetchData(tenant.id)}
                  className="text-xs text-[#4264fb] hover:underline flex items-center space-x-1 font-semibold"
                >
                  <RefreshCw className="w-3 h-3" />
                  <span>Refresh</span>
                </button>
              </div>

              <div>
                <p className="text-xs font-bold text-[#1a2b3c]">
                  Default public token
                </p>
                <p className="text-[11px] text-[#6b7c93] leading-relaxed mt-1">
                  Use protected tokens for live applications. See our token management best practices page to learn more.
                </p>
              </div>

              {/* Token Box with Copy Button */}
              <div className="flex items-center space-x-1.5 bg-[#f4f7fb] border border-[#d2dce6] rounded-md p-1.5">
                <span className="font-mono text-[11px] text-[#334155] px-2 truncate flex-1 select-all">
                  {tokenSnippet}
                </span>
                <button
                  onClick={handleCopyToken}
                  className="bg-[#4264fb] hover:bg-[#314ccd] text-white p-1.5 rounded transition-colors shrink-0"
                  title="Copiar token"
                >
                  {copiedToken ? <Check className="w-3.5 h-3.5" /> : <Copy className="w-3.5 h-3.5" />}
                </button>
              </div>

              <div className="pt-2 border-t border-[#edf1f4] space-y-2">
                <a
                  href="#"
                  className="text-xs font-bold text-[#4264fb] hover:underline flex items-center space-x-1"
                >
                  <span>View all tokens &gt;</span>
                </a>
              </div>

              {/* Tenant Identity Box */}
              <div className="bg-[#edf2ff] border border-[#bac8ff] rounded-lg p-3 space-y-1 text-xs">
                <p className="font-bold text-[#4264fb] flex items-center space-x-1">
                  <ShieldCheck className="w-3.5 h-3.5" />
                  <span>Aislamiento RLS Activo</span>
                </p>
                <p className="text-[11px] text-[#334155]">
                  Tenant ID: <code className="font-mono">{tenant.id?.slice(0, 8)}...</code>
                </p>
                <p className="text-[11px] text-[#334155]">
                  Plan: <strong>{tenant.subscription?.plan?.name || 'Pro SaaS'}</strong>
                </p>
              </div>
            </div>

            {/* Quick Branches Card */}
            <div className="bg-white rounded-xl border border-[#e1e7ec] p-5 shadow-2xs space-y-3">
              <h3 className="font-bold text-sm text-[#1a2b3c] flex items-center justify-between">
                <span>Sucursales & Almacenes</span>
                <span className="text-xs font-mono font-semibold text-[#6b7c93]">
                  {branches.length} activas
                </span>
              </h3>

              <div className="space-y-2">
                {branches.map((b) => (
                  <div
                    key={b.id}
                    className="p-2.5 bg-[#f7f9fb] border border-[#e1e7ec] rounded-lg flex items-center justify-between text-xs"
                  >
                    <div>
                      <p className="font-bold text-[#1a2b3c]">{b.name}</p>
                      <p className="text-[11px] text-[#6b7c93]">{b.warehouses?.length || 0} depósitos</p>
                    </div>
                    <span className="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded border border-emerald-200">
                      En Línea
                    </span>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>

        {/* ==================================================== */}
        {/* 5. TAB DETAILS: PRODUCTS / QUOTES / EXPENSES / STATS */}
        {/* ==================================================== */}
        {currentView === 'inventory' && (
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
            <div className="px-6 py-4 border-b border-[#edf1f4] flex items-center justify-between">
              <div>
                <h3 className="font-bold text-sm text-[#1a2b3c]">
                  Catálogo de Productos y Existencias
                </h3>
                <p className="text-xs text-[#6b7c93]">Aislado para el tenant: <strong>{tenant.tradeName}</strong></p>
              </div>
              <button
                onClick={() => setShowProductModal(true)}
                className="bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold px-3 py-1.5 rounded-md"
              >
                + Nuevo Producto
              </button>
            </div>
            <div className="overflow-x-auto">
              <table className="w-full text-left text-xs">
                <thead className="bg-[#f7f9fb] uppercase font-bold text-[#8a9ba8] border-b border-[#edf1f4]">
                  <tr>
                    <th className="px-6 py-3">Código</th>
                    <th className="px-6 py-3">Nombre</th>
                    <th className="px-6 py-3">Costo ($)</th>
                    <th className="px-6 py-3">Precio ($)</th>
                    <th className="px-6 py-3">Stock Físico</th>
                    <th className="px-6 py-3">Estado</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-[#edf1f4]">
                  {products.map((p) => {
                    const st = p.warehouseStocks?.reduce((acc: number, curr: any) => acc + Number(curr.quantity), 0) || 0;
                    return (
                      <tr key={p.id} className="hover:bg-[#f7f9fb] transition-colors">
                        <td className="px-6 py-3 font-mono font-bold text-[#4264fb]">{p.code}</td>
                        <td className="px-6 py-3 font-semibold text-[#1a2b3c]">{p.name}</td>
                        <td className="px-6 py-3">${Number(p.cost).toFixed(2)}</td>
                        <td className="px-6 py-3 font-bold text-[#1a2b3c]">${Number(p.price).toFixed(2)}</td>
                        <td className="px-6 py-3 font-mono font-bold">{st}</td>
                        <td className="px-6 py-3">
                          <span
                            className={`px-2 py-0.5 rounded text-[10px] font-bold ${
                              st > 5 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                            }`}
                          >
                            {st > 5 ? 'En Stock' : 'Stock Bajo'}
                          </span>
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {currentView === 'quotes' && (
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
            <div className="px-6 py-4 border-b border-[#edf1f4] flex items-center justify-between">
              <div>
                <h3 className="font-bold text-sm text-[#1a2b3c]">
                  Cotizaciones y Presupuestos
                </h3>
                <p className="text-xs text-[#6b7c93]">Convierte ofertas en facturas descargando inventario automáticamente.</p>
              </div>
              <button
                onClick={() => setShowQuoteModal(true)}
                className="bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold px-3 py-1.5 rounded-md"
              >
                + Nueva Cotización
              </button>
            </div>
            <div className="overflow-x-auto">
              <table className="w-full text-left text-xs">
                <thead className="bg-[#f7f9fb] uppercase font-bold text-[#8a9ba8] border-b border-[#edf1f4]">
                  <tr>
                    <th className="px-6 py-3">Referencia</th>
                    <th className="px-6 py-3">Cliente</th>
                    <th className="px-6 py-3">Fecha</th>
                    <th className="px-6 py-3">Total ($)</th>
                    <th className="px-6 py-3">Estado</th>
                    <th className="px-6 py-3 text-right">Acción</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-[#edf1f4]">
                  {quotes.map((q) => (
                    <tr key={q.id} className="hover:bg-[#f7f9fb] transition-colors">
                      <td className="px-6 py-3 font-mono font-bold text-violet-600">{q.referenceNumber}</td>
                      <td className="px-6 py-3 font-semibold text-[#1a2b3c]">{q.customer?.name}</td>
                      <td className="px-6 py-3 text-[#6b7c93]">{new Date(q.createdAt).toLocaleDateString()}</td>
                      <td className="px-6 py-3 font-bold text-[#1a2b3c]">${Number(q.grandTotal).toFixed(2)}</td>
                      <td className="px-6 py-3">
                        <span
                          className={`px-2 py-0.5 rounded text-[10px] font-bold ${
                            q.status === 'CONVERTED' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
                          }`}
                        >
                          {q.status === 'CONVERTED' ? 'Facturada' : 'Pendiente'}
                        </span>
                      </td>
                      <td className="px-6 py-3 text-right">
                        {q.status === 'PENDING' && (
                          <button
                            onClick={() => handleConvertQuote(q.id)}
                            className="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-2.5 py-1 rounded text-[11px]"
                          >
                            Facturar Cotización
                          </button>
                        )}
                        {q.status === 'CONVERTED' && (
                          <span className="text-[#8a9ba8] font-semibold text-[11px]">Convertida</span>
                        )}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {currentView === 'expenses' && (
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
            <div className="px-6 py-4 border-b border-[#edf1f4] flex items-center justify-between">
              <div>
                <h3 className="font-bold text-sm text-[#1a2b3c]">
                  Gastos Operativos
                </h3>
                <p className="text-xs text-[#6b7c93]">Registro de egresos y costos no relacionados con compras de inventario.</p>
              </div>
              <button
                onClick={() => setShowExpenseModal(true)}
                className="bg-[#4264fb] hover:bg-[#314ccd] text-white text-xs font-bold px-3 py-1.5 rounded-md"
              >
                + Registrar Gasto
              </button>
            </div>
            <div className="overflow-x-auto">
              <table className="w-full text-left text-xs">
                <thead className="bg-[#f7f9fb] uppercase font-bold text-[#8a9ba8] border-b border-[#edf1f4]">
                  <tr>
                    <th className="px-6 py-3">Comprobante</th>
                    <th className="px-6 py-3">Categoría</th>
                    <th className="px-6 py-3">Nota</th>
                    <th className="px-6 py-3">Fecha</th>
                    <th className="px-6 py-3 text-right">Monto ($)</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-[#edf1f4]">
                  {expenses.map((e) => (
                    <tr key={e.id} className="hover:bg-[#f7f9fb] transition-colors">
                      <td className="px-6 py-3 font-mono font-bold text-rose-600">{e.reference}</td>
                      <td className="px-6 py-3 font-semibold text-[#1a2b3c]">{e.category?.name || 'General'}</td>
                      <td className="px-6 py-3 text-[#6b7c93]">{e.note || '-'}</td>
                      <td className="px-6 py-3 text-[#6b7c93]">{new Date(e.date).toLocaleDateString()}</td>
                      <td className="px-6 py-3 font-bold text-rose-600 text-right">
                        -${Number(e.amount).toFixed(2)}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}
      </main>

      {/* ==================================================== */}
      {/* 6. MODALS (Crear Producto, Cotización, Gasto, Transfer) */}
      {/* ==================================================== */}
      {showProductModal && (
        <div className="fixed inset-0 bg-[#0f172a]/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl max-w-md w-full p-6 shadow-xl border border-[#d2dce6]">
            <h3 className="font-bold text-base text-[#1a2b3c] mb-4">Añadir Nuevo Producto</h3>
            <form onSubmit={handleCreateProduct} className="space-y-3.5 text-xs">
              <div>
                <label className="block font-bold text-[#475569] mb-1">Código / SKU</label>
                <input
                  type="text"
                  value={newCode}
                  onChange={(e) => setNewCode(e.target.value)}
                  placeholder="ej. SAM-001"
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Nombre</label>
                <input
                  type="text"
                  value={newName}
                  onChange={(e) => setNewName(e.target.value)}
                  placeholder="ej. Pantalla LED 24 pulgadas"
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="block font-bold text-[#475569] mb-1">Costo ($)</label>
                  <input
                    type="number"
                    step="0.01"
                    value={newCost}
                    onChange={(e) => setNewCost(Number(e.target.value))}
                    required
                    className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                  />
                </div>
                <div>
                  <label className="block font-bold text-[#475569] mb-1">Precio ($)</label>
                  <input
                    type="number"
                    step="0.01"
                    value={newPrice}
                    onChange={(e) => setNewPrice(Number(e.target.value))}
                    required
                    className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                  />
                </div>
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Stock Inicial</label>
                <input
                  type="number"
                  value={newStock}
                  onChange={(e) => setNewStock(Number(e.target.value))}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div className="flex space-x-2 pt-3">
                <button
                  type="button"
                  onClick={() => setShowProductModal(false)}
                  className="flex-1 py-2 text-[#475569] border border-[#d2dce6] rounded-md hover:bg-[#f7f9fb] font-semibold"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  className="flex-1 py-2 bg-[#4264fb] hover:bg-[#314ccd] text-white rounded-md font-bold"
                >
                  Guardar
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {showQuoteModal && (
        <div className="fixed inset-0 bg-[#0f172a]/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl max-w-md w-full p-6 shadow-xl border border-[#d2dce6]">
            <h3 className="font-bold text-base text-[#1a2b3c] mb-4">Nueva Cotización</h3>
            <form onSubmit={handleCreateQuote} className="space-y-3.5 text-xs">
              <div>
                <label className="block font-bold text-[#475569] mb-1">Cliente</label>
                <input
                  type="text"
                  value={quoteCustomerName}
                  onChange={(e) => setQuoteCustomerName(e.target.value)}
                  placeholder="ej. Inversiones Tecnológicas C.A."
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Producto</label>
                <select
                  value={quoteProduct}
                  onChange={(e) => setQuoteProduct(e.target.value)}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                >
                  <option value="">Selecciona Producto</option>
                  {products.map((p) => (
                    <option key={p.id} value={p.id}>
                      {p.name} - ${Number(p.price).toFixed(2)}
                    </option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Cantidad</label>
                <input
                  type="number"
                  min="1"
                  value={quoteQty}
                  onChange={(e) => setQuoteQty(Number(e.target.value))}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div className="flex space-x-2 pt-3">
                <button
                  type="button"
                  onClick={() => setShowQuoteModal(false)}
                  className="flex-1 py-2 text-[#475569] border border-[#d2dce6] rounded-md hover:bg-[#f7f9fb] font-semibold"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  className="flex-1 py-2 bg-[#4264fb] hover:bg-[#314ccd] text-white rounded-md font-bold"
                >
                  Crear Cotización
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {showExpenseModal && (
        <div className="fixed inset-0 bg-[#0f172a]/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl max-w-md w-full p-6 shadow-xl border border-[#d2dce6]">
            <h3 className="font-bold text-base text-[#1a2b3c] mb-4">Registrar Gasto</h3>
            <form onSubmit={handleCreateExpense} className="space-y-3.5 text-xs">
              <div>
                <label className="block font-bold text-[#475569] mb-1">Categoría</label>
                <input
                  type="text"
                  value={expenseCategoryName}
                  onChange={(e) => setExpenseCategoryName(e.target.value)}
                  placeholder="ej. Alquiler, Luz, Internet"
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Monto ($)</label>
                <input
                  type="number"
                  step="0.01"
                  value={expenseAmount}
                  onChange={(e) => setExpenseAmount(Number(e.target.value))}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Concepto</label>
                <input
                  type="text"
                  value={expenseNote}
                  onChange={(e) => setExpenseNote(e.target.value)}
                  placeholder="ej. Factura Corpoelec Octubre"
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div className="flex space-x-2 pt-3">
                <button
                  type="button"
                  onClick={() => setShowExpenseModal(false)}
                  className="flex-1 py-2 text-[#475569] border border-[#d2dce6] rounded-md hover:bg-[#f7f9fb] font-semibold"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  className="flex-1 py-2 bg-[#4264fb] hover:bg-[#314ccd] text-white rounded-md font-bold"
                >
                  Registrar Gasto
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {showTransferModal && (
        <div className="fixed inset-0 bg-[#0f172a]/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl max-w-md w-full p-6 shadow-xl border border-[#d2dce6]">
            <h3 className="font-bold text-base text-[#1a2b3c] mb-4">Transferir Stock entre Almacenes</h3>
            <form onSubmit={handleCreateTransfer} className="space-y-3.5 text-xs">
              <div>
                <label className="block font-bold text-[#475569] mb-1">Origen</label>
                <select
                  value={transferOriginWh}
                  onChange={(e) => setTransferOriginWh(e.target.value)}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                >
                  <option value="">Selecciona Almacén Origen</option>
                  {allWarehouses.map((w: any) => (
                    <option key={w.id} value={w.id}>{w.name}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Destino</label>
                <select
                  value={transferDestWh}
                  onChange={(e) => setTransferDestWh(e.target.value)}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                >
                  <option value="">Selecciona Almacén Destino</option>
                  {allWarehouses.map((w: any) => (
                    <option key={w.id} value={w.id}>{w.name}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Producto</label>
                <select
                  value={transferProduct}
                  onChange={(e) => setTransferProduct(e.target.value)}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                >
                  <option value="">Selecciona Producto</option>
                  {products.map((p) => (
                    <option key={p.id} value={p.id}>{p.name} ({p.code})</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block font-bold text-[#475569] mb-1">Cantidad</label>
                <input
                  type="number"
                  min="1"
                  value={transferQty}
                  onChange={(e) => setTransferQty(Number(e.target.value))}
                  required
                  className="w-full px-3 py-2 border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:outline-none"
                />
              </div>
              <div className="flex space-x-2 pt-3">
                <button
                  type="button"
                  onClick={() => setShowTransferModal(false)}
                  className="flex-1 py-2 text-[#475569] border border-[#d2dce6] rounded-md hover:bg-[#f7f9fb] font-semibold"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  className="flex-1 py-2 bg-[#4264fb] hover:bg-[#314ccd] text-white rounded-md font-bold"
                >
                  Transferir
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
