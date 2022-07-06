<?php
include('../funtions.php');
session_start(); 	

//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$colaborador_id = $_SESSION['colaborador_id'];
$fecha = date("Y-m-d");

//FECHA
$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$nuevafecha = date("Y-m-d", strtotime ( '-1 day' , strtotime ( $fecha )));

$mes_acutal=nombremes(date("m", strtotime($fecha)));

$consultar_puesto_colaborador = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto_colaborador);
$consultar_puesto_colaborador2 = $result->fetch_assoc();
$puesto_colaboradores = $consultar_puesto_colaborador2['puesto_id'];

if ($puesto_colaboradores == 2 || $puesto_colaboradores == 4){	 
    $consultar_registros = "SELECT COUNT(pacientes_id) AS 'total' 
	     FROM agenda 
         WHERE CAST(fecha_cita AS DATE) BETWEEN '$fecha_inicial' AND '$nuevafecha' AND status = 0 and preclinica = 1 AND colaborador_id = '$colaborador_id'";
    $result = $mysqli->query($consultar_registros);		 
}else{	 		 
    $consultar_registros = "SELECT COUNT(pacientes_id) AS 'total' 
	     FROM agenda 
         WHERE CAST(fecha_cita AS DATE) BETWEEN '$fecha_inicial' AND '$nuevafecha' AND status = 0 AND colaborador_id = '$colaborador_id'";
    $result = $mysqli->query($consultar_registros);		 
}

$consultar_registros2 = $result->fetch_assoc();
$total = $consultar_registros2['total'];

if($fecha == $fecha_inicial){
	$total = 0;
}

$datos = array(
				0 => $total, 
				1 => $mes_acutal,				
				);
				
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>