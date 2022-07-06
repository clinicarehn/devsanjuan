<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$unidad = $_POST['unidad'];
$servicio = $_POST['servicio'];
$colaborador = $_POST['colaborador'];
$paginaActual = $_POST['partida'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if ($servicio != "" && $unidad !="" && $colaborador == ""){
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad'";
}else if ($servicio != "" && $unidad !="" && $colaborador !=""){
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND c.colaborador_id = '$colaborador'";	
}else{
   $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio'";
}

$query = "SELECT CONCAT(p.apellido,' ',p.nombre) AS 'Nombre', p.expediente AS 'Expediente', p.identidad AS 'Identidad', a.años AS 'Edad',
    (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'H',
    (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'M',
    (CASE WHEN a.paciente = 'N' THEN 'X' ELSE '' END) AS 'Nuevo',
    (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'Subsguiente',
     d.nombre AS 'Procedencia', a.observaciones AS 'observaciones'
     FROM ata_familiares AS a
     LEFT JOIN pacientes AS p
     ON a.expediente = p.expediente
     LEFT JOIN departamentos AS d
     ON p.departamento_id = d.departamento_id	 
     LEFT JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     LEFT JOIN servicios AS s
     ON a.servicio_id = s.servicio_id 
     ".$where."
     ORDER BY p.expediente";
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
  
$registro = "SELECT CONCAT(p.apellido,' ',p.nombre) AS 'Nombre', p.expediente AS 'Expediente', p.identidad AS 'Identidad', a.años AS 'Edad',
    (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'H',
    (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'M',
    (CASE WHEN a.paciente = 'N' THEN 'X' ELSE '' END) AS 'Nuevo',
    (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'Subsguiente',
     d.nombre AS 'Procedencia', a.observaciones AS 'observaciones'
     FROM ata_familiares AS a
     LEFT JOIN pacientes AS p
     ON a.expediente = p.expediente
     LEFT JOIN departamentos AS d
     ON p.departamento_id = d.departamento_id	 
     LEFT JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     LEFT JOIN servicios AS s
     ON a.servicio_id = s.servicio_id 	 
     ".$where."    
     ORDER BY p.expediente ASC LIMIT $limit, $nroLotes";	
$result = $mysqli->query($query);	 
  
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
			               <th width="3.09%">No.</th>
            	           <th width="25.09%">Nombre</th>
                           <th width="9.09%">Expediente</th>
				           <th width="10.09%">Identidad</th>
				           <th width="5.09%">Edad</th>
				           <th width="2.09%">H</th>
				           <th width="2.09%">M</th>
				           <th width="4.09%">Nuevo</th>
				           <th width="9.09%">Subsiguiente</th>
				           <th width="16.09%">Procedencia</th>
				           <th width="17.09%">Observación</th>
			            </tr>';
				
	$valor = 1;

if($nroProductos>0){	
	while($registro2 = $result->fetch_assoc()){	
		$tabla = $tabla.'<tr>
		   <td>'.$valor.'</td>
		   <td>'.$registro2['Nombre'].'</td>	
		   <td>'.$registro2['Expediente'].'</td>	
		   <td>'.$registro2['Identidad'].'</td>
	  	   <td>'.$registro2['Edad'].'</td>			
		   <td>'.$registro2['H'].'</td>			
		   <td>'.$registro2['M'].'</td>			
		   <td>'.$registro2['Nuevo'].'</td>			
		   <td>'.$registro2['Subsguiente'].'</td>			
		   <td>'.$registro2['Procedencia'].'</td>			
		   <td>'.$registro2['observaciones'].'</td>	   		   		   		   		   		   
	  </tr>';
	$valor++;	  
	}
        
    $tabla = $tabla.'<tr>
	   <td colspan="13"><b><p ALIGN="center">Total de Registros Encontrados '.$nroProductos.'</p></b>
	</tr>';
	
    $tabla = $tabla.'</table>';
}else{
	$tabla = $tabla.'<tr>
				<td colspan="13" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';		
}

    $array = array(0 => $tabla,
    			   1 => $lista);
				   
    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>