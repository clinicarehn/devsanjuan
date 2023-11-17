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

$consultar_registros = "SELECT COUNT(a.pacientes_id) AS 'total' 
FROM agenda AS a
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
WHERE CAST(a.fecha_cita AS DATE) BETWEEN '$fecha_inicial' AND '$nuevafecha' AND a.postclinica = 1 AND c.puesto_id = 2";
$result = $mysqli->query($consultar_registros);

$consultar_registros2 = $result->fetch_assoc();
$total_agenda = $consultar_registros2['total'];

if($fecha == $fecha_inicial){
	$total_agenda = 0;
}
/*FIN DE EVALUACION DE PENDIENTES AGENDA*/

/*EVALUAR PENDIENTES HOSPITALIZACION*/
//OBTENER PUESTO_ID
$consulta_puesto = "SELECT puesto_id, CONCAT(nombre,' ',apellido) AS 'nombre' 
    FROM colaboradores 
	WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consulta_puesto);
$consulta_puesto2 = $result->fetch_assoc();
$consulta_puesto_id = $consulta_puesto2['puesto_id'];
$consulta_colaborador = $consulta_puesto2['nombre'];

if(".$consulta_colaborador."  == ""){
   $consulta_puesto = "SELECT puesto_id, CONCAT(nombre,' ',apellido) AS 'nombre' 
       FROM colaboradores 
	   WHERE colaborador_id = '$colaborador_id'";
   $result = $mysqli->query($consulta_puesto);
   $consulta_puesto2 = $result->fetch_assoc();
   $consulta_puesto_id = $consulta_puesto2['puesto_id'];
   $consulta_colaborador = $consulta_puesto2['nombre'];
}

if($total_agenda == 1){
	$string_agenda = "registro pendiente";
}else{
	$string_agenda = "registros pendientes";
}

//CONSULTAR CORREO
$consulta_correo = "SELECT email 
   FROM users WHERE colaborador_id = '$colaborador_id'";
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
$cc1 = "corenfermeria@hsjddhn.com";
$cc2 = "corenfermeria01@hsjddhn.com";
$cc3 = "hsanjuandedios@hsjddhn.com";
$asunto = "Registros Pendientes\n";
$from = "Registros Pendientes";

$sistema = "https://181.115.46.150:2030/";
$logo = "https://hsjddhn.com/wp-content/uploads/2017/09/cropped-Logo4-1.png";
$firma = "https://hsjddhn.com/firmas/firma.png";

  $mensaje="
       <table class='table table-striped table-responsive-md btn-table'>
         <tr>
            <td colspan='2'><center><img width='45%' heigh='40%' src='".$logo."'></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h4>Reporte de Registros Pendientes</h4></b></center></td>
         </tr>
         <tr>
            <td colspan='2'><center><b><h3><center><b>Postclinica</b></center></h3></b></center></td>
         </tr>		 
         <tr>
            <td>
	           <p style='text-align: justify'>
			      Estimado(a) <b>".$consulta_colaborador."</b>, se le recuerda que tiene un total de <b>".$total_agenda."</b> ".$string_agenda." en el mes de <b>".$mes_actual.", ".$año.".
		          </b><br/>Los cuales debe realizar la Postclinica. No debe dejar ningun registro pendiente dentro de este mes.
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

//ENVIAMOS EL CORREO ELECTRONICO
sendMail($servidor, $puerto, $contraseña, $CharSet, $SMTPSecure , $de, $para, $from, $asunto, $mensaje);

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>