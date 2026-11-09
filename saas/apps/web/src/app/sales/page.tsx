'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  Receipt,
  Plus,
  RefreshCw,
  Search,
  CheckCircle,
  Clock,
  User,
  CreditCard,
  FileText,
  DollarSign,
  Printer,
  ChevronRight,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function SalesPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [sales, setSales] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedSale, setSelectedSale] = useState<any>(null);

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
      const salesList = await apiFetch<any[]>('/sales', { token, tenantId });
      setSales(salesList || []);
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const filteredSales = sales.filter(
    (s) =>
      s.invoiceNumber?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      s.customer?.name?.toLowerCase().includes(searchTerm.toLowerCase())
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
              <h1 className="font-bold text-sm text-[#1a2b3c]">Historial de Ventas y Facturación</h1>
              <span className="bg-[#edf2ff] text-[#4264fb] font-mono text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#bac8ff]">
                SMA 3.4
              </span>
            </div>
            <p className="text-[11px] text-[#6b7c93]">{tenant?.tradeName} — Facturas emitidas, pagos y comprobantes</p>
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

          <Link
            href="/pos"
            className="bg-[#4264fb] hover:bg-[#314ccd] text-white px-3.5 py-2 rounded-lg text-xs font-bold flex items-center space-x-1.5 transition-colors shadow-xs"
          >
            <Receipt className="w-3.5 h-3.5" />
            <span>Abrir Terminal POS</span>
          </Link>
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
              placeholder="Buscar por número de factura o cliente..."
              className="w-full pl-9 pr-3 py-1.5 text-xs bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
            />
          </div>

          <div className="text-xs text-[#6b7c93]">
            <span>Total Ventas Emitidas: </span>
            <strong className="text-[#1a2b3c] font-bold">{sales.length}</strong>
          </div>
        </div>

        {/* Sales Table */}
        <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs border-collapse">
              <thead>
                <tr className="bg-[#f7f9fb] border-b border-[#e1e7ec] text-[#6b7c93] font-bold uppercase tracking-wider text-[10px]">
                  <th className="py-3 px-4">Fecha</th>
                  <th className="py-3 px-4">Factura #</th>
                  <th className="py-3 px-4">Cliente</th>
                  <th className="py-3 px-4">Cajero / Vendedor</th>
                  <th className="py-3 px-4">Forma de Pago</th>
                  <th className="py-3 px-4 text-right">Total Factura</th>
                  <th className="py-3 px-4 text-center">Acciones</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-[#edf1f4]">
                {loading ? (
                  <tr>
                    <td colSpan={7} className="py-12 text-center text-[#8a9ba8]">
                      <RefreshCw className="w-5 h-5 animate-spin mx-auto mb-2 text-[#4264fb]" />
                      Cargando historial de facturas...
                    </td>
                  </tr>
                ) : filteredSales.length === 0 ? (
                  <tr>
                    <td colSpan={7} className="py-12 text-center text-[#8a9ba8]">
                      No se encontraron ventas registradas en esta sucursal.
                    </td>
                  </tr>
                ) : (
                  filteredSales.map((s) => (
                    <tr key={s.id} className="hover:bg-[#fbfcfd] transition-colors">
                      <td className="py-3 px-4 text-[#475569]">{new Date(s.createdAt).toLocaleString()}</td>
                      <td className="py-3 px-4 font-mono font-bold text-[#1a2b3c]">{s.invoiceNumber}</td>
                      <td className="py-3 px-4 text-[#1a2b3c] font-medium">{s.customer?.name || 'Cliente General'}</td>
                      <td className="py-3 px-4 text-[#475569]">
                        {s.user ? `${s.user.firstName} ${s.user.lastName}` : 'Cajero'}
                      </td>
                      <td className="py-3 px-4">
                        <span className="bg-[#edf2ff] text-[#4264fb] font-mono px-2 py-0.5 rounded text-[11px] font-bold uppercase">
                          {s.payments?.[0]?.method || 'CASH'}
                        </span>
                      </td>
                      <td className="py-3 px-4 text-right font-mono font-extrabold text-[#1a2b3c]">
                        ${Number(s.grandTotal).toFixed(2)}
                      </td>
                      <td className="py-3 px-4 text-center">
                        <button
                          onClick={() => setSelectedSale(s)}
                          className="px-2.5 py-1 text-[11px] font-bold border border-[#d2dce6] rounded-md text-[#475569] hover:bg-[#edf2ff] hover:text-[#4264fb] hover:border-[#bac8ff] transition-colors"
                        >
                          Ver Factura
                        </button>
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </main>

      {/* Modal: Detalle de Factura Imprimible */}
      {selectedSale && (
        <div className="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-xl max-w-lg w-full p-6 space-y-4">
            <div className="flex items-center justify-between border-b border-[#edf1f4] pb-3">
              <div className="flex items-center space-x-2">
                <FileText className="w-4 h-4 text-[#4264fb]" />
                <h3 className="font-bold text-sm text-[#1a2b3c]">Factura {selectedSale.invoiceNumber}</h3>
              </div>
              <button
                onClick={() => setSelectedSale(null)}
                className="text-[#8a9ba8] hover:text-[#1a2b3c] text-lg font-bold"
              >
                ×
              </button>
            </div>

            {/* Recibo Ticket Estilo Térmico 80mm */}
            <div className="bg-[#fcfdfd] p-4 rounded-lg border border-[#e1e7ec] font-mono text-[11px] space-y-3">
              <div className="text-center border-b border-dashed border-[#d2dce6] pb-2 space-y-0.5">
                <h4 className="font-bold text-xs uppercase">{tenant?.tradeName}</h4>
                <p className="text-[10px] text-[#6b7c93]">RIF: {tenant?.taxId}</p>
                <p className="text-[10px] text-[#6b7c93]">{new Date(selectedSale.createdAt).toLocaleString()}</p>
              </div>

              <div className="space-y-0.5 text-[#475569]">
                <p>
                  <strong>Factura:</strong> {selectedSale.invoiceNumber}
                </p>
                <p>
                  <strong>Cliente:</strong> {selectedSale.customer?.name}
                </p>
                <p>
                  <strong>RIF/CI:</strong> {selectedSale.customer?.taxId || 'V-00000000'}
                </p>
              </div>

              <div className="border-t border-b border-dashed border-[#d2dce6] py-2 space-y-1">
                <div className="flex justify-between font-bold text-[#1a2b3c]">
                  <span>Ítem / Cant.</span>
                  <span>Total</span>
                </div>
                {selectedSale.items?.map((item: any, idx: number) => (
                  <div key={idx} className="flex justify-between text-[#475569]">
                    <span>
                      {item.product?.name} x{Number(item.quantity)}
                    </span>
                    <span>${Number(item.subtotal).toFixed(2)}</span>
                  </div>
                ))}
              </div>

              <div className="space-y-1 text-right">
                <div className="flex justify-between font-extrabold text-sm text-[#1a2b3c] pt-1">
                  <span>TOTAL A PAGAR:</span>
                  <span>${Number(selectedSale.grandTotal).toFixed(2)}</span>
                </div>
                <p className="text-[10px] text-[#6b7c93]">
                  Pagado con: {selectedSale.payments?.[0]?.method || 'CASH'} (${Number(selectedSale.paidAmount).toFixed(2)})
                </p>
              </div>
            </div>

            <div className="flex justify-end space-x-2 pt-2">
              <button
                onClick={() => window.print()}
                className="px-3.5 py-1.5 bg-[#1a2b3c] text-white font-bold rounded-md text-xs flex items-center space-x-1.5 hover:bg-black transition-colors"
              >
                <Printer className="w-3.5 h-3.5" />
                <span>Imprimir Recibo</span>
              </button>
              <button
                onClick={() => setSelectedSale(null)}
                className="px-3.5 py-1.5 border border-[#d2dce6] rounded-md text-xs text-[#475569] hover:bg-[#f7f9fb]"
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
