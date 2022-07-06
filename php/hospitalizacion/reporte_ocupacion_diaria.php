<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$registro = "SELECT s.nombre AS 'concepto', 
   SUM(CASE WHEN DAY(hc.fecha) = 1 THEN hc.porcentaje END) AS '1',  
   SUM(CASE WHEN DAY(hc.fecha) = 2 THEN hc.porcentaje END) AS '2',
   SUM(CASE WHEN DAY(hc.fecha) = 3 THEN hc.porcentaje END) AS '3',
   SUM(CASE WHEN DAY(hc.fecha) = 4 THEN hc.porcentaje END) AS '4',
   SUM(CASE WHEN DAY(hc.fecha) = 5 THEN hc.porcentaje END) AS '5',
   SUM(CASE WHEN DAY(hc.fecha) = 6 THEN hc.porcentaje END) AS '6',
   SUM(CASE WHEN DAY(hc.fecha) = 7 THEN hc.porcentaje END) AS '7',
   SUM(CASE WHEN DAY(hc.fecha) = 8  THEN hc.porcentaje END) AS '8',
   SUM(CASE WHEN DAY(hc.fecha) = 9 THEN hc.porcentaje END) AS '9',
   SUM(CASE WHEN DAY(hc.fecha) = 10 THEN hc.porcentaje END) AS '10',
   SUM(CASE WHEN DAY(hc.fecha) = 11 THEN hc.porcentaje END) AS '11',
   SUM(CASE WHEN DAY(hc.fecha) = 12 THEN hc.porcentaje END) AS '12',
   SUM(CASE WHEN DAY(hc.fecha) = 13 THEN hc.porcentaje END) AS '13',
   SUM(CASE WHEN DAY(hc.fecha) = 14 THEN hc.porcentaje END) AS '14',
   SUM(CASE WHEN DAY(hc.fecha) = 15 THEN hc.porcentaje END) AS '15',
   SUM(CASE WHEN DAY(hc.fecha) = 16 THEN hc.porcentaje END) AS '16',
   SUM(CASE WHEN DAY(hc.fecha) = 17 THEN hc.porcentaje END) AS '17',
   SUM(CASE WHEN DAY(hc.fecha) = 18 THEN hc.porcentaje END) AS '18',
   SUM(CASE WHEN DAY(hc.fecha) = 19 THEN hc.porcentaje END) AS '19',
   SUM(CASE WHEN DAY(hc.fecha) = 20 THEN hc.porcentaje END) AS '20',
   SUM(CASE WHEN DAY(hc.fecha) = 21 THEN hc.porcentaje END) AS '21',
   SUM(CASE WHEN DAY(hc.fecha) = 22 THEN hc.porcentaje END) AS '22',
   SUM(CASE WHEN DAY(hc.fecha) = 23 THEN hc.porcentaje END) AS '23',
   SUM(CASE WHEN DAY(hc.fecha) = 24 THEN hc.porcentaje END) AS '24',
   SUM(CASE WHEN DAY(hc.fecha) = 25 THEN hc.porcentaje END) AS '25',
   SUM(CASE WHEN DAY(hc.fecha) = 26 THEN hc.porcentaje END) AS '26',
   SUM(CASE WHEN DAY(hc.fecha) = 27 THEN hc.porcentaje END) AS '27',
   SUM(CASE WHEN DAY(hc.fecha) = 28 THEN hc.porcentaje END) AS '28',
   SUM(CASE WHEN DAY(hc.fecha) = 29 THEN hc.porcentaje END) AS '29',
   SUM(CASE WHEN DAY(hc.fecha) = 30 THEN hc.porcentaje END) AS '30',
   SUM(CASE WHEN DAY(hc.fecha) = 31 THEN hc.porcentaje END) AS '31',
   (SUM(hc.porcentaje))/22 AS 'total'  
   FROM historial_camas AS hc
   INNER JOIN hospitalizacion AS h
   ON hc.historial_id = h.historial_id
   INNER JOIN camas AS c
   ON hc.cama_id = c.cama_id
   INNER JOIN sala AS s
   ON c.sala_id = s.sala_id
   WHERE h.estado = 1 AND h.puesto_id = 2 AND hc.fecha BETWEEN '$desde' AND '$hasta'
   GROUP BY 1";
