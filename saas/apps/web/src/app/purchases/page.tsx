'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  ShoppingBag,
  Plus,
  RefreshCw,
  Search,
  Building,
  Calendar,
  CheckCircle,
  FileText,
  DollarSign,
  Package,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function PurchasesPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [branch, setBranch] = useState<any>(null);
  const [purchases, setPurchases] = useState<any[]>([]);
  const [suppliers, setSuppliers] = useState<any[]>([]);
  const [products, setProducts] = useState<any[]>([]);
  const [warehouses, setWarehouses] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');

  // Modal Nueva Compra
  const [showModal, setShowModal] = useState(false);
  const [selectedSupplier, setSelectedSupplier] = useState('');
  const [selectedWarehouse, setSelectedWarehouse] = useState('');
  const [note, setNote] = useState('');
  const [items, setItems] = useState<Array<{ productId: string; quantity: number; unitCost: number }>>([
    { productId: '', quantity: 1, unitCost: 10 },
  ]);
  const [saving, setSaving] = useState(false);

  useEffect(() => {
    const rawTenant = localStorage.getItem('tenant');
    const rawBranch = localStorage.getItem('branch');
    if (!rawTenant) {
      window.location.href = '/';
      return;
    }
    const t = JSON.parse(rawTenant);
    setTenant(t);
    if (rawBranch) setBranch(JSON.parse(rawBranch));
    loadData(t.id);
  }, []);

  const loadData = async (tenantId: string) => {
    setLoading(true);
    const token = localStorage.getItem('token') || undefined;

    try {
      const [purchList, supps, prods, branchData] = await Promise.all([
        apiFetch<any[]>('/purchases', { token, tenantId }),
        apiFetch<any[]>('/contacts/suppliers', { token, tenantId }),
        apiFetch<any[]>('/products', { token, tenantId }),
        apiFetch<any[]>('/branches', { token, tenantId }),
      ]);

      setPurchases(purchList || []);
      setSuppliers(supps || []);
      setProducts(prods || []);

      const whList: any[] = [];
      branchData?.forEach((b: any) => {
        if (b.warehouses) whList.push(...b.warehouses);
      });
      setWarehouses(whList);
      if (whList.length > 0) setSelectedWarehouse(whList[0].id);
      if (supps && supps.length > 0) setSelectedSupplier(supps[0].id);
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const addItemRow = () => {
    setItems((prev) => [...prev, { productId: '', quantity: 1, unitCost: 10 }]);
  };

  const removeItemRow = (index: number) => {
    setItems((prev) => prev.filter((_, i) => i !== index));
  };

  const updateItem = (index: number, field: string, value: any) => {
    setItems((prev) => {
      const copy = [...prev];
      copy[index] = { ...copy[index], [field]: value };
      return copy;
    });
  };

  const calculateTotal = () => {
    return items.reduce((acc, curr) => acc + (Number(curr.quantity) || 0) * (Number(curr.unitCost) || 0), 0);
  };

  const handleCreatePurchase = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!selectedSupplier || !selectedWarehouse) {
      alert('Seleccione un proveedor y un almacén.');
      return;
    }

    const validItems = items.filter((i) => i.productId && i.quantity > 0);
    if (validItems.length === 0) {
      alert('Debe agregar al menos un producto válido.');
      return;
    }

    setSaving(true);
    const token = localStorage.getItem('token') || undefined;
    const branchId = branch?.id || warehouses[0]?.branchId;

    try {
      await apiFetch('/purchases', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          branchId,
          supplierId: selectedSupplier,
          warehouseId: selectedWarehouse,
          items: validItems,
          note,
        }),
      });

      setShowModal(false);
      setNote('');
      setItems([{ productId: '', quantity: 1, unitCost: 10 }]);
      alert('¡Compra registrada exitosamente! El costo unitario y el stock han sido actualizados en Kárdex.');
      loadData(tenant.id);
    } catch (err: any) {
      alert(`Error al registrar compra: ${err.message}`);
    } finally {
      setSaving(false);
    }
  };

  const filteredPurchases = purchases.filter(
    (p) =>
      p.referenceNumber?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      p.supplier?.name?.toLowerCase().includes(searchTerm.toLowerCase())
  );

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
              <h1 className="font-bold text-sm text-[#1a2b3c]">Órdenes de Compra a Proveedores</h1>
              <span className="bg-[#edf2ff] text-[#4264fb] font-mono text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#bac8ff]">
                SMA 3.4
              </span>
            </div>
            <p className="text-[11px] text-[#6b7c93]">{tenant?.tradeName} — Entrada de mercancía y costeo promedio</p>
          </div>
        </div>

        <div className="flex items-center space-x-3">
          <button
            onClick={() => loadData(tenant?.id)}
            className="p-2 rounded-lg border border-[#d2dce6] bg-white hover:bg-[#f7f9fb] text-[#475569] text-xs flex items-center space-x-1.5 transition-colors"
          >
            <RefreshCw className="w-3.5 h-3.5" />
            <span>Refrescar</span>
          </button>

          <button
            onClick={() => setShowModal(true)}
            className="bg-[#4264fb] hover:bg-[#314ccd] text-white px-3.5 py-2 rounded-lg text-xs font-bold flex items-center space-x-1.5 transition-colors shadow-xs"
          >
            <Plus className="w-3.5 h-3.5" />
            <span>Registrar Compra</span>
          </button>
        </div>
      </header>

      {/* Main Container */}
      <main className="max-w-7xl mx-auto px-8 py-6 space-y-5">
        {/* Search Bar */}
        <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-4">
          <div className="relative w-full sm:w-96">
            <Search className="w-4 h-4 text-[#8a9ba8] absolute left-3 top-2.5" />
            <input
              type="text"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              placeholder="Buscar por referencia o proveedor..."
              className="w-full pl-9 pr-3 py-1.5 text-xs bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
            />
          </div>

          <div className="text-xs text-[#6b7c93]">
            <span>Total Compras Realizadas: </span>
            <strong className="text-[#1a2b3c] font-bold">{purchases.length}</strong>
          </div>
        </div>

        {/* Purchases Table */}
        <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs border-collapse">
              <thead>
                <tr className="bg-[#f7f9fb] border-b border-[#e1e7ec] text-[#6b7c93] font-bold uppercase tracking-wider text-[10px]">
                  <th className="py-3 px-4">Fecha</th>
                  <th className="py-3 px-4">Referencia</th>
                  <th className="py-3 px-4">Proveedor</th>
                  <th className="py-3 px-4">Estado</th>
                  <th className="py-3 px-4">Ítems</th>
                  <th className="py-3 px-4 text-right">Monto Total</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-[#edf1f4]">
                {loading ? (
                  <tr>
                    <td colSpan={6} className="py-12 text-center text-[#8a9ba8]">
                      <RefreshCw className="w-5 h-5 animate-spin mx-auto mb-2 text-[#4264fb]" />
                      Cargando historial de compras...
                    </td>
                  </tr>
                ) : filteredPurchases.length === 0 ? (
                  <tr>
                    <td colSpan={6} className="py-12 text-center text-[#8a9ba8]">
                      No se encontraron compras a proveedores registradas.
                    </td>
                  </tr>
                ) : (
                  filteredPurchases.map((p) => (
                    <tr key={p.id} className="hover:bg-[#fbfcfd] transition-colors">
                      <td className="py-3 px-4 text-[#475569]">{new Date(p.createdAt).toLocaleDateString()}</td>
                      <td className="py-3 px-4 font-mono font-bold text-[#1a2b3c]">{p.referenceNumber}</td>
                      <td className="py-3 px-4 text-[#1a2b3c] font-medium">{p.supplier?.name || 'Proveedor General'}</td>
                      <td className="py-3 px-4">
                        <span className="inline-flex items-center space-x-1 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded text-[10px] font-bold uppercase">
                          <CheckCircle className="w-3 h-3" />
                          <span>{p.status || 'Received'}</span>
                        </span>
                      </td>
                      <td className="py-3 px-4 text-[#475569]">{p.items?.length || 0} productos</td>
                      <td className="py-3 px-4 text-right font-mono font-bold text-[#1a2b3c]">
                        ${Number(p.grandTotal).toFixed(2)}
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </main>

      {/* Modal: Registrar Compra */}
      {showModal && (
        <div className="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-xl max-w-2xl w-full p-6 space-y-4">
            <div className="flex items-center justify-between border-b border-[#edf1f4] pb-3">
              <div className="flex items-center space-x-2">
                <ShoppingBag className="w-4 h-4 text-[#4264fb]" />
                <h3 className="font-bold text-sm text-[#1a2b3c]">Registrar Nueva Compra a Proveedor</h3>
              </div>
              <button
                onClick={() => setShowModal(false)}
                className="text-[#8a9ba8] hover:text-[#1a2b3c] text-lg font-bold"
              >
                ×
              </button>
            </div>

            <form onSubmit={handleCreatePurchase} className="space-y-4 text-xs">
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className="block font-bold text-[#475569] mb-1">Proveedor *</label>
                  <select
                    value={selectedSupplier}
                    onChange={(e) => setSelectedSupplier(e.target.value)}
                    required
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  >
                    {suppliers.map((s) => (
                      <option key={s.id} value={s.id}>
                        {s.name} ({s.taxId})
                      </option>
                    ))}
                  </select>
                </div>

                <div>
                  <label className="block font-bold text-[#475569] mb-1">Almacén Receptor *</label>
                  <select
                    value={selectedWarehouse}
                    onChange={(e) => setSelectedWarehouse(e.target.value)}
                    required
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  >
                    {warehouses.map((w) => (
                      <option key={w.id} value={w.id}>
                        {w.name} ({w.code})
                      </option>
                    ))}
                  </select>
                </div>
              </div>

              {/* Renglones de Ítems Comprados */}
              <div className="space-y-2 pt-2 border-t border-[#edf1f4]">
                <div className="flex items-center justify-between">
                  <label className="font-bold text-[#475569]">Productos Recibidos</label>
                  <button
                    type="button"
                    onClick={addItemRow}
                    className="text-[#4264fb] hover:underline text-[11px] font-bold flex items-center space-x-1"
                  >
                    <Plus className="w-3 h-3" />
                    <span>Agregar otro ítem</span>
                  </button>
                </div>

                <div className="space-y-2 max-h-56 overflow-y-auto pr-1">
                  {items.map((row, index) => (
                    <div
                      key={index}
                      className="grid grid-cols-12 gap-2 items-center bg-[#f7f9fb] p-2.5 rounded-lg border border-[#e1e7ec]"
                    >
                      <div className="col-span-6">
                        <select
                          value={row.productId}
                          onChange={(e) => updateItem(index, 'productId', e.target.value)}
                          required
                          className="w-full p-1.5 bg-white border border-[#d2dce6] rounded text-[11px]"
                        >
                          <option value="">Seleccione producto...</option>
                          {products.map((p) => (
                            <option key={p.id} value={p.id}>
                              {p.code} - {p.name}
                            </option>
                          ))}
                        </select>
                      </div>

                      <div className="col-span-2">
                        <input
                          type="number"
                          min="1"
                          placeholder="Cant."
                          value={row.quantity}
                          onChange={(e) => updateItem(index, 'quantity', Number(e.target.value))}
                          required
                          className="w-full p-1.5 bg-white border border-[#d2dce6] rounded text-[11px]"
                        />
                      </div>

                      <div className="col-span-3">
                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          placeholder="Costo Unit."
                          value={row.unitCost}
                          onChange={(e) => updateItem(index, 'unitCost', Number(e.target.value))}
                          required
                          className="w-full p-1.5 bg-white border border-[#d2dce6] rounded text-[11px]"
                        />
                      </div>

                      <div className="col-span-1 text-center">
                        {items.length > 1 && (
                          <button
                            type="button"
                            onClick={() => removeItemRow(index)}
                            className="text-rose-500 hover:text-rose-700 font-bold"
                          >
                            ×
                          </button>
                        )}
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {/* Total y Notas */}
              <div className="pt-2 border-t border-[#edf1f4] flex items-center justify-between">
                <span className="text-xs text-[#6b7c93]">Total Compra Calculado:</span>
                <span className="text-base font-extrabold font-mono text-[#1a2b3c]">
                  ${calculateTotal().toFixed(2)}
                </span>
              </div>

              {/* Botones de acción */}
              <div className="flex justify-end space-x-2 pt-3 border-t border-[#edf1f4]">
                <button
                  type="button"
                  onClick={() => setShowModal(false)}
                  className="px-4 py-2 border border-[#d2dce6] rounded-md text-[#475569] hover:bg-[#f7f9fb]"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  disabled={saving}
                  className="px-4 py-2 bg-[#4264fb] hover:bg-[#314ccd] text-white font-bold rounded-md"
                >
                  {saving ? 'Registrando...' : 'Recibir Compra y Aumentar Stock'}
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
