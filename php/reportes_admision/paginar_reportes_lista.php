<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$servicio = $_POST['servicio'];
$unidad = $_POST['unidad'];
$medico_general = $_POST['medico_general'];
$reporte = $_POST['reporte'];
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$paginaActual = $_POST['partida'];
$dato = $_POST['dato'];	

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($unidad == ""){
	$where = "WHERE le.servicio = '$servicio' AND CAST(fecha_solicitud as DATE) BETWEEN '$fechai' AND '$fechaf' AND le.reprogramo = ''";
}else if($medico_general == "" && $unidad != ""){
	$where = "WHERE le.servicio = '$servicio' AND CAST(fecha_solicitud as DATE) BETWEEN '$fechai' AND '$fechaf' AND le.reprogramo = '' AND c.puesto_id = '$unidad'";	
}else{
	$where = "WHERE le.servicio = '$servicio' AND CAST(fecha_solicitud as DATE) BETWEEN '$fechai' AND '$fechaf' AND le.reprogramo = '' AND c.colaborador_id = '$medico_general'";	
}

$query = "SELECT CAST(le.fecha_solicitud AS DATE) AS 'fecha_solicitud', CAST(le.fecha_solicitud AS DATE) AS 'fecha_registro', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', le.edad AS 'edad', p.identidad AS 'identidad', CONCAT(p.localidad,', ',m.nombre) AS 'direccion', p.telefono AS 'telefono', pc.nombre AS 'especialidad', CONCAT(c.nombre,' ',c.apellido) AS 'medico',
le.fecha_cita AS 'fecha_cita',
(CASE WHEN le.prioridad = 'P' THEN 'X' ELSE '' END) AS 'preferente',
(CASE WHEN le.prioridad = 'N' THEN 'X' ELSE '' END) AS 'normal',
(CASE WHEN le.tipo_cita = 'N' THEN 'X' ELSE '' END) AS 'nuevo',
(CASE WHEN le.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'sub',
le.reprogramo AS 'reprogramacion', DATEDIFF(le.fecha_cita,le.fecha_solicitud) AS 'dias_espera'
FROM lista_espera AS le
INNER JOIN pacientes AS p
ON le.pacientes_id = p.pacientes_id
INNER JOIN departamentos AS d
ON d.departamento_id = p.departamento_id
INNER JOIN municipios AS m
ON m.municipio_id = p.municipio_id
INNER JOIN colaboradores AS c
ON c.colaborador_id = le.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON pc.puesto_id = c.puesto_id
INNER JOIN servicios AS s
ON s.servicio_id = le.servicio
".$where."
GROUP BY le.pacientes_id, le.fecha_solicitud
ORDER BY c.colaborador_id, le.fecha_solicitud ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
	

    $nroLotes = 15;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

	if($paginaActual > 1){
		$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.(1).');void(0);">Inicio</a></li>';
	}
	
	if($paginaActual > 1){
		$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.($paginaActual-1).');void(0);">Anterior '.($paginaActual-1).'</a></li>';
	}
	
	if($paginaActual < $nroPaginas){
		$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.($paginaActual+1).');void(0);">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
	}
	
	if($paginaActual > 1){
		$lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination_busqueda_reportes('.($nroPaginas).');void(0);">Ultima</a></li>';
	}
	
	if($paginaActual <= 1){
		$limit = 0;
	}else{
		$limit = $nroLotes*($paginaActual-1);
	}	  
	
$registro = "SELECT CAST(le.fecha_solicitud AS DATE) AS 'fecha_solicitud', CAST(le.fecha_solicitud AS DATE) AS 'fecha_registro', CONCAT(p.nombre,' ',p.apellido) AS 'nombre', le.edad AS 'edad', p.identidad AS 'identidad', CONCAT(p.localidad,' ',m.nombre) AS 'direccion', p.telefono AS 'telefono', pc.nombre AS 'especialidad', CONCAT(c.nombre,' ',c.apellido) AS 'medico',
(CASE WHEN le.prioridad = 'P' THEN 'X' ELSE '' END) AS 'preferente',
(CASE WHEN le.prioridad = 'N' THEN 'X' ELSE '' END) AS 'normal',
le.fecha_cita AS 'fecha_cita',
(CASE WHEN le.tipo_cita = 'N' THEN 'X' ELSE '' END) AS 'nuevo',
(CASE WHEN le.tipo_cita = 'S' THEN 'X' ELSE '' END) AS 'sub',
le.reprogramo AS 'reprogramacion', DATEDIFF(le.fecha_cita,le.fecha_solicitud) AS 'dias_espera'
FROM lista_espera AS le
INNER JOIN agenda AS a
ON le.pacientes_id = a.pacientes_id
INNER JOIN pacientes AS p
ON le.pacientes_id = p.pacientes_id
INNER JOIN municipios AS m
ON p.municipio_id = m.municipio_id
INNER JOIN colaboradores AS c
ON le.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN servicios AS s
ON le.servicio = s.servicio_id
".$where."
GROUP BY le.pacientes_id, le.fecha_solicitud
ORDER BY c.colaborador_id, le.fecha_solicitud ASC LIMIT $limit, $nroLotes";	
$result = $mysqli->query($registro);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			<tr>
			    <th width="7.14%">Fecha Solicitud</th>
                <th width="23.14%">Usuario</th>
                <th width="3.14%">Edad</th>
                <th width="7.14%">Identidad</th>
                <th width="7.14%">Teléfono</th>				
				<th width="7.14%">Especialidad</th>
                <th width="14.14%">Médico</th>	
				<th width="5.14%">Prefente</th>
				<th width="5.14%">Normal</th>
				<th width="8.14%">Cita</th>				
			    <th width="2.14%">N</th>
				<th width="2.14%">S</th>
				<th width="2.14%">R</th>
				<th width="6.14%">Días Espera</th>
			</tr>';
$i = 1;					
if($result->num_rows>0){	
	while($registro2 = $result->fetch_assoc()){
		$tabla = $tabla.'<tr>		
       	             <td>'.$registro2['fecha_solicitud'].'</td>
       	             <td>'.$registro2['nombre'].'</td>
       	             <td>'.$registro2['edad'].'</td>
       	             <td>'.$registro2['identidad'].'</td>
       	             <td>'.$registro2['telefono'].'</td>
       	             <td>'.$registro2['especialidad'].'</td>					 
      	             <td>'.$registro2['medico'].'</td>
 		             <td>'.$registro2['preferente'].'</td>	
		             <td>'.$registro2['normal'].'</td>
                     <td>'.$registro2['fecha_cita'].'</td>					 
                     <td>'.$registro2['nuevo'].'</td>	
		             <td>'.$registro2['sub'].'</td>					 
		             <td>'.$registro2['reprogramacion'].'</td>
                     <td>'.$registro2['dias_espera'].' Días</td>					 
	  </tr>';  
	  $i++;
	}
      $tabla = $tabla.'<tr>
	   <td colspan="14"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
	  </tr>';	
	
}else{
    $tabla = $tabla.'<tr>
	   <td colspan="14" style="color:#C7030D">No se encontraron resultados.</td>
	</tr>';		
}      
	
    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>