import type { Metadata } from 'next';
import './globals.css';

export const metadata: Metadata = {
  title: 'BodeShop Master SaaS - Plataforma B2B Multi-Tenant & Multi-Sucursal',
  description: 'Sistema Integral de Comercio, POS y Gestión Empresarial en la Nube',
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="es">
      <body className="antialiased min-h-screen bg-slate-50 text-slate-900">
        {children}
      </body>
    </html>
  );
}
