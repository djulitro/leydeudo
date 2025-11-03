# LeyDeudo - Setup de Aliases

Este directorio contiene scripts para configurar automáticamente los aliases de desarrollo del proyecto LeyDeudo en diferentes sistemas operativos.

## 🚀 Instalación Rápida

### Windows

#### Opción 1: PowerShell (Recomendado)
```powershell
# Ejecutar desde PowerShell como Administrador
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
.\setup-aliases.bat
```

#### Opción 2: Git Bash
```bash
# Ejecutar desde Git Bash
./setup-aliases.sh
```

### Linux / macOS
```bash
# Dar permisos de ejecución
chmod +x setup-aliases.sh

# Ejecutar el script
./setup-aliases.sh
```

## 📋 Aliases Disponibles

### Gestión de Contenedores
| Alias | Comando | Descripción |
|-------|---------|-------------|
| `leydeudo-up` | `docker-compose up -d` | Levantar todos los servicios |
| `leydeudo-down` | `docker-compose down` | Detener todos los servicios |
| `leydeudo-restart` | `docker-compose restart` | Reiniciar todos los servicios |
| `leydeudo-ps` | `docker-compose ps` | Ver estado de contenedores |
| `leydeudo-logs` | `docker-compose logs -f backend` | Ver logs del backend |
| `leydeudo-build` | `docker-compose build` | Construir imágenes |
| `leydeudo-rebuild` | `docker-compose down && build --no-cache && up -d` | Reconstruir completamente |

### Comandos Laravel
| Alias | Comando | Descripción |
|-------|---------|-------------|
| `leydeudo-artisan` | `docker-compose exec backend php artisan` | Ejecutar comandos artisan |
| `leydeudo-migrate` | `docker-compose exec backend php artisan migrate` | Ejecutar migraciones |
| `leydeudo-seed` | `docker-compose exec backend php artisan db:seed` | Ejecutar seeders |
| `leydeudo-fresh` | `docker-compose exec backend php artisan migrate:fresh --seed` | Migración fresh con seed |
| `leydeudo-routes` | `docker-compose exec backend php artisan route:list` | Listar rutas |
| `leydeudo-tinker` | `docker-compose exec backend php artisan tinker` | Abrir tinker |

### Acceso Directo
| Alias | Comando | Descripción |
|-------|---------|-------------|
| `leydeudo-shell` | `docker-compose exec backend bash` | Shell del contenedor backend |
| `leydeudo-mysql` | `docker-compose exec mysql mysql -u leydeudo_user -p leydeudo_db` | Cliente MySQL |
| `leydeudo-redis` | `docker-compose exec redis redis-cli` | Cliente Redis |

### Composer
| Alias | Comando | Descripción |
|-------|---------|-------------|
| `leydeudo-composer` | `docker-compose exec backend composer` | Ejecutar composer |
| `leydeudo-install` | `docker-compose exec backend composer install` | Instalar dependencias |
| `leydeudo-update` | `docker-compose exec backend composer update` | Actualizar dependencias |

### Testing
| Alias | Comando | Descripción |
|-------|---------|-------------|
| `leydeudo-test` | `docker-compose exec backend php artisan test` | Ejecutar tests con Artisan |
| `leydeudo-phpunit` | `docker-compose exec backend ./vendor/bin/phpunit` | Ejecutar PHPUnit directamente |

### Desarrollo
| Alias | Comando | Descripción |
|-------|---------|-------------|
| `leydeudo-clear` | Limpiar cache, config y views | Limpiar cachés de Laravel |
| `leydeudo-optimize` | `docker-compose exec backend php artisan optimize` | Optimizar aplicación |

## 🔄 Actualización de Aliases

Cuando se agreguen nuevos aliases al proyecto:

1. **Ejecuta el script nuevamente:**
   ```bash
   # Linux/macOS/Git Bash
   ./setup-aliases.sh
   
   # Windows PowerShell
   .\setup-aliases.bat
   ```

2. **El script detectará los aliases existentes y preguntará si quieres actualizarlos**

3. **Recarga tu perfil:**
   ```bash
   # Bash/Zsh
   source ~/.bashrc  # o ~/.zshrc
   
   # PowerShell
   . $PROFILE
   ```

## 📂 Archivos de Configuración

### Windows PowerShell
- **Ubicación**: `$PROFILE` (generalmente `Documents\WindowsPowerShell\Microsoft.PowerShell_profile.ps1`)
- **Formato**: Funciones de PowerShell

### Linux/macOS
- **Ubicación**: `~/.bashrc`, `~/.zshrc`, o `~/.bash_profile`
- **Formato**: Alias de Bash/Zsh

## 🛠️ Solución de Problemas

### Windows: "no se puede cargar el archivo porque la ejecución de scripts está deshabilitada"
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### Linux/macOS: "Permission denied"
```bash
chmod +x setup-aliases.sh
```

### Los aliases no se cargan automáticamente
Asegúrate de recargar tu perfil o reiniciar la terminal después de ejecutar el script.

## 🔧 Personalización

Para agregar nuevos aliases:

1. **Edita los scripts** `setup-aliases.sh` y `setup-aliases.bat`
2. **Agrega los nuevos alias** en las secciones correspondientes
3. **Ejecuta el script** para actualizar la configuración
4. **Comparte los cambios** con el equipo via Git

## 📞 Soporte

Si tienes problemas con la configuración de aliases:
1. Verifica que Docker y Docker Compose estén instalados
2. Asegúrate de estar en el directorio raíz del proyecto
3. Ejecuta `leydeudo-ps` para verificar que los contenedores estén corriendo

---

**Proyecto LeyDeudo** - Sistema Legal para Abogados