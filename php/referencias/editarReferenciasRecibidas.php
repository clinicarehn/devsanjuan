<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL REGISTRO

//CONSULTA EN LA ENTIDAD CORPORACION
$valores = "SELECT p.expediente AS 'expediente', p.identidad AS 'identidad', patologia_id AS 'patologia_id', CONCAT(p.nombre,' ',p.apellido) AS nombre, rc.motivo_referencia AS 'motivo', rc.nivel AS 'nivel', rc.centro AS 'centro', rc.unidad_envia AS 'recibidade', rc.motivo_traslado AS 'motivo_traslado', rc.motivo_traslado_otros AS 'motivo_traslado_otros'
      FROM referencia_recibida AS rc
      INNER JOIN pacientes AS p
      ON rc.expediente = p.expediente
      WHERE rc.referenciar_id = '$id'";
$result = $mysqli->query($valores);	  

$valores2 = $result->fetch_assoc();

$datos = array(
				0 => $valores2['expediente'], 
				1 => $valores2['identidad'], 
 				2 => $valores2['nombre'],
                3 => $valores2['motivo'],
                4 => $valores2['nivel'],
                5 => $valores2['centro'],
                6 => $valores2['recibidade'],
                7 => $valores2['patologia_id'],	
                8 => $valores2['motivo_traslado'],	
                9 => $valores2['motivo_traslado_otros'],					
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>