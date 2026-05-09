<?php

namespace App\Filament\Resources\Fiadores\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FiadorForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Fiador')
                    ->schema([
                        Select::make('contrato_id')
                            ->label('Contrato')
                            ->relationship('contrato', 'folio')
                            ->searchable()
                            ->preload()
                            ->required(),

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
                                    ->reactive(),

                                Select::make('tipo_persona')
                                    ->label('Tipo de Persona')
                                    ->options([
                                        'fisica' => 'Persona Física',
                                        'moral' => 'Persona Moral',
                                    ])
                                    ->default('fisica')
                                    ->reactive()
                                    ->visible(fn ($get) => $get('tipo') !== 'ninguno'),
                            ]),

                        Grid::make(3)
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

                        Grid::make(3)
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
                            ]),
                    ]),
            ]);
    }
}
