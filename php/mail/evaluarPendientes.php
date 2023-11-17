<?php 
include('../funtions.php');
session_start();
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

/*EVALUAR PENDIENTES EN EL AGENDA*/
$colaborador_id = $_SESSION['colaborador_id'];
$fecha = date("Y-m-d");

//FECHA
$año = date("Y", strtotime($fecha));
$mes = date("m", strtotime($fecha));
$dia = date("d", mktime(0,0,0, $mes+1, 0, $año));

$dia1 = date('d', mktime(0,0,0, $mes, 1, $año)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes, $dia, $año)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año."-".$mes."-".$dia1));
$nuevafecha = date("Y-m-d", strtotime ( '-1 day' , strtotime ( $fecha )));

$mes_actual =nombremes(date("m", strtotime($fecha)));

$consultar_puesto_colaborador = "SELECT puesto_id 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_puesto_colaborador);
$consultar_puesto_colaborador2 = $result->fetch_assoc();
$puesto_colaboradores = $consultar_puesto_colaborador2['puesto_id'];

if ($puesto_colaboradores == 2 || $puesto_colaboradores == 4){	 
    $consultar_registros = "SELECT COUNT(pacientes_id) AS 'total' 
	     FROM agenda 
         WHERE CAST(fecha_cita AS DATE) BETWEEN '$fecha_inicial' AND '$nuevafecha' AND status = 0 and preclinica = 1 AND colaborador_id = '$colaborador_id'";		 
}else{	 	 
    $consultar_registros = "SELECT COUNT(pacientes_id) AS 'total' 
	     FROM agenda 
         WHERE CAST(fecha_cita AS DATE) BETWEEN '$fecha_inicial' AND '$nuevafecha' AND status = 0 AND colaborador_id = '$colaborador_id'";		 
}

$result = $mysqli->query($consultar_registros);
$consultar_registros2 = $result->fetch_assoc();
$total_agenda = $consultar_registros2['total'];

if($fecha == $fecha_inicial){
	$total_agenda = 0;
}
/*FIN DE EVALUACION DE PENDIENTES AGENDA*/

/*EVALUAR PENDIENTES HOSPITALIZACION*/
//OBTENER PUESTO_ID
$consulta_puesto = "SELECT puesto_id, CONCAT(c.nombre,' ',c.apellido) AS 'nombre' 
     FROM colaboradores AS c 
     INNER JOIN servicios_puestos AS s
     ON c.colaborador_id = s.colaborador_id
     WHERE c.colaborador_id = '$colaborador_id' AND (s.servicio_id = 3 OR s.servicio_id = 4)
     GROUP BY 1";
$result = $mysqli->query($consulta_puesto);	 
	 
$consulta_puesto2 = $result->fetch_assoc();
$consulta_puesto_id = $consulta_puesto2['puesto_id'];
$consulta_colaborador = $consulta_puesto2['nombre'];

if($consulta_colaborador  == ""){
   $consulta_puesto = "SELECT puesto_id, CONCAT(nombre,' ',apellido) AS 'nombre' 
        FROM colaboradores 
		WHERE colaborador_id = '$colaborador_id'";
   $result = $mysqli->query($consulta_puesto);
   $consulta_puesto2 = $result->fetch_assoc();
   $consulta_puesto_id = $consulta_puesto2['puesto_id'];
   $consulta_colaborador = $consulta_puesto2['nombre'];
}

/*EVALUAR SI EL PROFESIONAL ES ENCARGADO DE HOSPITALIZACIÓN*/
//MAIDA
$consuta_disponible_hospitalizacipon_maida = "SELECT id 
    FROM servicios_puestos 
	WHERE servicio_id = 3 AND colaborador_id = '$colaborador_id'";
	$result = $mysqli->query($consuta_disponible_hospitalizacipon_maida);
$consuta_disponible_hospitalizacipon_maida2 = $result->fetch_assoc();
$servicio_hospitalizacion_maida = $consuta_disponible_hospitalizacipon_maida2['id'];

//SALON DEL HUESPED
$consuta_disponible_hospitalizacipon_salon = "SELECT id 
     FROM servicios_puestos 
	 WHERE servicio_id = 4 AND colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consuta_disponible_hospitalizacipon_salon);
$consuta_disponible_hospitalizacipon_salon2 = $result->fetch_assoc();
$servicio_hospitalizacion_salon = $consuta_disponible_hospitalizacipon_salon2['id'];

