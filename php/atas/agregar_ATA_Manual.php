<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

include('../conexion-postgresql.php');
date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro_ata'];

$expediente_valor = $_POST['expediente_ata'];

//OBTENEMOS EL NUMERO DE EXPEDIENTE DEL USUARIO
$consultar_expediente = "SELECT expediente, pacientes_id, departamento_id, municipio_id, localidad, sexo
       FROM pacientes 
	   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	   
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];
$departamento_id = $consultar_expediente2['departamento_id'];
$municipio_id = $consultar_expediente2['municipio_id'];
$localidad = $consultar_expediente2['localidad'];
$sexo = $consultar_expediente2['sexo'];

$fecha = $_POST['fecha_ata'];
$fecha_cita = date("Y-m-d H:i:s", strtotime($_POST['fecha_ata']));
$fecha_cita_end = date("Y-m-d H:i:s", strtotime($_POST['fecha_ata']));
$paciente = $_POST['paciente_ata'];

if(isset($_POST['patologia_ata1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['patologia_ata1'] == ""){
	   $patologia_id1 = 0;
   }else{
	   $patologia_id1 = $_POST['patologia_ata1'];
   }    
}else{
	$patologia_id1 = 0;
}

if(isset($_POST['patologia_ata2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['patologia_ata2'] == ""){
	   $patologia_id2 = 0;
   }else{
	   $patologia_id2 = $_POST['patologia_ata2'];
   }    
}else{
	$patologia_id2 = 0;
}

if(isset($_POST['patologia_ata3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['patologia_ata3'] == ""){
	   $patologia_id3 = 0;
   }else{
	   $patologia_id3 = $_POST['patologia_ata3'];
   }    
}else{
	$patologia_id3 = 0;
}

//CONSULTAR EXISTENCIA PATOLOGIA
/*1ER PATOLOGIA*/
$consultar_patologia1 = "SELECT expediente 
    FROM ata 
	WHERE patologia_id = '$patologia_id1' AND expediente = '$expediente'";
$result = $mysqli->query($consultar_patologia1);
$consultar_patologia1_1 = $result->num_rows;

if ($consultar_patologia1_1==0){
	$patologiaid_tipo1 = 'N';
}else{
	$patologiaid_tipo1 = 'S';
}

/*2DA PATOLOGIA*/
if($patologia_id2 != 0){
  $consultar_patologia2 = "SELECT expediente 
      FROM ata 
	  WHERE patologia_id1 = '$patologia_id2' AND expediente = '$expediente'";
  $result = $mysqli->query($consultar_patologia2);
  $consultar_patologia2_1 = $result->num_rows;

  if ($consultar_patologia2_1==0){
	$patologiaid_tipo2 = 'N';
  }else{
	$patologiaid_tipo2 = 'S';
  }
}else{
	$patologiaid_tipo2 = '';
}

/*3ER PATOLOGIA*/
if($patologia_id3 != 0){
  $consultar_patologia3 = "SELECT expediente 
      FROM ata 
	  WHERE patologia_id2 = '$patologia_id3' AND expediente = '$expediente'";
  $result = $mysqli->query($consultar_patologia3);
  $consultar_patologia3_1 = $result->num_rows;

  if ($consultar_patologia3_1==0){
	$patologiaid_tipo3 = 'N';
  }else{
	 $patologiaid_tipo3 = 'S';
  }
}else{
	$patologiaid_tipo3 = '';
}

$servicio_id = $_POST['servicio_ata'];
$unidad = $_POST['unidad_ata'];
$colaborador_id = $_POST['colaborador_ata'];
$obs = mb_convert_case(trim($_POST['observacion_ata']), MB_CASE_TITLE, "UTF-8");
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

if(isset($_POST['primera1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['primera1'] == null || $_POST['primera1'] == ""){
		$paciente_agenda = 1;
	}else{
		$paciente_agenda = $_POST['primera1'];
	}
}else{
	$paciente_agenda = 1;
}

if($paciente_agenda == 1){
	$paciente_agenda_estado = 'N'; 
}else{
	$paciente_agenda_estado = 'S';
}

/*********************************************************************************/
//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];

//CONSULTA AÑO, MES y DIA DEL PACIENTE
$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/

//CONSULTAR EXISTENCIA DE REGISTRO
$consulta = "SELECT ata_id
    FROM ata
	WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
$result = $mysqli->query($consulta);		
$consulta2 = $result->fetch_assoc();
$ata_id = $consulta2['ata_id'];	
	
$numero_atenciones = correlativo("ata_id", "ata");

$enviadaa = '';
$recibidade = '';
$referencia_mayor = '';
$respuesta1 = '';
$respuesta2 = '';
$tiempo_estancia = '';
$referencia = '';
$enfermedad_id = 0;
$tipos_atencion_id = 0;
$cantidad_tipos_atencion = 0;
$nivel_socioeconomico_id = 0;
$problema_social_id = 0;
$motivo_traslado_id = 0;

if($departamento_id != 0 && $municipio_id != 0 && $sexo != ""){
  if($ata_id == ""){
     //ALMACENAMOS EL REGISTRO EN EL ATA DEL USUARIO
     $insert = "INSERT INTO ata 
        VALUES('$numero_atenciones','$colaborador_id','$expediente','$anos', '$meses', '$dias', '$departamento_id', '$municipio_id', '$localidad','$paciente','$patologia_id1', '$patologiaid_tipo1', '$patologia_id2', '$patologiaid_tipo2', '$patologia_id3', '$patologiaid_tipo3 ','$servicio_id','$enviadaa','$recibidade','$fecha','$referencia_mayor','$respuesta1','$respuesta2','$tiempo_estancia','$referencia','$obs','$enfermedad_id','$tipos_atencion_id','$cantidad_tipos_atencion','$nivel_socioeconomico_id','$problema_social_id','$motivo_traslado_id','$fecha_registro')";
     $query = $mysqli->query($insert);
      
     if($query){
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado = "Agregar";
       $observacion = "Se ha almacenado el registro en el ATA del usuario";
       $modulo = "ATA";
       $insert = "INSERT INTO historial 
          VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_atenciones','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/
	   
	   //AGREGAMOS LA AGENDA PARA ESTE REGISTRO
	   $numero_agenda = correlativo("agenda_id", "agenda");
	   $estado_agenda = 1;
	   $color = '#DF0101';
	   $observacion_agenda = "Este usuario fue agregado de forma Manual al sistema";
	   $comentario_agenda = '';
	   $preclinica = 1;
	   $postclinica = 1;
	   $reprogramo = 2; //1. Sí, 2. No
	   $status_id_agenda = 0;
	   
	  //VERIFICAMOS SI EXISTE LA ATENCION DE ESTE USUARIO
	  //CONSULTAR AGENDA SI HAY VALORES
      $consultar_agenda = "SELECT a.agenda_id 
		  FROM agenda AS a
		  INNER JOIN colaboradores AS c
		  ON a.colaborador_id = c.colaborador_id
	      WHERE a.expediente = '$expediente' AND cast(a.fecha_cita AS DATE) = '$fecha_cita' AND c.colaborador_id = 'colaborador_id' AND a.servicio_id = '$servicio_id'";
	   $result = $mysqli->query($consultar_agenda);
       $consultar_agenda1 = $result->fetch_assoc();
       $agenda_id = $consultar_agenda1['agenda_id'];
	
	   if($agenda_id == ""){
	      $insert = "INSERT INTO agenda 
	          VALUES('$numero_agenda','$pacientes_id','$expediente','$colaborador_id','00:00','$fecha_cita','$fecha_cita_end','$fecha_registro','$estado_agenda','$color','$observacion_agenda','$usuario','$servicio_id','$comentario_agenda','$preclinica','$postclinica','$reprogramo','$paciente_agenda_estado','$status_id_agenda')";
	      $mysqli->query($insert);
	   
          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
          $historial_numero = historial();
          $estado = "Agregar";
          $observacion = "Se ha almacenado la cita de este usuario de forma manual";
          $modulo = "Agenda";
          $insert = "INSERT INTO historial 
              VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$colaborador_id','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
          $mysqli->query($insert);
          /*****************************************************/			   
	   }		  
	  
	   echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
    }else{
	   echo 2;//ERROR AL ALMACENAR EL REGISTRO
     }	   
  }else{
	 echo 3; //ESTE REGISTRO YA EXISTE
  }
}else{
	echo 4;// HAY REGISTROS EN BLANCO, EN LA ENTIDAD PACIENTE
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>