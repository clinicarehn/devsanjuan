<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 	

date_default_timezone_set('America/Tegucigalpa');
$paginaActual = $_POST['partida'];
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$dato = $_POST['dato'];
$servicio = $_POST['servicio'];
$unidad = $_POST['unidad'];
$profesional = $_POST['profesional'];
$fecha_registro = date('Y-m-d');
$servicio_nombre = "";
$unidad_nombre = "";
$profesional_nombre = "";
$datos = "";

if($servicio != ""){
	//CONSULTAMOS EL NOMBRE DEL SERVICIO
	$query_servicio = "SELECT nombre
		FROM servicios WHERE servicio_id = '$servicio'";
	$result_servicio = $mysqli->query($query_servicio);
	$registro_servicio = $result_servicio->fetch_assoc();
	$servicio_nombre = "<b>Servicio:</b> ".$registro_servicio['nombre'];

	$where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf' AND a.servicio_id = '$servicio' AND a.color IN('#0071c5','#008000')";
}

if($unidad != ""){
	//CONSULTAMOS EL NOMBRE DE LA UNIDAD
	$query_unidad = "SELECT nombre
		FROM puesto_colaboradores WHERE puesto_id = '$unidad'";
	$result_unidad = $mysqli->query($query_unidad);
	$registro_unidad = $result_unidad->fetch_assoc();
	$unidad_nombre = " <b>Unidad:</b> ".$registro_unidad['nombre'];

	$where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.color IN('#0071c5','#008000')";
}

if($profesional != ""){
	//CONSULTAMOS EL NOMBRE DEL PROFESIONAL
	$query_profesional = "SELECT CONCAT(nombre,' ',apellido) AS 'profesional'
		FROM colaboradores WHERE colaborador_id = '$profesional'";
	$result_profesional = $mysqli->query($query_profesional);
	$registro_profesional = $result_profesional->fetch_assoc();
	$profesional_nombre = " <b>Profesional:</b> ".$registro_profesional['profesional'];

	$where = "WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fechai' AND '$fechaf' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$profesional' AND a.color IN('#0071c5','#008000')";
}

$query = "SELECT CONCAT(c.nombre,' ',c.apellido) AS 'profesional', COUNT(CASE WHEN DAY(a.fecha_cita) = 1 THEN a.agenda_id END) AS '1',  
	COUNT(CASE WHEN DAY(a.fecha_cita) = 2 THEN a.agenda_id END) AS '2',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 3 THEN a.agenda_id END) AS '3',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 4 THEN a.agenda_id END) AS '4',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 5 THEN a.agenda_id END) AS '5',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 6 THEN a.agenda_id END) AS '6',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 7 THEN a.agenda_id END) AS '7',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 8 THEN a.agenda_id END) AS '8',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 9 THEN a.agenda_id END) AS '9',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 10 THEN a.agenda_id END) AS '10',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 11 THEN a.agenda_id END) AS '11',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 12 THEN a.agenda_id END) AS '12',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 13 THEN a.agenda_id END) AS '13',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 14 THEN a.agenda_id END) AS '14',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 15 THEN a.agenda_id END) AS '15',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 16 THEN a.agenda_id END) AS '16',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 17 THEN a.agenda_id END) AS '17',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 18 THEN a.agenda_id END) AS '18',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 19 THEN a.agenda_id END) AS '19',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 20 THEN a.agenda_id END) AS '20',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 21 THEN a.agenda_id END) AS '21',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 22 THEN a.agenda_id END) AS '22',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 23 THEN a.agenda_id END) AS '23',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 24 THEN a.agenda_id END) AS '24',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 25 THEN a.agenda_id END) AS '25',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 26 THEN a.agenda_id END) AS '26',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 27 THEN a.agenda_id END) AS '27',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 28 THEN a.agenda_id END) AS '28',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 29 THEN a.agenda_id END) AS '29',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 30 THEN a.agenda_id END) AS '30',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 31 THEN a.agenda_id END) AS '31',
	COUNT(a.agenda_id) AS 'total'
	FROM agenda AS a
	INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
	".$where."
	GROUP BY a.colaborador_id
	ORDER BY a.fecha_cita";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
   
