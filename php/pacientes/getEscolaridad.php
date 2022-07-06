<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$query = "SELECT escolaridad_id, nombre 
   FROM escolaridad"; 
$result = $mysqli->query($query);
  
if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['escolaridad_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN		
?>