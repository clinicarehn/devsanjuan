<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$consulta = "SELECT * 
   FROM triage_observacion"; 
$result = $mysqli->query($consulta);
  
if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['observacion_id'].'">'.$consulta2['tipo'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>