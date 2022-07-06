<?php
    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

	class loginModel extends mainModel{

		protected function iniciar_sesion_modelo($datos){
			$username = $datos['username'];
			$password = $datos['password'];
			$estatus = 1;//USUARIO ACTIVO

			$mysqli = mainModel::connection();
			$query = "SELECT u.*, tu.nombre AS 'cuentaTipo' 
				FROM users AS u
				INNER JOIN tipo_user AS tu
				ON u.tipo_user_id = tu.tipo_user_id 
				WHERE BINARY u.username = '$username' AND u.password = '$password' AND u.estado = '$estatus'
				GROUP by u.tipo_user_id";
			$result = $mysqli->query($query) or die($mysqli->error);
			
			return $result;
		}
		
		protected function cerrar_sesion_modelo($datos){
			if($datos['usuario'] != "" && $datos['token_s'] == $datos['token']){
				$abitacora = mainModel::actualizar_bitacora($datos['codigo'], $datos['hora']);
				
				if($abitacora){
					session_unset();//VACIAR LA SESION
					session_destroy();//DESTRUIR LA SESION
					$respuesta = "true";
				}else{
					$respuesta = "false";
				}
				
			}else{
				$respuesta = "false";
			}
			
			return $respuesta;
		}
	}
