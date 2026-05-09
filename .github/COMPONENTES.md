# Componentes Blade - Poder Legal

Esta guía muestra cómo usar los componentes Blade personalizados con los estilos de Poder Legal.

## 📦 Componentes Disponibles

### 1. Button (Botón)

```blade
<!-- Botón primario (dorado) -->
<x-button variant="primary" type="submit">
    Enviar formulario
</x-button>

<!-- Botón secundario (morado) -->
<x-button variant="secondary">
    Ver más información
</x-button>

<!-- Botón outline -->
<x-button variant="outline-primary">
    Cancelar
</x-button>

<!-- Diferentes tamaños -->
<x-button size="small">Pequeño</x-button>
<x-button size="large">Grande</x-button>
<x-button size="xl">Extra grande</x-button>

<!-- Botón de bloque (ancho completo) -->
<x-button block="true">
    Continuar
</x-button>
```

### 2. Input (Campo de texto)

```blade
<!-- Input básico -->
<x-input 
    name="nombre" 
    label="Nombre completo" 
    placeholder="Ingresa tu nombre"
    required
/>

<!-- Con validación de error -->
<x-input 
    name="email" 
    label="Correo electrónico" 
    type="email"
    placeholder="correo@ejemplo.com"
    :error="$errors->first('email')"
    required
/>

<!-- Con valor por defecto -->
<x-input 
    name="telefono" 
    label="Teléfono" 
    type="tel"
    value="{{ $usuario->telefono }}"
/>
```

### 3. Textarea

```blade
<!-- Textarea básico -->
<x-textarea 
    name="observaciones" 
    label="Observaciones adicionales"
    placeholder="Escribe tus observaciones aquí..."
    rows="5"
/>

<!-- Con límite de caracteres -->
<x-textarea 
    name="mensaje" 
    label="Mensaje"
    maxlength="2000"
    required
/>
```

### 4. Select (Desplegable)

```blade
<!-- Select básico -->
<x-select 
    name="tipo_producto" 
    label="Selecciona un producto"
    :options="[
        'basica' => 'Básica',
        'superior' => 'Superior',
        'empresarial' => 'Empresarial',
    ]"
    required
/>

<!-- Con valor seleccionado -->
<x-select 
    name="estado" 
    label="Estado"
    :options="$estados"
    value="{{ $contrato->estado }}"
/>
```

### 5. Card (Tarjeta)

```blade
<!-- Card básico -->
<x-card>
    <h3 class="text-lg font-bold mb-4">Título de la tarjeta</h3>
    <p>Contenido de la tarjeta...</p>
</x-card>

<!-- Card con gradiente morado -->
<x-card variant="gradient">
    <h3>Tarjeta con fondo morado</h3>
</x-card>

<!-- Card con gradiente dorado -->
<x-card variant="gold">
    <h3>Tarjeta con fondo dorado</h3>
</x-card>

<!-- Card sin efecto hover -->
<x-card hover="false">
    <p>Tarjeta estática</p>
</x-card>
```

### 6. Wizard Steps (Pasos del wizard)

```blade
<x-wizard-steps 
    :steps="[
        'Datos tramitante',
        'Solicitud cobertura',
        'Inquilino',
        'Fiador',
        'Propietario',
        'Dirección',
        'Datos renta',
        'Servicios',
        'Observaciones'
    ]"
    :currentStep="3"
/>
```

### 7. Loading (Spinner de carga)

```blade
<!-- Mostrar spinner -->
<x-loading :show="true" />

<!-- Con Livewire -->
<x-loading :show="$isLoading" />
```

## 🎨 Ejemplo de Formulario Completo

