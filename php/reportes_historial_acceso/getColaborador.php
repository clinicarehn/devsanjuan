<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$db = $_SESSION['db'];
$mysqli = connect_mysqli($db);
 
date_default_timezone_set('America/Tegucigalpa');

$consulta = "SELECT colaborador_id, CONCAT(nombre,' ',apellido) AS 'nombre' 
     FROM colaboradores O
	 RDER BY nombre"; 
$result = $mysqli->query($consulta);
  
if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';	
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['colaborador_id'].'">'.$consulta2['nombre'].'</option>';
	}	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>