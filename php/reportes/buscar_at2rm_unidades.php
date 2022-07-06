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

if ($colaborador == ""){
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años >= 1";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 1 AND 4";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 5 AND 9";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 10 AND 14";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 15 AND 19";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 20 AND 49";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 50 AND 59";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años>=60";
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND p.sexo IN('H','M')";
}else{	
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años >= 1 AND c.colaborador_id = '$colaborador'";
	$where1 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 1 AND 4 AND c.colaborador_id = '$colaborador'";
	$where2 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 5 AND 9 AND c.colaborador_id = '$colaborador'";
	$where3 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 10 AND 14 AND c.colaborador_id = '$colaborador'";
	$where4 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 15 AND 19 AND c.colaborador_id = '$colaborador'";
	$where5 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 20 AND 49 AND c.colaborador_id = '$colaborador' ";
	$where6 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años BETWEEN 50 AND 59 AND c.colaborador_id = '$colaborador'";
	$where7 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.años>=60 AND c.colaborador_id = '$colaborador'";	
	$where8 = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND p.sexo IN('H','M') AND c.colaborador_id = '$colaborador'";
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where."
   GROUP BY 1";
$result = $mysqli->query($registro); 

//DE 1 - 4 AÑOS 
 $registro1_4 = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where1."   
   GROUP BY 1";
$result1_4 = $mysqli->query($registro1_4); 
 
 //DE 5 - 9 AÑOS
 $registro5_9 = "SELECT DISTINCT 
   CONCAT('5 - 9 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where2."   
   GROUP BY 1";
$result5_9 = $mysqli->query($registro5_9); 
 
 //DE 10 - 14 AÑOS
 $registro10_14 = "SELECT DISTINCT 
   CONCAT('10 - 14 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where3."   
   GROUP BY 1";
$result10_14 = $mysqli->query($registro10_14);
 
 //DE 15 - 19 AÑOS
  $registro15_19 = "SELECT DISTINCT 
   CONCAT('15 - 19 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where4."   
   GROUP BY 1";
$result15_19 = $mysqli->query($registro15_19); 

 //DE 20 - 49 AÑOS
$registro20_49 = "SELECT DISTINCT 
   CONCAT('20 - 49 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where5."   
   GROUP BY 1";
$result20_49 = $mysqli->query($registro20_49); 
 
 //DE 50 - 59 AÑOS
  $registro50_59 = "SELECT DISTINCT 
   CONCAT('50 - 59 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where6."   
   GROUP BY 1";
$result50_59 = $mysqli->query($registro50_59); 
 
 //60 AÑOS
 $registro60 = "SELECT DISTINCT 
   CONCAT('60 Y + años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where7."   
   GROUP BY 1";
$result60 = $mysqli->query($registro60);  
 
//CONSULTA SEXO USUARIOS
 $sexo = "SELECT DISTINCT 
   CONCAT('', (CASE WHEN p.sexo = 'M' THEN 'No. Atenciones Mujeres' ELSE 'No. Atenciones Hombres' END)) AS 'Concepto', 
   COUNT(CASE WHEN c.puesto_id = '$unidad' THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   ".$where8."   
   GROUP BY 1";
$resultSexo = $mysqli->query($sexo);   

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="15%">No.</th>
            	<th width="35%">Concepto</th>
                <th width="25%">Especialista</th>
				<th width="25%">Total</th>
            </tr>';

$i = 1;			
$total = 0;
$especialista = 0;
if($result->num_rows>0){
	if($result1_4->num_rows>0){
	    while($registro1_4_1 = $result1_4->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro1_4_1['Concepto'].'</td>	
				  <td>'.number_format($registro1_4_1['Total']).'</td>
                  <td>'.number_format($registro1_4_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro1_4_1['Total'];
	    }			
	}
	
	if($result5_9->num_rows>0){
	    while($registro5_9_1 = $result5_9->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro5_9_1['Concepto'].'</td>	
				  <td>'.number_format($registro5_9_1['Total']).'</td>
                  <td>'.number_format($registro5_9_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro5_9_1['Total'];
	    }			
	}

	if($result10_14->num_rows>0){
	    while($registro10_14_1 = $result10_14->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro10_14_1['Concepto'].'</td>	
				  <td>'.number_format($registro10_14_1['Total']).'</td>
                  <td>'.number_format($registro10_14_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro10_14_1['Total'];
	    }			
	}

	if($result15_19->num_rows>0){
	    while($registro15_19_1 = $result15_19->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro15_19_1['Concepto'].'</td>	
				  <td>'.number_format($registro15_19_1['Total']).'</td>
                  <td>'.number_format($registro15_19_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro15_19_1['Total'];
	    }			
	}

	if($result20_49->num_rows>0){
	    while($registro20_49_1 = $result20_49->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro20_49_1['Concepto'].'</td>	
				  <td>'.number_format($registro20_49_1['Total']).'</td>
                  <td>'.number_format($registro20_49_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro20_49_1['Total'];
	    }			
	}

	if($result50_59->num_rows>0){
	    while($registro50_59_1 = $result50_59->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro50_59_1['Concepto'].'</td>	
				  <td>'.number_format($registro50_59_1['Total']).'</td>
                  <td>'.number_format($registro50_59_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro50_59_1['Total'];
	    }			
	}

	if($result60->num_rows>0){
	    while($registro60_1 = $result60->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro60_1['Concepto'].'</td>	
				  <td>'.number_format($registro60_1['Total']).'</td>
                  <td>'.number_format($registro60_1['Total']).'</td>				
				</tr>';
				$i++;
				$total = $total + $registro60_1['Total'];
	    }			
	}	

	$i++;
	   echo '<tr>
	        <td><b>'.$i.'</b></td>
		    <td><b>Total Pacientes Atendidos</b></td>
	        <td><b>'.number_format($total).'</b></td>
			<td><b>'.number_format($total).'</b></td>
		  </tr>';	
		  
    if($resultSexo->num_rows>0){
	    while($sexo1 = $resultSexo->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$sexo1['Concepto'].'</td>	
				  <td>'.number_format($sexo1['Especialista']).'</td>
                  <td>'.number_format($sexo1['Total']).'</td>				  
				</tr>';
				$i++;
	    }			
	}

}else{
	echo '<tr>
				<td colspan="6" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

$result->free();//LIMPIAR RESULTADO
$result1_4->free();
$result5_9->free();
$result10_14->free();
$result15_19->free();
$result20_49->free();
$result50_59->free();
$result60->free();
$resultSexo->free();
$mysqli->close();//CERRAR CONEXIÓN
?>