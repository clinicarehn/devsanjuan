<?php
include('../funtions.php');  
session_start();
$mysqli = connect_mysqli();
date_default_timezone_set('America/Tegucigalpa');

$username = $_POST['usu_forgot'];
$contraseña_generada = generar_password_complejo();

$consultar_datos = "SELECT colaborador_id, email 
   FROM users WHERE BINARY username = '$username'";
$result = $mysqli->query($consultar_datos);
$consultar_datos1 = $result->fetch_assoc();
$colaborador_id = $consultar_datos1['colaborador_id'];
$para = $consultar_datos1['email'];
$from = "Cambio de Contraseña";

$sistema = "https://181.115.46.150:2030/";
$logo = "https://hsjddhn.com/wp-content/uploads/2017/09/cropped-Logo4-1.png";
$firma = "https://hsjddhn.com/firmas/firma.png";

if($colaborador_id != ""){
      $consultar_nombre = "SELECT CONCAT(nombre, ' ', apellido) AS 'colaborador' 
	         FROM colaboradores 
			 WHERE colaborador_id = '$colaborador_id'";
	  $result = $mysqli->query($consultar_nombre);
      $consultar_nombre1 = $result->fetch_assoc();
      $colaborador = $consultar_nombre1['colaborador'];

      $insert = "UPDATE users SET password = MD5('$contraseña_generada') 
	      WHERE username = '$username'";
	  $query = $mysqli->query($insert);

      if($query){
         echo 1;//CONTRASEÑA CAMBIADA EXITOSAMENTE
   
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
               <td colspan='2'><center><img width='45%' heigh='40%' src='".$logo."'></center></td>
            </tr>
            <tr>
               <td colspan='2'><center><b><h4>Notificación Cambio de Contraseña</h4></b></center></td>
            </tr>
            <tr>
              <td>
	            <p style='text-align: justify'>Estimado(a) <b>".$colaborador."</b>, se le notifica que se ha cambiado su contraseña.
		        <br/>Su nueva contraseña es: <b>".$contraseña_generada."</b> se requiere que la cambie a la brevedad posible.
		        <a href='".$sistema."'>Presione este enlace para acceder al Sistema Hospitalario</a>,	  
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
                <p><img width='100%' heigh='100%' src='".$firma."'></p>
	          </td>			  
           </tr>   
           </table>
         ";		

		//ENVIAMOS EL CORREO ELECTRONICO
		sendMail($servidor, $puerto, $contraseña, $CharSet, $SMTPSecure , $de, $para, $from, $asunto, $mensaje);
     }else{
	    echo 2;//ERROR AL ACTUALIZAR LA CONTRASEÑA
     }
}else{
	echo 3;//EL USUARIO INGRESADO NO EXISTE
}	 
$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>