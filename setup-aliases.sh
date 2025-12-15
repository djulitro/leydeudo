#!/bin/bash

# =============================================================================
# LeyDeudo - Script de configuración de alias multiplataforma
# =============================================================================
# Este script configura alias para comandos Docker del proyecto LeyDeudo
# Funciona en Windows (PowerShell/Git Bash), Linux y macOS
# =============================================================================

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Banner
echo -e "${BLUE}"
echo "======================================"
echo "    LeyDeudo - Setup de Aliases"
echo "======================================"
echo -e "${NC}"

# Detectar sistema operativo
detect_os() {
    if [[ "$OSTYPE" == "msys" ]] || [[ "$OSTYPE" == "cygwin" ]] || [[ -n "$WINDIR" ]]; then
        echo "windows"
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        echo "macos"
    elif [[ "$OSTYPE" == "linux-gnu"* ]]; then
        echo "linux"
    else
        echo "unknown"
    fi
}

# Detectar shell en Windows
detect_windows_shell() {
    if command -v powershell.exe &> /dev/null; then
        echo "powershell"
    elif command -v pwsh &> /dev/null; then
        echo "pwsh"
    else
        echo "bash"
    fi
}

# Crear alias para PowerShell
setup_powershell_aliases() {
    echo -e "${YELLOW}Configurando aliases para PowerShell...${NC}"
    
    # Detectar perfil de PowerShell
    if command -v powershell.exe &> /dev/null; then
        PROFILE_PATH=$(powershell.exe -Command 'echo $PROFILE' 2>/dev/null | tr -d '\r')
    elif command -v pwsh &> /dev/null; then
        PROFILE_PATH=$(pwsh -Command 'echo $PROFILE' 2>/dev/null | tr -d '\r')
    else
        echo -e "${RED}PowerShell no encontrado${NC}"
        return 1
    fi
    
    # Crear directorio del perfil si no existe
    PROFILE_DIR=$(dirname "$PROFILE_PATH")
    mkdir -p "$PROFILE_DIR" 2>/dev/null || true
    
    # Contenido de los alias para PowerShell
    POWERSHELL_ALIASES='
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
'
    
    # Verificar si los alias ya existen
    if [[ -f "$PROFILE_PATH" ]] && grep -q "LeyDeudo Docker Aliases" "$PROFILE_PATH"; then
        echo -e "${YELLOW}Los aliases ya existen. ¿Quieres actualizarlos? (y/n):${NC}"
        read -r response
        if [[ "$response" != "y" ]] && [[ "$response" != "Y" ]]; then
            echo -e "${BLUE}Operación cancelada${NC}"
            return 0
        fi
        
        # Remover aliases existentes
        sed -i '/# LeyDeudo Docker Aliases/,/^$/d' "$PROFILE_PATH" 2>/dev/null || true
    fi
    
    # Agregar nuevos aliases
    echo "$POWERSHELL_ALIASES" >> "$PROFILE_PATH"
    
    echo -e "${GREEN}✓ Aliases configurados en: $PROFILE_PATH${NC}"
    echo -e "${YELLOW}Ejecuta: . \$PROFILE (o reinicia PowerShell) para cargar los aliases${NC}"
}

