<?php

namespace App\Services;

use App\Models\Contrato;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class GeneradorContratoPdf
{
    public function generar(Contrato $contrato): string
    {
        $contrato->load(['plantilla', 'arrendadores', 'arrendatarios', 'inmueble', 'fiador', 'tramitante']);

        // Usar plantilla asignada, o la plantilla por defecto si no tiene
        $plantilla = $contrato->plantilla
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-habitacional')->first();

        if (!$plantilla) {
            throw new \Exception('No se encontró la plantilla de contrato. Ejecuta: php artisan db:seed --class=PlantillaArrendamientoSeeder');
        }

        $html = $plantilla->contenido_html;

        $variables = $this->construirVariables($contrato);

        foreach ($variables as $clave => $valor) {
            $html = str_replace('{{' . $clave . '}}', $valor ?? '', $html);
        }

        $pdf = Pdf::loadHTML($html)
            ->setPaper('letter', 'portrait')
            ->setOptions([
                'defaultFont'     => 'serif',
                'isRemoteEnabled' => false,
                'dpi'             => 150,
            ]);

        $nombreArchivo = 'contratos/' . $contrato->folio . '.pdf';

        Storage::disk('local')->put($nombreArchivo, $pdf->output());

        $contrato->update(['pdf_path' => $nombreArchivo]);

        return $nombreArchivo;
    }

    private function construirVariables(Contrato $contrato): array
    {
        $arrendador   = $contrato->arrendadores->first();
        $arrendatario = $contrato->arrendatarios->first();
        $inmueble     = $contrato->inmueble;
        $fiador       = $contrato->fiador;

        // \Log::debug('PDF variables debug', [
        //     'arrendador_nombre'    => $arrendador?->nombre,
        //     'arrendador_ap'       => $arrendador?->apellido_paterno,
        //     'arrendador_am'       => $arrendador?->apellido_materno,
        //     'arrendador_completo' => $arrendador?->nombre_completo,
        //     'arrendatario_nombre'    => $arrendatario?->nombre,
        //     'arrendatario_ap'       => $arrendatario?->apellido_paterno,
        //     'arrendatario_am'       => $arrendatario?->apellido_materno,
        //     'arrendatario_tipo'      => $arrendatario?->tipo_persona,
        //     'arrendatario_completo' => $arrendatario?->nombre_completo,
        // ]);

        $fechaInicio  = $contrato->fecha_inicio  ? Carbon::parse($contrato->fecha_inicio)  : null;
        $fechaTermino = $contrato->fecha_termino ? Carbon::parse($contrato->fecha_termino) : null;

        $monto = (float) $contrato->monto_renta_mensual;

        return [
            // Arrendador
            'arrendador_nombre_completo' => mb_strtoupper($arrendador?->nombre_completo ?? '', 'UTF-8'),
            'arrendador_tipo_persona'    => mb_strtoupper($arrendador?->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8'),
            'arrendador_domicilio'       => mb_strtoupper($this->formatearDireccion($arrendador?->direccion), 'UTF-8'),
            'arrendador_email'           => mb_strtoupper($arrendador?->email ?? '', 'UTF-8'),
            'arrendador_telefono'        => $arrendador?->telefono_1 ?? '',

            // Arrendatario
            'arrendatario_nombre_completo' => mb_strtoupper($arrendatario?->nombre_completo ?? '', 'UTF-8'),
            'arrendatario_tipo_persona'    => mb_strtoupper($arrendatario?->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8'),
            'arrendatario_email'           => mb_strtoupper($arrendatario?->email ?? '', 'UTF-8'),
            'arrendatario_telefono'        => $arrendatario?->telefono_1 ?? '',

            // Inmueble
            'inmueble_direccion_completa' => mb_strtoupper($inmueble?->direccion_completa ?? '', 'UTF-8'),
            'inmueble_calle'              => mb_strtoupper($inmueble?->calle ?? '', 'UTF-8'),
            'inmueble_colonia'            => mb_strtoupper($inmueble?->colonia ?? '', 'UTF-8'),
            'inmueble_alcaldia'           => mb_strtoupper($inmueble?->alcaldia_municipio ?? '', 'UTF-8'),
            'inmueble_estado'             => mb_strtoupper($inmueble?->estado ?? '', 'UTF-8'),
            'inmueble_cp'                 => $inmueble?->codigo_postal ?? '',
            'inmueble_uso'                => mb_strtoupper($inmueble?->uso_inmueble ?? 'habitacional', 'UTF-8'),
            'inmueble_estacionamiento'    => '1',

            // Montos
            'monto_renta_mensual'    => number_format($monto, 2),
            'deposito_garantia'      => number_format($monto, 2),
            'deposito_garantia_letra' => $this->numeroALetras($monto),
            'monto_total'            => number_format((float) $contrato->monto_total, 2),

            // Fechas
            'fecha_inicio_texto'  => $fechaInicio  ? mb_strtoupper($this->fechaTexto($fechaInicio), 'UTF-8')  : '',
            'fecha_termino_texto' => $fechaTermino ? mb_strtoupper($this->fechaTexto($fechaTermino), 'UTF-8') : '',
            'fecha_firma'         => $fechaInicio  ? mb_strtoupper($this->fechaTexto($fechaInicio), 'UTF-8')  : '',
            'mes_primer_pago'     => $fechaInicio  ? mb_strtoupper($this->mesAnio($fechaInicio), 'UTF-8')     : '',
            'mes_inicio_periodo'  => $fechaInicio  ? mb_strtoupper($this->mesNombre($fechaInicio), 'UTF-8')   : '',
            'mes_fin_periodo'     => $fechaTermino ? mb_strtoupper($this->mesNombre($fechaTermino), 'UTF-8')  : '',
            'anio_inicio'         => $fechaInicio  ? $fechaInicio->year               : '',
            'anio_fin'            => $fechaTermino ? $fechaTermino->year              : '',

            // Fiador
            'fiador_nombre_completo' => mb_strtoupper($fiador?->nombre_completo ?? 'N/A', 'UTF-8'),
            'fiador_tipo'            => mb_strtoupper($fiador?->tipo ?? '', 'UTF-8'),

            // Folio
            'folio' => $contrato->folio ?? '',
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

    private function mesNombre(Carbon $fecha): string
    {
        $meses = [
            1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
        ];
        return $meses[$fecha->month];
    }

    private function mesAnio(Carbon $fecha): string
    {
        return $this->mesNombre($fecha) . ' de ' . $fecha->year;
    }

    private function numeroALetras(float $numero): string
    {
        $entero = (int) $numero;
        $fmt = new NumberFormatter('es_MX', NumberFormatter::SPELLOUT);
        $letras = mb_strtoupper($fmt->format($entero), 'UTF-8');
        return $letras . ' PESOS 00/100 M.N.';
    }
}
