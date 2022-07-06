<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$proceso = $_POST['pro_enviada'];
$referencia = $_POST['referencia_id_enviada'];
$ata_id = $_POST['ata_id_enviada'];
$expediente = $_POST['expediente_enviada'];
$motivo = $_POST['motivo_enviada'];
$centros_nivel = $_POST['centros_nivel_enviada'];
$centro = $_POST['centro_enviada'];
$enviadaa = $_POST['enviadaa'];
$diagnostico = $_POST['diagnostico_enviada'];
$colaborador_id = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//CONSULTAR PACIENTES_ID DE LA ENTIDAD PACIENTES_ID
$query_paciente = "SELECT pacientes_id
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];  

//CONSULTAR DATOS DE LA ENTIDAD REFERENCIA
$query_referencia = "SELECT servicio_id, colaborador_id, fecha
   FROM referencia_enviada
   WHERE referenciar_id = '$referencia'";
$result = $mysqli->query($query_referencia);
$consulta_referencia = $result->fetch_assoc();
$servicio_id = $consulta_referencia['servicio_id']; 
$medico = $consulta_referencia['colaborador_id'];     
$fecha = $consulta_referencia['fecha'];  

if(isset($_POST['patologia1'])){
	if ($_POST['patologia1'] == ""){
		 $patologia1 = 0;
	}else{
         $patologia1 = $_POST['patologia1'];		
	}
}else{
	$patologia1 = 0;
}

if(isset($_POST['patologia2'])){
	if($_POST['patologia2'] == ""){
		$patologia2 = 0;
	}else{
        $patologia2 = $_POST['patologia2'];		
	}
}else{
	$patologia2 = 0;
}

if(isset($_POST['patologia3'])){
	if($_POST['patologia3'] == ""){
	   $patologia3 = 0;
	}else{
       $patologia3 = $_POST['patologia3'];		
	}
}else{
	$patologia3 = 0;
}

if(isset($_POST['motivo'])){
	if($_POST['motivo'] == ""){
	   $motivo_ref = 0;
	}else{
       $motivo_ref = $_POST['motivo'];		
	}
}else{
	$motivo_ref = 0;
}

//CONSULTAR MOTIVO REFERENCIA ENVIADA
if($motivo_ref != 0){
    $consulta_motivo = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo_ref'";	
	$result = $mysqli->query($consulta_motivo);
    $consulta_motivo1 = $result->fetch_assoc();
    $motivo_referencia_enviada = $consulta_motivo1['nombre'];	
}

if(isset($_POST['motivo_otro'])){
	if($_POST['motivo_otro'] == ""){
	   $motivo_otro = 0;
	}else{
       $motivo_otro = $_POST['motivo_otro'];		
	}
}else{
	$motivo_otro = 0;
}

//CONSULTAR MOTIVO REFERENCIA ENVIADA
if($motivo_otro != 0){
    $consulta_motivo_traslado_otro = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo_otro'";
	$result = $mysqli->query($consulta_motivo_traslado_otro);
    $consulta_motivo_traslado_otro1 = $result->fetch_assoc();
    $motivo_referencia_enviada_traslado_otro = $consulta_motivo_traslado_otro1['nombre'];
	
	if($motivo_referencia_enviada != ""){
		$motivo_referencia_enviada .= ", ".$motivo_referencia_enviada_traslado_otro;
	}else{
		$motivo_referencia_enviada = $motivo_referencia_enviada_traslado_otro;
	}
}
//CONSULTAR EXISTENCIA PATOLOGIA
/*1ER PATOLOGIA*/
$consultar_patologia1 = "SELECT expediente 
    FROM ata 
	WHERE patologia_id = '$patologia1' AND expediente = '$expediente'";
$result = $mysqli->query($consultar_patologia1);
$consultar_patologia1_1 = $result->num_rows;

if ($consultar_patologia1_1==0){
	$patologiaid_tipo1 = 'N';
}else{
	$patologiaid_tipo1 = 'S';
}

/*2DA PATOLOGIA*/
if($patologia2 != 0){
  $consultar_patologia2 = "SELECT expediente 
       FROM ata 
	   WHERE patologia_id1 = '$patologia2' AND expediente = '$expediente'";
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
if($patologia3 != 0){
  $consultar_patologia3 = "SELECT expediente 
      FROM ata 
	  WHERE patologia_id2 = '$patologia3' AND expediente = '$expediente'";
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


//OBTENER NOMBRE COLABORADOR
$consulta_colaborador = "SELECT CONCAT(nombre, ' ', apellido) AS 'nombre' 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_colaborador);
$consulta_colaborador2 = $result->fetch_assoc();
$colaborador_nombre = $consulta_colaborador2['nombre'];


if ($proceso = 'Edición'){
	$dato_referencia = "UPDATE referencia_enviada 
	   SET motivo_referencia = '$motivo_referencia_enviada', unidad_envia = '$enviadaa', nivel = '$centros_nivel', centro = '$centro', patologia1 = '$patologia1', patologia2 = '$patologia2', patologia3 = '$patologia3', motivo_traslado = '$motivo_ref', motivo_traslado_otros = '$motivo_otro'
	   WHERE referenciar_id = '$referencia'";
	$mysqli->query($dato_referencia);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Actualizar";
    $observacion = "Se ha modificado la información de la referencia enviada";
    $modulo = "Referencia Enviada";
    $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$referencia','$medico','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/			
	
	//OBTENER NOMBRE DEL CENTRO
	$consulta_nombre_centro = "SELECT centro_nombre 
	     FROM centros_hospitalarios WHERE centros_id = '$enviadaa'";
	$result = $mysqli->query($consulta_nombre_centro);
    $consulta_nombre_centro2 = $result->fetch_assoc();
    $centro_nombre = $consulta_nombre_centro2['centro_nombre'];	
	

	$dato_ata = "UPDATE ata 
	    SET enviadaa = '$centro_nombre', patologia_id = '$patologia1', patologia_id1 = '$patologia2', patologia_id2 = '$patologia3', patologiaid_tipo1 = '$patologiaid_tipo1', patologiaid_tipo2 = '$patologiaid_tipo2', patologiaid_tipo3 = '$patologiaid_tipo3' 
	    WHERE ata_id = '$ata_id'";
	$mysqli->query($dato_ata);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Actualizar";
    $observacion = "Se ha modificado la información de la referencia enviada en el ATA del usuario";
    $modulo = "ATA";
    $insert = "INSERT INTO historial 
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id','$medico','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/		
	
    if($dato_referencia == true){
		echo 1;//REGISTRO ALMACENADO CORRECTAMENTE 
	}else{
        echo 2;//ERROR AL GUARDAR EL REGISTRO
	}// && $dato_ata == true		
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>