<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');

$paginaActual = $_POST['partida'];
$postclinica_id = $_POST['postclinica_id'];
$expediente = $_POST['expediente'];
	
$query = "SELECT postd.medicamento As 'medicamento', postd.dosis As 'dosis', postd.via As 'via', postd.frecuencia As 'frecuencia', postd.recomendaciones AS 'recomendaciones', v.nombre AS 'via'
  FROM postclinica_detalle AS postd
  INNER JOIN postclinica AS post
  ON postd.postclinica_id = post.postclinica_id
  INNER JOIN via AS v
  ON postd.via = v.via_id
  WHERE postd.postclinica_id = '$postclinica_id'
  ORDER BY postd.postclinica_id ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
  
$nroLotes = 5;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

//No esta disponible esta opcion, ya que no se paginaran los resultados
if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination_preclinica('.($paginaActual-1).');">Anterior</a></li>';
}
for($i=1; $i<=$nroPaginas; $i++){
	if($i == $paginaActual){
		$lista = $lista.'<li class="active"><a href="javascript:pagination_preclinica('.$i.');">'.$i.'</a></li>';
	}else{
		$lista = $lista.'<li><a>'.$i.'</a></li>';
	}
}
if($paginaActual < $nroPaginas){
	$lista = $lista.'<li><a href="javascript:pagination_preclinica('.($paginaActual+1).');">Siguiente</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

//Finaliza la opcion la cual no esta disponible para paginacion;

$registro = "SELECT postd.medicamento As 'medicamento', postd.dosis As 'dosis', postd.via As 'via', postd.frecuencia As 'frecuencia', postd.recomendaciones AS 'recomendaciones', v.nombre AS 'via'
  FROM postclinica_detalle AS postd
  INNER JOIN postclinica AS post
  ON postd.postclinica_id = post.postclinica_id
  INNER JOIN via AS v
  ON postd.via = v.via_id	  
  WHERE postd.postclinica_id = '$postclinica_id'
  ORDER BY postd.postclinica_id
  LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$consultar_datos = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'nombre', post.expediente AS 'expediente', p.identidad AS 'identidad'
   FROM postclinica AS post
   INNER JOIN pacientes AS p
   ON post.expediente = p.expediente
   WHERE post.expediente = '$expediente'";
$result_datos= $mysqli->query($consultar_datos);
   
$consultar_datos2 = $result_datos->fetch_assoc();
$nombre = $consultar_datos2['nombre'];
$expediente = $consultar_datos2['expediente'];
$identidad = $consultar_datos2['identidad'];

$tabla = $tabla."<div class='row'>
	<div class='col-md-6'><b>Nombre:</b> $nombre</div>
	<div class='col-md-2'><b>Exp:</b> $expediente</div>
	<div class='col-md-4'><b>Identidad:</b> $identidad</div>		
</div>";	

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="20%">Medicamento</th>
			<th width="20%">Dosis</th>				
			<th width="20%">Vía</th>
			<th width="20%">Frecuencia</th>
			<th width="20%">Recomendaciones</th>				
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){	
	$tabla = $tabla.'<tr>		 
	   <td>'.$registro2['medicamento'].'</td>
	   <td>'.$registro2['dosis'].'</td>		   
	   <td>'.$registro2['via'].'</td>
	   <td>'.$registro2['frecuencia'].'</td>		   
	   <td>'.$registro2['recomendaciones'].'</td>		   
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