'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  ArrowLeftRight,
  Plus,
  RefreshCw,
  Search,
  Warehouse,
  CheckCircle,
  Clock,
  Send,
  FileText,
  AlertTriangle,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function TransfersPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [transfers, setTransfers] = useState<any[]>([]);
  const [products, setProducts] = useState<any[]>([]);
  const [warehouses, setWarehouses] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');

  // Modal Nuevo Traslado
  const [showModal, setShowModal] = useState(false);
  const [fromWarehouse, setFromWarehouse] = useState('');
  const [toWarehouse, setToWarehouse] = useState('');
  const [note, setNote] = useState('');
  const [items, setItems] = useState<Array<{ productId: string; quantity: number }>>([
    { productId: '', quantity: 1 },
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
      const [transList, prods, branchData] = await Promise.all([
        apiFetch<any[]>('/transfers', { token, tenantId }),
        apiFetch<any[]>('/products', { token, tenantId }),
        apiFetch<any[]>('/branches', { token, tenantId }),
      ]);

      setTransfers(transList || []);
      setProducts(prods || []);

      const whList: any[] = [];
      branchData?.forEach((b: any) => {
        if (b.warehouses) whList.push(...b.warehouses);
      });
      setWarehouses(whList);

      if (whList.length >= 2) {
        setFromWarehouse(whList[0].id);
        setToWarehouse(whList[1].id);
      }
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const addItemRow = () => {
    setItems((prev) => [...prev, { productId: '', quantity: 1 }]);
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

  const handleCreateTransfer = async (e: React.FormEvent) => {
    e.preventDefault();
    if (fromWarehouse === toWarehouse) {
      alert('El almacén de origen y destino deben ser diferentes.');
      return;
    }

    const validItems = items.filter((i) => i.productId && i.quantity > 0);
    if (validItems.length === 0) {
      alert('Debe agregar al menos un producto a transferir.');
      return;
    }

    setSaving(true);
    const token = localStorage.getItem('token') || undefined;

    try {
      await apiFetch('/transfers', {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          fromWarehouseId: fromWarehouse,
          toWarehouseId: toWarehouse,
          items: validItems,
          note,
        }),
      });

      setShowModal(false);
      setNote('');
      setItems([{ productId: '', quantity: 1 }]);
      alert('¡Traslado inter-almacén registrado exitosamente!');
      loadData(tenant.id);
    } catch (err: any) {
      alert(`Error al registrar traslado: ${err.message}`);
    } finally {
      setSaving(false);
    }
  };

  const handleCompleteTransfer = async (transferId: string) => {
    const token = localStorage.getItem('token') || undefined;
    try {
      await apiFetch(`/transfers/${transferId}/complete`, {
        method: 'POST',
        token,
        tenantId: tenant.id,
      });
      alert('¡Traslado completado! La mercancía ha sido acreditada en el almacén de destino.');
      loadData(tenant.id);
    } catch (err: any) {
      alert(`Error: ${err.message}`);
    }
  };

  const filteredTransfers = transfers.filter(
    (t) =>
      t.referenceNumber?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      t.fromWarehouse?.name?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      t.toWarehouse?.name?.toLowerCase().includes(searchTerm.toLowerCase())
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
              <h1 className="font-bold text-sm text-[#1a2b3c]">Traslados entre Almacenes</h1>
              <span className="bg-[#edf2ff] text-[#4264fb] font-mono text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#bac8ff]">
                SMA 3.4
              </span>
            </div>
            <p className="text-[11px] text-[#6b7c93]">
              {tenant?.tradeName} — Logística inter-sucursal y tránsito de mercancía
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
            <span>Nuevo Traslado</span>
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
              placeholder="Buscar por referencia o almacenes..."
              className="w-full pl-9 pr-3 py-1.5 text-xs bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
            />
          </div>

          <div className="text-xs text-[#6b7c93]">
            <span>Total Traslados: </span>
            <strong className="text-[#1a2b3c] font-bold">{transfers.length}</strong>
          </div>
        </div>

        {/* Transfers Table */}
        <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs border-collapse">
              <thead>
                <tr className="bg-[#f7f9fb] border-b border-[#e1e7ec] text-[#6b7c93] font-bold uppercase tracking-wider text-[10px]">
                  <th className="py-3 px-4">Fecha</th>
                  <th className="py-3 px-4">Referencia</th>
                  <th className="py-3 px-4">Almacén Origen</th>
                  <th className="py-3 px-4">Almacén Destino</th>
                  <th className="py-3 px-4">Estado</th>
                  <th className="py-3 px-4">Ítems</th>
                  <th className="py-3 px-4 text-center">Acción</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-[#edf1f4]">
                {loading ? (
                  <tr>
                    <td colSpan={7} className="py-12 text-center text-[#8a9ba8]">
                      <RefreshCw className="w-5 h-5 animate-spin mx-auto mb-2 text-[#4264fb]" />
                      Cargando traslados...
                    </td>
                  </tr>
                ) : filteredTransfers.length === 0 ? (
                  <tr>
                    <td colSpan={7} className="py-12 text-center text-[#8a9ba8]">
                      No se encontraron traslados registrados.
                    </td>
                  </tr>
                ) : (
                  filteredTransfers.map((t) => (
                    <tr key={t.id} className="hover:bg-[#fbfcfd] transition-colors">
                      <td className="py-3 px-4 text-[#475569]">{new Date(t.createdAt).toLocaleDateString()}</td>
                      <td className="py-3 px-4 font-mono font-bold text-[#1a2b3c]">{t.referenceNumber}</td>
                      <td className="py-3 px-4 text-[#1a2b3c]">
                        <span className="font-semibold">{t.fromWarehouse?.name || 'Origen'}</span>
                      </td>
                      <td className="py-3 px-4 text-[#1a2b3c]">
                        <span className="font-semibold">{t.toWarehouse?.name || 'Destino'}</span>
                      </td>
                      <td className="py-3 px-4">
                        <span
                          className={`inline-flex items-center space-x-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase border ${
                            t.status === 'COMPLETED'
                              ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                              : 'bg-amber-50 text-amber-700 border-amber-200'
                          }`}
                        >
                          {t.status === 'COMPLETED' ? (
                            <CheckCircle className="w-3 h-3" />
                          ) : (
                            <Clock className="w-3 h-3" />
                          )}
                          <span>{t.status}</span>
                        </span>
                      </td>
                      <td className="py-3 px-4 text-[#475569]">{t.items?.length || 0} productos</td>
                      <td className="py-3 px-4 text-center">
                        {t.status !== 'COMPLETED' && (
                          <button
                            onClick={() => handleCompleteTransfer(t.id)}
                            className="px-2.5 py-1 text-[11px] font-bold bg-[#4264fb] hover:bg-[#314ccd] text-white rounded transition-colors"
                          >
                            Recibir Mercancía
                          </button>
                        )}
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </main>

      {/* Modal: Nuevo Traslado */}
      {showModal && (
        <div className="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-xl max-w-xl w-full p-6 space-y-4">
            <div className="flex items-center justify-between border-b border-[#edf1f4] pb-3">
              <div className="flex items-center space-x-2">
                <ArrowLeftRight className="w-4 h-4 text-[#4264fb]" />
                <h3 className="font-bold text-sm text-[#1a2b3c]">Nuevo Traslado de Mercancía</h3>
              </div>
              <button
                onClick={() => setShowModal(false)}
                className="text-[#8a9ba8] hover:text-[#1a2b3c] text-lg font-bold"
              >
                ×
              </button>
            </div>

            <form onSubmit={handleCreateTransfer} className="space-y-4 text-xs">
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block font-bold text-[#475569] mb-1">Almacén Origen (Sale)</label>
                  <select
                    value={fromWarehouse}
                    onChange={(e) => setFromWarehouse(e.target.value)}
                    required
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  >
                    {warehouses.map((w) => (
                      <option key={w.id} value={w.id}>
                        {w.name}
                      </option>
                    ))}
                  </select>
                </div>

                <div>
                  <label className="block font-bold text-[#475569] mb-1">Almacén Destino (Entra)</label>
                  <select
                    value={toWarehouse}
                    onChange={(e) => setToWarehouse(e.target.value)}
                    required
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  >
                    {warehouses.map((w) => (
                      <option key={w.id} value={w.id}>
                        {w.name}
                      </option>
                    ))}
                  </select>
                </div>
              </div>

              <div>
                <label className="block font-bold text-[#475569] mb-1">Nota / Observación</label>
                <input
                  type="text"
                  value={note}
                  onChange={(e) => setNote(e.target.value)}
                  placeholder="Motivo del traslado..."
                  className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                />
              </div>

              {/* Renglones de Productos */}
              <div className="space-y-2 pt-2 border-t border-[#edf1f4]">
                <div className="flex items-center justify-between">
                  <label className="font-bold text-[#475569]">Productos a Trasladar</label>
                  <button
                    type="button"
                    onClick={addItemRow}
                    className="text-[#4264fb] hover:underline text-[11px] font-bold flex items-center space-x-1"
                  >
                    <Plus className="w-3 h-3" />
                    <span>Agregar otro ítem</span>
                  </button>
                </div>

                <div className="space-y-2 max-h-48 overflow-y-auto pr-1">
                  {items.map((row, index) => (
                    <div
                      key={index}
                      className="grid grid-cols-12 gap-2 items-center bg-[#f7f9fb] p-2 rounded-lg border border-[#e1e7ec]"
                    >
                      <div className="col-span-8">
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
                        <input
                          type="number"
                          min="1"
                          placeholder="Cantidad"
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
                  {saving ? 'Registrando...' : 'Emitir Traslado'}
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
