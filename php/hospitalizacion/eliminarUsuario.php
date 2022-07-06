<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');

$historial_id = $_POST['historial_id'];
$cama_id = $_POST['cama_id'];
$fecha_ = $_POST['fecha'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");


$año = date("Y", strtotime($fecha_));
$mes = date("m", strtotime($fecha_));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

//OBTENER EXPEDIENTE DEL HISTORIAL DE CAMAS
$consulta = "SELECT expediente 
   FROM historial_camas 
   WHERE historial_id = '$historial_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$expediente = $consulta2['expediente'];

//CONSULTAMOS LA EXISTENCIA DEL REGISTRO ANTES DE ELIMINARLO
$query = "SELECT historial_id, servicio_id, fecha
    FROM historial_camas 
	WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND expediente = '$expediente'";
$result = $mysqli->query($query);
$consulta_historial = $result->fetch_assoc();
$servicio_id = $consulta_historial['servicio_id']; 
$fecha = $consulta_historial['fecha']; 

//CONSULTAR VALORES EN LA ENTIDAD PACIENTES
$consulta_pacientes = "SELECT pacientes_id, CONCAT(nombre, ' ', apellido) AS nombre
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_pacientes);
$consulta_pacientes2 = $result->fetch_assoc();
$pacientes_id = $consulta_pacientes2['pacientes_id']; 
$paciente_nombre = $consulta_pacientes2['nombre'];

$nroProductos = $result->num_rows;
//LIBERAMOS LA CAMA CAMBIANDO SU ESTADO

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

if ($nroProductos > 1 ){
	echo 2; //HAY REGISTROS ALAMCENADOS
}else{
    $update = "UPDATE camas SET estado = 0 
	    WHERE cama_id = '$cama_id'";	
	$query = $mysqli->query($update);
	
    if($query){
	   //ELIMINAR HISTORIAL DE CAMAS
	   $delete = "DELETE FROM historial_camas 
	       WHERE expediente = '$expediente' AND fecha = '$fecha'";
	   $mysqli->query($delete);
	   
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado = "Eliminar";
       $observacion_historial = "Se ha eliminado el historial de cama para el usuario $paciente_nombre con expediente $expediente, en el area de Hospitalización para el servicio: $servicio_nombre";
       $modulo = "Hospitalizacion";
       $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','0','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/			   
	   
	   $delete = "DELETE FROM hospitalizacion 
	       WHERE expediente = '$expediente' AND fecha = '$fecha'";
       $mysqli->query($delete);	

       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado = "Eliminar";
       $observacion_historial = "Se ha eliminado el registro $paciente_nombre con $expediente, del area de Hospitalización en el servicio: $servicio_nombre";
       $modulo = "Hospitalizacion";
       $insert = "INSERT INTO historial 
           VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','0','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/		   
	   echo 1;
    }else{
	   echo 3;
    }	
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>