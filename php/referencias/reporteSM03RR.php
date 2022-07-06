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
$servicio = $_GET['servicio'];	
$servicio_name = "";

//OBTENER NOMBRE DE EMPRESA
$usuario = $_SESSION['colaborador_id'];	

$query_empresa = "SELECT e.nombre AS 'empresa'
FROM users AS u
INNER JOIN empresa AS e
ON u.empresa_id = e.empresa_id
WHERE u.colaborador_id = '$usuario'";
$result_empresa = $mysqli->query($query_empresa) or die($mysqli->error);;
$consulta_empresa = $result_empresa->fetch_assoc();

$empresa_nombre = '';

if($result_empresa->num_rows>0){
   $empresa_nombre = $consulta_empresa['empresa'];	
}

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($servicio != 0){
	$where = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id > 0";
	$where1 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio'";
	$where2 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 1 AND 43";
	$where3 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 44 AND 123";
	$where4 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 124 AND 154";
	$where5 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 155 AND 160";
	$where6 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 161 AND 171";
	$where7 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 172 AND 196";
	$where8 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 197 AND 245";
	$where9 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 246 AND 282";
	$where10 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 283 AND 335";
	$where11 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 336 AND 341";
	$where12 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 342 AND 368";
	$where13 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 369 AND 413";
	$where14 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 414 AND 414";
	$where15 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id BETWEEN 415 AND 415";
	$where16 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 416";
	$where17 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 417";
	$where18 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 418";
	$where19 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 419";
	$where20 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 420";
	$where21 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 421";
	$where22 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 422";
	$where23 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 423";
	$where24 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 424";
	$where25 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 425";
	$where26 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 426";
	$where27 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 427";
	$where28 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 428";
	$where29 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 429";
	$where30 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 430";
	$where31 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 431";
	$where32 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 432";
	$where33 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 433";
	$where34 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 434";
	$where35 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 436";
	$where36 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 437";
	$where37 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 438";
	$where38 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 439";
	$where39 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 440";
	$where40 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 441";
	$where41 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 442";
	$where42 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.servicio_id = '$servicio' AND rr.patologia_id = 435";	
    
	//OBTENER NOMBRE SERVICIO
    $consulta_servicio = "SELECT nombre 
	   FROM servicios 
	   WHERE servicio_id = '$servicio'";
	$result = $mysqli->query($consulta_servicio);
    $consulta_servicio1 = $result->fetch_assoc();
    $servicio_name = "Servicio ".$consulta_servicio1['nombre'];	
}else{
	$where = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id > 0";
	$where1 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta'";
	$where2 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 1 AND 43";
	$where3 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 44 AND 123";
	$where4 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 124 AND 154";
	$where5 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 155 AND 160";
	$where6 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 161 AND 171";
	$where7 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 172 AND 196";
	$where8 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 197 AND 245";
	$where9 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 246 AND 282";
	$where10 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 283 AND 335";
	$where11 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 336 AND 341";
	$where12 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 342 AND 368";
	$where13 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 369 AND 413";
	$where14 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 414 AND 414";
	$where15 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id BETWEEN 415 AND 415";
	$where16 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 416";
	$where17 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 417";
	$where18 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 418";
	$where19 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 419";
	$where20 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 420";
	$where21 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 421";
	$where22 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 422";
	$where23 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 423";
	$where24 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 424";
	$where25 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 425";
	$where26 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 426";
	$where27 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 427";
	$where28 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 428";
	$where29 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 429";
	$where30 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 430";
	$where31 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 431";
	$where32 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 432";
	$where33 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 433";
	$where34 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 434";
	$where35 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 436";
	$where36 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 437";
	$where37 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 438";
	$where38 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 439";
	$where39 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 440";
	$where40 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 441";
	$where41 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 442";
	$where42 = "WHERE rr.fecha BETWEEN '$desde' AND '$hasta' AND rr.patologia_id = 435";
    $servicio_name = "";
}

$registro = "SELECT DISTINCT 
   CONCAT('F00-F09') AS 'Codigo', CONCAT('Trastorno mentales organicos incluidos los sintomaticos (Demencias)') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  
   ".$where1;
