<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$unidad = $_POST['unidad'];
$colaborador = $_POST['colaborador_usuario'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];	
	
$where = "WHERE CAST(p.fecha AS DATE) BETWEEN '$desde' AND '$hasta' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		

$query = "SELECT p.pacientes_id AS 'pacientes_id', DATE_FORMAT(CAST(p.fecha AS DATE ), '%d/%m/%Y') AS 'fecha', p.identidad AS 'identidad', 
   CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', 
  (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', CONCAT(c.nombre,' ',c.apellido) AS 'usuario', d.nombre AS 'departamento', 
   m.nombre AS 'municipio', p.telefono AS 'telefono', p.telefono1 AS 'telefono1', p.tipo AS 'tipo', p.fecha_nacimiento AS 'fecha_nacimiento'
   FROM pacientes AS p
   INNER JOIN colaboradores AS c
   ON p.usuario = c.colaborador_id
   INNER JOIN departamentos AS d
   ON p.departamento_id = d.departamento_id
   INNER JOIN municipios AS m
   ON p.municipio_id = m.municipio_id	   
   ".$where."
   ORDER BY p.fecha ASC";
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

$registro = "SELECT p.pacientes_id AS 'pacientes_id', DATE_FORMAT(CAST(p.fecha AS DATE ), '%d/%m/%Y') AS 'fecha', p.identidad AS 'identidad', 
   CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.expediente AS 'expediente', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', 
  (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', CONCAT(c.nombre,' ',c.apellido) AS 'usuario', d.nombre AS 'departamento', 
   m.nombre AS 'municipio', p.telefono AS 'telefono', p.telefono1 AS 'telefono1', p.tipo AS 'tipo', p.fecha_nacimiento AS 'fecha_nacimiento'
   FROM pacientes AS p
   INNER JOIN colaboradores AS c
   ON p.usuario = c.colaborador_id
   INNER JOIN departamentos AS d
   ON p.departamento_id = d.departamento_id
   INNER JOIN municipios AS m
   ON p.municipio_id = m.municipio_id  	   
   ".$where."
   ORDER BY p.fecha ASC
   LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="6.69%" title="Fecha de Creación de Usuario">Fecha</th>
			<th width="20.69%">Nombre</th>				
			<th width="5.69%">Expediente</th>
			<th width="7.69%">Identidad</th>				
			<th width="1.69%">H</th>
			<th width="1.69%">M</th>
			<th width="2.69">Edad</th>
			<th width="7.69">Telefono</th>
			<th width="7.69">Telefono</th>
			<th width="10.69%">Departamento</th>
			<th width="9.69%">Municipio</th>				
			<th width="9.69%">Usuario</th>	
			<th width="7.69%">Tipo</th>					
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){			

	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
	
	if($registro2['telefono'] != ""){
	 $telefonousuario = '<a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$registro2['telefono'].'">'.$registro2['telefono'].'</a>'; 
	}
  
	if($registro2['telefono1'] != ""){
		$telefonousuario1 = '<a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$registro2['telefono1'].'">'.$registro2['telefono1'].'</a>'; 
	}else{
	   $telefonousuario1 = ''; 
	}		
	
	if($registro2['tipo'] == 1){
		$tipo = "Paciente";
	}else{
		$tipo = "Familiar";
	}
   
	$fecha_de_nacimiento = $registro2['fecha_nacimiento'];
   
	//OBTENER LA EDAD DEL USUARIO 
	/*********************************************************************************/
	$valores_array = getEdad($fecha_de_nacimiento);
	$anos = $valores_array['anos'];
	/*********************************************************************************/	
	
	$tabla = $tabla.'<tr>
	   <td title="Fecha de Creación de Usuario">'.$registro2['fecha'].'</a></td>   
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$expediente .'</td>
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['h'].'</td>
	   <td>'.$registro2['m'].'</td>
	   <td>'.$anos.'</td>
	   <td>'.$telefonousuario.'</td> 
	   <td>'.$telefonousuario1.'</td> 
	   <td>'.$registro2['departamento'].'</td>
	   <td>'.$registro2['municipio'].'</td>
	   <td>'.$registro2['usuario'].'</td>
	   <td>'.$tipo.'</td>		   
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="13"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>