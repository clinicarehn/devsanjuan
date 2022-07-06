<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$servicio = $_POST['servicio'];
$año = $_POST['año'];
$mes = $_POST['mes'];
$color_neto = '#083BF7';
$color_porcentaje = '#087623';

if($año == null || $año == ""){
	$año = date("Y");
}

if($servicio == ""){
    $where = "WHERE YEAR(a.fecha) = '$año'";
    $group_by = "GROUP BY s.servicio_id, a.enfermedades_id, a.paciente";		
}else{
	if($servicio == 0 && $mes == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
		$group_by = "GROUP BY a.enfermedades_id, a.paciente";	
    }else{
		$where = "WHERE YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
        $group_by = "GROUP BY a.enfermedades_id, a.paciente";			
	}	
}

$query = "SELECT s.nombre AS 'servicio', a.paciente, e.nombre AS 'enfermedad',
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.enfermedades_id END) AS 'enero',
COUNT(CASE WHEN MONTH(a.fecha) = 2 THEN a.enfermedades_id END) AS 'febrero',
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.enfermedades_id END) AS 'marzo',
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.enfermedades_id END) AS 'abril',
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.enfermedades_id END) AS 'mayo',
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.enfermedades_id END) AS 'junio',
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.enfermedades_id END) AS 'julio',
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.enfermedades_id END) AS 'agosto',
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.enfermedades_id END) AS 'septiembre',
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.enfermedades_id END) AS 'octubre',
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.enfermedades_id END) AS 'noviembre',
COUNT(CASE WHEN MONTH(a.fecha) = 12 THEN a.enfermedades_id END) AS 'diciembre',
COUNT(a.enfermedades_id) AS 'total'
FROM ata AS a
INNER JOIN enfermedades AS e
ON a.enfermedades_id = e.enfermedades_id
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
".$where." 
".$group_by;

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
		
$nroLotes = 20;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_enfermedades('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
  $lista = $lista.'<li><a href="javascript:pagination_enfermedades('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}
    
if($paginaActual < $nroPaginas){
   $lista = $lista.'<li><a href="javascript:pagination_enfermedades('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_enfermedades('.($nroPaginas).');">Ultima</a></li>';
 }
  
if($paginaActual <= 1){
   $limit = 0;
}else{
   $limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT s.nombre AS 'servicio', a.paciente, e.nombre AS 'enfermedad',
COUNT(CASE WHEN MONTH(a.fecha) = 1 THEN a.enfermedades_id END) AS 'enero',
COUNT(CASE WHEN MONTH(a.fecha) = 2 THEN a.enfermedades_id END) AS 'febrero',
COUNT(CASE WHEN MONTH(a.fecha) = 3 THEN a.enfermedades_id END) AS 'marzo',
COUNT(CASE WHEN MONTH(a.fecha) = 4 THEN a.enfermedades_id END) AS 'abril',
COUNT(CASE WHEN MONTH(a.fecha) = 5 THEN a.enfermedades_id END) AS 'mayo',
COUNT(CASE WHEN MONTH(a.fecha) = 6 THEN a.enfermedades_id END) AS 'junio',
COUNT(CASE WHEN MONTH(a.fecha) = 7 THEN a.enfermedades_id END) AS 'julio',
COUNT(CASE WHEN MONTH(a.fecha) = 8 THEN a.enfermedades_id END) AS 'agosto',
COUNT(CASE WHEN MONTH(a.fecha) = 9 THEN a.enfermedades_id END) AS 'septiembre',
COUNT(CASE WHEN MONTH(a.fecha) = 10 THEN a.enfermedades_id END) AS 'octubre',
COUNT(CASE WHEN MONTH(a.fecha) = 11 THEN a.enfermedades_id END) AS 'noviembre',
COUNT(CASE WHEN MONTH(a.fecha) = 12 THEN a.enfermedades_id END) AS 'diciembre',
COUNT(a.enfermedades_id) AS 'total'
FROM ata AS a
INNER JOIN enfermedades AS e
ON a.enfermedades_id = e.enfermedades_id
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
".$where." 
".$group_by." LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="21.25%">Servicio</th>
		<th width="3.25%">Paciente</th>
		<th width="6.25%">Enfermedad</th>
		<th width="5.25%">Enero</th>		
		<th width="5.25%">Febrero</th>
		<th width="5.25%">Marzo</th>
		<th width="5.6%">Abril</th>
		<th width="5.25%">Mayo</th>
		<th width="5.25%">Junio</th>
		<th width="5.25%">Julio</th>
		<th width="5.25%">Agosto</th>
		<th width="5.25%">Septiembre</th>
		<th width="5.25%">Octubre</th>
		<th width="5.25%">Noviembre</th>
		<th width="5.25%">Diciembre</th>		
		<th width="6.25%">Total</th>
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
		<td>'.$registro2['paciente'].'</td>
		<td>'.$registro2['enfermedad'].'</td>
		<td>'.number_format($registro2['enero']).'</td>		
        <td>'.number_format($registro2['febrero']).'</td>		
		<td>'.number_format($registro2['marzo']).'</td>
        <td>'.number_format($registro2['abril']).'</td>
		<td>'.number_format($registro2['mayo']).'</td>
		<td>'.number_format($registro2['junio']).'</td>
		<td>'.number_format($registro2['julio']).'</td>
		<td>'.number_format($registro2['agosto']).'</td>
		<td>'.number_format($registro2['septiembre']).'</td>
		<td>'.number_format($registro2['octubre']).'</td>
		<td>'.number_format($registro2['noviembre']).'</td>
		<td>'.number_format($registro2['diciembre']).'</td>
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['total']).'</b></td>
	 </tr>';					
  }	
}else{
	$tabla = $tabla.'<tr>
	   <td colspan="4" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';	
}	
   
$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
 			   1 => $lista);

echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>