#!/bin/bash
# Script para actualizar la plantilla en la base de datos después de editarla

echo "🔄 Actualizando plantilla de contrato..."
php artisan db:seed --class=PlantillaArrendamientoProfesionalSeeder

echo ""
echo "✅ Plantilla actualizada!"
echo "🌐 Abre: http://localhost:8000/preview"
echo "📝 Recarga la página (F5) para ver los cambios"
