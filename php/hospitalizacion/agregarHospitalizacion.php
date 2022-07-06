<?php
session_start();   
include('../funtions.php');
include('../conexion-postgresql.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");

$proceso = $_POST['pro'];
$hosp_id = $_POST['id-registro'];
$historial = $_POST['historial_id'];
$fecha = $_POST['fecha'];
$expediente_valor = $_POST['expediente'];
$estado = 1;
$servicio_id = $_POST['servicio_consulta'];
$usuario = $_SESSION['colaborador_id'];
$paciente = $_POST['paciente'];
$profesional_transito_recibida = $_POST['transito_profesional_recibida'];
$profesional_transito_enviada = $_POST['transito_profesional_enviada'];
$tipo_atencion_trabajosocial = $_POST['tipo_atencion_enviadas'];
$fecha_registro = date("Y-m-d H:i:s");
	
//RECETA
if(isset($_POST['receta'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	$receta_medica = $_POST['receta'];
}else{
	$receta_medica = "2";
}

//1ERA FILA
if(isset($_POST['medicamento1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento1'] == ""){
		$medicamento1 = "";
	}else{
		$medicamento1 = $_POST['medicamento1'];
	} 
}else{
	$medicamento1 = "";
}

if(isset($_POST['via1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['via1'] == ""){
		$via1 = "";
	}else{
		$via1 = $_POST['via1'];
	} 
}else{
	$via1 = "";
}

if(isset($_POST['frecuencia1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['frecuencia1'] == ""){
		$frecuencia1 = "";
	}else{
		$frecuencia1 = mb_convert_case($_POST['frecuencia1'], MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$frecuencia1 = "";
}

if(isset($_POST['cantidad1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['cantidad1'] == ""){
		$cantidad1 = "";
	}else{
		$cantidad1 = $_POST['cantidad1'];
	} 
}else{
	$cantidad1 = "";
}

if(isset($_POST['recomendaciones1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['recomendaciones1'] == ""){
		$recomendaciones1 = "";
	}else{
		$recomendaciones1 = mb_convert_case(trim($_POST['recomendaciones1']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$recomendaciones1 = "";
}

//2DA FILA
if(isset($_POST['medicamento2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento2'] == ""){
		$medicamento2 = "";
	}else{
		$medicamento2 = $_POST['medicamento2'];
	} 
}else{
	$medicamento2 = "";
}

if(isset($_POST['via2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['via2'] == ""){
		$via2 = "";
	}else{
		$via2 = $_POST['via2'];
	} 
}else{
	$via2 = "";
}

if(isset($_POST['frecuencia2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['frecuencia2'] == ""){
		$frecuencia2 = "";
	}else{
		$frecuencia2 = mb_convert_case(trim($_POST['frecuencia2']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$frecuencia2 = "";
}

if(isset($_POST['cantidad2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['cantidad2'] == ""){
		$cantidad2 = "";
	}else{
		$cantidad2 = $_POST['cantidad2'];
	} 
}else{
	$cantidad2 = "";
}

if(isset($_POST['recomendaciones2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['recomendaciones2'] == ""){
		$recomendaciones2 = "";
	}else{
		$recomendaciones2 = mb_convert_case(trim($_POST['recomendaciones2']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$recomendaciones2 = "";
}

//3RA FILA
if(isset($_POST['medicamento3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento3'] == ""){
		$medicamento3 = "";
	}else{
		$medicamento3 = $_POST['medicamento3'];
	} 
}else{
	$medicamento3 = "";
}

if(isset($_POST['via3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['via3'] == ""){
		$via3 = "";
	}else{
		$via3 = $_POST['via3'];
	} 
}else{
	$via3 = "";
}

if(isset($_POST['frecuencia3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['frecuencia3'] == ""){
		$frecuencia3 = "";
	}else{
		$frecuencia3 = mb_convert_case(trim($_POST['frecuencia3']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$frecuencia3 = "";
}

if(isset($_POST['cantidad3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['cantidad3'] == ""){
		$cantidad3 = "";
	}else{
		$cantidad3 = $_POST['cantidad3'];
	} 
}else{
	$cantidad3 = "";
}

if(isset($_POST['recomendaciones3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['recomendaciones3'] == ""){
		$recomendaciones3 = "";
	}else{
		$recomendaciones3 = mb_convert_case(trim($_POST['recomendaciones3']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$recomendaciones3 = "";
}

//4TA FILA
if(isset($_POST['medicamento4'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento4'] == ""){
		$medicamento4 = "";
	}else{
		$medicamento4 = $_POST['medicamento4'];
	} 
}else{
	$medicamento4 = "";
}

if(isset($_POST['via4'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['via4'] == ""){
		$via4 = "";
	}else{
		$via4 = $_POST['via4'];
	} 
}else{
	$via4 = "";
}

if(isset($_POST['frecuencia4'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['frecuencia4'] == ""){
		$frecuencia4 = "";
	}else{
		$frecuencia4 = mb_convert_case(trim($_POST['frecuencia4']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$frecuencia4 = "";
}

if(isset($_POST['cantidad4'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['cantidad4'] == ""){
		$cantidad4 = "";
	}else{
		$cantidad4 = $_POST['cantidad4'];
	} 
}else{
	$cantidad4 = "";
}

if(isset($_POST['recomendaciones4'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['recomendaciones4'] == ""){
		$recomendaciones4 = "";
	}else{
		$recomendaciones4 = mb_convert_case(trim($_POST['recomendaciones4']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$recomendaciones4 = "";
}


//5TA FILA
if(isset($_POST['medicamento5'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento5'] == ""){
		$medicamento5 = "";
	}else{
		$medicamento5 = $_POST['medicamento5'];
	} 
}else{
	$medicamento5 = "";
}

if(isset($_POST['via5'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['via5'] == ""){
		$via5 = "";
	}else{
		$via5 = $_POST['via5'];
	} 
}else{
	$via5 = "";
}

if(isset($_POST['frecuencia5'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['frecuencia5'] == ""){
		$frecuencia5 = "";
	}else{
		$frecuencia5 = mb_convert_case(trim($_POST['frecuencia5']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$frecuencia5 = "";
}

if(isset($_POST['cantidad5'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['cantidad5'] == ""){
		$cantidad5 = "";
	}else{
		$cantidad5 = $_POST['cantidad5'];
	} 
}else{
	$cantidad5 = "";
}

if(isset($_POST['recomendaciones5'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['recomendaciones5'] == ""){
		$recomendaciones5 = "";
	}else{
		$recomendaciones5 = mb_convert_case(trim($_POST['recomendaciones5']), MB_CASE_TITLE, "UTF-8");
	} 
}else{
	$recomendaciones5 = "";
}

if($medicamento1 != "" && $via1 != "" && $frecuencia1 != "" && $cantidad1 != "" && $recomendaciones1 != ""){
	$tipo_unidad = "Consultas/Medicamentos";	
}

if($medicamento2 != "" && $via2 != "" && $frecuencia2 != "" && $cantidad2 != "" && $recomendaciones2 != ""){
	$tipo_unidad = "Consultas/Medicamentos";	
}

if($medicamento3 != "" && $via3 != "" && $frecuencia3 != "" && $cantidad3 != "" && $recomendaciones3 != ""){
	$tipo_unidad = "Consultas/Medicamentos";	
}

if($medicamento4 != "" && $via4 != "" && $frecuencia4 != "" && $cantidad4 != "" && $recomendaciones4 != ""){
	$tipo_unidad = "Consultas/Medicamentos";	
}

if($medicamento5 != "" && $via5 != "" && $frecuencia5 != "" && $cantidad5 != "" && $recomendaciones5 != ""){
	$tipo_unidad = "Consultas/Medicamentos";	
}
/****************************************************************/
//REFERENCIA ENVIADA
if(isset($_POST['motivo_traslado'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['motivo_traslado'] == ""){
		$motivo_traslado = 0;
	}else{
	    $motivo_traslado = $_POST['motivo_traslado'];		
	}
}else{
	$motivo_traslado = 0;
}

//CONSULTAR MOTIVO REFERENCIA ENVIADA
if($motivo_traslado != 0){
    $consulta_motivo = "SELECT nombre 
	   FROM motivo_traslado 
	   WHERE motivo_traslado_id = '$motivo_traslado'";	
	$result = $mysqli->query($consulta_motivo);
    $consulta_motivo1 = $result->fetch_assoc();
    $motivo_referencia_enviada = $consulta_motivo1['nombre'];	
}

if(isset($_POST['motivo_e1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['motivo_e1'] == ""){
		$motivo_traslado_otro = 0;
	}else{
	    $motivo_traslado_otro = $_POST['motivo_e1'];		
	}
}else{
	$motivo_traslado_otro = 0;
}

//CONSULTAR MOTIVO REFERENCIA ENVIADA
if($motivo_traslado_otro != 0){
    $consulta_motivo_traslado_otro = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo_traslado_otro'";	
	$result = $mysqli->query($consulta_motivo_traslado_otro);
    $consulta_motivo_traslado_otro1 = $result->fetch_assoc();
    $motivo_referencia_enviada_traslado_otro = $consulta_motivo_traslado_otro1['nombre'];
	
	if($motivo_referencia_enviada != ""){
		$motivo_referencia_enviada .= ", ".$motivo_referencia_enviada_traslado_otro;
	}else{
		$motivo_referencia_enviada = $motivo_referencia_enviada_traslado_otro;
	}
}

if(isset($_POST['patologia1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA	
	if($_POST['patologia1'] == ""){
		$patologia_id1 = 0;
	}else{
		$patologia_id1 = $_POST['patologia1'];
	}
}else{
	$patologia_id1 = 0;
}

if(isset($_POST['patologia2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA	
	if($_POST['patologia2'] == ""){
		$patologia_id2 = 0;
	}else{
		$patologia_id2 = $_POST['patologia2'];
	}
}else{
	$patologia_id2 = 0;
}

if(isset($_POST['patologia3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA	
	if($_POST['patologia3'] == ""){
		$patologia_id3 = 0;
	}else{
		$patologia_id3 = $_POST['patologia3'];
	}
}else{
	$patologia_id3 = 0;
}

$asegurado = $_POST['ihss'];
$porta_referencia = "";

if(isset($_POST['enfermedad'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['enfermedad'] == ""){
		$enfermedad = 0;
	}else{
	   $enfermedad = $_POST['enfermedad'];	
	}	
}else{
	$enfermedad = 0;
}

$observaciones_hospi = mb_convert_case(trim($_POST['observaciones']), MB_CASE_TITLE, "UTF-8");
$fecha_sistema = date("Y-m-d");

$consultar_expediente = "SELECT expediente, pacientes_id 
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

//CONSULTAR PUESTO COLABORADORES
$consulta_puesto_colaboradores = "SELECT puesto_id, identidad 
    FROM colaboradores 
	WHERE colaborador_id = '$usuario'";
$result = $mysqli->query($consulta_puesto_colaboradores);
$consulta_puesto_colaboradores2 = $result->fetch_assoc();
$puesto_colaboradores = $consulta_puesto_colaboradores2['puesto_id'];
$identidad_colaboradores = $consulta_puesto_colaboradores2['identidad'];	

//TAB Transito
//RECIBIDA
$transito_servicio_recibida = $_POST['transito_servicio_recibida'];
$transito_unidad_recibida = $_POST['transito_unidad_recibida'];
$transito_motivo_recibida = mb_convert_case(trim($_POST['transito_motivo_recibida']), MB_CASE_TITLE, "UTF-8");
//ENVIADAS
$transito_servicio_enviada = $_POST['transito_servicio_enviada'];
$transito_unidad_enviada = $_POST['transito_unidad_enviada'];
$transito_motivo_enviada = mb_convert_case(trim($_POST['transito_motivo_enviada']), MB_CASE_TITLE, "UTF-8");
//TAB Referencias
//RECIBIDAS
$nivel = $_POST['nivel'];
$centro = $_POST['centro'];
$recibida = $_POST['centroi'];
$clinico1 = mb_convert_case(trim($_POST['clinico']), MB_CASE_TITLE, "UTF-8");
$motivo = mb_convert_case(trim($_POST['motivo']), MB_CASE_TITLE, "UTF-8");
//ENVIADAS
$nivel_e = $_POST['nivel_e'];
$centro_e = $_POST['centro_e'];
$enviada_e = $_POST['centroi_e'];

if(isset($_POST['motivo'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['motivo'] == ""){
	   $motivo = 0;
   }else{
	   $motivo = $_POST['motivo'];
   }
}else{
	$motivo = 0;
}

//CONSULTAR MOTIVO REFERENCIA RECIBIDA
if($motivo != 0){
    $consulta_motivo_ref_recibida = "SELECT nombre 
	    FROM motivo_traslado 
		WHERE motivo_traslado_id = '$motivo'";	
	$result = $mysqli->query($consulta_motivo_ref_recibida);
    $consulta_motivo_ref_recibida1 = $result->fetch_assoc();
    $motivo_referencia_recibida = $consulta_motivo_ref_recibida1['nombre'];	
}

if(isset($_POST['motivo_e'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['motivo_e'] == ""){
	   $motivo_ref_recibida = 0;
   }else{
	   $motivo_ref_recibida = $_POST['motivo_e'];
   }
}else{
	$motivo_ref_recibida = 0;
}

if($motivo_ref_recibida != 0){
    $consulta_motivo_ref_recibida_otros = "SELECT nombre 
	   FROM motivo_traslado WHERE motivo_traslado_id = '$motivo_ref_recibida'";
    $result = $mysqli->query($consulta_motivo_ref_recibida_otros);	
    $consulta_motivo_ref_recibida_otros1 = $result->fetch_assoc();
    $motivo_referencia_recibida_otro = $consulta_motivo_ref_recibida_otros1['nombre'];
	
	if($motivo_referencia_recibida != ""){
		$motivo_referencia_recibida .= ", ".$motivo_referencia_recibida_otro;
	}else{
		$motivo_referencia_recibida = $motivo_referencia_recibida_otro;
	}
}

$clinico = cleanStringStrtolower($_POST['diagnostico_clinico']);

if($nivel!="" || $nivel!=null){
	$porta_referencia = 1;
}else{
	$porta_referencia = "";
}
//OBTENER CENTRO
//RECIBIDA
$centroi = $_POST['centroi'];
//OBTENER NOMBRE
$consulta_respuesta_recibida = "SELECT centro_nombre 
    FROM centros_hospitalarios 
	WHERE centros_id = '$centroi'";
$result = $mysqli->query($consulta_respuesta_recibida);
$consulta_respuesta_recibida2 = $result->fetch_assoc();
$referencia_recibidade = $consulta_respuesta_recibida2['centro_nombre'];

//ENVIADAS
$centroi_e = $_POST['centroi_e'];
//OBTENER NOMBRE
$consulta_repuesta_enviada = "SELECT centro_nombre 
    FROM centros_hospitalarios 
	WHERE centros_id = '$enviada_e'";
$result = $mysqli->query($consulta_repuesta_enviada);
$consulta_repuesta_enviada2 = $result->fetch_assoc();
$referencia_enviadaa = $consulta_repuesta_enviada2['centro_nombre'];

if ($patologia_id1 == ""){
	$patologia_id1 = 0;
}

if ($patologia_id2 == ""){
	$patologia_id2 = 0;
}

if ($patologia_id3 == ""){
	$patologia_id3 = 0;
}

/*INTENTO SUICIDA*/
if(isset($_POST['suicida'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['suicida'] == ""){
		$suicida = 0;
	}else{
	    $suicida = $_POST['suicida'];		
	}
}else{
	$suicida = 0;
}
/**********************************************************************************/
  
/*********************************************************************************/
//CONSULTA AÑO, MES y DIA DEL PACIENTE
$nacimiento = "SELECT fecha_nacimiento AS fecha, localidad, departamento_id, municipio_id 
	FROM pacientes WHERE expediente = '$expediente'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $nacimiento2['fecha'];
$departamento_id = $nacimiento2['departamento_id'];
$municipio_id = $nacimiento2['municipio_id'];
$localidad = $nacimiento2['localidad'];

$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
/*********************************************************************************/

//SI EL SIGUIENTE DIA SUMA ES IGUAL A SABADO SE SUMAN DOS DIAS MAS A LA FECHA, DE LO CONTRARIO SOLO SE SUMA UN DIA
if(date("D", strtotime ( '+1 day' , strtotime ( $fecha ) )) == 'Sat' ){
	$nuevafecha =  date("Y-m-d", strtotime ( '+3 day' , strtotime ( $fecha )));
}else{
	$nuevafecha = date("Y-m-d", strtotime ( '+1 day' , strtotime ( $fecha )));
}

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

//CORRELATIVO HOSPITALIZACION
$correlativo_hospitalizacion = "SELECT MAX(hosp_id) AS max, COUNT(hosp_id) AS count 
   FROM hospitalizacion";
$result = $mysqli->query($correlativo_hospitalizacion);
$correlativo_hospitalizacion2 = $result->fetch_assoc();

$numero = $correlativo_hospitalizacion2['max'];
$cantidad = $correlativo_hospitalizacion2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;

if ($proceso = 'Registro'){
	//AGREGAR ATA
    //OBTENER CORRELATIVO
    $correlativo_ata= "SELECT MAX(ata_id) AS max, COUNT(ata_id) AS count 
	   FROM ata";
	$result = $mysqli->query($correlativo_ata);
    $correlativo_ata2 = $result->fetch_assoc();

    $numero_ata = $correlativo_ata2['max'];
    $cantidad_ata = $correlativo_ata2['count'];
 
    if ( $cantidad_ata == 0 )
	   $numero_ata = 1;
    else
       $numero_ata = $numero_ata + 1;	
   
    /*********************************************************************************/
    //VERIFICAMOS SI SE HA GUARDADO EL REGISTRO EN EL ATA
    $registro_guardado = "SELECT a.ata_id AS 'ata_id'
      FROM ata AS a
      INNER JOIN colaboradores AS c
      ON a.colaborador_id = c.colaborador_id
      WHERE a.expediente = '$expediente' AND a.servicio_id = '$servicio_id' AND a.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND c.puesto_id = '$puesto_colaboradores'";
	$result = $mysqli->query($registro_guardado);
    
	$registro_guardado2 = $result->num_rows;
	
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
	
    if($nivel==1){
	   $respuesta1 = $referencia_recibidade;
	   $respuesta2 = "";
	   $referencia_mayor = "";
    }else if($nivel==2){
	   $respuesta2 = $referencia_recibidade;
	   $respuesta1 = "";
	   $referencia_mayor = "";
     }else if($nivel==3){
	   $respuesta1 = "";
	   $respuesta2 = "";	
	   $referencia_mayor = $referencia_recibidade;
     }else{
	   $respuesta1 = "";
	   $respuesta2 = "";	
	   $referencia_mayor = "";
     }	
	
   if($expediente == 0 || $patologia_id1 == 0){
	  echo 4;//Indica que el expediente no puede quedar en cero, no se guardan los datos
   }else{
     if ($registro_guardado2==0){//GUARDA EL REGISTRO EN LA ENTIDAD ATA
	    $insert = "INSERT INTO ata 
		    VALUES('$numero_ata','$usuario','$expediente', '$anos', '$meses', '$dias', '$departamento_id', 
		    '$municipio_id', '$localidad', '$paciente', '$patologia_id1', '$patologiaid_tipo1', '$patologia_id2', '$patologiaid_tipo2', 
			'$patologia_id3', '$patologiaid_tipo3', '$servicio_id', '$referencia_enviadaa', '$referencia_recibidade', '$fecha', 
			'$referencia_mayor', '$respuesta1', '$respuesta2','1 Día','$porta_referencia','$observaciones_hospi','$enfermedad','0','0','0','0','$motivo_traslado','$fecha_registro')";
		$mysqli->query($insert);
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado_historial = "Agregar";
        $observacion_historial = "Se ha agregado un nuevo registro en el ATA para el servicio: $servicio_nombre";
        $modulo = "ATA";
        $insert = "INSERT INTO historial 
             VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_ata','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";		 
        $mysqli->query($insert);
	    /******************************************************/
        //AGREGAR DATOS DE ASEGURADO
        //OBTENER CORRELATIVO
        $correlativo_asegurado= "SELECT MAX(ata_id) AS max, COUNT(ata_id) AS count 
		   FROM ata";
		$result = $mysqli->query($correlativo_asegurado);
        $correlativo_asegurado2 = $result->fetch_assoc();
 
        $numero_asegurado = $correlativo_asegurado2['max'];
        $cantidad_asegurado = $correlativo_asegurado2['count'];

        if ( $cantidad_asegurado == 0 )
	      $numero_asegurado = 1;
        else
          $numero_asegurado = $numero_asegurado + 1;	
   
        if($asegurado!=""){
			$insert = "INSERT INTO asegurado 
			    VALUES('$numero_asegurado','$expediente','$fecha','$servicio_id','$usuario','$asegurado')";
            $mysqli->query($insert);	

            //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
            $historial_numero = historial();
            $estado_historial = "Agregar";
            $observacion_historial = "Se ha agregado un nuevo registro en los reporte de usuarios asegurados";
            $modulo = "Asegurado";
            $insert = "INSERT INTO historial 
                 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_asegurado','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
            $mysqli->query($insert);
	        /******************************************************/			
		}              
		/******************************************************/	
		
	   //TRANSITO
	   //TRANSITO RECIBIDAS
	   if($transito_servicio_recibida != "" && $transito_unidad_recibida != ""){
		   //CONSULTAR REGISTRO
           $consultar_registro = "SELECT transito_id 
		       FROM transito_recibida 
               WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio_id'";
           $result = $mysqli->query($consultar_registro);			   
			
		    if($result->num_rows==0){
               //OBTENER CORRELATIVO
               $correlativo_transito_recibida = "SELECT MAX(transito_id) AS max, COUNT(transito_id) AS count 
			      FROM transito_recibida";
			   $result = $mysqli->query($correlativo_transito_recibida);
               $correlativo_transito_recibida2 = $result->fetch_assoc();

               $numero_transito_recibida = $correlativo_transito_recibida2['max'];
               $cantidad_transito_recibida = $correlativo_transito_recibida2['count'];	
	   
               if ( $cantidad_transito_recibida == 0 )
	              $numero_transito_recibida = 1;
               else
                  $numero_transito_recibida = $numero_transito_recibida + 1;	   	      	     
	           
			   if($numero_ata != 0 && $servicio_id != 0 && $departamento_id != 0 && $municipio_id != 0 && $usuario != 0 && $expediente != 0){
                   $insert = "INSERT INTO transito_recibida 
				       VALUES('$numero_transito_recibida','$fecha','$numero_ata','$expediente', '$usuario','$anos','$paciente','$departamento_id','$municipio_id','$transito_servicio_recibida','$transito_unidad_recibida','$servicio_id','$transito_motivo_recibida','$fecha_registro')";	
                   $mysqli->query($insert);	

				   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                   $historial_numero = historial();
                   $estado_historial = "Agregar";
                   $observacion_historial = "Se ha agregado el transito para este usuario";
                   $modulo = "Transito Recibida";
                   $insert = "INSERT INTO historial 
                       VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_transito_recibida','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                   $mysqli->query($insert);
	               /******************************************************/	
			   }
			}	   
	   }
	
	   //TRANSITO ENVIADAS
	   if($transito_servicio_enviada != "" && $transito_unidad_enviada != ""){
		  //CONSULTAR REGISTRO
          $consultar_registro = "SELECT transito_id 
		     FROM transito_enviada 
             WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio_id'"; 
		  $result = $mysqli->query($consultar_registro);
	   
	      if($result->num_rows==0){
             //OBTENER CORRELATIVO
             $correlativo_transito_enviada = "SELECT MAX(transito_id) AS max, COUNT(transito_id) AS count 
			     FROM transito_enviada";
			 $result = $mysqli->query($correlativo_transito_enviada);
             $correlativo_transito_enviada2 = $result->fetch_assoc();

             $numero_transito_enviada = $correlativo_transito_enviada2['max'];
             $cantidad_transito_enviada = $correlativo_transito_enviada2['count'];	
	   
             if ( $cantidad_transito_enviada == 0 )
	           $numero_transito_enviada = 1;
             else
               $numero_transito_enviada = $numero_transito_enviada + 1;	   	      	     
	   
             if($numero_ata != 0 && $servicio_id != 0 && $departamento_id != 0 && $municipio_id != 0 && $usuario != 0 && $expediente != 0){
				 $insert = "INSERT INTO transito_enviada 
				     VALUES('$numero_transito_enviada','$fecha','$numero_ata','$expediente', '$usuario','$anos','$paciente','$departamento_id','$municipio_id','$transito_servicio_enviada','$transito_unidad_enviada','$servicio_id','$transito_motivo_enviada','$fecha_registro')";	
                 $mysqli->query($insert);

				 //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                 $historial_numero = historial();
                 $estado_historial = "Agregar";
                 $observacion_historial = "Se ha agregado el transito para este usuario";
                 $modulo = "Transito Enviada";
                 $insert = "INSERT INTO historial 
                      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_transito_enviada','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                 $mysqli->query($insert);
	             /******************************************************/
			 }
		  }	

		 if($transito_servicio_enviada == 8 && $profesional_transito_enviada != 0){
		    $fecha_registro = date("Y-m-d H:i:s");
		    $fecha_cita = date("Y-m-d H:i:s", strtotime($fecha));
	
	        //CONSULTA PACIENTE_ID
			$consultar_expediente= "SELECT pacientes_id 
			    FROM pacientes 
				WHERE expediente = '$expediente'";
			$result = $mysqli->query($consultar_expediente);
            $consultar_expediente1 = $result->fetch_assoc();
            $pacientes_id = $consultar_expediente1['pacientes_id'];
			   
		    //CONSULTAMOS SI EL USUARIO ES NUEVO EN EL SERVICIO
	        $consultar_expediente = "SELECT agenda_id 
			    FROM agenda 
				WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$usuario' AND servicio_id = '$servicio_id' AND status = 1";
			$result = $mysqli->query($consultar_expediente);

            $consultar_expediente1 = $result->fetch_assoc(); 
		  
		    if ($consultar_expediente1['agenda_id']== ""){
			    $paciente = 'N';
			    $color = '#008000'; //VERDE;
		    }else{ 
			    $paciente = 'S';
			    $color = '#0071c5'; //AZUL;
		    }			  
		      
			//CORRELATIVO AGENDA
	        $correlativo= "SELECT MAX(agenda_id) AS max, COUNT(agenda_id) AS count 
			   FROM agenda";
			$result = $mysqli->query($correlativo);
            $correlativo2 = $result->fetch_assoc();

			$numero_agenda = $correlativo2['max'];
            $cantidad_agenda = $correlativo2['count'];

            if ( $cantidad_agenda == 0 )
	           $numero_agenda = 1;
            else
               $numero_agenda = $numero_agenda + 1;
		
     		$hora = date("H:i", strtotime('00:00'));

			if($tipo_atencion_trabajosocial == "" && $transito_motivo_enviada != ""){
			  $observacion = "Usuario enviado a Trabajo social. ".$transito_motivo_enviada;  
			}
			  
			 if($tipo_atencion_trabajosocial != "" && $transito_motivo_enviada == ""){
			    //CONSULTAR TIPO DE ATENCION
			    $consulta_tipo_atencion = "SELECT nombre 
				    FROM tipos_atencion 
					WHERE tipos_atencion_id = '$tipo_atencion_trabajosocial'";
				$result = $mysqli->query($consulta_tipo_atencion);
                $consulta_tipo_atencion1 = $result->fetch_assoc();
                $consulta_tipo_atencion_nombre = $consulta_tipo_atencion1['nombre'];				  
				$observacion = "Usuario enviado a Trabajo social. Tipo de Atención: ".$consulta_tipo_atencion_nombre.".";  
			}
			  
			if($tipo_atencion_trabajosocial != "" && $transito_motivo_enviada != ""){
				//CONSULTAR TIPO DE ATENCION
				$consulta_tipo_atencion = "SELECT nombre 
				    FROM tipos_atencion 
					WHERE tipos_atencion_id = '$tipo_atencion_trabajosocial'";
				$result = $mysqli->query($consulta_tipo_atencion);
                $consulta_tipo_atencion1 = $result->fetch_assoc();
                $consulta_tipo_atencion_nombre = $consulta_tipo_atencion1['nombre'];				  
				$observacion = "Usuario enviado a Trabajo social. ".$transito_motivo_enviada.". Tipo de Atención: ".$consulta_tipo_atencion_nombre.".";  
			}				
			  		
            //CONSULTAR AGENDA SI HAY VALORES
            $consultar_agenda = "SELECT agenda_id FROM agenda 
			       WHERE expediente = '$expediente' AND cast(fecha_cita AS DATE) = '$fecha_cita' AND 
				   colaborador_id = '$profesional_transito_enviada' AND servicio_id = '$transito_servicio_enviada'";
			$result = $mysqli->query($consultar_agenda);
            $consultar_agenda1 = $result->fetch_assoc();
            $agenda_id = $consultar_agenda1['agenda_id'];
					
			//AGREGAMOS LOS DATOS EN LA AGENDA PARA TRABAJO SOCIAL*/
            if($agenda_id == ""){
				$insert = "INSERT INTO agenda VALUES('$numero_agenda', '$pacientes_id', '$expediente', '$profesional_transito_enviada', '$hora', 
			      '$fecha_cita', '$fecha_cita', '$fecha_registro', '0', '$color', '$observacion','$usuario','$transito_servicio_enviada',
			      '','0','0','2','$paciente','0')";	
                $mysqli->query($insert);

				//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado_historial = "Agregar";
                $observacion_historial = "Se ha agregado un nuevo registro en la agenda para Trabajo Social";
                $modulo = "Agenda";
                $insert = "INSERT INTO historial 
                      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_agenda','$profesional_transito_enviada','$transito_servicio_enviada','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
	            /******************************************************/				
			}
		  } 		  
	   }	
	    	
	   //REFERENCIAS
	   //REFERENCIAS RECIBIDAS
	   if($nivel != 0){
            //CONSULTAR REGISTRO
            $consultar_registro = "SELECT referenciar_id 
			    FROM referencia_recibida 
                WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio_id'"; 
			$result = $mysqli->query($consultar_registro);
	   
            if($result->num_rows==0){
              //OBTENER CORRELATIVO
              $correlativo_referencia_recibida = "SELECT MAX(referenciar_id) AS max, COUNT(referenciar_id) AS count 
			     FROM referencia_recibida";
			  $result = $mysqli->query($correlativo_referencia_recibida);
              $correlativo_referencia_recibida2 = $result->fetch_assoc();

              $numero_referencia_recibida = $correlativo_referencia_recibida2['max'];
              $cantidad_referencia_recibida = $correlativo_referencia_recibida2['count'];

              if ( $cantidad_referencia_recibida == 0 )
	            $numero_referencia_recibida = 1;
              else
                $numero_referencia_recibida = $numero_referencia_recibida + 1; 	   
     			   
               if($numero_ata != 0 && $patologia_id1 != 0 && $servicio_id != 0 && $centroi != 0 && $nivel != 0 && $centro != 0 && $expediente != 0 && $motivo != 0 && $motivo_ref_recibida != 0){
				   $insert = "INSERT INTO referencia_recibida 
				       VALUES('$numero_referencia_recibida','$numero_ata','$fecha','$expediente', '$anos', '$patologia_id1', '$clinico1', '$servicio_id','$usuario','$motivo_referencia_recibida','$centroi','Sí','$centroi','$nivel','$centro','$usuario','$fecha_registro', '$motivo', '$motivo_ref_recibida')";  
                   $mysqli->query($insert);	
				
				  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                  $historial_numero = historial();
                  $estado_historial = "Agregar";
                  $observacion_historial = "Se ha agregado una nueva referencia recibida";
                  $modulo = "Referencia Recibida";
                  $insert = "INSERT INTO historial 
                      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_referencia_recibida','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                  $mysqli->query($insert);
	              /******************************************************/					   
			   }
			}
	   }
	
	   //REFERENCIAS ENVIADAS
	   if($nivel_e != 0){	
           //CONSULTAR REGISTRO
           $consultar_registro = "SELECT referenciar_id 
		       FROM referencia_enviada 
               WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio_id' AND unidad_envia = '$centroi_e'";
		   $result = $mysqli->query($consultar_registro);

          if($result->num_rows==0){
             //OBTENER CORRELATIVO
             $correlativo_referencia_enviada = "SELECT MAX(referenciar_id) AS max, COUNT(referenciar_id) AS count 
			     FROM referencia_enviada";
			 $result = $mysqli->query($correlativo_referencia_enviada);
             $correlativo_referencia_enviada2 = $result->fetch_assoc();

             $numero_referencia_enviada = $correlativo_referencia_enviada2['max'];
             $cantidad_referencia_enviada = $correlativo_referencia_enviada2['count'];
			 
             if ( $cantidad_referencia_enviada == 0 )
	           $numero_referencia_enviada = 1;
             else
                $numero_referencia_enviada = $numero_referencia_enviada + 1; 	   
  		 
             if($numero_ata != 0 && $patologia_id1 != 0 && $servicio_id != 0 && $centroi_e != 0 && $nivel_e != 0 && $centro_e != 0 && $expediente != 0 && $motivo_traslado != 0 && $motivo_traslado_otro != 0){
				 $insert  = "INSERT INTO referencia_enviada 
				    VALUES('$numero_referencia_enviada','$numero_ata','$fecha','$expediente', '$anos', '$clinico','$patologia_id1','$patologia_id2','$patologia_id3','$servicio_id','$usuario','$motivo_referencia_enviada','$centroi_e','$nivel_e','$centro_e','No','$usuario','$fecha_registro', '$motivo_traslado', '$motivo_traslado_otro')";	
                 $mysqli->query($insert);	
				 
                  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                  $historial_numero = historial();
                  $estado_historial = "Agregar";
                  $observacion_historial = "Se ha agregado una nueva referencia enviada";
                  $modulo = "Referencia Enviada";
                  $insert = "INSERT INTO historial 
                      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_referencia_enviada','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                  $mysqli->query($insert);
	              /******************************************************/				 
			 }
		  }
	   }

      //ALMACENAR VALORES DE USUARIOS SUICIDAS
      if($suicida !=0 && $usuario != 0 && $servicio_id != 0 && $expediente != 0 && $pacientes_id != 0){
		  //OBTENER CORRELATIVO
          $correlativo_suicida = "SELECT MAX(suicida_id) AS max, COUNT(suicida_id) AS count 
		     FROM suicida";
		  $result = $mysqli->query($correlativo_suicida);
          $correlativo_suicida2 = $result->fetch_assoc();

          $numero_suicida = $correlativo_suicida2['max'];
          $cantidad_suicida = $correlativo_suicida2['count'];

          if ( $cantidad_suicida == 0 )
	         $numero_suicida = 1;
          else
             $numero_suicida = $numero_suicida + 1; 
		 
		 
		  $insert = "INSERT INTO suicida 
		      VALUES('$numero_suicida','$pacientes_id','$expediente','$usuario','$servicio_id','$suicida','$fecha','$fecha_registro','$paciente')";
          $mysqli->query($insert);

          //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
          $historial_numero = historial();
          $estado_historial = "Agregar";
          $observacion_historial = "Se ha agregado registro a los reportes de suicidios";
          $modulo = "Suicida";
          $insert = "INSERT INTO historial 
             VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_suicida','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
          $mysqli->query($insert);
	      /******************************************************/					  
	  }		   
	   
	   //INICIO RECETA MEDICA
	   if($receta_medica == 1){
		   if($expediente != 0 && $pacientes_id != 0 && $usuario != 0 && $servicio_id != 0){
		      //CONSULTAMOS SI EXISTE EL REGISTRO EN LA FECHA ACTUAL
		      $consulta_receta = "SELECT receta_id 
		         FROM receta
			     WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$usuario' AND servicio_id = '$servicio_id'";
			  $result = $mysqli->query($consulta_receta);
              $consulta_receta2 = $result->fetch_assoc();
              $receta_id = $consulta_receta2['receta_id'];	
			  
              if($receta_id == ""){//EVALUAMOS QUE EL REGISTRO NO EXISTA	
			      //AGREGARMOS EL ENCABEZADO DE LA RECETA
                  $receta_id_valor = correlativoReceta($mysqli);		  
				  $insert =  "INSERT INTO receta 
				        VALUES('$receta_id_valor','$pacientes_id','$expediente','$fecha','$usuario','$servicio_id','$usuario','$fecha_registro')";
				  $query = $mysqli->query($insert);
				  
                  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                  $historial_numero = historial();
                  $estado_historial = "Agregar";
                  $observacion_historial = "Se ha agregado valores a la receta para este registro";
                  $modulo = "Receta";
                  $insert = "INSERT INTO historial 
                      VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$receta_id_valor','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                  $mysqli->query($insert);
	              /******************************************************/					  
	
				  //GREGARMOS LOS VALORES EN ODOO
				  if($medicamento1 != "" && $via1 != "" && $frecuencia1 != "" && $cantidad1 != ""){
					  insertFacturacion($expediente, $servicio_nombre, $tipo_unidad, $identidad_colaboradores, $anos, $medicamento1, $cantidad1, $medicamento2, $cantidad2, $medicamento3, $cantidad3, $medicamento4, $cantidad4, $medicamento5, $cantidad5, $servicio_id, $usuario);	  
				  }
				  /****************************************************************************************************************/
				  
				  //REVISAMOS SI SE HA GUARDADO EN ENCABEZADO DE LA RECETA PARA PROCEDER A ALMACENAR SU DETALLE
				  if($query){
				    //AGREGAMOS EL DETALLE DE LA RECETA
					
					//1ERA FILA
				    if($medicamento1 !="" && $via1 != "" && $frecuencia1 != "" && $cantidad1 != ""){
					    $receta_id_detalle = correlativoRecetaDetalle($mysqli);
  
						$insert = "INSERT INTO receta_detalle 
						      VALUES('$receta_id_detalle','$receta_id_valor','$medicamento1','$via1','$frecuencia1','$cantidad1','$recomendaciones1')";
						$mysqli->query($insert);

                        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                        $historial_numero = historial();
                        $estado_historial = "Agregar";
                        $observacion_historial = "Se ha agregado detalles a los valores de receta para este registro";
                        $modulo = "Receta Detalle";
                        $insert = "INSERT INTO historial 
                               VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$receta_id_detalle','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                        $mysqli->query($insert);
	                    /******************************************************/						
				    }	

					//2DA FILA
				    if($medicamento2 !="" && $via2 != "" && $frecuencia2 != "" && $cantidad2 != ""){
					    $receta_id_detalle = correlativoRecetaDetalle($mysqli);
						
						$insert = "INSERT INTO receta_detalle 
						      VALUES('$receta_id_detalle','$receta_id_valor','$medicamento2','$via2','$frecuencia2','$cantidad2','$recomendaciones2')";
						$mysqli->query($insert);
				    }	

					//3ERA FILA
				    if($medicamento3 !="" && $via3 != "" && $frecuencia3 != "" && $cantidad3 != ""){
					    $receta_id_detalle = correlativoRecetaDetalle($mysqli);
						$insert = "INSERT INTO receta_detalle 
						      VALUES('$receta_id_detalle','$receta_id_valor','$medicamento3','$via3','$frecuencia3','$cantidad3','$recomendaciones3')";
					    $mysqli->query($insert);
				    }	

					//4TA FILA
				    if($medicamento4 !="" && $via4 != "" && $frecuencia4 != "" && $cantidad4 != ""){
					    $receta_id_detalle = correlativoRecetaDetalle($mysqli);
						
						$insert = "INSERT INTO receta_detalle 
						      VALUES('$receta_id_detalle','$receta_id_valor','$medicamento4','$via4','$frecuencia4','$cantidad4','$recomendaciones4')";
					    $mysqli->query($insert);
				    }	

					//5TA FILA
				    if($medicamento5 !="" && $via5 != "" && $frecuencia5 != "" && $cantidad5 != ""){
					    $receta_id_detalle = correlativoRecetaDetalle($mysqli);
 
						$insert = "INSERT INTO receta_detalle 
						      VALUES('$receta_id_detalle','$receta_id_valor','$medicamento5','$via5','$frecuencia5','$cantidad5','$recomendaciones5')";
						$mysqli->query($insert);
				    }						
				  }
			  }			  
		   }
	   }//FIN RECETA MEDICA
	   
	   //AGREGAMOS LOS DATOS DE LA ATENCION EN LA ENTIDAD HOSPITALIZACION
	   //CONSULTAR EXISTENCIA HOSPITALIZACION
	 $consultar_existencia_hospitalizacion = "SELECT hosp_id 
	     FROM hospitalizacion 
		 WHERE fecha = '$fecha' AND expediente = '$expediente' AND puesto_id = '$puesto_colaboradores' AND servicio_id = '$servicio_id'";
	 $result = $mysqli->query($consultar_existencia_hospitalizacion);
       $consultar_existencia_hospitalizacion2 = $result->fetch_assoc();
       $resp_existencia_hospitalizacion = $consultar_existencia_hospitalizacion2['hosp_id'];
			 
	   if($resp_existencia_hospitalizacion == ""){
           $insert = "INSERT INTO hospitalizacion 
		         VALUES ('$numero','0', '$numero_ata', '$fecha','$expediente','$servicio_id', '$usuario', '$puesto_colaboradores', '$paciente', '1',
				 '$observaciones_hospi','1','4', '$patologia_id1', '$patologiaid_tipo1', '$patologia_id2', '$patologiaid_tipo2', 
			     '$patologia_id3', '$patologiaid_tipo3','$enfermedad','$motivo_traslado','$fecha_registro')";	 
           $query = $mysqli->query($insert);
		   
           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Agregar";
           $observacion_historial = "Se ha agregado un nuevo registro en el area de Hospitalizacion para el servicio: $servicio_nombre";
           $modulo = "Hospitalizacion";
           $insert = "INSERT INTO historial 
              VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";		  
           $mysqli->query($insert);
	       /******************************************************/				   
				 
	       if($query){
		     echo 1;//El registro se ha almacenado correctamente	 
	       }else{
		      echo 2;//Error al guardar el registro
	       }		   
	   }else{
		   echo 3;
	   }		 	   
	   
	 }//FIN CONDICION GUARDAR EN ATA, REFERENCIAS Y TRANSITO 
	 else{
		 echo 3;
	 }
  }
}//FIN DEL PROCESO

function correlativoRecetaDetalle($mysqli){
    //OBTENER CORRELATIVO
    $correlativo= "SELECT MAX(id) AS max, COUNT(id) AS count 
	   FROM receta_detalle";
	$result = $mysqli->query($correlativo);
    $correlativo2 = $result->fetch_assoc();

    $numero_receta_detalle = $correlativo2['max'];
    $cantidad_receta_detalle = $correlativo2['count'];

    if ( $cantidad_receta_detalle == 0 )
	   $numero_receta_detalle = 1;
    else
       $numero_receta_detalle = $numero_receta_detalle + 1;

    return $numero_receta_detalle;   
 } 
 
 function correlativoReceta($mysqli){
    //OBTENER CORRELATIVO
    $correlativo= "SELECT MAX(receta_id) AS max, COUNT(receta_id) AS count 
	   FROM receta";
	$result = $mysqli->query($correlativo);
    $correlativo2 = $result->fetch_assoc();

    $numero_receta = $correlativo2['max'];
    $cantidad_receta = $correlativo2['count'];

    if ( $cantidad_receta == 0 )
	   $numero_receta = 1;
    else
       $numero_receta = $numero_receta + 1;

    return $numero_receta;   
 } 

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>