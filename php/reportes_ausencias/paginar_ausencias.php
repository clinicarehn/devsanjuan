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

//INICIO CONSULTA DE FECHAS PARA EVALUAR EL PRIEMR DIA DEL AÑO PARA ENERO Y EL ULTIMO DIA DEL AÑO PARA DICIEMBRE
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));
$año_actual = date("Y", strtotime($desde));
$mes_actual = date("m", strtotime($desde));
$dia = date("d", mktime(0,0,0, $mes_actual+1, 0, $año_actual));

$dia1 = date('d', mktime(0,0,0, $mes_actual, 1, $año_actual)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes_actual, $dia, $año_actual)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año_actual."-".$mes_actual."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año_actual."-".$mes_actual."-".$dia2));
//FIN CONSULTA DE FECHAS PARA EVALUAR EL PRIEMR DIA DEL AÑO PARA ENERO Y EL ULTIMO DIA DEL AÑO PARA DICIEMBRE


if($servicio != "" && $unidad == "" && $profesional == "" && $colaborador_usuario == ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND (CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}else if ($servicio != "" && $unidad != "" && $profesional == "" && $colaborador_usuario == ""){
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";				
}else if ($servicio != "" && $unidad != "" && $profesional != "" && $colaborador_usuario == ""){	 	
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$profesional' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";
}else{
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.usuario = '$colaborador_usuario' AND (p.expediente LIKE '%$dato%' OR CONCAT(p.nombre,' ',p.apellido) LIKE '%$dato%' OR p.apellido LIKE '$dato%' OR p.identidad LIKE '$dato%')";		
}
	  
$query = "SELECT p.pacientes_id AS 'pacientes_id', a.ausencia_id AS 'ausencia_id', (CASE WHEN a.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', DATE_FORMAT(a.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.identidad AS 'identidad', a.expediente AS 'expediente', a.comentario AS 'comentario', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', d.nombre AS 'departamento', m.nombre AS 'municipio', a.fecha AS 'fecha_ausencia', s.servicio_id AS 'servicio_id', c.colaborador_id AS 'colaborador_id'
  FROM ausencias AS a
  INNER JOIN pacientes AS p
  ON a.pacientes_id = p.pacientes_id
  INNER JOIN colaboradores AS c
  ON a.colaborador_id = c.colaborador_id
  INNER JOIN colaboradores AS c1
  ON a.usuario = c1.colaborador_id
  INNER JOIN servicios AS s
  ON a.servicio_id = s.servicio_id
  INNER JOIN departamentos AS d
  ON p.departamento_id = d.departamento_id
  INNER JOIN municipios AS m
  ON p.municipio_id = m.municipio_id  	  
  ".$where."
  ORDER BY a.fecha ASC";
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

$registro = "SELECT p.pacientes_id AS 'pacientes_id', a.ausencia_id AS 'ausencia_id', (CASE WHEN a.paciente = 'n' THEN 'X' ELSE '' END) AS 'nuevo', (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'subsiguiente', DATE_FORMAT(a.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', p.identidad AS 'identidad', a.expediente AS 'expediente', a.comentario AS 'comentario', s.nombre AS 'servicio', CONCAT(c.nombre,' ',c.apellido) AS 'medico', CONCAT(c1.nombre,' ',c1.apellido) AS 'usuario', (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'h', (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'm', CONCAT(c1.apellido,' ',c1.nombre) AS 'usuario', d.nombre AS 'departamento', m.nombre AS 'municipio', a.fecha AS 'fecha_ausencia', s.servicio_id AS 'servicio_id', c.colaborador_id AS 'colaborador_id'
  FROM ausencias AS a
  INNER JOIN pacientes AS p
  ON a.pacientes_id = p.pacientes_id
  INNER JOIN colaboradores AS c
  ON a.colaborador_id = c.colaborador_id
  INNER JOIN colaboradores AS c1
  ON a.usuario = c1.colaborador_id
  INNER JOIN servicios AS s
  ON a.servicio_id = s.servicio_id
  INNER JOIN departamentos AS d
  ON p.departamento_id = d.departamento_id
  INNER JOIN municipios AS m
  ON p.municipio_id = m.municipio_id  	  
  ".$where."
  ORDER BY a.fecha ASC LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			<th width="6.25%">Fecha</th>
			<th width="16.25%">Nombre</th>				
			<th width="6.25%">Expediente</th>
			<th width="6.25%">Identidad</th>				
			<th width="1.25%">H</th>
			<th width="1.25%">M</th>
			<th width="1.25%">N</th>
			<th width="1.25%">S</th>				
			<th width="6.25%">Servicio</th>
			<th width="6.25%">Profesional</th>	
			<th width="8.25%">Departamento</th>	
			<th width="10.25%">Municipio</th>
			<th width="6.25%">Confirmo</th>				
			<th width="10.25%">Comentario</th>
			<th width="6.25%">Usuario</th>			
			<th width="6.25%">Opciones</th>				
			</tr>';			
			
while($registro2 = $result->fetch_assoc()){	
	if($registro2['expediente'] == 0){
		$expediente = 'TEMP';
	}else{
		$expediente = $registro2['expediente'];
	}
		
   //CONSULTAR CONFIRMACION
   $pacientes_id = $registro2['pacientes_id'];
   $fecha_cita = $registro2['fecha_ausencia'];
   $servicio_id = $registro2['servicio_id'];
   $colaborador_id = $registro2['colaborador_id'];
   $confirmo = '';  
   
   //INICIO CONSULTAR CONFIRMACION DE LA REPROGRAMACION DE AUSENCIAS DE USUARIOS
   $query_confirmacion = "SELECT confirmar_ausencias_repro_id, observacion, confirmo
	  FROM  confirmar_ausencias_repro
	  WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha_cita' AND servicio_id = '$servicio_id' AND colaborador_id = '$colaborador_id'"; 
   $result_confirmacion = $mysqli->query($query_confirmacion) or die($mysqli->error);
   $registro_confirmacion2 = $result_confirmacion->fetch_assoc();

   if($registro_confirmacion2['confirmo'] == 1){
	   $confirmo = 'Sí'; 
	   if($registro_confirmacion2['observacion'] == ''){
		   $observacion = $registro2['comentario'];     
	   }else{
		   $observacion = $registro2['comentario']."***".$registro_confirmacion2['observacion'];
	   }
   }else{
	   $confirmo = 'No'; 
	   if($registro_confirmacion2['observacion'] == ''){
		   $observacion = $registro2['comentario'];     
	   }else{
		   $observacion = $registro2['comentario']."***".$registro_confirmacion2['observacion'];
	   }      		   
   }
   //FIN CONSULTAR CONFIRMACION DE LA REPROGRAMACION DE AUSENCIAS DE USUARIOS
   
	$tabla = $tabla.'<tr>
	   <td><a style="text-decoration:none" href="javascript:showDetails('.$registro2['ausencia_id'].');">'.$registro2['fecha'].'</a></td> 
	   <td>'.$registro2['nombre'].'</td>
	   <td>'.$expediente.'</td>		   
	   <td>'.$registro2['identidad'].'</td>		   
	   <td>'.$registro2['h'].'</td>		   
	   <td>'.$registro2['m'].'</td>
	   <td>'.$registro2['nuevo'].'</td>
	   <td>'.$registro2['subsiguiente'].'</td>
	   <td>'.$registro2['servicio'].'</td>
	   <td>'.$registro2['medico'].'</td>
	   <td>'.$registro2['departamento'].'</td>
	   <td>'.$registro2['municipio'].'</td>
	   <td>'.$confirmo.'</td>
	   <td>'.$observacion.'</td>
	   <td>'.$registro2['usuario'].'</td>   
	   <td>
		   <a title = "Eliminar Registro" href="javascript:modal_eliminarAusencias('.$registro2['ausencia_id'].','.$registro2['pacientes_id'].');" class="fas fa-trash fa-lg" style="text-decoration:none;"></a>
	   </td>		   
	</tr>';	        
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="16" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="16"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>