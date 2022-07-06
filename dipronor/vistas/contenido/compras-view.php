<div class="container-fluid">
    <ol class="breadcrumb mt-2 mb-4">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SERVERURL; ?>dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Compras</li>
    </ol>
	<div class="card mb-4">
		<div class="card-header">
			<i class="fas fa-file-invoice-dollar mr-1"></i>
			Compras
		</div>
		<div class="card-body"> 
			<div class="table-responsive">	
				<form class="FormularioAjax" id="purchase-form" action="<?php echo SERVERURL;?>ajax/addComprasAjax.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data" >
				  <div class="form-group row">	
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit" id="reg_factura" form="purchase-form" data-toggle="tooltip" data-placement="top" title="Registrar Factura"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
					</div>				
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Factura <span class="priority">*<span/></label>
					<div class="col-sm-3">
						<input type="text" class="form-control" placeholder="Número de Factura de Compra" id="facturaPurchase" name="facturaPurchase" required data-toggle="tooltip" data-placement="top" title="Factura Compra" maxlength="19" required>
					</div>						
				  </div>				  
				  <div class="form-group row">
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Proveedor <span class="priority">*<span/></label>
					<div class="col-sm-5">
						<div class="input-group mb-3">
						  <input type="hidden" class="form-control" placeholder="Proceso" id="proceso_Purchase" name="proceso_Purchase" readonly>
						  <input type="hidden" class="form-control" placeholder="Compra" id="compras_id" name="compras_id" readonly>
						  <input type="hidden" class="form-control" placeholder="Proveedor" id="proveedores_id" name="proveedores_id" readonly required>
						  <input type="text" class="form-control" placeholder="Proveedor" id="proveedor" name="proveedor" required readonly data-toggle="tooltip" data-placement="top" title="Proveedor">					  
						  <div class="input-group-append">				
							<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Empleados"><a data-toggle="modal" href="#" class="btn btn-outline-success" id="buscar_proveedores_compras"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span>
						  </div>
						</div>	
					</div>
					<label for="inputFecha" class="col-sm-1 col-form-label-md">Fecha <span class="priority">*<span/></label>
					<div class="col-sm-3">
					  <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required id="fechaPurchase" name="fechaPurchase" data-toggle="tooltip" data-placement="top" title="Fecha de Facturación">				
					</div>					
				  </div>				  
				  <div cla
				  <div class="form-group row">
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Usuario <span class="priority">*<span/></label>
					<div class="col-sm-5">
					<div class="input-group mb-3">
					  <input type="hidden" class="form-control" placeholder="Vendedor" id="colaborador_id" name="colaborador_id" aria-label="Colaborador" aria-describedby="basic-addon2" readonly required>
					  <input type="text" class="form-control" placeholder="Vendedor" id="colaborador" name="colaborador" aria-label="Colaborador" aria-describedby="basic-addon2" required readonly data-toggle="tooltip" data-placement="top" title="Vendedor">					  
					  <div class="input-group-append" id="grupo_buscar_colaboradores">				
						<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Colaboradores"><a data-toggle="modal" href="#" class="btn btn-outline-success" id="buscar_colaboradores_compras"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a><span>
					  </div>
					</div>
					</div>
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Tipo <span class="priority">*<span/></label>
					<div class="col-sm-5">
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="tipoPurchase" id="contadoPurchase" value="1" checked data-toggle="tooltip" data-placement="top" title="Factura de Contado">
						  <label class="form-check-label" for="contado" data-toggle="tooltip" data-placement="top" title="Factura de Contado">Contado</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="tipoPurchase" id="creditoPurchase" value="2" data-toggle="tooltip" data-placement="top" title="Factura al Crédito">
						  <label class="form-check-label" for="credito" data-toggle="tooltip" data-placement="top" title="Factura al Crédito">Crédito</label>
						</div>					
					</div>					
				  </div>				  
				  <div class="form-group row table-responsive-xl">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<table class="table table-bordered table-hover" id="purchaseItem">
							<thead align="center" class="table-success">
								<tr>
									<th width="2%" scope="col"><input id="checkAllPurchase" class="formcontrol" type="checkbox"></th>
									<th width="38%">Nombre Producto</th>
									<th width="15%">Cantidad</th>
									<th width="15%">Precio</th>	
									<th width="15%">Descuento</th>									
									<th width="15%">Total</th>
								</tr>	
							</thead>
							<tbody>							
								<tr>
									<td><input class="itemRowPurchase" type="checkbox"></td>
									<td>
										<div class="input-group mb-3">
											<input type="hidden" name="isvPurchase[]" id="isvPurchase_0" class="form-control" placeholder="Producto ISV" autocomplete="off">
											<input type="hidden" name="valor_isvPurchase[]" id="valor_isvPurchase_0" class="form-control" placeholder="Valor ISV" autocomplete="off">										
											<input type="hidden" name="productos_idPurchase[]" id="productos_idPurchase_0" class="form-control" autocomplete="off">
											<input type="text" name="productNamePurchase[]" id="productNamePurchase_0" class="form-control" autocomplete="off">
											<div class="input-group-append">				
												<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos_purchase"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span>
											</div>
										</div>								
									</td>			
									<td><input type="number" name="quantityPurchase[]" id="quantityPurchase_0" class="buscar_cantidad_purchase form-control" autocomplete="off"></td>
									<td><input type="number" name="pricePurchase[]" id="pricePurchase_0" class="buscar_price_purchase form-control" autocomplete="off"></td>
									<td><input type="number" name="discountPurchase[]" id="discountPurchase_0" class="form-control" autocomplete="off"></td>
									<td><input type="number" name="totalPurchase[]" id="totalPurchase_0" class="form-control total" readonly autocomplete="off"></td>
								</tr>	
							</tbody>
						</table>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button class="btn btn-success ml-3" id="addRowsPurchase" type="button" data-toggle="tooltip" data-placement="top" title="Agregar filas en la factura"><div class="sb-nav-link-icon"></div><i class="fas fa-plus fa-lg"></i> Agregar</button>
							<button class="btn btn-danger delete" id="removeRowsPurchase" type="button" data-toggle="tooltip" data-placement="top" title="Remover filas en la factura"><div class="sb-nav-link-icon"></div><i class="fas fa-minus fa-lg"></i> Remover</button>
						</div>
					</div>					
				  </div>		
				  <div class="form-group row">
					  <div class="form-row col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-sm-12 col-md-8">
							<h3>Notas: </h3>
							<div class="form-group">
								<textarea class="form-control txt" rows="5" name="notesPurchase" id="notesPurchase" placeholder="Notas" maxlength="255"></textarea>
								<p id="charNum_notas">255 Caracteres</p>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
						  <div class="row">					  
							<div class="col-sm-3 form-inline">
							  <label>Subtotal:</label>
							</div>
							<div class="col-sm-9">	
								<div class="input-group">
									<div class="input-group-append mb-1">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>L</i></span>
									</div>												
									<input value="" type="number" class="form-control" name="subTotalPurchase" id="subTotalPurchase" readonly placeholder="Subtotal">
								</div>
							</div>
						  </div>
						  <div class="row" style="display: none;">
							<div class="col-sm-3 form-inline">
								<label>Porcentaje:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">															
									<input value="15" type="number" class="form-control" name="taxRatePurchase" id="taxRatePurchase" readonly placeholder="Tasa de Impuestos">
									<div class="input-group-append">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>%</i></span>
									</div>
								</div>
							</div>
						  </div>
						  <div class="row">
							<div class="col-sm-3 form-inline">
							  <label>ISV:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">											
									<div class="input-group-append">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>L</i></span>
									</div>	
									<input value="" type="number" class="form-control" name="taxAmountPurchase" id="taxAmountPurchase" readonly placeholder="Monto del Impuesto">
								</div>
							</div>
						  </div>
						  <div class="row">
							<div class="col-sm-3 form-inline">
							  <label>Descuento:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">											
									<div class="input-group-append">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>L</i></span>
									</div>	
									<input value="" type="number" class="form-control" name="taxDescuentoPurchase" id="taxDescuentoPurchase" readonly placeholder="Descuento Otorgado">
								</div>
							</div>
						  </div>						  
						  <div class="row">
							<div class="col-sm-3 form-inline">
								<label>Total:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">
									<div class="input-group-append">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>L</i></span>
									</div>	
									<input value="" type="number" class="form-control" name="totalAftertaxPurchase" id="totalAftertaxPurchase" readonly placeholder="Total">
								</div>
							</div>
						  </div>	
						  <div class="row" style="display: none;">
							<div class="col-sm-3 form-inline">
								<label>Cantidad pagada:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">
									<div class="input-group-append">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>L</i></span>
									</div>	
									<input value="" type="number" class="form-control" name="amountPaidPurchase" id="amountPaidPurchase" readonly placeholder="Cantidad pagada">
								</div>
							</div>
						  </div>	
						  <div class="row" style="display: none;">
							<div class="col-sm-3 form-inline">
								<label>Cantidad debida:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">
									<div class="input-group-append">				
										<span class="input-group-text"><div class="sb-nav-link-icon"></div>L</i></span>
									</div>	
									<input value="" type="number" class="form-control" name="amountDuePurchase" id="amountDuePurchase" readonly placeholder="Cantidad debida">
								</div>
							</div>
						  </div>								  		
						</div>
					  </div>
				  </div>
				  <div class="RespuestaAjax"></div> 
				</form>
			</div>                   
			</div>
		<div class="card-footer small text-muted">
 			<?php
				require_once "./core/mainModel.php";
				
				$insMainModel = new mainModel();
				$entidad = "compras";
				$consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
				$fecha_registro = $consulta_last_update['fecha_registro'];
				$hora = date('g:i:s a',strtotime($fecha_registro));
								
				echo "Última Actualización ".$insMainModel->getTheDay($fecha_registro, $hora);			
			?>
		</div>
	</div>
</div>

<?php
	$insMainModel->guardar_historial_accesos("Ingreso al modulo Facturas");
?>