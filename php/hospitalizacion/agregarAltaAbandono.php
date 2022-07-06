<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$hosp_id = $_POST['hosp_id'];
$fecha = $_POST['fecha'];

$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año."-".$mes."-".$dia2));

if(date("D", strtotime ( '+1 day' , strtotime ( $fecha ) )) == 'Sat' ){
	$nuevafecha =  date("Y-m-d", strtotime ( '+3 day' , strtotime ( $fecha )));
}else{
	$nuevafecha = date("Y-m-d", strtotime ( '+1 day' , strtotime ( $fecha )));
}

//CONSULTAR DATOS DEL USUSUARIO
$consulta = "SELECT historial_id, ata_id, expediente, servicio_id, puesto_id 
    FROM hospitalizacion 
	WHERE hosp_id = '$hosp_id'"; 
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$historial_id = $consulta2['historial_id'];
$ata_id = $consulta2['ata_id'];
$expediente = $consulta2['expediente'];
$servicio_id = $consulta2['servicio_id'];
$puesto_id = $consulta2['puesto_id'];
$alta = 4;
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR VALORES EN LA ENTIDAD PACIENTES
$consulta_pacientes = "SELECT pacientes_id, CONCAT(nombre, ' ', apellido) AS nombre
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_pacientes);
$consulta_pacientes2 = $result->fetch_assoc();
$pacientes_id = $consulta_pacientes2['pacientes_id'];
$paciente_nombre = $consulta_pacientes2['nombre'];

//CONSULTAR EL NOMBRE DEL SERVICIO
$consulta_servicio = "SELECT nombre 
    FROM servicios 
	WHERE servicio_id = '$servicio_id'";
$result = $mysqli->query($consulta_servicio);
$consulta_servicio2 = $result->fetch_assoc();
$servicio_nombre = $consulta_servicio2['nombre'];

//OBTENER LA CAMA DEL USUARIO
$consultar_cama = "SELECT cama_id 
    FROM historial_camas 
	WHERE historial_id = '$historial_id'";
$result = $mysqli->query($consultar_cama);
$consultar_cama2 = $result->fetch_assoc();
$cama_id = $consultar_cama2['cama_id'];

//SE ACTUALIZA EL ESTADO DE LA ALTA
$query = $update = "UPDATE hospitalizacion SET alta = '$alta', observacion = 'Alta a usuario por abandono', estado = '$alta' 
  WHERE hosp_id = '$hosp_id'";
$query = $mysqli->query($update);
     
//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Actualizar";
$observacion_historial = "Se ha agregado el alta por abandono para este registro en el servicio: $servicio_nombre";
$modulo = "Hospitalizacion";
$insert = "INSERT INTO historial 
    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/

//SE AGREGA EL USUARIO EN EL REGISTRO DE INASISTENCIA
//OBTENER CORRELATIVO
$correlativo_ausencias = "SELECT MAX(ausencia_id) AS max, COUNT(ausencia_id) AS count 
   FROM ausencias";
$result = $mysqli->query($correlativo_ausencias);
$correlativo_ausencias2 = $result->fetch_assoc();

$numero_ausencias = $correlativo_ausencias2['max'];
$cantidad_ausencias = $correlativo_ausencias2['count'];

if ( $cantidad_ausencias == 0 )
  $numero_ausencias = 1;
else
   $numero_ausencias = $numero_ausencias + 1;

//OBTENER PACIENTES_ID
$consulta_paciente = "SELECT pacientes_id 
   FROM pacientes 
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_paciente);
$consulta_paciente2 = $result->fetch_assoc();
$pacientes_id = $consulta_paciente2['pacientes_id'];
	
$insert = "INSERT INTO ausencias 
    VALUES('$numero_ausencias','$pacientes_id', '$expediente', '$historial_id','$fecha','No se presento a su cita, se le dio de alta. (Alta Abandono)','$usuario','$usuario','$servicio_id')";
$mysqli->query($insert);

//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
$historial_numero = historial();
$estado = "Agregar";
$observacion_historial = "Se ha agregado la ausencia a este registro para el servicio: $servicio_nombre";
$modulo = "Ausencias";
$insert = "INSERT INTO historial 
    VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$numero_ausencias','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
$mysqli->query($insert);
/*****************************************************/

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
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado = "Actualizar";
        $observacion_historial = "Se ha actualizado el tiempo de estancia en psicología en el ATA para el servicio: $servicio_nombre";
        $modulo = "ATA";
        $insert = "INSERT INTO historial 
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$ata_id_datos','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
        $mysqli->query($insert);
        /*****************************************************/		
	}
			
    //ACUTALIZAMOS EL ESETADO DE LA ALTA			
	$update = "UPDATE hospitalizacion SET alta = '$alta', estado = 4, observacion = 'Alta a usuario por abandono' 
	     WHERE hosp_id = '$hosp_id_psico'";
	$query = $mysqli->query($update);
	
    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado = "Actualizar";
    $observacion_historial = "Se ha actualizado el alta en Hospitalizacion (alta abandono) para el servicio: $servicio_nombre";
    $modulo = "Hospitalizacion";
    $insert = "INSERT INTO historial 
       VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id_psico','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
    $mysqli->query($insert);
    /*****************************************************/			
	
	if($estado == 1 || $estado == 3){//SI EL USUARIO FUE ATENDIDO SE PROCEDE A ELIMINAR EL REGISTRO DEL SIGUIENTE DIA
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
           $estado = "Eliminar";
           $observacion_historial = "Se ha eliminado el registro ($paciente_nombre, expediente: $expediente) automaticamente ya que se le dio alta anteriormente para el servicio: $servicio_nombre";
           $modulo = "Hospitalizacion";
           $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$hosp_id_psico','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
           $mysqli->query($insert);
           /*****************************************************/				   
		   
		   //ELMINAMOS EL REGISTRO DEL AREA HISTORIAL DE CAMAS
		    $delete  = "DELETE FROM historial_camas 
			    WHERE historial_id = '$historial_id'";
			$mysqli->query($delete);
			
           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado = "Eliminar";
           $observacion_historial = "Se ha eliminado el registro ($paciente_nombre, expediente: $expediente) automaticamente ya que se le dio alta anteriormente para el servicio: $servicio_nombre";
           $modulo = "Hospitalizacion";
           $insert = "INSERT INTO historial 
                VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','$usuario','$servicio_id','$fecha','$estado','$observacion_historial','$usuario','$fecha_registro')";	 
           $mysqli->query($insert);
           /*****************************************************/				
	   }				
	}
}	   

if($query){
	//CONSULTAMOS EL TIEMPO DE ESTANCIA DEL USUARIO
	$consulta_estancia = "SELECT sum(estancia) AS 'total'
            FROM hospitalizacion
            WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND estado = 1 AND servicio_id = '$servicio_id' AND puesto_id = '$puesto_id' AND expediente = '$expediente'
            ORDER BY hosp_id";
	$result = $mysqli->query($consulta_estancia);
			
	$consulta_estancia2 = $result->fetch_assoc();
    $total = $consulta_estancia2['total'];
	
	if($total != null || $total != ""){
		if ($total == 1){
		   $total = $total.' Día'; 
		}else{
		   $total = $total.' Días';
		}

		$update = "UPDATE ata SET tiempo_estancia = '$total' 
		     WHERE ata_id = '$ata_id'";
		$mysqli->query($update);
		
		//CAMBIAMOS EL ESTADO DE LA CAMA
		$update = "UPDATE camas SET estado = 0 
		    WHERE cama_id = '$cama_id'";
		$mysqli->query($update);
	}
			
	echo 1;
}else{
	echo 2;
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>