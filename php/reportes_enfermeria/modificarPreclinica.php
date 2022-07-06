<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$id = $_POST['id-registro'];
$expediente = $_POST['expediente'];
$pa = $_POST['pa'];
$fr = $_POST['fr'];
$fc = $_POST['fc'];
$temperatura = $_POST['temperatura'];
$peso = $_POST['peso'];
$talla = $_POST['talla'];
$observaciones = cleanStringStrtolower($_POST['observaciones']);
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

//OBTENER DATOS DE LA PRECLINICA
$consulta_post = "SELECT colaborador_id, servicio_id, fecha
   FROM preclinica
   WHERE preclinica_id = '$id'";
$result = $mysqli->query($consulta_post);
$consulta_paciente = $result->fetch_assoc();
$colaborador_id = $consulta_paciente['colaborador_id'];
$servicio_id = $consulta_paciente['servicio_id'];
$fecha = $consulta_paciente['fecha'];

//VERIFICAMOS EL PROCESO
if ($proceso = 'Edicion'){
	$update = "UPDATE preclinica SET pa = '$pa', fr = '$fr', fc = '$fc', t = '$temperatura', peso = '$peso', talla = '$talla', observacion = 'observaciones'
	WHERE preclinica_id = '$id'";
	$data = $mysqli->query($update);

    //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
    $historial_numero = historial();
    $estado_historial = "Actualizar";
    $observacion_historial = "Se ha actualizado la preclínica para este usuario: $nombre_paciente con expediente n° $expediente";
    $modulo = "Preclinica";
    $insert = "INSERT INTO historial
         VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$id','$colaborador_id','$servicio_id','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";
    $mysqli->query($insert);
    /*****************************************************/

	if($data){
		echo 1;
	}else{
		echo 2;
	}
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>
