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
$colaborador_usuario = $_POST['colaborador_usuario'];	

if($servicio != "" && $unidad == "" && $profesional == "" && $colaborador_usuario == ""){
	$where = "WHERE ex.fecha BETWEEN '$desde' AND '$hasta' AND ex.servicio_id = '$servicio' AND (CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == "" && $colaborador_usuario == ""){
   $where = "WHERE ex.fecha BETWEEN '$desde' AND '$hasta' AND pc.puesto_id = '$unidad ' AND ex.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else if ($servicio != "" && $unidad != "" && $profesional != "" && $colaborador_usuario == ""){
   $where = "WHERE ex.fecha BETWEEN '$desde' AND '$hasta' AND pc.puesto_id = '$unidad ' and ex.colaborador_id = '$profesional' AND ex.servicio_id = '$servicio' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}else{
   $where = "WHERE ex.fecha BETWEEN '$desde' AND '$hasta' AND pc.puesto_id = '$unidad ' AND ex.servicio_id = '$servicio' AND ex.usuario = '$colaborador_usuario' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}
		
$query = "SELECT ex.pacientes_id AS 'pacientes_id', ex.extem_id AS 'extem_id', CAST(ex.fecha AS DATE) AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.expediente AS 'expediente', p.identidad AS 'identidad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
   (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', (CASE WHEN ex.tipo_cita = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN ex.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', pc.nombre AS 'puesto', CONCAT(c.apellido,' ',c.nombre) AS 'profesional', s.nombre AS 'servicio',  CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', ex.observaciones AS 'observaciones'
	FROM extemporaneos AS ex
	INNER JOIN pacientes AS p
	ON ex.pacientes_id = p.pacientes_id
	INNER JOIN departamentos AS d
	ON p.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON p.municipio_id = m.municipio_id
	INNER JOIN colaboradores AS c
	ON ex.colaborador_id = c.colaborador_id
	INNER JOIN colaboradores AS c1
	ON ex.usuario = c1.colaborador_id
	INNER JOIN servicios AS s
	ON ex.servicio_id = s.servicio_id
	INNER JOIN puesto_colaboradores AS pc
	ON c.puesto_id = pc.puesto_id
	".$where."
	ORDER BY ex.fecha ASC";	
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


$registro = "SELECT ex.pacientes_id AS 'pacientes_id', ex.extem_id AS 'extem_id', CAST(ex.fecha AS DATE) AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.expediente AS 'expediente', p.identidad AS 'identidad', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h',
	(CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', (CASE WHEN ex.tipo_cita = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN ex.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', pc.nombre AS 'puesto', CONCAT(c.apellido,' ',c.nombre) AS 'profesional', s.nombre AS 'servicio',  CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', ex.observaciones AS 'observaciones'
	FROM extemporaneos AS ex
	INNER JOIN pacientes AS p
	ON ex.expediente = p.expediente
	INNER JOIN departamentos AS d
	ON p.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON p.municipio_id = m.municipio_id
	INNER JOIN colaboradores AS c
	ON ex.colaborador_id = c.colaborador_id
	INNER JOIN colaboradores AS c1
	ON ex.usuario = c1.colaborador_id
	INNER JOIN servicios AS s
	ON ex.servicio_id = s.servicio_id
	INNER JOIN puesto_colaboradores AS pc
	ON c.puesto_id = pc.puesto_id
	".$where."
	ORDER BY ex.fecha
	LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8.14%">Fecha</th>
			<th width="17.14%">Nombre</th>				
			<th width="5.14%">Expediente</th>
			<th width="7.14%">Identidad</th>				
			<th width="2.14%">H</th>
			<th width="2.4%">M</th>
			<th width="2.14%">N</th>				
			<th width="2.14%">S</th>
			<th width="9.14%">Unidad</th>				
			<th width="10.14%">Profesional</th>		
			<th width="8.14%">Servicio</th>
			<th width="12.14%">Observaciones</th>
			<th width="7.14%">Usuario</th>				
			<th width="7.14%">Opciones</th>					
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
	   <td>'.$registro2['puesto'].'</td>
	   <td>'.$registro2['profesional'].'</td>
	   <td>'.$registro2['servicio'].'</td>			   
	   <td>'.$registro2['observaciones'].'</td>	
	   <td>'.$registro2['usuario'].'</td>			   
	   <td>
		   <a title = "Eliminar Registro" href="javascript:modal_eliminarExtemporaneos('.$registro2['extem_id'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-trash fa-lg" style="text-decoration:none;"></a>
	   </td>			   
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