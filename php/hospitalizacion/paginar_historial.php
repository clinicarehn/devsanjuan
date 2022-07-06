<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$paginaActual = $_POST['partida'];
$colaborador_id = $_SESSION['colaborador_id'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
 
$query = "SELECT DISTINCT a.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', pa1.patologia_id AS 'patologia1', pa2.patologia_id AS 'patologia2', pa3.patologia_id AS 'patologia3', DATE_FORMAT(CAST(a.fecha AS DATE ), '%d/%m/%Y') AS 'fecha'
    FROM ata AS a
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN patologia AS pa1
    ON a.patologia_id = pa1.id  
    LEFT JOIN patologia AS pa2
    ON a.patologia_id1 = pa2.id
    LEFT JOIN patologia As pa3
    ON a.patologia_id2 = pa3.id
    WHERE a.colaborador_id = '$colaborador_id' AND a.servicio_id IN(3,4)
	ORDER BY a.fecha ASC";
    $result = $mysqli->query($query);
    $nroProductos = $result->num_rows;
	   
    $nroLotes = 5;
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
	   
	   
$registro = "SELECT DISTINCT a.expediente AS 'expediente', p.identidad AS 'identidad', CONCAT(p.apellido,' ',p.nombre) AS 'nombre', pa1.patologia_id AS 'patologia1', pa2.patologia_id AS 'patologia2', pa3.patologia_id AS 'patologia3', DATE_FORMAT(CAST(a.fecha AS DATE ), '%d/%m/%Y') AS 'fecha'
    FROM ata AS a
    INNER JOIN pacientes AS p
    ON a.expediente = p.expediente
    INNER JOIN patologia AS pa1
    ON a.patologia_id = pa1.id  
    LEFT JOIN patologia AS pa2
    ON a.patologia_id1 = pa2.id
    LEFT JOIN patologia As pa3
    ON a.patologia_id2 = pa3.id
    WHERE a.colaborador_id = '$colaborador_id' AND a.servicio_id IN(3,4)
	ORDER BY a.fecha ASC LIMIT $limit, $nroLotes";	
$result = $mysqli->query($registro);	   

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			  <tr>
                <th width="10%">Expediente</th>	
                <th width="10%">Identidad</th>					
                <th width="40%">Nombre</th>
				<th width="20%">Patología</th>
                <th width="20%">Fecha de Cita</th>
			   </tr>';
$i = 1;					
if($result->num_rows0){	
	while($registro2 = $result->fetch_assoc()){
       if($registro2['patologia2']==""){
	      $patologia = $registro2['patologia1'];
	   }else if($registro2['patologia2']!="" && $registro2['patologia3']==""){
		   $patologia = $registro2['patologia1'].'/'.$registro2['patologia2'];		   
	   }else{
	      $patologia = $registro2['patologia1'].'/'.$registro2['patologia2'].'/'.$registro2['patologia3'];
	   }	  
	  
		$tabla = $tabla.'<tr>
		   <td>'.$registro2['expediente'].'</td>	
           <td>'.$registro2['identidad'].'</td>			   
       	   <td>'.$registro2['nombre'].'</td>
		   <td>'.$patologia.'</td>		   
		   <td>'.$registro2['fecha'].'</td>   
	  </tr>';
	}
}else{
    $tabla = $tabla.'<tr>
	   <td colspan="6" style="color:#C7030D">No se encontraron resultados.</td>
	</tr>';		
}      
	
    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>