$result = $mysqli->query($registro);

$registro_conteo = "SELECT s.nombre AS 'concepto', 
   COUNT(CASE WHEN DAY(hc.fecha) = 1 THEN hc.porcentaje END) AS '1',  
   COUNT(CASE WHEN DAY(hc.fecha) = 2 THEN hc.porcentaje END) AS '2',
   COUNT(CASE WHEN DAY(hc.fecha) = 3 THEN hc.porcentaje END) AS '3',
   COUNT(CASE WHEN DAY(hc.fecha) = 4 THEN hc.porcentaje END) AS '4',
   COUNT(CASE WHEN DAY(hc.fecha) = 5 THEN hc.porcentaje END) AS '5',
   COUNT(CASE WHEN DAY(hc.fecha) = 6 THEN hc.porcentaje END) AS '6',
   COUNT(CASE WHEN DAY(hc.fecha) = 7 THEN hc.porcentaje END) AS '7',
   COUNT(CASE WHEN DAY(hc.fecha) = 8  THEN hc.porcentaje END) AS '8',
   COUNT(CASE WHEN DAY(hc.fecha) = 9 THEN hc.porcentaje END) AS '9',
   COUNT(CASE WHEN DAY(hc.fecha) = 10 THEN hc.porcentaje END) AS '10',
   COUNT(CASE WHEN DAY(hc.fecha) = 11 THEN hc.porcentaje END) AS '11',
   COUNT(CASE WHEN DAY(hc.fecha) = 12 THEN hc.porcentaje END) AS '12',
   COUNT(CASE WHEN DAY(hc.fecha) = 13 THEN hc.porcentaje END) AS '13',
   COUNT(CASE WHEN DAY(hc.fecha) = 14 THEN hc.porcentaje END) AS '14',
   COUNT(CASE WHEN DAY(hc.fecha) = 15 THEN hc.porcentaje END) AS '15',
   COUNT(CASE WHEN DAY(hc.fecha) = 16 THEN hc.porcentaje END) AS '16',
   COUNT(CASE WHEN DAY(hc.fecha) = 17 THEN hc.porcentaje END) AS '17',
   COUNT(CASE WHEN DAY(hc.fecha) = 18 THEN hc.porcentaje END) AS '18',
   COUNT(CASE WHEN DAY(hc.fecha) = 19 THEN hc.porcentaje END) AS '19',
   COUNT(CASE WHEN DAY(hc.fecha) = 20 THEN hc.porcentaje END) AS '20',
   COUNT(CASE WHEN DAY(hc.fecha) = 21 THEN hc.porcentaje END) AS '21',
   COUNT(CASE WHEN DAY(hc.fecha) = 22 THEN hc.porcentaje END) AS '22',
   COUNT(CASE WHEN DAY(hc.fecha) = 23 THEN hc.porcentaje END) AS '23',
   COUNT(CASE WHEN DAY(hc.fecha) = 24 THEN hc.porcentaje END) AS '24',
   COUNT(CASE WHEN DAY(hc.fecha) = 25 THEN hc.porcentaje END) AS '25',
   COUNT(CASE WHEN DAY(hc.fecha) = 26 THEN hc.porcentaje END) AS '26',
   COUNT(CASE WHEN DAY(hc.fecha) = 27 THEN hc.porcentaje END) AS '27',
   COUNT(CASE WHEN DAY(hc.fecha) = 28 THEN hc.porcentaje END) AS '28',
   COUNT(CASE WHEN DAY(hc.fecha) = 29 THEN hc.porcentaje END) AS '29',
   COUNT(CASE WHEN DAY(hc.fecha) = 30 THEN hc.porcentaje END) AS '30',
   COUNT(CASE WHEN DAY(hc.fecha) = 31 THEN hc.porcentaje END) AS '31'
   FROM historial_camas AS hc
   INNER JOIN hospitalizacion AS h
   ON hc.historial_id = h.historial_id
   INNER JOIN camas AS c
   ON hc.cama_id = c.cama_id
   INNER JOIN sala AS s
   ON c.sala_id = s.sala_id
   WHERE h.estado = 1 AND h.puesto_id = 2 AND hc.fecha BETWEEN '$desde' AND '$hasta'
   GROUP BY 1";
