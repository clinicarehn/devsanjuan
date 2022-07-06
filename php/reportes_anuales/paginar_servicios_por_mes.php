<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$servicio = $_POST['servicio'];
$mes = $_POST['mes'];
$año = $_POST['año'];
$color_neto = '#083BF7';

if($año == null || $año == ""){
	$año = date("Y");
}

if($servicio == ""){
	$where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año'";
    $group_by = "GROUP BY a.servicio_id, pc.puesto_id";	
}else{
	if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
		$group_by = "GROUP BY pc.puesto_id";
    }else{
	    $where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
		$group_by = "GROUP BY a.servicio_id, pc.puesto_id";	
	}	
}
	
$query = "SELECT s.nombre AS 'servicio', pc.nombre AS 'unidad',
COUNT(CASE WHEN a.paciente = 'N' THEN a.paciente END) AS 'nuevo', 
COUNT(CASE WHEN a.paciente = 'S' THEN a.paciente END) AS 'sub', 
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'H',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'M',
COUNT(CASE WHEN MONTH(a.fecha) = '$mes' THEN a.paciente END) AS 'total'
FROM ata AS a
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where." 
".$group_by."
ORDER BY s.nombre";

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
		
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_detallado('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
  $lista = $lista.'<li><a href="javascript:pagination_detallado('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}
    
if($paginaActual < $nroPaginas){
   $lista = $lista.'<li><a href="javascript:pagination_detallado('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_detallado('.($nroPaginas).');">Ultima</a></li>';
 }
  
if($paginaActual <= 1){
   $limit = 0;
}else{
   $limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT s.nombre AS 'servicio', pc.nombre AS 'unidad',
COUNT(CASE WHEN a.paciente = 'N' THEN a.paciente END) AS 'nuevo', 
COUNT(CASE WHEN a.paciente = 'S' THEN a.paciente END) AS 'sub', 
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'H',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'M',
COUNT(CASE WHEN MONTH(a.fecha) = '$mes' THEN a.paciente END) AS 'total'
FROM ata AS a
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where." 
".$group_by."
ORDER BY s.nombre LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);
		
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="24.28%">Servicio</th>
        <th width="24.28%">Unidad</th>
    	<th width="10.28%">Nuevos</th>
		<th width="10.28%">Subsiguientes</th>
    	<th width="10.28%">Hombre</th>
		<th width="10.28%">Mujer</th>		
		<th width="10.28%">Total</th>
	</tr>';			
	
if($nroProductos>0){	
  while($registro2 = $result->fetch_assoc()){
	 if($servicio == ""){
		 $servicio_ = $registro2['servicio'];
	 }else if($servicio != 0){
		 $servicio_ = $registro2['servicio'];
	 }else{
		 $servicio_ = "Consulta Externa General";		 
	 }
	 
	 $tabla = $tabla.'<tr>			
		<td>'.$servicio_.'</td>
		<td>'.$registro2['unidad'].'</td>	
		<td>'.number_format($registro2['nuevo']).'</td>
		<td>'.number_format($registro2['sub']).'</td>
		<td>'.number_format($registro2['H']).'</td>
		<td>'.number_format($registro2['M']).'</td>		
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['total']).'</b></td>		
	 </tr>';					
  }	
}else{
	$tabla = $tabla.'<tr>
	   <td colspan="6" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';	
}	
   
$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
 			   1 => $lista);

echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>