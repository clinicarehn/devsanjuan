<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$pacientes_id = $_POST['pacientes_id'];
$expediente = $_POST['expediente'];
$fecha = $_POST['fecha'];

if(isset($_POST['modalidad'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['modalidad'] == ""){
	   $modalidad = 0;
   }else{
	   $modalidad = $_POST['modalidad'];
   }
}else{
	$modalidad = 0;
}

$entrevistado = cleanStringStrtolower($_POST['entrevistado']);

if(isset($_POST['relacion'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['relacion'] == ""){
	   $relacion = 0;
   }else{
	   $relacion = $_POST['relacion'];
   }
}else{
	$relacion = 0;
}

if(isset($_POST['trabajador_social'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['trabajador_social'] == ""){
	   $trabajador_social = 0;
   }else{
	   $trabajador_social = $_POST['trabajador_social'];
   }
}else{
	$trabajador_social = 0;
}

if(isset($_POST['solicitado'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['solicitado'] == ""){
	   $solicitado = 0;
   }else{
	   $solicitado = $_POST['solicitado'];
   }
}else{
	$solicitado = 0;
}

$agenda = cleanStringStrtolower($_POST['agenda']);

if(isset($_POST['servicio_id'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['servicio_id'] == ""){
	   $servicio_id = 0;
   }else{
	   $servicio_id = $_POST['servicio_id'];
   }
}else{
	$servicio_id = 0;
}

$motivo = cleanStringStrtolower($_POST['motivo']);
$desarrollo = cleanStringStrtolower($_POST['motivo']);
$valoracion = cleanStringStrtolower($_POST['motivo']);
$observaciones = cleanStringStrtolower($_POST['observaciones']);

if(isset($_POST['clasificacion1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['clasificacion1'] == ""){
	   $clasificacion1 = 0;
   }else{
	   $clasificacion1 = $_POST['clasificacion1'];
   }
}else{
	$clasificacion1 = 0;
}

if(isset($_POST['tipologia1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['tipologia1'] == ""){
	   $tipologia1 = 0;
   }else{
	   $tipologia1 = $_POST['tipologia1'];
   }
}else{
	$tipologia1 = 0;
}

if(isset($_POST['clasificacion2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['clasificacion2'] == ""){
	   $clasificacion2 = 0;
   }else{
	   $clasificacion2 = $_POST['clasificacion2'];
   }
}else{
	$clasificacion2 = 0;
}

if(isset($_POST['tipologia2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['tipologia2'] == ""){
	   $tipologia2 = 0;
   }else{
	   $tipologia2 = $_POST['tipologia2'];
   }
}else{
	$tipologia2 = 0;
}

if(isset($_POST['clasificacion3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['clasificacion3'] == ""){
	   $clasificacion3 = 0;
   }else{
	   $clasificacion3 = $_POST['clasificacion3'];
   }
}else{
	$clasificacion3 = 0;
}

if(isset($_POST['tipologia3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['tipologia3'] == ""){
	   $tipologia3 = 0;
   }else{
	   $tipologia3 = $_POST['tipologia3'];
   }
}else{
	$tipologia3 = 0;
}

$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

if(isset($_POST['intervencion'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['intervencion'] == ""){
	   $intervencion = 0;
   }else{
	   $intervencion = $_POST['intervencion'];
   }
}else{
	$intervencion = 0;
}

//VERIFICAMOS QUE NO EXISTA EL REGISTRO
$query_entrevista = "SELECT entrevista_id
	FROM entrevista
	WHERE pacientes_id = '$pacientes_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
$result_entrevista = $mysqli->query($query_entrevista); 		
$consulta_entrevista = $result_entrevista->fetch_assoc();

if($result_entrevista->num_rows==0){
	$entrevista_id = correlativo('entrevista_id', 'entrevista');
	$insert = "INSERT INTO entrevista VALUES('$entrevista_id','$pacientes_id','$usuario','$servicio_id','$fecha','$modalidad','$intervencion','$entrevistado','$relacion','$solicitado','$motivo','$desarrollo','$valoracion','$observaciones','$agenda','$clasificacion1','$tipologia1','$clasificacion2','$tipologia2','$clasificacion3','$tipologia3','$usuario','$fecha_registro')";
	$query = $mysqli->query($insert);
	
	if($query){//REGISTRO ALMACENADO CORRECTAMENTE
		$datos = array(
			0 => "Almacenado", 
			1 => "Registro Almacenado Correctamente", 
			2 => "success",
			3 => "btn-primary",
			4 => "formulario_entrevista_trabajo_social",
			5 => "Registro",
			6 => "EntrevistaTS",
			7 => "modal_entrevista_trabajo_social",			
		);
	}else{//NO SE PUEDO ALMACENAR ESTE REGISTRO
		$datos = array(
			0 => "Error", 
			1 => "No se puedo almacenar este registro, los datos son incorrectos por favor corregir", 
			2 => "error",
			3 => "btn-danger",
			4 => "",
			5 => "",			
		);
	}
}else{//ESTE REGISTRO YA EXISTE
	$datos = array(
		0 => "Error", 
		1 => "Lo sentimos este registro ya existe no se puede almacenar", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",		
	);
}

echo json_encode($datos);
?>