$nroProductos=$result->num_rows; 
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.(1).');void(0);">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual-1).');void(0);">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual+1).');void(0);">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($nroPaginas).');void(0);">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT CONCAT(c.nombre,' ',c.apellido) AS 'profesional', COUNT(CASE WHEN DAY(a.fecha_cita) = 1 THEN a.agenda_id END) AS '1',  
	COUNT(CASE WHEN DAY(a.fecha_cita) = 2 THEN a.agenda_id END) AS '2',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 3 THEN a.agenda_id END) AS '3',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 4 THEN a.agenda_id END) AS '4',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 5 THEN a.agenda_id END) AS '5',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 6 THEN a.agenda_id END) AS '6',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 7 THEN a.agenda_id END) AS '7',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 8 THEN a.agenda_id END) AS '8',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 9 THEN a.agenda_id END) AS '9',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 10 THEN a.agenda_id END) AS '10',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 11 THEN a.agenda_id END) AS '11',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 12 THEN a.agenda_id END) AS '12',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 13 THEN a.agenda_id END) AS '13',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 14 THEN a.agenda_id END) AS '14',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 15 THEN a.agenda_id END) AS '15',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 16 THEN a.agenda_id END) AS '16',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 17 THEN a.agenda_id END) AS '17',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 18 THEN a.agenda_id END) AS '18',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 19 THEN a.agenda_id END) AS '19',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 20 THEN a.agenda_id END) AS '20',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 21 THEN a.agenda_id END) AS '21',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 22 THEN a.agenda_id END) AS '22',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 23 THEN a.agenda_id END) AS '23',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 24 THEN a.agenda_id END) AS '24',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 25 THEN a.agenda_id END) AS '25',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 26 THEN a.agenda_id END) AS '26',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 27 THEN a.agenda_id END) AS '27',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 28 THEN a.agenda_id END) AS '28',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 29 THEN a.agenda_id END) AS '29',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 30 THEN a.agenda_id END) AS '30',
	COUNT(CASE WHEN DAY(a.fecha_cita) = 31 THEN a.agenda_id END) AS '31',
	COUNT(a.agenda_id) AS 'total'
	FROM agenda AS a
	INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
	".$where."
	GROUP BY a.colaborador_id
	ORDER BY a.fecha_cita ASC LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $servicio_nombre.$unidad_nombre.$profesional_nombre;

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
		  <tr>
		  <th width="3%">No.</th>
		  <th width="21%">Profesional</th>
		  <th width="2%">1</th>
		  <th width="2%">2</th>
		  <th width="2%">3</th>
		  <th width="2%">4</th>
		  <th width="2%">5</th>
		  <th width="2%">6</th>
		  <th width="2%">7</th>
		  <th width="2%">8</th>
		  <th width="2%">9</th>
		  <th width="2%">10</th>
		  <th width="2%">11</th>
		  <th width="2%">12</th>
		  <th width="2%">13</th>
		  <th width="2%">14</th>
		  <th width="2%">15</th>
		  <th width="2%">16</th>
		  <th width="2%">17</th>
		  <th width="2%">18</th>
		  <th width="2%">19</th>
		  <th width="2%">20</th>
		  <th width="2%">21</th>
		  <th width="2%">22</th>
		  <th width="2%">23</th>
		  <th width="2%">24</th>
		  <th width="2%">25</th>
		  <th width="2%">26</th>
		  <th width="2%">27</th>
		  <th width="2%">28</th>
		  <th width="2%">29</th>
		  <th width="2%">30</th>
		  <th width="2%">31</th>
		  <th width="4%">Total</th>
	</tr>';
			
$i=1;			
while($registro2 = $result->fetch_assoc()){	   	
	$tabla = $tabla.'<tr>
	   <td>'.$i.'</td>
	   <td>'.$registro2['profesional'].'</td>
	   <td>'.$registro2['1'].'</td>		
	   <td>'.$registro2['2'].'</td>		
	   <td>'.$registro2['3'].'</td>		
	   <td>'.$registro2['4'].'</td>		
	   <td>'.$registro2['5'].'</td>		
	   <td>'.$registro2['6'].'</td>		
	   <td>'.$registro2['7'].'</td>		
	   <td>'.$registro2['8'].'</td>		
	   <td>'.$registro2['9'].'</td>		
	   <td>'.$registro2['10'].'</td>		
	   <td>'.$registro2['11'].'</td>		
	   <td>'.$registro2['12'].'</td>		
	   <td>'.$registro2['13'].'</td>		
	   <td>'.$registro2['14'].'</td>		
	   <td>'.$registro2['15'].'</td>		
	   <td>'.$registro2['16'].'</td>		
	   <td>'.$registro2['17'].'</td>		
	   <td>'.$registro2['18'].'</td>		
	   <td>'.$registro2['19'].'</td>		
	   <td>'.$registro2['20'].'</td>		
	   <td>'.$registro2['21'].'</td>		
	   <td>'.$registro2['22'].'</td>		
	   <td>'.$registro2['23'].'</td>		
	   <td>'.$registro2['24'].'</td>		
	   <td>'.$registro2['25'].'</td>		
	   <td>'.$registro2['26'].'</td>		
	   <td>'.$registro2['27'].'</td>		
	   <td>'.$registro2['28'].'</td>		
	   <td>'.$registro2['29'].'</td>		
	   <td>'.$registro2['30'].'</td>		   
	   <td>'.$registro2['13'].'</td>
	   <td>'.$registro2['total'].'</td>
  </tr>';		
  $i++;
}
  
if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="34" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="34"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>