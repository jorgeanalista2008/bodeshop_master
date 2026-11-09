Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "       INICIANDO ECOSISTEMA BODESHOP SAAS" -ForegroundColor Cyan
Write-Host "==========================================================" -ForegroundColor Cyan

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path

Write-Host "[1/2] Iniciando Backend API (NestJS en puerto 4000)..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$scriptDir\apps\api'; Write-Host '--- BODESHOP API (NESTJS :4000) ---' -ForegroundColor Green; npm run start:dev"

Start-Sleep -Seconds 3

Write-Host "[2/2] Iniciando Frontend Web (Next.js en puerto 3000)..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$scriptDir\apps\web'; Write-Host '--- BODESHOP WEB (NEXTJS :3000) ---' -ForegroundColor Green; npm run dev"

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host " Todo en marcha!" -ForegroundColor Green
Write-Host " Backend:  http://localhost:4000/health" -ForegroundColor White
Write-Host " Frontend: http://localhost:3000" -ForegroundColor White
Write-Host "==========================================================" -ForegroundColor Cyan

Start-Sleep -Seconds 2
Start-Process "http://localhost:3000"
