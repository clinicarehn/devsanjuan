<?php
require_once "conf/configAPP.php";
date_default_timezone_set('America/Tegucigalpa');

function sweetAlert($datos){
	if($datos['alert'] == "simple"){
		$alerta = "
			<script>
				swal({
					title: '".$datos['title']."',
					text: '".$datos['text']."',
					type: '".$datos['type']."',
					confirmButtonClass: '".$datos['btn-class']."'
				});
			</script>
		";
	}elseif($datos['alert'] == "reload"){
		$alerta = "
			<script>
				swal({
					title: '".$datos['title']."',
					text: '".$datos['text']."',
					type: '".$datos['type']."',
					showCancelButton: true,
					confirmButtonClass: '".$datos['btn-class']."',
					confirmButtonText: '".$datos['btn-text']."',
					closeOnConfirm: false
				},
				function(){
					location.reload();
				});
			</script>
		";
	}elseif($datos['alert'] == "clear"){
		$alerta = "
			<script>
				swal({
				  title: '".$datos['title']."',
				  text: '".$datos['text']."',
				  type: '".$datos['type']."',
				  showCancelButton: false,
				  confirmButtonClass: '".$datos['btn-class']."',
				  confirmButtonText: '".$datos['btn-text']."',
				  closeOnConfirm: false
				},
				function(){
				   swal.close();
				   $('#".$datos['form']."')[0].reset();
				   $('#".$datos['form']." #".$datos['id']."').val('".$datos['valor']."');
				   ".$datos['funcion'].";
				});
			</script>
		";
		echo $alerta;
	}
	return $alerta;
}

function getRealIP(){
	if (isset($_SERVER["HTTP_CLIENT_IP"])){
		return $_SERVER["HTTP_CLIENT_IP"];
	}elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
		return $_SERVER["HTTP_X_FORWARDED"];
	}elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
		return $_SERVER["HTTP_FORWARDED_FOR"];
	}elseif (isset($_SERVER["HTTP_FORWARDED"])){
		return $_SERVER["HTTP_FORWARDED"];
	}else{
		return $_SERVER["REMOTE_ADDR"];
	}
}

function dia_nombre($fecha){
   $dia_nombre = '';
   switch (date('w', strtotime($fecha))){
	 case 0: $dia_nombre = "domingo"; break;
	 case 1: $dia_nombre = "lunes"; break;
	 case 2: $dia_nombre = "martes"; break;
	 case 3: $dia_nombre = "miercoles"; break;
	 case 4: $dia_nombre = "jueves"; break;
	 case 5: $dia_nombre = "viernes"; break;
	 case 6: $dia_nombre = "sabado"; break;
  }

  return $dia_nombre;
}

function dia_nombre_corto($fecha){
   $dia_nombre = '';
   switch (date('w', strtotime($fecha))){
	 case 0: $dia_nombre = "dom"; break;
	 case 1: $dia_nombre = "lun"; break;
	 case 2: $dia_nombre = "mar"; break;
	 case 3: $dia_nombre = "mie"; break;
	 case 4: $dia_nombre = "jue"; break;
	 case 5: $dia_nombre = "vier"; break;
	 case 6: $dia_nombre = "sab"; break;
  }

  return $dia_nombre;
}

function getUltimoDiaMes($año,$mes){
	$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));
	$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

	return $dia2;
}

function getPrimerDiaMes($año,$mes){
	$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));
	$dia2 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES

	return $dia2;
}

function encrypt($string, $key) {
	$result = ''; $key=$key.'2015';
	for($i=0; $i<strlen($string); $i++) {
		  $char = substr($string, $i, 1);
		  $keychar = substr($key, ($i % strlen($key))-1, 1);
		  $char = chr(ord($char)+ord($keychar));
		  $result.=$char;
	}
	return base64_encode($result);
}

function decrypt($string, $key) {
	$result = ''; $key=$key.'2015';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++) {
		  $char = substr($string, $i, 1);
		  $keychar = substr($key, ($i % strlen($key))-1, 1);
		  $char = chr(ord($char)-ord($keychar));
		  $result.=$char;
	}
	return $result;
}

function estado($estado){
	if($estado=='s'){
		return '<span class="label label-success">Activo</span>';
	}else{
		return '<span class="label label-important">No Activo</span>';
	}
}

function dias_pasados($fecha_inicial,$fecha_final){
  $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
  $dias = abs($dias); $dias = floor($dias);
  return $dias;
}

function mensajes($mensaje,$tipo){
	if($tipo=='verde'){
		$tipo='alert alert-success';
	}elseif($tipo=='rojo'){
		$tipo='alert alert-danger';
	}elseif($tipo=='azul'){
		$tipo='alert alert-info';
	}
	return '<div class="'.$tipo.'" align="center">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>'.$mensaje.'</strong>
		</div>';
}

function formato($valor){
	return number_format($valor,2,",",".");
}

function cambiarfecha_mysql($fecha){
  list($dia,$mes,$ano)=explode(" de ",$fecha);
  $fecha="$ano-$mes-$dia";
  return $fecha;
}

function dias_transcurridos($fecha_i,$fecha_f){//Obtiene los dias transcurridos entre dos fechas
   $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
   $dias 	=  abs($dias); $dias = floor($dias);
   return $dias;
}

function Bisiesto($anyo){
   if(!checkdate(02,29,$anyo)){
	  return false;
   }else{
	 return true;
   }
}

function nombremes($mes){
  setlocale(LC_TIME, 'spanish');
  $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
  return $nombre;
}

function nombre_mes_corto($mes){
   $dia_nombre = '';
   switch ($mes){
	 case 'enero': $dia_nombre = "ene"; break;
	 case 'febrero': $dia_nombre = "feb"; break;
	 case 'marzo': $dia_nombre = "mar"; break;
	 case 'abril': $dia_nombre = "abr"; break;
	 case 'mayo': $dia_nombre = "may"; break;
	 case 'junio': $dia_nombre = "jun"; break;
	 case 'julio': $dia_nombre = "jul"; break;
	 case 'agosto': $dia_nombre = "ago"; break;
	 case 'septiembre': $dia_nombre = "sep"; break;
	 case 'octubre': $dia_nombre = "oct"; break;
	 case 'noviembre': $dia_nombre = "nov"; break;
	 case 'diciembre': $dia_nombre = "dic"; break;
  }

  return $dia_nombre;
}

function connect(){
	error_reporting(0);
	error_reporting(E_ALL ^ E_DEPRECATED);

	$conexion = mysql_connect(SERVER, USER, PASS);
	mysql_select_db(DB, $conexion);
	mysql_query("SET NAMES 'utf8'");
}

function connect_mysqli(){
	$mysqli=mysqli_connect(SERVER,USER,PASS,DB);

	$mysqli->set_charset("utf8");

	if ($mysqli->connect_errno) {
	   echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
	   exit;
	}

	return $mysqli;
}

//FUNCION QUE PERMITE GENERAR LA CONTRASEÑA DE FORMA AUTOMATICA
function generar_password_complejo(){
   $largo = 12;
   $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
   $cadena_base .= '0123456789' ;
   $cadena_base .= '!@#%^&()_,./<>?;:[]{}\|=+|*-';

   $password = '';
   $limite = strlen($cadena_base) - 1;

   for ($i=0; $i < $largo; $i++)
	   $password .= $cadena_base[rand(0, $limite)];

   return $password;
}


function historial(){
	$mysqli = connect_mysqli();
	$correlativo = "SELECT MAX(historial_id) AS max, COUNT(historial_id) AS count
	   FROM historial";
	$result = $mysqli->query($correlativo);

	$correlativo2 = $result->fetch_assoc();

	$numero = $correlativo2['max'];
	$cantidad = $correlativo2['count'];

	if ( $cantidad == 0 )
	   $numero = 1;
	else
	   $numero = $numero + 1;

	return $numero;
}


function correlativo($campo_id, $tabla){
	$mysqli = connect_mysqli();
	$correlativo = "SELECT MAX(".$campo_id.") AS max, COUNT(".$campo_id.") AS count
	   FROM ".$tabla;

	$result = $mysqli->query($correlativo);

	$correlativo2 = $result->fetch_assoc();

	$numero = $correlativo2['max'];
	$cantidad = $correlativo2['count'];

	if ( $cantidad == 0 )
	   $numero = 1;
	else
	   $numero = $numero + 1;

	return $numero;
}

function correlativo_diario($servicio_id){
	$mysqli = connect_mysqli();
	$fecha = date("Y-m-d");
	$correlativo = "SELECT MAX(cola_numero) AS max, COUNT(cola_numero) AS count
	   FROM colas
	   WHERE servicio_id = '$servicio_id' AND fecha = '$fecha'";
	$result = $mysqli->query($correlativo);

	$correlativo2 = $result->fetch_assoc();

	$numero = $correlativo2['max'];
	$cantidad = $correlativo2['count'];

	if ( $cantidad == 0 )
	   $numero = 1;
	else
	   $numero = $numero + 1;

	return $numero;
}

