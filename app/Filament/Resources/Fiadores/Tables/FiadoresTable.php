<?php

namespace App\Filament\Resources\Fiadores\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FiadoresTable
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

                TextColumn::make('tipo')
                    ->label('Tipo de Fiador')
                    ->badge()
                    ->colors([
                        'success' => 'fiador',
                        'warning' => 'obligado_solidario',
                        'gray' => 'ninguno',
                    ])
                    ->icons([
                        'heroicon-o-shield-check' => 'fiador',
                        'heroicon-o-document-check' => 'obligado_solidario',
                        'heroicon-o-x-circle' => 'ninguno',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'fiador' => 'Fiador',
                        'obligado_solidario' => 'Obligado Solidario',
                        'ninguno' => 'Sin Fiador',
                        default => $state,
                    }),

                TextColumn::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->searchable(['nombre', 'apellido_paterno', 'apellido_materno'])
                    ->sortable()
                    ->weight('bold')
                    ->icon(fn ($record) => $record->tipo_persona === 'moral' ? 'heroicon-o-building-office' : 'heroicon-o-user')
                    ->placeholder('N/A'),

                TextColumn::make('tipo_persona')
                    ->label('Tipo')
                    ->badge()
                    ->colors([
                        'info' => 'fisica',
                        'warning' => 'moral',
                    ])
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'fisica' => 'Persona Física',
                        'moral' => 'Persona Moral',
                        default => 'N/A',
                    })
                    ->placeholder('N/A'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->limit(30)
                    ->placeholder('N/A'),

                TextColumn::make('telefono_1')
                    ->label('Teléfono')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->formatStateUsing(fn (?string $state): string => 
                        $state ? preg_replace('/(\d{2})(\d{4})(\d{4})/', '$1 $2 $3', $state) : 'N/A'
                    )
                    ->placeholder('N/A'),

                TextColumn::make('created_at')
                    ->label('Registrado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('tipo')
                    ->label('Tipo de Fiador')
                    ->options([
                        'fiador' => 'Fiador',
                        'obligado_solidario' => 'Obligado Solidario',
                        'ninguno' => 'Sin Fiador',
                    ]),

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
