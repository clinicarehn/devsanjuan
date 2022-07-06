<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$empresa = $_POST['empresa'];
$puesto = $_POST['puesto'];
$identidad = $_POST['identidad'];
$estatus = $_POST['estatus'];
$nombres = cleanStringStrtolower($nombre);
$apellidos = cleanStringStrtolower($apellido);
date_default_timezone_set('America/Tegucigalpa');
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(colaborador_id) AS max, COUNT(colaborador_id) AS count 
   FROM colaboradores";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
$insert = "INSERT INTO colaboradores 
      VALUES('$numero', '$empresa', '$puesto', '$nombres', '$apellidos','$identidad','$estatus')";
$query = $mysqli->query($insert);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado_historial = "Agregar";
$observacion_historial = "Se ha agregado un nuevo colaborador: $nombre $apellido con identidad n° $identidad";
$modulo = "Colaboradores";
$insert = "INSERT INTO historial 
   VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
/********************************************/
$mysqli->query($insert);

if($query){
	echo 1;//REGISTRO ALMACENADO CON EXITO;
}else{
	echo 2;//ERROR AL COMPLETAR LA SOLICITUD
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>