$flag_hospitalizaicion = false;

if($servicio_hospitalizacion_maida != "" && $servicio_hospitalizacion_salon == ""){
   $consultar_registros = "SELECT COUNT(hosp_id) AS 'total' 
      FROM hospitalizacion
      WHERE fecha BETWEEN '$fecha_inicial' AND '$nuevafecha' AND estado IN(0,3) AND puesto_id = '$consulta_puesto_id'";
   $result = $mysqli->query($consultar_registros);

   $consultar_registros2 = $result->fetch_assoc();
   $total_hospitalizacion = $consultar_registros2['total'];
}else if($servicio_hospitalizacion_salon != "" && $servicio_hospitalizacion_maida == ""){
   $consultar_registros = "SELECT COUNT(hosp_id) AS 'total' 
      FROM hospitalizacion
      WHERE fecha BETWEEN '$fecha_inicial' AND '$nuevafecha' AND estado IN(0,3) AND puesto_id = '$consulta_puesto_id'";
   $result = $mysqli->query($consultar_registros);

   $consultar_registros2 = $result->fetch_assoc();
   $total_hospitalizacion = $consultar_registros2['total'];	
}else if($servicio_hospitalizacion_maida != "" && $servicio_hospitalizacion_salon != ""){
   $consultar_registros = "SELECT COUNT(hosp_id) AS 'total' 
      FROM hospitalizacion
      WHERE fecha BETWEEN '$fecha_inicial' AND '$nuevafecha' AND estado IN(0,3)  AND puesto_id = '$consulta_puesto_id'";
   $result = $mysqli->query($consultar_registros);
   $consultar_registros2 = $result->fetch_assoc();
   $total_hospitalizacion = $consultar_registros2['total'];
}else{
   $total_hospitalizacion = 0;
}

if($fecha == $fecha_inicial){
	$total_hospitalizacion = 0;
}

if($total_agenda == 1){
	$string_agenda = "registro pendiente";
}else{
	$string_agenda = "registros pendientes";
}

if($total_hospitalizacion == 1){
	$string_hospitalizacion = "registro pendiente";
}else{
	$string_hospitalizacion = "registros pendientes";
}

//CONSULTAR CORREO
$consulta_correo = "SELECT email 
    FROM users 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_correo);
$consulta_correo2 = $result->fetch_assoc();
$correo_consulta = $consulta_correo2['email'];
   
$de = SUPPORT_USER;
$contraseña = SUPPORT_PASS;	
$servidor = "smtp.office365.com";
$puerto = "587";
$SMTPSecure = "tls";
$CharSet = "UTF-8";	
$para = $correo_consulta;
$cc1 = "subdasistencial@hsjddhn.com";
$cc2 = "psiquiatria1@hsjddhn.com";
$cc3 = "hsanjuandedios@hsjddhn.com";
$sistema = "https://181.115.46.150:2030/";
$logo = "https://hsjddhn.com/wp-content/uploads/2017/09/cropped-Logo4-1.png";
$firma = "https://hsjddhn.com/firmas/firma.png";

$asunto = "Registros Pendientes\n";
$mensaje = "";
$from = "Pendientes";

