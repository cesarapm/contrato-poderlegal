<?php

namespace App\Filament\Resources\Arrendadores\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArrendadoresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contrato.folio')
                    ->label('Contrato')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-document-text')
                    ->url(fn ($record) => $record->contrato ? route('filament.admin.resources.contratos.contratos.edit', $record->contrato) : null),

                TextColumn::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->searchable(['nombre', 'apellido_paterno', 'apellido_materno'])
                    ->sortable()
                    ->weight('bold')
                    ->icon(fn ($record) => $record->tipo_persona === 'moral' ? 'heroicon-o-building-office' : 'heroicon-o-user'),

                TextColumn::make('tipo_persona')
                    ->label('Tipo')
                    ->badge()
                    ->colors([
                        'info' => 'fisica',
                        'warning' => 'moral',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'fisica' => 'Persona Física',
                        'moral' => 'Persona Moral',
                        default => $state,
                    }),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->limit(30),

                TextColumn::make('telefono_1')
                    ->label('Teléfono')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->formatStateUsing(fn (string $state): string => 
                        preg_replace('/(\d{2})(\d{4})(\d{4})/', '$1 $2 $3', $state)
                    ),

                IconColumn::make('tiene_representante_legal')
                    ->label('Rep. Legal')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->alignCenter(),

                IconColumn::make('en_proceso_sucesorio')
                    ->label('Sucesorio')
                    ->boolean()
                    ->trueIcon('heroicon-o-exclamation-triangle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->alignCenter()
                    ->colors([
                        'warning' => true,
                        'gray' => false,
                    ]),

                TextColumn::make('orden')
                    ->label('Orden')
                    ->badge()
                    ->color('gray')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Registrado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('tipo_persona')
                    ->label('Tipo de Persona')
                    ->options([
                        'fisica' => 'Persona Física',
                        'moral' => 'Persona Moral',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
