<?php
session_start();  
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();  

$bloqueo_id = $_POST['bloqueo_id'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date('Y-m-d H:i:s');	
$fecha = date('Y-m-d');	

//ELIMINO EL REGISTRO DE LA AGENDA
$delete = "DELETE FROM bloqueo 
    WHERE bloqueo_id = '$bloqueo_id'";
$query = $mysqli->query($delete);
/*****************************************************/	

if($query){
	echo 1;//REGISTRO COMPLETADO CON EXITO
}else{
	echo 2;//ERROR EN ELIMINAR ESTE REGISTRO
}

$mysqli->close();//CERRAR CONEXIÓN
?>