<?php
session_start();   
include('../funtions.php');
include('../conexion-postgresql.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");

$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$expediente_valor = $_POST['expediente'];
$hora_sistema = date('H:i:s');	
$fecha = $_POST['fecha'];

$fecha_cita = $_POST['fecha_siguiente'];
$patologia1 = $_POST['patologia1'];
$fecha_siguiente = $_POST['fecha_siguiente'];
$hora = date('H:i:s',strtotime($_POST['hora']));
$servicio = $_POST['servicio_postclinica'];
$medico = $_POST['colaborador'];
$instrucciones = cleanStringStrtolower($_POST['observacion']);
$procedimiento = cleanStringStrtolower($_POST['procedimiento']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

$consultar_expediente = "SELECT expediente 
     FROM pacientes 
	 WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor' AND tipo = 1";
$result = $mysqli->query($consultar_expediente);	 
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];

//TRATAMIENTO
//1ER FILA
if(isset($_POST['medicamento1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento1'] == ""){
		$medicamento1 = "";
		$dosis1 = "";
	}else{
		$medicamento1 = $_POST['medicamento1'];
		$dosis1 = getDosis($medicamento1);
	}
}else{
	$medicamento1 = "";
	$dosis1 = "";
}

$via1 = cleanStringStrtolower($_POST['via1']);
$frecuencia1 = cleanStringStrtolower($_POST['frecuencia1']);
$recomendaciones1 = cleanStringStrtolower($_POST['recomendaciones1']);

//2DA FILA
if(isset($_POST['medicamento2'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento2'] == ""){
		$medicamento2 = "";
		$dosis2 = "";
	}else{
		$medicamento2 = $_POST['medicamento2'];
		$dosis2 = getDosis($medicamento2);
	}
}else{
	$medicamento2 = "";
	$dosis2 = "";
}

$via2 = cleanStringStrtolower($_POST['via2']);
$frecuencia2 = cleanStringStrtolower($_POST['frecuencia2']);
$recomendaciones2 = cleanStringStrtolower($_POST['recomendaciones2']);

//3ER FILA
if(isset($_POST['medicamento3'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento3'] == ""){
		$medicamento3 = "";
		$dosis3 = "";
	}else{
		$medicamento3 = $_POST['medicamento3'];
		$dosis3 = getDosis($medicamento3);
	}
}else{
	$medicamento3 = "";
	$dosis3 = "";
}

$via3 = cleanStringStrtolower($_POST['via3']);
$frecuencia3 = cleanStringStrtolower($_POST['frecuencia3']);
$recomendaciones3 = cleanStringStrtolower($_POST['recomendaciones3']);

//4TQ FILA
if(isset($_POST['medicamento4'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento4'] == ""){
		$medicamento4 = "";
		$dosis4 = "";
	}else{
		$medicamento4 = $_POST['medicamento4'];
		$dosis4 = getDosis($medicamento4);
	}
}else{
	$medicamento4 = "";
	$dosis4 = "";
}

$via4 = cleanStringStrtolower($_POST['via4']);
$frecuencia4 = cleanStringStrtolower($_POST['frecuencia4']);
$recomendaciones4 = cleanStringStrtolower($_POST['recomendaciones4']);

//5TA FILA
if(isset($_POST['medicamento5'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
	if($_POST['medicamento5'] == ""){
		$medicamento5 = "";
		$dosis5 = "";
	}else{
		$medicamento5 = $_POST['medicamento5'];
		$dosis5 = getDosis($medicamento5);
	}
}else{
	$medicamento5 = "";
	$dosis5 = "";
}

$via5 = cleanStringStrtolower($_POST['via5']);
$frecuencia5 = cleanStringStrtolower($_POST['frecuencia5']);
$recomendaciones5 = cleanStringStrtolower($_POST['recomendaciones5']);

//CONSULTAR PACIENTE_ID
$consultar_paciente = "SELECT pacientes_id 
    FROM pacientes 
	WHERE expediente = '$expediente'";
$result = $mysqli->query($consultar_paciente);
$consultar_paciente2 = $result->fetch_assoc();
$pacientes_id = $consultar_paciente2['pacientes_id'];

//CONSULTAR AGENDA SI HAY VALORES
$consultar_agenda = "SELECT agenda_id 
   FROM agenda 
   WHERE expediente = '$expediente' AND cast(fecha_cita AS DATE) = '$fecha' AND colaborador_id = '$medico' AND servicio_id = '$servicio'";
$result = $mysqli->query($consultar_agenda);
$consultar_agenda1 = $result->fetch_assoc();
$consultar_agenda2 = $result->num_rows;
$agenda_id = $consultar_agenda1['agenda_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(postclinica_id) AS max, COUNT(postclinica_id) AS count 
   FROM postclinica";
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
	      FROM pacientes 
		  WHERE expediente = '$expediente'";
$result = $mysqli->query($nacimiento);
$nacimiento2 = $result->fetch_assoc();
$fecha_nacimiento = $nacimiento2['fecha'];

$valores_array = getEdad($fecha_nacimiento);
$anos = $valores_array['anos'];
$meses = $valores_array['meses'];	  
$dias = $valores_array['dias'];	
//VERIFICAMOS EL PROCESO

if ($proceso = 'Registro'){
	
   //CONSULTAR Registro
   $consultar_registro = "SELECT postclinica_id FROM postclinica 
       WHERE expediente = '$expediente' AND fecha = '$fecha' AND servicio_id = '$servicio' AND colaborador_id = '$medico'";
   $result = $mysqli->query($consultar_registro);	   

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{
	   $insert = "INSERT INTO postclinica VALUES('$numero', '$pacientes_id', '$expediente', '$medico', '$anos', '$patologia1', '$fecha_registro', '$fecha_cita', '$hora', '$servicio', '$usuario', '$instrucciones', '$procedimiento')";   
       $query = $mysqli->query($insert);	   
	   	  

       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado = "Agregar";
       $observacion = "Se ha realizado la postclínica para este usuario";
       $modulo = "Postclinica";
       $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/	
   
       if($query){		   
	       if ($consultar_agenda2 > 0){
		      $update = "UPDATE agenda SET postclinica = 2 
			     WHERE agenda_id = '$agenda_id' AND CAST(fecha_cita AS DATE) = '$fecha'";
              $mysqli->query($update);	

              //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
              $historial_numero = historial();
              $estado = "Actualizar";
              $observacion = "Se actualiza el campo postclinica en la entidad agenda desde el area de postclínica";
              $modulo = "Postclinica";
              $insert = "INSERT INTO historial 
                  VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
             $mysqli->query($insert);
             /*****************************************************/			  
	       }  
		   
		   //AGREGAR EN MEDICAMENTOS	
           if($medicamento1 !="" && $dosis1 && $via1 != "" && $frecuencia1 != ""){
			   $postclinica_id = correlativoTratamiento($mysqli);
			   
			   $insert = "INSERT INTO postclinica_detalle 
			      VALUES('$postclinica_id','$numero','$medicamento1','$dosis1','$via1','$frecuencia1','$recomendaciones1')";
			   $mysqli->query($insert);	
			   
               //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
               $historial_numero = historial();
               $estado = "Agregar";
               $observacion = "Se agrega el detalle de los medicamentos en la entidad postclínica";
               $modulo = "Postclinica";
               $insert = "INSERT INTO historial 
                   VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','$medico','$servicio','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
              $mysqli->query($insert);
              /*****************************************************/			   
		   }
		   
           if($medicamento2 !="" && $dosis1 && $via2 != "" && $frecuencia2 != ""){
			   $postclinica_id = correlativoTratamiento($mysqli);

			   $insert = "INSERT INTO postclinica_detalle 
			       VALUES('$postclinica_id','$numero','$medicamento2','$dosis2','$via2','$frecuencia2','$recomendaciones2')";
               $mysqli->query($insert);	
		   }

           if($medicamento3 !="" && $dosis3 && $via3 != "" && $frecuencia3 != ""){
			  $postclinica_id = correlativoTratamiento($mysqli); 
			  
			   $insert = "INSERT INTO postclinica_detalle 
			       VALUES('$postclinica_id','$numero','$medicamento3','$dosis3','$via3','$frecuencia3','$recomendaciones3')";
               $mysqli->query($insert);				   
		   }

           if($medicamento4 !="" && $dosis4 && $via4 != "" && $frecuencia4 != ""){
			  $postclinica_id = correlativoTratamiento($mysqli);
			  
			   $insert = "INSERT INTO postclinica_detalle 
			       VALUES('$postclinica_id','$numero','$medicamento4','$dosis4','$via4','$frecuencia4','$recomendaciones4')";	
              $mysqli->query($insert);				   
		   }

           if($medicamento5 !="" && $dosis5 && $via5 != "" && $frecuencia5 != ""){
			  $postclinica_id = correlativoTratamiento($mysqli);
			  
			   $insert = "INSERT INTO postclinica_detalle 
			       VALUES('$postclinica_id','$numero','$medicamento5','$dosis5','$via5','$frecuencia5','$recomendaciones5')";
               $mysqli->query($insert);				   
		   }		   
		   
		   echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
	   }else{
		   echo 3; //ERROR AL ALMACENAR EL REGISTRO;
	   }
   }  
}


function correlativoTratamiento($mysqli){
    //OBTENER CORRELATIVO
    $correlativo = "SELECT MAX(id) AS max, COUNT(id) AS count 
	   FROM postclinica_detalle";
	$result = $mysqli->query($correlativo);
    $correlativo2 = $result->fetch_assoc();

    $numero_postclinica = $correlativo2['max'];
    $cantidad_postclinica = $correlativo2['count'];

    if ( $cantidad_postclinica == 0 )
	   $numero_postclinica = 1;
    else
       $numero_postclinica = $numero_postclinica + 1;

    return $numero_postclinica;   
}

function getDosis($medicamento){	
	$conexion = conectar();
		
	$query = "SELECT pt.id as product_template_id, pp.id AS product_id, pp.default_code AS codigo, pp.name_template AS producto, x_concentracion AS concentracion, pu.name AS unidad, x_codigo_atc AS codigo_atc
     FROM product_product AS pp
     INNER JOIN product_template AS pt
     ON pp.product_tmpl_id = pt.id
     INNER JOIN product_uom pu
     ON pt.uom_id = pu.id
     WHERE pt.type = 'product' AND pt.sale_ok = 't' AND pp.name_template = '$medicamento'";
	 
    $resultado_busqueda = pg_query($conexion, $query); 
    $consulta2 = pg_fetch_array($resultado_busqueda);	
	
	$concentracion = $consulta2['concentracion'];
	
	return $concentracion;
}
   
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN   
?>