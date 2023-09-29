<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$unidad = $_GET['unidad'];
$servicio = $_GET['servicio'];

if($servicio==""){
	$servicio = "1,3,4,6,7,11,12,14";
}else{
	$servicio = "1,3,4,6,7,11,12,14";
}

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

$servicio_name = "C.E";

//OBTENER NOMBRE UNIDAD
$consulta_unidad = "SELECT nombre 
    FROM puesto_colaboradores 
	WHERE puesto_id = '$unidad'";
$result = $mysqli->query($consulta_unidad);
$consulta_unidad1 = $result->fetch_assoc();
$unidad_name = $consulta_unidad1['nombre'];

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

$colaborador_name = "";

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if ($servicio != "" && $unidad != ""){
    //OBTENER NOMBRE UNIDAD
    $consulta_unidad = "SELECT nombre 
	    FROM puesto_colaboradores 
		WHERE puesto_id = '$unidad'";
	$result = $mysqli->query($consulta_unidad);
    $consulta_unidad1 = $result->fetch_assoc();
    $unidad_name = $consulta_unidad1['nombre'];
	
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.patologia_id BETWEEN 1 AND 442 AND c.puesto_id = '$unidad'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad' ";
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


$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("SM03 ".strtoupper($unidad_name)); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 13
    )
));

$titulo1 = new PHPExcel_Style(); //nuevo estilo
$titulo1->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 13
    )
));

$subtitulo1 = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo1->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true
    )
));

 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$totales = new PHPExcel_Style(); //nuevo estilo
$totales->applyFromArray(
  array('font' => array( //fuente
      'bold' => true,
      'size' => 12
    ),
	'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$texto = new PHPExcel_Style(); //nuevo estilo
$texto->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$style = new PHPExcel_Style(); //nuevo estilo
$style->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => false,
      'size' => 10
    )
));
 
$other = new PHPExcel_Style(); //nuevo estilo
$other->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));
 
$bordes = new PHPExcel_Style(); //nuevo estilo
 
