<?php

namespace App\Filament\Resources\Contratos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use App\Services\GeneradorContratoPdf;
use App\Services\GeneradorPolizaPdf;
use Illuminate\Support\Facades\Storage;

class ContratosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('folio')
                    ->label('Folio')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Folio copiado')
                    ->icon('heroicon-o-document-duplicate'),

                TextColumn::make('tramitante.nombre_completo')
                    ->label('Tramitante')
                    ->searchable(['tramitantes.nombre', 'tramitantes.apellido_paterno'])
                    ->sortable()
                    ->limit(30),

                TextColumn::make('tipo_producto')
                    ->label('Producto')
                    ->badge()
                    ->colors([
                        'gray' => 'basica',
                        'warning' => 'superior',
                        'success' => 'empresarial',
                    ])
                    ->icons([
                        'heroicon-o-document-text' => 'basica',
                        'heroicon-o-star' => 'superior',
                        'heroicon-o-briefcase' => 'empresarial',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'basica' => 'Básica',
                        'superior' => 'Superior',
                        'empresarial' => 'Empresarial',
                        default => $state,
                    }),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->colors([
                        'gray' => 'borrador',
                        'warning' => 'pendiente_pago',
                        'info' => 'pagado',
                        'success' => 'generado',
                        'primary' => 'firmado',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'borrador',
                        'heroicon-o-clock' => 'pendiente_pago',
                        'heroicon-o-check-circle' => 'pagado',
                        'heroicon-o-document-check' => 'generado',
                        'heroicon-o-check-badge' => 'firmado',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'borrador' => 'Borrador',
                        'pendiente_pago' => 'Pendiente Pago',
                        'pagado' => 'Pagado',
                        'generado' => 'Generado',
                        'firmado' => 'Firmado',
                        default => $state,
                    }),

                TextColumn::make('monto_renta_mensual')
                    ->label('Renta Mensual')
                    ->money('MXN')
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('monto_total')
                    ->label('Monto Total')
                    ->money('MXN')
                    ->sortable()
                    ->alignEnd()
                    ->weight('bold'),

                IconColumn::make('incluye_iva')
                    ->label('IVA')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('fecha_inicio')
                    ->label('Inicio')
                    ->date('d/M/Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('fecha_termino')
                    ->label('Término')
                    ->date('d/M/Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('plantilla.nombre')
                    ->label('Plantilla')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(25),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/M/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/M/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->dateTime('d/M/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tipo_producto')
                    ->label('Tipo de Producto')
                    ->options([
                        'basica' => 'Básica',
                        'superior' => 'Superior',
                        'empresarial' => 'Empresarial',
                    ]),
                
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'borrador' => 'Borrador',
                        'pendiente_pago' => 'Pendiente Pago',
                        'pagado' => 'Pagado',
                        'generado' => 'Generado',
                        'firmado' => 'Firmado',
                    ]),
                
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('generar_pdf')
                    ->label('Contrato')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->tooltip('Generar y descargar PDF del contrato')
                    ->action(function ($record) {
                        try {
                            $generador = app(GeneradorContratoPdf::class);
                            $path = $generador->generar($record);

                            Notification::make()
                                ->title('PDF generado correctamente')
                                ->success()
                                ->send();

                            return response()->streamDownload(function () use ($path) {
                                echo Storage::disk('local')->get($path);
                            }, $record->folio . '.pdf', ['Content-Type' => 'application/pdf']);
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error al generar PDF')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),

                Action::make('generar_poliza')
                    ->label('Póliza')
                    ->icon('heroicon-o-shield-check')
                    ->color('warning')
                    ->tooltip('Generar y descargar Póliza Poder Legal')
                    ->action(function ($record) {
                        try {
                            $generador = app(GeneradorPolizaPdf::class);
                            $path = $generador->generar($record);

                            Notification::make()
                                ->title('Póliza generada correctamente')
                                ->success()
                                ->send();

                            return response()->streamDownload(function () use ($path) {
                                echo Storage::disk('local')->get($path);
                            }, $record->folio . '-poliza.pdf', ['Content-Type' => 'application/pdf']);
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error al generar Póliza')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
