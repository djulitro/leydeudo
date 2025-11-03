# LeyDeudo - Script de configuracion de alias para PowerShell
# Ejecutar con: powershell -ExecutionPolicy Bypass -File setup-aliases.ps1

Write-Host ""
Write-Host "======================================"
Write-Host "    LeyDeudo - Setup de Aliases"
Write-Host "======================================"
Write-Host ""

Write-Host "Configurando aliases para PowerShell..." -ForegroundColor Yellow

# Obtener ruta del perfil
$ProfilePath = $PROFILE

# Crear directorio del perfil si no existe
$ProfileDir = Split-Path $ProfilePath -Parent
if (!(Test-Path $ProfileDir)) {
    New-Item -ItemType Directory -Path $ProfileDir -Force | Out-Null
}

# Crear backup del perfil existente si existe y luego recrearlo limpio
if (Test-Path $ProfilePath) {
    $BackupPath = "$ProfilePath.backup.$(Get-Date -Format 'yyyyMMdd-HHmmss')"
    Copy-Item $ProfilePath $BackupPath
    Write-Host "Backup creado en: $BackupPath" -ForegroundColor Green
    Remove-Item $ProfilePath -Force
}

Write-Host "Creando perfil limpio..." -ForegroundColor Yellow
New-Item -Path $ProfilePath -Type File -Force | Out-Null

# Definir los nuevos aliases
$AliasContent = @"
# LEYDEUDO_ALIASES_START
# =============================================================================
# LeyDeudo Docker Aliases - Configuracion limpia
# Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
# =============================================================================

Write-Host "LeyDeudo Docker aliases loaded!" -ForegroundColor Green

# Funciones para comandos Docker
function leydeudo-up { docker-compose up -d }
function leydeudo-down { docker-compose down }
function leydeudo-restart { docker-compose restart }
function leydeudo-ps { docker-compose ps }
function leydeudo-logs { docker-compose logs -f backend }
function leydeudo-build { docker-compose build }
function leydeudo-rebuild { docker-compose down; docker-compose build --no-cache; docker-compose up -d }

# Funciones para Laravel
function leydeudo-artisan { 
    param([Parameter(ValueFromRemainingArguments=`$true)]`$args)
    docker-compose exec backend php artisan `$args 
}
function leydeudo-migrate { docker-compose exec backend php artisan migrate }
function leydeudo-seed { docker-compose exec backend php artisan db:seed }
function leydeudo-fresh { docker-compose exec backend php artisan migrate:fresh --seed }
function leydeudo-routes { docker-compose exec backend php artisan route:list }
function leydeudo-tinker { docker-compose exec backend php artisan tinker }

# Funciones para acceso directo
function leydeudo-shell { docker-compose exec backend bash }
function leydeudo-mysql { docker-compose exec mysql mysql -u leydeudo_user -p leydeudo_db }
function leydeudo-redis { docker-compose exec redis redis-cli }

# Funciones para Composer
function leydeudo-composer { 
    param([Parameter(ValueFromRemainingArguments=`$true)]`$args)
    docker-compose exec backend composer `$args 
}
function leydeudo-install { docker-compose exec backend composer install }
function leydeudo-update { docker-compose exec backend composer update }

