<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$motivo = cleanStringStrtolower($_POST['motivo']);
$fecha = $_POST['fecha'];
$vehiculo_id = $_POST['vehiculo_t'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

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
	
$numero = correlativo($db ,"transporte_usuarios_id", "transporte_usuarios");

if($colaborador_id != 0){
    $insert = "INSERT INTO transporte_usuarios 
         VALUES('$numero', '$vehiculo_id', '$fecha','$motivo','$adulto_h','$adulto_m', '$niño', '$total', '$hora_inicial', '$hora_final', '$km_inicial', '$km_final','$total_km', '$transportista','$colaborador_id','$fecha_registro')";
    $query = $mysqli->query($insert);		 
		   
    if($query){
         //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
         $historial_numero = historial($db);
         $estado_historial = "Agregar";
         $observacion_historial = "Se ha almacenado el recorrido para el vehículo $vehiculo";
         $modulo = "Transporte";
         $insert = "INSERT INTO historial 
            VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
         $mysqli->query($insert);	 
         /********************************************/ 	
	   
	    echo 1;//REGISTRO ALMACENADO CORRECTAMENTE	  		  
    }else{
	    echo 2;//ERROR EN ALMACENAR EL REGISTRO
    }	   
}else{
    echo 3;//SU SESIÓN HA VENCIDO, POR FAVOR INICIAR SESIÓN NUEVAMENTE
}

/*
function correlativo($columna, $tabla, $mysqli){
    $correlativo= "SELECT DISTINCT MAX(".$columna.") AS max, COUNT(".$columna.") AS count 
	   FROM ".$tabla;
	$result = $mysqli->query($correlativo);
    $correlativo2 = $result->fetch_assoc();

    $numero = $correlativo2['max'];
    $cantidad = $correlativo2['count'];

    if ( $cantidad == 0 )
	   $numero = 1;
    else
       $numero = $numero + 1;

    return $numero;   
}*/

$mysqli->close();//CERRAR CONEXIÓN
?>