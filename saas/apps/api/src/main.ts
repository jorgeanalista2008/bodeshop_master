import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';
import { ValidationPipe, Logger } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import * as cookieParser from 'cookie-parser';

async function bootstrap() {
  const logger = new Logger('BodeShopSaaS');
  const app = await NestFactory.create(AppModule);
  const configService = app.get(ConfigService);

  const port = configService.get<number>('app.port') || 4000;
  const deploymentEnv = configService.get<string>('app.deploymentEnv');
  const isLocal = configService.get<boolean>('app.isLocal');

  app.use(cookieParser());

  // Habilitar CORS dinámico según entorno
  app.enableCors({
    origin: (origin, callback) => {
      // Permitir llamadas sin origen (ej: curl, postman, server-to-server)
      if (!origin) return callback(null, true);

      if (isLocal) {
        // En entorno local, permitir cualquier subdominio localhost
        if (origin.includes('localhost') || origin.includes('127.0.0.1')) {
          return callback(null, true);
        }
      } else {
        // En producción, permitir subdominios de vercel o dominio propio
        if (origin.endsWith('.vercel.app') || origin.includes('bodeshop')) {
          return callback(null, true);
        }
      }

      callback(null, true);
    },
    credentials: true,
    methods: ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    allowedHeaders: ['Content-Type', 'Authorization', 'x-tenant-id', 'x-branch-id', 'x-tenant-slug'],
  });

  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      transform: true,
      forbidNonWhitelisted: true,
    }),
  );

  await app.listen(port);
  logger.log(`🚀 BodeShop SaaS API iniciada en: http://localhost:${port}`);
  logger.log(`🌍 Modo de Despliegue activo: [${deploymentEnv.toUpperCase()}]`);
  logger.log(`📊 Endpoint de Salud: http://localhost:${port}/health`);
}
bootstrap();
