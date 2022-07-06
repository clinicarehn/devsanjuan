<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$transito_id = $_POST['transito_id'];

//CONSULTAR DETALLES DE LA RECETA
$query = "SELECT te.transito_id AS 'transito_id', DATE_FORMAT(te.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.nombre,' ',p.apellido) AS 'usuario', te.expediente AS 'expediente', p.identidad AS 'identidad', te.edad AS 'edad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', (CASE WHEN te.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN te.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', d.nombre As 'departamento', m.nombre AS 'municipio', s.nombre AS 'enviadaa', pc.nombre AS 'enviadaa_unidad', te.observacion AS 'observacion', CONCAT(c.nombre,' ',c.apellido) AS 'profesional', DATE_FORMAT(te.fecha, '%d/%m/%Y') AS 'fecha_cita'
   FROm transito_enviada AS te
   INNER JOIN pacientes AS p
   ON te.expediente = p.expediente
   INNER JOIN departamentos AS d
   ON te.departemento_id = d.departamento_id
   INNER JOIN municipios AS m
   ON te.municipio_id = m.municipio_id
   INNER JOIN servicios AS s
   ON te.enviada_a = s.servicio_id
   INNER JOIN puesto_colaboradores AS pc
   ON te.enviada_a_unidad = pc.puesto_id
   INNER JOIN colaboradores AS c
   ON te.colaborador_id = c.colaborador_id
   WHERE te.transito_id = '$transito_id'";
$result = $mysqli->query($query);

$arreglo = array();

while($row = $result->fetch_assoc()){
  $arreglo[] = $row;
}

echo json_encode($arreglo);
?>
