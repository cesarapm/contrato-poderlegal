<?php

namespace Database\Seeders;

use App\Models\PlantillaContrato;
use Illuminate\Database\Seeder;

class PlantillaPolizaSeeder extends Seeder
{
    public function run(): void
    {
        $html = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
  /* ===== RESET & BASE ===== */
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: "Arial", "Helvetica Neue", Helvetica, sans-serif;
    font-size: 10pt;
    line-height: 1.5;
    color: #1a1a2e;
    background: #fff;
  }

  /* ===== PORTADA ===== */
  .portada {
    page-break-after: always;
    min-height: 100vh;
    display: block;
  }

  /* Cabecera azul oscuro */
  .portada-header {
    background: #0d1b4b;
    color: #fff;
    padding: 22px 36px 18px;
    display: table;
    width: 100%;
  }
  .portada-header-left {
    display: table-cell;
    vertical-align: middle;
    width: 75%;
  }
  .portada-header-right {
    display: table-cell;
    vertical-align: middle;
    text-align: right;
    width: 25%;
  }
  .portada-header-right img {
    width: 90px;
    height: auto;
  }
  .portada-header .brand {
    font-size: 22pt;
    font-weight: 900;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #ffffff;
  }
  .portada-header .brand span {
    color: #f0c040;
  }
  .portada-header .tagline {
    font-size: 9pt;
    color: #a8b8d8;
    margin-top: 3px;
    letter-spacing: 1px;
    text-transform: uppercase;
  }
  .portada-header .badge-proteccion {
    display: inline-block;
    background: #f0c040;
    color: #0d1b4b;
    font-weight: 800;
    font-size: 8.5pt;
    padding: 4px 14px;
    border-radius: 3px;
    letter-spacing: 1px;
    margin-top: 10px;
    text-transform: uppercase;
  }

  /* Franja dorada */
  .portada-stripe {
    background: #f0c040;
    height: 5px;
  }

  /* Sección de datos */
  .portada-body {
    padding: 28px 36px;
  }
  .portada-title {
    font-size: 14pt;
    font-weight: 700;
    color: #0d1b4b;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 2.5px solid #f0c040;
    padding-bottom: 8px;
    margin-bottom: 22px;
  }

