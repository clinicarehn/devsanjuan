<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$nivel = $_POST['centros_nivel'];
$centro = $_POST['centro'];
$recibida = $_POST['recibidade'];
$patologia = $_POST['patologia1'];
$diagnostico = cleanStringStrtolower($_POST['diagnostico']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

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

if(isset($_POST['motivo1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
   if($_POST['motivo1'] == ""){
	   $motivo_ref_recibida = 0;
   }else{
	   $motivo_ref_recibida = $_POST['motivo1'];
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

$servicio = $_POST['servicio'];
$medico = $_POST['medico_general'];
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$consultar_expediente = "SELECT expediente, pacientes_id
    FROM pacientes 
	WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

//CONSULTAR PUESTO
$consulta_puesto = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$medico'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc();
$puesto_id = $consulta_puesto1['puesto_id'];	

//CONSULTAR EXISTENCIA DE ATENCIONES
$consultar_existencia = "SELECT ata_id, recibidade 
    FROM ata 
	WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$medico' AND servicio_id = '$servicio'";
$result = $mysqli->query($consultar_existencia);
$consultar_existencia2 = $result->fetch_assoc();
$consulta_existencia_ata_id = $consultar_existencia2['ata_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(referenciar_id) AS max, COUNT(referenciar_id) AS count 
   FROM referencia_recibida";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	

//CONSULTAR FECHA DE NACIMIENTO
$consulta_nacimiento = "SELECT fecha_nacimiento 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_nacimiento);
$consulta_nacimiento2 = $result->fetch_assoc();
$fecha_de_nacimiento = $consulta_nacimiento2['fecha_nacimiento'];

/*********************************************************************************/
//CONSULTA AÑO, MES y DIA DEL PACIENTE
$nacimiento = "SELECT fecha_nacimiento AS fecha 
	FROM pacientes WHERE expediente = '$expediente'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $nacimiento2['fecha'];

$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	 
/*********************************************************************************/
	
//VERIFICAMOS EL PROCESO

if ($proceso = 'Registro'){
  if($consulta_existencia_ata_id != ""){	
	
   //CONSULTAR REGISTRO
   $consultar_registro = "SELECT referenciar_id 
        FROM referencia_recibida AS r
		INNER JOIN colaboradores AS c
		ON r.colaborador_id = c.colaborador_id
        WHERE r.expediente = '$expediente' AND r.fecha = '$fecha' AND r.servicio_id = '$servicio' AND c.puesto_id = '$puesto_id'";
   $result = $mysqli->query($consultar_registro);		

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{
	   //CONSULTAR ATA ID
	   $consultar_ata = "SELECT a.ata_id 
	           FROM ata AS a
			   INNER JOIN colaboradores AS c
			   ON a.colaborador_id = c.colaborador_id
	           WHERE c.puesto_id = '$puesto_id' AND a.expediente = '$expediente' AND a.fecha = '$fecha' AND a.servicio_id = '$servicio'";	
       $result = $mysqli->query($consultar_ata);			   
	   
	   if($result->num_rows>0){//SI REGISTRO FUE ENCONTRADO, SE ALMACENA EL ATA_ID
		  $consultar_ata2 = $result->fetch_assoc(); 
		  $ata_id = $consultar_ata2['ata_id'];
		  //MODIFICAMOS LOS VALORES EN LA REFERENCIA RECIBIDA
		  //CONSULTAMOS EL NIVEL PARA LA RESPUESTA

         //OBTENER NOMBRE
         $consulta_respuesta_recibida = "SELECT centro_nombre 
		     FROM centros_hospitalarios 
			 WHERE centros_id = '$recibida'";
		 $result = $mysqli->query($consulta_respuesta_recibida);
         $consulta_respuesta_recibida2 = $result->fetch_assoc();
         $referencia_recibidade = $consulta_respuesta_recibida2['centro_nombre'];
		  
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
		  
		$update = "UPDATE ata SET recibidade = '$referencia_recibidade', referencia_mayor = '$referencia_mayor', respuesta1 = '$respuesta1', respuesta2 = '$respuesta2' 
		       WHERE ata_id = '$ata_id'";
	    $mysqli->query($update);
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Actualizar";
        $observacion = "Se ha actualizado la referencia recibida en el ATA del usuario desde Referencias Recibidas";
        $modulo = "ATA";
        $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/				
	   }else{//DE LO CONTRARIO SE GUARDA EN CERO
		  $ata_id = 0;
	   }
	   	   
	   if($recibida != 0 && $nivel != 0 && $centro != 0 && $ata_id != 0 && $servicio != 0 && $patologia != 0 && $medico != 0 && $motivo != 0 && $motivo_ref_recibida != 0){
		   $insert = "INSERT INTO referencia_recibida 
	           VALUES('$numero', '$ata_id', '$fecha', '$expediente', '$anos', '$patologia', '$diagnostico', '$servicio','$medico','$motivo_referencia_recibida','$recibida','Sí', '$recibida', '$nivel','$centro','$usuario','$fecha_registro', '$motivo', '$motivo_ref_recibida')";
		   $query = $mysqli->query($insert);
		   
           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado = "Agregar";
           $observacion = "Se ha agregado una nueva referencia recibida";
           $modulo = "Referencia Recibida";
           $insert = "INSERT INTO historial 
               VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
           $mysqli->query($insert);
           /*****************************************************/			   
	       
		   if($query){
		      echo 1;//REGISTRO ALMACENADO CORRECTAMENTE 
	       }else{
		      echo 4;//EL REGISTRO NO SE PUEDO ALMACENAR 
	       }	   
	   }else{
		   echo 5; //ERROR AL INTENTAR GUARDAR EL REGISTRO EL CENTRO DE PROCEDENCIA NO DEBE QUEDAR EN BLANCO O SER CERO
	   }			         
   }
  }else{
	  echo 3;//NO EXISTEN ATENCIONES DEL USUARIO
  } 
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>