<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$unidad = $_POST['unidad'];
$servicio = $_POST['servicio'];
$color_totales = '#5DADE2';
$color_neto = '#083BF7';
$color_porcentaje = '#087623';

if($servicio==""){
	$servicio = "1,3,4,6,7,11,12,14";
}else{
	$servicio = "1,3,4,6,7,11,12,14";
}

if ($servicio != "" && $unidad != ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.patologia_id BETWEEN 1 AND 442 AND c.puesto_id = '$unidad'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where9 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where10 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where11 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where12 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where13 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where14 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where15 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where16 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where17 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where18 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where19 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where20 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where21 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where22 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where23 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where24 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where25 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where26 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where27 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where28 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where29 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where30 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where31 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where32 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where33 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where34 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where35 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where36 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where37 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where38 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where39 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where40 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where41 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where42 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
}else{
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.patologia_id BETWEEN 1 AND 442";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where9 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where10 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where11 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where12 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where13 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where14 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where15 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where16 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where17 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where18 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where19 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where20 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where21 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where22 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where23 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where24 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where25 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where26 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where27 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where28 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where29 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where30 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where31 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where32 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where33 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where34 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where35 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where36 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where37 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where38 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where39 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where40 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where41 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where42 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$consulta = "SELECT count(a.expediente) AS Total
   FROM ata AS a 
   INNER JOIN pacientes AS p
   ON a.expediente = p.expediente
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id	   
   ".$where."";
$result = $mysqli->query($consulta);   

$consulta1 = $result->fetch_assoc();

$registro = "SELECT DISTINCT 
   CONCAT('F00-F09') AS 'Codigo', CONCAT('Trastorno mentales orgánicos incluidos los sintomáticos') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN a.patologia_id END) AS 'NH1',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN a.patologia_id END) AS 'NM1',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN a.patologia_id END) AS 'SH1',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN a.patologia_id END) AS 'SM1',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p
   ON a.expediente = p.expediente
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id	   
   ".$where1;
$result_registro = $mysqli->query($registro);   

	 
//F00 - F09..   1 AND 43
$registroF00 = "SELECT DISTINCT 
    CONCAT('F00-F09') AS 'Codigo', CONCAT('Trastorno mentales orgánicos incluidos los sintomáticos') AS 'Enfermedad',
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 1 AND 43) THEN a.patologia_id END) AS 'Total4',
	#TOTAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 1 AND 43) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id	   
   ".$where2;
$resultF00 = $mysqli->query($registroF00);   

//F10 - F19.... 44 AND 123
$registroF10 = "SELECT DISTINCT 
   CONCAT('F10-F19') AS 'Codigo', CONCAT('Trastornos mentales y del comportamiento debidos al consumo de sustancias psicotropicas') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 44 AND 123) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 44 AND 123) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  
   ".$where3;
$resultF10 = $mysqli->query($registroF10);      

//F20 - F29...   124 AND 154
$registroF20 = "SELECT DISTINCT 
   CONCAT('F20-F29') AS 'Codigo', CONCAT('Esquizofrenia, trastorno esquizotipico y trastorno de ideas delirantes') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 124 AND 154) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 124 AND 154) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where4;
$resultF20 = $mysqli->query($registroF20);      
   
//F30..   155 AND 160
$registroF30 = "SELECT DISTINCT 
   CONCAT('F30') AS 'Codigo', CONCAT('Trastorno del humor (Episodio Maniaco)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 155 AND 160) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 155 AND 160) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  	   
   ".$where5;
$resultF30 = $mysqli->query($registroF30);       

//F31...    161 AND 171	
$registroF31 = "SELECT DISTINCT 
   CONCAT('F31') AS 'Codigo', CONCAT('Trastorno del humor (Bipolar)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 161 AND 171) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 161 AND 171) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where6; 
$resultF31 = $mysqli->query($registroF31);       

//F32 - F39...    172 AND 196
$registroF32 = "SELECT DISTINCT 
   CONCAT('F32-F39') AS 'Codigo', CONCAT('Trastornos del humnor episodio depresivo') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 172 AND 196) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 172 AND 196) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where7;
$resultF32 = $mysqli->query($registroF32);    

//F40 - F49...    197 AND 245
$registroF40 = "SELECT DISTINCT 
   CONCAT('F40-F49') AS 'Codigo', CONCAT('Trastorno Neuróticos, secundarios a situaciones estresantes y somatomorfos') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 197 AND 245) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 197 AND 245) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where8;
$resultF40 = $mysqli->query($registroF40);    

//F50 - F59...     246 AND 282
$registroF50 = "SELECT DISTINCT 
   CONCAT('F50-F59') AS 'Codigo', CONCAT('Trastorno del comportamiento asociadas a disfunciones fisiológicas y a factores sománticos') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 246 AND 282) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 246 AND 282) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where9;
$resultF50 = $mysqli->query($registroF50);    

//F60 - F69...   283 AND 335
$registroF60 = "SELECT DISTINCT 
   CONCAT('F60-F69') AS 'Codigo', CONCAT('Trastorno de la personalidad y del comportamiento del adulto') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 283 AND 335) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 283 AND 335) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  	   
   ".$where10;
$resultF60 = $mysqli->query($registroF60);    

//F70 - F70...     336 AND 341
$registroF70 = "SELECT DISTINCT 
   CONCAT('F70-F79') AS 'Codigo', CONCAT('Retraso Mental') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 336 AND 341) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 336 AND 341) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where11;
$resultF70 = $mysqli->query($registroF70);    

//F80 - F89...    342 AND 368
$registroF80 = "SELECT DISTINCT 
   CONCAT('F80-F89') AS 'Codigo', CONCAT('Trastorno del desarrollo psicológico') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 342 AND 368) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 342 AND 368) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where12;
$resultF80 = $mysqli->query($registroF80);    

//F90 - F98... 413
$registroF90 = "SELECT DISTINCT 
   CONCAT('F90-F98') AS 'Codigo', CONCAT('Trastornos del comportamiento y de las emociones de comienzo habitual en la infancia y la adolescencia') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id BETWEEN 369 AND 413) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id BETWEEN 369 AND 413) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where13;
$resultF90 = $mysqli->query($registroF90);    

//F99... 414
$registroF99 = "SELECT DISTINCT 
   CONCAT('F99') AS 'Codigo', CONCAT('Trastorno Mental sin especificación') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 414) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 414) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 414) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 414) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 414) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 414) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where14;
$resultF99 = $mysqli->query($registroF99);    

//G40-G40.9... 415
$registroG40 = "SELECT DISTINCT 
   CONCAT('G40-G40.9') AS 'Codigo', CONCAT('Epilepsia') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 415) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 415) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 415) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 415) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 415) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 415) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id 	   
   ".$where15;
$resultG40 = $mysqli->query($registroG40);    
   
//G41-G41.9... 416
$registroG41 = "SELECT DISTINCT 
   CONCAT('G41-G41.9') AS 'Codigo', CONCAT('Estado de mal epiléptico (status) gran mal y pequeño mal, complejo, otros de tipo no especificado') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 416) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 416) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 416) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 416) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 416) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 416) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where16; 
$resultG41 = $mysqli->query($registroG41);     

//X60-X69... 417
$registroX60 = "SELECT DISTINCT 
   CONCAT('X60-X69') AS 'Codigo', CONCAT('Envenenamiento o lesión intencionalmente autoinflingida, intento suicidio por diferentes medios') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 417) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 417) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 417) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 417) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 417) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 417) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  
   ".$where17; 
$resultX60 = $mysqli->query($registroX60);     

//X70-X89... 418
$registroX70 = "SELECT DISTINCT 
   CONCAT('X70-X89') AS 'Codigo', CONCAT('Suicidio y Lesión intencionalmente autoinflingida por diferentes medios') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 418) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 418) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 418) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 418) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 418) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 418) THEN a.paciente END) AS 'Total'	
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where18;
$resultX70 = $mysqli->query($registroX70);     

//X85-X99... 419
$registroX85 = "SELECT DISTINCT 
   CONCAT('X85-X99') AS 'Codigo', CONCAT('Agresión, lesiones ocasionadas por otra persona con intento de lesionar o matar por cualquier medio (incluye intento de homicidio, homicidio)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑO9
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 419) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 419) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 419) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 419) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 419) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 419) THEN a.paciente END) AS 'Total'	
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id 
	".$where19;
$resultX85 = $mysqli->query($registroX85);  	

//Y00-Y03... 420
$registroY00 = "SELECT DISTINCT 
   CONCAT('Y00-Y03') AS 'Codigo', CONCAT('Agresión con objeto romo o sin filo, por empujón, atropello deliberado con vehículo de motor, (incluye intento de homicidio, homicidio)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 420) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 420) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 420) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 420) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 420) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 420) THEN a.paciente END) AS 'Total'	
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where20; 
$resultY00 = $mysqli->query($registroY00);     

//Y04... 421
$registroY04 = "SELECT DISTINCT 
   CONCAT('Y04') AS 'Codigo', CONCAT('Agresión con fuerza corporal (incluye lucha o peleas sin armas, homicidio)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 421) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 421) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 421) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 421) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 421) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 421) THEN a.paciente END) AS 'Total'	
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where21;
$resultY04 = $mysqli->query($registroY04);     

//Y05... 422
$registroY05 = "SELECT DISTINCT 
   CONCAT('Y05') AS 'Codigo', CONCAT('Agresión sexual con fuerza corporal (incluye intento de violación, violación)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 422) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 422) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 422) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 422) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 422) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 422) THEN a.paciente END) AS 'Total'	
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  
   ".$where22;   
$resultY05 = $mysqli->query($registroY05);     

   
//Y06... 423
$registroY06 = "SELECT DISTINCT 
   CONCAT('Y06') AS 'Codigo', CONCAT('Negligencia y Abandono') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 423) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 423) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 423) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 423) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 423) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 423) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where23;   
$resultY06 = $mysqli->query($registroY06);  

//Y07... 424
$registroY07 = "SELECT DISTINCT 
   CONCAT('Y07') AS 'Codigo', CONCAT('Otros sindromes de maltrato (crueldad mental, abuso físico, abuso sexual y tortura)') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 424) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 424) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 424) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 424) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 424) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 424) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where24;
$resultY07 = $mysqli->query($registroY07);     

//Y08... 425
$registroY08 = "SELECT DISTINCT 
   CONCAT('Y08') AS 'Codigo', CONCAT('Agresión por otros medios especificados') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 425) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 425) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 425) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 425) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 425) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  
   ".$where25; 
$resultY08 = $mysqli->query($registroY08);     

//Y09... 426
$registroY09 = "SELECT DISTINCT 
   CONCAT('Y09') AS 'Codigo', CONCAT('Agresión por medios no especificados') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 425) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 426) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 426) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 426) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 426) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 426) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 426) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where26;  
$resultY09 = $mysqli->query($registroY09);     

//T74.1 ... 427
$registroT74A = "SELECT DISTINCT 
   CONCAT('T74.1') AS 'Codigo', CONCAT('Abuso Físico') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 427) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 427) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 427) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 427) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 427) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 427) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where27;  
$resultT74A = $mysqli->query($registroT74A);     

//T74.2... 428
$registroT74B = "SELECT DISTINCT 
   CONCAT('T74.2') AS 'Codigo', CONCAT('Abuso Sexual') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 428) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 428) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 428) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 428) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 428) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 428) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  	   
   ".$where28;  
$resultT74B = $mysqli->query($registroT74B);   

//T74.3... 429
$registroT74C = "SELECT DISTINCT 
   CONCAT('T74.3') AS 'Codigo', CONCAT('Abuso Psicológico') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 429) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 429) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 429) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 429) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 429) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 429) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where29;  
$resultT74C = $mysqli->query($registroT74C);   

//AA206.... 430
$registroAA206 = "SELECT DISTINCT 
   CONCAT('AA206') AS 'Codigo', CONCAT('(Violación) intimidación o engaño') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 430) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 430) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 430) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 430) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 430) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 430) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where30;  
$resultAA206 = $mysqli->query($registroAA206);   

//AA207.... 431
$registroAA207 = "SELECT DISTINCT 
   CONCAT('AA207') AS 'Codigo', CONCAT('Violación Física') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 431) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 431) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 431) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 431) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 431) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 431) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where31;  
$resultAA207 = $mysqli->query($registroAA207);      

//AA208.... 432
$registroAA208 = "SELECT DISTINCT 
   CONCAT('AA208') AS 'Codigo', CONCAT('Violación Sexual') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 432) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 432) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 432) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 432) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 432) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 432) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id    
   ".$where32;  
$resultAA208 = $mysqli->query($registroAA208);

//AA175... 433
$registroAA175 = "SELECT DISTINCT 
   CONCAT('AA175') AS 'Codigo', CONCAT('Violación Psicológica') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 433) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 433) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 433) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 433) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 433) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 433) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where33;  
$resultAA175 = $mysqli->query($registroAA175);    

//AA210... 434
$registroAA210 = "SELECT DISTINCT 
   CONCAT('AA210') AS 'Codigo', CONCAT('Violación Patrimonial / económica') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 434) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 434) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 434) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 434) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 434) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 434) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where34; 
$resultAA210 = $mysqli->query($registroAA210);    

//Z00-Z13... 436
$registroZ00 = "SELECT DISTINCT 
   CONCAT('Z00-Z13') AS 'Codigo', CONCAT('Pruebas para aclarar o investigar problemas de salud') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 436) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 436) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 436) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 436) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 436) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 436) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where35; 
$resultZ00 = $mysqli->query($registroZ00);    

//Z20-Z29... 437
$registroZ20 = "SELECT DISTINCT 
   CONCAT('Z20-Z29') AS 'Codigo', CONCAT('Contacto y exposición a enfermedades contagiosas') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 437) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 437) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 437) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 437) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 437) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 437) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where36; 
$resultZ20 = $mysqli->query($registroZ20);   

//Z30-Z39...    438
$registroZ30 = "SELECT DISTINCT 
   CONCAT('Z30-Z39') AS 'Codigo', CONCAT('Intervenciones relativas a la reproducción') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 438) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 438) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 438) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 438) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 438) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 438) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where37; 
$resultZ30 = $mysqli->query($registroZ30);      

//Z40-Z54...    439
$registroZ40 = "SELECT DISTINCT 
   CONCAT('Z40-Z54') AS 'Codigo', CONCAT('Personas candidatas a cirugía') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 439) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 439) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 439) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 439) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 439) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 439) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id  
   ".$where38;  
$resultZ40 = $mysqli->query($registroZ40);      

//Z55-Z65...    440
$registroZ55 = "SELECT DISTINCT 
   CONCAT('Z55-Z65') AS 'Codigo', CONCAT('Personas con problemas potenciales psíquicos o psicosociales') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 440) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 440) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 440) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 440) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 440) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 440) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where39;   
$resultZ55 = $mysqli->query($registroZ55);      

//Z70-Z76...   441
$registroZ70 = "SELECT DISTINCT 
   CONCAT('Z70-Z76') AS 'Codigo', CONCAT('Consultas') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 441) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 441) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 441) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 441) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 441) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 441) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id     
   ".$where40; 
$resultZ70 = $mysqli->query($registroZ70);      

//Z80-Z99...  442
$registroZ80 = "SELECT DISTINCT 
   CONCAT('Z80-Z99') AS 'Codigo', CONCAT('Historias') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 442) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 442) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 442) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 442) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 442) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 442) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where41;
$resultZ80 = $mysqli->query($registroZ80);      

//NPP.... 435
$registroNPP = "SELECT DISTINCT 
   CONCAT('NPP') AS 'Codigo', CONCAT('No Presenta Patologías') AS 'Enfermedad', 
    #MENORES DE 1 AÑO
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años < 1 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH1',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años < 1 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM1',
    #1-4 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH2',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 1 AND 4 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM2',
    #5-9 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH3',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 5 AND 9 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM3',
    #10-14 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH4',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH4',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 10 AND 14 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM4',
    #15-19 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH5',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH5',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 15 AND 19 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM5',
    #20-24 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH6',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH6',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 20 AND 24 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM6',
    #25-39 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH7',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH7',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 25 AND 39 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM7',
    #40-59 AÑOS
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH8',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH8',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años BETWEEN 40 AND 59 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM8',
    #60 y Mas
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NH9',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'NM9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.años >= 60 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SH9',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.años >= 60 AND a.patologia_id = 435) THEN a.patologia_id END) AS 'SM9',
	#TOTAL
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H' AND a.patologia_id = 435) THEN a.patologia_id END) AS 'Total1',
    COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M' AND a.patologia_id = 435) THEN a.patologia_id END) AS 'Total2',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H' AND a.patologia_id = 435) THEN a.patologia_id END) AS 'Total3',
    COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M' AND a.patologia_id = 435) THEN a.patologia_id END) AS 'Total4',
	#TOTAL GENERAL
	COUNT(CASE WHEN (a.patologia_id = 435) THEN a.paciente END) AS 'Total'
    FROM ata AS a 
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN colaboradores AS c
    ON a.colaborador_id	= c.colaborador_id
    INNER JOIN servicios AS s
    ON a.servicio_id = s.servicio_id   
   ".$where42;   
$resultNPP = $mysqli->query($registroNPP);    
   
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
	<tr>
	    <th rowspan=3>Codigo</th>
		<th rowspan=3>Diagnostico</th>
		<th colspan="4"><center>MENOR 1 AÑO</center></th>
        <th colspan="4"><center>1-4 AÑOS</center></th>
        <th colspan="4"><center>5-9 AÑOS</center></th>
        <th colspan="4"><center>10-14 AÑOS</center></th>
        <th colspan="4"><center>15-19 AÑOS</center></th>
        <th colspan="4"><center>20-24 AÑOS</center></th>
        <th colspan="4"><center>25-39 AÑOS</center></th>
        <th colspan="4"><center>40-59 AÑOS</center></th>
        <th colspan="4"><center>60 Y MAS</center></th>	
        <th colspan="4"><center>TOTAL</center></th>	
        <th rowspan="3"><center>NETO</center></th>
        <th rowspan="3"><center>%</center></th>		
	</tr>
	<tr>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>		
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th>1er. Vez</th>
		<th>Subs.</th>	
		<th colspan="2">1er. Vez</th>
		<th colspan="2">Subs.</th>			
	</tr>
	<tr>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>	
		<th>H</th>
		<th>M</th>			
	</tr>	';			

$i = 1;	
$totalNH1 = 0; $totalNH2 = 0; $totalNH3 = 0; $totalNH4 = 0; $totalNH5 = 0; $totalNH6 = 0; $totalNH7 = 0; $totalNH8 = 0; $totalNH9 = 0;
$totalNM1 = 0; $totalNM2 = 0; $totalNM3 = 0; $totalNM4 = 0; $totalNM5 = 0; $totalNM6 = 0; $totalNM7 = 0; $totalNM8 = 0; $totalNM9 = 0;		
$totalSH1 = 0; $totalSH2 = 0; $totalSH3 = 0; $totalSH4 = 0; $totalSH5 = 0; $totalSH6 = 0; $totalSH7 = 0; $totalSH8 = 0; $totalSH9 = 0; $totalSH = 0;
$totalSM1 = 0; $totalSM2 = 0; $totalSM3 = 0; $totalSM4 = 0; $totalSM5 = 0; $totalSM6 = 0; $totalSM7 = 0; $totalSM8 = 0; $totalSM9 = 0; $totalSM = 0;
$total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0; $total7 = 0; $total8 = 0; $total9 = 0; $total = 0; $total_nuevos = 0;