  /* Tabla de datos de la portada */
  .data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 22px;
  }
  .data-table tr { border-bottom: 1px solid #e8eaf2; }
  .data-table tr:last-child { border-bottom: none; }
  .data-table td {
    padding: 8px 10px;
    vertical-align: top;
  }
  .data-table td.label {
    width: 42%;
    font-size: 8.5pt;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .data-table td.value {
    font-size: 10pt;
    font-weight: 600;
    color: #1a1a2e;
  }
  .data-table td.value.highlight {
    color: #0d1b4b;
    font-size: 11pt;
  }

  /* Cuadro de paquete */
  .paquete-box {
    background: #0d1b4b;
    color: #fff;
    border-radius: 6px;
    padding: 16px 22px;
    margin-bottom: 22px;
  }
  .paquete-box .paquete-nombre {
    font-size: 13pt;
    font-weight: 800;
    color: #f0c040;
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  .paquete-box .paquete-desc {
    font-size: 8.5pt;
    color: #a8b8d8;
    margin-top: 4px;
  }

  /* Cuadro financiero */
  .financiero-box {
    border: 2px solid #0d1b4b;
    border-radius: 6px;
    overflow: hidden;
    margin-bottom: 22px;
  }
  .financiero-box .financiero-header {
    background: #0d1b4b;
    color: #f0c040;
    font-weight: 800;
    font-size: 9pt;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 7px 14px;
  }
  .financiero-box table {
    width: 100%;
    border-collapse: collapse;
  }
  .financiero-box table td {
    padding: 9px 14px;
    border-bottom: 1px solid #e8eaf2;
    font-size: 10pt;
  }
  .financiero-box table tr:last-child td { border-bottom: none; }
  .financiero-box table td.flab {
    color: #6b7280;
    font-size: 8.5pt;
    font-weight: 700;
    text-transform: uppercase;
    width: 55%;
  }
  .financiero-box table td.fval {
    font-weight: 700;
    color: #0d1b4b;
    text-align: right;
  }
  .financiero-box table td.fval.total {
    font-size: 13pt;
    color: #0d1b4b;
  }

  /* Disclaimer portada */
  .portada-disclaimer {
    background: #f3f4f8;
    border-left: 4px solid #0d1b4b;
    padding: 12px 16px;
    font-size: 8pt;
    color: #4b5563;
    line-height: 1.5;
    margin-bottom: 20px;
  }

  /* Pie de portada */
  .portada-footer {
    background: #0d1b4b;
    color: #a8b8d8;
    font-size: 7.5pt;
    padding: 12px 36px;
    text-align: center;
  }

  /* ===== CONTRATO ===== */
  .contrato {
    padding: 2cm 2.5cm;
  }
  .contrato-header {
    text-align: center;
    margin-bottom: 24px;
  }
  .contrato-header .brand-contrato {
    font-size: 16pt;
    font-weight: 900;
    color: #0d1b4b;
    letter-spacing: 3px;
    text-transform: uppercase;
  }
  .contrato-header .brand-contrato span { color: #f0c040; }
  .contrato-stripe {
    height: 3px;
    background: linear-gradient(to right, #0d1b4b, #f0c040, #0d1b4b);
    margin: 10px auto 18px;
    width: 60%;
  }
  .contrato-titulo {
    text-align: center;
    font-size: 11pt;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #0d1b4b;
    margin-bottom: 18px;
    border-bottom: 1.5px solid #e8eaf2;
    padding-bottom: 10px;
  }

  .intro { text-align: justify; margin-bottom: 16px; font-size: 9.5pt; }

  h2.seccion {
    font-size: 10pt;
    font-weight: 800;
    text-align: center;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #0d1b4b;
    margin: 20px 0 10px;
  }
  .declaracion {
    margin-bottom: 8px;
    text-align: justify;
    font-size: 9.5pt;
  }
  .declaracion .num {
    font-weight: 700;
    color: #0d1b4b;
  }

  .clausula {
    margin-bottom: 12px;
    text-align: justify;
    font-size: 9.5pt;
  }
  .clausula .clausula-titulo {
    font-weight: 800;
    text-transform: uppercase;
    color: #0d1b4b;
  }

  .firmas {
    margin-top: 50px;
    page-break-inside: avoid;
  }
  .firmas-row {
    display: table;
    width: 100%;
  }
  .firma-col {
    display: table-cell;
    width: 48%;
    text-align: center;
    padding: 0 10px;
    vertical-align: top;
  }
  .firma-espacio { height: 55px; }
  .firma-linea {
    border-top: 1.5px solid #0d1b4b;
    margin-bottom: 6px;
  }
  .firma-nombre {
    font-weight: 700;
    font-size: 9.5pt;
    color: #0d1b4b;
  }
  .firma-cargo {
    font-size: 8pt;
    color: #6b7280;
  }
  .firma-separador { display: table-cell; width: 4%; }

  .contrato-footer-num {
    text-align: center;
    font-size: 7.5pt;
    color: #9ca3af;
    margin-top: 30px;
    padding-top: 10px;
    border-top: 1px solid #e8eaf2;
  }

  .vigencia-badge {
    display: inline-block;
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
    border-radius: 12px;
    font-size: 8.5pt;
    font-weight: 700;
    padding: 3px 12px;
  }
</style>
</head>
<body>

<!-- ===================================================== -->
<!-- PORTADA                                               -->
<!-- ===================================================== -->
<div class="portada">

  <div class="portada-header">
    <div class="portada-header-left">
      <div class="brand">PODER <span>LEGAL</span></div>
      <div class="tagline">Protección integral para arrendadores</div>
      <div class="badge-proteccion">&#128737; Protección Segura</div>
    </div>
    <div class="portada-header-right">
      <img src="{{logo_base64}}" alt="Pólizas Jurídicas" />
    </div>
  </div>
  <div class="portada-stripe"></div>

  <div class="portada-body">

    <div class="portada-title">Resumen de Póliza</div>

    <table class="data-table">
      <tr>
        <td class="label">N° Contrato</td>
        <td class="value highlight">{{folio}}</td>
      </tr>
      <tr>
        <td class="label">Nombre del Cliente (Arrendador)</td>
        <td class="value">{{arrendador_nombre_completo}}</td>
      </tr>
      <tr>
        <td class="label">Dirección del Inmueble</td>
        <td class="value">{{inmueble_direccion_completa}}</td>
      </tr>
      <tr>
        <td class="label">Asesor Inmobiliario</td>
        <td class="value">{{tramitante_nombre_completo}}</td>
      </tr>
      <tr>
        <td class="label">Uso del Inmueble</td>
        <td class="value">{{inmueble_uso}}</td>
      </tr>
      <tr>
        <td class="label">Arrendatario (Inquilino)</td>
        <td class="value">{{arrendatario_nombre_completo}}</td>
      </tr>
      <tr>
        <td class="label">Vigencia del Contrato de Renta</td>
        <td class="value">Del {{fecha_inicio_texto}} al {{fecha_termino_texto}}</td>
      </tr>
    </table>

    <div class="paquete-box">
      <div class="paquete-nombre">Paquete Poder Legal</div>
      <div class="paquete-desc">Investigación · Contrato · Cobranza · Asesoría · Representación Jurídica</div>
    </div>

    <div class="financiero-box">
      <div class="financiero-header">Datos Económicos</div>
      <table>
        <tr>
          <td class="flab">Monto Renta Mensual</td>
          <td class="fval">${{monto_renta_mensual}} MXN</td>
        </tr>
        <tr>
          <td class="flab">Precio del Servicio (sin IVA)</td>
          <td class="fval">${{precio_servicio_sin_iva}} MXN</td>
        </tr>
        <tr>
          <td class="flab">IVA (16%)</td>
          <td class="fval">${{iva_servicio}} MXN</td>
        </tr>
        <tr style="background:#f0f4ff;">
          <td class="flab" style="color:#0d1b4b;font-size:10pt;">Total del Servicio (IVA incluido)</td>
          <td class="fval total">${{precio_servicio_con_iva}} MXN</td>
        </tr>
        <tr>
          <td class="flab">Límite de Renta Puntual</td>
          <td class="fval">${{monto_renta_mensual}} MXN / mes</td>
        </tr>
        <tr>
          <td class="flab">Vigencia del Servicio</td>
          <td class="fval"><span class="vigencia-badge">12 meses</span></td>
        </tr>
      </table>
    </div>

    <div class="portada-disclaimer">
      <strong>PODER LEGAL</strong> brinda un servicio legal integral que protege el patrimonio del arrendador a través de
      investigación, contratos, cobranza, asesoría y representación jurídica ante cualquier incumplimiento del arrendamiento.
      Este modelo de acompañamiento <strong>no constituye una fianza ni seguro</strong>, sino una solución especializada para
      prevenir riesgos, asegurar el cumplimiento del contrato y, en caso necesario, recuperar el inmueble y las rentas vencidas
      mediante negociación, mediación o litigio; siempre priorizando la pronta recuperación del inmueble.
    </div>

  </div><!-- /portada-body -->

  <div class="portada-footer">
    GW NETWORK S.A. DE C.V. &nbsp;·&nbsp; Poder Legal &nbsp;·&nbsp; Folio: {{folio}}
  </div>

</div><!-- /portada -->


<!-- ===================================================== -->
<!-- CONTRATO                                              -->
<!-- ===================================================== -->
<div class="contrato">

  <div class="contrato-header">
    <img src="{{logo_base64}}" alt="Pólizas Jurídicas" style="width:70px;height:auto;margin-bottom:6px;" />
    <div class="brand-contrato">PODER <span>LEGAL</span></div>
    <div class="contrato-stripe"></div>
  </div>

  <div class="contrato-titulo">Contrato de Prestación de Servicios</div>

  <p class="intro">
    CONTRATO DE PRESTACIÓN DE SERVICIOS (EL <strong>"CONTRATO"</strong>) QUE CELEBRAN (I)
    <strong>{{arrendador_nombre_completo}}</strong> (EL <strong>"CLIENTE"</strong>), POR PROPIO DERECHO;
    Y LA SOCIEDAD DENOMINADA <strong>GW NETWORK S.A. DE C.V.</strong> (<strong>"PODER LEGAL"</strong>),
    REPRESENTADA EN ESTE ACTO POR <strong>JORGE WHITTEMBURY BELMONTE</strong>;
    CONJUNTAMENTE DENOMINADOS (<strong>LAS "PARTES"</strong>); AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:
  </p>

  <h2 class="seccion">D E C L A R A C I O N E S</h2>

  <p class="declaracion"><span class="num">1. DECLARA EL CLIENTE QUE:</span></p>

  <p class="declaracion">
    <span class="num">A.</span>&nbsp;
    Ser una persona física, con la capacidad legal suficiente para celebrar el presente Contrato.
  </p>

  <p class="declaracion">
    <span class="num">B.</span>&nbsp;
    Su domicilio para efectos legales del presente Contrato se ubica en <strong>{{arrendador_domicilio}}</strong>.
  </p>

  <p class="declaracion">
    <span class="num">C.</span>&nbsp;
    Tener la facultad de arrendar el Inmueble ubicado en: <strong>{{inmueble_direccion_completa}}</strong>
    (el <strong>"Inmueble"</strong>) y haber celebrado sobre el mismo, un (<strong>"Contrato de Arrendamiento"</strong>) con
    <strong>{{arrendatario_nombre_completo}}</strong> (el <strong>"Arrendatario"</strong>) investigado por PODER LEGAL.
  </p>

  <p class="declaracion" style="margin-top:10px;"><span class="num">2. DECLARA PODER LEGAL, A TRAVÉS DE SU APODERADO QUE:</span></p>

  <p class="declaracion">
    <span class="num">A.</span>&nbsp;
    Es una sociedad debidamente constituida y con personalidad jurídica de conformidad con las leyes de los
    Estados Unidos Mexicanos y su apoderado cuenta con las facultades necesarias y suficientes para celebrar el
    presente Contrato.
  </p>

  <p class="declaracion">
    <span class="num">B.</span>&nbsp;
    Se encuentra inscrita en el Registro Federal de Contribuyentes (R.F.C.) bajo la clave correspondiente.
  </p>

  <p class="declaracion">
    <span class="num">C.</span>&nbsp;
    Su domicilio se ubica en Ciudad de México, México.
  </p>

  <h2 class="seccion">C L Á U S U L A S</h2>

  <p class="clausula">
    <span class="clausula-titulo">PRIMERA. Objeto.</span>
    El presente Contrato tiene por objeto definir los términos y condiciones bajo los cuales PODER LEGAL
    prestará al CLIENTE los siguientes servicios:
  </p>

  <p class="clausula">
    <span class="num">A.</span>&nbsp;<strong>Investigación y aprobación del Arrendatario:</strong>
    Previo a la celebración del Contrato de Arrendamiento, PODER LEGAL llevará a cabo una evaluación integral de la
    viabilidad del Arrendatario, que comprenderá el análisis de su solvencia económica, antecedentes legales, historial
    crediticio y verificación de identidad, con el propósito de determinar su aprobación y confirmar que cumple con los
    requisitos necesarios para la celebración y cumplimiento del Contrato de Arrendamiento.
  </p>

  <p class="clausula">
    <span class="num">B.</span>&nbsp;<strong>Elaboración y firma del Contrato:</strong>
    PODER LEGAL asesorará al CLIENTE y elaborará el Contrato de Arrendamiento, así como cualquier documento adicional
    necesario para formalizar o modificar la relación jurídica entre el CLIENTE y su Arrendatario. Esto incluye, de
    manera enunciativa más no limitativa, la elaboración de fe de erratas, convenios modificatorios y cesiones de derechos.
    El CLIENTE podrá elegir entre dos modalidades para la firma del Contrato de Arrendamiento: (i) Firma presencial,
    realizada en el Inmueble o en el lugar que acuerde con su Arrendatario; o (ii) Firma electrónica; ambas modalidades
    asistidas por abogados y mediante el uso de herramientas que aseguren la debida formalización y validez del Contrato.
  </p>

  <p class="clausula">
    <span class="num">C.</span>&nbsp;<strong>Gestión jurídica:</strong>
    PODER LEGAL brindará al CLIENTE el acompañamiento legal necesario ante cualquier incumplimiento de las obligaciones
    a cargo del Arrendatario derivadas del Contrato de Arrendamiento, así como en los procedimientos relacionados con la
    terminación, rescisión y/o recuperación de la posesión del Inmueble. Este servicio comprende:
  </p>

  <p class="clausula">
    &nbsp;&nbsp;&nbsp;<span class="num">(i) Procedimientos extrajudiciales:</span>
    PODER LEGAL podrá implementar las acciones necesarias para buscar una solución sin acudir a juicio, incluyendo de
    manera enunciativa más no limitativa: cobranza, negociación y cualquier otro mecanismo alterno que considere pertinente.
  </p>

  <p class="clausula">
    &nbsp;&nbsp;&nbsp;<span class="num">(ii) Procedimientos judiciales:</span>
    Cuando resulte necesario, PODER LEGAL promoverá el juicio correspondiente ante la autoridad competente y dará
    seguimiento al proceso legal hasta su conclusión.
  </p>

  <p class="clausula">
    La obligación de PODER LEGAL permanecerá vigente hasta que la posesión del Inmueble sea entregada al CLIENTE,
    sin importar el tiempo requerido ni la causa del incumplimiento, incluyendo de manera enunciativa más no limitativa por:
    impago de rentas, abandono del Inmueble, cambio no autorizado de uso o destino y procedimientos en relación con
    extinción de dominio. El CLIENTE se obliga a firmar oportunamente todos los documentos, demandas y demás instrumentos
    legales necesarios para ejecutar la estrategia definida por PODER LEGAL.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">SEGUNDA. Contraprestación.</span>
    La contraprestación a pagar a favor de PODER LEGAL será por un total de
    <strong>${{precio_servicio_sin_iva}} M.N.</strong> más el correspondiente Impuesto al Valor Agregado (I.V.A.),
    equivalente a un monto total de <strong>${{precio_servicio_con_iva}} M.N.</strong> (la <strong>"Contraprestación"</strong>).
    El presente Contrato y todas las obligaciones a cargo de PODER LEGAL no tendrán validez hasta que la Contraprestación
    haya sido cubierta en su totalidad por el CLIENTE o la persona que este designe.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">TERCERA. Vigencia.</span>
    El presente Contrato tendrá una duración de 12 (doce) meses contados a partir del <strong>{{fecha_inicio_texto}}</strong>.
    No obstante, en caso de que a la fecha de terminación exista alguna obligación pendiente de cumplimiento por
    cualquiera de las Partes, este Contrato continuará vigente únicamente respecto de dichas obligaciones, hasta que sean
    debidamente satisfechas conforme a lo establecido en el presente instrumento.
  </p>

  <p class="clausula">
    En caso de que el Contrato de Arrendamiento finalice de manera anticipada o tenga una vigencia menor a la del presente
    Contrato, las obligaciones de PODER LEGAL concluirán en la misma fecha en que termine la relación contractual entre el
    CLIENTE y su Arrendatario, siempre y cuando todas las obligaciones pendientes entre las Partes hayan sido debidamente finiquitadas.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">CUARTA. Cobranza y representación.</span>
    En caso de incumplimiento en el pago de la Renta por parte del Arrendatario, PODER LEGAL podrá realizar gestiones de
    cobranza únicamente relacionadas con dicho incumplimiento, tales como requerimientos de pago, comunicación directa,
    seguimiento de acuerdos de pago, así como emitir y suscribir títulos de crédito. El CLIENTE autoriza a PODER LEGAL a
    recibir, en su nombre y representación, cantidades que el Arrendatario entregue exclusivamente como parte del proceso
    de incumplimiento.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">QUINTA. Pena convencional.</span>
    En caso de terminación anticipada por causas imputables a PODER LEGAL, éste deberá cumplir, dentro de los 5 (cinco)
    días hábiles siguientes a la fecha de terminación, con todas las obligaciones exigibles hasta ese momento conforme al
    presente Contrato. Asimismo, se establece una pena convencional equivalente a tres veces la Contraprestación, la cual
    será aplicable únicamente cuando la terminación derive de un incumplimiento atribuible a PODER LEGAL.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">SEXTA. Impuestos, gastos y responsabilidad laboral.</span>
    Todos los impuestos y contribuciones que se generen o se deriven con motivo de la celebración del presente Contrato así
    como del Contrato de Arrendamiento, serán responsabilidad exclusiva de la parte a la que le corresponda en términos de
    las leyes fiscales aplicables. El presente Contrato no crea ni constituye una relación laboral, asociación, sociedad o
    acuerdo similar entre las Partes, por lo que cada parte es y se mantendrá independiente.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">SÉPTIMA. Notificaciones.</span>
    Todos los avisos y notificaciones entre las Partes deberán realizarse por escrito por correo electrónico a las
    direcciones señaladas en las declaraciones del presente Contrato. Las Partes deberán notificar cualquier cambio de
    correo electrónico para la recepción de las notificaciones relacionadas con el presente Contrato.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">OCTAVA. Acuerdo total y confidencialidad.</span>
    El presente Contrato constituye la expresión completa y exclusiva de los acuerdos a los que han llegado las Partes en
    relación con la prestación de servicios otorgada por PODER LEGAL y sustituyen a cualquier otra propuesta o convenio.
    Cualquier modificación deberá constar por escrito firmado por ambas Partes. Las Partes se obligan a mantener la
    confidencialidad de la información que con motivo de la celebración de este Contrato sea compartida entre ellas de
    acuerdo al aviso de privacidad de PODER LEGAL.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">NOVENA. Legislación aplicable y jurisdicción.</span>
    Para todo lo relacionado a la interpretación y cumplimiento del presente Contrato, las Partes se someten a las leyes
    aplicables y tribunales competentes de la Ciudad de México, renunciando por tanto al fuero que pudiera corresponderles
    por razón de sus domicilios presentes o futuros o por cualquier otra causa.
  </p>

  <p class="clausula">
    <span class="clausula-titulo">DÉCIMA. Firma electrónica.</span>
    Las Partes manifiestan su consentimiento expreso de forma digital en el presente instrumento, existente a través de
    su firma; mismo que no se vio influenciado por ningún vicio que pudiera nulificarlo en todo o en parte, de conformidad
    con el artículo 1803 del Código Civil para el Distrito Federal.
  </p>

  <p class="clausula">
    Leído por las Partes el presente instrumento y enteradas de su alcance y fuerzas legales, lo suscriben de forma
    digital con fecha de inicio de vigencia el <strong>{{fecha_inicio_texto}}</strong>.
  </p>

  <!-- Firmas -->
  <div class="firmas">
    <div class="firmas-row">
      <div class="firma-col">
        <div class="firma-espacio"></div>
        <div class="firma-linea"></div>
        <div class="firma-nombre">{{arrendador_nombre_completo}}</div>
        <div class="firma-cargo">CLIENTE · Por propio derecho</div>
      </div>
      <div class="firma-separador"></div>
      <div class="firma-col">
        <div class="firma-espacio"></div>
        <div class="firma-linea"></div>
        <div class="firma-nombre">JORGE WHITTEMBURY BELMONTE</div>
        <div class="firma-cargo">PODER LEGAL · Apoderado Legal<br>GW NETWORK S.A. DE C.V.</div>
      </div>
    </div>
  </div>

  <div class="contrato-footer-num">
    Póliza No. {{folio}} &nbsp;·&nbsp; GW NETWORK S.A. DE C.V. (PODER LEGAL) &nbsp;·&nbsp; Página 1 de 1
  </div>

</div><!-- /contrato -->

</body>
</html>
HTML;

        PlantillaContrato::updateOrCreate(
            ['slug' => 'poliza-poder-legal'],
            [
                'nombre'               => 'Póliza Poder Legal',
                'contenido_html'       => $html,
                'variables_detectadas' => [],
                'activa'               => true,
            ]
        );
    }
}
