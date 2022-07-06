<?php
session_start(); 
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
 
date_default_timezone_set('America/Tegucigalpa');

$expediente = $_POST['expediente'];
$fecha = $_POST['fecha'];
$enviada_a = $_POST['servicio_id'];

//CONSULTAMOS EL ATA_ID DE TRANSITO ENVIADA
$consulta_transito_ata = "SELECT ata_id, colaborador_id, servicio_id 
FROM transito_enviada 
WHERE expediente = '$expediente' AND enviada_a = '$enviada_a' AND fecha = '$fecha'";
$result = $mysqli->query($consulta_transito_ata);
$consulta_transito_ata2 = $result->fetch_assoc();
$ata_id = $consulta_transito_ata2['ata_id'];
$colaborador_id = $consulta_transito_ata2['colaborador_id'];
$servicio_id = $consulta_transito_ata2['servicio_id'];

//OBTENER LA PATOLOGIA
$consultar_patologias = "SELECT patologia_id, patologia_id1, patologia_id2 
    FROM ata 
    WHERE expediente = '$expediente' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'
    ORDER BY ata_id DESC LIMIT 1";
$result = $mysqli->query($consultar_patologias);	
$consultar_patologias2 = $result->fetch_assoc();
$patologia_id = $consultar_patologias2['patologia_id'];
$patologia_id1 = $consultar_patologias2['patologia_id1'];
$patologia_id2 = $consultar_patologias2['patologia_id2'];

$datos = array(
                0 => $patologia_id,
                1 => $patologia_id1,
                2 => $patologia_id2,									
				);
echo json_encode($datos);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>