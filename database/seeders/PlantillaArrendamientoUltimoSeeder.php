<?php

namespace Database\Seeders;

use App\Models\PlantillaContrato;
use Illuminate\Database\Seeder;

class PlantillaArrendamientoUltimoSeeder extends Seeder
{
    public function run(): void
    {
        $html = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: "Times New Roman", Times, serif; font-size: 11pt; line-height: 1.5; margin: 1cm 1.5cm; color: #000; }
  p { margin: 6px 0; text-align: justify; }
  strong { font-weight: bold; }
  .viñeta { margin-left: 20px; }
  .seccion-titulo { text-align: center; font-weight: bold; letter-spacing: 2px; margin: 12px 0 8px 0; }
  .firma-espacio { height: 60px; }
    strong { font-weight: 900; }
  .firma-section { margin-top: 60px; }
  .firma-row { display: table; width: 100%; margin-top: 20px; }
  .firma-box { display: table-cell; text-align: center; width: 50%; padding: 0 20px; }
  .firma-line { border-top: 1px solid #000; margin-top: 60px; margin-bottom: 8px; }
  .firma-linefiador {
    border-top: 1px solid #000;
    width: 450px;
    margin: 60px auto 8px auto;
}
  .firma-nombre { text-align: center; margin-top: 4px; }
  .clausula-num { font-weight: bold; }
  .uppercase { text-transform: uppercase; }
</style>
</head>
<body>

<p style=" font-weight: bold; margin-bottom: 15px;">
CONTRATO DE ARRENDAMIENTO QUE CELEBRAN POR UNA PARTE {{arrendador_nombre_completo}}, A QUIEN EN LO SUCESIVO Y PARA LOS EFECTOS 
DEL PRESENTE INSTRUMENTO SE LE DENOMINARA "EL ARRENDADOR", POR LA OTRA {{arrendatario_nombre_completo}}, A QUIEN EN LO 
SUCESIVO SE LE DENOMINARA "EL ARRENDATARIO"; Y {{fiador_nombre_completo}} A QUIEN EN LO SUCESIVO SE LE DENOMINARA EL 
"OBLIGADO SOLIDARIO" TODOS LOS CUALES SE SUJETAN A LAS SIGUIENTES DECLARACIONES Y CLAUSULAS:
</p>

<div class="seccion-titulo">D E C L A R A C I O N E S</div>

<p><strong>I.- DECLARA "EL ARRENDADOR":</strong></p>
<div class="viñeta">
<p>a) Que cuenta con la capacidad jurídica suficiente y bastante para celebrar el presente contrato.</p>
<p>b) Que es propietario del inmueble ubicado en {{inmueble_direccion_completa}} con INE {{fiador_numero_ine}} CURP {{fiador_numero_ine}} email {{arrendador_email}} teléfono {{arrendador_telefono}}</p>
<p>c) Que para efectos de este contrato señala como su domicilio para recibir y oír toda clase de notificaciones el ubicado {{arrendador_domicilio}}</p>
</div>

<p><strong>II.- DECLARA "EL ARRENDATARIO":</strong></p>
<div class="viñeta">
<p>a) Que tiene las facultades suficientes y bastantes para obligarse en términos del presente instrumento.</p>
<p>b) Que tiene interés en recibir en arrendamiento el inmueble que se describe en el inciso b), de la declaración número I, el cual sabe y le consta, se encuentra en las condiciones necesarias de seguridad, higiene y salubridad para ser habitado y que cuenta con el equipo en perfecto por lo que no condicionará el pago de rentas a ningún tipo de mejora.</p>
<p>c) Que para efectos del presente contrato señala como su domicilio para recibir y oír toda clase de notificaciones el mismo inmueble motivo del arrendamiento y el ubicado {{arrendatario_email}}</p>
<p>d) Ser una persona {{arrendatario_tipo_persona}}, con capacidad económica para fungir en el presente contrato como "EL ARRENDATARIO", obligándose en los términos del mismo.</p>
</div>

{{seccion_fiador_ultimo}}

<p><strong>III.- DECLARAN LAS PARTES</strong></p>
<div class="viñeta">
<p>a) Que en el presente contrato no existe dolo, error, mala fe o cualquier otro vicio de la voluntad, por lo que expresamente renuncian a invocarlos en cualquier tiempo.</p>
<p>b) Que se reconocen la personalidad con la que comparecen a la celebración de este contrato y expresamente convienen en someterse a las obligaciones contenidas en las siguientes:</p>
</div>

<div class="seccion-titulo">C L Á U S U L A S</div>

<p><strong>PRIMERA. - OBJETO.</strong> - "EL ARRENDADOR" da en arrendamiento al "ARRENDATARIO", y éste toma en dicha calidad, el inmueble que se describe en el inciso b) de la declaración I que antecede.</p>

