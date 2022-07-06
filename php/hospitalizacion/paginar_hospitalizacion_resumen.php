<?php
session_start();   
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');
$fecha_sistema = date("Y-m-d");
$fecha_sistema_time = date("D M j g:i:s a");

$tabla = '';
$lista = '';

//INICIO CONSULTA CAMAS MAIDA MUJERES
//CONSULTAR CAMAS VISIBLES
$registro_maida_mujeres = "SELECT cama_id, codigo, estado 
	FROM camas
	WHERE sala_id = 1 AND visible = 1";
$result_maida_mujeres = $mysqli->query($registro_maida_mujeres);

$registro_maida_mujeres_letras = "SELECT cama_id, codigo, estado 
	FROM camas
	WHERE sala_id = 1 AND visible = 1";	
$result_maida_mujeres_letras = $mysqli->query($registro_maida_mujeres_letras);

//LETRAS DE LAS CAMAS VISIBLES
//FIN CONSULTA CAMAS MAIDA MUJERES

//INICIO CONSULTA CAMAS MAIDA HOMBRES
//CONSULTAR CAMAS VISIBLES
$registro_maida_hombres = "SELECT cama_id, codigo, estado 
	FROM camas
	WHERE sala_id = 2 AND visible = 1";
$result_maida_hombres = $mysqli->query($registro_maida_hombres);

//LETRAS DE LAS CAMAS VISIBLES
$registro_maida_hombres_letras = "SELECT cama_id, codigo, estado 
	FROM camas
	WHERE sala_id = 2 AND visible = 1";
$result_maida_hombres_letras = $mysqli->query($registro_maida_hombres_letras);

//FIN CONSULTA CAMAS MAIDA HOMBRES	

//INICIO CONSULTA CAMAS SALON DEL HUESPED
//CONSULTAR CAMAS VISIBLES
$registro_salon_del_huesped = "SELECT cama_id, codigo, estado 
	FROM camas
	WHERE sala_id = 3 AND visible = 1";	
$result_salon_del_huesped = $mysqli->query($registro_salon_del_huesped);

//LETRAS DE LAS CAMAS VISIBLES
$registro_salon_del_huesped_letras = "SELECT cama_id, codigo, estado 
	FROM camas
	WHERE sala_id = 3 AND visible = 1;";
$result_salon_del_huesped_letras = $mysqli->query($registro_salon_del_huesped_letras);	
//FIN CONSULTA CAMAS SALON DEL HUESPED

//INICIO MADIDA MUJERES
$tabla = $tabla.'<center><h4><b>Tablero de Camas       '.$fecha_sistema_time.'</b></h4></b></center>';
$tabla = $tabla.'<table class="table table-bordered">';	
$tabla = $tabla.'<tr>';	
$tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>SALA</b></h4></td>';
  
//CONSULTAMOS EL CODIGO DE LAS CAMAS DISPONIBLES  
while($registro_maida_mujeres_letras2 = $result_maida_mujeres_letras->fetch_assoc()){
	   $letra_cama = $registro_maida_mujeres_letras2['codigo'];
	   $tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>'.$letra_cama.'</b></h4></td>';
}	
$tabla = $tabla.'</tr>';		  

$tabla = $tabla.'<tr>';	
$tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>MAIDA MUJERES</b></h4></td>';	
	
