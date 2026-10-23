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

        // Usar plantilla asignada, o la plantilla profesional si no tiene
        $plantilla = $contrato->plantilla
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-profesional')->first()
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-ultimo')->first();

        if (!$plantilla) {
            throw new \Exception('No se encontró la plantilla de contrato. Ejecuta: php artisan db:seed --class=PlantillaArrendamientoProfesionalSeeder y php artisan db:seed --class=PlantillaArrendamientoUltimoSeeder');
        }

        $html = $plantilla->contenido_html;

        $variables = $this->construirVariables($contrato);

        foreach ($variables as $clave => $valor) {
            $html = str_replace('{{' . $clave . '}}', $valor ?? '', $html);
        }

        // $pdf = Pdf::loadHTML($html)
        //     ->setPaper('letter', 'portrait')
        //     ->setOptions([
        //         'defaultFont'     => 'serif',
        //         'isRemoteEnabled' => false,
        //         'dpi'             => 150,
        //     ]);

        // $nombreArchivo = 'contratos/' . $contrato->folio . '.pdf';

        // Storage::disk('local')->put($nombreArchivo, $pdf->output());

        $pdf = Pdf::loadHTML($html)
            ->setPaper('letter', 'portrait')
            ->setOptions([
                'defaultFont' => 'serif',
                'isRemoteEnabled' => false,
                'dpi' => 150,
            ]);

        // render() primero para que _pages se llene con todas las páginas
        $pdf->render();

        // page_text() después de render() = footer en TODAS las páginas
        $canvas = $pdf->getDomPDF()->getCanvas();
        $font   = $pdf->getDomPDF()->getFontMetrics()->getFont('Helvetica', 'bold');
        $purple = [91 / 255, 44 / 255, 131 / 255];

        $canvas->page_text(45,  765, 'www.poderlegal.mx',          $font, 8, $purple);
        $canvas->page_text(510, 765, '{PAGE_NUM} de {PAGE_COUNT}', $font, 8, $purple);

        $nombreArchivo = 'contratos/' . $contrato->folio . '.pdf';
        Storage::disk('local')->put($nombreArchivo, $pdf->output());

        $contrato->update(['pdf_path' => $nombreArchivo]);

        return $nombreArchivo;

    }

    private function construirVariables(Contrato $contrato): array
    {
        $arrendador = $contrato->arrendadores->first();
        $arrendatario = $contrato->arrendatarios->first();
        $inmueble = $contrato->inmueble;
        $fiador = $contrato->fiador;

        $fechaInicio = $contrato->fecha_inicio ? Carbon::parse($contrato->fecha_inicio) : null;
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

        // Construir dirección completa del arrendatario
        $arrendatarioDomicilioCompleto = '';
        if ($arrendatario) {
            if ($arrendatario->tipo_persona === 'moral' && $arrendatario->direccion_empresa) {
                // Para persona moral, usar dirección de la empresa
                $arrendatarioDomicilioCompleto = mb_strtoupper($arrendatario->direccion_empresa, 'UTF-8');
            } else {
                // Para persona física, construir desde campos individuales
                $direccionArrendatarioParts = [];
                $direccion = $arrendatario->domicilio_notificaciones;
                if (is_array($direccion)) {
                    if (isset($direccion['calle'])) {
                        $direccionArrendatarioParts[] = $direccion['calle'];
                    }
                    if (isset($direccion['numero_exterior'])) {
                        $direccionArrendatarioParts[] = 'No. ' . $direccion['numero_exterior'];
                    }
                    if (isset($direccion['colonia'])) {
                        $direccionArrendatarioParts[] = $direccion['colonia'];
                    }
                    if (isset($direccion['alcaldia_municipio'])) {
                        $direccionArrendatarioParts[] = $direccion['alcaldia_municipio'];
                    }
                    if (isset($direccion['estado'])) {
                        $direccionArrendatarioParts[] = $direccion['estado'];
                    }
                    if (isset($direccion['codigo_postal'])) {
                        $direccionArrendatarioParts[] = 'C.P. ' . $direccion['codigo_postal'];
                    }
                }
                $arrendatarioDomicilioCompleto = mb_strtoupper(implode(', ', $direccionArrendatarioParts), 'UTF-8');
            }
        }

        // Construir dirección completa del fiador para plantilla último
        $fiadorDomicilioCompleto = '';
        if ($fiador) {
            if ($fiador->tipo_persona === 'moral' && $fiador->direccion_empresa) {
                // Para persona moral, usar dirección de la empresa
                $fiadorDomicilioCompleto = mb_strtoupper($fiador->direccion_empresa, 'UTF-8');
            } else {
                // Para persona física, construir desde campos individuales
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

        // Preparar sección de datos bancarios (condicional según forma_pago)
        $seccionDatosBancarios = '';
        $textoPagoForma = 'EN EFECTIVO';
        $textIncisoPago = '';
        $diaPago = $fechaInicio ? $fechaInicio->day : '1';

        if ($contrato->forma_pago === 'transferencia') {
            $textoPagoForma = 'EN EFECTIVO o mediante TRANSFERENCIA BANCARIA';

            $textIncisoPago = 'El pago de la renta mensual se cubrirá en su totalidad dentro de los primeros CINCO DÍAS contados a partir del día 1 de cada mes, en la cuenta bancaria número ' . ($contrato->cuenta ?? '') . ', del banco ' . ($contrato->banco ?? '') . ', a nombre de ' . ($contrato->beneficiario ?? '') . ', con CLABE Interbancaria ' . ($contrato->clabe ?? '') . ', o en el domicilio de "EL ARRENDADOR", señalado en la declaración I inciso c), y empezará a cubrirse a partir de la fecha de inicio de la vigencia del presente instrumento, siendo causa de rescisión de contrato el hecho de que se cubra extemporáneamente una mensualidad o más, o de que ésta no sea cubierta, en cuyo caso "EL ARRENDATARIO" acepta que se le embarguen bienes muebles u objetos de los que introduzca en la localidad arrendada y que declara desde hoy que son de su exclusiva propiedad, los que entregará desde luego a la persona que "EL ARRENDADOR" nombre como depositario.';

            $seccionDatosBancarios = '
            <table class="banco-table">
                <tr>
                    <td colspan="2" class="banco-table-header">DATOS BANCARIOS PARA EL PAGO DE RENTA</td>
                </tr>
                <tr class="banco-table-row">
                    <td class="banco-table-label">BANCO</td>
                    <td>' . ($contrato->banco ?? '____________________________') . '</td>
                </tr>
                <tr class="banco-table-row">
                    <td class="banco-table-label">NÚMERO DE CUENTA</td>
                    <td>' . ($contrato->cuenta ?? '____________________________') . '</td>
                </tr>
                <tr class="banco-table-row">
                    <td class="banco-table-label">CLABE INTERBANCARIA</td>
                    <td>' . ($contrato->clabe ?? '____________________________') . '</td>
                </tr>
            </table>
            ';
        } else {
            // Cuando es solo efectivo
            $textIncisoPago = 'El pago de la renta mensual se cubrirá en su totalidad dentro de los primeros CINCO DÍAS contados a partir del día 1 de cada mes, en efectivo en el domicilio de "EL ARRENDADOR", señalado en la declaración I inciso c), y empezará a cubrirse a partir de la fecha de inicio de la vigencia del presente instrumento, siendo causa de rescisión de contrato el hecho de que se cubra extemporáneamente una mensualidad o más, o de que ésta no sea cubierta, en cuyo caso "EL ARRENDATARIO" acepta que se le embarguen bienes muebles u objetos de los que introduzca en la localidad arrendada y que declara desde hoy que son de su exclusiva propiedad, los que entregará desde luego a la persona que "EL ARRENDADOR" nombre como depositario.';

            $seccionDatosBancarios = '
            <table class="banco-table">
                <tr>
                    <td colspan="2" class="banco-table-header">FORMA DE PAGO</td>
                </tr>
                <tr class="banco-table-row">
                    <td class="banco-table-label">MÉTODO DE PAGO</td>
                    <td>EN EFECTIVO</td>
                </tr>
                <tr class="banco-table-row">
                    <td class="banco-table-label">LUGAR DE PAGO</td>
                    <td>En el domicilio de "EL ARRENDADOR" señalado en la Declaración I, inciso e)</td>
                </tr>
            </table>
            ';
        }

        return [
            // Arrendador
            'arrendador_nombre_completo' => mb_strtoupper($arrendador?->nombre_completo ?? '', 'UTF-8'),
            'arrendador_tipo_persona' => mb_strtoupper($arrendador?->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8'),
            'arrendador_nacionalidad' => mb_strtoupper($arrendador?->nacionalidad ?? 'México', 'UTF-8'),
            'arrendador_curp' => $arrendador?->curp ?? '',
            'arrendador_domicilio' => mb_strtoupper($this->formatearDireccion($arrendador?->direccion), 'UTF-8'),
            'arrendador_email' => $arrendador && $arrendador->tipo_persona === 'moral'
                ? mb_strtoupper($arrendador->representante_legal_email ?? $arrendador->email ?? '', 'UTF-8')
                : mb_strtoupper($arrendador?->email ?? '', 'UTF-8'),
            'arrendador_telefono' => $arrendador && $arrendador->tipo_persona === 'moral'
                ? ($arrendador->representante_legal_telefono ?? $arrendador->telefono_1 ?? '')
                : ($arrendador?->telefono_1 ?? ''),
            'arrendador_numero_ine' => $arrendador?->numero_ine ?? '',
            'arrendador_razon_social' => mb_strtoupper($arrendador?->razon_social ?? '', 'UTF-8'),
            'arrendador_rfc' => $arrendador?->rfc ?? '',
            // Variables condicionales según tipo de persona
            'arrendador_nombre_o_razon' => $arrendador && $arrendador->tipo_persona === 'moral'
                ? mb_strtoupper($arrendador->razon_social ?? '', 'UTF-8')
                : mb_strtoupper($arrendador?->nombre_completo ?? '', 'UTF-8'),
            'arrendador_identificacion' => $arrendador && $arrendador->tipo_persona === 'moral'
                ? ($arrendador->rfc ?? '')
                : ($arrendador->numero_ine ?? ''),

            // Arrendatario
            'arrendatario_nombre_completo' => mb_strtoupper($arrendatario?->nombre_completo ?? '', 'UTF-8'),
            'arrendatario_tipo_persona' => mb_strtoupper($arrendatario?->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8'),
            'arrendatario_nacionalidad' => mb_strtoupper($arrendatario?->nacionalidad ?? 'México', 'UTF-8'),
            'arrendatario_curp' => $arrendatario?->curp ?? '',
            'arrendatario_email' => $arrendatario && $arrendatario->tipo_persona === 'moral'
                ? mb_strtoupper($arrendatario->representante_legal_email ?? $arrendatario->email ?? '', 'UTF-8')
                : mb_strtoupper($arrendatario?->email ?? '', 'UTF-8'),
            'arrendatario_telefono' => $arrendatario && $arrendatario->tipo_persona === 'moral'
                ? ($arrendatario->representante_legal_telefono ?? $arrendatario->telefono_1 ?? '')
                : ($arrendatario?->telefono_1 ?? ''),
            'arrendatario_numero_ine' => $arrendatario?->numero_ine ?? '',
            'arrendatario_razon_social' => mb_strtoupper($arrendatario?->razon_social ?? '', 'UTF-8'),
            'arrendatario_rfc' => $arrendatario?->rfc ?? '',
            // Variables condicionales según tipo de persona
            'arrendatario_nombre_o_razon' => $arrendatario && $arrendatario->tipo_persona === 'moral'
                ? mb_strtoupper($arrendatario->razon_social ?? '', 'UTF-8')
                : mb_strtoupper($arrendatario?->nombre_completo ?? '', 'UTF-8'),
            'arrendatario_identificacion' => $arrendatario && $arrendatario->tipo_persona === 'moral'
                ? ($arrendatario->rfc ?? '')
                : ($arrendatario->numero_ine ?? ''),
            'arrendatario_domicilio_completo' => $arrendatarioDomicilioCompleto,

            // Inmueble
            'inmueble_direccion_completa' => mb_strtoupper($inmueble?->direccion_completa ?? '', 'UTF-8'),
            'inmueble_calle' => mb_strtoupper($inmueble?->calle ?? '', 'UTF-8'),
            'inmueble_colonia' => mb_strtoupper($inmueble?->colonia ?? '', 'UTF-8'),
            'inmueble_alcaldia' => mb_strtoupper($inmueble?->alcaldia_municipio ?? '', 'UTF-8'),
            'inmueble_estado' => mb_strtoupper($inmueble?->estado ?? '', 'UTF-8'),
            'inmueble_cp' => $inmueble?->codigo_postal ?? '',
            'inmueble_uso' => mb_strtoupper($inmueble?->uso_inmueble ?? 'habitacional', 'UTF-8'),
            'inmueble_estacionamiento' => '1',
            'numero_estacionamientos' => (string) ($inmueble?->numero_estacionamientos ?? 0),

            // Montos
            'monto_renta_mensual' => number_format($monto, 2),
            'monto_renta_mensual_letra' => $this->numeroALetras($monto),
            'iva_texto' => $contrato->incluye_iva ? ' MÁS IVA' : '',
            'deposito_garantia' => number_format($monto, 2),
            'deposito_garantia_letra' => $this->numeroALetras($monto),
            'deposito_garantia_meses' => '1',
            'monto_total' => number_format((float) $contrato->monto_total, 2),

            // Datos bancarios
            'numero_cuenta' => $contrato->cuenta ?? '',
            'banco' => $contrato->banco ?? '',
            'beneficiario' => $contrato->beneficiario ?? '',
            'clabe' => $contrato->clabe ?? '',

            // Fechas
            'fecha_inicio_texto' => $fechaInicio ? mb_strtoupper($this->fechaTexto($fechaInicio), 'UTF-8') : '',
            'fecha_termino_texto' => $fechaTermino ? mb_strtoupper($this->fechaTexto($fechaTermino), 'UTF-8') : '',
            'fecha_firma' => $fechaInicio ? mb_strtoupper($this->fechaTexto($fechaInicio), 'UTF-8') : '',
            'mes_primer_pago' => $fechaInicio ? mb_strtoupper($this->mesAnio($fechaInicio), 'UTF-8') : '',
            'mes_inicio_periodo' => $fechaInicio ? mb_strtoupper($this->mesNombre($fechaInicio), 'UTF-8') : '',
            'mes_fin_periodo' => $fechaTermino ? mb_strtoupper($this->mesNombre($fechaTermino), 'UTF-8') : '',
            'anio_inicio' => $fechaInicio ? $fechaInicio->year : '',
            'anio_fin' => $fechaTermino ? $fechaTermino->year : '',
            'dia_pago_renta' => $fechaInicio ? $fechaInicio->day : '1',
            'fecha_inicio_formato' => $fechaInicio ? $this->fechaTexto($fechaInicio) : '',
            'fecha_termino_formato' => $fechaTermino ? $this->fechaTexto($fechaTermino) : '',
            'plazo_contrato' => ($fechaInicio && $fechaTermino)
                ? mb_strtoupper(round($fechaInicio->diffInMonths($fechaTermino)) . ' MESES', 'UTF-8')
                : '',
            'dia_firma' => $fechaInicio ? $fechaInicio->day : '',
            'mes_firma' => $fechaInicio ? mb_strtoupper($this->mesNombre($fechaInicio), 'UTF-8') : '',
            'anio_firma' => $fechaInicio ? $fechaInicio->year : '',

            // Fiador - variables simples (sin condicionales)
            'fiador_nombre_completo' => mb_strtoupper($fiador?->nombre_completo ?? '', 'UTF-8'),
            'fiador_tipo' => mb_strtoupper($fiador?->tipo ?? '', 'UTF-8'),
            'fiador_tipo_persona' => mb_strtoupper($fiador?->tipo_persona === 'moral' ? 'moral' : 'física', 'UTF-8'),
            'fiador_numero_ine' => $fiador?->numero_ine ?? '',
            'fiador_curp' => $fiador?->curp ?? '',
            'fiador_nacionalidad' => mb_strtoupper($fiador?->nacionalidad ?? 'México', 'UTF-8'),
            'fiador_domicilio_completo' => $fiadorDomicilioCompleto,
            'fiador_email' => $fiador && $fiador->tipo_persona === 'moral'
                ? mb_strtoupper($fiador->representante_legal_email ?? $fiador->email ?? '', 'UTF-8')
                : mb_strtoupper($fiador?->email ?? '', 'UTF-8'),
            'fiador_telefono' => $fiador && $fiador->tipo_persona === 'moral'
                ? ($fiador->representante_legal_telefono ?? $fiador->telefono_1 ?? '')
                : ($fiador?->telefono_1 ?? ''),
            'fiador_rfc' => $fiador?->rfc ?? '',
            // Variables condicionales según tipo de persona
            'fiador_nombre_o_razon' => $fiador && $fiador->tipo_persona === 'moral'
                ? mb_strtoupper($fiador->razon_social ?? '', 'UTF-8')
                : mb_strtoupper($fiador?->nombre_completo ?? '', 'UTF-8'),
            'fiador_identificacion' => $fiador && $fiador->tipo_persona === 'moral'
                ? ($fiador->rfc ?? '')
                : ($fiador->numero_ine ?? ''),

            // Secciones condicionales del fiador (para plantilla habitacional)
            'seccion_fiador' => $seccionFiador,
            'firma_fiador' => $firmaFiador,
            'seccion_fiador_ultimo' => $seccionFiadorUltimo,

            // Sección condicional de datos bancarios y texto de pago
            'seccion_datos_bancarios' => $seccionDatosBancarios,
            'texto_pago_forma' => $textoPagoForma,
            'texto_inciso_pago' => $textIncisoPago,

            // Folio
            'folio' => $contrato->folio ?? '',
        ];
    }

    private function formatearDireccion(?array $dir): string
    {
        if (empty($dir))
            return '';
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
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];
        return $fecha->day . ' de ' . $meses[$fecha->month] . ' de ' . $fecha->year;
    }

    private function mesNombre(Carbon $fecha): string
    {
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
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