<p><strong>SEGUNDA. - RENTA.</strong> - Las partes convienen voluntariamente y de común acuerdo que "EL ARRENDATARIO" pagará a "EL ARRENDADOR" o a quien sus derechos representen, por concepto de contraprestación una renta mensual en los siguientes términos:</p>
<div class="viñeta">
<p>a) El monto de la renta mensual será de {{monto_renta_mensual}} M.N. ({{monto_renta_mensual_letra}})</p>
<p>b) El pago de la renta mensual será por meses adelantados, siéndole forzoso todo el mes y debiendo cubrir íntegra la mensualidad, aun cuando no usare el inmueble de tiempo completo.</p>
<p>c) A la fecha de firma del presente contrato, "EL ARRENDATARIO" paga a "EL ARRENDADOR", el primer mes de renta, sirviendo el presente contrato como el recibo más eficaz que en derecho corresponda.</p>
<p>d) El pago de la renta mensual se cubrirá en su totalidad dentro de los primeros CINCO DÍAS contados a partir del día 1 de cada mes, en efectivo o en la cuenta que indique por escrito "EL ARRENDADOR", y empezará a cubrirse a partir de la fecha de inicio de la vigencia del presente instrumento, siendo causa de rescisión de contrato el hecho de que se cubra extemporáneamente una mensualidad o más, o de que ésta no sea cubierta, en cuyo caso "EL ARRENDATARIO" acepta que se le embarguen bienes muebles u objetos de los que introduzca en la localidad arrendada y que declara desde hoy que son de su exclusiva propiedad, los que entregará desde luego a la persona que "EL ARRENDADOR" nombre como depositario.</p>
<p>e) No podrá en ningún caso "EL ARRENDATARIO", retener las rentas, bajo ningún título judicial, ni extrajudicialmente, debiendo hacer el pago íntegro, a más tardar en el plazo que se describe en el inciso d) de esta cláusula, por lo que de no hacerlo en el tiempo, modo y lugar convenidos, pagará la pena convencional del 1% (uno por ciento) diario, sobre el importe de la renta, sin perjuicio de lo que estipula dicho inciso d).</p>
</div>

<p><strong>TERCERA.- SERVICIOS.</strong> - "EL ARRENDATARIO" se obliga a cubrir oportunamente el importe de los servicios de energía eléctrica, servicio de agua potable y gas, así como a entregar los recibos originales liquidados por tales conceptos y por el servicio telefónico si es que lo hubiere, a "EL ARRENDADOR" o a quien sus derechos representen inmediatamente después de haber sido pagados.</p>

<p><strong>CUARTA. - ESTACIONAMIENTO.</strong> - "EL ARRENDATARIO" deberá ocupar como área de estacionamiento únicamente los {{inmueble_estacionamiento}} espacio(s) que le sean asignados para ello. "EL ARRENDADOR" no es responsable de los daños que sufran los vehículos de "EL ARRENDATARIO" en el estacionamiento ni de la seguridad de los mismos.</p>

<p><strong>QUINTA. - MEJORAS.</strong> - Todas las mejoras, modificaciones y adaptaciones que se realicen en el inmueble, serán cubiertas por "EL ARRENDATARIO", incluyendo los desperfectos no atribuibles al uso normal del inmueble. Dichas mejoras deberán poner a consideración de "EL ARRENDADOR" y se realizarán únicamente con autorización por escrito de éste.</p>

<p><strong>SEXTA. - LIMPIEZA.</strong> - "EL ARRENDATARIO", deberá tener limpias todas las áreas que correspondan al inmueble, así mismos conductos de cañerías y drenajes que a éste correspondan, para evitar humedades y goteras; de no hacerlo, cualquier daño corre por su cuenta.</p>

<p><strong>SÉPTIMA. - FORMA DE USO.</strong> - "EL ARRENDATARIO" podrá gozar y disponer del inmueble arrendado en forma ordenada y tranquila no debiendo destinarlo a usos contrarios a la moral y a las buenas costumbres. Ambas partes convienen en que queda prohibido tener animales o ejecutar actos que perturben la seguridad o tranquilidad de los vecinos.</p>

<p><strong>OCTAVA. - USO DE SUELO.</strong> - El inmueble será destinado únicamente para uso {{inmueble_uso}}, quedándole prohibido a "EL ARRENDATARIO" y éste lo acepta expresamente, cambiar el uso referido o destinarlo a un uso distinto, salvo autorización escrita de "EL ARRENDADOR".</p>

