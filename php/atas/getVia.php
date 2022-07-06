<?php
session_start();   
include('../funtions.php');	  

//CONEXION A DB
$mysqli = connect_mysqli(); 

$query = "SELECT * FROM via";
$result = $mysqli->query($query);

if($result->num_rows>0){
	 echo '<option value="">Seleccione</option>';
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['via_id'].'">'.$consulta2['nombre'].'</option>';
	}
}  
?>


               
			   
               