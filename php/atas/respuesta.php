<?php
session_start();   
include('../funtions.php');
include('../pdf/plantilla_pdf.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

/*VARIABLES*/
$titulo = 11;
$subtitulo = 10;
$contenido = 9;
$contenido1 = 10;
$contenido2 = 11;
$referencia = "X";
$respuesta = "X";
$nombre = "Edwin Javier";
$apellido1 = "Velasquez";
$apellido2 = "Cortes";
$genero_h = "X";
$genero_m = "X";
$edad = "28";
$expediente = "13080";
$identidad = "1804-1991-04339";
$dirección = "El Progreso, Yoro";
$telefono = "97079577";
$dir_tel = $dirección." ".$telefono;
$correo = "edwincortes764@gmail.com";
$responsable = "Maria Elizabeth Cortes Mejia";
$diagnostico = "X";
$tratamiento = "X";
$seguimiento = "X";
$rehabilitacion = "X";
$resumen_datos_clinicos = "Estos son los resumenesde los datos clinicos encontrados,Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados, Estos son los resumenesde los datos clinicos encontrados";
$pa = '100/60';
$fr = "18";
$fc = "89";
$pulso = "10";
$t = "37";
$peso = "145";
$resultado_complementarios = "Estos son los Examenes complementarios, Estos son los Examenes complementarios, Estos son los Examenes complementarios, Estos son los Examenes complementarios, Estos son los Examenes complementarios, Estos son los Examenes complementarios, Estos son los Examenes complementarios";
$tratamienti_aplicado = "Estos son los Tratamientos que se aplicaron, Estos son los Tratamientos que se aplicaron, Estos son los Tratamientos que se aplicaron, Estos son los Tratamientos que se aplicaron, Estos son los Tratamientos que se aplicaron";
$diagnostico_remision = "Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión, Estos son los Diagnosticos de Remisión";
$recomendaciones = "Estas son las Recomendaciones dadas, Estas son las Recomendaciones dadas, Estas son las Recomendaciones dadas, Estas son las Recomendaciones dadas, Estas son las Recomendaciones dadas, Estas son las Recomendaciones dadas";
$uaps = "X";
$cis = "X";
$policlinico = "X";
$segundo_nivel = "X";
$otro_centro_segundo_nivel = "Otro centro de segundo nivel";
$consulta_externa = "X";
$emergencia = "X";
$hospitalizacion = "X";
$otra_atencion = "X";
$otro_atencion_especifique = "Otro que amerita especificación";

$nombre_establecimiento = "Hospital Mario Catarino Rivas";
$nombre_servicio = "Consulta Externa";
$dia = '31';
$hora = "10:00am";
$mes_año = "diciembre, 2019";
$our_hospital = "Hospital San Juan de Dios A.R";
$red_hospital = "SESAL";
$direccion_our_hospital = "Residencial Palos Verdes, 8ava Avenida S.E, 37 Calle San Pedro Sula Cortés";
$region_sanitaria = "Cortés";
$telefono_hospital = "(+504) 2512-0870";
$correo_hospital = "hsanjuandedios@hsjddhn.com";
$red_establecimiento_salud = "SESAL";
$direccion_establecimiento_salud = "San Pedro Sula Cortés";
$region_sanitaria_establecimiento_salud = "Cortés";
$referencia_resuesta_por_medico_general = "X";
$referencia_resuesta_por_medico_especialista = "X";
$referencia_resuesta_por_medico_enfermera = "X";
$referencia_resuesta_por_auxiliar = "X";
$referencia_resuesta_por_promotor = "X";
$referencia_resuesta_por_otro = "X";
$referencia_resuesta_por_especifique = "Otro profesional";
/******************************************/

$pdf = new PDF();
//$pdf->AddPage('P','letter');
$pdf->AddPage('P','letter');
$pdf->SetFont('Arial','B',$titulo);
/*TITULOS Y SUBTITULOS*/
$pdf->setY(8);
$pdf->SetTitle("Referencia y Respuesta");
$pdf->Cell(0,5, utf8_decode('SECRETARIA DE SALUD'),0,1,'C');
$pdf->Cell(0,5, utf8_decode('SAN PEDRO SULA, HONDURAS'),0,1,'C');
$pdf->Cell(0,5, utf8_decode('REFERENCIAS Y RESPUESTAS'),0,0,'C');
/****************************************************************/

$pdf->SetFont('Arial','',$subtitulo);
$pdf->setX(-62);
$pdf->Cell(0,4, utf8_decode('REFERENCIA'),0,0,'C');
$pdf->setX(-20);
$pdf->Cell(8,4, utf8_decode($referencia),1,1,'C');
$pdf->setX(-63);
$pdf->Cell(0,4, utf8_decode('RESPUESTA'),0,0,'C');
$pdf->setX(-20);
$pdf->Cell(8,4, utf8_decode($respuesta),1,1,'C');

$pdf->SetFont('Arial','',$contenido);
$pdf->Ln(1);
$pdf->Rect(8,27,140,12);//Recta
$pdf->Cell(40,4, utf8_decode('Primer Apellido'),0,0,'');
$pdf->Cell(50,4, utf8_decode('Segundo Apellido'),0,0,'');
$pdf->Cell(50,4, utf8_decode('Nombre(s)'),0,0,'');
$pdf->Rect(148,27,35,12);//Recta
$pdf->Cell(35,4, utf8_decode('Sexo'),0,0,'');
$pdf->Rect(183,27,21,12);//Recta
$pdf->Cell(20,4, utf8_decode('Edad'),0,1,'');
$pdf->Cell(40,4, utf8_decode($apellido1),0,0,'');
$pdf->Cell(50,4, utf8_decode($apellido2),0,0,'');
$pdf->Cell(50,4, utf8_decode($nombre),0,0,'');

$pdf->setX(-66);
$pdf->Cell(22,3, utf8_decode('Masculino'),0,0,'');
$pdf->Cell(6,3, utf8_decode($genero_h),1,1,'C');
$pdf->Ln(1);
$pdf->setX(-66);
$pdf->Cell(22,3, utf8_decode('Femenino'),0,0,'');
$pdf->Cell(6,3, utf8_decode($genero_m),1,0,'C');
$pdf->Cell(20,3, utf8_decode($edad),0,1,'C');
$pdf->Ln(1);

$pdf->Rect(8,39,90,8);//Recta
$pdf->Cell(90,4, utf8_decode('No de Expediente'),0,0,'');
$pdf->Rect(98,39,106,8);//Recta
$pdf->Cell(50,4, utf8_decode('No de Identidad'),0,1,'');
$pdf->Ln(1);
$pdf->Cell(90,3, utf8_decode($expediente),0,0,'');
$pdf->Cell(50,3, utf8_decode($identidad),0,1,'');
$pdf->Ln(2);

$pdf->Rect(8,47,196,9);//Recta
$pdf->Cell(40,3, utf8_decode('Dirección y Teléfono (móvil/fijo):'),0,1,'');
$pdf->Ln(1);
$pdf->Cell(40,3, utf8_decode($dir_tel),0,1,'');
$pdf->Ln(2);

$pdf->Rect(8,56,90,9);//Recta
$pdf->Cell(90,3, utf8_decode('Correo Electronico:'),0,0,'');
$pdf->Rect(98,56,106,9);//Recta
$pdf->Cell(50,3, utf8_decode('Persona Responsable:'),0,1,'');
$pdf->Ln(1);
$pdf->Cell(90,3, utf8_decode($correo),0,0,'');
$pdf->Cell(50,3, utf8_decode($responsable),0,0,'');
$pdf->Ln(4);

$pdf->Rect(8,65,196,6);//Recta
$pdf->Cell(28,3, utf8_decode('Motivo del envió:'),0,0,'');
$pdf->Cell(20,3, utf8_decode('Diagnóstico'),0,0,'');
$pdf->Cell(7,3, utf8_decode($diagnostico),1,0,'C');
$pdf->Cell(21,3, utf8_decode('Tratamiento'),0,0,'');
$pdf->Cell(7,3, utf8_decode($tratamiento),1,0,'C');
$pdf->Cell(22,3, utf8_decode('Seguimiento'),0,0,'');
$pdf->Cell(7,3, utf8_decode($seguimiento),1,0,'C');
$pdf->Cell(24,3, utf8_decode('Rehabilitacion'),0,0,'');
$pdf->Cell(7,3, utf8_decode($rehabilitacion),1,0,'C');
$pdf->Ln(2);

$pdf->Cell(28,11, utf8_decode('Resumen de datos clínicos:'),0,1,'');
$pdf->setY(76);
$pdf->MultiCell(197,5, utf8_decode($resumen_datos_clinicos),0,1,'');
$pdf->Rect(8,71,196,5);//Recta
$pdf->Rect(8,76,196,5);//Recta
$pdf->Rect(8,81,196,5);//Recta	
$pdf->Rect(8,86,196,5);//Recta	
$pdf->Rect(8,91,196,5);//Recta	
$pdf->Rect(8,96,196,5);//Recta	
$pdf->Rect(8,101,196,5);//Recta	
$pdf->Rect(8,106,196,5);//Recta	
$pdf->setY(112);
$pdf->setX(8);
	
$pdf->Rect(8,111,16,9);//Recta	
$pdf->SetFont('Arial','B',$contenido);
$pdf->MultiCell(19,4, utf8_decode('Signos Vitales'));
$pdf->SetFont('Arial','',$contenido);
$pdf->setY(82);
$pdf->setX(18);

$pdf->Rect(24,111,95,9);//Recta	
$pdf->Cell(7,63, '',0,0,'');
$pdf->Cell(16,63, utf8_decode('P/A:'),0,0,'');
$pdf->Cell(16,63, utf8_decode('F/R:'),0,0,'');
$pdf->Cell(16,63, utf8_decode('F/C:'),0,0,'');
$pdf->Cell(16,63, utf8_decode('Pulso:'),0,0,'');
$pdf->Cell(16,63, utf8_decode('T°:'),0,0,'');
$pdf->Cell(16,63, utf8_decode('Peso:'),0,1,'');
$pdf->setY(116);
$pdf->setX(5);

$pdf->Cell(19,3, '',0,0,'');
$pdf->Cell(16,3, utf8_decode($pa),0,0,'');
$pdf->Cell(17,3, utf8_decode($fr),0,0,'');
$pdf->Cell(15,3, utf8_decode($fc),0,0,'');
$pdf->Cell(17,3, utf8_decode($pulso),0,0,'');
$pdf->Cell(15,3, utf8_decode($t),0,0,'');
$pdf->Cell(17,3, utf8_decode($peso),0,1,'');
	
$pdf->setY(104);
$pdf->setX(120);
$pdf->Rect(119,111,85,9);//Recta
$pdf->Cell(28,19, utf8_decode('Recién Nacido:'),0,0,'');
$pdf->Cell(12,19, utf8_decode('FCF:'),0,0,'');
$pdf->Cell(14,19, utf8_decode('Talla:'),0,0,'');
$pdf->Cell(14,19, utf8_decode('APGAR:'),0,1,'');

$pdf->Rect(8,120,196,10);//Recta
$pdf->Cell(80,0, utf8_decode('Datos Obstértricos: Fecha Ultimo Parto:'),0,0,'');
$pdf->Cell(25,0, utf8_decode('FUM:'),0,0,'');
$pdf->Cell(25,0, utf8_decode('FPP:'),0,0,'');
$pdf->Cell(25,0, utf8_decode('E:'),0,0,'');
$pdf->Cell(25,0, utf8_decode('P:'),0,0,'');
$pdf->Cell(25,0, utf8_decode('C:'),0,1,'');

$pdf->Cell(16,9, utf8_decode('HV:'),0,0,'');
$pdf->Cell(16,9, utf8_decode('HM:'),0,0,'');
$pdf->Cell(16,9, utf8_decode('O:'),0,0,'');
$pdf->Cell(16,9, utf8_decode('AB:'),0,0,'');
$pdf->Cell(16,9, utf8_decode('NV:'),0,0,'');
$pdf->Cell(16,9, utf8_decode('NM:'),0,0,'');
$pdf->Cell(16,9, utf8_decode('AU:'),0,1,'');

$pdf->Rect(8,130,196,5);//Recta
$pdf->Cell(16,2, utf8_decode('Resultados de exámenes complementarios:'),0,1,'');
$pdf->Ln(1);
$pdf->MultiCell(190,5, utf8_decode($resultado_complementarios),0,1,'');
$pdf->Rect(8,135,196,5);//Recta
$pdf->Rect(8,140,196,5);//Recta
$pdf->Rect(8,145,196,5);//Recta

$pdf->Rect(8,150,196,5);//Recta
$pdf->Ln(1);
$pdf->Cell(16,3, utf8_decode('Tratamiento aplicado:'),0,1,'');
$pdf->Ln(1);
$pdf->MultiCell(197,5, utf8_decode($tratamienti_aplicado),0,1,'');
$pdf->Rect(8,155,196,5);//Recta
$pdf->Rect(8,160,196,5);//Recta
$pdf->Rect(8,165,196,5);//Recta

$pdf->Rect(8,170,196,5);//Recta
$pdf->Ln(1);
$pdf->Cell(16,3, utf8_decode('Diagnóstico de remisión:'),0,1,'');
$pdf->Ln(1);
$pdf->MultiCell(195,5, utf8_decode($diagnostico_remision),0,1,'');
$pdf->Rect(8,175,196,5);//Recta
$pdf->Rect(8,180,196,5);//Recta
$pdf->Rect(8,185,196,5);//Recta

$pdf->Cell(16,4, utf8_decode('Recomendaciones:'),0,1,'');
$pdf->Ln(1);
$pdf->MultiCell(197,5, utf8_decode($recomendaciones),0,1,'');
$pdf->Rect(8,190,196,5);//Recta
$pdf->Rect(8,195,196,5);//Recta

$pdf->setY(201);
$pdf->setX(9);
$pdf->Rect(8,200,106,15);//Recta
$pdf->Cell(16,3, utf8_decode('REFERIDO o RESPONDE A:'),0,1,'');
$pdf->setY(205);
$pdf->setX(9);
$pdf->Cell(4,4, utf8_decode($uaps),1,0,'');
$pdf->setX(13);
$pdf->Cell(2,4, utf8_decode('UAPS'),0,0,'');
$pdf->setX(25);
$pdf->Cell(4,4, utf8_decode($cis),1,0,'');
$pdf->setX(29);
$pdf->Cell(2,4, utf8_decode('CIS'),0,0,'');
$pdf->setX(36);
$pdf->Cell(4,4, utf8_decode($policlinico),1,0,'');
$pdf->setX(40);
$pdf->Cell(2,4, utf8_decode('Policlínico'),0,0,'');
$pdf->setX(57);
$pdf->Cell(4,4, utf8_decode($segundo_nivel),1,0,'');
$pdf->setX(61);
$pdf->Cell(2,4, utf8_decode('Segundo Nivel, especifique:'),0,1,'');
$pdf->setX(61);
$pdf->Cell(2,6, utf8_decode($otro_centro_segundo_nivel),0,1,'');

$pdf->setY(201);
$pdf->setX(114);
$pdf->Rect(114,200,90,15);//Recta
$pdf->Cell(3,3, utf8_decode('AMERITA ATENCIÓN EN:'),0,0,'');

$pdf->setY(205);
$pdf->setX(115);
$pdf->Cell(4,4, utf8_decode($consulta_externa),1,0,'');
$pdf->setY(201);
$pdf->setX(119);
$pdf->Cell(2,12, utf8_decode('Consulta Externa'),0,0,'');

$pdf->setY(205);
$pdf->setX(145);
$pdf->Cell(4,4, utf8_decode($emergencia),1,0,'');
$pdf->setY(201);
$pdf->setX(150);
$pdf->Cell(2,12, utf8_decode('Emergencia'),0,0,'');

$pdf->setY(205);
$pdf->setX(170);
$pdf->Cell(4,4, utf8_decode($hospitalizacion),1,0,'');
$pdf->setY(201);
$pdf->setX(174);
$pdf->Cell(2,12, utf8_decode('Hospitalización'),0,1,'');

$pdf->setY(210);
$pdf->setX(115);
$pdf->Cell(4,4, utf8_decode($otra_atencion),1,0,'');
$pdf->setY(212);
$pdf->setX(119);
$pdf->Cell(2,0, utf8_decode('Otro, especifique:'),0,0,'');
$pdf->setX(145);
$pdf->Cell(2,0, utf8_decode($otro_atencion_especifique),0,1,'');

$pdf->Rect(8,215,106,9);//Recta
$pdf->Cell(8,10, utf8_decode('Nombre del establecimiento al que se refiere o responde:'),0,1,'');
$pdf->setY(221);
$pdf->Cell(2,1, utf8_decode($nombre_establecimiento),0,0,'');

$pdf->Rect(114,215,90,9);//Recta
$pdf->setY(212);
$pdf->setX(114);
$pdf->Cell(2,11, utf8_decode('Nombre del servicio al que se refiere o responde:'),0,1,'');
$pdf->setY(216);
$pdf->setX(114);
$pdf->Cell(2,11, utf8_decode($nombre_servicio),0,1,'');

$pdf->setY(226);
$pdf->Rect(8,224,106,10);//Recta
$pdf->Cell(2,1, utf8_decode('Se contacto con el establecimiento al que se Refiere o Responde:'),0,0,'');
$pdf->setY(227);
$pdf->setX(13);
$pdf->Rect(10,229,3,4);//Recta
$pdf->Cell(2,8, utf8_decode('Sí'),0,0,'');
$pdf->Rect(20,229,3,4);//Recta
$pdf->setX(23);
$pdf->Cell(2,8, utf8_decode('No'),0,0,'');
$pdf->Rect(31,229,3,4);//Recta
$pdf->setX(34);
$pdf->Cell(2,8, utf8_decode('Especifique:'),0,0,'');

$pdf->setY(226);
$pdf->setX(115);
$pdf->Rect(114,224,90,10);//Recta
$pdf->Cell(2,1, utf8_decode('Nombre y cargo de la persona contactada:'),0,0,'');

$pdf->setY(237);
$pdf->Rect(8,234,106,6);//Recta
$pdf->Cell(2,1, utf8_decode('Referencia o respuesta:'),0,0,'');
$pdf->setX(46);
$pdf->Cell(2,1, utf8_decode('Pertinente:'),0,0,'');
$pdf->Rect(64,235,3,4);//Recta
$pdf->setX(68);
$pdf->Cell(2,1, utf8_decode('Sí:'),0,0,'');
$pdf->Rect(82,235,3,4);//Recta
$pdf->setX(75);
$pdf->Cell(2,1, utf8_decode('No:'),0,0,'');

$pdf->setY(237);
$pdf->setX(115);
$pdf->Rect(114,234,90,6);//Recta
$pdf->Cell(2,1, utf8_decode('Adecuada'),0,0,'');
$pdf->setX(138);
$pdf->Rect(133,235,3,4);//Recta
$pdf->Cell(2,1, utf8_decode('Sí:'),0,0,'');
$pdf->setX(153);
$pdf->Rect(150,235,3,4);//Recta
$pdf->Cell(2,1, utf8_decode('No:'),0,1,'');

$pdf->setY(242);
$pdf->setX(26);
$pdf->Rect(8,240,43,4);//Recta
$pdf->Cell(2,1, utf8_decode('FECHA'),0,0,'C');
$pdf->setX(79);
$pdf->Rect(51,240,63,4);//Recta
$pdf->Cell(2,1, utf8_decode('REFERENCIA O RESPUESTA POR:'),0,0,'C');
$pdf->setX(79);
$pdf->Rect(114,240,90,4);//Recta
$pdf->setX(158);
$pdf->Cell(2,1, utf8_decode('NOMBRE, FIRMA Y SELLO DE LA PERSONA REMITENTE:'),0,1,'C');

$pdf->setY(247);
$pdf->setX(11);
$pdf->Rect(8,244,14,7);//Recta
$pdf->Cell(2,1, utf8_decode('DÍA:'),0,0,'C');

$pdf->setX(29);
$pdf->Rect(22,244,15,7);//Recta
$pdf->Cell(2,1, utf8_decode('MES:'),0,0,'C');

$pdf->setX(42);
$pdf->Rect(37,244,14,7);//Recta
$pdf->Cell(2,1, utf8_decode('AÑO:'),0,1,'C');
$pdf->setY(247);
$pdf->setX(17);
$pdf->Cell(2,1, utf8_decode($dia),0,0,'C');
$pdf->setY(248);
$pdf->setX(10);
$pdf->Rect(8,251,14,9);//Recta
$pdf->Cell(9,11, utf8_decode('HORA:'),0,1,'C');

$pdf->setY(256);
$pdf->setX(10);
$pdf->Cell(9,2, utf8_decode($hora),0,1,'C');

$pdf->setY(248);
$pdf->setX(31);
$pdf->Rect(22,251,29,9);//Recta
$pdf->Cell(9,11, utf8_decode($mes_año),0,0,'C');

$pdf->setY(247);
$pdf->setX(66);
$pdf->Rect(51,244,63,16);//Recta
$pdf->setY(245);
$pdf->setX(52);
$pdf->Cell(4,4, utf8_decode($referencia_resuesta_por_medico_general),1,0,'');
$pdf->setY(247);
$pdf->setX(67);
$pdf->Cell(2,1, utf8_decode('Medico General:'),0,0,'C');
$pdf->setY(245);
$pdf->setX(80);
$pdf->Cell(4,4, utf8_decode($referencia_resuesta_por_medico_especialista),1,0,'');
$pdf->setY(247);
$pdf->setX(98);
$pdf->Cell(2,1, utf8_decode('Medico Especialista:'),0,1,'C');
$pdf->setY(250);
$pdf->setX(52);
$pdf->Cell(4,4, utf8_decode($referencia_resuesta_por_medico_enfermera),1,0,'');
$pdf->setY(248);
$pdf->setX(63);
$pdf->Cell(2,8, utf8_decode('Enfermera:'),0,0,'C');

$pdf->setY(250);
$pdf->setX(72);
$pdf->Cell(4,4, utf8_decode($referencia_resuesta_por_auxiliar),1,0,'');
$pdf->setY(248);
$pdf->setX(81);
$pdf->Cell(2,8, utf8_decode('Auxiliar:'),0,0,'C');

$pdf->setY(250);
$pdf->setX(89);
$pdf->Cell(4,4, utf8_decode($referencia_resuesta_por_promotor),1,0,'');
$pdf->setY(248);
$pdf->setX(100);
$pdf->Cell(2,8, utf8_decode('Promotor:'),0,0,'C');

$pdf->setY(255);
$pdf->setX(52);
$pdf->Cell(4,4, utf8_decode($referencia_resuesta_por_otro),1,0,'');
$pdf->setY(254);
$pdf->setX(55);
$pdf->MultiCell(197,5, utf8_decode('Otro, especificar: '.$referencia_resuesta_por_especifique),0,1,'');

//Area del sello y firma del profesional
$pdf->setY(247);
$pdf->setX(66);
$pdf->Rect(114,244,90,16);//Recta

$pdf->AddPage('P','letter');
$pdf->SetFont('Arial','',$contenido1);
$pdf->setX(10);
$pdf->Cell(194,20, utf8_decode('ESTE DOCUMENTO CONTINENE INFORMACION INDISPENSABLE PARA SU SALUD. CUIDELO'),1,1,'C');

$pdf->Ln(5);
$pdf->Cell(194,20, utf8_decode('ES IMPORTANTE QUE CUMPLA LAS INDICACIONES DEL MEDICO O PERSONAL DE SALUD'),1,1,'C');

$pdf->Ln(5);
$pdf->Cell(194,20, utf8_decode('PRESENTESE AL ESTABLECIMIENTO DE SALUD INDICANDO LO MAS PRONTO POSIBLE'),1,1,'C');

$pdf->Ln(5);
$pdf->Rect(10,105,194,64);//Recta
$pdf->Cell(194,6, utf8_decode('Emisor'),0,1,'C');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Establecimiento de Salud:'),0,0,'');
$pdf->setX(53);
$pdf->Cell(2,10, utf8_decode($our_hospital),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Red a la que pertence el establecimiento de Salud:'),0,0,'');
$pdf->setX(93);
$pdf->Cell(2,10, utf8_decode($red_hospital),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Dirección establecimiento de salud:'),0,0,'');
$pdf->setX(69);
$pdf->Cell(2,10, utf8_decode($direccion_our_hospital),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Región Sanitaria:'),0,0,'');
$pdf->setX(40);
$pdf->Cell(2,10, utf8_decode($region_sanitaria),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Número de Teléfono del Establecimiento:'),0,0,'');
$pdf->setX(78);
$pdf->Cell(2,10, utf8_decode($telefono_hospital),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Correo electrónico del establecimiento:'),0,0,'');
$pdf->setX(74);
$pdf->Cell(2,10, utf8_decode($correo_hospital),0,1,'');

$pdf->Ln(5);
$pdf->Rect(10,175,194,64);//Recta
$pdf->Cell(194,6, utf8_decode('Receptor'),0,1,'C');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Establecimiento de Salud:'),0,0,'');
$pdf->setX(54);
$pdf->Cell(2,10, utf8_decode($nombre_establecimiento),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Red a la que pertenece el Establecimiento de Salud:'),0,0,'');
$pdf->setX(95);
$pdf->Cell(2,10, utf8_decode($red_establecimiento_salud),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Dirección del Establecimiento de Salud:'),0,0,'');
$pdf->setX(75);
$pdf->Cell(2,10, utf8_decode($direccion_establecimiento_salud),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Región Sanitaria:'),0,0,'');
$pdf->setX(40);
$pdf->Cell(2,10, utf8_decode($region_sanitaria_establecimiento_salud),0,1,'');
$pdf->setX(12);
$pdf->Cell(2,10, utf8_decode('Servicio al que se remite:'),0,0,'');
$pdf->setX(53);
$pdf->Cell(2,10, utf8_decode($nombre_servicio),0,1,'');

$pdf->SetAuthor('Ing. Edwin Velásquez');
$pdf->Output();
?>