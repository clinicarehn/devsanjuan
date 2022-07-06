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
$color_porcentaje = '#087623';

if($servicio == ""){
    $where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año'";
}else{
	if($servicio == 0){//CONSULTA EXTERNA GENERAL
		$where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id IN(1,6)";
	}else{
		$where = "WHERE MONTH(a.fecha) = '$mes' AND YEAR(a.fecha) = '$año' AND a.servicio_id = '$servicio'";
	}
}
	
$query = "SELECT gp.codigo AS 'codigo', gp.nombre AS 'enfermedad',
COUNT(CASE WHEN a.paciente = 'N' THEN a.paciente END) AS 'nuevos',
COUNT(CASE WHEN a.paciente = 'S' THEN a.paciente END) AS 'subsiguientes',
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'H',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'M',
COUNT(a.patologia_id) AS 'total',
ROUND(AVG(a.años),0) AS 'promedio_edad'
FROM ata AS a
INNER JOIN patologia As pa
ON a.patologia_id = pa.id
INNER JOIN grupo_patologia AS gp
ON pa.grupo_id = gp.grupo_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where."
GROUP BY gp.grupo_id";

$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
		
$nroLotes = 25;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_sm03('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
  $lista = $lista.'<li><a href="javascript:pagination_sm03('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}
    
if($paginaActual < $nroPaginas){
   $lista = $lista.'<li><a href="javascript:pagination_sm03('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}
	
if($paginaActual > 1){
   $lista = $lista.'<li><a href="javascript:pagination_sm03('.($nroPaginas).');">Ultima</a></li>';
 }
  
if($paginaActual <= 1){
   $limit = 0;
}else{
   $limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT gp.codigo AS 'codigo', gp.nombre AS 'enfermedad',
COUNT(CASE WHEN a.paciente = 'N' THEN a.paciente END) AS 'nuevos',
COUNT(CASE WHEN a.paciente = 'S' THEN a.paciente END) AS 'subsiguientes',
COUNT(CASE WHEN p.sexo = 'H' THEN a.paciente END) AS 'H',
COUNT(CASE WHEN p.sexo = 'M' THEN a.paciente END) AS 'M',
COUNT(a.patologia_id) AS 'total',
ROUND(AVG(a.años),0) AS 'promedio_edad'
FROM ata AS a
INNER JOIN patologia As pa
ON a.patologia_id = pa.id
INNER JOIN grupo_patologia AS gp
ON pa.grupo_id = gp.grupo_id
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
".$where."
GROUP BY gp.grupo_id LIMIT $limit, $nroLotes";

$result = $mysqli->query($registro);
		
$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
    <tr>
      	<th width="5.5%">Código</th>
        <th width="37.5%">Enfermedad</th>
    	<th width="8.5%">Nuevos</th>
		<th width="8.5%">Subsiguientes</th>
    	<th width="9.5%">Hombre</th>
		<th width="9.5%">Mujer</th>		
		<th width="9.5%">Total</th>
		<th width="11.5%">Promedio Edad</th>
	</tr>';			

$total = 0;	$nuevos = 0; $subsiguientes = 0; $total_nuevos_consulta = 0;
if($nroProductos>0){	
  while($registro2 = $result->fetch_assoc()){
	 $total += $registro2['total'];
	 $nuevos += $registro2['nuevos'];
	 $subsiguientes += $registro2['subsiguientes'];	

  	 if ($total!=0){
        $total_nuevos_consulta = ($nuevos / $total )*100;		
	 }else{
	    $total_nuevos_consulta = 0;
	 }
	
	 $tabla = $tabla.'<tr>			
		<td>'.$registro2['codigo'].'</td>	
		<td>'.$registro2['enfermedad'].'</td>
		<td>'.number_format($registro2['nuevos']).'</td>
		<td>'.number_format($registro2['subsiguientes']).'</td>		
		<td>'.number_format($registro2['H']).'</td>
		<td>'.number_format($registro2['M']).'</td>		
		<td style="color: '.$color_neto.';"><b>'.number_format($registro2['total']).'</b></td>	
		<td style="color: '.$color_porcentaje.';"><b>'.number_format($registro2['promedio_edad']).'</b></td>			
	 </tr>';	 
  }	
    $tabla = $tabla.'
	    <tr>
	        <td colspan="8"></b></td>
		</tr>;	
	     <tr>
	         <td colspan="8"><b><p ALIGN="center">ANALISIS</p></b></td>			
		</tr>	
        <tr>
	        <td colspan="2"><p ALIGN="right">1. Total Pacientes:</p></td>
			<td colspan="6"><p ALIGN="left"><b>'.number_format($total).'</b></p></td>			
		</tr>
        <tr>
	        <td colspan="2"><p ALIGN="right">2. Enfermedeades mas comunes (según %):</p></td>					
		</tr>
        <tr>
	        <td colspan="2"><p ALIGN="right">3. Cantidad de Nuevos:</p></td>
			<td colspan="6"><p ALIGN="left"><b>'.number_format($nuevos).'</b></p></td>			
		</tr>
        <tr>
		    <td colspan="2"><p ALIGN="right">4. % Nuevos conforme a la consulta:</p></td>
			<td colspan="6"><p ALIGN="left"><b>'.number_format($total_nuevos_consulta).'</b></p></td> 			
		</tr>';	  
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