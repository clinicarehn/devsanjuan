<?php
include('../funtions.php');
session_start(); 	

//CONEXION A DB
$mysqli = connect_mysqli(); 

$query = "SELECT * FROM frecuencia";
$result = $mysqli->query($query);

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['frecuencia_id'].'">'.$consulta2['nombre'].'</option>';
	}
}    
?>