<?php
    if($peticionAjax){
        require_once "../modelos/facturasModelo.php";
    }else{
        require_once "./modelos/facturasModelo.php";
    }
	
	class facturasControlador extends facturasModelo{
		public function agregar_facturas_controlador(){
			session_start(['name'=>'SD']);
			$usuario = $_SESSION['colaborador_id_sd'];
			$empresa_id = $_SESSION['empresa_id_sd'];			
			//ENCABEZADO DE FACTURA
			$clientes_id = $_POST['cliente_id'];
			$colaborador_id = $_POST['colaborador_id'];
			
			if(isset($_POST['tipo_factura'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['tipo_factura'] == ""){
					$tipo_factura = 2;
				}else{
					$tipo_factura = $_POST['tipo_factura'];
				}
			}else{
				$tipo_factura = 2;
			}
			
			$secuenciaFacturacion = facturasModelo::secuencia_facturacion($empresa_id)->fetch_assoc();
			$secuencia_facturacion_id = $secuenciaFacturacion['secuencia_facturacion_id'];
			$numero = $secuenciaFacturacion['numero'];
			$incremento = $secuenciaFacturacion['incremento'];
			$no_factura = $secuenciaFacturacion['prefijo']."".str_pad($secuenciaFacturacion['numero'], $secuenciaFacturacion['relleno'], "0", STR_PAD_LEFT);
			$notas = mainModel::cleanStringConverterCase($_POST['notes']);
			$fecha = $_POST['fecha'];
			$fecha_registro = date("Y-m-d H:i:s");
			
			$estado = 2;//PAGADA
			
			$datos = [
				"clientes_id" => $clientes_id,
				"secuencia_facturacion_id" => $secuencia_facturacion_id,
				"tipo_factura" => $tipo_factura,				
				"numero" => $numero,
				"colaboradores_id" => $colaborador_id,
				"importe" => 0,
				"notas" => $notas,
				"fecha" => $fecha,				
				"estado" => $estado,
				"usuario" => $usuario,
				"fecha_registro" => $fecha_registro			
			];	
						
			if($clientes_id != "" && $colaborador_id != ""){
				//OBTENEMOS EL TAMAÑO DE LA TABLA
				if(isset($_POST['productName'])){	
					if($_POST['productos_id'][0] && $_POST['productName'][0] != "" && $_POST['quantity'][0] && $_POST['price'][0]){
						$tamano_tabla = count( $_POST['productName']);
					}else{
						$tamano_tabla = 0;
					}
				}else{
					$tamano_tabla = 0;
				}				
				
				//SI EXITE VALORES EN LA TABLA, PROCEDEMOS ALMACENAR LA FACTURA Y EL DETALLE DE ESTA
				if($tamano_tabla >0){
					//EINICIO FACTURA CONTADO
					if($tipo_factura == 1){		
						$query = facturasModelo::agregar_facturas_modelo($datos);
					
						if($query){
							//ALMACENAMOS LOS DETALLES DE LA FACTURA
							$consulta_factura = facturasModelo::obtener_facturaID_modelo($clientes_id, $fecha, $numero, $colaborador_id)->fetch_assoc();
							$facturas_id = $consulta_factura['facturas_id'];
							$total_valor = 0;
							$descuentos = 0;
							$isv_neto = 0;
							$total_despues_isv = 0;
							
							for ($i = 0; $i < count( $_POST['productName']); $i++){//INICIO CICLO FOR
								$productos_id = $_POST['productos_id'][$i];
								$productName = $_POST['productName'][$i];
								$quantity = $_POST['quantity'][$i];
								$price = $_POST['price'][$i];
								$discount = $_POST['discount'][$i];
								$total = $_POST['total'][$i];			
								$isv_valor = 0;
								
								if($productos_id != "" && $productName != "" && $quantity != "" && $price != "" && $discount != "" && $total != ""){
									//OBTENEMOS EL VALOR DEL PORCENTAJE DE ISV DE LOS PRODUCTOS
									$porcentajeISV = 0;
									
									$result_isv = facturasModelo::getISV_modelo();
									
									if($result_isv->num_rows>0){
										$consulta_isv_valor = $result_isv->fetch_assoc();
										$porcentajeISV = $consulta_isv_valor["nombre"];						
									}
									
									//CONSULTAMOS EL ESTADO DEL ISV DEL PRODUCTOS PARA VALIDAR SI APLICA REALIZAR EL CALCULO DE ESTE
									$result_productos_isv_activo = facturasModelo::getISVEstadoProducto_modelo($productos_id);
									$aplica_isv = 0;
									
									if($result_productos_isv_activo->num_rows>0){
										$consulta_aplica_isv_productos = $result_productos_isv_activo->fetch_assoc();
										$aplica_isv = $consulta_aplica_isv_productos["isv_venta"];						
									}							
									
									$porcentaje_isv = 0;								
									
									if($aplica_isv == 1){
										$porcentaje_isv = ($porcentajeISV / 100);
										$isv_valor = $price * $quantity * $porcentaje_isv;
									}		
						
									//VERIFICAMOS SI NO EXISTE LA FACTURA, DE NO EXISTIR LA ACTUALIZAMOS
									$result_factura_detalle = facturasModelo::validDetalleFactura($facturas_id, $productos_id);	

									$datos_detalles_facturas = [
										"facturas_id" => $facturas_id,
										"productos_id" => $productos_id,
										"cantidad" => $quantity,				
										"precio" => $price,
										"isv_valor" => $isv_valor,
										"descuento" => $discount,				
									];	
									
									$total_valor += ($price * $quantity);
									$descuentos += $discount;
									$isv_neto += $isv_valor;									
									
									if($result_factura_detalle->num_rows>0){
										//INSERTAMOS LOS DE PRODUCTOS EN EL DETALLE DE LA FACTURA
										facturasModelo::actualizar_detalle_facturas($datos_detalles_facturas);								
									}else{
										//INSERTAMOS LOS DE PRODUCTOS EN EL DETALLE DE LA FACTURA
										facturasModelo::agregar_detalle_facturas($datos_detalles_facturas);
									}							
									
									//OBTENEMOS LA CATEOGRIA DEL PRODUCTO PARA EVALUAR SI ES UN PRODUCTO, AGREGAR LA SALIDA DE ESTE
									$result_categoria = facturasModelo::categoria_producto_modelo($productos_id);
						
									$categoria_producto = "";
								
									if($result_categoria->num_rows>0){
										$consulta_categoria = $result_categoria->fetch_assoc();
										$categoria_producto = $consulta_categoria["categoria"];
										
										//SI LA CATEGORIA ES PRODUCTO PROCEDEMOS A RALIZAR LA SALIDA Y ACTUALIZAMOS LA NUEVA CANTIDAD DEL PRODUCTO, AGREGANDO TAMBIÉN EL MOVIMIENTO DE ESTE
										if($categoria_producto == "Producto"){
											$result_productos = facturasModelo::cantidad_producto_modelo($productos_id);			  

											$cantidad_productos = "";
											
											if($result_productos->num_rows>0){
												$consulta = $result_productos->fetch_assoc();
												$cantidad_productos = $consulta['cantidad'];
											}	

											$cantidad = $cantidad_productos - $quantity;
																				
											//ACTUALIZAMOS LA NUEVA CANTIDAD EN LA ENTIDAD PRODUCTOS
											facturasModelo::actualizar_cantidad_productos_modelo($productos_id, $cantidad);
											
											//CONSULTAMOS EL SALDO DEL PRODUCTO EN LA ENTIDAD MOVIMIENTOS
											$result_movimientos = facturasModelo::saldo_productos_movimientos_modelo($productos_id);
											
											$saldo_productos = 0;
											
											if($result_movimientos->num_rows>0){
												$consulta = $result_movimientos->fetch_assoc();
												$saldo_productos = $consulta['saldo'];
											}
											
											$saldo = $saldo_productos - $quantity;						
																									
											$cantidad_entrada = 0;
											$cantidad_salida = $quantity;
											$documento = "Factura ".$no_factura;									
											
											$datos_movimientos_productos = [
												"productos_id" => $productos_id,
												"documento" => $documento,
												"cantidad_entrada" => $cantidad_entrada,				
												"cantidad_salida" => $cantidad_salida,
												"saldo" => $saldo,
												"fecha_registro" => $fecha_registro,				
											];	

											facturasModelo::agregar_movimientos_productos_modelo($datos_movimientos_productos);
										}								
									}							
								}
							}//FIN CICLO FOR
							$total_despues_isv = ($total_valor + $isv_neto) - $descuentos;
							
							//ACTUALIZAMOS EL NUMERO SIGUIENTE DE LA SECUENCIA PARA LA FACTURACION
							$numero += $incremento;
							facturasModelo::actualizar_secuencia_facturacion_modelo($secuencia_facturacion_id, $numero);
							
							//ACTUALIZAMOS EL IMPORTE EN LA FACTURA
							$datos_factura = [
								"facturas_id" => $facturas_id,
								"importe" => $total_despues_isv		
							];
							
							facturasModelo::actualizar_factura_importe($datos_factura);
							
							$alert = [
								"alert" => "save_simple",
								"title" => "Registro almacenado",
								"text" => "El registro se ha almacenado correctamente",
								"type" => "success",
								"btn-class" => "btn-primary",
								"btn-text" => "¡Bien Hecho!",
								"form" => "invoice-form",	
								"id" => "proceso_factura",
								"valor" => "Registro",
								"funcion" => "limpiarTablaFactura();pago(".$facturas_id.");",
								"modal" => "",
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
					//FIN FACTURA CONTADO
					}else{//INICIO FACTURA CRÉDITO
						//SI LA FACTURA ES AL CRÉDITO ALMACENAMOS LOS DATOS DE LA FACTURA PERO NO REGISTRAMOS EL PAGO, SIMPLEMENTE DEJAMOS LA CUENTA POR COBRAR A LOS CLIENTES
						$query = facturasModelo::agregar_facturas_modelo($datos);
						
						if($query){
							//ALMACENAMOS LOS DETALLES DE LA FACTURA
							$consulta_factura = facturasModelo::obtener_facturaID_modelo($clientes_id, $fecha, $numero, $colaborador_id)->fetch_assoc();
							$facturas_id = $consulta_factura['facturas_id'];
							
							$total_valor = 0;
							$descuentos = 0;
							$isv_neto = 0;
							$total_despues_isv = 0;
							
							for ($i = 0; $i < count( $_POST['productName']); $i++){//INICIO CICLO FOR
								$productos_id = $_POST['productos_id'][$i];
								$productName = $_POST['productName'][$i];
								$quantity = $_POST['quantity'][$i];
								$price = $_POST['price'][$i];
								$discount = $_POST['discount'][$i];
								$total = $_POST['total'][$i];			
								$isv_valor = 0;								
								
								if($productos_id != "" && $productName != "" && $quantity != "" && $price != "" && $discount != "" && $total != ""){
									//OBTENEMOS EL VALOR DEL PORCENTAJE DE ISV DE LOS PRODUCTOS
									$porcentajeISV = 0;
									
									$result_isv = facturasModelo::getISV_modelo();
									
									if($result_isv->num_rows>0){
										$consulta_isv_valor = $result_isv->fetch_assoc();
										$porcentajeISV = $consulta_isv_valor["nombre"];						
									}
									
									//CONSULTAMOS EL ESTADO DEL ISV DEL PRODUCTOS PARA VALIDAR SI APLICA REALIZAR EL CALCULO DE ESTE
									$result_productos_isv_activo = facturasModelo::getISVEstadoProducto_modelo($productos_id);
									$aplica_isv = 0;
									
									if($result_productos_isv_activo->num_rows>0){
										$consulta_aplica_isv_productos = $result_productos_isv_activo->fetch_assoc();
										$aplica_isv = $consulta_aplica_isv_productos["isv_venta"];						
									}							
									
									$porcentaje_isv = 0;								
									
									if($aplica_isv == 1){
										$porcentaje_isv = ($porcentajeISV / 100);
										$isv_valor = $price * $quantity * $porcentaje_isv;
									}		
						
									//VERIFICAMOS SI NO EXISTE LA FACTURA, DE NO EXISTIR LA ACTUALIZAMOS
									$result_factura_detalle = facturasModelo::validDetalleFactura($facturas_id, $productos_id);	

									$datos_detalles_facturas = [
										"facturas_id" => $facturas_id,
										"productos_id" => $productos_id,
										"cantidad" => $quantity,				
										"precio" => $price,
										"isv_valor" => $isv_valor,
										"descuento" => $discount,				
									];	
									
									$total_valor += ($price * $quantity);
									$descuentos += $discount;
									$isv_neto += $isv_valor;
									
									if($result_factura_detalle->num_rows>0){
										//INSERTAMOS LOS DE PRODUCTOS EN EL DETALLE DE LA FACTURA
										facturasModelo::actualizar_detalle_facturas($datos_detalles_facturas);								
									}else{
										//INSERTAMOS LOS DE PRODUCTOS EN EL DETALLE DE LA FACTURA
										facturasModelo::agregar_detalle_facturas($datos_detalles_facturas);
									}							
									
									//OBTENEMOS LA CATEOGRIA DEL PRODUCTO PARA EVALUAR SI ES UN PRODUCTO, AGREGAR LA SALIDA DE ESTE
									$result_categoria = facturasModelo::categoria_producto_modelo($productos_id);
						
									$categoria_producto = "";
								
									if($result_categoria->num_rows>0){
										$consulta_categoria = $result_categoria->fetch_assoc();
										$categoria_producto = $consulta_categoria["categoria"];
										
										//SI LA CATEGORIA ES PRODUCTO PROCEDEMOS A RALIZAR LA SALIDA Y ACTUALIZAMOS LA NUEVA CANTIDAD DEL PRODUCTO, AGREGANDO TAMBIÉN EL MOVIMIENTO DE ESTE
										if($categoria_producto == "Producto"){
											$result_productos = facturasModelo::cantidad_producto_modelo($productos_id);			  

											$cantidad_productos = "";
											
											if($result_productos->num_rows>0){
												$consulta = $result_productos->fetch_assoc();
												$cantidad_productos = $consulta['cantidad'];
											}	

											$cantidad = $cantidad_productos - $quantity;
																				
											//ACTUALIZAMOS LA NUEVA CANTIDAD EN LA ENTIDAD PRODUCTOS
											facturasModelo::actualizar_cantidad_productos_modelo($productos_id, $cantidad);
											
											//CONSULTAMOS EL SALDO DEL PRODUCTO EN LA ENTIDAD MOVIMIENTOS
											$result_movimientos = facturasModelo::saldo_productos_movimientos_modelo($productos_id);
											
											$saldo_productos = 0;
											
											if($result_movimientos->num_rows>0){
												$consulta = $result_movimientos->fetch_assoc();
												$saldo_productos = $consulta['saldo'];
											}
											
											$saldo = $saldo_productos - $quantity;						
																									
											$cantidad_entrada = 0;
											$cantidad_salida = $quantity;
											$documento = "Factura ".$no_factura;									
											
											$datos_movimientos_productos = [
												"productos_id" => $productos_id,
												"documento" => $documento,
												"cantidad_entrada" => $cantidad_entrada,				
												"cantidad_salida" => $cantidad_salida,
												"saldo" => $saldo,
												"fecha_registro" => $fecha_registro,				
											];	

											facturasModelo::agregar_movimientos_productos_modelo($datos_movimientos_productos);
										}								
									}									
								}
							}//FIN CICLO FOR
							$total_despues_isv = ($total_valor + $isv_neto) - $descuentos;
							
							//ACTUALIZAMOS EL NUMERO SIGUIENTE DE LA SECUENCIA PARA LA FACTURACION
							$numero += $incremento;
							facturasModelo::actualizar_secuencia_facturacion_modelo($secuencia_facturacion_id, $numero);
									
							//ACTUALIZAMOS EL IMPORTE EN LA FACTURA
							$datos_factura = [
								"facturas_id" => $facturas_id,
								"importe" => $total_despues_isv		
							];
							
							facturasModelo::actualizar_factura_importe($datos_factura);
							
							//AGREGAMOS LA CUENTA POR COBRAR CLIENTES
							$estado_cuenta_cobrar = 1;//CRÉDITO
							
							$datos_cobrar_clientes = [
								"clientes_id" => $clientes_id,
								"facturas_id" => $facturas_id,
								"fecha" => $fecha,				
								"saldo" => $total_despues_isv,
								"estado" => $estado_cuenta_cobrar,
								"usuario" => $usuario,
								"fecha_registro" => $fecha_registro			
							];		
							
							facturasModelo::agregar_cuenta_por_cobrar_clientes($datos_cobrar_clientes);
							
							$alert = [
								"alert" => "save_simple",
								"title" => "Registro almacenado",
								"text" => "El registro se ha almacenado correctamente",
								"type" => "success",
								"btn-class" => "btn-primary",
								"btn-text" => "¡Bien Hecho!",
								"form" => "invoice-form",	
								"id" => "proceso_factura",
								"valor" => "Registro",
								"funcion" => "limpiarTablaFactura();",
								"modal" => "",
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
					}//FIN FACTURA CRÉDITO
				}else{
					$alert = [
						"alert" => "simple",
						"title" => "Error Registros en Blanco",
						"text" => "Lo sentimos al parecer no ha seleccionado un producto en el detalle de la factura, antes de proceder debe seleccionar por lo menos un producto para realizar la facturación",
						"type" => "error",
						"btn-class" => "btn-danger",
					];						
				}				
			}else{
				$alert = [
					"alert" => "simple",
					"title" => "Error Registros en Blanco",
					"text" => "Lo sentimos el cliente y el vendedor no pueden quedar en blanco, por favor corregir",
					"type" => "error",
					"btn-class" => "btn-danger",
				];					
			}			

			return mainModel::sweetAlert($alert);
		}
		
		public function cancelar_facturas_controlador(){
			$facturas_id = $_POST['facturas_id'];
			
			$query = facturasModelo::cancelar_facturas_modelo($facturas_id);
			
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
					"funcion" => "",
					"modal" => "",
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