function ejecutar($url){
  trim($url);
  return $url;
}

//INICIO CONTROL DE AGENDA PARA USUARIOS EN EL CALENDARIO DE CITAS SEGUN AGENDA DIARIA
function getAgendatime($consultarJornadaJornada_id, $servicio, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $expediente, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto){
   $limite = 0;
   $hora = '';

	//EVALUAMOS SI EL PROFESIONAL TIENEN UNA JORNADA ASIGNADA
	//INICIO SERVICIO CONSULTA EXTERNA
	if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){
		//EVALUAMOS QUE SEA PSIQUIATRAS O MEDICOS GENERALES EN EL SERVICIO
		if($servicio == 1 || $servicio == 6){//ESTA CONSULTA SOLO ES VALIDA PARA CONSULTA EXTERNA Y LA UNIDAD DE NIÑOS Y ADOLESCENTES PARA PSIQUIATRIA Y PSICOLOGIA
			//INICIO AREA CONSULTA EXTERNA MAÑANA
			//INICIO PSIQUIATRAS CONSULTA EXTERNA MAÑANA
			if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
				if($consultarJornadaJornada_id == 1 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSIQUIATRIA Y MEDICOS GENERALES
					//INICIO DE HORAS PARA USUARIOS NUEVOS
					if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('08:40'))){//INICIO NUEVOS
					   $colores = "#008000"; //VERDE USUARIOS NUEVOS
					   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
						  $hora = "NuevosExcede";
					   }else{
						  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){
							 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){
							 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if($hora_h >= date('H:i',strtotime('09:20'))){
							 $hora = 'NulaSError';
						  }else if($hora_h == date('H:i',strtotime('00:00')) ){
							$hora = 'NulaSError';
						  }else{
							  $hora = "NulaP";
						  }

						  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							 if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('23:20'))){
								$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
							 }
						  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
								$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
							 }
						  }
						}
					}//FIN USUARIOS NUEVOS
					else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

						if($consulta_subsiguientes_devuelto > $limite){
							  $hora = "SubsiguienteExcede";
						}else if($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//2DO USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if ($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//3ER USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
						}else if($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//4TO USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//5T0 USUARIO SUBSIGUIENTE
						  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
						}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//6TO USUARIO SUBSIGUIENTE
						  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//7MO USUARIO SUBSIGUIENTE
						  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//8VO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:80'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h == date('H:i',strtotime('00:00')) ){
						  $hora = 'NulaSError';
						}else{
							$hora = "NulaP";
						}

						if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('23:20'))){
							   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
							}
						}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
							   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
							}
						}
					}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				//FIN SERVICIO CONSULTA EXTERNA
			}//FIN PSIQUIATRAS CONSULTA EXTERNA MAÑANA

			//INICIO PSIQUIATRAS CONSULTA EXTERNA TARDE
			if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
				if($consultarJornadaJornada_id == 2 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSIQUIATRAS Y MEDICOS GENERALES
					//INICIO DE HORAS PARA USUARIOS NUEVOS
					if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('08:40'))){//INICIO NUEVOS
					   $colores = "#008000"; //VERDE USUARIOS NUEVOS
					   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
						  $hora = "NuevosExcede";
					   }else{
						  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){
							 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){
							 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if($hora_h >= date('H:i',strtotime('09:20'))){
							 $hora = 'NulaSError';
						  }else if($hora_h == date('H:i',strtotime('00:00')) ){
							$hora = 'NulaSError';
						  }else{
							  $hora = "NulaP";
						  }

						  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							 if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('23:20'))){
								$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
							 }
						  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
								$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
							 }
						  }
						}
					}//FIN USUARIOS NUEVOS
					else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

						if($consulta_subsiguientes_devuelto > $limite){
							  $hora = "SubsiguienteExcede";
						}else if($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//2DO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if ($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//3ER USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
						}else if($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//4TO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//5T0 USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
						}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//6TO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//7MO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//8VO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:80'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//9NO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h == date('H:i',strtotime('00:00')) ){
						  $hora = 'NulaSError';
						}else{
							$hora = "NulaP";
						}

						if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('23:20'))){
							   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
							}
						}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
							   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
							}
						}
					}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				//FIN SERVICIO CONSULTA EXTERNA
			}//FIN PSIQUIATRAS CONSULTA EXTERNA TARDE

			//EVALUAMOS LOS PSICOLOGOS DE CONSULTA EXTERNA
			//INICIO PSICOLOGOS CONSULTA EXTERNA MAÑANA
			if($consultar_colaborador_puesto_id == 1){
				if($consultarJornadaJornada_id == 1 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSICOLOGOS
					//INICIO PARA EL INGRESO USUARIOS NUEVOS
					if ($expediente == ""){
							$colores = "#008000"; //VERDE USUARIOS NUEVOS
							if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
								$hora = "NuevosExcede";
							}else{
								if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
									$hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
								}else if ($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){
									$hora = "15:00";
								}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('09:20'))){
									$hora = $hora_h;
								}else{
								   $hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
								}

								if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
									if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('14:40'))){
										$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
									}
								}else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
									 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
										$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
									 }
								}
							}
					}//FIN PARA EL INGRESO USUARIOS NUEVOS
					else{//INICIO PARA INGRESO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto;
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						if($consulta_subsiguientes_devuelto > $limite){
							$hora = "SubsiguienteExcede";
						}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
							 $hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
						}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('15:20'))){
							 $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
							 $hora = $hora_nueva;
						}else if ($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){
							 $hora = "15:00";
						}else{
							$hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
						}

						if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('14:40'))){
							   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
							}
						}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
							   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
							}
						}
					}
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
			}//FIN PSICOLOGOS CONSULTA EXTERNA MAÑANA
			//FIN AREA CONSULTA EXTERNA MAÑANA

			/*#################################################################################################################################
			###################################################################################################################################
			*/

			//INICIO SERVICIO UNA MAÑANA
			if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){
				//EVALUAMOS QUE SEA PSIQUIATRAS O MEDICOS GENERALES EN EL SERVICIO
				//INICIO AREA UNA
				//INICIO PSIQUIATRAS UNA MAÑANA
				if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
					if($consultarJornadaJornada_id == 1 && $servicio == 6){//INICIO SERVICIO DE UNA Y JORNADA MATUTINA PARA PSIQUIATRAS Y MEDICOS GENERALES
						//INICIO DE HORAS PARA USUARIOS NUEVOS
						if ($hora_h >= date('H:i',strtotime('7:00')) && $hora_h < date('H:i',strtotime('10:00'))){//INICIO NUEVOS
						   $colores = "#008000"; //VERDE USUARIOS NUEVOS
						   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
							  $hora = "NuevosExcede";
						   }else{
							  if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('08:40'))){
								 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
							  }else if ($hora_h >= date('H:i',strtotime('08:40')) && $hora_h < date('H:i',strtotime('09:20'))){
								 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
							  }else if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('10:00'))){
								 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
							  }else if($hora_h >= date('H:i',strtotime('10:00'))){
								 $hora = 'NulaSError';
							  }else if($hora_h == date('H:i',strtotime('00:00')) ){
								$hora = 'NulaSError';
							  }else{
								  $hora = "NulaP";
							  }

							  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
								 if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('23:20'))){
									$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
								 }
							  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
								 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
									$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
								 }
							  }
							}
						}//FIN USUARIOS NUEVOS
						else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
							$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
							$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

							if($consulta_subsiguientes_devuelto > $limite){
								  $hora = "SubsiguienteExcede";
							}else if($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h == date('H:i',strtotime('00:00')) ){
							  $hora = 'NulaSError';
							}else{
								$hora = "NulaP";
							}

							if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
								if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('23:20'))){
								   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
								}
							}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
								if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
								   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
								}
							}
						}
						//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
					}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
					//FIN SERVICIO CONSULTA EXTERNA
				}//FIN PSOQUIATRAS UNA MAÑANA

				//INICIO PSIQUIATRAS UNA TARDE
				if($consultar_colaborador_puesto_id == 2 || $consultar_colaborador_puesto_id == 4){
					if($consultarJornadaJornada_id == 2 && $servicio == 6){//INICIO SERVICIO DE UNA Y JORNADA VESPERTINA PARA PSIQUIATRAS Y MEDICOS GENERALES
						//INICIO DE HORAS PARA USUARIOS NUEVOS
						if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h <= date('H:i',strtotime('10:00'))){//INICIO NUEVOS
						   $colores = "#008000"; //VERDE USUARIOS NUEVOS
						   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
							  $hora = "NuevosExcede";
						   }else{
							  if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){
								 $hora = "NulaP"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
							  }else if($hora_h >= date('H:i',strtotime('10:00'))){
								 $hora = 'NulaSError';
							  }else if($hora_h == date('H:i',strtotime('00:00')) ){
								$hora = 'NulaSError';
							  }

							  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
								 if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('23:20'))){
									$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
								 }
							  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
								 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
									$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
								 }
							  }
							}
						}//FIN USUARIOS NUEVOS
						else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
							$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
							$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

							if($consulta_subsiguientes_devuelto > $limite){
								  $hora = "SubsiguienteExcede";
							}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:00'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h == date('H:i',strtotime('00:00')) ){
							  $hora = 'NulaSError';
							}else{
								$hora = "NulaP";
							}

							if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
								if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('23:20'))){
								   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
								}
							}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
								if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
								   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
								}
							}
						}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
					}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
					//FIN SERVICIO CONSULTA EXTERNA
				}//FIN PSOQUIATRAS UNA TARDE

				//EVALUAMOS LOS PSICOLOGOS DE UNA
				//INICIO PSICOLOGOS UNA MAÑANA
				if($consultar_colaborador_puesto_id == 1){
					if($consultarJornadaJornada_id == 1 && $servicio == 6){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSICOLOGOS
						//INICIO PARA EL INGRESO USUARIOS NUEVOS
						if ($expediente == ""){
								$colores = "#008000"; //VERDE USUARIOS NUEVOS
								if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
									$hora = "NuevosExcede";
								}else{
									if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
										$hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
									}else if ($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){
										$hora = "15:00";
									}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('09:20'))){
										$hora = $hora_h;
									}else{
									   $hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
									}

									if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
										if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('14:40'))){
											$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
										}
									}else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
										 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
											$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
										 }
									}
								}
						}//FIN PARA EL INGRESO USUARIOS NUEVOS
						else{//INICIO PARA INGRESO USUARIOS SUBSIGUIENTES
							$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto;
							$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
							if($consulta_subsiguientes_devuelto > $limite){
								$hora = "SubsiguienteExcede";
							}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
								 $hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
							}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('15:20'))){
								 $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
								 $hora = $hora_nueva;
							}else if ($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){
							 $hora = "15:00";
							}else if ($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){
								 $hora = "15:00";
							}else{
								$hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
							}

							if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
								if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('14:40'))){
								   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
								}
							}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
								if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
								   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
								}
							}
						}
					}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				}//FIN PSICOLOGOS UNA MAÑANA
			}
			////FIN SERVICIO UNA MAÑANA
		}else{
			//INICIO PARA EL INGRESO USUARIOS NUEVOS
			if ($expediente == ""){
				$colores = "#008000"; //VERDE USUARIOS NUEVOS
				if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
					$hora = "NuevosExcede";
				}else{
					if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
						$hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
					}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('12:40'))){
						$hora = $hora_h;
					}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('19:20'))){
					   $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
					   $hora = $hora_nueva;
					}else{
					   $hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
					}
				}
			}//FIN PARA EL INGRESO USUARIOS NUEVOS
			else{//INICIO PARA INGRESO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto;
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES

				if($consulta_subsiguientes_devuelto > $limite){
					$hora = "SubsiguienteExcede";
				}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
					 $hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
				}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('12:40'))){
					 $hora = $hora_h;
				}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('19:20'))){
					 $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
					 $hora = $hora_nueva;
				}else{
					$hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
				}
			}
		}
	}

	$datos = array(
		"hora" => $hora,
		"colores" => $colores
	);

	return $datos;
}
//FIN CONTROL DE AGENDA PARA USUARIOS EN EL CALENDARIO DE CITAS SEGUN AGENDA DIARIA

