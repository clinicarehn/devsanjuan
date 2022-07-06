<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();   
include('../funtions.php');

date_default_timezone_set('America/Tegucigalpa');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$proceso = $_POST['pro'];
$colaborador_id = $_POST['colaborador_id'];
$servicio = $_POST['servicio_colaborador'];

$servicio_jornada_colaborador = $_POST['servicio_jornada_colaborador'];
$cantidad_nuevos = $_POST['cantidad_nuevos'];
$cantidad_subsiguientes = $_POST['cantidad_subsiguientes'];
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

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
  WHERE servicio_id = '$servicio'";
$result = $mysqli->query($query_servicio);  
$consulta_servicio = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio['nombre'];   

//OBTENER NOMBRE DE JORNADA
$query_jornada = "SELECT nombre
   FROM jornada
   WHERE jornada_id = '$servicio_jornada_colaborador'";
$result = $mysqli->query($query_jornada) or die($mysqli->error);   
$consulta_jornada = $result->fetch_assoc();
$jornada_nombre = $consulta_jornada['nombre']; 
   
//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(id) AS max, COUNT(id) AS count 
   FROM servicios_puestos";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//CONSULTAMOS QUE EL REGISTRO EXISTA
$consulta = "SELECT id 
      FROM servicios_puestos 
	  WHERE servicio_id = '$servicio' AND colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta);	  
$consulta2 = $result->fetch_assoc();
$servicios_puestos_id = $consulta2['id'];
	
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	 
    if($servicio_jornada_colaborador != "" || $servicio != ""){	 
	   if($servicios_puestos_id == ""){
		   $insert = "INSERT INTO servicios_puestos VALUES('$numero', '$servicio_jornada_colaborador', '$servicio','$colaborador_id', '$cantidad_nuevos', '$cantidad_subsiguientes')";
		   $mysqli->query($insert);
		   
           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Agregar";
           $observacion_historial = "Se ha agregado al colaborador $colaborador_nombre en el nuevo servicio $servicio_nombre en la jornada de la $jornada_nombre, con un total de $cantidad_nuevos nuevos, y un total de $cantidad_subsiguientes subsiguientes";
           $modulo = "Servicio Puesto Colaboradores";
           $insert = "INSERT INTO historial 
               VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
           $mysqli->query($insert);	   
           /********************************************/		   
		   echo 1; //REGISTRO ALMACENADO
	   }else{
		   echo 2; //EL REGISTRO YA EXISTE
	   }
	}else{
		echo 3;//REGISTRO EN BLANCO
	}
	break;
	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>