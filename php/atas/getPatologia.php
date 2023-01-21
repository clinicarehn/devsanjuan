<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$db = $_SESSION['db'];
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT id, patologia_id, LEFT(nombre,45) AS 'nombre'
   FROM patologia 
   ORDER BY id";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option title = "'.$consulta2['nombre'].'" value="'.$consulta2['id'].'">['.$consulta2['patologia_id'].'] '.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>