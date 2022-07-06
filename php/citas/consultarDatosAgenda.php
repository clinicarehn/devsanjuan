<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$agenda_id = $_POST['agenda_id'];
date_default_timezone_set('America/Tegucigalpa');

//CONSULTA EN LA ENTIDAD CORPORACION		 
$query = "SELECT CONCAT(p.apellido, ' ', p.nombre) AS 'usuario', 
  (CASE WHEN p.expediente = 0 THEN 'TEMP' ELSE p.expediente END) AS 'expediente', CAST(a.fecha_cita AS DATE) AS 'fecha_cita', s.nombre AS 'servicio' , p.identidad AS 'identidad', a.colaborador_id AS 'colaborador_id', a.servicio_id AS 'servicio_id'
  FROM agenda AS a
  INNER JOIN pacientes AS p
  ON a.pacientes_id = p.pacientes_id
  INNER JOIN servicios AS s
  ON a.servicio_id = s.servicio_id
  WHERE a.agenda_id = '$agenda_id'  
";
$result = $mysqli->query($query);

$usuario = "";
$expediente = "";
$identidad = "";
$servicio = "";
$fecha_cita = "";
$colaborador_id = "";
$servicio_id = "";

if($result->num_rows>0){
  $consultar_agenda = $result->fetch_assoc();
  $usuario = $consultar_agenda['usuario'];
  $expediente = $consultar_agenda['expediente'];
  $identidad = $consultar_agenda['identidad']; 
  $servicio = $consultar_agenda['servicio'];
  $fecha_cita = $consultar_agenda['fecha_cita'];
  $colaborador_id = $consultar_agenda['colaborador_id'];
  $servicio_id = $consultar_agenda['servicio_id']; 
}
	 
$datos = array(
      0 => $usuario, 
      1 => $expediente,
      2 => $identidad, 
      3 => $servicio, 
      4 => $fecha_cita, 
      5 => $colaborador_id,
      6 => $servicio_id            			
);

echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>