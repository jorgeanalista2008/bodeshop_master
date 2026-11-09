import { Injectable } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

@Injectable()
export class ReportsService {
  constructor(private readonly prisma: PrismaService) {}

  async getOverview(tenantId: string, branchId?: string) {
    const now = new Date();
    const startOfToday = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);

    const branchFilter = branchId ? { branchId } : {};

    // Ventas de hoy
    const salesToday = await this.prisma.sale.aggregate({
      where: {
        tenantId,
        ...branchFilter,
        createdAt: { gte: startOfToday },
      },
      _sum: { grandTotal: true },
      _count: { id: true },
    });

    // Ventas del mes
    const salesMonth = await this.prisma.sale.aggregate({
      where: {
        tenantId,
        ...branchFilter,
        createdAt: { gte: startOfMonth },
      },
      _sum: { grandTotal: true },
      _count: { id: true },
    });

    // Gastos del mes
    const expensesMonth = await this.prisma.expense.aggregate({
      where: {
        tenantId,
        ...branchFilter,
        date: { gte: startOfMonth },
      },
      _sum: { amount: true },
    });

    // Últimas ventas
    const recentSales = await this.prisma.sale.findMany({
      where: { tenantId, ...branchFilter },
      include: { customer: true },
      orderBy: { createdAt: 'desc' },
      take: 5,
    });

    // Productos con stock bajo
    const products = await this.prisma.product.findMany({
      where: { tenantId, isActive: true },
      include: { warehouseStocks: true },
    });

    let lowStockCount = 0;
    let totalStockValue = 0;

    for (const p of products) {
      const totalQty = p.warehouseStocks.reduce((sum, s) => sum + Number(s.quantity), 0);
      totalStockValue += totalQty * Number(p.cost);
      if (totalQty <= Number(p.alertQuantity)) {
        lowStockCount++;
      }
    }

    return {
      today: {
        count: salesToday._count.id || 0,
        amount: Number(salesToday._sum.grandTotal || 0),
      },
      month: {
        count: salesMonth._count.id || 0,
        amount: Number(salesMonth._sum.grandTotal || 0),
        expenses: Number(expensesMonth._sum.amount || 0),
      },
      inventory: {
        totalProducts: products.length,
        totalStockValue,
        lowStockCount,
      },
      recentSales: recentSales.map((s) => ({
        id: s.id,
        invoiceNumber: s.invoiceNumber,
        customer: s.customer?.name || 'Cliente Ocasional',
        grandTotal: Number(s.grandTotal),
        createdAt: s.createdAt,
      })),
    };
  }

  async getLowStockAlerts(tenantId: string) {
    const products = await this.prisma.product.findMany({
      where: { tenantId, isActive: true },
      include: {
        category: true,
        warehouseStocks: { include: { warehouse: true } },
      },
    });

    const lowStock = [];
    for (const p of products) {
      const currentStock = p.warehouseStocks.reduce((sum, s) => sum + Number(s.quantity), 0);
      const alertQty = Number(p.alertQuantity);
      if (currentStock <= alertQty) {
        lowStock.push({
          id: p.id,
          code: p.code,
          name: p.name,
          category: p.category.name,
          currentStock,
          alertQuantity: alertQty,
          warehouses: p.warehouseStocks.map((ws) => ({
            warehouseName: ws.warehouse.name,
            stock: Number(ws.quantity),
          })),
        });
      }
    }

    return lowStock;
  }

  async getProfitAndLoss(tenantId: string, startDate?: string, endDate?: string) {
    const start = startDate ? new Date(startDate) : new Date(new Date().getFullYear(), new Date().getMonth(), 1);
    const end = endDate ? new Date(endDate) : new Date();

    const sales = await this.prisma.sale.findMany({
      where: {
        tenantId,
        createdAt: { gte: start, lte: end },
      },
      include: {
        items: true,
      },
    });

    let totalRevenue = 0;
    let totalCogs = 0;

    for (const sale of sales) {
      totalRevenue += Number(sale.grandTotal);
      for (const item of sale.items) {
        totalCogs += Number(item.quantity) * Number(item.unitCost);
      }
    }

    const expensesAgg = await this.prisma.expense.aggregate({
      where: {
        tenantId,
        date: { gte: start, lte: end },
      },
      _sum: { amount: true },
    });

    const totalExpenses = Number(expensesAgg._sum.amount || 0);
    const grossProfit = totalRevenue - totalCogs;
    const netProfit = grossProfit - totalExpenses;

    return {
      period: { start, end },
      totalRevenue,
      costOfGoodsSold: totalCogs,
      grossProfit,
      totalExpenses,
      netProfit,
      grossMarginPercentage: totalRevenue > 0 ? (grossProfit / totalRevenue) * 100 : 0,
      netMarginPercentage: totalRevenue > 0 ? (netProfit / totalRevenue) * 100 : 0,
    };
  }
}
