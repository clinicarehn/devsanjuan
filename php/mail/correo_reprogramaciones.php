<?php
include('../funtions.php');
session_start();
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');
$agenda_id = $_POST['agenda_id'];

//CONSULTAR DATOS DE LA AGENDA
$consultar_paciente_agenda = "SELECT pacientes_id, colaborador_id, 	hora, CAST(fecha_cita AS DATE) AS 'fecha_cita', servicio_id, reprogramo, DATE_FORMAT(fecha_registro, '%d/%m/%Y %h:%i:%s %p') AS 'fecha_registro' 
    FROM agenda 
	WHERE agenda_id = '$agenda_id'";
$result = $mysqli->query($consultar_paciente_agenda);	
$consultar_paciente_agenda2 = $result->fetch_assoc();	
$pacientes_id = $consultar_paciente_agenda2['pacientes_id'];
$medico = $consultar_paciente_agenda2['colaborador_id'];	
$fecha_cita = $consultar_paciente_agenda2['fecha_cita'];
$hora = date('g:i a',strtotime($consultar_paciente_agenda2['hora']));		
$servicio = $consultar_paciente_agenda2['servicio_id'];	
$reprogramo = $consultar_paciente_agenda2['reprogramo'];
$reprogramo_cita = "";
$fecha_registro = $consultar_paciente_agenda2['fecha_registro'];

if($reprogramo == 1){
	$reprogramo_cita = "(Reprogramación)";
}else{
	$reprogramo_cita = "";
}	

//CONSULTAR NOMBRE DE PROFESIONAL
$consulta_nombre_profesional = "SELECT CONCAT(nombre,' ',apellido) AS nombre , puesto_id
    FROM colaboradores 
	WHERE colaborador_id = '$medico'";
$result = $mysqli->query($consulta_nombre_profesional);	

$consulta_nombre_profesional2 = $result->fetch_assoc();	
$nombre_colaborador = $consulta_nombre_profesional2['nombre'];
$consultar_colaborador = $consulta_nombre_profesional2['puesto_id'];

//OBTENER CORREO ELECTRONICO DEL USUARIO
$consulta_correo = "SELECT email, CONCAT(nombre,' ',apellido) AS nombre, expediente, identidad 
     FROM pacientes 
	 WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consulta_correo);
	 
$consulta_correo2 = $result->fetch_assoc();	
$para = $consulta_correo2['email'];
$nombre = $consulta_correo2['nombre'];

if($consulta_correo2['expediente'] == 0 ){
   $expediente = "TEMP";	
}else{
   $expediente = $consulta_correo2['expediente'];	
}
	
$identidad = $consulta_correo2['identidad'];	

//CONSULTRA NOMBRE DE SERVICIO
$consulta_nombre_servicio = "SELECT nombre 
   FROM servicios 
   WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_nombre_servicio);

$consulta_nombre_servicio2 = $result->fetch_assoc();	
$nombre_servicio = $consulta_nombre_servicio2['nombre'];

//CONOCER EL TIPO DE USUARIO
$consultar_expediente = "SELECT a.agenda_id AS 'agenda_id'
    FROM agenda AS a
    INNER JOIN colaboradores AS c
	ON a.colaborador_id = c.colaborador_id
    WHERE pacientes_id = '$pacientes_id' AND a.servicio_id = '$servicio' AND c.puesto_id = '$consultar_colaborador' AND a.status = 1";
$result = $mysqli->query($consultar_expediente);	

$consultar_expediente1 = $result->fetch_assoc();   

if($consultar_expediente1['agenda_id'] == ""){
   $usuario = 'Nuevo'; 
}else{
   $usuario = 'Subsiguiente';
} 
	
$de = "reprogramaciones@hsjddhn.com";
$contraseña = 'S@nhn2023%CLIN';	
$servidor = "smtp.office365.com";
$puerto = "587";
$SMTPSecure = "tls";
$CharSet = "UTF-8";		
$from = "Reprogramación de Citas";		   
$asunto = "Reprogramación de Cita";

$logo = "https://hsjddhn.com/wp-content/uploads/2017/09/cropped-Logo4-1.png";
$firma = "https://hsjddhn.com/firmas/firma.png";
$sitio_web = "http://hsjddhn.com/";
$facebook = "https://www.facebook.com/HospitalSanJuandeDiosHN/";
$correo1 = "admision@hsjddhn.com";
$correo2 = "admision2@hsjddhn.com";
$telefono = "+504 2512-0870";
$whatsapp = "+504 9468-6195";
$horario = "Lunes a Viernes: 7:00am a 4:00pm";

