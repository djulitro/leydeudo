# Guía Rápida - LeyDeudo Setup

## 🚀 Instalación de Aliases

### Windows
```powershell
# Script PowerShell (recomendado) - Recrea el perfil limpio
powershell -ExecutionPolicy Bypass -File setup-aliases-simple.ps1

# Script bash multiplataforma
./setup-aliases.sh
```

### Linux/macOS
```bash
chmod +x setup-aliases.sh
./setup-aliases.sh
```

## 📋 Comandos Más Usados

```bash
# Gestión básica
leydeudo-up          # Levantar servicios
leydeudo-down        # Detener servicios
leydeudo-ps          # Ver estado

# Laravel desarrollo
leydeudo-artisan     # Comandos artisan
leydeudo-migrate     # Migraciones
leydeudo-shell       # Entrar al contenedor

# Base de datos
leydeudo-mysql       # Cliente MySQL
```

## 🔧 URLs de Acceso

- **Laravel**: http://localhost:8081
- **PhpMyAdmin**: http://localhost:8082
- **Frontend**: http://localhost:3001 (futuro)

## 📞 Solución Rápida

```bash
# Si algo falla, reiniciar todo
leydeudo-down
leydeudo-up

# Ver logs si hay errores
leydeudo-logs
```