//INICIO CONTROL DE AGENDA PARA USUARIOS SOBRE CUPO Y EXTEMPORANEOS
function getAgendatimeSE($consultarJornadaJornada_id, $servicio, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $expediente, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto){
   $limite = 0;
   $hora = '';

	//EVALUAMOS SI EL PROFESIONAL TIENEN UNA JORNADA ASIGNADA
	//INICIO SERVICIO CONSULTA EXTERNA
	if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){
		//EVALUAMOS QUE SEA PSIQUIATRAS O MEDICOS GENERALES EN EL SERVICIO
		if($servicio == 1 || $servicio == 6){//ESTA CONSULTA SOLO ES VALIDA PARA CONSULTA EXTERNA Y LA UNIDAD DE NIÑOS Y ADOLESCENTES PARA PSIQUIATRIA Y PSICOLOGIA
			//INICIO AREA CONSULTA EXTERNA MAÑANA
			//INICIO PSIQUIATRAS CONSULTA EXTERNA MAÑANA
			if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
				if($consultarJornadaJornada_id == 1 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSIQUIATRIA Y MEDICOS GENERALES
					//INICIO DE HORAS PARA USUARIOS NUEVOS
					if( $expediente == ""){//INICIO NUEVOS
					   $colores = "#008000"; //VERDE USUARIOS NUEVOS
					   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
						  $hora = "NuevosExcede";
					   }else{
						  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
							 $hora = "07:45"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if($hora_h == date('H:i',strtotime('00:00')) ){
							$hora = 'NulaSError';
						  }else{
							  $hora = "NulaP";
						  }
						}
					}//FIN USUARIOS NUEVOS
					else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
						if($consulta_subsiguientes_devuelto > $limite){
							  $hora = "SubsiguienteExcede";
						}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h == date('H:i',strtotime('00:00')) ){
						  $hora = 'NulaSError';
						}else{
							$hora = "NulaP";
						}
					}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				//FIN SERVICIO CONSULTA EXTERNA
			}//FIN PSIQUIATRAS CONSULTA EXTERNA MAÑANA

			//INICIO PSIQUIATRAS CONSULTA EXTERNA TARDE
			if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
				if($consultarJornadaJornada_id == 2 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSIQUIATRAS Y MEDICOS GENERALES
					//INICIO DE HORAS PARA USUARIOS NUEVOS
					if( $expediente == ""){//INICIO NUEVOS
					   $colores = "#008000"; //VERDE USUARIOS NUEVOS
					   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
						  $hora = "NuevosExcede";
					   }else{
						  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
							 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if($hora_h == date('H:i',strtotime('00:00')) ){
							$hora = 'NulaSError';
						  }else{
							  $hora = "NulaP";
						  }
						}
					}//FIN USUARIOS NUEVOS
					else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
						if($consulta_subsiguientes_devuelto > $limite){
							  $hora = "SubsiguienteExcede";
						}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
						  $hora = "14:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h == date('H:i',strtotime('00:00')) ){
						  $hora = 'NulaSError';
						}else{
							$hora = "NulaP";
						}
					}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				//FIN SERVICIO CONSULTA EXTERNA
			}//FIN PSIQUIATRAS CONSULTA EXTERNA TARDE

			//EVALUAMOS LOS PSICOLOGOS DE CONSULTA EXTERNA
			//INICIO PSICOLOGOS CONSULTA EXTERNA MAÑANA
			if($consultar_colaborador_puesto_id == 1){
				if($consultarJornadaJornada_id == 1 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSICOLOGOS
					//INICIO DE HORAS PARA USUARIOS NUEVOS
					if( $expediente == ""){//INICIO NUEVOS
					   $colores = "#008000"; //VERDE USUARIOS NUEVOS
					   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
						  $hora = "NuevosExcede";
					   }else{
						  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
							 $hora = "07:45"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
						  }else if($hora_h == date('H:i',strtotime('00:00')) ){
							$hora = 'NulaSError';
						  }else{
							  $hora = "NulaP";
						  }
						}
					}//FIN USUARIOS NUEVOS
					else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
						if($consulta_subsiguientes_devuelto > $limite){
							  $hora = "SubsiguienteExcede";
						}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h == date('H:i',strtotime('00:00')) ){
						  $hora = 'NulaSError';
						}else{
							$hora = "NulaP";
						}
					}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
			}//FIN PSICOLOGOS CONSULTA EXTERNA MAÑANA
			//FIN AREA CONSULTA EXTERNA MAÑANA

			/*#################################################################################################################################
			###################################################################################################################################
			*/

			//INICIO SERVICIO UNA MAÑANA
			if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){
				//EVALUAMOS QUE SEA PSIQUIATRAS O MEDICOS GENERALES EN EL SERVICIO
				//INICIO AREA UNA
				//INICIO PSIQUIATRAS UNA MAÑANA
				if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
						if($consultarJornadaJornada_id == 1 && $servicio == 6){//INICIO SERVICIO DE UNA Y JORNADA MATUTINA PARA PSIQUIATRAS Y MEDICOS GENERALES
							//INICIO DE HORAS PARA USUARIOS NUEVOS
							if( $expediente == ""){//INICIO NUEVOS
							   $colores = "#008000"; //VERDE USUARIOS NUEVOS
							   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
								  $hora = "NuevosExcede";
							   }else{
								  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
									 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
								  }else if($hora_h == date('H:i',strtotime('00:00')) ){
									$hora = 'NulaSError';
								  }else{
									  $hora = "NulaP";
								  }
								}
							}//FIN USUARIOS NUEVOS
							else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
								$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
								$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
								if($consulta_subsiguientes_devuelto > $limite){
									  $hora = "SubsiguienteExcede";
								}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
								  $hora = "08:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
								}else if($hora_h == date('H:i',strtotime('00:00')) ){
								  $hora = 'NulaSError';
								}else{
									$hora = "NulaP";
								}
							}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
					}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
					//FIN SERVICIO CONSULTA EXTERNA
				}//FIN PSOQUIATRAS UNA MAÑANA

				//INICIO PSIQUIATRAS UNA TARDE
				if($consultar_colaborador_puesto_id == 2 || $consultar_colaborador_puesto_id == 4){
						if($consultarJornadaJornada_id == 2 && $servicio == 6){//INICIO SERVICIO DE UNA Y JORNADA VESPERTINA PARA PSIQUIATRAS Y MEDICOS GENERALES
						//INICIO DE HORAS PARA USUARIOS NUEVOS
						if( $expediente == ""){//INICIO NUEVOS
						   $colores = "#008000"; //VERDE USUARIOS NUEVOS
						   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
							  $hora = "NuevosExcede";
						   }else{
							  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
								 $hora = "07:45"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
							  }else if($hora_h == date('H:i',strtotime('00:00')) ){
								$hora = 'NulaSError';
							  }else{
								  $hora = "NulaP";
							  }
							}
						}//FIN USUARIOS NUEVOS
						else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
							$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
							$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
							if($consulta_subsiguientes_devuelto > $limite){
								  $hora = "SubsiguienteExcede";
							}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h == date('H:i',strtotime('00:00')) ){
							  $hora = 'NulaSError';
							}else{
								$hora = "NulaP";
							}
						}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
					}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
					//FIN SERVICIO CONSULTA EXTERNA
				}//FIN PSOQUIATRAS UNA TARDE

				//EVALUAMOS LOS PSICOLOGOS DE UNA
				//INICIO PSICOLOGOS UNA MAÑANA
				if($consultar_colaborador_puesto_id == 1){
					if($consultarJornadaJornada_id == 1 && $servicio == 6){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSICOLOGOS
						//INICIO DE HORAS PARA USUARIOS NUEVOS
						if( $expediente == ""){//INICIO NUEVOS
						   $colores = "#008000"; //VERDE USUARIOS NUEVOS
						   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
							  $hora = "NuevosExcede";
						   }else{
							  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
								 $hora = "07:45"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
							  }else if($hora_h == date('H:i',strtotime('00:00')) ){
								$hora = 'NulaSError';
							  }else{
								  $hora = "NulaP";
							  }
							}
						}//FIN USUARIOS NUEVOS
						else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
							$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
							$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
							if($consulta_subsiguientes_devuelto > $limite){
								  $hora = "SubsiguienteExcede";
							}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
							  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
							}else if($hora_h == date('H:i',strtotime('00:00')) ){
							  $hora = 'NulaSError';
							}else{
								$hora = "NulaP";
							}
						}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
					}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				}//FIN PSICOLOGOS UNA MAÑANA
			}
			////FIN SERVICIO UNA MAÑANA
		}else{
			//INICIO DE HORAS PARA USUARIOS NUEVOS
			if( $expediente == ""){//INICIO NUEVOS
			   $colores = "#008000"; //VERDE USUARIOS NUEVOS
			   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				  $hora = "NuevosExcede";
			   }else{
				  if ($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){
					 $hora = "07:45"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if($hora_h == date('H:i',strtotime('00:00')) ){
					$hora = 'NulaSError';
				  }else{
					  $hora = "NulaP";
				  }
				}
			}//FIN USUARIOS NUEVOS
			else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;
				if($consulta_subsiguientes_devuelto > $limite){
					  $hora = "SubsiguienteExcede";
				}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('23:20'))){//2DO USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h == date('H:i',strtotime('00:00')) ){
				  $hora = 'NulaSError';
				}else{
					$hora = "NulaP";
				}
			}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
		}
	}

	$datos = array(
		"hora" => $hora,
		"colores" => $colores
	);

	return $datos;
}
//FIN CONTROL DE AGENDA PARA USUARIOS SOBRE CUPO Y EXTEMPORANEOS

