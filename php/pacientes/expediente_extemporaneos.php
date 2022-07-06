<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$query = "SELECT expediente, extem_id
    FROM extemporaneos";

$result = $mysqli->query($query);

while($registro2 = $result->fetch_assoc()){
	$expediente = $registro2['expediente'];
	$extem_id = $registro2['extem_id'];

	//ACTUALIZAR PACIENTE id
	$query_pacientes_id = "SELECT pacientes_id
	    FROM pacientes
		  WHERE expediente = '$expediente'";
	$result = $mysqli->query($query_pacientes_id);
	$consultar_pacientes_id1 = $result->fetch_assoc();
	$pacientes_id = $consultar_pacientes_id1['pacientes_id'];

	//ACTUALIZAMOS EL REGISTRO
	$update = "UPDATE extemporaneos SET pacientes_id = '$pacientes_id'
	     WHERE extem_id = '$extem_id'";
	$mysqli->query($update);

}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
