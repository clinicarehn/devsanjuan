<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$hosp_id = $_POST['hosp_id'];
$expediente = $_POST['expediente'];

$consultar_existencias = "SELECT fecha, historial_id 
    FROM hospitalizacion 
	WHERE hosp_id = '$hosp_id'";
$result = $mysqli->query($consultar_existencias);
$consultar_existencias2 = $result->fetch_assoc();
$fecha_consultada = $consultar_existencias2['fecha'];
$historial_id = $consultar_existencias2['historial_id'];

$año = date("Y", strtotime($fecha_consultada));
$mes = date("m", strtotime($fecha_consultada));

$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));//1ER FECHA DEL MES
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));//ULTIMA FECHA DEL MES

$query = "SELECT hosp_id 
    FROM hospitalizacion 
	WHERE expediente = '$expediente' AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND estado = 1";
$result = $mysqli->query($query);
$nvalores = $result->num_rows;

if($nvalores>=2){
	echo 1;//NO SE PUEDE ELIMINAR EL REGISTRO YA HA TENIDO DOS ATENCIONES
}else{
//ELIMINAMOS EL REGISTRO
   $query = "DELETE 
        FROM hospitalizacion 
		WHERE expediente = '$expediente' AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
   $dato = $mysqli->query($query);
   
   if($dato){
	   echo 2;//ELIMINO CORRECTAMENTE EL REGISTRO	   
	   //CONSULTA CAMA
	   $consulta_cama = "SELECT cama_id 
	        FROM historial_camas 
			WHERE historial_id = '$historial_id'";
	   $result = $mysqli->query($consulta_cama);
	   $consulta_cama2 = $result->fetch_assoc();
       $cama_id = $consulta_cama2['cama_id'];
	   
	   //ACUTALIZAR ESTADO DE LA CAMA
	   $update = "UPDATE camas SET estado = 0 
	      WHERE cama_id = '$cama_id'";
	   $mysqli->query($update);
	   
	   $delete = "DELETE FROM historial_camas 
	       WHERE expediente = '$expediente' AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
	   $mysqli->query($delete);
   }else{
	   echo 3;//ERROR AL ELIMINAR EL REGISTRO
   }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN   
?>