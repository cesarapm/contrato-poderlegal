---
description: "Desarrollar sistema de generación de contratos de arrendamiento con formularios dinámicos usando Laravel 12, Filament 4, Livewire y generación de PDF. Incluye wizard multi-paso, validaciones, vista previa y almacenamiento en MySQL. Usa los estilos de Poder Legal (morado/dorado)."
name: "Generador de Contratos de Arrendamiento"
argument-hint: "Especifica qué componente desarrollar (wizard, modelo, PDF, etc.) o déjalo vacío para guía completa"
agent: "agent"
tools: [file_search, read_file, create_file, replace_string_in_file, multi_replace_string_in_file, grep_search, semantic_search, run_in_terminal, get_errors]
---

# Sistema de Generación de Contratos de Arrendamiento

> **⚠️ IMPORTANTE**: Este sistema debe seguir la guía de estilos de Poder Legal definida en [.github/ESTILOS.md](../.github/ESTILOS.md). Usa la paleta morado/dorado (#4A148C, #663399, #FFD700) y las fuentes Poppins e Inter.

Desarrolla un sistema completo en **Laravel 12 + Filament 4** para generar contratos de arrendamiento mediante formularios dinámicos con las siguientes características:

## Arquitectura del Sistema

### Stack Tecnológico
- **Backend**: Laravel 12
- **Panel Admin**: Filament 4 (con tema personalizado Poder Legal)
- **Frontend Reactivo**: Livewire 3
- **Estilos**: TailwindCSS + CSS personalizado (paleta morado/dorado)
- **Fuentes**: Poppins (títulos) e Inter (cuerpo)
- **Base de datos**: MySQL
- **Generación PDF**: DOMPDF o Browsershot
- **Validación**: FormRequest de Laravel

### Paleta de Colores (Poder Legal)
- **Morado Principal**: `#4A148C` (purple-bishop)
- **Morado Profundo**: `#1A0933` (purple-deep) 
- **Morado Medio**: `#663399` (primary-purple)
- **Morado Claro**: `#9C27B0` (light-purple)
- **Dorado Principal**: `#FFD700` (primary-gold)
- **Dorado Acento**: `#FFC107` (gold-accent)
- **Dorado Cálido**: `#FFAA00` (gold-warm)

### Estructura de Módulos

```
app/
├── Models/
│   ├── Contrato.php
│   ├── Tramitante.php
│   ├── Inmueble.php
│   ├── Arrendatario.php (Inquilino)
│   ├── Arrendador.php (Propietario)
│   ├── Fiador.php
│   └── PlantillaContrato.php
├── Filament/
│   ├── Resources/
│   │   ├── ContratoResource.php
│   │   └── PlantillaContratoResource.php
│   └── Widgets/
│       └── ContratoStatsWidget.php
├── Services/
│   ├── ContratoService.php
│   ├── PdfGeneratorService.php
│   └── VariableParserService.php
└── Http/
    ├── Requests/
    │   └── GenerarContratoRequest.php
    └── Livewire/
        └── ContratoWizard.php
```

## Formulario Wizard Multi-Paso

Implementa un wizard de **9 pasos** basado en las imágenes proporcionadas:

### Paso 1: Datos del Tramitante
- Nombre, apellido paterno, apellido materno
- Teléfono 1, Teléfono 2 (opcional)
- Correo electrónico
- Toggle: "Soy independiente" / "Pertenezco a una inmobiliaria"
- Radio buttons: "¿Quién solicita el trámite?" (Asesor/Propietario)
- Checkbox: "Acepto Términos y condiciones"

### Paso 2: Solicitud de Cobertura
**Ubicación del Inmueble en Renta:**
- Código postal (con botón "Buscar" para autocompletar)
- Estado (autocompletado)
- Alcaldía/Municipio (autocompletado)
- Colonia (select)
- Calle
- No. Ext, Edificio, No. Int
- Uso del inmueble (select)

**Abogado Operativo:**
- Select dropdown (opcional)

**Monto y Periodo de Renta:**
- Periodo de arrendamiento (select)
- Fecha inicio, Fecha de término (date pickers)
- Renta mensual (input numérico con formato de moneda)
- Total (calculado automáticamente)
- Toggle: "Más IVA"

**Seleccionar Producto:**
- Radio buttons: Básica / Superior / Empresarial
- Mostrar "Incluye" debajo de cada opción

**Precio de la Cobertura:**
- Mostrado dinámicamente según producto seleccionado

**Agregar Complementos:**
- Tabla con columnas: Complemento | Precio unitario | Cantidad | Subtotal
- Filas: Antecedentes crediticios, Antecedentes legales, Antecedentes laborales
- Botones +/- para ajustar cantidad
- Cálculo automático de subtotales

### Paso 3: Datos del Inquilino (Arrendatario)
Por cada inquilino (con opción "Agregar inquilino extra"):
- Tipo persona: Física / Moral (radio buttons)
- Nombre, Apellido paterno, Apellido materno
- Teléfono 1, Teléfono 2
- Correo electrónico
- Identificación vigente (file upload con icono de nube)

**Domicilio de Notificaciones:**
- Código postal (con botón "Buscar")
- Estado, Alcaldía/Municipio
- Colonia (select)
- Calle
- No. Exterior, Edificio, No. Interior

### Paso 4: Datos del Fiador u Obligado Solidario
- Radio buttons: No hay fiador / Fiador / Obligado solidario
- Si se selecciona, mostrar formulario similar al del inquilino

### Paso 5: Datos del Propietario (Arrendador)
Por cada propietario (soporte multi-propietario):
- Tipo persona: Física / Moral
- Nombre, Apellido paterno, Apellido materno
- Teléfono 1, Teléfono 2
- Correo electrónico
- Identificación vigente (file upload)
- Título de propiedad (file upload)
- ¿El propietario cuenta con representante legal? (Sí/No)
- ¿La propiedad está en proceso sucesorio? (Sí/No)

### Paso 6: Dirección del Propietario
- Código postal, Estado
- Colonia, Calle
- No. Ext, Edificio, No. Int

### Paso 7: Datos de Renta
**¿Cómo se paga la renta?**
- Radio buttons: Efectivo / Cuenta bancaria

**Forma de pago de rentas:**
- Radio buttons: Mensual / Semestral / Anual
- Info tooltip para cada opción

**Depósito en garantía (meses):**
- Input numérico con tooltip

**¿Existe cuota de mantenimiento?**
- Radio buttons: Sí / No

### Paso 8: Servicio del Inmueble en Renta
- ¿Cuenta con lugar de estacionamiento? (Sí/No)
- ¿Se autorizan mascotas? (Sí/No)
- ¿Con qué servicios cuenta?
  - Checkboxes: Teléfono, Internet, TV de paga, Gas

### Paso 9: Observaciones Adicionales
- Textarea (máximo 2000 caracteres)
- Botón "Guardar para más tarde"
- Botón "Siguiente" (ir a Pago)

## Modelos y Migraciones

### Migration: contratos
```php
Schema::create('contratos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tramitante_id')->constrained();
    $table->foreignId('plantilla_id')->nullable()->constrained('plantillas_contrato');
    $table->string('folio')->unique();
    $table->enum('tipo_producto', ['basica', 'superior', 'empresarial']);
    $table->decimal('monto_renta_mensual', 10, 2);
    $table->decimal('monto_total', 10, 2);
    $table->boolean('incluye_iva')->default(false);
    $table->date('fecha_inicio');
    $table->date('fecha_termino');
    $table->enum('estado', ['borrador', 'pendiente_pago', 'pagado', 'generado', 'firmado'])->default('borrador');
    $table->json('complementos')->nullable(); // Antecedentes
    $table->json('datos_renta'); // Forma de pago, depósito, etc.
    $table->json('servicios_inmueble'); // Estacionamiento, mascotas, servicios
    $table->text('observaciones')->nullable();
    $table->string('pdf_path')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

### Migration: tramitantes
```php
Schema::create('tramitantes', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('apellido_paterno');
    $table->string('apellido_materno')->nullable();
    $table->string('telefono_1');
    $table->string('telefono_2')->nullable();
    $table->string('email')->unique();
    $table->boolean('es_independiente')->default(true);
    $table->enum('tipo_solicitante', ['asesor', 'propietario']);
    $table->boolean('acepto_terminos')->default(false);
    $table->timestamps();
});
```

### Migration: inmuebles
```php
Schema::create('inmuebles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('contrato_id')->constrained()->cascadeOnDelete();
    $table->string('codigo_postal', 5);
    $table->string('estado');
    $table->string('alcaldia_municipio');
    $table->string('colonia');
    $table->string('calle');
    $table->string('numero_exterior');
    $table->string('edificio')->nullable();
    $table->string('numero_interior')->nullable();
    $table->string('uso_inmueble');
    $table->foreignId('abogado_id')->nullable()->constrained('users');
    $table->timestamps();
});
```

### Migration: arrendatarios (Inquilinos)
```php
Schema::create('arrendatarios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('contrato_id')->constrained()->cascadeOnDelete();
    $table->enum('tipo_persona', ['fisica', 'moral']);
    $table->string('nombre');
    $table->string('apellido_paterno')->nullable();
    $table->string('apellido_materno')->nullable();
    $table->string('telefono_1');
    $table->string('telefono_2')->nullable();
    $table->string('email');
    $table->string('identificacion_path')->nullable();
    $table->json('domicilio_notificaciones');
    $table->integer('orden')->default(1); // Para multi-inquilino
    $table->timestamps();
});
```

### Migration: arrendadores (Propietarios)
```php
Schema::create('arrendadores', function (Blueprint $table) {
    $table->id();
    $table->foreignId('contrato_id')->constrained()->cascadeOnDelete();
    $table->enum('tipo_persona', ['fisica', 'moral']);
    $table->string('nombre');
    $table->string('apellido_paterno')->nullable();
    $table->string('apellido_materno')->nullable();
    $table->string('telefono_1');
    $table->string('telefono_2')->nullable();
    $table->string('email');
    $table->string('identificacion_path')->nullable();
    $table->string('titulo_propiedad_path')->nullable();
    $table->boolean('tiene_representante_legal')->default(false);
    $table->boolean('en_proceso_sucesorio')->default(false);
    $table->json('direccion');
    $table->integer('orden')->default(1); // Para multi-propietario
    $table->timestamps();
});
```

### Migration: fiadores
```php
Schema::create('fiadores', function (Blueprint $table) {
    $table->id();
    $table->foreignId('contrato_id')->constrained()->cascadeOnDelete();
    $table->enum('tipo', ['fiador', 'obligado_solidario', 'ninguno'])->default('ninguno');
    $table->enum('tipo_persona', ['fisica', 'moral'])->nullable();
    $table->string('nombre')->nullable();
    $table->string('apellido_paterno')->nullable();
    $table->string('apellido_materno')->nullable();
    $table->string('telefono_1')->nullable();
    $table->string('telefono_2')->nullable();
    $table->string('email')->nullable();
    $table->string('identificacion_path')->nullable();
    $table->json('domicilio')->nullable();
    $table->timestamps();
});
```

### Migration: plantillas_contrato
```php
Schema::create('plantillas_contrato', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('slug')->unique();
    $table->text('contenido_html'); // HTML con variables {{nombre_variable}}
    $table->json('variables_detectadas'); // ['{{nombre_arrendatario}}', '{{renta_mensual}}', ...]
    $table->boolean('activa')->default(true);
    $table->timestamps();
});
```

## Componente Livewire: Wizard

### ContratoWizard.php

```php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ContratoService;