if($result->num_rows>0){
	if($resultF00->num_rows>0){
		while($registroF00_1 = $resultF00->fetch_assoc()){
		  if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroF00_1['Total'] / $consulta1['Total'])*100;
		  }else{
			 $porcentaje = 0; 
		  }

	   	   echo '<tr>
		        <td>'.$registroF00_1['Codigo'].'</td>
				<td>'.$registroF00_1['Enfermedad'].'</td>	
				<td>'.$registroF00_1['NH1'].'</td>	
                <td>'.$registroF00_1['NM1'].'</td>					
				<td>'.$registroF00_1['SH1'].'</td>					
				<td>'.$registroF00_1['SM1'].'</td>	
				
				<td>'.$registroF00_1['NH2'].'</td>	
                <td>'.$registroF00_1['NM2'].'</td>					
				<td>'.$registroF00_1['SH2'].'</td>					
				<td>'.$registroF00_1['SM2'].'</td>	
				
				<td>'.$registroF00_1['NH3'].'</td>	
                <td>'.$registroF00_1['NM3'].'</td>					
				<td>'.$registroF00_1['SH3'].'</td>					
				<td>'.$registroF00_1['SM3'].'</td>	
				
				<td>'.$registroF00_1['NH4'].'</td>	
                <td>'.$registroF00_1['NM4'].'</td>					
				<td>'.$registroF00_1['SH4'].'</td>					
				<td>'.$registroF00_1['SM4'].'</td>	
				
				<td>'.$registroF00_1['NH5'].'</td>	
                <td>'.$registroF00_1['NM5'].'</td>					
				<td>'.$registroF00_1['SH5'].'</td>								
				<td>'.$registroF00_1['SM5'].'</td>	
				
				<td>'.$registroF00_1['NH6'].'</td>	
                <td>'.$registroF00_1['NM6'].'</td>					
				<td>'.$registroF00_1['SH6'].'</td>					
				<td>'.$registroF00_1['SM6'].'</td>	
				
				<td>'.$registroF00_1['NH7'].'</td>	
                <td>'.$registroF00_1['NM7'].'</td>					
				<td>'.$registroF00_1['SH7'].'</td>					
				<td>'.$registroF00_1['SM7'].'</td>	
				
				<td>'.$registroF00_1['NH8'].'</td>	
                <td>'.$registroF00_1['NM8'].'</td>					
				<td>'.$registroF00_1['SH8'].'</td>					
				<td>'.$registroF00_1['SM8'].'</td>
				
				<td>'.$registroF00_1['NH9'].'</td>	
                <td>'.$registroF00_1['NM9'].'</td>					
				<td>'.$registroF00_1['SH9'].'</td>					
				<td>'.$registroF00_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF00_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF00_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF00_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF00_1['Total4']).'</p></b></td>

                <td><b><p style="color: '.$color_neto.';">'.number_format($registroF00_1['Total']).'</p></b></td>				

				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>					
				</tr>';
				$totalNH1 += $registroF00_1['NH1'];
				$totalNM1 += $registroF00_1['NM1'];
				$totalSH1 += $registroF00_1['SH1'];
				$totalSM1 += $registroF00_1['SM1'];
				
				$totalNH2 += $registroF00_1['NH2'];
				$totalNM2 += $registroF00_1['NM2'];
				$totalSH2 += $registroF00_1['SH2'];
				$totalSM2 += $registroF00_1['SM2'];
				
				$totalNH3 += $registroF00_1['NH3'];
				$totalNM3 += $registroF00_1['NM3'];
				$totalSH3 += $registroF00_1['SH3'];
				$totalSM3 += $registroF00_1['SM3'];
				
				$totalNH4 += $registroF00_1['NH4'];
				$totalNM4 += $registroF00_1['NM4'];
				$totalSH4 += $registroF00_1['SH4'];
				$totalSM4 += $registroF00_1['SM4'];
				
				$totalNH5 += $registroF00_1['NH5'];
				$totalNM5 += $registroF00_1['NM5'];
				$totalSH5 += $registroF00_1['SH5'];
				$totalSM5 += $registroF00_1['SM5'];
				
				$totalNH6 += $registroF00_1['NH6'];
				$totalNM6 += $registroF00_1['NM6'];
				$totalSH6 += $registroF00_1['SH6'];
				$totalSM6 += $registroF00_1['SM6'];
				
				$totalNH7 += $registroF00_1['NH7'];
				$totalNM7 += $registroF00_1['NM7'];
				$totalSH7 += $registroF00_1['SH7'];
				$totalSM7 += $registroF00_1['SM7'];
				
				$totalNH8 += $registroF00_1['NH8'];
				$totalNM8 += $registroF00_1['NM8'];
				$totalSH8 += $registroF00_1['SH8'];
				$totalSM8 += $registroF00_1['SM8'];
				
				$totalNH9 += $registroF00_1['NH9'];
				$totalNM9 += $registroF00_1['NM9'];
				$totalSH9 += $registroF00_1['SH9'];
				$totalSM9 += $registroF00_1['SM9'];	

				$total1 += $registroF00_1['Total1'];
				$total2 += $registroF00_1['Total2'];
				$total3 += $registroF00_1['Total3'];
				$total4 += $registroF00_1['Total4'];
				
				$total += $registroF00_1['Total'];
	   }
	}	
	
	if($resultF10->num_rows>0){
		while($registroF10_1 = $resultF10->fetch_assoc()){
		 if ($consulta1['Total'] != 0){
			 $porcentaje = ($registroF10_1['Total'] / $consulta1['Total'])*100;	 
		 }else{
			 $porcentaje = 0; 
		  }			  
		
	   	   echo '<tr>
		        <td>'.$registroF10_1['Codigo'].'</td>
				<td>'.$registroF10_1['Enfermedad'].'</td>	
				<td>'.$registroF10_1['NH1'].'</td>	
                <td>'.$registroF10_1['NM1'].'</td>					
				<td>'.$registroF10_1['SH1'].'</td>					
				<td>'.$registroF10_1['SM1'].'</td>	
				
				<td>'.$registroF10_1['NH2'].'</td>	
                <td>'.$registroF10_1['NM2'].'</td>					
				<td>'.$registroF10_1['SH2'].'</td>					
				<td>'.$registroF10_1['SM2'].'</td>
				
				<td>'.$registroF10_1['NH3'].'</td>	
                <td>'.$registroF10_1['NM3'].'</td>					
				<td>'.$registroF10_1['SH3'].'</td>					
				<td>'.$registroF10_1['SM3'].'</td>
				
				<td>'.$registroF10_1['NH4'].'</td>	
                <td>'.$registroF10_1['NM4'].'</td>					
				<td>'.$registroF10_1['SH4'].'</td>					
				<td>'.$registroF10_1['SM4'].'</td>
				
				<td>'.$registroF10_1['NH5'].'</td>	
                <td>'.$registroF10_1['NM5'].'</td>					
				<td>'.$registroF10_1['SH5'].'</td>					
				<td>'.$registroF10_1['SM5'].'</td>
				
				<td>'.$registroF10_1['NH6'].'</td>	
                <td>'.$registroF10_1['NM6'].'</td>					
				<td>'.$registroF10_1['SH6'].'</td>					
				<td>'.$registroF10_1['SM6'].'</td>
				
				<td>'.$registroF10_1['NH7'].'</td>	
                <td>'.$registroF10_1['NM7'].'</td>					
				<td>'.$registroF10_1['SH7'].'</td>					
				<td>'.$registroF10_1['SM7'].'</td>
				
				<td>'.$registroF10_1['NH8'].'</td>	
                <td>'.$registroF10_1['NM8'].'</td>					
				<td>'.$registroF10_1['SH8'].'</td>					
				<td>'.$registroF10_1['SM8'].'</td>
				
				<td>'.$registroF10_1['NH9'].'</td>	
                <td>'.$registroF10_1['NM9'].'</td>					
				<td>'.$registroF10_1['SH9'].'</td>					
				<td>'.$registroF10_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF10_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF10_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF10_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF10_1['Total4']).'</p></b></td>

                <td><b><p style="color: '.$color_neto.';">'.number_format($registroF10_1['Total']).'</td>				
				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>					
				</tr>';
				$totalNH1 += $registroF10_1['NH1'];
				$totalNM1 += $registroF10_1['NM1'];
				$totalSH1 += $registroF10_1['SH1'];
				$totalSM1 += $registroF10_1['SM1'];
				
				$totalNH2 += $registroF10_1['NH2'];
				$totalNM2 += $registroF10_1['NM2'];
				$totalSH2 += $registroF10_1['SH2'];
				$totalSM2 += $registroF10_1['SM2'];
				
				$totalNH3 += $registroF10_1['NH3'];
				$totalNM3 += $registroF10_1['NM3'];
				$totalSH3 += $registroF10_1['SH3'];
				$totalSM3 += $registroF10_1['SM3'];
				
				$totalNH4 += $registroF10_1['NH4'];
				$totalNM4 += $registroF10_1['NM4'];
				$totalSH4 += $registroF10_1['SH4'];
				$totalSM4 += $registroF10_1['SM4'];
				
				$totalNH5 += $registroF10_1['NH5'];
				$totalNM5 += $registroF10_1['NM5'];
				$totalSH5 += $registroF10_1['SH5'];
				$totalSM5 += $registroF10_1['SM5'];
				
				$totalNH6 += $registroF10_1['NH6'];
				$totalNM6 += $registroF10_1['NM6'];
				$totalSH6 += $registroF10_1['SH6'];
				$totalSM6 += $registroF10_1['SM6'];
				
				$totalNH7 += $registroF10_1['NH7'];
				$totalNM7 += $registroF10_1['NM7'];
				$totalSH7 += $registroF10_1['SH7'];
				$totalSM7 += $registroF10_1['SM7'];
				
				$totalNH8 += $registroF10_1['NH8'];
				$totalNM8 += $registroF10_1['NM8'];
				$totalSH8 += $registroF10_1['SH8'];
				$totalSM8 += $registroF10_1['SM8'];
				
				$totalNH9 += $registroF10_1['NH9'];
				$totalNM9 += $registroF10_1['NM9'];
				$totalSH9 += $registroF10_1['SH9'];
				$totalSM9 += $registroF10_1['SM9'];
				
				$total1 += $registroF10_1['Total1'];
				$total2 += $registroF10_1['Total2'];
				$total3 += $registroF10_1['Total3'];
				$total4 += $registroF10_1['Total4'];				
				
				$total += $registroF10_1['Total'];
	   }
	}	
	
	if($resultF20->num_rows>0){
		while($registroF20_1 = $resultF20->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			 $porcentaje = ($registroF20_1['Total'] / $consulta1['Total'])*100;			 
		 }else{
			 $porcentaje = 0; 
		  }
			
	   	   echo '<tr>
		        <td>'.$registroF20_1['Codigo'].'</td>
				<td>'.$registroF20_1['Enfermedad'].'</td>	
				<td>'.$registroF20_1['NH1'].'</td>	
                <td>'.$registroF20_1['NM1'].'</td>					
				<td>'.$registroF20_1['SH1'].'</td>					
				<td>'.$registroF20_1['SM1'].'</td>	

				<td>'.$registroF20_1['NH2'].'</td>	
                <td>'.$registroF20_1['NM2'].'</td>					
				<td>'.$registroF20_1['SH2'].'</td>					
				<td>'.$registroF20_1['SM2'].'</td>	

				<td>'.$registroF20_1['NH3'].'</td>	
                <td>'.$registroF20_1['NM3'].'</td>					
				<td>'.$registroF20_1['SH3'].'</td>					
				<td>'.$registroF20_1['SM3'].'</td>	

				<td>'.$registroF20_1['NH4'].'</td>	
                <td>'.$registroF20_1['NM4'].'</td>					
				<td>'.$registroF20_1['SH4'].'</td>					
				<td>'.$registroF20_1['SM4'].'</td>	

				<td>'.$registroF20_1['NH5'].'</td>	
                <td>'.$registroF20_1['NM5'].'</td>					
				<td>'.$registroF20_1['SH5'].'</td>					
				<td>'.$registroF20_1['SM5'].'</td>	

				<td>'.$registroF20_1['NH6'].'</td>	
                <td>'.$registroF20_1['NM6'].'</td>					
				<td>'.$registroF20_1['SH6'].'</td>					
				<td>'.$registroF20_1['SM6'].'</td>	

				<td>'.$registroF20_1['NH7'].'</td>	
                <td>'.$registroF20_1['NM7'].'</td>					
				<td>'.$registroF20_1['SH7'].'</td>					
				<td>'.$registroF20_1['SM7'].'</td>	

				<td>'.$registroF20_1['NH8'].'</td>	
                <td>'.$registroF20_1['NM8'].'</td>					
				<td>'.$registroF20_1['SH8'].'</td>					
				<td>'.$registroF20_1['SM8'].'</td>	

				<td>'.$registroF20_1['NH9'].'</td>	
                <td>'.$registroF20_1['NM9'].'</td>					
				<td>'.$registroF20_1['SH9'].'</td>					
				<td>'.$registroF20_1['SM9'].'</td>					

				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF20_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF20_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF20_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF20_1['Total4']).'</p></b></td>					
				
                <td><b><p style="color: '.$color_neto.';">'.number_format($registroF20_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF20_1['NH1'];
				$totalNM1 += $registroF20_1['NM1'];
				$totalSH1 += $registroF20_1['SH1'];
				$totalSM1 += $registroF20_1['SM1'];
				
				$totalNH2 += $registroF20_1['NH2'];
				$totalNM2 += $registroF20_1['NM2'];
				$totalSH2 += $registroF20_1['SH2'];
				$totalSM2 += $registroF20_1['SM2'];

				$totalNH3 += $registroF20_1['NH3'];
				$totalNM3 += $registroF20_1['NM3'];
				$totalSH3 += $registroF20_1['SH3'];
				$totalSM3 += $registroF20_1['SM3'];

				$totalNH4 += $registroF20_1['NH4'];
				$totalNM4 += $registroF20_1['NM4'];
				$totalSH4 += $registroF20_1['SH4'];
				$totalSM4 += $registroF20_1['SM4'];

				$totalNH5 += $registroF20_1['NH5'];
				$totalNM5 += $registroF20_1['NM5'];
				$totalSH5 += $registroF20_1['SH5'];
				$totalSM5 += $registroF20_1['SM5'];

				$totalNH6 += $registroF20_1['NH6'];
				$totalNM6 += $registroF20_1['NM6'];
				$totalSH6 += $registroF20_1['SH6'];
				$totalSM6 += $registroF20_1['SM6'];

				$totalNH7 += $registroF20_1['NH7'];
				$totalNM7 += $registroF20_1['NM7'];
				$totalSH7 += $registroF20_1['SH7'];
				$totalSM7 += $registroF20_1['SM7'];

				$totalNH8 += $registroF20_1['NH8'];
				$totalNM8 += $registroF20_1['NM8'];
				$totalSH8 += $registroF20_1['SH8'];
				$totalSM8 += $registroF20_1['SM8'];

				$totalNH9 += $registroF20_1['NH9'];
				$totalNM9 += $registroF20_1['NM9'];
				$totalSH9 += $registroF20_1['SH9'];
				$totalSM9 += $registroF20_1['SM9'];
				
				$total1 += $registroF20_1['Total1'];
				$total2 += $registroF20_1['Total2'];
				$total3 += $registroF20_1['Total3'];
				$total4 += $registroF20_1['Total4'];				
				
				$total += $registroF20_1['Total'];
	   }
	}		
	
	if($resultF30->num_rows>0){
		while($registroF30_1 = $resultF30->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			 $porcentaje = ($registroF30_1['Total'] / $consulta1['Total'])*100;			 
		 }else{
			 $porcentaje = 0; 
		  }			
		
	   	   echo '<tr>
		        <td>'.$registroF30_1['Codigo'].'</td>
				<td>'.$registroF30_1['Enfermedad'].'</td>	
				<td>'.$registroF30_1['NH1'].'</td>	
                <td>'.$registroF30_1['NM1'].'</td>					
				<td>'.$registroF30_1['SH1'].'</td>					
				<td>'.$registroF30_1['SM1'].'</td>

				<td>'.$registroF30_1['NH2'].'</td>	
                <td>'.$registroF30_1['NM2'].'</td>					
				<td>'.$registroF30_1['SH2'].'</td>					
				<td>'.$registroF30_1['SM2'].'</td>

				<td>'.$registroF30_1['NH3'].'</td>	
                <td>'.$registroF30_1['NM3'].'</td>					
				<td>'.$registroF30_1['SH3'].'</td>					
				<td>'.$registroF30_1['SM3'].'</td>

				<td>'.$registroF30_1['NH4'].'</td>	
                <td>'.$registroF30_1['NM4'].'</td>					
				<td>'.$registroF30_1['SH4'].'</td>					
				<td>'.$registroF30_1['SM4'].'</td>

				<td>'.$registroF30_1['NH5'].'</td>	
                <td>'.$registroF30_1['NM5'].'</td>					
				<td>'.$registroF30_1['SH5'].'</td>					
				<td>'.$registroF30_1['SM5'].'</td>

				<td>'.$registroF30_1['NH6'].'</td>	
                <td>'.$registroF30_1['NM6'].'</td>					
				<td>'.$registroF30_1['SH6'].'</td>					
				<td>'.$registroF30_1['SM6'].'</td>

				<td>'.$registroF30_1['NH7'].'</td>	
                <td>'.$registroF30_1['NM7'].'</td>					
				<td>'.$registroF30_1['SH7'].'</td>					
				<td>'.$registroF30_1['SM7'].'</td>

				<td>'.$registroF30_1['NH8'].'</td>	
                <td>'.$registroF30_1['NM8'].'</td>					
				<td>'.$registroF30_1['SH8'].'</td>					
				<td>'.$registroF30_1['SM8'].'</td>

				<td>'.$registroF30_1['NH9'].'</td>	
                <td>'.$registroF30_1['NM9'].'</td>					
				<td>'.$registroF30_1['SH9'].'</td>					
				<td>'.$registroF30_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF30_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF30_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF30_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF30_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF30_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF30_1['NH1'];
				$totalNM1 += $registroF30_1['NM1'];
				$totalSH1 += $registroF30_1['SH1'];
				$totalSM1 += $registroF30_1['SM1'];
				
				$totalNH2 += $registroF30_1['NH2'];
				$totalNM2 += $registroF30_1['NM2'];
				$totalSH2 += $registroF30_1['SH2'];
				$totalSM2 += $registroF30_1['SM2'];

				$totalNH3 += $registroF30_1['NH3'];
				$totalNM3 += $registroF30_1['NM3'];
				$totalSH3 += $registroF30_1['SH3'];
				$totalSM3 += $registroF30_1['SM3'];

				$totalNH4 += $registroF30_1['NH4'];
				$totalNM4 += $registroF30_1['NM4'];
				$totalSH4 += $registroF30_1['SH4'];
				$totalSM4 += $registroF30_1['SM4'];

				$totalNH5 += $registroF30_1['NH5'];
				$totalNM5 += $registroF30_1['NM5'];
				$totalSH5 += $registroF30_1['SH5'];
				$totalSM5 += $registroF30_1['SM5'];

				$totalNH6 += $registroF30_1['NH6'];
				$totalNM6 += $registroF30_1['NM6'];
				$totalSH6 += $registroF30_1['SH6'];
				$totalSM6 += $registroF30_1['SM6'];

				$totalNH7 += $registroF30_1['NH7'];
				$totalNM7 += $registroF30_1['NM7'];
				$totalSH7 += $registroF30_1['SH7'];
				$totalSM7 += $registroF30_1['SM7'];

				$totalNH8 += $registroF30_1['NH8'];
				$totalNM8 += $registroF30_1['NM8'];
				$totalSH8 += $registroF30_1['SH8'];
				$totalSM8 += $registroF30_1['SM8'];

				$totalNH9 += $registroF30_1['NH9'];
				$totalNM9 += $registroF30_1['NM9'];
				$totalSH9 += $registroF30_1['SH9'];
				$totalSM9 += $registroF30_1['SM9'];		

				$total1 += $registroF30_1['Total1'];
				$total2 += $registroF30_1['Total2'];
				$total3 += $registroF30_1['Total3'];
				$total4 += $registroF30_1['Total4'];						
				
				$total += $registroF30_1['Total'];
	   }
	}	

	if($resultF31->num_rows>0){
		while($registroF31_1 = $resultF31->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
		    $porcentaje = ($registroF31_1['Total'] / $consulta1['Total'])*100;		 
		 }else{
			 $porcentaje = 0; 
		  }			
			
	   	   echo '<tr>
		        <td>'.$registroF31_1['Codigo'].'</td>
				<td>'.$registroF31_1['Enfermedad'].'</td>	
				<td>'.$registroF31_1['NH1'].'</td>	
                <td>'.$registroF31_1['NM1'].'</td>					
				<td>'.$registroF31_1['SH1'].'</td>					
				<td>'.$registroF31_1['SM1'].'</td>

				<td>'.$registroF31_1['NH2'].'</td>	
                <td>'.$registroF31_1['NM2'].'</td>					
				<td>'.$registroF31_1['SH2'].'</td>					
				<td>'.$registroF31_1['SM2'].'</td>

				<td>'.$registroF31_1['NH3'].'</td>	
                <td>'.$registroF31_1['NM3'].'</td>					
				<td>'.$registroF31_1['SH3'].'</td>					
				<td>'.$registroF31_1['SM3'].'</td>

				<td>'.$registroF31_1['NH4'].'</td>	
                <td>'.$registroF31_1['NM4'].'</td>					
				<td>'.$registroF31_1['SH4'].'</td>					
				<td>'.$registroF31_1['SM4'].'</td>				
				
				<td>'.$registroF31_1['NH5'].'</td>	
                <td>'.$registroF31_1['NM5'].'</td>					
				<td>'.$registroF31_1['SH5'].'</td>					
				<td>'.$registroF31_1['SM5'].'</td>

				<td>'.$registroF31_1['NH6'].'</td>	
                <td>'.$registroF31_1['NM6'].'</td>					
				<td>'.$registroF31_1['SH6'].'</td>					
				<td>'.$registroF31_1['SM6'].'</td>

				<td>'.$registroF31_1['NH7'].'</td>	
                <td>'.$registroF31_1['NM7'].'</td>					
				<td>'.$registroF31_1['SH7'].'</td>					
				<td>'.$registroF31_1['SM7'].'</td>

				<td>'.$registroF31_1['NH8'].'</td>	
                <td>'.$registroF31_1['NM8'].'</td>					
				<td>'.$registroF31_1['SH8'].'</td>					
				<td>'.$registroF31_1['SM8'].'</td>	

				<td>'.$registroF31_1['NH9'].'</td>	
                <td>'.$registroF31_1['NM9'].'</td>					
				<td>'.$registroF31_1['SH9'].'</td>					
				<td>'.$registroF31_1['SM9'].'</td>					
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF31_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF31_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF31_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF31_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF31_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF31_1['NH1'];
				$totalNM1 += $registroF31_1['NM1'];
				$totalSH1 += $registroF31_1['SH1'];
				$totalSM1 += $registroF31_1['SM1'];
				
				$totalNH2 += $registroF31_1['NH2'];
				$totalNM2 += $registroF31_1['NM2'];
				$totalSH2 += $registroF31_1['SH2'];
				$totalSM2 += $registroF31_1['SM2'];

				$totalNH3 += $registroF31_1['NH3'];
				$totalNM3 += $registroF31_1['NM3'];
				$totalSH3 += $registroF31_1['SH3'];
				$totalSM3 += $registroF31_1['SM3'];

				$totalNH4 += $registroF31_1['NH4'];
				$totalNM4 += $registroF31_1['NM4'];
				$totalSH4 += $registroF31_1['SH4'];
				$totalSM4 += $registroF31_1['SM4'];

				$totalNH5 += $registroF31_1['NH5'];
				$totalNM5 += $registroF31_1['NM5'];
				$totalSH5 += $registroF31_1['SH5'];
				$totalSM5 += $registroF31_1['SM5'];

				$totalNH6 += $registroF31_1['NH6'];
				$totalNM6 += $registroF31_1['NM6'];
				$totalSH6 += $registroF31_1['SH6'];
				$totalSM6 += $registroF31_1['SM6'];

				$totalNH7 += $registroF31_1['NH7'];
				$totalNM7 += $registroF31_1['NM7'];
				$totalSH7 += $registroF31_1['SH7'];
				$totalSM7 += $registroF31_1['SM7'];

				$totalNH8 += $registroF31_1['NH8'];
				$totalNM8 += $registroF31_1['NM8'];
				$totalSH8 += $registroF31_1['SH8'];
				$totalSM8 += $registroF31_1['SM8'];

				$totalNH9 += $registroF31_1['NH9'];
				$totalNM9 += $registroF31_1['NM9'];
				$totalSH9 += $registroF31_1['SH9'];
				$totalSM9 += $registroF31_1['SM9'];
				
				$total1 += $registroF31_1['Total1'];
				$total2 += $registroF31_1['Total2'];
				$total3 += $registroF31_1['Total3'];
				$total4 += $registroF31_1['Total4'];				
				
				$total += $registroF31_1['Total'];
	   }
	}

	if($resultF32->num_rows>0){
		while($registroF32_1 = $resultF32->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
		    $porcentaje = ($registroF32_1['Total'] / $consulta1['Total'])*100;			 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroF32_1['Codigo'].'</td>
				<td>'.$registroF32_1['Enfermedad'].'</td>	
				<td>'.$registroF32_1['NH1'].'</td>	
                <td>'.$registroF32_1['NM1'].'</td>					
				<td>'.$registroF32_1['SH1'].'</td>					
				<td>'.$registroF32_1['SM1'].'</td>	

				<td>'.$registroF32_1['NH2'].'</td>	
                <td>'.$registroF32_1['NM2'].'</td>					
				<td>'.$registroF32_1['SH2'].'</td>					
				<td>'.$registroF32_1['SM2'].'</td>	

				<td>'.$registroF32_1['NH3'].'</td>	
                <td>'.$registroF32_1['NM3'].'</td>					
				<td>'.$registroF32_1['SH3'].'</td>					
				<td>'.$registroF32_1['SM3'].'</td>	

				<td>'.$registroF32_1['NH4'].'</td>	
                <td>'.$registroF32_1['NM4'].'</td>					
				<td>'.$registroF32_1['SH4'].'</td>					
				<td>'.$registroF32_1['SM4'].'</td>	

				<td>'.$registroF32_1['NH5'].'</td>	
                <td>'.$registroF32_1['NM5'].'</td>					
				<td>'.$registroF32_1['SH5'].'</td>					
				<td>'.$registroF32_1['SM5'].'</td>	

				<td>'.$registroF32_1['NH6'].'</td>	
                <td>'.$registroF32_1['NM6'].'</td>					
				<td>'.$registroF32_1['SH6'].'</td>					
				<td>'.$registroF32_1['SM6'].'</td>	

				<td>'.$registroF32_1['NH7'].'</td>	
                <td>'.$registroF32_1['NM7'].'</td>					
				<td>'.$registroF32_1['SH7'].'</td>					
				<td>'.$registroF32_1['SM7'].'</td>	

				<td>'.$registroF32_1['NH8'].'</td>	
                <td>'.$registroF32_1['NM8'].'</td>					
				<td>'.$registroF32_1['SH8'].'</td>					
				<td>'.$registroF32_1['SM8'].'</td>

				<td>'.$registroF32_1['NH9'].'</td>	
                <td>'.$registroF32_1['NM9'].'</td>					
				<td>'.$registroF32_1['SH9'].'</td>					
				<td>'.$registroF32_1['SM9'].'</td>				
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF32_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF32_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF32_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF32_1['Total4']).'</p></b></td>	
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF32_1['Total']).'</p></b></td>					
				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF32_1['NH1'];
				$totalNM1 += $registroF32_1['NM1'];
				$totalSH1 += $registroF32_1['SH1'];
				$totalSM1 += $registroF32_1['SM1'];
				
				$totalNH2 += $registroF32_1['NH2'];
				$totalNM2 += $registroF32_1['NM2'];
				$totalSH2 += $registroF32_1['SH2'];
				$totalSM2 += $registroF32_1['SM2'];

				$totalNH3 += $registroF32_1['NH3'];
				$totalNM3 += $registroF32_1['NM3'];
				$totalSH3 += $registroF32_1['SH3'];
				$totalSM3 += $registroF32_1['SM3'];

				$totalNH4 += $registroF32_1['NH4'];
				$totalNM4 += $registroF32_1['NM4'];
				$totalSH4 += $registroF32_1['SH4'];
				$totalSM4 += $registroF32_1['SM4'];

				$totalNH5 += $registroF32_1['NH5'];
				$totalNM5 += $registroF32_1['NM5'];
				$totalSH5 += $registroF32_1['SH5'];
				$totalSM5 += $registroF32_1['SM5'];

				$totalNH6 += $registroF32_1['NH6'];
				$totalNM6 += $registroF32_1['NM6'];
				$totalSH6 += $registroF32_1['SH6'];
				$totalSM6 += $registroF32_1['SM6'];

				$totalNH7 += $registroF32_1['NH7'];
				$totalNM7 += $registroF32_1['NM7'];
				$totalSH7 += $registroF32_1['SH7'];
				$totalSM7 += $registroF32_1['SM7'];

				$totalNH8 += $registroF32_1['NH8'];
				$totalNM8 += $registroF32_1['NM8'];
				$totalSH8 += $registroF32_1['SH8'];
				$totalSM8 += $registroF32_1['SM8'];

				$totalNH9 += $registroF32_1['NH9'];
				$totalNM9 += $registroF32_1['NM9'];
				$totalSH9 += $registroF32_1['SH9'];
				$totalSM9 += $registroF32_1['SM9'];
				
				$total1 += $registroF32_1['Total1'];
				$total2 += $registroF32_1['Total2'];
				$total3 += $registroF32_1['Total3'];
				$total4 += $registroF32_1['Total4'];				
				
				$total += $registroF32_1['Total'];
	   }
	}	
	
	if($resultF40->num_rows>0){
		while($registroF40_1 = $resultF40->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
		     $porcentaje = ($registroF40_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		  }			
			
	   	   echo '<tr>
		        <td>'.$registroF40_1['Codigo'].'</td>
				<td>'.$registroF40_1['Enfermedad'].'</td>	
				<td>'.$registroF40_1['NH1'].'</td>	
                <td>'.$registroF40_1['NM1'].'</td>					
				<td>'.$registroF40_1['SH1'].'</td>					
				<td>'.$registroF40_1['SM1'].'</td>	

				<td>'.$registroF40_1['NH2'].'</td>	
                <td>'.$registroF40_1['NM2'].'</td>					
				<td>'.$registroF40_1['SH2'].'</td>					
				<td>'.$registroF40_1['SM2'].'</td>	

				<td>'.$registroF40_1['NH3'].'</td>	
                <td>'.$registroF40_1['NM3'].'</td>					
				<td>'.$registroF40_1['SH3'].'</td>					
				<td>'.$registroF40_1['SM3'].'</td>	

				<td>'.$registroF40_1['NH4'].'</td>	
                <td>'.$registroF40_1['NM4'].'</td>					
				<td>'.$registroF40_1['SH4'].'</td>					
				<td>'.$registroF40_1['SM4'].'</td>	

				<td>'.$registroF40_1['NH5'].'</td>	
                <td>'.$registroF40_1['NM5'].'</td>					
				<td>'.$registroF40_1['SH5'].'</td>					
				<td>'.$registroF40_1['SM5'].'</td>	

				<td>'.$registroF40_1['NH6'].'</td>	
                <td>'.$registroF40_1['NM6'].'</td>					
				<td>'.$registroF40_1['SH6'].'</td>					
				<td>'.$registroF40_1['SM6'].'</td>	

				<td>'.$registroF40_1['NH7'].'</td>	
                <td>'.$registroF40_1['NM7'].'</td>					
				<td>'.$registroF40_1['SH7'].'</td>					
				<td>'.$registroF40_1['SM7'].'</td>	

				<td>'.$registroF40_1['NH8'].'</td>	
                <td>'.$registroF40_1['NM8'].'</td>					
				<td>'.$registroF40_1['SH8'].'</td>					
				<td>'.$registroF40_1['SM8'].'</td>	

				<td>'.$registroF40_1['NH9'].'</td>	
                <td>'.$registroF40_1['NM9'].'</td>					
				<td>'.$registroF40_1['SH9'].'</td>					
				<td>'.$registroF40_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF40_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF40_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF40_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF40_1['Total4']).'</p></b></td>					

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF40_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p><b></td>						
				</tr>';
				$totalNH1 += $registroF40_1['NH1'];
				$totalNM1 += $registroF40_1['NM1'];
				$totalSH1 += $registroF40_1['SH1'];
				$totalSM1 += $registroF40_1['SM1'];
				
				$totalNH2 += $registroF40_1['NH2'];
				$totalNM2 += $registroF40_1['NM2'];
				$totalSH2 += $registroF40_1['SH2'];
				$totalSM2 += $registroF40_1['SM2'];

				$totalNH3 += $registroF40_1['NH3'];
				$totalNM3 += $registroF40_1['NM3'];
				$totalSH3 += $registroF40_1['SH3'];
				$totalSM3 += $registroF40_1['SM3'];

				$totalNH4 += $registroF40_1['NH4'];
				$totalNM4 += $registroF40_1['NM4'];
				$totalSH4 += $registroF40_1['SH4'];
				$totalSM4 += $registroF40_1['SM4'];

				$totalNH5 += $registroF40_1['NH5'];
				$totalNM5 += $registroF40_1['NM5'];
				$totalSH5 += $registroF40_1['SH5'];
				$totalSM5 += $registroF40_1['SM5'];

				$totalNH6 += $registroF40_1['NH6'];
				$totalNM6 += $registroF40_1['NM6'];
				$totalSH6 += $registroF40_1['SH6'];
				$totalSM6 += $registroF40_1['SM6'];

				$totalNH7 += $registroF40_1['NH7'];
				$totalNM7 += $registroF40_1['NM7'];
				$totalSH7 += $registroF40_1['SH7'];
				$totalSM7 += $registroF40_1['SM7'];

				$totalNH8 += $registroF40_1['NH8'];
				$totalNM8 += $registroF40_1['NM8'];
				$totalSH8 += $registroF40_1['SH8'];
				$totalSM8 += $registroF40_1['SM8'];

				$totalNH9 += $registroF40_1['NH9'];
				$totalNM9 += $registroF40_1['NM9'];
				$totalSH9 += $registroF40_1['SH9'];
				$totalSM9 += $registroF40_1['SM9'];
				
				$total1 += $registroF40_1['Total1'];
				$total2 += $registroF40_1['Total2'];
				$total3 += $registroF40_1['Total3'];
				$total4 += $registroF40_1['Total4'];				
				
				$total += $registroF40_1['Total'];
	   }
	}		
	
	if($resultF50->num_rows>0){
		while($registroF50_1 = $resultF50->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
		     $porcentaje = ($registroF50_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		  }					
			
	   	   echo '<tr>
		        <td>'.$registroF50_1['Codigo'].'</td>
				<td>'.$registroF50_1['Enfermedad'].'</td>	
				<td>'.$registroF50_1['NH1'].'</td>	
                <td>'.$registroF50_1['NM1'].'</td>					
				<td>'.$registroF50_1['SH1'].'</td>					
				<td>'.$registroF50_1['SM1'].'</td>	

				<td>'.$registroF50_1['NH2'].'</td>	
                <td>'.$registroF50_1['NM2'].'</td>					
				<td>'.$registroF50_1['SH2'].'</td>					
				<td>'.$registroF50_1['SM2'].'</td>	

				<td>'.$registroF50_1['NH3'].'</td>	
                <td>'.$registroF50_1['NM3'].'</td>					
				<td>'.$registroF50_1['SH3'].'</td>					
				<td>'.$registroF50_1['SM3'].'</td>	

				<td>'.$registroF50_1['NH4'].'</td>	
                <td>'.$registroF50_1['NM4'].'</td>					
				<td>'.$registroF50_1['SH4'].'</td>					
				<td>'.$registroF50_1['SM4'].'</td>	

				<td>'.$registroF50_1['NH5'].'</td>	
                <td>'.$registroF50_1['NM5'].'</td>					
				<td>'.$registroF50_1['SH5'].'</td>					
				<td>'.$registroF50_1['SM5'].'</td>	

				<td>'.$registroF50_1['NH6'].'</td>	
                <td>'.$registroF50_1['NM6'].'</td>					
				<td>'.$registroF50_1['SH6'].'</td>					
				<td>'.$registroF50_1['SM6'].'</td>	

				<td>'.$registroF50_1['NH7'].'</td>	
                <td>'.$registroF50_1['NM7'].'</td>					
				<td>'.$registroF50_1['SH7'].'</td>					
				<td>'.$registroF50_1['SM7'].'</td>	

				<td>'.$registroF50_1['NH8'].'</td>	
                <td>'.$registroF50_1['NM8'].'</td>					
				<td>'.$registroF50_1['SH8'].'</td>					
				<td>'.$registroF50_1['SM8'].'</td>	

				<td>'.$registroF50_1['NH9'].'</td>	
                <td>'.$registroF50_1['NM9'].'</td>					
				<td>'.$registroF50_1['SH9'].'</td>					
				<td>'.$registroF50_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF50_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF50_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF50_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF50_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF50_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF50_1['NH1'];
				$totalNM1 += $registroF50_1['NM1'];
				$totalSH1 += $registroF50_1['SH1'];
				$totalSM1 += $registroF50_1['SM1'];
				
				$totalNH2 += $registroF50_1['NH2'];
				$totalNM2 += $registroF50_1['NM2'];
				$totalSH2 += $registroF50_1['SH2'];
				$totalSM2 += $registroF50_1['SM2'];

				$totalNH3 += $registroF50_1['NH3'];
				$totalNM3 += $registroF50_1['NM3'];
				$totalSH3 += $registroF50_1['SH3'];
				$totalSM3 += $registroF50_1['SM3'];

				$totalNH4 += $registroF50_1['NH4'];
				$totalNM4 += $registroF50_1['NM4'];
				$totalSH4 += $registroF50_1['SH4'];
				$totalSM4 += $registroF50_1['SM4'];

				$totalNH5 += $registroF50_1['NH5'];
				$totalNM5 += $registroF50_1['NM5'];
				$totalSH5 += $registroF50_1['SH5'];
				$totalSM5 += $registroF50_1['SM5'];

				$totalNH6 += $registroF50_1['NH6'];
				$totalNM6 += $registroF50_1['NM6'];
				$totalSH6 += $registroF50_1['SH6'];
				$totalSM6 += $registroF50_1['SM6'];

				$totalNH7 += $registroF50_1['NH7'];
				$totalNM7 += $registroF50_1['NM7'];
				$totalSH7 += $registroF50_1['SH7'];
				$totalSM7 += $registroF50_1['SM7'];

				$totalNH8 += $registroF50_1['NH8'];
				$totalNM8 += $registroF50_1['NM8'];
				$totalSH8 += $registroF50_1['SH8'];
				$totalSM8 += $registroF50_1['SM8'];

				$totalNH9 += $registroF50_1['NH9'];
				$totalNM9 += $registroF50_1['NM9'];
				$totalSH9 += $registroF50_1['SH9'];
				$totalSM9 += $registroF50_1['SM9'];
				
				$total1 += $registroF50_1['Total1'];
				$total2 += $registroF50_1['Total2'];
				$total3 += $registroF50_1['Total3'];
				$total4 += $registroF50_1['Total4'];				
				
				$total += $registroF50_1['Total'];
	   }
	}

	if($resultF60->num_rows>0){
		while($registroF60_1 = $resultF60->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroF60_1['Total'] / $consulta1['Total'])*100;				 
		 }else{
			 $porcentaje = 0; 
		  }			
			
	   	   echo '<tr>
		        <td>'.$registroF60_1['Codigo'].'</td>
				<td>'.$registroF60_1['Enfermedad'].'</td>	
				<td>'.$registroF60_1['NH1'].'</td>	
                <td>'.$registroF60_1['NM1'].'</td>					
				<td>'.$registroF60_1['SH1'].'</td>					
				<td>'.$registroF60_1['SM1'].'</td>		

				<td>'.$registroF60_1['NH2'].'</td>	
                <td>'.$registroF60_1['NM2'].'</td>					
				<td>'.$registroF60_1['SH2'].'</td>					
				<td>'.$registroF60_1['SM2'].'</td>		

				<td>'.$registroF60_1['NH3'].'</td>	
                <td>'.$registroF60_1['NM3'].'</td>					
				<td>'.$registroF60_1['SH3'].'</td>					
				<td>'.$registroF60_1['SM3'].'</td>		

				<td>'.$registroF60_1['NH4'].'</td>	
                <td>'.$registroF60_1['NM4'].'</td>					
				<td>'.$registroF60_1['SH4'].'</td>					
				<td>'.$registroF60_1['SM4'].'</td>		
				
				<td>'.$registroF60_1['NH5'].'</td>	
                <td>'.$registroF60_1['NM5'].'</td>					
				<td>'.$registroF60_1['SH5'].'</td>					
				<td>'.$registroF60_1['SM5'].'</td>		

				<td>'.$registroF60_1['NH6'].'</td>	
                <td>'.$registroF60_1['NM6'].'</td>					
				<td>'.$registroF60_1['SH6'].'</td>					
				<td>'.$registroF60_1['SM6'].'</td>		

				<td>'.$registroF60_1['NH7'].'</td>	
                <td>'.$registroF60_1['NM7'].'</td>					
				<td>'.$registroF60_1['SH7'].'</td>					
				<td>'.$registroF60_1['SM7'].'</td>		

				<td>'.$registroF60_1['NH8'].'</td>	
                <td>'.$registroF60_1['NM8'].'</td>					
				<td>'.$registroF60_1['SH8'].'</td>					
				<td>'.$registroF60_1['SM8'].'</td>		

				<td>'.$registroF60_1['NH9'].'</td>	
                <td>'.$registroF60_1['NM9'].'</td>					
				<td>'.$registroF60_1['SH9'].'</td>					
				<td>'.$registroF60_1['SM9'].'</td>	

				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF60_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF60_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF60_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF60_1['Total4']).'</p></b></td>					

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF60_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF60_1['NH1'];
				$totalNM1 += $registroF60_1['NM1'];
				$totalSH1 += $registroF60_1['SH1'];
				$totalSM1 += $registroF60_1['SM1'];
				
				$totalNH2 += $registroF60_1['NH2'];
				$totalNM2 += $registroF60_1['NM2'];
				$totalSH2 += $registroF60_1['SH2'];
				$totalSM2 += $registroF60_1['SM2'];

				$totalNH3 += $registroF60_1['NH3'];
				$totalNM3 += $registroF60_1['NM3'];
				$totalSH3 += $registroF60_1['SH3'];
				$totalSM3 += $registroF60_1['SM3'];

				$totalNH4 += $registroF60_1['NH4'];
				$totalNM4 += $registroF60_1['NM4'];
				$totalSH4 += $registroF60_1['SH4'];
				$totalSM4 += $registroF60_1['SM4'];

				$totalNH5 += $registroF60_1['NH5'];
				$totalNM5 += $registroF60_1['NM5'];
				$totalSH5 += $registroF60_1['SH5'];
				$totalSM5 += $registroF60_1['SM5'];

				$totalNH6 += $registroF60_1['NH6'];
				$totalNM6 += $registroF60_1['NM6'];
				$totalSH6 += $registroF60_1['SH6'];
				$totalSM6 += $registroF60_1['SM6'];

				$totalNH7 += $registroF60_1['NH7'];
				$totalNM7 += $registroF60_1['NM7'];
				$totalSH7 += $registroF60_1['SH7'];
				$totalSM7 += $registroF60_1['SM7'];

				$totalNH8 += $registroF60_1['NH8'];
				$totalNM8 += $registroF60_1['NM8'];
				$totalSH8 += $registroF60_1['SH8'];
				$totalSM8 += $registroF60_1['SM8'];

				$totalNH9 += $registroF60_1['NH9'];
				$totalNM9 += $registroF60_1['NM9'];
				$totalSH9 += $registroF60_1['SH9'];
				$totalSM9 += $registroF60_1['SM9'];
				
				$total1 += $registroF60_1['Total1'];
				$total2 += $registroF60_1['Total2'];
				$total3 += $registroF60_1['Total3'];
				$total4 += $registroF60_1['Total4'];				
								
				$total += $registroF60_1['Total'];
	   }
	}

	if($resultF70->num_rows>0){
		while($registroF70_1 = $resultF70->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
		     $porcentaje = ($registroF70_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		  }					
			
	   	   echo '<tr>
		        <td>'.$registroF70_1['Codigo'].'</td>
				<td>'.$registroF70_1['Enfermedad'].'</td>	
				<td>'.$registroF70_1['NH1'].'</td>	
                <td>'.$registroF70_1['NM1'].'</td>					
				<td>'.$registroF70_1['SH1'].'</td>					
				<td>'.$registroF70_1['SM1'].'</td>

				<td>'.$registroF70_1['NH2'].'</td>	
                <td>'.$registroF70_1['NM2'].'</td>					
				<td>'.$registroF70_1['SH2'].'</td>					
				<td>'.$registroF70_1['SM2'].'</td>
				
				<td>'.$registroF70_1['NH3'].'</td>	
                <td>'.$registroF70_1['NM3'].'</td>					
				<td>'.$registroF70_1['SH3'].'</td>					
				<td>'.$registroF70_1['SM3'].'</td>

				<td>'.$registroF70_1['NH4'].'</td>	
                <td>'.$registroF70_1['NM4'].'</td>					
				<td>'.$registroF70_1['SH4'].'</td>					
				<td>'.$registroF70_1['SM4'].'</td>

				<td>'.$registroF70_1['NH5'].'</td>	
                <td>'.$registroF70_1['NM5'].'</td>					
				<td>'.$registroF70_1['SH5'].'</td>					
				<td>'.$registroF70_1['SM5'].'</td>

				<td>'.$registroF70_1['NH6'].'</td>	
                <td>'.$registroF70_1['NM6'].'</td>					
				<td>'.$registroF70_1['SH6'].'</td>					
				<td>'.$registroF70_1['SM6'].'</td>

				<td>'.$registroF70_1['NH7'].'</td>	
                <td>'.$registroF70_1['NM7'].'</td>					
				<td>'.$registroF70_1['SH7'].'</td>					
				<td>'.$registroF70_1['SM7'].'</td>

				<td>'.$registroF70_1['NH8'].'</td>	
                <td>'.$registroF70_1['NM8'].'</td>					
				<td>'.$registroF70_1['SH8'].'</td>					
				<td>'.$registroF70_1['SM8'].'</td>

				<td>'.$registroF70_1['NH9'].'</td>	
                <td>'.$registroF70_1['NM9'].'</td>					
				<td>'.$registroF70_1['SH9'].'</td>					
				<td>'.$registroF70_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF70_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF70_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF70_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF70_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF70_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF70_1['NH1'];
				$totalNM1 += $registroF70_1['NM1'];
				$totalSH1 += $registroF70_1['SH1'];
				$totalSM1 += $registroF70_1['SM1'];
				
				$totalNH2 += $registroF70_1['NH2'];
				$totalNM2 += $registroF70_1['NM2'];
				$totalSH2 += $registroF70_1['SH2'];
				$totalSM2 += $registroF70_1['SM2'];
				
				$totalNH3 += $registroF70_1['NH3'];
				$totalNM3 += $registroF70_1['NM3'];
				$totalSH3 += $registroF70_1['SH3'];
				$totalSM3 += $registroF70_1['SM3'];

				$totalNH4 += $registroF70_1['NH4'];
				$totalNM4 += $registroF70_1['NM4'];
				$totalSH4 += $registroF70_1['SH4'];
				$totalSM4 += $registroF70_1['SM4'];

				$totalNH5 += $registroF70_1['NH5'];
				$totalNM5 += $registroF70_1['NM5'];
				$totalSH5 += $registroF70_1['SH5'];
				$totalSM5 += $registroF70_1['SM5'];

				$totalNH6 += $registroF70_1['NH6'];
				$totalNM6 += $registroF70_1['NM6'];
				$totalSH6 += $registroF70_1['SH6'];
				$totalSM6 += $registroF70_1['SM6'];

				$totalNH7 += $registroF70_1['NH7'];
				$totalNM7 += $registroF70_1['NM7'];
				$totalSH7 += $registroF70_1['SH7'];
				$totalSM7 += $registroF70_1['SM7'];

				$totalNH8 += $registroF70_1['NH8'];
				$totalNM8 += $registroF70_1['NM8'];
				$totalSH8 += $registroF70_1['SH8'];
				$totalSM8 += $registroF70_1['SM8'];

				$totalNH9 += $registroF70_1['NH9'];
				$totalNM9 += $registroF70_1['NM9'];
				$totalSH9 += $registroF70_1['SH9'];
				$totalSM9 += $registroF70_1['SM9'];
				
				$total1 += $registroF70_1['Total1'];
				$total2 += $registroF70_1['Total2'];
				$total3 += $registroF70_1['Total3'];
				$total4 += $registroF70_1['Total4'];				
				
				$total += $registroF70_1['Total'];
	   }
	}

	if($resultF80->num_rows>0){
		while($registroF80_1 = $resultF80->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
		   $porcentaje = ($registroF80_1['Total'] / $consulta1['Total'])*100;		 
		 }else{
			 $porcentaje = 0; 
		  }		  
	   	   echo '<tr>
		        <td>'.$registroF80_1['Codigo'].'</td>
				<td>'.$registroF80_1['Enfermedad'].'</td>	
				<td>'.$registroF80_1['NH1'].'</td>	
                <td>'.$registroF80_1['NM1'].'</td>					
				<td>'.$registroF80_1['SH1'].'</td>					
				<td>'.$registroF80_1['SM1'].'</td>

				<td>'.$registroF80_1['NH2'].'</td>	
                <td>'.$registroF80_1['NM2'].'</td>					
				<td>'.$registroF80_1['SH2'].'</td>					
				<td>'.$registroF80_1['SM2'].'</td>

				<td>'.$registroF80_1['NH3'].'</td>	
                <td>'.$registroF80_1['NM3'].'</td>					
				<td>'.$registroF80_1['SH3'].'</td>					
				<td>'.$registroF80_1['SM3'].'</td>

				<td>'.$registroF80_1['NH4'].'</td>	
                <td>'.$registroF80_1['NM4'].'</td>					
				<td>'.$registroF80_1['SH4'].'</td>					
				<td>'.$registroF80_1['SM4'].'</td>

				<td>'.$registroF80_1['NH5'].'</td>	
                <td>'.$registroF80_1['NM5'].'</td>					
				<td>'.$registroF80_1['SH5'].'</td>					
				<td>'.$registroF80_1['SM5'].'</td>

				<td>'.$registroF80_1['NH6'].'</td>	
                <td>'.$registroF80_1['NM6'].'</td>					
				<td>'.$registroF80_1['SH6'].'</td>					
				<td>'.$registroF80_1['SM6'].'</td>

				<td>'.$registroF80_1['NH7'].'</td>	
                <td>'.$registroF80_1['NM7'].'</td>					
				<td>'.$registroF80_1['SH7'].'</td>					
				<td>'.$registroF80_1['SM7'].'</td>

				<td>'.$registroF80_1['NH8'].'</td>	
                <td>'.$registroF80_1['NM8'].'</td>					
				<td>'.$registroF80_1['SH8'].'</td>					
				<td>'.$registroF80_1['SM8'].'</td>

				<td>'.$registroF80_1['NH9'].'</td>	
                <td>'.$registroF80_1['NM9'].'</td>					
				<td>'.$registroF80_1['SH9'].'</td>					
				<td>'.$registroF80_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF80_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF80_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF80_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF80_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF80_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF80_1['NH1'];
				$totalNM1 += $registroF80_1['NM1'];
				$totalSH1 += $registroF80_1['SH1'];
				$totalSM1 += $registroF80_1['SM1'];
				
				$totalNH2 += $registroF80_1['NH2'];
				$totalNM2 += $registroF80_1['NM2'];
				$totalSH2 += $registroF80_1['SH2'];
				$totalSM2 += $registroF80_1['SM2'];

				$totalNH3 += $registroF80_1['NH3'];
				$totalNM3 += $registroF80_1['NM3'];
				$totalSH3 += $registroF80_1['SH3'];
				$totalSM3 += $registroF80_1['SM3'];

				$totalNH4 += $registroF80_1['NH4'];
				$totalNM4 += $registroF80_1['NM4'];
				$totalSH4 += $registroF80_1['SH4'];
				$totalSM4 += $registroF80_1['SM4'];

				$totalNH5 += $registroF80_1['NH5'];
				$totalNM5 += $registroF80_1['NM5'];
				$totalSH5 += $registroF80_1['SH5'];
				$totalSM5 += $registroF80_1['SM5'];

				$totalNH6 += $registroF80_1['NH6'];
				$totalNM6 += $registroF80_1['NM6'];
				$totalSH6 += $registroF80_1['SH6'];
				$totalSM6 += $registroF80_1['SM6'];

				$totalNH7 += $registroF80_1['NH7'];
				$totalNM7 += $registroF80_1['NM7'];
				$totalSH7 += $registroF80_1['SH7'];
				$totalSM7 += $registroF80_1['SM7'];

				$totalNH8 += $registroF80_1['NH8'];
				$totalNM8 += $registroF80_1['NM8'];
				$totalSH8 += $registroF80_1['SH8'];
				$totalSM8 += $registroF80_1['SM8'];

				$totalNH9 += $registroF80_1['NH9'];
				$totalNM9 += $registroF80_1['NM9'];
				$totalSH9 += $registroF80_1['SH9'];
				$totalSM9 += $registroF80_1['SM9'];	

				$total1 += $registroF80_1['Total1'];
				$total2 += $registroF80_1['Total2'];
				$total3 += $registroF80_1['Total3'];
				$total4 += $registroF80_1['Total4'];					
				
				$total += $registroF80_1['Total'];
	   }
	}
	

	if($resultF90->num_rows>0){
		while($registroF90_1 = $resultF90->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroF90_1['Total'] / $consulta1['Total'])*100;	 
		 }else{
			 $porcentaje = 0; 
		  }			
			
	   	   echo '<tr>
		        <td>'.$registroF90_1['Codigo'].'</td>
				<td>'.$registroF90_1['Enfermedad'].'</td>	
				<td>'.$registroF90_1['NH1'].'</td>	
                <td>'.$registroF90_1['NM1'].'</td>					
				<td>'.$registroF90_1['SH1'].'</td>					
				<td>'.$registroF90_1['SM1'].'</td>	

				<td>'.$registroF90_1['NH2'].'</td>	
                <td>'.$registroF90_1['NM2'].'</td>					
				<td>'.$registroF90_1['SH2'].'</td>					
				<td>'.$registroF90_1['SM2'].'</td>	

				<td>'.$registroF90_1['NH3'].'</td>	
                <td>'.$registroF90_1['NM3'].'</td>					
				<td>'.$registroF90_1['SH3'].'</td>					
				<td>'.$registroF90_1['SM3'].'</td>	

				<td>'.$registroF90_1['NH4'].'</td>	
                <td>'.$registroF90_1['NM4'].'</td>					
				<td>'.$registroF90_1['SH4'].'</td>					
				<td>'.$registroF90_1['SM4'].'</td>	

				<td>'.$registroF90_1['NH5'].'</td>	
                <td>'.$registroF90_1['NM5'].'</td>					
				<td>'.$registroF90_1['SH5'].'</td>					
				<td>'.$registroF90_1['SM5'].'</td>	

				<td>'.$registroF90_1['NH6'].'</td>	
                <td>'.$registroF90_1['NM6'].'</td>					
				<td>'.$registroF90_1['SH6'].'</td>					
				<td>'.$registroF90_1['SM6'].'</td>	

				<td>'.$registroF90_1['NH7'].'</td>	
                <td>'.$registroF90_1['NM7'].'</td>					
				<td>'.$registroF90_1['SH7'].'</td>					
				<td>'.$registroF90_1['SM7'].'</td>	

				<td>'.$registroF90_1['NH8'].'</td>	
                <td>'.$registroF90_1['NM8'].'</td>					
				<td>'.$registroF90_1['SH8'].'</td>					
				<td>'.$registroF90_1['SM8'].'</td>	

				<td>'.$registroF90_1['NH9'].'</td>	
                <td>'.$registroF90_1['NM9'].'</td>					
				<td>'.$registroF90_1['SH9'].'</td>					
				<td>'.$registroF90_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF90_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF90_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF90_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF90_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF90_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF90_1['NH1'];
				$totalNM1 += $registroF90_1['NM1'];
				$totalSH1 += $registroF90_1['SH1'];
				$totalSM1 += $registroF90_1['SM1'];
				
				$totalNH2 += $registroF90_1['NH2'];
				$totalNM2 += $registroF90_1['NM2'];
				$totalSH2 += $registroF90_1['SH2'];
				$totalSM2 += $registroF90_1['SM2'];

				$totalNH3 += $registroF90_1['NH3'];
				$totalNM3 += $registroF90_1['NM3'];
				$totalSH3 += $registroF90_1['SH3'];
				$totalSM3 += $registroF90_1['SM3'];

				$totalNH4 += $registroF90_1['NH4'];
				$totalNM4 += $registroF90_1['NM4'];
				$totalSH4 += $registroF90_1['SH4'];
				$totalSM4 += $registroF90_1['SM4'];

				$totalNH5 += $registroF90_1['NH5'];
				$totalNM5 += $registroF90_1['NM5'];
				$totalSH5 += $registroF90_1['SH5'];
				$totalSM5 += $registroF90_1['SM5'];

				$totalNH6 += $registroF90_1['NH6'];
				$totalNM6 += $registroF90_1['NM6'];
				$totalSH6 += $registroF90_1['SH6'];
				$totalSM6 += $registroF90_1['SM6'];

				$totalNH7 += $registroF90_1['NH7'];
				$totalNM7 += $registroF90_1['NM7'];
				$totalSH7 += $registroF90_1['SH7'];
				$totalSM7 += $registroF90_1['SM7'];

				$totalNH8 += $registroF90_1['NH8'];
				$totalNM8 += $registroF90_1['NM8'];
				$totalSH8 += $registroF90_1['SH8'];
				$totalSM8 += $registroF90_1['SM8'];

				$totalNH9 += $registroF90_1['NH9'];
				$totalNM9 += $registroF90_1['NM9'];
				$totalSH9 += $registroF90_1['SH9'];
				$totalSM9 += $registroF90_1['SM9'];
				
				$total1 += $registroF90_1['Total1'];
				$total2 += $registroF90_1['Total2'];
				$total3 += $registroF90_1['Total3'];
				$total4 += $registroF90_1['Total4'];				
				
				$total += $registroF90_1['Total'];
	   }
	}

	if($resultF99->num_rows>0){
		while($registroF99_1 = $resultF99->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroF99_1['Total'] / $consulta1['Total'])*100;		 
		 }else{
			 $porcentaje = 0; 
		 }			
			
	   	   echo '<tr>
		        <td>'.$registroF99_1['Codigo'].'</td>
				<td>'.$registroF99_1['Enfermedad'].'</td>	
				<td>'.$registroF99_1['NH1'].'</td>	
                <td>'.$registroF99_1['NM1'].'</td>					
				<td>'.$registroF99_1['SH1'].'</td>					
				<td>'.$registroF99_1['SM1'].'</td>	

				<td>'.$registroF99_1['NH2'].'</td>	
                <td>'.$registroF99_1['NM2'].'</td>					
				<td>'.$registroF99_1['SH2'].'</td>					
				<td>'.$registroF99_1['SM2'].'</td>	

				<td>'.$registroF99_1['NH3'].'</td>	
                <td>'.$registroF99_1['NM3'].'</td>					
				<td>'.$registroF99_1['SH3'].'</td>					
				<td>'.$registroF99_1['SM3'].'</td>	

				<td>'.$registroF99_1['NH4'].'</td>	
                <td>'.$registroF99_1['NM4'].'</td>					
				<td>'.$registroF99_1['SH4'].'</td>					
				<td>'.$registroF99_1['SM4'].'</td>	

				<td>'.$registroF99_1['NH5'].'</td>	
                <td>'.$registroF99_1['NM5'].'</td>					
				<td>'.$registroF99_1['SH5'].'</td>					
				<td>'.$registroF99_1['SM5'].'</td>	

				<td>'.$registroF99_1['NH6'].'</td>	
                <td>'.$registroF99_1['NM6'].'</td>					
				<td>'.$registroF99_1['SH6'].'</td>					
				<td>'.$registroF99_1['SM6'].'</td>	

				<td>'.$registroF99_1['NH7'].'</td>	
                <td>'.$registroF99_1['NM7'].'</td>					
				<td>'.$registroF99_1['SH7'].'</td>					
				<td>'.$registroF99_1['SM7'].'</td>	

				<td>'.$registroF99_1['NH8'].'</td>	
                <td>'.$registroF99_1['NM8'].'</td>					
				<td>'.$registroF99_1['SH8'].'</td>					
				<td>'.$registroF99_1['SM8'].'</td>	

				<td>'.$registroF99_1['NH9'].'</td>	
                <td>'.$registroF99_1['NM9'].'</td>					
				<td>'.$registroF99_1['SH9'].'</td>					
				<td>'.$registroF99_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF99_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroF99_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF99_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroF99_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroF99_1['Total']).'</p></b></td>	
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroF99_1['NH1'];
				$totalNM1 += $registroF99_1['NM1'];
				$totalSH1 += $registroF99_1['SH1'];
				$totalSM1 += $registroF99_1['SM1'];
				
				$totalNH2 += $registroF99_1['NH2'];
				$totalNM2 += $registroF99_1['NM2'];
				$totalSH2 += $registroF99_1['SH2'];
				$totalSM2 += $registroF99_1['SM2'];

				$totalNH3 += $registroF99_1['NH3'];
				$totalNM3 += $registroF99_1['NM3'];
				$totalSH3 += $registroF99_1['SH3'];
				$totalSM3 += $registroF99_1['SM3'];

				$totalNH4 += $registroF99_1['NH4'];
				$totalNM4 += $registroF99_1['NM4'];
				$totalSH4 += $registroF99_1['SH4'];
				$totalSM4 += $registroF99_1['SM4'];

				$totalNH5 += $registroF99_1['NH5'];
				$totalNM5 += $registroF99_1['NM5'];
				$totalSH5 += $registroF99_1['SH5'];
				$totalSM5 += $registroF99_1['SM5'];

				$totalNH6 += $registroF99_1['NH6'];
				$totalNM6 += $registroF99_1['NM6'];
				$totalSH6 += $registroF99_1['SH6'];
				$totalSM6 += $registroF99_1['SM6'];

				$totalNH7 += $registroF99_1['NH7'];
				$totalNM7 += $registroF99_1['NM7'];
				$totalSH7 += $registroF99_1['SH7'];
				$totalSM7 += $registroF99_1['SM7'];

				$totalNH8 += $registroF99_1['NH8'];
				$totalNM8 += $registroF99_1['NM8'];
				$totalSH8 += $registroF99_1['SH8'];
				$totalSM8 += $registroF99_1['SM8'];

				$totalNH9 += $registroF99_1['NH9'];
				$totalNM9 += $registroF99_1['NM9'];
				$totalSH9 += $registroF99_1['SH9'];
				$totalSM9 += $registroF99_1['SM9'];
				
				$total1 += $registroF99_1['Total1'];
				$total2 += $registroF99_1['Total2'];
				$total3 += $registroF99_1['Total3'];
				$total4 += $registroF99_1['Total4'];				
				
				$total += $registroF99_1['Total'];
	   }
	}
	
	if($resultG40->num_rows>0){
		while($registroG40_1 = $resultG40->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroG40_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroG40_1['Codigo'].'</td>
				<td>'.$registroG40_1['Enfermedad'].'</td>	
				<td>'.$registroG40_1['NH1'].'</td>	
                <td>'.$registroG40_1['NM1'].'</td>					
				<td>'.$registroG40_1['SH1'].'</td>					
				<td>'.$registroG40_1['SM1'].'</td>	

				<td>'.$registroG40_1['NH2'].'</td>	
                <td>'.$registroG40_1['NM2'].'</td>					
				<td>'.$registroG40_1['SH2'].'</td>					
				<td>'.$registroG40_1['SM2'].'</td>	

				<td>'.$registroG40_1['NH3'].'</td>	
                <td>'.$registroG40_1['NM3'].'</td>					
				<td>'.$registroG40_1['SH3'].'</td>					
				<td>'.$registroG40_1['SM3'].'</td>	

				<td>'.$registroG40_1['NH4'].'</td>	
                <td>'.$registroG40_1['NM4'].'</td>					
				<td>'.$registroG40_1['SH4'].'</td>					
				<td>'.$registroG40_1['SM4'].'</td>	

				<td>'.$registroG40_1['NH5'].'</td>	
                <td>'.$registroG40_1['NM5'].'</td>					
				<td>'.$registroG40_1['SH5'].'</td>					
				<td>'.$registroG40_1['SM5'].'</td>	

				<td>'.$registroG40_1['NH6'].'</td>	
                <td>'.$registroG40_1['NM6'].'</td>					
				<td>'.$registroG40_1['SH6'].'</td>					
				<td>'.$registroG40_1['SM6'].'</td>	

				<td>'.$registroG40_1['NH7'].'</td>	
                <td>'.$registroG40_1['NM7'].'</td>					
				<td>'.$registroG40_1['SH7'].'</td>					
				<td>'.$registroG40_1['SM7'].'</td>	

				<td>'.$registroG40_1['NH8'].'</td>	
                <td>'.$registroG40_1['NM8'].'</td>					
				<td>'.$registroG40_1['SH8'].'</td>					
				<td>'.$registroG40_1['SM8'].'</td>	

				<td>'.$registroG40_1['NH9'].'</td>	
                <td>'.$registroG40_1['NM9'].'</td>					
				<td>'.$registroG40_1['SH9'].'</td>					
				<td>'.$registroG40_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroG40_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroG40_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroG40_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroG40_1['Total4']).'</p></b></td>
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registroG40_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroG40_1['NH1'];
				$totalNM1 += $registroG40_1['NM1'];
				$totalSH1 += $registroG40_1['SH1'];
				$totalSM1 += $registroG40_1['SM1'];
				
				$totalNH2 += $registroG40_1['NH2'];
				$totalNM2 += $registroG40_1['NM2'];
				$totalSH2 += $registroG40_1['SH2'];
				$totalSM2 += $registroG40_1['SM2'];

				$totalNH3 += $registroG40_1['NH3'];
				$totalNM3 += $registroG40_1['NM3'];
				$totalSH3 += $registroG40_1['SH3'];
				$totalSM3 += $registroG40_1['SM3'];

				$totalNH4 += $registroG40_1['NH4'];
				$totalNM4 += $registroG40_1['NM4'];
				$totalSH4 += $registroG40_1['SH4'];
				$totalSM4 += $registroG40_1['SM4'];

				$totalNH5 += $registroG40_1['NH5'];
				$totalNM5 += $registroG40_1['NM5'];
				$totalSH5 += $registroG40_1['SH5'];
				$totalSM5 += $registroG40_1['SM5'];

				$totalNH6 += $registroG40_1['NH6'];
				$totalNM6 += $registroG40_1['NM6'];
				$totalSH6 += $registroG40_1['SH6'];
				$totalSM6 += $registroG40_1['SM6'];

				$totalNH7 += $registroG40_1['NH7'];
				$totalNM7 += $registroG40_1['NM7'];
				$totalSH7 += $registroG40_1['SH7'];
				$totalSM7 += $registroG40_1['SM7'];

				$totalNH8 += $registroG40_1['NH8'];
				$totalNM8 += $registroG40_1['NM8'];
				$totalSH8 += $registroG40_1['SH8'];
				$totalSM8 += $registroG40_1['SM8'];

				$totalNH9 += $registroG40_1['NH9'];
				$totalNM9 += $registroG40_1['NM9'];
				$totalSH9 += $registroG40_1['SH9'];
				$totalSM9 += $registroG40_1['SM9'];
				
				$total1 += $registroG40_1['Total1'];
				$total2 += $registroG40_1['Total2'];
				$total3 += $registroG40_1['Total3'];
				$total4 += $registroG40_1['Total4'];				
				
				$total += $registroG40_1['Total'];
	   }
	}

	if($resultG41->num_rows>0){
		while($registroG41_1 = $resultG41->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroG41_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroG41_1['Codigo'].'</td>
				<td>'.$registroG41_1['Enfermedad'].'</td>	
				<td>'.$registroG41_1['NH1'].'</td>	
                <td>'.$registroG41_1['NM1'].'</td>					
				<td>'.$registroG41_1['SH1'].'</td>					
				<td>'.$registroG41_1['SM1'].'</td>	

				<td>'.$registroG41_1['NH2'].'</td>	
                <td>'.$registroG41_1['NM2'].'</td>					
				<td>'.$registroG41_1['SH2'].'</td>					
				<td>'.$registroG41_1['SM2'].'</td>	

				<td>'.$registroG41_1['NH3'].'</td>	
                <td>'.$registroG41_1['NM3'].'</td>					
				<td>'.$registroG41_1['SH3'].'</td>					
				<td>'.$registroG41_1['SM3'].'</td>	

				<td>'.$registroG41_1['NH4'].'</td>	
                <td>'.$registroG41_1['NM4'].'</td>					
				<td>'.$registroG41_1['SH4'].'</td>					
				<td>'.$registroG41_1['SM4'].'</td>	

				<td>'.$registroG41_1['NH5'].'</td>	
                <td>'.$registroG41_1['NM5'].'</td>					
				<td>'.$registroG41_1['SH5'].'</td>					
				<td>'.$registroG41_1['SM5'].'</td>	

				<td>'.$registroG41_1['NH6'].'</td>	
                <td>'.$registroG41_1['NM6'].'</td>					
				<td>'.$registroG41_1['SH6'].'</td>					
				<td>'.$registroG41_1['SM6'].'</td>	
				
				<td>'.$registroG41_1['NH7'].'</td>	
                <td>'.$registroG41_1['NM7'].'</td>					
				<td>'.$registroG41_1['SH7'].'</td>					
				<td>'.$registroG41_1['SM7'].'</td>	

				<td>'.$registroG41_1['NH8'].'</td>	
                <td>'.$registroG41_1['NM8'].'</td>					
				<td>'.$registroG41_1['SH8'].'</td>					
				<td>'.$registroG41_1['SM8'].'</td>	

				<td>'.$registroG41_1['NH9'].'</td>	
                <td>'.$registroG41_1['NM9'].'</td>					
				<td>'.$registroG41_1['SH9'].'</td>					
				<td>'.$registroG41_1['SM9'].'</td>	

				<td><b><p style="color: '.$color_totales.';">'.number_format($registroG41_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroG41_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroG41_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroG41_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroG41_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroG41_1['NH1'];
				$totalNM1 += $registroG41_1['NM1'];
				$totalSH1 += $registroG41_1['SH1'];
				$totalSM1 += $registroG41_1['SM1'];

				$totalNH2 += $registroG41_1['NH2'];
				$totalNM2 += $registroG41_1['NM2'];
				$totalSH2 += $registroG41_1['SH2'];
				$totalSM2 += $registroG41_1['SM2'];

				$totalNH3 += $registroG41_1['NH3'];
				$totalNM3 += $registroG41_1['NM3'];
				$totalSH3 += $registroG41_1['SH3'];
				$totalSM3 += $registroG41_1['SM3'];

				$totalNH4 += $registroG41_1['NH4'];
				$totalNM4 += $registroG41_1['NM4'];
				$totalSH4 += $registroG41_1['SH4'];
				$totalSM4 += $registroG41_1['SM4'];

				$totalNH5 += $registroG41_1['NH5'];
				$totalNM5 += $registroG41_1['NM5'];
				$totalSH5 += $registroG41_1['SH5'];
				$totalSM5 += $registroG41_1['SM5'];

				$totalNH6 += $registroG41_1['NH6'];
				$totalNM6 += $registroG41_1['NM6'];
				$totalSH6 += $registroG41_1['SH6'];
				$totalSM6 += $registroG41_1['SM6'];

				$totalNH7 += $registroG41_1['NH7'];
				$totalNM7 += $registroG41_1['NM7'];
				$totalSH7 += $registroG41_1['SH7'];
				$totalSM7 += $registroG41_1['SM7'];

				$totalNH8 += $registroG41_1['NH8'];
				$totalNM8 += $registroG41_1['NM8'];
				$totalSH8 += $registroG41_1['SH8'];
				$totalSM8 += $registroG41_1['SM8'];

				$totalNH9 += $registroG41_1['NH9'];
				$totalNM9 += $registroG41_1['NM9'];
				$totalSH9 += $registroG41_1['SH9'];
				$totalSM9 += $registroG41_1['SM9'];
				
				$total1 += $registroG41_1['Total1'];
				$total2 += $registroG41_1['Total2'];
				$total3 += $registroG41_1['Total3'];
				$total4 += $registroG41_1['Total4'];				
				
				$total += $registroG41_1['Total'];
	   }
	}

	if($resultX60->num_rows>0){
		while($registroX60_1 = $resultX60->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroX60_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroX60_1['Codigo'].'</td>
				<td>'.$registroX60_1['Enfermedad'].'</td>	
				<td>'.$registroX60_1['NH1'].'</td>	
                <td>'.$registroX60_1['NM1'].'</td>					
				<td>'.$registroX60_1['SH1'].'</td>					
				<td>'.$registroX60_1['SM1'].'</td>

				<td>'.$registroX60_1['NH2'].'</td>	
                <td>'.$registroX60_1['NM2'].'</td>					
				<td>'.$registroX60_1['SH2'].'</td>					
				<td>'.$registroX60_1['SM2'].'</td>

				<td>'.$registroX60_1['NH3'].'</td>	
                <td>'.$registroX60_1['NM3'].'</td>					
				<td>'.$registroX60_1['SH3'].'</td>					
				<td>'.$registroX60_1['SM3'].'</td>

				<td>'.$registroX60_1['NH4'].'</td>	
                <td>'.$registroX60_1['NM4'].'</td>					
				<td>'.$registroX60_1['SH4'].'</td>					
				<td>'.$registroX60_1['SM4'].'</td>

				<td>'.$registroX60_1['NH5'].'</td>	
                <td>'.$registroX60_1['NM5'].'</td>					
				<td>'.$registroX60_1['SH5'].'</td>					
				<td>'.$registroX60_1['SM5'].'</td>

				<td>'.$registroX60_1['NH6'].'</td>	
                <td>'.$registroX60_1['NM6'].'</td>					
				<td>'.$registroX60_1['SH6'].'</td>					
				<td>'.$registroX60_1['SM6'].'</td>

				<td>'.$registroX60_1['NH7'].'</td>	
                <td>'.$registroX60_1['NM7'].'</td>					
				<td>'.$registroX60_1['SH7'].'</td>					
				<td>'.$registroX60_1['SM7'].'</td>

				<td>'.$registroX60_1['NH8'].'</td>	
                <td>'.$registroX60_1['NM8'].'</td>					
				<td>'.$registroX60_1['SH8'].'</td>					
				<td>'.$registroX60_1['SM8'].'</td>

				<td>'.$registroX60_1['NH9'].'</td>	
                <td>'.$registroX60_1['NM9'].'</td>					
				<td>'.$registroX60_1['SH9'].'</td>					
				<td>'.$registroX60_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX60_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroX60_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX60_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX60_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroX60_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroX60_1['NH1'];
				$totalNM1 += $registroX60_1['NM1'];
				$totalSH1 += $registroX60_1['SH1'];
				$totalSM1 += $registroX60_1['SM1'];
				
				$totalNH2 += $registroX60_1['NH2'];
				$totalNM2 += $registroX60_1['NM2'];
				$totalSH2 += $registroX60_1['SH2'];
				$totalSM2 += $registroX60_1['SM2'];

				$totalNH3 += $registroX60_1['NH3'];
				$totalNM3 += $registroX60_1['NM3'];
				$totalSH3 += $registroX60_1['SH3'];
				$totalSM3 += $registroX60_1['SM3'];

				$totalNH4 += $registroX60_1['NH4'];
				$totalNM4 += $registroX60_1['NM4'];
				$totalSH4 += $registroX60_1['SH4'];
				$totalSM4 += $registroX60_1['SM4'];

				$totalNH5 += $registroX60_1['NH5'];
				$totalNM5 += $registroX60_1['NM5'];
				$totalSH5 += $registroX60_1['SH5'];
				$totalSM5 += $registroX60_1['SM5'];

				$totalNH6 += $registroX60_1['NH6'];
				$totalNM6 += $registroX60_1['NM6'];
				$totalSH6 += $registroX60_1['SH6'];
				$totalSM6 += $registroX60_1['SM6'];

				$totalNH7 += $registroX60_1['NH7'];
				$totalNM7 += $registroX60_1['NM7'];
				$totalSH7 += $registroX60_1['SH7'];
				$totalSM7 += $registroX60_1['SM7'];

				$totalNH8 += $registroX60_1['NH8'];
				$totalNM8 += $registroX60_1['NM8'];
				$totalSH8 += $registroX60_1['SH8'];
				$totalSM8 += $registroX60_1['SM8'];
				
				$totalNH9 += $registroX60_1['NH9'];
				$totalNM9 += $registroX60_1['NM9'];
				$totalSH9 += $registroX60_1['SH9'];
				$totalSM9 += $registroX60_1['SM9'];	

				$total1 += $registroX60_1['Total1'];
				$total2 += $registroX60_1['Total2'];
				$total3 += $registroX60_1['Total3'];
				$total4 += $registroX60_1['Total4'];					
				
				$total += $registroX60_1['Total'];
	   }
	}

	if($resultX70->num_rows>0){
		while($registroX70_1 = $resultX70->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroX70_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroX70_1['Codigo'].'</td>
				<td>'.$registroX70_1['Enfermedad'].'</td>	
				<td>'.$registroX70_1['NH1'].'</td>	
                <td>'.$registroX70_1['NM1'].'</td>					
				<td>'.$registroX70_1['SH1'].'</td>					
				<td>'.$registroX70_1['SM1'].'</td>	

				<td>'.$registroX70_1['NH2'].'</td>	
                <td>'.$registroX70_1['NM2'].'</td>					
				<td>'.$registroX70_1['SH2'].'</td>					
				<td>'.$registroX70_1['SM2'].'</td>	

				<td>'.$registroX70_1['NH3'].'</td>	
                <td>'.$registroX70_1['NM3'].'</td>					
				<td>'.$registroX70_1['SH3'].'</td>					
				<td>'.$registroX70_1['SM3'].'</td>	

				<td>'.$registroX70_1['NH4'].'</td>	
                <td>'.$registroX70_1['NM4'].'</td>					
				<td>'.$registroX70_1['SH4'].'</td>					
				<td>'.$registroX70_1['SM4'].'</td>	

				<td>'.$registroX70_1['NH5'].'</td>	
                <td>'.$registroX70_1['NM5'].'</td>					
				<td>'.$registroX70_1['SH5'].'</td>					
				<td>'.$registroX70_1['SM5'].'</td>	

				<td>'.$registroX70_1['NH6'].'</td>	
                <td>'.$registroX70_1['NM6'].'</td>					
				<td>'.$registroX70_1['SH6'].'</td>					
				<td>'.$registroX70_1['SM6'].'</td>	

				<td>'.$registroX70_1['NH7'].'</td>	
                <td>'.$registroX70_1['NM7'].'</td>					
				<td>'.$registroX70_1['SH7'].'</td>					
				<td>'.$registroX70_1['SM7'].'</td>	

				<td>'.$registroX70_1['NH8'].'</td>	
                <td>'.$registroX70_1['NM8'].'</td>					
				<td>'.$registroX70_1['SH8'].'</td>					
				<td>'.$registroX70_1['SM8'].'</td>	

				<td>'.$registroX70_1['NH9'].'</td>	
                <td>'.$registroX70_1['NM9'].'</td>					
				<td>'.$registroX70_1['SH9'].'</td>					
				<td>'.$registroX70_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX70_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroX70_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX70_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX70_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroX70_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroX70_1['NH1'];
				$totalNM1 += $registroX70_1['NM1'];
				$totalSH1 += $registroX70_1['SH1'];
				$totalSM1 += $registroX70_1['SM1'];
				
				$totalNH2 += $registroX70_1['NH2'];
				$totalNM2 += $registroX70_1['NM2'];
				$totalSH2 += $registroX70_1['SH2'];
				$totalSM2 += $registroX70_1['SM2'];

				$totalNH3 += $registroX70_1['NH3'];
				$totalNM3 += $registroX70_1['NM3'];
				$totalSH3 += $registroX70_1['SH3'];
				$totalSM3 += $registroX70_1['SM3'];

				$totalNH4 += $registroX70_1['NH4'];
				$totalNM4 += $registroX70_1['NM4'];
				$totalSH4 += $registroX70_1['SH4'];
				$totalSM4 += $registroX70_1['SM4'];

				$totalNH5 += $registroX70_1['NH5'];
				$totalNM5 += $registroX70_1['NM5'];
				$totalSH5 += $registroX70_1['SH5'];
				$totalSM5 += $registroX70_1['SM5'];

				$totalNH6 += $registroX70_1['NH6'];
				$totalNM6 += $registroX70_1['NM6'];
				$totalSH6 += $registroX70_1['SH6'];
				$totalSM6 += $registroX70_1['SM6'];

				$totalNH7 += $registroX70_1['NH7'];
				$totalNM7 += $registroX70_1['NM7'];
				$totalSH7 += $registroX70_1['SH7'];
				$totalSM7 += $registroX70_1['SM7'];

				$totalNH8 += $registroX70_1['NH8'];
				$totalNM8 += $registroX70_1['NM8'];
				$totalSH8 += $registroX70_1['SH8'];
				$totalSM8 += $registroX70_1['SM8'];

				$totalNH9 += $registroX70_1['NH9'];
				$totalNM9 += $registroX70_1['NM9'];
				$totalSH9 += $registroX70_1['SH9'];
				$totalSM9 += $registroX70_1['SM9'];
				
				$total1 += $registroX70_1['Total1'];
				$total2 += $registroX70_1['Total2'];
				$total3 += $registroX70_1['Total3'];
				$total4 += $registroX70_1['Total4'];				
				
				$total += $registroX70_1['Total'];
	   }
	}	
	
	if($resultX85->num_rows>0){
		while($registroX85_1 = $resultX85->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroX85_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroX85_1['Codigo'].'</td>
				<td>'.$registroX85_1['Enfermedad'].'</td>	
				<td>'.$registroX85_1['NH1'].'</td>	
                <td>'.$registroX85_1['NM1'].'</td>					
				<td>'.$registroX85_1['SH1'].'</td>					
				<td>'.$registroX85_1['SM1'].'</td>	

				<td>'.$registroX85_1['NH2'].'</td>	
                <td>'.$registroX85_1['NM2'].'</td>					
				<td>'.$registroX85_1['SH2'].'</td>					
				<td>'.$registroX85_1['SM2'].'</td>	

				<td>'.$registroX85_1['NH3'].'</td>	
                <td>'.$registroX85_1['NM3'].'</td>					
				<td>'.$registroX85_1['SH3'].'</td>					
				<td>'.$registroX85_1['SM3'].'</td>	

				<td>'.$registroX85_1['NH4'].'</td>	
                <td>'.$registroX85_1['NM4'].'</td>					
				<td>'.$registroX85_1['SH4'].'</td>					
				<td>'.$registroX85_1['SM4'].'</td>	

				<td>'.$registroX85_1['NH5'].'</td>	
                <td>'.$registroX85_1['NM5'].'</td>					
				<td>'.$registroX85_1['SH5'].'</td>					
				<td>'.$registroX85_1['SM5'].'</td>	

				<td>'.$registroX85_1['NH6'].'</td>	
                <td>'.$registroX85_1['NM6'].'</td>					
				<td>'.$registroX85_1['SH6'].'</td>					
				<td>'.$registroX85_1['SM6'].'</td>	

				<td>'.$registroX85_1['NH7'].'</td>	
                <td>'.$registroX85_1['NM7'].'</td>					
				<td>'.$registroX85_1['SH7'].'</td>					
				<td>'.$registroX85_1['SM7'].'</td>	

				<td>'.$registroX85_1['NH8'].'</td>	
                <td>'.$registroX85_1['NM8'].'</td>					
				<td>'.$registroX85_1['SH8'].'</td>					
				<td>'.$registroX85_1['SM8'].'</td>	

				<td>'.$registroX85_1['NH9'].'</td>	
                <td>'.$registroX85_1['NM9'].'</td>					
				<td>'.$registroX85_1['SH9'].'</td>					
				<td>'.$registroX85_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX85_1['Total1']).'</td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroX85_1['Total2']).'</td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX85_1['Total3']).'</td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroX85_1['Total4']).'</td>					
			
				<td><b><p style="color: '.$color_neto.';">'.number_format($registroX85_1['Total']).'</td>
   			    <td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroX85_1['NH1'];
				$totalNM1 += $registroX85_1['NM1'];
				$totalSH1 += $registroX85_1['SH1'];
				$totalSM1 += $registroX85_1['SM1'];
				
				$totalNH2 += $registroX85_1['NH2'];
				$totalNM2 += $registroX85_1['NM2'];
				$totalSH2 += $registroX85_1['SH2'];
				$totalSM2 += $registroX85_1['SM2'];

				$totalNH3 += $registroX85_1['NH3'];
				$totalNM3 += $registroX85_1['NM3'];
				$totalSH3 += $registroX85_1['SH3'];
				$totalSM3 += $registroX85_1['SM3'];

				$totalNH4 += $registroX85_1['NH4'];
				$totalNM4 += $registroX85_1['NM4'];
				$totalSH4 += $registroX85_1['SH4'];
				$totalSM4 += $registroX85_1['SM4'];

				$totalNH5 += $registroX85_1['NH5'];
				$totalNM5 += $registroX85_1['NM5'];
				$totalSH5 += $registroX85_1['SH5'];
				$totalSM5 += $registroX85_1['SM5'];

				$totalNH6 += $registroX85_1['NH6'];
				$totalNM6 += $registroX85_1['NM6'];
				$totalSH6 += $registroX85_1['SH6'];
				$totalSM6 += $registroX85_1['SM6'];
				
				$totalNH7 += $registroX85_1['NH7'];
				$totalNM7 += $registroX85_1['NM7'];
				$totalSH7 += $registroX85_1['SH7'];
				$totalSM7 += $registroX85_1['SM7'];

				$totalNH8 += $registroX85_1['NH8'];
				$totalNM8 += $registroX85_1['NM8'];
				$totalSH8 += $registroX85_1['SH8'];
				$totalSM8 += $registroX85_1['SM8'];

				$totalNH9 += $registroX85_1['NH9'];
				$totalNM9 += $registroX85_1['NM9'];
				$totalSH9 += $registroX85_1['SH9'];
				$totalSM9 += $registroX85_1['SM9'];
				
				$total1 += $registroX85_1['Total1'];
				$total2 += $registroX85_1['Total2'];
				$total3 += $registroX85_1['Total3'];
				$total4 += $registroX85_1['Total4'];				
				
				$total += $registroX85_1['Total'];
	   }
	}		
	
	if($resultY00->num_rows>0){
		while($registroY00_1 = $resultY00->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY00_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY00_1['Codigo'].'</td>
				<td>'.$registroY00_1['Enfermedad'].'</td>	
				<td>'.$registroY00_1['NH1'].'</td>	
                <td>'.$registroY00_1['NM1'].'</td>					
				<td>'.$registroY00_1['SH1'].'</td>					
				<td>'.$registroY00_1['SM1'].'</td>

				<td>'.$registroY00_1['NH2'].'</td>	
                <td>'.$registroY00_1['NM2'].'</td>					
				<td>'.$registroY00_1['SH2'].'</td>					
				<td>'.$registroY00_1['SM2'].'</td>

				<td>'.$registroY00_1['NH3'].'</td>	
                <td>'.$registroY00_1['NM3'].'</td>					
				<td>'.$registroY00_1['SH3'].'</td>					
				<td>'.$registroY00_1['SM3'].'</td>

				<td>'.$registroY00_1['NH4'].'</td>	
                <td>'.$registroY00_1['NM4'].'</td>					
				<td>'.$registroY00_1['SH4'].'</td>					
				<td>'.$registroY00_1['SM4'].'</td>

				<td>'.$registroY00_1['NH5'].'</td>	
                <td>'.$registroY00_1['NM5'].'</td>					
				<td>'.$registroY00_1['SH5'].'</td>					
				<td>'.$registroY00_1['SM5'].'</td>

				<td>'.$registroY00_1['NH6'].'</td>	
                <td>'.$registroY00_1['NM6'].'</td>					
				<td>'.$registroY00_1['SH6'].'</td>					
				<td>'.$registroY00_1['SM6'].'</td>

				<td>'.$registroY00_1['NH7'].'</td>	
                <td>'.$registroY00_1['NM7'].'</td>					
				<td>'.$registroY00_1['SH7'].'</td>					
				<td>'.$registroY00_1['SM7'].'</td>

				<td>'.$registroY00_1['NH8'].'</td>	
                <td>'.$registroY00_1['NM8'].'</td>					
				<td>'.$registroY00_1['SH8'].'</td>					
				<td>'.$registroY00_1['SM8'].'</td>

				<td>'.$registroY00_1['NH9'].'</td>	
                <td>'.$registroY00_1['NM9'].'</td>					
				<td>'.$registroY00_1['SH9'].'</td>					
				<td>'.$registroY00_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY00_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY00_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY00_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY00_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY00_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY00_1['NH1'];
				$totalNM1 += $registroY00_1['NM1'];
				$totalSH1 += $registroY00_1['SH1'];
				$totalSM1 += $registroY00_1['SM1'];
				
				$totalNH2 += $registroY00_1['NH2'];
				$totalNM2 += $registroY00_1['NM2'];
				$totalSH2 += $registroY00_1['SH2'];
				$totalSM2 += $registroY00_1['SM2'];

				$totalNH3 += $registroY00_1['NH3'];
				$totalNM3 += $registroY00_1['NM3'];
				$totalSH3 += $registroY00_1['SH3'];
				$totalSM3 += $registroY00_1['SM3'];

				$totalNH4 += $registroY00_1['NH4'];
				$totalNM4 += $registroY00_1['NM4'];
				$totalSH4 += $registroY00_1['SH4'];
				$totalSM4 += $registroY00_1['SM4'];

				$totalNH5 += $registroY00_1['NH5'];
				$totalNM5 += $registroY00_1['NM5'];
				$totalSH5 += $registroY00_1['SH5'];
				$totalSM5 += $registroY00_1['SM5'];

				$totalNH6 += $registroY00_1['NH6'];
				$totalNM6 += $registroY00_1['NM6'];
				$totalSH6 += $registroY00_1['SH6'];
				$totalSM6 += $registroY00_1['SM6'];

				$totalNH7 += $registroY00_1['NH7'];
				$totalNM7 += $registroY00_1['NM7'];
				$totalSH7 += $registroY00_1['SH7'];
				$totalSM7 += $registroY00_1['SM7'];

				$totalNH8 += $registroY00_1['NH8'];
				$totalNM8 += $registroY00_1['NM8'];
				$totalSH8 += $registroY00_1['SH8'];
				$totalSM8 += $registroY00_1['SM8'];

				$totalNH9 += $registroY00_1['NH9'];
				$totalNM9 += $registroY00_1['NM9'];
				$totalSH9 += $registroY00_1['SH9'];
				$totalSM9 += $registroY00_1['SM9'];	
				
				$total1 += $registroY00_1['Total1'];
				$total2 += $registroY00_1['Total2'];
				$total3 += $registroY00_1['Total3'];
				$total4 += $registroY00_1['Total4'];					
				
				$total += $registroY00_1['Total'];
	   }
	}
	
	if($resultY04->num_rows>0){
		while($registroY04_1 = $resultY04->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY04_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY04_1['Codigo'].'</td>
				<td>'.$registroY04_1['Enfermedad'].'</td>	
				<td>'.$registroY04_1['NH1'].'</td>	
                <td>'.$registroY04_1['NM1'].'</td>					
				<td>'.$registroY04_1['SH1'].'</td>					
				<td>'.$registroY04_1['SM1'].'</td>	

				<td>'.$registroY04_1['NH2'].'</td>	
                <td>'.$registroY04_1['NM2'].'</td>					
				<td>'.$registroY04_1['SH2'].'</td>					
				<td>'.$registroY04_1['SM2'].'</td>	

				<td>'.$registroY04_1['NH3'].'</td>	
                <td>'.$registroY04_1['NM3'].'</td>					
				<td>'.$registroY04_1['SH3'].'</td>					
				<td>'.$registroY04_1['SM3'].'</td>	
				
				<td>'.$registroY04_1['NH4'].'</td>	
                <td>'.$registroY04_1['NM4'].'</td>					
				<td>'.$registroY04_1['SH4'].'</td>					
				<td>'.$registroY04_1['SM4'].'</td>	

				<td>'.$registroY04_1['NH5'].'</td>	
                <td>'.$registroY04_1['NM5'].'</td>					
				<td>'.$registroY04_1['SH5'].'</td>					
				<td>'.$registroY04_1['SM5'].'</td>	

				<td>'.$registroY04_1['NH6'].'</td>	
                <td>'.$registroY04_1['NM6'].'</td>					
				<td>'.$registroY04_1['SH6'].'</td>					
				<td>'.$registroY04_1['SM6'].'</td>	

				<td>'.$registroY04_1['NH7'].'</td>	
                <td>'.$registroY04_1['NM7'].'</td>					
				<td>'.$registroY04_1['SH7'].'</td>					
				<td>'.$registroY04_1['SM7'].'</td>	

				<td>'.$registroY04_1['NH8'].'</td>	
                <td>'.$registroY04_1['NM8'].'</td>					
				<td>'.$registroY04_1['SH8'].'</td>					
				<td>'.$registroY04_1['SM8'].'</td>	

				<td>'.$registroY04_1['NH9'].'</td>	
                <td>'.$registroY04_1['NM9'].'</td>					
				<td>'.$registroY04_1['SH9'].'</td>					
				<td>'.$registroY04_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY04_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY04_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY04_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY04_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY04_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY04_1['NH1'];
				$totalNM1 += $registroY04_1['NM1'];
				$totalSH1 += $registroY04_1['SH1'];
				$totalSM1 += $registroY04_1['SM1'];
				
				$totalNH2 += $registroY04_1['NH2'];
				$totalNM2 += $registroY04_1['NM2'];
				$totalSH2 += $registroY04_1['SH2'];
				$totalSM2 += $registroY04_1['SM2'];

				$totalNH3 += $registroY04_1['NH3'];
				$totalNM3 += $registroY04_1['NM3'];
				$totalSH3 += $registroY04_1['SH3'];
				$totalSM3 += $registroY04_1['SM3'];

				$totalNH4 += $registroY04_1['NH4'];
				$totalNM4 += $registroY04_1['NM4'];
				$totalSH4 += $registroY04_1['SH4'];
				$totalSM4 += $registroY04_1['SM4'];

				$totalNH5 += $registroY04_1['NH5'];
				$totalNM5 += $registroY04_1['NM5'];
				$totalSH5 += $registroY04_1['SH5'];
				$totalSM5 += $registroY04_1['SM5'];

				$totalNH6 += $registroY04_1['NH6'];
				$totalNM6 += $registroY04_1['NM6'];
				$totalSH6 += $registroY04_1['SH6'];
				$totalSM6 += $registroY04_1['SM6'];

				$totalNH7 += $registroY04_1['NH7'];
				$totalNM7 += $registroY04_1['NM7'];
				$totalSH7 += $registroY04_1['SH7'];
				$totalSM7 += $registroY04_1['SM7'];

				$totalNH8 += $registroY04_1['NH8'];
				$totalNM8 += $registroY04_1['NM8'];
				$totalSH8 += $registroY04_1['SH8'];
				$totalSM8 += $registroY04_1['SM8'];

				$totalNH9 += $registroY04_1['NH9'];
				$totalNM9 += $registroY04_1['NM9'];
				$totalSH9 += $registroY04_1['SH9'];
				$totalSM9 += $registroY04_1['SM9'];
				
				$total1 += $registroY04_1['Total1'];
				$total2 += $registroY04_1['Total2'];
				$total3 += $registroY04_1['Total3'];
				$total4 += $registroY04_1['Total4'];				
				
				$total += $registroY04_1['Total'];
	   }
	}	
	
	if($resultY05->num_rows>0){
		while($registroY05_1 = $resultY05->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY05_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY05_1['Codigo'].'</td>
				<td>'.$registroY05_1['Enfermedad'].'</td>	
				<td>'.$registroY05_1['NH1'].'</td>	
                <td>'.$registroY05_1['NM1'].'</td>					
				<td>'.$registroY05_1['SH1'].'</td>					
				<td>'.$registroY05_1['SM1'].'</td>	

				<td>'.$registroY05_1['NH2'].'</td>	
                <td>'.$registroY05_1['NM2'].'</td>					
				<td>'.$registroY05_1['SH2'].'</td>					
				<td>'.$registroY05_1['SM2'].'</td>	

				<td>'.$registroY05_1['NH3'].'</td>	
                <td>'.$registroY05_1['NM3'].'</td>					
				<td>'.$registroY05_1['SH3'].'</td>					
				<td>'.$registroY05_1['SM3'].'</td>	

				<td>'.$registroY05_1['NH4'].'</td>	
                <td>'.$registroY05_1['NM4'].'</td>					
				<td>'.$registroY05_1['SH4'].'</td>					
				<td>'.$registroY05_1['SM4'].'</td>	

				<td>'.$registroY05_1['NH5'].'</td>	
                <td>'.$registroY05_1['NM5'].'</td>					
				<td>'.$registroY05_1['SH5'].'</td>					
				<td>'.$registroY05_1['SM5'].'</td>	

				<td>'.$registroY05_1['NH6'].'</td>	
                <td>'.$registroY05_1['NM6'].'</td>					
				<td>'.$registroY05_1['SH6'].'</td>					
				<td>'.$registroY05_1['SM6'].'</td>	

				<td>'.$registroY05_1['NH7'].'</td>	
                <td>'.$registroY05_1['NM7'].'</td>					
				<td>'.$registroY05_1['SH7'].'</td>					
				<td>'.$registroY05_1['SM7'].'</td>	

				<td>'.$registroY05_1['NH8'].'</td>	
                <td>'.$registroY05_1['NM8'].'</td>					
				<td>'.$registroY05_1['SH8'].'</td>					
				<td>'.$registroY05_1['SM8'].'</td>	

				<td>'.$registroY05_1['NH9'].'</td>	
                <td>'.$registroY05_1['NM9'].'</td>					
				<td>'.$registroY05_1['SH9'].'</td>					
				<td>'.$registroY05_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY05_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY05_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY05_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY05_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY05_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY05_1['NH1'];
				$totalNM1 += $registroY05_1['NM1'];
				$totalSH1 += $registroY05_1['SH1'];
				$totalSM1 += $registroY05_1['SM1'];
				
				$totalNH2 += $registroY05_1['NH2'];
				$totalNM2 += $registroY05_1['NM2'];
				$totalSH2 += $registroY05_1['SH2'];
				$totalSM2 += $registroY05_1['SM2'];

				$totalNH3 += $registroY05_1['NH3'];
				$totalNM3 += $registroY05_1['NM3'];
				$totalSH3 += $registroY05_1['SH3'];
				$totalSM3 += $registroY05_1['SM3'];

				$totalNH4 += $registroY05_1['NH4'];
				$totalNM4 += $registroY05_1['NM4'];
				$totalSH4 += $registroY05_1['SH4'];
				$totalSM4 += $registroY05_1['SM4'];

				$totalNH5 += $registroY05_1['NH5'];
				$totalNM5 += $registroY05_1['NM5'];
				$totalSH5 += $registroY05_1['SH5'];
				$totalSM5 += $registroY05_1['SM5'];

				$totalNH6 += $registroY05_1['NH6'];
				$totalNM6 += $registroY05_1['NM6'];
				$totalSH6 += $registroY05_1['SH6'];
				$totalSM6 += $registroY05_1['SM6'];
				
				$totalNH7 += $registroY05_1['NH7'];
				$totalNM7 += $registroY05_1['NM7'];
				$totalSH7 += $registroY05_1['SH7'];
				$totalSM7 += $registroY05_1['SM7'];

				$totalNH8 += $registroY05_1['NH8'];
				$totalNM8 += $registroY05_1['NM8'];
				$totalSH8 += $registroY05_1['SH8'];
				$totalSM8 += $registroY05_1['SM8'];

				$totalNH9 += $registroY05_1['NH9'];
				$totalNM9 += $registroY05_1['NM9'];
				$totalSH9 += $registroY05_1['SH9'];
				$totalSM9 += $registroY05_1['SM9'];
				
				$total1 += $registroY05_1['Total1'];
				$total2 += $registroY05_1['Total2'];
				$total3 += $registroY05_1['Total3'];
				$total4 += $registroY05_1['Total4'];				
				
				$total += $registroY05_1['Total'];
	   }
	}	

	if($resultY06->num_rows>0){
		while($registroY06_1 = $resultY06->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY06_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY06_1['Codigo'].'</td>
				<td>'.$registroY06_1['Enfermedad'].'</td>	
				<td>'.$registroY06_1['NH1'].'</td>	
                <td>'.$registroY06_1['NM1'].'</td>					
				<td>'.$registroY06_1['SH1'].'</td>					
				<td>'.$registroY06_1['SM1'].'</td>	

				<td>'.$registroY06_1['NH2'].'</td>	
                <td>'.$registroY06_1['NM2'].'</td>					
				<td>'.$registroY06_1['SH2'].'</td>					
				<td>'.$registroY06_1['SM2'].'</td>	

				<td>'.$registroY06_1['NH3'].'</td>	
                <td>'.$registroY06_1['NM3'].'</td>					
				<td>'.$registroY06_1['SH3'].'</td>					
				<td>'.$registroY06_1['SM3'].'</td>	

				<td>'.$registroY06_1['NH4'].'</td>	
                <td>'.$registroY06_1['NM4'].'</td>					
				<td>'.$registroY06_1['SH4'].'</td>					
				<td>'.$registroY06_1['SM4'].'</td>	

				<td>'.$registroY06_1['NH5'].'</td>	
                <td>'.$registroY06_1['NM5'].'</td>					
				<td>'.$registroY06_1['SH5'].'</td>					
				<td>'.$registroY06_1['SM5'].'</td>	

				<td>'.$registroY06_1['NH6'].'</td>	
                <td>'.$registroY06_1['NM6'].'</td>					
				<td>'.$registroY06_1['SH6'].'</td>					
				<td>'.$registroY06_1['SM6'].'</td>	

				<td>'.$registroY06_1['NH7'].'</td>	
                <td>'.$registroY06_1['NM7'].'</td>					
				<td>'.$registroY06_1['SH7'].'</td>					
				<td>'.$registroY06_1['SM7'].'</td>	

				<td>'.$registroY06_1['NH8'].'</td>	
                <td>'.$registroY06_1['NM8'].'</td>					
				<td>'.$registroY06_1['SH8'].'</td>					
				<td>'.$registroY06_1['SM8'].'</td>	

				<td>'.$registroY06_1['NH9'].'</td>	
                <td>'.$registroY06_1['NM9'].'</td>					
				<td>'.$registroY06_1['SH9'].'</td>					
				<td>'.$registroY06_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY06_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY06_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY06_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY06_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY06_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY06_1['NH1'];
				$totalNM1 += $registroY06_1['NM1'];
				$totalSH1 += $registroY06_1['SH1'];
				$totalSM1 += $registroY06_1['SM1'];
				
				$totalNH2 += $registroY06_1['NH2'];
				$totalNM2 += $registroY06_1['NM2'];
				$totalSH2 += $registroY06_1['SH2'];
				$totalSM2 += $registroY06_1['SM2'];

				$totalNH3 += $registroY06_1['NH3'];
				$totalNM3 += $registroY06_1['NM3'];
				$totalSH3 += $registroY06_1['SH3'];
				$totalSM3 += $registroY06_1['SM3'];

				$totalNH4 += $registroY06_1['NH4'];
				$totalNM4 += $registroY06_1['NM4'];
				$totalSH4 += $registroY06_1['SH4'];
				$totalSM4 += $registroY06_1['SM4'];

				$totalNH5 += $registroY06_1['NH5'];
				$totalNM5 += $registroY06_1['NM5'];
				$totalSH5 += $registroY06_1['SH5'];
				$totalSM5 += $registroY06_1['SM5'];

				$totalNH6 += $registroY06_1['NH6'];
				$totalNM6 += $registroY06_1['NM6'];
				$totalSH6 += $registroY06_1['SH6'];
				$totalSM6 += $registroY06_1['SM6'];

				$totalNH7 += $registroY06_1['NH7'];
				$totalNM7 += $registroY06_1['NM7'];
				$totalSH7 += $registroY06_1['SH7'];
				$totalSM7 += $registroY06_1['SM7'];

				$totalNH8 += $registroY06_1['NH8'];
				$totalNM8 += $registroY06_1['NM8'];
				$totalSH8 += $registroY06_1['SH8'];
				$totalSM8 += $registroY06_1['SM8'];

				$totalNH9 += $registroY06_1['NH9'];
				$totalNM9 += $registroY06_1['NM9'];
				$totalSH9 += $registroY06_1['SH9'];
				$totalSM9 += $registroY06_1['SM9'];
				
				$total1 += $registroY06_1['Total1'];
				$total2 += $registroY06_1['Total2'];
				$total3 += $registroY06_1['Total3'];
				$total4 += $registroY06_1['Total4'];				
				
				$total += $registroY06_1['Total'];
	   }
	}	

	if($resultY07->num_rows>0){
		while($registroY07_1 = $resultY07->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY07_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY07_1['Codigo'].'</td>
				<td>'.$registroY07_1['Enfermedad'].'</td>	
				<td>'.$registroY07_1['NH1'].'</td>	
                <td>'.$registroY07_1['NM1'].'</td>					
				<td>'.$registroY07_1['SH1'].'</td>					
				<td>'.$registroY07_1['SM1'].'</td>	

				<td>'.$registroY07_1['NH2'].'</td>	
                <td>'.$registroY07_1['NM2'].'</td>					
				<td>'.$registroY07_1['SH2'].'</td>					
				<td>'.$registroY07_1['SM2'].'</td>	

				<td>'.$registroY07_1['NH3'].'</td>	
                <td>'.$registroY07_1['NM3'].'</td>					
				<td>'.$registroY07_1['SH3'].'</td>					
				<td>'.$registroY07_1['SM3'].'</td>	

				<td>'.$registroY07_1['NH4'].'</td>	
                <td>'.$registroY07_1['NM4'].'</td>					
				<td>'.$registroY07_1['SH4'].'</td>					
				<td>'.$registroY07_1['SM4'].'</td>	

				<td>'.$registroY07_1['NH5'].'</td>	
                <td>'.$registroY07_1['NM5'].'</td>					
				<td>'.$registroY07_1['SH5'].'</td>					
				<td>'.$registroY07_1['SM5'].'</td>	

				<td>'.$registroY07_1['NH6'].'</td>	
                <td>'.$registroY07_1['NM6'].'</td>					
				<td>'.$registroY07_1['SH6'].'</td>					
				<td>'.$registroY07_1['SM6'].'</td>	
				
				<td>'.$registroY07_1['NH7'].'</td>	
                <td>'.$registroY07_1['NM7'].'</td>					
				<td>'.$registroY07_1['SH7'].'</td>					
				<td>'.$registroY07_1['SM7'].'</td>	

				<td>'.$registroY07_1['NH8'].'</td>	
                <td>'.$registroY07_1['NM8'].'</td>					
				<td>'.$registroY07_1['SH8'].'</td>					
				<td>'.$registroY07_1['SM8'].'</td>	

				<td>'.$registroY07_1['NH9'].'</td>	
                <td>'.$registroY07_1['NM9'].'</td>					
				<td>'.$registroY07_1['SH9'].'</td>					
				<td>'.$registroY07_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY07_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY07_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY07_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY07_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY07_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY07_1['NH1'];
				$totalNM1 += $registroY07_1['NM1'];
				$totalSH1 += $registroY07_1['SH1'];
				$totalSM1 += $registroY07_1['SM1'];
				
				$totalNH2 += $registroY07_1['NH2'];
				$totalNM2 += $registroY07_1['NM2'];
				$totalSH2 += $registroY07_1['SH2'];
				$totalSM2 += $registroY07_1['SM2'];

				$totalNH3 += $registroY07_1['NH3'];
				$totalNM3 += $registroY07_1['NM3'];
				$totalSH3 += $registroY07_1['SH3'];
				$totalSM3 += $registroY07_1['SM3'];

				$totalNH4 += $registroY07_1['NH4'];
				$totalNM4 += $registroY07_1['NM4'];
				$totalSH4 += $registroY07_1['SH4'];
				$totalSM4 += $registroY07_1['SM4'];

				$totalNH5 += $registroY07_1['NH5'];
				$totalNM5 += $registroY07_1['NM5'];
				$totalSH5 += $registroY07_1['SH5'];
				$totalSM5 += $registroY07_1['SM5'];

				$totalNH6 += $registroY07_1['NH6'];
				$totalNM6 += $registroY07_1['NM6'];
				$totalSH6 += $registroY07_1['SH6'];
				$totalSM6 += $registroY07_1['SM6'];

				$totalNH7 += $registroY07_1['NH7'];
				$totalNM7 += $registroY07_1['NM7'];
				$totalSH7 += $registroY07_1['SH7'];
				$totalSM7 += $registroY07_1['SM7'];

				$totalNH8 += $registroY07_1['NH8'];
				$totalNM8 += $registroY07_1['NM8'];
				$totalSH8 += $registroY07_1['SH8'];
				$totalSM8 += $registroY07_1['SM8'];

				$total1 += $registroY07_1['Total1'];
				$total2 += $registroY07_1['Total2'];
				$total3 += $registroY07_1['Total3'];
				$total4 += $registroY07_1['Total4'];
				
				$total += $registroY07_1['Total'];
	   }
	}	

	if($resultY08->num_rows>0){
		while($registroY08_1 = $resultY08->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY08_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY08_1['Codigo'].'</td>
				<td>'.$registroY08_1['Enfermedad'].'</td>	
				<td>'.$registroY08_1['NH1'].'</td>	
                <td>'.$registroY08_1['NM1'].'</td>					
				<td>'.$registroY08_1['SH1'].'</td>					
				<td>'.$registroY08_1['SM1'].'</td>

				<td>'.$registroY08_1['NH2'].'</td>	
                <td>'.$registroY08_1['NM2'].'</td>					
				<td>'.$registroY08_1['SH2'].'</td>					
				<td>'.$registroY08_1['SM2'].'</td>

				<td>'.$registroY08_1['NH3'].'</td>	
                <td>'.$registroY08_1['NM3'].'</td>					
				<td>'.$registroY08_1['SH3'].'</td>					
				<td>'.$registroY08_1['SM3'].'</td>

				<td>'.$registroY08_1['NH4'].'</td>	
                <td>'.$registroY08_1['NM4'].'</td>					
				<td>'.$registroY08_1['SH4'].'</td>					
				<td>'.$registroY08_1['SM4'].'</td>
				
				<td>'.$registroY08_1['NH5'].'</td>	
                <td>'.$registroY08_1['NM5'].'</td>					
				<td>'.$registroY08_1['SH5'].'</td>					
				<td>'.$registroY08_1['SM5'].'</td>
				
				<td>'.$registroY08_1['NH6'].'</td>	
                <td>'.$registroY08_1['NM6'].'</td>					
				<td>'.$registroY08_1['SH6'].'</td>					
				<td>'.$registroY08_1['SM6'].'</td>

				<td>'.$registroY08_1['NH7'].'</td>	
                <td>'.$registroY08_1['NM7'].'</td>					
				<td>'.$registroY08_1['SH7'].'</td>					
				<td>'.$registroY08_1['SM7'].'</td>

				<td>'.$registroY08_1['NH8'].'</td>	
                <td>'.$registroY08_1['NM8'].'</td>					
				<td>'.$registroY08_1['SH8'].'</td>					
				<td>'.$registroY08_1['SM8'].'</td>

				<td>'.$registroY08_1['NH9'].'</td>	
                <td>'.$registroY08_1['NM9'].'</td>					
				<td>'.$registroY08_1['SH9'].'</td>					
				<td>'.$registroY08_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY08_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY08_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY08_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY08_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY08_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY08_1['NH1'];
				$totalNM1 += $registroY08_1['NM1'];
				$totalSH1 += $registroY08_1['SH1'];
				$totalSM1 += $registroY08_1['SM1'];
				
				$totalNH2 += $registroY08_1['NH2'];
				$totalNM2 += $registroY08_1['NM2'];
				$totalSH2 += $registroY08_1['SH2'];
				$totalSM2 += $registroY08_1['SM2'];

				$totalNH3 += $registroY08_1['NH3'];
				$totalNM3 += $registroY08_1['NM3'];
				$totalSH3 += $registroY08_1['SH3'];
				$totalSM3 += $registroY08_1['SM3'];

				$totalNH4 += $registroY08_1['NH4'];
				$totalNM4 += $registroY08_1['NM4'];
				$totalSH4 += $registroY08_1['SH4'];
				$totalSM4 += $registroY08_1['SM4'];

				$totalNH5 += $registroY08_1['NH5'];
				$totalNM5 += $registroY08_1['NM5'];
				$totalSH5 += $registroY08_1['SH5'];
				$totalSM5 += $registroY08_1['SM5'];

				$totalNH6 += $registroY08_1['NH6'];
				$totalNM6 += $registroY08_1['NM6'];
				$totalSH6 += $registroY08_1['SH6'];
				$totalSM6 += $registroY08_1['SM6'];

				$totalNH7 += $registroY08_1['NH7'];
				$totalNM7 += $registroY08_1['NM7'];
				$totalSH7 += $registroY08_1['SH7'];
				$totalSM7 += $registroY08_1['SM7'];

				$totalNH8 += $registroY08_1['NH8'];
				$totalNM8 += $registroY08_1['NM8'];
				$totalSH8 += $registroY08_1['SH8'];
				$totalSM8 += $registroY08_1['SM8'];

				$totalNH9 += $registroY08_1['NH9'];
				$totalNM9 += $registroY08_1['NM9'];
				$totalSH9 += $registroY08_1['SH9'];
				$totalSM9 += $registroY08_1['SM9'];
				
				$total1 += $registroY08_1['Total1'];
				$total2 += $registroY08_1['Total2'];
				$total3 += $registroY08_1['Total3'];
				$total4 += $registroY08_1['Total4'];				
				
				$total += $registroY08_1['Total'];
	   }
	}	

	if($resultY09->num_rows>0){
		while($registroY09_1 = $resultY09->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroY09_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroY09_1['Codigo'].'</td>
				<td>'.$registroY09_1['Enfermedad'].'</td>	
				<td>'.$registroY09_1['NH1'].'</td>	
                <td>'.$registroY09_1['NM1'].'</td>					
				<td>'.$registroY09_1['SH1'].'</td>					
				<td>'.$registroY09_1['SM1'].'</td>	

				<td>'.$registroY09_1['NH2'].'</td>	
                <td>'.$registroY09_1['NM2'].'</td>					
				<td>'.$registroY09_1['SH2'].'</td>					
				<td>'.$registroY09_1['SM2'].'</td>	
				
				<td>'.$registroY09_1['NH3'].'</td>	
                <td>'.$registroY09_1['NM3'].'</td>					
				<td>'.$registroY09_1['SH3'].'</td>					
				<td>'.$registroY09_1['SM3'].'</td>	
				
				<td>'.$registroY09_1['NH4'].'</td>	
                <td>'.$registroY09_1['NM4'].'</td>					
				<td>'.$registroY09_1['SH4'].'</td>					
				<td>'.$registroY09_1['SM4'].'</td>	

				<td>'.$registroY09_1['NH5'].'</td>	
                <td>'.$registroY09_1['NM5'].'</td>					
				<td>'.$registroY09_1['SH5'].'</td>					
				<td>'.$registroY09_1['SM5'].'</td>	

				<td>'.$registroY09_1['NH6'].'</td>	
                <td>'.$registroY09_1['NM6'].'</td>					
				<td>'.$registroY09_1['SH6'].'</td>					
				<td>'.$registroY09_1['SM6'].'</td>	

				<td>'.$registroY09_1['NH7'].'</td>	
                <td>'.$registroY09_1['NM7'].'</td>					
				<td>'.$registroY09_1['SH7'].'</td>					
				<td>'.$registroY09_1['SM7'].'</td>	

				<td>'.$registroY09_1['NH8'].'</td>	
                <td>'.$registroY09_1['NM8'].'</td>					
				<td>'.$registroY09_1['SH8'].'</td>					
				<td>'.$registroY09_1['SM8'].'</td>	
				
				<td>'.$registroY09_1['NH9'].'</td>	
                <td>'.$registroY09_1['NM9'].'</td>					
				<td>'.$registroY09_1['SH9'].'</td>					
				<td>'.$registroY09_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY09_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroY09_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY09_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroY09_1['Total4']).'</p></b></td>
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registroY09_1['Total']).'</p></b></td>								
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroY09_1['NH1'];
				$totalNM1 += $registroY09_1['NM1'];
				$totalSH1 += $registroY09_1['SH1'];
				$totalSM1 += $registroY09_1['SM1'];
				
				$totalNH2 += $registroY09_1['NH2'];
				$totalNM2 += $registroY09_1['NM2'];
				$totalSH2 += $registroY09_1['SH2'];
				$totalSM2 += $registroY09_1['SM2'];

				$totalNH3 += $registroY09_1['NH3'];
				$totalNM3 += $registroY09_1['NM3'];
				$totalSH3 += $registroY09_1['SH3'];
				$totalSM3 += $registroY09_1['SM3'];

				$totalNH4 += $registroY09_1['NH4'];
				$totalNM4 += $registroY09_1['NM4'];
				$totalSH4 += $registroY09_1['SH4'];
				$totalSM4 += $registroY09_1['SM4'];

				$totalNH5 += $registroY09_1['NH5'];
				$totalNM5 += $registroY09_1['NM5'];
				$totalSH5 += $registroY09_1['SH5'];
				$totalSM5 += $registroY09_1['SM5'];

				$totalNH6 += $registroY09_1['NH6'];
				$totalNM6 += $registroY09_1['NM6'];
				$totalSH6 += $registroY09_1['SH6'];
				$totalSM6 += $registroY09_1['SM6'];

				$totalNH7 += $registroY09_1['NH7'];
				$totalNM7 += $registroY09_1['NM7'];
				$totalSH7 += $registroY09_1['SH7'];
				$totalSM7 += $registroY09_1['SM7'];

				$totalNH8 += $registroY09_1['NH8'];
				$totalNM8 += $registroY09_1['NM8'];
				$totalSH8 += $registroY09_1['SH8'];
				$totalSM8 += $registroY09_1['SM8'];

				$totalNH9 += $registroY09_1['NH9'];
				$totalNM9 += $registroY09_1['NM9'];
				$totalSH9 += $registroY09_1['SH9'];
				$totalSM9 += $registroY09_1['SM9'];
				
				$total1 += $registroY09_1['Total1'];
				$total2 += $registroY09_1['Total2'];
				$total3 += $registroY09_1['Total3'];
				$total4 += $registroY09_1['Total4'];				
			
				$total += $registroY09_1['Total'];
	   }
	}		

	if($resultT74A->num_rows>0){
		while($registroT74A_1 = $resultT74A->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroT74A_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroT74A_1['Codigo'].'</td>
				<td>'.$registroT74A_1['Enfermedad'].'</td>	
				<td>'.$registroT74A_1['NH1'].'</td>	
                <td>'.$registroT74A_1['NM1'].'</td>					
				<td>'.$registroT74A_1['SH1'].'</td>					
				<td>'.$registroT74A_1['SM1'].'</td>		

				<td>'.$registroT74A_1['NH2'].'</td>	
                <td>'.$registroT74A_1['NM2'].'</td>					
				<td>'.$registroT74A_1['SH2'].'</td>					
				<td>'.$registroT74A_1['SM2'].'</td>		

				<td>'.$registroT74A_1['NH3'].'</td>	
                <td>'.$registroT74A_1['NM3'].'</td>					
				<td>'.$registroT74A_1['SH3'].'</td>					
				<td>'.$registroT74A_1['SM3'].'</td>		

				<td>'.$registroT74A_1['NH4'].'</td>	
                <td>'.$registroT74A_1['NM4'].'</td>					
				<td>'.$registroT74A_1['SH4'].'</td>					
				<td>'.$registroT74A_1['SM4'].'</td>		

				<td>'.$registroT74A_1['NH5'].'</td>	
                <td>'.$registroT74A_1['NM5'].'</td>					
				<td>'.$registroT74A_1['SH5'].'</td>					
				<td>'.$registroT74A_1['SM5'].'</td>		

				<td>'.$registroT74A_1['NH6'].'</td>	
                <td>'.$registroT74A_1['NM6'].'</td>					
				<td>'.$registroT74A_1['SH6'].'</td>					
				<td>'.$registroT74A_1['SM6'].'</td>		

				<td>'.$registroT74A_1['NH7'].'</td>	
                <td>'.$registroT74A_1['NM7'].'</td>					
				<td>'.$registroT74A_1['SH7'].'</td>					
				<td>'.$registroT74A_1['SM7'].'</td>		

				<td>'.$registroT74A_1['NH8'].'</td>	
                <td>'.$registroT74A_1['NM8'].'</td>					
				<td>'.$registroT74A_1['SH8'].'</td>					
				<td>'.$registroT74A_1['SM8'].'</td>		

				<td>'.$registroT74A_1['NH9'].'</td>	
                <td>'.$registroT74A_1['NM9'].'</td>					
				<td>'.$registroT74A_1['SH9'].'</td>					
				<td>'.$registroT74A_1['SM9'].'</td>		
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74A_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroT74A_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74A_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74A_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroT74A_1['Total']).'</p></b></td>							
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroT74A_1['NH1'];
				$totalNM1 += $registroT74A_1['NM1'];
				$totalSH1 += $registroT74A_1['SH1'];
				$totalSM1 += $registroT74A_1['SM1'];
				
				$totalNH2 += $registroT74A_1['NH2'];
				$totalNM2 += $registroT74A_1['NM2'];
				$totalSH2 += $registroT74A_1['SH2'];
				$totalSM2 += $registroT74A_1['SM2'];

				$totalNH3 += $registroT74A_1['NH3'];
				$totalNM3 += $registroT74A_1['NM3'];
				$totalSH3 += $registroT74A_1['SH3'];
				$totalSM3 += $registroT74A_1['SM3'];

				$totalNH4 += $registroT74A_1['NH4'];
				$totalNM4 += $registroT74A_1['NM4'];
				$totalSH4 += $registroT74A_1['SH4'];
				$totalSM4 += $registroT74A_1['SM4'];

				$totalNH5 += $registroT74A_1['NH5'];
				$totalNM5 += $registroT74A_1['NM5'];
				$totalSH5 += $registroT74A_1['SH5'];
				$totalSM5 += $registroT74A_1['SM5'];

				$totalNH6 += $registroT74A_1['NH6'];
				$totalNM6 += $registroT74A_1['NM6'];
				$totalSH6 += $registroT74A_1['SH6'];
				$totalSM6 += $registroT74A_1['SM6'];

				$totalNH7 += $registroT74A_1['NH7'];
				$totalNM7 += $registroT74A_1['NM7'];
				$totalSH7 += $registroT74A_1['SH7'];
				$totalSM7 += $registroT74A_1['SM7'];

				$totalNH8 += $registroT74A_1['NH8'];
				$totalNM8 += $registroT74A_1['NM8'];
				$totalSH8 += $registroT74A_1['SH8'];
				$totalSM8 += $registroT74A_1['SM8'];

				$total1 += $registroT74A_1['Total1'];
				$total2 += $registroT74A_1['Total2'];
				$total3 += $registroT74A_1['Total3'];
				$total4 += $registroT74A_1['Total4'];
				
				$total += $registroT74A_1['Total'];
	   }
	}	
	
	if($resultT74B->num_rows>0){
		while($registroT74B_1 = $resultT74B->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroT74B_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroT74B_1['Codigo'].'</td>
				<td>'.$registroT74B_1['Enfermedad'].'</td>	
				<td>'.$registroT74B_1['NH1'].'</td>	
                <td>'.$registroT74B_1['NM1'].'</td>					
				<td>'.$registroT74B_1['SH1'].'</td>					
				<td>'.$registroT74B_1['SM1'].'</td>		

				<td>'.$registroT74B_1['NH2'].'</td>	
                <td>'.$registroT74B_1['NM2'].'</td>					
				<td>'.$registroT74B_1['SH2'].'</td>					
				<td>'.$registroT74B_1['SM2'].'</td>		

				<td>'.$registroT74B_1['NH3'].'</td>	
                <td>'.$registroT74B_1['NM3'].'</td>					
				<td>'.$registroT74B_1['SH3'].'</td>					
				<td>'.$registroT74B_1['SM3'].'</td>		

				<td>'.$registroT74B_1['NH4'].'</td>	
                <td>'.$registroT74B_1['NM4'].'</td>					
				<td>'.$registroT74B_1['SH4'].'</td>					
				<td>'.$registroT74B_1['SM4'].'</td>		

				<td>'.$registroT74B_1['NH5'].'</td>	
                <td>'.$registroT74B_1['NM5'].'</td>					
				<td>'.$registroT74B_1['SH5'].'</td>					
				<td>'.$registroT74B_1['SM5'].'</td>		

				<td>'.$registroT74B_1['NH6'].'</td>	
                <td>'.$registroT74B_1['NM6'].'</td>					
				<td>'.$registroT74B_1['SH6'].'</td>					
				<td>'.$registroT74B_1['SM6'].'</td>		

				<td>'.$registroT74B_1['NH7'].'</td>	
                <td>'.$registroT74B_1['NM7'].'</td>					
				<td>'.$registroT74B_1['SH7'].'</td>					
				<td>'.$registroT74B_1['SM7'].'</td>		

				<td>'.$registroT74B_1['NH8'].'</td>	
                <td>'.$registroT74B_1['NM8'].'</td>					
				<td>'.$registroT74B_1['SH8'].'</td>					
				<td>'.$registroT74B_1['SM8'].'</td>		

				<td>'.$registroT74B_1['NH9'].'</td>	
                <td>'.$registroT74B_1['NM9'].'</td>					
				<td>'.$registroT74B_1['SH9'].'</td>					
				<td>'.$registroT74B_1['SM9'].'</td>		
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74B_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroT74B_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74B_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74B_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroT74B_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroT74B_1['NH1'];
				$totalNM1 += $registroT74B_1['NM1'];
				$totalSH1 += $registroT74B_1['SH1'];
				$totalSM1 += $registroT74B_1['SM1'];
				
				$totalNH2 += $registroT74B_1['NH2'];
				$totalNM2 += $registroT74B_1['NM2'];
				$totalSH2 += $registroT74B_1['SH2'];
				$totalSM2 += $registroT74B_1['SM2'];

				$totalNH3 += $registroT74B_1['NH3'];
				$totalNM3 += $registroT74B_1['NM3'];
				$totalSH3 += $registroT74B_1['SH3'];
				$totalSM3 += $registroT74B_1['SM3'];

				$totalNH4 += $registroT74B_1['NH4'];
				$totalNM4 += $registroT74B_1['NM4'];
				$totalSH4 += $registroT74B_1['SH4'];
				$totalSM4 += $registroT74B_1['SM4'];

				$totalNH5 += $registroT74B_1['NH5'];
				$totalNM5 += $registroT74B_1['NM5'];
				$totalSH5 += $registroT74B_1['SH5'];
				$totalSM5 += $registroT74B_1['SM5'];

				$totalNH6 += $registroT74B_1['NH6'];
				$totalNM6 += $registroT74B_1['NM6'];
				$totalSH6 += $registroT74B_1['SH6'];
				$totalSM6 += $registroT74B_1['SM6'];

				$totalNH7 += $registroT74B_1['NH7'];
				$totalNM7 += $registroT74B_1['NM7'];
				$totalSH7 += $registroT74B_1['SH7'];
				$totalSM7 += $registroT74B_1['SM7'];
				
				$totalNH8 += $registroT74B_1['NH8'];
				$totalNM8 += $registroT74B_1['NM8'];
				$totalSH8 += $registroT74B_1['SH8'];
				$totalSM8 += $registroT74B_1['SM8'];

				$totalNH9 += $registroT74B_1['NH9'];
				$totalNM9 += $registroT74B_1['NM9'];
				$totalSH9 += $registroT74B_1['SH9'];
				$totalSM9 += $registroT74B_1['SM9'];
				
				$total1 += $registroT74B_1['Total1'];
				$total2 += $registroT74B_1['Total2'];
				$total3 += $registroT74B_1['Total3'];
				$total4 += $registroT74B_1['Total4'];				
				
				$total += $registroT74B_1['Total'];
	   }
	}	

	if($resultT74C->num_rows>0){
		while($registroT74C_1 = $resultT74C->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroT74C_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroT74C_1['Codigo'].'</td>
				<td>'.$registroT74C_1['Enfermedad'].'</td>	
				<td>'.$registroT74C_1['NH1'].'</td>	
                <td>'.$registroT74C_1['NM1'].'</td>					
				<td>'.$registroT74C_1['SH1'].'</td>					
				<td>'.$registroT74C_1['SM1'].'</td>		

				<td>'.$registroT74C_1['NH2'].'</td>	
                <td>'.$registroT74C_1['NM2'].'</td>					
				<td>'.$registroT74C_1['SH2'].'</td>					
				<td>'.$registroT74C_1['SM2'].'</td>		

				<td>'.$registroT74C_1['NH3'].'</td>	
                <td>'.$registroT74C_1['NM3'].'</td>					
				<td>'.$registroT74C_1['SH3'].'</td>					
				<td>'.$registroT74C_1['SM3'].'</td>		

				<td>'.$registroT74C_1['NH4'].'</td>	
                <td>'.$registroT74C_1['NM4'].'</td>					
				<td>'.$registroT74C_1['SH4'].'</td>					
				<td>'.$registroT74C_1['SM4'].'</td>		

				<td>'.$registroT74C_1['NH5'].'</td>	
                <td>'.$registroT74C_1['NM5'].'</td>					
				<td>'.$registroT74C_1['SH5'].'</td>					
				<td>'.$registroT74C_1['SM5'].'</td>		

				<td>'.$registroT74C_1['NH6'].'</td>	
                <td>'.$registroT74C_1['NM6'].'</td>					
				<td>'.$registroT74C_1['SH6'].'</td>					
				<td>'.$registroT74C_1['SM6'].'</td>		

				<td>'.$registroT74C_1['NH7'].'</td>	
                <td>'.$registroT74C_1['NM7'].'</td>					
				<td>'.$registroT74C_1['SH7'].'</td>					
				<td>'.$registroT74C_1['SM7'].'</td>		

				<td>'.$registroT74C_1['NH8'].'</td>	
                <td>'.$registroT74C_1['NM8'].'</td>					
				<td>'.$registroT74C_1['SH8'].'</td>					
				<td>'.$registroT74C_1['SM8'].'</td>		

				<td>'.$registroT74C_1['NH9'].'</td>	
                <td>'.$registroT74C_1['NM9'].'</td>					
				<td>'.$registroT74C_1['SH9'].'</td>					
				<td>'.$registroT74C_1['SM9'].'</td>		
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74C_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroT74C_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74C_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroT74C_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroT74C_1['Total']).'</p></b></td>								
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroT74C_1['NH1'];
				$totalNM1 += $registroT74C_1['NM1'];
				$totalSH1 += $registroT74C_1['SH1'];
				$totalSM1 += $registroT74C_1['SM1'];
				
				$totalNH2 += $registroT74C_1['NH2'];
				$totalNM2 += $registroT74C_1['NM2'];
				$totalSH2 += $registroT74C_1['SH2'];
				$totalSM2 += $registroT74C_1['SM2'];

				$totalNH3 += $registroT74C_1['NH3'];
				$totalNM3 += $registroT74C_1['NM3'];
				$totalSH3 += $registroT74C_1['SH3'];
				$totalSM3 += $registroT74C_1['SM3'];

				$totalNH4 += $registroT74C_1['NH4'];
				$totalNM4 += $registroT74C_1['NM4'];
				$totalSH4 += $registroT74C_1['SH4'];
				$totalSM4 += $registroT74C_1['SM4'];

				$totalNH5 += $registroT74C_1['NH5'];
				$totalNM5 += $registroT74C_1['NM5'];
				$totalSH5 += $registroT74C_1['SH5'];
				$totalSM5 += $registroT74C_1['SM5'];

				$totalNH6 += $registroT74C_1['NH6'];
				$totalNM6 += $registroT74C_1['NM6'];
				$totalSH6 += $registroT74C_1['SH6'];
				$totalSM6 += $registroT74C_1['SM6'];

				$totalNH7 += $registroT74C_1['NH7'];
				$totalNM7 += $registroT74C_1['NM7'];
				$totalSH7 += $registroT74C_1['SH7'];
				$totalSM7 += $registroT74C_1['SM7'];

				$totalNH8 += $registroT74C_1['NH8'];
				$totalNM8 += $registroT74C_1['NM8'];
				$totalSH8 += $registroT74C_1['SH8'];
				$totalSM8 += $registroT74C_1['SM8'];
				
				$totalNH9 += $registroT74C_1['NH9'];
				$totalNM9 += $registroT74C_1['NM9'];
				$totalSH9 += $registroT74C_1['SH9'];
				$totalSM9 += $registroT74C_1['SM9'];

				$total1 += $registroT74C_1['Total1'];
				$total2 += $registroT74C_1['Total2'];
				$total3 += $registroT74C_1['Total3'];
				$total4 += $registroT74C_1['Total4'];				
				
				$total += $registroT74C_1['Total'];
	   }
	}

	if($resultAA206->num_rows>0){
		while($registroAA206_1 = $resultAA206->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroAA206_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroAA206_1['Codigo'].'</td>
				<td>'.$registroAA206_1['Enfermedad'].'</td>	
				<td>'.$registroAA206_1['NH1'].'</td>	
                <td>'.$registroAA206_1['NM1'].'</td>					
				<td>'.$registroAA206_1['SH1'].'</td>					
				<td>'.$registroAA206_1['SM1'].'</td>	

				<td>'.$registroAA206_1['NH2'].'</td>	
                <td>'.$registroAA206_1['NM2'].'</td>					
				<td>'.$registroAA206_1['SH2'].'</td>					
				<td>'.$registroAA206_1['SM2'].'</td>	

				<td>'.$registroAA206_1['NH3'].'</td>	
                <td>'.$registroAA206_1['NM3'].'</td>					
				<td>'.$registroAA206_1['SH3'].'</td>					
				<td>'.$registroAA206_1['SM3'].'</td>	

				<td>'.$registroAA206_1['NH4'].'</td>	
                <td>'.$registroAA206_1['NM4'].'</td>					
				<td>'.$registroAA206_1['SH4'].'</td>					
				<td>'.$registroAA206_1['SM4'].'</td>	

				<td>'.$registroAA206_1['NH5'].'</td>	
                <td>'.$registroAA206_1['NM5'].'</td>					
				<td>'.$registroAA206_1['SH5'].'</td>					
				<td>'.$registroAA206_1['SM5'].'</td>	

				<td>'.$registroAA206_1['NH6'].'</td>	
                <td>'.$registroAA206_1['NM6'].'</td>					
				<td>'.$registroAA206_1['SH6'].'</td>					
				<td>'.$registroAA206_1['SM6'].'</td>	

				<td>'.$registroAA206_1['NH7'].'</td>	
                <td>'.$registroAA206_1['NM7'].'</td>					
				<td>'.$registroAA206_1['SH7'].'</td>					
				<td>'.$registroAA206_1['SM7'].'</td>	

				<td>'.$registroAA206_1['NH8'].'</td>	
                <td>'.$registroAA206_1['NM8'].'</td>					
				<td>'.$registroAA206_1['SH8'].'</td>					
				<td>'.$registroAA206_1['SM8'].'</td>	

				<td>'.$registroAA206_1['NH9'].'</td>	
                <td>'.$registroAA206_1['NM9'].'</td>					
				<td>'.$registroAA206_1['SH9'].'</td>					
				<td>'.$registroAA206_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA206_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroAA206_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA206_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA206_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroAA206_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroAA206_1['NH1'];
				$totalNM1 += $registroAA206_1['NM1'];
				$totalSH1 += $registroAA206_1['SH1'];
				$totalSM1 += $registroAA206_1['SM1'];
				
				$totalNH2 += $registroAA206_1['NH2'];
				$totalNM2 += $registroAA206_1['NM2'];
				$totalSH2 += $registroAA206_1['SH2'];
				$totalSM2 += $registroAA206_1['SM2'];

				$totalNH3 += $registroAA206_1['NH3'];
				$totalNM3 += $registroAA206_1['NM3'];
				$totalSH3 += $registroAA206_1['SH3'];
				$totalSM3 += $registroAA206_1['SM3'];

				$totalNH4 += $registroAA206_1['NH4'];
				$totalNM4 += $registroAA206_1['NM4'];
				$totalSH4 += $registroAA206_1['SH4'];
				$totalSM4 += $registroAA206_1['SM4'];

				$totalNH5 += $registroAA206_1['NH5'];
				$totalNM5 += $registroAA206_1['NM5'];
				$totalSH5 += $registroAA206_1['SH5'];
				$totalSM5 += $registroAA206_1['SM5'];

				$totalNH6 += $registroAA206_1['NH6'];
				$totalNM6 += $registroAA206_1['NM6'];
				$totalSH6 += $registroAA206_1['SH6'];
				$totalSM6 += $registroAA206_1['SM6'];

				$totalNH7 += $registroAA206_1['NH7'];
				$totalNM7 += $registroAA206_1['NM7'];
				$totalSH7 += $registroAA206_1['SH7'];
				$totalSM7 += $registroAA206_1['SM7'];

				$totalNH8 += $registroAA206_1['NH8'];
				$totalNM8 += $registroAA206_1['NM8'];
				$totalSH8 += $registroAA206_1['SH8'];
				$totalSM8 += $registroAA206_1['SM8'];

				$totalNH9 += $registroAA206_1['NH9'];
				$totalNM9 += $registroAA206_1['NM9'];
				$totalSH9 += $registroAA206_1['SH9'];
				$totalSM9 += $registroAA206_1['SM9'];
				
				$total1 += $registroAA206_1['Total1'];
				$total2 += $registroAA206_1['Total2'];
				$total3 += $registroAA206_1['Total3'];
				$total4 += $registroAA206_1['Total4'];				
				
				$total += $registroAA206_1['Total'];
	   }
	}	
	
	if($resultAA207->num_rows>0){
		while($registroAA207_1 = $resultAA207->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroAA207_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroAA207_1['Codigo'].'</td>
				<td>'.$registroAA207_1['Enfermedad'].'</td>	
				<td>'.$registroAA207_1['NH1'].'</td>	
                <td>'.$registroAA207_1['NM1'].'</td>					
				<td>'.$registroAA207_1['SH1'].'</td>					
				<td>'.$registroAA207_1['SM1'].'</td>

				<td>'.$registroAA207_1['NH2'].'</td>	
                <td>'.$registroAA207_1['NM2'].'</td>					
				<td>'.$registroAA207_1['SH2'].'</td>					
				<td>'.$registroAA207_1['SM2'].'</td>

				<td>'.$registroAA207_1['NH3'].'</td>	
                <td>'.$registroAA207_1['NM3'].'</td>					
				<td>'.$registroAA207_1['SH3'].'</td>					
				<td>'.$registroAA207_1['SM3'].'</td>

				<td>'.$registroAA207_1['NH4'].'</td>	
                <td>'.$registroAA207_1['NM4'].'</td>					
				<td>'.$registroAA207_1['SH4'].'</td>					
				<td>'.$registroAA207_1['SM4'].'</td>

				<td>'.$registroAA207_1['NH5'].'</td>	
                <td>'.$registroAA207_1['NM5'].'</td>					
				<td>'.$registroAA207_1['SH5'].'</td>					
				<td>'.$registroAA207_1['SM5'].'</td>

				<td>'.$registroAA207_1['NH6'].'</td>	
                <td>'.$registroAA207_1['NM6'].'</td>					
				<td>'.$registroAA207_1['SH6'].'</td>					
				<td>'.$registroAA207_1['SM6'].'</td>

				<td>'.$registroAA207_1['NH7'].'</td>	
                <td>'.$registroAA207_1['NM7'].'</td>					
				<td>'.$registroAA207_1['SH7'].'</td>					
				<td>'.$registroAA207_1['SM7'].'</td>

				<td>'.$registroAA207_1['NH8'].'</td>	
                <td>'.$registroAA207_1['NM8'].'</td>					
				<td>'.$registroAA207_1['SH8'].'</td>					
				<td>'.$registroAA207_1['SM8'].'</td>

				<td>'.$registroAA207_1['NH9'].'</td>	
                <td>'.$registroAA207_1['NM9'].'</td>					
				<td>'.$registroAA207_1['SH9'].'</td>					
				<td>'.$registroAA207_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA207_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroAA207_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA207_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA207_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroAA207_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroAA207_1['NH1'];
				$totalNM1 += $registroAA207_1['NM1'];
				$totalSH1 += $registroAA207_1['SH1'];
				$totalSM1 += $registroAA207_1['SM1'];
				
				$totalNH2 += $registroAA207_1['NH2'];
				$totalNM2 += $registroAA207_1['NM2'];
				$totalSH2 += $registroAA207_1['SH2'];
				$totalSM2 += $registroAA207_1['SM2'];

				$totalNH3 += $registroAA207_1['NH3'];
				$totalNM3 += $registroAA207_1['NM3'];
				$totalSH3 += $registroAA207_1['SH3'];
				$totalSM3 += $registroAA207_1['SM3'];

				$totalNH4 += $registroAA207_1['NH4'];
				$totalNM4 += $registroAA207_1['NM4'];
				$totalSH4 += $registroAA207_1['SH4'];
				$totalSM4 += $registroAA207_1['SM4'];

				$totalNH5 += $registroAA207_1['NH5'];
				$totalNM5 += $registroAA207_1['NM5'];
				$totalSH5 += $registroAA207_1['SH5'];
				$totalSM5 += $registroAA207_1['SM5'];

				$totalNH6 += $registroAA207_1['NH6'];
				$totalNM6 += $registroAA207_1['NM6'];
				$totalSH6 += $registroAA207_1['SH6'];
				$totalSM6 += $registroAA207_1['SM6'];

				$totalNH7 += $registroAA207_1['NH7'];
				$totalNM7 += $registroAA207_1['NM7'];
				$totalSH7 += $registroAA207_1['SH7'];
				$totalSM7 += $registroAA207_1['SM7'];

				$totalNH8 += $registroAA207_1['NH8'];
				$totalNM8 += $registroAA207_1['NM8'];
				$totalSH8 += $registroAA207_1['SH8'];
				$totalSM8 += $registroAA207_1['SM8'];

				$totalNH9 += $registroAA207_1['NH9'];
				$totalNM9 += $registroAA207_1['NM9'];
				$totalSH9 += $registroAA207_1['SH9'];
				$totalSM9 += $registroAA207_1['SM9'];
				
				$total1 += $registroAA207_1['Total1'];
				$total2 += $registroAA207_1['Total2'];
				$total3 += $registroAA207_1['Total3'];
				$total4 += $registroAA207_1['Total4'];				
				
				$total += $registroAA207_1['Total'];
	   }
	}

	if($resultAA208->num_rows>0){
		while($registroAA208_1 = $resultAA208->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroAA208_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroAA208_1['Codigo'].'</td>
				<td>'.$registroAA208_1['Enfermedad'].'</td>	
				<td>'.$registroAA208_1['NH1'].'</td>	
                <td>'.$registroAA208_1['NM1'].'</td>					
				<td>'.$registroAA208_1['SH1'].'</td>					
				<td>'.$registroAA208_1['SM1'].'</td>

				<td>'.$registroAA208_1['NH2'].'</td>	
                <td>'.$registroAA208_1['NM2'].'</td>					
				<td>'.$registroAA208_1['SH2'].'</td>					
				<td>'.$registroAA208_1['SM2'].'</td>

				<td>'.$registroAA208_1['NH3'].'</td>	
                <td>'.$registroAA208_1['NM3'].'</td>					
				<td>'.$registroAA208_1['SH3'].'</td>					
				<td>'.$registroAA208_1['SM3'].'</td>

				<td>'.$registroAA208_1['NH4'].'</td>	
                <td>'.$registroAA208_1['NM4'].'</td>					
				<td>'.$registroAA208_1['SH4'].'</td>					
				<td>'.$registroAA208_1['SM4'].'</td>

				<td>'.$registroAA208_1['NH5'].'</td>	
                <td>'.$registroAA208_1['NM5'].'</td>					
				<td>'.$registroAA208_1['SH5'].'</td>					
				<td>'.$registroAA208_1['SM5'].'</td>

				<td>'.$registroAA208_1['NH6'].'</td>	
                <td>'.$registroAA208_1['NM6'].'</td>					
				<td>'.$registroAA208_1['SH6'].'</td>					
				<td>'.$registroAA208_1['SM6'].'</td>

				<td>'.$registroAA208_1['NH7'].'</td>	
                <td>'.$registroAA208_1['NM7'].'</td>					
				<td>'.$registroAA208_1['SH7'].'</td>					
				<td>'.$registroAA208_1['SM7'].'</td>

				<td>'.$registroAA208_1['NH8'].'</td>	
                <td>'.$registroAA208_1['NM8'].'</td>					
				<td>'.$registroAA208_1['SH8'].'</td>					
				<td>'.$registroAA208_1['SM8'].'</td>
				
				<td>'.$registroAA208_1['NH9'].'</td>	
                <td>'.$registroAA208_1['NM9'].'</td>					
				<td>'.$registroAA208_1['SH9'].'</td>					
				<td>'.$registroAA208_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA208_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroAA208_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA208_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA208_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroAA208_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroAA208_1['NH1'];
				$totalNM1 += $registroAA208_1['NM1'];
				$totalSH1 += $registroAA208_1['SH1'];
				$totalSM1 += $registroAA208_1['SM1'];
				
				$totalNH2 += $registroAA208_1['NH2'];
				$totalNM2 += $registroAA208_1['NM2'];
				$totalSH2 += $registroAA208_1['SH2'];
				$totalSM2 += $registroAA208_1['SM2'];

				$totalNH3 += $registroAA208_1['NH3'];
				$totalNM3 += $registroAA208_1['NM3'];
				$totalSH3 += $registroAA208_1['SH3'];
				$totalSM3 += $registroAA208_1['SM3'];

				$totalNH4 += $registroAA208_1['NH4'];
				$totalNM4 += $registroAA208_1['NM4'];
				$totalSH4 += $registroAA208_1['SH4'];
				$totalSM4 += $registroAA208_1['SM4'];

				$totalNH5 += $registroAA208_1['NH5'];
				$totalNM5 += $registroAA208_1['NM5'];
				$totalSH5 += $registroAA208_1['SH5'];
				$totalSM5 += $registroAA208_1['SM5'];

				$totalNH6 += $registroAA208_1['NH6'];
				$totalNM6 += $registroAA208_1['NM6'];
				$totalSH6 += $registroAA208_1['SH6'];
				$totalSM6 += $registroAA208_1['SM6'];
				
				$totalNH7 += $registroAA208_1['NH7'];
				$totalNM7 += $registroAA208_1['NM7'];
				$totalSH7 += $registroAA208_1['SH7'];
				$totalSM7 += $registroAA208_1['SM7'];

				$totalNH8 += $registroAA208_1['NH8'];
				$totalNM8 += $registroAA208_1['NM8'];
				$totalSH8 += $registroAA208_1['SH8'];
				$totalSM8 += $registroAA208_1['SM8'];
				
				$totalNH9 += $registroAA208_1['NH9'];
				$totalNM9 += $registroAA208_1['NM9'];
				$totalSH9 += $registroAA208_1['SH9'];
				$totalSM9 += $registroAA208_1['SM9'];				

				$total1 += $registroAA208_1['Total1'];
				$total2 += $registroAA208_1['Total2'];
				$total3 += $registroAA208_1['Total3'];
				$total4 += $registroAA208_1['Total4'];
				
				$total += $registroAA208_1['Total'];
	   }
	}

	if($resultAA175->num_rows>0){
		while($registroAA175_1 = $resultAA175->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroAA175_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroAA175_1['Codigo'].'</td>
				<td>'.$registroAA175_1['Enfermedad'].'</td>	
				<td>'.$registroAA175_1['NH1'].'</td>	
                <td>'.$registroAA175_1['NM1'].'</td>					
				<td>'.$registroAA175_1['SH1'].'</td>					
				<td>'.$registroAA175_1['SM1'].'</td>	

				<td>'.$registroAA175_1['NH2'].'</td>	
                <td>'.$registroAA175_1['NM2'].'</td>					
				<td>'.$registroAA175_1['SH2'].'</td>					
				<td>'.$registroAA175_1['SM2'].'</td>	

				<td>'.$registroAA175_1['NH3'].'</td>	
                <td>'.$registroAA175_1['NM3'].'</td>					
				<td>'.$registroAA175_1['SH3'].'</td>					
				<td>'.$registroAA175_1['SM3'].'</td>	

				<td>'.$registroAA175_1['NH4'].'</td>	
                <td>'.$registroAA175_1['NM4'].'</td>					
				<td>'.$registroAA175_1['SH4'].'</td>					
				<td>'.$registroAA175_1['SM4'].'</td>	

				<td>'.$registroAA175_1['NH5'].'</td>	
                <td>'.$registroAA175_1['NM5'].'</td>					
				<td>'.$registroAA175_1['SH5'].'</td>					
				<td>'.$registroAA175_1['SM5'].'</td>	

				<td>'.$registroAA175_1['NH6'].'</td>	
                <td>'.$registroAA175_1['NM6'].'</td>					
				<td>'.$registroAA175_1['SH6'].'</td>					
				<td>'.$registroAA175_1['SM6'].'</td>	

				<td>'.$registroAA175_1['NH7'].'</td>	
                <td>'.$registroAA175_1['NM7'].'</td>					
				<td>'.$registroAA175_1['SH7'].'</td>					
				<td>'.$registroAA175_1['SM7'].'</td>	

				<td>'.$registroAA175_1['NH8'].'</td>	
                <td>'.$registroAA175_1['NM8'].'</td>					
				<td>'.$registroAA175_1['SH8'].'</td>					
				<td>'.$registroAA175_1['SM8'].'</td>	

				<td>'.$registroAA175_1['NH9'].'</td>	
                <td>'.$registroAA175_1['NM9'].'</td>					
				<td>'.$registroAA175_1['SH9'].'</td>					
				<td>'.$registroAA175_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA175_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroAA175_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA175_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA175_1['Total4']).'</p></b></td>
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registroAA175_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroAA175_1['NH1'];
				$totalNM1 += $registroAA175_1['NM1'];
				$totalSH1 += $registroAA175_1['SH1'];
				$totalSM1 += $registroAA175_1['SM1'];
				
				$totalNH2 += $registroAA175_1['NH2'];
				$totalNM2 += $registroAA175_1['NM2'];
				$totalSH2 += $registroAA175_1['SH2'];
				$totalSM2 += $registroAA175_1['SM2'];

				$totalNH3 += $registroAA175_1['NH3'];
				$totalNM3 += $registroAA175_1['NM3'];
				$totalSH3 += $registroAA175_1['SH3'];
				$totalSM3 += $registroAA175_1['SM3'];

				$totalNH4 += $registroAA175_1['NH4'];
				$totalNM4 += $registroAA175_1['NM4'];
				$totalSH4 += $registroAA175_1['SH4'];
				$totalSM4 += $registroAA175_1['SM4'];

				$totalNH5 += $registroAA175_1['NH5'];
				$totalNM5 += $registroAA175_1['NM5'];
				$totalSH5 += $registroAA175_1['SH5'];
				$totalSM5 += $registroAA175_1['SM5'];

				$totalNH6 += $registroAA175_1['NH6'];
				$totalNM6 += $registroAA175_1['NM6'];
				$totalSH6 += $registroAA175_1['SH6'];
				$totalSM6 += $registroAA175_1['SM6'];

				$totalNH7 += $registroAA175_1['NH7'];
				$totalNM7 += $registroAA175_1['NM7'];
				$totalSH7 += $registroAA175_1['SH7'];
				$totalSM7 += $registroAA175_1['SM7'];

				$totalNH8 += $registroAA175_1['NH8'];
				$totalNM8 += $registroAA175_1['NM8'];
				$totalSH8 += $registroAA175_1['SH8'];
				$totalSM8 += $registroAA175_1['SM8'];

				$totalNH9 += $registroAA175_1['NH9'];
				$totalNM9 += $registroAA175_1['NM9'];
				$totalSH9 += $registroAA175_1['SH9'];
				$totalSM9 += $registroAA175_1['SM9'];
				
				$total1 += $registroAA175_1['Total1'];
				$total2 += $registroAA175_1['Total2'];
				$total3 += $registroAA175_1['Total3'];
				$total4 += $registroAA175_1['Total4'];				
				
				$total += $registroAA175_1['Total'];
	   }
	}	
	
	if($resultAA210->num_rows>0){
		while($registroAA210_1 = $resultAA210->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroAA210_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroAA210_1['Codigo'].'</td>
				<td>'.$registroAA210_1['Enfermedad'].'</td>	
				<td>'.$registroAA210_1['NH1'].'</td>	
                <td>'.$registroAA210_1['NM1'].'</td>					
				<td>'.$registroAA210_1['SH1'].'</td>					
				<td>'.$registroAA210_1['SM1'].'</td>

				<td>'.$registroAA210_1['NH2'].'</td>	
                <td>'.$registroAA210_1['NM2'].'</td>					
				<td>'.$registroAA210_1['SH2'].'</td>					
				<td>'.$registroAA210_1['SM2'].'</td>

				<td>'.$registroAA210_1['NH3'].'</td>	
                <td>'.$registroAA210_1['NM3'].'</td>					
				<td>'.$registroAA210_1['SH3'].'</td>					
				<td>'.$registroAA210_1['SM3'].'</td>

				<td>'.$registroAA210_1['NH4'].'</td>	
                <td>'.$registroAA210_1['NM4'].'</td>					
				<td>'.$registroAA210_1['SH4'].'</td>					
				<td>'.$registroAA210_1['SM4'].'</td>

				<td>'.$registroAA210_1['NH5'].'</td>	
                <td>'.$registroAA210_1['NM5'].'</td>					
				<td>'.$registroAA210_1['SH5'].'</td>					
				<td>'.$registroAA210_1['SM5'].'</td>

				<td>'.$registroAA210_1['NH6'].'</td>	
                <td>'.$registroAA210_1['NM6'].'</td>					
				<td>'.$registroAA210_1['SH6'].'</td>					
				<td>'.$registroAA210_1['SM6'].'</td>
				
				<td>'.$registroAA210_1['NH7'].'</td>	
                <td>'.$registroAA210_1['NM7'].'</td>					
				<td>'.$registroAA210_1['SH7'].'</td>					
				<td>'.$registroAA210_1['SM7'].'</td>

				<td>'.$registroAA210_1['NH8'].'</td>	
                <td>'.$registroAA210_1['NM8'].'</td>					
				<td>'.$registroAA210_1['SH8'].'</td>					
				<td>'.$registroAA210_1['SM8'].'</td>

				<td>'.$registroAA210_1['NH9'].'</td>	
                <td>'.$registroAA210_1['NM9'].'</td>					
				<td>'.$registroAA210_1['SH9'].'</td>					
				<td>'.$registroAA210_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA210_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroAA210_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA210_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroAA210_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroAA210_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroAA210_1['NH1'];
				$totalNM1 += $registroAA210_1['NM1'];
				$totalSH1 += $registroAA210_1['SH1'];
				$totalSM1 += $registroAA210_1['SM1'];
				
				$totalNH2 += $registroAA210_1['NH2'];
				$totalNM2 += $registroAA210_1['NM2'];
				$totalSH2 += $registroAA210_1['SH2'];
				$totalSM2 += $registroAA210_1['SM2'];

				$totalNH3 += $registroAA210_1['NH3'];
				$totalNM3 += $registroAA210_1['NM3'];
				$totalSH3 += $registroAA210_1['SH3'];
				$totalSM3 += $registroAA210_1['SM3'];

				$totalNH4 += $registroAA210_1['NH4'];
				$totalNM4 += $registroAA210_1['NM4'];
				$totalSH4 += $registroAA210_1['SH4'];
				$totalSM4 += $registroAA210_1['SM4'];

				$totalNH5 += $registroAA210_1['NH5'];
				$totalNM5 += $registroAA210_1['NM5'];
				$totalSH5 += $registroAA210_1['SH5'];
				$totalSM5 += $registroAA210_1['SM5'];

				$totalNH6 += $registroAA210_1['NH6'];
				$totalNM6 += $registroAA210_1['NM6'];
				$totalSH6 += $registroAA210_1['SH6'];
				$totalSM6 += $registroAA210_1['SM6'];

				$totalNH7 += $registroAA210_1['NH7'];
				$totalNM7 += $registroAA210_1['NM7'];
				$totalSH7 += $registroAA210_1['SH7'];
				$totalSM7 += $registroAA210_1['SM7'];

				$totalNH8 += $registroAA210_1['NH8'];
				$totalNM8 += $registroAA210_1['NM8'];
				$totalSH8 += $registroAA210_1['SH8'];
				$totalSM8 += $registroAA210_1['SM8'];

				$totalNH9 += $registroAA210_1['NH9'];
				$totalNM9 += $registroAA210_1['NM9'];
				$totalSH9 += $registroAA210_1['SH9'];
				$totalSM9 += $registroAA210_1['SM9'];
				
				$total1 += $registroAA210_1['Total1'];
				$total2 += $registroAA210_1['Total2'];
				$total3 += $registroAA210_1['Total3'];
				$total4 += $registroAA210_1['Total4'];				
				
				$total += $registroAA210_1['Total'];
	   }
	}	

	if($resultZ00->num_rows>0){
		while($registroZ00_1 = $resultZ00->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroZ00_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroZ00_1['Codigo'].'</td>
				<td>'.$registroZ00_1['Enfermedad'].'</td>	
				<td>'.$registroZ00_1['NH1'].'</td>	
                <td>'.$registroZ00_1['NM1'].'</td>					
				<td>'.$registroZ00_1['SH1'].'</td>					
				<td>'.$registroZ00_1['SM1'].'</td>		

				<td>'.$registroZ00_1['NH2'].'</td>	
                <td>'.$registroZ00_1['NM2'].'</td>					
				<td>'.$registroZ00_1['SH2'].'</td>					
				<td>'.$registroZ00_1['SM2'].'</td>		

				<td>'.$registroZ00_1['NH3'].'</td>	
                <td>'.$registroZ00_1['NM3'].'</td>					
				<td>'.$registroZ00_1['SH3'].'</td>					
				<td>'.$registroZ00_1['SM3'].'</td>		

				<td>'.$registroZ00_1['NH4'].'</td>	
                <td>'.$registroZ00_1['NM4'].'</td>					
				<td>'.$registroZ00_1['SH4'].'</td>					
				<td>'.$registroZ00_1['SM4'].'</td>		

				<td>'.$registroZ00_1['NH5'].'</td>	
                <td>'.$registroZ00_1['NM5'].'</td>					
				<td>'.$registroZ00_1['SH5'].'</td>					
				<td>'.$registroZ00_1['SM5'].'</td>		

				<td>'.$registroZ00_1['NH6'].'</td>	
                <td>'.$registroZ00_1['NM6'].'</td>					
				<td>'.$registroZ00_1['SH6'].'</td>					
				<td>'.$registroZ00_1['SM6'].'</td>		

				<td>'.$registroZ00_1['NH7'].'</td>	
                <td>'.$registroZ00_1['NM7'].'</td>					
				<td>'.$registroZ00_1['SH7'].'</td>					
				<td>'.$registroZ00_1['SM7'].'</td>		

				<td>'.$registroZ00_1['NH8'].'</td>	
                <td>'.$registroZ00_1['NM8'].'</td>					
				<td>'.$registroZ00_1['SH8'].'</td>					
				<td>'.$registroZ00_1['SM8'].'</td>		

				<td>'.$registroZ00_1['NH9'].'</td>	
                <td>'.$registroZ00_1['NM9'].'</td>					
				<td>'.$registroZ00_1['SH9'].'</td>					
				<td>'.$registroZ00_1['SM9'].'</td>		
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ00_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroZ00_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ00_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ00_1['Total4']).'</p></b></td>

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroZ00_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroZ00_1['NH1'];
				$totalNM1 += $registroZ00_1['NM1'];
				$totalSH1 += $registroZ00_1['SH1'];
				$totalSM1 += $registroZ00_1['SM1'];
				
				$totalNH2 += $registroZ00_1['NH2'];
				$totalNM2 += $registroZ00_1['NM2'];
				$totalSH2 += $registroZ00_1['SH2'];
				$totalSM2 += $registroZ00_1['SM2'];

				$totalNH3 += $registroZ00_1['NH3'];
				$totalNM3 += $registroZ00_1['NM3'];
				$totalSH3 += $registroZ00_1['SH3'];
				$totalSM3 += $registroZ00_1['SM3'];

				$totalNH4 += $registroZ00_1['NH4'];
				$totalNM4 += $registroZ00_1['NM4'];
				$totalSH4 += $registroZ00_1['SH4'];
				$totalSM4 += $registroZ00_1['SM4'];

				$totalNH5 += $registroZ00_1['NH5'];
				$totalNM5 += $registroZ00_1['NM5'];
				$totalSH5 += $registroZ00_1['SH5'];
				$totalSM5 += $registroZ00_1['SM5'];

				$totalNH6 += $registroZ00_1['NH6'];
				$totalNM6 += $registroZ00_1['NM6'];
				$totalSH6 += $registroZ00_1['SH6'];
				$totalSM6 += $registroZ00_1['SM6'];

				$totalNH7 += $registroZ00_1['NH7'];
				$totalNM7 += $registroZ00_1['NM7'];
				$totalSH7 += $registroZ00_1['SH7'];
				$totalSM7 += $registroZ00_1['SM7'];

				$totalNH8 += $registroZ00_1['NH8'];
				$totalNM8 += $registroZ00_1['NM8'];
				$totalSH8 += $registroZ00_1['SH8'];
				$totalSM8 += $registroZ00_1['SM8'];
				
				$totalNH9 += $registroZ00_1['NH9'];
				$totalNM9 += $registroZ00_1['NM9'];
				$totalSH9 += $registroZ00_1['SH9'];
				$totalSM9 += $registroZ00_1['SM9'];	

				$total1 += $registroZ00_1['Total1'];
				$total2 += $registroZ00_1['Total2'];
				$total3 += $registroZ00_1['Total3'];
				$total4 += $registroZ00_1['Total4'];					
				
				$total += $registroZ00_1['Total'];
	   }
	}	

	if($resultZ20->num_rows>0){
		while($registroZ20_1 = $resultZ20->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroZ20_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroZ20_1['Codigo'].'</td>
				<td>'.$registroZ20_1['Enfermedad'].'</td>	
				<td>'.$registroZ20_1['NH1'].'</td>	
                <td>'.$registroZ20_1['NM1'].'</td>					
				<td>'.$registroZ20_1['SH1'].'</td>					
				<td>'.$registroZ20_1['SM1'].'</td>		

				<td>'.$registroZ20_1['NH2'].'</td>	
                <td>'.$registroZ20_1['NM2'].'</td>					
				<td>'.$registroZ20_1['SH2'].'</td>					
				<td>'.$registroZ20_1['SM2'].'</td>		

				<td>'.$registroZ20_1['NH3'].'</td>	
                <td>'.$registroZ20_1['NM3'].'</td>					
				<td>'.$registroZ20_1['SH3'].'</td>					
				<td>'.$registroZ20_1['SM3'].'</td>		

				<td>'.$registroZ20_1['NH4'].'</td>	
                <td>'.$registroZ20_1['NM4'].'</td>					
				<td>'.$registroZ20_1['SH4'].'</td>					
				<td>'.$registroZ20_1['SM4'].'</td>		

				<td>'.$registroZ20_1['NH5'].'</td>	
                <td>'.$registroZ20_1['NM5'].'</td>					
				<td>'.$registroZ20_1['SH5'].'</td>					
				<td>'.$registroZ20_1['SM5'].'</td>		

				<td>'.$registroZ20_1['NH6'].'</td>	
                <td>'.$registroZ20_1['NM6'].'</td>					
				<td>'.$registroZ20_1['SH6'].'</td>					
				<td>'.$registroZ20_1['SM6'].'</td>		

				<td>'.$registroZ20_1['NH7'].'</td>	
                <td>'.$registroZ20_1['NM7'].'</td>					
				<td>'.$registroZ20_1['SH7'].'</td>					
				<td>'.$registroZ20_1['SM7'].'</td>		

				<td>'.$registroZ20_1['NH8'].'</td>	
                <td>'.$registroZ20_1['NM8'].'</td>					
				<td>'.$registroZ20_1['SH8'].'</td>					
				<td>'.$registroZ20_1['SM8'].'</td>		

				<td>'.$registroZ20_1['NH9'].'</td>	
                <td>'.$registroZ20_1['NM9'].'</td>					
				<td>'.$registroZ20_1['SH9'].'</td>					
				<td>'.$registroZ20_1['SM9'].'</td>		
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ20_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroZ20_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ20_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ20_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroZ20_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroZ20_1['NH1'];
				$totalNM1 += $registroZ20_1['NM1'];
				$totalSH1 += $registroZ20_1['SH1'];
				$totalSM1 += $registroZ20_1['SM1'];
				
				$totalNH2 += $registroZ20_1['NH2'];
				$totalNM2 += $registroZ20_1['NM2'];
				$totalSH2 += $registroZ20_1['SH2'];
				$totalSM2 += $registroZ20_1['SM2'];

				$totalNH3 += $registroZ20_1['NH3'];
				$totalNM3 += $registroZ20_1['NM3'];
				$totalSH3 += $registroZ20_1['SH3'];
				$totalSM3 += $registroZ20_1['SM3'];

				$totalNH4 += $registroZ20_1['NH4'];
				$totalNM4 += $registroZ20_1['NM4'];
				$totalSH4 += $registroZ20_1['SH4'];
				$totalSM4 += $registroZ20_1['SM4'];

				$totalNH5 += $registroZ20_1['NH5'];
				$totalNM5 += $registroZ20_1['NM5'];
				$totalSH5 += $registroZ20_1['SH5'];
				$totalSM5 += $registroZ20_1['SM5'];

				$totalNH6 += $registroZ20_1['NH6'];
				$totalNM6 += $registroZ20_1['NM6'];
				$totalSH6 += $registroZ20_1['SH6'];
				$totalSM6 += $registroZ20_1['SM6'];

				$totalNH7 += $registroZ20_1['NH7'];
				$totalNM7 += $registroZ20_1['NM7'];
				$totalSH7 += $registroZ20_1['SH7'];
				$totalSM7 += $registroZ20_1['SM7'];

				$totalNH8 += $registroZ20_1['NH8'];
				$totalNM8 += $registroZ20_1['NM8'];
				$totalSH8 += $registroZ20_1['SH8'];
				$totalSM8 += $registroZ20_1['SM8'];
				
				$totalNH9 += $registroZ20_1['NH9'];
				$totalNM9 += $registroZ20_1['NM9'];
				$totalSH9 += $registroZ20_1['SH9'];
				$totalSM9 += $registroZ20_1['SM9'];	

				$total1 += $registroZ20_1['Total1'];
				$total2 += $registroZ20_1['Total2'];
				$total3 += $registroZ20_1['Total3'];
				$total4 += $registroZ20_1['Total4'];	
				
				$total += $registroZ20_1['Total'];
	   }
	}

	if($resultZ30->num_rows>0){
		while($registroZ30_1 = $resultZ30->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroZ30_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroZ30_1['Codigo'].'</td>
				<td>'.$registroZ30_1['Enfermedad'].'</td>	
				<td>'.$registroZ30_1['NH1'].'</td>	
                <td>'.$registroZ30_1['NM1'].'</td>					
				<td>'.$registroZ30_1['SH1'].'</td>					
				<td>'.$registroZ30_1['SM1'].'</td>	

				<td>'.$registroZ30_1['NH2'].'</td>	
                <td>'.$registroZ30_1['NM2'].'</td>					
				<td>'.$registroZ30_1['SH2'].'</td>					
				<td>'.$registroZ30_1['SM2'].'</td>	

				<td>'.$registroZ30_1['NH3'].'</td>	
                <td>'.$registroZ30_1['NM3'].'</td>					
				<td>'.$registroZ30_1['SH3'].'</td>					
				<td>'.$registroZ30_1['SM3'].'</td>	

				<td>'.$registroZ30_1['NH4'].'</td>	
                <td>'.$registroZ30_1['NM4'].'</td>					
				<td>'.$registroZ30_1['SH4'].'</td>					
				<td>'.$registroZ30_1['SM4'].'</td>	

				<td>'.$registroZ30_1['NH5'].'</td>	
                <td>'.$registroZ30_1['NM5'].'</td>					
				<td>'.$registroZ30_1['SH5'].'</td>					
				<td>'.$registroZ30_1['SM5'].'</td>	

				<td>'.$registroZ30_1['NH6'].'</td>	
                <td>'.$registroZ30_1['NM6'].'</td>					
				<td>'.$registroZ30_1['SH6'].'</td>					
				<td>'.$registroZ30_1['SM6'].'</td>	

				<td>'.$registroZ30_1['NH7'].'</td>	
                <td>'.$registroZ30_1['NM7'].'</td>					
				<td>'.$registroZ30_1['SH7'].'</td>					
				<td>'.$registroZ30_1['SM7'].'</td>	

				<td>'.$registroZ30_1['NH8'].'</td>	
                <td>'.$registroZ30_1['NM8'].'</td>					
				<td>'.$registroZ30_1['SH8'].'</td>					
				<td>'.$registroZ30_1['SM8'].'</td>	

				<td>'.$registroZ30_1['NH9'].'</td>	
                <td>'.$registroZ30_1['NM9'].'</td>					
				<td>'.$registroZ30_1['SH9'].'</td>					
				<td>'.$registroZ30_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ30_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroZ30_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ30_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ30_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroZ30_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroZ30_1['NH1'];
				$totalNM1 += $registroZ30_1['NM1'];
				$totalSH1 += $registroZ30_1['SH1'];
				$totalSM1 += $registroZ30_1['SM1'];
				
				$totalNH2 += $registroZ30_1['NH2'];
				$totalNM2 += $registroZ30_1['NM2'];
				$totalSH2 += $registroZ30_1['SH2'];
				$totalSM2 += $registroZ30_1['SM2'];

				$totalNH3 += $registroZ30_1['NH3'];
				$totalNM3 += $registroZ30_1['NM3'];
				$totalSH3 += $registroZ30_1['SH3'];
				$totalSM3 += $registroZ30_1['SM3'];

				$totalNH4 += $registroZ30_1['NH4'];
				$totalNM4 += $registroZ30_1['NM4'];
				$totalSH4 += $registroZ30_1['SH4'];
				$totalSM4 += $registroZ30_1['SM4'];

				$totalNH5 += $registroZ30_1['NH5'];
				$totalNM5 += $registroZ30_1['NM5'];
				$totalSH5 += $registroZ30_1['SH5'];
				$totalSM5 += $registroZ30_1['SM5'];

				$totalNH6 += $registroZ30_1['NH6'];
				$totalNM6 += $registroZ30_1['NM6'];
				$totalSH6 += $registroZ30_1['SH6'];
				$totalSM6 += $registroZ30_1['SM6'];
				
				$totalNH7 += $registroZ30_1['NH7'];
				$totalNM7 += $registroZ30_1['NM7'];
				$totalSH7 += $registroZ30_1['SH7'];
				$totalSM7 += $registroZ30_1['SM7'];

				$totalNH8 += $registroZ30_1['NH8'];
				$totalNM8 += $registroZ30_1['NM8'];
				$totalSH8 += $registroZ30_1['SH8'];
				$totalSM8 += $registroZ30_1['SM8'];

				$totalNH9 += $registroZ30_1['NH9'];
				$totalNM9 += $registroZ30_1['NM9'];
				$totalSH9 += $registroZ30_1['SH9'];
				$totalSM9 += $registroZ30_1['SM9'];
				
				$total1 += $registroZ30_1['Total1'];
				$total2 += $registroZ30_1['Total2'];
				$total3 += $registroZ30_1['Total3'];
				$total4 += $registroZ30_1['Total4'];				
				
				$total += $registroZ30_1['Total'];
	   }
	}

	if($resultZ40->num_rows>0){
		while($registroZ40_1 = $resultZ40->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroZ40_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroZ40_1['Codigo'].'</td>
				<td>'.$registroZ40_1['Enfermedad'].'</td>	
				<td>'.$registroZ40_1['NH1'].'</td>	
                <td>'.$registroZ40_1['NM1'].'</td>					
				<td>'.$registroZ40_1['SH1'].'</td>					
				<td>'.$registroZ40_1['SM1'].'</td>	

				<td>'.$registroZ40_1['NH2'].'</td>	
                <td>'.$registroZ40_1['NM2'].'</td>					
				<td>'.$registroZ40_1['SH2'].'</td>					
				<td>'.$registroZ40_1['SM2'].'</td>	

				<td>'.$registroZ40_1['NH3'].'</td>	
                <td>'.$registroZ40_1['NM3'].'</td>					
				<td>'.$registroZ40_1['SH3'].'</td>					
				<td>'.$registroZ40_1['SM3'].'</td>	

				<td>'.$registroZ40_1['NH4'].'</td>	
                <td>'.$registroZ40_1['NM4'].'</td>					
				<td>'.$registroZ40_1['SH4'].'</td>					
				<td>'.$registroZ40_1['SM4'].'</td>	

				<td>'.$registroZ40_1['NH5'].'</td>	
                <td>'.$registroZ40_1['NM5'].'</td>					
				<td>'.$registroZ40_1['SH5'].'</td>					
				<td>'.$registroZ40_1['SM5'].'</td>	
				
				<td>'.$registroZ40_1['NH6'].'</td>	
                <td>'.$registroZ40_1['NM6'].'</td>					
				<td>'.$registroZ40_1['SH6'].'</td>					
				<td>'.$registroZ40_1['SM6'].'</td>	

				<td>'.$registroZ40_1['NH7'].'</td>	
                <td>'.$registroZ40_1['NM7'].'</td>					
				<td>'.$registroZ40_1['SH7'].'</td>					
				<td>'.$registroZ40_1['SM7'].'</td>	
				
				<td>'.$registroZ40_1['NH8'].'</td>	
                <td>'.$registroZ40_1['NM8'].'</td>					
				<td>'.$registroZ40_1['SH8'].'</td>					
				<td>'.$registroZ40_1['SM8'].'</td>	

				<td>'.$registroZ40_1['NH9'].'</td>	
                <td>'.$registroZ40_1['NM9'].'</td>					
				<td>'.$registroZ40_1['SH9'].'</td>					
				<td>'.$registroZ40_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ40_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroZ40_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ40_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ40_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroZ40_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroZ40_1['NH1'];
				$totalNM1 += $registroZ40_1['NM1'];
				$totalSH1 += $registroZ40_1['SH1'];
				$totalSM1 += $registroZ40_1['SM1'];
				
				$totalNH2 += $registroZ40_1['NH2'];
				$totalNM2 += $registroZ40_1['NM2'];
				$totalSH2 += $registroZ40_1['SH2'];
				$totalSM2 += $registroZ40_1['SM2'];

				$totalNH3 += $registroZ40_1['NH3'];
				$totalNM3 += $registroZ40_1['NM3'];
				$totalSH3 += $registroZ40_1['SH3'];
				$totalSM3 += $registroZ40_1['SM3'];

				$totalNH4 += $registroZ40_1['NH4'];
				$totalNM4 += $registroZ40_1['NM4'];
				$totalSH4 += $registroZ40_1['SH4'];
				$totalSM4 += $registroZ40_1['SM4'];

				$totalNH5 += $registroZ40_1['NH5'];
				$totalNM5 += $registroZ40_1['NM5'];
				$totalSH5 += $registroZ40_1['SH5'];
				$totalSM5 += $registroZ40_1['SM5'];

				$totalNH6 += $registroZ40_1['NH6'];
				$totalNM6 += $registroZ40_1['NM6'];
				$totalSH6 += $registroZ40_1['SH6'];
				$totalSM6 += $registroZ40_1['SM6'];

				$totalNH7 += $registroZ40_1['NH7'];
				$totalNM7 += $registroZ40_1['NM7'];
				$totalSH7 += $registroZ40_1['SH7'];
				$totalSM7 += $registroZ40_1['SM7'];

				$totalNH8 += $registroZ40_1['NH8'];
				$totalNM8 += $registroZ40_1['NM8'];
				$totalSH8 += $registroZ40_1['SH8'];
				$totalSM8 += $registroZ40_1['SM8'];

				$totalNH9 += $registroZ40_1['NH9'];
				$totalNM9 += $registroZ40_1['NM9'];
				$totalSH9 += $registroZ40_1['SH9'];
				$totalSM9 += $registroZ40_1['SM9'];
				
				$total1 += $registroZ40_1['Total1'];
				$total2 += $registroZ40_1['Total2'];
				$total3 += $registroZ40_1['Total3'];
				$total4 += $registroZ40_1['Total4'];				
				
				$total += $registroZ40_1['Total'];
	   }
	}

	if($resultZ55->num_rows>0){
		while($registroZ55_1 = $resultZ55->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroZ55_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroZ55_1['Codigo'].'</td>
				<td>'.$registroZ55_1['Enfermedad'].'</td>	
				<td>'.$registroZ55_1['NH1'].'</td>	
                <td>'.$registroZ55_1['NM1'].'</td>					
				<td>'.$registroZ55_1['SH1'].'</td>					
				<td>'.$registroZ55_1['SM1'].'</td>	

				<td>'.$registroZ55_1['NH2'].'</td>	
                <td>'.$registroZ55_1['NM2'].'</td>					
				<td>'.$registroZ55_1['SH2'].'</td>					
				<td>'.$registroZ55_1['SM2'].'</td>	

				<td>'.$registroZ55_1['NH3'].'</td>	
                <td>'.$registroZ55_1['NM3'].'</td>					
				<td>'.$registroZ55_1['SH3'].'</td>					
				<td>'.$registroZ55_1['SM3'].'</td>	

				<td>'.$registroZ55_1['NH4'].'</td>	
                <td>'.$registroZ55_1['NM4'].'</td>					
				<td>'.$registroZ55_1['SH4'].'</td>					
				<td>'.$registroZ55_1['SM4'].'</td>	

				<td>'.$registroZ55_1['NH5'].'</td>	
                <td>'.$registroZ55_1['NM5'].'</td>					
				<td>'.$registroZ55_1['SH5'].'</td>					
				<td>'.$registroZ55_1['SM5'].'</td>	

				<td>'.$registroZ55_1['NH6'].'</td>	
                <td>'.$registroZ55_1['NM6'].'</td>					
				<td>'.$registroZ55_1['SH6'].'</td>					
				<td>'.$registroZ55_1['SM6'].'</td>	

				<td>'.$registroZ55_1['NH7'].'</td>	
                <td>'.$registroZ55_1['NM7'].'</td>					
				<td>'.$registroZ55_1['SH7'].'</td>					
				<td>'.$registroZ55_1['SM7'].'</td>	

				<td>'.$registroZ55_1['NH8'].'</td>	
                <td>'.$registroZ55_1['NM8'].'</td>					
				<td>'.$registroZ55_1['SH8'].'</td>					
				<td>'.$registroZ55_1['SM8'].'</td>	

				<td>'.$registroZ55_1['NH9'].'</td>	
                <td>'.$registroZ55_1['NM9'].'</td>					
				<td>'.$registroZ55_1['SH9'].'</td>					
				<td>'.$registroZ55_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ55_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroZ55_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ55_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroZ55_1['Total4']).'</p></b></td>	

				<td><b><p style="color: '.$color_neto.';">'.number_format($registroZ55_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroZ55_1['NH1'];
				$totalNM1 += $registroZ55_1['NM1'];
				$totalSH1 += $registroZ55_1['SH1'];
				$totalSM1 += $registroZ55_1['SM1'];
				
				$totalNH2 += $registroZ55_1['NH2'];
				$totalNM2 += $registroZ55_1['NM2'];
				$totalSH2 += $registroZ55_1['SH2'];
				$totalSM2 += $registroZ55_1['SM2'];

				$totalNH3 += $registroZ55_1['NH3'];
				$totalNM3 += $registroZ55_1['NM3'];
				$totalSH3 += $registroZ55_1['SH3'];
				$totalSM3 += $registroZ55_1['SM3'];

				$totalNH4 += $registroZ55_1['NH4'];
				$totalNM4 += $registroZ55_1['NM4'];
				$totalSH4 += $registroZ55_1['SH4'];
				$totalSM4 += $registroZ55_1['SM4'];

				$totalNH5 += $registroZ55_1['NH5'];
				$totalNM5 += $registroZ55_1['NM5'];
				$totalSH5 += $registroZ55_1['SH5'];
				$totalSM5 += $registroZ55_1['SM5'];

				$totalNH6 += $registroZ55_1['NH6'];
				$totalNM6 += $registroZ55_1['NM6'];
				$totalSH6 += $registroZ55_1['SH6'];
				$totalSM6 += $registroZ55_1['SM6'];

				$totalNH7 += $registroZ55_1['NH7'];
				$totalNM7 += $registroZ55_1['NM7'];
				$totalSH7 += $registroZ55_1['SH7'];
				$totalSM7 += $registroZ55_1['SM7'];

				$totalNH8 += $registroZ55_1['NH8'];
				$totalNM8 += $registroZ55_1['NM8'];
				$totalSH8 += $registroZ55_1['SH8'];
				$totalSM8 += $registroZ55_1['SM8'];

				$totalNH9 += $registroZ55_1['NH9'];
				$totalNM9 += $registroZ55_1['NM9'];
				$totalSH9 += $registroZ55_1['SH9'];
				$totalSM9 += $registroZ55_1['SM9'];
				
				$total1 += $registroZ55_1['Total1'];
				$total2 += $registroZ55_1['Total2'];
				$total3 += $registroZ55_1['Total3'];
				$total4 += $registroZ55_1['Total4'];				
				
				$total += $registroZ55_1['Total'];
	   }
	}	
	
	if($resultZ70->num_rows>0){
		while($registro70_1 = $resultZ70->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registro70_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registro70_1['Codigo'].'</td>
				<td>'.$registro70_1['Enfermedad'].'</td>	
				<td>'.$registro70_1['NH1'].'</td>	
                <td>'.$registro70_1['NM1'].'</td>					
				<td>'.$registro70_1['SH1'].'</td>					
				<td>'.$registro70_1['SM1'].'</td>	

				<td>'.$registro70_1['NH2'].'</td>	
                <td>'.$registro70_1['NM2'].'</td>					
				<td>'.$registro70_1['SH2'].'</td>					
				<td>'.$registro70_1['SM2'].'</td>	

				<td>'.$registro70_1['NH3'].'</td>	
                <td>'.$registro70_1['NM3'].'</td>					
				<td>'.$registro70_1['SH3'].'</td>					
				<td>'.$registro70_1['SM3'].'</td>	

				<td>'.$registro70_1['NH4'].'</td>	
                <td>'.$registro70_1['NM4'].'</td>					
				<td>'.$registro70_1['SH4'].'</td>					
				<td>'.$registro70_1['SM4'].'</td>	

				<td>'.$registro70_1['NH5'].'</td>	
                <td>'.$registro70_1['NM5'].'</td>					
				<td>'.$registro70_1['SH5'].'</td>					
				<td>'.$registro70_1['SM5'].'</td>	

				<td>'.$registro70_1['NH6'].'</td>	
                <td>'.$registro70_1['NM6'].'</td>					
				<td>'.$registro70_1['SH6'].'</td>					
				<td>'.$registro70_1['SM6'].'</td>	

				<td>'.$registro70_1['NH7'].'</td>	
                <td>'.$registro70_1['NM7'].'</td>					
				<td>'.$registro70_1['SH7'].'</td>					
				<td>'.$registro70_1['SM7'].'</td>	

				<td>'.$registro70_1['NH8'].'</td>	
                <td>'.$registro70_1['NM8'].'</td>					
				<td>'.$registro70_1['SH8'].'</td>					
				<td>'.$registro70_1['SM8'].'</td>	

				<td>'.$registro70_1['NH9'].'</td>	
                <td>'.$registro70_1['NM9'].'</td>					
				<td>'.$registro70_1['SH9'].'</td>					
				<td>'.$registro70_1['SM9'].'</td>

				<td><b><p style="color: '.$color_totales.';">'.number_format($registro70_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registro70_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registro70_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registro70_1['Total4']).'</p></b></td>
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registro70_1['Total']).'</p></b></td>
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registro70_1['NH1'];
				$totalNM1 += $registro70_1['NM1'];
				$totalSH1 += $registro70_1['SH1'];
				$totalSM1 += $registro70_1['SM1'];
				
				$totalNH2 += $registro70_1['NH2'];
				$totalNM2 += $registro70_1['NM2'];
				$totalSH2 += $registro70_1['SH2'];
				$totalSM2 += $registro70_1['SM2'];

				$totalNH3 += $registro70_1['NH3'];
				$totalNM3 += $registro70_1['NM3'];
				$totalSH3 += $registro70_1['SH3'];
				$totalSM3 += $registro70_1['SM3'];

				$totalNH4 += $registro70_1['NH4'];
				$totalNM4 += $registro70_1['NM4'];
				$totalSH4 += $registro70_1['SH4'];
				$totalSM4 += $registro70_1['SM4'];

				$totalNH5 += $registro70_1['NH5'];
				$totalNM5 += $registro70_1['NM5'];
				$totalSH5 += $registro70_1['SH5'];
				$totalSM5 += $registro70_1['SM5'];

				$totalNH6 += $registro70_1['NH6'];
				$totalNM6 += $registro70_1['NM6'];
				$totalSH6 += $registro70_1['SH6'];
				$totalSM6 += $registro70_1['SM6'];

				$totalNH7 += $registro70_1['NH7'];
				$totalNM7 += $registro70_1['NM7'];
				$totalSH7 += $registro70_1['SH7'];
				$totalSM7 += $registro70_1['SM7'];

				$totalNH8 += $registro70_1['NH8'];
				$totalNM8 += $registro70_1['NM8'];
				$totalSH8 += $registro70_1['SH8'];
				$totalSM8 += $registro70_1['SM8'];

				$totalNH9 += $registro70_1['NH9'];
				$totalNM9 += $registro70_1['NM9'];
				$totalSH9 += $registro70_1['SH9'];
				$totalSM9 += $registro70_1['SM9'];
				
				$total1 += $registro70_1['Total1'];
				$total2 += $registro70_1['Total2'];
				$total3 += $registro70_1['Total3'];
				$total4 += $registro70_1['Total4'];				
				
				$total += $registro70_1['Total'];
	   }
	}	

	if($resultZ80->num_rows>0){
		while($registro80_1 = $resultZ80->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registro80_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registro80_1['Codigo'].'</td>
				<td>'.$registro80_1['Enfermedad'].'</td>	
				<td>'.$registro80_1['NH1'].'</td>	
                <td>'.$registro80_1['NM1'].'</td>					
				<td>'.$registro80_1['SH1'].'</td>					
				<td>'.$registro80_1['SM1'].'</td>

				<td>'.$registro80_1['NH2'].'</td>	
                <td>'.$registro80_1['NM2'].'</td>					
				<td>'.$registro80_1['SH2'].'</td>					
				<td>'.$registro80_1['SM2'].'</td>

				<td>'.$registro80_1['NH3'].'</td>	
                <td>'.$registro80_1['NM3'].'</td>					
				<td>'.$registro80_1['SH3'].'</td>					
				<td>'.$registro80_1['SM3'].'</td>

				<td>'.$registro80_1['NH4'].'</td>	
                <td>'.$registro80_1['NM4'].'</td>					
				<td>'.$registro80_1['SH4'].'</td>					
				<td>'.$registro80_1['SM4'].'</td>

				<td>'.$registro80_1['NH5'].'</td>	
                <td>'.$registro80_1['NM5'].'</td>					
				<td>'.$registro80_1['SH5'].'</td>					
				<td>'.$registro80_1['SM5'].'</td>

				<td>'.$registro80_1['NH6'].'</td>	
                <td>'.$registro80_1['NM6'].'</td>					
				<td>'.$registro80_1['SH6'].'</td>					
				<td>'.$registro80_1['SM6'].'</td>

				<td>'.$registro80_1['NH7'].'</td>	
                <td>'.$registro80_1['NM7'].'</td>					
				<td>'.$registro80_1['SH7'].'</td>					
				<td>'.$registro80_1['SM7'].'</td>

				<td>'.$registro80_1['NH8'].'</td>	
                <td>'.$registro80_1['NM8'].'</td>					
				<td>'.$registro80_1['SH8'].'</td>					
				<td>'.$registro80_1['SM8'].'</td>

				<td>'.$registro80_1['NH9'].'</td>	
                <td>'.$registro80_1['NM9'].'</td>					
				<td>'.$registro80_1['SH9'].'</td>					
				<td>'.$registro80_1['SM9'].'</td>
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registro80_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registro80_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registro80_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registro80_1['Total4']).'</p></b></td>
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registro80_1['Total1']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registro80_1['NH1'];
				$totalNM1 += $registro80_1['NM1'];
				$totalSH1 += $registro80_1['SH1'];
				$totalSM1 += $registro80_1['SM1'];
				
				$totalNH2 += $registro80_1['NH2'];
				$totalNM2 += $registro80_1['NM2'];
				$totalSH2 += $registro80_1['SH2'];
				$totalSM2 += $registro80_1['SM2'];

				$totalNH3 += $registro80_1['NH3'];
				$totalNM3 += $registro80_1['NM3'];
				$totalSH3 += $registro80_1['SH3'];
				$totalSM3 += $registro80_1['SM3'];

				$totalNH4 += $registro80_1['NH4'];
				$totalNM4 += $registro80_1['NM4'];
				$totalSH4 += $registro80_1['SH4'];
				$totalSM4 += $registro80_1['SM4'];

				$totalNH5 += $registro80_1['NH5'];
				$totalNM5 += $registro80_1['NM5'];
				$totalSH5 += $registro80_1['SH5'];
				$totalSM5 += $registro80_1['SM5'];

				$totalNH6 += $registro80_1['NH6'];
				$totalNM6 += $registro80_1['NM6'];
				$totalSH6 += $registro80_1['SH6'];
				$totalSM6 += $registro80_1['SM6'];

				$totalNH7 += $registro80_1['NH7'];
				$totalNM7 += $registro80_1['NM7'];
				$totalSH7 += $registro80_1['SH7'];
				$totalSM7 += $registro80_1['SM7'];

				$totalNH8 += $registro80_1['NH8'];
				$totalNM8 += $registro80_1['NM8'];
				$totalSH8 += $registro80_1['SH8'];
				$totalSM8 += $registro80_1['SM8'];

				$totalNH9 += $registro80_1['NH9'];
				$totalNM9 += $registro80_1['NM9'];
				$totalSH9 += $registro80_1['SH9'];
				$totalSM9 += $registro80_1['SM9'];
				
				$total1 += $registro80_1['Total1'];
				$total2 += $registro80_1['Total2'];
				$total3 += $registro80_1['Total3'];
				$total4 += $registro80_1['Total4'];				
				
				$total += $registro80_1['Total'];
	   }
	}

	if($resultNPP->num_rows>0){
		while($registroNPP_1 = $resultNPP->fetch_assoc()){
	     if ($consulta1['Total'] != 0){
			  $porcentaje = ($registroNPP_1['Total'] / $consulta1['Total'])*100;					 
		 }else{
			 $porcentaje = 0; 
		 }			
		
	   	   echo '<tr>
		        <td>'.$registroNPP_1['Codigo'].'</td>
				<td>'.$registroNPP_1['Enfermedad'].'</td>	
				<td>'.$registroNPP_1['NH1'].'</td>	
                <td>'.$registroNPP_1['NM1'].'</td>					
				<td>'.$registroNPP_1['SH1'].'</td>					
				<td>'.$registroNPP_1['SM1'].'</td>	

				<td>'.$registroNPP_1['NH2'].'</td>	
                <td>'.$registroNPP_1['NM2'].'</td>					
				<td>'.$registroNPP_1['SH2'].'</td>					
				<td>'.$registroNPP_1['SM2'].'</td>	

				<td>'.$registroNPP_1['NH3'].'</td>	
                <td>'.$registroNPP_1['NM3'].'</td>					
				<td>'.$registroNPP_1['SH3'].'</td>					
				<td>'.$registroNPP_1['SM3'].'</td>	

				<td>'.$registroNPP_1['NH4'].'</td>	
                <td>'.$registroNPP_1['NM4'].'</td>					
				<td>'.$registroNPP_1['SH4'].'</td>					
				<td>'.$registroNPP_1['SM4'].'</td>	

				<td>'.$registroNPP_1['NH5'].'</td>	
                <td>'.$registroNPP_1['NM5'].'</td>					
				<td>'.$registroNPP_1['SH5'].'</td>					
				<td>'.$registroNPP_1['SM5'].'</td>	

				<td>'.$registroNPP_1['NH6'].'</td>	
                <td>'.$registroNPP_1['NM6'].'</td>					
				<td>'.$registroNPP_1['SH6'].'</td>					
				<td>'.$registroNPP_1['SM6'].'</td>	

				<td>'.$registroNPP_1['NH7'].'</td>	
                <td>'.$registroNPP_1['NM7'].'</td>					
				<td>'.$registroNPP_1['SH7'].'</td>					
				<td>'.$registroNPP_1['SM7'].'</td>	

				<td>'.$registroNPP_1['NH8'].'</td>	
                <td>'.$registroNPP_1['NM8'].'</td>					
				<td>'.$registroNPP_1['SH8'].'</td>					
				<td>'.$registroNPP_1['SM8'].'</td>	

				<td>'.$registroNPP_1['NH9'].'</td>	
                <td>'.$registroNPP_1['NM9'].'</td>					
				<td>'.$registroNPP_1['SH9'].'</td>					
				<td>'.$registroNPP_1['SM9'].'</td>	
				
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroNPP_1['Total1']).'</p></b></td>	
                <td><b><p style="color: '.$color_totales.';">'.number_format($registroNPP_1['Total2']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroNPP_1['Total3']).'</p></b></td>					
				<td><b><p style="color: '.$color_totales.';">'.number_format($registroNPP_1['Total4']).'</p></b></td>
				
				<td><b><p style="color: '.$color_neto.';">'.number_format($registroNPP_1['Total']).'</p></b></td>				
				<td><b><p style="color: '.$color_porcentaje.';">'.number_format($porcentaje).'</p></b></td>						
				</tr>';
				$totalNH1 += $registroNPP_1['NH1'];
				$totalNM1 += $registroNPP_1['NM1'];
				$totalSH1 += $registroNPP_1['SH1'];
				$totalSM1 += $registroNPP_1['SM1'];
				
				$totalNH2 += $registroNPP_1['NH2'];
				$totalNM2 += $registroNPP_1['NM2'];
				$totalSH2 += $registroNPP_1['SH2'];
				$totalSM2 += $registroNPP_1['SM2'];

				$totalNH3 += $registroNPP_1['NH3'];
				$totalNM3 += $registroNPP_1['NM3'];
				$totalSH3 += $registroNPP_1['SH3'];
				$totalSM3 += $registroNPP_1['SM3'];

				$totalNH4 += $registroNPP_1['NH4'];
				$totalNM4 += $registroNPP_1['NM4'];
				$totalSH4 += $registroNPP_1['SH4'];
				$totalSM4 += $registroNPP_1['SM4'];

				$totalNH5 += $registroNPP_1['NH5'];
				$totalNM5 += $registroNPP_1['NM5'];
				$totalSH5 += $registroNPP_1['SH5'];
				$totalSM5 += $registroNPP_1['SM5'];

				$totalNH6 += $registroNPP_1['NH6'];
				$totalNM6 += $registroNPP_1['NM6'];
				$totalSH6 += $registroNPP_1['SH6'];
				$totalSM6 += $registroNPP_1['SM6'];

				$totalNH7 += $registroNPP_1['NH7'];
				$totalNM7 += $registroNPP_1['NM7'];
				$totalSH7 += $registroNPP_1['SH7'];
				$totalSM7 += $registroNPP_1['SM7'];

				$totalNH8 += $registroNPP_1['NH8'];
				$totalNM8 += $registroNPP_1['NM8'];
				$totalSH8 += $registroNPP_1['SH8'];
				$totalSM8 += $registroNPP_1['SM8'];		

				$totalNH9 += $registroNPP_1['NH9'];
				$totalNM9 += $registroNPP_1['NM9'];
				$totalSH9 += $registroNPP_1['SH9'];
				$totalSM9 += $registroNPP_1['SM9'];	

				$total1 += $registroNPP_1['Total1'];
				$total2 += $registroNPP_1['Total2'];
				$total3 += $registroNPP_1['Total3'];
				$total4 += $registroNPP_1['Total4'];					
				
				$total += $registroNPP_1['Total'];
	   }
	}	
	
	$total_nuevos += $totalNM1 + $totalNM2 + $totalNM3 + $totalNM4 + $totalNM5 + $totalNM6 + $totalNM7 + $totalNM8 + $totalNM9 + $totalNH1 + $totalNH2 + $totalNH3 + $totalNH4 + $totalNH5 + $totalNH6 + $totalNH7 + $totalNH8 + $totalNH9;
	
	if ($total!=0){
       $total_nuevos_consulta = ($total_nuevos / $total )*100;		
	}else{
	   $total_nuevos_consulta = 0;
	}

    echo '<tr>
	        <td colspan="2"><b>TOTAL</b></td>
	    	<td><b>'.number_format($totalNH1).'</b></td>
            <td><b>'.number_format($totalNM1).'</b></td>
			<td><b>'.number_format($totalSH1).'</b></td>			
			<td><b>'.number_format($totalSM1).'</b></td>
			
	    	<td><b>'.number_format($totalNH2).'</b></td>
            <td><b>'.number_format($totalNM2).'</b></td>
			<td><b>'.number_format($totalSH2).'</b></td>			
			<td><b>'.number_format($totalSM2).'</b></td>
			
	    	<td><b>'.number_format($totalNH3).'</b></td>			
            <td><b>'.number_format($totalNM3).'</b></td>
			<td><b>'.number_format($totalSH3).'</b></td>			
			<td><b>'.number_format($totalSM3).'</b></td>
	    	
			<td><b>'.number_format($totalNH4).'</b></td>			
            <td><b>'.number_format($totalNM4).'</b></td>
			<td><b>'.number_format($totalSH4).'</b></td>			
			<td><b>'.number_format($totalSM4).'</b></td>
			
	    	<td><b>'.number_format($totalNH5).'</b></td>
            <td><b>'.number_format($totalNM5).'</b></td>
			<td><b>'.number_format($totalSH5).'</b></td>			
			<td><b>'.number_format($totalSM5).'</b></td>
			
	    	<td><b>'.number_format($totalNH6).'</b></td>
            <td><b>'.number_format($totalNM6).'</b></td>
			<td><b>'.number_format($totalSH6).'</b></td>			
			<td><b>'.number_format($totalSM6).'</b></td>
			
	    	<td><b>'.number_format($totalNH7).'</b></td>			
            <td><b>'.number_format($totalNM7).'</b></td>
			<td><b>'.number_format($totalSH7).'</b></td>			
			<td><b>'.number_format($totalSM7).'</b></td>
			
	    	<td><b>'.number_format($totalNH8).'</b></td>
            <td><b>'.number_format($totalNM8).'</b></td>
			<td><b>'.number_format($totalSH8).'</b></td>			
			<td><b>'.number_format($totalSM8).'</b></td>
			
	    	<td><b>'.number_format($totalNH9).'</b></td>
            <td><b>'.number_format($totalNM9).'</b></td>
			<td><b>'.number_format($totalSH9).'</b></td>			
			<td><b>'.number_format($totalSM9).'</b></td>
			
	    	<td><b><p style="color: '.$color_totales.';">'.number_format($total1).'</p></b></td>
            <td><b><p style="color: '.$color_totales.';">'.number_format($total2).'</p></b></td>
			<td><b><p style="color: '.$color_totales.';">'.number_format($total3).'</p></b></td>			
			<td><b><p style="color: '.$color_totales.';">'.number_format($total4).'</p></b></td>

             <td><b><p style="color: '.$color_totales.';">'.number_format($total).'</p></b></td>			
		
			</tr>';
    echo '<tr>
	        <td colspan="25"></b></td>
			</tr>';	
	echo '<tr>
	        <td colspan="25"><b><p ALIGN="center">ANALISIS</p></b></td>			
			</tr>';	
    echo '<tr>
	        <td colspan="25"><p ALIGN="right">1. Total Pacientes:</p></td>
			<td colspan="25"><p><b>'.number_format($total).'</b></p></td>			
			</tr>';	
    echo '<tr>
	        <td colspan="25"><p ALIGN="right">2. Enfermedeades mas comunes (según %):</p></td>					
			</tr>';
    echo '<tr>
	        <td colspan="25"><p ALIGN="right">3. Cantidad de Nuevos:</p></td>
			<td colspan="25"><p><b>'.number_format($total_nuevos).'</b></p></td>			
			</tr>';
    echo '<tr>
		    <td colspan="25"><p ALIGN="right">4. % Nuevos conforme a la consulta:</p></td>
			<td colspan="25"><p><b>'.number_format($total_nuevos_consulta).'</b></p></td> 			
			</tr>';				
}else{
	echo '<tr>
				<td colspan="25" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

$result->free();//LIMPIAR RESULTADO
$result_registro->free();//LIMPIAR RESULTADO
$resultF00->free();//LIMPIAR RESULTADO
$resultF10->free();//LIMPIAR RESULTADO
$resultF20->free();//LIMPIAR RESULTADO
$resultF30->free();//LIMPIAR RESULTADO
$resultF31->free();//LIMPIAR RESULTADO
$resultF32->free();//LIMPIAR RESULTADO
$resultF40->free();//LIMPIAR RESULTADO
$resultF50->free();//LIMPIAR RESULTADO
$resultF60->free();//LIMPIAR RESULTADO
$resultF70->free();//LIMPIAR RESULTADO
$resultF80->free();//LIMPIAR RESULTADO
$resultF90->free();//LIMPIAR RESULTADO
$resultF99->free();//LIMPIAR RESULTADO
$resultG40->free();//LIMPIAR RESULTADO
$resultG41->free();//LIMPIAR RESULTADO
$resultX60->free();//LIMPIAR RESULTADO
$resultX70->free();//LIMPIAR RESULTADO
$resultX85->free();//LIMPIAR RESULTADO
$resultY00->free();//LIMPIAR RESULTADO
$resultY04->free();//LIMPIAR RESULTADO
$resultY05->free();//LIMPIAR RESULTADO
$resultY06->free();//LIMPIAR RESULTADO
$resultY07->free();//LIMPIAR RESULTADO
$resultY08->free();//LIMPIAR RESULTADO
$resultY09->free();//LIMPIAR RESULTADO
$resultT74A->free();//LIMPIAR RESULTADO
$resultT74B->free();//LIMPIAR RESULTADO
$resultT74C->free();//LIMPIAR RESULTADO
$resultAA206->free();//LIMPIAR RESULTADO
$resultAA207->free();//LIMPIAR RESULTADO
$resultAA208->free();//LIMPIAR RESULTADO
$resultAA175->free();//LIMPIAR RESULTADO
$resultAA210->free();//LIMPIAR RESULTADO
$resultZ20->free();//LIMPIAR RESULTADO
$resultZ30->free();//LIMPIAR RESULTADO
$resultZ40->free();//LIMPIAR RESULTADO
$resultZ55->free();//LIMPIAR RESULTADO
$resultZ70->free();//LIMPIAR RESULTADO
$resultZ80->free();//LIMPIAR RESULTADO
$resultNPP->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>