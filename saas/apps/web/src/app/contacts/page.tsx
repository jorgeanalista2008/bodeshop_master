'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import {
  ArrowLeft,
  Users,
  Building,
  Plus,
  RefreshCw,
  Search,
  Mail,
  Phone,
  MapPin,
  Tag,
  DollarSign,
  Briefcase,
} from 'lucide-react';
import { apiFetch } from '../../lib/api';

export default function ContactsPage() {
  const [tenant, setTenant] = useState<any>(null);
  const [activeTab, setActiveTab] = useState<'customers' | 'suppliers'>('customers');
  const [customers, setCustomers] = useState<any[]>([]);
  const [suppliers, setSuppliers] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');

  // Modals
  const [showModal, setShowModal] = useState(false);
  const [name, setName] = useState('');
  const [taxId, setTaxId] = useState('');
  const [email, setEmail] = useState('');
  const [phone, setPhone] = useState('');
  const [address, setAddress] = useState('');
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
      const [custs, supps] = await Promise.all([
        apiFetch<any[]>('/contacts/customers', { token, tenantId }),
        apiFetch<any[]>('/contacts/suppliers', { token, tenantId }),
      ]);
      setCustomers(custs || []);
      setSuppliers(supps || []);
    } catch (err) {
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const handleCreateContact = async (e: React.FormEvent) => {
    e.preventDefault();
    setSaving(true);
    const token = localStorage.getItem('token') || undefined;
    const endpoint = activeTab === 'customers' ? '/contacts/customers' : '/contacts/suppliers';

    try {
      await apiFetch(endpoint, {
        method: 'POST',
        token,
        tenantId: tenant.id,
        body: JSON.stringify({
          name,
          taxId,
          email,
          phone,
          address,
        }),
      });

      setShowModal(false);
      setName('');
      setTaxId('');
      setEmail('');
      setPhone('');
      setAddress('');
      loadData(tenant.id);
    } catch (err: any) {
      alert(`Error al crear contacto: ${err.message}`);
    } finally {
      setSaving(false);
    }
  };

  const currentList = activeTab === 'customers' ? customers : suppliers;
  const filteredList = currentList.filter(
    (c) =>
      c.name?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      c.taxId?.toLowerCase().includes(searchTerm.toLowerCase()) ||
      c.email?.toLowerCase().includes(searchTerm.toLowerCase())
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
              <h1 className="font-bold text-sm text-[#1a2b3c]">Directorio de Clientes y Proveedores</h1>
              <span className="bg-[#edf2ff] text-[#4264fb] font-mono text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#bac8ff]">
                SMA 3.4
              </span>
            </div>
            <p className="text-[11px] text-[#6b7c93]">{tenant?.tradeName} — Gestión de contactos comerciales</p>
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
            <span>{activeTab === 'customers' ? 'Nuevo Cliente' : 'Nuevo Proveedor'}</span>
          </button>
        </div>
      </header>

      {/* Main Container */}
      <main className="max-w-7xl mx-auto px-8 py-6 space-y-5">
        {/* Tab Switcher & Search */}
        <div className="bg-white p-4 rounded-xl border border-[#e1e7ec] shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-4">
          <div className="flex items-center space-x-2 bg-[#f0f4f8] p-1 rounded-lg">
            <button
              onClick={() => setActiveTab('customers')}
              className={`flex items-center space-x-2 px-3 py-1.5 rounded-md text-xs font-bold transition-colors ${
                activeTab === 'customers' ? 'bg-white text-[#4264fb] shadow-2xs' : 'text-[#475569] hover:text-[#1a2b3c]'
              }`}
            >
              <Users className="w-3.5 h-3.5" />
              <span>Clientes ({customers.length})</span>
            </button>

            <button
              onClick={() => setActiveTab('suppliers')}
              className={`flex items-center space-x-2 px-3 py-1.5 rounded-md text-xs font-bold transition-colors ${
                activeTab === 'suppliers' ? 'bg-white text-[#4264fb] shadow-2xs' : 'text-[#475569] hover:text-[#1a2b3c]'
              }`}
            >
              <Building className="w-3.5 h-3.5" />
              <span>Proveedores ({suppliers.length})</span>
            </button>
          </div>

          <div className="relative w-full sm:w-80">
            <Search className="w-4 h-4 text-[#8a9ba8] absolute left-3 top-2.5" />
            <input
              type="text"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              placeholder={`Buscar en ${activeTab === 'customers' ? 'clientes' : 'proveedores'}...`}
              className="w-full pl-9 pr-3 py-1.5 text-xs bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
            />
          </div>
        </div>

        {/* Contacts Table */}
        <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-2xs overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs border-collapse">
              <thead>
                <tr className="bg-[#f7f9fb] border-b border-[#e1e7ec] text-[#6b7c93] font-bold uppercase tracking-wider text-[10px]">
                  <th className="py-3 px-4">Nombre / Empresa</th>
                  <th className="py-3 px-4">RIF / Tax ID</th>
                  <th className="py-3 px-4">Teléfono</th>
                  <th className="py-3 px-4">Correo Electrónico</th>
                  <th className="py-3 px-4">Dirección</th>
                  {activeTab === 'customers' && <th className="py-3 px-4">Grupo de Precios</th>}
                </tr>
              </thead>
              <tbody className="divide-y divide-[#edf1f4]">
                {loading ? (
                  <tr>
                    <td colSpan={6} className="py-12 text-center text-[#8a9ba8]">
                      <RefreshCw className="w-5 h-5 animate-spin mx-auto mb-2 text-[#4264fb]" />
                      Cargando contactos...
                    </td>
                  </tr>
                ) : filteredList.length === 0 ? (
                  <tr>
                    <td colSpan={6} className="py-12 text-center text-[#8a9ba8]">
                      No se encontraron contactos registrados en este módulo.
                    </td>
                  </tr>
                ) : (
                  filteredList.map((contact) => (
                    <tr key={contact.id} className="hover:bg-[#fbfcfd] transition-colors">
                      <td className="py-3 px-4 font-bold text-[#1a2b3c]">{contact.name}</td>
                      <td className="py-3 px-4 font-mono text-[#475569]">{contact.taxId || '—'}</td>
                      <td className="py-3 px-4 text-[#475569]">{contact.phone || '—'}</td>
                      <td className="py-3 px-4 text-[#475569]">{contact.email || '—'}</td>
                      <td className="py-3 px-4 text-[#6b7c93] max-w-xs truncate" title={contact.address || ''}>
                        {contact.address || '—'}
                      </td>
                      {activeTab === 'customers' && (
                        <td className="py-3 px-4">
                          <span className="bg-[#edf2ff] text-[#4264fb] px-2 py-0.5 rounded text-[11px] font-medium">
                            {contact.customerGroup?.name || 'Cliente Estándar'}
                          </span>
                        </td>
                      )}
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </main>

      {/* Modal: Crear Contacto */}
      {showModal && (
        <div className="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-xl border border-[#e1e7ec] shadow-xl max-w-md w-full p-6 space-y-4">
            <div className="flex items-center justify-between border-b border-[#edf1f4] pb-3">
              <h3 className="font-bold text-sm text-[#1a2b3c]">
                {activeTab === 'customers' ? 'Registrar Nuevo Cliente' : 'Registrar Nuevo Proveedor'}
              </h3>
              <button
                onClick={() => setShowModal(false)}
                className="text-[#8a9ba8] hover:text-[#1a2b3c] text-lg font-bold"
              >
                ×
              </button>
            </div>

            <form onSubmit={handleCreateContact} className="space-y-3.5 text-xs">
              <div>
                <label className="block font-bold text-[#475569] mb-1">Nombre o Razón Social *</label>
                <input
                  type="text"
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                  placeholder="Ej. Cristales del Centro C.A."
                  required
                  className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                />
              </div>

              <div>
                <label className="block font-bold text-[#475569] mb-1">RIF / Cédula / Tax ID</label>
                <input
                  type="text"
                  value={taxId}
                  onChange={(e) => setTaxId(e.target.value)}
                  placeholder="Ej. J-12345678-0"
                  className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="block font-bold text-[#475569] mb-1">Teléfono</label>
                  <input
                    type="text"
                    value={phone}
                    onChange={(e) => setPhone(e.target.value)}
                    placeholder="0414-0000000"
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  />
                </div>

                <div>
                  <label className="block font-bold text-[#475569] mb-1">Correo</label>
                  <input
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    placeholder="contacto@empresa.com"
                    className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                  />
                </div>
              </div>

              <div>
                <label className="block font-bold text-[#475569] mb-1">Dirección Física</label>
                <input
                  type="text"
                  value={address}
                  onChange={(e) => setAddress(e.target.value)}
                  placeholder="Calle, Ciudad, Estado..."
                  className="w-full p-2 bg-[#f7f9fb] border border-[#d2dce6] rounded-md focus:border-[#4264fb] focus:bg-white focus:outline-none"
                />
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
                  {saving ? 'Guardando...' : 'Guardar Contacto'}
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
