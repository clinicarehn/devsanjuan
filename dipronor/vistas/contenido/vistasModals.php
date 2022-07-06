<!--INICIO MODAL PARA EL INGRESO DE MEDIDAS-->
<div class="modal fade" id="modal_medidas">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Medidas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="form-horizontal FormularioAjax" id="formMedidas" action="" method="POST" data-form="" enctype="multipart/form-data">				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					    <input type="hidden" required="required" readonly id="medida_id" name="medida_id"/>
						<div class="input-group mb-3">
							<input type="text" required readonly id="pro_medidas" name="pro_medidas" class="form-control"/>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label>Medida <span class="priority">*<span/></label>
					  <input type="text" required id="medidas_medidas" name="medidas_medidas" placeholder="Medida" class="form-control"  maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>
					<div class="col-md-8 mb-3">
					  <label for="apellido_proveedores">Descripción <span class="priority">*<span/></label>
					  <input type="text" required id="descripcion_medidas" name="descripcion_medidas" placeholder="Descripción" class="form-control"  maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>					
				</div>
				<div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="medidas_activo" name="medidas_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
				</div>
				<div class="RespuestaAjax"></div> 
			</form>
        </div>	
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_medidas" form="formMedidas"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_medidas" form="formMedidas"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_medidas" form="formMedidas"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL PARA EL INGRESO DE MEDIDAS-->

<!--INICIO MODAL PARA EL INGRESO DE UBICACION-->
<div class="modal fade" id="modal_ubicacion">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Ubicación</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="form-horizontal FormularioAjax" id="formUbicacion" action="" method="POST" data-form="" enctype="multipart/form-data">				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					    <input type="hidden" required="required" readonly id="ubicacion_id" name="ubicacion_id"/>
						<div class="input-group mb-3">
							<input type="text" required readonly id="pro_ubicacion" name="pro_ubicacion" class="form-control"/>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Ubicación <span class="priority">*<span/></label>
					  <input type="text" required class="form-control" name="ubicacion_ubicacion" id="ubicacion_ubicacion" placeholder="Ubicación	" maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>
					<div class="col-md-6 mb-3">
					  <label for="apellido_proveedores">Empresa <span class="priority">*<span/></label>
					  <select id="empresa_ubicacion" name="empresa_ubicacion" class="form-control" data-toggle="tooltip" data-placement="top" title="Empresa" required>   				   
					 </select>
					</div>					
				</div>
				<div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="ubicacion_activo" name="ubicacion_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
				</div>
				<div class="RespuestaAjax"></div> 
			</form>
        </div>		
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_ubicacion" form="formUbicacion"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_ubicacion" form="formUbicacion"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_ubicacion" form="formUbicacion"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL PARA EL INGRESO DE UBICACION-->

<!--INICIO MODAL PARA EL INGRESO DE ALMACENES-->
<div class="modal fade" id="modal_almacen">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Almacén</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form class="form-horizontal FormularioAjax" id="formAlmacen" action="" method="POST" data-form="" enctype="multipart/form-data">				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					    <input type="hidden" required="required" readonly id="almacen_id" name="almacen_id"/>
						<div class="input-group mb-3">
							<input type="text" required readonly id="pro_almacen" name="pro_almacen" class="form-control"/>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Almacén <span class="priority">*<span/></label>
					  <input type="text" required class="form-control" name="almacen_almacen" id="almacen_almacen" placeholder="Almacén" maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>
					<div class="col-md-6 mb-3">
					  <label for="apellido_proveedores">Ubicación <span class="priority">*<span/></label>
					  <select id="ubicacion_almacen" name="ubicacion_almacen" class="form-control" data-toggle="tooltip" data-placement="top" title="Ubicacion" required>   				   
					  </select>
					</div>					
				</div>
				<div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="almacen_activo" name="almacen_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
				</div>
				<div class="RespuestaAjax"></div> 
			</form>
        </div>	
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_almacen" form="formAlmacen"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_almacen" form="formAlmacen"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_almacen" form="formAlmacen"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL PARA EL INGRESO DE ALMACENES-->

<!--INICIO MODAL CAMBIAR CONTRASEÑA --> 
 <div class="modal fade" id="ModalContraseña">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modificar Contraseña</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">		
			<form id="form-cambiarcontra" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">	
				<div class="form-row">
				    <div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						   <input type="text" required="required" readonly id="id-registro" name="id-" readonly="readonly" style="display: none;" class="form-control"/>
						  <input type="password" name="contranaterior" class="form-control" id="contranaterior" placeholder="Contraseña Anterior" required="required">
						  <div class="input-group-append">
							<span class="btn btn-outline-success" id="show_password1" style="cursor:pointer;"><i id="icon1" class="fa fa-eye-slash icon fa-la"></i></span>
						  </div>
						</div>
					</div>
				</div>	
				<div class="form-row">
				    <div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						  <input type="password" name="nuevacontra" class="form-control" id="nuevacontra" placeholder="Nueva Contraseña" required="required">
						  <div class="input-group-append">
							<span class="btn btn-outline-success" id="show_password2" style="cursor:pointer;"><i id="icon1" class="fa fa-eye-slash icon fa-la"></i></span>
						  </div>
						</div>
					</div>
				</div>		
				<div class="form-row">
				    <div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						  <input type="password" name="repcontra" class="form-control" id="repcontra" placeholder="Repetir Contraseña" required="required">
						  <div class="input-group-append">
							<span class="btn btn-outline-success" id="show_password3" style="cursor:pointer;"><i id="icon1" class="fa fa-eye-slash icon fa-la"></i></span>
						  </div>
						</div>
					</div>
				</div>
				<div class="form-row">
				    <div class="col-md-12 mb-3">
						<div id="mensaje_cmabiar_contra"></div>
					</div>
				</div>				
				<div class="form-row">
				    <div class="col-md-12 mb-3">
					   <ul title="La contraseña debe cumplir con todas estas características">
					     <li id="mayus"> 1 Mayúscula</li>
					     <li id="special">1 Caracter Especial (Símbolo)</li>
					     <li id="numbers">Números</li>
					     <li id="lower">Minúsculas</li>
					     <li id="len">Mínimo 8 Caracteres</li>
					  </ul>
					</div>
				</div>	
				<input type="hidden" name="id" class="form-control" id="id" value = "<?php echo $_SESSION['colaborador_id'];?>">
				<div class="modal-footer">
				<button class="btn btn-success ml-2" type="submit" id="Modalcambiarcontra_Edit"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Editar</button>		
				</div>				
			</form>
        </div>
      </div>
    </div>
