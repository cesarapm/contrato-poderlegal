#!/bin/bash

# Script para limpiar cache en producción (Hostinger)
# Ejecutar este script en el servidor de producción

echo "🔧 Limpiando caches de Laravel..."

# Limpiar cache de vistas (Blade)
php artisan view:clear
echo "✓ Cache de vistas limpiado"

# Limpiar cache de aplicación
php artisan cache:clear
echo "✓ Cache de aplicación limpiado"

# Limpiar cache de configuración
php artisan config:clear
echo "✓ Cache de configuración limpiado"

# Limpiar cache de rutas
php artisan route:clear
echo "✓ Cache de rutas limpiado"

# Limpiar cache compilado de Blade
rm -rf storage/framework/views/*.php
echo "✓ Archivos compilados de Blade eliminados"

# Optimizar para producción (opcional)
# php artisan config:cache
# php artisan route:cache
# php artisan view:cache

echo ""
echo "✅ Limpieza completada. Recarga tu sitio web."
