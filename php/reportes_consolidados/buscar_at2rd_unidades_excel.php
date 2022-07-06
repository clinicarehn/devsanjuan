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

$servicio_name = "C.E General";

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

$unidad_name = "";

if($servicio==""){
	$servicio = "1,3,4,6,7,12,14";
}else{
	$servicio = "1,3,4,6,7,12,14";
}

if ($servicio != "" && $unidad == ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 1 AND 4";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 5 AND 9";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 10 AND 14";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 15 AND 19";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 20 AND 49";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 50 AND 59";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años >= 60";
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.")";	
}else{
    //OBTENER NOMBRE UNIDAD
    $consulta_unidad = "SELECT nombre 
	    FROM puesto_colaboradores 
		WHERE puesto_id = '$unidad'";
	$result = $mysqli->query($consulta_unidad);
    $consulta_unidad1 = $result->fetch_assoc();
    $unidad_name = $consulta_unidad1['nombre'];
		
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 1 AND 4 AND c.puesto_id = '$unidad'";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 5 AND 9 AND c.puesto_id = '$unidad'";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 10 AND 14 AND c.puesto_id = '$unidad'";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 15 AND 19 AND c.puesto_id = '$unidad'";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 20 AND 49 AND c.puesto_id = '$unidad'";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años BETWEEN 50 AND 59 AND c.puesto_id = '$unidad'";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND a.años >= 60 AND c.puesto_id = '$unidad'";
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id IN(".$servicio.") AND c.puesto_id = '$unidad'";	
}	
	
//EJECUTAMOS LA CONSULTA DE BUSQUEDA
//REGISTROS
$registro = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where."
   GROUP BY 1";
$result = $mysqli->query($registro);
   
//DE 1 - 4 AÑOS
$registro1_4 = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where1."   
   GROUP BY 1";
$result1_4 = $mysqli->query($registro1_4);

