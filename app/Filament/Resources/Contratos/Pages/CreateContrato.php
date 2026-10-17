<?php

namespace App\Filament\Resources\Contratos\Pages;

use App\Filament\Resources\Contratos\ContratoResource;
use App\Services\GeneradorContratoPdf;
use App\Services\CalculadoraPrecioPoliza;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateContrato extends CreateRecord
{
    protected static string $resource = ContratoResource::class;

    protected ?bool $hasDatabaseTransactions = true;

    protected bool $pdfGenerado = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $renta = (float) $data['monto_renta_mensual'];
        $desglose = app(CalculadoraPrecioPoliza::class)->obtenerDesglose($renta);
        $precio = (float) ($data['poliza_precio_completa'] ?: $desglose['precio_sin_iva']);
        $incluyeIvaPoliza = (bool) ($data['poliza_incluye_iva'] ?? true);
        $ivaPoliza = $incluyeIvaPoliza ? round($precio * 0.16, 2) : 0;

        $data['poliza_precio_completa'] = $precio;
        $data['poliza_subtotal'] = $ivaPoliza;
        $data['poliza_total'] = $precio + $ivaPoliza;
        $data['monto_total'] = $desglose['precio_con_iva'];
        $data['datos_renta'] = [
            'monto_mensual' => $renta,
            'incluye_iva' => (bool) ($data['incluye_iva'] ?? false),
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_termino' => $data['fecha_termino'],
            'forma_pago' => $data['forma_pago'] ?? 'efectivo',
            'banco' => $data['banco'] ?? null,
            'cuenta' => $data['cuenta'] ?? null,
            'clabe' => $data['clabe'] ?? null,
            'beneficiario' => $data['beneficiario'] ?? null,
        ];
        $data['servicios_inmueble'] ??= [];
        $data['estado'] ??= 'borrador';
        unset($data['poliza_incluye_iva']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $inmueble = $this->record->inmueble;

        if ($inmueble) {
            $direccion = array_filter([
                'calle' => $inmueble->calle,
                'numero_exterior' => $inmueble->numero_exterior,
                'numero_interior' => $inmueble->numero_interior,
                'colonia' => $inmueble->colonia,
                'municipio' => $inmueble->alcaldia_municipio,
                'estado' => $inmueble->estado,
                'codigo_postal' => $inmueble->codigo_postal,
            ], fn ($value) => filled($value));

            $this->record->arrendatarios()->update(['domicilio_notificaciones' => json_encode($direccion)]);
            $this->record->arrendadores()->update(['direccion' => json_encode($direccion)]);
        }

        try {
            app(GeneradorContratoPdf::class)->generar($this->record);
            $this->pdfGenerado = true;
        } catch (\Throwable $exception) {
            report($exception);

            Notification::make()
                ->title('Contrato creado; no se pudo generar el PDF')
                ->body('Puedes revisar la plantilla y volver a generarlo desde la tabla de Contratos.')
                ->warning()
                ->send();
        }
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return $this->pdfGenerado
            ? 'Contrato y PDF generados correctamente'
            : 'Contrato creado correctamente';
    }
}
