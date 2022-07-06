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
$expediente = $_POST['expediente1'];
$estado = 1;
$usuario = $_SESSION['colaborador_id'];
$paciente = $_POST['paciente'];
$profesional_transito_recibida = $_POST['transito_profesional_recibida'];
$profesional_transito_enviada = $_POST['transito_profesional_enviada'];
$tipo_atencion_trabajosocial = $_POST['tipo_atencion_enviadas'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTA PACIENTE_ID
$consultar_expediente= "SELECT pacientes_id, CONCAT(nombre, ' ', apellido) AS nombre
    FROM pacientes 
	WHERE expediente = '$expediente'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente1 = $result->fetch_assoc();
$pacientes_id = $consultar_expediente1['pacientes_id'];
$paciente_nombre = $consultar_expediente1['nombre'];

//CONSULTAR ATA_ID DE LA ENTIDAD HOSPITALIZACION
$consulta_ata_hospitalizacion = "SELECT ata_id, puesto_id, servicio_id, alta 
    FROM hospitalizacion 
	WHERE hosp_id = '$hosp_id'";
$result = $mysqli->query($consulta_ata_hospitalizacion);
$consulta_ata_hospitalizacion2 = $result->fetch_assoc();
$puesto_id = $consulta_ata_hospitalizacion2['puesto_id'];	
$servicio_id = $consulta_ata_hospitalizacion2['servicio_id'];
$alta = $consulta_ata_hospitalizacion2['alta'];
$ata_id_consulta = $consulta_ata_hospitalizacion2['ata_id'];

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

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
		$frecuencia1 = cleanStringStrtolower($_POST['frecuencia1']);
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
		$recomendaciones1 = cleanStringStrtolower($_POST['recomendaciones1']);
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
		$frecuencia2 = cleanStringStrtolower($_POST['frecuencia2']);
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
		$recomendaciones2 = cleanStringStrtolower($_POST['recomendaciones2']);
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
		$frecuencia3 = cleanStringStrtolower($_POST['frecuencia3']);
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
		$recomendaciones3 = cleanStringStrtolower($_POST['recomendaciones3']);
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
		$frecuencia4 = cleanStringStrtolower($_POST['frecuencia4']);
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
		$recomendaciones4 = cleanStringStrtolower($_POST['recomendaciones4']);
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
		$frecuencia5 = cleanStringStrtolower($_POST['frecuencia5']);
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
		$recomendaciones5 = cleanStringStrtolower($_POST['recomendaciones5']);
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
//REFERENCIAS ENVIADAS
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

//EVALUA LA SELECCION DE LA PREGUNTA USUARIO CRONICO, PARA SABER SI EL USUARIO ES O NO CRONICO
if(isset($_POST['cronico1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	$user_cronico = $_POST['cronico1'];
}else{
	$user_cronico = "";
}

if(isset($_POST['alta'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
    if($_POST['alta'] == ""){
		$alta_dada_medico = 0;
	}else{
		$alta_dada_medico = $_POST['alta'];
	}
	
}else{
	$alta_dada_medico = 0;
}

if(isset($_POST['diagnostico_ultimo'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	$diagnostico_ultimo = $_POST['diagnostico_ultimo'];
}else{
	$diagnostico_ultimo = 0;
}

$observaciones_hospi = cleanStringStrtolower($_POST['observaciones']);
$fecha_sistema = date("Y-m-d");
$tiempo = 1;
$alta_dada = 0;
			 
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
$transito_motivo_recibida = cleanStringStrtolower($_POST['transito_motivo_recibida']);
//ENVIADAS
$transito_servicio_enviada = $_POST['transito_servicio_enviada'];
$transito_unidad_enviada = $_POST['transito_unidad_enviada'];
$transito_motivo_enviada = cleanStringStrtolower($_POST['transito_motivo_enviada']);
//TAB Referencias
//RECIBIDAS
$nivel = $_POST['nivel'];
$centro = $_POST['centro'];
$recibida = $_POST['centroi'];
$clinico1 = cleanStringStrtolower($_POST['clinico']);

//REFERENCIA RECIBIDA
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
	   FROM motivo_traslado 
	   WHERE motivo_traslado_id = '$motivo_ref_recibida'";	
	$result = $mysqli->query($consulta_motivo_ref_recibida_otros);
    $consulta_motivo_ref_recibida_otros1 = $result->fetch_assoc();
    $motivo_referencia_recibida_otro = $consulta_motivo_ref_recibida_otros1['nombre'];
	
	if($motivo_referencia_recibida != ""){
		$motivo_referencia_recibida .= ", ".$motivo_referencia_recibida_otro;
	}else{
		$motivo_referencia_recibida = $motivo_referencia_recibida_otro;
	}
}

//ENVIADAS
$nivel_e = $_POST['nivel_e'];
$centro_e = $_POST['centro_e'];
$enviada_e = $_POST['centroi_e'];
$motivo_e = cleanStringStrtolower($_POST['motivo_e']);
$clinico = cleanStringStrtolower($_POST['diagnostico_clinico']);

if($nivel != "" || $nivel != null){
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
	WHERE centros_id = '$recibida'";
$result = $mysqli->query($consulta_respuesta_recibida);
$consulta_respuesta_recibida2 = $result->fetch_assoc();
$referencia_recibidade = $consulta_respuesta_recibida2['centro_nombre'];

//ENVIADAS
$centroi_e = $_POST['centroi_e'];
//OBTENER NOMBRE
$consulta_repuesta_enviada = "SELECT centro_nombre 
   FROM centros_hospitalarios 
   WHERE centros_id = '$centroi_e'";
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
	FROM pacientes 
	WHERE expediente = '$expediente'";
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
	$tiempo = 3;
}else{
	$nuevafecha = date("Y-m-d", strtotime ( '+1 day' , strtotime ( $fecha )));
	$tiempo = 1;
}

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));
$mes_anterior = date("m", strtotime ( '-1 month' , strtotime ( $fecha )));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

$fecha_mes_anterior = date("Y-m-d", strtotime($año."-".$mes_anterior."-".$dia1));

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

if ($proceso = 'Registro por usuario'){
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
	  echo 3;//Indica que el expediente no puede quedar en cero, no se guardan los datos
   }else{
     if ($registro_guardado2==0){//GUARDA EL REGISTRO EN LA ENTIDAD ATA			
	    $insert = "INSERT INTO ata VALUES('$numero_ata','$usuario','$expediente', '$anos', '$meses', '$dias', '$departamento_id', '$municipio_id', 
		    '$localidad', '$paciente', '$patologia_id1', '$patologiaid_tipo1', '$patologia_id2', '$patologiaid_tipo2', '$patologia_id3', 
			'$patologiaid_tipo3', '$servicio_id', '$referencia_enviadaa', '$referencia_recibidade', '$fecha', '$referencia_mayor', '$respuesta1', 
			'$respuesta2','','$porta_referencia','$observaciones_hospi','$enfermedad','0','0','0','0','$motivo_traslado','$fecha_registro')";
			
	    $mysqli->query($insert);	
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado_historial = "Agregar";
        $observacion_historial = "Se ha agregado un nuevo registro en el ATA para el servicio: $servicio_nombre.";
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
		
		//ACTUALIZAMOS EL ATA ID DE LA ENTIDAD HOSPITALIZACION
        $update = "UPDATE hospitalizacion 
		    SET ata_id = '$numero_ata', colaborador_id = '$usuario', estancia = '1', observacion = '$observaciones_hospi', patologia_id = '$patologia_id1', 
			patologiaid_tipo1 = '$patologiaid_tipo1', patologia_id1 = '$patologia_id2', patologiaid_tipo2 = '$patologiaid_tipo2', 
			patologia_id2 = '$patologia_id3', 	patologiaid_tipo3 = '$patologiaid_tipo3', enfermedad_id = '$enfermedad', motivo_traslado_id = $motivo_traslado
			WHERE hosp_id = '$hosp_id'";
	    $mysqli->query($update);
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado_historial = "Actualizar";
        $observacion_historial = "Se han actualizado los valores del ata_id entre otros en la entidad Hospitalizacion";
        $modulo = "Hospitalizacion";
        $insert = "INSERT INTO historial 
           VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
	    /******************************************************/			
			
	    //USUARIOS CRONICOS
	    if($user_cronico == 1 || $user_cronico == 2){
            //OBTENER CORRELATIVO
            $correlativo_cronico = "SELECT MAX(user_cronico_id) AS max, COUNT(user_cronico_id) AS count 
			   FROM user_cronico";
			$result = $mysqli->query($correlativo_cronico);
            $correlativo_cronico2 = $result->fetch_assoc();
  
            $numero_cronico = $correlativo_cronico2['max'];
            $cantidad_cronico = $correlativo_cronico2['count'];
  
            if ( $cantidad_cronico == 0 )
	            $numero_cronico = 1;
            else
                $numero_cronico = $numero_cronico + 1; 	
		 
		    if($pacientes_id != 0 && $expediente != 0 && $usuario != 0 && $servicio_id != 0){
                //EVALUAR EXISTENCIA USUARIO ATA
                $consulta = "SELECT user_cronico_id 
			        FROM user_cronico 
				    WHERE pacientes_id = '$pacientes_id' AND expediente = '$expediente' AND colaborador_id = '$usuario' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
                $result = $mysqli->query($consulta);					

                $consulta2 = $result->fetch_assoc();

                $user_cronico_id = $consulta2['user_cronico_id'];
			
		        $insert = "INSERT INTO user_cronico 
				    VALUES('$numero_cronico','$pacientes_id','$expediente','$usuario','$servicio_id','$paciente','$user_cronico','$fecha','$fecha_registro')";
				$mysqli->query($insert);
				
                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado_historial = "Agregar";
                $observacion_historial = "Se ha agregado registro a los reportes de usuarios cronicos";
                $modulo = "Cronico";
                $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_cronico','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
   	            /******************************************************/				
		    }
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
       /*************************************************************************************************************************************/	   
	   
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
			   
			   
               if($centroi != 0 && $nivel != 0 && $recibida != 0 && $centro !=0 && $numero_ata != 0 && $patologia_id1 != 0 && $servicio_id != 0 && $expediente != 0 && $usuario != 0 && $motivo != 0 && $motivo_ref_recibida != 0){
				   $insert = "INSERT INTO referencia_recibida VALUES('$numero_referencia_recibida','$numero_ata','$fecha','$expediente', '$anos', '$patologia_id1', '$clinico1', '$servicio_id','$usuario','$motivo_referencia_recibida','$recibida','Sí','$recibida','$nivel','$centro','$usuario','$fecha_registro', '$motivo', '$motivo_ref_recibida')";  
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
	   
               $consulta_transito = "SELECT transito_id 
			       FROM transito_recibida 
				   WHERE expediente = '$expediente' AND colaborador_id = '$usuario' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
         	   $result = $mysqli->query($consulta_transito);   
			   
              if($numero_ata != 0 && $servicio_id != 0 && $expediente != 0 && $usuario != 0 && $departamento_id != 0 && $municipio_id != 0){
				  if($result->num_rows == 0){
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
	  }	  
    }//FIN CONDICION GUARDAR EN ATA, REFERENCIAS Y TRANSITO
	
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
					  insertFacturacion($expediente, $servicio_nombre, $tipo_unidad, $identidad_colaboradores, $anos, $medicamento1, $cantidad1, $medicamento2, $cantidad2, $medicamento3, $cantidad3, $medicamento4, $cantidad4, $medicamento5, $cantidad5, $servicio_id);	  
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
       /*************************************************************************************************************************************/	
	
    //TRANSITO Y REFERENCIA DE USUARIOS
	//TRANSITO	
	//ENVIADAS
	if($transito_servicio_enviada != "" && $transito_unidad_enviada != ""){
           //CONSULTAR ATA_ID DE LA ENTIDAD HOSPITALIZACION
           $consulta_ata_hospitalizacion = "SELECT ata_id, puesto_id, servicio_id, alta 
		      FROM hospitalizacion WHERE hosp_id = '$hosp_id'";
		   $result = $mysqli->query($consulta_ata_hospitalizacion);
           $consulta_ata_hospitalizacion2 = $result->fetch_assoc();
           $puesto_id = $consulta_ata_hospitalizacion2['puesto_id'];	
           $servicio_id = $consulta_ata_hospitalizacion2['servicio_id'];
           $alta = $consulta_ata_hospitalizacion2['alta'];
           $ata_id_consulta = $consulta_ata_hospitalizacion2['ata_id'];
		 
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

			 if ($ata_id_consulta == ""){
				 $ata_id_consulta = $numero_ata;
			 }		   
	   
             if($ata_id_consulta != 0 && $servicio_id != 0 && $expediente != 0 && $usuario != 0 && $departamento_id != 0 && $municipio_id != 0){
				 $insert = "INSERT INTO transito_enviada 
				      VALUES('$numero_transito_enviada','$fecha','$ata_id_consulta','$expediente', '$usuario','$anos','$paciente','$departamento_id','$municipio_id','$transito_servicio_enviada','$transito_unidad_enviada','$servicio_id','$transito_motivo_enviada','$fecha_registro')";	   			   
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
				   
		    //CONSULTAMOS SI EL USUARIO ES NUEVO EN EL SERVICIO
	        $consultar_expediente = "SELECT agenda_id FROM agenda WHERE pacientes_id = '$pacientes_id' AND colaborador_id = '$usuario' AND servicio_id = '$servicio_id' AND status = 1";
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
	    	   	
	//REFERENCIAS ENVIADAS
	if($nivel_e != 0){	
           //CONSULTAR ATA_ID DE LA ENTIDAD HOSPITALIZACION
           $consulta_ata_hospitalizacion = "SELECT ata_id, puesto_id, servicio_id, alta 
		       FROM hospitalizacion 
			   WHERE hosp_id = '$hosp_id'";
		   $result = $mysqli->query($consulta_ata_hospitalizacion);
           $consulta_ata_hospitalizacion2 = $result->fetch_assoc();
           $puesto_id = $consulta_ata_hospitalizacion2['puesto_id'];	
           $servicio_id = $consulta_ata_hospitalizacion2['servicio_id'];
           $alta = $consulta_ata_hospitalizacion2['alta'];
           $ata_id_consulta = $consulta_ata_hospitalizacion2['ata_id'];
		   
           //CONSULTAR REGISTRO
           $consultar_registro = "SELECT referenciar_id FROM referencia_enviada 
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
              
			 if ($ata_id_consulta == ""){
				 $ata_id_consulta = $numero_ata;
			 }
			 		 
			 if($centroi_e != 0 && $nivel_e != 0 && $enviada_e != 0 && $centro_e != 0 && $ata_id_consulta != 0 && $patologia_id1 != 0 && $servicio_id != 0 && $expediente != 0 && $usuario != 0 && $motivo_traslado != 0 && $motivo_traslado_otro != 0){
				 //ACTUALIZAMOS EN EL ATA EL MOTIVO DEL ENVIO DE LA REFERENCIA
			     if($motivo_traslado != 0){
				    $update = "UPDATE ata SET motivo_traslado_id = '$motivo_traslado' 
					    WHERE ata_id = '$ata_id_consulta'"; 
					$mysqli->query($update);
			     }
				 
				 $insert = "INSERT INTO referencia_enviada VALUES('$numero_referencia_enviada','$ata_id_consulta','$fecha','$expediente', '$anos', '$clinico','$patologia_id1','$patologia_id2','$patologia_id3','$servicio_id','$usuario','$motivo_referencia_enviada','$enviada_e','$nivel_e','$centro_e','No','$usuario','$fecha_registro', '$motivo_traslado', '$motivo_traslado_otro')";
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
			
		     //MODIFICAMOS LOS VALORES EN LA REFERENCIA ENVIADA
		     $update = "UPDATE ata SET enviadaa = '$referencia_enviadaa' 
		         WHERE ata_id = '$ata_id_consulta'";
             $mysqli->query($update);

             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado_historial = "Agregar";
             $observacion_historial = "Se ha actualizado la referencia enviada en el ATA del usuario";
             $modulo = "ATA";
             $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id_consulta','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
	         /******************************************************/				 
		  }		  
    }		
	
	 //OBTENER CORRELATIVO
     $correlativo= "SELECT MAX(historial_id) AS max, COUNT(historial_id) AS count 
	    FROM historial_camas";
	 $result = $mysqli->query($correlativo);
     $correlativo2 = $result->fetch_assoc();
 
     $numero_historial = $correlativo2['max'];
     $cantidad_historial = $correlativo2['count'];
 
     if ( $cantidad_historial == 0 )
	   $numero_historial = 1;
     else
       $numero_historial = $numero_historial + 1;

    //CONSULTAR ATA_ID DE LA ENTIDAD HOSPITALIZACION
    $consulta_ata_hospitalizacion = "SELECT ata_id 
	   FROM hospitalizacion 
	   WHERE hosp_id = '$hosp_id'";
	$result = $mysqli->query($consulta_ata_hospitalizacion);
    $consulta_ata_hospitalizacion2 = $result->fetch_assoc();
    $ata_id = $consulta_ata_hospitalizacion2['ata_id']; 
	 
	//*******************************************Revisar esta logica ***************************************
	//$alta_medica = 1***alta_exigida=2***no_alta_medica = 0
	if($alta_dada_medico == 1){
		$alta_dada = 1;
	}else if($alta_dada_medico == 2){
		$alta_dada = 2;
	}else if($alta_dada_medico == 0){
		$alta_dada = 0;
	}
	
	//CALCULA LOS DIAS QUE LLEVA HOSPITALIZADO EL USUARIO Y SI LLEGA A 15 LE DA ALTA AUTOMATICAMENTE
    $consulta_cantidad_dias = "SELECT SUM(estancia) AS 'estancia' 
	   FROM hospitalizacion 
	   WHERE fecha BETWEEN '$fecha_mes_anterior' AND '$fecha_final' AND expediente = '$expediente' AND servicio_id = '$servicio_id' AND puesto_id = '$puesto_id'";
	$result = $mysqli->query($consulta_cantidad_dias);
	$consulta_cantidad_dias2 = $result->fetch_assoc();
    $total_estancia = $consulta_cantidad_dias2['estancia']; 
	
	
    //ALTA DE PSICOLOGIA
    $consulta_alta_psicologia = "SELECT alta 
	    FROM hospitalizacion 
		WHERE fecha = '$fecha' AND servicio_id = '$servicio_id' AND puesto_id = 1 AND expediente = '$expediente'";	
	$result = $mysqli->query($consulta_alta_psicologia);
	$consulta_alta_psicologia2 = $result->fetch_assoc();
    $alta_psicologia_dada = $consulta_alta_psicologia2['alta']; 
	
	if($alta_psicologia_dada != 0){
	    $alta_dada = 1;
		$alta_dada_medico = 1;		
	}
	
	if($total_estancia == 14 && $servicio_id == 4){//SI EL USUARIO LLEVA 15 DÍAS HOSPITALIZADO SE DA DE ALTA AUTOMATICAMENTE SALÓN DEL HUÉSPED
	    $alta_dada = 1;
		$alta_dada_medico = 1;
	}	
	
    if($total_estancia == 15 && $servicio_id == 3){//SI EL USUARIO LLEVA 16 DÍAS HOSPITALIZADO SE DA DE ALTA AUTOMATICAMENTE MAIDA
	    $alta_dada = 1;
		$alta_dada_medico = 1;
	}	
	//FIN DEL CALCULO DE DIAS
	//*******************************************************************************************************
	
	//****************************************************************************************************
	//LLENA LOS REGISTROS DE HOSPITALIZACION PARA EL SIGUIENTE DIA HABIL
        if($alta_dada_medico == 0){//SI NO SE SELECCIONO NINGÚN TIPO DE ALTA, SE PROCEDE A GUARDAR LOS DATOS EN EL HISTORIAL DE CAMAS Y EN LA HOSPITALIZACION DEL SIGUIENTE DIA Y ACTUALIZAR LOS DEL DIA ACTUAL.		   
		   //REVISAR EXISTENCIA EN HOSPITALIZACIÓN
		   $consultar_existencia_hospitalizacion = "SELECT hosp_id 
		      FROM hospitalizacion 
			  WHERE fecha = '$nuevafecha' AND expediente = '$expediente' AND puesto_id = '$puesto_id' AND servicio_id = '$servicio_id'";
		   $result = $mysqli->query($consultar_existencia_hospitalizacion);
     	   $consultar_existencia_hospitalizacion2 = $result->fetch_assoc();
           $resp_consulta_hospitalizacion = $consultar_existencia_hospitalizacion2['hosp_id']; 
	       
		   //CONSULTAR ESTADO DE LA CAMA PARA EL SIGUIENTE DIA HABIL EN PSIQUIATRIA PARA PSICOLOGIA
		   $consultar_datos = "SELECT estado 
		       FROM  hospitalizacion 
			   WHERE fecha = '$nuevafecha' AND puesto_id = 2 AND servicio_id = '$servicio_id' AND expediente = '$expediente'";
		   $result = $mysqli->query($consultar_datos);
     	   $consultar_datos2 = $result->fetch_assoc();
           $consultar_datos_estado = $consultar_datos2['estado']; 
		   
		   if ($consultar_datos_estado != ""){
			   if($consultar_datos_estado == 1 || $consultar_datos_estado == 2 || $consultar_datos_estado == 0 || $consultar_datos_estado == 5 || $consultar_datos_estado == 4){
				   $estado_nuevo = 0;
			   }else{
				   $estado_nuevo = 3;
			   }
			   
		   }else{
			   $estado_nuevo = 3;
		   }
		   		   
	       if($resp_consulta_hospitalizacion == ""){	
		   //CONSULTAR EXISTENCIA PATOLOGIA
           /*1ER PATOLOGIA*/
           $consultar_patologia1 = "SELECT expediente 
		      FROM ata 
			  WHERE patologia_id = '$patologia_id1' AND expediente = '$expediente'";
		   $result = $mysqli->query($consultar_patologia1);
           $consultar_patologia1_1 = $result->num_rows;
   
           if ($consultar_patologia1_1==0){
               $patologiaid_tipo1_1 = 'N';
           }else{
               $patologiaid_tipo1_1 = 'S';
           }

           /*2DA PATOLOGIA*/
           if($patologia_id2 != 0){
               $consultar_patologia2 = "SELECT expediente 
			       FROM ata 
				   WHERE patologia_id1 = '$patologia_id2' AND expediente = '$expediente'";
			   $result = $mysqli->query($consultar_patologia2);
               $consultar_patologia2_1 = $result->num_rows;

               if ($consultar_patologia2_1==0){
                    $patologiaid_tipo2_1 = 'N';
               }else{
                    $patologiaid_tipo2_1 = 'S';
               }
           }else{
               $patologiaid_tipo2_1 = '';
           }

           /*3ER PATOLOGIA*/
           if($patologia_id3 != 0){
               $consultar_patologia3 = "SELECT expediente 
			       FROM ata 
				   WHERE patologia_id2 = '$patologia_id3' AND expediente = '$expediente'";
			   $result = $mysqli->query($consultar_patologia3);
               $consultar_patologia3_1 = $result->num_rows;

               if ($consultar_patologia3_1==0){
                  $patologiaid_tipo3_1 = 'N';
               }else{
	              $patologiaid_tipo3_1 = 'S';
               }
            }else{
                 $patologiaid_tipo3_1 = '';
            }
			
			$insert = "INSERT INTO hospitalizacion 
			      VALUES ('$numero','$numero_historial', '$ata_id', '$nuevafecha','$expediente','$servicio_id', '$usuario', '$puesto_id', 
				  '$paciente', '$estado_nuevo','','0','$alta_dada', '$patologia_id1', '$patologiaid_tipo1_1', '$patologia_id2', '$patologiaid_tipo2_1', 
				  '$patologia_id3', '$patologiaid_tipo3_1','$enfermedad','$motivo_traslado','$fecha_registro')";
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
		  }else{
			   echo 2; //ERROR AL GUARDAR EL REGISTRO YA EXISTE
		   }		   
			
            $update = "UPDATE hospitalizacion 
			    SET estado = '$estado', estancia = '$tiempo', colaborador_id = '$usuario', observacion = '$observaciones_hospi', 
				patologia_id = '$patologia_id1', patologiaid_tipo1 = '$patologiaid_tipo1', patologia_id1 = '$patologia_id2', 
				patologiaid_tipo2 = '$patologiaid_tipo2', patologia_id2 = '$patologia_id3', patologiaid_tipo3 = '$patologiaid_tipo3', 
				enfermedad_id = '$enfermedad', motivo_traslado_id = $motivo_traslado
				WHERE hosp_id = '$hosp_id'";		    
		    $query = $mysqli->query($update);

           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado_historial = "Actualizar";
           $observacion_historial = "Se han actualizado los valores del ata_id entre otros en la entidad Hospitalizacion";
           $modulo = "Hospitalizacion";
           $insert = "INSERT INTO historial 
              VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";		  
           $mysqli->query($insert);
	       /******************************************************/
		
            //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
            $historial_numero = historial();
            $estado_historial = "Actualizar";
            $observacion_historial = "Se han actualizado los datos de este registro en el area de Hospitalización para el servicio: $servicio_nombre";
            $modulo = "Hospitalizacion";
            $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
	         /******************************************************/			
		 
	        if($fecha_sistema == $fecha_final){
	           //CONSULTO CANTIDAD DE REGISTROS EN LA ENTIDAD HOSPITALIZACION
	           $consulta_total_hospi = "SELECT sum(estancia) AS 'total'
                  FROM hospitalizacion
                  WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND estado = 1 AND servicio_id = '$servicio_id' AND puesto_id = '$puesto_id' AND expediente = '$expediente'
                  ORDER BY hosp_id";
			   $result = $mysqli->query($consulta_total_hospi);
					
		       $consulta_total_hospi2 = $result->fetch_assoc();
               $total_hospitalizacion = $consulta_total_hospi2['total'];
			 
		       if ($total_hospitalizacion == 1){
		          $total_hospitalizacion1 = $total_hospitalizacion.' Día'; 
		       }else{
		          $total_hospitalizacion1 = $total_hospitalizacion.' Días';
		       }
			 
               if($total_hospitalizacion>0){
		          //ACTUALIZAMOS VALORES EN EL ATA
		          $update = "UPDATE ata SET tiempo_estancia = '$total_hospitalizacion1' 
   			         WHERE expediente = '$expediente' AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND servicio_id = '$servicio_id' AND colaborador_id = '$usuario'";
			      $mysqli->query($update);
				  
                  //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                  $historial_numero = historial();
                  $estado_historial = "Actualizar";
                  $observacion_historial = "Se han actualizado el tiempo de estancia para este registro en el ATA de Hospitalizacion para el servicio: $servicio_nombre";
                  $modulo = "ATA";
                  $insert = "INSERT INTO historial 
                       VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                  $mysqli->query($insert);
	              /******************************************************/					  
		       }		 
	        }	 
	 		
	        //HISTORIAL DE CAMAS
	        //CONSULTAR HISTORIAL DE CAMAS
	        $consultar_historial_camas = "SELECT cama_id, usuario, color, paciente, observaciones, porcentaje 
 	           FROM historial_camas 
	           WHERE historial_id = '$historial'";	  
            $result = $mysqli->query($consultar_historial_camas);			   
		   
	        $consultar_historial_camas2 = $result->fetch_assoc();
	        $cama_id = $consultar_historial_camas2['cama_id'];
	        $usuario = $consultar_historial_camas2['usuario'];
	        $color = "#FAF03C"; //Color AMARILLO
	        $paciente = $consultar_historial_camas2['paciente'];
	        $observaciones = $consultar_historial_camas2['observaciones'];
	        $porcentaje = $consultar_historial_camas2['porcentaje'];
	        $estado1 = 2;		  
	 
	        //CONSULTAR COLOR DE LA CAMA PARA EL SIGUIENTE DIA HABIL EN PSIQUIATRIA PARA PSICOLOGIA
			$consultar_dato_historial = "SELECT color 
			     FROM historial_camas 
				 WHERE fecha = '$nuevafecha' AND servicio_id = '$servicio_id' AND puesto_id = '2' AND expediente = '$expediente'";
			$result = $mysqli->query($consultar_dato_historial);
	        $consultar_dato_historial2 = $result->fetch_assoc();
	        $consultar_dato_historial_color = $consultar_dato_historial2['color'];
			
			if($consultar_dato_historial_color != ""){
				$nuevo_color = $consultar_dato_historial_color;
			}else{
				$nuevo_color = $color;
			}
			
	        //AGREGAR HISTORIAL DE CAMAS
			//CONSULTAR EXISTENCIA HISTORIAL DE CAMAS
			$consultar_existencia_historial_camas = "SELECT historial_id 
			    FROM historial_camas historial_id 
				WHERE fecha = '$nuevafecha' AND expediente = '$expediente' AND puesto_id = '$puesto_id' AND servicio_id = '$servicio_id'";
		    
			$result_existencia = $mysqli->query($consultar_existencia_historial_camas);
            $consultar_existencia_historial_camas2 = $result_existencia->fetch_assoc();
	        $resp_existencia_historial_camas = $consultar_existencia_historial_camas2['historial_id'];			
			
			if ($resp_existencia_historial_camas == ""){	   			   
			   $insert = "INSERT INTO historial_camas 
			       values('$numero_historial','$nuevafecha','$expediente','$cama_id','$servicio_id','$puesto_id','$usuario','$nuevo_color','$paciente','','$estado1','$porcentaje','$fecha_registro')";	
               $mysqli->query($insert);	
			   
               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado_historial = "Agregar";
               $observacion_historial = "Se han agregado el registro en el Historial de Camas en Hospitalziacion para el servicio: $servicio_nombre";
               $modulo = "Historial de Camas";
               $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_historial','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";			   
               $mysqli->query($insert);			 
	           /******************************************************/				   
			}			
			
	        //ACTUALIZAMOS EL ESTADO DE LAS CAMAS
	        $update = "UPDATE camas SET estado = '$estado1' 
			    WHERE cama_id = '$cama_id'";
			$mysqli->query($update);
			
            //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
            $historial_numero = historial();
            $estado_historial = "Actualizar";
            $observacion_historial = "Se han actualizado el estado de la cama en Hospitalziacion para el servicio: $servicio_nombre";
            $modulo = "Cama";
            $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_historial','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
            $mysqli->query($insert);
	        /******************************************************/				
	
	        if($query){
		      echo 1;//EL RESGISTRO SE HA ALMACENADO CORRECTAMENTE	 
	        }else{
		      echo 2;//ERROR AL GUARDAR EL REGISTRO
	        }			
		}else{//SI SE LE DA ALTA AL USUARIO, SE PROCEDE A GUARDAR EL ALTA, Y EL REGISTRO YA NO SE GUARDA PARA EL SIGUIENTE DÍA (HISTORIAL DE CAMAS Y HOSPITALIZACION).
			//SE ACTUALIZA EL ESTADO DE LA ALTA		
			$estancia = 1;
			$estado = 1;
			
			if($total_estancia == 14 && $servicio_id == 4 ){//sI EL TOTAL DE ESTANCIA ES IGUAL A 15 SE DA DE ALTA AUTOMATICAMENTE SALÓN DEL HUÉSPED
				$estancia = 1;
				$estado = 5; //ESTADO DEL ALTA AUTOMATICAMENTE
				$observaciones_hospi = "El sistema dió el alta medica";
			}
			
			if($total_estancia == 15 && $servicio_id == 3 ){//sI EL TOTAL DE ESTANCIA ES IGUAL A 15 SE DA DE ALTA AUTOMATICAMENTE MAIDA
				$estancia = 1;
				$estado = 5; //ESTADO DEL ALTA AUTOMATICAMENTE
				$observaciones_hospi = "El sistema dió el alta medica";
			}			
			
            $update = "UPDATE hospitalizacion 
			    SET alta = '$alta_dada', estado = '$estado', observacion = '$observaciones_hospi', estancia = '$estancia', 
                patologia_id = '$patologia_id1', patologiaid_tipo1 = '$patologiaid_tipo1', patologia_id1 = '$patologia_id2', 
				patologiaid_tipo2 = '$patologiaid_tipo2', patologia_id2 = '$patologia_id3', patologiaid_tipo3 = '$patologiaid_tipo3', 
				enfermedad_id = '$enfermedad', motivo_traslado_id = $motivo_traslado		
				WHERE hosp_id = '$hosp_id'"; 
			$query = $mysqli->query($update);
			
            //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
            $historial_numero = historial();
            $estado_historial = "Actualizar";
            $observacion_historial = "Se han actualizado los valores del ata_id entre otros en la entidad Hospitalizacion";
            $modulo = "Hospitalizacion";
            $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
            $mysqli->query($insert);
	        /******************************************************/			
			
	        //CONSULTO CANTIDAD DE REGISTROS EN LA ENTIDAD HOSPITALIZACION
	        $consulta_total_hospi = "SELECT sum(estancia) AS 'total'
                  FROM hospitalizacion
                  WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND estado IN(1,5) AND servicio_id = '$servicio_id' AND puesto_id = '$puesto_id' AND expediente = '$expediente'
                  ORDER BY hosp_id";
            $result = $mysqli->query($consulta_total_hospi);								
		    $consulta_total_hospi2 = $result->fetch_assoc();
            $total_hospitalizacion = $consulta_total_hospi2['total'];
			 
		    if ($total_hospitalizacion == 1){
		        $total_hospitalizacion1 = $total_hospitalizacion.' Día'; 
		    }else{
		       $total_hospitalizacion1 = $total_hospitalizacion.' Días';
		    }
			 			
            if($total_hospitalizacion>0){
		        //ACTUALIZAMOS VALORES EN EL ATA
		        $update = "UPDATE ata SET tiempo_estancia = '$total_hospitalizacion1' WHERE ata_id = '$ata_id'";
				$mysqli->query($update);
				
                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado_historial = "Actualizar";
                $observacion_historial = "Se han actualizado el timpo de estancia en el ATA de Hospitalizacion para el servicio: $servicio_nombre";
                $modulo = "ATA";
                $insert = "INSERT INTO historial 
                     VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
	            /******************************************************/						
		    }
			   				 
            //CONSULTAMOS SI EXISTE EL REGISTRO EN EL AREA DE PSICOLOGIA
            $consulta_registro_psico = "SELECT hosp_id, estado, ata_id
                 FROM hospitalizacion
                 WHERE expediente = '$expediente' AND puesto_id = 1 AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
			$result = $mysqli->query($consulta_registro_psico);
				 
			$consulta_registro_psico2 = $result->fetch_assoc();
            $hosp_id_psico = $consulta_registro_psico2['hosp_id'];
            $estado = $consulta_registro_psico2['estado'];	
            $ata_id_datos = $consulta_registro_psico2['ata_id'];	

            if($hosp_id_psico > 0 ){
	           //CONSULTAMOS EL TIEMPO DE ESTANCIA DEL USUARIO
	           $consulta_estancia_usuario_psicologia = "SELECT sum(estancia) AS 'total'
                   FROM hospitalizacion
                   WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND estado = 1 AND servicio_id = '$servicio_id' AND puesto_id = 1 AND expediente = '$expediente'
                   ORDER BY hosp_id";
				$result = $mysqli->query($consulta_estancia_usuario_psicologia);
		
                //ACUTALIZAMOS EL ESETADO DE LA ALTA			
	            $update = "UPDATE hospitalizacion 
				    SET alta = '$alta_dada', observacion = '$observaciones_hospi', 
                    patologia_id = '$patologia_id1', patologiaid_tipo1 = '$patologiaid_tipo1', patologia_id1 = '$patologia_id2', 
				    patologiaid_tipo2 = '$patologiaid_tipo2', patologia_id2 = '$patologia_id3', patologiaid_tipo3 = '$patologiaid_tipo3', 
				    enfermedad_id = '$enfermedad', motivo_traslado_id = $motivo_traslado					
					WHERE hosp_id = '$hosp_id_psico'";
			    $query = $mysqli->query($update);
				
                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado_historial = "Actualizar";
                $observacion_historial = "Se han actualizado los valores del ata_id entre otros en la entidad Hospitalizacion";
                $modulo = "Hospitalizacion";
                $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
	            /******************************************************/				
				
 	            $consulta_estancia_usuario_psicologia2 = $result->fetch_assoc();
                $total_usuario_psicologia = $consulta_estancia_usuario_psicologia2['total'];
    
	            if($total_usuario_psicologia != null || $total_usuario_psicologia != ""){
		            if ($total_usuario_psicologia == 1){
                    $total_usuario_psicologia = $total_usuario_psicologia.' Día'; 
                }else{
                    $total_usuario_psicologia = $total_usuario_psicologia.' Días';
                }			
                    //ACTUALIZAMOS EL TIEMPO DE ESTANCIA DEL USUARIO EN EL AREA DE PSICOLOGIA			
		            $update = "UPDATE ata SET tiempo_estancia = '$total_usuario_psicologia' 
					    WHERE ata_id = '$ata_id_datos'";
					$mysqli->query($update);
	            }
		
	            if($estado == 1){//SI EL USUARIO FUE ATENDIDO SE PROCEDE A ELIMINAR EL REGISTRO DEL SIGUIENTE DIA
                    $consulta_registro_psico_1 = "SELECT hosp_id, estado, historial_id
                       FROM hospitalizacion
                       WHERE expediente = '$expediente' AND puesto_id = 1 AND servicio_id = '$servicio_id' AND fecha = '$nuevafecha'";
					$result = $mysqli->query($consulta_registro_psico_1);
        
		            $consulta_registro_psico_12 = $result->fetch_assoc();
                    $hosp_id_psico1 = $consulta_registro_psico_12['hosp_id'];
                    $historial_id = $consulta_registro_psico_12['historial_id'];		

                    if($hosp_id_psico1 > 0){
		               //ELMINAMOS EL REGISTRO DEL AREA DE HOSPITALIZACION
		               $delete = "DELETE FROM hospitalizacion 
					       WHERE hosp_id = '$hosp_id_psico1'";
					   $mysqli->query($delete);
					   
                       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                       $historial_numero = historial();
                       $estado_historial = "Eliminar";
                       $observacion_historial = "Se han eliminado el registro $paciente_nombre con expediente: $expediente, de psicología en Hospitalizacion para el servicio: $servicio_nombre";
                       $modulo = "Hospitalizacion";
                       $insert = "INSERT INTO historial 
                            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id_psico1','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                       $mysqli->query($insert);
	                   /******************************************************/						   
		   
		               //ELMINAMOS EL REGISTRO DEL AREA HISTORIAL DE CAMAS
		               $delete = "DELETE FROM historial_camas 
					      WHERE historial_id = '$historial_id'";						  						  
					   $mysqli->query($delete);
					   
                       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                       $historial_numero = historial();
                       $estado_historial = "Eliminar";
                       $observacion_historial = "Se han eliminado el registro $paciente_nombre con expediente: $expediente, de psicología en Hospitalizacion para el Historial de Camas en el servicio de: $servicio_nombre ";
                       $modulo = "Historial de Camas";
                       $insert = "INSERT INTO historial 
                            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id_psico1','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                       $mysqli->query($insert);
	                   /******************************************************/					   
	            }		
	        }
         }

         if($query){
			 echo 1;//EL REGISTRO SE ALMACENO CORRECTAMENTE
			 
			//MODIFICAMOS LOS VALORES PARA EL ULTIMO DIAGNOSTICO
	        if( $diagnostico_ultimo == 1 && $patologia_id1 != 0){
		        //CONSULTAR EXISTENCIA PATOLOGIA
                /*1ER PATOLOGIA*/
                $consultar_patologia1 = "SELECT expediente 
				    FROM ata 
					WHERE patologia_id = '$patologia_id1' AND expediente = '$expediente'";
				$result = $mysqli->query($consultar_patologia1);
                $consultar_patologia1_1 = $result->num_rows;
   
                if ($consultar_patologia1_1==0){
                   $patologiaid_tipo1_1 = 'N';
                }else{
                   $patologiaid_tipo1_1 = 'S';
                }

                /*2DA PATOLOGIA*/
                if($patologia_id2 != 0){
                    $consultar_patologia2 = "SELECT expediente 
					    FROM ata 
						WHERE patologia_id1 = '$patologia_id2' AND expediente = '$expediente'";
					$result = $mysqli->query($consultar_patologia2);
                    $consultar_patologia2_1 = $result->num_rows;

                    if ($consultar_patologia2_1==0){
                       $patologiaid_tipo2_1 = 'N';
                    }else{
                       $patologiaid_tipo2_1 = 'S';
                    }
                }else{
                     $patologiaid_tipo2_1 = '';
                }

                /*3ER PATOLOGIA*/
                if($patologia_id3 != 0){
                   $consultar_patologia3 = "SELECT expediente 
				       FROM ata 
					   WHERE patologia_id2 = '$patologia_id3' AND expediente = '$expediente'";
				   $result = $mysqli->query($consultar_patologia3);
                   $consultar_patologia3_1 = $result->num_rows;

                   if ($consultar_patologia3_1==0){
                      $patologiaid_tipo3_1 = 'N';
                   }else{
	                  $patologiaid_tipo3_1 = 'S';
                   }
                }else{
                    $patologiaid_tipo3_1 = '';
                }
			    
		        $update = "UPDATE ata SET 
				     patologia_id = '$patologia_id1', patologiaid_tipo1 = '$patologiaid_tipo1_1', patologia_id1 = '$patologia_id2', 
				     patologiaid_tipo2 = '$patologiaid_tipo2_1', patologia_id2 = '$patologia_id3', patologiaid_tipo3 = '$patologiaid_tipo3_1',
					 enfermedad_id = '$enfermedad', motivo_traslado_id = $motivo_traslado
		             WHERE ata_id = '$ata_id_consulta'";
                $mysqli->query($update);				

                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado_historial = "Actualizar";
                $observacion_historial = "Se han actualizado la informacion en el ATA de psicología en el área de Hospitalización para el servicio: $servicio_nombre";
                $modulo = "ATA";
                $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id_consulta','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
	            /******************************************************/					
					 
			    $update = "UPDATE hospitalizacion SET 
				    patologia_id = '$patologia_id1', patologiaid_tipo1 = '$patologiaid_tipo1_1', patologia_id1 = '$patologia_id2', 
				    patologiaid_tipo2 = '$patologiaid_tipo2_1', patologia_id2 = '$patologia_id3', patologiaid_tipo3 = '$patologiaid_tipo3_1',
					enfermedad_id = '$enfermedad'
				    WHERE hosp_id = '$hosp_id'";					
				$mysqli->query($update);
				
                //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
                $historial_numero = historial();
                $estado_historial = "Actualizar";
                $observacion_historial = "Se han actualizado la informacion de psicología en el área de Hospitalización para el servicio: $servicio_nombre";
                $modulo = "Hospitalizacion";
                $insert = "INSERT INTO historial 
                    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id_consulta','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
                $mysqli->query($insert);
	            /******************************************************/					
	        }
			
	        //HISTORIAL DE CAMAS
	        //CONSULTAR HISTORIAL DE CAMAS
	        $consultar_historial_camas = "SELECT cama_id, usuario, color, paciente, observaciones, porcentaje 
 	           FROM historial_camas 
	           WHERE historial_id = '$historial'";
            $result = $mysqli->query($consultar_historial_camas);			   
		   
	        $consultar_historial_camas2 = $result->fetch_assoc();
	        $cama_id = $consultar_historial_camas2['cama_id'];
			
		     //CAMBIAMOS EL ESTADO DE LA CAMA
		     $update = "UPDATE camas SET estado = 0 
			    WHERE cama_id = '$cama_id'";
			 $mysqli->query($update);
			 
             //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
             $historial_numero = historial();
             $estado_historial = "Actualizar";
             $observacion_historial = "Se han actualizado el estado de la cama para el area de Hospitalización en el servicio de: $servicio_nombre";
             $modulo = "Historial de Camas";
             $insert = "INSERT INTO historial 
                 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial','$usuario','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
	         /******************************************************/			 
			 
            //TRANSITO Y REFERENCIA DE USUARIOS
	        //TRANSITO	
	        //ENVIADAS
	        if($transito_servicio_enviada != "" && $transito_unidad_enviada != ""){
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

               //CONSULTAMOS REGISTRO ANTES DE ALMACENARLO
               $consulta_transito = "SELECT transito_id 
			       FROM transito_enviada 
				   WHERE expediente = '$expediente' AND colaborador_id = '$usuario' AND servicio_id = '$servicio_id' AND fecha = '$fecha'";
         	   $result = $mysqli->query($consulta_transito);   
	   
               if($numero_ata != 0 && $expediente != 0 && $usuario != 0 && $departamento_id != 0 && $municipio_id != 0 && $servicio_id != 0){
				   if($result->num_rows==0){
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
					  insertFacturacion($expediente, $servicio_nombre, $tipo_unidad, $identidad_colaboradores, $anos, $medicamento1, $cantidad1, $medicamento2, $cantidad2, $medicamento3, $cantidad3, $medicamento4, $cantidad4, $medicamento5, $cantidad5, $servicio_id);	  
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
       /*************************************************************************************************************************************/
	   
	        //REFERENCIAS ENVIADAS
	        if($nivel_e != 0){			 
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
                   
			     if($numero_ata != 0 && $expediente != 0 && $patologia_id1 != 0 && $servicio_id != 0 && $usuario != 0 && $centroi_e != 0 && $nivel_e != 0 && $centro_e != 0){
				   $insert = "INSERT INTO referencia_enviada VALUES('$numero_referencia_enviada','$numero_ata','$fecha','$expediente', '$anos', '$clinico','$patologia_id1','$patologia_id2','$patologia_id3','$servicio_id','$usuario','$motivo_e','$centroi_e','$nivel_e','$centro_e','No','$usuario' '$motivo', '$motivo_ref_recibida')";
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
		 }else{
			 echo 2;//ERROR AL GUARDAR EL REGISTRO
		 }		 
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