class ContratoWizard extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;
    public array $tramitante = [];
    public array $solicitud = [];
    public array $arrendatarios = [[]]; // Soporte multi-inquilino
    public array $fiador = ['tipo' => 'ninguno'];
    public array $arrendadores = [[]]; // Soporte multi-propietario
    public array $datosRenta = [];
    public array $serviciosInmueble = [];
    public ?string $observaciones = null;

    protected $listeners = ['buscarCodigoPostal', 'calcularTotal'];

    public function mount()
    {
        $this->tramitante = [
            'nombre' => '',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'telefono_1' => '',
            'telefono_2' => '',
            'email' => '',
            'es_independiente' => true,
            'tipo_solicitante' => 'asesor',
            'acepto_terminos' => false,
        ];
    }

    public function agregarArrendatario()
    {
        $this->arrendatarios[] = $this->getArrendatarioTemplate();
    }

    public function eliminarArrendatario($index)
    {
        if (count($this->arrendatarios) > 1) {
            unset($this->arrendatarios[$index]);
            $this->arrendatarios = array_values($this->arrendatarios);
        }
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function buscarCodigoPostal($codigoPostal)
    {
        // Integración con API de códigos postales
        // Actualizar estado, municipio, colonias
    }

    public function calcularTotal()
    {
        // Calcular renta total según periodo + complementos + IVA
    }

    public function submit()
    {
        $this->validate($this->rules());
        
        $contratoService = app(ContratoService::class);
        $contrato = $contratoService->crear([
            'tramitante' => $this->tramitante,
            'solicitud' => $this->solicitud,
            'arrendatarios' => $this->arrendatarios,
            'fiador' => $this->fiador,
            'arrendadores' => $this->arrendadores,
            'datos_renta' => $this->datosRenta,
            'servicios_inmueble' => $this->serviciosInmueble,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('success', 'Contrato creado exitosamente');
        return redirect()->route('contrato.pago', $contrato);
    }

    public function guardarBorrador()
    {
        // Guardar progreso actual
    }

    protected function validateCurrentStep()
    {
        // Validar según el paso actual
    }

    protected function rules()
    {
        return [
            'tramitante.nombre' => 'required|string|max:255',
            'tramitante.apellido_paterno' => 'required|string|max:255',
            'tramitante.email' => 'required|email',
            'tramitante.telefono_1' => 'required|string',
            'tramitante.acepto_terminos' => 'accepted',
            // ... más reglas de validación
        ];
    }

    public function render()
    {
        return view('livewire.contrato-wizard');
    }
}
```

## Servicio de Generación de PDF

### PdfGeneratorService.php

```php
namespace App\Services;

use App\Models\Contrato;
use App\Models\PlantillaContrato;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfGeneratorService
{
    protected VariableParserService $parser;

    public function __construct(VariableParserService $parser)
    {
        $this->parser = $parser;
    }

    public function generar(Contrato $contrato): string
    {
        $plantilla = $contrato->plantilla ?? PlantillaContrato::where('activa', true)->first();
        
        $variables = $this->parser->extraerVariables($contrato);
        $contenidoHtml = $this->parser->reemplazarVariables($plantilla->contenido_html, $variables);
        
        $pdf = Pdf::loadHTML($contenidoHtml)
            ->setPaper('letter')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);
        
        $filename = "contrato_{$contrato->folio}_" . now()->format('YmdHis') . ".pdf";
        $path = "contratos/{$contrato->id}/{$filename}";
        
        Storage::put($path, $pdf->output());
        
        $contrato->update(['pdf_path' => $path]);
        
        return $path;
    }

    public function generarVistaPrevia(Contrato $contrato): string
    {
        $plantilla = $contrato->plantilla ?? PlantillaContrato::where('activa', true)->first();
        $variables = $this->parser->extraerVariables($contrato);
        
        return $this->parser->reemplazarVariables($plantilla->contenido_html, $variables);
    }
}
```

### VariableParserService.php

```php
namespace App\Services;

use App\Models\Contrato;

class VariableParserService
{
    public function detectarVariables(string $html): array
    {
        preg_match_all('/\{\{([^}]+)\}\}/', $html, $matches);
        return array_unique($matches[1]);
    }

    public function extraerVariables(Contrato $contrato): array
    {
        $contrato->load(['tramitante', 'inmueble', 'arrendatarios', 'arrendadores', 'fiador']);
        
        return [
            // Tramitante
            'nombre_tramitante' => $contrato->tramitante->nombre_completo,
            'email_tramitante' => $contrato->tramitante->email,
            
            // Inmueble
            'direccion_inmueble' => $contrato->inmueble->direccion_completa,
            'codigo_postal_inmueble' => $contrato->inmueble->codigo_postal,
            
            // Arrendatarios
            'nombre_arrendatario' => $contrato->arrendatarios->first()->nombre_completo,
            'telefono_arrendatario' => $contrato->arrendatarios->first()->telefono_1,
            
            // Arrendadores
            'nombre_arrendador' => $contrato->arrendadores->first()->nombre_completo,
            
            // Datos de renta
            'renta_mensual' => number_format($contrato->monto_renta_mensual, 2),
            'monto_total' => number_format($contrato->monto_total, 2),
            'fecha_inicio' => $contrato->fecha_inicio->format('d/m/Y'),
            'fecha_termino' => $contrato->fecha_termino->format('d/m/Y'),
            
            // Fiador
            'nombre_fiador' => $contrato->fiador?->nombre_completo ?? 'N/A',
            
            // Sistema
            'folio_contrato' => $contrato->folio,
            'fecha_generacion' => now()->format('d/m/Y H:i:s'),
        ];
    }

    public function reemplazarVariables(string $html, array $variables): string
    {
        foreach ($variables as $key => $value) {
            $html = str_replace("{{{$key}}}", $value, $html);
        }
        
        return $html;
    }
}
```

## Resource de Filament

### ContratoResource.php

```php
namespace App\Filament\Resources;

use App\Filament\Resources\ContratoResource\Pages;
use App\Models\Contrato;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class ContratoResource extends Resource
{
    protected static ?string $model = Contrato::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Contratos';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('folio')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tramitante.nombre_completo')->label('Tramitante'),
                Tables\Columns\TextColumn::make('tipo_producto')->badge(),
                Tables\Columns\TextColumn::make('monto_total')->money('MXN'),
                Tables\Columns\BadgeColumn::make('estado')
                    ->colors([
                        'secondary' => 'borrador',
                        'warning' => 'pendiente_pago',
                        'success' => 'pagado',
                        'primary' => 'generado',
                        'info' => 'firmado',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')->options([
                    'borrador' => 'Borrador',
                    'pendiente_pago' => 'Pendiente de Pago',
                    'pagado' => 'Pagado',
                    'generado' => 'Generado',
                    'firmado' => 'Firmado',
                ]),
                Tables\Filters\SelectFilter::make('tipo_producto'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('generar_pdf')
                    ->icon('heroicon-o-document-download')
                    ->action(function (Contrato $record) {
                        $service = app(\App\Services\PdfGeneratorService::class);
                        $path = $service->generar($record);
                        return response()->download(storage_path("app/{$path}"));
                    }),
                Tables\Actions\Action::make('vista_previa')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn (Contrato $record) => view('contratos.preview', [
                        'html' => app(\App\Services\PdfGeneratorService::class)->generarVistaPrevia($record)
                    ]))
                    ->modalWidth('7xl'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContratos::route('/'),
            'view' => Pages\ViewContrato::route('/{record}'),
        ];
    }
}
```

## Vistas Blade

### livewire/contrato-wizard.blade.php

```blade
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            @foreach(['Datos tramitante', 'Solicitud cobertura', 'Inquilino', 'Fiador', 'Propietario', 'Dirección', 'Datos renta', 'Servicios', 'Observaciones'] as $index => $step)
                <div class="flex flex-col items-center {{ $currentStep === $index + 1 ? 'text-blue-600' : 'text-gray-400' }}">
                    <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center 
                        {{ $currentStep === $index + 1 ? 'border-blue-600 bg-blue-50' : 'border-gray-300' }}">
                        {{ $index + 1 }}
                    </div>
                    <span class="text-xs mt-2 text-center">{{ $step }}</span>
                </div>
                @if($index < 8)
                    <div class="flex-1 h-0.5 mx-2 {{ $currentStep > $index + 1 ? 'bg-blue-600' : 'bg-gray-300' }}"></div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Form Steps -->
    <div class="bg-white shadow rounded-lg p-6">
        @if($currentStep === 1)
            @include('livewire.contrato-wizard.paso-1-tramitante')
        @elseif($currentStep === 2)
            @include('livewire.contrato-wizard.paso-2-solicitud')
        @elseif($currentStep === 3)
            @include('livewire.contrato-wizard.paso-3-arrendatario')
        @elseif($currentStep === 4)
            @include('livewire.contrato-wizard.paso-4-fiador')
        @elseif($currentStep === 5)
            @include('livewire.contrato-wizard.paso-5-arrendador')
        @elseif($currentStep === 6)
            @include('livewire.contrato-wizard.paso-6-direccion')
        @elseif($currentStep === 7)
            @include('livewire.contrato-wizard.paso-7-renta')
        @elseif($currentStep === 8)
            @include('livewire.contrato-wizard.paso-8-servicios')
        @elseif($currentStep === 9)
            @include('livewire.contrato-wizard.paso-9-observaciones')
        @endif

        <!-- Navigation Buttons -->
        <div class="mt-8 flex justify-between">
            @if($currentStep > 1)
                <button type="button" wire:click="previousStep" 
                    class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Anterior
                </button>
            @else
                <div></div>
            @endif

            <div class="flex gap-3">
                <button type="button" wire:click="guardarBorrador" 
                    class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Guardar para más tarde
                </button>
                
                @if($currentStep < 9)
                    <button type="button" wire:click="nextStep" 
                        class="px-6 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-800">
                        Siguiente
                    </button>
                @else
                    <button type="button" wire:click="submit" 
                        class="px-6 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-800">
                        Ir a Pago
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
```

## Mejores Prácticas

### Validación en Tiempo Real
- Usar `wire:model.live` para campos críticos
- Validar emails, teléfonos y RFCs con regex
- Autocompletar direcciones usando API de SEPOMEX

### Gestión de Archivos
- Validar tipos de archivo (PDF, JPG, PNG)
- Tamaño máximo de 2MB por archivo
- Almacenar en `storage/app/contratos/{contrato_id}/`
- Generar nombres únicos con UUID

### Cálculos Automáticos
- Calcular totales en tiempo real con Livewire
- Aplicar IVA dinámicamente (16%)
- Calcular subtotales de complementos

### Seguridad
- Validar todos los inputs en el servidor
- Sanitizar HTML de plantillas
- Proteger rutas con middleware `auth`
- Firmar URLs de descarga de PDFs

### Performance
- Usar `lazy` loading para archivos subidos
- Cachear colonias por código postal
- Indexar campos de búsqueda (folio, email)
- Paginar listados de contratos

## Pasos de Implementación

1. **Crear migraciones y modelos** (todos los listados arriba)
2. **Implementar ContratoService** con lógica de negocio
3. **Desarrollar componente Livewire** con wizard multi-paso
4. **Crear vistas Blade parciales** para cada paso del formulario
5. **Implementar servicios de PDF** (generación y parser de variables)
6. **Configurar Filament Resource** para panel administrativo
7. **Crear FormRequests** para validación robusta
8. **Implementar sistema de pagos** (Stripe/PayPal/Openpay)
9. **Agregar plantillas editables** desde panel admin
10. **Testing** (Feature y Unit tests)

## Comandos Artisan Útiles

```bash
# Generar modelos con migraciones, factories y seeders
php artisan make:model Contrato -mfs
php artisan make:model Tramitante -mfs

