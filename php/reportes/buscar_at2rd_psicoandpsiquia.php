<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$servicio = $_POST['servicio'];

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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio'
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 1 AND 4
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 5 AND 9
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 10 AND 14
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 15 AND 19
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 20 AND 49
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 50 AND 59
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años >= 60
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
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio'
   GROUP BY 1";
$resultSexo= $mysqli->query($sexo);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
$total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0; $total7 = 0; $total8 = 0; $total9 = 0; $total10 = 0; $total11 = 0;
$total12 = 0; $total13 = 0; $total14 = 0; $total15 = 0; $total16 = 0; $total17 = 0; $total18 = 0; $total19 = 0; $total20 = 0; $total21 = 0;
$total22 = 0; $total23 = 0; $total24 = 0; $total25 = 0; $total26 = 0; $total27 = 0; $total28 = 0; $total29 = 0; $total30 = 0; $total31 = 0;
$totalsexo = 0;

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="3%">No.</th>
            	<th width="21%">Concepto</th>
                <th width="2%">1</th>
				<th width="2%">2</th>
				<th width="2%">3</th>
				<th width="2%">4</th>
				<th width="2%">5</th>
				<th width="2%">6</th>
				<th width="2%">7</th>
				<th width="2%">8</th>
				<th width="2%">9</th>
				<th width="2%">10</th>
				<th width="2%">11</th>
				<th width="2%">12</th>
				<th width="2%">13</th>
				<th width="2%">14</th>
				<th width="2%">15</th>
				<th width="2%">16</th>
				<th width="2%">17</th>
				<th width="2%">18</th>
				<th width="2%">19</th>
				<th width="2%">20</th>
				<th width="2%">21</th>
				<th width="2%">22</th>
				<th width="2%">23</th>
				<th width="2%">24</th>
				<th width="2%">25</th>
				<th width="2%">26</th>
				<th width="2%">27</th>
				<th width="2%">28</th>
				<th width="2%">29</th>
				<th width="2%">30</th>
				<th width="2%">31</th>
				<th width="4%">Total</th>
            </tr>';

