<div class="container-fluid">
    <ol class="breadcrumb mt-2 mb-4">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SERVERURL; ?>dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Facturas</li>
    </ol>
	<div class="card mb-4">
		<div class="card-header">
			<i class="fas fa-file-invoice mr-1"></i>
			Facturas
		</div>
		<div class="card-body"> 
			<div class="table-responsive">	
				<form class="FormularioAjax" id="invoice-form" action="<?php echo SERVERURL;?>ajax/addFacturaAjax.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data" >
				  <div class="form-group row">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<button class="btn btn-primary" type="submit" id="reg_factura" form="invoice-form" data-toggle="tooltip" data-placement="top" title="Registrar Factura"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>										
					</div>
				  </div>				  
				  <div class="form-group row">
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Cliente <span class="priority">*<span/></label>
					<div class="col-sm-5">
					<div class="input-group mb-3">
					  <input type="hidden" class="form-control" placeholder="Proceso" id="proceso_factura" name="proceso_factura" readonly>
					  <input type="hidden" class="form-control" placeholder="Factura" id="facturas_id" name="facturas_id" readonly>
					  <input type="hidden" class="form-control" placeholder="Cliente" id="cliente_id" name="cliente_id" readonly required>
					  <input type="text" class="form-control" placeholder="Cliente" id="cliente" name="cliente" required readonly data-toggle="tooltip" data-placement="top" title="Cliente">					  
					  <div class="input-group-append" id="grupo_buscar_colaboradores">				
						<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Empleados"><a data-toggle="modal" href="#" class="btn btn-outline-success" id="buscar_clientes"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span>
					  </div>
					</div>	
					</div>
					<label for="inputFecha" class="col-sm-1 col-form-label-md">Fecha <span class="priority">*<span/></label>
					<div class="col-sm-3">
					  <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required id="fecha" name="fecha" data-toggle="tooltip" data-placement="top" title="Fecha de Facturación" style="width:165px">
					</div>					
				  </div>
				  <div class="form-group row">
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Vendedor <span class="priority">*<span/></label>
					<div class="col-sm-5">
					<div class="input-group mb-3">
					  <input type="hidden" class="form-control" placeholder="Vendedor" id="colaborador_id" name="colaborador_id" aria-label="Colaborador" aria-describedby="basic-addon2" readonly required>
					  <input type="text" class="form-control" placeholder="Vendedor" id="colaborador" name="colaborador" aria-label="Colaborador" aria-describedby="basic-addon2" required readonly data-toggle="tooltip" data-placement="top" title="Vendedor">					  
					  <div class="input-group-append" id="grupo_buscar_colaboradores">				
						<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Colaboradores"><a data-toggle="modal" href="#" class="btn btn-outline-success" id="buscar_colaboradores"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a><span>
					  </div>
					</div>
					</div>
					<label for="inputCliente" class="col-sm-1 col-form-label-md">Tipo <span class="priority">*<span/></label>
					<div class="col-sm-5">
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="tipo_factura" id="contado" value="1" checked data-toggle="tooltip" data-placement="top" title="Factura de Contado">
						  <label class="form-check-label" for="contado" data-toggle="tooltip" data-placement="top" title="Factura de Contado">Contado</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="tipo_factura" id="credito" value="2" data-toggle="tooltip" data-placement="top" title="Factura al Crédito">
						  <label class="form-check-label" for="credito" data-toggle="tooltip" data-placement="top" title="Factura al Crédito">Crédito</label>
						</div>					
					</div>					
				  </div>				  
				  <div class="form-group row table-responsive-xl">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<table class="table table-bordered table-hover" id="invoiceItem">
							<thead align="center" class="table-success">
								<tr>
									<th width="2%" scope="col"><input id="checkAll" class="formcontrol" type="checkbox"></th>
									<th width="38%">Nombre Producto</th>
									<th width="15%">Cantidad</th>
									<th width="15%">Precio</th>	
									<th width="15%">Descuento</th>									
									<th width="15%">Total</th>
								</tr>	
							</thead>
							<tbody>							
								<tr>
									<td><input class="itemRow" type="checkbox"></td>
									<td>
										<div class="input-group mb-3">
											<input type="hidden" name="isv[]" id="isv_0" class="form-control" placeholder="Producto ISV" autocomplete="off">
											<input type="hidden" name="valor_isv[]" id="valor_isv_0" class="form-control" placeholder="Valor ISV" autocomplete="off">										
											<input type="hidden" name="productos_id[]" id="productos_id_0" class="form-control quantity" autocomplete="off">
											<input type="text" name="productName[]" id="productName_0" class="form-control" autocomplete="off">
											<div class="input-group-append" id="grupo_buscar_colaboradores">				
												<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span>
											</div>
										</div>								
									</td>			
									<td><input type="number" name="quantity[]" id="quantity_0" class="buscar_cantidad form-control" autocomplete="off"></td>
									<td><input type="number" name="price[]" id="price_0" class="form-control" readonly autocomplete="off"></td>
									<td><input type="number" name="discount[]" id="discount_0" class="form-control" autocomplete="off"></td>
									<td><input type="number" name="total[]" id="total_0" class="form-control total" readonly autocomplete="off"></td>
								</tr>	
							</tbody>
						</table>
					</div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button class="btn btn-success ml-3" id="addRows" type="button" data-toggle="tooltip" data-placement="top" title="Agregar filas en la factura"><div class="sb-nav-link-icon"></div><i class="fas fa-plus fa-lg"></i> Agregar</button>
							<button class="btn btn-danger delete" id="removeRows" type="button" data-toggle="tooltip" data-placement="top" title="Remover filas en la factura"><div class="sb-nav-link-icon"></div><i class="fas fa-minus fa-lg"></i> Remover</button>
						</div>
					</div>					
				  </div>		
				  <div class="form-group row">
					  <div class="form-row col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-sm-12 col-md-8">
							<h3>Notas: </h3>
							<div class="form-group">
								<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas" maxlength="255"></textarea>
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
									<input value="" type="number" class="form-control" name="subTotal" id="subTotal" readonly placeholder="Subtotal">
								</div>
							</div>
						  </div>
						  <div class="row" style="display: none;">
							<div class="col-sm-3 form-inline">
								<label>Porcentaje:</label>
							</div>
							<div class="col-sm-9">
								<div class="input-group mb-1">															
									<input value="15" type="number" class="form-control" name="taxRate" id="taxRate" readonly placeholder="Tasa de Impuestos">
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
									<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" readonly placeholder="Monto del Impuesto">
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
									<input value="" type="number" class="form-control" name="taxDescuento" id="taxDescuento" readonly placeholder="Descuento Otorgado">
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
									<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" readonly placeholder="Total">
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
									<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" readonly placeholder="Cantidad pagada">
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
									<input value="" type="number" class="form-control" name="amountDue" id="amountDue" readonly placeholder="Cantidad debida">
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
				$entidad = "facturas";
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