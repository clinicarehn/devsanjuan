<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$colaborador_id = $_SESSION['colaborador_id'];
date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$servicio = $_POST['servicio'];
$paginaActual = $_POST['partida'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$query = "SELECT CONCAT(p.apellido,' ',p.nombre) AS 'Nombre', p.expediente AS 'Expediente', p.identidad AS 'Identidad', a.años AS 'Edad',
    (CASE WHEN p.sexo = 'H' THEN 'X' ELSE '' END) AS 'H',
    (CASE WHEN p.sexo = 'M' THEN 'X' ELSE '' END) AS 'M',
    (CASE WHEN a.paciente = 'N' THEN 'X' ELSE '' END) AS 'Nuevo',
    (CASE WHEN a.paciente = 'S' THEN 'X' ELSE '' END) AS 'Subsguiente',
     d.nombre AS 'Procedencia',
     pa.patologia_id AS 'Codigo_CIE-10', pa1.patologia_id AS 'Codigo_CIE-101', pa2.patologia_id AS 'Codigo_CIE-102',
     pa.nombre AS 'Diagnostico_CIE-10', tiempo_estancia
     FROM ata AS a
     LEFT JOIN pacientes AS p
     ON a.expediente = p.expediente
     LEFT JOIN departamentos AS d
     ON a.departamento_id = d.departamento_id
     LEFT JOIN patologia AS pa
     ON a.patologia_id = pa.id
     LEFT JOIN patologia AS pa1
     ON a.patologia_id1 = pa1.id 
     LEFT JOIN patologia AS pa2
     ON a.patologia_id2 = pa2.id	 
     LEFT JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     LEFT JOIN servicios AS s
     ON a.servicio_id = s.servicio_id	 
     WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio'
     ORDER BY p.expediente";
$result = $mysqli->query($query);  
$nroProductos = $result->num_rows;
  
    $nroLotes = 15;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

	if($paginaActual > 1){
        $lista = $lista.'<liclass="page-item" ><a class="page-link" href="javascript:pagination1('.(1).');">Inicio</a></li>';
    }
	
    if($paginaActual > 1){
        $lista = $lista.'<liclass="page-item" ><a class="page-link" href="javascript:pagination1('.($paginaActual-1).');">Anterior '.($paginaActual-1).'</a></li>';
    }
    
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<liclass="page-item" ><a class="page-link" href="javascript:pagination1('.($paginaActual+1).');">Siguiente '.($paginaActual+1).' de '.$nroPaginas.'</a></li>';
    }
	
	if($paginaActual > 1){
        $lista = $lista.'<liclass="page-item" ><a class="page-link" href="javascript:pagination1('.($nroPaginas).');">Ultima</a></li>';
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
     d.nombre AS 'Procedencia',
     pa.patologia_id AS 'Codigo_CIE-10', pa1.patologia_id AS 'Codigo_CIE-101', pa1.patologia_id AS 'Codigo_CIE-101', pa2.patologia_id AS 'Codigo_CIE-102',
     pa.nombre AS 'Diagnostico_CIE-10', tiempo_estancia
     FROM ata AS a
     LEFT JOIN pacientes AS p
     ON a.expediente = p.expediente
     LEFT JOIN departamentos AS d
     ON a.departamento_id = d.departamento_id
     LEFT JOIN patologia AS pa
     ON a.patologia_id = pa.id
     LEFT JOIN patologia AS pa1
     ON a.patologia_id1 = pa1.id 
     LEFT JOIN patologia AS pa2
     ON a.patologia_id2 = pa2.id	 
     LEFT JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     LEFT JOIN servicios AS s
     ON a.servicio_id = s.servicio_id	 
     WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio'
     ORDER BY p.expediente ASC LIMIT $limit, $nroLotes"; 
$result = $mysqli->query($registro);  

  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
			               <th width="3%">No.</th>
            	           <th width="16.38%">Nombre</th>
                           <th width="5.69%">Expediente</th>
				           <th width="10.69%">Identidad</th>
				           <th width="3%">Edad</th>
				           <th width="2%">H</th>
				           <th width="2%">M</th>
				           <th width="3.69%">Nuevo</th>
				           <th width="6.69%">Subsiguiente</th>
				           <th width="10.69%">Procedencia</th>
				           <th width="10.69%">Tiempo estancia</th>
				           <th width="5.29%">CIE-10</th>
				           <th width="15.07%">Diagnostico</th>
			            </tr>';
				
	$valor = 1;			
	while($registro2 = $result->fetch_assoc()){	
	
       if($registro2['Codigo_CIE-101']==""){
	      $patologia = $registro2['Codigo_CIE-10'];
	   }else if($registro2['Codigo_CIE-101']!="" && $registro2['Codigo_CIE-102']==""){
		   $patologia = $registro2['Codigo_CIE-10'].'/'.$registro2['Codigo_CIE-101'];		   
	   }else{
	      $patologia = $registro2['Codigo_CIE-10'].'/'.$registro2['Codigo_CIE-101'].'/'.$registro2['Codigo_CIE-102'];
	   }
	   
	   
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
		   <td>'.$registro2['tiempo_estancia'].'</td>			
		   <td>'.$patologia.'</td>			
		   <td>'.$registro2['Diagnostico_CIE-10'].'</td>		   		   		   		   		   		   
	  </tr>';
	$valor++;	  
	}
        
    $tabla = $tabla.'<tr>
	   <td colspan="13"><b><p ALIGN=center>Total de Registros Encontrados '.number_format($nroProductos).'</p></b>
	</tr>';
	
    $tabla = $tabla.'</table>';

    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
	
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>