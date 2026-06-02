<?php

namespace App\Services;

use App\Models\Contrato;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class GeneradorPolizaPdf
{
    protected CalculadoraPrecioPoliza $calculadora;

    public function __construct()
    {
        $this->calculadora = new CalculadoraPrecioPoliza();
    }

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
        
        // Usar fecha_emision del contrato si existe, si no usar fecha actual
        $fechaEmision = $contrato->fecha_emision ? Carbon::parse($contrato->fecha_emision) : Carbon::now();

        $montoRenta = (float) $contrato->monto_renta_mensual;
        
        // Usar monto_iva_mensual del contrato si existe, si no calcularlo
        if ($contrato->monto_iva_mensual !== null) {
            $montoIvaRenta = (float) $contrato->monto_iva_mensual;
        } else {
            $montoIvaRenta = $contrato->incluye_iva ? $montoRenta * 0.16 : 0;
        }

        // Para los precios de la póliza, usar los valores editables si existen, si no calcularlos
        if ($contrato->poliza_precio_completa !== null && 
            $contrato->poliza_subtotal !== null && 
            $contrato->poliza_total !== null) {
            // Usar valores manuales
            $precioSinIva = (float) $contrato->poliza_precio_completa;
            $iva = (float) $contrato->poliza_subtotal;
            $precioConIva = (float) $contrato->poliza_total;
            $desglose = $this->calculadora->obtenerDesglose($montoRenta);
            $vigenciaMeses = $desglose['vigencia_meses'];
            $limiteRentaMensual = $desglose['limite_renta_mensual'];
        } else {
            // Calcular automáticamente
            $desglose = $this->calculadora->obtenerDesglose($montoRenta);
            $precioSinIva = $desglose['precio_sin_iva'];
            $iva = $desglose['iva'];
            $precioConIva = $desglose['precio_con_iva'];
            $vigenciaMeses = $desglose['vigencia_meses'];
            $limiteRentaMensual = $desglose['limite_renta_mensual'];
        }

        return [
            'folio'                        => $contrato->folio ?? '',
            'numero_poliza'                => $contrato->numero_poliza ?? $contrato->folio ?? '',
            'tipo_producto'                => strtoupper($contrato->tipo_producto ?? 'SUPERIOR'),
            'fecha_emision'                => $this->fechaTexto($fechaEmision),
            
            // Arrendador
            'arrendador_nombre_completo'   => $arrendador?->nombre_completo ?? '',
            'arrendador_domicilio'         => $this->formatearDireccion($arrendador?->direccion),
            'arrendador_telefono'          => $arrendador?->telefono_1 ?? '',
            'arrendador_email'             => $arrendador?->email ?? '',
            
            // Arrendatario
            'arrendatario_nombre_completo' => $arrendatario?->nombre_completo ?? '',
            'arrendatario_telefono'        => $arrendatario?->telefono_1 ?? '',
            'arrendatario_email'           => $arrendatario?->email ?? '',
            
            // Inmueble
            'inmueble_direccion_completa'  => $inmueble?->direccion_completa ?? '',
            'inmueble_uso'                 => ucfirst($inmueble?->uso_inmueble ?? 'habitacional'),
            
            // Tramitante
            'tramitante_nombre_completo'   => $tramitante?->nombre_completo ?? '',
            'tramitante_inmobiliaria'      => $tramitante?->inmobiliaria ?? 'Asesor Independiente',
            
            // Montos
            'monto_renta_mensual'          => number_format($montoRenta, 2),
            'monto_iva_renta'              => number_format($montoIvaRenta, 2),
            'precio_servicio_sin_iva'      => number_format($precioSinIva, 2),
            'iva_servicio'                 => number_format($iva, 2),
            'precio_servicio_con_iva'      => number_format($precioConIva, 2),
            'vigencia_servicio'            => $vigenciaMeses . ' meses',
            'limite_renta_mensual'         => number_format($limiteRentaMensual, 2),
            
            // Fechas
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
