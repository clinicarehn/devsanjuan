<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT c.colaborador_id AS 'colaborador_id', CONCAT(c.nombre,' ',c.apellido) AS 'nombre'
    FROM colaboradores AS c
	INNER JOIN users AS u
	ON c.colaborador_id = u.colaborador_id
    WHERE type IN(11) AND c.estatus = 1 AND u.estatus = 1 
	ORDER BY c.nombre";
$result = $mysqli->query($consulta);	

if($result->num_rows>0){	
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['colaborador_id'].'">'.$consulta2['nombre'].'</option>';
	}	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>