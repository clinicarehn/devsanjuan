<!--INICIO MODAL AGREGAR CITAS-->
<div class="modal fade" id="ModalAdd">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Citas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form id="form-addevent" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<input type="text" name="paciente_id" class="form-control" id="paciente_id" placeholder="Paciente" style="display: none;">
	            <input type="text" name="medico" class="form-control" id="medico" placeholder="Médico" style="display: none;">
	            <input type="text" name="serv" class="form-control" id="serv" placeholder="Servicio" style="display: none;">
                <input type="text" name="unidad" class="form-control" id="unidad" placeholder="Puesto" style="display: none;">
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="expediente">Expediente</label>
						  <input type="number" name="expediente" class="form-control" id="expediente" placeholder="Expediente o Identidad" required="required">
					</div>
					<div class="col-md-4 mb-3">
					  <label for="profesional_citas">Profesional</label>
					  <input type="text" name="profesional_citas" readonly class="form-control" id="profesional_citas" required="required">
					</div>
					<div class="col-md-4 mb-3">
						<label for="color">Color </label>
						<div class="input-group">
							<div class="input-group-append">
								<select id="color" name="color" class="selectpicker" title="Color" data-live-search="true" disabled>
									<option value="">Choose</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Azul Oscuro</option>
									<option style="color:#008000;" value="#008000">&#9724; Verde</option>
								</select>
							</div>	
						</div>
					</div>					
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="nombre">Nombre</label>
					  <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" readonly="readonly">
					</div>
				</div>

				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="fecha_cita">Fecha Cita Inicio</label>
						  <input type="text" name="fecha_cita" class="form-control" id="fecha_cita" readonly="readonly">
					</div>
					<div class="col-md-4 mb-3">
					  <label for="fecha_cita_end">Fecha Cita Fin</label>
					  <input type="text" name="fecha_cita_end" class="form-control" id="fecha_cita_end" readonly="readonly" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" title="Año-Mes-Dia Hora:Minutos:Segundos">
					</div>
					<div class="col-md-4 mb-3">
					  <label for="hora">Hora <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="hora" name="hora" class="selectpicker" title="Hora" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>				
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="hora">Referencia de Factura</label>
						<textarea id="factura" name="factura" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Número Factura" data-toggle="tooltip" data-placement="top" title="Este es el número de factura que se genera en el sistema de facturación, deberán pegarlo en esta sección, solo es obligatorio para usuarios nuevos, si se escribe un valor aquí, aparecerá como pagado en el reporte de agenda diaria tanto para nuevos como para subsiguientes, tomar esto en cuenta."></textarea>
						<p id="charNum_citas_referencia_factura">250 Caracteres</p>
					</div>					
				</div>				
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="obs">Observación</label>
					  <textarea id="obs" name="obs" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Observación"></textarea>
					  <p id="charNum_citas_observacion">250 Caracteres</p>
					</div>
				</div>
				 <div class="form-check-inline">
					 <p for="end" class="col-sm-10 form-check-label">¿Usuario Priorizado?</p>
					 <div class="col-sm-2">
						<input type="checkbox" class="form-check-input" name="checkPriorizado" id="checkPriorizado" value="1">
					 </div>
				 </div>
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-2" type="submit" id="ModalAdd_enviar" form="form-addevent"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		</div>
      </div>
    </div>
</div>
<!--FIN MODAL AGREGAR CITAS-->

