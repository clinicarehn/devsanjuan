<?php
    if($peticionAjax){
        require_once "../modelos/clientesModelo.php";
    }else{
        require_once "./modelos/clientesModelo.php";
    }
	
	class clientesControlador extends clientesModelo{
		public function agregar_clientes_controlador(){
			session_start(['name'=>'SD']);
			$nombre = mainModel::cleanStringConverterCase($_POST['nombre_clientes']);
			$apellido = mainModel::cleanStringConverterCase($_POST['apellido_clientes']);
			$rtn = mainModel::cleanString($_POST['identidad_clientes']);
			$fecha = mainModel::cleanString($_POST['fecha_clientes']);			
			$departamento_id = mainModel::cleanString($_POST['departamento_cliente']);
			$municipio_id = mainModel::cleanString($_POST['municipio_cliente']);
			$localidad = mainModel::cleanString($_POST['dirección_clientes']);
			$telefono = mainModel::cleanString($_POST['telefono_clientes']);
			$correo = mainModel::cleanStringStrtolower($_POST['correo_clientes']);
			
			if (isset($_POST['clientes_activo'])){
				$estado = $_POST['clientes_activo'];
			}else{
				$estado = 2;
			}
			
			$colaborador_id = $_SESSION['colaborador_id_sd'];
			$fecha_registro = date("Y-m-d H:i:s");

			$datos = [
				"nombre" => $nombre,
				"apellido" => $apellido,
				"rtn" => $rtn,
				"fecha" => $fecha,
				"departamento_id" => $departamento_id,
				"municipio_id" => $municipio_id,
				"localidad" => $localidad,
				"telefono" => $telefono,
				"correo" => $correo,
				"estado" => $estado,
				"colaborador_id" => $colaborador_id,
				"fecha_registro" => $fecha_registro,			
			];
			
			$result = clientesModelo::valid_clientes_modelo($rtn);
			
			if($result->num_rows==0){
				$query = clientesModelo::agregar_clientes_modelo($datos);
				
				if($query){
					$alert = [
						"alert" => "save",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formClientes",	
						"id" => "proceso_clientes",
						"valor" => "Registro",
						"funcion" => "listar_clientes();",
						"modal" => "modal_registrar_clientes",
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
		
		public function edit_clientes_controlador(){
			$clientes_id = $_POST['clientes_id'];
			$nombre = mainModel::cleanStringConverterCase($_POST['nombre_clientes']);
			$apellido = mainModel::cleanStringConverterCase($_POST['apellido_clientes']);
			$rtn = mainModel::cleanString($_POST['identidad_clientes']);			
			$departamento_id = mainModel::cleanString($_POST['departamento_cliente']);
			$municipio_id = mainModel::cleanString($_POST['municipio_cliente']);
			$localidad = mainModel::cleanString($_POST['dirección_clientes']);
			$telefono = mainModel::cleanString($_POST['telefono_clientes']);
			$correo = mainModel::cleanStringStrtolower($_POST['correo_clientes']);
			
			if (isset($_POST['clientes_activo'])){
				$estado = $_POST['clientes_activo'];
			}else{
				$estado = 2;
			}			
			
			$datos = [
				"clientes_id" => $clientes_id,
				"nombre" => $nombre,
				"apellido" => $apellido,
				"rtn" => $rtn,
				"departamento_id" => $departamento_id,
				"municipio_id" => $municipio_id,
				"localidad" => $localidad,
				"telefono" => $telefono,
				"correo" => $correo,
				"estado" => $estado,
			];			
						
			$query = clientesModelo::edit_clientes_modelo($datos);
			
			if($query){				
				$alert = [
					"alert" => "edit",
					"title" => "Registro modificado",
					"text" => "El registro se ha modificado correctamente",
					"type" => "success",
					"btn-class" => "btn-primary",
					"btn-text" => "¡Bien Hecho!",
					"form" => "formClientes",	
					"id" => "proceso_clientes",
					"valor" => "Editar",
					"funcion" => "listar_clientes();",
					"modal" => "modal_registrar_clientes",
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
		
		public function delete_clientes_controlador(){
			$clientes_id = $_POST['clientes_id'];
			
			$result_valid_clientes = clientesModelo::valid_clientes_facturas_modelo($clientes_id);
			
			if($result_valid_clientes->num_rows==0){
				$query = clientesModelo::delete_clientes_modelo($clientes_id);
								
				if($query){
					$alert = [
						"alert" => "delete",
						"title" => "Registro eliminado",
						"text" => "El registro se ha eliminado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formClientes",	
						"id" => "proceso_clientes",
						"valor" => "Eliminar",
						"funcion" => "listar_clientes();",
						"modal" => "modal_registrar_clientes",
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