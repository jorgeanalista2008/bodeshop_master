import { Injectable, BadRequestException, NotFoundException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface OpenRegisterDto {
  branchId: string;
  cashInHand: number;
}

export interface CloseRegisterDto {
  registerId: string;
  totalCashSubmitted: number;
  totalCardSubmitted: number;
  closingNote?: string;
}

export interface SuspendBillDto {
  branchId: string;
  posRegisterId?: string;
  customerId?: string;
  suspendNote?: string;
  items: Array<{
    productId: string;
    unitPrice: number;
    quantity: number;
  }>;
}

@Injectable()
export class PosService {
  constructor(private readonly prisma: PrismaService) {}

  async getActiveRegister(tenantId: string, branchId: string, userId: string) {
    const active = await this.prisma.posRegister.findFirst({
      where: {
        tenantId,
        branchId,
        userId,
        status: 'OPEN',
      },
      include: {
        sales: {
          include: {
            payments: true,
          },
        },
      },
    });

    if (!active) return null;

    let cashSales = 0;
    let cardSales = 0;

    for (const sale of active.sales) {
      for (const p of sale.payments) {
        if (p.method === 'CASH') cashSales += Number(p.amount);
        else if (p.method === 'CARD') cardSales += Number(p.amount);
      }
    }

    return {
      ...active,
      calculatedCashSales: cashSales,
      calculatedCardSales: cardSales,
      expectedCashInDrawer: Number(active.cashInHand) + cashSales,
    };
  }

  async openRegister(tenantId: string, userId: string, dto: OpenRegisterDto) {
    const existing = await this.prisma.posRegister.findFirst({
      where: {
        tenantId,
        branchId: dto.branchId,
        userId,
        status: 'OPEN',
      },
    });

    if (existing) {
      throw new BadRequestException('Ya posee una caja registradora abierta en esta sucursal.');
    }

    return this.prisma.posRegister.create({
      data: {
        tenantId,
        branchId: dto.branchId,
        userId,
        cashInHand: dto.cashInHand,
        status: 'OPEN',
      },
      include: { branch: true },
    });
  }

  async closeRegister(tenantId: string, userId: string, dto: CloseRegisterDto) {
    const register = await this.prisma.posRegister.findFirst({
      where: {
        id: dto.registerId,
        tenantId,
        status: 'OPEN',
      },
      include: {
        sales: {
          include: { payments: true },
        },
      },
    });

    if (!register) {
      throw new NotFoundException('Caja no encontrada o ya se encuentra cerrada.');
    }

    let totalCashSales = 0;
    let totalCardSales = 0;

    for (const sale of register.sales) {
      for (const payment of sale.payments) {
        if (payment.method === 'CASH') totalCashSales += Number(payment.amount);
        else if (payment.method === 'CARD') totalCardSales += Number(payment.amount);
      }
    }

    const expectedCash = Number(register.cashInHand) + totalCashSales;
    const cashDifference = dto.totalCashSubmitted - expectedCash;
    const cardDifference = dto.totalCardSubmitted - totalCardSales;

    const closed = await this.prisma.posRegister.update({
      where: { id: register.id },
      data: {
        status: 'CLOSED',
        closedAt: new Date(),
        closedByUserId: userId,
        totalCashSales,
        totalCardSales,
        totalCashSubmitted: dto.totalCashSubmitted,
        totalCardSubmitted: dto.totalCardSubmitted,
        closingNote: dto.closingNote,
      },
    });

    return {
      message: 'Caja cerrada exitosamente. Arqueo (Corte Z) generado.',
      summary: {
        registerId: closed.id,
        openedAt: closed.openedAt,
        closedAt: closed.closedAt,
        initialCashFloat: Number(closed.cashInHand),
        totalCashSales,
        totalCardSales,
        totalSales: totalCashSales + totalCardSales,
        totalTransactions: register.sales.length,
        cashSubmitted: dto.totalCashSubmitted,
        expectedCash,
        cashDifference,
        cardSubmitted: dto.totalCardSubmitted,
        expectedCard: totalCardSales,
        cardDifference,
        closingNote: dto.closingNote,
      },
    };
  }

  // --- CUENTAS SUSPENDIDAS (HOLD BILLS) ---
  async suspendBill(tenantId: string, dto: SuspendBillDto) {
    if (!dto.items || dto.items.length === 0) {
      throw new BadRequestException('La cuenta a suspender debe contener productos.');
    }

    let customerId = dto.customerId;
    if (!customerId) {
      const defCust = await this.prisma.customer.findFirst({ where: { tenantId } });
      customerId = defCust?.id;
    }

    let total = 0;
    const itemsData = dto.items.map((i) => {
      const subtotal = i.quantity * i.unitPrice;
      total += subtotal;
      return {
        tenantId,
        productId: i.productId,
        unitPrice: i.unitPrice,
        quantity: i.quantity,
        subtotal,
      };
    });

    return this.prisma.suspendedBill.create({
      data: {
        tenantId,
        branchId: dto.branchId,
        posRegisterId: dto.posRegisterId,
        customerId: customerId!,
        suspendNote: dto.suspendNote || 'Venta en Espera',
        total,
        totalItems: dto.items.length,
        items: { create: itemsData },
      },
      include: {
        customer: true,
        items: { include: { product: true } },
      },
    });
  }

  async getSuspendedBills(tenantId: string, branchId: string) {
    return this.prisma.suspendedBill.findMany({
      where: { tenantId, branchId },
      include: {
        customer: true,
        items: { include: { product: true } },
      },
      orderBy: { createdAt: 'desc' },
    });
  }

  async deleteSuspendedBill(tenantId: string, id: string) {
    return this.prisma.suspendedBill.delete({
      where: { id },
    });
  }
}
