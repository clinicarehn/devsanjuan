<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
$paginaActual = $_POST['partida'];
date_default_timezone_set('America/Tegucigalpa');
$dato = $_POST['dato'];
$fechai = $_POST['fecha_i'];
$fechaf = $_POST['fecha_f'];
$servicio = $_POST['servicio'];
$consolidado = "";

if($servicio !=0){
	$where = "WHERE rr.servicio_id = '$servicio' AND rr.fecha BETWEEN '$fechai' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}else{
	$where = "WHERE rr.fecha BETWEEN '$fechai' AND '$fechaf' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.identidad LIKE '$dato%' OR p.apellido LIKE '$dato%')";
}		
	
$query = "SELECT CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', rr.referenciar_id AS 'referenciar_id', rr.ata_id AS 'ata_id', DATE_FORMAT(rr.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.identidad AS 'identidad', p.expediente AS 'expediente', pa.patologia_id AS 'patalogia_id', pa.nombre AS 'nombre', CONCAT(s.nombre,' ',pc.nombre) AS 'especialidad', rr.motivo_referencia AS 'motivo', ch.centro_nombre AS 'unidad_envia', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', rr.respuesta AS 'respuesta', ch.centro_nombre AS 'unidad_respuesta', rr.servicio_id AS 'servicio_id', rr.colaborador_id AS 'colaborador_id', rr.unidad_envia AS 'recibidade', p.pacientes_id AS 'pacientes_id'
	 FROM referencia_recibida rr
	 INNER JOIN pacientes AS p
	 ON rr.expediente = p.expediente
	 INNER JOIN colaboradores AS c
	 ON rr.colaborador_id = c.colaborador_id
	 INNER JOIN puesto_colaboradores AS pc
	 ON c.puesto_id = pc.puesto_id
	 INNER JOIN servicios AS s
	 ON rr.servicio_id = s.servicio_id
	 INNER JOIN patologia AS pa
	 ON rr.patologia_id = pa.id
	 INNER JOIN centros_hospitalarios AS ch
	 ON rr.unidad_envia = ch.centros_id
	 INNER JOIN colaboradores AS c1
	 ON rr.usuario = c1.colaborador_id
	 ".$where."
	 ORDER BY rr.fecha ASC
";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
	
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';	

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_recibidas('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_recibidas('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_recibidas('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_referencias_recibidas('.($nroPaginas).');">Ultima</a></li>';
}

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}	

$registro = "SELECT CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', rr.referenciar_id AS 'referenciar_id', rr.ata_id AS 'ata_id', DATE_FORMAT(rr.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'paciente', p.identidad AS 'identidad', p.expediente AS 'expediente', pa.patologia_id AS 'patalogia_id', pa.nombre AS 'nombre', CONCAT(s.nombre,' ',pc.nombre) AS 'especialidad', rr.motivo_referencia AS 'motivo', ch.centro_nombre AS 'unidad_envia', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador', rr.respuesta AS 'respuesta', ch.centro_nombre AS 'unidad_respuesta', rr.servicio_id AS 'servicio_id', rr.colaborador_id AS 'colaborador_id', rr.unidad_envia AS 'recibidade', p.pacientes_id AS 'pacientes_id'
	 FROM referencia_recibida rr
	 INNER JOIN pacientes AS p
	 ON rr.expediente = p.expediente
	 INNER JOIN colaboradores AS c
	 ON rr.colaborador_id = c.colaborador_id
	 INNER JOIN puesto_colaboradores AS pc
	 ON c.puesto_id = pc.puesto_id
	 INNER JOIN servicios AS s
	 ON rr.servicio_id = s.servicio_id
	 INNER JOIN patologia AS pa
	 ON rr.patologia_id = pa.id
	 INNER JOIN centros_hospitalarios AS ch
	 ON rr.unidad_envia = ch.centros_id
	 INNER JOIN colaboradores AS c1
	 ON rr.usuario = c1.colaborador_id		 
	 ".$where."
	 ORDER BY rr.fecha
	 LIMIT $limit, $nroLotes 
";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="8.33%">Fecha</th>
			<th width="18.33%">Nombre</th>
			<th width="8.33%">Identidad</th>
			<th width="8.33%">Expediente</th>
			<th width="5.33%">CIE-10</th>
			<th width="8.33%">Especialidad</th>
			<th width="8.33%">Motivo Refeferencia</th>
			<th width="8.33%">Unidad que Envia</th>
			<th width="8.33%">Persona que registra</th>
			<th width="4.33%">Resp</th>
			<th width="9.33%">Unidad donde se envía la Resp.</th>
			<th width="4.33%">Opciones</th>
			</tr>';	
if($nroProductos>0){

while($registro2 = $result->fetch_assoc()){	
	$tabla = $tabla.'<tr>	
			<td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:showDatosReferenciasRecibidas('.$registro2['ata_id'].');">'.$registro2['fecha'].'</a></td>	
			<td>'.$registro2['paciente'].'</td>
			<td>'.$registro2['identidad'].'</td>
			<td>'.$registro2['expediente'].'</td>
			<td>'.$registro2['patalogia_id'].'</td>
			<td>'.$registro2['especialidad'].'</td>
			<td>'.$registro2['motivo'].'</td>
			<td>'.$registro2['unidad_envia'].'</td>
			<td>'.$registro2['usuario'].'</td>
			<td>'.$registro2['respuesta'].'</td>
			<td>'.$registro2['unidad_respuesta'].'</td>
			<td>
			  <a style="text-decoration:none" href="javascript:modal_agregar_confirmacion_referencia_recibida('.$registro2['referenciar_id'].','.$registro2['colaborador_id'].','.$registro2['servicio_id'].');void(0);" title="Agregar Información a Respuesta Enviada" class="far fa-check-square fa-lg"></a>			
			  <a style="text-decoration:none;" href="javascript:editarReferenciasRecibidas('.$registro2['referenciar_id'].','.$registro2['ata_id'].');void(0);" title="Editar Referencia Recibida" class="fas fa-edit fa-lg"></a>
			  <a style="text-decoration:none;" title = "Eliminar Registro" href="javascript:modal_eliminarRecibidas('.$registro2['ata_id'].','.$registro2['expediente'].','.$registro2['referenciar_id'].','.$registro2['pacientes_id'].');void(0);" class="fas fa-trash fa-lg"></a>					  
			</td>
			</tr>';					
}
	
$tabla = $tabla.'<tr>
   <td colspan="13"><b><p ALIGN="center">Total de Registros Encontrados (Referencias Recibidas y Respuestas Enviadas): '.$nroProductos.'</p></b>
</tr>';
}else{
$tabla = $tabla.'<tr>
			<td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
		</tr>';	
}	
$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>