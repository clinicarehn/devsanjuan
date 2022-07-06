<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

include('../conexion-postgresql.php');
date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];

$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];

$fecha_sistema = date('Y-m-d');
$año = date("Y", strtotime($fecha_sistema));
$fecha_inical = date("Y-m-d", strtotime($año."-01-01"));
$fecha_final = date("Y-m-d", strtotime($año."-12-31"));
$usuario = $_SESSION['colaborador_id'];

$obs = mb_convert_case(trim($_POST['obs']), MB_CASE_TITLE, "UTF-8");
$servicio = $_POST['servicio'];
$fecha_ingreso = $_POST['fecha_ingreso'];

/*INICIO PREGUNTAS*/
if(isset($_POST['maida_p1'])){
	$p1 = $_POST['maida_p1'];
}else{
	$p1 = 0;
}

if(isset($_POST['maida_p2'])){
	$p2 = $_POST['maida_p2'];
}else{
	$p2 = 0;
}

if(isset($_POST['maida_p3'])){
	$p3 = $_POST['maida_p3'];
}else{
	$p3 = 0;
}

if(isset($_POST['maida_p4'])){
	$p4 = $_POST['maida_p4'];
}else{
	$p4 = 0;
}

if(isset($_POST['maida_p5'])){
	$p5 = $_POST['maida_p5'];
}else{
	$p5 = 0;
}

if(isset($_POST['maida_p6'])){
	$p6 = $_POST['maida_p6'];
}else{
	$p6 = 0;
}
/*FIN PREGUNTAS*/

if(isset($_POST['patologia'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['patologia'] == ""){
		$patologia = 0;
	}else{
	    $patologia = $_POST['patologia'];
	}
}else{
	$patologia = 0;
}

$consultar_expediente = "SELECT expediente, pacientes_id 
       FROM pacientes 
	   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	   
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

if($patologia != 0){
   $consultar_patologia1 = "SELECT cuestionario_maida_id 
       FROM cuestionario_maida 
	   WHERE patologia_id = '$patologia' AND expediente = '$expediente'";
   $result = $mysqli->query($consultar_patologia1);
   $consultar_patologia1_1 = $result->num_rows;

   if ($consultar_patologia1_1==0){
	   $patologiaid_tipo1 = 'N';
   }else{
	  $patologiaid_tipo1 = 'S';
   }	
}else{
	$patologiaid_tipo1 = '';
}

$fecha_registro = date("Y-m-d H:i:s");
$colaborador_id = $_SESSION['colaborador_id'];

//INICIO CONSULTAR TIPO DE PACIENTE, NUEVO O SUBSIGUIENTE

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
     FROM colaboradores 
	 WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);	 
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];

$valores = "SELECT cm.cuestionario_maida_id
     FROM cuestionario_maida AS cm
     INNER JOIN colaboradores AS c
     ON cm.colaborador_id = c.colaborador_id
     WHERE cm.expediente = '$expediente' AND cm.fecha BETWEEN '$fecha_inical' AND '$fecha_final' AND cm.servicio_id = '$servicio' AND c.puesto_id = '$puesto_id'";
$result = $mysqli->query($valores);	 
	 
if($result->num_rows>0){
	$paciente = "S";
}else{
	$paciente = "N";	
}	 
//FIN CONSULTAR TIPO DE PACIENTE, NUEVO O SUBSIGUIENTE

//CONSULTAR EXISTENCIA DE REGISTRO
$consulta = "SELECT cuestionario_maida_id
    FROM cuestionario_maida
	WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio' AND fecha = '$fecha'";
$result = $mysqli->query($consulta);	
$consulta2 = $result->fetch_assoc();
$cuestionario_maida_id = $consulta2['cuestionario_maida_id'];	
	
$numero_atenciones = correlativo("cuestionario_maida_id", "cuestionario_maida");

  if($cuestionario_maida_id == ""){
    if($colaborador_id != 0 && $servicio != 0){
      $insert = "INSERT INTO cuestionario_maida 
           VALUES('$numero_atenciones', '$pacientes_id', '$expediente', '$servicio', '$colaborador_id', '$fecha', '$obs', '$paciente', '$fecha_ingreso', '$p1', '$p2', '$p3', '$p4', '$p5', '$patologia', '$patologiaid_tipo1', '$p6', '$colaborador_id', '$fecha_registro')";
	  $query = $mysqli->query($insert);
	  
      //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
      $historial_numero = historial();
      $estado = "Agregar";
      $observacion = "Se almacena el cuestionario de los usuarios egresados de MAIDA";
      $modulo = "Cuestionario Maida";
      $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_atenciones','$colaborador_id','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
      $mysqli->query($insert);
      /*****************************************************/	  
	  
      if($query){
	      echo 1;//REGISTRO ALMACENADO CORRECTAMENTE  		  
      }else{
	      echo 2;//ERROR EN ALMACENAR EL REGISTRO
      }	   
   }else{
	  echo 3;//SU SESIÓN HA VENCIDO, POR FAVOR INICIAR SESIÓN NUEVAMENTE
   }
 }else{
	echo 4;//ESTE REGISTRO YA HA SIDO ALMACENADO ANTERIORMENTE
 }
 
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>