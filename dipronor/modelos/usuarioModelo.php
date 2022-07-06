<?php
    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";	
    }

    class usuarioModelo extends mainModel{
		protected function agregar_usuario_modelo($datos){
			$users_id = mainModel::correlativo("users_id", "users");
			//$contraseña_generada = mainModel::encryption(mainModel::generar_password_complejo());
			$contraseña_generada = mainModel::encryption($datos['pass']);
			$insert = "INSERT INTO users VALUES('$users_id','".$datos['colaborador_id']."','".$datos['privilegio_id']."','".$datos['nickname']."','$contraseña_generada','".$datos['correo']."','".$datos['tipo_user']."','".$datos['estado']."','".$datos['fecha_registro']."','".$datos['empresa']."')";
			$sql = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
			
			return $sql;
		}
		
		protected function valid_user_modelo($colaborador_id){
			$query = "SELECT users_id FROM users WHERE colaborador_id  = '$colaborador_id'";
			$sql = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $sql;
		}	

		protected function edit_user_modelo($datos){
			$update = "UPDATE users
			SET 
				email = '".$datos['correo']."',
				tipo_user_id = '".$datos['tipo_user']."',
				privilegio_id = '".$datos['privilegio_id']."',
				estado = '".$datos['estado']."'
			WHERE users_id = '".$datos['usuarios_id']."'";

			$sql = mainModel::connection()->query($update) or die(mainModel::connection()->error);
			
			return $sql;			
		}
		
		protected function delete_user_modelo($users_id){
			$delete = "DELETE FROM users WHERE users_id = '$users_id'";
			
			$sql = mainModel::connection()->query($delete) or die(mainModel::connection()->error);
			
			return $sql;			
		}
		
		protected function valid_user_bitacora($user_id){
			$query = "SELECT b.colaborador_id
				FROM bitacora as b
				INNER JOIN users AS u
				ON b.colaborador_id = u.colaborador_id
				WHERE u.users_id = '$user_id'";
			
			$sql = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $sql;			
		}
    }
