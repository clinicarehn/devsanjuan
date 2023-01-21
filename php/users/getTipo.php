<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$consulta = "SELECT tipo_user_id, nombre 
   FROM tipo_user ORDER BY nombre";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['tipo_user_id'].'">'.$consulta2['nombre'].'</option>';
	}
}
?>