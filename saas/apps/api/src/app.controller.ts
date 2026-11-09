import { Controller, Get } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Controller()
export class AppController {
  constructor(private readonly configService: ConfigService) {}

  @Get('health')
  getHealth() {
    const deploymentEnv = this.configService.get<string>('app.deploymentEnv');
    const isProduction = this.configService.get<boolean>('app.isProduction');

    return {
      status: 'ok',
      service: 'BodeShop Master SaaS API',
      deploymentEnvironment: deploymentEnv.toUpperCase(),
      mode: isProduction ? 'CLOUD_PRODUCTION (Supabase & Vercel)' : 'LOCAL_DEVELOPMENT (Localhost & Local PostgreSQL)',
      timestamp: new Date().toISOString(),
    };
  }
}