<!--INICIO MODAL EDITAR CITAS-->
<div class="modal fade" id="ModalEdit">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar/Eliminar una Cita</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form id="form-editevent" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="paciente_id" class="form-control" id="paciente_id" placeholder="Paciente">
	            <input type="hidden" name="id" class="form-control" id="id" placeholder="Médico">
	            <input type="hidden" name="medico" class="form-control" id="medico" placeholder="Médico">
	            <input type="hidden" name="serv" class="form-control" id="serv" placeholder="Servicio">
                <input type="hidden" name="unidad" class="form-control" id="unidad" placeholder="Puesto">
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre_proveedores">Expediente</label>
					  <input type="text" name="expediente_edit" class="form-control" id="expediente_edit" placeholder="Expediente" readonly="readonly">
					</div>
					<div class="col-md-8 mb-3">
					  <label for="apellido_proveedores">Paciente</label>
					  <input type="text" name="paciente" class="form-control" id="paciente" placeholder="Paciente" readonly="readonly">
					  <input type="text" name="medico1" class="form-control" id="medico1" readonly="readonly" style="display: none;">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
					  <label for="nombre_proveedores">Fecha</label>
					  <input type="date" name="fecha_citaedit" class="form-control" id="fecha_citaedit" data-toggle="tooltip" data-placement="top" title="Año-Mes-Dia   Hora:Minutos:Segundos">
					</div>					
					<div class="col-md-3 mb-3">
					  <label for="hora_nueva">Nueva Hora <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="hora_nueva" name="hora_nueva" class="selectpicker" title="Hora" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>						
					<div class="col-md-3 mb-3">
					  <label for="rtn_proveedores">Fecha Cita Inicio</label>
						 <input type="text" name="fecha_citaedit1" class="form-control" id="fecha_citaedit1" data-toggle="tooltip" data-placement="top" title="Año-Mes-Dia Hora:Minutos:Segundos" readonly="readonly">
					</div>
					<div class="col-md-3 mb-3">
					  <label for="apellido_proveedores">Fecha Cita Fin</label>
					  <input type="text" name="fecha_citaeditend" class="form-control" id="fecha_citaeditend" data-toggle="tooltip" data-placement="top" title="Año-Mes-Dia Hora:Minutos:Segundos" readonly="readonly">
					</div>					
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
					  <label for="rtn_proveedores">Hora</label>
					  <input type="time" name="hora_citaeditend" class="form-control" id="hora_citaeditend" placeholder="Hora" readonly >
					</div>
					<div class="col-md-3 mb-3">
					  <label for="color">Color <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="color" name="color" class="selectpicker" title="Color" data-live-search="true" disabled>
									<option value="">Choose</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Azul Oscuro</option><!--Usuarios Subsiguientes-->
									<option style="color:#008000;" value="#008000">&#9724; Verde</option><!--Usuarios Nuevos-->
									<option style="color:#DF0101;" value="#DF0101">&#9724; Rojo</option><!--Usuarios Precargados-->
									<option style="color:#824CC8;" value="#824CC8">&#9724; Morado</option><!--Usuarios Extemporaneos-->
									<option style="color:#FF5733;" value="#FF5733">&#9724; Naranja</option><!--Usuarios Reprogramados-->
									<option style="color:#B7950B;" value="#B7950B">&#9724; Amarillo</option><!--Usuarios con mas de 5 años-->
								</select>
							</div>	
					   </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="colaborador">Colaborador <span class="priority">*<span/></label>
						<div class="input-group">
							<div class="input-group-append">
								<select id="colaborador" name="colaborador" class="selectpicker" title="Colaborador" data-live-search="true">
									<option value="">Seleccione</option>
								</select>
							</div>	
						</div>
					</div>					
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="coment1">Observación</label>
					  <textarea rows="4" cols="50" name="coment1" class="form-control" id="coment1" placeholder="Observación" readonly="readonly" maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
					  </textarea>
					  <p id="charNum_editar_citas_observacion">250 Caracteres</p>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="coment_1">Comentario</label>
					  <textarea rows="4" cols="50" name="coment_1" class="form-control" id="coment_1" placeholder="Comentario" readonly="readonly" maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
					  </textarea>
					  <p id="charNum_editar_citas_comentario">250 Caracteres</p>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="coment">Comentario</label>
						<textarea id="coment" name="coment" class="form-control" rows="3" required maxlength="250" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Comentario"></textarea>
						<p id="charNum_editar_citas_comentario1">250 Caracteres</p>
					</div>
				</div>
			   <div class="form-group form-check-inline">
				  <div class="col-md-12 mb-3">
					 <input type="checkbox" name="checkeliminar" class="checkbox-inline" id="checkeliminar" placeholder="Comentario" value="1">
					 <label class="form-check-label" for="exampleCheck1">Eliminar</label>
				  </div>
			   </div>
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-warning ml-2" type="submit" id="ModalEdit_enviar"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Modificar</button>
			<button class="btn btn-danger ml-2" type="submit" id="ModalDelete_enviar"><div class="sb-nav-link-icon"></div><i class="fas fa-trash fa-lg"></i> Eliminar</button>
			<button class="btn btn-dark ml-2" type="submit" id="ModalImprimir_enviar"><div class="sb-nav-link-icon"></div><i class="fas fa-print fa-lg"></i> Imprimir</button>
		</div>
      </div>
    </div>
</div>
<!--FIN MODAL EDITAR CITAS-->

