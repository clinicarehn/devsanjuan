<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$receta_id = $_POST['receta_id'];
$colaborador_id = $_SESSION['colaborador_id'];

$consulta = "SELECT *
FROM receta
WHERE receta_id = '$receta_id' AND usuario = '$colaborador_id'";
$result = $mysqli->query($consulta);

$total = 0;//NO ES EL PROPIETARIO DE LA RECETA (EL QUE LA PRESCRIBE)
  
if($result->num_rows>0){
	$total = 1;//NO ES EL PROPIETARIO DE LA RECETA (EL QUE LA PRESCRIBE)
}

echo $total;

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>