$result = $mysqli->query($registro);	 

	 
//F00 - F09
$registroF00 = "SELECT DISTINCT 
   CONCAT('F00-F09') AS 'Codigo', CONCAT('Trastorno mentales organicos incluidos los sintomaticos (Demencias)') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where2;
$resultF00 = $mysqli->query($registroF00);    

//F10 - F19
$registroF10 = "SELECT DISTINCT 
   CONCAT('F10-F19') AS 'Codigo', CONCAT('Trastornos mentales y del comportamiento debidos al consumo de sustancias psicotropas') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where3;
$resultF10 = $mysqli->query($registroF10);    

//F20 - F29
$registroF20 = "SELECT DISTINCT 
   CONCAT('F20-F29') AS 'Codigo', CONCAT('Esquizofrenia, trastorno esquizotipico y trastorno de ideas delirantes') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente 	   
   ".$where4;
$resultF20 = $mysqli->query($registroF20);    

//F30
$registroF30 = "SELECT DISTINCT 
   CONCAT('F30') AS 'Codigo', CONCAT('Trastorno del humor (Episodio Maniaco)') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente 	   
   ".$where5;
$resultF30 = $mysqli->query($registroF30); 

//F31	
$registroF31 = "SELECT DISTINCT 
   CONCAT('F31') AS 'Codigo', CONCAT('Trastorno del humor (Bipolar)') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where6; 
$resultF31 = $mysqli->query($registroF31);    

//F32 - F39
$registroF32 = "SELECT DISTINCT 
   CONCAT('F32-F39') AS 'Codigo', CONCAT('Trastorno del humor episodio depresivo') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente 	   
   ".$where7;
$resultF32 = $mysqli->query($registroF32);    

//F40 - F49
$registroF40 = "SELECT DISTINCT 
   CONCAT('F40-F49') AS 'Codigo', CONCAT('Trastorno Neuroticos, secundarios a situaciones estresantes y somatomorfos') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where8;
$resultF40 = $mysqli->query($registroF40);    

//F50 - F59
$registroF50 = "SELECT DISTINCT 
   CONCAT('F50-F59') AS 'Codigo', CONCAT('Trastorno del comportamiento asociadas a disfunciones fisiológicas y a factores somáticos') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where9;
$resultF50 = $mysqli->query($registroF50);    

//F60 - F69
$registroF60 = "SELECT DISTINCT 
   CONCAT('F60-F69') AS 'Codigo', CONCAT('Trastorno de la personalidad y del comportamiento del adulto') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    	   
   ".$where10;
$resultF60 = $mysqli->query($registroF60);    

//F70 - F70
$registroF70 = "SELECT DISTINCT 
   CONCAT('F70-F79') AS 'Codigo', CONCAT('Retraso Mental') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where11;
$resultF70 = $mysqli->query($registroF70);    

//F80 - F89
$registroF80 = "SELECT DISTINCT 
   CONCAT('F80-F89') AS 'Codigo', CONCAT('Trastorno del desarrollo psicológico') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where12;
$resultF80 = $mysqli->query($registroF80); 

//F90 - F98
$registroF90 = "SELECT DISTINCT 
   CONCAT('F90-F98') AS 'Codigo', CONCAT('Trastornos del comportamiento y de las emociones del comienzo habitual en la infancia y la adolescencia') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    	   
   ".$where13;
$resultF90 = $mysqli->query($registroF90);    

//F99
$registroF99 = "SELECT DISTINCT 
   CONCAT('F99') AS 'Codigo', CONCAT('Trastorno Mental sin especificación') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente      
   ".$where14;
$resultF99 = $mysqli->query($registroF99);    

//G40-G40.9
$registroG40 = "SELECT DISTINCT 
   CONCAT('G40-G40.9') AS 'Codigo', CONCAT('Epilepsia') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where15;
$resultG40 = $mysqli->query($registroG40);    
   
