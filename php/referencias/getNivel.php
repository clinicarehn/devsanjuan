<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$query = "SELECT * 
   FROM niveles_centros";
$result = $mysqli->query($query);

if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['niveles_centros_id'].'">'.$consulta2['nombre'].'</option>';
	}	
}
?>