$i = 1;		
$total = 0;	
if($result->num_rows>0){
	if($result1_4->num_rows>0){
     	while($registro1_4_1 = $result1_4->fetch_assoc()){
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro1_4_1['Concepto'].'</td>	
				  <td>'.$registro1_4_1['1'].'</td>
				  <td>'.$registro1_4_1['2'].'</td>
				  <td>'.$registro1_4_1['3'].'</td>
				  <td>'.$registro1_4_1['4'].'</td>
				  <td>'.$registro1_4_1['5'].'</td>
				  <td>'.$registro1_4_1['6'].'</td>
				  <td>'.$registro1_4_1['7'].'</td>
				  <td>'.$registro1_4_1['8'].'</td>
				  <td>'.$registro1_4_1['9'].'</td>
				  <td>'.$registro1_4_1['10'].'</td>
				  <td>'.$registro1_4_1['11'].'</td>
				  <td>'.$registro1_4_1['12'].'</td>
				  <td>'.$registro1_4_1['13'].'</td>
				  <td>'.$registro1_4_1['14'].'</td>
				  <td>'.$registro1_4_1['15'].'</td>
				  <td>'.$registro1_4_1['16'].'</td>
				  <td>'.$registro1_4_1['17'].'</td>
				  <td>'.$registro1_4_1['18'].'</td>
  				  <td>'.$registro1_4_1['19'].'</td>
				  <td>'.$registro1_4_1['20'].'</td>
				  <td>'.$registro1_4_1['21'].'</td>
				  <td>'.$registro1_4_1['22'].'</td>
				  <td>'.$registro1_4_1['23'].'</td>
				  <td>'.$registro1_4_1['24'].'</td>
				  <td>'.$registro1_4_1['25'].'</td>
				  <td>'.$registro1_4_1['26'].'</td>
				  <td>'.$registro1_4_1['27'].'</td>
				  <td>'.$registro1_4_1['28'].'</td>
				  <td>'.$registro1_4_1['29'].'</td>
				  <td>'.$registro1_4_1['30'].'</td>
				  <td>'.$registro1_4_1['31'].'</td>
				  <td>'.number_format($registro1_4_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro5_9_1['Concepto'].'</td>	
				  <td>'.$registro5_9_1['1'].'</td>
				  <td>'.$registro5_9_1['2'].'</td>
				  <td>'.$registro5_9_1['3'].'</td>
				  <td>'.$registro5_9_1['4'].'</td>
				  <td>'.$registro5_9_1['5'].'</td>
				  <td>'.$registro5_9_1['6'].'</td>
				  <td>'.$registro5_9_1['7'].'</td>
				  <td>'.$registro5_9_1['8'].'</td>
				  <td>'.$registro5_9_1['9'].'</td>
				  <td>'.$registro5_9_1['10'].'</td>
				  <td>'.$registro5_9_1['11'].'</td>
				  <td>'.$registro5_9_1['12'].'</td>
				  <td>'.$registro5_9_1['13'].'</td>
				  <td>'.$registro5_9_1['14'].'</td>
				  <td>'.$registro5_9_1['15'].'</td>
				  <td>'.$registro5_9_1['16'].'</td>
				  <td>'.$registro5_9_1['17'].'</td>
				  <td>'.$registro5_9_1['18'].'</td>
  				  <td>'.$registro5_9_1['19'].'</td>
				  <td>'.$registro5_9_1['20'].'</td>
				  <td>'.$registro5_9_1['21'].'</td>
				  <td>'.$registro5_9_1['22'].'</td>
				  <td>'.$registro5_9_1['23'].'</td>
				  <td>'.$registro5_9_1['24'].'</td>
				  <td>'.$registro5_9_1['25'].'</td>
				  <td>'.$registro5_9_1['26'].'</td>
				  <td>'.$registro5_9_1['27'].'</td>
				  <td>'.$registro5_9_1['28'].'</td>
				  <td>'.$registro5_9_1['29'].'</td>
				  <td>'.$registro5_9_1['30'].'</td>
				  <td>'.$registro5_9_1['31'].'</td>
				  <td>'.number_format($registro5_9_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro10_14_1['Concepto'].'</td>	
				  <td>'.$registro10_14_1['1'].'</td>
				  <td>'.$registro10_14_1['2'].'</td>
				  <td>'.$registro10_14_1['3'].'</td>
				  <td>'.$registro10_14_1['4'].'</td>
				  <td>'.$registro10_14_1['5'].'</td>
				  <td>'.$registro10_14_1['6'].'</td>
				  <td>'.$registro10_14_1['7'].'</td>
				  <td>'.$registro10_14_1['8'].'</td>
				  <td>'.$registro10_14_1['9'].'</td>
				  <td>'.$registro10_14_1['10'].'</td>
				  <td>'.$registro10_14_1['11'].'</td>
				  <td>'.$registro10_14_1['12'].'</td>
				  <td>'.$registro10_14_1['13'].'</td>
				  <td>'.$registro10_14_1['14'].'</td>
				  <td>'.$registro10_14_1['15'].'</td>
				  <td>'.$registro10_14_1['16'].'</td>
				  <td>'.$registro10_14_1['17'].'</td>
				  <td>'.$registro10_14_1['18'].'</td>
  				  <td>'.$registro10_14_1['19'].'</td>
				  <td>'.$registro10_14_1['20'].'</td>
				  <td>'.$registro10_14_1['21'].'</td>
				  <td>'.$registro10_14_1['22'].'</td>
				  <td>'.$registro10_14_1['23'].'</td>
				  <td>'.$registro10_14_1['24'].'</td>
				  <td>'.$registro10_14_1['25'].'</td>
				  <td>'.$registro10_14_1['26'].'</td>
				  <td>'.$registro10_14_1['27'].'</td>
				  <td>'.$registro10_14_1['28'].'</td>
				  <td>'.$registro10_14_1['29'].'</td>
				  <td>'.$registro10_14_1['30'].'</td>
				  <td>'.$registro10_14_1['31'].'</td>
				  <td>'.number_format($registro10_14_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro15_19_1['Concepto'].'</td>	
				  <td>'.$registro15_19_1['1'].'</td>
				  <td>'.$registro15_19_1['2'].'</td>
				  <td>'.$registro15_19_1['3'].'</td>
				  <td>'.$registro15_19_1['4'].'</td>
				  <td>'.$registro15_19_1['5'].'</td>
				  <td>'.$registro15_19_1['6'].'</td>
				  <td>'.$registro15_19_1['7'].'</td>
				  <td>'.$registro15_19_1['8'].'</td>
				  <td>'.$registro15_19_1['9'].'</td>
				  <td>'.$registro15_19_1['10'].'</td>
				  <td>'.$registro15_19_1['11'].'</td>
				  <td>'.$registro15_19_1['12'].'</td>
				  <td>'.$registro15_19_1['13'].'</td>
				  <td>'.$registro15_19_1['14'].'</td>
				  <td>'.$registro15_19_1['15'].'</td>
				  <td>'.$registro15_19_1['16'].'</td>
				  <td>'.$registro15_19_1['17'].'</td>
				  <td>'.$registro15_19_1['18'].'</td>
  				  <td>'.$registro15_19_1['19'].'</td>
				  <td>'.$registro15_19_1['20'].'</td>
				  <td>'.$registro15_19_1['21'].'</td>
				  <td>'.$registro15_19_1['22'].'</td>
				  <td>'.$registro15_19_1['23'].'</td>
				  <td>'.$registro15_19_1['24'].'</td>
				  <td>'.$registro15_19_1['25'].'</td>
				  <td>'.$registro15_19_1['26'].'</td>
				  <td>'.$registro15_19_1['27'].'</td>
				  <td>'.$registro15_19_1['28'].'</td>
				  <td>'.$registro15_19_1['29'].'</td>
				  <td>'.$registro15_19_1['30'].'</td>
				  <td>'.$registro15_19_1['31'].'</td>
				  <td>'.number_format($registro15_19_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro20_49_1['Concepto'].'</td>	
				  <td>'.$registro20_49_1['1'].'</td>
				  <td>'.$registro20_49_1['2'].'</td>
				  <td>'.$registro20_49_1['3'].'</td>
				  <td>'.$registro20_49_1['4'].'</td>
				  <td>'.$registro20_49_1['5'].'</td>
				  <td>'.$registro20_49_1['6'].'</td>
				  <td>'.$registro20_49_1['7'].'</td>
				  <td>'.$registro20_49_1['8'].'</td>
				  <td>'.$registro20_49_1['9'].'</td>
				  <td>'.$registro20_49_1['10'].'</td>
				  <td>'.$registro20_49_1['11'].'</td>
				  <td>'.$registro20_49_1['12'].'</td>
				  <td>'.$registro20_49_1['13'].'</td>
				  <td>'.$registro20_49_1['14'].'</td>
				  <td>'.$registro20_49_1['15'].'</td>
				  <td>'.$registro20_49_1['16'].'</td>
				  <td>'.$registro20_49_1['17'].'</td>
				  <td>'.$registro20_49_1['18'].'</td>
  				  <td>'.$registro20_49_1['19'].'</td>
				  <td>'.$registro20_49_1['20'].'</td>
				  <td>'.$registro20_49_1['21'].'</td>
				  <td>'.$registro20_49_1['22'].'</td>
				  <td>'.$registro20_49_1['23'].'</td>
				  <td>'.$registro20_49_1['24'].'</td>
				  <td>'.$registro20_49_1['25'].'</td>
				  <td>'.$registro20_49_1['26'].'</td>
				  <td>'.$registro20_49_1['27'].'</td>
				  <td>'.$registro20_49_1['28'].'</td>
				  <td>'.$registro20_49_1['29'].'</td>
				  <td>'.$registro20_49_1['30'].'</td>
				  <td>'.$registro20_49_1['31'].'</td>
				  <td>'.number_format($registro20_49_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro50_59_1['Concepto'].'</td>	
				  <td>'.$registro50_59_1['1'].'</td>
				  <td>'.$registro50_59_1['2'].'</td>
				  <td>'.$registro50_59_1['3'].'</td>
				  <td>'.$registro50_59_1['4'].'</td>
				  <td>'.$registro50_59_1['5'].'</td>
				  <td>'.$registro50_59_1['6'].'</td>
				  <td>'.$registro50_59_1['7'].'</td>
				  <td>'.$registro50_59_1['8'].'</td>
				  <td>'.$registro50_59_1['9'].'</td>
				  <td>'.$registro50_59_1['10'].'</td>
				  <td>'.$registro50_59_1['11'].'</td>
				  <td>'.$registro50_59_1['12'].'</td>
				  <td>'.$registro50_59_1['13'].'</td>
				  <td>'.$registro50_59_1['14'].'</td>
				  <td>'.$registro50_59_1['15'].'</td>
				  <td>'.$registro50_59_1['16'].'</td>
				  <td>'.$registro50_59_1['17'].'</td>
				  <td>'.$registro50_59_1['18'].'</td>
  				  <td>'.$registro50_59_1['19'].'</td>
				  <td>'.$registro50_59_1['20'].'</td>
				  <td>'.$registro50_59_1['21'].'</td>
				  <td>'.$registro50_59_1['22'].'</td>
				  <td>'.$registro50_59_1['23'].'</td>
				  <td>'.$registro50_59_1['24'].'</td>
				  <td>'.$registro50_59_1['25'].'</td>
				  <td>'.$registro50_59_1['26'].'</td>
				  <td>'.$registro50_59_1['27'].'</td>
				  <td>'.$registro50_59_1['28'].'</td>
				  <td>'.$registro50_59_1['29'].'</td>
				  <td>'.$registro50_59_1['30'].'</td>
				  <td>'.$registro50_59_1['31'].'</td>
				  <td>'.number_format($registro50_59_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro60_1['Concepto'].'</td>	
				  <td>'.$registro60_1['1'].'</td>
				  <td>'.$registro60_1['2'].'</td>
				  <td>'.$registro60_1['3'].'</td>
				  <td>'.$registro60_1['4'].'</td>
				  <td>'.$registro60_1['5'].'</td>
				  <td>'.$registro60_1['6'].'</td>
				  <td>'.$registro60_1['7'].'</td>
				  <td>'.$registro60_1['8'].'</td>
				  <td>'.$registro60_1['9'].'</td>
				  <td>'.$registro60_1['10'].'</td>
				  <td>'.$registro60_1['11'].'</td>
				  <td>'.$registro60_1['12'].'</td>
				  <td>'.$registro60_1['13'].'</td>
				  <td>'.$registro60_1['14'].'</td>
				  <td>'.$registro60_1['15'].'</td>
				  <td>'.$registro60_1['16'].'</td>
				  <td>'.$registro60_1['17'].'</td>
				  <td>'.$registro60_1['18'].'</td>
  				  <td>'.$registro60_1['19'].'</td>
				  <td>'.$registro60_1['20'].'</td>
				  <td>'.$registro60_1['21'].'</td>
				  <td>'.$registro60_1['22'].'</td>
				  <td>'.$registro60_1['23'].'</td>
				  <td>'.$registro60_1['24'].'</td>
				  <td>'.$registro60_1['25'].'</td>
				  <td>'.$registro60_1['26'].'</td>
				  <td>'.$registro60_1['27'].'</td>
				  <td>'.$registro60_1['28'].'</td>
				  <td>'.$registro60_1['29'].'</td>
				  <td>'.$registro60_1['30'].'</td>
				  <td>'.$registro60_1['31'].'</td>
				  <td>'.number_format($registro60_1['Total']).'</td>			
				  </tr>';
				  $i++;
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
    echo '<tr>
	         <td><b>'.$i.'</b></td>
	         <td><b>Total Pacientes Atendidos</b></td>
			 <td><b>'.number_format($total1).'</b></td>
			 <td><b>'.number_format($total2).'</b></td>
			 <td><b>'.number_format($total3).'</b></td>
			 <td><b>'.number_format($total4).'</b></td>
			 <td><b>'.number_format($total5).'</b></td>
			 <td><b>'.number_format($total6).'</b></td>
			 <td><b>'.number_format($total7).'</b></td>
			 <td><b>'.number_format($total8).'</b></td>
			 <td><b>'.number_format($total9).'</b></td>
			 <td><b>'.number_format($total10).'</b></td>
			 <td><b>'.number_format($total11).'</b></td>
			 <td><b>'.number_format($total12).'</b></td>
			 <td><b>'.number_format($total13).'</b></td>
			 <td><b>'.number_format($total14).'</b></td>
			 <td><b>'.number_format($total15).'</b></td>
			 <td><b>'.number_format($total16).'</b></td>
			 <td><b>'.number_format($total17).'</b></td>
			 <td><b>'.number_format($total18).'</b></td>
			 <td><b>'.number_format($total19).'</b></td>
			 <td><b>'.number_format($total20).'</b></td>
			 <td><b>'.number_format($total21).'</b></td>
			 <td><b>'.number_format($total22).'</b></td>
			 <td><b>'.number_format($total23).'</b></td>
			 <td><b>'.number_format($total24).'</b></td>
			 <td><b>'.number_format($total25).'</b></td>
			 <td><b>'.number_format($total26).'</b></td>
			 <td><b>'.number_format($total27).'</b></td>
			 <td><b>'.number_format($total28).'</b></td>
			 <td><b>'.number_format($total29).'</b></td>
			 <td><b>'.number_format($total30).'</b></td>
			 <td><b>'.number_format($total31).'</b></td>
	         <td><b>'.number_format($total).'</b></td>
		 </tr>';

    $i++;
	if($resultSexo->num_rows>0){
     	while($sexo1 = $resultSexo->fetch_assoc()){
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$sexo1['Sexo'].'</td>	
				  <td>'.number_format($sexo1['1']).'</td>
				  <td>'.number_format($sexo1['2']).'</td>
				  <td>'.number_format($sexo1['3']).'</td>
				  <td>'.number_format($sexo1['4']).'</td>
				  <td>'.number_format($sexo1['5']).'</td>
				  <td>'.number_format($sexo1['6']).'</td>
				  <td>'.number_format($sexo1['7']).'</td>
				  <td>'.number_format($sexo1['8']).'</td>
				  <td>'.number_format($sexo1['9']).'</td>
				  <td>'.number_format($sexo1['10']).'</td>
				  <td>'.number_format($sexo1['11']).'</td>
				  <td>'.number_format($sexo1['12']).'</td>
				  <td>'.number_format($sexo1['13']).'</td>
				  <td>'.number_format($sexo1['14']).'</td>
				  <td>'.number_format($sexo1['15']).'</td>
				  <td>'.number_format($sexo1['16']).'</td>
				  <td>'.number_format($sexo1['17']).'</td>
				  <td>'.number_format($sexo1['18']).'</td>
  				  <td>'.number_format($sexo1['19']).'</td>
				  <td>'.number_format($sexo1['20']).'</td>
				  <td>'.number_format($sexo1['21']).'</td>
				  <td>'.number_format($sexo1['22']).'</td>
				  <td>'.number_format($sexo1['23']).'</td>
				  <td>'.number_format($sexo1['24']).'</td>
				  <td>'.number_format($sexo1['25']).'</td>
				  <td>'.number_format($sexo1['26']).'</td>
				  <td>'.number_format($sexo1['27']).'</td>
				  <td>'.number_format($sexo1['28']).'</td>
				  <td>'.number_format($sexo1['29']).'</td>
				  <td>'.number_format($sexo1['30']).'</td>
				  <td>'.number_format($sexo1['31']).'</td>
				  <td>'.number_format($sexo1['Total']).'</td>			
				  </tr>';
				  $i++;
				  $totalsexo = $totalsexo + $sexo1['Total'];
			}
		}			
}else{
	echo '<tr>
				<td colspan="6" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

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