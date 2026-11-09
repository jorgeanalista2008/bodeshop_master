import { Injectable, OnModuleInit, OnModuleDestroy, Logger } from '@nestjs/common';
import { PrismaClient } from '@prisma/client';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class PrismaService extends PrismaClient implements OnModuleInit, OnModuleDestroy {
  private readonly logger = new Logger(PrismaService.name);

  constructor(private readonly configService: ConfigService) {
    const isProduction = configService.get<boolean>('app.isProduction');
    const databaseUrl = configService.get<string>('app.databaseUrl');

    super({
      datasources: {
        db: {
          url: databaseUrl,
        },
      },
      log: isProduction ? ['error', 'warn'] : ['query', 'info', 'warn', 'error'],
    });
  }

  async onModuleInit() {
    try {
      await this.$connect();
      const env = this.configService.get<string>('app.deploymentEnv');
      this.logger.log(`Conexión exitosa a PostgreSQL [Entorno activo: ${env.toUpperCase()}]`);
    } catch (error) {
      this.logger.error('Error al conectar con la base de datos PostgreSQL:', error);
      throw error;
    }
  }

  async onModuleDestroy() {
    await this.$disconnect();
    this.logger.log('Desconexión de PostgreSQL completada');
  }
}
