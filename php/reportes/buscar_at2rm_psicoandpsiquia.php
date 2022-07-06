<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$servicio = $_POST['servicio'];
$servicio = $_POST['servicio'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',    
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años >= 1
   GROUP BY 1";
$result = $mysqli->query($registro); 

//DE 1 - 4 AÑOS 
 $registro1_4 = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',    
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 1 AND 4
   GROUP BY 1";
$result1_4 = $mysqli->query($registro1_4);  
 
 //DE 5 - 9 AÑOS
 $registro5_9 = "SELECT DISTINCT 
   CONCAT('5 - 9 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',    
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 5 AND 9
   GROUP BY 1";
$result5_9 = $mysqli->query($registro5_9);  

 //DE 10 - 14 AÑOS
 $registro10_14 = "SELECT DISTINCT 
   CONCAT('10 - 14 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',   
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 10 AND 14
   GROUP BY 1";
$result10_14 = $mysqli->query($registro10_14);  
 
 //DE 15 - 19 AÑOS
  $registro15_19 = "SELECT DISTINCT 
   CONCAT('15 - 19 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',   
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 15 AND 19
   GROUP BY 1";
$result15_19 = $mysqli->query($registro15_19);    

 //DE 20 - 49 AÑOS
  $registro20_49 = "SELECT DISTINCT 
   CONCAT('20 - 49 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',  
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 20 AND 49
   GROUP BY 1";
$result20_49 = $mysqli->query($registro20_49);       

 //DE 50 - 59 AÑOS
  $registro50_59 = "SELECT DISTINCT 
   CONCAT('50 - 59 años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',   
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años BETWEEN 50 AND 59
   GROUP BY 1";
$result50_59 = $mysqli->query($registro50_59);
 
 //60 AÑOS
 $registro60 = "SELECT DISTINCT 
   CONCAT('60 Y + años ', (CASE WHEN a.paciente = 'N' THEN '1a. Vez' ELSE 'Subsiguiente' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',   
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND a.años >= 60
   GROUP BY 1";
$result60 = $mysqli->query($registro60); 

  //CONSULTA SEXO USUARIOS
 $sexo = "SELECT DISTINCT 
   CONCAT('1 - 4 años ', (CASE WHEN p.sexo = 'M' THEN 'No. Atenciones Mujeres' ELSE 'No. Atenciones Hombres' END)) AS 'Concepto',
   COUNT(CASE WHEN c.puesto_id = 1 THEN a.paciente END) AS 'General',  
   COUNT(CASE WHEN c.puesto_id = 4 THEN a.paciente END) AS 'Medico',   
   COUNT(CASE WHEN c.puesto_id = 2 THEN a.paciente END) AS 'Especialista',   
   COUNT(a.paciente) AS 'Total'
   FROM ata AS a 
   INNER JOIN pacientes AS p 
   ON a.expediente = p.expediente 
   INNER JOIN colaboradores AS c
   ON a.colaborador_id	= c.colaborador_id
   INNER JOIN servicios AS s
   ON a.servicio_id = s.servicio_id    
   WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND s.servicio_id = '$servicio' AND p.sexo IN('H','M')
   GROUP BY 1";
$resultSexo = $mysqli->query($sexo);   

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="10%">No.</th>
            	<th width="24%">Concepto</th>
				<th width="24%">General</th>
                <th width="24%">Especialista</th>
				<th width="17%">Total</th>
            </tr>';

$i = 1;			
$totalg = 0; $totale = 0; $total = 0;
if($result->num_rows>0){
	if($result1_4->num_rows>0){
	    while($registro1_4_1 = $result1_4->fetch_assoc()){
		  $totalgeneral_medico = $registro1_4_1['General'] + $registro1_4_1['Medico'];
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro1_4_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro1_4_1['Especialista']).'</td>
                  <td>'.number_format($registro1_4_1['Total']).'</td>				  
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro1_4_1['Especialista'];
				$total = $total + $registro1_4_1['Total'];
	    }			
	}
	
	if($result5_9->num_rows>0){
	    while($registro5_9_1 = $result5_9->fetch_assoc()){
		  $totalgeneral_medico = $registro5_9_1['General'] + $registro5_9_1['Medico'];			
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro5_9_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro5_9_1['Especialista']).'</td>
                  <td>'.number_format($registro5_9_1['Total']).'</td>				  
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro5_9_1['Especialista'];				
				$total = $total + $registro5_9_1['Total'];
	    }			
	}

	if($result10_14->num_rows>0){
	    while($registro10_14_1 = $result10_14->fetch_assoc()){
		  $totalgeneral_medico = $registro10_14_1['General'] + $registro10_14_1['Medico'];			
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro10_14_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro10_14_1['Especialista']).'</td>	
                  <td>'.number_format($registro10_14_1['Total']).'</td>					  
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro10_14_1['Especialista'];				
				$total = $total + $registro10_14_1['Total'];
	    }			
	}

	if($result15_19->num_rows>0){
	    while($registro15_19_1 = $result15_19->fetch_assoc()){
		  $totalgeneral_medico = $registro15_19_1['General'] + $registro15_19_1['Medico'];			
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro15_19_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro15_19_1['Especialista']).'</td>
                  <td>'.number_format($registro15_19_1['Total']).'</td>				  
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro15_19_1['Especialista'];				
				$total = $total + $registro15_19_1['Total'];
	    }			
	}

	if($result20_49->num_rows>0){
	    while($registro20_49_1 = $result20_49->fetch_assoc()){
		  $totalgeneral_medico = $registro20_49_1['General'] + $registro20_49_1['Medico'];			
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro20_49_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro20_49_1['Especialista']).'</td>	
                  <td>'.number_format($registro20_49_1['Total']).'</td>					  
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro20_49_1['Especialista'];				
				$total = $total + $registro20_49_1['Total'];
	    }			
	}

	if($result50_59->num_rows>0){
	    while($registro50_59_1 = $result50_59->fetch_assoc()){
		  $totalgeneral_medico = $registro50_59_1['General'] + $registro50_59_1['Medico'];			
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro50_59_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro50_59_1['Especialista']).'</td>	
				  <td>'.number_format($registro50_59_1['Total']).'</td>	
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro50_59_1['Especialista'];				
				$total = $total + $registro50_59_1['Total'];
	    }			
	}

	if($result60->num_rows>0){
	    while($registro60_1 = $result60->fetch_assoc()){
		  $totalgeneral_medico = $registro60_1['General'] + $registro60_1['Medico'];			
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$registro60_1['Concepto'].'</td>	
				  <td>'.number_format($totalgeneral_medico).'</td>
                  <td>'.number_format($registro60_1['Especialista']).'</td>	
		          <td>'.number_format($registro60_1['Total']).'</td>					  
				</tr>';
				$i++;
				$totalg = $totalg + $totalgeneral_medico;
				$totale = $totale + $registro60_1['Especialista'];				
				$total = $total + $registro60_1['Total'];
	    }			
	}
	   echo '<tr>
	        <td><b>'.$i.'</b></td>
		    <td><b>Total Pacientes Atendidos</b></td>
	        <td><b>'.number_format($totalg).'</b></td>
			<td><b>'.number_format($totale).'</b></td>
			<td><b>'.number_format($total).'</b></td>
		  </tr>';		

    if($resultSexo->num_rows>0){
	    while($sexo1 = $resultSexo->fetch_assoc()){
		  echo '<tr>
		          <td>'.$i.'</td>
			      <td>'.$sexo1['Concepto'].'</td>	
				  <td>'.number_format($sexo1['General']).'</td>
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