# Crear alias para Bash/Zsh
setup_bash_aliases() {
    echo -e "${YELLOW}Configurando aliases para Bash/Zsh...${NC}"
    
    # Detectar archivo de configuración
    if [[ -f "$HOME/.zshrc" ]]; then
        SHELL_CONFIG="$HOME/.zshrc"
        SHELL_NAME="Zsh"
    elif [[ -f "$HOME/.bashrc" ]]; then
        SHELL_CONFIG="$HOME/.bashrc"
        SHELL_NAME="Bash"
    elif [[ -f "$HOME/.bash_profile" ]]; then
        SHELL_CONFIG="$HOME/.bash_profile"
        SHELL_NAME="Bash"
    else
        # Crear .bashrc si no existe
        SHELL_CONFIG="$HOME/.bashrc"
        SHELL_NAME="Bash"
        touch "$SHELL_CONFIG"
    fi
    
    # Contenido de los alias para Bash/Zsh
    BASH_ALIASES="
# LEYDEUDO_ALIASES_START
# =============================================================================
# LeyDeudo Docker Aliases - Generado automáticamente
# Fecha: $(date '+%Y-%m-%d %H:%M:%S')
# =============================================================================

echo \"LeyDeudo Docker aliases loaded!\"

# Alias para comandos Docker
alias leydeudo-up=\"docker-compose up -d\"
alias leydeudo-down=\"docker-compose down\"
alias leydeudo-restart=\"docker-compose restart\"
alias leydeudo-ps=\"docker-compose ps\"
alias leydeudo-logs=\"docker-compose logs -f backend\"
alias leydeudo-build=\"docker-compose build\"
alias leydeudo-rebuild=\"docker-compose down && docker-compose build --no-cache && docker-compose up -d\"

# Alias para Laravel
alias leydeudo-artisan=\"docker-compose exec backend php artisan\"
alias leydeudo-migrate=\"docker-compose exec backend php artisan migrate\"
alias leydeudo-seed=\"docker-compose exec backend php artisan db:seed\"
alias leydeudo-fresh=\"docker-compose exec backend php artisan migrate:fresh --seed\"
alias leydeudo-routes=\"docker-compose exec backend php artisan route:list\"
alias leydeudo-tinker=\"docker-compose exec backend php artisan tinker\"

# Alias para acceso directo
alias leydeudo-shell=\"docker-compose exec backend bash\"
alias leydeudo-mysql=\"docker-compose exec mysql mysql -u leydeudo_user -p leydeudo_db\"
alias leydeudo-redis=\"docker-compose exec redis redis-cli\"

# Alias para Composer
alias leydeudo-composer=\"docker-compose exec backend composer\"
alias leydeudo-install=\"docker-compose exec backend composer install\"
alias leydeudo-update=\"docker-compose exec backend composer update\"

# Alias para testing
alias leydeudo-test=\"docker-compose exec backend php artisan test\"
alias leydeudo-phpunit=\"docker-compose exec backend ./vendor/bin/phpunit\"

# Alias para desarrollo
alias leydeudo-clear=\"docker-compose exec backend php artisan cache:clear && docker-compose exec backend php artisan config:clear && docker-compose exec backend php artisan view:clear\"
alias leydeudo-optimize=\"docker-compose exec backend php artisan optimize\"

# Función de ayuda
leydeudo-help() {
    echo \"\"
    echo -e \"\033[34m====================================== LeyDeudo - Comandos Disponibles ======================================\033[0m\"
    echo \"\"
    echo -e \"\033[33mGESTIÓN DE CONTENEDORES:\033[0m\"
    echo -e \"  \033[32mleydeudo-up          \033[0m Levantar todos los servicios Docker\"
    echo -e \"  \033[32mleydeudo-down        \033[0m Detener todos los servicios Docker\"
    echo -e \"  \033[32mleydeudo-restart     \033[0m Reiniciar todos los servicios\"
    echo -e \"  \033[32mleydeudo-ps          \033[0m Ver estado de contenedores\"
    echo -e \"  \033[32mleydeudo-logs        \033[0m Ver logs del backend en tiempo real\"
    echo -e \"  \033[32mleydeudo-build       \033[0m Construir las imágenes Docker\"
    echo -e \"  \033[32mleydeudo-rebuild     \033[0m Reconstruir completamente (down + build + up)\"
    echo \"\"
    echo -e \"\033[33mCOMANDOS LARAVEL:\033[0m\"
    echo -e \"  \033[32mleydeudo-artisan     \033[0m Ejecutar comandos Artisan (ej: leydeudo-artisan migrate)\"
    echo -e \"  \033[32mleydeudo-migrate     \033[0m Ejecutar migraciones de base de datos\"
    echo -e \"  \033[32mleydeudo-seed        \033[0m Ejecutar seeders de base de datos\"
    echo -e \"  \033[32mleydeudo-fresh       \033[0m Migración fresh con seeders\"
    echo -e \"  \033[32mleydeudo-routes      \033[0m Listar todas las rutas de la aplicación\"
    echo -e \"  \033[32mleydeudo-tinker      \033[0m Abrir Tinker para interactuar con Laravel\"
    echo \"\"
    echo -e \"\033[33mACCESO DIRECTO:\033[0m\"
    echo -e \"  \033[32mleydeudo-shell       \033[0m Acceder al shell del contenedor backend\"
    echo -e \"  \033[32mleydeudo-mysql       \033[0m Conectar al cliente MySQL\"
    echo -e \"  \033[32mleydeudo-redis       \033[0m Conectar al cliente Redis\"
    echo \"\"
    echo -e \"\033[33mCOMPOSER:\033[0m\"
    echo -e \"  \033[32mleydeudo-composer    \033[0m Ejecutar comandos Composer (ej: leydeudo-composer require)\"
    echo -e \"  \033[32mleydeudo-install     \033[0m Instalar dependencias PHP\"
    echo -e \"  \033[32mleydeudo-update      \033[0m Actualizar dependencias PHP\"
    echo \"\"
    echo -e \"\033[33mTESTING:\033[0m\"
    echo -e \"  \033[32mleydeudo-test        \033[0m Ejecutar tests con Artisan\"
    echo -e \"  \033[32mleydeudo-phpunit     \033[0m Ejecutar PHPUnit directamente\"
    echo \"\"
    echo -e \"\033[33mDESARROLLO:\033[0m\"
    echo -e \"  \033[32mleydeudo-clear       \033[0m Limpiar cachés de Laravel (cache, config, views)\"
    echo -e \"  \033[32mleydeudo-optimize    \033[0m Optimizar la aplicación para producción\"
    echo \"\"
    echo -e \"\033[33mINFORMACIÓN:\033[0m\"
    echo -e \"  \033[32mleydeudo-help        \033[0m Mostrar esta ayuda\"
    echo \"\"
    echo -e \"\033[36mURLS DE ACCESO:\033[0m\"
    echo -e \"  Laravel:     \033[34mhttp://localhost:8081\033[0m\"
    echo -e \"  PhpMyAdmin:  \033[34mhttp://localhost:8082\033[0m\"
    echo -e \"  MySQL:       \033[34mlocalhost:3307 (user: leydeudo_user, db: leydeudo_db)\033[0m\"
    echo \"\"
    echo -e \"\033[34m===============================================================================================\033[0m\"
    echo \"\"
}

# LEYDEUDO_ALIASES_END
"
    
    # Verificar si los alias ya existen
    if grep -q "# LEYDEUDO_ALIASES_START" "$SHELL_CONFIG" 2>/dev/null; then
        echo -e "${YELLOW}Los aliases ya existen. ¿Quieres actualizarlos? (y/n):${NC}"
        read -r response
        if [[ "$response" != "y" ]] && [[ "$response" != "Y" ]]; then
            echo -e "${BLUE}Operación cancelada${NC}"
            return 0
        fi
        
        echo -e "${YELLOW}Eliminando aliases existentes...${NC}"
        
        # Crear archivo temporal sin la sección de LeyDeudo
        awk '
            /# LEYDEUDO_ALIASES_START/ { skip=1; next }
            /# LEYDEUDO_ALIASES_END/ { skip=0; next }
            !skip
        ' "$SHELL_CONFIG" > "$SHELL_CONFIG.tmp"
        
        # Reemplazar el archivo original
        mv "$SHELL_CONFIG.tmp" "$SHELL_CONFIG"
    fi
    
    # Agregar nuevos aliases
    echo "$BASH_ALIASES" >> "$SHELL_CONFIG"
    
    echo -e "${GREEN}✓ Aliases configurados en: $SHELL_CONFIG${NC}"
    echo -e "${YELLOW}Ejecuta: source $SHELL_CONFIG (o reinicia la terminal) para cargar los aliases${NC}"
}

