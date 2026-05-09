<?php

namespace App\Filament\Resources\Inmuebles\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InmuebleForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Inmueble')
                    ->schema([
                        Select::make('contrato_id')
                            ->label('Contrato')
                            ->relationship('contrato', 'folio')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Grid::make(3)
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

                        Grid::make(3)
                            ->schema([
                                TextInput::make('numero_exterior')
                                    ->label('Número Exterior')
                                    ->required()
                                    ->maxLength(20),

                                TextInput::make('numero_interior')
                                    ->label('Número Interior')
                                    ->maxLength(20),

                                TextInput::make('edificio')
                                    ->label('Edificio')
                                    ->maxLength(50),
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
                    ]),
            ]);
    }
}