//G41-G41.9
$registroG41 = "SELECT DISTINCT 
   CONCAT('G41-G41.9') AS 'Codigo', CONCAT('Estado de mal epiléptico (status) gran mal y pequeño mal, complejo, otros de tipo no especificado') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente     
   ".$where16; 
$resultG41 = $mysqli->query($registroG41);   

//X60-X69
$registroX60 = "SELECT DISTINCT 
   CONCAT('X60-X69') AS 'Codigo', CONCAT('Envenenamiento o lesión intencionalmente autoinflingida, intento suicidio por diferentes medios') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    	   
   ".$where17; 
$resultX60 = $mysqli->query($registroX60);    

//X70-X89
$registroX70 = "SELECT DISTINCT 
   CONCAT('X70-X89') AS 'Codigo', CONCAT('Suicidio y Lesión intencionalmente autoinflingida por diferentes medios') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente 	   
   ".$where18;
$resultX70 = $mysqli->query($registroX70);    

//X85-X99
$registroX85 = "SELECT DISTINCT 
CONCAT('X85-X99') AS 'Codigo', CONCAT('Agresión, lesiones ocasionadas por otra persona con intento de lesionar o matar por cualquier medio (incluye intento de homicidio, homicidio)') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',  
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where19;
$resultX85 = $mysqli->query($registroX85);   

//Y00-Y03
$registroY00 = "SELECT DISTINCT 
   CONCAT('Y00-Y03') AS 'Codigo', CONCAT('Agresión con objeto romo o sin filo, por empujón, atropello deliberado con vehículo de motor, (incluye intento de homicidio, homicidio)') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where20; 
$resultY00 = $mysqli->query($registroY00);    

//Y04
$registroY04 = "SELECT DISTINCT 
   CONCAT('Y04') AS 'Codigo', CONCAT('Agresión con fuerza corporal (incluye lucha o peleas sin armas, homicidio)') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where21;
$resultY04 = $mysqli->query($registroY04);    

//Y05
$registroY05 = "SELECT DISTINCT 
   CONCAT('Y05') AS 'Codigo', CONCAT('Agresión sexual con fuerza corporal (incluye intento de violación, violación)') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where22;  
$resultY05 = $mysqli->query($registroY05); 
   
//Y06
$registroY06 = "SELECT DISTINCT 
   CONCAT('Y06') AS 'Codigo', CONCAT('Negligencia y Abandono') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where23;   
$resultY06 = $mysqli->query($registroY06); 

//Y07
$registroY07 = "SELECT DISTINCT 
   CONCAT('Y07') AS 'Codigo', CONCAT('Otros sindromes de maltrato (crueldad mental, abuso físico, abuso sexual y tortura)') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',  
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where24; 
$resultY07 = $mysqli->query($registroY07); 

//Y08
$registroY08 = "SELECT DISTINCT 
   CONCAT('Y08') AS 'Codigo', CONCAT('Agresión por otros medios especificados') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where25; 
$resultY08 = $mysqli->query($registroY08);    

//Y09
$registroY09 = "SELECT DISTINCT 
   CONCAT('Y09') AS 'Codigo', CONCAT('Agresión por medios no especificados') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where26;  
$resultY09 = $mysqli->query($registroY09);    

//T74.1
$registroT74A = "SELECT DISTINCT 
   CONCAT('T74.1') AS 'Codigo', CONCAT('Abuso Físico') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',  
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where27;  
$resultT74A = $mysqli->query($registroT74A); 

//T74.2
$registroT74B = "SELECT DISTINCT 
   CONCAT('T74.2') AS 'Codigo', CONCAT('Abuso Sexual') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where28; 
$resultT74B = $mysqli->query($registroT74B);    

//T74.3
$registroT74C = "SELECT DISTINCT 
   CONCAT('T74.3') AS 'Codigo', CONCAT('Abuso Psicológico') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    	   
   ".$where29;  
$resultT74C = $mysqli->query($registroT74C);   

//AA206
$registroAA206 = "SELECT DISTINCT 
   CONCAT('AA206') AS 'Codigo', CONCAT('(Violación) intimidación o engaño') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where30; 