</div>
 <!--FIN MODAL CAMBIAR CONTRASEÑA --> 
 
<!--INICIO MODAL PAGOS COMPRAS---->
<div class="modal fade" id="modal_pagosPurchase">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pagos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div>
        <div class="modal-body">		
			<form class="FormularioAjax" id="formPagosPurchase" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" required="required" readonly id="compras_idPurchase" name="compras_idPurchase" readonly="readonly">
							<input type="text" id="proceso_pagosPurchase" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="edad">Cliente <span class="priority">*<span/></label>
					  <input type="text" required id="proveedorPurchase" name="proveedorPurchase" placeholder="Paciente" readonly class="form-control"/>
					</div>	
					<div class="col-md-6 mb-3">
					  <label for="edad">Fecha <span class="priority">*<span/></label>
					  <input type="date" required readonly id="fechaPurchase" name="fechaPurchase" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>						
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="edad">Metodo de Pago <span class="priority">*<span/></label>
					  <select class="form-control" id="tipo_pago_idPurchase" name="tipo_pago_idPurchase" required>	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Banco</label>
					  <select class="form-control" id="banco_idPurchase" name="banco_idPurchase">	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Monto Entregado <span class="priority">*<span/></label>
					  <input type="number" id="efectivoPurchase" name="efectivoPurchase" step="0.01" class="form-control" placeholder="Monto Entregado" required />
					</div>						
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="edad">Metodo de Pago</label>
					  <select class="form-control" id="tipo_pago_idPurchase1" name="tipo_pago_idPurchase1">	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Banco</label>
					  <select class="form-control" id="banco_idPurchase1" name="banco_idPurchase1">	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Monto Entregado</label>
					  <input type="number" id="efectivoPurchase1" name="efectivoPurchase1" step="0.01" class="form-control" placeholder="Monto Entregado"/>
					</div>						
				</div>					
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="edad">Referencia Primera Forma de Pago </label>
					  <input type="text" id="referencia_pagoPurchase1" name="referencia_pagoPurchase1" placeholder="Referencia de Pago" class="form-control" maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
					</div>						
					<div class="col-md-6 mb-3">
					  <label for="edad">Referencia Segunda Forma de Pago </label>
					  <input type="text" id="referencia_pagoPurchase2" name="referencia_pagoPurchase2" placeholder="Referencia de Pago" class="form-control" maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>					
				</div>						
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre">Importe</label>
					  <input type="number" required id="importePurchase" name="importePurchase" readonly class="form-control"/>
					</div>					
					<div class="col-md-4 mb-3">
					  <label for="edad">Cambio</label>
					  <input type="number"  id="cambioPurchase" name="cambioPurchase" class="form-control" readonly placeholder="Cambio"/>
					</div>					
					<div class="col-md-4 mb-3">
					  <label for="edad">Monto Pendiente</label>
					  <input type="number" id="m_pendientePurchase" name="m_pendientePurchase" class="form-control" readonly placeholder="Pendiente de Pago"/>
					</div>	
				</div>	
				<div class="RespuestaAjax"></div> 
			</form>
        </div>		
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" form="formPagosPurchase" type="submit" id="reg_pagosPurchase"><div class="sb-nav-link-icon"></div><i class="fas fa-money-bill-wave fa-lg"></i> Registrar Pago</button>				
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL PAGOS COMPRAS--