//INICIO CONTROL DE AGENDA PARA USUARIOS EN EL CALENDARIO DE CITAS PARA USUARIOS EXTEMPORANEOS
function getAgendatimeExtemporaneo($consultarJornadaJornada_id, $servicio, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $expediente, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto){
   $limite = 0;
   $hora = '';

	//EVALUAMOS SI EL PROFESIONAL TIENEN UNA JORNADA ASIGNADA
	//INICIO SERVICIO CONSULTA EXTERNA
	if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){
		//EVALUAMOS QUE SEA PSIQUIATRAS O MEDICOS GENERALES EN EL SERVICIO
		if($servicio == 1 || $servicio == 6){//ESTA CONSULTA SOLO ES VALIDA PARA CONSULTA EXTERNA Y LA UNIDAD DE NIÑOS Y ADOLESCENTES PARA PSIQUIATRIA Y PSICOLOGIA
			//INICIO AREA CONSULTA EXTERNA MAÑANA
			//INICIO PSIQUIATRAS CONSULTA EXTERNA MAÑANA
			if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){
				if($consultarJornadaJornada_id == 1 && $servicio == 1){//INICIO SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA PARA PSIQUIATRIA Y MEDICOS GENERALES
					//INICIO DE HORAS PARA USUARIOS NUEVOS
					if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('08:40'))){//INICIO NUEVOS
					   $colores = "#008000"; //VERDE USUARIOS NUEVOS
					   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
						  $hora = "NuevosExcede";
					   }else{
						  if($hora_h >= date('H:i',strtotime('09:20'))){
							 $hora = 'NulaSError';
						  }else if($hora_h == date('H:i',strtotime('00:00')) ){
							$hora = 'NulaSError';
						  }else{
							  $hora = "NulaP";
						  }

						  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							 if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('23:20'))){
								$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
							 }
						  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
								$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
							 }
						  }
						}
					}//FIN USUARIOS NUEVOS
					else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
						$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
						$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

						if($consulta_subsiguientes_devuelto > $limite){
							  $hora = "SubsiguienteExcede";
						}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//2DO USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if ($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//3ER USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
						}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//4TO USUARIO SUBSIGUIENTE
						  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if ($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//5T0 USUARIO SUBSIGUIENTE
						  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
						}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//6TO USUARIO SUBSIGUIENTE
						  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//7MO USUARIO SUBSIGUIENTE
						  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
						}else if($hora_h == date('H:i',strtotime('00:00')) ){
						  $hora = 'NulaSError';
						}else{
							$hora = "NulaP";
						}

						if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('09:20')) && $hora_h < date('H:i',strtotime('23:20'))){
							   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
							}
						}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
							if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('09:20'))){
							   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
							}
						}
					}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
				}//FIN SERVICIO CONSULTA EXTERNA Y JORNADA MATUTINA
				//FIN SERVICIO CONSULTA EXTERNA
			}//FIN PSIQUIATRAS CONSULTA EXTERNA MAÑANA
			////FIN SERVICIO UNA MAÑANA
		}else{
			$hora = "NulaP";
			$colores = "#008000";
		}
	}

	$datos = array(
		"hora" => $hora,
		"colores" => $colores
	);

	return $datos;
}
//FIN CONTROL DE AGENDA PARA USUARIOS EN EL CALENDARIO DE CITAS PARA USUARIOS EXTEMPORANEOS

