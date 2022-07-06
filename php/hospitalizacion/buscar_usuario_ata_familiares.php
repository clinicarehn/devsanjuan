<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');
$expediente_valor = $_POST['expediente'];
$servicio = $_POST['servicio'];
$fecha = date('Y-m-d');
$año = date("Y", strtotime($fecha));
$fecha_inical = date("Y-m-d", strtotime($año."-01-01"));
$fecha_final = date("Y-m-d", strtotime($año."-12-31"));
$colaborador_id = $_SESSION['colaborador_id'];

$consultar_expediente = "SELECT expediente, tipo 
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 2";
$result = $mysqli->query($consultar_expediente);	
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$tipo = $consultar_expediente2['tipo'];

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);	
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];

//CONSULTA EN LA ENTIDAD ATA
$valores = "SELECT a.ata_familiares_id AS 'ata_familiares_id'
     FROM ata_familiares AS a
     INNER JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     WHERE a.expediente = '$expediente' AND a.fecha BETWEEN '$fecha_inical' AND '$fecha_final' AND a.servicio_id = '$servicio' AND c.puesto_id = '$puesto_id'";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();

if($tipo == 2){
if($result->num_rows>0){
	$paciente = "S";
	$datos = array(
				0 => $paciente, 	
	);
}else{
	$paciente = "N";	
	$datos = array(
				0 => $paciente,			
	);	
}
}else{
	   $datos = array(
				0 => 'Paciente', 
				1 => '', 
 				2 => '',
	    );		
} 					
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>