$result_conteo = $mysqli->query($registro_conteo);


$total1 = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0; $total7 = 0; $total8 = 0; $total9 = 0; $total10 = 0; $total11 = 0;
$total12 = 0; $total13 = 0; $total14 = 0; $total15 = 0; $total16 = 0; $total17 = 0; $total18 = 0; $total19 = 0; $total20 = 0; $total21 = 0;
$total22 = 0; $total23 = 0; $total24 = 0; $total25 = 0; $total26 = 0; $total27 = 0; $total28 = 0; $total29 = 0; $total30 = 0; $total31 = 0; $total = 0; 
$total_total = 0;
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="3%">No.</th>
            	<th width="21%">Concepto</th>
                <th width="2%">1</th>
				<th width="2%">2</th>
				<th width="2%">3</th>
				<th width="2%">4</th>
				<th width="2%">5</th>
				<th width="2%">6</th>
				<th width="2%">7</th>
				<th width="2%">8</th>
				<th width="2%">9</th>
				<th width="2%">10</th>
				<th width="2%">11</th>
				<th width="2%">12</th>
				<th width="2%">13</th>
				<th width="2%">14</th>
				<th width="2%">15</th>
				<th width="2%">16</th>
				<th width="2%">17</th>
				<th width="2%">18</th>
				<th width="2%">19</th>
				<th width="2%">20</th>
				<th width="2%">21</th>
				<th width="2%">22</th>
				<th width="2%">23</th>
				<th width="2%">24</th>
				<th width="2%">25</th>
				<th width="2%">26</th>
				<th width="2%">27</th>
				<th width="2%">28</th>
				<th width="2%">29</th>
				<th width="2%">30</th>
				<th width="2%">31</th>
				<th width="4%">Total</th>
            </tr>';

$i = 1;		
$total = 0;	

$prom1 = 0; $prom2 = 0; $prom3 = 0; $prom4 = 0; $prom5 = 0; $prom6 = 0; $prom7 = 0; $prom8 = 0; $prom9 = 0; $prom10 = 0; $prom11 = 0; $prom12 = 0;
$prom13 = 0; $prom14 = 0; $prom15 = 0; $prom16 = 0; $prom17 = 0; $prom18 = 0; $prom19 = 0; $prom20 = 0; $prom21 = 0; $prom22 = 0; $prom123 = 0;
$prom24 = 0; $prom25 = 0; $prom26 = 0; $prom27 = 0; $prom28 = 0; $prom29 = 0; $prom30 = 0; $prom31 = 0; $prom = 0; $prom_total = 0;
	 
