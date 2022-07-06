<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$queja_id = $_POST['queja_id'];
$seguimiento = cleanStringStrtolower($_POST['seguimiento']);
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

$resuelta = 2;
if(isset($_POST['resuelta'])){
   if($_POST['resuelta'] == ""){
       $resuelta = 2;
   }else{
	   $resuelta = $_POST['resuelta'];
   }
}

//CONSULTAR DATOS DE LA Queja
$get_queja = "SELECT q.servicio_id AS 'servicio_id', p.pacientes_id AS 'pacientes_id', p.expediente As 'expediente'
   FROM queja AS q
   INNER JOIN pacientes AS p
   ON q.pacientes_id = p.pacientes_id
   WHERE queja_id = '$queja_id'";
$result = $mysqli->query($get_queja);	 
$consultar_expediente2 = $result->fetch_assoc();

$servicio_id = ""; 
$pacientes_id = ""; 
$expediente = ""; 

if($result->num_rows>0){
   $pacientes_id = $consultar_expediente2['pacientes_id']; 
   $expediente = $consultar_expediente2['expediente']; 
   $servicio_id = $consultar_expediente2['servicio_id'];    
}  

//OBTENER CORRELATIVO PACIENTES_SEGUIMIENTO
$correlativo_queja_segmimiento = correlativo("id  ","queja_detalle");

//CONSULTAMOS SI EL REGISTRO YA ESTA ALMACENADO
$query_seguimiento = "SELECT id 
    FROM queja_detalle
	WHERE queja_id = '$queja_id'";
$result_segumiento = $mysqli->query($query_seguimiento);

if($result_segumiento->num_rows == 0){
  $insert = "INSERT INTO queja_detalle 
      VALUES('$correlativo_queja_segmimiento','$queja_id','$seguimiento','$resuelta','$usuario','$fecha_registro')";
	  
      $sql = $mysqli->query($insert);
	  
      if($sql){
		echo 1;//REGISTRO ALMACENADO CORRECTAENTE
				
		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Actualizar";
		$observacion_historial = "Se ha registrado un seguimiento a la Queja";
		$modulo = "Agenda";
		$insert = "INSERT INTO historial 
			 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','0','$usuario','$servicio_id','$fecha_registro','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
	    
		$mysqli->query($insert);		
	}else{
		echo 2;//ERROR AL ALMACENAR ESTE REGISTRO
	}		  
}else{
	echo 3;//ESTE REGISTRO YA EXISTE
}
/*****************************************************/		

$mysqli->close();//CERRAR CONEXIÓN
?>