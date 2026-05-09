<?php

namespace App\Filament\Resources\Inmuebles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InmueblesTable
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

                TextColumn::make('direccion_completa')
                    ->label('Dirección')
                    ->searchable(['calle', 'colonia', 'alcaldia_municipio'])
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->direccion_completa),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('alcaldia_municipio')
                    ->label('Municipio/Alcaldía')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('colonia')
                    ->label('Colonia')
                    ->searchable()
                    ->limit(25),

                TextColumn::make('codigo_postal')
                    ->label('C.P.')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('uso_inmueble')
                    ->label('Uso')
                    ->badge()
                    ->colors([
                        'success' => 'habitacional',
                        'warning' => 'comercial',
                        'info' => 'industrial',
                        'gray' => 'mixto',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('created_at')
                    ->label('Registrado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('estado')
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

                SelectFilter::make('uso_inmueble')
                    ->label('Uso del Inmueble')
                    ->options([
                        'habitacional' => 'Habitacional',
                        'comercial' => 'Comercial',
                        'industrial' => 'Industrial',
                        'mixto' => 'Mixto',
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