# Funciones para testing
function leydeudo-test { docker-compose exec backend php artisan test }
function leydeudo-phpunit { 
    param([Parameter(ValueFromRemainingArguments=`$true)]`$args)
    docker-compose exec backend ./vendor/bin/phpunit `$args 
}

# Funciones para desarrollo
function leydeudo-clear { docker-compose exec backend php artisan cache:clear; docker-compose exec backend php artisan config:clear; docker-compose exec backend php artisan view:clear }
function leydeudo-optimize { docker-compose exec backend php artisan optimize }

# Función de ayuda
function leydeudo-help {
    Write-Host ""
    Write-Host "====================================== LeyDeudo - Comandos Disponibles ======================================" -ForegroundColor Blue
    Write-Host ""
    Write-Host "GESTION DE CONTENEDORES:" -ForegroundColor Yellow
    Write-Host "  leydeudo-up           " -NoNewline -ForegroundColor Green; Write-Host "Levantar todos los servicios Docker"
    Write-Host "  leydeudo-down         " -NoNewline -ForegroundColor Green; Write-Host "Detener todos los servicios Docker"
    Write-Host "  leydeudo-restart      " -NoNewline -ForegroundColor Green; Write-Host "Reiniciar todos los servicios"
    Write-Host "  leydeudo-ps           " -NoNewline -ForegroundColor Green; Write-Host "Ver estado de contenedores"
    Write-Host "  leydeudo-logs         " -NoNewline -ForegroundColor Green; Write-Host "Ver logs del backend en tiempo real"
    Write-Host "  leydeudo-build        " -NoNewline -ForegroundColor Green; Write-Host "Construir las imágenes Docker"
    Write-Host "  leydeudo-rebuild      " -NoNewline -ForegroundColor Green; Write-Host "Reconstruir completamente (down + build + up)"
    Write-Host ""
    Write-Host "COMANDOS LARAVEL:" -ForegroundColor Yellow
    Write-Host "  leydeudo-artisan      " -NoNewline -ForegroundColor Green; Write-Host "Ejecutar comandos Artisan (ej: leydeudo-artisan migrate)"
    Write-Host "  leydeudo-migrate      " -NoNewline -ForegroundColor Green; Write-Host "Ejecutar migraciones de base de datos"
    Write-Host "  leydeudo-seed         " -NoNewline -ForegroundColor Green; Write-Host "Ejecutar seeders de base de datos"
    Write-Host "  leydeudo-fresh        " -NoNewline -ForegroundColor Green; Write-Host "Migracion fresh con seeders"
    Write-Host "  leydeudo-routes       " -NoNewline -ForegroundColor Green; Write-Host "Listar todas las rutas de la aplicacion"
    Write-Host "  leydeudo-tinker       " -NoNewline -ForegroundColor Green; Write-Host "Abrir Tinker para interactuar con Laravel"
    Write-Host ""
    Write-Host "ACCESO DIRECTO:" -ForegroundColor Yellow
    Write-Host "  leydeudo-shell        " -NoNewline -ForegroundColor Green; Write-Host "Acceder al shell del contenedor backend"
    Write-Host "  leydeudo-mysql        " -NoNewline -ForegroundColor Green; Write-Host "Conectar al cliente MySQL"
    Write-Host "  leydeudo-redis        " -NoNewline -ForegroundColor Green; Write-Host "Conectar al cliente Redis"
    Write-Host ""
    Write-Host "COMPOSER:" -ForegroundColor Yellow
    Write-Host "  leydeudo-composer     " -NoNewline -ForegroundColor Green; Write-Host "Ejecutar comandos Composer (ej: leydeudo-composer require)"
    Write-Host "  leydeudo-install      " -NoNewline -ForegroundColor Green; Write-Host "Instalar dependencias PHP"
    Write-Host "  leydeudo-update       " -NoNewline -ForegroundColor Green; Write-Host "Actualizar dependencias PHP"
    Write-Host ""
    Write-Host "TESTING:" -ForegroundColor Yellow
    Write-Host "  leydeudo-test         " -NoNewline -ForegroundColor Green; Write-Host "Ejecutar tests con Artisan"
    Write-Host "  leydeudo-phpunit      " -NoNewline -ForegroundColor Green; Write-Host "Ejecutar PHPUnit directamente"
    Write-Host ""
    Write-Host "DESARROLLO:" -ForegroundColor Yellow
    Write-Host "  leydeudo-clear        " -NoNewline -ForegroundColor Green; Write-Host "Limpiar caches de Laravel (cache, config, views)"
    Write-Host "  leydeudo-optimize     " -NoNewline -ForegroundColor Green; Write-Host "Optimizar la aplicacion para produccion"
    Write-Host ""
    Write-Host "INFORMACION:" -ForegroundColor Yellow
    Write-Host "  leydeudo-help         " -NoNewline -ForegroundColor Green; Write-Host "Mostrar esta ayuda"
    Write-Host ""
    Write-Host "URLS DE ACCESO:" -ForegroundColor Cyan
    Write-Host "  Laravel:     " -NoNewline -ForegroundColor White; Write-Host "http://localhost:8081" -ForegroundColor Blue
    Write-Host "  PhpMyAdmin:  " -NoNewline -ForegroundColor White; Write-Host "http://localhost:8082" -ForegroundColor Blue
    Write-Host "  MySQL:       " -NoNewline -ForegroundColor White; Write-Host "localhost:3307 (user: leydeudo_user, db: leydeudo_db)" -ForegroundColor Blue
    Write-Host ""
    Write-Host "===============================================================================================" -ForegroundColor Blue
    Write-Host ""
}

# LEYDEUDO_ALIASES_END
"@

# Escribir los aliases al perfil
Set-Content -Path $ProfilePath -Value $AliasContent

Write-Host ""
Write-Host "======================================"
Write-Host "    Configuracion completada"
Write-Host "======================================"
Write-Host ""
Write-Host "Perfil configurado en: $ProfilePath"
Write-Host ""
Write-Host "Aliases disponibles:"
Write-Host "  - leydeudo-up, leydeudo-down, leydeudo-restart"
Write-Host "  - leydeudo-artisan, leydeudo-migrate, leydeudo-seed"
Write-Host "  - leydeudo-shell, leydeudo-mysql, leydeudo-redis"
Write-Host "  - leydeudo-test, leydeudo-logs, leydeudo-clear"
Write-Host ""
Write-Host "Ejecuta '. `$PROFILE' o reinicia PowerShell para usar los aliases!"
Write-Host ""
pause