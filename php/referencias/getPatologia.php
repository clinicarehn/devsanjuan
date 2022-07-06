<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT id, patologia_id, LEFT(nombre,45) AS 'nombre' 
    FROM patologia 
	ORDER BY id";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['id'].'">['.$consulta2['patologia_id'].'] '.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>