<p><strong>NOVENA. - CESIÓN DE DERECHOS.</strong> - "EL ARRENDATARIO" tampoco podrá subarrendar, traspasar o ceder sus derechos de inquilino del inmueble en todo o en parte, a cualquier otra persona. El incumplimiento a esta cláusula tendrá como consecuencia que "EL ARRENDATARIO" deberá pagar a "EL ARRENDADOR" la cantidad equivalente al cien por ciento de las rentas correspondientes, al término del arrendamiento a título de pena convencional.</p>

<p><strong>DÉCIMA. - SUSTANCIAS PELIGROSAS.</strong> - Las partes acuerdan que queda prohibido almacenar sustancias peligrosas, inflamables, corrosivas, deletéreas o ilegales dentro del inmueble. En caso de siniestro, "EL ARRENDATARIO" deberá cubrir a "EL ARRENDADOR" y a los demás vecinos que resulten afectados los daños y perjuicios que les ocasione.</p>

<p><strong>DÉCIMA PRIMERA. - DAÑOS O FALTANTES.</strong> - "EL ARRENDADOR" no se hace responsable de los daños o faltantes sufridos en vehículos, bienes muebles o patrimonio de "EL ARRENDATARIO", durante la ocupación o desocupación del inmueble.</p>

<p><strong>DÉCIMA SEGUNDA. - CUIDADO DEL INMUEBLE.</strong> - "EL ARRENDATARIO" se obliga a no perforar azulejos, pisos, puertas, o colocar muebles que dañen los acabados del inmueble, sin previa autorización por escrito de "EL ARRENDADOR" y a darle el mantenimiento adecuado y oportuno a los muebles que forman parte de las instalaciones del inmueble.</p>

<p><strong>DÉCIMA TERCERA.- VIGENCIA.</strong> - El presente contrato tendrá un plazo forzoso para ambas partes, comenzando el {{fecha_inicio_texto}}, debiendo avisar "EL ARRENDATARIO" a "EL ARRENDADOR" por escrito con treinta días de anticipación a su vencimiento, si es su deseo continuar con el arrendamiento. Ambas partes convienen que, a la renovación, la renta se incrementará EN UN 10% O CONFORME AL ÍNDICE INFLACIONARIO DETERMINADO POR EL INEGI (INSTITUTO NACIONAL DE ESTADÍSTICA Y GEOGRAFÍA), lo que resulte mayor.</p>

<p><strong>DÉCIMA CUARTA.- DESOCUPACIÓN.</strong> - Las partes acuerdan que si al término del presente contrato no hubiere renovación del mismo, "EL ARRENDATARIO" estará obligado a desocupar el inmueble arrendado a más tardar en la fecha de su vencimiento y si por cualquier motivo no lo hiciere, deberá pagar el doble de la renta pactada.</p>

<p><strong>DÉCIMA QUINTA. - TERMINACIÓN ANTICIPADA.</strong> - En caso de que "EL ARRENDATARIO" pretenda dar por concluido el arrendamiento antes de su vencimiento, cualquiera que sea la causa, pagará como pena convencional el importe de tres meses de renta al 100% por ciento, o el importe de los meses que falten para el vencimiento de este contrato, lo que resulte menor.</p>

<p><strong>DÉCIMA SEXTA.- SINIESTROS Y CLAUSURAS.</strong> - Los daños ocasionados al inmueble, así como a los colindantes, por siniestros originados por culpa o negligencia de "EL ARRENDATARIO" y/o de toda persona que viva en o visite el inmueble, serán de la exclusiva responsabilidad de los primeros.</p>

<p><strong>DÉCIMA SÉPTIMA. - EXTINCIÓN DE DOMINIO</strong> - Las partes manifiestan que conocen el contenido y alcance de la Ley Federal de Extinción de Dominio, reglamentaria del artículo 22 de la Constitución Política de los Estados Unidos Mexicanos, y por tal motivo el "ARRENDADOR" declara que el bien objeto del presente Contrato no es producto o se encuentra relacionado o vinculados a los delitos de delincuencia organizada, delitos contra la salud, secuestro, robo de vehículos, trata de personas o enriquecimiento ilícito.</p>

<p>El "ARRENDATARIO" manifiesta BAJO PROTESTA DE DECIR VERDAD que todas las actividades que se realizarán dentro del "INMUEBLE" serán lícitas, por lo que cualquier acto que tenga lugar al interior de la localidad arrendada es de su más estricta responsabilidad y sin conocimiento ni responsabilidad alguna por parte del "ARRENDADOR".</p>

<p><strong>DÉCIMA OCTAVA - DEPÓSITO EN GARANTÍA.</strong> - A la fecha de firma del presente contrato "EL ARRENDATARIO" entrega a "EL ARRENDADOR" por concepto de depósito una cantidad igual al importe de {{deposito_garantia}} M.N. ({{deposito_garantia_letra}}), establecida en este contrato. En caso de variación en el monto de la renta, éste depósito se ajustará dentro de los cinco días siguientes.</p>

