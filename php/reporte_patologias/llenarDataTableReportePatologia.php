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

$departamentos = "";
$municipios = "";
$servicio = '';
$unidad = '';
$colaborador = '';
$fecha_actual = date("Y-m-d");

if($_POST['departamentos'] != '' || $_POST['departamentos'] != 0){
	$departamentos = "AND a.departamento_id = '".$_POST['departamentos']."'";
}

if($_POST['municipios'] != '' || $_POST['municipios'] != 0){
	$municipios = "AND a.municipio_id = '".$_POST['municipios']."'";
}

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
$query = "SELECT d.nombre AS 'departamento', m.nombre AS 'municipio', gp.codigo AS 'patologia', 
	COUNT(CASE WHEN (a.años BETWEEN 0 AND 4) THEN a.patologia_id END) AS '0_4',
	COUNT(CASE WHEN (a.años BETWEEN 5 AND 10) THEN a.patologia_id END) AS '5_10',
	COUNT(CASE WHEN (a.años BETWEEN 11 AND 20) THEN a.patologia_id END) AS '11_20',
	COUNT(CASE WHEN (a.años BETWEEN 21 AND 30) THEN a.patologia_id END) AS '21_30',
	COUNT(CASE WHEN (a.años BETWEEN 31 AND 40) THEN a.patologia_id END) AS '31_40',
	COUNT(CASE WHEN (a.años BETWEEN 41 AND 50) THEN a.patologia_id END) AS '41_50',
	COUNT(CASE WHEN (a.años BETWEEN 51 AND 60) THEN a.patologia_id END) AS '51_60',
	COUNT(CASE WHEN (a.años > 60) THEN a.patologia_id END) AS '61_mas',
	COUNT(CASE WHEN (pa.sexo = 'M') THEN pa.sexo END) AS 'mujeres',
	COUNT(CASE WHEN (pa.sexo = 'H') THEN pa.sexo END) AS 'hombres',
	COUNT(a.años) AS 'total'
	FROM ATA as A
	INNER JOIN patologia AS p ON a.patologia_id = p.id
	INNER JOIN colaboradores AS c ON a.colaborador_id = c.colaborador_id
	INNER JOIN grupo_patologia AS gp ON p.grupo_id = gp.grupo_id
	INNER JOIN departamentos AS d ON a.departamento_id = d.departamento_id
	INNER JOIN municipios AS m ON a.municipio_id = m.municipio_id
	INNER JOIN pacientes AS pa ON a.expediente = pa.expediente
	WHERE a.fecha BETWEEN '$fechai' AND '$fechaf'
	$departamentos
	$municipios
	$servicio
	$unidad
	$colaborador
	GROUP BY d.nombre, m.municipio_id, gp.codigo, pa.sexo
	ORDER BY d.nombre";

$result = $mysqli->query($query);

$arreglo = array();
$data = [];

if($result->num_rows>0){
	while( $row = $result->fetch_assoc()){	
		$data[] = array( 
			"departamento"=>$row['departamento'],
			"municipio"=>$row['municipio'],
			"patologia"=>$row['patologia'],
			"0_4"=>$row['0_4'],
			"5_10"=>$row['5_10'],
			"11_20"=>$row['11_20'],
			"21_30"=>$row['21_30'],
			"31_40"=>$row['31_40'],
			"41_50"=>$row['41_50'],	 
			"51_60"=>$row['51_60'],	 
			"61_mas"=>$row['61_mas'],	
			"mujeres"=>$row['mujeres'],	 
			"hombres"=>$row['hombres'],	 
			"total_"=>$row['total'],	 
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
