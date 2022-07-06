<?php
    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";	
    }
	
	class pagoCompraModelo extends mainModel{
		protected function agregar_pago_compras_modelo($datos){
			$pagoscompras_id = mainModel::correlativo("pagoscompras_id", " pagoscompras");
			$insert = "INSERT INTO pagoscompras 
				VALUES('$pagoscompras_id','".$datos['compras_id']."','".$datos['fecha']."','".$datos['importe']."','".$datos['cambio']."','".$datos['usuario']."','".$datos['estado']."','".$datos['fecha_registro']."')";
				
			$result = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
			
			return $result;		
		}
		
		protected function agregar_pago_detalles_compras_modelo($datos){			
			$pagoscompras_detalles_id = mainModel::correlativo("pagoscompras_detalles_id", "pagoscompras_detalles");
			$insert = "INSERT INTO pagoscompras_detalles 
				VALUES('$pagoscompras_detalles_id','".$datos['pagoscompras_id']."','".$datos['tipo_pago_id']."','".$datos['banco_id']."','".$datos['efectivo']."','".$datos['descripcion']."')";
				
			$result = mainModel::connection()->query($insert) or die(mainModel::connection()->error);
			
			return $result;			
		}
		
		protected function cancelar_pago_modelo($pagoscompras_id){
			$estado = 2;//FACTURA CANCELADA
			$update = "UPDATE pagoscompras
				SET
					estado = '$estado'
				WHERE pagoscompras_id = '$pagoscompras_id'";
			
			$result = mainModel::connection()->query($update) or die(mainModel::connection()->error);
			
			return $result;				
		}
		
		protected function consultar_codigo_pago_modelo($compras_id){
			$query = "SELECT pagoscompras_id
				FROM pagoscompras
				WHERE compras_id = '$compras_id'";
			$result = mainModel::connection()->query($query) or die(mainModel::connection()->error);
			
			return $result;			
		}
	}