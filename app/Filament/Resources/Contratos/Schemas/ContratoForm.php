<?php

namespace App\Filament\Resources\Contratos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ContratoForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Datos del Contrato')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Información General')
                                    ->schema([
                                        TextInput::make('folio')
                                            ->label('Folio')
                                            ->disabled()
                                            ->dehydrated()
                                            ->placeholder('Se genera automáticamente')
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
                                            ->columnSpan(1),
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
                                            ])
                                            ->columnSpan(1),

                                        Select::make('tipo_producto')
                                            ->label('Tipo de Producto')
                                            ->options([
                                                'basica' => '📄 Básica',
                                                'superior' => '⭐ Superior',
                                                'empresarial' => '💼 Empresarial',
                                            ])
                                            ->required()
                                            ->columnSpan(1),

                                        Select::make('plantilla_id')
                                            ->label('Plantilla de Contrato')
                                            ->relationship('plantilla', 'nombre', fn($query) => $query->where('activa', true))
                                            ->searchable()
                                            ->preload()
                                            ->columnSpan(2),
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

                                Section::make('Complementos y Servicios')
                                    ->schema([
                                        KeyValue::make('complementos')
                                            ->label('Complementos del Contrato')
                                            ->keyLabel('Concepto')
                                            ->valueLabel('Valor')
                                            ->reorderable()
                                            ->columnSpanFull(),

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
                            ]),

                        Tabs\Tab::make('Inmueble')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Placeholder::make('inmueble_info')
                                    ->label('')
                                    ->content('Los datos del inmueble se gestionan en la relación una vez creado el contrato.')
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Arrendatarios')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                Placeholder::make('arrendatarios_info')
                                    ->label('')
                                    ->content('Los arrendatarios se gestionan en la relación una vez creado el contrato.')
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Arrendadores')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Placeholder::make('arrendadores_info')
                                    ->label('')
                                    ->content('Los arrendadores se gestionan en la relación una vez creado el contrato.')
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Fiador')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Placeholder::make('fiador_info')
                                    ->label('')
                                    ->content('El fiador se gestiona en la relación una vez creado el contrato.')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
