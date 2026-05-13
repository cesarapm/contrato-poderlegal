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
                                    ->reactive(),

                                TextInput::make('orden')
                                    ->label('Orden')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->helperText('Orden en el contrato (1, 2, 3...)'),
                            ]),

                        Grid::make(3)
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

                        Grid::make(3)
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
