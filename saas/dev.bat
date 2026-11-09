@echo off
title BodeShop SaaS Launcher
color 0B
echo ==========================================================
echo        INICIANDO ECOSISTEMA BODESHOP SAAS
echo ==========================================================
echo [1/2] Iniciando Backend API (NestJS en puerto 4000)...
start "BodeShop API (NestJS :4000)" cmd /k "cd /d "%~dp0apps\api" && npm run start:dev"

timeout /t 3 /nobreak > nul

echo [2/2] Iniciando Frontend Web (Next.js en puerto 3000)...
start "BodeShop Web (Next.js :3000)" cmd /k "cd /d "%~dp0apps\web" && npm run dev"

echo ==========================================================
echo  Todo en marcha!
echo  Backend:  http://localhost:4000/health
echo  Frontend: http://localhost:3000
echo ==========================================================
timeout /t 2 /nobreak > nul
start http://localhost:3000
