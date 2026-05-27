<?php

namespace Database\Seeders;

use App\Models\PlantillaContrato;
use Illuminate\Database\Seeder;

class PlantillaArrendamientoSeeder extends Seeder
{
    public function run(): void
    {
        $html = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: "Times New Roman", Times, serif; font-size: 12pt; line-height: 1.6; margin: 2cm 2.5cm; color: #000; }
  h1 { text-align: center; font-size: 13pt; font-weight: bold; text-transform: uppercase; margin-bottom: 20px; }
  h2 { text-align: center; font-size: 12pt; font-weight: bold; letter-spacing: 4px; text-transform: uppercase; margin: 20px 0 10px; }
  h3 { font-size: 12pt; font-weight: bold; margin: 16px 0 4px; }
  p { margin: 8px 0; text-align: justify; }
  strong { font-weight: 900; }
  .firma-section { margin-top: 60px; }
  .firma-row { display: table; width: 100%; margin-top: 20px; }
  .firma-box { display: table-cell; text-align: center; width: 50%; padding: 0 20px; }
  .firma-line { border-top: 1px solid #000; margin-top: 60px; margin-bottom: 8px; }
  .firma-nombre { text-align: center; margin-top: 4px; }
  .clausula-num { font-weight: bold; }
  .uppercase { text-transform: uppercase; }
</style>
</head>
<body>

<h1>CONTRATO DE ARRENDAMIENTO</h1>

<p>CONTRATO DE ARRENDAMIENTO DE BIEN INMUEBLE QUE CELEBRAN POR UNA PARTE
<strong>{{arrendador_nombre_completo}}</strong> POR SU PROPIO DERECHO, EN ADELANTE Y PARA EFECTOS DEL PRESENTE
CONTRATO IDENTIFICADO COMO EL <strong>"ARRENDADOR"</strong>; Y POR LA OTRA PARTE
<strong>{{arrendatario_nombre_completo}}</strong> POR SU PROPIO DERECHO, EN ADELANTE Y PARA EFECTOS DEL PRESENTE
CONTRATO IDENTIFICADO COMO EL <strong>"ARRENDATARIO"</strong>, A QUIENES EN SU CONJUNTO SE LES DENOMINARÁ COMO LAS
<strong>"PARTES"</strong>, Y EN LO INDIVIDUAL COMO LA <strong>"PARTE"</strong>, CONFORME A LAS SIGUIENTES DECLARACIONES Y
CLÁUSULAS:</p>

<h2>D E C L A R A C I O N E S</h2>

<p><span class="clausula-num">1.</span> &nbsp; Declara el <strong>"ARRENDADOR"</strong>, por conducto de representante legal:</p>

<p><span class="clausula-num">1.1</span> &nbsp; Ser una persona <strong>{{arrendador_tipo_persona}}</strong> de nacionalidad mexicana, con plena capacidad para la celebración del presente Contrato.</p>

<p><span class="clausula-num">1.2</span> &nbsp; Tener su domicilio el ubicado en <strong>{{arrendador_domicilio}}</strong>.</p>

<p><span class="clausula-num">1.3</span> &nbsp; Que es el legítimo propietario del inmueble ubicado en <strong>{{inmueble_direccion_completa}}</strong> (El <strong>"Inmueble"</strong>).</p>

<p><span class="clausula-num">1.4</span> &nbsp; Que, a la fecha de firma del presente Contrato, el Inmueble se encuentra al corriente en el pago de impuestos, derechos y aprovechamientos en los términos de las leyes aplicables, y que no ha sido objeto de ninguna reclamación, demanda o juicio reivindicatorio o embargo de cualquier tercero que esté pendiente de resolución y que atente contra sus derechos de dar en arrendamiento el Inmueble.</p>

<p><span class="clausula-num">1.5</span> &nbsp; Que no tiene conocimiento alguno sobre si el "ARRENDATARIO" se encuentra o ha estado involucrado, directa o indirectamente, en la comisión de delitos, particularmente aquellos que establece el Artículo 4 (cuatro) de la Ley de Extinción de Dominio para la Ciudad de México y los que menciona el Inciso a) de la Fracción II del Artículo 22 (veintidós) Constitucional, por lo que hasta donde es de su conocimiento el "ARRENDATARIO" se dedica exclusivamente a la realización de actividades lícitas.</p>

<p><span class="clausula-num">1.6</span> &nbsp; Que al no conocer sobre la realización por parte del "ARRENDATARIO" de ninguno de los hechos ilícitos y delitos a los que se refieren la Ley Federal de Extinción de Dominio y la Ley de Extinción de Dominio para la Ciudad de México, actúa con absoluta buena fe en la celebración de este Contrato.</p>

<p><span class="clausula-num">1.7</span> &nbsp; Que es su voluntad el celebrar el Contrato de Arrendamiento sobre el Inmueble, en los términos y condiciones que en este instrumento se establecen.</p>

<p><span class="clausula-num">2.</span> &nbsp; Declara el <strong>"ARRENDATARIO"</strong>, por su propio derecho:</p>

<p><span class="clausula-num">2.1</span> &nbsp; Ser persona <strong>{{arrendatario_tipo_persona}}</strong> de nacionalidad mexicana con plena capacidad para la celebración del presente Contrato.</p>

<p><span class="clausula-num">2.2</span> &nbsp; Que cuenta con las facultades necesarias y suficientes para la celebración del presente Contrato.</p>

<p><span class="clausula-num">2.3</span> &nbsp; Que cuenta con los recursos necesarios para cumplir con las obligaciones a su cargo derivadas del presente Contrato.</p>

<p><span class="clausula-num">2.4</span> &nbsp; Tener su domicilio el ubicado en el Inmueble arrendado.</p>

<p><span class="clausula-num">2.5</span> &nbsp; Que no existe impedimento legal alguno para arrendar el Inmueble objeto del presente Contrato.</p>

<p><span class="clausula-num">2.6</span> &nbsp; Que los recursos que destinan y/o destinarán al pago de la Renta mensual y la constitución del Depósito en Garantía (según dichos términos se definen en el Clausulado de este Contrato) provienen y/o provendrán de fuentes lícitas.</p>

<p><span class="clausula-num">2.7</span> &nbsp; Que durante la vigencia de este Contrato y mientras se encuentre en posesión del Inmueble, tomará todas las medidas razonables y convenientes para evitar que cualquier persona, incluyendo sus funcionarios, empleados, prestadores de servicios, visitantes y, en general, cualquier persona a la que permita el ingreso al Inmueble, cometa delito alguno, particularmente aquellos a los que se refieren la Ley Federal de Extinción de Dominio y la Ley de Extinción de Dominio para la Ciudad de México.</p>

<p><span class="clausula-num">2.8</span> &nbsp; Que es su voluntad el celebrar el Contrato de Arrendamiento sobre el Inmueble, en los términos y condiciones que en este instrumento se establecen.</p>

<p><span class="clausula-num">3.</span> &nbsp; Declaran las <strong>"PARTES"</strong>:</p>

<p><span class="clausula-num">3.1.</span> &nbsp; Que se reconocen recíprocamente sus personalidades.</p>

<p><span class="clausula-num">3.2.</span> &nbsp; Que en la celebración del presente Contrato no ha mediado error, dolo, violencia, coerción o mala fe por ninguna de las partes, por lo que el presente documento contiene la manifestación de su libre y espontánea voluntad y no adolece, por tanto, de ningún vicio en el consentimiento.</p>

<p>EN VIRTUD DE LO ANTERIOR, y considerando los intereses de las partes antes expuestas, las mismas están dispuestas a obligarse de conformidad con lo establecido en las siguientes:</p>

<h2>C L A U S U L A S</h2>

<h3>Primera.- Objeto.</h3>
<p>En este acto el "ARRENDADOR" se obliga a conceder el uso y goce temporal del Inmueble ubicado en <strong>{{inmueble_direccion_completa}}</strong>, el cual incluye <strong>{{inmueble_estacionamiento}}</strong> espacio(s) para estacionamiento (El <strong>"Inmueble"</strong>) a favor del "ARRENDATARIO", quien a su vez toma posesión del Inmueble y se obliga a pagar a cambio el precio cierto previsto en la Cláusula Segunda siguiente.</p>

<h3>Segunda.- La Renta.</h3>
<p>El "ARRENDATARIO" pagará al "ARRENDADOR" una renta mensual, durante el Plazo de Vigencia del presente Contrato por el equivalente a la cantidad de <strong>${{monto_renta_mensual}} M.N. (Moneda Nacional)</strong> (<strong>"Renta Mensual"</strong>), en el entendido que dicha cantidad cubre la Cuota de Mantenimiento.</p>

<p>El "ARRENDATARIO" debe pagar al "ARRENDADOR" la primer Renta Mensual correspondiente al mes de <strong>{{mes_primer_pago}}</strong> en la fecha de firma del presente Contrato.</p>

<p>Asimismo, el "ARRENDATARIO" pagará la Renta Mensual independientemente que el Inmueble sea o no ocupado por el "ARRENDATARIO" por el total del Plazo de Vigencia del presente Contrato.</p>

<p><strong>Forma de Pago</strong><br>
El "ARRENDATARIO" pagará al "ARRENDADOR" la Renta Mensual de manera adelantada, dentro de los primeros 5 (cinco) días naturales calendario contados a partir del día 15 de cada mes (la "Fecha de Pago") en efectivo o a la cuenta bancaria que indique por escrito el "ARRENDADOR".</p>

<p>Al momento de la entrega de la posesión del Inmueble, el "ARRENDADOR" recibirá el pago la Renta Mensual correspondiente al periodo comprendido del mes de <strong>{{mes_inicio_periodo}}</strong> del año <strong>{{anio_inicio}}</strong> al <strong>{{mes_fin_periodo}}</strong> del <strong>{{anio_fin}}</strong>, en los términos establecidos en la presente cláusula, siendo el presente documento el recibo más eficaz que en derecho proceda. El "ARRENDATARIO" en ningún caso y bajo ningún concepto o título podrá retener el importe de la Renta Mensual.</p>

<p><strong>Recibos de Pago.</strong><br>
En caso de que el pago de la Renta Mensual se haga vía transferencia bancaria, el "ARRENDATARIO" entregará al "ARRENDADOR" de manera física o virtual (al correo electrónico descrito en la cláusula Décima Octava del presente Contrato) dentro de los primeros 5 (cinco) días naturales calendario contados a partir del día primero de cada mes, la ficha de depósito bancaria o documento en que conste la transferencia interbancaria que hubiere realizado para el pago de la Renta Mensual correspondiente. El "ARRENDADOR", a su vez, mediante correo electrónico acusará de recibo a más tardar dentro de los 5 (cinco) días hábiles siguientes a la fecha en que se le haya notificado dicho pago, siendo ésta forma el medio idóneo para comprobar los pagos por concepto de Renta Mensual, por lo que el "ARRENDATARIO" se compromete a guardar todos y cada uno de los comprobantes de pago, mismos que le serán requeridos en caso de que se le solicite acreditar el pago de la Renta Mensual convenida, por tanto convienen las partes considerarlos como "RECIBOS DE PAGO" en su más amplio sentido y por cumplida la obligación del "ARRENDADOR" prevista en el artículo 2448-E del Código Civil aplicable para la Ciudad de México.</p>

<p><strong>Consignación.</strong><br>
El "ARRENDATARIO" no podrá consignar la Renta Mensual en Institución o Dependencia Pública alguna, solamente por causa de fuerza mayor, en este supuesto el "ARRENDATARIO" se obliga para efectos de todas las consignaciones que realice a (i) ingresarlas ante el Tribunal Superior de Justicia de la Ciudad de México, (ii) informar por escrito al "ARRENDADOR" a más tardar dentro de los siguientes 5 (cinco) días calendario posteriores a aquel en el que haya efectuado la Consignación el número de folio que le fue asignado a dicha consignación, en el entendido, de que si el "ARRENDATARIO" incumple con lo anteriormente expuesto, la Consignación se tendrá como no válida y el "ARRENDATARIO" estará sujeto a las penalidades y consecuencias establecidas en el presente Contrato, incluyendo sin limitar, el pago del interés moratorio descrito en la Cláusula Cuarta del presente Contrato.</p>

<p><strong>Cuota de Mantenimiento.</strong><br>
En caso de que se decidiera incrementar la Cuota de Mantenimiento, la Renta Mensual convenida se incrementará de igual manera, en la cantidad numéricamente igual a dicho incremento.</p>

<h3>Tercera.- Plazo de vigencia del Contrato de Arrendamiento.</h3>
<p>El plazo de vigencia de este Contrato será de 12 meses (el "Plazo de Vigencia"), contado a partir del <strong>{{fecha_inicio_texto}}</strong>. El Plazo de Vigencia queda acordado en forma forzosa para ambas partes, salvo porque existiera una causal de terminación anticipada en los términos dispuestos en este Contrato. El presente Contrato concluye el día <strong>{{fecha_termino_texto}}</strong>, una vez terminado el Plazo de Vigencia, el "ARRENDATARIO" entregará el Inmueble sin oposición y en las mismas condiciones en que le fue entregado.</p>

<p><strong>Renovación</strong><br>
El presente contrato podrá renovarse a entera discrecionalidad del "ARRENDADOR", lo anterior en términos del artículo 2448-C del Código Civil aplicable para la Ciudad de México, no obstante, el "ARRENDADOR" tomará en consideración el cumplimiento del "ARRENDATARIO" respecto de sus obligaciones contraídas en el presente Contrato.</p>

<p>Para efectos de renovación del presente Contrato, las partes acuerdan que: (i) el "ARRENDATARIO" solicitará por escrito al "ARRENDADOR" dicha renovación a más tardar 60 (sesenta) días previos a la terminación del Plazo de Vigencia, (ii) que dicha renovación queda supeditada a la discrecionalidad del "ARRENDADOR" y al fiel cumplimiento de todas y cada una de las cláusulas del presente Contrato por parte del "ARRENDATARIO" y (iii) que dicha renovación se realizará de manera escrita por un plazo de vigencia adicional de 1 (un) año.</p>

<p>Sin perjuicio de lo establecido en el párrafo que antecede, de renovarse el presente Contrato: (i) la Renta Mensual establecida en el primer párrafo de la Cláusula Segunda, se incrementará en el porcentaje anual que refleje el índice Nacional de Precios al Consumidor publicadas por el Instituto Nacional de Estadística y Geografía e Informática, en la fecha correspondiente al término de vigencia del presente Contrato; (ii) el "ARRENDATARIO" deberá pagar la diferencia del Depósito en Garantía respecto del Incremento que sufra la Renta Mensual, en términos del numeral (i) del presente párrafo, y (iii) el "ARRENDATARIO" deberá comprobar documentalmente estar al corriente con el pago de los servicios de suministro de agua, gas y energía eléctrica.</p>

<p>Asimismo, si cualquiera de las partes decide no renovar el presente Contrato, el "ARRENDADOR" podrá promover y mostrar la propiedad a futuros clientes, así como exhibir una manta en el mismo.</p>

<p>El incumplimiento total o parcial de los requisitos antes referidos, tendrá como consecuencia que el presente Contrato concluya en el plazo de vigencia estipulado en el párrafo primero de la presente cláusula con todas sus consecuencias jurídicas.</p>

<p><strong>Terminación Anticipada de Contrato.</strong><br>
En caso de que el "ARRENDATARIO" tenga voluntad de dar por terminado el presente Contrato de Arrendamiento de manera anticipada: (i) estará obligado a pagar al "ARRENDADOR" la cantidad equivalente a 2 (dos) meses de Renta Mensual como pena convencional, (ii) avisará por escrito al "ARRENDADOR" su intención de dar por terminado el Contrato de Arrendamiento de manera escrita y con cuando menos 20 (veinte) días anteriores al vencimiento del último mes que desea arrendar, (iii) demostrar documentalmente que no existen adeudos de los servicios prestados al Inmueble por suministro de agua, gas y energía eléctrica, (iv) demostrar que el Inmueble se encuentre en las mismas condiciones en que fue entregado, (v) firmará el Convenio de Terminación anticipada del presente Contrato en el cual conste el finiquito correspondiente y, (vi) entregará la posesión del Inmueble en la fecha de firma del Convenio de Terminación.</p>

<p>Dichos requisitos deberán cumplirse a cabalidad, de lo contrario el presente Contrato seguirá produciendo sus efectos en todas y cada una de sus cláusulas, y el Plazo de Vigencia del presente Contrato seguirá corriendo con todos los efectos jurídicos y obligaciones contraídas por las partes.</p>

<h3>Cuarta.- Intereses en caso de mora.</h3>
<p>El "ARRENDATARIO" se obliga a cumplir con todas y cada una de las obligaciones de pago pactadas en el presente Contrato de Arrendamiento precisamente en las fechas y términos convenidos y en caso de falta de pago oportuno de la Renta Mensual en la fecha señalada, "EL ARRENDATARIO" al incurrir en mora se obliga a pagar un interés moratorio del 10% (Diez por Ciento) mensual.</p>

<p>Dichos intereses moratorios se causarán desde la primera Renta Mensual vencida y no pagada y serán calculados de la siguiente manera: al momento de hacer la planilla de liquidación de los intereses moratorios se calculan estos multiplicando el importe de la primera Renta Mensual vencida y no pagada por un 10% (Diez por Ciento), lo que da como resultado el importe de los intereses moratorios a pagar por el primer mes vencido y no pagado hasta ese momento, y para el segundo mes se suman el importe de las dos mensualidades vencidas y no pagadas hasta ese momento y al resultado se le aplica el 10% (Diez por Ciento), y así sucesivamente hasta en tanto no se verifique el pago de dichas Rentas Mensuales vencidas y no pagadas.</p>

<p>Esta operación se repite por cada uno de los meses en que permanezcan insolutas las mismas y al final se calculará la suma total de todas y cada una de las cantidades obtenidas por cada uno de los meses vencidos mediante el procedimiento descrito con anterioridad. Esto ocurrirá en tanto no se verifique materialmente el pago total de las Rentas Mensuales adeudadas conjuntamente con los intereses generados.</p>

<p>No se entenderá pagada la Renta Mensual del mes adeudado, sino hasta que se cubra íntegramente la Renta Mensual y su respectiva pena convencional señalada en la presente Cláusula.</p>

<p>Esta estipulación respecto al pago de intereses moratorios, no se interpretará como si se extendiera el plazo u otorgase prórroga para el pago de las cantidades que el "ARRENDATARIO" deba pagar conforme a este Contrato de Arrendamiento, ni como una dispensa o remisión, compensación o novación en favor de éste de su obligación de pagar todas las sumas en la fecha o fechas estipuladas en este Contrato.</p>

<h3>Quinta.- Depósito en Garantía.</h3>
<p>El "ARRENDATARIO" al momento de la firma del presente contrato, entrega de manera voluntaria al "ARRENDADOR" en efectivo la cantidad de <strong>${{deposito_garantia}} M.N. ({{deposito_garantia_letra}})</strong> (el <u><strong>"Depósito en Garantía"</strong></u>), siendo el presente Contrato el recibo más eficaz que en derecho proceda, en el entendido que, dicha cantidad no causará ningún interés a favor del "ARRENDATARIO", el cual equivale al monto de 1 (una) Renta Mensual.</p>

<p>El Depósito en Garantía servirá para garantizar el total y puntual cumplimiento de todas y cada una de las obligaciones del "ARRENDATARIO" derivadas del Contrato de Arrendamiento, en el entendido que, no significa anticipo de rentas mensuales ni pago de daños y perjuicios al "ARRENDADOR". El Depósito en Garantía no podrá ser otorgado en prenda, ni ser cedido, gravado o transferido de cualquier otra manera por el "ARRENDATARIO" y cualquiera de tales actos no obligará de manera alguna al "ARRENDADOR".</p>

<p>Si el "ARRENDATARIO" incumpliera cualesquiera de sus obligaciones o pactos derivados del presente Contrato de Arrendamiento, incluyendo la falta de pago de cualquier Renta Mensual, servicio o cualquier otra comisión o penalidad estipulada en este Contrato, o si el "ARRENDADOR" hiciera cualquier pago por cuenta del "ARRENDATARIO" en los términos del presente Contrato, entonces será a elección del "ARRENDADOR" y sin perjuicio de los demás derechos o acciones que le correspondieren al respecto, el aplicar la totalidad del Depósito en Garantía para compensarse por los mencionados incumplimientos del "ARRENDATARIO", y si éste no fuera suficiente, el "ARRENDATARIO" deberá cubrir cualquier monto faltante inmediatamente que se lo solicite el "ARRENDADOR" por escrito.</p>

<p>El "ARRENDADOR" devolverá el Depósito en Garantía al "ARRENDATARIO", dentro de los 45 (cuarenta y cinco) días calendario siguientes al término del Plazo de Vigencia o a la terminación anticipada del mismo, siempre y cuando, el "ARRENDATARIO" haya cumplido puntualmente con todas y cada una de sus obligaciones pactadas, en caso contrario el "ARRENDADOR" tendrá derecho a descontar del Depósito en Garantía, aquellos gastos que hubiere tenido que realizar por incumplimiento o negligencia del "ARRENDATARIO", sin perjuicio de su derecho de ejercitar todas las acciones que procedan en contra del "ARRENDATARIO" respecto de los montos faltantes.</p>

<h3>Sexta.- Uso y Condición del Inmueble.</h3>
<p>El Inmueble será destinado únicamente para uso <strong>{{inmueble_uso}}</strong>, quedándole prohibido al "ARRENDATARIO" y éste lo acepta expresamente, cambiar el uso referido, salvo autorización escrita del "ARRENDADOR".</p>

<p>El "ARRENDATARIO" reconoce expresamente que recibe el Inmueble arrendado a su entera satisfacción, en buen estado de conservación, uso y aseo, con sus instalaciones hidráulicas y de energía eléctrica completas y en condiciones normales de servicio, comprometiéndose a mantenerlo en igual estado hasta su devolución.</p>

<p>Asimismo, el "ARRENDATARIO" podrá gozar y disponer libremente del Inmueble, incluyendo las áreas comunes, en forma ordenada y tranquila no debiendo destinarlo a usos contrarios a la moral y a las buenas costumbres, observando las disposiciones, limitaciones y prohibiciones establecidas en la legislación aplicable y al Reglamento Interno.</p>

<h3>Séptima.- Adecuaciones, Modificaciones y Mejoras al Inmueble.</h3>
<p>El "ARRENDATARIO" acuerda no hacer adecuaciones, remodelaciones, modificaciones, mejoras y/o adiciones de cualquier tipo o naturaleza al Inmueble durante el Plazo de Vigencia, sin la previa autorización por escrito del "ARRENDADOR", mismas que podrán ser negadas por éste a su entera discreción.</p>

<h3>Octava.- Mantenimiento y Reparaciones en el Inmueble.</h3>
<p>Para el caso de vicios ocultos que impidan el uso adecuado del Inmueble, el "ARRENDATARIO" deberá notificar los mismos al "ARRENDADOR" por escrito con acuse de recibo dentro de los siguientes 8 (ocho) días hábiles contados a partir de que el "ARRENDATARIO" se cerciore de la existencia de dichos vicios ocultos, para proceder a la reparación, por cuenta del propietario, siempre y cuando no sea imputable dicha reparación al "ARRENDATARIO".</p>

<p>El "ARRENDATARIO" conservará y mantendrá en óptimo estado el Inmueble y cada parte del mismo en los términos en que fue entregado, incluyendo sin limitación las partes interiores y exteriores de todas las puertas y sus partes, salidas de emergencia, ventanas, vidrios, instalaciones de servicios públicos, instalaciones de plomería y drenaje, así como paredes interiores y pisos.</p>

<h3>Novena.- Inspección del Inmueble.</h3>
<p>El "ARRENDATARIO" permitirá que los representantes del "ARRENDADOR" inspeccionen y examinen el Inmueble en una única ocasión y previo aviso de 48 (cuarenta y ocho) horas hecho al "ARRENDATARIO", lo anterior con el efecto de que el "ARRENDADOR" se cerciore del uso y condiciones del Inmueble, sin que esta situación se entienda como perturbación o acto de molestia alguna en el arrendamiento.</p>

<h3>Décima.- Servicios e Impuestos.</h3>
<p>El "ARRENDATARIO" pagará antes de su vencimiento los servicios de gas, agua y electricidad. En ningún caso será responsable el "ARRENDADOR" por la calidad, cantidad, falta o interrupción de tales servicios al Inmueble.</p>

<h3>Décima Primera.- Cesión o Subarriendo.</h3>
<p>Las partes convienen que el "ARRENDATARIO" no podrá subarrendar, en todo o en partes, el Inmueble objeto de este Contrato; ni podrá ceder sus derechos a ningún tercero; si lo hiciere, se dará por rescindido el presente Contrato.</p>

<h3>Décima Segunda.- Expropiación del Inmueble.</h3>
<p>En caso de que el Inmueble o parte de éste fuera expropiado por causas de utilidad pública, el "ARRENDADOR" tendrá derecho a dar por terminado este Contrato sin perjuicio para ninguna de las partes y cualquier cantidad que recibiere como indemnización en virtud de tal expropiación pertenecerá exclusivamente al "ARRENDADOR".</p>

<h3>Décima Tercera.- Eventualidades.</h3>
<p>En caso de que se presente alguna Causa de Daño por caso fortuito o fuerza mayor, el "ARRENDATARIO" notificará inmediatamente al "ARRENDADOR" por escrito al momento en que ocurra dicha circunstancia.</p>

<h3>Décima Cuarta.- Devolución del Inmueble.</h3>
<p>El "ARRENDATARIO" se obliga a devolver la posesión del Inmueble a la expiración del Plazo de Vigencia, o a la terminación anticipada del Contrato de Arrendamiento conforme a lo establecido en el mismo, limpio y en buenas condiciones de reparación y conservación, tal y como se encontraba a su entrega a excepción del desgaste natural que haya sufrido por el uso normal.</p>

<h3>Décima Quinta.- Causas de Rescisión del Contrato de Arrendamiento.</h3>
<p>En forma enunciativa más no limitativa, serán causas de rescisión (las "Causas de Rescisión") del presente Contrato de Arrendamiento, sin necesidad de declaración judicial alguna:</p>
<p>1. El hecho de que el "ARRENDATARIO" no cumpla puntualmente con (i) el pago de una o más Rentas Mensuales, (ii) Cualquier penalidad estipulada en este Contrato (iii) o cualesquiera aportaciones conforme a este Contrato deba ser rembolsada por gastos realizados por el "ARRENDADOR" imputables al "ARRENDATARIO".</p>
<p>2. El hecho de que el "ARRENDATARIO" incumpla con cualquiera de sus obligaciones contenidas en este Contrato distintas a las obligaciones de pago.</p>
<p>3. El hecho de que el "ARRENDATARIO" realice actividades restringidas relativas al uso y funcionamiento del Inmueble.</p>
<p>4. El hecho de que el "ARRENDATARIO" subarriende o ceda todo o en parte el Inmueble arrendado.</p>
<p>5. El hecho de que cualquier declaración efectuada por el "ARRENDATARIO" en el presente Contrato resulte falsa o imprecisa.</p>
<p>6. El hecho de que el "ARRENDATARIO" incumpla con cualquier otra de las obligaciones o pactos contenidos en el presente Contrato de Arrendamiento.</p>
<p>7. El hecho de que el "ARRENDATARIO" por cualquier razón deje de pagar 2 (dos) o más cargos o cuotas consecutivas por servicios de energía eléctrica, gas, agua o cualquier otro servicio que tenga que ser pagados directamente por el "ARRENDATARIO" a los proveedores de servicios.</p>
<p>8. Cualquier otra causa establecida por Ley, imputable al "ARRENDATARIO" Y/O "ARRENDADOR".</p>
<p>9. En caso de que alguna de las partes incurra en alguno de los supuestos establecidos en esta Cláusula, se procederá automáticamente a rescindir el presente Contrato; quedando obligado expresamente la parte que incumpla a devolver o recibir, según sea el caso, la posesión material del Inmueble en forma inmediata y a pagar a la parte que haya cumplido el importe de la última Renta Mensual vigente multiplicada por 3 (tres), como pena convencional.</p>

<h3>Décima Sexta.- Totalidad del Contrato.</h3>
<p>Este documento contiene y refleja integralmente los acuerdos entre las partes, por lo que acuerdan dejar sin efectos legales cualquier otro acuerdo verbal o escrito que hayan celebrado con anterioridad a este Contrato de Arrendamiento.</p>

<h3>Décima Séptima.- Modificaciones.</h3>
<p>Ninguna modificación, cambio, ampliación, reducción o substitución parcial o total a los términos y condiciones pactados en este Contrato de Arrendamiento o renuncia de cualquiera de sus cláusulas tendrá efectos jurídicos, a excepción de que se otorguen por escrito firmado conjuntamente por el "ARRENDADOR" y el "ARRENDATARIO".</p>

<h3>Décima Octava.- Avisos y Notificaciones.</h3>
<p>Cualquier aviso o notificación, solicitud, requerimiento, exigencia, aprobación, consentimiento u otras comunicaciones que el "ARRENDADOR" y el "ARRENDATARIO" pretendan o deban otorgarse entre sí, conforme al presente Contrato de Arrendamiento, serán por escrito y remitidas a la otra parte a su domicilio señalado en las declaraciones del presente contrato y a los siguientes correos electrónicos:</p>
<p><strong>"ARRENDADOR":</strong> <strong>{{arrendador_email}}</strong></p>
<p><strong>"ARRENDATARIO":</strong> <strong>{{arrendatario_email}}</strong></p>

<h3>Décima Novena.- Jurisdicción y Ley aplicable.</h3>
<p>Las partes se sujetan al Código Civil de la Ciudad de México para todo lo no previsto en el presente Contrato de Arrendamiento, así como para la interpretación, ejecución y cumplimiento del mismo. Consecuentemente, las partes se someten expresamente a la jurisdicción de los tribunales competentes de la Ciudad de México, respecto a cualquier acción o procedimiento, interpretación y cumplimiento de todo lo pactado en el presente Contrato, renunciando expresamente a cualquier jurisdicción que les pudiera corresponder en virtud de sus domicilios presentes o futuros.</p>

<h3>Vigésima.- Derecho de prórroga.</h3>
<p>El "ARRENDATARIO" renuncia expresamente al derecho de prórroga en términos del Artículo 2448-C del Código Civil de la Ciudad de México.</p>

<h3>Vigésima Primera.- Extinción de Dominio.</h3>
<p>Las partes manifiestan que conocen el contenido y alcance de la Ley Federal de Extinción de Dominio, reglamentaria del artículo 22 de la Constitución Política de los Estados Unidos Mexicanos, y por tal motivo el "ARRENDADOR" declara que el bien objeto del presente Contrato no es producto o se encuentra relacionado o vinculados a los delitos de delincuencia organizada, delitos contra la salud, secuestro, robo de vehículos, trata de personas o enriquecimiento ilícito.</p>

<p>El "ARRENDATARIO" manifiesta BAJO PROTESTA DE DECIR VERDAD que todas las actividades que se realizarán dentro del "INMUEBLE" serán lícitas, por lo que cualquier acto que tenga lugar al interior de la localidad arrendada es de su más estricta responsabilidad y sin conocimiento ni responsabilidad alguna por parte del "ARRENDADOR".</p>

<h3>Vigésima Segunda.- Anexo Uno.</h3>
<p>El Anexo Uno firmado por las partes formará parte integrante de este Contrato, en el entendido que en caso de haber discrepancias o contradicciones entre el Anexo Uno y el Contrato, prevalecerá lo establecido en el Anexo Uno.</p>

<p>Enteradas las partes del alcance y contenido del presente Contrato de Arrendamiento, y con pleno reconocimiento de la personalidad de las mismas, lo firman de conformidad y por triplicado en la Ciudad de México, con fecha <strong>{{fecha_firma}}</strong>.</p>

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

  <h2 style="margin-top:50px;">T E S T I G O S</h2>
  <div class="firma-row">
    <div class="firma-box">
      <div class="firma-line"></div>
      <p>&nbsp;</p>
    </div>
    <div class="firma-box">
      <div class="firma-line"></div>
      <p>&nbsp;</p>
    </div>
  </div>
</div>

</body>
</html>
HTML;

        PlantillaContrato::updateOrCreate(
            ['slug' => 'contrato-arrendamiento-habitacional'],
            [
                'nombre'        => 'Contrato de Arrendamiento Habitacional',
                'contenido_html' => $html,
                'activa'        => true,
                'variables_detectadas' => [],
            ]
        );
    }
}
