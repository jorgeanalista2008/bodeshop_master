'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import { Store, ShoppingCart, Search, Filter, CheckCircle2, ArrowRight, X, Plus, Minus, Tag, ShieldCheck } from 'lucide-react';

export default function ShopPage() {
  const [tenantSlug, setTenantSlug] = useState('bodeshop');
  const [products, setProducts] = useState<any[]>([]);
  const [categories, setCategories] = useState<string[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>('ALL');
  const [search, setSearch] = useState('');
  const [cart, setCart] = useState<any[]>([]);
  const [cartOpen, setCartOpen] = useState(false);
  const [loading, setLoading] = useState(true);
  const [orderSuccess, setOrderSuccess] = useState<any>(null);

  useEffect(() => {
    fetchStoreCatalog(tenantSlug);
  }, [tenantSlug]);

  const fetchStoreCatalog = async (slug: string) => {
    setLoading(true);
    try {
      // Usar endpoint público con header del subdominio de la tienda
      const res = await fetch('http://localhost:4000/products', {
        headers: { 'x-tenant-slug': slug },
      });

      if (res.ok) {
        const data = await res.json();
        setProducts(data);
        const cats = Array.from(new Set(data.map((p: any) => p.category?.name).filter(Boolean))) as string[];
        setCategories(cats);
      }
    } catch (e) {
      console.error(e);
    } finally {
      setLoading(false);
    }
  };

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
    setCartOpen(true);
  };

  const updateQuantity = (productId: string, delta: number) => {
    setCart((prev) =>
      prev
        .map((item) => {
          if (item.product.id === productId) {
            const newQty = item.quantity + delta;
            return newQty > 0 ? { ...item, quantity: newQty } : null;
          }
          return item;
        })
        .filter(Boolean) as any[]
    );
  };

  const total = cart.reduce((acc, item) => acc + item.quantity * item.unitPrice, 0);

  const filteredProducts = products.filter((p) => {
    const matchesCat = selectedCategory === 'ALL' || p.category?.name === selectedCategory;
    const matchesSearch = p.name.toLowerCase().includes(search.toLowerCase()) || p.code.toLowerCase().includes(search.toLowerCase());
    return matchesCat && matchesSearch;
  });

  return (
    <div className="min-h-screen bg-slate-50 text-slate-900 flex flex-col">
      {/* Top Banner de Comercio */}
      <div className="bg-slate-900 text-slate-300 text-xs py-2 px-6 flex items-center justify-between border-b border-slate-800">
        <div className="flex items-center space-x-2">
          <ShieldCheck className="w-4 h-4 text-emerald-400" />
          <span>Tienda E-commerce B2C Segura • Compras directas al inventario</span>
        </div>

        {/* Selector de Comercio Demo */}
        <div className="flex items-center space-x-2">
          <span>Tienda activa:</span>
          <select
            value={tenantSlug}
            onChange={(e) => setTenantSlug(e.target.value)}
            className="bg-slate-800 text-white font-bold rounded px-2 py-0.5 border border-slate-700 text-xs focus:outline-none"
          >
            <option value="bodeshop">BodeShop Master C.A.</option>
            <option value="calzados-madrid">Calzados Madrid</option>
            <option value="farmacia-central">Farmacia Central</option>
          </select>
        </div>
      </div>

      {/* Main Navbar */}
      <header className="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm px-6 py-4 flex items-center justify-between">
        <div className="flex items-center space-x-3">
          <div className="bg-sky-600 text-white p-2.5 rounded-xl shadow-md">
            <Store className="w-6 h-6" />
          </div>
          <div>
            <h1 className="font-extrabold text-xl text-slate-900 tracking-tight capitalize">
              {tenantSlug === 'bodeshop' ? 'BodeShop Master' : tenantSlug.replace('-', ' ')}
            </h1>
            <p className="text-xs text-slate-500">Tienda Online Oficial</p>
          </div>
        </div>

        {/* Buscador */}
        <div className="hidden sm:flex items-center flex-1 max-w-md mx-8 relative">
          <Search className="w-4 h-4 text-slate-400 absolute left-3" />
          <input
            type="text"
            placeholder="Buscar productos..."
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            className="w-full pl-9 pr-4 py-2 bg-slate-100 border border-slate-200 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
          />
        </div>

        {/* Botón Carrito */}
        <button
          onClick={() => setCartOpen(true)}
          className="relative bg-slate-900 hover:bg-slate-800 text-white px-4 py-2.5 rounded-full flex items-center space-x-2 shadow-md transition-all active:scale-95"
        >
          <ShoppingCart className="w-4 h-4" />
          <span className="font-bold text-xs">Carrito</span>
          {cart.length > 0 && (
            <span className="bg-sky-500 text-white font-black text-[11px] px-2 py-0.5 rounded-full">
              {cart.reduce((a, b) => a + b.quantity, 0)}
            </span>
          )}
        </button>
      </header>

      {/* Hero Banner */}
      <div className="bg-gradient-to-r from-sky-600 to-indigo-700 text-white py-12 px-6 text-center">
        <h2 className="text-3xl sm:text-4xl font-extrabold tracking-tight">Catálogo de Productos y Envíos a Domicilio</h2>
        <p className="text-sky-100 text-sm mt-2 max-w-xl mx-auto">
          Productos con disponibilidad inmediata en tiempo real sincronizados con nuestros almacenes.
        </p>
      </div>

      {/* Categorías y Catálogo */}
      <main className="flex-1 max-w-7xl w-full mx-auto px-6 py-8 space-y-6">
        {/* Barra de Categorías */}
        <div className="flex items-center space-x-2 overflow-x-auto pb-2">
          <button
            onClick={() => setSelectedCategory('ALL')}
            className={`px-4 py-1.5 rounded-full text-xs font-bold transition-all shrink-0 ${
              selectedCategory === 'ALL'
                ? 'bg-slate-900 text-white shadow'
                : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            Todos los Productos ({products.length})
          </button>
          {categories.map((c) => (
            <button
              key={c}
              onClick={() => setSelectedCategory(c)}
              className={`px-4 py-1.5 rounded-full text-xs font-bold transition-all shrink-0 ${
                selectedCategory === c
                  ? 'bg-sky-600 text-white shadow'
                  : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-100'
              }`}
            >
              {c}
            </button>
          ))}
        </div>

        {/* Grid de Productos */}
        {loading ? (
          <div className="py-20 text-center text-slate-400">Cargando catálogo...</div>
        ) : filteredProducts.length === 0 ? (
          <div className="py-20 text-center text-slate-400">No se encontraron productos para esta búsqueda.</div>
        ) : (
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {filteredProducts.map((p) => {
              const stock = p.warehouseStocks?.reduce((acc: number, curr: any) => acc + Number(curr.quantity), 0) || 0;
              return (
                <div
                  key={p.id}
                  className="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between"
                >
                  <div className="p-5 space-y-3">
                    <div className="flex items-center justify-between text-xs text-slate-400">
                      <span className="font-mono uppercase font-bold text-sky-600">{p.code}</span>
                      <span className="bg-slate-100 px-2 py-0.5 rounded text-[11px] font-medium">{p.category?.name || 'General'}</span>
                    </div>

                    <h3 className="font-bold text-slate-900 text-base leading-snug line-clamp-2">{p.name}</h3>

                    <div className="pt-2 flex items-baseline justify-between">
                      <span className="text-2xl font-black text-slate-900">${Number(p.price).toFixed(2)}</span>
                      <span className={`text-xs font-bold ${stock > 0 ? 'text-emerald-600' : 'text-rose-500'}`}>
                        {stock > 0 ? `Stock: ${stock}` : 'Agotado'}
                      </span>
                    </div>
                  </div>

                  <div className="p-4 bg-slate-50 border-t border-slate-100">
                    <button
                      onClick={() => addToCart(p)}
                      disabled={stock <= 0}
                      className="w-full bg-slate-900 hover:bg-sky-600 disabled:opacity-40 disabled:cursor-not-allowed text-white font-bold py-2.5 rounded-xl text-xs flex items-center justify-center space-x-1.5 transition-colors shadow-sm"
                    >
                      <ShoppingCart className="w-4 h-4" />
                      <span>{stock > 0 ? 'Añadir al Carrito' : 'Sin Stock'}</span>
                    </button>
                  </div>
                </div>
              );
            })}
          </div>
        )}
      </main>

      {/* Drawer Carrito de Compras */}
      {cartOpen && (
        <div className="fixed inset-0 z-50 overflow-hidden">
          <div className="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onClick={() => setCartOpen(false)} />

          <div className="absolute inset-y-0 right-0 max-w-full flex pl-10">
            <div className="w-screen max-w-md bg-white shadow-2xl flex flex-col">
              <div className="p-6 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                <div className="flex items-center space-x-2">
                  <ShoppingCart className="w-5 h-5 text-sky-600" />
                  <h3 className="font-bold text-base text-slate-900">Tu Carrito de Compra</h3>
                </div>
                <button onClick={() => setCartOpen(false)} className="text-slate-400 hover:text-slate-600 p-1">
                  <X className="w-5 h-5" />
                </button>
              </div>

              <div className="flex-1 overflow-y-auto p-6 space-y-4">
                {cart.length === 0 ? (
                  <div className="py-20 text-center text-slate-400">Tu carrito está vacío.</div>
                ) : (
                  cart.map((item) => (
                    <div key={item.product.id} className="flex items-center justify-between border-b border-slate-100 pb-3">
                      <div className="flex-1 pr-3">
                        <h4 className="font-bold text-sm text-slate-900 line-clamp-1">{item.product.name}</h4>
                        <p className="text-xs text-slate-400 font-mono">${item.unitPrice.toFixed(2)} c/u</p>
                      </div>

                      <div className="flex items-center space-x-2">
                        <button
                          onClick={() => updateQuantity(item.product.id, -1)}
                          className="w-7 h-7 rounded-full border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-100"
                        >
                          <Minus className="w-3.5 h-3.5" />
                        </button>
                        <span className="font-mono font-bold text-sm w-5 text-center">{item.quantity}</span>
                        <button
                          onClick={() => updateQuantity(item.product.id, 1)}
                          className="w-7 h-7 rounded-full border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-100"
                        >
                          <Plus className="w-3.5 h-3.5" />
                        </button>
                      </div>

                      <div className="w-16 text-right font-black text-sm text-slate-900 font-mono">
                        ${(item.quantity * item.unitPrice).toFixed(2)}
                      </div>
                    </div>
                  ))
                )}
              </div>

              {cart.length > 0 && (
                <div className="p-6 bg-slate-50 border-t border-slate-200 space-y-4">
                  <div className="flex items-center justify-between text-base font-black text-slate-900">
                    <span>Total a Pagar:</span>
                    <span className="text-2xl text-sky-600 font-mono">${total.toFixed(2)}</span>
                  </div>

                  <button
                    onClick={() => {
                      setOrderSuccess({ id: 'ORD-' + Date.now().toString().slice(-6), total });
                      setCart([]);
                      setCartOpen(false);
                    }}
                    className="w-full bg-sky-600 hover:bg-sky-700 text-white font-extrabold py-3.5 rounded-xl text-sm shadow-lg flex items-center justify-center space-x-2"
                  >
                    <span>Confirmar Pedido Online</span>
                    <ArrowRight className="w-4 h-4" />
                  </button>
                </div>
              )}
            </div>
          </div>
        </div>
      )}

      {/* Modal Confirmación de Pedido */}
      {orderSuccess && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-2xl max-w-sm w-full p-6 text-center space-y-4 shadow-2xl">
            <CheckCircle2 className="w-12 h-12 text-emerald-500 mx-auto" />
            <h3 className="font-extrabold text-xl text-slate-900">¡Pedido Recibido!</h3>
            <p className="text-xs text-slate-500 font-mono">Número de Orden: {orderSuccess.id}</p>
            <p className="text-xs text-slate-600">
              Tu pedido ha sido procesado exitosamente por un total de <strong>${orderSuccess.total.toFixed(2)}</strong>.
            </p>
            <button
              onClick={() => setOrderSuccess(null)}
              className="w-full bg-slate-900 text-white font-bold py-2.5 rounded-xl text-xs"
            >
              Aceptar y Continuar
            </button>
          </div>
        </div>
      )}
    </div>
  );
}