<!--INICIO MODAL PAGOS FACTURACION---->
<div class="modal fade" id="modal_pagos">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pagos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div>
        <div class="modal-body">		
			<form class="FormularioAjax" id="formPagos" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" required="required" readonly id="facturas_id" name="facturas_id" readonly="readonly"/>
							<input type="text" id="proceso_pagos" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="edad">Cliente <span class="priority">*<span/></label>
					  <input type="text" required id="cliente" name="cliente" placeholder="Paciente" readonly class="form-control"/>
					</div>	
					<div class="col-md-6 mb-3">
					  <label for="edad">Fecha <span class="priority">*<span/></label>
					  <input type="date" required readonly id="fecha" name="fecha" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>						
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="edad">Metodo de Pago <span class="priority">*<span/></label>
					  <select class="form-control" id="tipo_pago_id" name="tipo_pago_id" required>	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Banco</label>
					  <select class="form-control" id="banco_id" name="banco_id">	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Monto Entregado <span class="priority">*<span/></label>
					  <input type="number" id="efectivo" name="efectivo" step="0.01" class="form-control" placeholder="Monto Entregado" required />
					</div>						
				</div>	
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="edad">Metodo de Pago</label>
					  <select class="form-control" id="tipo_pago_id1" name="tipo_pago_id1">	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Banco</label>
					  <select class="form-control" id="banco_id1" name="banco_id1">	
						 <option value="">Seleccione</option>
					  </select>
					</div>
					<div class="col-md-4 mb-3">
					  <label for="edad">Monto Entregado</label>
					  <input type="number" id="efectivo1" name="efectivo1" step="0.01" class="form-control" placeholder="Monto Entregado"/>
					</div>						
				</div>					
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="edad">Referencia Primera Forma de Pago </label>
					  <input type="text" id="referencia_pago1" name="referencia_pago1" placeholder="Referencia de Pago" class="form-control" maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
					</div>						
					<div class="col-md-6 mb-3">
					  <label for="edad">Referencia Segunda Forma de Pago </label>
					  <input type="text" id="referencia_pago2" name="referencia_pago2" placeholder="Referencia de Pago" class="form-control" maxlength="30" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>					
				</div>						
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre">Importe</label>
					  <input type="number" required id="importe" name="importe" readonly class="form-control"/>
					</div>					
					<div class="col-md-4 mb-3">
					  <label for="edad">Cambio</label>
					  <input type="number"  id="cambio" name="cambio" class="form-control" readonly placeholder="Cambio"/>
					</div>					
					<div class="col-md-4 mb-3">
					  <label for="edad">Monto Pendiente</label>
					  <input type="number" id="m_pendiente" name="m_pendiente" class="form-control" readonly placeholder="Pendiente de Pago"/>
					</div>	
				</div>	
				<div class="RespuestaAjax"></div> 
			</form>
        </div>		
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" form="formPagos" type="submit" id="reg_pagos"><div class="sb-nav-link-icon"></div><i class="fas fa-money-bill-wave fa-lg"></i> Registrar Pago</button>				
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL PAGOS FACTURACION--

<!--INICIO MODAL MOVIMIENTO DE PRODUCTOS-->
<div class="modal fade" id="modal_movimientos">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Movimiento de Productos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div>
        <div class="modal-body">		
			<form class="FormularioAjax" id="formMovimientos" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">			
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="movimientos_id" name="movimientos_id" class="form-control"/>	
							<input type="text" id="proceso_movimientos" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label>Categoría <span class="priority">*<span/></label>
					  <select id="movimiento_categoria" name="movimiento_categoria" class="form-control" data-toggle="tooltip" data-placement="top" title="Categoría Productos" required>
							<option value="">Seleccione</option>
					  </select>					  
					</div>
					<div class="col-md-6 mb-3">
						<label>Productos <span class="priority">*<span/></label>
						<div class="input-group mb-3">
						  <select id="movimiento_producto" name="movimiento_producto" class="form-control" data-toggle="tooltip" data-placement="top" title="Productos" required>
								<option value="">Seleccione</option>
						  </select>
						 <div class="input-group-append" id="buscar_colaboradores">				
							<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span>
						 </div>
						</div>			  
					</div>								
				</div>	
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label>Tipo de Operación <span class="priority">*<span/></label>
					  <select id="movimiento_operacion" name="movimiento_operacion" class="form-control" data-toggle="tooltip" data-placement="top" title="Tipo Operación" required>
						 <option value="">Seleccione</option>
					  </select>					  
					</div>
					<div class="col-md-6 mb-3">
					  <label>Cantidad <span class="priority">*<span/></label>
					  <input type="number" required id="movimiento_cantidad" name="movimiento_cantidad" class="form-control" required>				  
					</div>										
				</div>	
				<div class="RespuestaAjax"></div> 
			</form>
        </div>		
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="modal_movimientos" form="formMovimientos"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>		
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL MOVIMIENTO DE PRODUCTOS-->

<!--INICIO MODAL CLIENTES-->
<div class="modal fade" id="modal_registrar_clientes">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Clientes</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formClientes" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="clientes_id" name="clientes_id" class="form-control">
							<input type="text" id="proceso_clientes" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>				
			  <div class="form-row">
				<div class="col-md-4 mb-3">
				  <label for="nombre_clientes">Nombre <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="nombre_clientes" name="nombre_clientes" placeholder="Nombre" required>
				</div>
				<div class="col-md-4 mb-3">
				  <label for="apellido_clientes">Apellido <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="apellido_clientes" name="apellido_clientes" placeholder="Apellido" required>
				</div>
				<div class="col-md-4 mb-3">
				  <label for="identidad_clientes">Identidad o RTN <span class="priority">*<span/></label>
				  <input type="number" class="form-control" id="identidad_clientes" name= "identidad_clientes" placeholder="Identidad o RTN" maxlength="14" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
				</div>					
			  </div>
			  <div class="form-row">
				<div class="col-md-4 mb-3">
					<label for="fecha_clientes">Fecha <span class="priority">*<span/></label>
					<div class="input-group mb-3">
						<input type="date" required id="fecha_clientes" name="fecha_clientes" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	 
				</div>				  
				<div class="col-md-4 mb-3">
				  <label for="departamento_cliente">Departamento <span class="priority">*<span/></label>
				  <select class="form-control" id="departamento_cliente" name="departamento_cliente" required>			  
				  </select>
				</div>
				<div class="col-md-4 mb-3">
				  <label for="municipio_cliente">Municipio <span class="priority">*<span/></label>
				  <select class="form-control" id="municipio_cliente" name="municipio_cliente" required>
					<option value="">Seleccione</option>
				  </select>
				</div>				
			  </div>
			  <div class="form-row">
				<div class="col-md-12 mb-3">
				  <label for="dirección_clientes">Dirección <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="dirección_clientes" name="dirección_clientes" placeholder="Dirección" maxlength="150" required>
				</div>				  				
			  </div>
			  <div class="form-row">			  
				<div class="col-md-4 mb-3">
				  <label for="telefono_clientes">Telefono <span class="priority">*<span/></label>
				  <input type="number" class="form-control" id="telefono_clientes" name="telefono_clientes" placeholder="Teléfono" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
				</div>
				<div class="col-md-8 mb-3">
					<label for="correo_clientes">Correo <span class="priority">*<span/></label>
					<div class="input-group mb-3">
					  <input type="email" class="form-control" placeholder="Correo" id="correo_clientes" name="correo_clientes" aria-label="Correo" aria-describedby="basic-addon2" maxlength="70" required>
					  <div class="input-group-append">				
						<span class="input-group-text"><div class="sb-nav-link-icon"></div>@algo.com</span>
					  </div>
					</div>					
				</div>				
			  </div>
			  <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="clientes_activo" name="clientes_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			  </div>	  
			  <div class="RespuestaAjax"></div>  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_cliente" form="formClientes"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_cliente" form="formClientes"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_cliente" form="formClientes"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL CLIENTES-->

