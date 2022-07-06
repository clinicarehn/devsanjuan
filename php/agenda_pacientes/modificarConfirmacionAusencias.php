<?php
session_start();  
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro_confirmacion'];
$agenda_id = $_POST['agenda_id_confirmacion'];
$fecha = $_POST['fecha_confirmacion'];
$correo = $_POST['correo_confirmacion'];
$telefono = $_POST['telefono_confirmacion'];
$colaborador_id = $_POST['colaborador_id_confirmacion'];
$servicio_id = $_POST['servicio_id_confirmacion'];
$observacion = cleanStringStrtolower($_POST['observacion_confirmacion']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$confirmo = 0;
$confirmo1 = 0;

//CONFIRMACIONES
if(isset($_POST['confirmo_si'])){
   if($_POST['confirmo_si'] == ""){
       $confirmo = 0;	
   }else{
	   $confirmo = $_POST['confirmo_si'];
   }
}

if(isset($_POST['confirmo_no'])){
    if($_POST['confirmo_no'] == ""){
        $confirmo1 = 0;	
    }else{
	    $confirmo1 = $_POST['confirmo_no'];
    }
}

//RESPUESTA A CONFIRMACION
if(isset($_POST['respuesta_confirmacion'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['respuesta_confirmacion'] == ""){
		$respuesta = 0;
	}else{
	    $respuesta = $_POST['respuesta_confirmacion'];		
	}
}else{
	$respuesta = 0;
}

//CONSULTAR FECHA_CITA
$consulta_fecha = "SELECT CAST(fecha_cita AS DATE) AS 'fecha_cita', pacientes_id, expediente 
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consulta_fecha);
$consulta_fecha2 = $result->fetch_assoc();

$fecha_cita = "";
$pacientes_id = "";
$expediente = "";

if($result->num_rows>0){
	$fecha_cita = $consulta_fecha2['fecha_cita'];
	$pacientes_id = $consulta_fecha2['pacientes_id'];
	$expediente = $consulta_fecha2['expediente'];	
}

//CONSULTAR EXISTENCIA DE REGISTRO
$consultar_existencia = "SELECT confirmar_ausencias_repro_id 
      FROM confirmar_ausencias_repro 
      WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
$result = $mysqli->query($consultar_existencia);	  
$consultar_existencia2 = $result->fetch_assoc();

$consulta_existencia_cofirmacion = "";

if($result->num_rows>0){
	$consulta_existencia_cofirmacion = $consultar_existencia2['confirmar_ausencias_repro_id'];
}

if($consulta_existencia_cofirmacion != ""){
   $update = "UPDATE confirmar_ausencias_repro SET observacion = '$observacion', confirmo = '$respuesta', confirmo_status = '$confirmo', correo = '$correo', telefono = '$telefono'
         WHERE agenda_id = '$agenda_id'";
		 
   $query = $mysqli->query($update);

   if($query){
	  echo 1;
   }else{
	  echo 2;
   }
}else{
	echo 3;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>