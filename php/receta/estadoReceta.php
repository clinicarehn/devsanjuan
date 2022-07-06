<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$receta_id = $_POST['receta_id'];
$colaborador_id = $_SESSION['colaborador_id'];

$consulta = "SELECT estado
	FROM receta
	WHERE receta_id = '$receta_id'";
$result = $mysqli->query($consulta);
 
$estado = 2;
 
if($result->num_rows>0){
	$valores2 = $result->fetch_assoc();
	$estado = $valores2['estado'];
}

echo $estado;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>