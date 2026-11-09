import { registerAs } from '@nestjs/config';

export interface AppConfig {
  deploymentEnv: 'local' | 'production';
  isLocal: boolean;
  isProduction: boolean;
  port: number;
  databaseUrl: string;
  directUrl: string;
  apiUrl: string;
  webUrl: string;
  jwt: {
    secret: string;
    expiresIn: string;
    refreshSecret: string;
    refreshExpiresIn: string;
  };
}

export default registerAs('app', (): AppConfig => {
  const deploymentEnv = (process.env.DEPLOYMENT_ENV || 'local').toLowerCase() as 'local' | 'production';
  const isLocal = deploymentEnv === 'local';
  const isProduction = deploymentEnv === 'production';

  // Selección automática de URLs en función del switch DEPLOYMENT_ENV
  const databaseUrl = isLocal
    ? process.env.LOCAL_DATABASE_URL || process.env.DATABASE_URL
    : process.env.PROD_DATABASE_URL || process.env.DATABASE_URL;

  const directUrl = isLocal
    ? process.env.LOCAL_DIRECT_URL || process.env.DIRECT_URL
    : process.env.PROD_DIRECT_URL || process.env.DIRECT_URL;

  const apiUrl = isLocal
    ? process.env.LOCAL_API_URL || 'http://localhost:4000'
    : process.env.PROD_API_URL || 'https://api.bodeshop-saas.vercel.app';

  const webUrl = isLocal
    ? process.env.LOCAL_WEB_URL || 'http://localhost:3000'
    : process.env.PROD_WEB_URL || 'https://bodeshop-saas.vercel.app';

  return {
    deploymentEnv,
    isLocal,
    isProduction,
    port: parseInt(process.env.PORT || '4000', 10),
    databaseUrl,
    directUrl,
    apiUrl,
    webUrl,
    jwt: {
      secret: process.env.JWT_SECRET || 'bodeshop-saas-master-secure-jwt-secret-2026',
      expiresIn: process.env.JWT_EXPIRES_IN || '15m',
      refreshSecret: process.env.JWT_REFRESH_SECRET || 'bodeshop-saas-master-secure-refresh-secret-2026',
      refreshExpiresIn: process.env.JWT_REFRESH_EXPIRES_IN || '7d',
    },
  };
});