function getAgendatime1($consultarJornadaJornada_id, $servicio, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $expediente, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto){
   //INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
   $limite = 0;
   $hora = '';

   //INICIO PARA EVALUAR QUE EXISTA REGISTRO DEL COLABORADOR EN LA ENTIDAD jornada_colaborador, VALIDANDO QUE TIENE JORNADA LABORAL ASIGNADA
   //SI TIENE JORNADA ASIGNADA Y EL SERVICIO DE ATENCION ES IGUAL AL SERVICIO ASIGNADO
   if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){
	if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){//INICIO BUSQUEDA PSIQUIATRAS Y/O MEDICO GENERAL
		if($consultarJornadaJornada_id == 1){//INICIO JORNADA MATUTINA
			if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('10:20'))){//INICIO DE HORAS PARA USUARIOS NUEVOS
			   $colores = "#008000"; //VERDE USUARIOS NUEVOS
			   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				  $hora = "NuevosExcede";
			   }else{
				  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('10:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('10:40'))){
					 $hora = 'NulaSError';
				  }else if($hora_h == date('H:i',strtotime('00:00')) ){
					$hora = 'NulaSError';
				  }

				  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('23:20'))){
						$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
					 }
				  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:40'))){
						$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
					 }
				   }
				}
			}//FIN DE HORAS PARA USUARIOS NUEVOS
			else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

				if($consulta_subsiguientes_devuelto > $limite){
					  $hora = "SubsiguienteExcede";
				}else if ($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('11:20'))){//1ER USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//2DO USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if ($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//3ER USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//4TO USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//5T0 USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//6TO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//7MO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//8VO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//9NO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//10MO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:00'))){//11VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('22:00')) && $hora_h < date('H:i',strtotime('22:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('22:40')) && $hora_h < date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h == date('H:i',strtotime('00:00')) ){//12VO USUARIO SUBSIGUIENTE
				  $hora = 'NulaSError';
				}

				if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('23:20'))){//CAMBIARE 17:20 POR
					   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
					}
				}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:40'))){
					   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
					}
				}

			}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
		}//FIN JORNADA MATUTINA

		if($consultarJornadaJornada_id == 2){//INICIO JORNADA VESPERTINA
			if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('10:40'))){//INICIO DE HORAS PARA USUARIOS NUEVOS
			   $colores = "#008000"; //VERDE USUARIOS NUEVOS
			   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				  $hora = "NuevosExcede";
			   }else{
				  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('10:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('11:20'))){
					 $hora = 'NulaSError';
				  }

				  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('23:20'))){
						$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
					 }
				  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('11:20'))){
						$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
					 }
				   }
				}
			}//FIN DE HORAS PARA USUARIOS NUEVOS
			else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

				if($consulta_subsiguientes_devuelto > $limite){
					  $hora = "SubsiguienteExcede";
				}else if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//1ER USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//2DO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//3ER USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//4TO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if ($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//5T0 USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//6TO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//7MO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//8VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//9NO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:00'))){//10MO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//11VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('22:00')) && $hora_h < date('H:i',strtotime('22:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('22:40')) && $hora_h < date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "13:00";
				}

				if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('23:20'))){
					   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
					}
				}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('11:20'))){
					   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
					}
				}

			}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
		}//FIN JORNADA VESPERTINA

		//INICIO JORNADA MIXTA MAÑANA Y TARDE
		if($consultarJornadaJornada_id == 3){
			if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('9:20'))){//INICIO DE HORAS PARA USUARIOS NUEVOS
				$colores = "#008000"; //VERDE USUARIOS NUEVOS

				  if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
					  $hora = "NuevosExcede";
				  }else{
					  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
						 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
					  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
						 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
					  }else if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
						 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
					  }else if($hora_h >= date('H:i',strtotime('14:40'))){
						 $hora = 'NulaSError';
					  }

					if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
						if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('18:40'))){
						   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
						}
					}else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
						if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
						   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
						}
					}
				 }
			}else{//USUARIOS SUBSIGUIENTE
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

				if($consulta_subsiguientes_devuelto > $limite){
					$hora = "SubsiguienteExcede";
				}else if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('10:40'))){//1ER USUARIO SUBSIGUIENTE
					$hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('11:20'))){//2DO USUARIO SUBSIGUIENTE
					$hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//3ER USUARIO SUBSIGUIENTE
					$hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//4TO USUARIO SUBSIGUIENTE
				 $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//5T0 USUARIO SUBSIGUIENTE
				 $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//6TO USUARIO SUBSIGUIENTE
				 $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//7MO USUARIO SUBSIGUIENTE
					$hora = "12:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//7MO USUARIO SUBSIGUIENTE
					$hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//7MO USUARIO SUBSIGUIENTE
					$hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//7MO USUARIO SUBSIGUIENTE
					$hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//7MO USUARIO SUBSIGUIENTE
					$hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:00'))){//10MO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//11VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('22:00')) && $hora_h < date('H:i',strtotime('22:40'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('22:40')) && $hora_h < date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}else if($hora_h >= date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
					$hora = "13:00";
				}
				  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					  if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('17:20'))){
						  $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
					  }
				  }else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					   if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
						  $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
					   }
				  }
			}
		}//FIN JORNADA MIXTA MAÑANA Y TARDE

	}//FIN BUSQUEDA PSIQUIATRAS
	else{
		//INICIO PARA EL INGRESO USUARIOS NUEVOS
		if ($expediente == ""){
			$colores = "#008000"; //VERDE USUARIOS NUEVOS
			if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				$hora = "NuevosExcede";
			}else{
				if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
					$hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
				}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('12:40'))){
					$hora = $hora_h;
				}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('19:20'))){
				   $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
				   $hora = $hora_nueva;
				}else{
				   $hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
				}
			}
		}//FIN PARA EL INGRESO USUARIOS NUEVOS
		else{//INICIO PARA INGRESO USUARIOS SUBSIGUIENTES
			$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto;
			$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES

			if($consulta_subsiguientes_devuelto > $limite){
				$hora = "SubsiguienteExcede";
			}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){
				 $hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
			}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('12:40'))){
				 $hora = $hora_h;
			}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('19:20'))){
				 $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
				 $hora = $hora_nueva;
			}else{
				$hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
			}
		}
	}//FIN EVALUACIÓN UNIDADES
}
//FIN PARA EVALUAR QUE EXISTA REGISTRO DEL COLABORADOR EN LA ENTIDAD jornada_colaborador, VALIDANDO QUE TIENE JORNADA LABORAL ASIGNADA
else{
   $hora = "Vacio"; //EL PROFESIONAL NO TIENE ASIGNADA UNA JORNADA LABORAL, O SIMPLEMENTE NO TIENE UN SERVICIO ASIGNADO, NO SE LE PUEDEN AGENDAR USUARIOS
   $colores = "";
}

$datos = array(
	"hora" => $hora,
	"colores" => $colores
);

return $datos;
//FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
}

