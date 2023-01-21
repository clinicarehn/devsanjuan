<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$db = $_SESSION['db'];
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$consulta = "SELECT puesto_id, nombre 
   FROM puesto_colaboradores
   ORDER BY nombre"; 
$result = $mysqli->query($consulta);
  
if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
	    echo '<option value="'.$consulta2['puesto_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>