//DE 5 - 9 AÑOS
$registro5_9 = "SELECT DISTINCT 
   CONCAT('5 - 9 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where2."   
   GROUP BY 1";
$result5_9 = $mysqli->query($registro5_9);   

//DE 10- 14 AÑOS
$registro10_14 = "SELECT DISTINCT 
   CONCAT('10 - 14 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where3."   
   GROUP BY 1";
$result10_14 = $mysqli->query($registro10_14);     

//DE 15 - 19 AÑOS
$registro15_19 = "SELECT DISTINCT 
   CONCAT('15 - 19 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where4."   
   GROUP BY 1";
$result15_19 = $mysqli->query($registro15_19);    

//DE 20 - 49 AÑOS 
$registro20_49 = "SELECT DISTINCT 
   CONCAT('20 - 49 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where5."   
   GROUP BY 1";
$result20_49 = $mysqli->query($registro20_49);    

//DE 50 - 59 AÑOS
$registro50_59 = "SELECT DISTINCT 
   CONCAT('50 - 59 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where6."   
   GROUP BY 1";
$result50_59 = $mysqli->query($registro50_59);    

//MAS 60
$registro60 = "SELECT DISTINCT 
   CONCAT('60 Y + años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN a.paciente END) AS '1',  
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN a.paciente END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN a.paciente END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN a.paciente END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN a.paciente END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN a.paciente END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN a.paciente END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN a.paciente END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN a.paciente END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN a.paciente END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN a.paciente END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN a.paciente END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN a.paciente END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN a.paciente END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN a.paciente END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN a.paciente END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN a.paciente END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN a.paciente END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN a.paciente END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN a.paciente END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN a.paciente END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN a.paciente END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN a.paciente END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN a.paciente END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN a.paciente END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN a.paciente END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN a.paciente END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN a.paciente END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN a.paciente END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN a.paciente END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN a.paciente END) AS '31',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where7."   
   GROUP BY 1";
$result60 = $mysqli->query($registro60);    

//CONSULTA SEXO USUARIOS
$sexo = "SELECT DISTINCT 
   (CASE WHEN p.sexo = 'H' THEN 'No. Atención Hombres' ELSE 'No. Atención Mujeres' END) AS 'Sexo',
   COUNT(CASE WHEN DAY(a.fecha) = 1 THEN p.sexo END) AS '1', 
   COUNT(CASE WHEN DAY(a.fecha) = 2 THEN p.sexo END) AS '2',
   COUNT(CASE WHEN DAY(a.fecha) = 3 THEN p.sexo END) AS '3',
   COUNT(CASE WHEN DAY(a.fecha) = 4 THEN p.sexo END) AS '4',
   COUNT(CASE WHEN DAY(a.fecha) = 5 THEN p.sexo END) AS '5',
   COUNT(CASE WHEN DAY(a.fecha) = 6 THEN p.sexo END) AS '6',
   COUNT(CASE WHEN DAY(a.fecha) = 7 THEN p.sexo END) AS '7',
   COUNT(CASE WHEN DAY(a.fecha) = 8 THEN p.sexo END) AS '8',
   COUNT(CASE WHEN DAY(a.fecha) = 9 THEN p.sexo END) AS '9',
   COUNT(CASE WHEN DAY(a.fecha) = 10 THEN p.sexo END) AS '10',
   COUNT(CASE WHEN DAY(a.fecha) = 11 THEN p.sexo END) AS '11',
   COUNT(CASE WHEN DAY(a.fecha) = 12 THEN p.sexo END) AS '12',
   COUNT(CASE WHEN DAY(a.fecha) = 13 THEN p.sexo END) AS '13',
   COUNT(CASE WHEN DAY(a.fecha) = 14 THEN p.sexo END) AS '14',
   COUNT(CASE WHEN DAY(a.fecha) = 15 THEN p.sexo END) AS '15',
   COUNT(CASE WHEN DAY(a.fecha) = 16 THEN p.sexo END) AS '16',
   COUNT(CASE WHEN DAY(a.fecha) = 17 THEN p.sexo END) AS '17',
   COUNT(CASE WHEN DAY(a.fecha) = 18 THEN p.sexo END) AS '18',
   COUNT(CASE WHEN DAY(a.fecha) = 19 THEN p.sexo END) AS '19',
   COUNT(CASE WHEN DAY(a.fecha) = 20 THEN p.sexo END) AS '20',
   COUNT(CASE WHEN DAY(a.fecha) = 21 THEN p.sexo END) AS '21',
   COUNT(CASE WHEN DAY(a.fecha) = 22 THEN p.sexo END) AS '22',
   COUNT(CASE WHEN DAY(a.fecha) = 23 THEN p.sexo END) AS '23',
   COUNT(CASE WHEN DAY(a.fecha) = 24 THEN p.sexo END) AS '24',
   COUNT(CASE WHEN DAY(a.fecha) = 25 THEN p.sexo END) AS '25',
   COUNT(CASE WHEN DAY(a.fecha) = 26 THEN p.sexo END) AS '26',
   COUNT(CASE WHEN DAY(a.fecha) = 27 THEN p.sexo END) AS '27',
   COUNT(CASE WHEN DAY(a.fecha) = 28 THEN p.sexo END) AS '28',
   COUNT(CASE WHEN DAY(a.fecha) = 29 THEN p.sexo END) AS '29',
   COUNT(CASE WHEN DAY(a.fecha) = 30 THEN p.sexo END) AS '30',
   COUNT(CASE WHEN DAY(a.fecha) = 31 THEN p.sexo END) AS '31',
   COUNT(p.sexo) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id     
   ".$where8."   
   GROUP BY 1";
$resultSexo = $mysqli->query($sexo);   

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("AT2R DIARIO ".strtoupper($unidad_name)); //titulo
 
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
    )
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("AT2R DIARIO ".strtoupper($unidad_name)); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('C7'); //INMOVILIZA PANELES
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
$objDrawing->setPath('../../img/escudo.jpg'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal.jpg'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('AG1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Secretaría de Salud - Departamento de Estadisticas");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AH$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AH$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "INFORME DIARIO DE ATENCIONES AMBULATORIAS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:AH$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:AH$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", "AT2");
$objPHPExcel->getActiveSheet()->mergeCells("AC$fila:AF$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "AC$fila:AF$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Región Salud: Número 5 Nivel  2  ");
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Establecimiento Hospital San Juan de Dios  ");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:N$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("P$fila:AB$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "B$fila:AB$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Tipo de Profefsional de Salud ");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Código: 85499");
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $servicio_name.' '.$unidad_name);
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:N$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "Emergencia");
$objPHPExcel->getActiveSheet()->mergeCells("P$fila:AB$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "B$fila:AB$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Concepto');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(90); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '1');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '2');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '3');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '4');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '5');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '6');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '7');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '8');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '9');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '10');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '11');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '12');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", '13');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '14');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '15');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '16');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '17');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '18');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", '19');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", '20');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", '21');
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", '22');
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", '23');
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", '24');
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", '25');
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", '26');
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", '27');
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", '28');
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", '29');
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", '30');
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", '31');
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(5); 
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'Total');
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(8);  


$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:AH$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:AH$fila")->getFont()->setBold(true); //negrita

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "1");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Menores de 1 Mes de 1a. Vez");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	

$fila=8;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "2");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Menores de 1 Mes Subsiguiente");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	

$fila=9;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "3");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1 mes a 1 año de 1a. Vez");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	

