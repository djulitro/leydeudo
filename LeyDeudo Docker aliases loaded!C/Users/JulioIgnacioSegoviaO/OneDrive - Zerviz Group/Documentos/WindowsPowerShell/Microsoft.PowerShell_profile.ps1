
# =============================================================================
# LeyDeudo Docker Aliases - Generado automáticamente
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
    param([Parameter(ValueFromRemainingArguments=$true)]$args)
    docker-compose exec backend php artisan $args 
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
    param([Parameter(ValueFromRemainingArguments=$true)]$args)
    docker-compose exec backend composer $args 
}
function leydeudo-install { docker-compose exec backend composer install }
function leydeudo-update { docker-compose exec backend composer update }

# Funciones para testing
function leydeudo-test { docker-compose exec backend php artisan test }
function leydeudo-phpunit { 
    param([Parameter(ValueFromRemainingArguments=$true)]$args)
    docker-compose exec backend ./vendor/bin/phpunit $args 
}

# Funciones para desarrollo
function leydeudo-clear { docker-compose exec backend php artisan cache:clear; docker-compose exec backend php artisan config:clear; docker-compose exec backend php artisan view:clear }
function leydeudo-optimize { docker-compose exec backend php artisan optimize }

