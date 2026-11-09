import { Module, NestModule, MiddlewareConsumer, RequestMethod } from '@nestjs/common';
import { ConfigModule } from '@nestjs/config';
import configuration from './config/configuration';
import { PrismaModule } from './prisma/prisma.module';
import { AuthModule } from './modules/auth/auth.module';
import { BranchesModule } from './modules/branches/branches.module';
import { ProductsModule } from './modules/products/products.module';
import { SalesModule } from './modules/sales/sales.module';
import { PosModule } from './modules/pos/pos.module';
import { TransfersModule } from './modules/transfers/transfers.module';
import { PurchasesModule } from './modules/purchases/purchases.module';
import { SubscriptionsModule } from './modules/subscriptions/subscriptions.module';
import { ExpensesModule } from './modules/expenses/expenses.module';
import { QuotesModule } from './modules/quotes/quotes.module';
import { SettingsModule } from './modules/settings/settings.module';
import { ReportsModule } from './modules/reports/reports.module';
import { AdjustmentsModule } from './modules/adjustments/adjustments.module';
import { ContactsModule } from './modules/contacts/contacts.module';
import { TenantMiddleware } from './common/middleware/tenant.middleware';
import { AppController } from './app.controller';

@Module({
  imports: [
    ConfigModule.forRoot({
      isGlobal: true,
      load: [configuration],
    }),
    PrismaModule,
    AuthModule,
    BranchesModule,
    ProductsModule,
    SalesModule,
    PosModule,
    TransfersModule,
    PurchasesModule,
    SubscriptionsModule,
    ExpensesModule,
    QuotesModule,
    SettingsModule,
    ReportsModule,
    AdjustmentsModule,
    ContactsModule,
  ],
  controllers: [AppController],
})
export class AppModule implements NestModule {
  configure(consumer: MiddlewareConsumer) {
    consumer
      .apply(TenantMiddleware)
      .forRoutes({ path: '*', method: RequestMethod.ALL });
  }
}
