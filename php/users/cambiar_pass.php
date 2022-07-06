<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli();

date_default_timezone_set('America/Tegucigalpa');

$id = $_POST['id'];
$contraseña = $_POST['repcontra'];

$consultar_nombre = "SELECT CONCAT(c.nombre, ' ', c.apellido) AS 'colaborador', u.username AS 'username', tu.nombre AS 'tipo_nombre', u.email AS 'email'
   FROM users AS u
   INNER JOIN colaboradores AS c
   ON u.colaborador_id = c.colaborador_id   
   INNER JOIN tipo_user AS tu
   ON u.type = tu.tipo_user_id
   WHERE u.colaborador_id = '$id'";

$result = $mysqli->query($consultar_nombre);   
$consultar_datos = $result->fetch_assoc();
$colaborador = $consultar_datos['colaborador'];
$username = $consultar_datos['username'];
$tipo_nombre = $consultar_datos['tipo_nombre'];
$para = $consultar_datos['email'];
$from = "Cambio de Contraseña";
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

$query = "UPDATE users 
    SET password = MD5('$contraseña') WHERE colaborador_id = '$id'";
$query = $mysqli->query($query);	
		
if ($query){
	//INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
	$historial_numero = historial();
	$estado_historial = "Actualizar";
	$observacion_historial = "Se ha cambiado la contraseña para el usuario $colaborador (username: $username) con perfil $tipo_nombre, para uso en el sistema";
	$modulo = "Usuarios";
	$insert = "INSERT INTO historial 
	  VALUES('$historial_numero','0','0','$modulo','$id','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
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
		
		$asunto = "Cambio de Contraseña\n";
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
				   <p style='text-align: justify'>
					 Estimado(a) <b>".$colaborador."</b>, se le notifica que se ha cambiado su contraseña.
					 </b>Esta solicitud fue realizada por su persona. Si desconoce esta acción por favor cambie su contraseña en la página de inicio de sesión
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

		//ENVIAMOS EL CORREO ELECTRONICO
		sendMail($servidor, $puerto, $contraseña, $CharSet, $SMTPSecure , $de, $para, $from, $asunto, $mensaje);
	}
}else{
	 echo 3;//NO SE PUEDO CAMBIAR LA CONTRASEÑA
}	
?>