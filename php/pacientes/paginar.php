<?php
header("Content-Type: text/html;charset=utf-8");

include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');	
$paginaActual = $_POST['partida'];
$estado = $_POST['estado'];
$paciente = $_POST['paciente'];
$dato = $_POST['dato'];

$query_row = "SELECT DISTINCT p.pacientes_id AS pacientes_id, p.expediente AS expediente, CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', 
	 p.identidad AS identidad, p.sexo AS sexo, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, p.telefono AS telefono,
	 p.telefono1 AS telefono1, p.telefonoresp AS telefonoresp,
	 p.telefonoresp1 AS telefonoresp1, d.nombre AS departamento, m.nombre AS municipio, p.localidad AS localidad
	 FROM pacientes AS p
	 LEFT JOIN departamentos AS d
	 ON p.departamento_id = d.departamento_id
	 LEFT JOIN municipios AS m
	 ON p.municipio_id = m.municipio_id 
	WHERE p.status = '$estado' AND p.tipo = '$paciente' AND (p.expediente LIKE '$dato%' OR p.nombre LIKE '$dato%' OR p.apellido LIKE '$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.telefono1 LIKE '$dato%' OR p.identidad LIKE '$dato%')
	ORDER BY p.expediente";	
$result = $mysqli->query($query_row);     

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

$query = "SELECT DISTINCT p.pacientes_id AS pacientes_id, p.expediente AS expediente, CONCAT(p.apellido, ' ', p.nombre) AS 'paciente_nombre', 
	 p.identidad AS identidad, p.sexo AS sexo, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, p.telefono AS telefono,
	 p.telefono1 AS telefono1, p.telefonoresp AS telefonoresp,
	 p.telefonoresp1 AS telefonoresp1, d.nombre AS departamento, m.nombre AS municipio, p.localidad AS localidad
	 FROM pacientes AS p
	 LEFT JOIN departamentos AS d
	 ON p.departamento_id = d.departamento_id
	 LEFT JOIN municipios AS m
	 ON p.municipio_id = m.municipio_id 
	WHERE p.status = '$estado' AND p.tipo = '$paciente' AND (p.expediente LIKE '$dato%' OR p.nombre LIKE '$dato%' OR p.apellido LIKE '$dato%' OR CONCAT(p.apellido,' ',p.nombre) LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.telefono1 LIKE '$dato%' OR p.identidad LIKE '$dato%')
	ORDER BY p.expediente LIMIT $limit, $nroLotes
";
$result = $mysqli->query($query);    
  
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
					<tr>
					   <th width="2.33%">Expediente</th>
					   <th width="31.99%">Nombre</th>
					   <th width="6.33%">Identidad</th>
					   <th width="3.33%">Sexo</th>	
					   <th width="6.33%">Nacimiento</th>
					   <th width="5.33%">Teléfono1</th>
					   <th width="5.33%">Teléfono2</th>						   
					   <th width="11.33%">Departamento</th>	
					   <th width="11.33%">Municipio</th>							   
					   <th width="17.33%">Opciones</th>
					</tr>';

$i=1;						
while($registro2 = $result->fetch_assoc()){
  if($registro2['telefono1'] == 0 || $registro2['telefono1'] == ""){
	  $telefono1 = "";
  }else{
	  $telefono1 = $registro2['telefono1'];  
  }
  
  if($registro2['telefonoresp'] == 0 || $registro2['telefonoresp'] == ""){
	  $telefonoresp = "";
  }else{
	  $telefonoresp = $registro2['telefonoresp'];  
  }	  
  
  if($registro2['telefonoresp1'] == 0 || $registro2['telefonoresp1'] == ""){
	  $telefonoresp1 = "";
  }else{
	  $telefonoresp1 = $registro2['telefonoresp1'];  
  }	  	  
  
  if ($registro2['expediente'] == 0){
	  $expediente = "TEMP"; 
  }else{
	  $expediente = $registro2['expediente'];
  }
  
  if($registro2['sexo'] == 'H'){
	$sexo = 'Hombre';
  }else{
	 $sexo = 'Mujer';
  }
  
  $fecha_nacimiento = $registro2['fecha_nacimiento'];
  $telefono = $registro2['telefono'];
  
	$tabla = $tabla.'<tr>
	   <td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:showExpediente('.$registro2['pacientes_id'].');">'.$expediente.'</a></td>		
	   <td>'.$registro2['paciente_nombre'].'</td>
	   <td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:detallesUsuario('.$registro2['pacientes_id'].');">'.$registro2['identidad'].'</a></td>		
	   <td>'.$sexo.'</td>
	   <td>'.$fecha_nacimiento.'</td>	
	   <td><a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$telefono.'">'.$telefono.'</a></td>	
	   <td><a style="text-decoration:none" title = "Teléfono Usuario" href="tel:9'.$telefono1.'">'.$telefono1.'</a></td>
	   <td>'.$registro2['departamento'].'</td>
	   <td>'.$registro2['municipio'].'</td> 		   
	   <td>
		   <a style="text-decoration:none;" title = "Asignar Expediente a Usuario" href="javascript:modal_agregar_expediente('.$registro2['pacientes_id'].','.$registro2['expediente'].');void(0);" class="fas fa-plus fa-lg"></a>
		   <a style="text-decoration:none;" title = "Asignar Expediente a Usuario de Forma Manual" href="javascript:modal_agregar_expediente_manual('.$registro2['pacientes_id'].','.$registro2['expediente'].');void(0);" class="fas fa-pencil-alt fa-lg"></a>
		   <a style="text-decoration:none;" title = "Transferir Usuario Activo/Pasivo" href="javascript:modal_transferirUsuario('.$registro2['pacientes_id'].','.$registro2['expediente'].');void(0);" class="fas fa-exchange-alt fa-lg"></a>			   
		   <a style="text-decoration:none;" title = "Editar Usuario" href="javascript:editarRegistro('.$registro2['pacientes_id'].');void(0);" class="fas fa-edit fa-lg"></a>
		   <a style="text-decoration:none;" title = "Eliminar Usuario" href="javascript:modal_eliminar('.$registro2['pacientes_id'].');void(0);" class="fas fa-trash fa-lg"></a>
	   </td>		              		  
	</tr>';
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="12" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="12"><b><p ALIGN="center">Total de Registros Encontrados '.number_format($nroProductos).'</p></b>
   </tr>';		
}   

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);
?>