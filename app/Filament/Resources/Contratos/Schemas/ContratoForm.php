<?php

namespace App\Filament\Resources\Contratos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContratoForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información General')
                    ->schema([
                        TextInput::make('numero_poliza')
                            ->label('Número de Póliza')
                            ->required()
                            ->placeholder('Ej: POL-2026-001')
                            ->helperText('Este número aparecerá en el campo PÓLIZA del PDF')
                            ->columnSpan(1),
                        
                        TextInput::make('folio')
                            ->label('Número de Contrato')
                            ->disabled()
                            ->dehydrated()
                            ->placeholder('Se genera automáticamente')
                            ->helperText('Se genera automáticamente como CON-XXXXXXXX')
                            ->columnSpan(1),
                        
                        Select::make('estado')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'pendiente_pago' => 'Pendiente de Pago',
                                'pagado' => 'Pagado',
                                'generado' => 'Generado',
                                'firmado' => 'Firmado',
                            ])
                            ->default('borrador')
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make('Tramitante y Producto')
                    ->schema([
                        Select::make('tramitante_id')
                            ->label('Tramitante')
                            ->relationship('tramitante', 'nombre')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('nombre')->required(),
                                TextInput::make('apellido_paterno')->required(),
                                TextInput::make('apellido_materno'),
                                TextInput::make('telefono_1')->required(),
                                TextInput::make('email')->email()->required(),
                                TextInput::make('inmobiliaria')
                                    ->label('Inmobiliaria')
                                    ->placeholder('Nombre de la inmobiliaria (si aplica)')
                                    ->helperText('Opcional: Si el asesor pertenece a una inmobiliaria'),
                            ])
                            ->columnSpan(1),

                        Select::make('tipo_producto')
                            ->label('Tipo de Cobertura')
                            ->options([
                                'basica' => 'Básica',
                                'superior' => 'Superior',
                                'premium' => 'Premium',
                                'empresarial' => 'Empresarial',
                            ])
                            ->required()
                            ->helperText('Este valor aparecerá como COBERTURA en el PDF')
                            ->columnSpan(1),

                        // Select::make('plantilla_id')
                        //     ->label('Plantilla de Contrato')
                        //     ->relationship('plantilla', 'nombre', fn($query) => $query->where('activa', true))
                        //     ->searchable()
                        //     ->preload()
                        //     ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make('Fechas y Montos')
                    ->schema([
                        DatePicker::make('fecha_inicio')
                            ->label('Fecha de Inicio')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),

                        DatePicker::make('fecha_termino')
                            ->label('Fecha de Término')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),

                        TextInput::make('monto_renta_mensual')
                            ->label('Renta Mensual')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->columnSpan(1),

                        TextInput::make('monto_total')
                            ->label('Monto Total')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->columnSpan(1),

                        Toggle::make('incluye_iva')
                            ->label('Incluye IVA')
                            ->inline(false)
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make('Datos de Cobertura de Póliza')
                    ->description('Estos montos aparecen en la tabla de DATOS DE COBERTURA del PDF')
                    ->schema([
                        Toggle::make('poliza_incluye_iva')
                            ->label('La póliza incluye IVA')
                            ->inline(false)
                            ->default(true)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $precio = floatval($get('poliza_precio_completa') ?? 0);
                                
                                if ($state) {
                                    // Con IVA
                                    $iva = $precio * 0.16;
                                    $total = $precio + $iva;
                                } else {
                                    // Sin IVA
                                    $iva = 0;
                                    $total = $precio;
                                }
                                
                                $set('poliza_subtotal', number_format($iva, 2, '.', ''));
                                $set('poliza_total', number_format($total, 2, '.', ''));
                            })
                            ->columnSpan(3),

                        TextInput::make('poliza_precio_completa')
                            ->label('Precio Completo')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $precio = floatval($state ?? 0);
                                $incluyeIva = $get('poliza_incluye_iva') ?? true;
                                
                                if ($incluyeIva) {
                                    $iva = $precio * 0.16;
                                    $total = $precio + $iva;
                                } else {
                                    $iva = 0;
                                    $total = $precio;
                                }
                                
                                $set('poliza_subtotal', number_format($iva, 2, '.', ''));
                                $set('poliza_total', number_format($total, 2, '.', ''));
                            })
                            ->helperText('Ingrese el precio base de la póliza.')
                            ->columnSpan(1),

                        TextInput::make('poliza_subtotal')
                            ->label('IVA (16%)')
                            ->numeric()
                            ->prefix('$')
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Se calcula automáticamente si aplica IVA')
                            ->columnSpan(1),

                        TextInput::make('poliza_total')
                            ->label('Total')
                            ->numeric()
                            ->prefix('$')
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Precio completo + IVA (si aplica)')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->collapsible(),

                Section::make('Complementos y Servicios')
                    ->schema([
                        // KeyValue::make('complementos')
                        //     ->label('Complementos del Contrato')
                        //     ->keyLabel('Concepto')
                        //     ->valueLabel('Valor')
                        //     ->reorderable()
                        //     ->columnSpanFull(),

                        KeyValue::make('datos_renta')
                            ->label('Datos de Renta')
                            ->keyLabel('Campo')
                            ->valueLabel('Información')
                            ->reorderable()
                            ->columnSpanFull(),

                        KeyValue::make('servicios_inmueble')
                            ->label('Servicios del Inmueble')
                            ->keyLabel('Servicio')
                            ->valueLabel('Detalle')
                            ->reorderable()
                            ->columnSpanFull(),

                        Textarea::make('observaciones')
                            ->label('Observaciones')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
