<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$identidad = $_POST['identidad'];
$nombres = cleanStringStrtolower($_POST['nombres']);
$apellidos = cleanStringStrtolower($_POST['apellidos']);
$fecha_atencion = $_POST['fecha'];
$fecha_nacimiento = $_POST['fecha_n'];
$telefono = $_POST['telefono'];
$servicio_id = 12;
$transferir = 2;

//OBTENER DATOS DEL PACIENTES
$consulta_pacientes = "SELECT expediente, pacientes_id
   FROM pacientes
   WHERE identidad = '$identidad'";
$result = $mysqli->query($consulta_pacientes); 
$consultar_pacientes_seg_id = $result->fetch_assoc();

$expediente = "";
$pacientes_id = "";

if($result->num_rows > 0){
	$expediente = $consultar_pacientes_seg_id['expediente'];
    $pacientes_id = $consultar_pacientes_seg_id['pacientes_id'];
}  

//CONSULTAR IDENTIDAD DEL USUARIO
if($identidad == 0){
	$flag_identidad = true;
	while($flag_identidad){
	   $d=rand(1,99999999);
	   $query_identidadRand = "SELECT pacientes_seg_id 
	       FROM pacientes_seguimiento 
		   WHERE identidad = '$d'";
	   $result_identidad = $mysqli->query($query_identidadRand);
	   if($result_identidad->num_rows==0){
		  $identidad = $d;
		  $flag_identidad = false;
	   }else{
		  $flag_identidad = true;
	   }		
	}
}

$genero = $_POST['genero'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];

$localidad = cleanStringStrtolower($_POST['localidad']);

$ansioso = 2;
if(isset($_POST['ansioso'])){
   if($_POST['ansioso'] == ""){
       $ansioso = 2;
   }else{
	   $ansioso = $_POST['ansioso'];
   }
}

$depresivo = 2;
if(isset($_POST['depresivo'])){
   if($_POST['depresivo'] == ""){
       $depresivo = 2;
   }else{
	   $depresivo = $_POST['depresivo'];
   }
}

$psicotico = 2;
if(isset($_POST['psicotico'])){
   if($_POST['psicotico'] == ""){
       $psicotico = 2;
   }else{
	   $psicotico = $_POST['psicotico'];//TIPO DE ATENCION
   }
}

$agitacion = 2;
if(isset($_POST['agitacion'])){
   if($_POST['agitacion'] == ""){
       $agitacion = 2;
   }else{
	   $agitacion = $_POST['agitacion'];//TIPO DE ATENCION
   }
}

$insomnio = 2;
if(isset($_POST['insomnio'])){
   if($_POST['insomnio'] == ""){
       $insomnio = 2;
   }else{
	   $insomnio = $_POST['insomnio'];//TIPO DE ATENCION
   }
}

$abandono_medicamento = 2;
if(isset($_POST['abandono_medicamento'])){
   if($_POST['abandono_medicamento'] == ""){
       $abandono_medicamento = 2;
   }else{
	   $abandono_medicamento = $_POST['abandono_medicamento'];//TIPO DE ATENCION
   }
}

$otros_sintomas = 2;
if(isset($_POST['otros_sintomas'])){
   if($_POST['otros_sintomas'] == ""){
       $otros_sintomas = 2;
   }else{
	   $otros_sintomas = $_POST['otros_sintomas'];//TIPO DE ATENCION
   }
}

$otros_especifique = cleanStringStrtolower($_POST['otros_especifique']);

$conducta_riegos = 2;
if(isset($_POST['conducta_riegos'])){
   if($_POST['conducta_riegos'] == ""){
       $conducta_riegos = 2;
   }else{
	   $conducta_riegos = $_POST['conducta_riegos'];//TIPO DE ATENCION
   }
}

$conducta_especifique = cleanStringStrtolower($_POST['conducta_especifique']);

$seguimiento = 0;
if(isset($_POST['seguimiento'])){
   if($_POST['seguimiento'] == ""){
       $seguimiento = 0;
   }else{
	   $seguimiento = $_POST['seguimiento'];//TIPO DE ATENCION
   }
}

$comentario = cleanStringStrtolower($_POST['comentario_seguimiento']);
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR PUESTO DE COLABORADOR
$query_puestos = "SELECT puesto_id
	FROM colaboradores
	WHERE colaborador_id = '$usuario'";
