<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$db = $_SESSION['db'];
$mysqli = connect_mysqli($db);

$departamento_id = $_POST['departamento_id'];

$query = "SELECT municipio_id, nombre 
    FROM municipios 
	WHERE departamento_id = '$departamento_id'";

$result = $mysqli->query($query);	    
  
if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['municipio_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>