<!--INICIO MODAL PROVEEDORES-->
<div class="modal fade" id="modal_registrar_proveedores">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Proveedores</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formProveedores" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="proveedores_id" name="proveedores_id" class="form-control">
							<input type="text" id="proceso_proveedores" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>				  
				<div class="form-row">
				<div class="col-md-4 mb-3">
				  <label for="nombre_proveedores">Nombre <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="nombre_proveedores" name="nombre_proveedores" placeholder="Nombre" required>
				</div>
				<div class="col-md-4 mb-3">
				  <label for="apellido_proveedores">Apellido <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="apellido_proveedores" name="apellido_proveedores" placeholder="Apellido" required>
				</div>
				<div class="col-md-4 mb-3">
				  <label for="rtn_proveedores">RTN <span class="priority">*<span/></label>
				  <input type="number" class="form-control" id="rtn_proveedores" name= "rtn_proveedores" maxlength="14" placeholder="RTN" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
				</div>					
				</div>
				<div class="form-row">
				<div class="col-md-4 mb-3">
					<label for="fecha_proveedores">Fecha <span class="priority">*<span/></label>
					<div class="input-group mb-3">
						<input type="date" required id="fecha_proveedores" name="fecha_proveedores" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
					</div>	 
				</div>				  
				<div class="col-md-4 mb-3">
				  <label for="departamento_proveedores">Departamento <span class="priority">*<span/></label>
				  <select class="form-control" id="departamento_proveedores" name="departamento_proveedores" required>		  
				  </select>
				</div>
				<div class="col-md-4 mb-3">
				  <label for="municipio_proveedores">Municipio <span class="priority">*<span/></label>
				  <select class="form-control" id="municipio_proveedores" name="municipio_proveedores" required>
					<option value="">Seleccione</option>				  
				  </select>
				</div>				
				</div>
				<div class="form-row">
				<div class="col-md-12 mb-3">
				  <label for="dirección_proveedores">Dirección <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="dirección_proveedores" name="dirección_proveedores" placeholder="Dirección" maxlength="150" required>
				</div>				  				
				</div>
				<div class="form-row">			  
				<div class="col-md-4 mb-3">
				  <label for="telefono_proveedores">Telefono <span class="priority">*<span/></label>
				  <input type="number" class="form-control" id="telefono_proveedores" name="telefono_proveedores" placeholder="Teléfono" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
				</div>
				<div class="col-md-8 mb-3">
					<label for="correo_proveedores">Correo <span class="priority">*<span/></label>
					<div class="input-group mb-3">
					  <input type="email" class="form-control" placeholder="Correo" id="correo_proveedores" name="correo_proveedores" aria-label="Correo" aria-describedby="basic-addon2" maxlength="70" required>
					  <div class="input-group-append">				
						<span class="input-group-text"><div class="sb-nav-link-icon"></div>@algo.com</span>
					  </div>
					</div>	 
				</div>
				</div>
			  <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="proveedores_activo" name="proveedores_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			  </div>			
			  <div class="RespuestaAjax"></div>	  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_proveedor" form="formProveedores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_proveedor" form="formProveedores"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_proveedor" form="formProveedores"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				
		</div>		
      </div>
    </div>
</div>
<!--FIN MODAL PROVEEDORES-->

<!--INICIO MODAL COLABORADORES-->
<div class="modal fade" id="modal_registrar_colaboradores">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Colaboradores</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formColaboradores" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="colaborador_id" name="colaborador_id" class="form-control">
							<input type="text" id="proceso_colaboradores" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>				
				<div class="form-row">
				<div class="col-md-6 mb-3">
				  <label for="nombre">Nombre <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="nombre_colaborador" name="nombre_colaborador" placeholder="Nombre" required>
				</div>
				<div class="col-md-6 mb-3">
				  <label for="apellido">Apellido <span class="priority">*<span/></label>
				  <input type="text" class="form-control" id="apellido_colaborador" name="apellido_colaborador" placeholder="Apellido" required>
				</div>
				</div>
				<div class="form-row">
				<div class="col-md-6 mb-3">
				  <label for="identidad">Identidad <span class="priority">*<span/></label>
				  <input type="number" class="form-control" id="identidad_colaborador" name= "identidad_colaborador" placeholder="Identidad" maxlength="13" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
				</div>			  
				<div class="col-md-6 mb-3">
				  <label for="telefono">Telefono <span class="priority">*<span/></label>
				  <input type="number" class="form-control" id="telefono_colaborador" name="telefono_colaborador" placeholder="Teléfono" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
				</div>
				</div>
				<div class="form-row">
				<div class="col-md-6 mb-3">
				  <label for="estado">Puesto <span class="priority">*<span/></label>
				  <select class="form-control" id="puesto_colaborador" name="puesto_colaborador" required>			  
				  </select>
				</div>				
				</div>
			   <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="colaboradores_activo" name="colaboradores_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			   </div>				
			   <div class="RespuestaAjax"></div>	  
			 </form>
        </div>
		<div class="modal-footer">
			 <button class="btn btn-primary ml-2" type="submit" id="reg_colaborador" form="formColaboradores"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			 <button class="btn btn-warning ml-2" type="submit" id="edi_colaborador" form="formColaboradores"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_colaborador" form="formColaboradores"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				 
		</div>		
      </div>
    </div>