//FUNCION CORRECTA ANTES DEL COVID-19
/*
INICIO FUNCION CORRECTA ANTES DEL COVID-19
function getAgendatime($consultarJornadaJornada_id, $servicio, $consultarJornadaServicio_id, $consultar_colaborador_puesto_id, $expediente, $hora_h, $consulta_nuevos_devuelto, $consultarJornadaNuevos, $consultaJornadaTotal, $consulta_subsiguientes_devuelto){
   //INICIO EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
   $limite = 0;
   $hora = '';
   $hora_ = '';

   if($consultarJornadaJornada_id != "" && $servicio == $consultarJornadaServicio_id){//INICIO PARA EVALUAR QUE EXISTA REGISTRO DEL COLABORADOR EN LA ENTIDAD jornada_colaborador
	if($consultar_colaborador_puesto_id  == 2 || $consultar_colaborador_puesto_id == 4){//INICIO BUSQUEDA PSIQUIATRAS Y/O MEDICO GENERAL
		if($consultarJornadaJornada_id == 1){//INICIO JORNADA MATUTINA
			if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('9:20'))){//INICIO DE HORAS PARA USUARIOS NUEVOS
			   $colores = "#008000"; //VERDE USUARIOS NUEVOS
			   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				  $hora = "NuevosExcede";
			   }else{
				  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('14:40'))){
					 $hora = 'NulaSError';
				  }

				  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('23:20'))){
						$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
					 }
				  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
						$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
					 }
				   }
				}
			}//FIN DE HORAS PARA USUARIOS NUEVOS
			else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

				if($consulta_subsiguientes_devuelto > $limite){
					  $hora = "SubsiguienteExcede";
				}else if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('10:40'))){//1ER USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('11:20'))){//2DO USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//3ER USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//4TO USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//5T0 USUARIO SUBSIGUIENTE
				  $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				}else if($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//6TO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//7MO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//8VO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//9NO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//10MO USUARIO SUBSIGUIENTE
				  $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//11VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('18:00')) && $hora_h < date('H:i',strtotime('18:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('18:40')) && $hora_h < date('H:i',strtotime('19:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('19:20')) && $hora_h < date('H:i',strtotime('20:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('20:00')) && $hora_h < date('H:i',strtotime('20:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('20:40')) && $hora_h < date('H:i',strtotime('21:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('21:20')) && $hora_h < date('H:i',strtotime('22:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('22:00')) && $hora_h < date('H:i',strtotime('22:40'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PA	RA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('22:40')) && $hora_h < date('H:i',strtotime('23:20'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				}else if($hora_h >= date('H:i',strtotime('23:20'))){//CAMBIARE 18:00 POR 23:20
				   $hora = 'NulaSError';
				}

				if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('23:20'))){//CAMBIARE 17:20 POR
					   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
					}
				}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
					   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
					}
				}

			}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
		}//FIN JORNADA MATUTINA

		if($consultarJornadaJornada_id == 2){//INICIO JORNADA VESPERTINA
			if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('9:20'))){//INICIO DE HORAS PARA USUARIOS NUEVOS
			   $colores = "#008000"; //VERDE USUARIOS NUEVOS
			   if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				  $hora = "NuevosExcede";
			   }else{
				  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
					 $hora = "13:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('14:40'))){
					 $hora = 'NulaSError';
				  }

				  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('18:40'))){
						$hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
					 }
				  }else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					 if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
						$hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
					 }
				   }
				}
			}//FIN DE HORAS PARA USUARIOS NUEVOS
			else{//INICIO DE HORAS PARA USUARIOS SUBSIGUIENTES
				$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

				if($consulta_subsiguientes_devuelto > $limite){
					  $hora = "SubsiguienteExcede";
				}else if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('10:40'))){//1ER USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('11:20'))){//2DO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//3ER USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//4TO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//5T0 USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//6TO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//7MO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//8VO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//9NO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//10MO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//11VO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('17:20')) && $hora_h < date('H:i',strtotime('18:00'))){//12VO USUARIO SUBSIGUIENTE
				  $hora = "14:00";
				}else if($hora_h >= date('H:i',strtotime('18:00'))){
				   $hora = 'NulaSError';
				}

				if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('17:20'))){
					   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
					}
				}else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
					   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
					}
				}

			}//FIN DE HORAS PARA USUARIOS SUBSIGUIENTES
		}//FIN JORNADA VESPERTINA

		//INICIO JORNADA MIXTA MAÑANA Y TARDE
		if($consultarJornadaJornada_id == 3){
			if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h <= date('H:i',strtotime('9:20'))){//INICIO DE HORAS PARA USUARIOS NUEVOS
				$colores = "#008000"; //VERDE USUARIOS NUEVOS

				  if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
					  $hora = "NuevosExcede";
				  }else{
					  if ($hora_h >= date('H:i',strtotime('8:00')) && $hora_h < date('H:i',strtotime('8:40'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
						 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
					  }else if ($hora_h >= date('H:i',strtotime('8:40')) && $hora_h < date('H:i',strtotime('9:20'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
						 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
					  }else if ($hora_h >= date('H:i',strtotime('9:20')) && $hora_h < date('H:i',strtotime('10:00'))){//EVALUA LAS CITAS POR LA MAÑANA PARA QUE PUEDAN AGREGAR NUEVOS
						 $hora = "07:00"; //HORA PARA USUARIOS NUEVOS POR LA MAÑANA
					  }else if($hora_h >= date('H:i',strtotime('14:40'))){
						 $hora = 'NulaSError';
					  }

					if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
						if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('18:40'))){
						   $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES SUBSIGUIENTE
						}
					}else{//EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
						if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
						   $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES NUEVO
						}
					}
				 }
			}else{//USUARIOS SUBSIGUIENTE
				  $colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES
				  $limite = $consultaJornadaTotal - $consulta_nuevos_devuelto; //EVALUAMOS LA CANTIDAD DE USUARIOS DISPONIBLES PARA AGENDAR;

				  if($consulta_subsiguientes_devuelto > $limite){
					  $hora = "SubsiguienteExcede";
				  }else if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('10:40'))){//1ER USUARIO SUBSIGUIENTE
					 $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('10:40')) && $hora_h < date('H:i',strtotime('11:20'))){//2DO USUARIO SUBSIGUIENTE
					 $hora = "09:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if ($hora_h >= date('H:i',strtotime('11:20')) && $hora_h < date('H:i',strtotime('12:00'))){//3ER USUARIO SUBSIGUIENTE
					 $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('12:40'))){//4TO USUARIO SUBSIGUIENTE
					 $hora = "10:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if ($hora_h >= date('H:i',strtotime('12:40')) && $hora_h < date('H:i',strtotime('13:20'))){//5T0 USUARIO SUBSIGUIENTE
					 $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA MAÑANA
				  }else if($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('14:00'))){//6TO USUARIO SUBSIGUIENTE
					 $hora = "11:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if($hora_h >= date('H:i',strtotime('14:00')) && $hora_h < date('H:i',strtotime('14:40'))){//7MO USUARIO SUBSIGUIENTE
					 $hora = "12:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if($hora_h >= date('H:i',strtotime('14:40')) && $hora_h < date('H:i',strtotime('15:20'))){//7MO USUARIO SUBSIGUIENTE
					 $hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if($hora_h >= date('H:i',strtotime('15:20')) && $hora_h < date('H:i',strtotime('16:00'))){//7MO USUARIO SUBSIGUIENTE
					 $hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if($hora_h >= date('H:i',strtotime('16:00')) && $hora_h < date('H:i',strtotime('16:40'))){//7MO USUARIO SUBSIGUIENTE
					 $hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if($hora_h >= date('H:i',strtotime('16:40')) && $hora_h < date('H:i',strtotime('17:20'))){//7MO USUARIO SUBSIGUIENTE
					 $hora = "13:00"; //HORA PARA USUARIOS SUBSIGUIENTES POR LA TARDE
				  }else if($hora_h >= date('H:i',strtotime('17:20'))){
					 $hora = 'NulaSError';
				  }

				  if ( $expediente == ""){//EVALUA SI ES UN USUARIO NUEVO PARA EL CONTROL DE HORAS
					  if ($hora_h >= date('H:i',strtotime('10:00')) && $hora_h < date('H:i',strtotime('17:20'))){
						  $hora = 'NulaN';//ESTE ES UN USUARIO NUEVO, NO ES UN SUBSIGUIENTE
					  }
				  }else{///EVALUA SI ES UN USUARIO SUBSIGUIENTE PARA EL CONTROL DE HORAS
					   if ($hora_h >= date('H:i',strtotime('07:00')) && $hora_h < date('H:i',strtotime('10:00'))){
						  $hora = 'NulaS';//ESTE ES UN USUARIO SUBSIGUIENTE, NO ES UN USUARIO NUEVO
					   }
				  }
			}
		}//FIN JORNADA MIXTA MAÑANA Y TARDE

	}//FIN BUSQUEDA PSIQUIATRAS
	else{
		//INICIO PARA EL INGRESO USUARIOS NUEVOS
		if ($expediente == ""){
			$colores = "#008000"; //VERDE USUARIOS NUEVOS
			if($consulta_nuevos_devuelto > $consultarJornadaNuevos){
				$hora = "NuevosExcede";
			}else{
				if ($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('13:20'))){
					$hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
				}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('12:00'))){
					$hora = $hora_h;
				}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('19:20'))){
				   $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
				   $hora = $hora_nueva;
				}else{
				   $hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
				}
			}
		}//FIN PARA EL INGRESO USUARIOS NUEVOS
		else{//INICIO PARA INGRESO USUARIOS SUBSIGUIENTES
			$limite = $consultaJornadaTotal - $consulta_nuevos_devuelto;
			$colores = "#0071c5"; //AZUL OSCURO USUARIOS SUBSIGUIENTES

			if($consulta_subsiguientes_devuelto > $limite){
				$hora = "SubsiguienteExcede";
			}else if ($hora_h >= date('H:i',strtotime('12:00')) && $hora_h < date('H:i',strtotime('13:20'))){
				 $hora = "Nula"; //EVLAUA LA HORA DE ALMUERZO Y NO PERMITE AGENDAR USUARIOS EN ELLA
			}else if ($hora_h >= date('H:i',strtotime('08:00')) && $hora_h < date('H:i',strtotime('12:00'))){
				 $hora = $hora_h;
			}else if ($hora_h >= date('H:i',strtotime('13:20')) && $hora_h < date('H:i',strtotime('19:20'))){
				 $hora_nueva = date('H:i', strtotime('- 20 minute', strtotime($hora_h)));
				 $hora = $hora_nueva;
			}else{
				$hora = "NulaP"; //HORA NO PERMITIDA PARA AGENDAR
			}
		}
	}//FIN EVALUACIÓN UNIDADES
}//FIN PARA EVALUAR QUE EXISTA REGISTRO DEL COLABORADOR EN LA ENTIDAD jornada_colaborador
else{
   $hora = "Vacio"; //EL PROFESIONAL NO TIENE ASIGNADA UNA JORNADA LABORAL, O SIMPLEMENTE NO TIENE UN SERVICIO ASIGNADO, NO SE LE PUEDEN AGENDAR USUARIOS
   $colores = "";
}

$datos = array(
	"hora" => $hora,
	"colores" => $colores
);

return $datos;
//FIN EVALUACIÓN HORARIOS PARA LOS SERVICIOS SEGUN PROFESIONAL
}
FIN FUNCION CORRECTA ANTES DEL COVID-19
*/

