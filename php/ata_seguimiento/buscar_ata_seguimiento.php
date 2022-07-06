<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$dato = $_POST['dato'];
$paginaActual = $_POST['partida'];

if($dato == ""){
	$where = "WHERE ase.fecha BETWEEN '$desde' AND '$hasta'";
}else if($dato != ""){
	$where = "WHERE CONCAT(pseg.nombres,' ',pseg.apellidos) LIKE '$dato%' OR pseg.identidad LIKE '$dato%' OR pseg.telefono LIKE '$dato%'";
}else{
	$where = "WHERE ase.fecha BETWEEN '$desde' AND '$hasta' AND (CONCAT(pseg.nombres,' ',pseg.apellidos) LIKE '$dato%' OR pseg.identidad LIKE '$dato%' OR pseg.telefono LIKE '$dato%')";
}
	
$query = "SELECT ase.ata_seguimiento_id AS 'ata_seguimiento_id', CONCAT(pseg.nombres,' ',pseg.apellidos) AS 'paciente', DATE_FORMAT(ase.fecha, '%d/%m/%Y') AS 'fecha', 
    (CASE WHEN pseg.genero = 'H' THEN 'Hombre' ELSE 'Mujer' END) AS 'genero',
	pseg.identidad, d.nombre AS 'departamento', m.nombre AS 'municipio', pseg.telefono,
	(CASE WHEN ase.ansioso = '1' THEN 'Sí' ELSE 'No' END) AS 'ansioso',
	(CASE WHEN ase.depresivo = '1' THEN 'Sí' ELSE 'No' END) AS 'depresivo',
	(CASE WHEN ase.psicotico = '1' THEN 'Sí' ELSE 'No' END) AS 'psicotico',
	(CASE WHEN ase.agitacion = '1' THEN 'Sí' ELSE 'No' END) AS 'agitacion',
	(CASE WHEN ase.insomnio = '1' THEN 'Sí' ELSE 'No' END) AS 'insomnio',
	(CASE WHEN ase.abandono_medicamento = '1' THEN 'Sí' ELSE 'No' END) AS 'abondono_medicamento',
	(CASE WHEN ase.otros_sitomas = '1' THEN 'Sí' ELSE 'No' END) AS 'otros_sintomas',
	(CASE WHEN ase.conducta_riesgo = '1' THEN 'Sí' ELSE 'No' END) AS 'conducta_riesgo',
	ase.comentario, CONCAT(c.apellido,' ',c.nombre) AS 'colaborador', ase.fecha_registro
	FROM ata_seguimiento AS ase
	INNER JOIN colaboradores AS c
	ON ase.usuario = c.colaborador_id
	INNER JOIN pacientes_seguimiento AS pseg
	ON ase.pacientes_seg_id = pseg.pacientes_seg_id
	INNER JOIN departamentos AS d
	ON pseg.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON pseg.municipio_id = m.municipio_id
	".$where."
	ORDER BY ase.fecha ASC";
$result = $mysqli->query($query);
$nroProductos = $result->num_rows;
  
$nroLotes = 15;
$nroPaginas = ceil($nroProductos/$nroLotes);
$lista = '';
$tabla = '';

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination('.(1).');">Inicio</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
}

if($paginaActual < $nroPaginas){
	$lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
}

if($paginaActual > 1){
	$lista = $lista.'<li><a href="javascript:pagination('.($nroPaginas).');">Ultima</a></li>';
}	

if($paginaActual <= 1){
	$limit = 0;
}else{
	$limit = $nroLotes*($paginaActual-1);
}

$registro = "SELECT ase.ata_seguimiento_id AS 'ata_seguimiento_id', CONCAT(pseg.nombres,' ',pseg.apellidos) AS 'paciente', DATE_FORMAT(ase.fecha, '%d/%m/%Y') AS 'fecha', 
    (CASE WHEN pseg.genero = 'H' THEN 'Hombre' ELSE 'Mujer' END) AS 'genero',
	pseg.identidad, d.nombre AS 'departamento', m.nombre AS 'municipio', pseg.telefono,
	(CASE WHEN ase.ansioso = '1' THEN 'Sí' ELSE 'No' END) AS 'ansioso',
	(CASE WHEN ase.depresivo = '1' THEN 'Sí' ELSE 'No' END) AS 'depresivo',
	(CASE WHEN ase.psicotico = '1' THEN 'Sí' ELSE 'No' END) AS 'psicotico',
	(CASE WHEN ase.agitacion = '1' THEN 'Sí' ELSE 'No' END) AS 'agitacion',
	(CASE WHEN ase.insomnio = '1' THEN 'Sí' ELSE 'No' END) AS 'insomnio',
	(CASE WHEN ase.abandono_medicamento = '1' THEN 'Sí' ELSE 'No' END) AS 'abondono_medicamento',
	(CASE WHEN ase.otros_sitomas = '1' THEN 'Sí' ELSE 'No' END) AS 'otros_sintomas',
	(CASE WHEN ase.conducta_riesgo = '1' THEN 'Sí' ELSE 'No' END) AS 'conducta_riesgo',
	ase.comentario, CONCAT(c.apellido,' ',c.nombre) AS 'colaborador', ase.fecha_registro
	FROM ata_seguimiento AS ase
	INNER JOIN colaboradores AS c
	ON ase.usuario = c.colaborador_id
	INNER JOIN pacientes_seguimiento AS pseg
	ON ase.pacientes_seg_id = pseg.pacientes_seg_id
	INNER JOIN departamentos AS d
	ON pseg.departamento_id = d.departamento_id
	INNER JOIN municipios AS m
	ON pseg.municipio_id = m.municipio_id
	".$where."
	ORDER BY ase.fecha ASC LIMIT $limit, $nroLotes";
$result = $mysqli->query($registro);

$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
	<tr>
		   <th width="2.11%">No.</th>
		   <th width="8.11%">Fecha</th>
		   <th width="24.11%">Paciente</th>
		   <th width="5.11%">Genero</th>
		   <th width="11.11%">Identidad</th>
		   <th width="5.11%">Teléfono</th>
		   <th width="13.11%">Departamento</th>
		   <th width="17.11%">Municipio</th>
		   <th width="14.11%">Colaborador</th>
	</tr>';			
	
$valor = 1;
	
while($registro2 = $result->fetch_assoc()){	
	$tabla = $tabla.'<tr>
		   <td>'.$valor.'</td>
		   <td><a style="text-decoration:none" title = "Información de Usuario" href="javascript:showDetailsSeguimiento('.$registro2['ata_seguimiento_id'].');">'.$registro2['fecha'].'</a></td>
		   <td>'.$registro2['paciente'].'</td>	
		   <td>'.$registro2['genero'].'</td>
	  	   <td>'.$registro2['identidad'].'</td>
		   <td>'.$registro2['telefono'].'</td>
           <td>'.$registro2['departamento'].'</td>		   
		   <td>'.$registro2['municipio'].'</td>										
		   <td>'.$registro2['colaborador'].'</td>		   
	</tr>';	
    $valor ++;	
}

if($nroProductos == 0){
	$tabla = $tabla.'<tr>
	   <td colspan="17" style="color:#C7030D">No se encontraron resultados</td>
	</tr>';		
}else{
   $tabla = $tabla.'<tr>
	  <td colspan="17"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
   </tr>';		
}        

$tabla = $tabla.'</table>';

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>