</div>
<!--FIN MODAL COLABORADORES-->

<!--INICIO MODAL USUARIOS-->
<div class="modal fade" id="modal_registrar_usuarios">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Usuarios</h4>    
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formUsers" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">	
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="hidden" id="usuarios_id" name="usuarios_id" class="form-control">
							<input type="hidden" id="usuarios_colaborador_id" name="usuarios_colaborador_id" class="form-control">
							<input type="text" id="proceso_usuarios"  class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>					
				<div class="form-row">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="Colaborador" id="colaborador_id_usuario" name="colaborador_id_usuario" aria-label="Colaborador" aria-describedby="basic-addon2" readonly required>
					 <div class="input-group-append" id="buscar_colaboradores">				
						<span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span>
					 </div>
					</div>	 			
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="nickname">Nick Name <span class="priority">*<span/></label>
					  <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nick Name" required>		  
					</div>
					<div class="col-md-6 mb-3">
						<label for="nickname">Contraseña <span class="priority">*<span/></label>
						<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>	 
					</div>		
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="nickname">Correo <span class="priority">*<span/></label>
						<div class="input-group mb-3">
						  <input type="email" class="form-control" placeholder="Correo" id="correo_usuario" name="correo_usuario" aria-label="Correo" aria-describedby="basic-addon2" required>
						  <div class="input-group-append">				
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>@algo.com</span>
						  </div>
						</div>	 
					</div>
					<div class="col-md-6 mb-3">
					  <label for="empresa">Empresa <span class="priority">*<span/></label>
					  <select class="form-control" id="empresa_usuario" name="empresa_usuario" required>			  
					  </select>
					</div>					
				</div>				
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="tipo_user">Tipo Usuario <span class="priority">*<span/></label>
					  <select class="form-control" id="tipo_user" name="tipo_user" required>						  
					  </select>
					</div>	
					<div class="col-md-6 mb-3">
					  <label for="tipo_user">Privilegio <span class="priority">*<span/></label>
					  <select class="form-control" id="privilegio_id" name="privilegio_id" required>						  
					  </select>
					</div>					
				</div>
			   <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="usuarios_activo" name="usuarios_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			   </div>					
				<div class="RespuestaAjax"></div>					 
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_usuario" form="formUsers"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_usuario" form="formUsers"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_usuario" form="formUsers"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>					
		</div>	 		
      </div>
    </div>
</div>
<!--FIN MODAL USUARIOS-->

<!--INICIO MODAL BUSQUEDA DE COLABORADORES-->
<div class="modal fade" id="modal_buscar_colaboradores_usuarios">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
	    <form class="form-horizontal" id="formulario_busqueda_coloboradores">
			<div class="modal-header">
			  <h4 class="modal-title">Buscar Colaboradores</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div><div class="container"></div>
			<div class="modal-body">  			  								
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-search mr-1"></i>
						Colaboradores						
					</div>
					<div class="card-body"> 										
						<div class="overflow-auto">											
							<table id="DatatableColaboradoresBusqueda" class="table table-striped table-condensed table-hover" style="width:100%">
								<thead>
									<tr>
										<th>Seleccione</th>
										<th>Nombre</th>
										<th>Identidad</th>	
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
		  </div>
		</form>
     </div>
	</div>
</div>	
<!--FIN MODAL BUSQUEDA DE COLABORADORES-->

<!--INICIO MODAL BUSQUEDA DE CLIENTES EN FACTURACION-->
<div class="modal fade" id="modal_buscar_clientes_facturacion">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
	    <form class="form-horizontal" id="formulario_busqueda_clientes_facturacion">
			<div class="modal-header">
			  <h4 class="modal-title">Buscar Clientes</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div><div class="container"></div>
			<div class="modal-body"> 
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-search mr-1"></i>
						Clientes						
					</div>
					<div class="card-body"> 										
						<div class="overflow-auto">											
							<table id="DatatableClientesBusquedaFactura" class="table table-striped table-condensed table-hover" style="width:100%">
								<thead>
									<tr>
										<th>Seleccione</th>
										<th>Cliente</th>
										<th>RTN</th>
										<th>Teléfono</th>
										<th>correo</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
		  </div>
		</form>
     </div>
	</div>
</div>	
<!--FIN MODAL BUSQUEDA DE CLIENTES EN FACTURACION-->

