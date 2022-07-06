<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();	

date_default_timezone_set('America/Tegucigalpa');
$paginaActual = $_POST['partida'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];
$servicio = $_POST['servicio'];
$unidad = $_POST['unidad'];
$profesional = $_POST['profesional'];
$estado = $_POST['estado'];

if($servicio != "" && $unidad == "" && $profesional == "" AND $estado != ""){
	$where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%')";		
}else if($servicio != "" && $unidad != "" && $profesional == "" AND $estado != ""){
	$where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio' AND h.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%')";		
}else{
	$where = "WHERE h.estado = '$estado' AND  h.fecha BETWEEN '$desde' AND '$hasta' AND h.servicio_id = '$servicio' AND h.puesto_id = '$unidad' AND h.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%')";		
}	

$query = "SELECT h.hosp_id AS 'hosp_id', DATE_FORMAT(h.fecha, '%d/%m/%Y') AS 'fecha', p.expediente AS 'expediente', CONCAT(p.nombre,' ',p.apellido) AS 'paciente_nombre', (CASE WHEN h.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN h.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', CONCAT(c.nombre,' ',c.apellido) AS 'profesional', s.nombre AS 'servicio', h.observacion AS 'observacion', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', p.identidad AS 'identidad'
   FROM hospitalizacion AS h
   INNER JOIN pacientes AS p
   ON h.expediente = p.expediente
   INNER JOIN colaboradores AS c
   ON h.colaborador_id = c.colaborador_id
   INNER JOIN servicios AS s
   ON h.servicio_id = s.servicio_id
   ".$where."
   ORDER BY h.fecha, h.expediente";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
  
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT h.hosp_id AS 'hosp_id', DATE_FORMAT(h.fecha, '%d/%m/%Y') AS 'fecha', p.expediente AS 'expediente', CONCAT(p.nombre,' ',p.apellido) AS 'paciente_nombre', (CASE WHEN h.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN h.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', CONCAT(c.nombre,' ',c.apellido) AS 'profesional', s.nombre AS 'servicio', h.observacion AS 'observacion', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', p.identidad AS 'identidad'
   FROM hospitalizacion AS h
   INNER JOIN pacientes AS p
   ON h.expediente = p.expediente
   LEFT JOIN colaboradores AS c
   ON h.colaborador_id = c.colaborador_id
   INNER JOIN servicios AS s
   ON h.servicio_id = s.servicio_id
   ".$where."
   ORDER BY h.fecha, h.expediente
   LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8.33%">Fecha</th>
			<th width="22.33%">Usuario</th>
			<th width="8.33%">Expediente</th>
			<th width="8.33%">Identidad</th>				
			<th width="2.33%">H</th>
			<th width="2.33%">M</th>	
			<th width="2.33%">N</th>
			<th width="2.33%">S</th>				
			<th width="13.33%">Profesional</th>
			<th width="13.33%">Servicio</th>
			<th width="12.33%">Observación</th>
			<th width="4.33%">Opciones</th>
			</tr>';
			
while($registro2 = $result->fetch_assoc()){	
	if($registro2['profesional'] == ''){
		$profesional = 'Sin asignar';
	}else{
		$profesional = $registro2['profesional'];
	}
	
	$tabla = $tabla.'<tr>
			<td>'.$registro2['fecha'].'</td>					
			<td>'.$registro2['paciente_nombre'].'</td>
			<td>'.$registro2['expediente'].'</td>				
			<td>'.$registro2['identidad'].'</td>				
			<td>'.$registro2['h'].'</td>
			<td>'.$registro2['m'].'</td>				
			<td>'.$registro2['nuevo'].'</td>
			<td>'.$registro2['subsiguiente'].'</td>
			<td>'.$profesional.'</td>
			<td>'.$registro2['servicio'].'</td>
			<td>'.$registro2['observacion'].'</td>				
			<td>                  				  
			  <a title = "Eliminar Registro" href="javascript:modal_eliminar('.$registro2['hosp_id'].','.$registro2['expediente'].','.$registro2['fecha'].');void(0);" class="glyphicon glyphicon glyphicon-trash" style="text-decoration:none;"></a>
			</td>					
		</tr>';					
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan=12" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="12"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>