<?php

namespace App\Filament\Resources\Contratos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ContratoCreateWizardForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->schema([
            Wizard::make([
                Step::make('Tramitante y producto')->icon('heroicon-o-user')
                    ->description('Quién solicita el contrato y qué cobertura necesita')
                    ->schema([
                        Select::make('tramitante_id')->label('Tramitante')->relationship('tramitante', 'nombre')
                            ->searchable()->preload()->required()
                            ->createOptionForm([
                                TextInput::make('nombre')->required(),
                                TextInput::make('apellido_paterno')->required(),
                                TextInput::make('apellido_materno'),
                                TextInput::make('telefono_1')->tel()->required(),
                                TextInput::make('telefono_2')->tel(),
                                TextInput::make('email')->email()->required(),
                                TextInput::make('inmobiliaria')->label('Inmobiliaria'),
                                Select::make('tipo_solicitante')->label('Tipo de solicitante')->options([
                                    'asesor' => 'Asesor', 'propietario' => 'Propietario',
                                ])->default('asesor')->required(),
                                Toggle::make('es_independiente')->label('Asesor independiente')->default(false),
                            ])
                            ->editOptionForm([
                                TextInput::make('nombre')->required(),
                                TextInput::make('apellido_paterno')->required(),
                                TextInput::make('apellido_materno'),
                                TextInput::make('telefono_1')->tel()->required(),
                                TextInput::make('telefono_2')->tel(),
                                TextInput::make('email')->email()->required(),
                                TextInput::make('inmobiliaria')->label('Inmobiliaria'),
                                Select::make('tipo_solicitante')->label('Tipo de solicitante')->options([
                                    'asesor' => 'Asesor', 'propietario' => 'Propietario',
                                ])->required(),
                                Toggle::make('es_independiente')->label('Asesor independiente'),
                            ]),
                        Select::make('tipo_producto')->label('Tipo de cobertura')->options([
                            'superior' => 'Completa',
                        ])->default('superior')
                        ->required()->native(false),
                    ])->columns(2),

                Step::make('Renta y vigencia')->icon('heroicon-o-calendar')
                    ->description('Datos económicos y fechas del arrendamiento')
                    ->schema([
                        TextInput::make('monto_renta_mensual')->label('Renta mensual')->numeric()->prefix('$')->required(),
                        Toggle::make('incluye_iva')->label('La renta incluye IVA')->default(false),
                        DatePicker::make('fecha_inicio')->label('Fecha de inicio')->native(false)->required(),
                        DatePicker::make('fecha_termino')->label('Fecha de término')->native(false)->required()->after('fecha_inicio'),
                        Toggle::make('incluye_mantenimiento')->label('Incluye mantenimiento')->live(),
                        TextInput::make('costo_mantenimiento')->label('Costo mensual de mantenimiento')->numeric()->prefix('$')
                            ->visible(fn ($get) => $get('incluye_mantenimiento'))
                            ->required(fn ($get) => $get('incluye_mantenimiento')),
                        Select::make('forma_pago')->label('Forma de pago')->options([
                            'efectivo' => 'Efectivo', 'transferencia' => 'Transferencia bancaria',
                        ])->default('efectivo')->required()->live(),
                        TextInput::make('banco')->label('Banco')->visible(fn ($get) => $get('forma_pago') === 'transferencia')->required(fn ($get) => $get('forma_pago') === 'transferencia'),
                        TextInput::make('beneficiario')->label('Beneficiario')->visible(fn ($get) => $get('forma_pago') === 'transferencia'),
                        TextInput::make('cuenta')->label('Número de cuenta')->visible(fn ($get) => $get('forma_pago') === 'transferencia'),
                        TextInput::make('clabe')->label('CLABE')->length(18)->visible(fn ($get) => $get('forma_pago') === 'transferencia'),
                        CheckboxList::make('servicios_inmueble')->label('Servicios incluidos')->options([
                            'agua' => 'Agua', 'luz' => 'Luz', 'gas' => 'Gas', 'internet' => 'Internet', 'seguridad' => 'Seguridad',
                        ])->columns(3)->columnSpanFull(),
                        TextInput::make('poliza_precio_completa')->label('Precio de póliza')->numeric()->prefix('$')->default(0),
                        Toggle::make('poliza_incluye_iva')->label('La póliza incluye IVA')->default(true),
                        Textarea::make('observaciones')->label('Observaciones')->rows(3)->columnSpanFull(),
                    ])->columns(2),

                Step::make('Inmueble')->icon('heroicon-o-home')
                    ->description('Domicilio y características del inmueble')
                    ->schema([
                        Group::make()->relationship('inmueble')->schema([
                            TextInput::make('codigo_postal')->label('Código postal')->required()->maxLength(10),
                            Select::make('estado')->label('Estado')->searchable()->options(self::estados())->required(),
                            TextInput::make('alcaldia_municipio')->label('Alcaldía o municipio')->required(),
                            TextInput::make('colonia')->required(),
                            TextInput::make('calle')->required(),
                            TextInput::make('numero_exterior')->label('Número exterior')->required(),
                            TextInput::make('edificio')->label('Edificio'),
                            TextInput::make('numero_interior')->label('Número interior'),
                            Select::make('uso_inmueble')->label('Uso del inmueble')->options([
                                'habitacional' => 'Habitacional', 'comercial' => 'Comercial', 'industrial' => 'Industrial', 'mixto' => 'Mixto',
                            ])->default('habitacional')->required(),
                            TextInput::make('numero_estacionamientos')->label('Estacionamientos')->numeric()->default(0),
                        ])->columns(2),
                    ]),

                Step::make('Arrendatario(s)')->icon('heroicon-o-users')
                    ->description('Agrega la información de la persona física o moral arrendataria')
                    ->schema([Repeater::make('arrendatarios')->relationship()->label('Arrendatario')->minItems(1)->maxItems(1)->defaultItems(1)
                        ->schema(self::partyFields(true))->columns(2)
                    ]),

                Step::make('Arrendador(es)')->icon('heroicon-o-user-group')
                    ->description('Agrega la información de la persona arrendadora')
                    ->schema([Repeater::make('arrendadores')->relationship()->label('Arrendador')->minItems(1)->maxItems(1)->defaultItems(1)
                        ->schema(self::partyFields(false))->columns(2)
                    ]),

                Step::make('Fiador y revisión')->icon('heroicon-o-shield-check')
                    ->description('El fiador es opcional. Revisa la información antes de guardar.')
                    ->schema([
                        // Select::make('fiador_tipo')->label('Fiador')->options(['ninguno' => 'Sin fiador', 'persona' => 'Persona física', 'empresa' => 'Persona moral'])
                        //     ->default('ninguno')->live()->dehydrated(false)
                        //     ->afterStateUpdated(fn ($state, $set) => $set('fiador.tipo_persona', $state === 'empresa' ? 'moral' : 'fisica')),
                        Group::make()->relationship('fiador')->schema([
                            Hidden::make('tipo')->default('fiador'),
                            Select::make('tipo_persona')->label('Tipo de persona')->options(['fisica' => 'Física', 'moral' => 'Moral'])
                                ->default('fisica')->live()->required(),
                            TextInput::make('nombre')->label('Nombre o razón social')->required(),
                            TextInput::make('apellido_paterno')->label('Apellido paterno')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
                            TextInput::make('apellido_materno')->label('Apellido materno')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
                            TextInput::make('telefono_1')->label('Teléfono')->tel()->required(),
                            TextInput::make('email')->email(),
                            TextInput::make('estado_civil')->label('Estado civil')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
                            TextInput::make('nacionalidad')->default('México'),
                            TextInput::make('numero_ine')->label('Número de INE'),
                            TextInput::make('curp')->label('CURP'),
                            TextInput::make('razon_social')->label('Razón social')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('rfc')->label('RFC')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('direccion_empresa')->label('Dirección de la empresa')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('representante_legal_nombre')->label('Nombre del representante legal')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('representante_legal_email')->label('Correo del representante')->email()->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('representante_legal_telefono')->label('Teléfono del representante')->tel()->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('representante_legal_numero_ine')->label('INE del representante')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('representante_legal_curp')->label('CURP del representante')->maxLength(18)->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('no_acta_constitutiva')->label('No. de acta constitutiva')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            DatePicker::make('fecha_acta_constitutiva')->label('Fecha del acta constitutiva')->native(false)->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            DatePicker::make('fecha_registro_acta')->label('Fecha de registro')->native(false)->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('estado_inscrita')->label('Estado donde está inscrita')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('nombre_notario')->label('Nombre completo del notario público')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('no_notario')->label('No. de notario')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('estado_notario')->label('Estado del notario')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('ciudad_notario')->label('Ciudad del notario')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('folio_mercantil')->label('Datos de registro (folio mercantil)')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            Radio::make('poder_en_acta')->label('¿El poder del representante está otorgado en el acta constitutiva?')
                                ->options([1 => 'Sí', 0 => 'No'])->default(1)->inline()->visible(fn ($get) => $get('tipo_persona') === 'moral'),
                            TextInput::make('domicilio')->label('Domicilio'),
                            TextInput::make('ciudad')->label('Ciudad'),
                            TextInput::make('estado')->label('Estado'),
                            TextInput::make('codigo_postal')->label('Código postal'),
                            TextInput::make('pais')->default('México'),
                        ])->columns(2)->visible(fn ($get) => $get('../fiador_tipo') !== 'ninguno'),
                    ]),
            ])->columnSpanFull()->skippable(false),
        ]);
    }

    private static function partyFields(bool $isTenant): array
    {
        return [
            Select::make('tipo_persona')->label('Tipo de persona')->options(['fisica' => 'Persona física', 'moral' => 'Persona moral'])->default('fisica')->required()->live(),
            // TextInput::make('orden')->label('Orden')->numeric()->default(1)->required(),
            TextInput::make('nombre')->label(fn ($get) => $get('tipo_persona') === 'moral' ? 'Nombre del representante/contacto' : 'Nombre')->required(),
            TextInput::make('apellido_paterno')->label('Apellido paterno')->required(fn ($get) => $get('tipo_persona') === 'fisica')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
            TextInput::make('apellido_materno')->label('Apellido materno')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
            TextInput::make('telefono_1')->label('Teléfono de contacto')->tel()->required(),
            TextInput::make('telefono_2')->label('Teléfono secundario')->tel()->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
            TextInput::make('email')->label('Correo de contacto')->email()->required(),
            TextInput::make('numero_ine')->label('Número de INE')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
            TextInput::make('curp')->label('CURP')->visible(fn ($get) => $get('tipo_persona') === 'fisica'),
            TextInput::make('razon_social')->label('Razón social')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('rfc')->label('RFC')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('direccion_empresa')->label('Dirección de la empresa')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('representante_legal_nombre')->label('Representante legal')->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('representante_legal_email')->label('Correo del representante')->email()->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('representante_legal_telefono')->label('Teléfono del representante')->tel()->required(fn ($get) => $get('tipo_persona') === 'moral')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('representante_legal_numero_ine')->label('INE del representante')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('representante_legal_curp')->label('CURP del representante')->maxLength(18)->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('no_acta_constitutiva')->label('No. de acta constitutiva')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            DatePicker::make('fecha_acta_constitutiva')->label('Fecha del acta constitutiva')->native(false)->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            DatePicker::make('fecha_registro_acta')->label('Fecha de registro')->native(false)->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('estado_inscrita')->label('Estado donde está inscrita')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('nombre_notario')->label('Nombre completo del notario público')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('no_notario')->label('No. de notario')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('estado_notario')->label('Estado del notario')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('ciudad_notario')->label('Ciudad del notario')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            TextInput::make('folio_mercantil')->label('Datos de registro (folio mercantil)')->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            Radio::make('poder_en_acta')->label('¿El poder del representante está otorgado en el acta constitutiva?')
                ->options([1 => 'Sí', 0 => 'No'])->default(1)->inline()->visible(fn ($get) => $get('tipo_persona') === 'moral'),
            ...($isTenant
                ? [Hidden::make('domicilio_notificaciones')->default([])]
                : [Hidden::make('direccion')->default([])]),
        ];
    }

    private static function estados(): array
    {
        return array_combine($estados = ['Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Chiapas', 'Chihuahua', 'Ciudad de México', 'Coahuila', 'Colima', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'], $estados);
    }
}