<!--INICIO MODAL BUSQUEDA DE CLIENTES EN COMPRAS-->
<div class="modal fade" id="modal_buscar_proveedores_compras">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
	    <form class="form-horizontal" id="formulario_busqueda_proveedores_compras">
			<div class="modal-header">
			  <h4 class="modal-title">Buscar Proveedores</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div><div class="container"></div>
			<div class="modal-body"> 
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-search mr-1"></i>
						Clientes						
					</div>
					<div class="card-body"> 										
						<div class="overflow-auto">											
							<table id="DatatableProveedoresBusquedaProveedores" class="table table-striped table-condensed table-hover" style="width:100%">
								<thead>
									<tr>
										<th>Seleccione</th>
										<th>Proveedor</th>
										<th>RTN</th>
										<th>Teléfono</th>
										<th>correo</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
		  </div>
		</form>
     </div>
	</div>
</div>	
<!--FIN MODAL BUSQUEDA DE CLIENTES EN modal_buscar_clientes_COMPRAS-->

<!--INICIO MODAL BUSQUEDA DE CLIENTES EN FACTURACION-->
<div class="modal fade" id="modal_buscar_productos_facturacion">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
	    <form class="form-horizontal" id="formulario_busqueda_productos_facturacion">
			<input type="hidden" id="row" name="row" class="form-control"/>
			<input type="hidden" id="col" name="col" class="form-control"/>			
			<div class="modal-header">
			  <h4 class="modal-title">Buscar Productos</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div><div class="container"></div>
			<div class="modal-body"> 
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-search mr-1"></i>
						Productos						
					</div>
					<div class="card-body"> 										
						<div class="overflow-auto">											
							<table id="DatatableProductosBusquedaFactura" class="table table-striped table-condensed table-hover" style="width:100%">
								<thead>
									<tr>
										<th>Seleccione</th>
										<th>Producto</th>
										<th>Cantidad</th>
										<th>Medida</th>
										<th>Categoria</th>
										<th>Precio Venta</th>							
										<th>Almacén</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>

		  </div>
		</form>
     </div>
	</div>
</div>	
<!--FIN MODAL BUSQUEDA DE CLIENTES EN FACTURACION-->

<!--INICIO MODAL BUSQUEDA DE COLABORADORES EN FACTURACION-->
<div class="modal fade" id="modal_buscar_colaboradores_facturacion">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
	    <form class="form-horizontal" id="formulario_busqueda_colaboradores_facturacion">
			<div class="modal-header">
			  <h4 class="modal-title">Buscar Colaboradores</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div><div class="container"></div>
			<div class="modal-body"> 
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-search mr-1"></i>
						Colaboradores						
					</div>
					<div class="card-body"> 										
						<div class="overflow-auto">											
							<table id="DatatableColaboradoresBusquedaFactura" class="table table-striped table-condensed table-hover" style="width:100%">
								<thead>
									<tr>
										<th>Seleccione</th>
										<th>Colaborador</th>
										<th>Identidad</th>
										<th>Teléfono</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>

		  </div>
		</form>
     </div>
	</div>
</div>	
<!--FIN MODAL BUSQUEDA DE COLABORADORES EN FACTURACION-->

<!--INICIO MODAL PUESTO-->
<div class="modal fade" id="modal_registrar_puestos">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Puestos</h4>    
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formPuestos" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="hidden" id="puestos_id" name="puestos_id" class="form-control">						
							<input type="text" id="proceso_puestos" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>					
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="puesto">Puesto <span class="priority">*<span/></label>
					  <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto" required>		  
					</div>		
				</div>
			    <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="puestos_activo" name="puestos_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			    </div>					
				<div class="RespuestaAjax"></div>  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_puestos" form="formPuestos"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_puestos" form="formPuestos"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_puestos" form="formPuestos"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>					
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL PUESTO-->

<!--INICIO MODAL SECUENCIA DE FACTURACION-->
<div class="modal fade" id="modal_registrar_secuencias">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Secuencia de Facturación</h4>    
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formSecuencia" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="secuencia_facturacion_id" name="secuencia_facturacion_id" class="form-control">
							<input type="text" id="proceso_secuencia_facturacion" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>				
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="empresa">Empresa <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<select id="empresa_secuencia" name="empresa_secuencia" class="form-control" title="Empresa" required>   							
							</select>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-building fa-lg"></i></span>
							</div>
						</div>	 
					</div>	
					<div class="col-md-8 mb-3">
						<label for="prefijo">CAI <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="cai_secuencia" id="cai_secuencia" class="form-control" placeholder="CAI" maxlength="37" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="far fa-id-card"></i></span>
							</div>
						</div>	 
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="prefijo">Prefijo <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="prefijo_secuencia" id="prefijo_secuencia" class="form-control" placeholder="Prefijo" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fab fa-autoprefixer fa-lg"></i></span>
							</div>
						</div>	 
					</div>	
					<div class="col-md-4 mb-3">
						<label for="relleno">Relleno <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="number" name="relleno_secuencia" id="relleno_secuencia" class="form-control" placeholder="Relleno" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-fill fa-lg"></i></span>
							</div>
						</div>	 
					</div>					
					<div class="col-md-4 mb-3">
						<label for="incremento">Incremento <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="number" name="incremento_secuencia" id="incremento_secuencia" class="form-control" placeholder="Incremento" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-arrow-right fa-lg"></i></span>
							</div>
						</div>	 
					</div>							
				</div>				
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="siguiente">Siguiente <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="number" name="siguiente_secuencia" id="siguiente_secuencia" class="form-control" title="Número Siguiente" placeholder="Siguiente" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-caret-right fa-lg"></i></span>
							</div>
						</div>	 
					</div>	
					<div class="col-md-4 mb-3">
						<label for="rango_inicial">Rango Inicial <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="rango_inicial_secuencia" id="rango_inicial_secuencia" class="form-control" placeholder="Rango Inicial" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-list-ol fa-lg"></i></span>
							</div>
						</div>	 
					</div>				
					<div class="col-md-4 mb-3">
						<label for="rango_final">Rango Final <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="rango_final_secuencia" id="rango_final_secuencia" class="form-control" placeholder="Rango Final" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-list-ol fa-lg"></i></span>
							</div>
						</div>	 
					</div>						
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="fecha_limite">Fecha Activación <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="date" required id="fecha_activacion_secuencia" name="fecha_activacion_secuencia" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
						</div>	 
					</div>	
					<div class="col-md-4 mb-3">
						<label for="fecha_limite">Fecha Límite <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="date" required id="fecha_limite_secuencia" name="fecha_limite_secuencia" value="<?php echo date ("Y-m-d");?>" class="form-control"/>
						</div>	 
					</div>					
				</div>	
			    <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="estado_secuencia" name="estado_secuencia" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			    </div>				
				<div class="RespuestaAjax"></div>  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_secuencia" form="formSecuencia"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_secuencia" form="formSecuencia"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_secuencia" form="formSecuencia"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>					
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL SECUENCIA DE FACTURACION-->

