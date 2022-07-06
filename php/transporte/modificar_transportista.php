<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$motivo = cleanStringStrtolower($_POST['motivo']);
$transporte_usuarios_id = $_POST['id-registro'];
$vehiculo_id = $_POST['vehiculo_t'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR FECHA REGISTRO
$consulta_transporte = "SELECT fecha
    FROM transporte_usuarios
	WHERE transporte_usuarios_id = '$transporte_usuarios_id'";
$result = $mysqli->query($consulta_transporte);
$consulta_transporte1 = $result->fetch_assoc();
$fecha = $consulta_transporte1['fecha'];

if(isset($_POST['adulto_h'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['adulto_h'] == ""){
		$adulto_h = 0;
	}else{
		$adulto_h = $_POST['adulto_h'];
	}
}else{
	$adulto_h = 0;
}

if(isset($_POST['adulto_m'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['adulto_m'] == ""){
		$adulto_m = 0;
	}else{
		$adulto_m = $_POST['adulto_m'];
	}
}else{
	$adulto_m = 0;
}

if(isset($_POST['niño'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['niño'] == ""){
		$niño = 0;
	}else{
		$niño = $_POST['niño'];
	}
}else{
	$niño = 0;
}

$total = $adulto_h + $adulto_m + $niño ;
$hora_inicial = $_POST['hora_inicial'];
$hora_final = $_POST['hora_final'];
$km_inicial = $_POST['km_inicial'];
$km_final = $_POST['km_final'];
$transportista = $_POST['transportista'];
$colaborador_id = $_SESSION['colaborador_id'];
$total_km = $km_final - $km_inicial;
$fecha_registro = date("Y-m-d H:i:s");

//OBTENER EL VEHICULO
$query_vehiculo = "SELECT nombre
   FROM vehiculo
   WHERE vehiculo_id = '$vehiculo_id'";
$result = $mysqli->query($query_vehiculo);
$comsulta_vehiculo = $result->fetch_assoc();
$vehiculo = $comsulta_vehiculo['nombre'];
	
if($colaborador_id != 0){
    $update = "UPDATE transporte_usuarios 
         SET motivo_viaje = '$motivo', adult_h = '$adulto_h', adult_m = '$adulto_m', niños = '$niño', total = '$total', hora_i = '$hora_inicial', hora_f = '$hora_final', km_i = '$km_inicial', km_f = '$km_final', km_total = '$total_km'
		 WHERE transporte_usuarios_id = '$transporte_usuarios_id'";
    $query = $mysqli->query($update);		 
		   
    if($query){
         //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
         $historial_numero = historial($db);
         $estado_historial = "Actualizar";
         $observacion_historial = "Se han actualizado los datos para el vehículo $vehiculo";
         $modulo = "Transporte";
         $insert = "INSERT INTO historial 
            VALUES('$historial_numero','0','0','$modulo','$transporte_usuarios_id','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
         $mysqli->query($insert);	 
         /********************************************/ 	
	   
	    echo 1;//REGISTRO ALMACENADO CORRECTAMENTE	  		  
    }else{
	    echo 2;//ERROR EN ALMACENAR EL REGISTRO
    }	   
}else{
    echo 3;//SU SESIÓN HA VENCIDO, POR FAVOR INICIAR SESIÓN NUEVAMENTE
}

$mysqli->close();//CERRAR CONEXIÓN
?>