<?php 
include('../funtions.php');
session_start();  
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$servicio = $_POST['servicio'];
$puesto_id = $_POST['puesto_id'];

//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT c.colaborador_id AS 'colaborador_id', CONCAT(c.nombre, ' ', c.apellido) AS 'profesional'
        FROM bloqueo AS b
        INNER JOIN colaboradores AS c
        ON b.colaborador_id = c.colaborador_id
        WHERE c.puesto_id = '$puesto_id'
        GROUP BY c.colaborador_id
        ORDER BY c.nombre";
$result = $mysqli->query($consulta);			  

if($result->num_rows>0){
	echo '<option value="">Profesional</option>';
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['colaborador_id'].'">'.$consulta2['profesional'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>


               
			   
               