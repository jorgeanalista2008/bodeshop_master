'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  ShoppingCart,
  Trash2,
  Plus,
  Minus,
  CreditCard,
  Banknote,
  CheckCircle,
  Package,
  PauseCircle,
  PlayCircle,
  Lock,
  Unlock,
  Printer,
  Search,
  AlertCircle,
  DollarSign,
  Clock,
  X,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function PosPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [branch, setBranch] = useState<any>(null);
  const [user, setUser] = useState<any>(null);
  const [products, setProducts] = useState<any[]>([]);
  const [cart, setCart] = useState<any[]>([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [loading, setLoading] = useState(true);
  const [processing, setProcessing] = useState(false);
  const [lastInvoice, setLastInvoice] = useState<any>(null);

  // Control de Caja Registradora (Turnos & Arqueo Z)
  const [activeRegister, setActiveRegister] = useState<any>(null);
  const [showOpenRegisterModal, setShowOpenRegisterModal] = useState(false);
  const [showCloseRegisterModal, setShowCloseRegisterModal] = useState(false);
  const [cashInHand, setCashInHand] = useState(100);
  const [cashSubmitted, setCashSubmitted] = useState(0);
  const [cardSubmitted, setCardSubmitted] = useState(0);
  const [closingNote, setClosingNote] = useState('');
  const [registerSummary, setRegisterSummary] = useState<any>(null);

  // Cuentas Suspendidas (Hold Bills)
  const [suspendedBills, setSuspendedBills] = useState<any[]>([]);
  const [showSuspendedDrawer, setShowSuspendedDrawer] = useState(false);
  const [suspendNote, setSuspendNote] = useState('');
  const [showSuspendModal, setShowSuspendModal] = useState(false);

  useEffect(() => {
    const rawTenant = localStorage.getItem('tenant');
    const rawBranch = localStorage.getItem('branch');
    const rawUser = localStorage.getItem('user');

    if (!rawTenant) {
      window.location.href = '/';
      return;
    }

    const t = JSON.parse(rawTenant);
    setTenant(t);
    if (rawUser) setUser(JSON.parse(rawUser));

    let b = rawBranch ? JSON.parse(rawBranch) : null;
    if (b) {
      setBranch(b);
      initPos(t.id, b.id);
    } else {
      fetchFirstBranch(t.id);
    }
  }, []);

  const fetchFirstBranch = async (tenantId: string) => {
    const token = localStorage.getItem('token') || undefined;
    try {
      const branches = await apiFetch<any[]>('/branches', { token, tenantId });
      if (branches && branches.length > 0) {
        setBranch(branches[0]);
        localStorage.setItem('branch', JSON.stringify(branches[0]));
        initPos(tenantId, branches[0].id);
      }
    } catch (e) {
      console.error(e);
    }
  };

  const initPos = async (tenantId: string, branchId: string) => {
    setLoading(true);
    const token = localStorage.getItem('token') || undefined;

    try {
      const [prods, reg, suspended] = await Promise.all([
        apiFetch<any[]>('/products', { token, tenantId }),
        apiFetch<any>(`/pos/active-register?branchId=${branchId}`, { token, tenantId }).catch(() => null),
        apiFetch<any[]>(`/pos/suspended?branchId=${branchId}`, { token, tenantId }).catch(() => []),
      ]);

      setProducts(prods || []);
      setActiveRegister(reg);
      setSuspendedBills(suspended || []);

      if (!reg) {
        setShowOpenRegisterModal(true);
      }
    } catch (err) {
      console.error('Error inicializando POS:', err);
    } finally {
      setLoading(false);
    }
  };

  // --- ARQUEO Y APERTURA DE CAJA ---
  const handleOpenRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    const token = localStorage.getItem('token') || undefined;

    try {
      const newReg = await apiFetch<any>('/pos/open-register', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          branchId: branch.id,
          cashInHand: Number(cashInHand),
        }),
      });

      setActiveRegister(newReg);
      setShowOpenRegisterModal(false);
      alert('¡Caja registradora abierta exitosamente!');
    } catch (err: any) {
      alert(`Error al abrir caja: ${err.message}`);
    }
  };

  const handleCloseRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    const token = localStorage.getItem('token') || undefined;

    try {
      const res = await apiFetch<any>('/pos/close-register', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          registerId: activeRegister.id,
          totalCashSubmitted: Number(cashSubmitted),
          totalCardSubmitted: Number(cardSubmitted),
          closingNote,
        }),
      });

      setRegisterSummary(res.summary);
      setActiveRegister(null);
      setShowCloseRegisterModal(false);
    } catch (err: any) {
      alert(`Error al cerrar caja: ${err.message}`);
    }
  };

  // --- CUENTAS SUSPENDIDAS ---
  const handleSuspendCurrentBill = async (e: React.FormEvent) => {
    e.preventDefault();
    if (cart.length === 0) return;

    const token = localStorage.getItem('token') || undefined;

    try {
      await apiFetch('/pos/suspend', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          branchId: branch.id,
          posRegisterId: activeRegister?.id,
          suspendNote: suspendNote || 'Venta en espera',
          items: cart.map((c) => ({
            productId: c.product.id,
            unitPrice: c.unitPrice,
            quantity: c.quantity,
          })),
        }),
      });

      setCart([]);
      setShowSuspendModal(false);
      setSuspendNote('');
      alert('¡Venta suspendida guardada!');

      // Recargar lista de suspendidas
      const suspended = await apiFetch<any[]>(`/pos/suspended?branchId=${branch.id}`, { token, tenantId: tenant.id });
      setSuspendedBills(suspended || []);
    } catch (err: any) {
      alert(`Error al suspender venta: ${err.message}`);
    }
  };

  const handleResumeSuspendedBill = async (bill: any) => {
    const token = localStorage.getItem('token') || undefined;

    // Cargar ítems a la cesta
    const newCart = bill.items.map((it: any) => ({
      product: it.product,
      quantity: Number(it.quantity),
      unitPrice: Number(it.unitPrice),
    }));

    setCart(newCart);

    // Eliminar de suspendidas
    try {
      await apiFetch(`/pos/suspended/${bill.id}`, {
        method: 'DELETE',
        token,
        tenantId: tenant.id,
      });

      setSuspendedBills((prev) => prev.filter((b) => b.id !== bill.id));
      setShowSuspendedDrawer(false);
    } catch (err) {
      console.error(err);
    }
  };

  // --- CESTA Y CHECKOUT ---
  const addToCart = (product: any) => {
    setCart((prev) => {
      const existing = prev.find((item) => item.product.id === product.id);
      if (existing) {
        return prev.map((item) =>
          item.product.id === product.id ? { ...item, quantity: item.quantity + 1 } : item
        );
      }
      return [...prev, { product, quantity: 1, unitPrice: Number(product.price) }];
    });
  };

  const updateQuantity = (productId: string, delta: number) => {
    setCart((prev) =>
      prev
        .map((item) => {
          if (item.product.id === productId) {
            const next = item.quantity + delta;
            return next > 0 ? { ...item, quantity: next } : null;
          }
          return item;
        })
        .filter(Boolean) as any[]
    );
  };

  const removeFromCart = (productId: string) => {
    setCart((prev) => prev.filter((item) => item.product.id !== productId));
  };

  const total = cart.reduce((acc, curr) => acc + curr.quantity * curr.unitPrice, 0);

  const handleCheckout = async (method: 'CASH' | 'CARD') => {
    if (cart.length === 0) return;
    if (!activeRegister) {
      alert('Debe abrir la caja registradora para poder facturar.');
      setShowOpenRegisterModal(true);
      return;
    }

    setProcessing(true);
    const token = localStorage.getItem('token') || undefined;
    const warehouseId = branch?.warehouses?.[0]?.id;

    try {
      const data = await apiFetch<any>('/sales', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          branchId: branch.id,
          warehouseId,
          paymentMethod: method,
          paidAmount: total,
          items: cart.map((c) => ({
            productId: c.product.id,
            quantity: c.quantity,
            unitPrice: c.unitPrice,
          })),
        }),
      });

      setLastInvoice(data);
      setCart([]);

      // Refrescar inventario
      const prods = await apiFetch<any[]>('/products', { token, tenantId: tenant.id });
      setProducts(prods || []);
    } catch (err: any) {
      alert(`Error al procesar cobro: ${err.message}`);
    } finally {
      setProcessing(false);
    }
  };

  const filteredProducts = products.filter(
    (p) =>
      p.name?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      p.code?.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="h-screen flex flex-col bg-slate-900 text-white overflow-hidden font-sans">
      {/* Top Header */}
      <header className="bg-slate-950 px-6 py-3 border-b border-slate-800 flex items-center justify-between z-10">
        <div className="flex items-center space-x-4">
          <Link
            href="/dashboard"
            className="p-2 bg-slate-800 hover:bg-slate-700 rounded-lg text-slate-300 transition-colors"
          >
            <ArrowLeft className="w-5 h-5" />
          </Link>
          <div>
            <div className="flex items-center space-x-2">
              <h1 className="font-extrabold text-sm text-white">{tenant?.tradeName} — Terminal POS</h1>
              <span className="bg-emerald-500/20 text-emerald-400 text-[10px] font-mono font-bold px-2 py-0.5 rounded border border-emerald-500/30">
                SMA 3.4
              </span>
            </div>
            <p className="text-xs text-slate-400">
              Sede: {branch?.name || 'San Felipe'} • Turno:{' '}
              {activeRegister ? (
                <span className="text-emerald-400 font-bold">ABIERTO (Fondo: ${Number(activeRegister.cashInHand).toFixed(2)})</span>
              ) : (
                <span className="text-rose-400 font-bold">CERRADO</span>
              )}
            </p>
          </div>
        </div>

        {/* Acciones de Caja & Cuentas Suspendidas */}
        <div className="flex items-center space-x-3">
          {/* Botón Cuentas Suspendidas */}
          <button
            onClick={() => setShowSuspendedDrawer(true)}
            className="relative px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold rounded-lg border border-slate-700 flex items-center space-x-1.5 transition-colors"
          >
            <PauseCircle className="w-4 h-4 text-amber-400" />
            <span>En Espera</span>
            {suspendedBills.length > 0 && (
              <span className="absolute -top-1.5 -right-1.5 bg-amber-500 text-slate-950 text-[10px] font-extrabold w-5 h-5 rounded-full flex items-center justify-center">
                {suspendedBills.length}
              </span>
            )}
          </button>

          {/* Botón de Apertura / Cierre de Turno */}
          {activeRegister ? (
            <button
              onClick={() => {
                setCashSubmitted(Number(activeRegister.expectedCashInDrawer) || Number(activeRegister.cashInHand));
                setCardSubmitted(Number(activeRegister.calculatedCardSales) || 0);
                setShowCloseRegisterModal(true);
              }}
              className="px-3 py-1.5 bg-rose-600/20 hover:bg-rose-600/30 border border-rose-500/30 text-rose-300 text-xs font-bold rounded-lg flex items-center space-x-1.5 transition-colors"
            >
              <Lock className="w-3.5 h-3.5" />
              <span>Cerrar Turno (Arqueo Z)</span>
            </button>
          ) : (
            <button
              onClick={() => setShowOpenRegisterModal(true)}
              className="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-lg flex items-center space-x-1.5 transition-colors shadow-xs"
            >
              <Unlock className="w-3.5 h-3.5" />
              <span>Abrir Turno de Caja</span>
            </button>
          )}
        </div>
      </header>

      {/* Main Workspace */}
      <div className="flex-1 grid grid-cols-12 overflow-hidden">
        {/* Catálogo de Productos (7 cols) */}
        <div className="col-span-7 p-6 overflow-y-auto bg-slate-900 border-r border-slate-800 flex flex-col space-y-4">
          <div className="flex items-center justify-between">
            <h2 className="text-xs uppercase font-extrabold tracking-wider text-slate-400">
              Catálogo Táctil ({filteredProducts.length} productos)
            </h2>
            <div className="relative w-64">
              <Search className="w-4 h-4 text-slate-500 absolute left-3 top-2.5" />
              <input
                type="text"
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                placeholder="Buscar por código o nombre..."
                className="w-full pl-9 pr-3 py-1.5 bg-slate-950 border border-slate-700 rounded-lg text-xs text-white focus:outline-none focus:border-indigo-500"
              />
            </div>
          </div>

          {loading ? (
            <p className="text-sm text-slate-500">Cargando inventario...</p>
          ) : (
            <div className="grid grid-cols-3 gap-3">
              {filteredProducts.map((p) => (
                <button
                  key={p.id}
                  onClick={() => addToCart(p)}
                  className="bg-slate-800 hover:bg-slate-750 active:scale-98 border border-slate-700/60 p-4 rounded-xl flex flex-col justify-between text-left transition-all group"
                >
                  <div>
                    <span className="text-[10px] font-mono text-indigo-400 font-bold">{p.code}</span>
                    <h3 className="font-bold text-xs text-slate-200 mt-1 line-clamp-2 leading-tight group-hover:text-white">
                      {p.name}
                    </h3>
                  </div>
                  <div className="mt-4 flex items-center justify-between pt-2 border-t border-slate-700/40">
                    <span className="text-[10px] text-slate-400">{p.unit || 'UND'}</span>
                    <span className="font-extrabold text-sm text-emerald-400 font-mono">
                      ${Number(p.price).toFixed(2)}
                    </span>
                  </div>
                </button>
              ))}
            </div>
          )}
        </div>

        {/* Canasta de Compra & Cobro (5 cols) */}
        <div className="col-span-5 flex flex-col bg-slate-950 overflow-hidden">
          <div className="p-4 border-b border-slate-800 flex items-center justify-between">
            <div className="flex items-center space-x-2">
              <ShoppingCart className="w-4 h-4 text-indigo-400" />
              <h2 className="text-xs uppercase font-extrabold text-slate-300">Ticket de Venta</h2>
            </div>
            {cart.length > 0 && (
              <div className="flex items-center space-x-2">
                <button
                  onClick={() => setShowSuspendModal(true)}
                  className="text-[11px] font-bold text-amber-400 hover:text-amber-300 px-2 py-1 bg-amber-500/10 rounded border border-amber-500/20"
                >
                  Suspender
                </button>
                <button
                  onClick={() => setCart([])}
                  className="text-[11px] font-bold text-rose-400 hover:text-rose-300 px-2 py-1 bg-rose-500/10 rounded border border-rose-500/20"
                >
                  Vaciar
                </button>
              </div>
            )}
          </div>

          {/* Lista de Ítems */}
          <div className="flex-1 p-4 overflow-y-auto divide-y divide-slate-800/60 space-y-2">
            {cart.length === 0 ? (
              <div className="h-full flex flex-col items-center justify-center text-slate-600 text-xs">
                <ShoppingCart className="w-10 h-10 mb-2 stroke-1" />
                <p>Cesta vacía. Selecciona productos a la izquierda.</p>
              </div>
            ) : (
              cart.map((item) => (
                <div key={item.product.id} className="pt-2 flex items-center justify-between text-xs">
                  <div className="flex-1 pr-2">
                    <p className="font-bold text-slate-200">{item.product.name}</p>
                    <p className="text-[10px] text-slate-400 font-mono">
                      ${item.unitPrice.toFixed(2)} c/u
                    </p>
                  </div>

                  <div className="flex items-center space-x-1.5">
                    <button
                      onClick={() => updateQuantity(item.product.id, -1)}
                      className="w-6 h-6 rounded bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300"
                    >
                      <Minus className="w-3 h-3" />
                    </button>
                    <span className="w-6 text-center font-mono font-bold text-white text-xs">
                      {item.quantity}
                    </span>
                    <button
                      onClick={() => updateQuantity(item.product.id, 1)}
                      className="w-6 h-6 rounded bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300"
                    >
                      <Plus className="w-3 h-3" />
                    </button>
                  </div>

                  <div className="w-16 text-right font-mono font-bold text-emerald-400 text-xs ml-3">
                    ${(item.quantity * item.unitPrice).toFixed(2)}
                  </div>

                  <button
                    onClick={() => removeFromCart(item.product.id)}
                    className="ml-2 text-slate-600 hover:text-rose-400"
                  >
                    <Trash2 className="w-3.5 h-3.5" />
                  </button>
                </div>
              ))
            )}
          </div>

          {/* Total & Botones de Cobro */}
          <div className="p-4 bg-slate-900 border-t border-slate-800 space-y-3">
            <div className="flex justify-between items-center text-sm">
              <span className="text-slate-400">Total a Pagar:</span>
              <span className="text-2xl font-black font-mono text-emerald-400">${total.toFixed(2)}</span>
            </div>

            <div className="grid grid-cols-2 gap-2">
              <button
                onClick={() => handleCheckout('CASH')}
                disabled={processing || cart.length === 0}
                className="py-3 bg-emerald-600 hover:bg-emerald-500 disabled:opacity-50 text-white font-extrabold text-xs rounded-xl flex items-center justify-center space-x-1.5 transition-all shadow-xs"
              >
                <Banknote className="w-4 h-4" />
                <span>Cobrar Efectivo</span>
              </button>

              <button
                onClick={() => handleCheckout('CARD')}
                disabled={processing || cart.length === 0}
                className="py-3 bg-indigo-600 hover:bg-indigo-500 disabled:opacity-50 text-white font-extrabold text-xs rounded-xl flex items-center justify-center space-x-1.5 transition-all shadow-xs"
              >
                <CreditCard className="w-4 h-4" />
                <span>Cobrar Tarjeta / POS</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* Modal: Apertura de Caja */}
      {showOpenRegisterModal && (
        <div className="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-slate-900 border border-slate-800 rounded-xl p-6 max-w-sm w-full space-y-4 shadow-2xl">
            <div className="flex items-center space-x-2 text-emerald-400">
              <Unlock className="w-5 h-5" />
              <h3 className="font-bold text-sm text-white">Apertura de Turno de Caja</h3>
            </div>
            <p className="text-xs text-slate-400">
              Ingrese el monto en efectivo inicial asignado a esta gaveta de dinero para comenzar las ventas.
            </p>

            <form onSubmit={handleOpenRegister} className="space-y-3">
              <div>
                <label className="block text-xs font-bold text-slate-300 mb-1">Fondo en Efectivo ($)</label>
                <input
                  type="number"
                  step="0.01"
                  min="0"
                  value={cashInHand}
                  onChange={(e) => setCashInHand(Number(e.target.value))}
                  required
                  className="w-full p-2 bg-slate-950 border border-slate-700 rounded-lg text-sm font-mono text-emerald-400 focus:outline-none"
                />
              </div>

              <button
                type="submit"
                className="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-lg"
              >
                Confirmar y Abrir Caja
              </button>
            </form>
          </div>
        </div>
      )}

      {/* Modal: Cierre de Turno y Arqueo Z */}
      {showCloseRegisterModal && activeRegister && (
        <div className="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-slate-900 border border-slate-800 rounded-xl p-6 max-w-md w-full space-y-4 shadow-2xl text-xs">
            <div className="flex items-center justify-between border-b border-slate-800 pb-2">
              <div className="flex items-center space-x-2 text-rose-400">
                <Lock className="w-5 h-5" />
                <h3 className="font-bold text-sm text-white">Arqueo y Cierre Z de Caja</h3>
              </div>
              <button onClick={() => setShowCloseRegisterModal(false)} className="text-slate-500 hover:text-white">
                <X className="w-4 h-4" />
              </button>
            </div>

            <div className="bg-slate-950 p-3 rounded-lg border border-slate-800 font-mono space-y-1 text-slate-300">
              <div className="flex justify-between">
                <span>Fondo Inicial:</span>
                <span>${Number(activeRegister.cashInHand).toFixed(2)}</span>
              </div>
              <div className="flex justify-between text-emerald-400">
                <span>Ventas Efectivo Sistema:</span>
                <span>+${Number(activeRegister.calculatedCashSales || 0).toFixed(2)}</span>
              </div>
              <div className="flex justify-between text-indigo-400">
                <span>Ventas Tarjeta Sistema:</span>
                <span>+${Number(activeRegister.calculatedCardSales || 0).toFixed(2)}</span>
              </div>
              <div className="flex justify-between font-bold border-t border-slate-800 pt-1 text-white">
                <span>Efectivo Esperado en Gaveta:</span>
                <span>${Number(activeRegister.expectedCashInDrawer || activeRegister.cashInHand).toFixed(2)}</span>
              </div>
            </div>

            <form onSubmit={handleCloseRegister} className="space-y-3">
              <div>
                <label className="block text-slate-300 font-bold mb-1">Efectivo Contado al Cierre ($)</label>
                <input
                  type="number"
                  step="0.01"
                  value={cashSubmitted}
                  onChange={(e) => setCashSubmitted(Number(e.target.value))}
                  required
                  className="w-full p-2 bg-slate-950 border border-slate-700 rounded-lg text-emerald-400 font-mono"
                />
              </div>

              <div>
                <label className="block text-slate-300 font-bold mb-1">Lotes / Tarjeta Contados ($)</label>
                <input
                  type="number"
                  step="0.01"
                  value={cardSubmitted}
                  onChange={(e) => setCardSubmitted(Number(e.target.value))}
                  required
                  className="w-full p-2 bg-slate-950 border border-slate-700 rounded-lg text-indigo-400 font-mono"
                />
              </div>

              <div>
                <label className="block text-slate-300 font-bold mb-1">Nota de Cierre</label>
                <input
                  type="text"
                  value={closingNote}
                  onChange={(e) => setClosingNote(e.target.value)}
                  placeholder="Observaciones de caja..."
                  className="w-full p-2 bg-slate-950 border border-slate-700 rounded-lg text-slate-200"
                />
              </div>

              <button
                type="submit"
                className="w-full py-2.5 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded-lg"
              >
                Efectuar Corte Z y Cerrar Turno
              </button>
            </form>
          </div>
        </div>
      )}

      {/* Cajón Lateral: Cuentas Suspendidas */}
      {showSuspendedDrawer && (
        <div className="fixed inset-0 bg-black/60 backdrop-blur-xs flex justify-end z-50">
          <div className="bg-slate-900 border-l border-slate-800 w-full max-w-sm p-6 space-y-4 flex flex-col">
            <div className="flex items-center justify-between border-b border-slate-800 pb-3">
              <div className="flex items-center space-x-2">
                <PauseCircle className="w-5 h-5 text-amber-400" />
                <h3 className="font-bold text-sm text-white">Ventas en Espera ({suspendedBills.length})</h3>
              </div>
              <button onClick={() => setShowSuspendedDrawer(false)} className="text-slate-500 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="flex-1 overflow-y-auto space-y-3">
              {suspendedBills.length === 0 ? (
                <p className="text-xs text-slate-500 text-center py-8">No hay ventas pausadas actualmente.</p>
              ) : (
                suspendedBills.map((bill) => (
                  <div key={bill.id} className="bg-slate-950 border border-slate-800 p-3 rounded-xl space-y-2">
                    <div className="flex justify-between items-center text-xs">
                      <span className="font-bold text-amber-400">{bill.suspendNote}</span>
                      <span className="text-[10px] text-slate-500">{new Date(bill.createdAt).toLocaleTimeString()}</span>
                    </div>
                    <p className="text-[11px] text-slate-400">{bill.items?.length || 0} ítems en cesta</p>
                    <div className="flex justify-between items-center pt-2 border-t border-slate-800/60">
                      <span className="font-mono font-bold text-white text-xs">${Number(bill.total).toFixed(2)}</span>
                      <button
                        onClick={() => handleResumeSuspendedBill(bill)}
                        className="px-2.5 py-1 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-[11px] rounded flex items-center space-x-1"
                      >
                        <PlayCircle className="w-3.5 h-3.5" />
                        <span>Retomar</span>
                      </button>
                    </div>
                  </div>
                ))
              )}
            </div>
          </div>
        </div>
      )}

      {/* Modal: Suspender Venta Actual */}
      {showSuspendModal && (
        <div className="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-slate-900 border border-slate-800 rounded-xl p-6 max-w-sm w-full space-y-4">
            <h3 className="font-bold text-sm text-white">Suspender Venta Actual</h3>
            <p className="text-xs text-slate-400">
              Asigne un identificador o nota a esta venta para atender a otro cliente en mostrador.
            </p>
            <form onSubmit={handleSuspendCurrentBill} className="space-y-3">
              <input
                type="text"
                value={suspendNote}
                onChange={(e) => setSuspendNote(e.target.value)}
                placeholder="Ej. Cliente de camisa azul, Mesa 4..."
                required
                className="w-full p-2 bg-slate-950 border border-slate-700 rounded-lg text-xs text-white"
              />
              <div className="flex justify-end space-x-2">
                <button
                  type="button"
                  onClick={() => setShowSuspendModal(false)}
                  className="px-3 py-1.5 border border-slate-700 rounded-lg text-xs text-slate-400"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  className="px-3 py-1.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-lg text-xs"
                >
                  Pausar Venta
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* Ticket Imprimible Última Venta */}
      {lastInvoice && (
        <div className="fixed inset-0 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white text-slate-900 p-6 rounded-2xl max-w-sm w-full font-mono text-xs space-y-4 shadow-2xl">
            <div className="text-center border-b border-dashed border-slate-300 pb-3">
              <h3 className="font-extrabold text-sm uppercase">{tenant.tradeName}</h3>
              <p className="text-[10px] text-slate-500">Comprobante POS • Factura {lastInvoice.invoiceNumber}</p>
              <p className="text-[10px] text-slate-400">{new Date().toLocaleString()}</p>
            </div>

            <div className="divide-y divide-dashed divide-slate-200 py-1">
              {lastInvoice.items?.map((item: any, idx: number) => (
                <div key={idx} className="py-1.5 flex justify-between">
                  <span>
                    {item.product?.name} x{item.quantity}
                  </span>
                  <span>${Number(item.subtotal).toFixed(2)}</span>
                </div>
              ))}
            </div>

            <div className="border-t border-dashed border-slate-300 pt-2 flex justify-between font-extrabold text-sm">
              <span>TOTAL PAGADO:</span>
              <span>${Number(lastInvoice.grandTotal).toFixed(2)}</span>
            </div>

            <div className="flex space-x-2 pt-2">
              <button
                onClick={() => window.print()}
                className="flex-1 py-2 bg-slate-950 text-white rounded-lg font-bold flex items-center justify-center space-x-1"
              >
                <Printer className="w-3.5 h-3.5" />
                <span>Imprimir Ticket</span>
              </button>
              <button
                onClick={() => setLastInvoice(null)}
                className="px-4 py-2 border border-slate-300 rounded-lg text-slate-600 font-bold"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
