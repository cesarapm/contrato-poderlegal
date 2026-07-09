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
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-ultimo')->first();

        if (!$plantilla) {
            throw new \Exception('No se encontró la plantilla de contrato. Ejecuta: php artisan db:seed --class=PlantillaArrendamientoSeeder y php artisan db:seed --class=PlantillaArrendamientoUltimoSeeder');
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

        $fechaInicio  = $contrato->fecha_inicio  ? Carbon::parse($contrato->fecha_inicio)  : null;
        $fechaTermino = $contrato->fecha_termino ? Carbon::parse($contrato->fecha_termino) : null;

        $monto = (float) $contrato->monto_renta_mensual;

        // Preparar secciones condicionales del fiador (para plantilla habitacional)
        $seccionFiador = '';
        $firmaFiador = '';
        
        if ($fiador && $fiador->tipo !== 'ninguno') {
            $nombreFiador = mb_strtoupper($fiador->nombre_completo ?? '', 'UTF-8');
            
            // Construir texto de tipo de persona
            $tipoPersona = '';
            if ($fiador->tipo_persona) {
                $tipoPersona = ' en su carácter de persona ' . mb_strtoupper($fiador->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8');
            }
            
            // Construir texto de nacionalidad y número de INE
            $textoNacionalidad = '';
            if ($fiador->nacionalidad) {
                $textoNacionalidad = ' de nacionalidad ' . mb_strtoupper($fiador->nacionalidad, 'UTF-8');
            }
            
            $textoIne = '';
            if ($fiador->numero_ine) {
                $textoIne = ' con número de INE ' . $fiador->numero_ine;
            }
            
            // Construir texto de residencia
            $textoResidencia = '';
            if ($fiador->numero_inm) {
                $textoResidencia = ' con residencia permanente en territorio mexicano expedido por el instituto nacional de migración número ' . $fiador->numero_inm;
            }
            
            // Construir dirección completa
            $direccionFiador = [];
            if ($fiador->domicilio) {
                $direccionFiador[] = $fiador->domicilio;
            }
            if ($fiador->ciudad) {
                $direccionFiador[] = $fiador->ciudad;
            }
            if ($fiador->estado) {
                $direccionFiador[] = $fiador->estado;
            }
            if ($fiador->pais && $fiador->pais !== 'México') {
                $direccionFiador[] = $fiador->pais;
            }
            if ($fiador->codigo_postal) {
                $direccionFiador[] = 'C.P. ' . $fiador->codigo_postal;
            }
            
            $direccionCompleta = !empty($direccionFiador) ? ' con domicilio en ' . mb_strtoupper(implode(', ', $direccionFiador), 'UTF-8') : '';
            
            $seccionFiador = '
<p><span class="clausula-num">3.3.</span> &nbsp; <strong>\'DECLARA EL OBLIGADO SOLIDARIO\'</strong></p>

<p><span class="clausula-num">3.4.</span> &nbsp; ' . $nombreFiador . $tipoPersona . $textoNacionalidad . $textoIne . $textoResidencia . $direccionCompleta . ' quien se compromete a cumplir exactamente con todas las cláusulas y obligaciones que se hacen referencia a <strong>\'EL ARRENDATARIO\'</strong> establecido en el presente contrato.</p>
';

            $firmaFiador = '
<div class="firma-row" style="margin-top:30px;">
  <div class="firma-box" style="margin:0 auto;">
    <p style="text-align:center;"><strong>\'OBLIGADO SOLIDARIO\'</strong></p>
    <div class="firma-linefiador"></div>
    <p class="firma-nombre"><strong>' . $nombreFiador . '</strong></p>
    <p class="firma-nombre">Por su propio derecho</p>
  </div>
</div>
';
        }

        // Construir dirección completa del fiador para plantilla último
        $fiadorDomicilioCompleto = '';
        if ($fiador) {
            $direccionFiadorParts = [];
            if ($fiador->domicilio) {
                $direccionFiadorParts[] = $fiador->domicilio;
            }
            if ($fiador->ciudad) {
                $direccionFiadorParts[] = $fiador->ciudad;
            }
            if ($fiador->estado) {
                $direccionFiadorParts[] = $fiador->estado;
            }
            if ($fiador->pais && $fiador->pais !== 'México') {
                $direccionFiadorParts[] = $fiador->pais;
            }
            if ($fiador->codigo_postal) {
                $direccionFiadorParts[] = 'C.P. ' . $fiador->codigo_postal;
            }
            $fiadorDomicilioCompleto = mb_strtoupper(implode(', ', $direccionFiadorParts), 'UTF-8');
        }

        // Construir sección fiador condicional para plantilla último
        $seccionFiadorUltimo = '';
        if ($fiador && $fiador->tipo !== 'ninguno') {
            $seccionFiadorUltimo = '
<p><strong>III.- DECLARA "EL OBLIGADO SOLIDARIO":</strong></p>
<div class="viñeta">
<p>a) Ser persona ' . mb_strtoupper($fiador->tipo_persona === 'moral' ? 'MORAL' : 'FÍSICA', 'UTF-8') . ' de nacionalidad ' . mb_strtoupper($fiador->nacionalidad ?? 'MÉXICO', 'UTF-8') . ' identificado con INE ' . ($fiador->numero_ine ?? '') . ' CURP ' . ($fiador->numero_ine ?? '') . ' y que tiene plena capacidad para la celebración del presente contrato y compromete a cumplir exactamente con todas las cláusulas y obligaciones que se hacen referencia a \'EL ARRENDATARIO\' establecido en el presente contrato y declara tener su domicilio en ' . $fiadorDomicilioCompleto . ' con email ' . mb_strtoupper($arrendador?->email ?? '', 'UTF-8') . ' teléfono ' . ($arrendador?->telefono_1 ?? '') . '</p>
</div>
';
        }

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
            'monto_renta_mensual'       => number_format($monto, 2),
            'monto_renta_mensual_letra' => $this->numeroALetras($monto),
            'iva_texto'                 => $contrato->incluye_iva ? ' MÁS IVA' : '',
            'deposito_garantia'         => number_format($monto, 2),
            'deposito_garantia_letra'   => $this->numeroALetras($monto),
            'monto_total'               => number_format((float) $contrato->monto_total, 2),

            // Fechas
            'fecha_inicio_texto'  => $fechaInicio  ? mb_strtoupper($this->fechaTexto($fechaInicio), 'UTF-8')  : '',
            'fecha_termino_texto' => $fechaTermino ? mb_strtoupper($this->fechaTexto($fechaTermino), 'UTF-8') : '',
            'fecha_firma'         => $fechaInicio  ? mb_strtoupper($this->fechaTexto($fechaInicio), 'UTF-8')  : '',
            'mes_primer_pago'     => $fechaInicio  ? mb_strtoupper($this->mesAnio($fechaInicio), 'UTF-8')     : '',
            'mes_inicio_periodo'  => $fechaInicio  ? mb_strtoupper($this->mesNombre($fechaInicio), 'UTF-8')   : '',
            'mes_fin_periodo'     => $fechaTermino ? mb_strtoupper($this->mesNombre($fechaTermino), 'UTF-8')  : '',
            'anio_inicio'         => $fechaInicio  ? $fechaInicio->year               : '',
            'anio_fin'            => $fechaTermino ? $fechaTermino->year              : '',

            // Fiador - variables simples (sin condicionales)
            'fiador_nombre_completo'    => mb_strtoupper($fiador?->nombre_completo ?? '', 'UTF-8'),
            'fiador_tipo'               => mb_strtoupper($fiador?->tipo ?? '', 'UTF-8'),
            'fiador_tipo_persona'       => mb_strtoupper($fiador?->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8'),
            'fiador_numero_ine'         => $fiador?->numero_ine ?? '',
            'fiador_nacionalidad'       => mb_strtoupper($fiador?->nacionalidad ?? 'México', 'UTF-8'),
            'fiador_domicilio_completo' => $fiadorDomicilioCompleto,
            
            // Secciones condicionales del fiador (para plantilla habitacional)
            'seccion_fiador' => $seccionFiador,
            'firma_fiador'   => $firmaFiador,
            'seccion_fiador_ultimo' => $seccionFiadorUltimo,

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
