<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT s.servicio_id AS 'servicio_id', s.nombre AS 'nombre'
FROM servicios_puestos AS sp
INNER JOIN servicios AS s
ON sp.servicio_id = s.servicio_id
GROUP BY s.servicio_id
ORDER BY s.nombre";
$result = $mysqli->query($consulta);	

if($result->num_rows>0){
	echo '<option value="">Servicio</option>';
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['servicio_id'].'">'.$consulta2['nombre'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>       