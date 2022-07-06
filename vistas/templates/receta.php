<div class="table-responsive" id="receta_medica" style="display: none;">	
	<form class="invoice-form FormularioAjax" id="formulario_receta_medica" action="" method="POST" data-form="" enctype="multipart/form-data">
		<div class="form-row">
			<div class="col-md-12 mb-3">
				<button class="btn btn-primary" type="submit" id="validar_receta" data-toggle="tooltip" data-placement="top" title="Registrar la Factura"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>	
				<button class="btn btn-warning" type="submit" id="editar_receta" data-toggle="tooltip" data-placement="top" title="Registrar la Factura"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Modificar</button>	
				<button class="btn btn-danger" type="submit" id="eliminar_receta" data-toggle="tooltip" data-placement="top" title="Registrar la Factura"><div class="sb-nav-link-icon"></div><i class="fas fa-trash fa-lg"></i> Eliminar</button>
			</div>				
		</div>				  
	  <div class="form-group row">
		<label for="inputCliente" class="col-sm-1 col-form-label-md">Expediente <span class="priority">*<span/></label>
		<div class="col-sm-3">
			<input type="hidden" id="pro" name="pro" readonly  class="form-control"/>
			<input type="hidden" id="agenda_id" name="agenda_id" class="form-control"/>
			<input type="hidden" id="pacientes_id" name="pacientes_id" class="form-control"/>
			<input type="hidden" id="receta_id" name="receta_id" class="form-control"/>			
			<input type="number" id="expediente" name="expediente" readonly placeholder="Expediente o Identidad" class="form-control"/>	
		</div>
		<label for="inputFecha" class="col-sm-1 col-form-label-md">Fecha <span class="priority">*<span/></label>
		<div class="col-sm-2">
		  <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" id="fecha" name="fecha" style="width:190px;">
		</div>	
		<label for="inputFecha" class="col-sm-1 col-form-label-md">Identidad <span class="priority">*<span/></label>
		<div class="col-sm-2">
		  <input type="text" required readonly id="identidad" name="identidad" placeholder="Identidad" class="form-control"/>
		</div>			
	  </div>
	  <div class="form-group row">
		<label for="inputCliente" class="col-sm-1 col-form-label-md">Nombre <span class="priority">*<span/></label>
		<div class="col-sm-3">
			<input type="text" readonly id="nombre" name="nombre" readonly placeholder="Usuario" class="form-control"/>
		</div>	
		<label for="inputFecha" class="col-sm-1 col-form-label-md">Servicio <span class="priority">*<span/></label>
		<div class="col-sm-3">
			<div class="input-group mb-3">
			  <select id="servicio_receta" name="servicio_receta" class="custom-select" data-toggle="tooltip" data-placement="top" title="Servicio" required ></select>
			  <div class="input-group-append" id="buscar_servicio_receta_electronica">				
				<a data-toggle="modal" href="#" class="btn btn-outline-success"><div class="sb-nav-link-icon"></div><i class="fab fa-servicestack fa-lg"></i></a>
			  </div>
			</div>
		</div>			
	  </div>				  
	  <div class="form-group row table-responsive-xl overflow-auto">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-bordered table-hover" id="recetaItem">
				<thead align="center" class="table-success">
					<tr>
						<th width="2.50%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
						<th width="22.50%">Nombre Producto</th>
						<th width="12.50%">Via</th>
						<th width="12.50%">Cantidad</th>
						<th width="12.50%">Mañana</th>	
						<th width="12.50%">Mediodia</th>									
						<th width="12.50%">Tarde</th>
						<th width="12.50%">Noche</th>
					</tr>	
				</thead>
				<tbody>
					<tr>
						<td><input class="itemRow" type="checkbox"></td>
						<td>
							<input type="hidden" name="productCode[]" id="productCode_0" class="form-control" placeholder="Producto ISV" autocomplete="off">
							<input type="hidden" name="product[]" id="product_0" class="form-control" placeholder="Valor ISV" autocomplete="off">
							<input type="hidden" name="concentracion[]" id="concentracion_0" class="form-control" placeholder="Código Producto" autocomplete="off">
							<input type="hidden" name="unidad[]" id="unidad_0" class="form-control" placeholder="Código Producto" autocomplete="off">	
							<div class="input-group mb-3">
								<input type="text" name="productName[]" id="productName_0" class="form-control producto" placeholder="Producto o Servicio" autocomplete="off">
								<div id="suggestions_producto_0" class="suggestions"></div>
								<div class="input-group-append" id="producto_grupo">								
									<a data-toggle="modal" href="#" class="btn btn-outline-success buscar_productos"><div class="sb-nav-link-icon"></div><i class="buscar_producto fas fa-search-plus fa-lg"></i></a>
								</div>
							</div>							
						</td>									
						<td><select name="via[]" id="via_0" class="custom-select"></select></td>
						<td><input type="number" step="0.01" name="quanty[]" id="quanty_0" class="form-control" placeholder="Cantidad" autocomplete="off"></td>
						<td><input type="text" step="0.01" name="manana[]" id="manana_0" class="form-control manana" placeholder="Mañana1" autocomplete="off"></td>
						<td><input type="text" step="0.01" name="mediodia[]" id="mediodia_0" class="form-control mediodia" placeholder="Mediodia" autocomplete="off"></td>
						<td><input type="text" step="0.01" name="tarde[]" id="tarde_0" class="form-control tarde" placeholder="Tarde" autocomplete="off"></td>					
						<td><input type="text" step="0.01" name="noche[]" id="nocche_0" class="form-control noche" placeholder="Noche" autocomplete="off"></td>
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
			<div class="col-md-12 mb-3">
				<h3>Observaciones: </h3>
				<div class="form-group">
					<textarea class="form-control txt" rows="3" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="255"></textarea>
					<p id="charNum_notas">255 Caracteres</p>
				</div>
			</div>					  
	  </div>
	</form>
</div> 