<?php

namespace App\Filament\Resources\Contratos\RelationManagers;

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

class InmuebleRelationManager extends RelationManager
{
    protected static string $relationship = 'inmueble';

    protected static ?string $title = 'Inmueble';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Inmueble')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('codigo_postal')
                                    ->label('Código Postal')
                                    ->required()
                                    ->maxLength(5)
                                    ->numeric(),

                                Select::make('estado')
                                    ->label('Estado')
                                    ->required()
                                    ->searchable()
                                    ->options([
                                        'Aguascalientes' => 'Aguascalientes',
                                        'Baja California' => 'Baja California',
                                        'Baja California Sur' => 'Baja California Sur',
                                        'Campeche' => 'Campeche',
                                        'Chiapas' => 'Chiapas',
                                        'Chihuahua' => 'Chihuahua',
                                        'Ciudad de México' => 'Ciudad de México',
                                        'Coahuila' => 'Coahuila',
                                        'Colima' => 'Colima',
                                        'Durango' => 'Durango',
                                        'Guanajuato' => 'Guanajuato',
                                        'Guerrero' => 'Guerrero',
                                        'Hidalgo' => 'Hidalgo',
                                        'Jalisco' => 'Jalisco',
                                        'México' => 'México',
                                        'Michoacán' => 'Michoacán',
                                        'Morelos' => 'Morelos',
                                        'Nayarit' => 'Nayarit',
                                        'Nuevo León' => 'Nuevo León',
                                        'Oaxaca' => 'Oaxaca',
                                        'Puebla' => 'Puebla',
                                        'Querétaro' => 'Querétaro',
                                        'Quintana Roo' => 'Quintana Roo',
                                        'San Luis Potosí' => 'San Luis Potosí',
                                        'Sinaloa' => 'Sinaloa',
                                        'Sonora' => 'Sonora',
                                        'Tabasco' => 'Tabasco',
                                        'Tamaulipas' => 'Tamaulipas',
                                        'Tlaxcala' => 'Tlaxcala',
                                        'Veracruz' => 'Veracruz',
                                        'Yucatán' => 'Yucatán',
                                        'Zacatecas' => 'Zacatecas',
                                    ]),

                                TextInput::make('alcaldia_municipio')
                                    ->label('Alcaldía/Municipio')
                                    ->required()
                                    ->maxLength(100),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('colonia')
                                    ->label('Colonia')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('calle')
                                    ->label('Calle')
                                    ->required()
                                    ->maxLength(150),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('numero_exterior')
                                    ->label('Número Exterior')
                                    ->required()
                                    ->maxLength(20),

                                TextInput::make('numero_interior')
                                    ->label('Número Interior')
                                    ->maxLength(20),

                                // TextInput::make('edificio')
                                //     ->label('Edificio')
                                //     ->maxLength(50),
                            ]),

                        Select::make('uso_inmueble')
                            ->label('Uso del Inmueble')
                            ->required()
                            ->options([
                                'habitacional' => 'Habitacional',
                                'comercial' => 'Comercial',
                                'industrial' => 'Industrial',
                                'mixto' => 'Mixto',
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('calle')
                    ->label('Calle')
                    ->searchable(),
                TextColumn::make('numero_exterior')
                    ->label('Nº Ext.')
                    ->searchable(),
                TextColumn::make('colonia')
                    ->label('Colonia')
                    ->searchable(),
                TextColumn::make('alcaldia_municipio')
                    ->label('Alcaldía/Municipio')
                    ->searchable(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge(),
                TextColumn::make('codigo_postal')
                    ->label('C.P.'),
                TextColumn::make('uso_inmueble')
                    ->label('Uso')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'habitacional' => 'success',
                        'comercial' => 'warning',
                        'industrial' => 'danger',
                        'mixto' => 'info',
                        default => 'gray',
                    }),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