if($result->fetch_assoc()>0){
     while($registro1 = $result->fetch_assoc()){
		   $total1 += $registro1['1'];
		   $total2 += $registro1['2'];
		   $total3 += $registro1['3'];
		   $total4 += $registro1['4'];
		   $total5 += $registro1['5'];
		   $total6 += $registro1['6'];
		   $total7 += $registro1['7'];
		   $total8 += $registro1['8'];
		   $total9 += $registro1['9'];
		   $total10 += $registro1['10'];
		   $total11 += $registro1['11'];
		   $total12 += $registro1['12'];
		   $total13 += $registro1['13'];
		   $total14 += $registro1['14'];
		   $total15 += $registro1['15'];
		   $total16 += $registro1['16'];
		   $total17 += $registro1['17'];
		   $total18 += $registro1['18'];
		   $total19 += $registro1['19'];
		   $total20 += $registro1['20'];
		   $total21 += $registro1['21'];
		   $total22 += $registro1['22'];
		   $total23 += $registro1['23'];
		   $total24 += $registro1['24'];
		   $total25 += $registro1['25'];
		   $total26 += $registro1['26'];
		   $total27 += $registro1['27'];
		   $total28 += $registro1['28'];
		   $total29 += $registro1['29'];
		   $total30 += $registro1['30'];
		   $total31 += $registro1['31'];
           $total_total += $registro1['total'];		   
		   
		   echo '<tr>
		          <td>'.$i.'</td>
			  	  <td>'.$registro1['concepto'].'</td>	
				  <td>'.round(number_format($registro1['1'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['2'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['3'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['4'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['5'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['6'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['7'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['8'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['9'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['10'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['11'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['12'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['13'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['14'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['15'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['16'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['17'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['18'], 1, '.', ''),2).'</td>
  				  <td>'.round(number_format($registro1['19'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['20'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['21'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['22'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['23'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['24'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['25'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['26'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['27'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['28'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['29'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['30'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['31'], 1, '.', ''),2).'</td>
				  <td>'.round(number_format($registro1['total'], 1, '.', ''),2).'</td>		  
				  </tr>';
                  $i++;
	 }
	 
	 $prom1 = $total1 / 3;
	 $prom2 = $total2 / 3;
	 $prom3 = $total3 / 3;
	 $prom4 = $total4 / 3;
	 $prom5 = $total5 / 3;
	 $prom6 = $total6 / 3;
	 $prom7 = $total7 / 3;
	 $prom8 = $total8 / 3;
	 $prom9 = $total9 / 3;
	 $prom10 = $total10 / 3;
	 $prom11 = $total11 / 3;
	 $prom12 = $total12 / 3;
	 $prom13 = $total13 / 3;
	 $prom14 = $total14 / 3;
	 $prom15 = $total15 / 3;
	 $prom16 = $total16 / 3;
	 $prom17 = $total17 / 3;
	 $prom18 = $total18 / 3;
	 $prom19 = $total19 / 3;
	 $prom20 = $total20 / 3;
	 $prom21 = $total21 / 3;
	 $prom22 = $total22 / 3;
	 $prom23 = $total23 / 3;
	 $prom24 = $total24 / 3;
	 $prom25 = $total25 / 3;
	 $prom26 = $total26 / 3;
	 $prom27 = $total27 / 3;
	 $prom28 = $total28 / 3;
	 $prom29 = $total29 / 3;
	 $prom30 = $total30 / 3;
	 $prom31 = $total31 / 3;
     $prom_total = $total_total / 3;  	 
	 //NOTA: Se divide entre 3 porque es la cantidad de salas que hay disponibles
	 	 
     echo '<tr>
	        <td><b>'.$i.'</b></td>
	    	<td><b>Total Ocupación</td>	
			<td><b>'.round(number_format($prom1, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom2, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom3, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom4, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom5, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom6, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom7, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom8, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom9, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom10, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom11, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom12, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom13, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom14, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom15, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom16, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom17, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom18, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom19, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom20, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom21, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom22, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom23, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom24, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom25, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom26, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom27, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom28, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom29, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom30, 1, '.', ''),2).'</b></td>
			<td><b>'.round(number_format($prom31, 1, '.', ''),2).'</b></td>
            <td><b>'.round(number_format($prom_total, 1, '.', ''),2).'</b></td>			
		</tr>';
        $i++;	 
}else{
	echo '<tr>
				<td colspan="35" style="color:#C7030D">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>