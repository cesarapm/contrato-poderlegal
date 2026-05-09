# 🎨 Configuración de Estilos - Poder Legal

Sistema de estilos personalizado con paleta morado/dorado para el proyecto de contratos de arrendamiento.

## ✅ Archivos Creados

### 📋 Guías y Documentación
- `.github/ESTILOS.md` - Guía completa de estilos y sistema de diseño
- `.github/COMPONENTES.md` - Documentación de componentes Blade
- `.github/prompts/contrato-arrendamiento.prompt.md` - Prompt especializado

### 🎨 Configuración de Estilos
- `tailwind.config.js` - Configuración de Tailwind con paleta personalizada
- `resources/css/app.css` - Importaciones y configuración de fuentes
- `resources/css/poderlegal.css` - Estilos personalizados de Poder Legal
- `resources/css/filament/admin/theme.css` - Tema personalizado para Filament

### 🔧 Componentes Blade (en `resources/views/components/`)
- `button.blade.php` - Componente de botón con variantes
- `input.blade.php` - Campo de texto con validación
- `textarea.blade.php` - Área de texto con contador
- `select.blade.php` - Select/desplegable
- `card.blade.php` - Tarjetas/contenedores
- `wizard-steps.blade.php` - Indicador de pasos del wizard
- `loading.blade.php` - Spinner de carga

### 📄 Layouts
- `resources/views/layouts/app.blade.php` - Layout principal

### ⚙️ Configuración
- `app/Providers/Filament/AdminPanelProvider.php` - Panel de Filament configurado
- `vite.config.js` - Configuración de Vite actualizada

## 🚀 Instalación de Dependencias

### 1. Instalar dependencias de Node.js

```bash
npm install
```

### 2. Instalar plugins adicionales de Tailwind (si no están instalados)

```bash
npm install -D @tailwindcss/forms @tailwindcss/typography
```

### 3. Compilar assets

```bash
npm run dev
# O para producción:
npm run build
```

## 🎨 Paleta de Colores

### Morados
- **Purple Bishop** (`#4A148C`) - Color principal de marca
- **Purple Deep** (`#1A0933`) - Morado más oscuro  
- **Primary Purple** (`#663399`) - Morado medio
- **Light Purple** (`#9C27B0`) - Morado claro
- **Dark Purple** (`#311B92`) - Morado oscuro

### Dorados
- **Primary Gold** (`#FFD700`) - Dorado principal
- **Gold Accent** (`#FFC107`) - Dorado acento
- **Gold Warm** (`#FFAA00`) - Dorado cálido

## 🔤 Tipografía

- **Display (títulos)**: Poppins (Google Fonts)
- **Body (texto)**: Inter (Google Fonts)

Las fuentes se cargan automáticamente desde:
```
https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap
```

## 📦 Uso de Componentes

### Ejemplo básico de botón

```blade
<x-button variant="primary" type="submit">
    Enviar formulario
</x-button>
```

### Ejemplo de formulario

```blade
<x-card>
    <form method="POST" action="{{ route('contratos.store') }}">
        @csrf
        
        <x-input 
            name="nombre" 
            label="Nombre completo" 
            required
        />
        
        <x-select 
            name="tipo_producto" 
            label="Tipo de producto"
            :options="['basica' => 'Básica', 'superior' => 'Superior']"
            required
        />
        
        <x-button variant="primary" type="submit">
            Guardar
        </x-button>
    </form>
</x-card>
```

Para más ejemplos, consulta [.github/COMPONENTES.md](.github/COMPONENTES.md)

## 🎯 Uso del Prompt Personalizado

Una vez que los estilos están configurados, puedes usar el prompt especializado:

```
/contrato-arrendamiento Crear las migraciones y modelos
```

o

```
/contrato-arrendamiento Implementar el wizard con los estilos de Poder Legal
```

## 🎨 Clases de Tailwind Personalizadas

### Colores
```blade
<!-- Texto -->
<div class="text-purple-bishop">Texto morado principal</div>
<div class="text-gold-primary">Texto dorado</div>

<!-- Fondos -->
<div class="bg-purple-deep">Fondo morado oscuro</div>
<div class="bg-gold-accent">Fondo dorado</div>

<!-- Bordes -->
<div class="border-purple-bishop">Borde morado</div>
```

### Gradientes CSS
```blade
<div class="bg-gradient-primary">Gradiente dorado</div>
<div class="bg-gradient-secondary">Gradiente morado</div>

<h1 class="text-gradient-primary">Texto con gradiente dorado</h1>
<h2 class="text-gradient-purple">Texto con gradiente morado</h2>
```

### Animaciones
```blade
<div class="animate-fade-in">Aparece con fade in</div>
<div class="animate-float">Flotando</div>
<div class="loading-shimmer">Efecto shimmer</div>
```

## 🎨 Filament Panel

El panel administrativo de Filament está configurado con:
- Colores primarios morado/dorado
- Fuente Inter
- Logo personalizado "Poder Legal"
- Sidebar colapsable
- Tema personalizado en `resources/css/filament/admin/theme.css`

Accede al panel en: `http://tu-dominio.test/admin`

## 📚 Recursos

- **Guía de estilos completa**: [.github/ESTILOS.md](.github/ESTILOS.md)
- **Documentación de componentes**: [.github/COMPONENTES.md](.github/COMPONENTES.md)
- **Prompt especializado**: Usa `/contrato-arrendamiento` en el chat

## 🔧 Troubleshooting

### Los estilos no se aplican

1. Asegúrate de compilar los assets:
```bash
npm run dev
```

2. Limpia la caché de vistas:
```bash
php artisan view:clear
php artisan config:clear
```

3. Verifica que las fuentes de Google estén cargando en el navegador

### Los componentes Blade no funcionan

Los componentes están en `resources/views/components/` y se usan con la sintaxis:
```blade
<x-nombre-componente />
```

Laravel los detecta automáticamente si están en ese directorio.

### Filament no muestra el tema personalizado

1. Compila los assets de Filament:
```bash
npm run build
```

2. Limpia la caché:
```bash
php artisan filament:optimize-clear
```

## 📝 Próximos Pasos

1. ✅ Estilos configurados
2. ⏳ Crear migraciones y modelos (usa el prompt)
3. ⏳ Implementar wizard de contratos
4. ⏳ Configurar generación de PDFs
5. ⏳ Integrar sistema de pagos

---

**Contacto**: Poder Legal - contacto@poderlegal.mx  
**Versión**: 1.0 (Mayo 2026)