# Función principal
main() {
    OS=$(detect_os)
    
    echo -e "${BLUE}Sistema operativo detectado: $OS${NC}"
    echo ""
    
    case $OS in
        "windows")
            SHELL_TYPE=$(detect_windows_shell)
            echo -e "${BLUE}Shell detectado: $SHELL_TYPE${NC}"
            echo ""
            
            if [[ "$SHELL_TYPE" == "powershell" ]] || [[ "$SHELL_TYPE" == "pwsh" ]]; then
                setup_powershell_aliases
            else
                echo -e "${YELLOW}Ejecutándose en Git Bash, configurando aliases de Bash...${NC}"
                setup_bash_aliases
            fi
            ;;
        "macos"|"linux")
            setup_bash_aliases
            ;;
        "unknown")
            echo -e "${RED}Sistema operativo no soportado${NC}"
            exit 1
            ;;
    esac
    
    echo ""
    echo -e "${GREEN}======================================"
    echo "    ✓ Configuración completada"
    echo "======================================${NC}"
    echo ""
    echo -e "${BLUE}Aliases disponibles:${NC}"
    echo "  • leydeudo-up, leydeudo-down, leydeudo-restart"
    echo "  • leydeudo-artisan, leydeudo-migrate, leydeudo-seed"
    echo "  • leydeudo-shell, leydeudo-mysql, leydeudo-redis"
    echo "  • leydeudo-test, leydeudo-logs, leydeudo-clear"
    echo ""
    echo -e "${YELLOW}¡Reinicia tu terminal o recarga tu perfil para usar los aliases!${NC}"
}

# Ejecutar función principal
main "$@"