if(".$total_agenda." > 0 && $total_hospitalizacion == 0){
    $mensaje="
       <table class='table table-striped table-responsive-md btn-table'>
         <tr>
            <td colspan='2'><center><img width='45%' heigh='40%' src='".$logo."'></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h4>Reporte de Registros Pendientes</h4></b></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h3><center><b>Agenda</b></center></h3></b></center></td>
         </tr>		 
         <tr>
            <td>
	           <p style='text-align: justify'>Estimado(a) <b>".$consulta_colaborador."</b>, se le recuerda que tiene un total de <b>".$total_agenda."</b> ".$string_agenda." en el mes de <b>".$mes_actual.", ".$año.".
			   </b><br/>Por favor ingresar la atencion de los usuarios. No debe dejar ningun registro pendiente dentro de este mes.
			   <a href='".$sistema."'>Presione este enlace para acceder al Sistema Hospitalario</a>
               </p>
	       </td>
         </tr>
         <tr>
            <td>
               <p style='text-align: justify; font-size:12px;'><b>
		 	   Este mensaje ha sido enviado de forma automática, por favor no responder este correo. Cualquier duda o consulta envié un correo electrónico a:  gestionsistemas@hsjddhn.com, o puede marcar  a nuestra PBX: 2512-0870 Ext. 116.<br/>Haciendo el bien a los demás nos hacemos el bien a nosotros mismos.
			   </b></p>
	        </td>
		  </tr>
		 <tr>
            <td>
               <p><img width='100%' heigh='100%' src='".$firma."'></p>
	        </td>			  
         </tr>   
       </table>
    ";	
		 
}else if(".$total_agenda." == 0 && $total_hospitalizacion > 0){
  $mensaje="
       <table class='table table-striped table-responsive-md btn-table'>
         <tr>
            <td colspan='2'><center><img width='45%' heigh='40%' src='".$logo."'></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h4>Reporte de Registros Pendientes</h4></b></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h3><center><b>Hospitalización</b></center></h3></b></center></td>
         </tr>		 
         <tr>
            <td>
	           <p style='text-align: justify'>Estimado(a) <b>".$consulta_colaborador."</b>, se le recuerda que tiene un total de <b>$total_hospitalizacion</b> ".$string_agenda." en el mes de <b>".$mes_actual.", ".$año.".
			   </b><br/>Por favor ingresar la atencion de los usuarios. No debe dejar ningun registro pendiente dentro de este mes.
			   <a href='".$sistema."'>Presione este enlace para acceder al Sistema Hospitalario</a>		  
               Cualquier duda o consulta por favor comunicarse con el Departamento de Sistemas Ext. 116.
               Haciendo el bien a los demas, nos hacemos el bien a nosotros mismos
               </p>
	       </td>
         </tr>
         <tr>
            <td>
               <p style='text-align: justify; font-size:12px;'><b>
		 	   Este mensaje ha sido enviado de forma automática, por favor no responder este correo. Cualquier duda o consulta por favor enviar un correo electrónico a:  gestionsistemas@hsjddhn.com, o puede marcar  a nuestra PBX: 2512-0870 Ext. 116.<br/>Haciendo el bien a los demás nos hacemos el bien a nosotros mismos.
			   </b></p>
	        </td>
		  </tr>
		 <tr>
            <td>
               <p><img width='100%' heigh='100%' src='".$firma."'></p>
	        </td>			  
         </tr>   
       </table>
    ";	
}else if(".$total_agenda." > 0 && $total_hospitalizacion > 0){				
  $mensaje="
       <table class='table table-striped table-responsive-md btn-table'>
         <tr>
            <td colspan='2'><center><img width='45%' heigh='40%' src='".$logo."'></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h4>Reporte de Registros Pendientes</h4></b></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h3><center><b>Agenda</b></center></h3></b></center></td>
         </tr>		 
         <tr>
            <td>
	           <p style='text-align: justify'>Estimado(a) <b>".$consulta_colaborador"</b>, se le recuerda que tiene un total de <b>".$total_agenda."</b> ".$string_agenda." en el ATA y <b>$total_hospitalizacion</b> ".$string_agenda." en Hospitalización, en el mes de <b>".$mes_actual.", ".$año.".
			   </b><br/>Por favor ingresar la atencion de los usuarios. No debe dejar ningun registro pendiente dentro de este mes.
			   <a href='".$sistema."'>Presione este enlace para acceder al Sistema Hospitalario</a>		  
               Cualquier duda o consulta por favor comunicarse con el Departamento de Sistemas Ext. 116.
               Haciendo el bien a los demas, nos hacemos el bien a nosotros mismos
               </p>
	       </td>
         </tr>
         <tr>
            <td>
               <p style='text-align: justify; font-size:12px;'><b>
		 	   Este mensaje ha sido enviado de forma automática, por favor no responder este correo. Cualquier duda o consulta por favor enviar un correo electrónico a:  gestionsistemas@hsjddhn.com, o puede marcar  a nuestra PBX: 2512-0870 Ext. 116.<br/>Haciendo el bien a los demás nos hacemos el bien a nosotros mismos.
			   </b></p>
	        </td>
		  </tr>
		 <tr>
            <td>
               <p><img width='100%' heigh='100%' src='".$firma."'></p>
	        </td>			  
         </tr>   
       </table>
    ";				
}

//ENVIAMOS EL CORREO ELECTRONICO
sendMail($servidor, $puerto, $contraseña, $CharSet, $SMTPSecure , $de, $para, $from, $asunto, $mensaje);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>