$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
	'alignment' => array( //alineacion
      'wrap' => true
    ),
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("SM03"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('C8'); //INMOVILIZA PANELES
//establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//fin: establecer impresion a pagina completa
 
//establecer margenes
$margin = 0.5 / 2.54; // 0.5 centimetros
$marginBottom = 1.2 / 2.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setWidth(190); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(60); //Alto
$objDrawing->setWidth(190); //Ancho
$objDrawing->setCoordinates('AK1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 7);

$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "HOSPITAL SAN JUAN DE DIOS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AP$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AP$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REGISTRO DE DIAGNOSTICO DE SALUD MENTAL");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AP$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AP$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "PERSONA RESPONSABLE: DR. VICTOR BORJAS");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "A$fila:B$fila");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "DEPARTAMENTO:");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "C$fila:F$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "CORTÉS");
$objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "MUNICIPIO:");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "I$fila:K$fila");
$objPHPExcel->getActiveSheet()->mergeCells("I$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "SAN PEDRO SULA CORTÉS");
$objPHPExcel->getActiveSheet()->mergeCells("L$fila:R$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", "AREA/RIM:");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "S$fila:V$fila");
$objPHPExcel->getActiveSheet()->mergeCells("S$fila:V$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", "TIPO DE ESTABLEC:");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "W$fila:Z$fila");
$objPHPExcel->getActiveSheet()->mergeCells("W$fila:Z$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", "US:");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "AC$fila:AD$fila");
$objPHPExcel->getActiveSheet()->mergeCells("AA$fila:AC$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", "CODIGO:");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "AD$fila:AE$fila");
$objPHPExcel->getActiveSheet()->mergeCells("AD$fila:AE$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", "85499");
$objPHPExcel->getActiveSheet()->mergeCells("AF$fila:AG$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", "SM3-07");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "AH$fila:AI$fila");
$objPHPExcel->getActiveSheet()->mergeCells("AH$fila:AI$fila"); //unir celdas

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "PERSONAL DE SALUD: ____________________________");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Desde: $mes $año Hasta: $mes1 $año2.  SERVICIO: ".strtoupper($servicio_name).' '.strtoupper($unidad_name));
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:S$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AP$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10); 
$objPHPExcel->getActiveSheet()->mergeCells("A5:A7"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ENFERMEDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(75);
$objPHPExcel->getActiveSheet()->mergeCells("B5:B7"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'MENOR 1 AÑO');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("C5:F5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '1-4 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("G5:J5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '5-9 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("K5:N5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("M$fila:N$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '10-14 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("O5:R5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("O$fila:P$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("Q$fila:R$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '15-19 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("S5:V5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("S$fila:T$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("U$fila:V$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '20-24 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("W5:Z5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("W$fila:X$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("Y$fila:Z$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", '25-39 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("AA5:AD5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AA$fila:AB$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AC$fila:AD$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", '40-59 AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("AE5:AH5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AE$fila:AF$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AG$fila:AH$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", '60 y MAS AÑOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("AI5:AL5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AI$fila:AJ$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AK$fila:AL$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(5);

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("AM5:AP5"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", '1er. Vez');
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AM$fila:AN$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(5);
$fila -=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", 'Subs.');
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(10);
$objPHPExcel->getActiveSheet()->mergeCells("AO$fila:AP$fila"); //unir celdas
$fila +=1;
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", 'H');
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", 'M');
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(5);

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A5:AP7");
$objPHPExcel->getActiveSheet()->getStyle("A5:AP6")->getFont()->setBold(true); //negrita*/

$fila=7;


//rellenar con contenido
$valor = 1;
$totalnh1 = 0; $totalnm1 = 0; $totalsh1 = 0; $totalsm1 = 0; $totalnh2 = 0; $totalnm2 = 0; $totalsh2 = 0; $totalsm2 = 0;
$totalnh3 = 0; $totalnm3 = 0; $totalsh3 = 0; $totalsm3 = 0; $totalnh4 = 0; $totalnm4 = 0; $totalsh4 = 0; $totalsm4 = 0; $totalnh5 = 0; $totalnm5 = 0; $totalsh5 = 0; $totalsm5 = 0;
$totalnh6 = 0; $totalnm6 = 0; $totalsh6 = 0; $totalsm6 = 0; $totalnh7 = 0; $totalnm7 = 0; $totalsh7 = 0; $totalsm7 = 0; $totalnh8 = 0; $totalnm8 = 0; $totalsh8 = 0; $totalsm8 = 0;
$totalnh9 = 0; $totalnm9 = 0; $totalsh9 = 0; $totalsm9 = 0; $total = 0; $total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $totalnuevos = 0;

if($result->num_rows>0){
	if($resultF00->num_rows>0){
		while($registroF00_1 = $resultF00->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF00_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF00_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF00_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF00_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF00_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF00_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF00_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF00_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF00_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF00_1['SM2']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF00_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF00_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF00_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF00_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF00_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF00_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF00_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF00_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF00_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF00_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF00_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF00_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF00_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF00_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF00_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF00_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF00_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF00_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF00_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF00_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF00_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF00_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF00_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF00_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF00_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF00_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF00_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF00_1['SM9']);		   
		   
		   $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF00_1['Total1']);
		   $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF00_1['Total2']);
		   $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF00_1['Total3']);
		   $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF00_1['Total4']);
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
	   
	       $valor++;		   
		   $totalnh1 += $registroF00_1['NH1'];
		   $totalnm1 += $registroF00_1['NM1'];
		   $totalsh1 += $registroF00_1['SH1'];
		   $totalsm1 += $registroF00_1['SM1'];
		   
		   $totalnh2 += $registroF00_1['NH2'];
		   $totalnm2 += $registroF00_1['NM2'];
		   $totalsh2 += $registroF00_1['SH2'];
		   $totalsm2 += $registroF00_1['SM2'];

		   $totalnh3 += $registroF00_1['NH3'];
		   $totalnm3 += $registroF00_1['NM3'];
		   $totalsh3 += $registroF00_1['SH3'];
		   $totalsm3 += $registroF00_1['SM3'];

		   $totalnh4 += $registroF00_1['NH4'];
		   $totalnm4 += $registroF00_1['NM4'];
		   $totalsh4 += $registroF00_1['SH4'];
		   $totalsm4 += $registroF00_1['SM4'];

		   $totalnh5 += $registroF00_1['NH5'];
		   $totalnm5 += $registroF00_1['NM5'];
		   $totalsh5 += $registroF00_1['SH5'];
		   $totalsm5 += $registroF00_1['SM5'];

		   $totalnh6 += $registroF00_1['NH6'];
		   $totalnm6 += $registroF00_1['NM6'];
		   $totalsh6 += $registroF00_1['SH6'];
		   $totalsm6 += $registroF00_1['SM6'];

		   $totalnh7 += $registroF00_1['NH7'];
		   $totalnm7 += $registroF00_1['NM7'];
		   $totalsh7 += $registroF00_1['SH7'];
		   $totalsm7 += $registroF00_1['SM7'];

		   $totalnh8 += $registroF00_1['NH8'];
		   $totalnm8 += $registroF00_1['NM8'];
		   $totalsh8 += $registroF00_1['SH8'];
		   $totalsm8 += $registroF00_1['SM8'];

		   $totalnh9 += $registroF00_1['NH9'];
		   $totalnm9 += $registroF00_1['NM9'];
		   $totalsh9 += $registroF00_1['SH9'];
		   $totalsm9 += $registroF00_1['SM9'];

		   $total1 += $registroF00_1['Total1'];
		   $total2 += $registroF00_1['Total2'];
		   $total3 += $registroF00_1['Total3'];
		   $total4 += $registroF00_1['Total4'];		

		   $total += $registroF00_1['Total'];				   
     }	
   }	
   
 	if($resultF10->num_rows>0){
		while($registroF10_1 = $resultF10->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF10_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF10_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF10_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF10_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF10_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF10_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF10_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF10_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF10_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF10_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF10_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF10_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF10_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF10_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF10_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF10_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF10_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF10_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF10_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF10_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF10_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF10_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF10_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF10_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF10_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF10_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF10_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF10_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF10_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF10_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF10_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF10_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF10_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF10_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF10_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF10_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF10_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF10_1['SM9']);		   
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF10_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF10_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF10_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF10_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF10_1['NH1'];
		   $totalnm1 += $registroF10_1['NM1'];
		   $totalsh1 += $registroF10_1['SH1'];
		   $totalsm1 += $registroF10_1['SM1'];
		   
		   $totalnh2 += $registroF10_1['NH2'];
		   $totalnm2 += $registroF10_1['NM2'];
		   $totalsh2 += $registroF10_1['SH2'];
		   $totalsm2 += $registroF10_1['SM2'];

		   $totalnh3 += $registroF10_1['NH3'];
		   $totalnm3 += $registroF10_1['NM3'];
		   $totalsh3 += $registroF10_1['SH3'];
		   $totalsm3 += $registroF10_1['SM3'];

		   $totalnh4 += $registroF10_1['NH4'];
		   $totalnm4 += $registroF10_1['NM4'];
		   $totalsh4 += $registroF10_1['SH4'];
		   $totalsm4 += $registroF10_1['SM4'];

		   $totalnh5 += $registroF10_1['NH5'];
		   $totalnm5 += $registroF10_1['NM5'];
		   $totalsh5 += $registroF10_1['SH5'];
		   $totalsm5 += $registroF10_1['SM5'];

		   $totalnh6 += $registroF10_1['NH6'];
		   $totalnm6 += $registroF10_1['NM6'];
		   $totalsh6 += $registroF10_1['SH6'];
		   $totalsm6 += $registroF10_1['SM6'];

		   $totalnh7 += $registroF10_1['NH7'];
		   $totalnm7 += $registroF10_1['NM7'];
		   $totalsh7 += $registroF10_1['SH7'];
		   $totalsm7 += $registroF10_1['SM7'];

		   $totalnh8 += $registroF10_1['NH8'];
		   $totalnm8 += $registroF10_1['NM8'];
		   $totalsh8 += $registroF10_1['SH8'];
		   $totalsm8 += $registroF10_1['SM8'];

		   $totalnh9 += $registroF10_1['NH9'];
		   $totalnm9 += $registroF10_1['NM9'];
		   $totalsh9 += $registroF10_1['SH9'];
		   $totalsm9 += $registroF10_1['SM9'];		   
		   
		   $total1 += $registroF10_1['Total1'];	
		   $total2 += $registroF10_1['Total2'];	
		   $total3 += $registroF10_1['Total3'];	
		   $total4 += $registroF10_1['Total4'];			   
		   
		   $total += $registroF10_1['Total'];			   
     }	
   }	

	if($resultF20->num_rows>0){
		while($registroF20_1 = $resultF20->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF20_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF20_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF20_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF20_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF20_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF20_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF20_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF20_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF20_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF20_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF20_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF20_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF20_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF20_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF20_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF20_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF20_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF20_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF20_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF20_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF20_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF20_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF20_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF20_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF20_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF20_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF20_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF20_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF20_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF20_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF20_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF20_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF20_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF20_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF20_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF20_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF20_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF20_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF20_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF20_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF20_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF20_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita		   
		   
	       $valor++;
		   $totalnh1 += $registroF20_1['NH1'];
		   $totalnm1 += $registroF20_1['NM1'];
		   $totalsh1 += $registroF20_1['SH1'];
		   $totalsm1 += $registroF20_1['SM1'];

		   $totalnh2 += $registroF20_1['NH2'];
		   $totalnm2 += $registroF20_1['NM2'];
		   $totalsh2 += $registroF20_1['SH2'];
		   $totalsm2 += $registroF20_1['SM2'];

		   $totalnh3 += $registroF20_1['NH3'];
		   $totalnm3 += $registroF20_1['NM3'];
		   $totalsh3 += $registroF20_1['SH3'];
		   $totalsm3 += $registroF20_1['SM3'];

		   $totalnh4 += $registroF20_1['NH4'];
		   $totalnm4 += $registroF20_1['NM4'];
		   $totalsh4 += $registroF20_1['SH4'];
		   $totalsm4 += $registroF20_1['SM4'];

		   $totalnh5 += $registroF20_1['NH5'];
		   $totalnm5 += $registroF20_1['NM5'];
		   $totalsh5 += $registroF20_1['SH5'];
		   $totalsm5 += $registroF20_1['SM5'];

		   $totalnh6 += $registroF20_1['NH6'];
		   $totalnm6 += $registroF20_1['NM6'];
		   $totalsh6 += $registroF20_1['SH6'];
		   $totalsm6 += $registroF20_1['SM6'];

		   $totalnh7 += $registroF20_1['NH7'];
		   $totalnm7 += $registroF20_1['NM7'];
		   $totalsh7 += $registroF20_1['SH7'];
		   $totalsm7 += $registroF20_1['SM7'];

		   $totalnh8 += $registroF20_1['NH8'];
		   $totalnm8 += $registroF20_1['NM8'];
		   $totalsh8 += $registroF20_1['SH8'];
		   $totalsm8 += $registroF20_1['SM8'];

		   $totalnh9 += $registroF20_1['NH9'];
		   $totalnm9 += $registroF20_1['NM9'];
		   $totalsh9 += $registroF20_1['SH9'];
		   $totalsm9 += $registroF20_1['SM9'];		   
		   
		   $total1 += $registroF20_1['Total1'];
           $total2 += $registroF20_1['Total2'];		   
		   $total3 += $registroF20_1['Total3'];
		   $total4 += $registroF20_1['Total4'];
		   
		   $total += $registroF20_1['Total'];		   
     }	
   }	

	if($resultF30->num_rows>0){
		while($registroF30_1 = $resultF30->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF30_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF30_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF30_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF30_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF30_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF30_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF30_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF30_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF30_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF30_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF30_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF30_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF30_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF30_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF30_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF30_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF30_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF30_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF30_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF30_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF30_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF30_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF30_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF30_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF30_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF30_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF30_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF30_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF30_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF30_1['SM7']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF30_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF30_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF30_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF30_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF30_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF30_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF30_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF30_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF30_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF30_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF30_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF30_1['Total4']);		   
	
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF30_1['NH1'];
		   $totalnm1 += $registroF30_1['NM1'];
		   $totalsh1 += $registroF30_1['SH1'];
		   $totalsm1 += $registroF30_1['SM1'];

		   $totalnh2 += $registroF30_1['NH2'];
		   $totalnm2 += $registroF30_1['NM2'];
		   $totalsh2 += $registroF30_1['SH2'];
		   $totalsm2 += $registroF30_1['SM2'];

		   $totalnh3 += $registroF30_1['NH3'];
		   $totalnm3 += $registroF30_1['NM3'];
		   $totalsh3 += $registroF30_1['SH3'];
		   $totalsm3 += $registroF30_1['SM3'];

		   $totalnh4 += $registroF30_1['NH4'];
		   $totalnm4 += $registroF30_1['NM4'];
		   $totalsh4 += $registroF30_1['SH4'];
		   $totalsm4 += $registroF30_1['SM4'];

		   $totalnh5 += $registroF30_1['NH5'];
		   $totalnm5 += $registroF30_1['NM5'];
		   $totalsh5 += $registroF30_1['SH5'];
		   $totalsm5 += $registroF30_1['SM5'];

		   $totalnh6 += $registroF30_1['NH6'];
		   $totalnm6 += $registroF30_1['NM6'];
		   $totalsh6 += $registroF30_1['SH6'];
		   $totalsm6 += $registroF30_1['SM6'];

		   $totalnh7 += $registroF30_1['NH7'];
		   $totalnm7 += $registroF30_1['NM7'];
		   $totalsh7 += $registroF30_1['SH7'];
		   $totalsm7 += $registroF30_1['SM7'];

		   $totalnh8 += $registroF30_1['NH8'];
		   $totalnm8 += $registroF30_1['NM8'];
		   $totalsh8 += $registroF30_1['SH8'];
		   $totalsm8 += $registroF30_1['SM8'];

		   $totalnh9 += $registroF30_1['NH9'];
		   $totalnm9 += $registroF30_1['NM9'];
		   $totalsh9 += $registroF30_1['SH9'];
		   $totalsm9 += $registroF30_1['SM9'];		   
		   
		   $total1 += $registroF30_1['Total1'];
		   $total2 += $registroF30_1['Total2'];
		   $total3 += $registroF30_1['Total3'];
		   $total4 += $registroF30_1['Total4'];		   
		   
		   $total += $registroF30_1['Total'];		   		   
     }	
   }	

	if($resultF31->num_rows>0){
		while($registroF31_1 = $resultF31->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF31_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF31_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF31_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF31_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF31_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF31_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF31_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF31_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF31_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF31_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF31_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF31_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF31_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF31_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF31_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF31_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF31_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF31_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF31_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF31_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF31_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF31_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF31_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF31_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF31_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF31_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF31_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF31_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF31_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF31_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF31_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF31_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF31_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF31_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF31_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF31_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF31_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF31_1['SM9']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF31_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF31_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF31_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF31_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF31_1['NH1'];
		   $totalnm1 += $registroF31_1['NM1'];
		   $totalsh1 += $registroF31_1['SH1'];
		   $totalsm1 += $registroF31_1['SM1'];

		   $totalnh2 += $registroF31_1['NH2'];
		   $totalnm2 += $registroF31_1['NM2'];
		   $totalsh2 += $registroF31_1['SH2'];
		   $totalsm2 += $registroF31_1['SM2'];

		   $totalnh3 += $registroF31_1['NH3'];
		   $totalnm3 += $registroF31_1['NM3'];
		   $totalsh3 += $registroF31_1['SH3'];
		   $totalsm3 += $registroF31_1['SM3'];

		   $totalnh4 += $registroF31_1['NH4'];
		   $totalnm4 += $registroF31_1['NM4'];
		   $totalsh4 += $registroF31_1['SH4'];
		   $totalsm4 += $registroF31_1['SM4'];
		   
		   $totalnh5 += $registroF31_1['NH5'];
		   $totalnm5 += $registroF31_1['NM5'];
		   $totalsh5 += $registroF31_1['SH5'];
		   $totalsm5 += $registroF31_1['SM5'];

		   $totalnh6 += $registroF31_1['NH6'];
		   $totalnm6 += $registroF31_1['NM6'];
		   $totalsh6 += $registroF31_1['SH6'];
		   $totalsm6 += $registroF31_1['SM6'];

		   $totalnh7 += $registroF31_1['NH7'];
		   $totalnm7 += $registroF31_1['NM7'];
		   $totalsh7 += $registroF31_1['SH7'];
		   $totalsm7 += $registroF31_1['SM7'];

		   $totalnh8 += $registroF31_1['NH8'];
		   $totalnm8 += $registroF31_1['NM8'];
		   $totalsh8 += $registroF31_1['SH8'];
		   $totalsm8 += $registroF31_1['SM8'];

		   $totalnh9 += $registroF31_1['NH9'];
		   $totalnm9 += $registroF31_1['NM9'];
		   $totalsh9 += $registroF31_1['SH9'];
		   $totalsm9 += $registroF31_1['SM9'];		   
		   
		   $total1 += $registroF31_1['Total1'];
		   $total2 += $registroF31_1['Total2'];
		   $total3 += $registroF31_1['Total3'];
		   $total4 += $registroF31_1['Total4'];	

		   $total += $registroF31_1['Total'];			   
     }	
   }	

	if($resultF32->num_rows>0){
		while($registroF32_1 = $resultF32->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF32_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF32_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF32_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF32_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF32_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF32_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF32_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF32_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF32_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF32_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF32_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF32_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF32_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF32_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF32_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF32_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF32_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF32_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF32_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF32_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF32_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF32_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF32_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF32_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF32_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF32_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF32_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF32_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF32_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF32_1['SM7']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF32_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF32_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF32_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF32_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF32_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF32_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF32_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF32_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF32_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF32_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF32_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF32_1['Total4']);
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF32_1['NH1'];
		   $totalnm1 += $registroF32_1['NM1'];
		   $totalsh1 += $registroF32_1['SH1'];
		   $totalsm1 += $registroF32_1['SM1'];

		   $totalnh2 += $registroF32_1['NH2'];
		   $totalnm2 += $registroF32_1['NM2'];
		   $totalsh2 += $registroF32_1['SH2'];
		   $totalsm2 += $registroF32_1['SM2'];

		   $totalnh3 += $registroF32_1['NH3'];
		   $totalnm3 += $registroF32_1['NM3'];
		   $totalsh3 += $registroF32_1['SH3'];
		   $totalsm3 += $registroF32_1['SM3'];

		   $totalnh4 += $registroF32_1['NH4'];
		   $totalnm4 += $registroF32_1['NM4'];
		   $totalsh4 += $registroF32_1['SH4'];
		   $totalsm4 += $registroF32_1['SM4'];

		   $totalnh5 += $registroF32_1['NH5'];
		   $totalnm5 += $registroF32_1['NM5'];
		   $totalsh5 += $registroF32_1['SH5'];
		   $totalsm5 += $registroF32_1['SM5'];

		   $totalnh6 += $registroF32_1['NH6'];
		   $totalnm6 += $registroF32_1['NM6'];
		   $totalsh6 += $registroF32_1['SH6'];
		   $totalsm6 += $registroF32_1['SM6'];

		   $totalnh7 += $registroF32_1['NH7'];
		   $totalnm7 += $registroF32_1['NM7'];
		   $totalsh7 += $registroF32_1['SH7'];
		   $totalsm7 += $registroF32_1['SM7'];

		   $totalnh8 += $registroF32_1['NH8'];
		   $totalnm8 += $registroF32_1['NM8'];
		   $totalsh8 += $registroF32_1['SH8'];
		   $totalsm8 += $registroF32_1['SM8'];

		   $totalnh9 += $registroF32_1['NH9'];
		   $totalnm9 += $registroF32_1['NM9'];
		   $totalsh9 += $registroF32_1['SH9'];
		   $totalsm9 += $registroF32_1['SM9'];		   
		   
		   $total1 += $registroF32_1['Total1'];
		   $total2 += $registroF32_1['Total2'];
		   $total3 += $registroF32_1['Total3'];
		   $total4 += $registroF32_1['Total4'];	

		   $total += $registroF32_1['Total'];			   
     }	
   }	

	if($resultF40->num_rows>0){
		while($registroF40_1 = $resultF40->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF40_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF40_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF40_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF40_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF40_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF40_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF40_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF40_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF40_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF40_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF40_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF40_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF40_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF40_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF40_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF40_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF40_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF40_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF40_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF40_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF40_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF40_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF40_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF40_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF40_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF40_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF40_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF40_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF40_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF40_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF40_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF40_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF40_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF40_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF40_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF40_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF40_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF40_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF40_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF40_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF40_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF40_1['Total4']);		   
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF40_1['NH1'];
		   $totalnm1 += $registroF40_1['NM1'];
		   $totalsh1 += $registroF40_1['SH1'];
		   $totalsm1 += $registroF40_1['SM1'];

		   $totalnh2 += $registroF40_1['NH2'];
		   $totalnm2 += $registroF40_1['NM2'];
		   $totalsh2 += $registroF40_1['SH2'];
		   $totalsm2 += $registroF40_1['SM2'];

		   $totalnh3 += $registroF40_1['NH3'];
		   $totalnm3 += $registroF40_1['NM3'];
		   $totalsh3 += $registroF40_1['SH3'];
		   $totalsm3 += $registroF40_1['SM3'];

		   $totalnh4 += $registroF40_1['NH4'];
		   $totalnm4 += $registroF40_1['NM4'];
		   $totalsh4 += $registroF40_1['SH4'];
		   $totalsm4 += $registroF40_1['SM4'];

		   $totalnh5 += $registroF40_1['NH5'];
		   $totalnm5 += $registroF40_1['NM5'];
		   $totalsh5 += $registroF40_1['SH5'];
		   $totalsm5 += $registroF40_1['SM5'];

		   $totalnh6 += $registroF40_1['NH6'];
		   $totalnm6 += $registroF40_1['NM6'];
		   $totalsh6 += $registroF40_1['SH6'];
		   $totalsm6 += $registroF40_1['SM6'];

		   $totalnh7 += $registroF40_1['NH7'];
		   $totalnm7 += $registroF40_1['NM7'];
		   $totalsh7 += $registroF40_1['SH7'];
		   $totalsm7 += $registroF40_1['SM7'];

		   $totalnh8 += $registroF40_1['NH8'];
		   $totalnm8 += $registroF40_1['NM8'];
		   $totalsh8 += $registroF40_1['SH8'];
		   $totalsm8 += $registroF40_1['SM8'];

		   $totalnh9 += $registroF40_1['NH9'];
		   $totalnm9 += $registroF40_1['NM9'];
		   $totalsh9 += $registroF40_1['SH9'];
		   $totalsm9 += $registroF40_1['SM9'];		   
		   
		   $total1 += $registroF40_1['Total1'];
		   $total2 += $registroF40_1['Total2'];
		   $total3 += $registroF40_1['Total3'];
		   $total4 += $registroF40_1['Total4'];	

		   $total += $registroF40_1['Total'];			   
     }	
   }	

	if($resultF50->num_rows>0){
		while($registroF50_1 = $resultF50->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF50_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF50_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF50_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF50_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF50_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF50_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF50_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF50_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF50_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF50_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF50_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF50_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF50_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF50_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF50_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF50_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF50_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF50_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF50_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF50_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF50_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF50_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF50_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF50_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF50_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF50_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF50_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF50_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF50_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF50_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF50_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF50_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF50_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF50_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF50_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF50_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF50_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF50_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF50_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF50_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF50_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF50_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;

		   $totalnh1 += $registroF50_1['NH1'];
		   $totalnm1 += $registroF50_1['NM1'];
		   $totalsh1 += $registroF50_1['SH1'];
		   $totalsm1 += $registroF50_1['SM1'];

		   $totalnh2 += $registroF50_1['NH2'];
		   $totalnm2 += $registroF50_1['NM2'];
		   $totalsh2 += $registroF50_1['SH2'];
		   $totalsm2 += $registroF50_1['SM2'];

		   $totalnh3 += $registroF50_1['NH3'];
		   $totalnm3 += $registroF50_1['NM3'];
		   $totalsh3 += $registroF50_1['SH3'];
		   $totalsm3 += $registroF50_1['SM3'];

		   $totalnh4 += $registroF50_1['NH4'];
		   $totalnm4 += $registroF50_1['NM4'];
		   $totalsh4 += $registroF50_1['SH4'];
		   $totalsm4 += $registroF50_1['SM4'];

		   $totalnh5 += $registroF50_1['NH5'];
		   $totalnm5 += $registroF50_1['NM5'];
		   $totalsh5 += $registroF50_1['SH5'];
		   $totalsm5 += $registroF50_1['SM5'];

		   $totalnh6 += $registroF50_1['NH6'];
		   $totalnm6 += $registroF50_1['NM6'];
		   $totalsh6 += $registroF50_1['SH6'];
		   $totalsm6 += $registroF50_1['SM6'];

		   $totalnh7 += $registroF50_1['NH7'];
		   $totalnm7 += $registroF50_1['NM7'];
		   $totalsh7 += $registroF50_1['SH7'];
		   $totalsm7 += $registroF50_1['SM7'];

		   $totalnh8 += $registroF50_1['NH8'];
		   $totalnm8 += $registroF50_1['NM8'];
		   $totalsh8 += $registroF50_1['SH8'];
		   $totalsm8 += $registroF50_1['SM8'];

		   $totalnh9 += $registroF50_1['NH9'];
		   $totalnm9 += $registroF50_1['NM9'];
		   $totalsh9 += $registroF50_1['SH9'];
		   $totalsm9 += $registroF50_1['SM9'];		   
		   
		   $total1 += $registroF50_1['Total1'];
		   $total2 += $registroF50_1['Total2'];
		   $total3 += $registroF50_1['Total3'];
		   $total4 += $registroF50_1['Total4'];

		   $total += $registroF50_1['Total'];		   
     }	
   }	

	if($resultF60->num_rows>0){
		while($registroF60_1 = $resultF60->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF60_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF60_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF60_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF60_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF60_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF60_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF60_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF60_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF60_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF60_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF60_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF60_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF60_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF60_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF60_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF60_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF60_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF60_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF60_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF60_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF60_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF60_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF60_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF60_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF60_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF60_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF60_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF60_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF60_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF60_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF60_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF60_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF60_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF60_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF60_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF60_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF60_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF60_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF60_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF60_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF60_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF60_1['Total4']);	
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF60_1['NH1'];
		   $totalnm1 += $registroF60_1['NM1'];
		   $totalsh1 += $registroF60_1['SH1'];
		   $totalsm1 += $registroF60_1['SM1'];		   

		   $totalnh2 += $registroF60_1['NH2'];
		   $totalnm2 += $registroF60_1['NM2'];
		   $totalsh2 += $registroF60_1['SH2'];
		   $totalsm2 += $registroF60_1['SM2'];

		   $totalnh3 += $registroF60_1['NH3'];
		   $totalnm3 += $registroF60_1['NM3'];
		   $totalsh3 += $registroF60_1['SH3'];
		   $totalsm3 += $registroF60_1['SM3'];

		   $totalnh4 += $registroF60_1['NH4'];
		   $totalnm4 += $registroF60_1['NM4'];
		   $totalsh4 += $registroF60_1['SH4'];
		   $totalsm4 += $registroF60_1['SM4'];

		   $totalnh5 += $registroF60_1['NH5'];
		   $totalnm5 += $registroF60_1['NM5'];
		   $totalsh5 += $registroF60_1['SH5'];
		   $totalsm5 += $registroF60_1['SM5'];

		   $totalnh6 += $registroF60_1['NH6'];
		   $totalnm6 += $registroF60_1['NM6'];
		   $totalsh6 += $registroF60_1['SH6'];
		   $totalsm6 += $registroF60_1['SM6'];

		   $totalnh7 += $registroF60_1['NH7'];
		   $totalnm7 += $registroF60_1['NM7'];
		   $totalsh7 += $registroF60_1['SH7'];
		   $totalsm7 += $registroF60_1['SM7'];

		   $totalnh8 += $registroF60_1['NH8'];
		   $totalnm8 += $registroF60_1['NM8'];
		   $totalsh8 += $registroF60_1['SH8'];
		   $totalsm8 += $registroF60_1['SM8'];

		   $totalnh9 += $registroF60_1['NH9'];
		   $totalnm9 += $registroF60_1['NM9'];
		   $totalsh9 += $registroF60_1['SH9'];
		   $totalsm9 += $registroF60_1['SM9'];
		   
		   $total1 += $registroF60_1['Total1'];
		   $total2 += $registroF60_1['Total2'];
		   $total3 += $registroF60_1['Total3'];
		   $total4 += $registroF60_1['Total4'];

		   $total += $registroF60_1['Total'];		   
     }	
   }	

	if($resultF70->num_rows>0){
		while($registroF70_1 = $resultF70->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF70_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF70_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF70_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF70_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF70_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF70_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF70_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF70_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF70_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF70_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF70_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF70_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF70_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF70_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF70_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF70_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF70_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF70_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF70_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF70_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF70_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF70_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF70_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF70_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF70_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF70_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF70_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF70_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF70_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF70_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF70_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF70_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF70_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF70_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF70_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF70_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF70_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF70_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF70_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF70_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF70_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF70_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF70_1['NH1'];
		   $totalnm1 += $registroF70_1['NM1'];
		   $totalsh1 += $registroF70_1['SH1'];
		   $totalsm1 += $registroF70_1['SM1'];
		   
		   $totalnh2 += $registroF70_1['NH2'];
		   $totalnm2 += $registroF70_1['NM2'];
		   $totalsh2 += $registroF70_1['SH2'];
		   $totalsm2 += $registroF70_1['SM2'];

		   $totalnh3 += $registroF70_1['NH3'];
		   $totalnm3 += $registroF70_1['NM3'];
		   $totalsh3 += $registroF70_1['SH3'];
		   $totalsm3 += $registroF70_1['SM3'];

		   $totalnh4 += $registroF70_1['NH4'];
		   $totalnm4 += $registroF70_1['NM4'];
		   $totalsh4 += $registroF70_1['SH4'];
		   $totalsm4 += $registroF70_1['SM4'];
		   
		   $totalnh5 += $registroF70_1['NH5'];
		   $totalnm5 += $registroF70_1['NM5'];
		   $totalsh5 += $registroF70_1['SH5'];
		   $totalsm5 += $registroF70_1['SM5'];

		   $totalnh6 += $registroF70_1['NH6'];
		   $totalnm6 += $registroF70_1['NM6'];
		   $totalsh6 += $registroF70_1['SH6'];
		   $totalsm6 += $registroF70_1['SM6'];

		   $totalnh7 += $registroF70_1['NH7'];
		   $totalnm7 += $registroF70_1['NM7'];
		   $totalsh7 += $registroF70_1['SH7'];
		   $totalsm7 += $registroF70_1['SM7'];

		   $totalnh8 += $registroF70_1['NH8'];
		   $totalnm8 += $registroF70_1['NM8'];
		   $totalsh8 += $registroF70_1['SH8'];
		   $totalsm8 += $registroF70_1['SM8'];

		   $totalnh9 += $registroF70_1['NH9'];
		   $totalnm9 += $registroF70_1['NM9'];
		   $totalsh9 += $registroF70_1['SH9'];
		   $totalsm9 += $registroF70_1['SM9'];		   

		   $total1 += $registroF70_1['Total1'];
		   $total2 += $registroF70_1['Total2'];
		   $total3 += $registroF70_1['Total3'];
		   $total4 += $registroF70_1['Total4'];

		   $total += $registroF70_1['Total'];		   
     }	
   }	

	if($resultF80->num_rows>0){
		while($registroF80_1 = $resultF80->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF80_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF80_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF80_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF80_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF80_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF80_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF80_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF80_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF80_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF80_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF80_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF80_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF80_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF80_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF80_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF80_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF80_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF80_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF80_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF80_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF80_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF80_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF80_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF80_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF80_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF80_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF80_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF80_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF80_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF80_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF80_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF80_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF80_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF80_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF80_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF80_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF80_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF80_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF80_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF80_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF80_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF80_1['Total4']);
    
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF80_1['NH1'];
		   $totalnm1 += $registroF80_1['NM1'];
		   $totalsh1 += $registroF80_1['SH1'];
		   $totalsm1 += $registroF80_1['SM1'];

		   $totalnh2 += $registroF80_1['NH2'];
		   $totalnm2 += $registroF80_1['NM2'];
		   $totalsh2 += $registroF80_1['SH2'];
		   $totalsm2 += $registroF80_1['SM2'];
		   
		   $totalnh3 += $registroF80_1['NH3'];
		   $totalnm3 += $registroF80_1['NM3'];
		   $totalsh3 += $registroF80_1['SH3'];
		   $totalsm3 += $registroF80_1['SM3'];

		   $totalnh4 += $registroF80_1['NH4'];
		   $totalnm4 += $registroF80_1['NM4'];
		   $totalsh4 += $registroF80_1['SH4'];
		   $totalsm4 += $registroF80_1['SM4'];

		   $totalnh5 += $registroF80_1['NH5'];
		   $totalnm5 += $registroF80_1['NM5'];
		   $totalsh5 += $registroF80_1['SH5'];
		   $totalsm5 += $registroF80_1['SM5'];

		   $totalnh6 += $registroF80_1['NH6'];
		   $totalnm6 += $registroF80_1['NM6'];
		   $totalsh6 += $registroF80_1['SH6'];
		   $totalsm6 += $registroF80_1['SM6'];

		   $totalnh7 += $registroF80_1['NH7'];
		   $totalnm7 += $registroF80_1['NM7'];
		   $totalsh7 += $registroF80_1['SH7'];
		   $totalsm7 += $registroF80_1['SM7'];

		   $totalnh8 += $registroF80_1['NH8'];
		   $totalnm8 += $registroF80_1['NM8'];
		   $totalsh8 += $registroF80_1['SH8'];
		   $totalsm8 += $registroF80_1['SM8'];

		   $totalnh9 += $registroF80_1['NH9'];
		   $totalnm9 += $registroF80_1['NM9'];
		   $totalsh9 += $registroF80_1['SH9'];
		   $totalsm9 += $registroF80_1['SM9'];		   
		   
		   $total1 += $registroF80_1['Total1'];
		   $total2 += $registroF80_1['Total2'];
		   $total3 += $registroF80_1['Total3'];
		   $total4 += $registroF80_1['Total4'];

		   $total += $registroF80_1['Total'];		   
     }	
   }	

	if($resultF90->num_rows>0){
		while($registroF90_1 = $resultF90->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF90_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF90_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF90_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF90_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF90_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF90_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF90_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF90_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF90_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF90_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF90_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF90_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF90_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF90_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF90_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF90_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF90_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF90_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF90_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF90_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF90_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF90_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF90_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF90_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF90_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF90_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF90_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF90_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF90_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF90_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF90_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF90_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF90_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF90_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF90_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF90_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF90_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF90_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF90_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF90_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF90_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF90_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;

		   $totalnh1 += $registroF90_1['NH1'];
		   $totalnm1 += $registroF90_1['NM1'];
		   $totalsh1 += $registroF90_1['SH1'];
		   $totalsm1 += $registroF90_1['SM1'];

		   $totalnh2 += $registroF90_1['NH2'];
		   $totalnm2 += $registroF90_1['NM2'];
		   $totalsh2 += $registroF90_1['SH2'];
		   $totalsm2 += $registroF90_1['SM2'];

		   $totalnh3 += $registroF90_1['NH3'];
		   $totalnm3 += $registroF90_1['NM3'];
		   $totalsh3 += $registroF90_1['SH3'];
		   $totalsm3 += $registroF90_1['SM3'];

		   $totalnh4 += $registroF90_1['NH4'];
		   $totalnm4 += $registroF90_1['NM4'];
		   $totalsh4 += $registroF90_1['SH4'];
		   $totalsm4 += $registroF90_1['SM4'];

		   $totalnh5 += $registroF90_1['NH5'];
		   $totalnm5 += $registroF90_1['NM5'];
		   $totalsh5 += $registroF90_1['SH5'];
		   $totalsm5 += $registroF90_1['SM5'];

		   $totalnh6 += $registroF90_1['NH6'];
		   $totalnm6 += $registroF90_1['NM6'];
		   $totalsh6 += $registroF90_1['SH6'];
		   $totalsm6 += $registroF90_1['SM6'];

		   $totalnh7 += $registroF90_1['NH7'];
		   $totalnm7 += $registroF90_1['NM7'];
		   $totalsh7 += $registroF90_1['SH7'];
		   $totalsm7 += $registroF90_1['SM7'];

		   $totalnh8 += $registroF90_1['NH8'];
		   $totalnm8 += $registroF90_1['NM8'];
		   $totalsh8 += $registroF90_1['SH8'];
		   $totalsm8 += $registroF90_1['SM8'];

		   $totalnh9 += $registroF90_1['NH9'];
		   $totalnm9 += $registroF90_1['NM9'];
		   $totalsh9 += $registroF90_1['SH9'];
		   $totalsm9 += $registroF90_1['SM9'];		   
		   
		   $total1 += $registroF90_1['Total1'];
		   $total2 += $registroF90_1['Total2'];
		   $total3 += $registroF90_1['Total3'];
		   $total4 += $registroF90_1['Total4'];	

		   $total += $registroF90_1['Total'];			   
     }	
   }	

	if($resultF99->num_rows>0){
		while($registroF99_1 = $resultF99->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF99_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF99_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF99_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF99_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF99_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF99_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF99_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroF99_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroF99_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroF99_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroF99_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroF99_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroF99_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroF99_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroF99_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroF99_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroF99_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroF99_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroF99_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroF99_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroF99_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroF99_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroF99_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroF99_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroF99_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroF99_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroF99_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroF99_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroF99_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroF99_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroF99_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroF99_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroF99_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroF99_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroF99_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroF99_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroF99_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroF99_1['SM9']);
 
           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroF99_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroF99_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroF99_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroF99_1['Total4']);		   
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroF99_1['NH1'];
		   $totalnm1 += $registroF99_1['NM1'];
		   $totalsh1 += $registroF99_1['SH1'];
		   $totalsm1 += $registroF99_1['SM1'];

		   $totalnh2 += $registroF99_1['NH2'];
		   $totalnm2 += $registroF99_1['NM2'];
		   $totalsh2 += $registroF99_1['SH2'];
		   $totalsm2 += $registroF99_1['SM2'];
		   
		   $totalnh3 += $registroF99_1['NH3'];
		   $totalnm3 += $registroF99_1['NM3'];
		   $totalsh3 += $registroF99_1['SH3'];
		   $totalsm3 += $registroF99_1['SM3'];

		   $totalnh4 += $registroF99_1['NH4'];
		   $totalnm4 += $registroF99_1['NM4'];
		   $totalsh4 += $registroF99_1['SH4'];
		   $totalsm4 += $registroF99_1['SM4'];

		   $totalnh5 += $registroF99_1['NH5'];
		   $totalnm5 += $registroF99_1['NM5'];
		   $totalsh5 += $registroF99_1['SH5'];
		   $totalsm5 += $registroF99_1['SM5'];

		   $totalnh6 += $registroF99_1['NH6'];
		   $totalnm6 += $registroF99_1['NM6'];
		   $totalsh6 += $registroF99_1['SH6'];
		   $totalsm6 += $registroF99_1['SM6'];

		   $totalnh7 += $registroF99_1['NH7'];
		   $totalnm7 += $registroF99_1['NM7'];
		   $totalsh7 += $registroF99_1['SH7'];
		   $totalsm7 += $registroF99_1['SM7'];

		   $totalnh8 += $registroF99_1['NH8'];
		   $totalnm8 += $registroF99_1['NM8'];
		   $totalsh8 += $registroF99_1['SH8'];
		   $totalsm8 += $registroF99_1['SM8'];

		   $totalnh9 += $registroF99_1['NH9'];
		   $totalnm9 += $registroF99_1['NM9'];
		   $totalsh9 += $registroF99_1['SH9'];
		   $totalsm9 += $registroF99_1['SM9'];		   
		   
		   $total1 += $registroF99_1['Total1'];
		   $total2 += $registroF99_1['Total2'];
		   $total3 += $registroF99_1['Total3'];
		   $total4 += $registroF99_1['Total4'];	

		   $total += $registroF99_1['Total'];			   
     }	
   }

	if($resultG40->num_rows>0){
		while($registroG40_1 = $resultG40->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroG40_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroG40_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroG40_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroG40_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroG40_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroG40_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroG40_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroG40_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroG40_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroG40_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroG40_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroG40_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroG40_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroG40_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroG40_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroG40_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroG40_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroG40_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroG40_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroG40_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroG40_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroG40_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroG40_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroG40_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroG40_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroG40_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroG40_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroG40_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroG40_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroG40_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroG40_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroG40_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroG40_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroG40_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroG40_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroG40_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroG40_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroG40_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroG40_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroG40_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroG40_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroG40_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroG40_1['NH1'];
		   $totalnm1 += $registroG40_1['NM1'];
		   $totalsh1 += $registroG40_1['SH1'];
		   $totalsm1 += $registroG40_1['SM1'];

		   $totalnh2 += $registroG40_1['NH2'];
		   $totalnm2 += $registroG40_1['NM2'];
		   $totalsh2 += $registroG40_1['SH2'];
		   $totalsm2 += $registroG40_1['SM2'];
		   
		   $totalnh3 += $registroG40_1['NH3'];
		   $totalnm3 += $registroG40_1['NM3'];
		   $totalsh3 += $registroG40_1['SH3'];
		   $totalsm3 += $registroG40_1['SM3'];

		   $totalnh4 += $registroG40_1['NH4'];
		   $totalnm4 += $registroG40_1['NM4'];
		   $totalsh4 += $registroG40_1['SH4'];
		   $totalsm4 += $registroG40_1['SM4'];

		   $totalnh5 += $registroG40_1['NH5'];
		   $totalnm5 += $registroG40_1['NM5'];
		   $totalsh5 += $registroG40_1['SH5'];
		   $totalsm5 += $registroG40_1['SM5'];

		   $totalnh6 += $registroG40_1['NH6'];
		   $totalnm6 += $registroG40_1['NM6'];
		   $totalsh6 += $registroG40_1['SH6'];
		   $totalsm6 += $registroG40_1['SM6'];

		   $totalnh7 += $registroG40_1['NH7'];
		   $totalnm7 += $registroG40_1['NM7'];
		   $totalsh7 += $registroG40_1['SH7'];
		   $totalsm7 += $registroG40_1['SM7'];

		   $totalnh8 += $registroG40_1['NH8'];
		   $totalnm8 += $registroG40_1['NM8'];
		   $totalsh8 += $registroG40_1['SH8'];
		   $totalsm8 += $registroG40_1['SM8'];

		   $totalnh9 += $registroG40_1['NH9'];
		   $totalnm9 += $registroG40_1['NM9'];
		   $totalsh9 += $registroG40_1['SH9'];
		   $totalsm9 += $registroG40_1['SM9'];		   
		   
		   $total1 += $registroG40_1['Total1'];
		   $total2 += $registroG40_1['Total2'];
		   $total3 += $registroG40_1['Total3'];
		   $total4 += $registroG40_1['Total4'];	

		   $total += $registroG40_1['Total'];			   
     }	
   }	
   
	if($resultG41->num_rows>0){
		while($registroG41_1 = $resultG41->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroG41_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroG41_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroG41_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroG41_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroG41_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroG41_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroG41_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroG41_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroG41_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroG41_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroG41_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroG41_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroG41_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroG41_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroG41_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroG41_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroG41_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroG41_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroG41_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroG41_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroG41_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroG41_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroG41_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroG41_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroG41_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroG41_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroG41_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroG41_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroG41_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroG41_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroG41_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroG41_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroG41_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroG41_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroG41_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroG41_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroG41_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroG41_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroG41_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroG41_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroG41_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroG41_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroG41_1['NH1'];
		   $totalnm1 += $registroG41_1['NM1'];
		   $totalsh1 += $registroG41_1['SH1'];
		   $totalsm1 += $registroG41_1['SM1'];

		   $totalnh2 += $registroG41_1['NH2'];
		   $totalnm2 += $registroG41_1['NM2'];
		   $totalsh2 += $registroG41_1['SH2'];
		   $totalsm2 += $registroG41_1['SM2'];

		   $totalnh3 += $registroG41_1['NH3'];
		   $totalnm3 += $registroG41_1['NM3'];
		   $totalsh3 += $registroG41_1['SH3'];
		   $totalsm3 += $registroG41_1['SM3'];

		   $totalnh4 += $registroG41_1['NH4'];
		   $totalnm4 += $registroG41_1['NM4'];
		   $totalsh4 += $registroG41_1['SH4'];
		   $totalsm4 += $registroG41_1['SM4'];

		   $totalnh5 += $registroG41_1['NH5'];
		   $totalnm5 += $registroG41_1['NM5'];
		   $totalsh5 += $registroG41_1['SH5'];
		   $totalsm5 += $registroG41_1['SM5'];

		   $totalnh6 += $registroG41_1['NH6'];
		   $totalnm6 += $registroG41_1['NM6'];
		   $totalsh6 += $registroG41_1['SH6'];
		   $totalsm6 += $registroG41_1['SM6'];

		   $totalnh7 += $registroG41_1['NH7'];
		   $totalnm7 += $registroG41_1['NM7'];
		   $totalsh7 += $registroG41_1['SH7'];
		   $totalsm7 += $registroG41_1['SM7'];

		   $totalnh8 += $registroG41_1['NH8'];
		   $totalnm8 += $registroG41_1['NM8'];
		   $totalsh8 += $registroG41_1['SH8'];
		   $totalsm8 += $registroG41_1['SM8'];

		   $totalnh9 += $registroG41_1['NH9'];
		   $totalnm9 += $registroG41_1['NM9'];
		   $totalsh9 += $registroG41_1['SH9'];
		   $totalsm9 += $registroG41_1['SM9'];		   
		   
		   $total1 += $registroG41_1['Total1'];
		   $total2 += $registroG41_1['Total2'];
		   $total3 += $registroG41_1['Total3'];
		   $total4 += $registroG41_1['Total4'];		   
		   
		   $total += $registroG41_1['Total'];		   
     }	
   }

	if($resultX60->num_rows>0){
		while($registroX60_1 = $resultX60->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroX60_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroX60_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroX60_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroX60_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroX60_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroX60_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroX60_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroX60_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroX60_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroX60_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroX60_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroX60_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroX60_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroX60_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroX60_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroX60_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroX60_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroX60_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroX60_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroX60_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroX60_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroX60_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroX60_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroX60_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroX60_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroX60_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroX60_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroX60_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroX60_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroX60_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroX60_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroX60_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroX60_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroX60_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroX60_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroX60_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroX60_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroX60_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroX60_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroX60_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroX60_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroX60_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroX60_1['NH1'];
		   $totalnm1 += $registroX60_1['NM1'];
		   $totalsh1 += $registroX60_1['SH1'];
		   $totalsm1 += $registroX60_1['SM1'];

		   $totalnh2 += $registroX60_1['NH2'];
		   $totalnm2 += $registroX60_1['NM2'];
		   $totalsh2 += $registroX60_1['SH2'];
		   $totalsm2 += $registroX60_1['SM2'];
		   
		   $totalnh3 += $registroX60_1['NH3'];
		   $totalnm3 += $registroX60_1['NM3'];
		   $totalsh3 += $registroX60_1['SH3'];
		   $totalsm3 += $registroX60_1['SM3'];

		   $totalnh4 += $registroX60_1['NH4'];
		   $totalnm4 += $registroX60_1['NM4'];
		   $totalsh4 += $registroX60_1['SH4'];
		   $totalsm4 += $registroX60_1['SM4'];

		   $totalnh5 += $registroX60_1['NH5'];
		   $totalnm5 += $registroX60_1['NM5'];
		   $totalsh5 += $registroX60_1['SH5'];
		   $totalsm5 += $registroX60_1['SM5'];

		   $totalnh6 += $registroX60_1['NH6'];
		   $totalnm6 += $registroX60_1['NM6'];
		   $totalsh6 += $registroX60_1['SH6'];
		   $totalsm6 += $registroX60_1['SM6'];

		   $totalnh7 += $registroX60_1['NH7'];
		   $totalnm7 += $registroX60_1['NM7'];
		   $totalsh7 += $registroX60_1['SH7'];
		   $totalsm7 += $registroX60_1['SM7'];

		   $totalnh8 += $registroX60_1['NH8'];
		   $totalnm8 += $registroX60_1['NM8'];
		   $totalsh8 += $registroX60_1['SH8'];
		   $totalsm8 += $registroX60_1['SM8'];

		   $totalnh9 += $registroX60_1['NH9'];
		   $totalnm9 += $registroX60_1['NM9'];
		   $totalsh9 += $registroX60_1['SH9'];
		   $totalsm9 += $registroX60_1['SM9'];		   
		   
		   $total1 += $registroX60_1['Total1'];
		   $total2 += $registroX60_1['Total2'];
		   $total3 += $registroX60_1['Total3'];
		   $total4 += $registroX60_1['Total4'];	

		   $total += $registroX60_1['Total'];			   
     }	
   }  

	if($resultX70->num_rows>0){
		while($registroX70_1 = $resultX70->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroX70_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroX70_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroX70_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroX70_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroX70_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroX70_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroX70_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroX70_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroX70_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroX70_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroX70_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroX70_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroX70_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroX70_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroX70_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroX70_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroX70_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroX70_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroX70_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroX70_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroX70_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroX70_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroX70_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroX70_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroX70_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroX70_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroX70_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroX70_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroX70_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroX70_1['SM7']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroX70_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroX70_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroX70_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroX70_1['SM8']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroX70_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroX70_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroX70_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroX70_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroX70_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroX70_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroX70_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroX70_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroX70_1['NH1'];
		   $totalnm1 +=  $registroX70_1['NM1'];
		   $totalsh1 += $registroX70_1['SH1'];
		   $totalsm1 += $registroX70_1['SM1'];	

		   $totalnh2 += $registroX70_1['NH2'];
		   $totalnm2 += $registroX70_1['NM2'];
		   $totalsh2 += $registroX70_1['SH2'];
		   $totalsm2 += $registroX70_1['SM2'];	

		   $totalnh3 += $registroX70_1['NH3'];
		   $totalnm3 += $registroX70_1['NM3'];
		   $totalsh3 += $registroX70_1['SH3'];
		   $totalsm3 += $registroX70_1['SM3'];	

		   $totalnh4 += $registroX70_1['NH4'];
		   $totalnm4 += $registroX70_1['NM4'];
		   $totalsh4 += $registroX70_1['SH4'];
		   $totalsm4 += $registroX70_1['SM4'];	

		   $totalnh5 += $registroX70_1['NH5'];
		   $totalnm5 += $registroX70_1['NM5'];
		   $totalsh5 += $registroX70_1['SH5'];
		   $totalsm5 += $registroX70_1['SM5'];	

		   $totalnh6 += $registroX70_1['NH6'];
		   $totalnm6 += $registroX70_1['NM6'];
		   $totalsh6 += $registroX70_1['SH6'];
		   $totalsm6 += $registroX70_1['SM6'];	

		   $totalnh7 += $registroX70_1['NH7'];
		   $totalnm7 += $registroX70_1['NM7'];
		   $totalsh7 += $registroX70_1['SH7'];
		   $totalsm7 += $registroX70_1['SM7'];	

		   $totalnh8 += $registroX70_1['NH8'];
		   $totalnm8 += $registroX70_1['NM8'];
		   $totalsh8 += $registroX70_1['SH8'];
		   $totalsm8 += $registroX70_1['SM8'];	

		   $totalnh9 += $registroX70_1['NH9'];
		   $totalnm9 += $registroX70_1['NM9'];
		   $totalsh9 += $registroX70_1['SH9'];
		   $totalsm9 += $registroX70_1['SM9'];				   
		   
		   $total1 += $registroX70_1['Total1'];
		   $total2 += $registroX70_1['Total2'];
		   $total3 += $registroX70_1['Total3'];
		   $total4 += $registroX70_1['Total4'];	

		   $total += $registroX70_1['Total'];			   
     }	
   } 

	if($resultX85->num_rows>0){
		while($registroX85_1 = $resultX85->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroX85_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroX85_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroX85_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroX85_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroX85_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroX85_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroX85_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroX85_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroX85_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroX85_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroX85_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroX85_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroX85_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroX85_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroX85_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroX85_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroX85_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroX85_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroX85_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroX85_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroX85_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroX85_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroX85_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroX85_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroX85_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroX85_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroX85_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroX85_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroX85_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroX85_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroX85_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroX85_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroX85_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroX85_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroX85_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroX85_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroX85_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroX85_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroX85_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroX85_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroX85_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroX85_1['Total4']);
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroX85_1['NH1'];
		   $totalnm1 += $registroX85_1['NM1'];
		   $totalsh1 += $registroX85_1['SH1'];
		   $totalsm1 += $registroX85_1['SM1'];	

		   $totalnh2 += $registroX85_1['NH2'];
		   $totalnm2 += $registroX85_1['NM2'];
		   $totalsh2 += $registroX85_1['SH2'];
		   $totalsm2 += $registroX85_1['SM2'];	

		   $totalnh3 += $registroX85_1['NH3'];
		   $totalnm3 += $registroX85_1['NM3'];
		   $totalsh3 += $registroX85_1['SH3'];
		   $totalsm3 += $registroX85_1['SM3'];	

		   $totalnh4 += $registroX85_1['NH4'];
		   $totalnm4 += $registroX85_1['NM4'];
		   $totalsh4 += $registroX85_1['SH4'];
		   $totalsm4 += $registroX85_1['SM4'];	

		   $totalnh5 += $registroX85_1['NH5'];
		   $totalnm5 += $registroX85_1['NM5'];
		   $totalsh5 += $registroX85_1['SH5'];
		   $totalsm5 += $registroX85_1['SM5'];	

		   $totalnh6 += $registroX85_1['NH6'];
		   $totalnm6 += $registroX85_1['NM6'];
		   $totalsh6 += $registroX85_1['SH6'];
		   $totalsm6 += $registroX85_1['SM6'];	

		   $totalnh7 += $registroX85_1['NH7'];
		   $totalnm7 += $registroX85_1['NM7'];
		   $totalsh7 += $registroX85_1['SH7'];
		   $totalsm7 += $registroX85_1['SM7'];	

		   $totalnh8 += $registroX85_1['NH8'];
		   $totalnm8 += $registroX85_1['NM8'];
		   $totalsh8 += $registroX85_1['SH8'];
		   $totalsm8 += $registroX85_1['SM8'];	

		   $totalnh9 += $registroX85_1['NH9'];
		   $totalnm9 += $registroX85_1['NM9'];
		   $totalsh9 += $registroX85_1['SH9'];
		   $totalsm9 += $registroX85_1['SM9'];	

		   $total1 += $registroX85_1['Total1'];
		   $total2 += $registroX85_1['Total2'];
		   $total3 += $registroX85_1['Total3'];
		   $total4 += $registroX85_1['Total4'];	

		   $total += $registroX85_1['Total'];			   
     }	
   }

	if($resultY00->num_rows>0){
		while($registroY00_1 = $resultY00->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY00_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY00_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY00_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY00_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY00_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY00_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY00_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY00_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY00_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY00_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY00_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY00_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY00_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY00_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY00_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY00_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY00_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY00_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY00_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY00_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY00_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY00_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY00_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY00_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY00_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY00_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY00_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY00_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY00_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY00_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY00_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY00_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY00_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY00_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY00_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY00_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY00_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY00_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY00_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY00_1['Total']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY00_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY00_1['Total']);   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY00_1['NH1'];
		   $totalnm1 += $registroY00_1['NM1'];
		   $totalsh1 += $registroY00_1['SH1'];
		   $totalsm1 += $registroY00_1['SM1'];	

		   $totalnh2 += $registroY00_1['NH2'];
		   $totalnm2 += $registroY00_1['NM2'];
		   $totalsh2 += $registroY00_1['SH2'];
		   $totalsm2 += $registroY00_1['SM2'];	

		   $totalnh3 += $registroY00_1['NH3'];
		   $totalnm3 += $registroY00_1['NM3'];
		   $totalsh3 += $registroY00_1['SH3'];
		   $totalsm3 += $registroY00_1['SM3'];	

		   $totalnh4 += $registroY00_1['NH4'];
		   $totalnm4 += $registroY00_1['NM4'];
		   $totalsh4 += $registroY00_1['SH4'];
		   $totalsm4 += $registroY00_1['SM4'];	
		   
		   $totalnh5 += $registroY00_1['NH5'];
		   $totalnm5 += $registroY00_1['NM5'];
		   $totalsh5 += $registroY00_1['SH5'];
		   $totalsm5 += $registroY00_1['SM5'];	

		   $totalnh6 += $registroY00_1['NH6'];
		   $totalnm6 += $registroY00_1['NM6'];
		   $totalsh6 += $registroY00_1['SH6'];
		   $totalsm6 += $registroY00_1['SM6'];	

		   $totalnh7 += $registroY00_1['NH7'];
		   $totalnm7 += $registroY00_1['NM7'];
		   $totalsh7 += $registroY00_1['SH7'];
		   $totalsm7 += $registroY00_1['SM7'];	

		   $totalnh8 += $registroY00_1['NH8'];
		   $totalnm8 += $registroY00_1['NM8'];
		   $totalsh8 += $registroY00_1['SH8'];
		   $totalsm8 += $registroY00_1['SM8'];	

		   $totalnh9 += $registroY00_1['NH9'];
		   $totalnm9 += $registroY00_1['NM9'];
		   $totalsh9 += $registroY00_1['SH9'];
		   $totalsm9 += $registroY00_1['SM9'];			   
		   
		   $total1 += $registroY00_1['Total1'];
		   $total2 += $registroY00_1['Total2'];
		   $total3 += $registroY00_1['Total3'];
		   $total4 += $registroY00_1['Total4'];	

		   $total += $registroY00_1['Total'];			   
     }	
   }   
   
   if($resultY04->num_rows>0){
		while($registroY04_1 = $resultY04->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY04_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY04_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY04_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY04_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY04_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY04_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY04_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY04_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY04_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY04_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY04_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY04_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY04_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY04_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY04_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY04_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY04_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY04_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY04_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY04_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY04_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY04_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY04_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY04_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY04_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY04_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY04_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY04_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY04_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY04_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY04_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY04_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY04_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY04_1['SM8']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY04_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY04_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY04_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY04_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY04_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY04_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY04_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY04_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY04_1['NH1'];
		   $totalnm1 += $registroY04_1['NM1'];
		   $totalsh1 += $registroY04_1['SH1'];
		   $totalsm1 += $registroY04_1['SM1'];
		   
		   $totalnh2 += $registroY04_1['NH2'];
		   $totalnm2 += $registroY04_1['NM2'];
		   $totalsh2 += $registroY04_1['SH2'];
		   $totalsm2 += $registroY04_1['SM2'];
		   
		   $totalnh3 += $registroY04_1['NH3'];
		   $totalnm3 += $registroY04_1['NM3'];
		   $totalsh3 += $registroY04_1['SH3'];
		   $totalsm3 += $registroY04_1['SM3'];

		   $totalnh4 += $registroY04_1['NH4'];
		   $totalnm4 += $registroY04_1['NM4'];
		   $totalsh4 += $registroY04_1['SH4'];
		   $totalsm4 += $registroY04_1['SM4'];

		   $totalnh5 += $registroY04_1['NH5'];
		   $totalnm5 += $registroY04_1['NM5'];
		   $totalsh5 += $registroY04_1['SH5'];
		   $totalsm5 += $registroY04_1['SM5'];

		   $totalnh6 += $registroY04_1['NH6'];
		   $totalnm6 += $registroY04_1['NM6'];
		   $totalsh6 += $registroY04_1['SH6'];
		   $totalsm6 += $registroY04_1['SM6'];

		   $totalnh7 += $registroY04_1['NH7'];
		   $totalnm7 += $registroY04_1['NM7'];
		   $totalsh7 += $registroY04_1['SH7'];
		   $totalsm7 += $registroY04_1['SM7'];

		   $totalnh8 += $registroY04_1['NH8'];
		   $totalnm8 += $registroY04_1['NM8'];
		   $totalsh8 += $registroY04_1['SH8'];
		   $totalsm8 += $registroY04_1['SM8'];

		   $totalnh9 += $registroY04_1['NH9'];
		   $totalnm9 += $registroY04_1['NM9'];
		   $totalsh9 += $registroY04_1['SH9'];
		   $totalsm9 += $registroY04_1['SM9'];		   

		   $total1 += $registroY04_1['Total1'];
		   $total2 += $registroY04_1['Total2'];
		   $total3 += $registroY04_1['Total3'];
		   $total4 += $registroY04_1['Total4'];

		   $total += $registroY04_1['Total'];		   
     }	
   }  

	if($resultY05->num_rows>0){
		while($registroY05_1 = $resultY05->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY05_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY05_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY05_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY05_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY05_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY05_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY05_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY05_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY05_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY05_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY05_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY05_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY05_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY05_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY05_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY05_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY05_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY05_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY05_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY05_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY05_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY05_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY05_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY05_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY05_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY05_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY05_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY05_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY05_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY05_1['SM7']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY05_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY05_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY05_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY05_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY05_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY05_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY05_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY05_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY05_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY05_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY05_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY05_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY05_1['NH1'];
		   $totalnm1 += $registroY05_1['NM1'];
		   $totalsh1 += $registroY05_1['SH1'];
		   $totalsm1 += $registroY05_1['SM1'];	

		   $totalnh2 += $registroY05_1['NH2'];
		   $totalnm2 += $registroY05_1['NM2'];
		   $totalsh2 += $registroY05_1['SH2'];
		   $totalsm2 += $registroY05_1['SM2'];	

		   $totalnh3 += $registroY05_1['NH3'];
		   $totalnm3 += $registroY05_1['NM3'];
		   $totalsh3 += $registroY05_1['SH3'];
		   $totalsm3 += $registroY05_1['SM3'];	

		   $totalnh4 += $registroY05_1['NH4'];
		   $totalnm4 += $registroY05_1['NM4'];
		   $totalsh4 += $registroY05_1['SH4'];
		   $totalsm4 += $registroY05_1['SM4'];	

		   $totalnh5 += $registroY05_1['NH5'];
		   $totalnm5 += $registroY05_1['NM5'];
		   $totalsh5 += $registroY05_1['SH5'];
		   $totalsm5 += $registroY05_1['SM5'];	

		   $totalnh6 += $registroY05_1['NH6'];
		   $totalnm6 += $registroY05_1['NM6'];
		   $totalsh6 += $registroY05_1['SH6'];
		   $totalsm6 += $registroY05_1['SM6'];	

		   $totalnh7 += $registroY05_1['NH7'];
		   $totalnm7 += $registroY05_1['NM7'];
		   $totalsh7 += $registroY05_1['SH7'];
		   $totalsm7 += $registroY05_1['SM7'];	
		   
		   $totalnh8 += $registroY05_1['NH8'];
		   $totalnm8 += $registroY05_1['NM8'];
		   $totalsh8 += $registroY05_1['SH8'];
		   $totalsm8 += $registroY05_1['SM8'];	

		   $totalnh9 += $registroY05_1['NH9'];
		   $totalnm9 += $registroY05_1['NM9'];
		   $totalsh9 += $registroY05_1['SH9'];
		   $totalsm9 += $registroY05_1['SM9'];			   
		   
		   $total1 += $registroY05_1['Total1'];
		   $total2 += $registroY05_1['Total2'];
		   $total3 += $registroY05_1['Total3'];
		   $total4 += $registroY05_1['Total4'];	

		   $total += $registroY05_1['Total'];			   
     }	
   }  

	if($resultY06->num_rows>0){
		while($registroY06_1 = $resultY06->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY06_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY06_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY06_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY06_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY06_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY06_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY06_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY06_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY06_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY06_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY06_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY06_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY06_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY06_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY06_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY06_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY06_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY06_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY06_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY06_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY06_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY06_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY06_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY06_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY06_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY06_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY06_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY06_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY06_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY06_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY06_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY06_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY06_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY06_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY06_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY06_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY06_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY06_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY06_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY06_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY06_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY06_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY06_1['NH1'];
		   $totalnm1 += $registroY06_1['NM1'];
		   $totalsh1 += $registroY06_1['SH1'];
		   $totalsm1 += $registroY06_1['SM1'];
		   
		   $totalnh2 += $registroY06_1['NH2'];
		   $totalnm2 += $registroY06_1['NM2'];
		   $totalsh2 += $registroY06_1['SH2'];
		   $totalsm2 += $registroY06_1['SM2'];

		   $totalnh3 += $registroY06_1['NH3'];
		   $totalnm3 += $registroY06_1['NM3'];
		   $totalsh3 += $registroY06_1['SH3'];
		   $totalsm3 += $registroY06_1['SM3'];

		   $totalnh4 += $registroY06_1['NH4'];
		   $totalnm4 += $registroY06_1['NM4'];
		   $totalsh4 += $registroY06_1['SH4'];
		   $totalsm4 += $registroY06_1['SM4'];

		   $totalnh5 += $registroY06_1['NH5'];
		   $totalnm5 += $registroY06_1['NM5'];
		   $totalsh5 += $registroY06_1['SH5'];
		   $totalsm5 += $registroY06_1['SM5'];

		   $totalnh6 += $registroY06_1['NH6'];
		   $totalnm6 += $registroY06_1['NM6'];
		   $totalsh6 += $registroY06_1['SH6'];
		   $totalsm6 += $registroY06_1['SM6'];

		   $totalnh7 += $registroY06_1['NH7'];
		   $totalnm7 += $registroY06_1['NM7'];
		   $totalsh7 += $registroY06_1['SH7'];
		   $totalsm7 += $registroY06_1['SM7'];

		   $totalnh8 += $registroY06_1['NH8'];
		   $totalnm8 += $registroY06_1['NM8'];
		   $totalsh8 += $registroY06_1['SH8'];
		   $totalsm8 += $registroY06_1['SM8'];

		   $totalnh9 += $registroY06_1['NH9'];
		   $totalnm9 += $registroY06_1['NM9'];
		   $totalsh9 += $registroY06_1['SH9'];
		   $totalsm9 += $registroY06_1['SM9'];		   

		   $total1 += $registroY06_1['Total1'];
		   $total2 += $registroY06_1['Total2'];
		   $total3 += $registroY06_1['Total3'];
		   $total4 += $registroY06_1['Total4'];	

		   $total += $registroY06_1['Total'];			   
     }	
   }    

	if($resultY07->num_rows>0){
		while($registroY07_1 = $resultY07->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY07_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY07_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY07_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY07_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY07_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY07_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY07_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY07_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY07_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY07_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY07_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY07_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY07_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY07_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY07_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY07_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY07_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY07_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY07_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY07_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY07_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY07_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY07_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY07_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY07_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY07_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY07_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY07_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY07_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY07_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY07_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY07_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY07_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY07_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY07_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY07_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY07_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY07_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY07_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY07_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY07_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY07_1['Total4']);		   
		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY07_1['NH1'];
		   $totalnm1 += $registroY07_1['NM1'];
		   $totalsh1 += $registroY07_1['SH1'];
		   $totalsm1 += $registroY07_1['SM1'];

		   $totalnh2 += $registroY07_1['NH2'];
		   $totalnm2 += $registroY07_1['NM2'];
		   $totalsh2 += $registroY07_1['SH2'];
		   $totalsm2 += $registroY07_1['SM2'];

		   $totalnh3 += $registroY07_1['NH3'];
		   $totalnm3 += $registroY07_1['NM3'];
		   $totalsh3 += $registroY07_1['SH3'];
		   $totalsm3 += $registroY07_1['SM3'];

		   $totalnh4 += $registroY07_1['NH4'];
		   $totalnm4 += $registroY07_1['NM4'];
		   $totalsh4 += $registroY07_1['SH4'];
		   $totalsm4 += $registroY07_1['SM4'];

		   $totalnh5 += $registroY07_1['NH5'];
		   $totalnm5 += $registroY07_1['NM5'];
		   $totalsh5 += $registroY07_1['SH5'];
		   $totalsm5 += $registroY07_1['SM5'];

		   $totalnh6 += $registroY07_1['NH6'];
		   $totalnm6 += $registroY07_1['NM6'];
		   $totalsh6 += $registroY07_1['SH6'];
		   $totalsm6 += $registroY07_1['SM6'];

		   $totalnh7 += $registroY07_1['NH7'];
		   $totalnm7 += $registroY07_1['NM7'];
		   $totalsh7 += $registroY07_1['SH7'];
		   $totalsm7 += $registroY07_1['SM7'];

		   $totalnh8 += $registroY07_1['NH8'];
		   $totalnm8 += $registroY07_1['NM8'];
		   $totalsh8 += $registroY07_1['SH8'];
		   $totalsm8 += $registroY07_1['SM8'];

		   $totalnh9 += $registroY07_1['NH9'];
		   $totalnm9 += $registroY07_1['NM9'];
		   $totalsh9 += $registroY07_1['SH9'];
		   $totalsm9 += $registroY07_1['SM9'];		   

		   $total1 += $registroY07_1['Total1'];
		   $total2 += $registroY07_1['Total2'];
		   $total3 += $registroY07_1['Total3'];
		   $total4 += $registroY07_1['Total4'];	

		   $total += $registroY07_1['Total'];			   
     }	
   }       

	if($resultY08->num_rows>0){
		while($registroY08_1 = $resultY08->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY08_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY08_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY08_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY08_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY08_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY08_1['SM1']);

           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY08_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY08_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY08_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY08_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY08_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY08_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY08_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY08_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY08_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY08_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY08_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY08_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY08_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY08_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY08_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY08_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY08_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY08_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY08_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY08_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY08_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY08_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY08_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY08_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY08_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY08_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY08_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY08_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY08_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY08_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY08_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY08_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY08_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY08_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY08_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY08_1['Total4']);		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY08_1['NH1'];
		   $totalnm1 += $registroY08_1['NM1'];
		   $totalsh1 += $registroY08_1['SH1'];
		   $totalsm1 += $registroY08_1['SM1'];
		   
		   $totalnh2 += $registroY08_1['NH2'];
		   $totalnm2 += $registroY08_1['NM2'];
		   $totalsh2 += $registroY08_1['SH2'];
		   $totalsm2 += $registroY08_1['SM2'];

		   $totalnh3 += $registroY08_1['NH3'];
		   $totalnm3 += $registroY08_1['NM3'];
		   $totalsh3 += $registroY08_1['SH3'];
		   $totalsm3 += $registroY08_1['SM3'];

		   $totalnh4 += $registroY08_1['NH4'];
		   $totalnm4 += $registroY08_1['NM4'];
		   $totalsh4 += $registroY08_1['SH4'];
		   $totalsm4 += $registroY08_1['SM4'];

		   $totalnh5 += $registroY08_1['NH5'];
		   $totalnm5 += $registroY08_1['NM5'];
		   $totalsh5 += $registroY08_1['SH5'];
		   $totalsm5 += $registroY08_1['SM5'];

		   $totalnh6 += $registroY08_1['NH6'];
		   $totalnm6 += $registroY08_1['NM6'];
		   $totalsh6 += $registroY08_1['SH6'];
		   $totalsm6 += $registroY08_1['SM6'];

		   $totalnh7 += $registroY08_1['NH7'];
		   $totalnm7 += $registroY08_1['NM7'];
		   $totalsh7 += $registroY08_1['SH7'];
		   $totalsm7 += $registroY08_1['SM7'];

		   $totalnh8 += $registroY08_1['NH8'];
		   $totalnm8 += $registroY08_1['NM8'];
		   $totalsh8 += $registroY08_1['SH8'];
		   $totalsm8 += $registroY08_1['SM8'];

		   $totalnh9 += $registroY08_1['NH9'];
		   $totalnm9 += $registroY08_1['NM9'];
		   $totalsh9 += $registroY08_1['SH9'];
		   $totalsm9 += $registroY08_1['SM9'];		   

		   $total1 += $registroY08_1['Total1'];
		   $total2 += $registroY08_1['Total2'];
		   $total3 += $registroY08_1['Total3'];
		   $total4 += $registroY08_1['Total4'];

		   $total += $registroY08_1['Total'];		   
     }	
   } 

	if($resultY09->num_rows>0){
		while($registroY09_1 = $resultY09->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY09_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY09_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY09_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY09_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY09_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY09_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY09_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroY09_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroY09_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroY09_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroY09_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroY09_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroY09_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroY09_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroY09_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroY09_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroY09_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroY09_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroY09_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroY09_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroY09_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroY09_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroY09_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroY09_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroY09_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroY09_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroY09_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroY09_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroY09_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroY09_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroY09_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroY09_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroY09_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroY09_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroY09_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroY09_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroY09_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroY09_1['SM9']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroY09_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroY09_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroY09_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroY09_1['Total4']);		   
		   				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroY09_1['NH1'];
		   $totalnm1 += $registroY09_1['NM1'];
		   $totalsh1 += $registroY09_1['SH1'];
		   $totalsm1 += $registroY09_1['SM1'];
		   
		   $totalnh2 += $registroY09_1['NH2'];
		   $totalnm2 += $registroY09_1['NM2'];
		   $totalsh2 += $registroY09_1['SH2'];
		   $totalsm2 += $registroY09_1['SM2'];

		   $totalnh3 += $registroY09_1['NH3'];
		   $totalnm3 += $registroY09_1['NM3'];
		   $totalsh3 += $registroY09_1['SH3'];
		   $totalsm3 += $registroY09_1['SM3'];

		   $totalnh4 += $registroY09_1['NH4'];
		   $totalnm4 += $registroY09_1['NM4'];
		   $totalsh4 += $registroY09_1['SH4'];
		   $totalsm4 += $registroY09_1['SM4'];

		   $totalnh5 += $registroY09_1['NH5'];
		   $totalnm5 += $registroY09_1['NM5'];
		   $totalsh5 += $registroY09_1['SH5'];
		   $totalsm5 += $registroY09_1['SM5'];

		   $totalnh6 += $registroY09_1['NH6'];
		   $totalnm6 += $registroY09_1['NM6'];
		   $totalsh6 += $registroY09_1['SH6'];
		   $totalsm6 += $registroY09_1['SM6'];

		   $totalnh7 += $registroY09_1['NH7'];
		   $totalnm7 += $registroY09_1['NM7'];
		   $totalsh7 += $registroY09_1['SH7'];
		   $totalsm7 += $registroY09_1['SM7'];

		   $totalnh8 += $registroY09_1['NH8'];
		   $totalnm8 += $registroY09_1['NM8'];
		   $totalsh8 += $registroY09_1['SH8'];
		   $totalsm8 += $registroY09_1['SM8'];

		   $totalnh9 += $registroY09_1['NH9'];
		   $totalnm9 += $registroY09_1['NM9'];
		   $totalsh9 += $registroY09_1['SH9'];
		   $totalsm9 += $registroY09_1['SM9'];		   

		   $total1 += $registroY09_1['Total1'];
		   $total2 += $registroY09_1['Total2'];
		   $total3 += $registroY09_1['Total3'];
		   $total4 += $registroY09_1['Total4'];	

		   $total += $registroY09_1['Total'];			   
     }	
   } 

	if($resultT74A->num_rows>0){
		while($registroT74A_1 = $resultT74A->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroT74A_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroT74A_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroT74A_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroT74A_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroT74A_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroT74A_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroT74A_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroT74A_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroT74A_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroT74A_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroT74A_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroT74A_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroT74A_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroT74A_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroT74A_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroT74A_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroT74A_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroT74A_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroT74A_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroT74A_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroT74A_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroT74A_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroT74A_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroT74A_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroT74A_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroT74A_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroT74A_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroT74A_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroT74A_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroT74A_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroT74A_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroT74A_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroT74A_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroT74A_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroT74A_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroT74A_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroT74A_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroT74A_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroT74A_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroT74A_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroT74A_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroT74A_1['Total4']);		   
		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroT74A_1['NH1'];
		   $totalnm1 += $registroT74A_1['NM1'];
		   $totalsh1 += $registroT74A_1['SH1'];
		   $totalsm1 += $registroT74A_1['SM1'];	

		   $totalnh2 += $registroT74A_1['NH2'];
		   $totalnm2 += $registroT74A_1['NM2'];
		   $totalsh2 += $registroT74A_1['SH2'];
		   $totalsm2 += $registroT74A_1['SM2'];	

		   $totalnh3 += $registroT74A_1['NH3'];
		   $totalnm3 += $registroT74A_1['NM3'];
		   $totalsh3 += $registroT74A_1['SH3'];
		   $totalsm3 += $registroT74A_1['SM3'];	

		   $totalnh4 += $registroT74A_1['NH4'];
		   $totalnm4 += $registroT74A_1['NM4'];
		   $totalsh4 += $registroT74A_1['SH4'];
		   $totalsm4 += $registroT74A_1['SM4'];	

		   $totalnh5 += $registroT74A_1['NH5'];
		   $totalnm5 += $registroT74A_1['NM5'];
		   $totalsh5 += $registroT74A_1['SH5'];
		   $totalsm5 += $registroT74A_1['SM5'];	

		   $totalnh6 += $registroT74A_1['NH6'];
		   $totalnm6 += $registroT74A_1['NM6'];
		   $totalsh6 += $registroT74A_1['SH6'];
		   $totalsm6 += $registroT74A_1['SM6'];	

		   $totalnh7 += $registroT74A_1['NH7'];
		   $totalnm7 += $registroT74A_1['NM7'];
		   $totalsh7 += $registroT74A_1['SH7'];
		   $totalsm7 += $registroT74A_1['SM7'];	

		   $totalnh8 += $registroT74A_1['NH8'];
		   $totalnm8 += $registroT74A_1['NM8'];
		   $totalsh8 += $registroT74A_1['SH8'];
		   $totalsm8 += $registroT74A_1['SM8'];	

		   $totalnh9 += $registroT74A_1['NH9'];
		   $totalnm9 += $registroT74A_1['NM9'];
		   $totalsh9 += $registroT74A_1['SH9'];
		   $totalsm9 += $registroT74A_1['SM9'];			   
		   
		   $total1 += $registroT74A_1['Total1'];
		   $total2 += $registroT74A_1['Total2'];
		   $total3 += $registroT74A_1['Total3'];
		   $total4 += $registroT74A_1['Total4'];

		   $total += $registroT74A_1['Total'];		   
     }	
   } 

	if($resultT74B->num_rows>0){
		while($registroT74B_1 = $resultT74B->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroT74B_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroT74B_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroT74B_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroT74B_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroT74B_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroT74B_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroT74B_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroT74B_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroT74B_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroT74B_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroT74B_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroT74B_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroT74B_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroT74B_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroT74B_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroT74B_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroT74B_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroT74B_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroT74B_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroT74B_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroT74B_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroT74B_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroT74B_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroT74B_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroT74B_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroT74B_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroT74B_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroT74B_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroT74B_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroT74B_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroT74B_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroT74B_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroT74B_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroT74B_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroT74B_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroT74B_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroT74B_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroT74B_1['SM9']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroT74B_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroT74B_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroT74B_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroT74B_1['Total4']);	   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroT74B_1['NH1'];
		   $totalnm1 += $registroT74B_1['NM1'];
		   $totalsh1 += $registroT74B_1['SH1'];
		   $totalsm1 += $registroT74B_1['SM1'];

		   $totalnh2 += $registroT74B_1['NH2'];
		   $totalnm2 += $registroT74B_1['NM2'];
		   $totalsh2 += $registroT74B_1['SH2'];
		   $totalsm2 += $registroT74B_1['SM2'];

		   $totalnh3 += $registroT74B_1['NH3'];
		   $totalnm3 += $registroT74B_1['NM3'];
		   $totalsh3 += $registroT74B_1['SH3'];
		   $totalsm3 += $registroT74B_1['SM3'];

		   $totalnh4 += $registroT74B_1['NH4'];
		   $totalnm4 += $registroT74B_1['NM4'];
		   $totalsh4 += $registroT74B_1['SH4'];
		   $totalsm4 += $registroT74B_1['SM4'];

		   $totalnh5 += $registroT74B_1['NH5'];
		   $totalnm5 += $registroT74B_1['NM5'];
		   $totalsh5 += $registroT74B_1['SH5'];
		   $totalsm5 += $registroT74B_1['SM5'];

		   $totalnh6 += $registroT74B_1['NH6'];
		   $totalnm6 += $registroT74B_1['NM6'];
		   $totalsh6 += $registroT74B_1['SH6'];
		   $totalsm6 += $registroT74B_1['SM6'];

		   $totalnh7 += $registroT74B_1['NH7'];
		   $totalnm7 += $registroT74B_1['NM7'];
		   $totalsh7 += $registroT74B_1['SH7'];
		   $totalsm7 += $registroT74B_1['SM7'];

		   $totalnh8 += $registroT74B_1['NH8'];
		   $totalnm8 += $registroT74B_1['NM8'];
		   $totalsh8 += $registroT74B_1['SH8'];
		   $totalsm8 += $registroT74B_1['SM8'];

		   $totalnh9 += $registroT74B_1['NH9'];
		   $totalnm9 += $registroT74B_1['NM9'];
		   $totalsh9 += $registroT74B_1['SH9'];
		   $totalsm9 += $registroT74B_1['SM9'];	   
		   
		   $total1 += $registroT74B_1['Total1'];
		   $total2 += $registroT74B_1['Total2'];
		   $total3 += $registroT74B_1['Total3'];
		   $total4 += $registroT74B_1['Total4'];	

		   $total += $registroT74B_1['Total'];			   
     }	
   } 

	if($resultT74C->num_rows>0){
		while($registroT74C_1 = $resultT74C->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroT74C_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroT74C_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroT74C_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroT74C_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroT74C_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroT74C_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroT74C_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroT74C_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroT74C_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroT74C_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroT74C_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroT74C_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroT74C_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroT74C_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroT74C_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroT74C_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroT74C_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroT74C_1['SM4']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroT74C_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroT74C_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroT74C_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroT74C_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroT74C_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroT74C_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroT74C_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroT74C_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroT74C_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroT74C_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroT74C_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroT74C_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroT74C_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroT74C_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroT74C_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroT74C_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroT74C_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroT74C_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroT74C_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroT74C_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroT74C_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroT74C_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroT74C_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroT74C_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroT74C_1['NH1'];
		   $totalnm1 += $registroT74C_1['NM1'];
		   $totalsh1 += $registroT74C_1['SH1'];
		   $totalsm1 += $registroT74C_1['SM1'];	

		   $totalnh2 += $registroT74C_1['NH2'];
		   $totalnm2 += $registroT74C_1['NM2'];
		   $totalsh2 += $registroT74C_1['SH2'];
		   $totalsm2 += $registroT74C_1['SM2'];	

		   $totalnh3 += $registroT74C_1['NH3'];
		   $totalnm3 += $registroT74C_1['NM3'];
		   $totalsh3 += $registroT74C_1['SH3'];
		   $totalsm3 += $registroT74C_1['SM3'];	

		   $totalnh4 += $registroT74C_1['NH4'];
		   $totalnm4 += $registroT74C_1['NM4'];
		   $totalsh4 += $registroT74C_1['SH4'];
		   $totalsm4 += $registroT74C_1['SM4'];	

		   $totalnh5 += $registroT74C_1['NH5'];
		   $totalnm5 += $registroT74C_1['NM5'];
		   $totalsh5 += $registroT74C_1['SH5'];
		   $totalsm5 += $registroT74C_1['SM5'];	

		   $totalnh6 += $registroT74C_1['NH6'];
		   $totalnm6 += $registroT74C_1['NM6'];
		   $totalsh6 += $registroT74C_1['SH6'];
		   $totalsm6 += $registroT74C_1['SM6'];	

		   $totalnh7 += $registroT74C_1['NH7'];
		   $totalnm7 += $registroT74C_1['NM7'];
		   $totalsh7 += $registroT74C_1['SH7'];
		   $totalsm7 += $registroT74C_1['SM7'];	

		   $totalnh8 += $registroT74C_1['NH8'];
		   $totalnm8 += $registroT74C_1['NM8'];
		   $totalsh8 += $registroT74C_1['SH8'];
		   $totalsm8 += $registroT74C_1['SM8'];	

		   $totalnh9 += $registroT74C_1['NH9'];
		   $totalnm9 += $registroT74C_1['NM9'];
		   $totalsh9 += $registroT74C_1['SH9'];
		   $totalsm9 += $registroT74C_1['SM9'];			   
		   
		   $total1 += $registroT74C_1['Total1'];
		   $total2 += $registroT74C_1['Total2'];
		   $total3 += $registroT74C_1['Total3'];
		   $total4 += $registroT74C_1['Total4'];

		   $total += $registroT74C_1['Total'];		   
     }	
   }  

	if($resultAA206->num_rows>0){
		while($registroAA206_1 = $resultAA206->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA206_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA206_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA206_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA206_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA206_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA206_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA206_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroAA206_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroAA206_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroAA206_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroAA206_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroAA206_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroAA206_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroAA206_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroAA206_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroAA206_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroAA206_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroAA206_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroAA206_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroAA206_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroAA206_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroAA206_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroAA206_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroAA206_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroAA206_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroAA206_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroAA206_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroAA206_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroAA206_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroAA206_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroAA206_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroAA206_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroAA206_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroAA206_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroAA206_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroAA206_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroAA206_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroAA206_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroAA206_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroAA206_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroAA206_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroAA206_1['Total4']);
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroAA206_1['NH1'];
		   $totalnm1 += $registroAA206_1['NM1'];
		   $totalsh1 += $registroAA206_1['SH1'];
		   $totalsm1 += $registroAA206_1['SM1'];	

		   $totalnh2 += $registroAA206_1['NH2'];
		   $totalnm2 += $registroAA206_1['NM2'];
		   $totalsh2 += $registroAA206_1['SH2'];
		   $totalsm2 += $registroAA206_1['SM2'];	
		   
		   $totalnh3 += $registroAA206_1['NH3'];
		   $totalnm3 += $registroAA206_1['NM3'];
		   $totalsh3 += $registroAA206_1['SH3'];
		   $totalsm3 += $registroAA206_1['SM3'];	

		   $totalnh4 += $registroAA206_1['NH4'];
		   $totalnm4 += $registroAA206_1['NM4'];
		   $totalsh4 += $registroAA206_1['SH4'];
		   $totalsm4 += $registroAA206_1['SM4'];	

		   $totalnh5 += $registroAA206_1['NH5'];
		   $totalnm5 += $registroAA206_1['NM5'];
		   $totalsh5 += $registroAA206_1['SH5'];
		   $totalsm5 += $registroAA206_1['SM5'];	

		   $totalnh6 += $registroAA206_1['NH6'];
		   $totalnm6 += $registroAA206_1['NM6'];
		   $totalsh6 += $registroAA206_1['SH6'];
		   $totalsm6 += $registroAA206_1['SM6'];	

		   $totalnh7 += $registroAA206_1['NH7'];
		   $totalnm7 += $registroAA206_1['NM7'];
		   $totalsh7 += $registroAA206_1['SH7'];
		   $totalsm7 += $registroAA206_1['SM7'];	

		   $totalnh8 += $registroAA206_1['NH8'];
		   $totalnm8 += $registroAA206_1['NM8'];
		   $totalsh8 += $registroAA206_1['SH8'];
		   $totalsm8 += $registroAA206_1['SM8'];	

		   $totalnh9 += $registroAA206_1['NH9'];
		   $totalnm9 += $registroAA206_1['NM9'];
		   $totalsh9 += $registroAA206_1['SH9'];
		   $totalsm9 += $registroAA206_1['SM9'];			   
		   
		   $total1 += $registroAA206_1['Total1'];
		   $total2 += $registroAA206_1['Total2'];
		   $total3 += $registroAA206_1['Total3'];
		   $total4 += $registroAA206_1['Total4'];

		   $total += $registroAA206_1['Total'];		   
     }	
   }   

	if($resultAA207->num_rows>0){
		while($registroAA207_1 = $resultAA207->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA207_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA207_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA207_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA207_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA207_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA207_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA207_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroAA207_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroAA207_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroAA207_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroAA207_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroAA207_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroAA207_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroAA207_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroAA207_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroAA207_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroAA207_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroAA207_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroAA207_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroAA207_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroAA207_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroAA207_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroAA207_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroAA207_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroAA207_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroAA207_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroAA207_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroAA207_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroAA207_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroAA207_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroAA207_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroAA207_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroAA207_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroAA207_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroAA207_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroAA207_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroAA207_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroAA207_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroAA207_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroAA207_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroAA207_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroAA207_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroAA207_1['NH1'];
		   $totalnm1 += $registroAA207_1['NM1'];
		   $totalsh1 += $registroAA207_1['SH1'];
		   $totalsm1 += $registroAA207_1['SM1'];	

		   $totalnh2 += $registroAA207_1['NH2'];
		   $totalnm2 += $registroAA207_1['NM2'];
		   $totalsh2 += $registroAA207_1['SH2'];
		   $totalsm2 += $registroAA207_1['SM2'];	

		   $totalnh3 += $registroAA207_1['NH3'];
		   $totalnm3 += $registroAA207_1['NM3'];
		   $totalsh3 += $registroAA207_1['SH3'];
		   $totalsm3 += $registroAA207_1['SM3'];	

		   $totalnh4 += $registroAA207_1['NH4'];
		   $totalnm4 += $registroAA207_1['NM4'];
		   $totalsh4 += $registroAA207_1['SH4'];
		   $totalsm4 += $registroAA207_1['SM4'];	

		   $totalnh5 += $registroAA207_1['NH5'];
		   $totalnm5 += $registroAA207_1['NM5'];
		   $totalsh5 += $registroAA207_1['SH5'];
		   $totalsm5 += $registroAA207_1['SM5'];	

		   $totalnh6 += $registroAA207_1['NH6'];
		   $totalnm6 += $registroAA207_1['NM6'];
		   $totalsh6 += $registroAA207_1['SH6'];
		   $totalsm6 += $registroAA207_1['SM6'];	

		   $totalnh7 += $registroAA207_1['NH7'];
		   $totalnm7 += $registroAA207_1['NM7'];
		   $totalsh7 += $registroAA207_1['SH7'];
		   $totalsm7 += $registroAA207_1['SM7'];	

		   $totalnh8 += $registroAA207_1['NH8'];
		   $totalnm8 += $registroAA207_1['NM8'];
		   $totalsh8 += $registroAA207_1['SH8'];
		   $totalsm8 += $registroAA207_1['SM8'];	

		   $totalnh9 += $registroAA207_1['NH9'];
		   $totalnm9 += $registroAA207_1['NM9'];
		   $totalsh9 += $registroAA207_1['SH9'];
		   $totalsm9 += $registroAA207_1['SM9'];			   
		   
		   $total1 += $registroAA207_1['Total1'];
		   $total2 += $registroAA207_1['Total2'];
		   $total3 += $registroAA207_1['Total3'];
		   $total4 += $registroAA207_1['Total4'];	

		   $total += $registroAA207_1['Total'];			   
     }	
   }    

	if($resultAA208->num_rows>0){
		while($registroAA208_1 = $resultAA208->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA208_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA208_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA208_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA208_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA208_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA208_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA208_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroAA208_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroAA208_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroAA208_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroAA208_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroAA208_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroAA208_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroAA208_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroAA208_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroAA208_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroAA208_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroAA208_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroAA208_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroAA208_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroAA208_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroAA208_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroAA208_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroAA208_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroAA208_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroAA208_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroAA208_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroAA208_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroAA208_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroAA208_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroAA208_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroAA208_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroAA208_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroAA208_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroAA208_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroAA208_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroAA208_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroAA208_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroAA208_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroAA208_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroAA208_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroAA208_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroAA208_1['NH1'];
		   $totalnm1 += $registroAA208_1['NM1'];
		   $totalsh1 += $registroAA208_1['SH1'];
		   $totalsm1 += $registroAA208_1['SM1'];
		   
		   $totalnh2 += $registroAA208_1['NH2'];
		   $totalnm2 += $registroAA208_1['NM2'];
		   $totalsh2 += $registroAA208_1['SH2'];
		   $totalsm2 += $registroAA208_1['SM2'];

		   $totalnh3 += $registroAA208_1['NH3'];
		   $totalnm3 += $registroAA208_1['NM3'];
		   $totalsh3 += $registroAA208_1['SH3'];
		   $totalsm3 += $registroAA208_1['SM3'];

		   $totalnh4 += $registroAA208_1['NH4'];
		   $totalnm4 += $registroAA208_1['NM4'];
		   $totalsh4 += $registroAA208_1['SH4'];
		   $totalsm4 += $registroAA208_1['SM4'];

		   $totalnh5 += $registroAA208_1['NH5'];
		   $totalnm5 += $registroAA208_1['NM5'];
		   $totalsh5 += $registroAA208_1['SH5'];
		   $totalsm5 += $registroAA208_1['SM5'];

		   $totalnh6 += $registroAA208_1['NH6'];
		   $totalnm6 += $registroAA208_1['NM6'];
		   $totalsh6 += $registroAA208_1['SH6'];
		   $totalsm6 += $registroAA208_1['SM6'];

		   $totalnh7 += $registroAA208_1['NH7'];
		   $totalnm7 += $registroAA208_1['NM7'];
		   $totalsh7 += $registroAA208_1['SH7'];
		   $totalsm7 += $registroAA208_1['SM7'];

		   $totalnh8 += $registroAA208_1['NH8'];
		   $totalnm8 += $registroAA208_1['NM8'];
		   $totalsh8 += $registroAA208_1['SH8'];
		   $totalsm8 += $registroAA208_1['SM8'];

		   $totalnh9 += $registroAA208_1['NH9'];
		   $totalnm9 += $registroAA208_1['NM9'];
		   $totalsh9 += $registroAA208_1['SH9'];
		   $totalsm9 += $registroAA208_1['SM9'];		   

		   $total1 += $registroAA208_1['Total1'];
		   $total2 += $registroAA208_1['Total2'];
		   $total3 += $registroAA208_1['Total3'];
		   $total4 += $registroAA208_1['Total4'];

		   $total += $registroAA208_1['Total'];		   
     }	
   } 

	if($resultAA175->num_rows>0){
		while($registroAA175_1 = $resultAA175->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA175_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA175_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA175_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA175_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA175_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA175_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA175_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroAA175_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroAA175_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroAA175_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroAA175_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroAA175_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroAA175_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroAA175_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroAA175_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroAA175_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroAA175_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroAA175_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroAA175_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroAA175_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroAA175_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroAA175_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroAA175_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroAA175_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroAA175_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroAA175_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroAA175_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroAA175_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroAA175_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroAA175_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroAA175_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroAA175_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroAA175_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroAA175_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroAA175_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroAA175_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroAA175_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroAA175_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroAA175_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroAA175_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroAA175_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroAA175_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroAA175_1['NH1'];
		   $totalnm1 += $registroAA175_1['NM1'];
		   $totalsh1 += $registroAA175_1['SH1'];
		   $totalsm1 += $registroAA175_1['SM1'];
		   
		   $totalnh2 += $registroAA175_1['NH2'];
		   $totalnm2 += $registroAA175_1['NM2'];
		   $totalsh2 += $registroAA175_1['SH2'];
		   $totalsm2 += $registroAA175_1['SM2'];

		   $totalnh3 += $registroAA175_1['NH3'];
		   $totalnm3 += $registroAA175_1['NM3'];
		   $totalsh3 += $registroAA175_1['SH3'];
		   $totalsm3 += $registroAA175_1['SM3'];

		   $totalnh4 += $registroAA175_1['NH4'];
		   $totalnm4 += $registroAA175_1['NM4'];
		   $totalsh4 += $registroAA175_1['SH4'];
		   $totalsm4 += $registroAA175_1['SM4'];

		   $totalnh5 += $registroAA175_1['NH5'];
		   $totalnm5 += $registroAA175_1['NM5'];
		   $totalsh5 += $registroAA175_1['SH5'];
		   $totalsm5 += $registroAA175_1['SM5'];

		   $totalnh6 += $registroAA175_1['NH6'];
		   $totalnm6 += $registroAA175_1['NM6'];
		   $totalsh6 += $registroAA175_1['SH6'];
		   $totalsm6 += $registroAA175_1['SM6'];

		   $totalnh7 += $registroAA175_1['NH7'];
		   $totalnm7 += $registroAA175_1['NM7'];
		   $totalsh7 += $registroAA175_1['SH7'];
		   $totalsm7 += $registroAA175_1['SM7'];

		   $totalnh8 += $registroAA175_1['NH8'];
		   $totalnm8 += $registroAA175_1['NM8'];
		   $totalsh8 += $registroAA175_1['SH8'];
		   $totalsm8 += $registroAA175_1['SM8'];

		   $totalnh9 += $registroAA175_1['NH9'];
		   $totalnm9 += $registroAA175_1['NM9'];
		   $totalsh9 += $registroAA175_1['SH9'];
		   $totalsm9 += $registroAA175_1['SM9'];		   

		   $total1 += $registroAA175_1['Total1'];
		   $total2 += $registroAA175_1['Total2'];
		   $total3 += $registroAA175_1['Total3'];
		   $total4 += $registroAA175_1['Total4'];

		   $total += $registroAA175_1['Total'];		   
     }	
   }    
   
	if($resultAA210->num_rows>0){
		while($registroAA210_1 = $resultAA210->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA210_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA210_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA210_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA210_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA210_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA210_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA210_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroAA210_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroAA210_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroAA210_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroAA210_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroAA210_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroAA210_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroAA210_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroAA210_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroAA210_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroAA210_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroAA210_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroAA210_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroAA210_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroAA210_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroAA210_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroAA210_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroAA210_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroAA210_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroAA210_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroAA210_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroAA210_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroAA210_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroAA210_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroAA210_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroAA210_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroAA210_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroAA210_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroAA210_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroAA210_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroAA210_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroAA210_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroAA210_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroAA210_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroAA210_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroAA210_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroAA210_1['NH1'];
		   $totalnm1 += $registroAA210_1['NM1'];
		   $totalsh1 += $registroAA210_1['SH1'];
		   $totalsm1 += $registroAA210_1['SM1'];	
		   
		   $totalnh2 += $registroAA210_1['NH2'];
		   $totalnm2 += $registroAA210_1['NM2'];
		   $totalsh2 += $registroAA210_1['SH2'];
		   $totalsm2 += $registroAA210_1['SM2'];	

		   $totalnh3 += $registroAA210_1['NH3'];
		   $totalnm3 += $registroAA210_1['NM3'];
		   $totalsh3 += $registroAA210_1['SH3'];
		   $totalsm3 += $registroAA210_1['SM3'];	

		   $totalnh4 += $registroAA210_1['NH4'];
		   $totalnm4 += $registroAA210_1['NM4'];
		   $totalsh4 += $registroAA210_1['SH4'];
		   $totalsm4 += $registroAA210_1['SM4'];	

		   $totalnh5 += $registroAA210_1['NH5'];
		   $totalnm5 += $registroAA210_1['NM5'];
		   $totalsh5 += $registroAA210_1['SH5'];
		   $totalsm5 += $registroAA210_1['SM5'];	

		   $totalnh6 += $registroAA210_1['NH6'];
		   $totalnm6 += $registroAA210_1['NM6'];
		   $totalsh6 += $registroAA210_1['SH6'];
		   $totalsm6 += $registroAA210_1['SM6'];	

		   $totalnh7 += $registroAA210_1['NH7'];
		   $totalnm7 += $registroAA210_1['NM7'];
		   $totalsh7 += $registroAA210_1['SH7'];
		   $totalsm7 += $registroAA210_1['SM7'];	

		   $totalnh8 += $registroAA210_1['NH8'];
		   $totalnm8 += $registroAA210_1['NM8'];
		   $totalsh8 += $registroAA210_1['SH8'];
		   $totalsm8 += $registroAA210_1['SM8'];	

		   $totalnh9 += $registroAA210_1['NH9'];
		   $totalnm9 += $registroAA210_1['NM9'];
		   $totalsh9 += $registroAA210_1['SH9'];
		   $totalsm9 += $registroAA210_1['SM9'];			   

		   $total1 += $registroAA210_1['Total1'];
		   $total2 += $registroAA210_1['Total2'];
		   $total3 += $registroAA210_1['Total3'];
		   $total4 += $registroAA210_1['Total4'];

		   $total += $registroAA210_1['Total'];		   
     }	
   }   

	if($resultZ00->num_rows>0){
		while($registroZ00_1 = $resultZ00->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ00_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ00_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ00_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ00_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ00_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ00_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ00_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroZ00_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroZ00_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroZ00_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroZ00_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroZ00_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroZ00_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroZ00_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroZ00_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroZ00_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroZ00_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroZ00_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroZ00_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroZ00_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroZ00_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroZ00_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroZ00_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroZ00_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroZ00_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroZ00_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroZ00_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroZ00_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroZ00_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroZ00_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroZ00_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroZ00_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroZ00_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroZ00_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroZ00_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroZ00_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroZ00_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroZ00_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroZ00_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroZ00_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroZ00_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroZ00_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroZ00_1['NH1'];
		   $totalnm1 += $registroZ00_1['NM1'];
		   $totalsh1 += $registroZ00_1['SH1'];
		   $totalsm1 += $registroZ00_1['SM1'];
		   
		   $totalnh2 += $registroZ00_1['NH2'];
		   $totalnm2 += $registroZ00_1['NM2'];
		   $totalsh2 += $registroZ00_1['SH2'];
		   $totalsm2 += $registroZ00_1['SM2'];

		   $totalnh3 += $registroZ00_1['NH3'];
		   $totalnm3 += $registroZ00_1['NM3'];
		   $totalsh3 += $registroZ00_1['SH3'];
		   $totalsm3 += $registroZ00_1['SM3'];

		   $totalnh4 += $registroZ00_1['NH4'];
		   $totalnm4 += $registroZ00_1['NM4'];
		   $totalsh4 += $registroZ00_1['SH4'];
		   $totalsm4 += $registroZ00_1['SM4'];

		   $totalnh5 += $registroZ00_1['NH5'];
		   $totalnm5 += $registroZ00_1['NM5'];
		   $totalsh5 += $registroZ00_1['SH5'];
		   $totalsm5 += $registroZ00_1['SM5'];

		   $totalnh6 += $registroZ00_1['NH6'];
		   $totalnm6 += $registroZ00_1['NM6'];
		   $totalsh6 += $registroZ00_1['SH6'];
		   $totalsm6 += $registroZ00_1['SM6'];

		   $totalnh7 += $registroZ00_1['NH7'];
		   $totalnm7 += $registroZ00_1['NM7'];
		   $totalsh7 += $registroZ00_1['SH7'];
		   $totalsm7 += $registroZ00_1['SM7'];

		   $totalnh8 += $registroZ00_1['NH8'];
		   $totalnm8 += $registroZ00_1['NM8'];
		   $totalsh8 += $registroZ00_1['SH8'];
		   $totalsm8 += $registroZ00_1['SM8'];

		   $totalnh9 += $registroZ00_1['NH9'];
		   $totalnm9 += $registroZ00_1['NM9'];
		   $totalsh9 += $registroZ00_1['SH9'];
		   $totalsm9 += $registroZ00_1['SM9'];		   

		   $total1 += $registroZ00_1['Total1'];
		   $total2 += $registroZ00_1['Total2'];
		   $total3 += $registroZ00_1['Total3'];
		   $total4 += $registroZ00_1['Total4'];	

		   $total += $registroZ00_1['Total'];			   
     }	
   }    

	if($resultZ20->num_rows>0){
		while($registroZ20_1 = $resultZ20->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ20_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ20_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ20_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ20_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ20_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ20_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ20_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroZ20_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroZ20_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroZ20_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroZ20_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroZ20_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroZ20_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroZ20_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroZ20_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroZ20_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroZ20_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroZ20_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroZ20_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroZ20_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroZ20_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroZ20_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroZ20_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroZ20_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroZ20_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroZ20_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroZ20_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroZ20_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroZ20_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroZ20_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroZ20_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroZ20_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroZ20_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroZ20_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroZ20_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroZ20_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroZ20_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroZ20_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroZ20_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroZ20_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroZ20_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroZ20_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroZ20_1['NH1'];
		   $totalnm1 += $registroZ20_1['NM1'];
		   $totalsh1 += $registroZ20_1['SH1'];
		   $totalsm1 += $registroZ20_1['SM1'];	

		   $totalnh2 += $registroZ20_1['NH2'];
		   $totalnm2 += $registroZ20_1['NM2'];
		   $totalsh2 += $registroZ20_1['SH2'];
		   $totalsm2 += $registroZ20_1['SM2'];	

		   $totalnh3 += $registroZ20_1['NH3'];
		   $totalnm3 += $registroZ20_1['NM3'];
		   $totalsh3 += $registroZ20_1['SH3'];
		   $totalsm3 += $registroZ20_1['SM3'];	

		   $totalnh4 += $registroZ20_1['NH4'];
		   $totalnm4 += $registroZ20_1['NM4'];
		   $totalsh4 += $registroZ20_1['SH4'];
		   $totalsm4 += $registroZ20_1['SM4'];	
		   
		   $totalnh5 += $registroZ20_1['NH5'];
		   $totalnm5 += $registroZ20_1['NM5'];
		   $totalsh5 += $registroZ20_1['SH5'];
		   $totalsm5 += $registroZ20_1['SM5'];	

		   $totalnh6 += $registroZ20_1['NH6'];
		   $totalnm6 += $registroZ20_1['NM6'];
		   $totalsh6 += $registroZ20_1['SH6'];
		   $totalsm6 += $registroZ20_1['SM6'];	

		   $totalnh7 += $registroZ20_1['NH7'];
		   $totalnm7 += $registroZ20_1['NM7'];
		   $totalsh7 += $registroZ20_1['SH7'];
		   $totalsm7 += $registroZ20_1['SM7'];	

		   $totalnh8 += $registroZ20_1['NH8'];
		   $totalnm8 += $registroZ20_1['NM8'];
		   $totalsh8 += $registroZ20_1['SH8'];
		   $totalsm8 += $registroZ20_1['SM8'];	

		   $totalnh9 += $registroZ20_1['NH9'];
		   $totalnm9 += $registroZ20_1['NM9'];
		   $totalsh9 += $registroZ20_1['SH9'];
		   $totalsm9 += $registroZ20_1['SM9'];	  
		   
		   $total1 += $registroZ20_1['Total1'];
		   $total2 += $registroZ20_1['Total2'];
		   $total3 += $registroZ20_1['Total3'];
		   $total4 += $registroZ20_1['Total4'];	

		   $total += $registroZ20_1['Total'];			   
     }	
   }    

	if($resultZ30->num_rows>0){
		while($registroZ30_1 = $resultZ30->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ30_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ30_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ30_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ30_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ30_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ30_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ30_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroZ30_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroZ30_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroZ30_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroZ30_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroZ30_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroZ30_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroZ30_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroZ30_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroZ30_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroZ30_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroZ30_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroZ30_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroZ30_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroZ30_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroZ30_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroZ30_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroZ30_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroZ30_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroZ30_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroZ30_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroZ30_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroZ30_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroZ30_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroZ30_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroZ30_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroZ30_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroZ30_1['SM8']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroZ30_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroZ30_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroZ30_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroZ30_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroZ30_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroZ30_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroZ30_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroZ30_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroZ30_1['NH1'];
		   $totalnm1 += $registroZ30_1['NM1'];
		   $totalsh1 += $registroZ30_1['SH1'];
		   $totalsm1 += $registroZ30_1['SM1'];

		   $totalnh2 += $registroZ30_1['NH2'];
		   $totalnm2 += $registroZ30_1['NM2'];
		   $totalsh2 += $registroZ30_1['SH2'];
		   $totalsm2 += $registroZ30_1['SM2'];	

		   $totalnh3 += $registroZ30_1['NH3'];
		   $totalnm3 += $registroZ30_1['NM3'];
		   $totalsh3 += $registroZ30_1['SH3'];
		   $totalsm3 += $registroZ30_1['SM3'];	

		   $totalnh4 += $registroZ30_1['NH4'];
		   $totalnm4 += $registroZ30_1['NM4'];
		   $totalsh4 += $registroZ30_1['SH4'];
		   $totalsm4 += $registroZ30_1['SM4'];	

		   $totalnh5 += $registroZ30_1['NH5'];
		   $totalnm5 += $registroZ30_1['NM5'];
		   $totalsh5 += $registroZ30_1['SH5'];
		   $totalsm5 += $registroZ30_1['SM5'];	

		   $totalnh6 += $registroZ30_1['NH6'];
		   $totalnm6 += $registroZ30_1['NM6'];
		   $totalsh6 += $registroZ30_1['SH6'];
		   $totalsm6 += $registroZ30_1['SM6'];	

		   $totalnh7 += $registroZ30_1['NH7'];
		   $totalnm7 += $registroZ30_1['NM7'];
		   $totalsh7 += $registroZ30_1['SH7'];
		   $totalsm7 += $registroZ30_1['SM7'];	

		   $totalnh8 += $registroZ30_1['NH8'];
		   $totalnm8 += $registroZ30_1['NM8'];
		   $totalsh8 += $registroZ30_1['SH8'];
		   $totalsm8 += $registroZ30_1['SM8'];	

		   $totalnh9 += $registroZ30_1['NH9'];
		   $totalnm9 += $registroZ30_1['NM9'];
		   $totalsh9 += $registroZ30_1['SH9'];
		   $totalsm9 += $registroZ30_1['SM9'];			   
		   
		   $total1 += $registroZ30_1['Total1'];
		   $total2 += $registroZ30_1['Total2'];
		   $total3 += $registroZ30_1['Total3'];
		   $total4 += $registroZ30_1['Total4'];	

		   $total += $registroZ30_1['Total'];			   
     }	
   }  

	if($resultZ40->num_rows>0){
		while($registroZ40_1 = $resultZ40->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ40_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ40_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ40_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ40_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ40_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ40_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ40_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroZ40_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroZ40_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroZ40_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroZ40_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroZ40_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroZ40_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroZ40_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroZ40_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroZ40_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroZ40_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroZ40_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroZ40_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroZ40_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroZ40_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroZ40_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroZ40_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroZ40_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroZ40_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroZ40_1['SM6']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroZ40_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroZ40_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroZ40_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroZ40_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroZ40_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroZ40_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroZ40_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroZ40_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroZ40_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroZ40_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroZ40_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroZ40_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroZ40_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroZ40_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroZ40_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroZ40_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroZ40_1['NH1'];
		   $totalnm1 += $registroZ40_1['NM1'];
		   $totalsh1 += $registroZ40_1['SH1'];
		   $totalsm1 += $registroZ40_1['SM1'];
		   
		   $totalnh2 += $registroZ40_1['NH2'];
		   $totalnm2 += $registroZ40_1['NM2'];
		   $totalsh2 += $registroZ40_1['SH2'];
		   $totalsm2 += $registroZ40_1['SM2'];

		   $totalnh3 += $registroZ40_1['NH3'];
		   $totalnm3 += $registroZ40_1['NM3'];
		   $totalsh3 += $registroZ40_1['SH3'];
		   $totalsm3 += $registroZ40_1['SM3'];

		   $totalnh4 += $registroZ40_1['NH4'];
		   $totalnm4 += $registroZ40_1['NM4'];
		   $totalsh4 += $registroZ40_1['SH4'];
		   $totalsm4 += $registroZ40_1['SM4'];

		   $totalnh5 += $registroZ40_1['NH5'];
		   $totalnm5 += $registroZ40_1['NM5'];
		   $totalsh5 += $registroZ40_1['SH5'];
		   $totalsm5 += $registroZ40_1['SM5'];

		   $totalnh6 += $registroZ40_1['NH6'];
		   $totalnm6 += $registroZ40_1['NM6'];
		   $totalsh6 += $registroZ40_1['SH6'];
		   $totalsm6 += $registroZ40_1['SM6'];

		   $totalnh7 += $registroZ40_1['NH7'];
		   $totalnm7 += $registroZ40_1['NM7'];
		   $totalsh7 += $registroZ40_1['SH7'];
		   $totalsm7 += $registroZ40_1['SM7'];

		   $totalnh8 += $registroZ40_1['NH8'];
		   $totalnm8 += $registroZ40_1['NM8'];
		   $totalsh8 += $registroZ40_1['SH8'];
		   $totalsm8 += $registroZ40_1['SM8'];

		   $totalnh9 += $registroZ40_1['NH9'];
		   $totalnm9 += $registroZ40_1['NM9'];
		   $totalsh9 += $registroZ40_1['SH9'];
		   $totalsm9 += $registroZ40_1['SM9'];		   

		   $total1 += $registroZ40_1['Total1'];
		   $total2 += $registroZ40_1['Total2'];
		   $total3 += $registroZ40_1['Total3'];
		   $total4 += $registroZ40_1['Total4'];	

		   $total += $registroZ40_1['Total'];			   
     }	
   }  

	if($resultZ55->num_rows>0){
		while($registroZ55_1 = $resultZ55->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ55_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ55_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ55_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ55_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ55_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ55_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ55_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroZ55_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroZ55_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroZ55_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroZ55_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroZ55_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroZ55_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroZ55_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroZ55_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroZ55_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroZ55_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroZ55_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroZ55_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroZ55_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroZ55_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroZ55_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroZ55_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroZ55_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroZ55_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroZ55_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroZ55_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroZ55_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroZ55_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroZ55_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroZ55_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroZ55_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroZ55_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroZ55_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroZ55_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroZ55_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroZ55_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroZ55_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroZ55_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroZ55_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroZ55_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroZ55_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroZ55_1['NH1'];
		   $totalnm1 += $registroZ55_1['NM1'];
		   $totalsh1 += $registroZ55_1['SH1'];
		   $totalsm1 += $registroZ55_1['SM1'];

		   $totalnh2 += $registroZ55_1['NH2'];
		   $totalnm2 += $registroZ55_1['NM2'];
		   $totalsh2 += $registroZ55_1['SH2'];
		   $totalsm2 += $registroZ55_1['SM2'];

		   $totalnh3 += $registroZ55_1['NH3'];
		   $totalnm3 += $registroZ55_1['NM3'];
		   $totalsh3 += $registroZ55_1['SH3'];
		   $totalsm3 += $registroZ55_1['SM3'];

		   $totalnh4 += $registroZ55_1['NH4'];
		   $totalnm4 += $registroZ55_1['NM4'];
		   $totalsh4 += $registroZ55_1['SH4'];
		   $totalsm4 += $registroZ55_1['SM4'];

		   $totalnh5 += $registroZ55_1['NH5'];
		   $totalnm5 += $registroZ55_1['NM5'];
		   $totalsh5 += $registroZ55_1['SH5'];
		   $totalsm5 += $registroZ55_1['SM5'];

		   $totalnh6 += $registroZ55_1['NH6'];
		   $totalnm6 += $registroZ55_1['NM6'];
		   $totalsh6 += $registroZ55_1['SH6'];
		   $totalsm6 += $registroZ55_1['SM6'];

		   $totalnh7 += $registroZ55_1['NH7'];
		   $totalnm7 += $registroZ55_1['NM7'];
		   $totalsh7 += $registroZ55_1['SH7'];
		   $totalsm7 += $registroZ55_1['SM7'];

		   $totalnh8 += $registroZ55_1['NH8'];
		   $totalnm8 += $registroZ55_1['NM8'];
		   $totalsh8 += $registroZ55_1['SH8'];
		   $totalsm8 += $registroZ55_1['SM8'];

		   $totalnh9 += $registroZ55_1['NH9'];
		   $totalnm9 += $registroZ55_1['NM9'];
		   $totalsh9 += $registroZ55_1['SH9'];
		   $totalsm9 += $registroZ55_1['SM9'];		   
		   
		   $total1 += $registroZ55_1['Total1'];
		   $total2 += $registroZ55_1['Total2'];
		   $total3 += $registroZ55_1['Total3'];
		   $total4 += $registroZ55_1['Total4'];	

		   $total += $registroZ55_1['Total'];			   
     }	
   } 

	if($resultZ70->num_rows>0){
		while($registro70_1 = $resultZ70->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro70_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro70_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro70_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro70_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro70_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro70_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro70_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro70_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro70_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro70_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro70_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro70_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro70_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro70_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro70_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro70_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro70_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro70_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro70_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro70_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro70_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro70_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro70_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro70_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro70_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro70_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro70_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro70_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro70_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro70_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro70_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro70_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro70_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro70_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registro70_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registro70_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registro70_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registro70_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registro70_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registro70_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registro70_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registro70_1['Total4']);		   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registro70_1['NH1'];
		   $totalnm1 += $registro70_1['NM1'];
		   $totalsh1 += $registro70_1['SH1'];
		   $totalsm1 += $registro70_1['SM1'];
		   
		   $totalnh2 += $registro70_1['NH2'];
		   $totalnm2 += $registro70_1['NM2'];
		   $totalsh2 += $registro70_1['SH2'];
		   $totalsm2 += $registro70_1['SM2'];

		   $totalnh3 += $registro70_1['NH3'];
		   $totalnm3 += $registro70_1['NM3'];
		   $totalsh3 += $registro70_1['SH3'];
		   $totalsm3 += $registro70_1['SM3'];

		   $totalnh4 += $registro70_1['NH4'];
		   $totalnm4 += $registro70_1['NM4'];
		   $totalsh4 += $registro70_1['SH4'];
		   $totalsm4 += $registro70_1['SM4'];

		   $totalnh5 += $registro70_1['NH5'];
		   $totalnm5 += $registro70_1['NM5'];
		   $totalsh5 += $registro70_1['SH5'];
		   $totalsm5 += $registro70_1['SM5'];

		   $totalnh6 += $registro70_1['NH6'];
		   $totalnm6 += $registro70_1['NM6'];
		   $totalsh6 += $registro70_1['SH6'];
		   $totalsm6 += $registro70_1['SM6'];

		   $totalnh7 += $registro70_1['NH7'];
		   $totalnm7 += $registro70_1['NM7'];
		   $totalsh7 += $registro70_1['SH7'];
		   $totalsm7 += $registro70_1['SM7'];

		   $totalnh8 += $registro70_1['NH8'];
		   $totalnm8 += $registro70_1['NM8'];
		   $totalsh8 += $registro70_1['SH8'];
		   $totalsm8 += $registro70_1['SM8'];

		   $totalnh9 += $registro70_1['NH9'];
		   $totalnm9 += $registro70_1['NM9'];
		   $totalsh9 += $registro70_1['SH9'];
		   $totalsm9 += $registro70_1['SM9'];		   

		   $total1 += $registro70_1['Total1'];
		   $total2 += $registro70_1['Total2'];
		   $total3 += $registro70_1['Total3'];
		   $total4 += $registro70_1['Total4'];		   
		   
		   $total += $registro70_1['Total'];		   
     }	
   }  

	if($resultZ80->num_rows>0){
		while($registro80_1 = $resultZ80->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro80_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro80_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro80_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro80_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro80_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro80_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro80_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro80_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro80_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro80_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro80_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro80_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro80_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro80_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro80_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro80_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro80_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro80_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro80_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro80_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro80_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro80_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro80_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro80_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro80_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro80_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro80_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro80_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro80_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro80_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro80_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro80_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro80_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro80_1['SM8']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registro80_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registro80_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registro80_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registro80_1['SM9']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registro80_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registro80_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registro80_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registro80_1['Total4']);		   
			   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registro80_1['NH1'];
		   $totalnm1 += $registro80_1['NM1'];
		   $totalsh1 += $registro80_1['SH1'];
		   $totalsm1 += $registro80_1['SM1'];
		   
		   $totalnh2 += $registro80_1['NH2'];
		   $totalnm2 += $registro80_1['NM2'];
		   $totalsh2 += $registro80_1['SH2'];
		   $totalsm2 += $registro80_1['SM2'];
		   
		   $totalnh3 += $registro80_1['NH3'];
		   $totalnm3 += $registro80_1['NM3'];
		   $totalsh3 += $registro80_1['SH3'];
		   $totalsm3 += $registro80_1['SM3'];

		   $totalnh4 += $registro80_1['NH4'];
		   $totalnm4 += $registro80_1['NM4'];
		   $totalsh4 += $registro80_1['SH4'];
		   $totalsm4 += $registro80_1['SM4'];

		   $totalnh5 += $registro80_1['NH5'];
		   $totalnm5 += $registro80_1['NM5'];
		   $totalsh5 += $registro80_1['SH5'];
		   $totalsm5 += $registro80_1['SM5'];

		   $totalnh6 += $registro80_1['NH6'];
		   $totalnm6 += $registro80_1['NM6'];
		   $totalsh6 += $registro80_1['SH6'];
		   $totalsm6 += $registro80_1['SM6'];

		   $totalnh7 += $registro80_1['NH7'];
		   $totalnm7 += $registro80_1['NM7'];
		   $totalsh7 += $registro80_1['SH7'];
		   $totalsm7 += $registro80_1['SM7'];

		   $totalnh8 += $registro80_1['NH8'];
		   $totalnm8 += $registro80_1['NM8'];
		   $totalsh8 += $registro80_1['SH8'];
		   $totalsm8 += $registro80_1['SM8'];

		   $totalnh9 += $registro80_1['NH9'];
		   $totalnm9 += $registro80_1['NM9'];
		   $totalsh9 += $registro80_1['SH9'];
		   $totalsm9 += $registro80_1['SM9'];		   

		   $total1 += $registro80_1['Total1'];
		   $total2 += $registro80_1['Total2'];
		   $total3 += $registro80_1['Total3'];
		   $total4 += $registro80_1['Total4'];

		   $total += $registro80_1['Total'];		   
     }	
   } 

	if($resultNPP->num_rows>0){
		while($registroNPP_1 = $resultNPP->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroNPP_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroNPP_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroNPP_1['NH1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroNPP_1['NM1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroNPP_1['SH1']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroNPP_1['SM1']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroNPP_1['NH2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registroNPP_1['NM2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registroNPP_1['SH2']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registroNPP_1['SM2']);

           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registroNPP_1['NH3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registroNPP_1['NM3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registroNPP_1['SH3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registroNPP_1['SM3']);

           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registroNPP_1['NH4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registroNPP_1['NM4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registroNPP_1['SH4']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registroNPP_1['SM4']);

           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registroNPP_1['NH5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registroNPP_1['NM5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registroNPP_1['SH5']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registroNPP_1['SM5']);

           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registroNPP_1['NH6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registroNPP_1['NM6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registroNPP_1['SH6']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registroNPP_1['SM6']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registroNPP_1['NH7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registroNPP_1['NM7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registroNPP_1['SH7']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registroNPP_1['SM7']);

           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registroNPP_1['NH8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registroNPP_1['NM8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registroNPP_1['SH8']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registroNPP_1['SM8']);
		   
           $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $registroNPP_1['NH9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $registroNPP_1['NM9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $registroNPP_1['SH9']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $registroNPP_1['SM9']);		

           $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $registroNPP_1['Total1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $registroNPP_1['Total2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $registroNPP_1['Total3']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $registroNPP_1['Total4']);				   
				   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
           $objPHPExcel->getActiveSheet()->getStyle("AM$fila:AP$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $totalnh1 += $registroNPP_1['NH1'];
		   $totalnm1 += $registroNPP_1['NM1'];
		   $totalsh1 += $registroNPP_1['SH1'];
		   $totalsm1 += $registroNPP_1['SM1'];
		   
		   $totalnh2 += $registroNPP_1['NH2'];
		   $totalnm2 += $registroNPP_1['NM2'];
		   $totalsh2 += $registroNPP_1['SH2'];
		   $totalsm2 += $registroNPP_1['SM2'];

		   $totalnh3 += $registroNPP_1['NH3'];
		   $totalnm3 += $registroNPP_1['NM3'];
		   $totalsh3 += $registroNPP_1['SH3'];
		   $totalsm3 += $registroNPP_1['SM3'];

		   $totalnh4 += $registroNPP_1['NH4'];
		   $totalnm4 += $registroNPP_1['NM4'];
		   $totalsh4 += $registroNPP_1['SH4'];
		   $totalsm4 += $registroNPP_1['SM4'];

		   $totalnh5 += $registroNPP_1['NH5'];
		   $totalnm5 += $registroNPP_1['NM5'];
		   $totalsh5 += $registroNPP_1['SH5'];
		   $totalsm5 += $registroNPP_1['SM5'];

		   $totalnh6 += $registroNPP_1['NH6'];
		   $totalnm6 += $registroNPP_1['NM6'];
		   $totalsh6 += $registroNPP_1['SH6'];
		   $totalsm6 += $registroNPP_1['SM6'];

		   $totalnh7 += $registroNPP_1['NH7'];
		   $totalnm7 += $registroNPP_1['NM7'];
		   $totalsh7 += $registroNPP_1['SH7'];
		   $totalsm7 += $registroNPP_1['SM7'];

		   $totalnh8 += $registroNPP_1['NH8'];
		   $totalnm8 += $registroNPP_1['NM8'];
		   $totalsh8 += $registroNPP_1['SH8'];
		   $totalsm8 += $registroNPP_1['SM8'];

		   $totalnh9 += $registroNPP_1['NH9'];
		   $totalnm9 += $registroNPP_1['NM9'];
		   $totalsh9 += $registroNPP_1['SH9'];
		   $totalsm9 += $registroNPP_1['SM9'];		   

		   $total1 += $registroNPP_1['Total1'];
		   $total2 += $registroNPP_1['Total2'];
		   $total3 += $registroNPP_1['Total3'];
		   $total4 += $registroNPP_1['Total4'];

		   $total += $registroNPP_1['Total'];		   
     }	
   }       
}	

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "TOTAL");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $totalnh1);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $totalnm1);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $totalsh1);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $totalsm1);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $totalnh2);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $totalnm2);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $totalsh2);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $totalsm2);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $totalnh3);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $totalnm3);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $totalsh3);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $totalsm3);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $totalnh4);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $totalnm4);
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $totalsh4);
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $totalsm4);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $totalnh5);
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $totalnm5);
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $totalsh5);
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $totalsm5);

