<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT p.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.nombre,' ',p.apellido) AS nombre, re.motivo_referencia As 'motivo', re.nivel As 'nivel', re.centro AS 'centro', re.clinico As 'clinico', re.unidad_envia AS 'enviadaa', patologia1 AS 'patologia1', patologia2 AS 'patologia2', patologia3 AS 'patologia3', re.motivo_traslado AS 'motivo_traslado', re.motivo_traslado_otros AS 'motivo_traslado_otros'
     FROM referencia_enviada AS re
     INNER JOIN pacientes AS p
     ON re.expediente = p.expediente
     WHERE re.referenciar_id = '$id'";
$result = $mysqli->query($valores);	 

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['expediente'], 
				1 => $valores2['identidad'], 
 				2 => $valores2['nombre'],
                3 => $valores2['motivo'],
                4 => $valores2['nivel'],
                5 => $valores2['centro'],
                6 => $valores2['enviadaa'],
                7 => $valores2['clinico'],
                8 => $valores2['patologia1'],
                9 => $valores2['patologia2'],
                10 => $valores2['patologia3'],	
                11 => $valores2['motivo_traslado'],	
                12 => $valores2['motivo_traslado_otros'],					
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>