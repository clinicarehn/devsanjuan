<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$combustible_id = $_POST['id-registro'];
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
$fecha_sistema = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

//OBTENER FECHA
$query_combustible = "SELECT fecha
    FROM combustible
	WHERE combustible_id = '$combustible_id '";
$result = $mysqli->query($query_combustible);
$comsulta_fecha = $result->fetch_assoc();
$fecha = $comsulta_fecha['fecha'];

//OBTENER EL VEHICULO
$query_vehiculo = "SELECT nombre
   FROM vehiculo
   WHERE vehiculo_id = '$vehiculo_id'";
$result = $mysqli->query($query_vehiculo);
$comsulta_vehiculo = $result->fetch_assoc();
$vehiculo = $comsulta_vehiculo['nombre'];
	
if($colaborador_id != 0){
    $update = "UPDATE combustible 
         SET tanque_inicio = '$tanque_inicio', tanque_final = '$tanque_final', cantidad_litros = '$cantidad_litros', total_tanque = '$total_tanque', valor_compra = '$valor_compra', costo_litro = '$costo_litro'
		 WHERE combustible_id = '$combustible_id'";
	$query = $mysqli->query($update);
		   
    if($query){
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
       $historial_numero = historial($db);
       $estado_historial = "Eliminar";
       $observacion_historial = "Se ha eliminado los registros de combustible para el vehículo $vehiculo, con fecha $fecha_sistema";
       $modulo = "Transporte";
       $insert = "INSERT INTO historial 
          VALUES('$historial_numero','0','0','$modulo','$combustible_id','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
       $mysqli->query($insert);	 
       /********************************************/ 	
   
	    echo 1;//REGISTRO ALMACENADO CORRECTAMENTE	  		  
    }else{
	    echo 2;//ERROR EN ALMACENAR EL REGISTRO
    }	   
}else{
    echo 3;//SU SESIÓN HA VENCIDO, POR FAVOR INICIAR SESIÓN NUEVAMENTE
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>