<!--INICIO MODAL EMPRESA-->
<div class="modal fade" id="modal_registrar_empresa">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Empresa</h4>    
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formEmpresa" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="empresa_id" name="empresa_id" class="form-control">
							<input type="text" id="proceso_empresa" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>					
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label>Razón Social <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="empresa_razon_social" id="empresa_razon_social" class="form-control" placeholder="Razón Social" maxlength="50" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="far fa-building"></i></span>
							</div>
						</div>	 
					</div>					
					<div class="col-md-6 mb-3">
						<label>Empresa <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="empresa_empresa" id="empresa_empresa" class="form-control" placeholder="Empresa" maxlength="50" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="far fa-building"></i></span>
							</div>
						</div>	 
					</div>					
				</div>
				<div class="form-row">					
					<div class="col-md-6 mb-3">
						<label for="prefijo">RTN <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="rtn_empresa" id="rtn_empresa" class="form-control" placeholder="RTN" maxlength="14" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-id-card-alt"></i></span>
							</div>
						</div>	 
					</div>
					<div class="col-md-6 mb-3">
						<label for="prefijo">Otra Información </label>
						<div class="input-group mb-3">
							<input type="text" name="empresa_otra_informacion" id="empresa_otra_informacion" class="form-control" placeholder="Otra Información" maxlength="150">
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-info-circle"></i></span>
							</div>
						</div>	 
					</div>						
				</div>				
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="prefijo">Eslogan </label>
						<div class="input-group mb-3">
							<input type="text" name="empresa_eslogan" id="empresa_eslogan" class="form-control" placeholder="Eslogan" maxlength="150">
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-id-card-alt"></i></span>
							</div>
						</div>	 
					</div>	
					<div class="col-md-6 mb-3">
						<label for="correo_empresa">Correo <span class="priority">*<span/></label>
						<div class="input-group mb-3">
						  <input type="email" class="form-control" placeholder="Correo" id="correo_empresa" name="correo_empresa" aria-label="Correo" aria-describedby="basic-addon2" required>
						  <div class="input-group-append">				
							<span class="input-group-text"><div class="sb-nav-link-icon"></div>@algo.com</span>
						  </div>
						</div>	 
					</div>						
				</div>				
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label>Telefono <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="telefono_empresa" id="telefono_empresa" class="form-control" placeholder="Teléfono" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-phone-alt"></i></span>
							</div>
						</div>	 
					</div>	
					<div class="col-md-6 mb-3">
						<label>WhatsApp <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="empresa_celular" id="empresa_celular" class="form-control" placeholder="Teléfono" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fab fa-whatsapp fa-lg"></i></span>
							</div>
						</div>	 
					</div>																
				</div>
				<div class="form-row">					
					<div class="col-md-12 mb-3">
						<label for="incremento">Dirección <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="direccion_empresa" id="direccion_empresa" class="form-control" placeholder="Dirección" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-address-card"></i></span>
							</div>
						</div>	 
					</div>							
				</div>	
			    <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="empresa_activo" name="empresa_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			    </div>					
				<div class="RespuestaAjax"></div>  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_empresa" form="formEmpresa"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_empresa" form="formEmpresa"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_empresa" form="formEmpresa"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>
		</div>			
      </div>
    </div>
</div>
<!--FIN MODAL EMPRESA-->

<!--INICIO MODAL PRIVILEGIOS-->
<div class="modal fade" id="modal_registrar_privilegios">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Privilegios</h4>    
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formPrivilegios" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="hidden" id="privilegio_id_" name="privilegio_id_" class="form-control">
							<input type="text" id="proceso_privilegios" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>					
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="prefijo">Nombre <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="privilegios_nombre" id="privilegios_nombre" class="form-control" placeholder="Nombre" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-id-card-alt"></i></span>
							</div>
						</div>	 
					</div>						
				</div>	
			    <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="privilegio_activo" name="privilegio_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			    </div>					
				<div class="RespuestaAjax"></div>	  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_privilegios" form="formPrivilegios"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_privilegios" form="formPrivilegios"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_privilegios" form="formPrivilegios"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>
		</div>		
      </div>
    </div>
</div>
<!--FIN MODAL PRIVILEGIOS-->