<!--INICIO MODAL SOBRECUPO-->
<div class="modal fade" id="modal_sobrecupo">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Citas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form id="formulario_sobrecupo" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" id="clientes_id" name="clientes_id" class="form-control">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="text" id="pro_sobrecupo" name="pro_sobrecupo" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Expediente</label>
					  <input type="number" required="required" name="sobrecupo_expediente" class="form-control" id="sobrecupo_expediente" placeholder="Expediente o Identidad">
					</div>
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Fecha Registro</label>
					  <input type="date" name="sobrecupo_fecha" required="required" class="form-control" id="sobrecupo_fecha" value="<?php echo date ("Y-m-d");?>" readonly>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="nombre_proveedores">Nombre</label>
					  <input type="text" name="sobrecupo_nombre" class="form-control" id="sobrecupo_nombre" placeholder="Nombre" readonly="readonly">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="sobrecupo_servicio">Servicio <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="sobrecupo_servicio" name="sobrecupo_servicio" class="selectpicker" title="Servicio" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>				
					<div class="col-md-4 mb-3">
					  <label for="sobrecupo_unidad">Unidad <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="sobrecupo_unidad" name="sobrecupo_unidad" class="selectpicker" title="Unidad" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>	
					<div class="col-md-4 mb-3">
					  <label for="sobrecupo_medico">Profesional <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="sobrecupo_medico" name="sobrecupo_medico" class="selectpicker" title="Profesional" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>	
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="tipo_sobrecupo">Tipo <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="tipo_sobrecupo" name="tipo_sobrecupo" class="selectpicker" title="Tipo" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>					
					<div class="col-md-4 mb-3">
					  <label for="nombre_proveedores">Fecha Cita</label>
					  <input type="date" required="required" name="sobrecupo_fecha_cita" id="sobrecupo_fecha_cita" class="form-control" value="<?php echo date ("Y-m-d");?>">
					</div>
					<div class="col-md-4 mb-3">
					  <label for="hora_sobrecupo">Hora <span class="priority">*<span/></label>
					  <div class="input-group">
							<div class="input-group-append">
								<select id="hora_sobrecupo" name="hora_sobrecupo" class="selectpicker" title="Hora" data-live-search="true">
								</select>
							</div>	
					   </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="nombre_proveedores">Observación</label>
					  <input type="text" required="required" name="sobrecupo_obsevacion" class="form-control" id="sobrecupo_obsevacion" placeholder="Observación">
					</div>
				</div>
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-1" type="submit" id="sobrecupo_agregar" form="formulario_sobrecupo"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
		</div>

      </div>
    </div>
</div>
<!--FIN MODAL SOBRECUPO-->

<!--INICIO MODAL CONFIGURAR EDADES-->
<div class="modal fade" id="registrar_config_edades">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Editar Edades</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form id="formulario_config_edades" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" id="clientes_id" name="clientes_id" class="form-control">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="text" id="pro_config_edades" name="pro_config_edades" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <label for="nombre_proveedores">Edad</label>
					   <input type="number" name="edad" id="edad" class="form-control">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					   <span id="edad_devuelta"></span>
					</div>
				</div>
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-1" type="submit" id="modificar_edades" form="formulario_config_edades"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Modificar</button>
		</div>

      </div>
    </div>
</div>
<!--FIN MODAL CONFIGURAR EDADES-->

<!--INICIO MODAL AUSENCIAS-->
<div class="modal fade" id="registrar_ausencias">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Ausencias</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form id="formulario_ausencias" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" id="clientes_id" name="clientes_id" class="form-control">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="text" id="pro_ausencias" name="pro_ausencias" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="colaborador_ausencia">Departamento</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="colaborador_ausencia" name="colaborador_ausencia" data-live-search="true" title="Unidad">			  
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="medico_ausencia">Profesional</label>			
						<div class="input-group mb-3">
						<select class="selectpicker" id="medico_ausencia" name="medico_ausencia" data-live-search="true" title="Profesional">			  
						</select>
						</div>
					</div>
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Comentario</label>
					  <input type="text" name="comentario_ausencias" id="comentario_ausencias" class="form-control" size="280">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
					  <label for="nombre_proveedores">Fecha Inicio</label>
					  <input type="date" name="fecha_ausencia" id="fecha_ausencia" class="form-control" value="<?php echo date ("Y-m-d");?>">
					</div>
					<div class="col-md-4 mb-3">
					  <label for="apellido_proveedores">Fecha Fin</label>
					  <input type="date" name="fecha_ausenciaf" id="fecha_ausenciaf" class="form-control" value="<?php echo date ("Y-m-d");?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  	<div class="registros" id="agrega-registros_ausencias"></div>
						</div>
					    <center>
						   <ul class="pagination" id="pagination"></ul>
					    </center>
				</div>
			</form>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary ml-1" type="submit" id="reg_ausencias" form="formulario_ausencias"><div class="sb-nav-link-icon"></div><i class="far fa-save fa-lg"></i> Registrar</button>
			<button class="btn btn-info ml-1" type="submit" id="reg_buscarausencias" form="formulario_ausencias"><div class="sb-nav-link-icon"></div><i class="fas fa-sync-alt fa-lg"></i> Buscar</button>
		</div>

      </div>
    </div>
</div>
<!--FIN MODAL AUSENCIAS-->

