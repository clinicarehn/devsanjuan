<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$fecha = $_POST['fecha'];
$tanque_inicio = $_POST['tanque_inicio'];
$tanque_final = $_POST['tanque_final'];
$cantidad_litros = $_POST['cantidad_litros'];
$total_tanque = $tanque_inicio + $cantidad_litros;
$valor_compra = $_POST['valor_compra'];
$costo_litro = $valor_compra / $cantidad_litros;
$vehiculo_id = $_POST['vehiculo'];
$transportista = $_POST['transportista_combustible'];
$fecha_registro = date("Y-m-d H:i:s");
$colaborador_id = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER EL VEHICULO
$query_vehiculo = "SELECT nombre
   FROM vehiculo
   WHERE vehiculo_id = '$vehiculo_id'";
$result = $mysqli->query($query_vehiculo);
$comsulta_vehiculo = $result->fetch_assoc();
$vehiculo = $comsulta_vehiculo['nombre'];
	
$numero = correlativo($db, "combustible_id", "combustible");

if($colaborador_id != 0){
    $query = "INSERT INTO combustible 
         VALUES('$numero', '$vehiculo_id', '$fecha','$tanque_inicio','$tanque_final', '$cantidad_litros', '$total_tanque', '$valor_compra', '$costo_litro', '$colaborador_id', '$transportista', '$fecha_registro')"; 
	$result = $mysqli->query($query);
		   
    if($query){
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
       $historial_numero = historial($db);
       $estado_historial = "Agregar";
       $observacion_historial = "Se ha almacenado el combustible para el vehículo $vehiculo";
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

$mysqli->close();//CERRAR CONEXIÓN		
?>