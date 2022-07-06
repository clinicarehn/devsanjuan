<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

$entrevista_id = $_POST['entrevista_id'];

if(isset($_POST['modalidad'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['modalidad'] == ""){
	   $modalidad = 0;
   }else{
	   $modalidad = $_POST['modalidad'];
   }
}else{
	$modalidad = 0;
}

$entrevistado = mb_convert_case(trim($_POST['entrevistado']), MB_CASE_TITLE, "UTF-8");

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

$agenda = mb_convert_case(trim($_POST['agenda']), MB_CASE_TITLE, "UTF-8");

if(isset($_POST['servicio_id'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['servicio_id'] == ""){
	   $servicio_id = 0;
   }else{
	   $servicio_id = $_POST['servicio_id'];
   }
}else{
	$servicio_id = 0;
}

$motivo = mb_convert_case(trim($_POST['motivo']), MB_CASE_TITLE, "UTF-8");
$desarrollo = mb_convert_case(trim($_POST['desarrollo']), MB_CASE_TITLE, "UTF-8");
$valoracion = mb_convert_case(trim($_POST['valoracion']), MB_CASE_TITLE, "UTF-8");
$observaciones = mb_convert_case(trim($_POST['observaciones']), MB_CASE_TITLE, "UTF-8");

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

if(isset($_POST['intervencion'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['intervencion'] == ""){
	   $intervencion = 0;
   }else{
	   $intervencion = $_POST['intervencion'];
   }
}else{
	$intervencion = 0;
}

//ACTUALIZAMOS LOS DATOS DE LA ENTREVISTA
$update = "UPDATE entrevista
	SET
		entrevista_modalidad_id = '$modalidad',
		entrevista_intervencion_id = '$intervencion',
		entrevistado = '$entrevistado',
		relacion_paciente = '$relacion',
		solicitado = '$solicitado',
		motivo = '$motivo',
		desarollo = '$desarrollo',
		valoracion = '$valoracion',
		observacion = '$observaciones',
		agenda = '$agenda',
		clasificacion1 = '$clasificacion1',
		tipologia1 = '$tipologia1',
		clasificacion2 = '$clasificacion2',
		tipologia2 = '$tipologia2',
		clasificacion3 = '$clasificacion3',
		tipologia3 = '$tipologia3'
	WHERE entrevista_id = '$entrevista_id'";	
$query = $mysqli->query($update);

if($query){//REGISTRO ALMACENADO CORRECTAMENTE
	$datos = array(
		0 => "Registro Editado", 
		1 => "Registro Editado Correctamente", 
		2 => "success",
		3 => "btn-primary",
		4 => "",
		5 => "Registro",
		6 => "EntrevistaTS",		
	);
}else{//NO SE PUEDO ALMACENAR ESTE REGISTRO	
	$datos = array(
		0 => "Error", 
		1 => "No se puedo modificar este registro, los datos son incorrectos por favor corregir", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",			
	);
}

echo json_encode($datos);
?>