<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id'];
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR LA ENTIDAD SERVICIOS_PUESTOS
$query_servicio_puestos = "SELECT j_colaborador_id, servicio_id, colaborador_id
   FROM servicios_puestos
   WHERE id = '$id'";
$result = $mysqli->query($query_servicio_puestos);
$cosulta_servicio_puestos = $result->fetch_assoc();
$j_colaborador_id = $cosulta_servicio_puestos['j_colaborador_id'];
$servicio_id = $cosulta_servicio_puestos['servicio_id'];
$colaborador_id = $cosulta_servicio_puestos['colaborador_id'];     

//OBTENER NOMBRE DE COLABORADOR
$query_colaborador = "SELECT CONCAT(nombre,' ',apellido) AS 'colaborador'
  FROM colaboradores
  WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($query_colaborador);
$cosulta_colaborador = $result->fetch_assoc();
$colaborador_nombre = $cosulta_colaborador['colaborador'];  

//OBTENER NOMBRE DE SERVICIO
$query_servicio = "SELECT nombre
  FROM servicios
  WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($query_servicio);  
$consulta_servicio = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio['nombre'];   

//OBTENER NOMBRE DE JORNADA
$query_jornada = "SELECT nombre
   FROM jornada
   WHERE jornada_id = '$j_colaborador_id'";
$result = $mysqli->query($query_jornada);  
$consulta_jornada = $result->fetch_assoc();
$jornada_nombre = $consulta_jornada['nombre'];  

//ELIMINAMOS EL REGISTRO
$delete = "DELETE FROM servicios_puestos 
   WHERE id = '$id'"; 
$query = $mysqli->query($delete);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado_historial = "Eliminar";
$observacion_historial = "Se ha eliminado el servicio $servicio_nombre y la jornada $jornada_nombre la cual había sido asignada al colaborador $colaborador_nombre";
$modulo = "Servicio Puesto Colaboradores";
$insert = "INSERT INTO historial 
   VALUES('$historial_numero','0','0','$modulo','$id','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
$mysqli->query($insert);	   
/********************************************/

if($query){
	echo 1;//REGISTRO ELIMINADO CORRECTAMENTE
}else{
	echo 2;//ERROR AL ELIMINAR EL REGISTRO
}

$mysqli->close();//CERRAR CONEXIÓN
?>