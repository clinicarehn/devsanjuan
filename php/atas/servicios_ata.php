<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$usuario = $_SESSION['colaborador_id'];

$consulta = "SELECT s.servicio_id AS 'servicio_id', s.nombre AS 'nombre'
    FROM colaboradores AS c
    INNER JOIN servicios_puestos AS sp
    ON c.colaborador_id = sp.colaborador_id
    INNER JOIN servicios AS s
    ON sp.servicio_id = s.servicio_id
    WHERE c.colaborador_id = '$usuario'"; 
$result = $mysqli->query($consulta);	
  
if($result->num_rows>0){	
	while($consulta2 = $result->fetch_assoc()){
	     echo '<option value="'.$consulta2['servicio_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>