$fila=10;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "4");
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1 mes a 1 año Subsiguiente");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	

//rellenar con contenido
$valor = 5;
$total = 0; $total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0; $total7 = 0; $total8 = 0;
$total9 = 0; $total10 = 0; $total11 = 0; $total12 = 0; $total13 = 0; $total14 = 0; $total15 = 0; $total16 = 0; $total17 = 0; 
$total18 = 0; $total19 = 0; $total20 = 0; $total21 = 0; $total22 = 0; $total23 = 0; $total24 = 0; $total25 = 0; $total26 = 0;
$total27 = 0; $total28 = 0; $total29 = 0; $total30 = 0; $total31 = 0;

if($result->num_rows>0){
	if($result1_4->num_rows>0){
		while($registro1_4_1 = $result1_4->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro1_4_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro1_4_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro1_4_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro1_4_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro1_4_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro1_4_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro1_4_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro1_4_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro1_4_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro1_4_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro1_4_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro1_4_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro1_4_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro1_4_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro1_4_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro1_4_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro1_4_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro1_4_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro1_4_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro1_4_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro1_4_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro1_4_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro1_4_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro1_4_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro1_4_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro1_4_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro1_4_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro1_4_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro1_4_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro1_4_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro1_4_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro1_4_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro1_4_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro1_4_1['Total'];
		   $total1 = $total1 + $registro1_4_1['1'];
		   $total2 = $total2 + $registro1_4_1['2'];
		   $total3 = $total3 + $registro1_4_1['3'];
		   $total4 = $total4 + $registro1_4_1['4'];
		   $total5 = $total5 + $registro1_4_1['5'];
		   $total6 = $total6 + $registro1_4_1['6'];
		   $total7 = $total7 + $registro1_4_1['7'];
		   $total8 = $total8 + $registro1_4_1['8'];
		   $total9 = $total9 + $registro1_4_1['9'];
		   $total10 = $total10 + $registro1_4_1['10'];
		   $total11 = $total11 + $registro1_4_1['11'];
		   $total12 = $total12 + $registro1_4_1['12'];
		   $total13 = $total13 + $registro1_4_1['13'];
		   $total14 = $total14 + $registro1_4_1['14'];
		   $total15 = $total15 + $registro1_4_1['15'];
		   $total16 = $total16 + $registro1_4_1['16'];
		   $total17 = $total17 + $registro1_4_1['17'];
		   $total18 = $total18 + $registro1_4_1['18'];
		   $total19 = $total19 + $registro1_4_1['19'];
		   $total20 = $total20 + $registro1_4_1['20'];
		   $total21 = $total21+ $registro1_4_1['21'];
		   $total22 = $total22 + $registro1_4_1['22'];
		   $total23 = $total23 + $registro1_4_1['23'];
		   $total24 = $total24 + $registro1_4_1['24'];
		   $total25 = $total25 + $registro1_4_1['25'];
		   $total26 = $total26 + $registro1_4_1['26'];
		   $total27 = $total27 + $registro1_4_1['27'];
		   $total28 = $total28 + $registro1_4_1['28'];
		   $total29 = $total29 + $registro1_4_1['29'];
		   $total30 = $total30 + $registro1_4_1['30'];
		   $total31 = $total31 + $registro1_4_1['31'];
     }	
   } 
   
   if($result5_9->num_rows>0){
		while($registro5_9_1 = $result5_9->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro5_9_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro5_9_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro5_9_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro5_9_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro5_9_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro5_9_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro5_9_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro5_9_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro5_9_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro5_9_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro5_9_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro5_9_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro5_9_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro5_9_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro5_9_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro5_9_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro5_9_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro5_9_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro5_9_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro5_9_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro5_9_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro5_9_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro5_9_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro5_9_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro5_9_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro5_9_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro5_9_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro5_9_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro5_9_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro5_9_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro5_9_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro5_9_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro5_9_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro5_9_1['Total'];
		   $total1 = $total1 + $registro5_9_1['1'];
		   $total2 = $total2 + $registro5_9_1['2'];
		   $total3 = $total3 + $registro5_9_1['3'];
		   $total4 = $total4 + $registro5_9_1['4'];
		   $total5 = $total5 + $registro5_9_1['5'];
		   $total6 = $total6 + $registro5_9_1['6'];
		   $total7 = $total7 + $registro5_9_1['7'];
		   $total8 = $total8 + $registro5_9_1['8'];
		   $total9 = $total9 + $registro5_9_1['9'];
		   $total10 = $total10 + $registro5_9_1['10'];
		   $total11 = $total11 + $registro5_9_1['11'];
		   $total12 = $total12 + $registro5_9_1['12'];
		   $total13 = $total13 + $registro5_9_1['13'];
		   $total14 = $total14 + $registro5_9_1['14'];
		   $total15 = $total15 + $registro5_9_1['15'];
		   $total16 = $total16 + $registro5_9_1['16'];
		   $total17 = $total17 + $registro5_9_1['17'];
		   $total18 = $total18 + $registro5_9_1['18'];
		   $total19 = $total19 + $registro5_9_1['19'];
		   $total20 = $total20 + $registro5_9_1['20'];
		   $total21 = $total21+ $registro5_9_1['21'];
		   $total22 = $total22 + $registro5_9_1['22'];
		   $total23 = $total23 + $registro5_9_1['23'];
		   $total24 = $total24 + $registro5_9_1['24'];
		   $total25 = $total25 + $registro5_9_1['25'];
		   $total26 = $total26 + $registro5_9_1['26'];
		   $total27 = $total27 + $registro5_9_1['27'];
		   $total28 = $total28 + $registro5_9_1['28'];
		   $total29 = $total29 + $registro5_9_1['29'];
		   $total30 = $total30 + $registro5_9_1['30'];
		   $total31 = $total31 + $registro5_9_1['31'];
     }	
   }	

	if($result10_14->num_rows>0){
		while($registro10_14_1 = $result10_14->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro10_14_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro10_14_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro10_14_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro10_14_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro10_14_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro10_14_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro10_14_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro10_14_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro10_14_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro10_14_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro10_14_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro10_14_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro10_14_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro10_14_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro10_14_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro10_14_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro10_14_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro10_14_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro10_14_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro10_14_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro10_14_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro10_14_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro10_14_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro10_14_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro10_14_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro10_14_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro10_14_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro10_14_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro10_14_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro10_14_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro10_14_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro10_14_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro10_14_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro10_14_1['Total'];
		   $total1 = $total1 + $registro10_14_1['1'];
		   $total2 = $total2 + $registro10_14_1['2'];
		   $total3 = $total3 + $registro10_14_1['3'];
		   $total4 = $total4 + $registro10_14_1['4'];
		   $total5 = $total5 + $registro10_14_1['5'];
		   $total6 = $total6 + $registro10_14_1['6'];
		   $total7 = $total7 + $registro10_14_1['7'];
		   $total8 = $total8 + $registro10_14_1['8'];
		   $total9 = $total9 + $registro10_14_1['9'];
		   $total10 = $total10 + $registro10_14_1['10'];
		   $total11 = $total11 + $registro10_14_1['11'];
		   $total12 = $total12 + $registro10_14_1['12'];
		   $total13 = $total13 + $registro10_14_1['13'];
		   $total14 = $total14 + $registro10_14_1['14'];
		   $total15 = $total15 + $registro10_14_1['15'];
		   $total16 = $total16 + $registro10_14_1['16'];
		   $total17 = $total17 + $registro10_14_1['17'];
		   $total18 = $total18 + $registro10_14_1['18'];
		   $total19 = $total19 + $registro10_14_1['19'];
		   $total20 = $total20 + $registro10_14_1['20'];
		   $total21 = $total21+ $registro10_14_1['21'];
		   $total22 = $total22 + $registro10_14_1['22'];
		   $total23 = $total23 + $registro10_14_1['23'];
		   $total24 = $total24 + $registro10_14_1['24'];
		   $total25 = $total25 + $registro10_14_1['25'];
		   $total26 = $total26 + $registro10_14_1['26'];
		   $total27 = $total27 + $registro10_14_1['27'];
		   $total28 = $total28 + $registro10_14_1['28'];
		   $total29 = $total29 + $registro10_14_1['29'];
		   $total30 = $total30 + $registro10_14_1['30'];
		   $total31 = $total31 + $registro10_14_1['31'];		   
     }	
   }

	if($result15_19->num_rows>0){
		while($registro15_19_1 = $result15_19->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro15_19_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro15_19_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro15_19_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro15_19_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro15_19_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro15_19_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro15_19_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro15_19_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro15_19_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro15_19_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro15_19_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro15_19_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro15_19_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro15_19_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro15_19_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro15_19_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro15_19_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro15_19_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro15_19_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro15_19_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro15_19_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro15_19_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro15_19_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro15_19_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro15_19_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro15_19_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro15_19_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro15_19_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro15_19_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro15_19_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro15_19_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro15_19_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro15_19_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro15_19_1['Total'];
		   $total1 = $total1 + $registro15_19_1['1'];
		   $total2 = $total2 + $registro15_19_1['2'];
		   $total3 = $total3 + $registro15_19_1['3'];
		   $total4 = $total4 + $registro15_19_1['4'];
		   $total5 = $total5 + $registro15_19_1['5'];
		   $total6 = $total6 + $registro15_19_1['6'];
		   $total7 = $total7 + $registro15_19_1['7'];
		   $total8 = $total8 + $registro15_19_1['8'];
		   $total9 = $total9 + $registro15_19_1['9'];
		   $total10 = $total10 + $registro15_19_1['10'];
		   $total11 = $total11 + $registro15_19_1['11'];
		   $total12 = $total12 + $registro15_19_1['12'];
		   $total13 = $total13 + $registro15_19_1['13'];
		   $total14 = $total14 + $registro15_19_1['14'];
		   $total15 = $total15 + $registro15_19_1['15'];
		   $total16 = $total16 + $registro15_19_1['16'];
		   $total17 = $total17 + $registro15_19_1['17'];
		   $total18 = $total18 + $registro15_19_1['18'];
		   $total19 = $total19 + $registro15_19_1['19'];
		   $total20 = $total20 + $registro15_19_1['20'];
		   $total21 = $total21+ $registro15_19_1['21'];
		   $total22 = $total22 + $registro15_19_1['22'];
		   $total23 = $total23 + $registro15_19_1['23'];
		   $total24 = $total24 + $registro15_19_1['24'];
		   $total25 = $total25 + $registro15_19_1['25'];
		   $total26 = $total26 + $registro15_19_1['26'];
		   $total27 = $total27 + $registro15_19_1['27'];
		   $total28 = $total28 + $registro15_19_1['28'];
		   $total29 = $total29 + $registro15_19_1['29'];
		   $total30 = $total30 + $registro15_19_1['30'];
		   $total31 = $total31 + $registro15_19_1['31'];		   
     }	
   }
   
	if($result20_49->num_rows>0){
		while($registro20_49_1 = $result20_49->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro20_49_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro20_49_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro20_49_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro20_49_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro20_49_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro20_49_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro20_49_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro20_49_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro20_49_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro20_49_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro20_49_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro20_49_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro20_49_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro20_49_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro20_49_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro20_49_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro20_49_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro20_49_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro20_49_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro20_49_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro20_49_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro20_49_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro20_49_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro20_49_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro20_49_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro20_49_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro20_49_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro20_49_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro20_49_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro20_49_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro20_49_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro20_49_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro20_49_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro20_49_1['Total'];
		   $total1 = $total1 + $registro20_49_1['1'];
		   $total2 = $total2 + $registro20_49_1['2'];
		   $total3 = $total3 + $registro20_49_1['3'];
		   $total4 = $total4 + $registro20_49_1['4'];
		   $total5 = $total5 + $registro20_49_1['5'];
		   $total6 = $total6 + $registro20_49_1['6'];
		   $total7 = $total7 + $registro20_49_1['7'];
		   $total8 = $total8 + $registro20_49_1['8'];
		   $total9 = $total9 + $registro20_49_1['9'];
		   $total10 = $total10 + $registro20_49_1['10'];
		   $total11 = $total11 + $registro20_49_1['11'];
		   $total12 = $total12 + $registro20_49_1['12'];
		   $total13 = $total13 + $registro20_49_1['13'];
		   $total14 = $total14 + $registro20_49_1['14'];
		   $total15 = $total15 + $registro20_49_1['15'];
		   $total16 = $total16 + $registro20_49_1['16'];
		   $total17 = $total17 + $registro20_49_1['17'];
		   $total18 = $total18 + $registro20_49_1['18'];
		   $total19 = $total19 + $registro20_49_1['19'];
		   $total20 = $total20 + $registro20_49_1['20'];
		   $total21 = $total21+ $registro20_49_1['21'];
		   $total22 = $total22 + $registro20_49_1['22'];
		   $total23 = $total23 + $registro20_49_1['23'];
		   $total24 = $total24 + $registro20_49_1['24'];
		   $total25 = $total25 + $registro20_49_1['25'];
		   $total26 = $total26 + $registro20_49_1['26'];
		   $total27 = $total27 + $registro20_49_1['27'];
		   $total28 = $total28 + $registro20_49_1['28'];
		   $total29 = $total29 + $registro20_49_1['29'];
		   $total30 = $total30 + $registro20_49_1['30'];
		   $total31 = $total31 + $registro20_49_1['31'];		   
     }	
   }
   
	if($result50_59->num_rows>0){
		while($registro50_59_1 = $result50_59->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro50_59_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro50_59_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro50_59_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro50_59_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro50_59_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro50_59_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro50_59_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro50_59_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro50_59_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro50_59_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro50_59_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro50_59_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro50_59_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro50_59_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro50_59_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro50_59_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro50_59_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro50_59_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro50_59_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro50_59_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro50_59_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro50_59_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro50_59_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro50_59_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro50_59_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro50_59_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro50_59_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro50_59_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro50_59_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro50_59_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro50_59_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro50_59_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro50_59_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro50_59_1['Total'];
		   $total1 = $total1 + $registro50_59_1['1'];
		   $total2 = $total2 + $registro50_59_1['2'];
		   $total3 = $total3 + $registro50_59_1['3'];
		   $total4 = $total4 + $registro50_59_1['4'];
		   $total5 = $total5 + $registro50_59_1['5'];
		   $total6 = $total6 + $registro50_59_1['6'];
		   $total7 = $total7 + $registro50_59_1['7'];
		   $total8 = $total8 + $registro50_59_1['8'];
		   $total9 = $total9 + $registro50_59_1['9'];
		   $total10 = $total10 + $registro50_59_1['10'];
		   $total11 = $total11 + $registro50_59_1['11'];
		   $total12 = $total12 + $registro50_59_1['12'];
		   $total13 = $total13 + $registro50_59_1['13'];
		   $total14 = $total14 + $registro50_59_1['14'];
		   $total15 = $total15 + $registro50_59_1['15'];
		   $total16 = $total16 + $registro50_59_1['16'];
		   $total17 = $total17 + $registro50_59_1['17'];
		   $total18 = $total18 + $registro50_59_1['18'];
		   $total19 = $total19 + $registro50_59_1['19'];
		   $total20 = $total20 + $registro50_59_1['20'];
		   $total21 = $total21 + $registro50_59_1['21'];
		   $total22 = $total22 + $registro50_59_1['22'];
		   $total23 = $total23 + $registro50_59_1['23'];
		   $total24 = $total24 + $registro50_59_1['24'];
		   $total25 = $total25 + $registro50_59_1['25'];
		   $total26 = $total26 + $registro50_59_1['26'];
		   $total27 = $total27 + $registro50_59_1['27'];
		   $total28 = $total28 + $registro50_59_1['28'];
		   $total29 = $total29 + $registro50_59_1['29'];
		   $total30 = $total30 + $registro50_59_1['30'];
		   $total31 = $total31 + $registro50_59_1['31'];		   
     }	
   }   
   
	if($result60->num_rows>0){
		while($registro60_1 = $result60->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro60_1['Concepto']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro60_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro60_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro60_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro60_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro60_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro60_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro60_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro60_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro60_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro60_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro60_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro60_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro60_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro60_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro60_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro60_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $registro60_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro60_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $registro60_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $registro60_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $registro60_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $registro60_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $registro60_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $registro60_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $registro60_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $registro60_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $registro60_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $registro60_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $registro60_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $registro60_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $registro60_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $registro60_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
		   $total = $total + $registro60_1['Total'];
		   $total1 = $total1 + $registro60_1['1'];
		   $total2 = $total2 + $registro60_1['2'];
		   $total3 = $total3 + $registro60_1['3'];
		   $total4 = $total4 + $registro60_1['4'];
		   $total5 = $total5 + $registro60_1['5'];
		   $total6 = $total6 + $registro60_1['6'];
		   $total7 = $total7 + $registro60_1['7'];
		   $total8 = $total8 + $registro60_1['8'];
		   $total9 = $total9 + $registro60_1['9'];
		   $total10 = $total10 + $registro60_1['10'];
		   $total11 = $total11 + $registro60_1['11'];
		   $total12 = $total12 + $registro60_1['12'];
		   $total13 = $total13 + $registro60_1['13'];
		   $total14 = $total14 + $registro60_1['14'];
		   $total15 = $total15 + $registro60_1['15'];
		   $total16 = $total16 + $registro60_1['16'];
		   $total17 = $total17 + $registro60_1['17'];
		   $total18 = $total18 + $registro60_1['18'];
		   $total19 = $total19 + $registro60_1['19'];
		   $total20 = $total20 + $registro60_1['20'];
		   $total21 = $total21 + $registro60_1['21'];
		   $total22 = $total22 + $registro60_1['22'];
		   $total23 = $total23 + $registro60_1['23'];
		   $total24 = $total24 + $registro60_1['24'];
		   $total25 = $total25 + $registro60_1['25'];
		   $total26 = $total26 + $registro60_1['26'];
		   $total27 = $total27 + $registro60_1['27'];
		   $total28 = $total28 + $registro60_1['28'];
		   $total29 = $total29 + $registro60_1['29'];
		   $total30 = $total30 + $registro60_1['30'];
		   $total31 = $total31 + $registro60_1['31'];		   
     }	
   }     
   
}

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Total Pacientes");
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $total1);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $total2);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $total3);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $total4);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $total5);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $total6);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $total7);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $total8);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $total9);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $total10);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $total11);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $total12);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $total13);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $total14);
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $total15);
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $total16);
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $total17);
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $total18);
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $total19);
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $total20);
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $total21);
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $total22);
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $total23);
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $total24);
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $total25);
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $total26);
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $total27);
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $total28);
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $total29);
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $total30);
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $total31);
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $total);
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "A$fila:AH$fila");

  if($resultSexo->num_rows>0){
		while($sexo_1 = $resultSexo->fetch_assoc()){
	       $fila+=1;
	       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $sexo_1['Sexo']);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $sexo_1['1']);
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $sexo_1['2']);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $sexo_1['3']);
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $sexo_1['4']);
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $sexo_1['5']);
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $sexo_1['6']);
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $sexo_1['7']);
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $sexo_1['8']);
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $sexo_1['9']);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $sexo_1['10']);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $sexo_1['11']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $sexo_1['12']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $sexo_1['13']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $sexo_1['14']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $sexo_1['15']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $sexo_1['16']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $sexo_1['17']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $sexo_1['18']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $sexo_1['19']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $sexo_1['20']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", $sexo_1['21']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", $sexo_1['22']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", $sexo_1['23']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", $sexo_1['24']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", $sexo_1['25']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", $sexo_1['26']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", $sexo_1['27']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", $sexo_1['28']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", $sexo_1['29']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", $sexo_1['30']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", $sexo_1['31']);  
           $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", $sexo_1['Total']);  		   
           //Establecer estilo
           $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");	
	       $valor++;
	  }		
   }	

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Consultas Expontaneas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Consultas Referidas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Detección de Sintomáticos Respiratorios");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Detección de Cancer Cervico Uterino");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Embarazadas Nuevas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Embarazadas de Control");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Controles Puerperales");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Anticonceptivo Oral 1 Ciclo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Anticonceptivo Oral 3 Ciclo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Anticonceptivo Oral 6 Ciclo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Condones 10 Unidades");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Condones 30 Unidades");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Depo prevera Aplicadas");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DIU insertados");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Usuarias Utilizando el Metodo de Dias Fijos (Collar)");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Otras Actividades de PF");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Diarrea");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Diarrea que acuden a cita de seguimiento");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Deshidratación Rehidratados en la US");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con casos de Neumonia nuevos en el Año");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Neumonia que acuden a su sita de Seguimiento");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con algun grado de Síndrome Anémico Diagnosticado por Laboratorio");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Total de Niños/as Menores de 5 años Atendidos");
$objPHPExcel->getActiveSheet()->setSharedStyle($totales, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Crecimiento Adecuado");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Crecimiento Inadecuado");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Bajo Percentil 3");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Daño Nutritivo Severo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Discapacidad Nuevos en el Año");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "No. Niños/as menores de 5 años con Probable Alteración del Desarrollo");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Atención prenatal nueva en las primeras 12 SG");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Atención prenatal subsiguiente en las primeras 12 SG");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Atención puerperal nueva en los 10 primeros días");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");

$fila+=1;
$valor+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Atención puerperal subsiguiente en los 10 primeros días");
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:AH$fila");
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
header('Content-Disposition: attachment; filename="AT2R DIARIO '.strtoupper($servicio_name).' '.strtoupper($unidad_name).' '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$result1_4->free();
$result5_9->free();
$result10_14->free();
$result15_19->free();
$result20_49->free();
$result50_59->free();
$result60->free();
$resultSexo->free();
$mysqli->close();//CERRAR CONEXIÓN
?>