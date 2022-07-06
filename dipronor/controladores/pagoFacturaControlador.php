<?php
    if($peticionAjax){
        require_once "../modelos/pagoFacturaModelo.php";
    }else{
        require_once "./modelos/pagoFacturaModelo.php";
    }
	
	class pagoFacturaControlador extends pagoFacturaModelo{
		public function agregar_pago_factura_controlador(){
			session_start(['name'=>'SD']);
			$facturas_id = $_POST['facturas_id'];
			$fecha = $_POST['fecha'];			
			
			if(isset($_POST['tipo_pago_id'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['tipo_pago_id'] == ""){
					$tipo_pago_id1 = 0;
				}else{
					$tipo_pago_id1 = $_POST['tipo_pago_id'];
				}
			}else{
				$tipo_pago_id1 = 0;
			}			

			if(isset($_POST['banco_id'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['banco_id'] == ""){
					$banco_id1 = 0;
				}else{
					$banco_id1 = $_POST['banco_id'];
				}
			}else{
				$banco_id1 = 0;
			}

			$efectivo1 = $_POST['efectivo'];
			
			if(isset($_POST['tipo_pago_id1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['tipo_pago_id1'] == ""){
					$tipo_pago_id2 = 0;
				}else{
					$tipo_pago_id2= $_POST['tipo_pago_id1'];
				}
			}else{
				$tipo_pago_i2 = 0;
			}

			if(isset($_POST['banco_id1'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['banco_id1'] == ""){
					$banco_id2 = 0;
				}else{
					$banco_id2 = $_POST['banco_id1'];
				}
			}else{
				$banco_id2 = 0;
			}

			$efectivo2 = $_POST['efectivo1'];
			$referencia_pago1 = mainModel::cleanStringConverterCase($_POST['referencia_pago1']);
			$referencia_pago2 = mainModel::cleanStringConverterCase($_POST['referencia_pago2']);
			$importe = $_POST['importe'];
			$cambio = $_POST['cambio'];
			$m_pendiente = $_POST['m_pendiente'];
			$usuario = $_SESSION['colaborador_id_sd'];
			$fecha_registro = date("Y-m-d H:i:s");
			$estado = 1;
			
			$datos = [
				"facturas_id" => $facturas_id,
				"fecha" => $fecha,
				"importe" => $importe,
				"cambio" => $cambio,
				"usuario" => $usuario,
				"estado" => $estado,
				"fecha_registro" => $fecha_registro,				
			];
			
			if($m_pendiente == 0){
				$query = pagoFacturaModelo::agregar_pago_factura_modelo($datos);

				if($query){
					//ACTUALIZAMOS EL DETALLE DEL PAGO
					$consulta_pago = pagoFacturaModelo::consultar_codigo_pago_modelo($facturas_id)->fetch_assoc();
					$pagos_id = $consulta_pago['pagos_id'];
												
					$datos_pago_detalle_1 = [
						"pagos_id" => $pagos_id,
						"tipo_pago_id" => $tipo_pago_id1,
						"banco_id" => $banco_id1,
						"efectivo" => $efectivo1,
						"descripcion" => $referencia_pago1,				
					];	

					if($tipo_pago_id1 != 0){
						pagoFacturaModelo::agregar_pago_detalles_factura_modelo($datos_pago_detalle_1);
					}
					
					$datos_pago_detalle_2 = [
						"pagos_id" => $pagos_id,
						"tipo_pago_id" => $tipo_pago_id2,
						"banco_id" => $banco_id2,
						"efectivo" => $efectivo2,
						"descripcion" => $referencia_pago2,				
					];	
					
					if($tipo_pago_id2 != 0){
						pagoFacturaModelo::agregar_pago_detalles_factura_modelo($datos_pago_detalle_2);
					}
					
					$alert = [
						"alert" => "clear",
						"title" => "Registro almacenado",
						"text" => "El registro se ha almacenado correctamente",
						"type" => "success",
						"btn-class" => "btn-primary",
						"btn-text" => "¡Bien Hecho!",
						"form" => "formPagos",
						"id" => "proceso_pagos",
						"valor" => "Registro",	
						"funcion" => "getBanco();",
						"modal" => "modal_pagos",
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