//LLENAMOS LAS CAMAS DISPONIBLES Y/O OCUPADAS			
while($registro_maida_mujeres2 = $result_maida_mujeres->fetch_assoc()){	
		$cama_id = $registro_maida_mujeres2['cama_id'];
		//CONSULTAR NOMBE DEL USUARIO
		$consulta = "SELECT p.expediente AS 'usuario', hc.estado, hc.color, p.identidad AS 'identidad'
			   FROM historial_camas AS hc
			   INNER JOIN pacientes AS p
			   ON hc.expediente = p.expediente
			   INNER JOIN hospitalizacion AS h
			   ON hc.historial_id = h.historial_id
			   WHERE hc.fecha = '$fecha_sistema' AND hc.puesto_id = 2 AND hc.cama_id = '$cama_id' AND h.alta = 0";
		$result = $mysqli->query($consulta);
		
		$consulta2 = $result->fetch_assoc();
		$usuario = $consulta2['usuario'];
		$estado = $consulta2['estado'];
		$color = $consulta2['color'];
		
		if( strlen($consulta2['identidad'])<10 ){
			$usuario = $consulta2['usuario'];
		}else{
			$identidad = $consulta2['identidad'];
			$identidad_nueva = SUBSTR($identidad,0,4)."-".SUBSTR($identidad,4,4)."-".SUBSTR($identidad,8,5);
			$usuario = $identidad_nueva;
		}
		
		if($color == ""){
			$color = "#27B604";
		}			
	
		if($color == "#DF0101"){
			$color_texto = "FFFFFF";
		}else{
			$color_texto = "#040404";
		}
		
		$tabla = $tabla.'<td style="text-align: center;" bgcolor = '.$color.'><b><font color='.$color_texto.'><h3><b>'.$usuario.'</b></h3></font></b></td>';				
}    

$tabla = $tabla.'</tr>';
$tabla = $tabla.'</table>';

//FIN MAIDA MUJERES	

//INICIO MADIDA HONMBRES	
$tabla = $tabla.'<table class="table table-bordered">';	
$tabla = $tabla.'<tr>';	
$tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>SALA</b></h4></td>';	  
  
//CONSULTAMOS EL CODIGO DE LAS CAMAS DISPONIBLES
while($registro_maida_hombres_letras2 = $result_maida_hombres_letras->fetch_assoc()){
	   $letra_cama = $registro_maida_hombres_letras2['codigo'];
	   $tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>'.$letra_cama.'</b></h4></td>';
}	
$tabla = $tabla.'</tr>';	  
	
$tabla = $tabla.'<tr>';	
$tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>MAIDA HOMBRES</b></h4></td>';	

//LLENAMOS LAS CAMAS DISPONIBLES Y/O OCUPADAS		
while($registro_maida_hombres2 = $result_maida_hombres->fetch_assoc()){	
		$cama_id = $registro_maida_hombres2['cama_id'];
		//CONSULTAR NOMBE DEL USUARIO
		$consulta = "SELECT p.expediente AS 'usuario', hc.estado, hc.color, p.identidad AS 'identidad'
			   FROM historial_camas AS hc
			   INNER JOIN pacientes AS p
			   ON hc.expediente = p.expediente
			   INNER JOIN hospitalizacion AS h
			   ON hc.historial_id = h.historial_id				   
			   WHERE hc.fecha = '$fecha_sistema' AND hc.puesto_id = 2 AND hc.cama_id = '$cama_id' AND h.alta = 0";
		$result = $mysqli->query($consulta);
		
		$consulta2 = $result->fetch_assoc();
		$usuario = $consulta2['usuario'];
		$estado = $consulta2['estado'];
		$color = $consulta2['color'];
		
		if( strlen($consulta2['identidad'])<10 ){
			$usuario = $consulta2['usuario'];
		}else{
			$identidad = $consulta2['identidad'];
			$identidad_nueva = SUBSTR($identidad,0,4)."-".SUBSTR($identidad,4,4)."-".SUBSTR($identidad,8,5);
			$usuario = $identidad_nueva;
		}
		
		if($color == ""){
			$color = "#27B604";
		}			
	
		if($color == "#DF0101"){
			$color_texto = "FFFFFF";
		}else{
			$color_texto = "#040404";
		}
		
		$tabla = $tabla.'<td style="text-align: center;" bgcolor = '.$color.'><b><font color='.$color_texto.'><h3><b>'.$usuario.'</b></h3></font></b></td>';					
}    

$tabla = $tabla.'</tr>';
$tabla = $tabla.'</table>';	
//FIN MAIDA HOMBRES

