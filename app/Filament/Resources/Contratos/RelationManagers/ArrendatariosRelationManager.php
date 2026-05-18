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

class ArrendatariosRelationManager extends RelationManager
{
    protected static string $relationship = 'arrendatarios';

    protected static ?string $title = 'Arrendatarios';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Arrendatario')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('tipo_persona')
                                    ->label('Tipo de Persona')
                                    ->required()
                                    ->options([
                                        'fisica' => 'Persona Física',
                                        'moral' => 'Persona Moral',
                                    ])
                                    ->default('fisica')
                                    ->live(),

                                TextInput::make('orden')
                                    ->label('Orden')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->helperText('Orden en el contrato (1, 2, 3...)'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('nombre')
                                    ->label('Nombre')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('apellido_paterno')
                                    ->label('Apellido Paterno')
                                    ->required()
                                    ->maxLength(50),

                                TextInput::make('apellido_materno')
                                    ->label('Apellido Materno')
                                    ->maxLength(50),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('telefono_1')
                                    ->label('Teléfono Principal')
                                    ->required()
                                    ->tel()
                                    ->maxLength(15),

                                TextInput::make('telefono_2')
                                    ->label('Teléfono Secundario')
                                    ->tel()
                                    ->maxLength(15),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->required()
                                    ->email()
                                    ->maxLength(100),
                            ]),
                    ]),

                Section::make('Acta Constitutiva')
                    ->visible(fn ($get) => $get('tipo_persona') === 'moral')
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
                    ->visible(fn ($get) => $get('tipo_persona') === 'moral')
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
                TextColumn::make('orden')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->formatStateUsing(fn ($record) => trim("{$record->nombre} {$record->apellido_paterno} {$record->apellido_materno}")),
                TextColumn::make('tipo_persona')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fisica' => 'success',
                        'moral' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('telefono_1')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
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

