<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
header("Content-Type: text/html;charset=utf-8");

$id = $_POST['id-registro'];
$expediente = $_POST['expediente'];
$patologia1 = $_POST['patologia1'];
$fecha_siguiente = $_POST['fecha_siguiente'];
$hora = date('H:i:s',strtotime($_POST['hora']));
$instrucciones = cleanStringStrtolower($_POST['observacion']);
$procedimiento = cleanStringStrtolower($_POST['procedimiento']);
$fecha_registro = date("Y-m-d H:i:s");
$usuario = $_SESSION['colaborador_id'];

//OBTENER PACIENTE_ID
$query_paciente = "SELECT pacientes_id, CONCAT(apellido,' ',nombre) AS 'paciente'
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($query_paciente);
$consulta_paciente = $result->fetch_assoc();
$pacientes_id = $consulta_paciente['pacientes_id'];
$nombre_paciente = $consulta_paciente['paciente'];

//OBTENER DATOS DE LA POSTCLINICA
$consulta_post = "SELECT colaborador_id, servicio_id, fecha
   FROM postclinica
   WHERE postclinica_id = '$id'";
$result = $mysqli->query($consulta_post);
$consulta_paciente = $result->fetch_assoc();
$colaborador_id = $consulta_paciente['colaborador_id'];
$servicio_id = $consulta_paciente['servicio_id'];
$fecha = $consulta_paciente['fecha'];

//TRATAMIENTO
//1ER FILA
$medicamento1 = cleanStringStrtolower($_POST['medicamento1']);
$dosis1 = cleanStringStrtolower($_POST['dosis1']);
$via1 = cleanStringStrtolower($_POST['via1']);
$frecuencia1 = cleanStringStrtolower($_POST['frecuencia1']);
$recomendaciones1 = cleanStringStrtolower($_POST['recomendaciones1']);
$registro1 = $_POST['registro1'];

//2DA FILA
$medicamento2 = cleanStringStrtolower($_POST['medicamento2']);
$dosis2 = cleanStringStrtolower($_POST['dosis2']);
$via2 = cleanStringStrtolower($_POST['via2']);
$frecuencia2 = cleanStringStrtolower($_POST['frecuencia2']);
$recomendaciones2 = cleanStringStrtolower($_POST['recomendaciones2']);
$registro2 = $_POST['registro2'];

//3ER FILA
$medicamento3 = cleanStringStrtolower($_POST['medicamento3']);
$dosis3 = cleanStringStrtolower($_POST['dosis3']);
$via3 = cleanStringStrtolower($_POST['via3']);
$frecuencia3 = cleanStringStrtolower($_POST['frecuencia3']);
$recomendaciones3 = cleanStringStrtolower($_POST['recomendaciones3']);
$registro3 = $_POST['registro3'];

//4TQ FILA
$medicamento4 = cleanStringStrtolower($_POST['medicamento4']);
$dosis4 = cleanStringStrtolower($_POST['dosis4']);
$via4 = cleanStringStrtolower($_POST['via4']);
$frecuencia4 = cleanStringStrtolower($_POST['frecuencia4']);
$recomendaciones4 = cleanStringStrtolower($_POST['recomendaciones4']);
$registro4 = $_POST['registro4'];

//5TA FILA
$medicamento5 = cleanStringStrtolower($_POST['medicamento5']);
$dosis5 = cleanStringStrtolower($_POST['dosis5']);
$via5 = cleanStringStrtolower($_POST['via5']);
$frecuencia5 = cleanStringStrtolower($_POST['frecuencia5']);
$recomendaciones5 = cleanStringStrtolower($_POST['recomendaciones5']);
$registro5 = $_POST['registro5'];

if ($proceso = 'Edicion'){

	$update = "UPDATE postclinica SET diagnostico = '$patologia1', fecha_cita = '$fecha_siguiente', hora = '$hora', instrucciones = '$instrucciones', precedimiento = '$procedimiento'
	WHERE postclinica_id = '$id'";
	$query = $mysqli->query($update);

    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado_historial = "Actualizar";
    $observacion_historial = "Se ha actualizado la postclinica para este usuario: $nombre_paciente con expediente n° $expediente";
    $modulo = "Postclinica";
    $insert = "INSERT INTO historial
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
    $mysqli->query($insert);
    /*****************************************************/

	if($query){
		echo 1;
	}else{
		echo 2;
	}

	if($registro1 !=""){
		$update = "UPDATE postclinica_detalle SET medicamento = '$medicamento1', dosis = '$dosis1', via = '$via1', frecuencia = '$frecuencia1', recomendaciones = '$recomendaciones1'
		WHERE id = '$registro1'";
		$mysqli->query($update);

        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
        $historial_numero = historial();
        $estado_historial = "Actualizar";
        $observacion_historial = "Se ha actualizado el detalle de la postclinica para este usuario: $nombre_paciente con expediente n° $expediente";
        $modulo = "Postclinica Detalle";
        $insert = "INSERT INTO historial
            VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$registro1','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
        $mysqli->query($insert);
        /*****************************************************/
	}

	if($registro2 !=""){
		$update = "UPDATE postclinica_detalle SET medicamento = '$medicamento2', dosis = '$dosis2', via = '$via2', frecuencia = '$frecuencia2', recomendaciones = '$recomendaciones2'
		WHERE id = '$registro2'";
		$mysqli->query($update);
	}

	if($registro3 !=""){
		$update = "UPDATE postclinica_detalle SET medicamento = '$medicamento3', dosis = '$dosis3', via = '$via3', frecuencia = '$frecuencia3', recomendaciones = '$recomendaciones3'
		WHERE id = '$registro3'";
		$mysqli->query($update);
	}

	if($registro4 !=""){
		$update = "UPDATE postclinica_detalle SET medicamento = '$medicamento4', dosis = '$dosis4', via = '$via4', frecuencia = '$frecuencia4', recomendaciones = '$recomendaciones4'
		WHERE id = '$registro4'";
		$mysqli->query($update);
	}

	if($registro5 !=""){
		$update = "UPDATE postclinica_detalle SET medicamento = '$medicamento5', dosis = '$dosis5', via = '$via5', frecuencia = '$frecuencia5', recomendaciones = '$recomendaciones5'
		WHERE id = '$registro5'";
		$mysqli->query($update);
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