<!--INICIO MODAL BUSCAR CITAS PENDIENTES-->
<div class="modal fade" id="buscarCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buscar Citas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="form-buscarcita">
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" placeholder="Buscar por: Expediente, Paciente, Medico/Psicólogo o Identidad" id="bs-regis" autofocus class="form-control"/>
					</div>
				</div>
				<div class="form-row">
				  <div class="col-md-12 mb-3 overflow-auto">
					 <div class="registros" id="agrega-registros"></div>
				  </div>
				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center" id="pagination"></ul>
				</nav>				
			</form>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL BUSCAR CITAS PENDIENTES-->

<!--INICIO MODAL BUSCAR HISTORIAL DE CITAS ATENDIDAS-->
<div class="modal fade" id="buscarHistorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atenciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-buscarhistorial">
			<div class="form-row">
				<div class="col-md-12 mb-3">
				  <input type="text" placeholder="Buscar por: Expediente, Paciente, Medico/Psicólogo o Identidad" id="bs-regis" autofocus class="form-control"/>
				</div>
			</div>
			<div class="form-row">
			  <div class="col-md-12 mb-3 overflow-auto">
				 <div class="registros" id="agrega-registros"></div>
			  </div>
			</div>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center" id="pagination"></ul>
			</nav>			
        </form>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL BUSCAR HISTORIAL DE CITAS ATENDIDAS-->

<!--INICIO MODAL BUSCAR HISTORIAL DE REPROGRAMACION DE CITAS-->
<div class="modal fade" id="buscarHistorialReprogramaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reprogramaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form id="form_buscarhistorial_reprogramaciones">
			<div class="form-row">
				<div class="col-md-12 mb-3">
				  <input type="text" placeholder="Buscar por: Expediente, Paciente, Medico/Psicólogo o Identidad" id="bs-regis" autofocus class="form-control"/>
				</div>
			</div>
			<div class="form-row">
			  <div class="col-md-12 mb-3 overflow-auto">
				 <div class="registros" id="agrega-registros"></div>
			  </div>
			</div>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center" id="pagination"></ul>
			</nav>			
		</form>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL BUSCAR HISTORIAL DE REPROGRAMACION DE CITAS-->

<!--INICIO MODAL BUSCAR HISTORIAL DE AUSENCIA DE USUARIOS-->
<div class="modal fade" id="buscarHistorialNo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ausencias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="form-buscarhistorialno">
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  <input type="text" placeholder="Buscar por: Expediente, Paciente, Medico/Psicólogo o Identidad" id="bs-regis" autofocus class="form-control"/>
					</div>
				</div>
				<div class="form-row">
				  <div class="col-md-12 mb-3 overflow-auto">
					 <div class="registros" id="agrega-registros"></div>
				  </div>
				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center" id="pagination"></ul>
				</nav>				
			</form>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL BUSCAR HISTORIAL DE AUSENCIA DE USUARIOS-->

<!--INICIO MODAL BLOQUEO POR HORA-->
<div class="modal fade" id="modal_bloqueo_hora">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulario Bloqueo de Horas</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
        </div><div class="container"></div>
        <div class="modal-body">
			<form id="formulario_bloquedo" action="" method="POST" data-form="" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" id="clientes_id" name="clientes_id" class="form-control">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<div class="input-group mb-3">
							<input type="text" id="pro_bloqueo" name="pro_bloqueo" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><div class="sb-nav-link-icon"></div><i class="fa fa-plus-square"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Unidad</label>
					   <select id="unidad_id" name="unidad_id" class="custom-select" data-toggle="tooltip" data-placement="top" title="Unidad">
						  <option value="">Seleccione</option>
					   </select>
					</div>
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Profesional</label>
					   <select id="profesional_id" name="profesional_id" class="custom-select" data-toggle="tooltip" data-placement="top" title="Profesional">
						  <option value="">Seleccione</option>
					   </select>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
					  <label for="nombre_proveedores">Fecha Inicio</label>
					  <input type="date" name="fecha_bloqueo" id="fecha_bloqueo" class="form-control" value="<?php echo date ("Y-m-d");?>">
					</div>
					<div class="col-md-6 mb-3">
					  <label for="apellido_proveedores">Fecha Fin</label>
					  <input type="date" name="fecha_bloqueof" id="fecha_bloqueof" class="form-control" value="<?php echo date ("Y-m-d");?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
					  	<div class="registros" id="agrega_registros_bloqueoHoras"></div>
						</div>
					    <center>
						   <ul class="pagination" id="pagination_bloqueoHoras"></ul>
					    </center>
				</div>
			</form>
        </div>
		<div class="modal-footer">

		</div>

      </div>
    </div>
</div>
<!--FIN MODAL AUSENCIAS-->