function getEdad($fecha_de_nacimiento){
  $fecha_actual = date ("Y-m-d");

  // separamos en partes las fechas
  $array_nacimiento = explode ( "-", $fecha_de_nacimiento );
  $array_actual = explode ( "-", $fecha_actual );

  $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
  $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
  $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días

  //ajuste de posible negativo en $días
  if ($dias < 0) {
	--$meses;

	//ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
	switch ($array_actual[1]) {
	   case 1:     $dias_mes_anterior=31; break;
	   case 2:     $dias_mes_anterior=31; break;
	   case 3:
			if (bisiesto($array_actual[0])){
				$dias_mes_anterior=29; break;
			} else {
				$dias_mes_anterior=28; break;
			}
	   case 4:     $dias_mes_anterior=31; break;
	   case 5:     $dias_mes_anterior=30; break;
	   case 6:     $dias_mes_anterior=31; break;
	   case 7:     $dias_mes_anterior=30; break;
	   case 8:     $dias_mes_anterior=31; break;
	   case 9:     $dias_mes_anterior=31; break;
	   case 10:    $dias_mes_anterior=30; break;
	   case 11:    $dias_mes_anterior=31; break;
	   case 12:    $dias_mes_anterior=30; break;
	}

	$dias=$dias + $dias_mes_anterior;
 }

 //ajuste de posible negativo en $meses
 if ($meses < 0){
   --$anos;
   $meses=$meses + 12;
 }

 $datos = array(
	 "anos" => $anos,
	 "meses" => $meses,
	 "dias" => $dias
 );

 return $datos;
}

function historial_acceso($comentario, $nombre_host, $colaborador_id){
	$mysqli = connect_mysqli();
	$fecha = date("Y-m-d H:i:s");

   //OBTENER CORRELATIVO
   $correlativo= "SELECT MAX(acceso_id) AS max, COUNT(acceso_id) AS count
	  FROM historial_acceso";
	 $result = $mysqli->query($correlativo);
	 $correlativo2 = $result->fetch_assoc();

	 $numero = $correlativo2['max'];
	 $cantidad = $correlativo2['count'];

	 if ( $cantidad == 0 )
		$numero = 1;
	 else
	   $numero = $numero + 1;

   //CONSULTAR REGISTRO
	$consultar_registro = "SELECT acceso_id
		 FROM historial_acceso
		 WHERE acceso_id = '$numero'";
   $result_acceso = $mysqli->query($consultar_registro);

   if($result_acceso->num_rows==0){
	 $insert = "INSERT INTO historial_acceso
		VALUES('$numero','$fecha','$colaborador_id','$nombre_host','$comentario')";
	 $mysqli->query($insert);
  }

  $result->free();//LIMPIAR RESULTADO
  $result_acceso->free();//LIMPIAR RESULTADO
}

function sendSMS($to, $mensaje){
   date_default_timezone_set('America/Tegucigalpa');

   $from = consultarFrom();
   $apy_key = consultarApi_key();
   $send_at = date("Y-m-d H:i:s");

   $request = '{
	  "api_key":"'.$apy_key.'",
	  "concat":1,
	  "messages":[
		{
		   "from":"'.$from.'",
		   "to":"'.$to.'",
		   "text":"'.$mensaje.'",
		   "send_at":"'.$send_at.'"
		}
	]
   }';

   $headers = array('Content-Type: application/json');
   $ch = curl_init('https://api.gateway360.com/api/3.0/sms/send');
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

   $result = curl_exec($ch);

   if (curl_errno($ch) != 0 ){
	  die("curl error: ".curl_errno($ch));
   }

   return $result;
}

function consultarFrom(){
   $mysqli = connect_mysqli();

   //CONSULTAR CONEXION SMS UP
   $query_sms = "SELECT * FROM sms_up";
   $result = $mysqli->query($query_sms);
   $correlativo2 = $result->fetch_assoc();

   $from = $correlativo2['from_'];

   return $from;
}

function consultarApi_key(){
   $mysqli = connect_mysqli();

   //CONSULTAR CONEXION SMS UP
   $query_sms = "SELECT * FROM sms_up";
   $result = $mysqli->query($query_sms);
   $correlativo2 = $result->fetch_assoc();

   $apy_key = $correlativo2['api_key'];

   return $apy_key;
}

/*INICIO CONVERTIR NUMEROS A LETRAS*/
function unidad($numuero){
	switch ($numuero){
		case 9:{
			$numu = "NUEVE";
			break;
		}
		case 8:{
			$numu = "OCHO";
			break;
		}
		case 7:{
			$numu = "SIETE";
			break;
		}
		case 6:{
			$numu = "SEIS";
			break;
		}
		case 5:{
			$numu = "CINCO";
			break;
		}
		case 4:{
			$numu = "CUATRO";
			break;
		}
		case 3:{
			$numu = "TRES";
			break;
		}
		case 2:{
			$numu = "DOS";
			break;
		}
		case 1:{
			$numu = "UNO";
			break;
		}
		case 0:{
			$numu = "";
			break;
		}
	}
	return $numu;
}

function decena($numdero){
	if ($numdero >= 90 && $numdero <= 99){
		$numd = "NOVENTA ";
		if ($numdero > 90)
			$numd = $numd."Y ".(unidad($numdero - 90));
	}
	else if ($numdero >= 80 && $numdero <= 89){
		$numd = "OCHENTA ";
		if ($numdero > 80)
			$numd = $numd."Y ".(unidad($numdero - 80));
	}
	else if ($numdero >= 70 && $numdero <= 79){
		$numd = "SETENTA ";
		if ($numdero > 70)
		$numd = $numd."Y ".(unidad($numdero - 70));
	}
	else if ($numdero >= 60 && $numdero <= 69){
		$numd = "SESENTA ";
		if ($numdero > 60)
		$numd = $numd."Y ".(unidad($numdero - 60));
	}
	else if ($numdero >= 50 && $numdero <= 59){
		$numd = "CINCUENTA ";
		if ($numdero > 50)
		$numd = $numd."Y ".(unidad($numdero - 50));
	}
	else if ($numdero >= 40 && $numdero <= 49){
		$numd = "CUARENTA ";
		if ($numdero > 40)
		$numd = $numd."Y ".(unidad($numdero - 40));
	}
	else if ($numdero >= 30 && $numdero <= 39){
		$numd = "TREINTA ";
		if ($numdero > 30)
		$numd = $numd."Y ".(unidad($numdero - 30));
	}
	else if ($numdero >= 20 && $numdero <= 29){
		if ($numdero == 20)
		$numd = "VEINTE ";
		else
		$numd = "VEINTI".(unidad($numdero - 20));
	}
	else if ($numdero >= 10 && $numdero <= 19)
	{
		switch ($numdero){
			case 10:{
				$numd = "DIEZ ";
				break;
			}
			case 11:{
				$numd = "ONCE ";
				break;
			}
			case 12:{
				$numd = "DOCE ";
				break;
			}
			case 13:{
				$numd = "TRECE ";
				break;
			}
			case 14:{
				$numd = "CATORCE ";
				break;
			}
			case 15:{
				$numd = "QUINCE ";
				break;
			}
			case 16:{
				$numd = "DIECISEIS ";
				break;
			}
			case 17:{
				$numd = "DIECISIETE ";
				break;
			}
			case 18:{
				$numd = "DIECIOCHO ";
				break;
			}
			case 19:{
				$numd = "DIECINUEVE ";
				break;
			}
		}
	}
	else
		$numd = unidad($numdero);
	return $numd;
}

