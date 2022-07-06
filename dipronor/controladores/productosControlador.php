<?php
    if($peticionAjax){
        require_once "../modelos/productosModelo.php";
    }else{
        require_once "./modelos/productosModelo.php";
    }
	
	class productosControlador extends productosModelo{
		public function agregar_productos_controlador(){
			session_start(['name'=>'SD']);
			$almacen_id = mainModel::cleanStringConverterCase($_POST['almacen']);
			$medida_id = mainModel::cleanStringConverterCase($_POST['medida']);
			$categoria = mainModel::cleanStringConverterCase($_POST['categoria']);			
			$nombre = mainModel::cleanString($_POST['producto']);
			$descripcion = mainModel::cleanString($_POST['descripcion']);			
			$cantidad = mainModel::cleanString($_POST['cantidad']);
			$precio_compra = mainModel::cleanString($_POST['precio_compra']);
			$precio_venta = mainModel::cleanString($_POST['precio_venta']);
			$cantidad_minima = mainModel::cleanString($_POST['cantidad_minima']);
			$cantidad_maxima = mainModel::cleanString($_POST['cantidad_maxima']);			
			$colaborador_id = $_SESSION['colaborador_id_sd'];
			$fecha_registro = date("Y-m-d H:i:s");
			
			if(isset($_POST['producto_activo'])){
				$estado = $_POST['producto_activo'];
			}else{
				$estado = 2;
			}

			if (isset($_POST['isv'])){
				$isv_venta = $_POST['isv'];
			}else{
				$isv_venta = 2;
			}	

			if (isset($_POST['isv_compra'])){
				$isv_compra = $_POST['isv_compra'];
			}else{
				$isv_compra = 2;
			}				

			$datos = [
				"almacen_id" => $almacen_id,
				"medida_id" => $medida_id,
				"categoria" => $categoria,				
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"cantidad" => $cantidad,
				"precio_compra" => $precio_compra,
				"precio_venta" => $precio_venta,
				"cantidad_minima" => $cantidad_minima,
				"cantidad_maxima" => $cantidad_maxima,				
				"colaborador_id" => $colaborador_id,
				"fecha_registro" => $fecha_registro,
				"estado" => $estado,
				"isv_venta" => $isv_venta,
				"isv_compra" => $isv_compra,				
			];
			
			$result = productosModelo::valid_productos_modelo($nombre);
			
			if($result->num_rows==0){
				$query = productosModelo::agregar_productos_modelo($datos);							
		
				if($query){
					$consulta_factura = productosModelo::consultar_codigo_producto($nombre)->fetch_assoc();
					$productos_id = $consulta_factura['productos_id'];					
					
					//CONSULTAMOS LA CATEGORIA DEL PRODUCTOS
					$categoria_producto = "";
					
					$result_categoria = productosModelo::categoria_producto_modelo($productos_id);
					
					if($result_categoria->num_rows > 0){
						$valores2 = $result_categoria->fetch_assoc();

						$categoria_producto = $valores2['categoria'];			
					}		

					$salida = 0;
					$datos_movimientos_productos = [
						"productos_id" => $productos_id,
						"cantidad_entrada" => $cantidad,				
						"cantidad_salida" => $salida,
						"saldo" => $cantidad,
						"fecha_registro" => $fecha_registro,				
					];		
								
					if ($categoria_producto == "Producto" || $categoria_producto == "Insumos"){
						productosModelo::agregar_movimientos_productos_modelo($datos_movimientos_productos);
					}
					
					$alert = [
						"alert" => "clear",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formProductos",	
						"id" => "proceso_productos",
						"valor" => "Registro",
						"funcion" => "listar_productos();",
						"modal" => "modal_registrar_productos",
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
		
		public function edit_productos_controlador(){;
			$productos_id = mainModel::cleanString($_POST['productos_id']);		
			$nombre = mainModel::cleanString($_POST['producto']);
			$descripcion = mainModel::cleanString($_POST['descripcion']);			
			$cantidad = mainModel::cleanString($_POST['cantidad']);
			$precio_compra = mainModel::cleanString($_POST['precio_compra']);
			$precio_venta = mainModel::cleanString($_POST['precio_venta']);
			$cantidad_minima = mainModel::cleanString($_POST['cantidad_minima']);
			$cantidad_maxima = mainModel::cleanString($_POST['cantidad_maxima']);				
			
			if (isset($_POST['producto_activo'])){
				$estado = $_POST['producto_activo'];
			}else{
				$estado = 2;
			}	

			if (isset($_POST['isv'])){
				$isv_venta = $_POST['isv'];
			}else{
				$isv_venta = 2;
			}	

			if (isset($_POST['isv_compra'])){
				$isv_compra = $_POST['isv_compra'];
			}else{
				$isv_compra = 2;
			}				

			$datos = [
				"productos_id" => $productos_id,
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"cantidad" => $cantidad,
				"precio_compra" => $precio_compra,
				"precio_venta" => $precio_venta,
				"cantidad_minima" => $cantidad_minima,
				"cantidad_maxima" => $cantidad_maxima,				
				"estado" => $estado,
				"isv_venta" => $isv_venta,
				"isv_compra" => $isv_compra,				
			];
			
			$query = productosModelo::edit_productos_modelo($datos);
			
			if($query){				
				$alert = [
					"alert" => "edit",
					"title" => "Registro modificado",
					"text" => "El registro se ha modificado correctamente",
					"type" => "success",
					"btn-class" => "btn-primary",
					"btn-text" => "¡Bien Hecho!",
					"form" => "formProductos",	
					"id" => "proceso_productos",
					"valor" => "Editar",
					"funcion" => "listar_productos();",
					"modal" => "modal_registrar_productos",
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
		
		public function delete_productos_controlador(){
			$productos_id = $_POST['productos_id'];
			
			$result_valid_productos_facturas = productosModelo::valid_productos_factura($productos_id);
			$result_valid_productos_compras = productosModelo::valid_productos_compras($productos_id);
			
			if($result_valid_productos_facturas->num_rows==0 || $result_valid_productos_compras->num_rows==0 ){
				$query = productosModelo::delete_productos_modelo($productos_id);
								
				if($query){
					$alert = [
						"alert" => "clear",
						"title" => "Registro eliminado",
						"text" => "El registro se ha eliminado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formProductos",	
						"id" => "proceso_productos",
						"valor" => "Eliminar",
						"funcion" => "listar_productos();",
						"modal" => "modal_registrar_productos",
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