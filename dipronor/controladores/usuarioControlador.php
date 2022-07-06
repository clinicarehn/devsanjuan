<?php
    if($peticionAjax){
        require_once "../modelos/usuarioModelo.php";
    }else{
        require_once "./modelos/usuarioModelo.php";
    }

    class usuarioControlador extends usuarioModelo{
		public function agregar_usuario_controlador(){
			$colaborador_id = mainModel::cleanString($_POST['usuarios_colaborador_id']);
			$privilegio_id = mainModel::cleanString($_POST['privilegio_id']);			
			$nickname = mainModel::cleanString($_POST['nickname']);	
			$pass = mainModel::cleanString($_POST['pass']);				
			$correo = mainModel::cleanStringStrtolower($_POST['correo_usuario']);
			$empresa = mainModel::cleanString($_POST['empresa_usuario']);
			$tipo_user = mainModel::cleanString($_POST['tipo_user']);			
			$fecha_registro = date("Y-m-d H:i:s");	
			
			if (isset($_POST['usuarios_activo'])){
				$estado = $_POST['usuarios_activo'];
			}else{
				$estado = 2;
			}			
			
			$datos = [
				"colaborador_id" => $colaborador_id,
				"privilegio_id" => $privilegio_id,				
				"nickname" => $nickname,
				"pass" => $pass,				
				"correo" => $correo,				
				"empresa" => $empresa,
				"tipo_user" => $tipo_user,				
				"estado" => $estado,
				"fecha_registro" => $fecha_registro,				
			];
			
			$result_usuario = usuarioModelo::valid_user_modelo($colaborador_id);
			
			if($result_usuario->num_rows==0){
				$query = usuarioModelo::agregar_usuario_modelo($datos);
				
				if($query){
					$alert = [
						"alert" => "clear",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formUsers",
						"id" => "proceso_usuarios",
						"valor" => "Registro",
						"funcion" => "listar_usuarios();",
						"modal" => "modal_registrar_usuarios"
					];
				}else{
					$alert = [
						"alert" => "simple",
						"title" => "Ocurrio un error inesperado",
						"text" => "No hemos podido procesar su solicitud",
						"type" => "error",
						"btn-class" => "btn-danger",					
					];				
				}				
			}else{
				$alert = [
					"alert" => "simple",
					"title" => "Resgistro ya existe",
					"text" => "Lo sentimos este registro ya existe",
					"type" => "error",	
					"btn-class" => "btn-danger",						
				];				
			}
			
			return mainModel::sweetAlert($alert);
		}
		
		public function edit_user_controlador(){
			$usuarios_id = $_POST['usuarios_id'];						
			$correo = mainModel::cleanStringStrtolower($_POST['correo_usuario']);
			$tipo_user = mainModel::cleanString($_POST['tipo_user']);
			$privilegio_id = mainModel::cleanString($_POST['privilegio_id']);			

			if (isset($_POST['usuarios_activo'])){
				$estado = $_POST['usuarios_activo'];
			}else{
				$estado = 2;
			}	
			
			$datos = [
				"usuarios_id" => $usuarios_id,				
				"correo" => $correo,				
				"tipo_user" => $tipo_user,	
				"privilegio_id" => $privilegio_id,					
				"estado" => $estado,				
			];
			
			$query = usuarioModelo::edit_user_modelo($datos);
			
			if($query){				
				$alert = [
					"alert" => "edit",
					"title" => "Registro modificado",
					"text" => "El registro se ha modificado correctamente",
					"type" => "success",
					"btn-class" => "btn-primary",
					"btn-text" => "¡Bien Hecho!",
					"form" => "formUsers",	
					"id" => "proceso_usuarios",
					"valor" => "Editar",
					"funcion" => "listar_usuarios();",
					"modal" => "modal_registrar_usuarios"
				];
			}else{
				$alert = [
					"alert" => "simple",
					"title" => "Ocurrio un error inesperado",
					"text" => "No hemos podido procesar su solicitud",
					"type" => "error",
					"btn-class" => "btn-danger",					
				];				
			}
			
			return mainModel::sweetAlert($alert);
		}
		
		public function delete_user_controlador(){
			$usuarios_id = $_POST['usuarios_id'];
			
			$result_valid_usuarios = usuarioModelo::valid_user_bitacora($usuarios_id);
			
			if($result_valid_usuarios->num_rows==0){
				$query = usuarioModelo::delete_user_modelo($usuarios_id);
								
				if($query){
					$alert = [
						"alert" => "clear",
						"title" => "Registro eliminado",
						"text" => "El registro se ha eliminado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formUsers",	
						"id" => "proceso_usuarios",
						"valor" => "Eliminar",
						"funcion" => "listar_usuarios();",
						"modal" => "modal_registrar_usuarios"
					];
				}else{
					$alert = [
						"alert" => "simple",
						"title" => "Ocurrio un error inesperado",
						"text" => "No hemos podido procesar su solicitud",
						"type" => "error",
						"btn-class" => "btn-danger",					
					];				
				}				
			}else{
				$alert = [
					"alert" => "simple",
					"title" => "Este registro cuenta con información almacenada",
					"text" => "No se puede eliminar este registro",
					"type" => "error",	
					"btn-class" => "btn-danger",						
				];				
			}
			
			return mainModel::sweetAlert($alert);
		}
    }