```blade
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <x-card>
        <h2 class="font-display text-3xl font-bold text-purple-bishop mb-6">
            Nuevo Contrato de Arrendamiento
        </h2>
        
        <form method="POST" action="{{ route('contratos.store') }}">
            @csrf
            
            <!-- Sección: Datos del Tramitante -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-purple-bishop mb-4 pb-2 border-b-2 border-gold-primary">
                    Datos del Tramitante
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="nombre" 
                        label="Nombre" 
                        required
                    />
                    
                    <x-input 
                        name="apellido_paterno" 
                        label="Apellido paterno" 
                        required
                    />
                    
                    <x-input 
                        name="apellido_materno" 
                        label="Apellido materno"
                    />
                    
                    <x-input 
                        name="email" 
                        label="Correo electrónico" 
                        type="email"
                        required
                    />
                    
                    <x-input 
                        name="telefono_1" 
                        label="Teléfono 1" 
                        type="tel"
                        required
                    />
                    
                    <x-input 
                        name="telefono_2" 
                        label="Teléfono 2 (opcional)" 
                        type="tel"
                    />
                </div>
            </div>
            
            <!-- Sección: Tipo de Producto -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-purple-bishop mb-4 pb-2 border-b-2 border-gold-primary">
                    Seleccionar Producto
                </h3>
                
                <x-select 
                    name="tipo_producto" 
                    label="Tipo de producto"
                    :options="[
                        'basica' => 'Básica',
                        'superior' => 'Superior',
                        'empresarial' => 'Empresarial',
                    ]"
                    required
                />
            </div>
            
            <!-- Observaciones -->
            <div class="mb-8">
                <x-textarea 
                    name="observaciones" 
                    label="Observaciones adicionales"
                    placeholder="Máximo 2000 caracteres"
                    maxlength="2000"
                />
            </div>
            
            <!-- Botones -->
            <div class="flex justify-between items-center">
                <x-button variant="outline-primary" type="button">
                    Guardar borrador
                </x-button>
                
                <x-button variant="primary" type="submit">
                    Continuar
                </x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection
```

## 🔄 Uso con Livewire

```blade
<div>
    <!-- Wizard steps -->
    <x-wizard-steps 
        :steps="$steps"
        :currentStep="$currentStep"
    />
    
    <!-- Loading overlay -->
    <x-loading :show="$isProcessing" />
    
    <!-- Formulario -->
    <x-card>
        <form wire:submit.prevent="nextStep">
            @if($currentStep === 1)
                <x-input 
                    wire:model="tramitante.nombre" 
                    name="nombre" 
                    label="Nombre"
                    required
                />
                
                <x-input 
                    wire:model="tramitante.email" 
                    name="email" 
                    label="Email"
                    type="email"
                    :error="$errors->first('tramitante.email')"
                    required
                />
            @endif
            
            <div class="flex justify-between mt-6">
                @if($currentStep > 1)
                    <x-button wire:click="previousStep" variant="outline-primary">
                        Anterior
                    </x-button>
                @endif
                
                <x-button type="submit" variant="primary">
                    {{ $currentStep < count($steps) ? 'Siguiente' : 'Finalizar' }}
                </x-button>
            </div>
        </form>
    </x-card>
</div>
```

## 🎯 Clases CSS Útiles

### Gradientes de Texto
```blade
<h1 class="text-gradient-primary">Título con gradiente dorado</h1>
<h2 class="text-gradient-purple">Título con gradiente morado</h2>
```

### Fondos
```blade
<div class="bg-gradient-primary">Fondo dorado</div>
<div class="bg-gradient-secondary">Fondo morado</div>
<div class="bg-light">Fondo claro</div>
```

### Animaciones
```blade
<div class="animate-fade-in">Se desvanece al entrar</div>
<div class="animate-float">Flotando</div>
<div class="loading-shimmer">Efecto shimmer</div>
```

### Colores Tailwind Personalizados
```blade
<div class="text-purple-bishop">Texto morado principal</div>
<div class="bg-purple-deep">Fondo morado oscuro</div>
<div class="text-gold-primary">Texto dorado</div>
<div class="border-gold-accent">Borde dorado</div>
```

---

**Para más detalles sobre los estilos, consulta:** `.github/ESTILOS.md`
