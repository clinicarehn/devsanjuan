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

if($colaborador != ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.colaborador_id = '$colaborador'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND d.departamento_id = 5 AND c.puesto_id = '$unidad' AND c.colaborador_id = '$colaborador'";
}else{
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND d.departamento_id = 5 AND c.puesto_id = '$unidad'";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro_departamentos = "SELECT d.nombre as departamento, COUNT(a.departamento_id) as total 
     FROM ata AS a
     INNER JOIN departamentos AS d
     ON a.departamento_id = d.departamento_id
     INNER JOIN municipios AS m
     ON a.municipio_id = m.municipio_id
     INNER JOIN colaboradores AS c
     ON a.colaborador_id = c.colaborador_id
     INNER JOIN puesto_colaboradores AS pc
     ON c.puesto_id = pc.puesto_id
     ".$where."
     GROUP BY d.departamento_id
     ORDER BY d.nombre";
$result_departamentos = $mysqli->query($registro_departamentos);	 

//MUNICIPIOS DE CORTES
$registro_cortes = "SELECT m.nombre as municipios, COUNT(a.municipio_id) as total
      FROM ata AS a
      INNER JOIN municipios AS m
      ON a.municipio_id = m.municipio_id
      INNER JOIN departamentos AS d
      ON a.departamento_id = d.departamento_id	 
	  INNER JOIN colaboradores AS c
	  ON a.colaborador_id = c.colaborador_id
	  INNER JOIN puesto_colaboradores AS pc
	  ON c.puesto_id = pc.puesto_id	  
      ".$where1."
      GROUP BY m.municipio_id
      ORDER BY m.nombre";
$result_cortes = $mysqli->query($registro_cortes);	 

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="50%">Departamento</th>
            	<th width="50%">Total</th>
            </tr>';
		
$total = 0;	$totalm = 0;		
if($result_departamentos->num_rows>0){
	if($result_departamentos->num_rows>0){
		while($registro_departamentos1 = $result_departamentos->fetch_assoc()){
		  echo '<tr>
				<td>'.$registro_departamentos1['departamento'].'</td>	
				<td>'.number_format($registro_departamentos1['total']).'</td>			
				</tr>';		
				$total = $total + $registro_departamentos1['total'];
	    }
	}
	
    echo '<tr>		        
	   <td><b>Total</b></td>	
	   <td><b>'.number_format($total).'</b></td>';	
	
	if($result_cortes->num_rows>0){
		echo '<tr>		        
	      <td colspan="2"><b>Municipios de Cortés</b></td>
		  <tr>';
		  
	if($result_cortes->num_rows>0){
    	while($registro_cortes1 = $result_cortes->fetch_assoc()){
	      echo '<tr>		        
		        <td>'.$registro_cortes1['municipios'].'</td>	
	            <td>'.number_format($registro_cortes1['total']).'</td>			
		      </tr>';		
			 $totalm = $totalm + $registro_cortes1['total'];
	        }
	    }		  
	}

    echo '<tr>		        
	   <td><b>Total Municipios de Cortés</b></td>	
	   <td><b>'.number_format($totalm).'</b></td>';
}else{
	echo '<tr>
				<td colspan="6" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

$result_departamentos->free();//LIMPIAR RESULTADO
$result_cortes->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>