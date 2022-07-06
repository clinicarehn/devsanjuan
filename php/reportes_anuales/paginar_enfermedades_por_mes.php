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
	$where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año'";	
	$group_by = "GROUP BY a.enfermedades_id, a.paciente";	
}else{
	if($servicio == 0){//CONSULTA EXTERNA GENERAL
	    $where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
		$group_by = "GROUP BY a.enfermedades_id, a.paciente";
    }else{
	    $where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
        $group_by = "GROUP BY a.enfermedades_id, a.paciente";
	}	
}

$query = "SELECT s.nombre AS 'servicio', a.paciente AS 'paciente', e.nombre AS 'enfermedad', COUNT(a.enfermedades_id) AS 'total'
FROM ata AS a
INNER JOIN enfermedades AS e
ON a.enfermedades_id = e.enfermedades_id
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
".$where." 
".$group_by;

$result_query = $mysqli->query($query);
$nroProductos = $result_query->num_rows;
		
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

$registro = "SELECT s.nombre AS 'servicio', a.paciente AS 'paciente', e.nombre AS 'enfermedad', COUNT(a.enfermedades_id) AS 'total'
FROM ata AS a
INNER JOIN enfermedades AS e
ON a.enfermedades_id = e.enfermedades_id
INNER JOIN servicios AS s
ON a.servicio_id = s.servicio_id
".$where." 
".$group_by." LIMIT $limit, $nroLotes";

$result_registro = $mysqli->query($registro);
	
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="43.33%">Servicio</th>
		<th width="16.66%">Paciente</th>
		<th width="43.33">Enfermedad</th>		
		<th width="13.33%">Total</th>
	</tr>';			
	
if($nroProductos>0){
  while($registro2 = $result_registro->fetch_assoc()){
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
		<td style="color: '.$color_neto.';"><b>'.$registro2['total'].'</b></td>
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
	
$result_query->free();//LIMPIAR RESULTADO
$result_registro->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>