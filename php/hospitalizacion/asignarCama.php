<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");
$proceso = $_POST['pro'];

$expediente_valor = $_POST['expediente'];
$fecha = $_POST['fecha'];
$cama = $_POST['cama'];
$sala = $_POST['sala'];
$servicio_id = $_POST['sala'];
$cama = $_POST['cama'];
$estado = 1;
$usuario = $_SESSION['colaborador_id'];
$observaciones = cleanStringStrtolower($_POST['observaciones']);
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

$consultar_expediente = "SELECT expediente, pacientes_id 
   FROM pacientes 
   WHERE expediente = '$expediente_valor' OR identidad = '$expediente_valor'";
$result = $mysqli->query($consultar_expediente);
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];
$pacientes_id = $consultar_expediente2['pacientes_id'];

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

if($servicio_id == 1 || $servicio_id == 2){
	$servicio_id = 3;
}else{
	$servicio_id = 4;
}

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

$enero = date("Y-m-d", strtotime($año."-01-01"));
$diciembre = date("Y-m-d", strtotime($año."-12-31"));

$valores = "SELECT historial_id
     FROM historial_camas AS a
     WHERE expediente = '$expediente' AND fecha BETWEEN '$enero' AND '$diciembre' AND a.servicio_id = '$servicio_id' AND puesto_id = 2";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();

if($result->num_rows>0){
	$paciente = "S";
}else{
	$paciente = "N";	
}
	 
$color = "#DF0101"; //COLOR ROJO INDICA CAMA OCUPADA

//OBTENER CORRELATIVO
//HISOTRIAL_CAMAS
$correlativo= "SELECT MAX(historial_id) AS max, COUNT(historial_id) AS count 
   FROM historial_camas";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//CORRELATIVO HOSPITALIZACION
$correlativo_hospitalizacion = "SELECT MAX(hosp_id) AS max, COUNT(hosp_id) AS count 
   FROM hospitalizacion";
$result = $mysqli->query($correlativo_hospitalizacion);
$correlativo_hospitalizacion2 = $result->fetch_assoc();

$numero1 = $correlativo_hospitalizacion2['max'];
$cantidad1 = $correlativo_hospitalizacion2['count'];

if ( $cantidad1 == 0 )
	$numero1 = 1;
else
    $numero1 = $numero1 + 1;


//VERIFICAMOS EL PROCESO
//CONSULTAR USUARIO
$consulta = "SELECT historial_id 
   FROM historial_camas 
   WHERE expediente = '$expediente' AND estado = 0";
$result = $mysqli->query($consulta);
$consulta1 = $result->num_rows;
$puesto_id = 2; 

if ($proceso = 'Registro'){
  if($consulta1 > 0){
	  echo 3; //EL REGISTRO YA EXISTE
  }else{
	//CONSULTAMOS LA CANTIDAD DE CAMAS POR SALA
	$consulta_cantidad_camas = "SELECT COUNT(Cama_id) AS 'total' 
	   FROM camas WHERE sala_id = '$sala'";
	$result = $mysqli->query($consulta_cantidad_camas);
	$consulta_cantidad_camas2 = $result->fetch_assoc();
    $total_camas = $consulta_cantidad_camas2['total'];
	
	if($total_camas > 0){
		$valor = (1/$total_camas)*100;
	}else{
		$valor = 0;
	}

	$porcentaje = number_format($valor, 2, '.', '');
	
	//ASIGNAMOS LA CAMA AL USUARIO
	if($expediente != 0 && $cama != 0 && $servicio_id != 0 && $puesto_id != 0 && $usuario !=0){
        $insert = "INSERT INTO historial_camas 
		    VALUES('$numero','$fecha', '$expediente', '$cama', '$servicio_id', '$puesto_id','$usuario', '$color', '$paciente','$observaciones', '1','$porcentaje','$fecha_registro')";
	    $query = $mysqli->query($insert);
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Agregar";
        $observacion_historial = "Se ha asignado cama para este usuario en el servicio: $servicio_nombre";
        $modulo = "Hospitalizacion";
        $insert = "INSERT INTO historial 
             VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','0','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/			
	
	    //LLENA LOS REGISTROS QUE PODRAN VISUALIZAR LOS PROFESIONALES ENCARGADOS DEL AREA
	     $insert = "INSERT INTO hospitalizacion 
		     VALUES ('$numero1','$numero','0', '$fecha','$expediente','$servicio_id', '0', '$puesto_id', '$paciente', 
	     '0','','0','0', '0', '', '0', '', '0', '','0','0','$fecha_registro')";	
        $mysqli->query($insert);

        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Agregar";
        $observacion_historial = "Se ha creado registro en el area de hospitalización, quedando disponible para el ingreso del ATA, el registro se hizo en el servicio: $servicio_nombre";
        $modulo = "Hospitalizacion";
        $insert = "INSERT INTO historial 
             VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','0','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/		
		 
	    if($query){
		    $update = "UPDATE camas 
			     SET estado = '$estado' 
				 WHERE cama_id = '$cama'";
			$mysqli->query($update);
			
            //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
            $historial_numero = historial();
            $estado = "Actualizar";
            $observacion_historial = "Se ha actualizado el estado de la cama eh el area de Hospitalización para el servicio: $servicio_nombre";
            $modulo = "Hospitalizacion";
            $insert = "INSERT INTO historial 
                 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero','0','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
            $mysqli->query($insert);
            /*****************************************************/	
		
		    echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
	    }else{
		    echo 2;//NO SE PUDO GUARDAR EL REGISTRO
	    }		 
	}else{
		echo 4;//ERROR AL GUARDAR EL REGISTRO
	}
  }
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>