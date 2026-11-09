import { Injectable, BadRequestException } from '@nestjs/common';
import { PrismaService } from '../../prisma/prisma.service';

export interface CreateExpenseDto {
  branchId: string;
  categoryId?: string;
  categoryName?: string;
  reference?: string;
  amount: number;
  note?: string;
}

@Injectable()
export class ExpensesService {
  constructor(private readonly prisma: PrismaService) {}

  async findAll(tenantId: string, branchId?: string) {
    const where: any = { tenantId };
    if (branchId) where.branchId = branchId;

    return this.prisma.expense.findMany({
      where,
      include: {
        category: true,
        branch: { select: { id: true, name: true, code: true } },
      },
      orderBy: { date: 'desc' },
    });
  }

  async getCategories(tenantId: string) {
    return this.prisma.expenseCategory.findMany({
      where: { tenantId },
      orderBy: { name: 'asc' },
    });
  }

  async create(tenantId: string, userId: string, dto: CreateExpenseDto) {
    return this.prisma.$transaction(async (tx) => {
      let categoryId = dto.categoryId;
      if (!categoryId) {
        let cat = await tx.expenseCategory.findFirst({
          where: { tenantId, name: dto.categoryName || 'Gastos Generales' },
        });

        if (!cat) {
          cat = await tx.expenseCategory.create({
            data: {
              tenantId,
              code: `CAT-${Date.now().toString().slice(-4)}`,
              name: dto.categoryName || 'Gastos Generales',
            },
          });
        }
        categoryId = cat.id;
      }

      const count = await tx.expense.count({ where: { tenantId } });
      const reference = dto.reference || `GAS-${String(count + 1).padStart(6, '0')}`;

      return tx.expense.create({
        data: {
          tenantId,
          branchId: dto.branchId,
          categoryId,
          reference,
          amount: dto.amount,
          note: dto.note,
          createdById: userId,
        },
        include: { category: true, branch: true },
      });
    });
  }
}