$result_puestos = $mysqli->query($query_puestos);
$puesto_id = "";
if($result_puestos->num_rows > 0){
	$consultar_puesto = $result_puestos->fetch_assoc();	
	$puesto_id = $consultar_puesto['puesto_id'];
}

//AGREGAR USUARIOS DE SEGUIMIENTO
//OBTENER CORRELATIVO PACIENTES_SEGUIMIENTO
$correlativo_pacientes_seguimiento = correlativo("pacientes_seg_id ","pacientes_seguimiento");

//CONSULTAMOS SI EL REGISTRO YA ESTA ALMACENADO
$query_seguimiento = "SELECT pacientes_seg_id
    FROM pacientes_seguimiento
	WHERE nombres = '$nombres' AND apellidos = '$apellidos'";
$result_segumiento = $mysqli->query($query_seguimiento);

if($result_segumiento->num_rows == 0){
  //AGREGAMOS LOS DATOS EN LOS PACIENTES DE SEGUIMIENTO
  $insert_pacientes_usuario = "INSERT INTO pacientes_seguimiento 
      VALUES('$correlativo_pacientes_seguimiento','$nombres','$apellidos','$genero','$identidad','$fecha_nacimiento','$telefono', '$departamento', '$municipio','$localidad','$usuario', '$transferir', '$fecha_registro')";
 
   $mysqli->query($insert_pacientes_usuario);
}

//CONSULTAR ID PACIENTES_ATENCION
$query_paciente = "SELECT pacientes_seg_id
    FROM pacientes_seguimiento
	WHERE nombres = '$nombres' AND apellidos = '$apellidos'";
$result_paciente = $mysqli->query($query_paciente);
$consultar_pacientes_seg_id = $result_paciente->fetch_assoc();
$pacientes_seg_id = "";

if($result_paciente->num_rows>0){
	$pacientes_seg_id = $consultar_pacientes_seg_id['pacientes_seg_id'];
}

//OBTENER CORRELATIVO ATA_SEGUIMIENTO
$numero = correlativo("ata_seguimiento_id ","ata_seguimiento");

//CONSULTAMOS SI EL REGISTRO ESTA ALMACENADO EN EL ATA_SEGUIMIENTO
$query_ata_seguimiento = "SELECT ata_seguimiento_id 
    FROM ata_seguimiento
	WHERE pacientes_seg_id = '$pacientes_seg_id' AND fecha = '$fecha_atencion'";

$result_ata_seguimiento = $mysqli->query($query_ata_seguimiento);

/*****************************************************/	
if($result_ata_seguimiento->num_rows == 0){//NO HAY REGISTROS ALMACENADOS
	$insert = "INSERT INTO ata_seguimiento VALUES ('$numero', '$pacientes_seg_id', '$fecha_atencion', '$ansioso', '$depresivo', '$psicotico', '$agitacion', '$insomnio', '$abandono_medicamento', '$otros_sintomas', '$otros_especifique', '$conducta_riegos', '$conducta_especifique', '$seguimiento', '$comentario', '$usuario', '$fecha_registro')"; 
	$sql = $mysqli->query($insert);
		
	if($sql){
		if($expediente == 0 && $puesto_id == 1){
			//ACTUALIZAMOS EL ESTADO DE LA AGENDA DEL PACIENTES
			$update = "UPDATE agenda SET status = 3 WHERE pacientes_id = '$pacientes_id'";
			$mysqli->query($update);
		}
				
		//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
		$historial_numero = historial();
		$estado = "Actualizar";
		$observacion_historial = "Se ha agregado un nuevo registro en el ATA-Seguimiento";
		$modulo = "Agenda";
		$insert = "INSERT INTO historial 
			 VALUES('$historial_numero','0','0','$modulo','0','$usuario','$servicio_id','$fecha_registro','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
	    
		$mysqli->query($insert);	

        echo 1;//REGISTRO ALMACENADO CORRECTAENTE		
	}else{
		echo 2;//ERROR AL ALMACENAR ESTE REGISTRO
	}	
}else{
     echo 3;//ESTE REGISTRO YA ESTA ALAMACENADO
}
/*****************************************************/		

$mysqli->close();//CERRAR CONEXIÓN
?>