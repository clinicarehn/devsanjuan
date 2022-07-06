<?php
    if($peticionAjax){
        require_once "../modelos/pagoCompraModelo.php";
    }else{
        require_once "./modelos/pagoCompraModelo.php";
    }
	
	class pagoCompraControlador extends pagoCompraModelo{
		public function agregar_pago_compra_controlador(){
			session_start(['name'=>'SD']);
			$compras_id = $_POST['compras_idPurchase'];
			$fecha = $_POST['fechaPurchase'];			
			
			if(isset($_POST['tipo_pago_idPurchase'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['tipo_pago_idPurchase'] == ""){
					$tipo_pago_id1 = 0;
				}else{
					$tipo_pago_id1 = $_POST['tipo_pago_idPurchase'];
				}
			}else{
				$tipo_pago_id1 = 0;
			}			

			if(isset($_POST['banco_idPurchase'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['banco_idPurchase'] == ""){
					$banco_id1 = 0;
				}else{
					$banco_id1 = $_POST['banco_idPurchase'];
				}
			}else{
				$banco_id1 = 0;
			}

			$efectivo1 = $_POST['efectivoPurchase'];
			
			if(isset($_POST['tipo_pago_idPurchase1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['tipo_pago_idPurchase1'] == ""){
					$tipo_pago_id2 = 0;
				}else{
					$tipo_pago_id2= $_POST['tipo_pago_idPurchase1'];
				}
			}else{
				$tipo_pago_i2 = 0;
			}

			if(isset($_POST['banco_idPurchase1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['banco_idPurchase1'] == ""){
					$banco_id2 = 0;
				}else{
					$banco_id2 = $_POST['banco_idPurchase1'];
				}
			}else{
				$banco_id2 = 0;
			}

			$efectivo2 = $_POST['efectivoPurchase1'];
			$referencia_pago1 = mainModel::cleanStringConverterCase($_POST['referencia_pagoPurchase1']);
			$referencia_pago2 = mainModel::cleanStringConverterCase($_POST['referencia_pagoPurchase2']);
			$importe = $_POST['importePurchase'];
			$cambio = $_POST['cambioPurchase'];
			$m_pendiente = $_POST['m_pendientePurchase'];
			$usuario = $_SESSION['colaborador_id_sd'];
			$fecha_registro = date("Y-m-d H:i:s");
			$estado = 1;
			
			$datos = [
				"compras_id" => $compras_id,
				"fecha" => $fecha,
				"importe" => $importe,
				"cambio" => $cambio,
				"usuario" => $usuario,
				"estado" => $estado,
				"fecha_registro" => $fecha_registro,				
			];
			
			if($m_pendiente == 0){
				$query = pagoCompraModelo::agregar_pago_compras_modelo($datos);

				if($query){
					//ACTUALIZAMOS EL DETALLE DEL PAGO
					$consulta_pago = pagoCompraModelo::consultar_codigo_pago_modelo($compras_id)->fetch_assoc();
					$pagoscompras_id = $consulta_pago['pagoscompras_id'];
												
					$datos_pago_detalle_1 = [
						"pagoscompras_id" => $pagoscompras_id,
						"tipo_pago_id" => $tipo_pago_id1,
						"banco_id" => $banco_id1,
						"efectivo" => $efectivo1,
						"descripcion" => $referencia_pago1,				
					];	

					if($tipo_pago_id1 != 0){
						pagoCompraModelo::agregar_pago_detalles_compras_modelo($datos_pago_detalle_1);
					}
					
					$datos_pago_detalle_2 = [
						"pagoscompras_id" => $pagoscompras_id,
						"tipo_pago_id" => $tipo_pago_id2,
						"banco_id" => $banco_id2,
						"efectivo" => $efectivo2,
						"descripcion" => $referencia_pago2,				
					];	
					
					if($tipo_pago_id2 != 0){
						pagoCompraModelo::agregar_pago_detalles_compras_modelo($datos_pago_detalle_2);
					}
					
					$alert = [
						"alert" => "clear",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formPagosPurchase",
						"id" => "proceso_pagosPurchase",
						"valor" => "Registro",	
						"funcion" => "getBanco();",
						"modal" => "modal_pagosPurchase",
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
						"title" => "Ocurrio un error inesperado",
						"text" => "No hemos podido procesar su solicitud, por favor revise el monto pendiente no debe estar en cero",
						"type" => "error",
						"btn-class" => "btn-danger",					
					];				
			}			
		
			return mainModel::sweetAlert($alert);
		}
		
		public function cancelar_pago_controlador(){
			$pagos_id = $_POST['pagos_id'];
			
			$query = facturasModelo::cancelar_pago_modelo($pagos_id);
			
			if($query){
				$alert = [
					"alert" => "clear",
					"title" => "Registro eliminado",
					"text" => "El registro se ha eliminado correctamente",
					"type" => "success",
					"btn-class" => "btn-primary",
					"btn-text" => "¡Bien Hecho!",
					"form" => "",	
					"id" => "",
					"valor" => "Cancelar",
					"funcion" => ""
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
	}