<!--INICIO MODAL TIPO USUARIO-->
<div class="modal fade" id="modal_registrar_tipoUsuario">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Tipo de Usuarios</h4>    
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formTipoUsuario" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="hidden" id="tipo_user_id" name="tipo_user_id" class="form-control">
							<input type="text" id="proceso_tipo_usuario" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>					
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="prefijo">Nombre <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="text" name="tipo_usuario_nombre" id="tipo_usuario_nombre" class="form-control" placeholder="Nombre" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fas fa-id-card-alt"></i></span>
							</div>
						</div>	 
					</div>						
				</div>	
			    <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" class="form-check-input" id="tipo_usuario_activo" name="tipo_usuario_activo" value="1" checked>
					 <label class="form-check-label" for="exampleCheck1">Activo</label>				
				  </div>						
			    </div>					
				<div class="RespuestaAjax"></div>	  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_tipo_usuario" form="formTipoUsuario"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_tipo_usuario" form="formTipoUsuario"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_tipo_usuario" form="formTipoUsuario"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>
		</div>		
      </div>
    </div>
</div>
<!--FIN MODAL TIPO USAURIO-->

<!--INICIO MODAL PRODUCTOS-->
<div class="modal fade" id="modal_registrar_productos">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Productos</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form class="FormularioAjax" id="formProductos" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
						    <input type="hidden" id="productos_id" name="productos_id" class="form-control">
							<input type="text" id="proceso_productos" class="form-control" readonly>
							<div class="input-group-append">				
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>	 
					</div>							
				</div>				
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="producto">Producto <span class="priority">*<span/></label>
					  <input type="text" class="form-control" id="producto" name="producto" maxlength="50" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Producto" required>
					</div>
					<div class="col-md-3 mb-3">
					  <label for="identidad_clientes">Categoria <span class="priority">*<span/></label>
					  <select class="form-control" id="categoria" name="categoria" required>			  
					  </select>
					</div>
					<div class="col-md-3 mb-3">
					  <label for="identidad_clientes">Almacén <span class="priority">*<span/></label>
					  <select class="form-control" id="almacen" name="almacen" required>			  
					  </select>
					</div>								
				</div>
				<div class="form-row">				  
					<div class="col-md-4 mb-3">
						<label for="fecha_clientes">Cantidad <span class="priority">*<span/></label>
						<div class="input-group mb-3">
							<input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" required>
						</div>	 
					</div>				  
					<div class="col-md-4 mb-3">
					  <label for="apellido_clientes">Medida <span class="priority">*<span/></label>
					  <select class="form-control" id="medida" name="medida" required>			  
					  </select>
					</div>					
					<div class="col-md-4 mb-3">
					  <label for="departamento_cliente">Precio Compra <span class="priority">*<span/></label>
					  <input type="number" class="form-control" id="precio_compra" name="precio_compra" placeholder="Precio Compra" required>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="municipio_cliente">Precio Venta <span class="priority">*<span/></label>
					  <input type="number" class="form-control" id="precio_venta" name="precio_venta" placeholder="Precio Venta" required>
					</div>
					<div class="col-md-4 mb-3">
					  <label>Cantidad Mínima</label>
					  <input type="number" id="cantidad_minima" name="cantidad_minima" placeholder="Cantidad Mínima" class="form-control"/>
					</div>	
					<div class="col-md-4 mb-3">
					  <label>Cantidad Máxima</label>
					  <input type="number" id="cantidad_maxima" name="cantidad_maxima" placeholder="Cantidad Máxima" class="form-control"/>
					</div>					
				</div>
				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="dirección_clientes">Descripción <span class="priority">*<span/></label>
					  <textarea id="descripcion" name="descripcion" required placeholder="Descripción" class="form-control" maxlength="100" rows="2"></textarea>	
					  <p id="charNum_descripcion">100 Caracteres</p>	
					</div>					
				</div>
				<div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top" title="Si esta marcado, el producto se encuentra activo, caso contrario el producto esta desactivado">
				  <input class="form-check-input" type="checkbox" value="1" id="producto_activo" name="producto_activo" checked>
				  <label class="form-check-label" for="defaultCheck1">Activo</label>
				</div>

				<div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top" title="Marcar si aplica para ISV en las ventas">
				  <label class="form-check-label mr-1" for="defaultCheck1">¿ISV Venta?</label>
				  <input class="form-check-input" type="radio" name="isv" id="isv_si" value="1" checked>
				  <label class="form-check-label" for="exampleRadios1">Sí</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="isv" id="isv_no" value="2">
				  <label class="form-check-label" for="exampleRadios2">No</label>
				</div>

				<div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top" title="Marcar si aplica para ISV en las compras">
				  <label class="form-check-label mr-1" for="defaultCheck1">¿ISV Compra?</label>
				  <input class="form-check-input" type="radio" name="isv_compra" id="isv_compra_si" value="1" checked>
				  <label class="form-check-label" for="exampleRadios3" checked>Sí</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="isv_compra" id="isv_compra_no" value="2">
				  <label class="form-check-label" for="exampleRadios4">No</label>
				</div>					
				<div class="RespuestaAjax"></div>	  
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="reg_producto" form="formProductos"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Guardar</button>
			<button class="btn btn-warning ml-2" type="submit" id="edi_producto" form="formProductos"><div class="sb-nav-link-icon"></div><i class="fas fa-edit fa-lg"></i> Editar</button>
			<button class="btn btn-danger ml-2" type="submit" id="delete_producto" form="formProductos"><div class="sb-nav-link-icon"></div><i class="fa fa-trash"></i> Eliminar</button>				
		</div>		
      </div>
    </div>
</div>
<!--FIN MODAL PRODUCTOS-->