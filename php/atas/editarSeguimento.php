<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$pacientes_id = $_POST['pacientes_id'];
$agenda_id = $_POST['agenda_id'];


//CONSULTAR DATOS DEL USARIO
$query_usuario = "SELECT nombre, apellido, identidad, fecha_nacimiento, telefono, departamento_id, municipio_id, localidad, sexo
   FROM pacientes
   WHERE pacientes_id = '$pacientes_id'";
    
$result = $mysqli->query($query_usuario);
$consultar_agenda2 = $result->fetch_assoc();

$nombre = "";
$apellido = "";
$identidad = "";
$fecha_nacimiento = "";
$telefono = "";
$departamento_id = "";
$municipio_id = "";
$localidad = "";

if($result->num_rows>0){
	$nombre = $consultar_agenda2['nombre'];
	$apellido = $consultar_agenda2['apellido'];
	$identidad = $consultar_agenda2['identidad'];
	$fecha_nacimiento = $consultar_agenda2['fecha_nacimiento'];
	$telefono = $consultar_agenda2['telefono'];
    $departamento_id = $consultar_agenda2['departamento_id'];
    $municipio_id = $consultar_agenda2['municipio_id'];
    $localidad = $consultar_agenda2['localidad'];
    $sexo = $consultar_agenda2['sexo'];
}

//CONSULTAR NOMBRE DEPARTAMENTO
$query_departamento =  "SELECT nombre 
   FROM departamentos
   WHERE departamento_id = '$departamento_id'";
$result = $mysqli->query($query_departamento);
$consultar_agenda2 = $result->fetch_assoc();

$departamento_nombre = "";

if($result->num_rows>0){
	$departamento_nombre = $consultar_agenda2['nombre'];	
}

//CONSULTAR NOMBRE MUNCIPIO
$query_municipio =  "SELECT nombre 
   FROM municipios
   WHERE municipio_id = '$municipio_id'";
$result = $mysqli->query($query_municipio);
$consultar_agenda2 = $result->fetch_assoc();

$municipio_nombre = "";

if($result->num_rows>0){
	$municipio_nombre = $consultar_agenda2['nombre'];	
}

$datos = array(
				0 => $nombre, 
				1 => $apellido, 
 				2 => $identidad,
                3 => $fecha_nacimiento,
                4 => $telefono,
                5 => $departamento_id,
                6 => $municipio_id,	
				7 => $localidad, 
				8 => $sexo
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>