<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
  
//CONSULTA LOS DATOS DE LA ENTIDAD CORPORACION
$consulta = "SELECT puesto_id, nombre 
   FROM puesto_colaboradores 
   WHERE puesto_id IN(1,2) 
   ORDER BY nombre";
$result = $mysqli->query($consulta);

if($result->num_rows>0){
	echo '<option value="">Unidad</option>';	
	while($consulta2 = $result->fetch_assoc()){
		echo '<option value="'.$consulta2['puesto_id'].'">'.$consulta2['nombre'].'</option>';
	}
}  

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>