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
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 8.5pt;
    color: #1a1a1a;
    background: #fff;
  }

  /* PORTADA */
  .portada {
    padding: 0;
    position: relative;
  }

  /* Header con franja amarilla diagonal */
  .header-portada {
    position: relative;
    padding: 20px 30px 15px;
    background: #fff;
    border-top: 10px solid #4A148C;
    overflow: hidden;
  }
  .diagonal-stripe {
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 150px;
    background: #FFC107;
    transform: skewX(-20deg);
    transform-origin: top right;
  }
  .header-content {
    display: table;
    width: 100%;
    position: relative;
    z-index: 2;
  }
  .header-left {
    display: table-cell;
    vertical-align: top;
    width: 65%;
  }
  .header-right {
    display: table-cell;
    vertical-align: top;
    text-align: right;
    width: 35%;
  }
  .logo-poder {
    font-size: 24pt;
    font-weight: 900;
    color: #4A148C;
    letter-spacing: 0.5px;
    line-height: 1;
  }
  .logo-poder .sup {
    font-size: 10pt;
    vertical-align: super;
  }
  .sub-logo {
    font-size: 9pt;
    color: #FFC107;
    font-weight: 700;
    margin-top: 2px;
    letter-spacing: 1.5px;
  }
  .tagline-seguridad {
    font-size: 7pt;
    color: #666;
    margin-top: 3px;
    font-weight: 600;
  }
  .escudo-logo {
    width: 85px;
    height: auto;
    margin-top: 5px;
  }

  /* Cuerpo de la portada */
  .body-portada {
    padding: 15px 30px 15px;
  }

  /* Layout de 2 columnas para la primera fila */
  .fila-superior {
    display: table;
    width: 100%;
    table-layout: fixed;
    margin-bottom: 12px;
  }
  .col-sup-izq {
    display: table-cell;
    width: 54%;
    padding-right: 6px;
    vertical-align: top;
  }
  .col-sup-der {
    display: table-cell;
    width: 46%;
    padding-left: 6px;
    vertical-align: top;
  }

  /* Secciones ancho completo */
  .seccion-completa {
    width: 100%;
    margin-bottom: 10px;
  }

  /* Secciones con icono amarillo */
  .seccion-box {
    border: 3px solid #4A148C;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
  }
  .seccion-header {
    background: #4A148C;
    color: #fff;
    padding: 9px 14px;
    font-size: 7.5pt;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: table;
    width: 100%;
  }
  .seccion-icon {
    display: table-cell;
    width: 28px;
    vertical-align: middle;
  }
  .seccion-icon-img {
    width: 24px;
    height: 24px;
    background: #FFC107;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    color: #4A148C;
    font-size: 11pt;
    line-height: 24px;
    text-align: center;
  }
  .seccion-titulo {
    display: table-cell;
    vertical-align: middle;
    padding-left: 5px;
  }
  .seccion-content {
    padding: 8px 12px;
    background: #fff;
  }

  /* Tabla de datos dentro de secciones */
  .datos-table {
    width: 100%;
    border-collapse: collapse;
  }
  .datos-table tr {
    border-bottom: 1px solid #e5e7eb;
  }
  .datos-table tr:last-child {
    border-bottom: none;
  }
  .datos-table td {
    padding: 6px 0;
    font-size: 8pt;
    vertical-align: top;
  }
  .datos-table td:first-child {
    font-weight: 800;
    color: #4A148C;
    text-transform: uppercase;
    width: 48%;
    font-size: 7pt;
    letter-spacing: 0.4px;
  }
  .datos-table td:last-child {
    color: #1a1a1a;
    font-weight: 600;
    padding-left: 10px;
  }

  /* Tabla de cobertura con montos */
  .cobertura-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0;
  }
  .cobertura-table thead th {
    padding: 7px 12px;
    font-size: 7pt;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
    border: none;
  }
  .cobertura-table thead th:first-child {
    background: #4A148C;
    color: #fff;
    text-align: center;
    border-radius: 0;
  }
  .cobertura-table thead th:last-child {
    background: #FFC107;
    color: #4A148C;
    text-align: center;
    border-radius: 0;
    font-weight: 900;
  }
  .cobertura-table tbody td {
    padding: 10px 12px;
    font-size: 7.5pt;
    border: 1px solid #e5e7eb;
    border-top: none;
    background: #fff;
  }
  .cobertura-table tbody td:first-child {
    font-weight: 700;
    color: #4A148C;
    text-transform: uppercase;
    text-align: left;
    letter-spacing: 0.3px;
  }
  .cobertura-table tbody td:last-child {
    text-align: right;
    font-weight: 700;
    color: #1a1a1a;
  }
  .total-row td {
    background: #4A148C !important;
    color: #FFC107 !important;
    font-weight: 900 !important;
    font-size: 9pt !important;
    padding: 12px !important;
    border: none !important;
  }
  .total-row td:first-child {
    color: #FFC107 !important;
    text-align: left !important;
  }
  .total-row td:last-child {
    text-align: right !important;
    color: #FFC107 !important;
  }

  /* Footer */
  .footer-portada {
    margin-top: 350px;
    background: #4A148C;
    color: #fff;
    padding: 18px 30px;
    font-size: 7pt;
    border-top: 5px solid #FFC107;
  }
  .footer-grid {
    display: table;
    width: 100%;
    table-layout: fixed;
  }
  .footer-col {
    display: table-cell;
    vertical-align: middle;
    padding: 0 12px;
  }
  .footer-icono-escudo {
    width: 50px;
    height: 50px;
    background: #FFC107;
    border: 3px solid #4A148C;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 22pt;
    color: #4A148C;
    vertical-align: middle;
    margin-right: 12px;
  }
  .footer-titulo {
    font-weight: 800;
    font-size: 8pt;
    line-height: 1.3;
    margin-bottom: 3px;
    text-transform: uppercase;
    color: #fff;
  }
  .footer-detalle {
    font-size: 7pt;
    line-height: 1.4;
    font-weight: 400;
    color: #fff;
  }
  .footer-detalle strong {
    font-weight: 700;
  }
  .footer-separador {
    width: 2px;
    height: 50px;
    background: rgba(255,255,255,0.3);
    display: inline-block;
    vertical-align: middle;
  }

  /* ===== ESTILOS CONTRATO ===== */
  .contrato {
    padding: 2cm 2.5cm;
    page-break-before: always;
  }
  .contrato-header {
    text-align: center;
    margin-bottom: 24px;
  }
  .contrato-header .brand-contrato {
    font-size: 16pt;
    font-weight: 900;
    color: #4A148C;
    letter-spacing: 3px;
    text-transform: uppercase;
  }
  .contrato-header .brand-contrato span { color: #FFC107; }
  .contrato-stripe {
    height: 3px;
    background: linear-gradient(to right, #4A148C, #FFC107, #4A148C);
    margin: 10px auto 18px;
    width: 60%;
  }
  .contrato-titulo {
    text-align: center;
    font-size: 11pt;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #4A148C;
    margin-bottom: 18px;
    border-bottom: 1.5px solid #e8eaf2;
    padding-bottom: 10px;
  }

  .intro { text-align: justify; margin-bottom: 16px; font-size: 9.5pt; line-height: 1.5; }

  h2.seccion {
    font-size: 10pt;
    font-weight: 800;
    text-align: center;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #4A148C;
    margin: 20px 0 10px;
  }
  .declaracion {
    margin-bottom: 8px;
    text-align: justify;
    font-size: 9.5pt;
    line-height: 1.5;
  }
  .declaracion .num {
    font-weight: 700;
    color: #4A148C;
  }

  .clausula {
    margin-bottom: 12px;
    text-align: justify;
    font-size: 9.5pt;
    line-height: 1.5;
  }
  .clausula .clausula-titulo {
    font-weight: 800;
    text-transform: uppercase;
    color: #4A148C;
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
    border-top: 1.5px solid #4A148C;
    margin-bottom: 6px;
  }
  .firma-nombre {
    font-weight: 700;
    font-size: 9.5pt;
    color: #4A148C;
  }
  .firma-cargo {
    font-size: 8pt;
    color: #6b7280;
    line-height: 1.3;
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
</style>
</head>
<body>

<!-- PORTADA -->
<div class="portada">
  <!-- Header -->
  <div class="header-portada">
    <div class="diagonal-stripe"></div>
    <div class="header-content">
      <div class="header-left">
        <div class="logo-poder">PODER <span class="sup">®</span> LEGAL</div>
        <div class="sub-logo">— PÓLIZAS JURÍDICAS —</div>
        <div class="tagline-seguridad">SEGURIDAD EN TUS ARRENDAMIENTOS</div>
      </div>
      <div class="header-right">
        <img src="{{logo_base64}}" alt="Escudo" class="escudo-logo" />
      </div>
    </div>
  </div>

  <!-- Cuerpo -->
  <div class="body-portada">
    
    <!-- Primera Fila: DATOS GENERALES y DATOS DE COBERTURA lado a lado -->
    <div class="fila-superior">
      <!-- DATOS GENERALES -->
      <div class="col-sup-izq">
        <div class="seccion-box">
          <div class="seccion-header">
            <div class="seccion-icon"><span class="seccion-icon-img">i</span></div>
            <div class="seccion-titulo">DATOS GENERALES</div>
          </div>
          <div class="seccion-content">
            <table class="datos-table">
              <tr>
                <td>Póliza</td>
                <td>{{numero_poliza}}</td>
              </tr>
              <tr>
                <td>Cobertura</td>
                <td>{{tipo_producto}}</td>
              </tr>
              <tr>
                <td>Contrato</td>
                <td>{{folio}}</td>
              </tr>
              <tr>
                <td>Inicio de Vigencia</td>
                <td>{{fecha_inicio_texto}}</td>
              </tr>
              <tr>
                <td>Fin de Vigencia</td>
                <td>{{fecha_termino_texto}}</td>
              </tr>
              <tr>
                <td>Fecha de Emisión</td>
                <td>{{fecha_emision}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <!-- DATOS DE COBERTURA -->
      <div class="col-sup-der">
        <div class="seccion-box">
          <div class="seccion-header">
            <div class="seccion-icon"><span class="seccion-icon-img">$</span></div>
            <div class="seccion-titulo">DATOS DE COBERTURA</div>
          </div>
          <div class="seccion-content">
            <table class="cobertura-table">
              <thead>
                <tr>
                  <th>CONCEPTO</th>
                  <th>MONTO</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>COMPLETA</td>
                  <td>$ {{precio_servicio_sin_iva}}</td>
                </tr>
                <tr>
                  <td>SUBTOTAL</td>
                  <td>$ {{iva_servicio}}</td>
                </tr>
                <tr class="total-row">
                  <td>TOTAL</td>
                  <td>$ {{precio_servicio_con_iva}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Secciones de Ancho Completo -->
    
    <!-- DATOS DE LA INMOBILIARIA -->
    <div class="seccion-completa">
      <div class="seccion-box">
        <div class="seccion-header">
          <div class="seccion-icon"><span class="seccion-icon-img">i</span></div>
          <div class="seccion-titulo">DATOS DE LA INMOBILIARIA</div>
        </div>
        <div class="seccion-content">
          <table class="datos-table">
            <tr>
              <td>Solicitante Inmobiliaria (Asesor)</td>
              <td>{{tramitante_nombre_completo}}</td>
            </tr>
            <tr>
              <td>Inmobiliaria</td>
              <td>{{tramitante_inmobiliaria}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <!-- DATOS DEL ARRENDADOR -->
    <div class="seccion-completa">
      <div class="seccion-box">
        <div class="seccion-header">
          <div class="seccion-icon"><span class="seccion-icon-img">A</span></div>
          <div class="seccion-titulo">DATOS DEL ARRENDADOR (PROPIETARIO)</div>
        </div>
        <div class="seccion-content">
          <table class="datos-table">
            <tr>
              <td>Nombre</td>
              <td>{{arrendador_nombre_completo}}</td>
            </tr>
            <tr>
              <td>Domicilio</td>
              <td>{{arrendador_domicilio}}</td>
            </tr>
            <tr>
              <td>Teléfono</td>
              <td>{{arrendador_telefono}}</td>
            </tr>
            <tr>
              <td>Correo</td>
              <td>{{arrendador_email}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <!-- DATOS DEL ARRENDATARIO -->
    <div class="seccion-completa">
      <div class="seccion-box">
        <div class="seccion-header">
          <div class="seccion-icon"><span class="seccion-icon-img">I</span></div>
          <div class="seccion-titulo">DATOS DEL ARRENDATARIO (INQUILINO)</div>
        </div>
        <div class="seccion-content">
          <table class="datos-table">
            <tr>
              <td>Nombre</td>
              <td>{{arrendatario_nombre_completo}}</td>
            </tr>
            <tr>
              <td>Teléfono</td>
              <td>{{arrendatario_telefono}}</td>
            </tr>
            <tr>
              <td>Correo</td>
              <td>{{arrendatario_email}}</td>
            </tr>
            <tr>
              <td>Domicilio</td>
              <td>{{inmueble_direccion_completa}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <!-- DATOS DEL CONTRATO -->
    <div class="seccion-completa">
      <div class="seccion-box">
        <div class="seccion-header">
          <div class="seccion-icon"><span class="seccion-icon-img">C</span></div>
          <div class="seccion-titulo">DATOS DEL CONTRATO</div>
        </div>
        <div class="seccion-content">
          <table class="datos-table">
            <tr>
              <td>Monto de Renta Mensual</td>
              <td>${{monto_renta_mensual}} MXN</td>
            </tr>
            <tr>
              <td>Monto de IVA Mensual</td>
              <td>${{monto_iva_renta}} MXN</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Footer -->
  <div class="footer-portada">
    <div class="footer-grid">
      <div class="footer-col" style="width:35%;text-align:left;">
        <div class="footer-titulo">PÓLIZAS JURÍDICAS</div>
        <div class="footer-detalle">Protección integral para arrendadores e inmobiliarias.</div>
      </div>
      <div class="footer-col" style="width:35%;text-align:center;">
        <div class="footer-titulo">ESTE DOCUMENTO NO ES VÁLIDO<br>COMO RECIBO DE PAGO.</div>
      </div>
      <div class="footer-col" style="width:30%;text-align:right;">
        <div class="footer-detalle"><strong>www.poderlegal.mx</strong></div>
        <div class="footer-detalle"><strong>(55) 8920 9955</strong></div>
        <div class="footer-detalle"><strong>contacto@poderlegal.mx</strong></div>
      </div>
    </div>
  </div>
</div>

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
    Póliza No. {{numero_poliza}} &nbsp;·&nbsp; GW NETWORK S.A. DE C.V. (PODER LEGAL) &nbsp;·&nbsp; Página 1 de 1
  </div>

</div>

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
