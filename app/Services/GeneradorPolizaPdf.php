<?php

namespace App\Services;

use App\Models\Contrato;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class GeneradorPolizaPdf
{
    public function generar(Contrato $contrato): string
    {
        $contrato->load(['tramitante', 'arrendadores', 'arrendatarios', 'inmueble']);

        $plantilla = \App\Models\PlantillaContrato::where('slug', 'poliza-poder-legal')->first();

        if (!$plantilla) {
            throw new \Exception('No se encontró la plantilla de la póliza. Ejecuta: php artisan db:seed --class=PlantillaPolizaSeeder');
        }

        $html = $plantilla->contenido_html;

        // Incrustar el logo como base64 para que DomPDF lo renderice correctamente
        $logoPath = public_path('logo.png');
        if (file_exists($logoPath)) {
            $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        } else {
            $logoBase64 = '';
        }
        $html = str_replace('{{logo_base64}}', $logoBase64, $html);

        $variables = $this->construirVariables($contrato);

        foreach ($variables as $clave => $valor) {
            $html = str_replace('{{' . $clave . '}}', $valor ?? '', $html);
        }

        $pdf = Pdf::loadHTML($html)
            ->setPaper('letter', 'portrait')
            ->setOptions([
                'defaultFont'     => 'sans-serif',
                'isRemoteEnabled' => false,
                'dpi'             => 150,
            ]);

        $nombreArchivo = 'polizas/' . $contrato->folio . '-poliza.pdf';

        Storage::disk('local')->put($nombreArchivo, $pdf->output());

        $contrato->update(['poliza_pdf_path' => $nombreArchivo]);

        return $nombreArchivo;
    }

    private function construirVariables(Contrato $contrato): array
    {
        $arrendador   = $contrato->arrendadores->first();
        $arrendatario = $contrato->arrendatarios->first();
        $inmueble     = $contrato->inmueble;
        $tramitante   = $contrato->tramitante;

        $fechaInicio  = $contrato->fecha_inicio  ? Carbon::parse($contrato->fecha_inicio)  : null;
        $fechaTermino = $contrato->fecha_termino ? Carbon::parse($contrato->fecha_termino) : null;

        $montoRenta = (float) $contrato->monto_renta_mensual;
        $montoTotal = (float) $contrato->monto_total;

        // El monto_total ya incluye IVA; calculamos sin IVA
        $precioSinIva   = round($montoTotal / 1.16, 2);
        $iva            = round($montoTotal - $precioSinIva, 2);

        return [
            'folio'                        => $contrato->folio ?? '',
            'arrendador_nombre_completo'   => $arrendador?->nombre_completo ?? '',
            'arrendador_domicilio'         => $this->formatearDireccion($arrendador?->direccion),
            'arrendatario_nombre_completo' => $arrendatario?->nombre_completo ?? '',
            'inmueble_direccion_completa'  => $inmueble?->direccion_completa ?? '',
            'inmueble_uso'                 => ucfirst($inmueble?->uso_inmueble ?? 'habitacional'),
            'tramitante_nombre_completo'   => $tramitante?->nombre_completo ?? '',
            'monto_renta_mensual'          => number_format($montoRenta, 2),
            'precio_servicio_sin_iva'      => number_format($precioSinIva, 2),
            'iva_servicio'                 => number_format($iva, 2),
            'precio_servicio_con_iva'      => number_format($montoTotal, 2),
            'fecha_inicio_texto'           => $fechaInicio  ? $this->fechaTexto($fechaInicio)  : '',
            'fecha_termino_texto'          => $fechaTermino ? $this->fechaTexto($fechaTermino) : '',
        ];
    }

    private function formatearDireccion(?array $dir): string
    {
        if (empty($dir)) return '';
        $partes = array_filter([
            $dir['calle'] ?? null,
            isset($dir['numero_exterior']) ? 'No. ' . $dir['numero_exterior'] : null,
            $dir['colonia'] ?? null,
            $dir['alcaldia_municipio'] ?? null,
            $dir['estado'] ?? null,
        ]);
        return implode(', ', $partes);
    }

    private function fechaTexto(Carbon $fecha): string
    {
        $meses = [
            1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
        ];
        return $fecha->day . ' de ' . $meses[$fecha->month] . ' de ' . $fecha->year;
    }
}
