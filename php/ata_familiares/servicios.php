<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$consulta = "SELECT servicio_id, nombre 
    FROM servicios WHERE servicio_id IN (3,4) 
	ORDER BY nombre"; 
$result = $mysqli->query($consulta);
  
if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';	
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['servicio_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>