$mensaje="
   <table class='table table-striped table-responsive-md btn-table'>
       <tr>
          <td colspan='2'><center><img width='45%' heigh='40%' src='".$logo."'></center></td>
       </tr>
       <tr>
          <td colspan='2'><center><b><h4>Reprogramación de Cita</h4></b></center></td>
       </tr>
	   <tr>
	       <td colspan='2'><b>Estimado(a) ".$nombre.", se le informa que se ha reprogramado su cita, los detalles de esta a continuación.</b></td>
	   </tr>
	   <tr>
	       <td><b>Identidad:</b></td>
		   <td>".$identidad."</td>		
	   </tr>
	   <tr>
	       <td><b>Expediente:</b></td>
		   <td>".$expediente."</td>		
	   </tr>	   
	   <tr>
	       <td><b>Fecha Cita:</b></td>
		   <td>".$fecha_cita."</td>
	   </tr>
	   <tr>
	       <td><b>Tipo de Cita:</b></td>
		   <td>".$usuario." ".$reprogramo_cita."</td>
	   </tr>	   
	   <tr>
	       <td><b>Hora:</b></td>
		   <td>".$hora."</td>
	   </tr>	
	   <tr>
	       <td><b>Profesional:</b></td>
		   <td>".$nombre_colaborador."</td>
	   </tr>
	   <tr>
	       <td><b>Servicio:</b></td>
		   <td>".$nombre_servicio."</td>
	   </tr>
	   <tr>
	       <td><b>Fecha de Registro:</b></td>
		   <td>".$fecha_registro."</td>
	   </tr>	   
       <tr>
          <td colspan='2'>
		  <p style='text-align: justify'>Se le recuerda que debe estar 15 minutos antes de su cita, y debe venir a compañado de un familiar.</p>
		  </td>
       </tr>
       <tr>
          <td colspan='2'>
             <p style='text-align: justify; font-size:12px;'><b>
		     Este mensaje ha sido enviado de forma automática, por favor no responder este correo. Cualquier duda o consulta puede contactarnos a las siguientes direcciones de correo: 
             <u>
                <li style='text-align: justify; font-size:12px;'>".$correo1."</li>
                <li style='text-align: justify; font-size:12px;'>".$correo2."</li>
             </u>
             <b style='text-align: justify; font-size:12px;'>Tambien puede llamarnos a nuestra PBX: ".$telefono."</b>
			 <b style='text-align: justify; font-size:12px;'>Tambien puede escribirnos a nuestro WhatsApp: ".$whatsapp."</b>
             <b style='text-align: justify; font-size:12px;'>En los siguientes horarios: ".$horario."</b>
             <a style='text-align: justify; font-size:12px;' href='".$sitio_web"'>Presione este enlace, para acceder a Nuestro Sitio WEB</a>
             <a style='text-align: justify; font-size:12px;' href='".$facebook."'>Presione este enlace, para acceder a Nuestro Facebook</a>
             <b style='text-align: justify; font-size:12px;'>Haciendo el bien a los demas, nos hacemos el bien a nosotros mismos.</b>
             <b style='text-align: justify; font-size:12px;'>Por favor no responder este correo.</b>
			 <br/>
			 <b style='text-align: justify; font-size:12px;'>Haciendo el bien a los demás nos hacemos el bien a nosotros mismos.</b>
			 </b></p>
		 </td>
       </tr>	
       <tr>
          <td colspan='2'>
		     <p><img width='75%' heigh='75%' src=".$firma."'></p>
		  </td>
       </tr>		   
   </table>	   
";			  
				   
$cabeceras = "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
$cabeceras .= "From: $de \r\n";
		
//incluyo la clase phpmailer	
include_once("../phpmailer/class.phpmailer.php");
include_once("../phpmailer/class.smtp.php");
	
$mail = new PHPMailer(); //creo un objeto de tipo PHPMailer
$mail->SMTPDebug = 1;
$mail->IsSMTP(); //protocolo SMTP
$mail->IsHTML(true);
$mail->CharSet = $CharSet;
$mail->SMTPAuth = true;//autenticación en el SMTP
$mail->SMTPSecure = $SMTPSecure;
$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);		
$mail->Host = $servidor;//servidor de SMTP de gmail
$mail->Port = $puerto;//puerto seguro del servidor SMTP de gmail
$mail->From = $de; //Remitente del correo
$mail->FromName = $from; //Remitente del correo
$mail->AddAddress($para);// Destinatario
$mail->Username = $de;//Aqui pon tu correo de gmail
$mail->Password = $contraseña;//Aqui pon tu contraseña de gmail
$mail->Subject = $asunto; //Asunto del correo
$mail->Body = $mensaje; //Contenido del correo
$mail->WordWrap = 50; //No. de columnas
$mail->MsgHTML($mensaje);//Se indica que el cuerpo del correo tendrá formato html

if($para != ""){		
	if($mail->Send()){ //enviamos el correo por PHPMailer
	   $respuesta = "El mensaje ha sido enviado con la clase PHPMailer =)";	   
	}else{
	   $respuesta = "El mensaje no se pudo enviar con la clase PHPMailer =(";
	   $respuesta .= " Error: ".$mail->ErrorInfo;
	}			   
}


$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>