function centena($numc){
	if ($numc >= 100){
		if ($numc >= 900 && $numc <= 999){
			$numce = "NOVECIENTOS ";
		if ($numc > 900)
			$numce = $numce.(decena($numc - 900));
		}
		else if ($numc >= 800 && $numc <= 899){
			$numce = "OCHOCIENTOS ";
			if ($numc > 800)
				$numce = $numce.(decena($numc - 800));
		}
		else if ($numc >= 700 && $numc <= 799){
			$numce = "SETECIENTOS ";
			if ($numc > 700)
				$numce = $numce.(decena($numc - 700));
		}
		else if ($numc >= 600 && $numc <= 699){
			$numce = "SEISCIENTOS ";
			if ($numc > 600)
				$numce = $numce.(decena($numc - 600));
		}
		else if ($numc >= 500 && $numc <= 599){
			$numce = "QUINIENTOS ";
			if ($numc > 500)
				$numce = $numce.(decena($numc - 500));
		}
		else if ($numc >= 400 && $numc <= 499){
			$numce = "CUATROCIENTOS ";
			if ($numc > 400)
				$numce = $numce.(decena($numc - 400));
		}
		else if ($numc >= 300 && $numc <= 399){
			$numce = "TRESCIENTOS ";
			if ($numc > 300)
				$numce = $numce.(decena($numc - 300));
		}
		else if ($numc >= 200 && $numc <= 299){
			$numce = "DOSCIENTOS ";
			if ($numc > 200)
				$numce = $numce.(decena($numc - 200));
		}
		else if ($numc >= 100 && $numc <= 199){
			if ($numc == 100)
			$numce = "CIEN ";
			else
				$numce = "CIENTO ".(decena($numc - 100));
		}
	}
	else
		$numce = decena($numc);
		return $numce;
}

function miles($nummero){
	if ($nummero >= 1000 && $nummero < 2000){
		$numm = "MIL ".(centena($nummero%1000));
	}
	if ($nummero >= 2000 && $nummero <10000){
		$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
	}
	if ($nummero < 1000)
		$numm = centena($nummero);

	return $numm;
}

function decmiles($numdmero){
	if ($numdmero == 10000)
		$numde = "DIEZ MIL";
	if ($numdmero > 10000 && $numdmero <20000){
		$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
	}
	if ($numdmero >= 20000 && $numdmero <100000){
		$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
	}
	if ($numdmero < 10000)
		$numde = miles($numdmero);

	return $numde;
}

function cienmiles($numcmero){
	if ($numcmero == 100000)
		$num_letracm = "CIEN MIL";
	if ($numcmero >= 100000 && $numcmero <1000000){
		$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
	}
	if ($numcmero < 100000)
		$num_letracm = decmiles($numcmero);
	return $num_letracm;
}

function millon($nummiero){
	if ($nummiero >= 1000000 && $nummiero <2000000){
		$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
	}
	if ($nummiero >= 2000000 && $nummiero <10000000){
		$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
	}
	if ($nummiero < 1000000)
		$num_letramm = cienmiles($nummiero);

	return $num_letramm;
}

function decmillon($numerodm){
	if ($numerodm == 10000000)
		$num_letradmm = "DIEZ MILLONES";
	if ($numerodm > 10000000 && $numerodm <20000000){
		$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
	}
	if ($numerodm >= 20000000 && $numerodm <100000000){
		$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
	}
	if ($numerodm < 10000000)
		$num_letradmm = millon($numerodm);

	return $num_letradmm;
}

function cienmillon($numcmeros){
	if ($numcmeros == 100000000)
		$num_letracms = "CIEN MILLONES";
	if ($numcmeros >= 100000000 && $numcmeros <1000000000){
		$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
	}
	if ($numcmeros < 100000000)
		$num_letracms = decmillon($numcmeros);
	return $num_letracms;
}

function milmillon($nummierod){
	if ($nummierod >= 1000000000 && $nummierod <2000000000){
		$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
	}
	if ($nummierod >= 2000000000 && $nummierod <10000000000){
		$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
	}
	if ($nummierod < 1000000000)
		$num_letrammd = cienmillon($nummierod);

	return $num_letrammd;
}


function convertir($numero){
	$num = str_replace(",","",$numero);
	$num = number_format($num,2,'.','');
	$cents = substr($num,strlen($num)-2,strlen($num)-1);
	$num = (int)$num;

	$numf = milmillon($num);

	return $numf." CON ".$cents."/100";
}
/*INICIO CONVERTIR NUMEROS A LETRAS*/

function eliminar_acentos($cadena){
	//Reemplazamos la A y a
	$cadena = str_replace(
	array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
	array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
	$cadena
	);

	//Reemplazamos la E y e
	$cadena = str_replace(
	array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
	array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	$cadena );

	//Reemplazamos la I y i
	$cadena = str_replace(
	array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
	array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	$cadena );

	//Reemplazamos la O y o
	$cadena = str_replace(
	array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
	array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	$cadena );

	//Reemplazamos la U y u
	$cadena = str_replace(
	array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
	array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	$cadena );

	//Reemplazamos la N, n, C y c
	$cadena = str_replace(
	array('Ñ', 'ñ', 'Ç', 'ç'),
	array('N', 'n', 'C', 'c'),
	$cadena
	);

	return $cadena;
}

/*Funcion que permite limpiar valores de los string (Inyección SQL)*/
function cleanString($string){
	//Limpia espacios al inicio y al final
	$string =  trim($string);

	//Quita las barras de un string con comillas escapadas
	$string = stripslashes($string);

	//Limpiar etiquetas de JavaScript o Instrucciones SQL entre otros
	$string = str_ireplace("<script>", "", $string);
	$string = str_ireplace("</script>", "", $string);
	$string = str_ireplace("<script src>", "", $string);
	$string = str_ireplace("<script type>", "", $string);
	$string = str_ireplace("SELECT * FROM", "", $string);
	$string = str_ireplace("DELETE FROM", "", $string);
	$string = str_ireplace("INSERT INTO", "", $string);
	$string = str_ireplace("UPDATE", "", $string);
	$string = str_ireplace("--", "", $string);
	$string = str_ireplace("^", "", $string);
	$string = str_ireplace("]", "", $string);
	$string = str_ireplace("[", "", $string);
	$string = str_ireplace("{", "", $string);
	$string = str_ireplace("}", "", $string);
	$string = str_ireplace("==", "", $string);

	return $string;
        }

function cleanStringStrtolower($string){
	//Limpia espacios al inicio y al final
	$string =  trim($string);

	//Quita las barras de un string con comillas escapadas
	$string = stripslashes($string);

	//Limpiar etiquetas de JavaScript o Instrucciones SQL entre otros
	$string = str_ireplace("<script>", "", $string);
	$string = str_ireplace("</script>", "", $string);
	$string = str_ireplace("<script src>", "", $string);
	$string = str_ireplace("<script type>", "", $string);
	$string = str_ireplace("SELECT * FROM", "", $string);
	$string = str_ireplace("DELETE FROM", "", $string);
	$string = str_ireplace("INSERT INTO", "", $string);
	$string = str_ireplace("UPDATE", "", $string);
	$string = str_ireplace("--", "", $string);
	$string = str_ireplace("^", "", $string);
	$string = str_ireplace("]", "", $string);
	$string = str_ireplace("[", "", $string);
	$string = str_ireplace("{", "", $string);
	$string = str_ireplace("}", "", $string);
	$string = str_ireplace("'", "", $string);
	$string = str_ireplace("==", "", $string);
	$string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");

	return $string;
}

function getHolidays($year = null)
{
  if ($year === null)
  {
    $year = intval(date('Y'));
  }

  $easterDate  = easter_date($year);
  $easterDay   = date('j', $easterDate);
  $easterMonth = date('n', $easterDate);
  $easterYear   = date('Y', $easterDate);

  $holidays = array(
    // These days have a fixed date
    mktime(0, 0, 0, 1,  1,  $year),  // 1er janvier
    mktime(0, 0, 0, 5,  1,  $year),  // Fête du travail
    mktime(0, 0, 0, 5,  8,  $year),  // Victoire des alliés
    mktime(0, 0, 0, 7,  14, $year),  // Fête nationale
    mktime(0, 0, 0, 8,  15, $year),  // Assomption
    mktime(0, 0, 0, 11, 1,  $year),  // Toussaint
    mktime(0, 0, 0, 11, 11, $year),  // Armistice
    mktime(0, 0, 0, 12, 25, $year),  // Noel

    // These days have a date depending on easter
    mktime(0, 0, 0, $easterMonth, $easterDay + 2,  $easterYear),
    mktime(0, 0, 0, $easterMonth, $easterDay + 40, $easterYear),
    mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear),
  );

  sort($holidays);

  return $holidays;
}
//OBTENER LA DISPONIBILDIAD DEL PROFESIONA, VERIFANCO QUE NO TENGA OCUPADA LA HORA DE ATENCION PARA QUE NO CONCUERDE CON OTRO SERVICIO
function getDisponibilidadDiponibilidadHorarioColaborador($colaborador_id, $fecha_cita){
	$mysqli = connect_mysqli();
	$resp = 2;//1. Si, 2. No
	$query = "SELECT agenda_id
		FROM agenda
		WHERE colaborador_id = '$colaborador_id' AND fecha_cita = '$fecha_cita'";
	$result = $mysqli->query($query);

	if($result->num_rows>0){
		$resp = 1;
	}

	return $resp;
}
?>
