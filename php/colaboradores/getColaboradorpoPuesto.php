<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$puesto_id = $_POST['puesto_id']; 

$consulta = "SELECT c.colaborador_id AS 'colaborador_id', CONCAT(c.nombre,' ',c.apellido) 'colaborador'
       FROM colaboradores AS c
       INNER JOIN users AS s
       ON c.colaborador_id = s.colaborador_id
       WHERE c.puesto_id = '$puesto_id' AND s.estatus = 1
       ORDER BY CONCAT(c.nombre,' ',c.apellido)"; 
$result = $mysqli->query($consulta);	   
  
if($result->num_rows>0){
	while($consulta2 = $result->fetch_assoc()){
	    echo '<option value="'.$consulta2['colaborador_id'].'">'.$consulta2['colaborador'].'</option>';
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>