<?php
    if($peticionAjax){
        require_once "../modelos/comprasModelo.php";
    }else{
        require_once "./modelos/comprasModelo.php";
    }
	
	class comprasControlador extends comprasModelo{
		public function agregar_compras_controlador(){
			session_start(['name'=>'SD']);
			$usuario = $_SESSION['colaborador_id_sd'];
			$empresa_id = $_SESSION['empresa_id_sd'];			
			//ENCABEZADO DE LA COMPRA
			$proveedores_id = $_POST['proveedores_id'];
			$proveedor = $_POST['proveedor'];
			$colaboradores_id = $_POST['colaborador_id'];
			
			if(isset($_POST['tipoPurchase'])){//COMPRUEBO SI LA VARIABLE ESTA DIFINIDA
				if($_POST['tipoPurchase'] == ""){
					$tipoPurchase = 2;
				}else{
					$tipoPurchase = $_POST['tipoPurchase'];
				}
			}else{
				$tipoPurchase = 2;
			}
			
			$number = $_POST['facturaPurchase'];
			$no_factura = $number;
			$notas = mainModel::cleanStringConverterCase($_POST['notesPurchase']);
			$fecha = $_POST['fechaPurchase'];
			$fecha_registro = date("Y-m-d H:i:s");
			
			$estado = 2;//PAGADA
			
			$datos = [
				"proveedores_id" => $proveedores_id,
				"number" => $number,
				"tipoPurchase" => $tipoPurchase,				
				"number" => $number,
				"colaboradores_id" => $colaboradores_id,
				"importe" => 0,
				"notas" => $notas,
				"fecha" => $fecha,				
				"estado" => $estado,
				"usuario" => $usuario,
				"fecha_registro" => $fecha_registro			
			];
						
			if($proveedores_id != "" && $colaboradores_id != "" && $number != ""){
				if(comprasModelo::validNumberCompras($proveedores_id, $fecha, $number, $colaboradores_id)->num_rows==0){
					//OBTENEMOS EL TAMAÑO DE LA TABLA
					if(isset($_POST['productNamePurchase'])){	
						if($_POST['productos_idPurchase'][0] && $_POST['productNamePurchase'][0] != "" && $_POST['quantityPurchase'][0] && $_POST['pricePurchase'][0]){
							$tamano_tabla = count( $_POST['productNamePurchase']);
						}else{
							$tamano_tabla = 0;
						}
					}else{
						$tamano_tabla = 0;
					}				
					
					//SI EXITE VALORES EN LA TABLA, PROCEDEMOS ALMACENAR LA FACTURA Y EL DETALLE DE ESTA
					if($tamano_tabla >0){
						//EINICIO FACTURA CONTADO
						if($tipoPurchase == 1){		
							$query = comprasModelo::agregar_compras_modelo($datos);
						
							if($query){
								//ALMACENAMOS LOS DETALLES DE LA FACTURA
								$consulta_compra = comprasModelo::obtener_compraID_modelo($proveedores_id, $fecha, $number, $colaboradores_id)->fetch_assoc();
								$compras_id = $consulta_compra['compras_id'];
								
								$total_valor = 0;
								$descuentos = 0;
								$isv_neto = 0;
								$total_despues_isv = 0;
								
								for ($i = 0; $i < count( $_POST['productNamePurchase']); $i++){//INICIO CICLO FOR
									$productos_id = $_POST['productos_idPurchase'][$i];
									$productName = $_POST['productNamePurchase'][$i];
									$quantity = $_POST['quantityPurchase'][$i];
									$price = $_POST['pricePurchase'][$i];
									$discount = $_POST['discountPurchase'][$i];
									$total = $_POST['totalPurchase'][$i];			
									$isv_valor = 0;
									
									if($productos_id != "" && $productName != "" && $quantity != "" && $price != "" && $discount != "" && $total != ""){
										//OBTENEMOS EL VALOR DEL PORCENTAJE DE ISV DE LOS PRODUCTOS
										$porcentajeISV = 0;
										
										$result_isv = comprasModelo::getISV_modelo();
										
										if($result_isv->num_rows>0){
											$consulta_isv_valor = $result_isv->fetch_assoc();
											$porcentajeISV = $consulta_isv_valor["nombre"];						
										}
										
										//CONSULTAMOS EL ESTADO DEL ISV DEL PRODUCTOS PARA VALIDAR SI APLICA REALIZAR EL CALCULO DE ESTE
										$result_productos_isv_activo = comprasModelo::getISVEstadoProducto_modelo($productos_id);
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
										$result_factura_detalle = comprasModelo::validDetalleCompras($compras_id, $productos_id);	

										$datos_detalles_facturas = [
											"compras_id" => $compras_id,
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
											comprasModelo::actualizar_detalle_compras($datos_detalles_facturas);								
										}else{
											//INSERTAMOS LOS DE PRODUCTOS EN EL DETALLE DE LA FACTURA
											comprasModelo::agregar_detalle_compras($datos_detalles_facturas);
										}							
										
										//OBTENEMOS LA CATEOGRIA DEL PRODUCTO PARA EVALUAR SI ES UN PRODUCTO, AGREGAR LA SALIDA DE ESTE
										$result_categoria = comprasModelo::categoria_producto_modelo($productos_id);
							
										$categoria_producto = "";
									
										if($result_categoria->num_rows>0){
											$consulta_categoria = $result_categoria->fetch_assoc();
											$categoria_producto = $consulta_categoria["categoria"];
											
											//SI LA CATEGORIA ES PRODUCTO PROCEDEMOS A RALIZAR LA SALIDA Y ACTUALIZAMOS LA NUEVA CANTIDAD DEL PRODUCTO, AGREGANDO TAMBIÉN EL MOVIMIENTO DE ESTE
											if($categoria_producto == "Producto"){
												$result_productos = comprasModelo::cantidad_producto_modelo($productos_id);			  

												$cantidad_productos = "";
												
												if($result_productos->num_rows>0){
													$consulta = $result_productos->fetch_assoc();
													$cantidad_productos = $consulta['cantidad'];
												}	

												$cantidad = $cantidad_productos + $quantity;
																					
												//ACTUALIZAMOS LA NUEVA CANTIDAD EN LA ENTIDAD PRODUCTOS
												comprasModelo::actualizar_productos_modelo($productos_id, $cantidad, $price);
												
												//CONSULTAMOS EL SALDO DEL PRODUCTO EN LA ENTIDAD MOVIMIENTOS
												$result_movimientos = comprasModelo::saldo_productos_movimientos_modelo($productos_id);
												
												$saldo_productos = 0;
												
												if($result_movimientos->num_rows>0){
													$consulta = $result_movimientos->fetch_assoc();
													$saldo_productos = $consulta['saldo'];
												}
												
												$saldo = $saldo_productos + $quantity;						
																										
												$cantidad_entrada = $quantity;
												$cantidad_salida = 0;
												$documento = "Compra ".$no_factura;									
												
												$datos_movimientos_productos = [
													"productos_id" => $productos_id,
													"documento" => $documento,
													"cantidad_entrada" => $cantidad_entrada,				
													"cantidad_salida" => $cantidad_salida,
													"saldo" => $saldo,
													"fecha_registro" => $fecha_registro,				
												];	

												comprasModelo::agregar_movimientos_productos_modelo($datos_movimientos_productos);
											}								
										}							
									}
								}//FIN CICLO FOR
								$total_despues_isv = ($total_valor + $isv_neto) - $descuentos;
								
								//ACTUALIZAMOS EL IMPORTE EN LA COMPRA
								$datos_factura = [
									"compras_id" => $compras_id,
									"importe" => $total_despues_isv		
								];
								
								comprasModelo::actualizar_compra_importe($datos_factura);
							
								$alert = [
									"alert" => "save_simple",
									"title" => "Registro almacenado",
									"text" => "El registro se ha almacenado correctamente",
									"type" => "success",
									"btn-class" => "btn-primary",
									"btn-text" => "¡Bien Hecho!",
									"form" => "purchase-form",	
									"id" => "proceso_Purchase",
									"valor" => "Registro",
									"funcion" => "limpiarTablaCompras();pagoCompras(".$compras_id.");getColaboradorCompras();",
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
							$query = comprasModelo::agregar_compras_modelo($datos);
						
							if($query){
								//ALMACENAMOS LOS DETALLES DE LA FACTURA
								$consulta_compra = comprasModelo::obtener_compraID_modelo($proveedores_id, $fecha, $number, $colaboradores_id)->fetch_assoc();
								$compras_id = $consulta_compra['compras_id'];
								
								$total_valor = 0;
								$descuentos = 0;
								$isv_neto = 0;
								$total_despues_isv = 0;
								
								for ($i = 0; $i < count( $_POST['productNamePurchase']); $i++){//INICIO CICLO FOR
									$productos_id = $_POST['productos_idPurchase'][$i];
									$productName = $_POST['productNamePurchase'][$i];
									$quantity = $_POST['quantityPurchase'][$i];
									$price = $_POST['pricePurchase'][$i];
									$discount = $_POST['discountPurchase'][$i];
									$total = $_POST['totalPurchase'][$i];			
									$isv_valor = 0;
									
									if($productos_id != "" && $productName != "" && $quantity != "" && $price != "" && $discount != "" && $total != ""){
										//OBTENEMOS EL VALOR DEL PORCENTAJE DE ISV DE LOS PRODUCTOS
										$porcentajeISV = 0;
										
										$result_isv = comprasModelo::getISV_modelo();
										
										if($result_isv->num_rows>0){
											$consulta_isv_valor = $result_isv->fetch_assoc();
											$porcentajeISV = $consulta_isv_valor["nombre"];						
										}
										
										//CONSULTAMOS EL ESTADO DEL ISV DEL PRODUCTOS PARA VALIDAR SI APLICA REALIZAR EL CALCULO DE ESTE
										$result_productos_isv_activo = comprasModelo::getISVEstadoProducto_modelo($productos_id);
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
										$result_factura_detalle = comprasModelo::validDetalleCompras($compras_id, $productos_id);	

										$datos_detalles_facturas = [
											"compras_id" => $compras_id,
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
											comprasModelo::actualizar_detalle_compras($datos_detalles_facturas);								
										}else{
											//INSERTAMOS LOS DE PRODUCTOS EN EL DETALLE DE LA FACTURA
											comprasModelo::agregar_detalle_compras($datos_detalles_facturas);
										}							
										
										//OBTENEMOS LA CATEOGRIA DEL PRODUCTO PARA EVALUAR SI ES UN PRODUCTO, AGREGAR LA SALIDA DE ESTE
										$result_categoria = comprasModelo::categoria_producto_modelo($productos_id);
							
										$categoria_producto = "";
									
										if($result_categoria->num_rows>0){
											$consulta_categoria = $result_categoria->fetch_assoc();
											$categoria_producto = $consulta_categoria["categoria"];
											
											//SI LA CATEGORIA ES PRODUCTO PROCEDEMOS A RALIZAR LA SALIDA Y ACTUALIZAMOS LA NUEVA CANTIDAD DEL PRODUCTO, AGREGANDO TAMBIÉN EL MOVIMIENTO DE ESTE
											if($categoria_producto == "Producto"){
												$result_productos = comprasModelo::cantidad_producto_modelo($productos_id);			  

												$cantidad_productos = "";
												
												if($result_productos->num_rows>0){
													$consulta = $result_productos->fetch_assoc();
													$cantidad_productos = $consulta['cantidad'];
												}	

												$cantidad = $cantidad_productos + $quantity;
																					
												//ACTUALIZAMOS LA NUEVA CANTIDAD EN LA ENTIDAD PRODUCTOS
												comprasModelo::actualizar_productos_modelo($productos_id, $cantidad, $price);
												
												//CONSULTAMOS EL SALDO DEL PRODUCTO EN LA ENTIDAD MOVIMIENTOS
												$result_movimientos = comprasModelo::saldo_productos_movimientos_modelo($productos_id);
												
												$saldo_productos = 0;
												
												if($result_movimientos->num_rows>0){
													$consulta = $result_movimientos->fetch_assoc();
													$saldo_productos = $consulta['saldo'];
												}
												
												$saldo = $saldo_productos + $quantity;						
																										
												$cantidad_entrada = $quantity;
												$cantidad_salida = 0;
												$documento = "Compra ".$no_factura;									
												
												$datos_movimientos_productos = [
													"productos_id" => $productos_id,
													"documento" => $documento,
													"cantidad_entrada" => $cantidad_entrada,				
													"cantidad_salida" => $cantidad_salida,
													"saldo" => $saldo,
													"fecha_registro" => $fecha_registro,				
												];	

												comprasModelo::agregar_movimientos_productos_modelo($datos_movimientos_productos);
											}								
										}							
									}
								}//FIN CICLO FOR
								$total_despues_isv = ($total_valor + $isv_neto) - $descuentos;
								
								//ACTUALIZAMOS EL IMPORTE EN LA COMPRA
								$datos_factura = [
									"compras_id" => $compras_id,
									"importe" => $total_despues_isv		
								];
								
								comprasModelo::actualizar_compra_importe($datos_factura);
								
								//AGREGAMOS LA CUENTA POR COBRAR CLIENTES
								$estado_cuenta_cobrar = 1;//CRÉDITO
								
								$datos_cobrar_clientes = [
									"proveedores_id" => $proveedores_id,
									"compras_id" => $compras_id,
									"fecha" => $fecha,				
									"saldo" => $total_despues_isv,
									"estado" => $estado_cuenta_cobrar,
									"usuario" => $usuario,
									"fecha_registro" => $fecha_registro			
								];		
								
								comprasModelo::agregar_cuenta_por_pagar_proveedores($datos_cobrar_clientes);
							
								$alert = [
									"alert" => "save_simple",
									"title" => "Registro almacenado",
									"text" => "El registro se ha almacenado correctamente",
									"type" => "success",
									"btn-class" => "btn-primary",
									"btn-text" => "¡Bien Hecho!",
									"form" => "purchase-form",	
									"id" => "proceso_Purchase",
									"valor" => "Registro",
									"funcion" => "limpiarTablaCompras();getColaboradorCompras();",
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
							"text" => "Lo sentimos al parecer no ha seleccionado un producto en el detalle de la compra, antes de proceder debe seleccionar por lo menos un producto para realizar la facturación",
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
			}else{
				$alert = [
					"alert" => "simple",
					"title" => "Error Registros en Blanco",
					"text" => "Lo sentimos el proveedor, el usuario y el número de factura, no pueden quedar en blanco, por favor corregir",
					"type" => "error",
					"btn-class" => "btn-danger",
				];					
			}			

			return mainModel::sweetAlert($alert);
		}
		
		public function cancelar_facturas_controlador(){
			$facturas_id = $_POST['facturas_id'];
			
			$query = comprasModelo::cancelar_facturas_modelo($facturas_id);
			
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