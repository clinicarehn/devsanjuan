<?php
    if($peticionAjax){
        require_once "../modelos/movimientoProductosModelo.php";
    }else{
        require_once "./modelos/movimientoProductosModelo.php";
    }
	
	class movimientoProductosControlador extends movimientoProductosModelo{
		public function agregar_movimiento_productos_controlador(){
			$movimiento_categoria = $_POST['movimiento_categoria'];
			$movimiento_producto = $_POST['movimiento_producto'];
			$movimiento_operacion = $_POST['movimiento_operacion'];
			$movimiento_cantidad = $_POST['movimiento_cantidad'];
			$fecha_registro = date("Y-m-d H:i:s");
			$cantidad = 0;
			$saldo = 0;
			
			//CONSULTAMOS LA CANTIDAD DE PRODUCTOS DISPONIBLES
			$result_productos = movimientoProductosModelo::cantidad_producto_modelo($movimiento_producto);			  

			$cantidad_productos = "";
			
			if($result_productos->num_rows>0){
				$consulta = $result_productos->fetch_assoc();
				$cantidad_productos = $consulta['cantidad'];
			}
			
			//SI LA OPERACION ES INGRESO
			if($movimiento_operacion == 1){
				$cantidad = $cantidad_productos + $movimiento_cantidad;
				
				//ACTUALIZAMOS LA NUEVA CANTIDAD EN LA ENTIDAD PRODUCTOS
				movimientoProductosModelo::actualizar_cantidad_productos_modelo($movimiento_producto, $cantidad);
				
				//CONSULTAMOS EL SALDO DEL PRODUCTO EN LA ENTIDAD MOVIMIENTOS
				$result_movimientos = movimientoProductosModelo::saldo_productos_movimientos_modelo($movimiento_producto);
				
				$saldo_productos = 0;
				
				if($result_movimientos->num_rows>0){
					$consulta = $result_movimientos->fetch_assoc();
					$saldo_productos = $consulta['saldo'];
				}

				$saldo = $saldo_productos + $movimiento_cantidad;
				$salida = 0;	

				//INGRESAMOS EL NUEVO REGISTRO EN LA ENTIDAD MOVIMIENTOS				
				
				$datos = [
					"productos_id" => $movimiento_producto,
					"cantidad_entrada" => $movimiento_cantidad,
					"cantidad_salida" => $salida,
					"saldo" => $saldo,	
					"fecha_registro" => $fecha_registro,						
				];
				
				$query = movimientoProductosModelo::agregar_movimiento_productos_modelo($datos);
				
				if($query){
					$alert = [
						"alert" => "clear",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formMovimientos",
						"id" => "proceso_movimientos",
						"valor" => "Registro",	
						"funcion" => "listar_movimientos();",
						"modal" => "modal_movimientos",
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
				$cantidad = $cantidad_productos - $movimiento_cantidad;
				
				//ACTUALIZAMOS LA NUEVA CANTIDAD EN LA ENTIDAD PRODUCTOS
				movimientoProductosModelo::actualizar_cantidad_productos_modelo($movimiento_producto, $cantidad);
				
				//CONSULTAMOS EL SALDO DEL PRODUCTO EN LA ENTIDAD MOVIMIENTOS
				$result_movimientos = movimientoProductosModelo::saldo_productos_movimientos_modelo($movimiento_producto);
				
				$saldo_productos = 0;
				
				if($result_movimientos->num_rows>0){
					$consulta = $result_movimientos->fetch_assoc();
					$saldo_productos = $consulta['saldo'];
				}

				$saldo = $saldo_productos - $movimiento_cantidad;
				$salida = 0;	

				//INGRESAMOS EL NUEVO REGISTRO EN LA ENTIDAD MOVIMIENTOS				
				
				$datos = [
					"productos_id" => $movimiento_producto,
					"cantidad_entrada" => $movimiento_cantidad,
					"cantidad_salida" => $salida,
					"saldo" => $saldo,	
					"fecha_registro" => $fecha_registro,						
				];
				
				$query = movimientoProductosModelo::agregar_movimiento_productos_modelo($datos);
				
				if($query){
					$alert = [
						"alert" => "clear",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formMovimientos",
						"id" => "proceso_movimientos",
						"valor" => "Registro",	
						"funcion" => "listar_movimientos();",
						"modal" => "modal_movimientos",
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
			}
			
			return mainModel::sweetAlert($alert);
		}
	}