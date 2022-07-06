<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT pd.medicamento AS 'medicamento', pd.dosis AS 'dosis', v.via_id AS 'via', pd.frecuencia AS 'frecuencia', pd.recomendaciones AS 'recomendaciones', pd.id AS 'id' 
     FROM postclinica_detalle AS pd
	 INNER JOIN via AS v
	 ON pd.via = v.via_id
	 WHERE pd.postclinica_id = '$id'";
$result = $mysqli->query($valores);	   
		
$datos = array(); 
    
while($row = $result->fetch_assoc()) { 
   $datos[] = $row;  
}  	

echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>