<?php  
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$consulta = "SELECT status_id, descripcion 
   FROM status_repro
   ORDER BY descripcion";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';	
	while($consulta2 = $result->fetch_assoc()){
	    echo '<option value="'.$consulta2['status_id'].'">'.$consulta2['descripcion'].'</option>';
	}
}
?>