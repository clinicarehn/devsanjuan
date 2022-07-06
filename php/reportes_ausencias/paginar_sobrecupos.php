<?php 
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$servicio = $_POST['servicio'];
$unidad = $_POST['unidad'];
$profesional = $_POST['profesional'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];	
$reporte = $_POST['reporte'];	
$colaborador_usuario = $_POST['colaborador_usuario'];
	
if($servicio != "" && $unidad == "" && $profesional == ""){
	$where = "WHERE so.fecha BETWEEN '$desde' AND '$hasta' AND so.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == ""){
   $where = "WHERE so.fecha BETWEEN '$desde' AND '$hasta' AND so.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else{
   $where = "WHERE so.fecha BETWEEN '$desde' AND '$hasta' AND so.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}

	$query = "SELECT DISTINCT DATE_FORMAT(CAST(so.fecha_registro AS DATE ), '%d/%m/%Y') AS 'fecha_registro', DATE_FORMAT(so.fecha, '%d/%m/%Y') AS 'fecha', p.identidad AS 'identidad', p.expediente AS 'expediente', CONCAT(p.apellido,' ',p.nombre) AS  'nombre', so.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', (CASE WHEN so.tipo_cita = 'N' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN so.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente'
	FROM sobrecupo AS so
	INNER JOIN pacientes AS p
	ON so.expediente = p.expediente
	INNER JOIN colaboradores AS c
	ON so.colaborador_id = c.colaborador_id
	INNER JOIN servicios s
	ON so.servicio_id = s.servicio_id
	".$where."	 	   
	ORDER BY so.fecha ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
	 
 
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_ausencias('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}	

	$registro = "SELECT DISTINCT DATE_FORMAT(CAST(so.fecha_registro AS DATE ), '%d/%m/%Y') AS 'fecha_registro', DATE_FORMAT(so.fecha, '%d/%m/%Y') AS 'fecha', p.identidad AS 'identidad', p.expediente AS 'expediente', CONCAT(p.apellido,' ',p.nombre) AS  'nombre', so.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', (CASE WHEN so.tipo_cita = 'N' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN so.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente'
	FROM sobrecupo AS so
	INNER JOIN pacientes AS p
	ON so.expediente = p.expediente
	INNER JOIN colaboradores AS c
	ON so.colaborador_id = c.colaborador_id
	INNER JOIN servicios s
	ON so.servicio_id = s.servicio_id
	".$where."		   
   ORDER BY so.fecha ASC
   LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="10%">Fecha</th>			
			<th width="25%">Nombre</th>				
			<th width="10%">Expediente</th>
			<th width="10%">Identidad</th>				
			<th width="2%">H</th>
			<th width="2%">M</th>	
			<th width="2%">N</th>
			<th width="2%">S</th>			
			<th width="18%">Servicio</th>
			<th width="19%">Profesional</th>											
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){			

	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
			
	$tabla = $tabla.'<tr>
	   <td>'.$registro2['fecha'].'</a></td>  		  		   
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$expediente.'</td>
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['h'].'</td>
	   <td>'.$registro2['m'].'</td>
	   <td>'.$registro2['nuevo'].'</td>
	   <td>'.$registro2['subsiguiente'].'</td>		   
	   <td>'.$registro2['servicio'].'</td>
	   <td>'.$registro2['medico'].'</td>		   
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="14" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="15"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>