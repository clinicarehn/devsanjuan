<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$expediente_valor = $_POST['expediente'];

$consultar_expediente = "SELECT pacientes_id, expediente 
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();

$expediente = "";
$pacientes_id = "";

if($result->num_rows>0){
	$expediente = $consultar_expediente2['expediente'];
	$pacientes_id = $consultar_expediente2['pacientes_id'];	
}

$fecha = $_POST['fecha'];

$gestion = 0;
if(isset($_POST['gestion'])){
   if($_POST['gestion'] == ""){
       $gestion = 0;
   }else{
	   $gestion = $_POST['gestion'];
   }
}

$seguimiento = 2;
if(isset($_POST['seguimiento'])){
   if($_POST['seguimiento'] == ""){
       $seguimiento = 2;
   }else{
	   $seguimiento = $_POST['seguimiento'];
   }
}

$calidez = 2;
if(isset($_POST['calidez'])){
   if($_POST['calidez'] == ""){
       $calidez = 2;
   }else{
	   $calidez = $_POST['calidez'];
   }
}

$competencia = 2;
if(isset($_POST['competencia'])){
   if($_POST['competencia'] == ""){
       $competencia = 2;
   }else{
	   $competencia = $_POST['competencia'];
   }
}

$estructura = 2;
if(isset($_POST['estructura'])){
   if($_POST['estructura'] == ""){
       $estructura = 2;
   }else{
	   $estructura = $_POST['estructura'];
   }
}

$organizacion = 2;
if(isset($_POST['organizacion'])){
   if($_POST['organizacion'] == ""){
       $organizacion = 2;
   }else{
	   $organizacion = $_POST['organizacion'];
   }
}

$otros = 2;
if(isset($_POST['otros'])){
   if($_POST['otros'] == ""){
       $otros = 2;
   }else{
	   $otros = $_POST['otros'];
   }
}

$otro_detalle = cleanStringStrtolower($_POST['otro_detalle']);

$incidente = 2;
if(isset($_POST['incidente'])){
   if($_POST['incidente'] == ""){
       $incidente = 2;
   }else{
	   $incidente = $_POST['incidente'];
   }
}

$servicio = 0;
if(isset($_POST['servicio'])){
   if($_POST['servicio'] == ""){
       $servicio = 0;
   }else{
	   $servicio = $_POST['servicio'];
   }
}

$queja = cleanStringStrtolower($_POST['queja']);
$queja1 = cleanStringStrtolower($_POST['queja1']);
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER CORRELATIVO PACIENTES_SEGUIMIENTO
$correlativo_queja = correlativo("queja_id","queja");

//CONSULTAMOS SI EL REGISTRO YA ESTA ALMACENADO
$query_seguimiento = "SELECT queja_id 
    FROM queja
	WHERE pacientes_id = '$pacientes_id' AND servicio_id = '$servicio' AND fecha = '$fecha'";
$result_segumiento = $mysqli->query($query_seguimiento);

if($result_segumiento->num_rows == 0){
  $insert_pacientes_usuario = "INSERT INTO queja 
      VALUES('$correlativo_queja','$pacientes_id','$servicio','$fecha','$gestion','$seguimiento','$calidez', '$competencia', '$estructura','$organizacion','$otros', '$otro_detalle', '$queja', '$queja1', '$usuario', '$fecha_registro')";
	  
      $sql = $mysqli->query($insert_pacientes_usuario);
	  
      if($sql){
		echo 1;//REGISTRO ALMACENADO CORRECTAENTE
				
		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Actualizar";
		$observacion_historial = "Se ha registrado una Queja";
		$modulo = "Agenda";
		$insert = "INSERT INTO historial 
			 VALUES('$historial_numero','0','0','$modulo','0','$usuario','$servicio','$fecha_registro','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
	    
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