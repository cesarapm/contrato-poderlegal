<?php

namespace App\Filament\Resources\Contratos\Pages;

use App\Filament\Resources\Contratos\ContratoResource;
use App\Services\GeneradorContratoPdf;
use App\Services\GeneradorPolizaPdf;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EditContrato extends EditRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generar_pdf')
                ->label('Generar Contrato PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Generar PDF del Contrato')
                ->modalDescription('Se generará el PDF con los datos actuales del contrato y se descargará automáticamente.')
                ->modalSubmitActionLabel('Generar y Descargar')
                ->action(function (): StreamedResponse|null {
                    $contrato = $this->record;

                    try {
                        $generador = app(GeneradorContratoPdf::class);
                        $path = $generador->generar($contrato);

                        Notification::make()
                            ->title('PDF generado correctamente')
                            ->success()
                            ->send();

                        return response()->streamDownload(function () use ($path) {
                            echo Storage::disk('local')->get($path);
                        }, $contrato->folio . '.pdf', [
                            'Content-Type' => 'application/pdf',
                        ]);
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error al generar PDF')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();

                        return null;
                    }
                }),

            Action::make('generar_poliza')
                ->label('Generar Póliza PDF')
                ->icon('heroicon-o-shield-check')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Generar Póliza Poder Legal')
                ->modalDescription('Se generará la Póliza Poder Legal con los datos actuales del contrato y se descargará automáticamente.')
                ->modalSubmitActionLabel('Generar y Descargar')
                ->action(function (): StreamedResponse|null {
                    $contrato = $this->record;

                    try {
                        $generador = app(GeneradorPolizaPdf::class);
                        $path = $generador->generar($contrato);

                        Notification::make()
                            ->title('Póliza generada correctamente')
                            ->success()
                            ->send();

                        return response()->streamDownload(function () use ($path) {
                            echo Storage::disk('local')->get($path);
                        }, $contrato->folio . '-poliza.pdf', [
                            'Content-Type' => 'application/pdf',
                        ]);
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error al generar Póliza')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();

                        return null;
                    }
                }),

            // Action::make('descargar_poliza')
            //     ->label('Descargar Póliza')
            //     ->icon('heroicon-o-arrow-down-tray')
            //     ->color('gray')
            //     ->visible(fn () => $this->record->poliza_pdf_path && Storage::disk('local')->exists($this->record->poliza_pdf_path))
            //     ->action(function (): StreamedResponse {
            //         $contrato = $this->record;
            //         return response()->streamDownload(function () use ($contrato) {
            //             echo Storage::disk('local')->get($contrato->poliza_pdf_path);
            //         }, $contrato->folio . '-poliza.pdf', [
            //             'Content-Type' => 'application/pdf',
            //         ]);
            //     }),

            // Action::make('descargar_pdf')
            //     ->label('Descargar PDF')
            //     ->icon('heroicon-o-arrow-down-tray')
            //     ->color('info')
            //     ->visible(fn () => $this->record->pdf_path && Storage::disk('local')->exists($this->record->pdf_path))
            //     ->action(function (): StreamedResponse {
            //         $contrato = $this->record;
            //         return response()->streamDownload(function () use ($contrato) {
            //             echo Storage::disk('local')->get($contrato->pdf_path);
            //         }, $contrato->folio . '.pdf', [
            //             'Content-Type' => 'application/pdf',
            //         ]);
            //     }),

            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
