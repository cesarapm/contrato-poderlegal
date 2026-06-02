<?php

namespace App\Filament\Resources\Contratos\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FiadorRelationManager extends RelationManager
{
    protected static string $relationship = 'fiador';

    protected static ?string $title = 'Fiador / Obligado Solidario';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Fiador')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('tipo')
                                    ->label('Tipo de Fiador')
                                    ->required()
                                    ->options([
                                        'fiador' => 'Fiador',
                                        'obligado_solidario' => 'Obligado Solidario',
                                        'ninguno' => 'Sin Fiador',
                                    ])
                                    ->default('fiador')
                                    ->live(),

                                Select::make('tipo_persona')
                                    ->label('Tipo de Persona')
                                    ->options([
                                        'fisica' => 'Persona Física',
                                        'moral' => 'Persona Moral',
                                    ])
                                    ->default('fisica')
                                    ->live()
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('nombre')
                                    ->label('Nombre')
                                    ->maxLength(100)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('apellido_paterno')
                                    ->label('Apellido Paterno')
                                    ->maxLength(50)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('apellido_materno')
                                    ->label('Apellido Materno')
                                    ->maxLength(50)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('telefono_1')
                                    ->label('Teléfono Principal')
                                    ->tel()
                                    ->maxLength(15)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('telefono_2')
                                    ->label('Teléfono Secundario')
                                    ->tel()
                                    ->maxLength(15)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(100)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                Select::make('estado_civil')
                                    ->label('Estado Civil')
                                    ->options([
                                        'SOLTERO' => 'Soltero',
                                        'CASADO' => 'Casado',
                                        'DIVORCIADO' => 'Divorciado',
                                        'VIUDO' => 'Viudo',
                                        'UNION_LIBRE' => 'Unión Libre',
                                    ])
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('nacionalidad')
                                    ->label('Nacionalidad')
                                    ->default('México')
                                    ->maxLength(100)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('numero_inm')
                                    ->label('Número INM')
                                    ->helperText('Solo para extranjeros con residencia permanente')
                                    ->maxLength(50)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),

                                TextInput::make('numero_ine')
                                    ->label('Número de INE')
                                    ->helperText('Opcional - Credencial de elector')
                                    ->maxLength(50)
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),
                            ]),
                    ]),

                Section::make('Dirección del Fiador')
                    ->visible(fn ($get) => $get('tipo') !== 'ninguno')
                    ->schema([
                        TextInput::make('domicilio')
                            ->label('Calle y Número')
                            ->maxLength(255)
                            ->placeholder('Avenida Insurgentes Sur 123, Colonia Roma'),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('codigo_postal')
                                    ->label('Código Postal')
                                    ->maxLength(10),

                                TextInput::make('ciudad')
                                    ->label('Alcaldía / Municipio')
                                    ->maxLength(100),

                                TextInput::make('estado')
                                    ->label('Estado')
                                    ->maxLength(100),
                            ]),

                        TextInput::make('pais')
                            ->label('País')
                            ->default('México')
                            ->maxLength(100),
                    ]),

                Section::make('Acta Constitutiva')
                    ->visible(fn ($get) => $get('tipo') !== 'ninguno' && $get('tipo_persona') === 'moral')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('no_acta_constitutiva')
                                    ->label('No. de acta constitutiva')
                                    ->maxLength(50),

                                DatePicker::make('fecha_acta_constitutiva')
                                    ->label('Fecha del acta constitutiva')
                                    ->native(false),

                                DatePicker::make('fecha_registro_acta')
                                    ->label('Fecha de registro')
                                    ->native(false),

                                TextInput::make('estado_inscrita')
                                    ->label('Estado donde está inscrita')
                                    ->maxLength(100),
                            ]),

                        Grid::make(4)
                            ->schema([
                                TextInput::make('nombre_notario')
                                    ->label('Nombre del notario público')
                                    ->columnSpan(2)
                                    ->maxLength(150),

                                TextInput::make('no_notario')
                                    ->label('No. de notario')
                                    ->maxLength(20),

                                TextInput::make('estado_notario')
                                    ->label('Estado del notario')
                                    ->maxLength(100),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('ciudad_notario')
                                    ->label('Ciudad del notario')
                                    ->maxLength(100),

                                TextInput::make('folio_mercantil')
                                    ->label('Folio mercantil')
                                    ->maxLength(100),
                            ]),

                        Radio::make('poder_en_acta')
                            ->label('¿El poder del representante está en el acta constitutiva?')
                            ->options([1 => 'Sí', 0 => 'No'])
                            ->inline(),

                        FileUpload::make('acta_constitutiva_path')
                            ->label('Copia del acta constitutiva')
                            ->disk('public')
                            ->directory('actas')
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->maxSize(5120)->downloadable()->openable()->nullable(),
                    ]),

                Section::make('Documentos adicionales (persona moral)')
                    ->visible(fn ($get) => $get('tipo') !== 'ninguno' && $get('tipo_persona') === 'moral')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('poderes_representante_path')
                                    ->label('Poderes del representante legal')
                                    ->disk('public')
                                    ->directory('poderes')
                                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                    ->maxSize(5120)->downloadable()->openable()->nullable(),

                                FileUpload::make('constancia_situacion_fiscal_path')
                                    ->label('Constancia de situación fiscal')
                                    ->disk('public')
                                    ->directory('constancias')
                                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                    ->maxSize(5120)->downloadable()->openable()->nullable(),
                            ]),
                    ]),

                Section::make('Documentos generales')
                    ->visible(fn ($get) => $get('tipo') !== 'ninguno')
                    ->schema([
                        FileUpload::make('comprobantes_ingresos')
                            ->label('Comprobantes de ingresos (últimos 3 meses)')
                            ->disk('public')
                            ->directory('comprobantes')
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->multiple()
                            ->maxSize(5120)->downloadable()->openable()->nullable(),

                        FileUpload::make('ine_paths')
                            ->label('INE / Identificación oficial')
                            ->disk('public')
                            ->directory('ines')
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->multiple()
                            ->maxSize(5120)->downloadable()->openable()->nullable(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fiador' => 'warning',
                        'obligado_solidario' => 'danger',
                        'ninguno' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->formatStateUsing(fn ($record) => trim("{$record->nombre} {$record->apellido_paterno} {$record->apellido_materno}")),
                TextColumn::make('tipo_persona')
                    ->label('Persona')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fisica' => 'success',
                        'moral' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('telefono_1')
                    ->label('Teléfono'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('nacionalidad')
                    ->label('Nacionalidad')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('numero_ine')
                    ->label('INE')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ciudad')
                    ->label('Ciudad')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()
                    ->modalWidth('7xl'),
            ])
            ->actions([
                EditAction::make()
                    ->modalWidth('7xl'),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

