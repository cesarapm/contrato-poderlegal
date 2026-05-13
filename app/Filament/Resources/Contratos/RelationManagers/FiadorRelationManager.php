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
