<?php
session_start();
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT c.colaborador_id AS 'colaborador_id', CONCAT(c.nombre,' ',c.apellido) 'colaborador'
              FROM colaboradores AS c
              WHERE c.puesto_id = '17'";
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


               
			   
               