$resultAA206 = $mysqli->query($registroAA206);   

//AA207
$registroAA207 = "SELECT DISTINCT 
   CONCAT('AA207') AS 'Codigo', CONCAT('Violación Física') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where31; 
$resultAA207 = $mysqli->query($registroAA207);    

//AA208
$registroAA208 = "SELECT DISTINCT 
   CONCAT('AA208') AS 'Codigo', CONCAT('Violación Sexual') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',  
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    	   
   ".$where32;
$resultAA208 = $mysqli->query($registroAA208);    

//AA175
$registroAA175 = "SELECT DISTINCT 
   CONCAT('AA175') AS 'Codigo', CONCAT('Violación Psicológica') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where33; 
$resultAA175 = $mysqli->query($registroAA175);    

//AA210
$registroAA210 = "SELECT DISTINCT 
   CONCAT('AA210') AS 'Codigo', CONCAT('Violación Patrimonial / económica') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where34; 
$resultAA210 = $mysqli->query($registroAA210);    

//Z00-Z13
$registroZ00 = "SELECT DISTINCT 
   CONCAT('Z00-Z13') AS 'Codigo', CONCAT('Pruebas para aclarar o investigar problemas de salud') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente  	   
   ".$where35; 
$resultZ00 = $mysqli->query($registroZ00);  

//Z20-Z29
$registroZ20 = "SELECT DISTINCT 
   CONCAT('Z20-Z29') AS 'Codigo', CONCAT('Contacto y exposición a enfermedades contagiosas') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente       
   ".$where36;
$resultZ20 = $mysqli->query($registroZ20);    

//Z30-Z39
$registroZ30 = "SELECT DISTINCT 
   CONCAT('Z30-Z39') AS 'Codigo', CONCAT('Intervenciones relativas a la reproducción') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',  
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where37; 
$resultZ30 = $mysqli->query($registroZ30);    

//Z40-Z54
$registroZ40 = "SELECT DISTINCT 
   CONCAT('Z40-Z54') AS 'Codigo', CONCAT('Personas candidatas a cirugía') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente      
   ".$where38; 
$resultZ40 = $mysqli->query($registroZ40);    

//Z55-Z65
$registroZ55 = "SELECT DISTINCT 
   CONCAT('Z55-Z65') AS 'Codigo', CONCAT('Personas con problemas potenciales psíquicos o psicosociales') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente   	   
   ".$where39;  
$resultZ55 = $mysqli->query($registroZ55);   

//Z70-Z76
$registro70 = "SELECT DISTINCT 
   CONCAT('Z70-Z76') AS 'Codigo', CONCAT('Consultas') AS 'Enfermedad', 
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente 	   
   ".$where40; 
$resultZ70 = $mysqli->query($registro70);      

//Z80-Z99
$registro80 = "SELECT DISTINCT 
   CONCAT('Z80-Z99') AS 'Codigo', CONCAT('Historias') AS 'Enfermedad',  
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',   
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where41;
$resultZ80 = $mysqli->query($registro80);      

//NPP
$registroNPP = "SELECT DISTINCT 
   CONCAT('NPP') AS 'Codigo', CONCAT('No Presenta Patologías') AS 'Enfermedad',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'NUEVO_H',
   COUNT(CASE WHEN (a.paciente = 'N' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'NUEVO_M',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'H') THEN rr.patologia_id END) AS 'SUBSIG_H',
   COUNT(CASE WHEN (a.paciente = 'S' AND p.sexo = 'M') THEN rr.patologia_id END) AS 'SUBSIG_M',    
   COUNT(a.paciente) AS 'Total'
   FROM referencia_recibida AS rr
   INNER JOIN ata As a
   ON rr.ata_id = a.ata_id
   INNER JOIN pacientes AS p
   ON rr.expediente = p.expediente    
   ".$where42; 
