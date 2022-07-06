<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$sexo = $_POST['sexo'];

if($sexo == 'H'){
	$valor = "IN(2,3)";
}else{
	$valor = "IN(1,3)";
}

$consulta = "SELECT sala_id, nombre
    FROM sala 
	WHERE sala_id ".$valor." ORDER BY nombre";
$result = $mysqli->query($consulta); 
  
if($result->num_rows>0){
	echo '<option value="">Sala</option>';
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['sala_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>