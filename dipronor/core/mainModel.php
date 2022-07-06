<?php
    if($peticionAjax){
        require_once "../core/configAPP.php";
		require_once "../core/phpmailer/class.phpmailer.php";
		require_once "../core/phpmailer/class.smtp.php";
    }else{
        require_once "./core/configAPP.php";
		require_once "./core/phpmailer/class.phpmailer.php";
		require_once "./core/phpmailer/class.smtp.php";
    }

    class mainModel{
         /*FUNCTION QUE PERMITE REALIZAR LA CONEXIÓN A LA DB*/
        protected function connection(){			
            $mysqli = new mysqli(SERVER, USER, PASS, DB);

            if ($mysqli->connect_errno) {
                echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
                exit;
            }
			
			$mysqli->set_charset("utf8");

            return $mysqli;
        }
		
		protected function ejecutar_consulta_simple($query){
			$result = self::connection()->query($query);
			
			return $result;
		}
		
		//FUNCION CORRELATIVO
		protected function correlativo($campo_id, $tabla){
			$query = "SELECT MAX(".$campo_id.") AS max, COUNT(".$campo_id.") AS count FROM ".$tabla;
			$result = self::connection()->query($query);
			
			$correlativo2 = $result->fetch_assoc();
	 
			$numero = $correlativo2['max'];
			$cantidad = $correlativo2['count'];

			if ( $cantidad == 0 )
			   $numero = 1;
			else
			   $numero = $numero + 1;	
		   
			return $numero;
		}
		
		protected function guardar_bitacora($datos){
			$bitacora_id = self::correlativo("bitacora_id", "bitacora");
			
			$bitacoraCodigo = $datos['bitacoraCodigo'];
			$bitacoraFecha = $datos['bitacoraFecha'];
			$bitacoraHoraInicio = $datos['bitacoraHoraInicio'];
			$bitacoraHoraFinal = $datos['bitacoraHoraFinal'];
			$bitacoraTipo = $datos['bitacoraTipo'];
			$bitacoraYear = $datos['bitacoraYear'];
			$user_id = $datos['user_id'];
			$fecha_registro = date("Y-m-d H:i:s");
			
			$insert = "INSERT INTO bitacora 
				VALUES('$bitacora_id','$bitacoraCodigo','$bitacoraFecha','$bitacoraHoraInicio','$bitacoraHoraFinal','$bitacoraTipo','$bitacoraYear','$user_id','$fecha_registro')";
			$result = self::connection()->query($insert) or die(self::connection()->error);
			
			return $result;
		}
		
		protected function actualizar_bitacora($bitacoraCodigo, $hora){
			$update = "UPDATE bitacora 
				SET 
					bitacoraHoraFinal = '$hora' 
				WHERE bitacoraCodigo = '$bitacoraCodigo'";
			$result = self::connection()->query($update);
			
			return $result;			
		}
		
		protected function eliminar_bitacora($user_id){
			$delte = "DELETE FROM bitacora WHERE user_id = '$user_id'";
			$result = self::connection()->query($update);
			
			return $result;
		}
		
		protected function getRealIP(){
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

		public function guardar_historial_accesos($comentario_){
			$nombre_host = self::getRealIP();
			$fecha = date("Y-m-d H:i:s"); 
			$comentario = mb_convert_case($comentario_, MB_CASE_TITLE, "UTF-8");		
			$usuario = $_SESSION['colaborador_id_sd'];
			
			$historial_acceso_id  = self::correlativo("historial_acceso_id ", "historial_acceso");
			$insert = "INSERT INTO historial_acceso VALUES('$historial_acceso_id','$fecha','$usuario','$nombre_host','$comentario')";
			
			$result = self::connection()->query($insert);
			
			return $result;			
		}
		
		//FUNCION PARA ENVIAR CORREO ELECTRONICO
		protected function sendEmail($server, $port, $SMTPSecure, $password, $from, $para, $asunto, $mensaje){
			$cabeceras = "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabeceras .= "From: $from \r\n";		

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
			$mail->Host = $server;//servidor de SMTP de gmail
			$mail->Port = $port;//puerto seguro del servidor SMTP de gmail
			$mail->From = $de; //Remitente del correo
			$mail->FromName = $from; //Remitente del correo
			$mail->AddAddress($para);// Destinatario
			$mail->AddCC($email_profesional);// Copia Destinatario
			$mail->Username = $de;//Aqui pon tu correo de gmail
			$mail->Password = $password;//Aqui pon tu contraseña de gmail
			$mail->Subject = $asunto; //Asunto del correo
			$mail->Body = $mensaje; //Contenido del correo
			$mail->WordWrap = 50; //No. de columnas
			$mail->MsgHTML($mensaje);//Se indica que el cuerpo del correo tendrá formato html

			if($para != ""){		
			   if($mail->Send()){ //enviamos el correo por PHPMailer			   
				  $respuesta = "El mensaje ha sido enviado con la clase PHPMailer y tu cuenta de gmail =)";
				   $alert = [
						"alert" => "simple",
						"title" => "Correo enviado correctamente",
						"text" => "El correo se ha enviado de forma satisfactoria",
						"type" => "error",
						"btn-class" => "btn-primary",					
					];				  
			   }else{
				   $alert = [
						"alert" => "simple",
						"title" => "Ocurrio un error inesperado",
						"text" => "El mensaje no se pudo enviar, verifique su conexión a Internet: Error: ".$mail->ErrorInfo."",
						"type" => "error",
						"btn-class" => "btn-danger",					
					];				  
			   }			   
			}else{
			   $alert = [
					"alert" => "simple",
					"title" => "Ocurrio un error inesperado",
					"text" => "Lo sentimos no existe un destinatario al cual enviar el correo, por favor corregir: Error: ".$mail->ErrorInfo."",
					"type" => "error",
					"btn-class" => "btn-danger",					
				];				
			}

			return self::sweetAlert($alert);
		}
		
		protected function generar_password_complejo(){
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

         /*Funcion que permite encriptar string */
        public function encryption($string){
            $ouput = FALSE;
            $key=hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV), 0, 16);
            $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
            $output = base64_encode($output);

            return $output;
        }

        /*Funcion que permite desencriptar string*/
        protected function decryption($string){
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV), 0, 16);
            $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);

            return $output;
        }

        /*Funcion que permite generar codigos aleatorios*/
        protected function getRandom($word, $length, $number){
            for($i=1; $i<$length; $i++){
                $number = rand(0,9);
                $word .= $number;
            }

            return $word.$number; 
        }

         /*Funcion que permite limpiar valores de los string (Inyección SQL)*/
        protected function cleanString($string){
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
		
        protected function cleanStringStrtolower($string){
            //Limpia espacios al inicio y al final
			$string =  strtolower(trim($string));

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
		
        protected function cleanStringConverterCase($string){
            //Limpia espacios al inicio y al final
			$string =  mb_convert_case(trim($string), MB_CASE_TITLE, "UTF-8");

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

        protected function sweetAlert($datos){	
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
							timer: 3000,
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
						  timer: 3000,
						  confirmButtonClass: '".$datos['btn-class']."',
						  confirmButtonText: '".$datos['btn-text']."',
						  closeOnConfirm: false
						});
						
						$('#".$datos['form']."')[0].reset();
						$('#".$datos['form']." #".$datos['id']."').val('".$datos['valor']."');
						".$datos['funcion'].";
						$('#".$datos['modal']."').modal('hide');						
                    </script>
                ";
				echo $alerta;
            }elseif($datos['alert'] == "save_simple"){
                $alerta = "
                    <script>
						swal({
						  title: '".$datos['title']."',
						  text: '".$datos['text']."',
						  type: '".$datos['type']."',
						  showCancelButton: false,
						  timer: 3000,
						  confirmButtonClass: '".$datos['btn-class']."',
						  confirmButtonText: '".$datos['btn-text']."',
						  closeOnConfirm: false
						});
						
						$('#".$datos['form']."')[0].reset();
						$('#".$datos['form']." #".$datos['id']."').val('".$datos['valor']."');
						".$datos['funcion'].";
						$('#".$datos['modal']."').modal('hide');
                    </script>
                ";
				echo $alerta;
            }elseif($datos['alert'] == "save"){
                $alerta = "
                    <script>
						swal({
						  title: '".$datos['title']."',
						  text: '".$datos['text']."',
						  type: '".$datos['type']."',
						  showCancelButton: false,
						  timer: 3000,
						  confirmButtonClass: '".$datos['btn-class']."',
						  confirmButtonText: '".$datos['btn-text']."',
						  closeOnConfirm: false
						});
						
					    $('#".$datos['form']."')[0].reset();
					    $('#".$datos['form']." #".$datos['id']."').val('".$datos['valor']."');
					    ".$datos['funcion'].";
					    $('#".$datos['modal']."').modal('hide');						
                    </script>
                ";
				echo $alerta;
            }elseif($datos['alert'] == "delete"){
                $alerta = "
                    <script>
						swal({
						  title: '".$datos['title']."',
						  text: '".$datos['text']."',
						  type: '".$datos['type']."',
						  showCancelButton: false,
						  timer: 3000,
						  confirmButtonClass: '".$datos['btn-class']."',
						  confirmButtonText: '".$datos['btn-text']."',
						  closeOnConfirm: false
						});

					    $('#".$datos['form']."')[0].reset();
					    $('#".$datos['form']." #".$datos['id']."').val('".$datos['valor']."');
					    ".$datos['funcion'].";
					    $('#".$datos['modal']."').modal('hide');						
                    </script>
                ";
				echo $alerta;
            }elseif($datos['alert'] == "edit"){
                $alerta = "
                    <script>
						swal({
						  title: '".$datos['title']."',
						  text: '".$datos['text']."',
						  type: '".$datos['type']."',
						  showCancelButton: false,
						  timer: 3000,
						  confirmButtonClass: '".$datos['btn-class']."',
						  confirmButtonText: '".$datos['btn-text']."',
						  closeOnConfirm: false
						});
						
					    $('#".$datos['form']." #".$datos['id']."').val('".$datos['valor']."');						   
					    ".$datos['funcion'].";
					    $('#".$datos['modal']."').modal('hide');						
                    </script>
                ";
				echo $alerta;
            }
            return $alerta;
        }
		
		public function getEmpresa(){
			$query = "SELECT * 
				FROM empresa 
				WHERE estado = 1
				ORDER BY nombre";
			$result = self::connection()->query($query);
			
			return $result;			
		}
		
		public function getDepartamentos(){
			$query = "SELECT * 
				FROM departamentos";
			$result = self::connection()->query($query);
			
			return $result;			
		}
		
		public function getMunicipios($departamentos_id){
			$query = "SELECT * 
				FROM municipios WHERE departamentos_id  = '$departamentos_id'";
			$result = self::connection()->query($query);
			
			return $result;			
		}
		
		public function getTipoUsuario(){
			$query = "SELECT * 
				FROM tipo_user";
			$result = self::connection()->query($query);
			
			return $result;			
		}

		public function getPrivilegio(){
			$query = "SELECT * 
				FROM privilegio
				WHERE estado = 1";
			$result = self::connection()->query($query);
			
			return $result;			
		}	

		public function getPuestoColaboradores(){
			$query = "SELECT * 
				FROM puestos
				WHERE estado = 1";
			$result = self::connection()->query($query);
			
			return $result;			
		}	

		public function getUserSession($colaboradores_id){
			$query = "SELECT nombre, apellido 
				FROM colaboradores 
				WHERE colaboradores_id = '$colaboradores_id'";
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getBitacora($fechai, $fechaf){
			$query = "SELECT b.bitacoraCodigo AS 'bitacoraCodigo', DATE_FORMAT(b.bitacoraFecha, '%d/%m/%Y') AS 'bitacoraFecha', b.bitacoraHoraInicio As 'bitacoraHoraInicio', b.bitacoraHoraFinal AS 'bitacoraHoraFinal', tu.nombre AS 'bitacoraTipo', b.bitacoraYear AS 'bitacoraYear', CONCAT(c.nombre,' ',c.apellido) AS 'colaborador'
				FROM bitacora AS b
				INNER JOIN tipo_user AS tu
				ON b.bitacoraTipo = tu.tipo_user_id
				INNER JOIN colaboradores AS c
				ON b.colaboradores_id = c.colaboradores_id
				WHERE b.bitacoraFecha BETWEEN '$fechai' AND '$fechaf'";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getHistorialAccesos($fechai, $fechaf){
			$query = "SELECT DATE_FORMAT(ha.fecha, '%d/%m/%Y %H:%i:%s') AS 'fecha', CONCAT(c.nombre, ' ', c.apellido) As 'colaborador', ha.ip AS 'ip', ha.acceso AS 'acceso'
				FROM historial_acceso AS ha
				INNER JOIN colaboradores AS c
				ON ha.colaboradores_id = c.colaboradores_id
				WHERE CAST(ha.fecha AS DATE) BETWEEN '$fechai' AND '$fechaf'
				ORDER BY ha.fecha DESC";
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getClientes(){
			$query = "SELECT c.clientes_id AS 'clientes_id', CONCAT(c.nombre, ' ', c.apellido) AS 'cliente', c.rtn AS 'rtn' , c.localidad AS 'localidad', c.telefono AS 'telefono', c.correo AS 'correo', d.nombre AS 'departamento', m.nombre AS 'municipio' 
				FROM clientes AS c
				INNER JOIN departamentos AS d
				ON c.departamentos_id = d.departamentos_id
				INNER JOIN municipios AS m
				ON c.municipios_id = m.municipios_id
				WHERE c.estado = 1";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}
		
		public function getProveedores(){
			$query = "SELECT p.proveedores_id AS 'proveedores_id', CONCAT(p.nombre, ' ', p.apellido) AS 'proveedor', p.rtn AS 'rtn' , p.localidad AS 'localidad', p.telefono AS 'telefono', p.correo AS 'correo', d.nombre AS 'departamento', m.nombre AS 'municipio' 
				FROM proveedores AS p
				INNER JOIN departamentos AS d
				ON p.departamentos_id = d.departamentos_id
				INNER JOIN municipios AS m
				ON p.municipios_id = m.municipios_id
				WHERE p.estado = 1
				ORDER BY CONCAT(p.nombre, ' ', p.apellido)";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	

		public function getColaboradores(){
			$query = "SELECT c.colaboradores_id AS 'colaborador_id', CONCAT(c.nombre, ' ', c.apellido) AS 'colaborador', c.identidad AS 'identidad', 
				CASE WHEN c.estado = 1 THEN 'Activo' ELSE 'Inactivo' END AS 'estado', c.telefono AS 'telefono'
				FROM colaboradores AS c
				WHERE c.estado = 1
				ORDER BY CONCAT(c.nombre, ' ', c.apellido)";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}
		
		public function getPuestos(){
			$query = "SELECT * 
				FROM puestos 
				WHERE estado = 1
				ORDER BY nombre";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getUsuarios(){
			$query = "SELECT u.users_id AS 'users_id', CONCAT(c.nombre, ' ', c.apellido) AS 'colaborador', u.username AS 'username', u.email AS 'correo', tp.nombre AS 'tipo_usuario', 
				CASE WHEN u.estado = 1 THEN 'Activo' ELSE 'Inactivo' END AS 'estado',
				e.nombre AS 'empresa'
				FROM users AS u
				INNER JOIN colaboradores AS c
				ON u.colaboradores_id = c.colaboradores_id
				INNER JOIN tipo_user AS tp
				ON u.tipo_user_id = tp.tipo_user_id
				INNER JOIN empresa AS e
				ON u.empresa_id = e.empresa_id
				WHERE u.estado = 1
				ORDER BY CONCAT(c.nombre, ' ', c.apellido)";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getSecuenciaFacturacion(){
			$query = "SELECT sf.secuencia_facturacion_id AS 'secuencia_facturacion_id', sf.cai AS 'cai', sf.prefijo AS 'prefijo', sf.relleno AS 'relleno', sf.incremento AS 'incremento', sf.siguiente AS 'siguiente', sf.rango_inicial AS 'rango_inicial', sf.rango_final AS 'rango_final', DATE_FORMAT(sf.fecha_activacion, '%d/%m/%Y') AS 'fecha_activacion', DATE_FORMAT(sf.fecha_registro, '%d/%m/%Y') AS 'fecha_registro', e.nombre AS 'empresa', DATE_FORMAT(sf.fecha_limite, '%d/%m/%Y') AS 'fecha_limite'
				FROM secuencia_facturacion AS sf
				INNER JOIN empresa AS e
				ON sf.empresa_id = e.empresa_id
				WHERE sf.activo = 1
				ORDER BY sf.fecha_registro";

			$result = self::connection()->query($query);
			
			return $result;						
		}

		public function getISV(){
			$query = "SELECT * 
				FROM isv";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}
		
		public function getISVEstadoProducto($productos_id){
			$query = "SELECT isv_venta
				FROM productos
				WHERE productos_id = '$productos_id'";
					
			$result = self::connection()->query($query);
			
			return $result;							
		}
		
		public function getCategoriaPorProducto($productos_id){
			$query = "SELECT cp.nombre AS 'categoria'
				FROM productos AS p
				INNER JOIN categoria_producto AS cp
				ON p.categoria_producto_id = cp.categoria_producto_id
				WHERE p.productos_id = '$productos_id'
				GROUP BY p.productos_id";
			$result = self::connection()->query($query);
			
			return $result;						
		}
		
		public function getCantidadProductos($productos_id){
			$query = "SELECT cantidad
				FROM productos
				WHERE productos_id = '$productos_id'";
				
			$result = self::connection()->query($query);
			
			return $result;			
		}
		
		public function getSaldoProductosMovimientos($productos_id){
			$query = "SELECT saldo
				FROM movimientos
				WHERE productos_id = '$productos_id'
				ORDER BY movimientos_id DESC LIMIT 1";
				
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getProductos(){
			$query = "SELECT p.productos_id AS 'productos_id', p.nombre AS 'nombre', p.descripcion AS 'descripcion', FORMAT(p.cantidad,0) AS 'cantidad', FORMAT(p.precio_compra,2) AS 'precio_compra', FORMAT(p.precio_venta,2) AS 'precio_venta',m.nombre AS 'medida', a.nombre AS 'almacen', u.nombre AS 'ubicacion', e.nombre AS 'empresa', 
			(CASE WHEN p.estado = '1' THEN 'Activo' ELSE 'Inactivo' END) AS 'estado', (CASE WHEN p.isv_venta = '1' THEN 'Sí' ELSE 'No' END) AS 'isv',
			cp.categoria_producto_id AS 'categoria_producto_id', cp.nombre AS 'categoria', p.isv_venta AS 'impuesto_venta', p.isv_compra AS 'isv_compra'
				FROM productos AS p
				INNER JOIN medida AS m
				ON p.medida_id = m.medida_id
				INNER JOIN almacen AS a
				ON p.almacen_id = a.almacen_id
				INNER JOIN ubicacion AS u
				ON a.ubicacion_id = u.ubicacion_id
				INNER JOIN empresa AS e
				ON u.empresa_id = e.empresa_id
				INNER JOIN categoria_producto AS cp
				ON p.categoria_producto_id = cp.categoria_producto_id
				WHERE p.estado = 1";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getProductosFacturas(){
			$query = "SELECT p.productos_id AS 'productos_id', p.nombre AS 'nombre', p.descripcion AS 'descripcion', p.cantidad AS 'cantidad', p.precio_compra AS 'precio_compra', p.precio_venta AS 'precio_venta',m.nombre AS 'medida', a.nombre AS 'almacen', u.nombre AS 'ubicacion', e.nombre AS 'empresa', 
			(CASE WHEN p.estado = '1' THEN 'Activo' ELSE 'Inactivo' END) AS 'estado', (CASE WHEN p.isv_venta = '1' THEN 'Sí' ELSE 'No' END) AS 'isv',
			cp.categoria_producto_id AS 'categoria_producto_id', cp.nombre AS 'categoria', p.isv_venta AS 'impuesto_venta', p.isv_compra AS 'isv_compra'
				FROM productos AS p
				INNER JOIN medida AS m
				ON p.medida_id = m.medida_id
				INNER JOIN almacen AS a
				ON p.almacen_id = a.almacen_id
				INNER JOIN ubicacion AS u
				ON a.ubicacion_id = u.ubicacion_id
				INNER JOIN empresa AS e
				ON u.empresa_id = e.empresa_id
				INNER JOIN categoria_producto AS cp
				ON p.categoria_producto_id = cp.categoria_producto_id
				WHERE p.estado = 1 AND cp.nombre NOT IN('Insumos')";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}		
		
		public function getProductosCompras(){
			$query = "SELECT p.productos_id AS 'productos_id', p.nombre AS 'nombre', p.descripcion AS 'descripcion', p.cantidad AS 'cantidad', p.precio_compra AS 'precio_compra', p.precio_venta AS 'precio_venta',m.nombre AS 'medida', a.nombre AS 'almacen', u.nombre AS 'ubicacion', e.nombre AS 'empresa', 
			(CASE WHEN p.estado = '1' THEN 'Activo' ELSE 'Inactivo' END) AS 'estado', (CASE WHEN p.isv_venta = '1' THEN 'Sí' ELSE 'No' END) AS 'isv',
			cp.categoria_producto_id AS 'categoria_producto_id', cp.nombre AS 'categoria', p.isv_venta AS 'impuesto_venta', p.isv_compra AS 'isv_compra'
				FROM productos AS p
				INNER JOIN medida AS m
				ON p.medida_id = m.medida_id
				INNER JOIN almacen AS a
				ON p.almacen_id = a.almacen_id
				INNER JOIN ubicacion AS u
				ON a.ubicacion_id = u.ubicacion_id
				INNER JOIN empresa AS e
				ON u.empresa_id = e.empresa_id
				INNER JOIN categoria_producto AS cp
				ON p.categoria_producto_id = cp.categoria_producto_id
				WHERE p.estado = 1 AND cp.nombre NOT IN('Servicio')";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}		
		
		function getProductoCategoria($categoria_producto_id){
			$query = "SELECT * 
				FROM productos
				WHERE categoria_producto_id = '$categoria_producto_id'";
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getMedida(){
			$query = "SELECT * 
				FROM medida
				WHERE estado = 1";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getAlmacen(){
			$query = "SELECT a.almacen_id AS 'almacen_id', a.nombre AS 'almacen', u.nombre AS 'ubicacion'
				FROM almacen AS a
				INNER JOIN ubicacion AS u
				ON a.ubicacion_id = u.ubicacion_id
				WHERE a.estado = 1
				ORDER BY a.nombre ASC";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}	

		public function getUbicacion(){
			$query = "SELECT u.ubicacion_id AS 'ubicacion_id', u.nombre AS 'ubicacion', e.nombre AS 'empresa'
				FROM ubicacion AS u
				INNER JOIN empresa AS e
				ON u.empresa_id = e.empresa_id
				WHERE u.estado = 1
				ORDER BY u.nombre ASC";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}	

		public function getCategoriaProducto(){
			$query = "SELECT * 
				FROM categoria_producto";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}			
		
		public function getCategoriaProductoMovimientos(){
			$query = "SELECT * 
				FROM categoria_producto
				WHERE nombre NOT IN ('Servicio')";
				
			$result = self::connection()->query($query);
			
			return $result;					
		}
		
		/*INICIO FUNCIONES ACCIONES CONSULTAS EDITAR FORMULARIOS*/
		public function getClientesEdit($clientes_id){
			$query = "SELECT *
				FROM clientes
				WHERE clientes_id = '$clientes_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}
		
		public function getProveedoresEdit($proveedores_id){
			$query = "SELECT *
				FROM proveedores
				WHERE proveedores_id = '$proveedores_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}		
		
		public function getColaboradoresEdit($colaboradores_id){
			$query = "SELECT *
				FROM colaboradores
				WHERE colaboradores_id = '$colaboradores_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	

		public function getPuestosEdit($puestos_id){
			$query = "SELECT *
				FROM puestos
				WHERE puestos_id = '$puestos_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	

		public function getUsersEdit($users_id){
			$query = "SELECT u.users_id AS 'users_id', c.colaboradores_id AS 'colaborador_id', CONCAT(c.nombre, ' ', c.apellido) AS 'colaborador', u.username AS 'username', u.email AS 'correo', u.tipo_user_id AS 'tipo_user_id', u.estado AS 'estado', u.empresa_id AS 'empresa_id', u.privilegio_id AS 'privilegio_id'
				FROM users AS u
				INNER JOIN colaboradores AS c
				ON u.colaboradores_id = c.colaboradores_id
				WHERE u.users_id = '$users_id'
				ORDER BY CONCAT(c.nombre, ' ', c.apellido)";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	

		public function getSecuenciaFacturacionEdit($secuencia_facturacion_id){
			$query = "SELECT *
				FROM secuencia_facturacion
				WHERE secuencia_facturacion_id = '$secuencia_facturacion_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}

		public function getEmpresasEdit($empresa_id){
			$query = "SELECT *
				FROM empresa
				WHERE empresa_id = '$empresa_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}
		
		public function getPrivilegiosEdit($privilegio_id){
			$query = "SELECT *
				FROM privilegio
				WHERE privilegio_id = '$privilegio_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	

		public function getTipoUsuarioEdit($tipo_user_id){
			$query = "SELECT *
				FROM tipo_user
				WHERE tipo_user_id = '$tipo_user_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}

		public function getTipoProductosEdit($productos_id){
			$query = "SELECT *
				FROM productos
				WHERE productos_id = '$productos_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	
		
		public function getUbicacionEdit($ubicacion_id){
			$query = "SELECT *
				FROM ubicacion
				WHERE ubicacion_id = '$ubicacion_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	
		
		public function getMedidaEdit($medida_id){
			$query = "SELECT *
				FROM medida
				WHERE medida_id = '$medida_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}	

		public function getAlmacenEdit($almacen_id){
			$query = "SELECT *
				FROM almacen
				WHERE almacen_id = '$almacen_id'";
			
			$result = self::connection()->query($query);
			
			return $result;					
		}			
		
		public function getMovimientosProductos($datos){
			$query = "SELECT p.nombre AS 'producto', me.nombre AS 'medida', m.cantidad_entrada AS 'entrada', m.cantidad_salida AS 'salida', m.saldo AS 'saldo', DATE_FORMAT(m.fecha_registro, '%d/%m/%Y %H:%i:%s') AS 'fecha_registro', m.documento AS 'documento'
				FROM movimientos AS m
				INNER JOIN productos AS p
				ON m.productos_id = p.productos_id
				INNER JOIN medida AS me
				ON p.medida_id = me.medida_id
				WHERE p.categoria_producto_id = '".$datos['categoria']."' AND CAST(m.fecha_registro AS DATE) BETWEEN '".$datos['fechai']."' AND '".$datos['fechaf']."'
				ORDER BY m.fecha_registro ASC";
				
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function consultaVentas($datos){
			$query = "SELECT DATE_FORMAT(f.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(c.nombre,' ',c.apellido) AS 'cliente', CONCAT(sf.prefijo,'',LPAD(f.number, sf.relleno, 0)) AS 'numero', FORMAT(f.importe,2) As 'total'
				FROM facturas AS f
				INNER JOIN clientes AS c
				ON f.clientes_id = c.clientes_id
				INNER JOIN secuencia_facturacion AS sf
				ON f.secuencia_facturacion_id = sf.secuencia_facturacion_id
				WHERE f.fecha BETWEEN '".$datos['fechai']."' AND '".$datos['fechaf']."'";
			
			$result = self::connection()->query($query);
			
			return $result;	
		}
		
		public function consultaCompras($datos){
			$query = "SELECT DATE_FORMAT(c.fecha, '%d/%m/%Y') AS 'fecha', CONCAT(p.nombre,' ',p.apellido) AS 'proveedor', c.number AS 'numero', FORMAT(c.importe,2) As 'total'
				FROM compras AS c
				INNER JOIN proveedores AS p
				ON c.proveedores_id = p.proveedores_id
				WHERE c.fecha BETWEEN '".$datos['fechai']."' AND '".$datos['fechaf']."'";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getBanco(){
			$query = "SELECT * FROM banco";
		
			$result = self::connection()->query($query);
			
			return $result;			
		}
		
		public function getTipoPago(){
			$query = "SELECT * FROM tipo_pago";
			
			$result = self::connection()->query($query);
			
			return $result;				
		}
		
		public function getDatosFactura($facturas_id){
			$query = "SELECT f.facturas_id AS facturas_id, DATE_FORMAT(f.fecha, '%d/%m/%Y') AS 'fecha', c.clientes_id AS 'clientes_id', CONCAT(c.nombre,' ',c.apellido) AS 'cliente', c.rtn AS 'rtn', CONCAT(ven.nombre,' ',ven.apellido) AS 'profesional', f.colaboradores_id AS 'colaborador_id', f.estado AS 'estado', f.fecha AS 'fecha_factura', f.notas AS 'notas' 
				FROM facturas AS f 
				INNER JOIN clientes AS c 
				ON f.clientes_id = c.clientes_id 
				INNER JOIN colaboradores AS ven 
				ON f.colaboradores_id = ven.colaboradores_id 
				WHERE f.facturas_id = '$facturas_id'";
			$result = self::connection()->query($query);
				
			return $result;					
		}	
		
		public function getDetalleProductosFactura($facturas_id){
			$query = "SELECT fd.productos_id AS 'productos_id', p.nombre AS 'producto', fd.cantidad AS 'cantidad', fd.precio AS 'precio', fd.isv_valor AS 'isv_valor', fd.descuento AS 'descuento'
				FROM facturas_detalles AS fd
				INNER JOIN facturas As f
				ON fd.facturas_id = f.facturas_id
				INNER JOIN productos AS p
				ON fd.productos_id = p.productos_id
				WHERE fd.facturas_id = '$facturas_id'";
	
			$result = self::connection()->query($query);
				
			return $result;					
		}
		
		public function getDatosCompras($compras_id){
			$query = "SELECT c.compras_id AS compras_id, DATE_FORMAT(c.fecha, '%d/%m/%Y') AS 'fecha', c.proveedores_id AS 'proveedores_id', CONCAT(p.nombre,' ',p.apellido) AS 'proveedor', p.rtn AS 'rtn', CONCAT(ven.nombre,' ',ven.apellido) AS 'profesional', c.colaboradores_id AS 'colaborador_id', c.estado AS 'estado', c.fecha AS 'fecha_compra', c.notas AS 'notas' 
				FROM compras AS c 
				INNER JOIN proveedores AS p 
				ON c.proveedores_id = p.proveedores_id 
				INNER JOIN colaboradores AS ven 
				ON c.colaboradores_id = ven.colaboradores_id 
				WHERE c.compras_id = '$compras_id'";
			$result = self::connection()->query($query);
				
			return $result;					
		}	
		
		public function getDetalleProductosCompras($compras_id){
			$query = "SELECT cd.productos_id AS 'productos_id', p.nombre AS 'producto', cd.cantidad AS 'cantidad', cd.precio AS 'precio', cd.isv_valor AS 'isv_valor', cd.descuento AS 'descuento'
				FROM compras_detalles AS cd
				INNER JOIN compras As c
				ON cd.compras_detalles_id = c.compras_id
				INNER JOIN productos AS p
				ON cd.productos_id = p.productos_id
				WHERE cd.compras_id = '$compras_id'";
	
			$result = self::connection()->query($query);
				
			return $result;					
		}		
		
		public function getCuentasporCobrarClientes(){
			$query = "SELECT CONCAT(c.nombre,' ',c.apellido) AS 'cliente', f.fecha AS 'fecha', FORMAT(cc.saldo,2) AS 'saldo', CONCAT(sf.prefijo,'',LPAD(f.number, sf.relleno, 0)) AS 'numero'
				FROM cobrar_clientes AS cc
				INNER JOIN clientes AS c
				ON cc.clientes_id = c.clientes_id
				INNER JOIN facturas AS f
				ON cc.facturas_id = f.facturas_id
				INNER JOIN secuencia_facturacion AS sf
				ON f.secuencia_facturacion_id = sf.secuencia_facturacion_id
				WHERE cc.estado = 1";
			
			$result = self::connection()->query($query);
				
			return $result;					
		}
		
		public function getCuentasporPagarProveedores(){
			$query = "SELECT CONCAT(p.nombre,' ',p.apellido) AS 'proveedores', cp.fecha AS 'fecha', FORMAT(cp.saldo,2) AS 'saldo', c.number AS 'factura' 
				FROM pagar_proveedores AS cp
				INNER JOIN proveedores AS p
				ON cp.proveedores_id = p.proveedores_id 
				INNER JOIN compras AS c
				ON cp.proveedores_id = c.proveedores_id
				WHERE cp.estado = 1";
			
			$result = self::connection()->query($query);
				
			return $result;					
		}		
		
		public function getCuentasporPagarClientes(){
			$query = "";
			
			$result = self::connection()->query($query);
				
			return $result;					
		}
		
		public function getlastUpdate($entidad){
			$query = "SELECT * FROM ".$entidad."
				ORDER BY ".$entidad."_id DESC LIMIT 1";

			$result = self::connection()->query($query);
				
			return $result;				
		}
		
		public function getlastUpdateHistorialAccessos(){
			$query = "SELECT * FROM historial_acceso
				ORDER BY historial_acceso_id  DESC LIMIT 1";

			$result = self::connection()->query($query);
				
			return $result;				
		}		
		
		function getTheDay($date, $hora){
			if($date !=""){
				$curr_date=strtotime(date("Y-m-d H:i:s"));
				$the_date=strtotime($date);
				$diff=floor(($curr_date-$the_date)/(60*60*24));
				
				switch($diff){
					case 0:
						return "Hoy ".$hora;
						break;
					case 1:
						return "Ayer ".$hora;
						break;
					default:
						return " Hace ".$diff." Días";
				}				
			}else{
				return "No se encontraron actualizaciones";
			}
		}	

		function getUserSistema($colaboradores_id){
			$query = "SELECT colaboradores_id, CONCAT(nombre, ' ', apellido) AS 'colaborador'
				FROM colaboradores
				WHERE colaboradores_id = '$colaboradores_id'";

			$result = self::connection()->query($query);
				
			return $result;					
		}
		/*FIN FUNCIONES ACCIONES EDITAR CONSULTAS FORMULARIOS*/		
    }