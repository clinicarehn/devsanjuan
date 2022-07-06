<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$dato = $_POST['dato'];
$sala = $_POST['sala'];
$estado = $_POST['estado'];
$usuario = $_SESSION['colaborador_id'];
	
//CONSULTAR PUESTO COLABORADOR
$consultar_maida = "SELECT s.servicio_id AS servicio
   FROM servicios_puestos AS sc
   INNER JOIN colaboradores AS c
   ON sc.colaborador_id = c.colaborador_id
   INNER JOIN servicios AS s
   ON sc.servicio_id = s.servicio_id
   INNER JOIN puesto_colaboradores AS pc
   ON pc.puesto_id = c.puesto_id AND s.servicio_id = 3
   WHERE c.colaborador_id = '$usuario'";
$result = $mysqli->query($consultar_maida);
   
$consultar_maida2 = $result->fetch_assoc();	
$maida = $consultar_maida2['servicio'];

$consultar_salon = "SELECT s.servicio_id AS servicio
   FROM servicios_puestos AS sc
   INNER JOIN colaboradores AS c
   ON sc.colaborador_id = c.colaborador_id
   INNER JOIN servicios AS s
   ON sc.servicio_id = s.servicio_id
   INNER JOIN puesto_colaboradores AS pc
   ON pc.puesto_id = c.puesto_id AND s.servicio_id = 4
   WHERE c.colaborador_id = '$usuario'";
$result = $mysqli->query($consultar_salon);
   
$consultar_salon2 = $result->fetch_assoc();	
$salon = $consultar_salon2['servicio'];	

$cantidad = $result->num_rows;

//OBTENER PUESTO_ID
$consulta_puesto = "SELECT puesto_id 
	 FROM colaboradores 
	 WHERE colaborador_id = '$usuario'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto1 = $result->fetch_assoc();

$puesto_id = $consulta_puesto1['puesto_id'];		

if($puesto_id  == 4){
	$puesto_id = 2;	
}

if($cantidad){
   if($maida != "" && $salon != ""){
	 $in = "IN($maida,$salon)";
   }else if($maida != "" && $salon == ""){
	  $in = "IN($maida)";
   }else{
	  $in = "IN($salon)";
}

if($estado == ""){
	$estado = "IN(0,3)";
}else{
	$estado = "IN(".$estado.")";
}

if($sala == ""){
	$where = "WHERE h.estado ".$estado." AND se.servicio_id ".$in." AND h.puesto_id = '$puesto_id' AND h.fecha BETWEEN '$fechai' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}else{
	$where = "WHERE c.sala_id = '$sala' AND h.estado ".$estado." AND h.puesto_id = '$puesto_id' AND h.fecha BETWEEN '$fechai' AND '$fechaf' AND se.servicio_id ".$in." AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}
	

$query = "SELECT hc.historial_id AS 'historial_id', h.hosp_id As 'hosp_id', DATE_FORMAT(CAST(h.fecha AS DATE ), '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.expediente, p.identidad, s.nombre As 'sala', h.servicio_id AS 'servicio_id', h.estado AS 'estado', p.pacientes_id AS 'pacientes_id'
  FROM hospitalizacion AS h
  INNER JOIN historial_camas AS hc
  ON h.historial_id = hc.historial_id
  INNER JOIN pacientes AS p
  ON h.expediente = p.expediente
  INNER JOIN camas AS c
  on hc.cama_id = c.cama_id
  INNER JOIN sala AS s
  ON c.sala_id = s.sala_id
  INNER JOIN servicios AS se
  ON h.servicio_id = se.servicio_id
  ".$where."
  ORDER BY c.cama_id, p.expediente ASC";
$result = $mysqli->query($query);
 
$nroProductos = $result->num_rows; 
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

$registro = "SELECT hc.historial_id AS 'historial_id', h.hosp_id As 'hosp_id', DATE_FORMAT(CAST(h.fecha AS DATE ), '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.expediente, p.identidad, s.nombre As 'sala', h.servicio_id AS 'servicio_id', h.estado AS 'estado', p.pacientes_id AS 'pacientes_id'
  FROM hospitalizacion AS h
  INNER JOIN historial_camas AS hc
  ON h.historial_id = hc.historial_id
  INNER JOIN pacientes AS p
  ON h.expediente = p.expediente
  INNER JOIN camas AS c
  on hc.cama_id = c.cama_id
  INNER JOIN sala AS s
  ON c.sala_id = s.sala_id
  INNER JOIN servicios AS se
  ON h.servicio_id = se.servicio_id	  
  ".$where."
  ORDER BY c.cama_id, p.expediente ASC
  LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);


$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="10.28.66%">Fecha</th>
			<th width="22.28%">Nombre</th>
			<th width="10.28%">Expediente</th>
			<th width="14.28%">Identidad</th>
			<th width="14.28%">Sala</th>
			<th width="14.38%">Estado</th>
			<th width="14.28%">Opciones</th>
			</tr>';
			
while($registro2 = $result->fetch_assoc()){	
	$estado_cama = $registro2['estado'];
	$estado = "";
	

	if($estado_cama == 0){
		$estado = 'Ocupada';
	}else if($estado_cama == 3){
		$estado = 'Alta-Ocupada';
	}
			
	$tabla = $tabla.'<tr>
			<td>'.$registro2['fecha'].'</td>	
			<td>'.$registro2['paciente'].'</td>
			<td>'.$registro2['expediente'].'</td>
			<td>'.$registro2['identidad'].'</td>
			<td>'.$registro2['sala'].'</td>	
			<td>'.$estado.'</td>	
			<td>
			  <a title = "Agregar ATA del usuario" href="javascript:editarRegistro('.$registro2['hosp_id'].",".$registro2['servicio_id'].",".$registro2['historial_id'].','.$registro2['estado'].');void(0);" class="fas fa-book-medical fa-lg" style="text-decoration:none;"></a>				  
			  <a title = "Alta a usuarios por abandono" href="javascript:modalAlta('.$registro2['hosp_id'].','.$registro2['estado'].','.$registro2['expediente'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-check fa-lg" style="text-decoration:none;"></a> 
			  <a title = "Transferir a Psicólogo" href="javascript:modalTransferir('.$registro2['hosp_id'].','.$registro2['estado'].','.$registro2['expediente'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-exchange-alt fa-lg" style="text-decoration:none;"></a> 
			  <a title = "Usuario no se presentó" href="javascript:nosePresntoRegistro('.$registro2['hosp_id'].','.$registro2['expediente'].','.$registro2['servicio_id'].','.$registro2['estado'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-times-circle fa-lg" style="text-decoration:none;"></a> 
			</td>				
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

}else{
$lista = '';
$tabla = '';

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="10.66%">Fecha</th>
			<th width="26.66%">Nombre</th>
			<th width="14.66%">Expediente</th>
			<th width="14.66%">Identidad</th>
			<th width="22.66%">Sala</th>
			<th width="10.66%">Opciones</th>
			</tr>';
				
	$tabla = $tabla.'<tr>
	   <td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';	

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);		
}
echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>