<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');

$colaborador_id = $_POST['colaborador_id'];
$consulta = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'"; 
$result = $mysqli->query($consulta);
  
if($result->num_rows>0){
   $consulta1 = $result->fetch_assoc();
   echo $consulta1['puesto_id'];
}else{
	echo "Error";
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>