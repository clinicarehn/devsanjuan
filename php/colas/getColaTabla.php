<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR LOS MEDICAMENTOS
$query = "SELECT co.colas_id AS 'colas_id', co.cola_numero AS 'cola_numero', co.fecha AS 'fecha', DATE_FORMAT(co.fecha_registro,'%h:%i %p') AS 'hora', p.identidad AS 'identidad', p.expediente AS 'expediente', CONCAT(p.apellido,' ',p.nombre) as 'usuario', s.nombre AS 'servicio', pc.nombre AS 'puesto', CONCAT(c.apellido,' ',c.nombre) as 'profesional',  co.receta_id AS 'receta_id', co.programar_cita_id AS 'programar_cita_id', co.transito_id AS 'transito_id', p.telefono AS 'telefono1', p.telefono1 AS 'telefono2', p.fecha_nacimiento AS 'fecha_nacimiento'
FROM colas AS co
INNER JOIN pacientes AS p
ON co.pacientes_id = p.pacientes_id
INNER JOIN colaboradores AS c
ON co.colaborador_id = c.colaborador_id
INNER JOIN servicios AS s
ON co.servicio_id = s.servicio_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN admision_servicios AS ads
ON ads.servicio_id = co.servicio_id
WHERE co.fecha = '$fecha' AND co.admision = 1 AND ads.colaborador_id = '$usuario'
GROUP BY co.colas_id
ORDER BY co.cola_numero, co.servicio_id";

$result = $mysqli->query($query);

$arreglo = array();
$data = [];

if($result->num_rows>0){
	while( $row = $result->fetch_assoc()){
		$fecha_nacimiento = $row['fecha_nacimiento'];
	
		//OBTENER LA EDAD DEL USUARIO 
		/*********************************************************************************/
		$valores_array = getEdad($fecha_nacimiento);
		$anos = $valores_array['anos'];
		$meses = $valores_array['meses'];	  
		$dias = $valores_array['dias'];	
		/*********************************************************************************/
	
		$data[] = array( 
			"cola_numero"=>$row['cola_numero'],
			"hora"=>$row['hora'],
			"identidad"=>$row['identidad'],
			"expediente"=>$row['expediente'],
			"usuario"=>$row['usuario'],
			"telefono1"=>$row['telefono1'],	
			"edad"=>$anos." Años",	
			"profesional"=>$row['profesional'],
			"servicio"=>$row['servicio'],
			"receta_id"=>$row['receta_id'],	
			"programar_cita_id"=>$row['programar_cita_id'],
			"colas_id"=>$row['colas_id'],
			"transito_id"=>$row['transito_id'] 				 
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