$resultNPP = $mysqli->query($registroNPP);      
   
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("PATOLOGIAS ".strtoupper($servicio_name)); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
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
$objPHPExcel->getActiveSheet()->setTitle("PATOLOGIAS"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('C6'); //INMOVILIZA PANELES
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
$objDrawing->setWidth(55); //anchura
$objDrawing->setHeight(50); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('F1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);

$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:G$fila");
 
$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REFERENCIAS RECIBIDAS Y RESPUESTAS ENVIADAS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:G$fila");
 
$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2 ".strtoupper($servicio_name));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:G$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:G$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ENFERMEDAD');;
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(75);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NUEVO H');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NUEVO M');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'SUBSIG H');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'SUBSIG M');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10); 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '%');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);  
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:H$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:H$fila")->getFont()->setBold(true); //negrita
//rellenar con contenido
$valor = 1;
$total = 0; $totalnh = 0; $totalnm = 0; $totalsh = 0; $totalsm = 0; $totalt = 0;
if($resultF00->num_rows>0){
	if($resultF00->num_rows>0){
		while($registroF00_1 = $resultF00->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF00_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF00_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF00_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF00_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF00_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF00_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF00_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");	
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
	   
	       $valor++;
		   $total = $total + $registroF00_1['Total'];
		   $totalnh = $totalnh +  $registroF00_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF00_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroF00_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF00_1['SUBSIG_M'];		   
     }	
   }	
   
 	if($resultF10->num_rows>0){
		while($registroF10_1 = $resultF10->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF10_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF10_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF10_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF10_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF10_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF10_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF10_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");	
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF10_1['Total'];
		   $totalnh = $totalnh +  $registroF10_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF10_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroF10_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF10_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF20->num_rows>0){
		while($registroF20_1 = $resultF20->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF20_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF20_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF20_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF20_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF20_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF20_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF20_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita		   
		   
	       $valor++;
		   $total = $total + $registroF20_1['Total'];
		   $totalnh = $totalnh +  $registroF20_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF20_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF10_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF10_1['SUBSIG_M'];			   
     }	
   }	

	if($resultF30->num_rows>0){
		while($registroF30_1 = $resultF30->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF30_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF30_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF30_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF30_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF30_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF30_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF30_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");	
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF30_1['Total'];
		   $totalnh = $totalnh +  $registroF30_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF30_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF30_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF30_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF31->num_rows>0){
		while($registroF31_1 = $resultF31->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF31_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF31_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF31_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF31_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF31_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF31_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF31_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");	
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF31_1['Total'];
		   $totalnh = $totalnh +  $registroF31_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF31_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroF31_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF31_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF32->num_rows>0){
		while($registroF32_1 = $resultF32->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF32_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF32_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF32_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF32_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF32_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF32_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF32_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF32_1['Total'];
		   $totalnh = $totalnh +  $registroF32_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF32_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF32_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF32_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF40->num_rows>0){
		while($registroF40_1 = $resultF40->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF40_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF40_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF40_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF40_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF40_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF40_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF40_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF40_1['Total'];
		   $totalnh = $totalnh +  $registroF40_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF40_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroF40_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF40_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF50->num_rows>0){
		while($registroF50_1 = $resultF50->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF50_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF50_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF50_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF50_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF50_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF50_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF50_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");		   
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
		   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF50_1['Total'];
		   $totalnh = $totalnh +  $registroF50_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF50_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF50_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF50_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF60->num_rows>0){
		while($registroF60_1 = $resultF60->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF60_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF60_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF60_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF60_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF60_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF60_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF60_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita		   
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF60_1['Total'];
		   $totalnh = $totalnh +  $registroF60_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF60_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroF60_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF60_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF70->num_rows>0){
		while($registroF70_1 = $resultF70->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF70_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF70_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF70_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF70_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF70_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF70_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF70_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita		   
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF70_1['Total'];
		   $totalnh = $totalnh +  $registroF70_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF70_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF70_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF70_1['SUBSIG_M'];			   
     }	
   }	

	if($resultF80->num_rows>0){
		while($registroF80_1 = $resultF80->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF80_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF80_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF80_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF80_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF80_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF80_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF80_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita		   
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF80_1['Total'];
		   $totalnh = $totalnh +  $registroF80_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF80_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroF80_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF80_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF90->num_rows>0){
		while($registroF90_1 = $resultF90->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF90_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF90_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF90_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF90_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF90_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF90_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF90_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");

           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita		   
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF90_1['Total'];
		   $totalnh = $totalnh +  $registroF90_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF90_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF90_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF90_1['SUBSIG_M'];		   
     }	
   }	

	if($resultF99->num_rows>0){
		while($registroF99_1 = $resultF99->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroF99_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroF99_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroF99_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroF99_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroF99_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroF99_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroF99_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
           $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita		   
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroF99_1['Total'];
		   $totalnh = $totalnh +  $registroF99_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroF99_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroF99_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroF99_1['SUBSIG_M'];		   
     }	
   }

	if($resultG40->num_rows>0){
		while($registroG40_1 = $resultG40->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroG40_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroG40_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroG40_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroG40_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroG40_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroG40_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroG40_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");	
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroG40_1['Total'];
		   $totalnh = $totalnh +  $registroG40_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroG40_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroG40_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroG40_1['SUBSIG_M'];		   
     }	
   }	
   
	if($resultG41->num_rows>0){
		while($registroG41_1 = $resultG41->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroG41_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroG41_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroG41_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroG41_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroG41_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroG41_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroG41_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroG41_1['Total'];
		   $totalnh = $totalnh +  $registroG41_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroG41_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroG41_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroG41_1['SUBSIG_M'];			   
		   
     }	
   }

	if($resultX60->num_rows>0){
		while($registroX60_1 = $resultX60->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroX60_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroX60_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroX60_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroX60_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroX60_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroX60_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroX60_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroX60_1['Total'];
		   $totalnh = $totalnh +  $registroX60_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroX60_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroX60_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroX60_1['SUBSIG_M'];			   
     }	
   }  

	if($resultX70->num_rows>0){
		while($registroX70_1 = $resultX70->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroX70_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroX70_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroX70_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroX70_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroX70_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroX70_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroX70_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroX70_1['Total'];
		   $totalnh = $totalnh +  $registroX70_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroX70_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroX70_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroX70_1['SUBSIG_M'];			   
     }	
   } 

	if($resultX85->num_rows>0){
		while($registroX85_1 = $resultX85->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroX85_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroX85_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroX85_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroX85_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroX85_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroX85_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroX85_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroX85_1['Total'];
		   $totalnh = $totalnh +  $registroX85_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroX85_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroX85_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroX85_1['SUBSIG_M'];		   
     }	
   }

	if($resultY00->num_rows>0){
		while($registroY00_1 = $resultY00->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY00_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY00_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY00_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY00_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY00_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY00_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY00_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY00_1['Total'];
		   $totalnh = $totalnh +  $registroY00_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY00_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY00_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY00_1['SUBSIG_M'];		   
     }	
   }   
   
   if($resultY04->num_rows>0){
		while($registroY04_1 = $resultY04->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY04_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY04_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY04_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY04_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY04_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY04_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY04_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY04_1['Total'];
		   $totalnh = $totalnh +  $registroY04_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY04_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY04_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY04_1['SUBSIG_M'];			   
     }	
   }  

	if($resultY05->num_rows>0){
		while($registroY05_1 = $resultY05->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY05_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY05_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY05_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY05_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY05_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY05_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY05_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY05_1['Total'];
		   $totalnh = $totalnh +  $registroY05_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY05_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY05_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY05_1['SUBSIG_M'];		   
     }	
   }  

	if($resultY06->num_rows>0){
		while($registroY06_1 = $resultY06->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY06_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY06_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY06_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY06_1['NUEVO_M']);;
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY06_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY06_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY06_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY06_1['Total'];
		   $totalnh = $totalnh +  $registroY06_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY06_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY06_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY06_1['SUBSIG_M'];			   
     }	
   }    

	if($resultY07->num_rows>0){
		while($registroY07_1 = $resultY07->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY07_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY07_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY07_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY07_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY07_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY07_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY07_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY07_1['Total'];
		   $totalnh = $totalnh +  $registroY07_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY07_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY07_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY07_1['SUBSIG_M'];		   
     }	
   }       

	if($resultY08->num_rows>0){
		while($registroY08_1 = $resultY08->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY08_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY08_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY08_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY08_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY08_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY08_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY08_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY08_1['Total'];
		   $totalnh = $totalnh +  $registroY08_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY08_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY08_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY08_1['SUBSIG_M'];		   
     }	
   } 

	if($resultY09->num_rows>0){
		while($registroY09_1 = $resultY09->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroY09_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroY09_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroY09_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroY09_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroY09_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroY09_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroY09_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroY09_1['Total'];
		   $totalnh = $totalnh +  $registroY09_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroY09_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroY09_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroY09_1['SUBSIG_M'];			   
     }	
   } 

	if($resultT74A->num_rows>0){
		while($registroT74A_1 = $resultT74A->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroT74A_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroT74A_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroT74A_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroT74A_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroT74A_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroT74A_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroT74A_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroT74A_1['Total'];
		   $totalnh = $totalnh +  $registroT74A_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroT74A_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroT74A_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroT74A_1['SUBSIG_M'];		   
     }	
   } 

	if($resultT74B->num_rows>0){
		while($registroT74B_1 = $resultT74B->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroT74B_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroT74B_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroT74B_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroT74B_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroT74B_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroT74B_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroT74B_1['Total']);	
                      $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroT74B_1['Total'];
		   $totalnh = $totalnh +  $registroT74B_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroT74B_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroT74B_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroT74B_1['SUBSIG_M'];			   
     }	
   } 

	if($resultT74C->num_rows>0){
		while($registroT74C_1 = $resultT74C->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroT74C_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroT74C_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroT74C_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroT74C_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroT74C_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroT74C_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroT74C_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroT74C_1['Total'];
		   $totalnh = $totalnh +  $registroT74C_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroT74C_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroT74C_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroT74C_1['SUBSIG_M'];		   
     }	
   }  

	if($resultAA206->num_rows>0){
		while($registroAA206_1 = $resultAA206->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA206_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA206_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA206_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA206_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA206_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA206_1['SUBSIG_M']);	   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA206_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroAA206_1['Total'];
		   $totalnh = $totalnh +  $registroAA206_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroAA206_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroAA206_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroAA206_1['SUBSIG_M'];		   
     }	
   }   

	if($resultAA207->num_rows>0){
		while($registroAA207_1 = $resultAA207->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA207_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA207_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA207_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA207_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA207_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA207_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA207_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroAA207_1['Total'];
		   $totalnh = $totalnh +  $registroAA207_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroAA207_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroAA207_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroAA207_1['SUBSIG_M'];			   
     }	
   }    

	if($resultAA208->num_rows>0){
		while($registroAA208_1 = $resultAA208->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA208_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA208_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA208_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA208_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA208_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA208_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA208_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroAA208_1['Total'];
		   $totalnh = $totalnh +  $registroAA208_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroAA208_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroAA208_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroAA208_1['SUBSIG_M'];			   
     }	
   } 

	if($resultAA175->num_rows>0){
		while($registroAA175_1 = $resultAA175->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA175_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA175_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA175_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA175_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA175_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA175_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA175_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroAA175_1['Total'];
		   $totalnh = $totalnh +  $registroAA175_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroAA175_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroAA175_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroAA175_1['SUBSIG_M'];		   
     }	
   }    
   
	if($resultAA210->num_rows>0){
		while($registroAA210_1 = $resultAA210->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroAA210_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroAA210_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroAA210_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroAA210_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroAA210_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroAA210_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroAA210_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroAA210_1['Total'];
		   $totalnh = $totalnh +  $registroAA210_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroAA210_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroAA210_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroAA210_1['SUBSIG_M'];		   
     }	
   }   

	if($resultZ00->num_rows>0){
		while($registroZ00_1 = $resultZ00->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ00_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ00_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ00_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ00_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ00_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ00_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ00_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroZ00_1['Total'];
		   $totalnh = $totalnh +  $registroZ00_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroZ00_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroZ00_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroZ00_1['SUBSIG_M'];		   
     }	
   }    

	if($resultZ20->num_rows>0){
		while($registroZ20_1 = $resultZ20->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ20_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ20_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ20_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ20_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ20_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ20_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ20_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroZ20_1['Total'];
		   $totalnh = $totalnh +  $registroZ20_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroZ20_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroZ20_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroZ20_1['SUBSIG_M'];		   
     }	
   }    

	if($resultZ30->num_rows>0){
		while($registroZ30_1 = $resultZ30->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ30_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ30_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ30_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ30_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ30_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ30_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ30_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroZ30_1['Total'];
		   $totalnh = $totalnh +  $registroZ30_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroZ30_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroZ30_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroZ30_1['SUBSIG_M'];		   
     }	
   }  

	if($resultZ40->num_rows>0){
		while($registroZ40_1 = $resultZ40->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ40_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ40_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ40_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ40_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ40_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ40_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ40_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroZ40_1['Total'];
		   $totalnh = $totalnh +  $registroZ40_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroZ40_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registroZ40_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroZ40_1['SUBSIG_M'];		   
     }	
   }  

	if($resultZ55->num_rows>0){
		while($registroZ55_1 = $resultZ55->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroZ55_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroZ55_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroZ55_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroZ55_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroZ55_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroZ55_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroZ55_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroZ55_1['Total'];
		   $totalnh = $totalnh +  $registroZ55_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroZ55_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroZ55_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroZ55_1['SUBSIG_M'];		   
     }	
   } 

	if($resultZ70->num_rows>0){
		while($registro70_1 = $resultZ70->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro70_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro70_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro70_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro70_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro70_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro70_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro70_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registro70_1['Total'];
		   $totalnh = $totalnh +  $registro70_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registro70_1['NUEVO_M'];
		   $totalsh = $totalsh + $registro70_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registro70_1['SUBSIG_M'];		   
     }	
   }  

	if($resultZ80->num_rows>0){
		while($registro80_1 = $resultZ80->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro80_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro80_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro80_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro80_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro80_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro80_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro80_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registro80_1['Total'];
		   $totalnh = $totalnh +  $registro80_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registro80_1['NUEVO_M'];	
		   $totalsh = $totalsh + $registro80_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registro80_1['SUBSIG_M'];			   
     }	
   } 

	if($resultNPP->num_rows>0){
		while($registroNPP_1 = $resultNPP->fetch_assoc()){
	       $fila+=1;
		   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registroNPP_1['Codigo']);
	       $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registroNPP_1['Enfermedad']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registroNPP_1['NUEVO_H']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registroNPP_1['NUEVO_M']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registroNPP_1['SUBSIG_H']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registroNPP_1['SUBSIG_M']);		   
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registroNPP_1['Total']);	
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "=ROUND((G$fila/G47)*100,2)");
		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
		   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getFont()->setBold(true); //negrita
           $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getFont()->setBold(true); //negrita
		   
	       $valor++;
		   $total = $total + $registroNPP_1['Total'];
		   $totalnh = $totalnh +  $registroNPP_1['NUEVO_H'];
		   $totalnm = $totalnm +  $registroNPP_1['NUEVO_M'];
		   $totalsh = $totalsh + $registroNPP_1['SUBSIG_H'];
		   $totalsm = $totalsm + $registroNPP_1['SUBSIG_M'];			   
     }	
   }    
   
   
}	
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "TOTAL");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $totalnh);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $totalnm);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $totalsh);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $totalsm);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $total);
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:H$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila:H$fila")->getFont()->setBold(true); //negrita
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
header('Content-Disposition: attachment; filename="REPORTE PATOLOGIAS REFERENCIAS RECIBIDAS '.strtoupper($servicio_name).' '.strtoupper($mes).'_'.$año.'.xls"');
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