//INICIO SALON DEL HUESPED	
$tabla = $tabla.'<table class="table table-bordered">';	
$tabla = $tabla.'<tr>';	
$tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>SALA</b></h4></td>';
 
//CONSULTAMOS EL CODIGO DE LAS CAMAS DISPONIBLES	 
while($registro_salon_del_huesped_letras2 = $result_salon_del_huesped_letras->fetch_assoc()){
	   $letra_cama = $registro_salon_del_huesped_letras2['codigo'];
	   $tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>'.$letra_cama.'</b></h4></td>';
}	
$tabla = $tabla.'</tr>';
$tabla = $tabla.'<tr>';	

$tabla = $tabla.'<td width=200 style="text-align: center;"><h4><b>SALÓN DEL HUÉSPED</b></h4></td>';	
		
//LLENAMOS LAS CAMAS DISPONIBLES Y/O OCUPADAS		
while($registro_salon_del_huesped2 = $result_salon_del_huesped->fetch_assoc()){	
		$cama_id = $registro_salon_del_huesped2['cama_id'];
		//CONSULTAR NOMBE DEL USUARIO
		$consulta = "SELECT p.expediente AS 'usuario', hc.estado, hc.color, p.identidad AS 'identidad'
			   FROM historial_camas AS hc
			   INNER JOIN pacientes AS p
			   ON hc.expediente = p.expediente
			   INNER JOIN hospitalizacion AS h
			   ON hc.historial_id = h.historial_id	
			   INNER JOIN camas AS c
			   ON hc.cama_id = c.cama_id				   
			   WHERE hc.fecha = '$fecha_sistema' AND hc.puesto_id = 2 AND hc.cama_id = '$cama_id' AND h.alta = 0 AND c.visible = 1";
		$result = $mysqli->query($consulta);
		
		$consulta2 = $result->fetch_assoc();
		$usuario = $consulta2['usuario'];
		$estado = $consulta2['estado'];
		$color = $consulta2['color'];

		if( strlen($consulta2['identidad'])<10 ){
			$usuario = $consulta2['usuario'];
		}else{
			$identidad = $consulta2['identidad'];
			$identidad_nueva = SUBSTR($identidad,0,4)."-".SUBSTR($identidad,4,4)."-".SUBSTR($identidad,8,5);
			$usuario = $identidad_nueva;
		}
   
		if($color == ""){
			$color = "#27B604";
		}			
	
		if($color == "#DF0101"){
			$color_texto = "#FFFFFF";
		}else{
			$color_texto = "#040404";
		}
		
		$tabla = $tabla.'<td style="text-align: center;" bgcolor = '.$color.'><b><font color='.$color_texto.'><h3><b>'.$usuario.'</b></h3></font></b></td>';		
}    

$tabla = $tabla.'</tr>';
$tabla = $tabla.'</table>';	

$color_verde = "#27B604";
$color_rojo = "#DF0101";
$color_amarillo = "#FAF03C";

$tabla = $tabla.'<table class="table table-bordered">';	
$tabla = $tabla.'<tr>';	
  $tabla = $tabla.'<td style="text-align: center;" width=200><h4><b>ESTADO</b></h4></td>';
  $tabla = $tabla.'<td style="text-align: center;" bgcolor = '.$color_verde.' width=200><h4><b>DISPONIBLE</b></h4></td>';
  $tabla = $tabla.'<td></td>';
  $tabla = $tabla.'<td style="text-align: center;" bgcolor = '.$color_rojo.' width=200><font color="#FFFFFF"><h4><b>OCUPADA</b></h4></font></td>';
  $tabla = $tabla.'<td></td>';
  $tabla = $tabla.'<td style="text-align: center;" bgcolor = '.$color_amarillo.' width=200><h4><b>ALTA-OCUPADA</b></h4></td>';
  $tabla = $tabla.'<td></td>';		  
  $tabla = $tabla.'</tr>';		  
$tabla = $tabla.'</table>';	

$array = array(0 => $tabla,
			   1 => $lista);

echo json_encode($array);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN	
?>