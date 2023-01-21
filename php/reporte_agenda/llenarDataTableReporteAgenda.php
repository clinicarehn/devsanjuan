<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];

$servicio = '';
$unidad = '';
$colaborador = '';
$fecha_actual = date("Y-m-d");

if($_POST['servicio'] != '' || $_POST['servicio'] != 0){
	$servicio = "AND a.servicio_id = '".$_POST['servicio']."'";
}

if($_POST['unidad'] != '' || $_POST['unidad'] != 0){
	$unidad =  "AND c.puesto_id = '".$_POST['unidad']."'";
}

if($_POST['colaborador'] != '' || $_POST['colaborador'] != 0){
	$colaborador =  "AND a.colaborador_id = '".$_POST['colaborador']."'";
}

//CONSULTAR LOS MEDICAMENTOS
$query = "SELECT s.nombre AS 'servicio', ae.nombre AS 'tipo', 
	COUNT(CASE WHEN DAY(a.fecha_cita) = 1 THEN a.agenda_id END) AS '1',  
	COUNT(CASE WHEN DAY(a.fecha_cita) = 2 THEN a.agenda_id END) AS '2',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 3 THEN a.agenda_id END) AS '3',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 4 THEN a.agenda_id END) AS '4',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 5 THEN a.agenda_id END) AS '5',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 6 THEN a.agenda_id END) AS '6',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 7 THEN a.agenda_id END) AS '7',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 8 THEN a.agenda_id END) AS '8',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 9 THEN a.agenda_id END) AS '9',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 10 THEN a.agenda_id END) AS '10',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 11 THEN a.agenda_id END) AS '11',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 12 THEN a.agenda_id END) AS '12',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 13 THEN a.agenda_id END) AS '13',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 14 THEN a.agenda_id END) AS '14',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 15 THEN a.agenda_id END) AS '15',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 16 THEN a.agenda_id END) AS '16',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 17 THEN a.agenda_id END) AS '17',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 18 THEN a.agenda_id END) AS '18',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 19 THEN a.agenda_id END) AS '19',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 20 THEN a.agenda_id END) AS '20',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 21 THEN a.agenda_id END) AS '21',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 22 THEN a.agenda_id END) AS '22',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 23 THEN a.agenda_id END) AS '23',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 24 THEN a.agenda_id END) AS '24',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 25 THEN a.agenda_id END) AS '25',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 26 THEN a.agenda_id END) AS '26',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 27 THEN a.agenda_id END) AS '27',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 28 THEN a.agenda_id END) AS '28',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 29 THEN a.agenda_id END) AS '29',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 30 THEN a.agenda_id END) AS '30',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 31 THEN a.agenda_id END) AS '31',
	COUNT(a.agenda_id) AS 'total'
	FROM agenda AS a
	INNER JOIN colaboradores AS c ON a.colaborador_id = c.colaborador_id
	INNER JOIN servicios AS s ON a.servicio_id = s.servicio_id
	INNER JOIN agenda_estado AS ae ON a.status = ae.agenda_estado_id
	WHERE CAST(a.fecha_cita AS date) BETWEEN '$fechai' AND '$fechaf' AND a.`status` IN(1,2)
	$servicio
	$unidad
	$colaborador
	GROUP BY s.nombre, a.status
	ORDER BY s.nombre, a.status";

$result = $mysqli->query($query);

$arreglo = array();
$data = [];

if($result->num_rows>0){
	while( $row = $result->fetch_assoc()){	
		$data[] = array( 
			"servicio"=>$row['servicio'],
			"tipo"=>$row['tipo'],
			"1"=>$row['1'],
			"2"=>$row['2'],
			"3"=>$row['3'],
			"4"=>$row['4'],
			"5"=>$row['5'],
			"6"=>$row['6'],
			"7"=>$row['7'],
			"8"=>$row['8'],
			"9"=>$row['9'],
			"10"=>$row['10'],
			"11"=>$row['11'],
			"12"=>$row['12'],
			"13"=>$row['13'],
			"14"=>$row['14'],
			"15"=>$row['15'],
			"16"=>$row['16'],
			"17"=>$row['17'],
			"18"=>$row['18'],
			"19"=>$row['19'],
			"20"=>$row['20'],
			"21"=>$row['21'],
			"22"=>$row['22'],
			"23"=>$row['23'],
			"24"=>$row['24'],
			"25"=>$row['25'],
			"26"=>$row['26'],
			"27"=>$row['27'],
			"28"=>$row['28'],
			"29"=>$row['29'],
			"30"=>$row['30'],
			"31"=>$row['31'],
			"total"=>$row['total']		 
		);	
	}	
}else{
	$data = array();	
}

$arreglo = array(
	"echo" => 1,
	"totalrecords" => count($data),
	"totaldisplayrecords" => count($data),
	"data" => $data
);

echo json_encode($arreglo);	
?>