# Generar componente Livewire
php artisan make:livewire ContratoWizard

# Generar Resource de Filament
php artisan make:filament-resource Contrato --generate

# Ejecutar migraciones
php artisan migrate:fresh --seed
```

## Integración con API Externa

### Búsqueda de Códigos Postales (SEPOMEX)
```php
// app/Services/SepomexService.php
public function buscar(string $codigoPostal): array
{
    $response = Http::get("https://api.copomex.com/query/info_cp/{$codigoPostal}", [
        'token' => config('services.copomex.token')
    ]);
    
    return $response->json();
}
```

## Testing

### Feature Test: Creación de Contrato
```php
public function test_usuario_puede_crear_contrato_completo()
{
    $this->actingAs($user = User::factory()->create());
    
    Livewire::test(ContratoWizard::class)
        ->set('tramitante.nombre', 'Juan')
        ->set('tramitante.apellido_paterno', 'Pérez')
        ->set('tramitante.email', 'juan@example.com')
        ->set('tramitante.telefono_1', '5512345678')
        ->set('tramitante.acepto_terminos', true)
        ->call('nextStep')
        // ... más pasos
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect();
    
    $this->assertDatabaseHas('contratos', [
        'estado' => 'borrador',
    ]);
}
```

---

**Nota**: Este prompt proporciona una arquitectura completa. Puedes invocarlopara generar componentes específicos o seguir los pasos en orden para construcción incremental.
