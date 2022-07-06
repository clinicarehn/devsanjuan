<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$colaborador_id = $_POST['colaborador'];
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$tipo = $_POST['tipo'];
$estatus = $_POST['estatus'];
date_default_timezone_set('America/Tegucigalpa');
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];
$empresa_id = $_POST['empresa'];

//OBTENER EL TIPO DE Usuario
$query_tipo = "SELECT nombre
   FROM tipo_user
   WHERE tipo_user_id = '$tipo'";
$result = $mysqli->query($query_tipo);   
$consultar_tipo = $result->fetch_assoc();
$tipo_nombre = $consultar_tipo['nombre'];

$contraseña_generada = generar_password_complejo();

$consultar_nombre = "SELECT CONCAT(nombre, ' ', apellido) AS 'colaborador' 
   FROM colaboradores 
   WHERE colaborador_id = '$colaborador_id'";
$result = $mysqli->query($consultar_nombre);   
$consultar_nombre1 = $result->fetch_assoc();
$colaborador = $consultar_nombre1['colaborador'];

$from = "Creación de Usuario";

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(id) AS max, COUNT(id) AS count 
   FROM users";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//VERIFICAMOS EL PROCESO
$insert = "INSERT INTO users 
  VALUES('$numero', '$colaborador_id', '$username', MD5('$contraseña_generada'), '$email', '$tipo','$estatus','$fecha_registro', '$empresa_id')";
$query = $mysqli->query($insert);

if($query){
   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
   $historial_numero = historial();
   $estado_historial = "Agregar";
   $observacion_historial = "Se ha agregado el colaborador $colaborador con username $username bajo el perfil $tipo_nombre, para uso en el sistema";
   $modulo = "Usuarios";
   $insert = "INSERT INTO historial 
      VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
   $mysqli->query($insert);	   
   /********************************************/ 	
	
   echo 1;
	
   if($sock = @fsockopen('www.google.com', 80)){ 	
		$de = "notificaciones@hsjddhn.com";
		$contraseña = 'Sjd2021hn05%';	
		$servidor = "smtp.office365.com";
		$puerto = "587";
		$SMTPSecure = "tls";
		$CharSet = "UTF-8";	
		$para = $email;
	    $asunto = "Creación de Usuario\n";
	    $mensaje = "";

	    $mensaje="
				<table class='table table-striped table-responsive-md btn-table'>
				<tr>
				   <td colspan='2'><center><img width='45%' heigh='40%' src='http://hsjddhn.com/wp-content/uploads/2017/09/cropped-Logo4-1.png'></center></td>
				</tr>
				<tr>
				   <td colspan='2'><center><b><h4>Notificación Cambio de Contraseña</h4></b></center></td>
				</tr>
				<tr>
				  <td>
					<p style='text-align: justify'>Estimado(a) <b>".$colaborador."</b>, Le damos la mas cordial bienvenida al sistema, Le notificamos lo siguiente.
					<br/>Se ha creado su nuevo usuario de acceso el cual es <b>".$username."</b> y la contraseña asignada es: <b>".$contraseña_generada."</b> se requiere que la cambie a la brevedad posible.
					<a href='http://192.168.1.229'>Presione este enlace para acceder al Sistema Hospitalario</a>
					</p>	
				  </td>
				</tr>
				<tr>
				  <td>
					<p style='text-align: justify; font-size:12px;'><b>
					  Este mensaje ha sido enviado de forma automática, por favor no responder este correo. Cualquier duda o consulta envié un correo electrónico a: gestionsistemas@hsjddhn.com, o puede marcar  a nuestra PBX: 2512-0870 Ext. 116.<br/>Haciendo el bien a los demás nos hacemos el bien a nosotros mismos.
					</b></p>
				  </td>
				</tr>
				<tr>
				  <td>
					<p><img width='100%' heigh='100%' src='http://hsjddhn.com/firmas/firma.png'></p>
				  </td>			  
			   </tr>   
			   </table>
			 ";		

		$cabeceras = "MIME-Version: 1.0\r\n";
		$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$cabeceras .= "From: $de \r\n";

		//$archivo = $_FILES["archivo_fls"]["tmp_name"];
		//$destino = $_FILES["archivo_fls"]["name"];

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

		if($email != ""){		
			if($mail->Send()){ //enviamos el correo por PHPMailer
			   $respuesta = "El mensaje ha sido enviado con la clase PHPMailer =)";	   
			}else{
			   $respuesta = "El mensaje no se pudo enviar con la clase PHPMailer =(";
			   $respuesta .= " Error: ".$mail->ErrorInfo;
			}			   
		}
   }
}else{
	echo 2;
}
?>