$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $totalnh6);
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $totalnm6);
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $totalsh6);
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $totalsm6);

$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $totalnh7);
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $totalnm7);
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $totalsh7);
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $totalsm7);

$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $totalnh8);
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $totalnm8);
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $totalsh8);
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $totalsm8);

$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", $totalnh9);
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", $totalnm9);
$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $totalsh9);
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $totalsm9);

$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", $total1);
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", $total2);
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", $total3);
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", $total4);

$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AP$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila:AP$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Analisis");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("C$fila:J$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "1. Total Pacientes");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $total);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "2. Enfermedades mas comunes (según %)");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getFont()->setBold(true); //negrita

$fila+=1;
$totalnuevos += $totalnh1 + $totalnh2 + $totalnh3 + $totalnh4 + $totalnh5 + $totalnh6 + $totalnh7 + $totalnh8 + $totalnh9 + $totalnm1 + $totalnm2 + $totalnm3 + $totalnm4 + $totalnm5 + $totalnm6 + $totalnm7 + $totalnm8 + $totalnm9;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "3. Cantidad de Nuevos");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $totalnuevos);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getFont()->setBold(true); //negrita

$fila+=1;

if ($total != 0){
	$porcentajenuevos = number_format((($totalnuevos / $total)*100));
}else{
	$porcentajenuevos = 0;
}

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "4. % de Nuevos conforme a la consulta");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:J$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $porcentajenuevos);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getFont()->setBold(true); //negrita*/
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setDifferentOddEven(false);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P / &N');

$objPHPExcel->removeSheetByIndex(
    $objPHPExcel->getIndex(
        $objPHPExcel->getSheetByName('Worksheet')
    )
);
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="SM03 '.strtoupper($servicio_name).' '.strtoupper($unidad_name).' '.$colaborador_name.' '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
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