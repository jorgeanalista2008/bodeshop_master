'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  SlidersHorizontal,
  Plus,
  RefreshCw,
  Search,
  Building2,
  Calendar,
  User,
  ArrowUpRight,
  ArrowDownRight,
  FileText,
  Warehouse,
  CheckCircle2,
  XCircle,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function AdjustmentsPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [adjustments, setAdjustments] = useState<any[]>([]);
  const [products, setProducts] = useState<any[]>([]);
  const [warehouses, setWarehouses] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');

  // Modal Nuevo Ajuste
  const [showModal, setShowModal] = useState(false);
  const [selectedWarehouse, setSelectedWarehouse] = useState('');
  const [note, setNote] = useState('');
  const [items, setItems] = useState<Array<{ productId: string; quantity: number; type: 'addition' | 'subtraction' }>>([
    { productId: '', quantity: 1, type: 'subtraction' },
  ]);
  const [saving, setSaving] = useState(false);

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
      const [adjs, prods, branchData] = await Promise.all([
        apiFetch<any[]>('/adjustments', { token, tenantId }),
        apiFetch<any[]>('/products', { token, tenantId }),
        apiFetch<any[]>('/branches', { token, tenantId }),
      ]);

      setAdjustments(adjs || []);
      setProducts(prods || []);

      const whList: any[] = [];
      branchData?.forEach((b: any) => {
        if (b.warehouses) whList.push(...b.warehouses);
      });
      setWarehouses(whList);
      if (whList.length > 0) setSelectedWarehouse(whList[0].id);
    } catch (err) {
      console.error('Error cargando ajustes:', err);
    } finally {
      setLoading(false);
    }
  };

  const addItemRow = () => {
    setItems((prev) => [...prev, { productId: '', quantity: 1, type: 'subtraction' }]);
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

  const handleCreateAdjustment = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!selectedWarehouse) {
      alert('Seleccione un almacén.');
      return;
    }

    const validItems = items.filter((i) => i.productId && i.quantity > 0);
    if (validItems.length === 0) {
      alert('Debe seleccionar al menos un producto con cantidad válida.');
      return;
    }

    setSaving(true);
    const token = localStorage.getItem('token') || undefined;

    try {
      await apiFetch('/adjustments', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          warehouseId: selectedWarehouse,
          note,
          items: validItems,
        }),
      });

      setShowModal(false);
      setNote('');
      setItems([{ productId: '', quantity: 1, type: 'subtraction' }]);
      alert('¡Ajuste de inventario aplicado exitosamente al Kárdex!');
      loadData(tenant.id);
    } catch (err: any) {
      alert(`Error al registrar ajuste: ${err.message}`);
    } finally {
      setSaving(false);
    }
  };

  const filteredAdjustments = adjustments.filter(
    (a) =>
      a.referenceNo?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      a.note?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      a.warehouse?.name?.toLowerCase().includes(searchTerm.toLowerCase())
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
              <h1 className="font-bold text-sm text-[#1a2b3c]">Ajustes de Inventario y Mermas</h1>
              <span className="bg-[#edf2ff] text-[#4264fb] font-mono text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#bac8ff]">
                SMA 3.4
              </span>
            </div>
            <p className="text-[11px] text-[#6b7c93]">
              {tenant?.tradeName} — Control de mermas, sobrantes y conciliaciones de stock
            </p>
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
            <span>Nuevo Ajuste / Merma</span>
          </button>
        </div>
      </header>

      {/* Main Container */}
      <main className="max-w-7xl mx-auto px-8 py-6 space-y-5">
        {/* Search & Stats Bar */}
        <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-4">
          <div className="relative w-full sm:w-96">
            <Search className="w-4 h-4 text-[#8a9ba8] absolute left-3 top-2.5" />
            <input
              type="text"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              placeholder="Buscar por referencia, almacén o nota..."
              className="w-full pl-9 pr-3 py-1.5 text-xs bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none transition-colors"
            />
          </div>

          <div className="flex items-center space-x-6 text-xs text-[#6b7c93]">
            <div>
              <span className="text-[#8a9ba8]">Total Ajustes Registrados: </span>
              <strong className="text-[#1a2b3c] font-bold">{adjustments.length}</strong>
            </div>
            <div>
              <span className="text-[#8a9ba8]">Almacenes: </span>
              <strong className="text-[#1a2b3c] font-bold">{warehouses.length}</strong>
            </div>
          </div>
        </div>

        {/* Adjustments Table */}
        <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs border-collapse">
              <thead>
                <tr className="bg-[#f7f9fb] border-b border-[#e1e7ec] text-[#6b7c93] font-bold uppercase tracking-wider text-[10px]">
                  <th className="py-3 px-4">Fecha</th>
                  <th className="py-3 px-4">Referencia</th>
                  <th className="py-3 px-4">Almacén</th>
                  <th className="py-3 px-4">Usuario</th>
                  <th className="py-3 px-4">Ítems Ajustados</th>
                  <th className="py-3 px-4">Nota / Motivo</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-[#edf1f4]">
                {loading ? (
                  <tr>
                    <td colSpan={6} className="py-12 text-center text-[#8a9ba8]">
                      <RefreshCw className="w-5 h-5 animate-spin mx-auto mb-2 text-[#4264fb]" />
                      Cargando historial de ajustes...
                    </td>
                  </tr>
                ) : filteredAdjustments.length === 0 ? (
                  <tr>
                    <td colSpan={6} className="py-12 text-center text-[#8a9ba8]">
                      No se encontraron ajustes de inventario registrados.
                    </td>
                  </tr>
                ) : (
                  filteredAdjustments.map((adj) => (
                    <tr key={adj.id} className="hover:bg-[#fbfcfd] transition-colors">
                      <td className="py-3 px-4 text-[#475569] whitespace-nowrap">
                        {new Date(adj.createdAt).toLocaleString()}
                      </td>
                      <td className="py-3 px-4 font-mono font-bold text-[#1a2b3c]">
                        {adj.referenceNo}
                      </td>
                      <td className="py-3 px-4">
                        <span className="inline-flex items-center space-x-1 bg-[#edf2ff] text-[#4264fb] px-2 py-0.5 rounded text-[11px] font-medium">
                          <Warehouse className="w-3 h-3" />
                          <span>{adj.warehouse?.name || 'Almacén Central'}</span>
                        </span>
                      </td>
                      <td className="py-3 px-4 text-[#475569]">
                        {adj.user ? `${adj.user.firstName} ${adj.user.lastName}` : 'Sistema'}
                      </td>
                      <td className="py-3 px-4">
                        <span className="font-bold text-[#1a2b3c]">{adj.items?.length || 0} productos</span>
                      </td>
                      <td className="py-3 px-4 text-[#6b7c93] max-w-xs truncate" title={adj.note || ''}>
                        {adj.note ? adj.note.replace(/<[^>]*>?/gm, '') : '—'}
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </main>

      {/* Modal: Crear Ajuste */}
      {showModal && (
        <div className="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-xl max-w-2xl w-full p-6 space-y-4">
            <div className="flex items-center justify-between border-b border-[#edf1f4] pb-3">
              <div className="flex items-center space-x-2">
                <SlidersHorizontal className="w-4 h-4 text-[#4264fb]" />
                <h3 className="font-bold text-sm text-[#1a2b3c]">Registrar Nuevo Ajuste de Inventario</h3>
              </div>
              <button
                onClick={() => setShowModal(false)}
                className="text-[#8a9ba8] hover:text-[#1a2b3c] text-lg font-bold"
              >
                ×
              </button>
            </div>

            <form onSubmit={handleCreateAdjustment} className="space-y-4 text-xs">
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className="block font-bold text-[#475569] mb-1">Almacén Destino *</label>
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

                <div>
                  <label className="block font-bold text-[#475569] mb-1">Motivo / Nota General</label>
                  <input
                    type="text"
                    value={note}
                    onChange={(e) => setNote(e.target.value)}
                    placeholder="Ej. Merma por daño en exhibición, Sobrante de conteo..."
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  />
                </div>
              </div>

              {/* Renglones de Productos */}
              <div className="space-y-2 pt-2 border-t border-[#edf1f4]">
                <div className="flex items-center justify-between">
                  <label className="font-bold text-[#475569]">Productos a Ajustar</label>
                  <button
                    type="button"
                    onClick={addItemRow}
                    className="text-[#4264fb] hover:underline text-[11px] font-bold flex items-center space-x-1"
                  >
                    <Plus className="w-3 h-3" />
                    <span>Agregar otro producto</span>
                  </button>
                </div>

                <div className="space-y-2 max-h-60 overflow-y-auto pr-1">
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

                      <div className="col-span-3">
                        <select
                          value={row.type}
                          onChange={(e) => updateItem(index, 'type', e.target.value)}
                          className="w-full p-1.5 bg-white border border-[#d2dce6] rounded text-[11px]"
                        >
                          <option value="subtraction">➖ Restar (Merma)</option>
                          <option value="addition">➕ Sumar (Sobrante)</option>
                        </select>
                      </div>

                      <div className="col-span-2">
                        <input
                          type="number"
                          min="1"
                          value={row.quantity}
                          onChange={(e) => updateItem(index, 'quantity', Number(e.target.value))}
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
                  {saving ? 'Aplicando ajuste...' : 'Confirmar y Actualizar Stock'}
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
