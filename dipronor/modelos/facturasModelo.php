<?php
    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";	
    }
	
	class facturasModelo extends mainModel{		
		protected function agregar_facturas_modelo($datos){
			$facturas_id = mainModel::correlativo("facturas_id", "facturas");
			$insert = "INSERT INTO facturas 
				VALUES('$facturas_id','".$datos['clientes_id']."','".$datos['secuencia_facturacion_id']."','".$datos['numero']."','".$datos['tipo_factura']."','".$datos['colaboradores_id']."','".$datos['importe']."','".$datos['notas']."','".$datos['fecha']."','".$datos['estado']."','".$datos['usuario']."','".$datos['fecha_registro']."')";

			$result = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
			
			return $result;			
		}
		
		protected function agregar_detalle_facturas($datos){
			$facturas_detalle_id = mainModel::correlativo("facturas_detalle_id", "facturas_detalles");
			$insert = "INSERT INTO facturas_detalles 
				VALUES('$facturas_detalle_id','".$datos['facturas_id']."','".$datos['productos_id']."','".$datos['cantidad']."','".$datos['precio']."','".$datos['isv_valor']."','".$datos['descuento']."')";
			$result = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
			
			return $result;			
		}
		
		protected function agregar_movimientos_productos_modelo($datos){
			$movimientos_id = mainModel::correlativo("movimientos_id", "movimientos");
			$insert = "INSERT INTO movimientos
				VALUES('$movimientos_id','".$datos['productos_id']."','".$datos['documento']."','".$datos['cantidad_entrada']."','".$datos['cantidad_salida']."','".$datos['saldo']."','".$datos['fecha_registro']."')";
			$result = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
		
			return $result;				
		}
		
		protected function agregar_cuenta_por_cobrar_clientes($datos){
			$cobrar_clientes_id = mainModel::correlativo("cobrar_clientes_id", "cobrar_clientes");
			$insert = "INSERT INTO cobrar_clientes
				VALUES('$cobrar_clientes_id','".$datos['clientes_id']."','".$datos['facturas_id']."','".$datos['fecha']."','".$datos['saldo']."','".$datos['estado']."','".$datos['usuario']."','".$datos['fecha_registro']."')";
			$result = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
		
			return $result;				
		}
		
		protected function actualizar_detalle_facturas($datos){
			$update = "UPDATE facturas_detalles
				SET 
					cantidad = '".$datos['cantidad']."',
					precio = '".$datos['precio']."',
					isv_valor = '".$datos['isv_valor']."',
					descuento = '".$datos['descuento']."'
				WHERE facturas_id = '".$datos['facturas_id']."' AND productos_id = '".$datos['productos_id']."'";
			
			$result = mainModel::connection()->query($update) or die(mainModel::connection()->error);
			
			return $result;					
		}
		
		protected function actualizar_factura_importe($datos){
			$update = "UPDATE facturas
				SET
					importe = '".$datos['importe']."'
				WHERE facturas_id = '".$datos['facturas_id']."'";
				
			$result = mainModel::connection()->query($update) or die(mainModel::connection()->error);
			
			return $result;				
		}
		
		protected function actualizar_cantidad_productos_modelo($productos_id, $cantidad){
			$update = "UPDATE productos
				SET
					cantidad = '$cantidad'
				WHERE productos_id = '$productos_id'";
			
			$result = mainModel::connection()->query($update) or die(mainModel::connection()->error);
		
			return $result;				
		}
		
		protected function actualizar_secuencia_facturacion_modelo($secuencia_facturacion_id, $numero){
			$update = "UPDATE secuencia_facturacion
				SET
					siguiente = '$numero'
				WHERE secuencia_facturacion_id = '$secuencia_facturacion_id'";
			$result = mainModel::connection()->query($update) or die(mainModel::connection()->error);
		
			return $result;				
		}
		
		protected function cancelar_facturas_modelo($facturas_id){
			$estado = 4;//FACTURA CANCELADA
			$update = "UPDATE facturas
				SET
					estado = '$estado'
				WHERE facturas_id = '$facturas_id'";
			$result = mainModel::connection()->query($update) or die(mainModel::connection()->error);
		
			return $result;			
		}
		
		protected function secuencia_facturacion($empresa_id){
			$query = "SELECT secuencia_facturacion_id, prefijo, siguiente AS 'numero', rango_final, fecha_limite, incremento, relleno
			   FROM secuencia_facturacion
			   WHERE activo = '1' AND empresa_id = '$empresa_id'";
			$result = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $result;
		}
		
		protected function obtener_facturaID_modelo($clientes_id, $fecha, $numero, $colaboradores_id){
			$query = "SELECT facturas_id 
				FROM facturas 
				WHERE clientes_id = '$clientes_id' AND fecha = '$fecha' AND number = '$numero' AND colaboradores_id = '$colaboradores_id'";
			$result = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $result;				
		}
		
		protected function validDetalleFactura($facturas_id, $productos_id){
			$query = "SELECT facturas_id
				FROM facturas_detalles
				WHERE facturas_id = '$facturas_id' AND productos_id  = '$productos_id'";
			
			$result = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $result;			
		}
		
		protected function saldo_productos_movimientos_modelo($productos_id){
			$result = mainModel::getSaldoProductosMovimientos($productos_id);
			
			return $result;			
		}
		
		protected function getISV_modelo(){
			$result = mainModel::getISV();
			
			return $result;
		}
		
		protected function getISVEstadoProducto_modelo($productos_id){
			$result = mainModel::getISVEstadoProducto($productos_id);
			
			return $result;			
		}
		
		protected function categoria_producto_modelo($productos_id){
			$result = mainModel::getCategoriaPorProducto($productos_id);
			
			return $result;			
		}
		
		protected function cantidad_producto_modelo($productos_id){
			$result = mainModel::getCantidadProductos($productos_id);
			
			return $result;			
		}			
	}