<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$hosp_id = $_POST['hosp_id'];
$consultar = "SELECT historial_id, fecha, expediente, servicio_id, paciente, estado, observacion 
    FROM hospitalizacion 
	WHERE hosp_id = '$hosp_id'";
$result = $mysqli->query($consultar);
$consultar2 = $result->fetch_assoc();
$historial_id = $consultar2['historial_id'];
$fecha = $consultar2['fecha'];
$expediente = $consultar2['expediente'];
$servicio_id = $consultar2['servicio_id'];
$paciente = $consultar2['paciente'];
$estado = $consultar2['estado'];
$observacion = cleanStringStrtolower($consultar2['observacion']);
$puesto_id = 1;
$fecha_sistema = date("Y-m-d");
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

//CONSULTAR VALORES EN LA ENTIDAD PACIENTES
$consulta_pacientes = "SELECT pacientes_id, CONCAT(nombre, ' ', apellido) AS nombre
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_pacientes);
$consulta_pacientes2 = $result->fetch_assoc();
$pacientes_id = $consulta_pacientes2['pacientes_id'];
$paciente_nombre = $consulta_pacientes2['nombre'];

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(historial_id) AS max, COUNT(historial_id) AS count 
    FROM historial_camas";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero_historial = $correlativo2['max'];
$cantidad_historial = $correlativo2['count'];
 
if ( $cantidad_historial == 0 )
  $numero_historial = 1;
else
  $numero_historial = $numero_historial + 1;
  
//HISTORIAL DE CAMAS
//CONSULTAR HISTORIAL DE CAMAS
$consultar_historial_camas = "SELECT cama_id, usuario, color, paciente, observaciones, porcentaje 
    FROM historial_camas 
    WHERE historial_id = '$historial_id'";	 
$result = $mysqli->query($consultar_historial_camas);	
	   
$consultar_historial_camas2 = $result->fetch_assoc();
$cama_id = $consultar_historial_camas2['cama_id'];
$usuario = $consultar_historial_camas2['usuario'];
$color = "#FAF03C"; //Color AMARILLO
$paciente = $consultar_historial_camas2['paciente'];
$observaciones = $consultar_historial_camas2['observaciones'];
$porcentaje = $consultar_historial_camas2['porcentaje'];
$estado1 = 2;	   
 
$correlativo = "SELECT MAX(hosp_id) AS max, COUNT(hosp_id) AS count 
   FROM hospitalizacion";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
  $numero = 1;
else
  $numero = $numero + 1; 

//CONSULTAR EXPEDIENTE SI EXISTE
$consulta_existencia_hospitalizacion = "SELECT hosp_id 
    FROM hospitalizacion 
	WHERE expediente = '$expediente' AND servicio_id = '$servicio_id' AND puesto_id = '$puesto_id' AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
$result = $mysqli->query($consulta_existencia_hospitalizacion);
$consulta_existencia_hospitalizacion2 = $result->num_rows;

$consulta_existencia_historial_camas = "SELECT historial_id 
    FROM historial_camas 
	WHERE expediente = '$expediente' AND servicio_id = '$servicio_id' AND puesto_id = '$puesto_id' AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
$result = $mysqli->query($consulta_existencia_historial_camas);
$consulta_existencia_historial_camas2 = $result->num_rows;

if($consulta_existencia_hospitalizacion2>0 && $consulta_existencia_historial_camas2 > 0){
	echo 3;
}else{
   //INSERTAR DATOS   
   $insert = "INSERT INTO historial_camas 
       values('$numero_historial','$fecha','$expediente','$cama_id','$servicio_id','$puesto_id','$usuario','$color','$paciente','','$estado1','$porcentaje','$fecha_registro')"; 
   $query = $mysqli->query($insert); 

   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Agregar";
   $observacion_historial = "Se ha transferido el usuario $paciente_nombre con expediente: $expediente a Psicología en el área de Hospitalización para el servicio: $servicio_nombre";
   $modulo = "Hospitalizacion";
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_historial','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
   $mysqli->query($insert);
   /*****************************************************/
   
   if($query){	 
     $insert = "INSERT INTO hospitalizacion 
	      VALUES('$numero','$numero_historial','0','$fecha','$expediente','$servicio_id', '0', '$puesto_id','$paciente','$estado','$observacion','0','0','0', '', '0', '', '0', '','0','0','$fecha_registro')";
	 $mysqli->query($insert); 
	 
     //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
     $historial_numero = historial();
     $estado_historial = "Agregar";
     $observacion_historial = "Se ha transferido el usuario $paciente_nombre con expediente: $expediente a Psicología, Historail de camas en Hospitalización para el servicio: $servicio_nombre";
     $modulo = "Historial de Camas";
     $insert = "INSERT INTO historial 
        VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
     $mysqli->query($insert);
     /*****************************************************/	 
	 
	 echo 1;
   }else{
	  echo 2;
   }	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>