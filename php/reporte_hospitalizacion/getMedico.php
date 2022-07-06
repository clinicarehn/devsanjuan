<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$servicio = $_POST['servicio'];
$puesto_id = $_POST['puesto_id'];


//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', c.colaborador_id AS 'colaborador_id'
             FROM colaboradores AS c
             INNER JOIN servicios_puestos AS sp
             ON c.colaborador_id = sp.colaborador_id
             WHERE sp.servicio_id = '$servicio' AND puesto_id = '$puesto_id'
			 ORDER BY CONCAT(c.nombre,' ',c.apellido)";
$result = $mysqli->query($consulta);			 

if($result->num_rows>0){
	echo '<option value="">Seleccione</option>';
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['colaborador_id'].'">'.$consulta2['colaborador'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>


               
			   
               