<p><strong>VIGÉSIMA- OBLIGADO SOLIDARIO.</strong> - En garantía al cumplimiento de las obligaciones contraídas en el presente contrato por parte de "EL ARRENDATARIO", "EL OBLIGADO SOLIDARIO" lo firma solidariamente, constituyéndose así en pagador de todas y cada una de dichas obligaciones, renunciando expresamente a los beneficios de orden y excusión en el presente contrato.</p>

<p><strong>VIGÉSIMA PRIMERA. - PÓLIZA JURÍDICA.</strong> - "EL ARRENDATARIO" se obliga a tramitar una PÓLIZA JURÍDICA, para garantizar la desocupación por el incumplimiento en el pago de rentas y pago de servicios. Los gastos y honorarios que se originen serán por cuenta de "EL ARRENDATARIO".</p>

<p><strong>VIGÉSIMA SEGUNDA.- DE NO RESPONSABILIDAD PENAL.</strong> - Las partes ratifican que el presente contrato de arrendamiento es celebrado de buena fe, "EL ARRENDATARIO" libera a "EL ARRENDADOR" de toda responsabilidad en la que pudiera verse involucrado, derivado de la comisión de delitos consumados dentro o fuera del inmueble referido.</p>

<p><strong>VIGÉSIMA TERCERA- CAUSAL DE RESCISIÓN AUTOMÁTICA.</strong> - Será causa de rescisión automática del presente contrato de arrendamiento, el solo hecho de que el bien inmueble objeto del presente instrumento sea asegurado o resguardado por cualquier autoridad o que se inicie averiguación previa en contra de "EL ARRENDATARIO".</p>

<p><strong>VIGÉSIMA CUARTA. - RESCISIÓN.</strong> - La falsedad en las declaraciones vertidas en este contrato y/o el incumplimiento de las partes a cualquiera de las cláusulas contenidas en el mismo, será motivo de su rescisión, sin perjuicio de las consecuencias legales procedentes.</p>

<p><strong>VIGÉSIMA QUINTA - CONVENIOS MODIFICATORIOS.</strong> - Las partes están de acuerdo en que se efectúen modificaciones al presente contrato, éstas podrán ser únicamente de forma y no de fondo. Para su validez deberán constar por escrito, con firma autógrafa y se añadirán al presente contrato formando parte integrante del mismo.</p>

<p><strong>VIGÉSIMA SEXTA - COMPETENCIA.</strong> - Las partes expresamente convienen en someterse a la jurisdicción de las Leyes y Tribunales de la Ciudad de México, ya sea para la ejecución del laudo arbitral o para la interpretación o cumplimiento del presente contrato cuando "EL ARRENDADOR" haya elegido el procedimiento judicial.</p>

<p style="margin-top: 18px;  font-weight: bold;">
LEÍDO QUE FUE EL PRESENTE INSTRUMENTO, CONSTANTE DE 6 FOJAS ÚTILES Y ENTERADAS QUE FUERON LAS PARTES DE SU CONTENIDO, VALOR Y ALCANCE LEGAL, LO FIRMAN AL MARGEN EN CADA UNA DE SUS HOJAS, CON EXCEPCIÓN DE LA ÚLTIMA, QUE SE FIRMA AL CALCE POR TRIPLICADO, EL DÍA {{fecha_firma}}, EN LA CIUDAD DE MÉXICO.
</p>

<div class="firma-section">
  <div class="firma-row">
    <div class="firma-box">
      <p style="text-align:center;"><strong>EL &#8220;ARRENDADOR&#8221;</strong></p>
      <div class="firma-line"></div>
      <p class="firma-nombre"><strong>{{arrendador_nombre_completo}}</strong></p>
      <p class="firma-nombre">Por su propio derecho</p>
    </div>
    <div class="firma-box">
      <p style="text-align:center;"><strong>EL &#8220;ARRENDATARIO&#8221;</strong></p>
      <div class="firma-line"></div>
      <p class="firma-nombre"><strong>{{arrendatario_nombre_completo}}</strong></p>
      <p class="firma-nombre">Por su propio derecho</p>
    </div>
  </div>

{{firma_fiador}}

</div>

</body>
</html>
HTML;

        PlantillaContrato::updateOrCreate(
            ['slug' => 'contrato-arrendamiento-ultimo'],
            [
                'nombre'        => 'Contrato de Arrendamiento Último',
                'contenido_html' => $html,
                'activa'        => true,
                'variables_detectadas' => [],
            ]
        );
    }
}
