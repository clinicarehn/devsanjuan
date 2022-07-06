<script>
/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
/*############################################################################################################################################################################################*/
/*############################################################################################################################################################################################*/
var imagen;
toDataURL(
  '<?php echo SERVERURL;?>vistas/plantilla/img/logo.png',
  function(dataUrl) {
	imagen = dataUrl;
  }
)

/*INICIO FUNCION OBTENER MUNICIPIOS*/
function getMunicipiosClientes(departamentos_id, municipios_id){
	var url = '<?php echo SERVERURL;?>core/getMunicipios.php';
		
	var departamentos_id = $('#formClientes #departamento_cliente').val();
	
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'departamentos_id='+departamentos_id,
	   success:function(data){
		  $('#formClientes #municipio_cliente').html("");
		  $('#formClientes #municipio_cliente').html(data);
		  $('#formClientes #municipio_cliente').val(municipios_id);			  
	  }
  });
  return false;			 				
}

function getMunicipiosProveedores(departamentos_id, municipios_id){
	var url = '<?php echo SERVERURL;?>core/getMunicipios.php';
		
	var departamentos_id = $('#formProveedores #departamento_proveedores').val();
	
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'departamentos_id='+departamentos_id,
	   success:function(data){
		  $('#formProveedores #municipio_proveedores').html("");
		  $('#formProveedores #municipio_proveedores').html(data);
		  $('#formProveedores #municipio_proveedores').val(municipios_id);			  
	  }
  });
  return false;			 				
}
/*FIN FUNCION OBTERNER MUNICIPIOS*/
	
/*INICIO FORMULARIO CLIENTES*/
function modal_clientes(){
	getDepartamentoClientes();	
	$('#formClientes').attr({ 'data-form': 'save' }); 
	$('#formClientes').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarClientesAjax.php' }); 
	$('#formClientes')[0].reset();
	$('#reg_cliente').show();
	$('#edi_cliente').hide();
	$('#delete_cliente').hide();
	$('#formClientes #fecha_clientes').attr('disabled', false);	
	
	//HABILITAR OBJETOS
	$('#formClientes #nombre_clientes').attr("readonly", false);
	$('#formClientes #apellido_clientes').attr("readonly", false);
	$('#formClientes #identidad_clientes').attr("readonly", false);
	$('#formClientes #fecha_clientes').attr("readonly", false);
	$('#formClientes #departamento_cliente').attr("disabled", false);
	$('#formClientes #municipio_cliente').attr("disabled", false);	
	$('#formClientes #dirección_clientes').attr("disabled", false);
	$('#formClientes #telefono_clientes').attr("readonly", false);
	$('#formClientes #correo_clientes').attr("readonly", false);
	$('#formClientes #clientes_activo').attr("disabled", false);
				
	$('#formClientes #proceso_clientes').val("Registro");
	$('#modal_registrar_clientes').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO CLIENTES*/

/*INICIO FORMULARIO PROVEEDORES*/
function modal_proveedores(){
	getDepartamentoProveedores();		
	$('#formProveedores').attr({ 'data-form': 'save' }); 
	$('#formProveedores').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarProveedoresAjax.php' }); 
	$('#formProveedores')[0].reset();	
	$('#reg_proveedor').show();
	$('#edi_proveedor').hide();	
	$('#delete_proveedor').hide();
	$('#formProveedores #fecha_proveedores').attr('disabled', false);

	//HABILITAR OBJETOS
	$('#formProveedores #nombre_proveedores').attr("readonly", false);
	$('#formProveedores #apellido_proveedores').attr("readonly", false);
	$('#formProveedores #rtn_proveedores').attr("readonly", false);
	$('#formProveedores #fecha_proveedores').attr("readonly", false);
	$('#formProveedores #departamento_proveedores').attr("disabled", false);
	$('#formProveedores #municipio_proveedores').attr("disabled", false);					
	$('#formProveedores #dirección_proveedores').attr("disabled", false);
	$('#formProveedores #telefono_proveedores').attr("readonly", false);
	$('#formProveedores #correo_proveedores').attr("readonly", false);
	$('#formProveedores #proveedores_activo').attr("disabled", false)
				
	$('#formProveedores #proceso_proveedores').val("Registro");	  
	$('#modal_registrar_proveedores').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO PROVEEDORES*/

/*INICIO FORMULARIO COLABORADORES*/
function modal_colaboradores(){
	getPuestoColaboradores();
	$('#formColaboradores').attr({ 'data-form': 'save' }); 
	$('#formColaboradores').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarColaboradorAjax.php' }); 
	$('#formColaboradores')[0].reset();
	$('#reg_colaborador').show();
	$('#edi_colaborador').hide();
	$('#delete_colaborador').hide();	
	
	//HABILITAR OBJETOS
	$('#formColaboradores #nombre_colaborador').attr('readonly', false);
	$('#formColaboradores #apellido_colaborador').attr('readonly', false);
	$('#formColaboradores #identidad_colaborador').attr('readonly', false);
	$('#formColaboradores #telefono_colaborador').attr('readonly', false);
	$('#formColaboradores #puesto_colaborador').attr('disabled', false);
	$('#formColaboradores #estado_colaborador').attr('disabled', false);
	$('#formColaboradores #colaboradores_activo').attr('disabled', false);
				
	$('#formColaboradores #proceso_colaboradores').val("Registro");	  
	$('#modal_registrar_colaboradores').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO COLABORADORES*/

/*INICIO FORMULARIO USUARIOS*/
function modal_usuarios(){
	getEmpresaUsers();	
	getTipoUsuario();
	getPrivilegio();	
	$('#formUsers').attr({ 'data-form': 'save' });
	$('#formUsers').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarUsuarioAjax.php' }); 	  
	$('#formUsers')[0].reset();
	$('#reg_usuario').show();
	$('#edi_usuario').hide();	
	$('#delete_usuario').hide();		
	$('#formUsers #proceso_usuarios').val("Registro");
	$('#formUsers #grupo_buscar_colaboradores').attr('disabled', false);
	$('#formUsers #buscar_colaboradores').show();
	
	//HABILITAR OBJETOS
	$('#formUsers #nickname').attr('readonly', false);
	$('#formUsers #pass').attr('readonly', false);
	$('#formUsers #correo_usuario').attr('readonly', false);
	$('#formUsers #empresa_usuario').attr('disabled', false);
	$('#formUsers #tipo_user').attr('disabled', false);
	$('#formUsers #estado_usuario').attr('disabled', false);
	$('#formUsers #privilegio_id').attr('disabled', false);
	$('#formUsers #usuarios_activo').attr('disabled', false);
				
	$('#formUsers #pass').attr('disabled', false);	
	$('#modal_registrar_usuarios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}

$('#formUsers #buscar_colaboradores').on('click',function(){	
	  $('#formColaboradores #edi_colaborador').hide();
	  $('#formColaboradores #reg_colaborador').hide();
	  $('#formColaboradores #delete_colaborador').hide();	  
	  $('#formBuscarColaboradores #buscar').val("");
	  $('#modal_buscar_colaboradores_usuarios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	  });
});
/*FIN FORMULARIO COLABORADORES*/

/*INICIO FORMULARIO PUESTO DE COLABORADORES*/
function modal_puestos(){
	  $('#formPuestos').attr({ 'data-form': 'save' });
	  $('#formPuestos').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarPuestosAjax.php' }); 	  
	  $('#formPuestos')[0].reset();
	  $('#reg_puestos').show();
	  $('#edi_puestos').hide();
	  $('#delete_puestos').hide();	 
	  
	  //HABILITAR OBJETOS
	  $('#formPuestos #puesto').attr('readonly', false);
	  $('#formPuestos #puestos_activo').attr('disabled', false);
				
	  $('#formPuestos #proceso_puestos').val("Registro");	  
	  $('#modal_registrar_puestos').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	  });
}
/*FIN FORMULARIO PUESTO DE COLABORADORES*/

/*INICIO FORMULARIO SECUENCIA DE FACTURACION*/
function modal_secuencia_facturacion(){
	getEmpresaSecuencia();		
	$('#formSecuencia').attr({ 'data-form': 'save' });
	$('#formSecuencia').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarSecuenciaFacturacionAjax.php' }); 	  
	$('#formSecuencia')[0].reset();
	$('#reg_secuencia').show();
	$('#edi_secuencia').hide();
	$('#delete_secuencia').hide();	
	
	//HABILITAR OBJETOS
	$('#formSecuencia #empresa_secuencia').attr('disabled', false);
	$('#formSecuencia #cai_secuencia').attr('readonly', false);
	$('#formSecuencia #prefijo_secuencia').attr('readonly', false);
	$('#formSecuencia #relleno_secuencia').attr('readonly', false);
	$('#formSecuencia #incremento_secuencia').attr('readonly', false);
	$('#formSecuencia #siguiente_secuencia').attr('readonly', false);
	$('#formSecuencia #rango_inicial_secuencia').attr('readonly', false);
	$('#formSecuencia #rango_final_secuencia').attr('readonly', false);
	$('#formSecuencia #fecha_activacion_secuencia').attr('readonly', false);
	$('#formSecuencia #fecha_limite_secuencia').attr('readonly', false);
	$('#formSecuencia #estado_secuencia').attr('disabled', false);	
				
	$('#formSecuencia #proceso_secuencia_facturacion').val("Registro");	
	$('#formSecuencia #empresa_secuencia').attr('disabled', false);	
	$('#modal_registrar_secuencias').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO SECUENCIA DE FACTURACION*/

/*INICIO FORMULARIO EMPRESA*/
function modal_empresa(){
	$('#formEmpresa').attr({ 'data-form': 'save' });
	$('#formEmpresa').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarEmpresaAjax.php' }); 	  
	$('#formEmpresa')[0].reset();
	$('#reg_empresa').show();
	$('#edi_empresa').hide();	
	$('#delete_empresa').hide();	
	
	//HABILITAR OBJETOS
	$('#formEmpresa #empresa_empresa').attr('readonly', false);
	$('#formEmpresa #rtn_empresa').attr('readonly', false);
	$('#formEmpresa #telefono_empresa').attr('readonly', false);
	$('#formEmpresa #correo_empresa').attr('readonly', false);
	$('#formEmpresa #direccion_empresa').attr('readonly', false);
	$('#formEmpresa #empresa_activo').attr('disabled', false);
	$('#formEmpresa #empresa_razon_social').attr('readonly', false);
	$('#formEmpresa #empresa_otra_informacion').attr('readonly', false);
	$('#formEmpresa #empresa_eslogan').attr('disabled', false);	
	$('#formEmpresa #empresa_celular').attr('disabled', false);		
				
	$('#formEmpresa #proceso_empresa').val("Registro");	  
	$('#modal_registrar_empresa').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO EMPRESA*/

/*INICIO FORMULARIO PRIVILEGIOS*/
function modal_privilegios(){
	$('#formPrivilegios').attr({ 'data-form': 'save' });
	$('#formPrivilegios').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarPrivilegiosAjax.php' }); 	  
	$('#formPrivilegios')[0].reset();
	$('#reg_privilegios').show();
	$('#edi_privilegios').hide();
	$('#delete_privilegios').hide();
	
	//HABILITAR OBJETOS
	$('#formPrivilegios #privilegios_nombre').attr('readonly', false);
	$('#formPrivilegios #privilegio_activo').attr('disabled', false);
				
	$('#formPrivilegios #proceso_privilegios').val("Registro");	  
	$('#modal_registrar_privilegios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO PRIVILEGIOS*/

/*INICIO FORMULARIO TIPO USUARIO*/
function modal_tipo_usuarios(){
	$('#formTipoUsuario').attr({ 'data-form': 'save' });
	$('#formTipoUsuario').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarTipoUsuarioAjax.php' }); 	  
	$('#formTipoUsuario')[0].reset();
	$('#reg_tipo_usuario').show();
	$('#edi_tipo_usuario').hide();
	$('#delete_tipo_usuario').hide();
	
	//HABILITAR OBJETOS
	$('#formTipoUsuario #tipo_usuario_nombre').attr('readonly', false);
	$('#formTipoUsuario #tipo_usuario_activo').attr('disabled', false);
				
	$('#formTipoUsuario #proceso_tipo_usuario').val("Registro");		  
	$('#modal_registrar_tipoUsuario').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO TIPO USAURIO*/

/*INICIO FORMULARIO TIPO USUARIO*/
function modal_productos(){
	$('#formProductos').attr({ 'data-form': 'save' });
	$('#formProductos').attr({ 'action': '<?php echo SERVERURL;?>ajax/agregarProductosAjax.php' }); 	  
	$('#formProductos')[0].reset();
	$('#reg_producto').show();
	$('#edi_producto').hide();
	$('#delete_producto').hide();
	
	//HABILITAR OBJETOS
	$('#formProductos #producto').attr("readonly", false);
	$('#formProductos #categoria').attr("disabled", false);
	$('#formProductos #medida').attr("disabled", false);
	$('#formProductos #almacen').attr("disabled", false);				
	$('#formProductos #cantidad').attr("readonly", false);
	$('#formProductos #precio_compra').attr("readonly", false);
	$('#formProductos #precio_venta').attr("readonly", false);
	$('#formProductos #descripcion').attr("readonly", false);
	$('#formProductos #cantidad_minima').attr("readonly", false);
	$('#formProductos #cantidad_maxima').attr("readonly", false);
	$('#formProductos #isv_si').attr("disabled", false);
	$('#formProductos #isv_no').attr("disabled", false);				
	$('#formProductos #isv_compra_si').attr("disabled", false);
	$('#formProductos #isv_compra_no').attr("disabled", false);	
				
	$('#formProductos #proceso_productos').val("Registro");		  
	$('#modal_registrar_productos').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
}
/*FIN FORMULARIO TIPO USAURIO*/

//INICIO FORMULARIO MOVIMIENTOS
function modal_movimientos(){
	$('#formMovimientos').attr({ 'data-form': 'save' });
	$('#formMovimientos').attr({ 'action': '<?php echo SERVERURL; ?>ajax/agregarMovimientoProductosAjax.php' });
	$('#formMovimientos')[0].reset();
	$('#formMovimientos #proceso_movimientos').val("Proceso");
	$('#modal_movimientos').show();
	funciones();
	$('#modal_movimientos').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	
}
//FIN FORMULARIO MOVIMIENTOS

//INICIO FORMULARIO MEDIDAS
function modalMedidas(){
	$('#formMedidas').attr({ 'data-form': 'save' });
	$('#formMedidas').attr({ 'action': '<?php echo SERVERURL; ?>ajax/agregarMedidasAjax.php' });
	$('#formMedidas')[0].reset();
	$('#formMedidas #pro_medidas').val("Proceso");
	$('#reg_medidas').show();
	$('#edi_medidas').hide();
	$('#delete_medidas').hide();
			
	//HABILITAR OBJETOS
	$('#formMedidas #medidas_medidas').attr('readonly', false);
	$('#formMedidas #descripcion_medidas').attr('readonly', false);
	$('#formMedidas #medidas_activo').attr('disabled', false);
				
	$('#modal_medidas').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	
}
//FIN FORMULARIO MEDIDAS

//INICIO FORMULARIO UBICACION
function modalUbicacion(){
	$('#formUbicacion').attr({ 'data-form': 'save' });
	$('#formUbicacion').attr({ 'action': '<?php echo SERVERURL; ?>ajax/agregarUbicacionAjax.php' });
	$('#formUbicacion')[0].reset();
	getEmpresaUbicacion();
	$('#formUbicacion #pro_ubicacion').val("Proceso");
	$('#reg_ubicacion').show();
	$('#edi_ubicacion').hide();
	$('#delete_ubicacion').hide();

	//HABILITAR OBJETOS
	$('#formUbicacion #ubicacion_ubicacion').attr('readonly', false);
	$('#formUbicacion #ubicacion_activo').attr('disabled', false);				
	$('#formUbicacion #empresa_ubicacion').attr('disabled', false);	
			
	 $('#modal_ubicacion').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	
}
//FIN FORMULARIO UBICACION

//INICIO FORMULARIO UBICACION
function modalAlmacen(){
	$('#formAlmacen').attr({ 'data-form': 'save' });
	$('#formAlmacen').attr({ 'action': '<?php echo SERVERURL; ?>ajax/agregarAlmacenAjax.php' });
	$('#formAlmacen')[0].reset();	
	$('#formAlmacen #pro_almacen').val("Proceso");
	$('#reg_almacen').show();
	$('#edi_almacen').hide();
	$('#delete_almacen').hide();	
	getUbicacionAlmacen();
	
	//HABILITAR OBJETOS
	$('#formAlmacen #almacen_almacen').attr('readonly', false);
	$('#formAlmacen #ubicacion_almacen').attr('disabled', false);
	$('#formAlmacen #almacen_activo').attr('disabled', false);	
			
	$('#modal_almacen').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	
}
//FIN FORMULARIO UBICACION

$(document).ready(function() {
	$('#formVarios #varios_tabla').on('change', function(){
		listar_varios(); 				
    });					
});

//BUSQUEDA FECHAS HISTORIAL DE ACCESOS
$(document).ready(function() {
	$('#formMainHistorialAcceso #fechai').on('change',function(){
		  listar_historial_accesos();
    });	

	$('#formMainHistorialAcceso #fechaf').on('change',function(){
		  listar_historial_accesos();
    });		
});


$(document).ready(function(){
	getUserSessionStart();
	getDepartamentoClientes();
	getDepartamentoProveedores();
	getEmpresaUsers();
	getEmpresaSecuencia();
	getTipoUsuario();
	getPrivilegio();
	getPuestoColaboradores();
	getMedida();
	getAlmacen();
	getCategoriaProducto();
	getCategoriaProductos();
	getTipoPago();
	getBanco();
	getColaboradorCompras();
	getProductosMovimientos();
	getEmpresaUbicacion();
	getUbicacionAlmacen();
	
	//DATA TABLES
	listar_historial_accesos();
	listar_clientes();
	listar_proveedores();
	listar_colaboradores();
	listar_puestos();
	listar_usuarios();
	listar_colaboradores_buscar();
	listar_secuencia_facturacion();
	listar_empresa();
	listar_privilegio();
	listar_tipo_usuario();
	listar_productos();
	listar_movimientos();
	listar_bitacora();
	listar_cuentas_por_cobrar_clientes();
	listar_cuentas_por_pagar_proveedores();
	listar_repote_ventas();
	listar_repote_compras();
	listar_almacen();
	listar_ubicacion();
	listar_medidas();

	$('#formClientes #departamento_cliente').on('change', function(){
		var url = '<?php echo SERVERURL;?>core/getMunicipios.php';
       		
		var departamentos_id = $('#formClientes #departamento_cliente').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'departamentos_id='+departamentos_id,
		   success:function(data){
		      $('#formClientes #municipio_cliente').html("");
			  $('#formClientes #municipio_cliente').html(data);					  
		  }
	  });
	  return false;			 				
    });	

	$('#formProveedores #departamento_proveedores').on('change', function(){
		var url = '<?php echo SERVERURL;?>core/getMunicipios.php';
       		
		var departamentos_id = $('#formProveedores #departamento_proveedores').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'departamentos_id='+departamentos_id,
		   success:function(data){
		      $('#formProveedores #municipio_proveedores').html("");
			  $('#formProveedores #municipio_proveedores').html(data);	  
		  }
	  });
	  return false;			 				
    });		
});

//INICIO SELECTORES
function getEmpresaUsers(){
    var url = '<?php echo SERVERURL;?>core/getEmpresa.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formUsers #empresa_usuario').html("");
			$('#formUsers #empresa_usuario').html(data);			
		}			
     });		
}

function getEmpresaSecuencia(){
    var url = '<?php echo SERVERURL;?>core/getEmpresa.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formSecuencia #empresa_secuencia').html("");
			$('#formSecuencia #empresa_secuencia').html(data);			
		}			
     });		
}

function getDepartamentoClientes(){
    var url = '<?php echo SERVERURL;?>core/getDepartamentos.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formClientes #departamento_cliente').html("");
			$('#formClientes #departamento_cliente').html(data);		
		}			
     });		
}

function getDepartamentoProveedores(){
    var url = '<?php echo SERVERURL;?>core/getDepartamentos.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formProveedores #departamento_proveedores').html("");
			$('#formProveedores #departamento_proveedores').html(data);			
		}			
     });		
}

function getTipoUsuario(){
    var url = '<?php echo SERVERURL;?>core/getTipoUsuario.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formUsers #tipo_user').html("");
			$('#formUsers #tipo_user').html(data);			
		}			
     });	
}

function getPrivilegio(){
    var url = '<?php echo SERVERURL;?>core/getPrivilegio.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formUsers #privilegio_id').html("");
			$('#formUsers #privilegio_id').html(data);			
		}			
     });	
}

function getPuestoColaboradores(){
    var url = '<?php echo SERVERURL;?>core/getPuestoColaboradores.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formColaboradores #puesto_colaborador').html("");
			$('#formColaboradores #puesto_colaborador').html(data);			
		}			
     });	
}

function getUserSessionStart(){
    var url = '<?php echo SERVERURL;?>core/getUserSession.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#user_session').html(data);		
		}			
     });		
}

function getMedida(){
    var url = '<?php echo SERVERURL;?>core/getMedida.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formProductos #medida').html("");
			$('#formProductos #medida').html(data);			
		}			
     });	
}

function getAlmacen(){
    var url = '<?php echo SERVERURL;?>core/getAlmacen.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formProductos #almacen').html("");
			$('#formProductos #almacen').html(data);			
		}			
     });	
}

function getCategoriaProducto(){
    var url = '<?php echo SERVERURL;?>core/getCategoriaProducto.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formProductos #categoria').html("");
			$('#formProductos #categoria').html(data);			
		}			
     });	
}

function getEmpresaUbicacion(){
    var url = '<?php echo SERVERURL;?>core/getEmpresa.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formUbicacion #empresa_ubicacion').html("");
			$('#formUbicacion #empresa_ubicacion').html(data);			
		}			
     });		
}

function getUbicacionAlmacen(){
    var url = '<?php echo SERVERURL;?>core/getUbicacion.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formAlmacen #ubicacion_almacen').html("");
			$('#formAlmacen #ubicacion_almacen').html(data);			
		}			
     });		
}
//FIN SELECTORES

//INICIO LLENAR TABLAS
//DATA TABLE HISTORIAL ACCESOS
var listar_historial_accesos = function(){
	var fechai = $("#formMainHistorialAcceso #fechai").val();
	var fechaf = $("#formMainHistorialAcceso #fechaf").val();
		
	var table_historial_accesos = $("#dataTableHistorialAccesos").DataTable({		
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableHistorialAccesos.php",
			"data":{
				"fechai":fechai,
				"fechaf":fechaf
			}
		},
		"columns":[
			{"data":"fecha"},
			{"data":"colaborador"},
			{"data":"ip"},
			{"data":"acceso"}			
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
		"dom": dom,		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar de Historial de Accesos',
				className: 'btn btn-info',
				action: 	function(){
					listar_historial_accesos();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Historial de Accesos',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Historial de Accesos',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_historial_accesos.search('').draw();
	$('#buscar').focus();
}

//INICIO BITACORA
var listar_bitacora = function(){
	var fechai = $("#formMainBitacora #fechai").val();
	var fechaf = $("#formMainBitacora #fechaf").val();
		
	var table_bitacora = $("#dataTableBitacora").DataTable({		
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableBitacora.php",
			"data":{
				"fechai":fechai,
				"fechaf":fechaf
			}
		},
		"columns":[
			{"data":"bitacoraFecha"},
			{"data":"bitacoraHoraInicio"},
			{"data":"bitacoraHoraFinal"},
			{"data":"bitacoraTipo"},
			{"data":"colaborador"}		
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
		"dom": dom,		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar de Historial de Accesos',
				className: 'btn btn-info',
				action: 	function(){
					listar_bitacora();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Historial de Accesos',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Historial de Accesos',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_bitacora.search('').draw();
	$('#buscar').focus();
}

//INICIO ACCIONES FROMULARIO CLIENTES
var listar_clientes = function(){
	var table_clientes = $("#dataTableClientes").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableClientes.php"
		},
		"columns":[
			{"data":"cliente"},
			{"data":"rtn"},
			{"data":"localidad"},
			{"data":"telefono"},
			{"data":"correo"},
			{"data":"departamento"},
			{"data":"municipio"},
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
		"dom": dom,	
		"columnDefs": [	
		  { width: "21.11%", targets: 0 },
		  { width: "11.11%", targets: 1 },
		  { width: "19.11%", targets: 2 },
		  { width: "11.11%", targets: 3 },
		  { width: "11.11%", targets: 4 },
		  { width: "11.11%", targets: 5 },
		  { width: "11.11%", targets: 6 },
		  { width: "2.11%", targets: 7 },
		  { width: "2.11%", targets: 8 }		  
		],		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Clientes',
				className: 'btn btn-info',
				action: 	function(){
					listar_clientes();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Clientes',
				className: 'btn btn-primary',
				action: 	function(){
					modal_clientes();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Clientes',
				className: 'btn btn-success'			
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Clientes',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	
	table_clientes.search('').draw();
	$('#buscar').focus();
	
	editar_clientes_dataTable("#dataTableClientes tbody", table_clientes);
	eliminar_clientes_dataTable("#dataTableClientes tbody", table_clientes);
}

var editar_clientes_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarClientes.php';		
		$('#formClientes #clientes_id').val(data.clientes_id)
				
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formClientes').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formClientes').attr({ 'data-form': 'update' }); 
				$('#formClientes').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarClientesAjax.php' }); 
				$('#formClientes')[0].reset();
				$('#reg_cliente').hide();
				$('#edi_cliente').show();	
				$('#formClientes #nombre_clientes').val(valores[0]);
				$('#formClientes #apellido_clientes').val(valores[1]);
				$('#formClientes #identidad_clientes').val(valores[2]);
				$('#formClientes #fecha_clientes').attr('disabled', true);
				$('#formClientes #fecha_clientes').val(valores[3]);
				$('#formClientes #departamento_cliente').val(valores[4]);
				getMunicipiosClientes(valores[4], valores[5]);			
				$('#formClientes #dirección_clientes').val(valores[6]);
				$('#formClientes #telefono_clientes').val(valores[7]);	
				$('#formClientes #correo_clientes').val(valores[8]);
				
				if(valores[9] == 1){
					$('#formClientes #clientes_activo').prop('checked', true);
				}else{
					$('#formClientes #clientes_activo').prop('checked', false);					
				}					

				//HABILITAR OBJETOS
				$('#formClientes #nombre_clientes').attr("readonly", false);
				$('#formClientes #apellido_clientes').attr("readonly", false);
				$('#formClientes #departamento_cliente').attr("disabled", false);
				$('#formClientes #municipio_cliente').attr("disabled", false);					
				$('#formClientes #dirección_clientes').attr("disabled", false);
				$('#formClientes #telefono_clientes').attr("readonly", false);
				$('#formClientes #correo_clientes').attr("readonly", false);
				$('#formClientes #clientes_activo').attr("disabled", false);				
				
				//DESHABILITAR
				$('#formClientes #identidad_clientes').attr("readonly", true);
				$('#formClientes #fecha_clientes').attr("readonly", true);
				
				$('#delete_cliente').hide();			
				$('#formClientes #proceso_clientes').val("Editar");
				$('#modal_registrar_clientes').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});
			}
		});			
	});
}

var eliminar_clientes_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarClientes.php';
		$('#formClientes #clientes_id').val(data.clientes_id);
				
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formClientes').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formClientes').attr({ 'data-form': 'delete' }); 
				$('#formClientes').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarClientesAjax.php' }); 
				$('#formClientes')[0].reset();
				$('#reg_cliente').hide();
				$('#edi_cliente').hide();
				$('#delete_cliente').hide();
				$('#delete_cliente').show();	
				$('#formClientes #nombre_clientes').val(valores[0]);
				$('#formClientes #apellido_clientes').val(valores[1]);
				$('#formClientes #identidad_clientes').val(valores[2]);
				$('#formClientes #fecha_clientes').attr('disabled', true);
				$('#formClientes #fecha_clientes').val(valores[3]);
				$('#formClientes #departamento_cliente').val(valores[4]);
				getMunicipiosClientes(valores[4], valores[5]);			
				$('#formClientes #dirección_clientes').val(valores[6]);
				$('#formClientes #telefono_clientes').val(valores[7]);	
				$('#formClientes #correo_clientes').val(valores[8]);
				
				if(valores[9] == 1){
					$('#formClientes #clientes_activo').prop('checked', true);
				}else{
					$('#formClientes #clientes_activo').prop('checked', false);					
				}					

				//DESHABILITAR OBJETOS
				$('#formClientes #nombre_clientes').attr("readonly", true);
				$('#formClientes #apellido_clientes').attr("readonly", true);
				$('#formClientes #identidad_clientes').attr("readonly", true);
				$('#formClientes #fecha_clientes').attr("readonly", true);
				$('#formClientes #departamento_cliente').attr("disabled", true);
				$('#formClientes #municipio_cliente').attr("disabled", true);					
				$('#formClientes #dirección_clientes').attr("disabled", true);
				$('#formClientes #telefono_clientes').attr("readonly", true);
				$('#formClientes #correo_clientes').attr("readonly", true);	
				$('#formClientes #clientes_activo').attr("disabled", true);	
				
				$('#formClientes #proceso_clientes').val("Eliminar");						
				$('#modal_registrar_clientes').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});			
	});
}
//FIN ACCIONES FROMULARIO CLIENTES

//INICIO ACCIONES FROMULARIO PROVEEDORES
var listar_proveedores = function(){
	var table_proveedores  = $("#dataTableProveedores").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableProveedores.php"
		},
		"columns":[
			{"data":"proveedor"},
			{"data":"rtn"},
			{"data":"localidad"},
			{"data":"telefono"},
			{"data":"correo"},
			{"data":"departamento"},
			{"data":"municipio"},
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
		"dom": dom,
		"columnDefs": [	
		  { width: "21.11%", targets: 0 },
		  { width: "11.11%", targets: 1 },
		  { width: "19.11%", targets: 2 },
		  { width: "11.11%", targets: 3 },
		  { width: "11.11%", targets: 4 },
		  { width: "11.11%", targets: 5 },
		  { width: "11.11%", targets: 6 },
		  { width: "2.11%", targets: 7 },
		  { width: "2.11%", targets: 8 }		  
		],			
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Proveedores',
				className: 'btn btn-info',
				action: 	function(){
					listar_proveedores();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Proveedores',
				className: 'btn btn-primary',
				action: 	function(){
					modal_proveedores();
				}
			},		
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Proveedores',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Proveedores',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_proveedores.search('').draw();
	$('#buscar').focus();
	
	editar_proveedores_dataTable("#dataTableProveedores tbody", table_proveedores);
	eliminar_proveedores_dataTable("#dataTableProveedores tbody", table_proveedores);
}

var editar_proveedores_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarProveedores.php';
		$('#formProveedores #proveedores_id').val(data.proveedores_id);	

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formProveedores').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formProveedores').attr({ 'data-form': 'update' }); 
				$('#formProveedores').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarProveedoresAjax.php' }); 
				$('#formProveedores')[0].reset();
				$('#reg_proveedor').hide();		
				$('#edi_proveedor').show();
				$('#delete_proveedor').hide();	
				$('#formProveedores #nombre_proveedores').val(valores[0]);
				$('#formProveedores #apellido_proveedores').val(valores[1]);
				$('#formProveedores #rtn_proveedores').val(valores[2]);
				$('#formProveedores #fecha_proveedores').attr('disabled', true);
				$('#formProveedores #fecha_proveedores').val(valores[3]);
				$('#formProveedores #departamento_proveedores').val(valores[4]);
				getMunicipiosProveedores(valores[4], valores[5]);			
				$('#formProveedores #dirección_proveedores').val(valores[6]);
				$('#formProveedores #telefono_proveedores').val(valores[7]);	
				$('#formProveedores #correo_proveedores').val(valores[8]);
				
				if(valores[9] == 1){
					$('#formProveedores #proveedores_activo').prop('checked', true);
				}else{
					$('#formProveedores #proveedores_activo').prop('checked', false);					
				}					

				//HABILITAR OBJETOS
				$('#formProveedores #nombre_proveedores').attr("readonly", false);
				$('#formProveedores #apellido_proveedores').attr("readonly", false);
				$('#formProveedores #departamento_proveedores').attr("disabled", false);
				$('#formProveedores #municipio_proveedores').attr("disabled", false);					
				$('#formProveedores #dirección_proveedores').attr("disabled", false);
				$('#formProveedores #telefono_proveedores').attr("readonly", false);
				$('#formProveedores #correo_proveedores').attr("readonly", false);
				$('#formProveedores #proveedores_activo').attr("disabled", false);
				
				//DESHABILITAR OBJETOS
				$('#formProveedores #rtn_proveedores').attr("readonly", true);
				
				$('#formProveedores #proceso_proveedores').val("Editar");				
				$('#modal_registrar_proveedores').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});
			}
		});			
	});
}

var eliminar_proveedores_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");	
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarProveedores.php';		
		$('#formProveedores #proveedores_id').val(data.proveedores_id);			
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formProveedores').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formProveedores').attr({ 'data-form': 'delete' }); 
				$('#formProveedores').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarProveedoresAjax.php' }); 
				$('#formProveedores')[0].reset();
				$('#reg_proveedor').hide();		
				$('#edi_proveedor').hide();
				$('#delete_proveedor').show();	
				$('#formProveedores #nombre_proveedores').val(valores[0]);
				$('#formProveedores #apellido_proveedores').val(valores[1]);
				$('#formProveedores #rtn_proveedores').val(valores[2]);
				$('#formProveedores #fecha_proveedores').attr('disabled', true);
				$('#formProveedores #fecha_proveedores').val(valores[3]);
				$('#formProveedores #departamento_proveedores').val(valores[4]);
				getMunicipiosProveedores(valores[4], valores[5]);			
				$('#formProveedores #dirección_proveedores').val(valores[6]);
				$('#formProveedores #telefono_proveedores').val(valores[7]);	
				$('#formProveedores #correo_proveedores').val(valores[8]);	
				
				if(valores[9] == 1){
					$('#formProveedores #proveedores_activo').prop('checked', true);
				}else{
					$('#formProveedores #proveedores_activo').prop('checked', false);					
				}					

				//DESHABILITAR OBJETOS
				$('#formProveedores #nombre_proveedores').attr("readonly", true);
				$('#formProveedores #apellido_proveedores').attr("readonly", true);
				$('#formProveedores #rtn_proveedores').attr("readonly", true);
				$('#formProveedores #fecha_proveedores').attr("readonly", true);
				$('#formProveedores #departamento_proveedores').attr("disabled", true);
				$('#formProveedores #municipio_proveedores').attr("disabled", true);					
				$('#formProveedores #dirección_proveedores').attr("disabled", true);
				$('#formProveedores #telefono_proveedores').attr("readonly", true);
				$('#formProveedores #correo_proveedores').attr("readonly", true);
				$('#formProveedores #proveedores_activo').attr("disabled", true);
				
				$('#formProveedores #proceso_proveedores').val("Eliminar");				
				$('#modal_registrar_proveedores').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});		
	});
}
//FIN ACCIONES FROMULARIO PROVEEDORES

//INICIO ACCIONES FROMULARIO COLABORADORES
var listar_colaboradores = function(){
	var table_colaboradores  = $("#dataTableColaboradores").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableColaboradores.php"
		},
		"columns":[
			{"data":"colaborador"},
			{"data":"identidad"},
			{"data":"estado"},
			{"data":"telefono"},
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
		"dom": dom,
		"columnDefs": [	
		  { width: "48.66%", targets: 0 },
		  { width: "18.66%", targets: 1 },
		  { width: "8.66%", targets: 2 },
		  { width: "18.66%", targets: 3 },
		  { width: "2.66%", targets: 4 },
		  { width: "2.66%", targets: 5 }		  
		],		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Colaboradores',
				className: 'btn btn-info',
				action: 	function(){
					listar_colaboradores();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Colaboradores',
				className: 'btn btn-primary',
				action: 	function(){
					modal_colaboradores();
				}
			},		
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Colaboradores',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Colaboradores',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_colaboradores.search('').draw();
	$('#buscar').focus();
	
	editar_colaboradores_dataTable("#dataTableColaboradores tbody", table_colaboradores);
	eliminar_colaboradores_dataTable("#dataTableColaboradores tbody", table_colaboradores);
}

var editar_colaboradores_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");		
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarColaboradores.php';		
		$('#formColaboradores #colaborador_id').val(data.colaborador_id);		

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formColaboradores').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formColaboradores').attr({ 'data-form': 'update' }); 
				$('#formColaboradores').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarColaboradorAjax.php' }); 
				$('#formColaboradores')[0].reset();
				$('#reg_colaborador').hide();
				$('#edi_colaborador').show();
				$('#delete_colaborador').hide();		
				$('#formColaboradores #nombre_colaborador').val(valores[0]);
				$('#formColaboradores #apellido_colaborador').val(valores[1]);
				$('#formColaboradores #identidad_colaborador').val(valores[2]);
				$('#formColaboradores #telefono_colaborador').val(valores[3]);
				$('#formColaboradores #puesto_colaborador').val(valores[4]);
				
				if(valores[5] == 1){
					$('#formColaboradores #colaboradores_activo').prop('checked', true);
				}else{
					$('#formColaboradores #colaboradores_activo').prop('checked', false);					
				}					
				
				//HABILITAR OBJETOS
				$('#formColaboradores #nombre_colaborador').attr('readonly', false);
				$('#formColaboradores #apellido_colaborador').attr('readonly', false);
				$('#formColaboradores #identidad_colaborador').attr('readonly', false);
				$('#formColaboradores #telefono_colaborador').attr('readonly', false);
				$('#formColaboradores #puesto_colaborador').attr('disabled', false);
				$('#formColaboradores #estado_colaborador').attr('disabled', false);
				$('#formColaboradores #colaboradores_activo').attr('disabled', false);				
				
				$('#formColaboradores #proceso_colaboradores').val("Editar");	 				
				$('#modal_registrar_colaboradores').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});			
	});
}

var eliminar_colaboradores_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarColaboradores.php';		
		$('#formColaboradores #colaborador_id').val(data.colaborador_id);		
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formColaboradores').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formColaboradores').attr({ 'data-form': 'delete' }); 
				$('#formColaboradores').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarColaboradorAjax.php' }); 
				$('#formColaboradores')[0].reset();
				$('#reg_colaborador').hide();
				$('#edi_colaborador').hide();
				$('#delete_colaborador').show();		
				$('#formColaboradores #nombre_colaborador').val(valores[0]);
				$('#formColaboradores #apellido_colaborador').val(valores[1]);
				$('#formColaboradores #identidad_colaborador').val(valores[2]);
				$('#formColaboradores #telefono_colaborador').val(valores[3]);
				$('#formColaboradores #puesto_colaborador').val(valores[4]);

				if(valores[5] == 1){
					$('#formColaboradores #colaboradores_activo').prop('checked', true);
				}else{
					$('#formColaboradores #colaboradores_activo').prop('checked', false);					
				}	
				
				//DESHABILITAR OBJETOS
				$('#formColaboradores #nombre_colaborador').attr('readonly', true);
				$('#formColaboradores #apellido_colaborador').attr('readonly', true);
				$('#formColaboradores #identidad_colaborador').attr('readonly', true);
				$('#formColaboradores #telefono_colaborador').attr('readonly', true);
				$('#formColaboradores #puesto_colaborador').attr('disabled', true);
				$('#formColaboradores #estado_colaborador').attr('disabled', true);	
				$('#formColaboradores #colaboradores_activo').attr('disabled', true);				
				
				$('#formColaboradores #proceso_colaboradores').val("Eliminar");	 				
				$('#modal_registrar_colaboradores').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});			
	});
}

var listar_colaboradores_buscar = function(){
	var table_colaboradores_buscar = $("#DatatableColaboradoresBusqueda").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableColaboradores.php"
		},
		"columns":[
			{"defaultContent":"<button class='editar btn btn-primary'><span class='fas fa-copy fa-lg'></span></button>"},
			{"data":"colaborador"},
			{"data":"identidad"}	
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_colaboradores_buscar.search('').draw();
	$('#buscar').focus();
	
	editar_colaboradores_busqueda_dataTable("#DatatableColaboradoresBusqueda tbody", table_colaboradores_buscar);
}

var editar_colaboradores_busqueda_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");		
	$(tbody).on("click", "button.editar", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();			
		$('#formUsers #usuarios_colaborador_id').val(data.colaborador_id);
		$('#formUsers #colaborador_id_usuario').val(data.colaborador);
		$('#formUsers #nickname').focus();
		$('#modal_buscar_colaboradores_usuarios').modal('hide');
	});
}
//FIN ACCIONES FROMULARIO COLABORADORES

//INICIO ACCIONES FROMULARIO PUESTOS
var listar_puestos = function(){
	var table_puestos  = $("#dataTablePuestos").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTablePuestos.php"
		},
		"columns":[
			{"data":"puestos_id"},
			{"data":"nombre"},
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,		
		"dom": dom,
		"columnDefs": [	
		  { width: "5%", targets: 0 },
		  { width: "85%", targets: 1 },
		  { width: "5%", targets: 2 },
		  { width: "5%", targets: 3 }		  
		],			
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Puestos',
				className: 'btn btn-info',
				action: 	function(){
					listar_puestos();
				}
			},				
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Puestos',
				className: 'btn btn-primary',
				action: 	function(){
					modal_puestos();
				}
			},		
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Puestos',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Puestos',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_puestos.search('').draw();
	$('#buscar').focus();
	
	editar_puestos_dataTable("#dataTablePuestos tbody", table_puestos);
	eliminar_puestos_dataTable("#dataTablePuestos tbody", table_puestos);
}

var editar_puestos_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");		
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarPuestos.php';
		$('#formPuestos #puestos_id').val(data.puestos_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formPuestos').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formPuestos').attr({ 'data-form': 'update' });
				$('#formPuestos').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarPuestosAjax.php' }); 	  
				$('#formPuestos')[0].reset();
				$('#reg_puestos').hide();
				$('#edi_puestos').show();
				$('#delete_puestos').hide();	
				$('#formPuestos #puesto').val(valores[0]);
				
				if(valores[1] == 1){
					$('#formPuestos #puestos_activo').prop('checked', true);
				}else{
					$('#formPuestos #puestos_activo').prop('checked', false);					
				}					
				
				//HABILITAR OBJETOS
				$('#formPuestos #puesto').attr('readonly', false);
				$('#formPuestos #puestos_activo').attr('disabled', false);
				
				$('#formPuestos #proceso_puestos').val("Editar");	 	
				$('#modal_registrar_puestos').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	 
			}
		});		
	});
}

var eliminar_puestos_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarPuestos.php';
		$('#formPuestos #puestos_id').val(data.puestos_id);			
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formPuestos').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formPuestos').attr({ 'data-form': 'delete' });
				$('#formPuestos').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarPuestosAjax.php' }); 	  
				$('#formPuestos')[0].reset();
				$('#reg_puestos').hide();
				$('#edi_puestos').hide();
				$('#delete_puestos').show();	
				$('#formPuestos #puesto').val(valores[0]);
				
				if(valores[1] == 1){
					$('#formPuestos #puestos_activo').prop('checked', true);
				}else{
					$('#formPuestos #puestos_activo').prop('checked', false);					
				}					
				
				//DESHABILITAR OBJETOS
				$('#formPuestos #puesto').attr('readonly', true);
				$('#formPuestos #puestos_activo').attr('disabled', true);
				
				$('#formPuestos #proceso_puestos').val("Eliminar");	
				$('#modal_registrar_puestos').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});		 
			}
		});						
	});
}
//FIN ACCIONES FROMULARIO PUESTOS

//INICIO ACCIONES FROMULARIO USUARIOS
var listar_usuarios = function(){
	var table_usuarios  = $("#dataTableUsers").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableUsuarios.php"
		},
		"columns":[
			{"data":"colaborador"},
			{"data":"username"},
			{"data":"correo"},
			{"data":"tipo_usuario"},
			{"data":"estado"},
			{"data":"empresa"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
		"dom": dom,
		"columnDefs": [	
		  { width: "32.5%", targets: 0 },
		  { width: "12.5%", targets: 1 },
		  { width: "12.5%", targets: 2 },
		  { width: "12.5%", targets: 3 },
		  { width: "5.5%", targets: 4 },
		  { width: "19.5%", targets: 5 },
		  { width: "2.5%", targets: 6 },
		  { width: "2.5%", targets: 7 }		  
		],			
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Usuarios',
				className: 'btn btn-info',
				action: 	function(){
					listar_usuarios();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Usuarios',
				className: 'btn btn-primary',
				action: 	function(){
					modal_usuarios();
				}
			},		
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Usuarios',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Usuarios',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_usuarios.search('').draw();
	$('#buscar').focus();
	
	editar_usuarios_dataTable("#dataTableUsers tbody", table_usuarios);
	eliminar_usuarios_dataTable("#dataTableUsers tbody", table_usuarios);
}

var editar_usuarios_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");	
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarUsuarios.php';		
		$('#formUsers #usuarios_id').val(data.users_id);		
	
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formUsers').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formUsers').attr({ 'data-form': 'update' });
				$('#formUsers').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarUsersAjax.php' }); 	  
				$('#formUsers')[0].reset();
				$('#reg_usuario').hide();
				$('#edi_usuario').show();
				$('#delete_usuario').hide();		
				$('#formUsers #usuarios_colaborador_id').val(valores[0]);
				$('#formUsers #colaborador_id_usuario').val(valores[1]);
				$('#formUsers #nickname').val(valores[2]);
				$('#formUsers #pass').attr('disabled', true);
				$('#formUsers #correo_usuario').val(valores[3]);
				$('#formUsers #empresa_usuario').val(valores[4]);
				$('#formUsers #tipo_user').val(valores[5]);	
				$('#formUsers #privilegio_id').val(valores[7]);	
				$('#formUsers #buscar_colaboradores').hide();				
				
				if(valores[6] == 1){
					$('#formUsers #usuarios_activo').prop('checked', true);
				}else{
					$('#formUsers #usuarios_activo').prop('checked', false);					
				}					

				//HABILITAR OBJETOS
				$('#formUsers #nickname').attr('readonly', true);
				$('#formUsers #pass').attr('readonly', false);
				$('#formUsers #correo_usuario').attr('readonly', false);
				$('#formUsers #empresa_usuario').attr('disabled', true);
				$('#formUsers #tipo_user').attr('disabled', false);
				$('#formUsers #estado_usuario').attr('disabled', false);
				$('#formUsers #privilegio_id').attr('disabled', false);
				$('#formUsers #usuarios_activo').attr('disabled', false);
				
				$('#formUsers #proceso_usuarios').val("Editar");	
				$('#formUsers #grupo_buscar_colaboradores').attr('disabled', true);
				$('#modal_registrar_usuarios').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});
			}
		});			
	});
}

var eliminar_usuarios_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarUsuarios.php';			
		$('#formUsers #usuarios_id').val(data.users_id);
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formUsers').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formUsers').attr({ 'data-form': 'delete' });
				$('#formUsers').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarUsersAjax.php' }); 	  
				$('#formUsers')[0].reset();
				$('#reg_usuario').hide();
				$('#edi_usuario').hide();
				$('#delete_usuario').show();		
				$('#formUsers #usuarios_colaborador_id').val(valores[0]);
				$('#formUsers #colaborador_id_usuario').val(valores[1]);
				$('#formUsers #nickname').val(valores[2]);
				$('#formUsers #pass').attr('disabled', true);
				$('#formUsers #correo_usuario').val(valores[3]);
				$('#formUsers #empresa_usuario').val(valores[4]);
				$('#formUsers #tipo_user').val(valores[5]);	
				$('#formUsers #privilegio_id').val(valores[7]);	
				
				if(valores[6] == 1){
					$('#formUsers #usuarios_activo').prop('checked', true);
				}else{
					$('#formUsers #usuarios_activo').prop('checked', false);					
				}					

				//DESHABILITAR OBJETOS
				$('#formUsers #nickname').attr('readonly', true);
				$('#formUsers #pass').attr('readonly', true);
				$('#formUsers #correo_usuario').attr('readonly', true);
				$('#formUsers #empresa_usuario').attr('disabled', true);
				$('#formUsers #tipo_user').attr('disabled', true);
				$('#formUsers #estado_usuario').attr('disabled', true);
				$('#formUsers #privilegio_id').attr('disabled', true);
				$('#formUsers #usuarios_activo').attr('disabled', true);
				
				$('#formUsers #proceso_usuarios').val("Eliminar");
				$('#formUsers #grupo_buscar_colaboradores').attr('disabled', true);			
				$('#modal_registrar_usuarios').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});
			}
		});			
	});
}
//FIN ACCIONES FROMULARIO USUARIOS

//INICIO ACCIONES FROMULARIO SECUENCIA FACTURACION
var listar_secuencia_facturacion = function(){
	var table_secuencia_facturacion  = $("#dataTableSecuencia").DataTable({	
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableSecuenciaFacturacion.php"
		},
		"columns":[
			{"data":"empresa"},
			{"data":"cai"},
			{"data":"prefijo"},
			{"data":"siguiente"},
			{"data":"rango_inicial"},
			{"data":"rango_final"},
			{"data":"fecha_limite"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
		"dom": dom,
		"columnDefs": [	
		  { width: "22.11%", targets: 0 },
		  { width: "19.11%", targets: 1 },
		  { width: "10.11%", targets: 2 },
		  { width: "8.11%", targets: 3 },
		  { width: "11.11%", targets: 4 },
		  { width: "11.11%", targets: 5 },
		  { width: "11.11%", targets: 6 },
		  { width: "2.11%", targets: 7 },
		  { width: "2.11%", targets: 8 }	  
		],		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Secuencia de Facturación',
				className: 'btn btn-info',
				action: 	function(){
					listar_secuencia_facturacion();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Secuencia de Facturación',
				className: 'btn btn-primary',
				action: 	function(){
					modal_secuencia_facturacion();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Secuencia de Facturación',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Secuencia de Facturación',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	 
	table_secuencia_facturacion.search('').draw();
	$('#buscar').focus();
	
	editar_secuencia_facturacion_dataTable("#dataTableSecuencia tbody", table_secuencia_facturacion);
	eliminar_secuencia_facturacion_dataTable("#dataTableSecuencia tbody", table_secuencia_facturacion);
}

var editar_secuencia_facturacion_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");	
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarSecuenciaFacturacion.php';			
		$('#formSecuencia #secuencia_facturacion_id').val(data.secuencia_facturacion_id);		
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formSecuencia').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formSecuencia').attr({ 'data-form': 'update' });
				$('#formSecuencia').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarSecuenciaFacturacionAjax.php' }); 	  
				$('#formSecuencia')[0].reset();
				$('#reg_secuencia').hide();
				$('#edi_secuencia').show();		
				$('#delete_secuencia').hide();		
				$('#formSecuencia #empresa_secuencia').val(valores[0]);
				$('#formSecuencia #cai_secuencia').val(valores[1]);
				$('#formSecuencia #prefijo_secuencia').val(valores[2]);
				$('#formSecuencia #relleno_secuencia').val(valores[3]);
				$('#formSecuencia #incremento_secuencia').val(valores[4]);
				$('#formSecuencia #siguiente_secuencia').val(valores[5]);
				$('#formSecuencia #rango_inicial_secuencia').val(valores[6]);
				$('#formSecuencia #rango_final_secuencia').val(valores[7]);
				$('#formSecuencia #fecha_activacion_secuencia').val(valores[8]);
				$('#formSecuencia #fecha_limite_secuencia').val(valores[9]);
				
				if(valores[10] == 1){
					$('#formSecuencia #estado_secuencia').prop('checked', true);
				}else{
					$('#formSecuencia #estado_secuencia').prop('checked', false);					
				}					
				
				//HABILITAR OBJETOS
				$('#formSecuencia #empresa_secuencia').attr('disabled', false);
				$('#formSecuencia #cai_secuencia').attr('readonly', false);
				$('#formSecuencia #prefijo_secuencia').attr('readonly', false);
				$('#formSecuencia #relleno_secuencia').attr('readonly', false);
				$('#formSecuencia #incremento_secuencia').attr('readonly', false);
				$('#formSecuencia #siguiente_secuencia').attr('readonly', false);
				$('#formSecuencia #rango_inicial_secuencia').attr('readonly', false);
				$('#formSecuencia #rango_final_secuencia').attr('readonly', false);
				$('#formSecuencia #fecha_activacion_secuencia').attr('readonly', false);
				$('#formSecuencia #fecha_limite_secuencia').attr('readonly', false);
				$('#formSecuencia #estado_secuencia').attr('disabled', false);	
				
				$('#formSecuencia #empresa_secuencia').attr('disabled', true);				
				$('#formSecuencia #proceso_secuencia_facturacion').val("Editar");		
				$('#modal_registrar_secuencias').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});			
	});
}

var eliminar_secuencia_facturacion_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarSecuenciaFacturacion.php';			
		$('#formSecuencia #secuencia_facturacion_id').val(data.secuencia_facturacion_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formSecuencia').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formSecuencia').attr({ 'data-form': 'delete' });
				$('#formSecuencia').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarSecuenciaFacturacionAjax.php' }); 	  
				$('#formSecuencia')[0].reset();
				$('#edi_secuencia').hide();
				$('#reg_secuencia').hide();
				$('#delete_secuencia').show();			
				$('#formSecuencia #empresa_secuencia').val(valores[0]);
				$('#formSecuencia #cai_secuencia').val(valores[1]);
				$('#formSecuencia #prefijo_secuencia').val(valores[2]);
				$('#formSecuencia #relleno_secuencia').val(valores[3]);
				$('#formSecuencia #incremento_secuencia').val(valores[4]);
				$('#formSecuencia #siguiente_secuencia').val(valores[5]);
				$('#formSecuencia #rango_inicial_secuencia').val(valores[6]);
				$('#formSecuencia #rango_final_secuencia').val(valores[7]);
				$('#formSecuencia #fecha_activacion_secuencia').val(valores[8]);
				$('#formSecuencia #fecha_limite_secuencia').val(valores[9]);

				if(valores[10] == 1){
					$('#formSecuencia #estado_secuencia').prop('checked', true);
				}else{
					$('#formSecuencia #estado_secuencia').prop('checked', false);					
				}
				
				//DESHABILITAR OBJETOS
				$('#formSecuencia #empresa_secuencia').attr('disabled', true);
				$('#formSecuencia #cai_secuencia').attr('readonly', true);
				$('#formSecuencia #prefijo_secuencia').attr('readonly', true);
				$('#formSecuencia #relleno_secuencia').attr('readonly', true);
				$('#formSecuencia #incremento_secuencia').attr('readonly', true);
				$('#formSecuencia #siguiente_secuencia').attr('readonly', true);
				$('#formSecuencia #rango_inicial_secuencia').attr('readonly', true);
				$('#formSecuencia #rango_final_secuencia').attr('readonly', true);
				$('#formSecuencia #fecha_activacion_secuencia').attr('readonly', true);
				$('#formSecuencia #fecha_limite_secuencia').attr('readonly', true);
				$('#formSecuencia #estado_secuencia').attr('disabled', true);				
				
				$('#formSecuencia #empresa_secuencia').attr('disabled', true);
				$('#formSecuencia #proceso_secuencia_facturacion').val("Eliminar");			
				$('#modal_registrar_secuencias').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});					
			}
		});			
	});
}
//FIN ACCIONES FROMULARIO SECUENCIA FACTURACION

//INICIO ACCIONES FROMULARIO EMPRESA
var listar_empresa = function(){
	var table_empresa  = $("#dataTableEmpresa").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableEmpresa.php"
		},
		"columns":[
			{"data":"nombre"},
			{"data":"telefono"},
			{"data":"correo"},
			{"data":"rtn"},
			{"data":"ubicacion"},		
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,		
		"dom": dom,
		"columnDefs": [	
		  { width: "33.28", targets: 0 },
		  { width: "12.28%", targets: 1 },
		  { width: "15.28%", targets: 2 },
		  { width: "10.28%", targets: 3 },
		  { width: "24.28%", targets: 4 },
		  { width: "2.28%", targets: 5 },
		  { width: "2.28%", targets: 6 }		  
		],			
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Empresa',
				className: 'btn btn-info',
				action: 	function(){
					listar_empresa();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Empresa',
				className: 'btn btn-primary',
				action: 	function(){
					modal_empresa();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Empresa',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Empresa',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	 
	table_empresa.search('').draw();
	$('#buscar').focus();
	
	editar_empresa_dataTable("#dataTableEmpresa tbody", table_empresa);
	eliminar_empresa_dataTable("#dataTableEmpresa tbody", table_empresa);
}

var editar_empresa_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");	
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarEmpresa.php';			
		$('#formEmpresa #empresa_id').val(data.empresa_id);		

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formEmpresa').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formEmpresa').attr({ 'data-form': 'update' });
				$('#formEmpresa').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarEmpreasAjax.php' }); 	  
				$('#formEmpresa')[0].reset();
				$('#reg_empresa').hide();
				$('#edi_empresa').show();	
				$('#delete_empresa').hide();		
				$('#formEmpresa #empresa_empresa').val(valores[0]);
				$('#formEmpresa #telefono_empresa').val(valores[1]);
				$('#formEmpresa #correo_empresa').val(valores[2]);
				$('#formEmpresa #rtn_empresa').val(valores[3]);				
				$('#formEmpresa #direccion_empresa').val(valores[4]);
				$('#formEmpresa #empresa_razon_social').val(valores[6]);
				$('#formEmpresa #empresa_otra_informacion').val(valores[7]);
				$('#formEmpresa #empresa_eslogan').val(valores[8]);
				$('#formEmpresa #empresa_celular').val(valores[9]);			
				
				if(valores[5] == 1){
					$('#formEmpresa #empresa_activo').prop('checked', true);
				}else{
					$('#formEmpresa #empresa_activo').prop('checked', false);					
				}				

				//HABILITAR OBJETOS
				$('#formEmpresa #empresa_empresa').attr('readonly', false);
				$('#formEmpresa #rtn_empresa').attr('readonly', false);
				$('#formEmpresa #telefono_empresa').attr('readonly', false);
				$('#formEmpresa #correo_empresa').attr('readonly', false);
				$('#formEmpresa #direccion_empresa').attr('readonly', false);
				$('#formEmpresa #empresa_activo').attr('disabled', false);
				$('#formEmpresa #empresa_razon_social').attr('readonly', false);
				$('#formEmpresa #empresa_otra_informacion').attr('readonly', false);
				$('#formEmpresa #empresa_eslogan').attr('disabled', false);	
				$('#formEmpresa #empresa_celular').attr('disabled', false);					
				
				$('#formEmpresa #proceso_empresa').val("Editar");		
				$('#modal_registrar_empresa').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});			
	});
}

var eliminar_empresa_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarEmpresa.php';		
		$('#formEmpresa #empresa_id').val(data.empresa_id);		
				
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formEmpresa').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formEmpresa').attr({ 'data-form': 'delete' });
				$('#formEmpresa').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarEmpresaAjax.php' }); 	  
				$('#formEmpresa')[0].reset();
				$('#reg_empresa').hide();
				$('#edi_empresa').hide();	
				$('#delete_empresa').show();		
				$('#formEmpresa #empresa_empresa').val(valores[0]);
				$('#formEmpresa #rtn_empresa').val(valores[1]);
				$('#formEmpresa #telefono_empresa').val(valores[2]);
				$('#formEmpresa #correo_empresa').val(valores[3]);
				$('#formEmpresa #direccion_empresa').val(valores[4]);
				$('#formEmpresa #empresa_razon_social').val(valores[6]);
				$('#formEmpresa #empresa_otra_informacion').val(valores[7]);
				$('#formEmpresa #empresa_eslogan').val(valores[8]);
				$('#formEmpresa #empresa_celular').val(valores[9]);					
				
				if(valores[5] == 1){
					$('#formEmpresa #empresa_activo').prop('checked', true);
				}else{
					$('#formEmpresa #empresa_activo').prop('checked', false);					
				}					

				//DESHABILITAR OBJETOS
				$('#formEmpresa #empresa_empresa').attr('readonly', true);
				$('#formEmpresa #rtn_empresa').attr('readonly', true);
				$('#formEmpresa #telefono_empresa').attr('readonly', true);
				$('#formEmpresa #correo_empresa').attr('readonly', true);
				$('#formEmpresa #direccion_empresa').attr('readonly', true);
				$('#formEmpresa #empresa_activo').attr('disabled', true);
				$('#formEmpresa #empresa_razon_social').attr('readonly', true);
				$('#formEmpresa #empresa_otra_informacion').attr('readonly', true);
				$('#formEmpresa #empresa_eslogan').attr('disabled', true);	
				$('#formEmpresa #empresa_celular').attr('disabled', true);					
				
				$('#formEmpresa #proceso_empresa').val("Eliminar");		
				$('#modal_registrar_empresa').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	

			}
		});			
	});
}
//FIN ACCIONES FROMULARIO EMPRESA

//INICIO ACCIONES FROMULARIO PRIVILEGIOS
var listar_privilegio = function(){
	var table_privilegio  = $("#dataTablePrivilegio").DataTable({	
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTablePrivilegio.php"
		},
		"columns":[
			{"data":"nombre"},		
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,		
		"dom": dom,	
		"columnDefs": [	
		  { width: "89.33%", targets: 0 },
		  { width: "5.33%", targets: 1 },
		  { width: "5.33%", targets: 2 }  
		],			
		"buttons":[			
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Privilegios',
				className: 'btn btn-info',
				action: 	function(){
					listar_privilegio();
				}
			},				
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Privilegios',
				className: 'btn btn-primary',
				action: 	function(){
					modal_privilegios();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Privilegios',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Privilegios',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	 
	table_privilegio.search('').draw();
	$('#buscar').focus();
	
	editar_privilegio_dataTable("#dataTablePrivilegio tbody", table_privilegio);
	eliminar_privilegio_dataTable("#dataTablePrivilegio tbody", table_privilegio);
}

var editar_privilegio_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");	
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarPrivilegios.php';
		$('#formPrivilegios #privilegio_id_').val(data.privilegio_id);
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formPrivilegios').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formPrivilegios').attr({ 'data-form': 'update' });
				$('#formPrivilegios').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarPrivilegioAjax.php' }); 	  
				$('#formPrivilegios')[0].reset();
				$('#reg_privilegios').hide();
				$('#edi_privilegios').show();
				$('#delete_privilegios').hide();	
				$('#formPrivilegios #privilegios_nombre').val(valores[0]);
				
				if(valores[1] == 1){
					$('#formPrivilegios #privilegio_activo').prop('checked', true);
				}else{
					$('#formPrivilegios #privilegio_activo').prop('checked', false);					
				}					

				//HABILITAR OBJETOS
				$('#formPrivilegios #privilegios_nombre').attr('readonly', false);
				$('#formPrivilegios #privilegio_activo').attr('disabled', false);
				
				$('#formPrivilegios #proceso_privilegios').val("Editar");		
				$('#modal_registrar_privilegios').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});		 
			}
		});			
	});
}

var eliminar_privilegio_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarPrivilegios.php';
		$('#formPrivilegios #privilegio_id_').val(data.privilegio_id);

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formPrivilegios').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formPrivilegios').attr({ 'data-form': 'delete' });
				$('#formPrivilegios').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarPrivilegioAjax.php' }); 	  
				$('#formPrivilegios')[0].reset();
				$('#reg_privilegios').hide();
				$('#edi_privilegios').hide();
				$('#delete_privilegios').show();
				$('#formPrivilegios #privilegios_nombre').val(valores[0]);

				if(valores[1] == 1){
					$('#formPrivilegios #privilegio_activo').prop('checked', true);
				}else{
					$('#formPrivilegios #privilegio_activo').prop('checked', false);					
				}					

				//DESHABIITAR OBJETOS
				$('#formPrivilegios #privilegios_nombre').attr('readonly', true);
				$('#formPrivilegios #privilegio_activo').attr('disabled', true);
				
				$('#formPrivilegios #proceso_privilegios').val("Eliminar");				
				$('#modal_registrar_privilegios').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});		 
			}
		});			
	});
}
//FIN ACCIONES FROMULARIO PRIVILEGIOS

//INICIO ACCIONES FROMULARIO TIPO USUARIO
var listar_tipo_usuario = function(){
	var table_tipo_usuario  = $("#dataTableTipoUser").DataTable({	
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableTipoUsuario.php"
		},
		"columns":[
			{"data":"nombre"},		
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
		"dom": dom,	
		"columnDefs": [	
		  { width: "89.33%", targets: 0 },
		  { width: "5.33%", targets: 1 },
		  { width: "5.33%", targets: 2 }  
		],			
		"buttons":[			
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Tipos de Usuario',
				className: 'btn btn-info',
				action: 	function(){
					listar_tipo_usuario();
				}
			},			
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Tipos de Usuario',
				className: 'btn btn-primary',
				action: 	function(){
					modal_tipo_usuarios();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Tipos de Usuario',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Tipos de Usuario',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	 
	table_tipo_usuario.search('').draw();
	$('#buscar').focus();
	
	editar_tipo_usaurio_dataTable("#dataTableTipoUser tbody", table_tipo_usuario);
	eliminar_tipo_usaurio_dataTable("#dataTableTipoUser tbody", table_tipo_usuario);
}

var editar_tipo_usaurio_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");	
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarTipoUsuario.php';
		$('#formTipoUsuario #tipo_user_id').val(data.tipo_user_id);
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formTipoUsuario').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formTipoUsuario').attr({ 'data-form': 'update' });
				$('#formTipoUsuario').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarTipoUsuarioAjax.php' }); 	  
				$('#formTipoUsuario')[0].reset();
				$('#reg_tipo_usuario').hide();
				$('#edi_tipo_usuario').show();
				$('#delete_tipo_usuario').hide();	
				$('#formTipoUsuario #tipo_usuario_nombre').val(valores[0]);

				if(valores[1] == 1){
					$('#formTipoUsuario #tipo_usuario_activo').prop('checked', true);
				}else{
					$('#formTipoUsuario #tipo_usuario_activo').prop('checked', false);					
				}	
				
				//HABILITAR OBJETOS
				$('#formTipoUsuario #tipo_usuario_nombre').attr('readonly', false);
				$('#formTipoUsuario #tipo_usuario_activo').attr('disabled', false);
				
				$('#formTipoUsuario #proceso_tipo_usuario').val("Editar");		
				$('#modal_registrar_tipoUsuario').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});		 
			}
		});			
	});
}

var eliminar_tipo_usaurio_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarTipoUsuario.php';
		$('#formTipoUsuario #tipo_user_id').val(data.tipo_user_id);

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formTipoUsuario').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formTipoUsuario').attr({ 'data-form': 'delete' });
				$('#formTipoUsuario').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarTipoUsuarioAjax.php' }); 	  
				$('#formTipoUsuario')[0].reset();
				$('#reg_tipo_usuario').hide();
				$('#edi_tipo_usuario').hide();
				$('#delete_tipo_usuario').show();
				$('#formTipoUsuario #tipo_usuario_nombre').val(valores[0]);
				
				if(valores[1] == 1){
					$('#formTipoUsuario #tipo_usuario_activo').prop('checked', true);
				}else{
					$('#formTipoUsuario #tipo_usuario_activo').prop('checked', false);					
				}					

				//DESHABIITAR OBJETOS
				$('#formTipoUsuario #tipo_usuario_nombre').attr('readonly', true);
				$('#formTipoUsuario #tipo_usuario_activo').attr('disabled', true);
				
				$('#formTipoUsuario #proceso_tipo_usuario').val("Eliminar");				
				$('#modal_registrar_tipoUsuario').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});		 
			}
		});			
	});
}
//FIN ACCIONES FROMULARIO TIPO USUARIO

$(document).ready(function() {
	$('#formProductos #categoria').on('change',function(){
		evaluarCategoria();
	});	
});	

function evaluarCategoria(){
	if($('#formProductos #categoria').find('option:selected').text() == "Servicio"){
		$('#formProductos #cantidad').attr('readonly', true);
		$('#formProductos #precio_compra').attr('readonly', true);
		$('#formProductos #precio_venta').attr('readonly', false);		
		$('#formProductos #cantidad_minima').attr('readonly', true);
		$('#formProductos #cantidad_maxima').attr('readonly', true);
		$('#formProductos #isv_si').prop('checked', false);
		$('#formProductos #isv_no').prop('checked', true);
		$('#formProductos #cantidad').val(1);
		$('#formProductos #precio_compra').val(0);
	}else if($('#formProductos #categoria').find('option:selected').text() == "Insumos"){
		$('#formProductos #cantidad').attr('readonly', false);
		$('#formProductos #precio_compra').attr('readonly', false);
		$('#formProductos #precio_venta').attr('readonly', true);
		$('#formProductos #cantidad_minima').attr('readonly', false);
		$('#formProductos #cantidad_maxima').attr('readonly', false);
		$('#formProductos #cantidad').val(1);
		$('#formProductos #precio_venta').val(0);
		$('#formProductos #isv_si').prop('checked', true);
		$('#formProductos #isv_no').prop('checked', false);		
	}else{
		$('#formProductos #cantidad').attr('readonly', false);
		$('#formProductos #precio_compra').attr('readonly', false);
		$('#formProductos #precio_venta').attr('readonly', false);		
		$('#formProductos #cantidad_minima').attr('readonly', false);
		$('#formProductos #cantidad_maxima').attr('readonly', false);
		$('#formProductos #isv_si').prop('checked', true);
		$('#formProductos #isv_no').prop('checked', false);				
		$('#formProductos #cantidad').val('');
		$('#formProductos #precio_compra').val('');			
	}	
}

function evaluarCategoriaDetalle(categoria){
	if(categoria == "Servicio"){
		$('#formProductos #cantidad').attr('readonly', true);
		$('#formProductos #precio_compra').attr('readonly', true);
		$('#formProductos #precio_venta').attr('readonly', false);		
		$('#formProductos #cantidad_minima').attr('readonly', true);
		$('#formProductos #cantidad_maxima').attr('readonly', true);
		$('#formProductos #isv_si').prop('checked', false);
		$('#formProductos #isv_no').prop('checked', true);
		$('#formProductos #cantidad').val(1);
		$('#formProductos #precio_compra').val(0);
	}else if(categoria == "Insumos"){
		$('#formProductos #cantidad').attr('readonly', false);
		$('#formProductos #precio_compra').attr('readonly', false);
		$('#formProductos #precio_venta').attr('readonly', true);
		$('#formProductos #cantidad_minima').attr('readonly', false);
		$('#formProductos #cantidad_maxima').attr('readonly', false);					
		$('#formProductos #concentracion').val("");
		$('#formProductos #cantidad').val(1);
		$('#formProductos #precio_venta').val(0);
		$('#formProductos #isv_si').prop('checked', true);
		$('#formProductos #isv_no').prop('checked', false);		
	}else{
		$('#formProductos #cantidad').attr('readonly', false);
		$('#formProductos #precio_compra').attr('readonly', false);
		$('#formProductos #precio_venta').attr('readonly', false);		
		$('#formProductos #cantidad_minima').attr('readonly', false);
		$('#formProductos #cantidad_maxima').attr('readonly', false);
		$('#formProductos #isv_si').prop('checked', true);
		$('#formProductos #isv_no').prop('checked', false);		
		$('#formProductos #cantidad').val('');
		$('#formProductos #precio_compra').val('');			
	}	
}

//INICIO ACCIONES FROMULARIO PRODUCTOS
var listar_productos = function(){
	var table_productos  = $("#dataTableProductos").DataTable({	
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableProductos.php"
		},
		"columns":[
			{"data":"nombre"},
			{"data":"cantidad"},
			{"data":"medida"},
			{"data":"categoria"},
			{"data":"precio_compra"},
			{"data":"precio_venta"},
			{"data":"impuesto_venta"},			
			{"data":"almacen"},
			{"data":"ubicacion"},			
			{"data":"empresa"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit fa-lg'></span></button>"},
			{"defaultContent":"<button class='eliminar btn btn-danger'><span class='fa fa-trash fa-lg'></span></button>"}			
		],
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
		"dom": dom,			
		"buttons":[			
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Productos',
				className: 'btn btn-info',
				action: 	function(){
					listar_productos();
				}
			},
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Productos',
				className: 'btn btn-primary',
				action: 	function(){
					modal_productos();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Productos',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Productos',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	 
	table_productos.search('').draw();
	$('#buscar').focus();
	
	editar_producto_dataTable("#dataTableProductos tbody", table_productos);
	eliminar_producto_dataTable("#dataTableProductos tbody", table_productos);
}

var editar_producto_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");	
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarProductos.php';
		$('#formProductos #productos_id').val(data.productos_id);
		
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formProductos').serialize(),
			success: function(registro){
				var datos = eval(registro);	  	  
				$('#formProductos').attr({ 'data-form': 'update' });
				$('#formProductos').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarProductosAjax.php' }); 	  
				$('#formProductos')[0].reset();
				$('#reg_producto').hide();
				$('#edi_producto').show();
				$('#delete_producto').hide();
				$('#formProductos #proceso_productos').val("Editar");
				$('#formProductos #medida').val(datos[0]);
				$('#formProductos #almacen').val(datos[1]);
				$('#formProductos #producto').val(datos[2]);	
				$('#formProductos #descripcion').val(datos[3]);					
				$('#formProductos #cantidad').val(datos[4]);
				$('#formProductos #precio_compra').val(datos[5]);
				$('#formProductos #precio_venta').val(datos[6]);
				$('#formProductos #categoria').val(datos[7]);

				if(datos[8] == 1){
					$('#formProductos #isv_si').prop('checked', true);
					$('#formProductos #isv_no').prop('checked', false);
				}else{
					$('#formProductos #isv_si').prop('checked', false);
					$('#formProductos #isv_no').prop('checked', true);					
				}
				
				if(datos[9] == 1){
					$('#formProductos #isv_compra_si').prop('checked', true);
					$('#formProductos #isv_compra_no').prop('checked', false);
				}else{
					$('#formProductos #isv_compra_si').prop('checked', false);
					$('#formProductos #isv_compra_no').prop('checked', true);					
				}				
				
				if(datos[10] == 1){
					$('#formProductos #producto_activo').prop('checked', true);
				}else{
					$('#formProductos #producto_activo').prop('checked', false);					
				}				

				evaluarCategoriaDetalle(datos[7]);
				//HABILITAR OBJETOS
				$('#formProductos #producto').attr("readonly", false);							
				$('#formProductos #cantidad').attr("readonly", true);
				$('#formProductos #precio_compra').attr("readonly", false);
				$('#formProductos #precio_venta').attr("readonly", false);
				$('#formProductos #descripcion').attr("readonly", false);
				$('#formProductos #cantidad_minima').attr("readonly", false);
				$('#formProductos #cantidad_maxima').attr("readonly", false);	
				$('#formProductos #isv_si').attr("disabled", false);
				$('#formProductos #isv_no').attr("disabled", false);				
				$('#formProductos #isv_compra_si').attr("disabled", false);
				$('#formProductos #isv_compra_no').attr("disabled", false);				

				//DESHABILITAR OBJETOS
				$('#formProductos #medida').attr("disabled", true);
				$('#formProductos #almacen').attr("disabled", true);
				$('#formProductos #categoria').attr("disabled", true);
				
				$('#modal_registrar_productos').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				}); 
			}
		});			
	});
}

var eliminar_producto_dataTable = function(tbody, table){
	$(tbody).off("click", "button.eliminar");		
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarProductos.php';
		$('#formProductos #productos_id').val(data.productos_id);

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formProductos').serialize(),
			success: function(registro){
				var datos = eval(registro); 
				$('#formProductos').attr({ 'data-form': 'delete' });
				$('#formProductos').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarProductosAjax.php' }); 	  
				$('#formProductos')[0].reset();
				$('#reg_producto').hide();
				$('#edi_producto').hide();
				$('#delete_producto').show();
				$('#formProductos #proceso_productos').val("Eliminar");	
				$('#formProductos #medida').val(datos[0]);
				$('#formProductos #almacen').val(datos[1]);
				$('#formProductos #producto').val(datos[2]);	
				$('#formProductos #descripcion').val(datos[3]);					
				$('#formProductos #cantidad').val(datos[4]);
				$('#formProductos #precio_compra').val(datos[5]);
				$('#formProductos #precio_venta').val(datos[6]);
				$('#formProductos #categoria').val(datos[7]);
				
				if(datos[8] == 1){
					$('#formProductos #isv_si').prop('checked', true);
					$('#formProductos #isv_no').prop('checked', false);
				}else{
					$('#formProductos #isv_si').prop('checked', false);
					$('#formProductos #isv_no').prop('checked', true);					
				}
				
				if(datos[9] == 1){
					$('#formProductos #isv_compra_si').prop('checked', true);
					$('#formProductos #isv_compra_no').prop('checked', false);
				}else{
					$('#formProductos #isv_compra_si').prop('checked', false);
					$('#formProductos #isv_compra_no').prop('checked', true);					
				}				
				
				if(datos[10] == 1){
					$('#formProductos #producto_activo').prop('checked', true);
				}else{
					$('#formProductos #producto_activo').prop('checked', false);					
				}					

				//DESHABILITAR OBJETOS
				$('#formProductos #producto').attr("readonly", true);
				$('#formProductos #medida').attr("disabled", true);
				$('#formProductos #almacen').attr("disabled", true);				
				$('#formProductos #cantidad').attr("readonly", true);
				$('#formProductos #precio_compra').attr("readonly", true);
				$('#formProductos #precio_venta').attr("readonly", true);
				$('#formProductos #descripcion').attr("readonly", true);
				$('#formProductos #cantidad_minima').attr("readonly", true);
				$('#formProductos #cantidad_maxima').attr("readonly", true);
				$('#formProductos #categoria').attr("disabled", true);
				$('#formProductos #producto_activo').attr("disabled", true);
				$('#formProductos #isv_si').attr("disabled", true);
				$('#formProductos #isv_no').attr("disabled", true);				
				$('#formProductos #isv_compra_si').attr("disabled", true);
				$('#formProductos #isv_compra_no').attr("disabled", true);
				
				$('#modal_registrar_productos').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				}); 	 
			}
		});			
	});
}

var listar_movimientos = function(){
	var categoria;
	
	if ($('#form_main_movimientos #categoria_id').val() == "" || $('#form_main_movimientos #categoria_id').val() == null){
	  categoria = 1;	
	}else{
	  categoria = $('#form_main_movimientos #categoria_id').val();
	}	

	var fechai = $("#form_main_movimientos #fechai").val();
	var fechaf = $("#form_main_movimientos #fechaf").val();
	
	var table_movimientos  = $("#dataTablaMovimientos").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableMovimientos.php",
			"data":{
				"categoria":categoria,
				"fechai":fechai,
				"fechaf":fechaf				
			}			
		},		
		"columns":[
			{"data":"fecha_registro"},
			{"data":"producto"},
			{"data":"medida"},	
			{"data":"documento"},				
			{"data":"entrada"},
			{"data":"salida"},
			{"data":"saldo"}
		],		
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,	
		"columnDefs": [	
		  { width: "14.28%", targets: 0 },
		  { width: "28.28%", targets: 1 },
		  { width: "7.28%", targets: 2 },
		  { width: "20.28%", targets: 3 },
		  { width: "10.28%", targets: 4 },
		  { width: "10.28%", targets: 5 },
		  { width: "10.28%", targets: 6 }	  
		],			
		"buttons":[			
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Movimientos',
				className: 'btn btn-info',
				action: 	function(){
					listar_movimientos();
				}
			},
			{
				text:      '<i class="fas fas fa-plus fa-lg"></i> Crear',
				titleAttr: 'Agregar Movimientos',
				className: 'btn btn-primary',
				action: 	function(){
					modal_movimientos();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Movimientos',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Movimientos',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_movimientos.search('').draw();
	$('#buscar').focus();
}

var listar_repote_ventas = function(){
	var fechai = $("#form_main_ventas #fechai").val();
	var fechaf = $("#form_main_ventas #fechaf").val();
	
	var table_reporte_ventas  = $("#dataTablaReporteVentas").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableReporteVentas.php",
			"data":{
				"fechai":fechai,
				"fechaf":fechaf				
			}			
		},		
		"columns":[
		    {"defaultContent":"<button class='print_factura btn btn-dark'><span class='fas fa-print fa-lg'></span></button>"},
			{"data":"fecha"},
			{"data":"cliente"},	
			{"data":"numero"},				
			{"data":"total"},
		],		
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,	
		"columnDefs": [	
		  { width: "2%", targets: 0 },
		  { width: "20%", targets: 1 },
		  { width: "38%", targets: 2 },
		  { width: "20%", targets: 3 },
		  { width: "20%", targets: 4 }
		],			
		"buttons":[			
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Reporte de Ventas',
				className: 'btn btn-info',
				action: 	function(){
					listar_repote_ventas();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Ventas',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Ventas',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_reporte_ventas.search('').draw();
	$('#buscar').focus();
	
	view_reporte_facturas_dataTable("#dataTablaReporteVentas tbody", table_reporte_ventas);
}

var view_reporte_facturas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.print_factura");		
	$(tbody).on("click", "button.print_factura", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
			swal({
				title: "Error", 
				text: "Opción no disponible por los momentos",
				type: "warning", 
				confirmButtonClass: 'btn-warning'
			});	
	});
}

var listar_repote_compras = function(){
	var fechai = $("#form_main_compras #fechai").val();
	var fechaf = $("#form_main_compras #fechaf").val();
	
	var table_reporte_compras  = $("#dataTablaReporteCompras").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableReporteCompras.php",
			"data":{
				"fechai":fechai,
				"fechaf":fechaf				
			}			
		},		
		"columns":[
		    {"defaultContent":"<button class='print_compras btn btn-dark'><span class='fas fa-print fa-lg'></span></button>"},
			{"data":"fecha"},
			{"data":"proveedor"},	
			{"data":"numero"},				
			{"data":"total"},
		],		
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,	
		"columnDefs": [	
		  { width: "2%", targets: 0 },
		  { width: "20%", targets: 1 },
		  { width: "38%", targets: 2 },
		  { width: "20%", targets: 3 },
		  { width: "20%", targets: 4 }
		],			
		"buttons":[			
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Reporte de Compras',
				className: 'btn btn-info',
				action: 	function(){
					listar_repote_ventas();
				}
			},			
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte de Compras',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte de Compras',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_reporte_compras.search('').draw();
	$('#buscar').focus();
	view_reporte_compras_dataTable("#dataTablaReporteCompras tbody", table_reporte_compras);
}

var view_reporte_compras_dataTable = function(tbody, table){
	$(tbody).off("click", "button.print_compras");		
	$(tbody).on("click", "button.print_compras", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
			swal({
				title: "Error", 
				text: "Opción no disponible por los momentos",
				type: "warning", 
				confirmButtonClass: 'btn-warning'
			});	
	});
}

var listar_almacen = function(){
	var table_almacen  = $("#dataTableConfAlmacen").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>core/llenarDataTableAlmacen.php"
		},		
		"columns":[
			{"data":"almacen"},
			{"data":"ubicacion"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit'></span></button>"},
			{"defaultContent":"<button class='delete btn btn-danger'><span class='fa fa-trash'></span></button>"}
		],		
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,			
		"buttons":[		
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Almacén',
				className: 'btn btn-info',
				action: 	function(){
					listar_almacen();
				}
			},		
			{
				text:      '<i class="fab fas fa-warehouse fa-lg"></i> Crear',
				titleAttr: 'Agregar Almacén',
				className: 'btn btn-primary',
				action: 	function(){
					modalAlmacen();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Almacén',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Almacén',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,//esta se encuenta en el archivo main.js
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_almacen.search('').draw();
	$('#buscar').focus();
	
	edit_alamcen_dataTable("#dataTableConfAlmacen tbody", table_almacen);
	delete_almacen_dataTable("#dataTableConfAlmacen tbody", table_almacen);
}

var edit_alamcen_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");		
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarAlmacen.php';
		$('#formAlmacen #almacen_id').val(data.almacen_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formAlmacen').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formAlmacen').attr({ 'data-form': 'update' });
				$('#formAlmacen').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarAlmacenAjax.php' }); 	  
				$('#formAlmacen')[0].reset();
				$('#reg_almacen').hide();
				$('#edi_almacen').show();
				$('#delete_almacen').hide();	
				$('#formAlmacen #pro_almacen').val("Editar");
				$('#formAlmacen #ubicacion_almacen').val(valores[0]);				
				$('#formAlmacen #almacen_almacen').val(valores[1]);
				
				if(valores[2] == 1){
					$('#formAlmacen #almacen_activo').prop('checked', true);
				}else{
					$('#formAlmacen #almacen_activo').prop('checked', false);					
				}					
				
				//HABILITAR OBJETOS
				$('#formAlmacen #almacen_almacen').attr('readonly', false);
				$('#formAlmacen #ubicacion_almacen').attr('disabled', false);
				$('#formAlmacen #almacen_activo').attr('disabled', false);
				
				//DESHABILITAR OBJETO
				$('#formAlmacen #ubicacion_almacen').attr('disabled', true);
				
				$('#formAlmacen #pro_ubicacion').val("Editar");	 	
				$('#modal_almacen').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	 
			}
		});		
	});
}

var delete_almacen_dataTable = function(tbody, table){
	$(tbody).off("click", "button.delete");		
	$(tbody).on("click", "button.delete", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarAlmacen.php';
		$('#formAlmacen #almacen_id').val(data.almacen_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formAlmacen').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formAlmacen').attr({ 'data-form': 'update' });
				$('#formAlmacen').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarAlmacenAjax.php' }); 	  
				$('#formAlmacen')[0].reset();
				$('#reg_almacen').hide();
				$('#edi_almacen').hide();
				$('#delete_almacen').show();	
				$('#formAlmacen #pro_almacen').val("Eliminar");
				$('#formAlmacen #ubicacion_almacen').val(valores[0]);				
				$('#formAlmacen #almacen_almacen').val(valores[1]);
				
				if(valores[2] == 1){
					$('#formAlmacen #almacen_activo').prop('checked', true);
				}else{
					$('#formAlmacen #almacen_activo').prop('checked', false);					
				}					
				
				//DESHABIITAR OBJETOS
				$('#formAlmacen #almacen_almacen').attr('readonly', true);
				$('#formAlmacen #ubicacion_almacen').attr('disabled', true);
				$('#formAlmacen #almacen_activo').attr('disabled', true);
				
				$('#formAlmacen #pro_ubicacion').val("Editar");	 	
				$('#modal_almacen').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	  
			}
		});		
	});
}

var listar_ubicacion = function(){
	var table_ubicacion  = $("#dataTableConfUbicacion").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>core/llenarDataTableUbicacion.php"
		},		
		"columns":[
			{"data":"ubicacion"},
			{"data":"empresa"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit'></span></button>"},
			{"defaultContent":"<button class='delete btn btn-danger'><span class='fa fa-trash'></span></button>"}
		],		
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,			
		"buttons":[		
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Ubicación',
				className: 'btn btn-info',
				action: 	function(){
					listar_ubicacion();
				}
			},			
			{
				text:      '<i class="fas fa-search-location fa-lg"></i> Crear',
				titleAttr: 'Agregar Ubicación',
				className: 'btn btn-primary',
				action: 	function(){
					modalUbicacion();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Ubicación',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Ubicación',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,//esta se encuenta en el archivo main.js
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_ubicacion.search('').draw();
	$('#buscar').focus();
	
	edit_ubicacion_dataTable("#dataTableConfUbicacion tbody", table_ubicacion);
	delete_ubicacion_dataTable("#dataTableConfUbicacion tbody", table_ubicacion);
}

var edit_ubicacion_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");		
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarUbicacion.php';
		$('#formUbicacion #ubicacion_id').val(data.ubicacion_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formUbicacion').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formUbicacion').attr({ 'data-form': 'update' });
				$('#formUbicacion').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarUbicacionAjax.php' }); 	  
				$('#formUbicacion')[0].reset();
				$('#reg_ubicacion').hide();
				$('#edi_ubicacion').show();
				$('#delete_ubicacion').hide();
				$('#formUbicacion #pro_ubicacion').val("Editar");
				$('#formUbicacion #empresa_ubicacion').val(valores[0]);				
				$('#formUbicacion #ubicacion_ubicacion').val(valores[1]);
				
				if(valores[2] == 1){
					$('#formUbicacion #ubicacion_activo').prop('checked', true);
				}else{
					$('#formUbicacion #ubicacion_activo').prop('checked', false);					
				}					
				
				//HABILITAR OBJETOS
				$('#formUbicacion #ubicacion_ubicacion').attr('readonly', false);
				$('#formUbicacion #ubicacion_activo').attr('disabled', false);
				
				//DESHABIITAR OBJETOS
				$('#formUbicacion #empresa_ubicacion').attr('disabled', true);
				
				$('#formUbicacion #pro_ubicacion').val("Editar");	 	
				$('#modal_ubicacion').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	 
			}
		});		
	});
}

var delete_ubicacion_dataTable = function(tbody, table){
	$(tbody).off("click", "button.delete");		
	$(tbody).on("click", "button.delete", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarUbicacion.php';
		$('#formUbicacion #ubicacion_id').val(data.ubicacion_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formUbicacion').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formUbicacion').attr({ 'data-form': 'update' });
				$('#formUbicacion').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarUbicacionAjax.php' }); 	  
				$('#formUbicacion')[0].reset();
				$('#reg_ubicacion').hide();
				$('#edi_ubicacion').hide();
				$('#delete_ubicacion').show();
				$('#formUbicacion #pro_ubicacion').val("Eliminar");				
				$('#formUbicacion #empresa_ubicacion').val(valores[0]);				
				$('#formUbicacion #ubicacion_ubicacion').val(valores[1]);
				
				if(valores[2] == 1){
					$('#formUbicacion #ubicacion_activo').prop('checked', true);
				}else{
					$('#formUbicacion #ubicacion_activo').prop('checked', false);					
				}					
				
				//DESHABIITAR OBJETOS
				$('#formUbicacion #ubicacion_ubicacion').attr('readonly', true);
				$('#formUbicacion #ubicacion_activo').attr('disabled', true);				
				$('#formUbicacion #empresa_ubicacion').attr('disabled', true);
				
				$('#formUbicacion #pro_ubicacion').val("Editar");	 	
				$('#modal_ubicacion').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	 
			}
		});		
	});
}

var listar_medidas = function(){
	var table_medidas  = $("#dataTableConfMedidas").DataTable({
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>core/llenarDataTableMedida.php"
		},		
		"columns":[
			{"data":"nombre"},
			{"data":"descripcion"},			
			{"defaultContent":"<button class='editar btn btn-warning'><span class='fas fa-edit'></span></button>"},
			{"defaultContent":"<button class='delete btn btn-danger'><span class='fa fa-trash'></span></button>"}
		],		
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,		
		"language": idioma_español,//esta se encuenta en el archivo main.js
		"dom": dom,			
		"buttons":[		
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Medidas',
				className: 'btn btn-info',
				action: 	function(){
					listar_medidas();
				}
			},		
			{
				text:      '<i class="fas fa-balance-scale-left fa-lg"></i> Crear',
				titleAttr: 'Agregar Medidas',
				className: 'btn btn-primary',
				action: 	function(){
					modalMedidas();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Medidas',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				orientation: 'landscape',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Medidas',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,//esta se encuenta en el archivo main.js
						width:170,
                        height:45
					} );
				}				
			}
		]
	});	 
	table_medidas.search('').draw();
	$('#buscar').focus();
	
	edit_medidas_dataTable("#dataTableConfMedidas tbody", table_medidas);
	delete_medidas_dataTable("#dataTableConfMedidas tbody", table_medidas);
}

var edit_medidas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.editar");		
	$(tbody).on("click", "button.editar", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarMedidas.php';
		$('#formMedidas #medida_id').val(data.medida_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formMedidas').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formMedidas').attr({ 'data-form': 'update' });
				$('#formMedidas').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarMedidasAjax.php' }); 	  
				$('#formMedidas')[0].reset();
				$('#reg_medidas').hide();
				$('#edi_medidas').show();
				$('#delete_medidas').hide();
				$('#formMedidas #pro_medidas').val("Editar");					
				$('#formMedidas #medidas_medidas').val(valores[0]);				
				$('#formMedidas #descripcion_medidas').val(valores[1]);
				
				if(valores[2] == 1){
					$('#formMedidas #medidas_activo').prop('checked', true);
				}else{
					$('#formMedidas #medidas_activo').prop('checked', false);					
				}					
				
				//HABILITAR OBJETOS
				$('#formMedidas #medidas_medidas').attr('readonly', false);
				$('#formMedidas #descripcion_medidas').attr('readonly', false);
				$('#formMedidas #medidas_activo').attr('disabled', false);
				
				//DESHABIITAR OBJETOS
				$('#formMedidas #medidas_medidas').attr('readonly', true);
				
				$('#formMedidas #pro_ubicacion').val("Editar");	 	
				$('#modal_medidas').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	 
			}
		});		
	});
}

var delete_medidas_dataTable = function(tbody, table){
	$(tbody).off("click", "button.delete");		
	$(tbody).on("click", "button.delete", function(){
		var data = table.row( $(this).parents("tr") ).data();
		var url = '<?php echo SERVERURL;?>core/editarMedidas.php';
		$('#formMedidas #medida_id').val(data.medida_id);			

		$.ajax({
			type:'POST',
			url:url,
			data:$('#formMedidas').serialize(),
			success: function(registro){
				var valores = eval(registro);
				$('#formMedidas').attr({ 'data-form': 'update' });
				$('#formMedidas').attr({ 'action': '<?php echo SERVERURL;?>ajax/eliminarMedidasAjax.php' }); 	  
				$('#formMedidas')[0].reset();
				$('#reg_medidas').hide();
				$('#edi_medidas').hide();
				$('#delete_medidas').show();
				$('#formMedidas #pro_medidas').val("Eliminar");					
				$('#formMedidas #medidas_medidas').val(valores[0]);				
				$('#formMedidas #descripcion_medidas').val(valores[1]);
				
				if(valores[2] == 1){
					$('#formMedidas #medidas_activo').prop('checked', true);
				}else{
					$('#formMedidas #medidas_activo').prop('checked', false);					
				}					
				
				//DESHABILITAR OBJETOS
				$('#formMedidas #ubicacion_ubicacion').attr('readonly', true);
				$('#formMedidas #descripcion_medidas').attr('readonly', true);
				$('#formMedidas #medidas_activo').attr('disabled', true);
				
				$('#formMedidas #pro_ubicacion').val("Editar");	 	
				$('#modal_medidas').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});	
			}
		});		
	});
}

$('#form_main_movimientos #categoria_id').on('change',function(){
  listar_movimientos();
}); 

$('#form_main_movimientos #fechai').on('change',function(){
  listar_movimientos();
});

$('#form_main_movimientos #fechaf').on('change',function(){
  listar_movimientos();
});
	
function funciones(){
    listar_movimientos();
	getCategoriaProductosMovimientos();
	getCategoriaProductos();
	getCategoriaOperacion();
	getProductosMovimientos(1);
}

//INIICO OBTENER LA CATEGORIA DEL PRODUCTO
function getCategoriaProductos(){
    var url = '<?php echo SERVERURL;?>core/getCategoriaProductoMovimientos.php';	
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main_movimientos #categoria_id').html("");
			$('#form_main_movimientos #categoria_id').html(data);		
		}			
     });		
}
//FIN OBTENER LA CATEGORIA DEL PRODUCTO

function getCategoriaOperacion(){
	var url = '<?php echo SERVERURL;?>core/getOperacion.php';		
		
	$.ajax({
        type: "POST",
        url: url,
        success: function(data){	
		    $('#formMovimientos #movimiento_operacion').html("");
			$('#formMovimientos #movimiento_operacion').html(data);		
		}			
     });	
}

function getCategoriaProductosMovimientos(){
	var url = '<?php echo SERVERURL;?>core/getCategoriaProductoMovimientos.php';		
		
	$.ajax({
        type: "POST",
        url: url,
        success: function(data){	
		    $('#formMovimientos #movimiento_categoria').html("");
			$('#formMovimientos #movimiento_categoria').html(data);		
		}			
     });	
}

$(document).ready(function() {
	$('#formMovimientos #movimiento_categoria').on('change', function(){
		var categoria_producto_id;
		
		if ($('#formMovimientos #movimiento_categoria').val() == "" || $('#formMovimientos #movimiento_categoria').val() == null){
		  categoria_producto_id = 1;	
		}else{
		  categoria_producto_id = $('#formMovimientos #movimiento_categoria').val();
		}	
	
		getProductosMovimientos(categoria_producto_id);		
	    return false;			 				
    });					
});

function getProductosMovimientos(categoria_producto_id){
    var url = '<?php echo SERVERURL; ?>core/getProductosMovimientosCategoria.php';		
		
	$.ajax({
        type: "POST",
        url: url,
		data:'categoria_producto_id='+categoria_producto_id,
        success: function(data){	
		    $('#formMovimientos #movimiento_producto').html("");
			$('#formMovimientos #movimiento_producto').html(data);		
		}			
     });	
}
//FIN ACCIONES FROMULARIO PRODUCTOS

//PAGOS FACTURACION

//INICIO FUNCION PARA OBTENER LOS TIPOS DE PAGO DISPONIBLES
function getTipoPago(){	
	var url = '<?php echo SERVERURL;?>core/getTipoPago.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formPagos #tipo_pago_id').html("");
			$('#formPagos #tipo_pago_id').html(data);		    
			
			$('#formPagos #tipo_pago_id1').html("");
			$('#formPagos #tipo_pago_id1').html(data);

		    $('#formPagosPurchase #tipo_pago_idPurchase').html("");
			$('#formPagosPurchase #tipo_pago_idPurchase').html(data);		    
			
			$('#formPagosPurchase #tipo_pago_idPurchase1').html("");
			$('#formPagosPurchase #tipo_pago_idPurchase1').html(data);			
        }
     });		
}
//FIN FUNCION PARA OBTENER LOS TIPOS DE PAGO DISPONIBLES

//INICIO FUNCION PARA OBTENER LOS BANCOS DISPONIBLES	
function getBanco(){
	var url = '<?php echo SERVERURL;?>core/getBanco.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formPagos #banco_id').html("");
			$('#formPagos #banco_id').html(data);

		    $('#formPagos #banco_id1').html("");
			$('#formPagos #banco_id1').html(data);	

		    $('#formPagosPurchase #banco_idPurchase').html("");
			$('#formPagosPurchase #banco_idPurchase').html(data);

		    $('#formPagosPurchase #banco_idPurchase1').html("");
			$('#formPagosPurchase #banco_idPurchase1').html(data);			
        }
     });		
}
//FIN FUNCION PARA OBTENER LOS BANCOS DISPONIBLES

//INICIO CUENTAS POR COBRAR CLIENTES
var listar_cuentas_por_cobrar_clientes = function(){		
	var table_cuentas_por_cobrar_clientes = $("#dataTableCuentasPorCobrarClientes").DataTable({		
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableCobrarClientes.php"
		},
		"columns":[
			{"defaultContent":"<button class='pay_clientes btn btn-primary'><span class='fas fa-money-bill fa-lg'></span></button>"},
			{"data":"fecha"},			
			{"data":"cliente"},
			{"data":"numero"},
			{"data":"saldo"}		
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
		"dom": dom,		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Cuents por Cobrar Clientes',
				className: 'btn btn-info',
				action: 	function(){
					listar_cuentas_por_cobrar_clientes();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Cuents por Cobrar Clientes',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Cuents por Cobrar Clientes',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_cuentas_por_cobrar_clientes.search('').draw();
	$('#buscar').focus();
	registrar_pago_clientes_dataTable("#dataTableCuentasPorCobrarClientes tbody", table_cuentas_por_cobrar_clientes);
}

var registrar_pago_clientes_dataTable = function(tbody, table){
	$(tbody).off("click", "button.pay_clientes");
	$(tbody).on("click", "button.pay_clientes", function(){
		var data = table.row( $(this).parents("tr") ).data();
			swal({
				title: "Error", 
				text: "Opción no disponible por los momentos",
				type: "warning", 
				confirmButtonClass: 'btn-warning'
			});	
	});
}

//INICIO CUENTAS POR PAGAR PROVEEDORES
var listar_cuentas_por_pagar_proveedores = function(){		
	var table_cuentas_por_pagar_proveedores = $("#dataTableCuentasPorPagarProveedores").DataTable({		
		"destroy":true,
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTablePagarProveedores.php"
		},
		"columns":[
			{"defaultContent":"<button class='pay_clientes btn btn-primary'><span class='fas fa-money-bill fa-lg'></span></button>"},
			{"data":"fecha"},			
			{"data":"proveedores"},
			{"data":"factura"},
			{"data":"saldo"}			
		],
		"pageLength": 10,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,
		"dom": dom,		
		"buttons":[
			{
				text:      '<i class="fas fa-sync-alt fa-lg"></i> Actualizar',
				titleAttr: 'Actualizar Cuents Pagar Proveedores',
				className: 'btn btn-info',
				action: 	function(){
					listar_cuentas_por_pagar_proveedores();
				}
			},				
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
				titleAttr: 'Excel',
				title: 'Reporte Cuents por Pagar Proveedores',
				className: 'btn btn-success'				
			},
			{
				extend:    'pdf',
				text:      '<i class="fas fa-file-pdf fa-lg"></i> PDF',
				titleAttr: 'PDF',
				title: 'Reporte Cuents por Pagar Proveedores',
				className: 'btn btn-danger',
				customize: function ( doc ) {
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'left',
						image: imagen,
						width:170,
                        height:45
					} );
				}				
			}
		]		
	});	 
	table_cuentas_por_pagar_proveedores.search('').draw();
	$('#buscar').focus();
	registrar_pago_proveedores_dataTable("#dataTableCuentasPorPagarProveedores tbody", table_cuentas_por_pagar_proveedores);
}

var registrar_pago_proveedores_dataTable = function(tbody, table){
	$(tbody).off("click", "button.pay_clientes");
	$(tbody).on("click", "button.pay_clientes", function(){
		var data = table.row( $(this).parents("tr") ).data();
			swal({
				title: "Error", 
				text: "Opción no disponible por los momentos",
				type: "warning", 
				confirmButtonClass: 'btn-warning'
			});	
	});
}
//FIN LLENAR TABLAS

//INICIO IDIOMA
var idioma_español = {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "1": "Mostrar 1 fila",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "not": "No",
                "notBetween": "No entre",
                "notEmpty": "No Vacio"
            },
            "moment": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "not": "No",
                "notBetween": "No entre",
                "notEmpty": "No vacio"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "not": "No",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "not": "No",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
    },
    "select": {
        "1": "%d fila seleccionada",
        "_": "%d filas seleccionadas",
        "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        }
    },
    "thousands": "."
} 
//FIN IDIOMA

//INICIO CONVETIR IMAGEN BASE 64
function toDataURL(src, callback, outputFormat) {
  var img = new Image();
  img.crossOrigin = 'Anonymous';
  img.onload = function() {
    var canvas = document.createElement('CANVAS');
    var ctx = canvas.getContext('2d');
    var dataURL;
    canvas.height = this.naturalHeight;
    canvas.width = this.naturalWidth;
    ctx.drawImage(this, 0, 0);
    dataURL = canvas.toDataURL(outputFormat);
    callback(dataURL);
  };
  img.src = src;
  if (img.complete || img.complete === undefined) {
    img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    img.src = src;
  }
}
//FIN CONVERTIR IMAGEN BASE 64

var lengthMenu = [[5, 10, 20, 30, 50, 100, -1], [5, 10, 20, 30, 50, 100, "Todo"]];

var dom = "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'i><'col-sm-7'p>>";

/*
###################################################################################################################################################################################################################
###################################################################################################################################################################################################################
###################################################################################################################################################################################################################
*/			
//INICIO INVOICES
//INICIO BUSQUEDA CLIENTES EN FACTURACION
$('#invoice-form #buscar_clientes').on('click', function(e){
	e.preventDefault();
	listar_clientes_factura_buscar();
	 $('#modal_buscar_clientes_facturacion').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});		 
});

var listar_clientes_factura_buscar = function(){
	var table_clientes_factura_buscar = $("#DatatableClientesBusquedaFactura").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableClientes.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"cliente"},
			{"data":"rtn"},
			{"data":"telefono"},
			{"data":"correo"}				
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_clientes_factura_buscar.search('').draw();
	$('#buscar').focus();
	
	view_clientes_busqueda_factura_dataTable("#DatatableClientesBusquedaFactura tbody", table_clientes_factura_buscar);
}

var view_clientes_busqueda_factura_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#invoice-form #cliente_id').val(data.clientes_id);
		$('#invoice-form #cliente').val(data.cliente);
		$('#modal_buscar_clientes_facturacion').modal('hide');
	});
}
//FIN BUSQUEDA CLIENTES EN FACTURACION

//INICIO BUSQUEDA COLABORADORES EN FACTURACION
$('#invoice-form #buscar_colaboradores').on('click', function(e){
	e.preventDefault();
	listar_colaboradores_buscar_factura();
	 $('#modal_buscar_colaboradores_facturacion').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});		 
});

var listar_colaboradores_buscar_factura = function(){
	var table_colaboradores_buscar_factura = $("#DatatableColaboradoresBusquedaFactura").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableColaboradores.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"colaborador"},
			{"data":"identidad"},
			{"data":"telefono"}			
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_colaboradores_buscar_factura.search('').draw();
	$('#buscar').focus();
	
	view_colaboradores_busqueda_factura_dataTable("#DatatableColaboradoresBusquedaFactura tbody", table_colaboradores_buscar_factura);
}

var view_colaboradores_busqueda_factura_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#invoice-form #colaborador_id').val(data.colaborador_id);
		$('#invoice-form #colaborador').val(data.colaborador);
		$('#modal_buscar_colaboradores_facturacion').modal('hide');
	});
}
//FIN BUSQUEDA COLABORADORES EN FACTURACION

//INICIO BUSQUEDA PRODUCTOS FACTURA
$(document).ready(function(){
    $("#invoice-form #invoiceItem").on('click', '.buscar_productos', function(e) {
		  e.preventDefault();
		  listar_productos_factura_buscar();
		  var row_index = $(this).closest("tr").index();
		  var col_index = $(this).closest("td").index();
		  
		  $('#formulario_busqueda_productos_facturacion #row').val(row_index);
		  $('#formulario_busqueda_productos_facturacion #col').val(col_index);		  
		  $('#modal_buscar_productos_facturacion').modal({
			show:true,
			keyboard: false,
			backdrop:'static'
		  });
	});
});

var listar_productos_factura_buscar = function(){
	var table_productos_factura_buscar = $("#DatatableProductosBusquedaFactura").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableProductosFacturas.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"nombre"},
			{"data":"cantidad"},
			{"data":"medida"},
			{"data":"categoria"},
			{"data":"precio_venta"},
			{"data":"almacen"}			
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_productos_factura_buscar.search('').draw();
	$('#buscar').focus();
	
	view_productos_busqueda_factura_dataTable("#DatatableProductosBusquedaFactura tbody", table_productos_factura_buscar);
}

var view_productos_busqueda_factura_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		if($("#invoice-form #cliente_id").val() != "" && $("#invoice-form #cliente").val() != "" && $("#invoice-form #colaborador_id").val() != "" && $("#invoice-form #colaborador").val() != ""){	
			var data = table.row( $(this).parents("tr") ).data();
			var row = $('#formulario_busqueda_productos_facturacion #row').val();
			
			$('#invoice-form #invoiceItem #productos_id_'+ row).val(data.productos_id);
			$('#invoice-form #invoiceItem #productName_'+ row).val(data.nombre);
			$('#invoice-form #invoiceItem #quantity_'+ row).val(1);
			$('#invoice-form #invoiceItem #quantity_'+ row).focus();
			$('#invoice-form #invoiceItem #price_'+ row).val(data.precio_venta);
			$('#invoice-form #invoiceItem #discount_'+ row).val(0);
			$('#invoice-form #invoiceItem #isv_'+ row).val(data.impuesto_venta);
			
			var isv = 0;
			var isv_total = 0;
			var porcentaje_isv = 0;
			var porcentaje_calculo = 0;
			var isv_neto = 0;
		
			if(data.impuesto_venta == 1){
				porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
				if($('#invoice-form #taxAmount').val() == "" || $('#invoice-form #taxAmount').val() == 0){
					porcentaje_calculo = (parseFloat(data.precio_venta) * porcentaje_isv).toFixed(2);			
					isv_neto = porcentaje_calculo;
					$('#invoice-form #taxAmount').val(porcentaje_calculo);
					$('#invoice-form #invoiceItem #valor_isv_'+ row).val(porcentaje_calculo);
				}else{				
					isv_total = parseFloat($('#invoice-form #taxAmount').val());
					porcentaje_calculo = (parseFloat(data.precio_venta) * porcentaje_isv).toFixed(2);
					isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
					$('#invoice-form #taxAmount').val(isv_neto);	
					$('#invoice-form #invoiceItem #valor_isv_'+ row).val(porcentaje_calculo);
				}
			}
			
			calculateTotalFacturas();
			addRowFacturas();
			$('#modal_buscar_productos_facturacion').modal('hide');
		}else{
			swal({
				title: "Error", 
				text: "Lo sentimos no se puede seleccionar un producto, por favor antes de continuar, verifique que los siguientes campos: clientes, vendedor no se encuentren vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger"
			});				
		}
	});
}
//FIN BUSQUEDA PRODUCTOS FACTURA

$(document).ready(function(){
    $("#invoice-form #invoiceItem").on('blur', '.buscar_cantidad', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		var impuesto_venta = parseFloat($('#invoice-form #invoiceItem #isv_'+ row_index).val());
		var cantidad = parseFloat($('#invoice-form #invoiceItem #quantity_'+ row_index).val());
		var precio = parseFloat($('#invoice-form #invoiceItem #price_'+ row_index).val());
		var total = parseFloat($('#invoice-form #invoiceItem #total_'+ row_index).val());

		var isv = 0;
		var isv_total = 0;
		var porcentaje_isv = 0;
		var porcentaje_calculo = 0;
		var isv_neto = 0;
		
		if(impuesto_venta == 1){
			porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
			if(total == "" || total == 0){
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);			
				isv_neto = parseFloat(porcentaje_calculo).toFixed(2);
				$('#invoice-form #invoiceItem #valor_isv_'+ row_index).val(porcentaje_calculo);
			}else{	
				isv_total = parseFloat($('#invoice-form #taxAmount').val());
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);
				isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
				$('#invoice-form #invoiceItem #valor_isv_'+ row_index).val(porcentaje_calculo);
			}
		}

		calculateTotalFacturas();
	});
});

$(document).ready(function(){
    $("#invoice-form #invoiceItem").on('keyup', '.buscar_cantidad', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		var impuesto_venta = parseFloat($('#invoice-form #invoiceItem #isv_'+ row_index).val());
		var cantidad = parseFloat($('#invoice-form #invoiceItem #quantity_'+ row_index).val());
		var precio = parseFloat($('#invoice-form #invoiceItem #price_'+ row_index).val());
		var total = parseFloat($('#invoice-form #invoiceItem #total_'+ row_index).val());

		var isv = 0;
		var isv_total = 0;
		var porcentaje_isv = 0;
		var porcentaje_calculo = 0;
		var isv_neto = 0;
		
		if(impuesto_venta == 1){
			porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
			if(total == "" || total == 0){
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);			
				isv_neto = parseFloat(porcentaje_calculo).toFixed(2);
				$('#invoice-form #invoiceItem #valor_isv_'+ row_index).val(porcentaje_calculo);
			}else{	
				isv_total = parseFloat($('#invoice-form #taxAmount').val());
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);
				isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
				$('#invoice-form #invoiceItem #valor_isv_'+ row_index).val(porcentaje_calculo);
			}
		}

		calculateTotalFacturas();
	});
});

function limpiarTablaFactura(){
	$("#invoice-form #invoiceItem > tbody").empty();//limpia solo los registros del body
	var count = 0;
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
	htmlRows += '<td><input type="hidden" name="isv[]" id="isv_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="valor_isv[]" id="valor_isv_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><div class="input-group mb-3"><input type="hidden" name="productos_id[]" id="productos_id_'+count+'" class="form-control quantity" autocomplete="off"><input type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"><div class="input-group-append" id="grupo_buscar_colaboradores"><span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span></div></div></td>';	
	htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="buscar_cantidad form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" placeholder="Precio" class="form-control" readonly autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="discount[]" id="discount_'+count+'" class="form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" readonly autocomplete="off"></td>';       
	htmlRows += '</tr>';
	$('#invoiceItem').append(htmlRows);
}

function addRowFacturas(){
	var count = $(".itemRow").length;
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
	htmlRows += '<td><input type="hidden" name="isv[]" id="isv_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="valor_isv[]" id="valor_isv_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><div class="input-group mb-3"><input type="hidden" name="productos_id[]" id="productos_id_'+count+'" class="form-control quantity" autocomplete="off"><input type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"><div class="input-group-append" id="grupo_buscar_colaboradores"><span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span></div></div></td>';	
	htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="buscar_cantidad form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" placeholder="Precio" class="form-control" readonly autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="discount[]" id="discount_'+count+'" class="form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" readonly autocomplete="off"></td>';       
	htmlRows += '</tr>';
	$('#invoiceItem').append(htmlRows);
}

$(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		if($("#invoice-form #cliente").val() != ""){
			addRowFacturas();
		}else{
			swal({
				title: "Error", 
				text: "Lo sentimos no puede agregar más filas, debe seleccionar un usuario antes de poder continuar",
				type: "error", 
				confirmButtonClass: "btn-danger"
			});				
		}
	}); 
	$(document).on('click', '#removeRows', function(){
		if ($('.itemRow ').is(':checked') ){
			$(".itemRow:checked").each(function() {
				$(this).closest('tr').remove();
				count--;
			});
			$('#checkAll').prop('checked', false);
			calculateTotalFacturas();						
		}else{
			swal({
				title: "Error", 
				text: "Lo sentimos debe seleccionar un fila antes de intentar eliminarla",
				type: "error", 
				confirmButtonClass: "btn-danger"
			});				
		}
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotalFacturas();
	});	
	$(document).on('keyup', "[id^=quantity_]", function(){
		calculateTotalFacturas();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotalFacturas();
	});	
	$(document).on('keyup', "[id^=price_]", function(){
		calculateTotalFacturas();
	});		
	$(document).on('blur', "[id^=discount_]", function(){
		calculateTotalFacturas();
	});	
	$(document).on('keyup', "[id^=discount_]", function(){
		calculateTotalFacturas();
	});		
	$(document).on('blur', "#taxRate", function(){		
		calculateTotalFacturas();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});

function calculateTotalFacturas(){
	var totalAmount = 0; 
	var totalDiscount = 0;
	var totalISV = 0;
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var isv_calculo = $('#valor_isv_'+id).val();
		var discount = $('#discount_'+id).val();
		var quantity  = $('#quantity_'+id).val();
		if(!discount){
			discount = 0;
		}
		if(!quantity) {
			quantity = 1;
		}
		
		if(!isv_calculo){
			isv_calculo = 0;
		}
		
		var total = price*quantity;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;
		totalISV += parseFloat(isv_calculo);
		totalDiscount += parseFloat(discount);
	});	
	$('#subTotal').val(parseFloat(totalAmount).toFixed(2));
	$('#taxDescuento').val(parseFloat(totalDiscount).toFixed(2));	
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		$('#taxAmount').val(parseFloat(totalISV).toFixed(2));
		subTotal = (parseFloat(subTotal)+parseFloat($('#taxAmount').val()))-parseFloat(totalDiscount);
		$('#totalAftertax').val(parseFloat(subTotal).toFixed(2));		
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}
}

//INICIO MODAL REGSITRAR PAGO FACTURACIÓN CLIENTES
function pago(facturas_id){
	var url = '<?php echo SERVERURL;?>core/editarPagoFacturas.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'facturas_id='+facturas_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formPagos')[0].reset();
			$('#formPagos #proceso_pagos').val("Registrar");
			$('#formPagos #facturas_id').val(facturas_id);
			$('#formPagos #cliente').val(datos[0]);
			$('#formPagos #fecha').val(datos[1]);;
			$('#formPagos #importe').val(datos[2]);
			
			$('#modal_pagos').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});	
			
			$('#formPagos').attr({ 'data-form': 'save' }); 
			$('#formPagos').attr({ 'action': '<?php echo SERVERURL;?>ajax/addPagoFacturasAjax.php' });
			
			return false;
		}
	});
}

$('#formPagos #tipo_pago_id').on('change',function(){
   $('#formPagos #efectivo').val("");
   $('#formPagos #cambio').val("");
});

$('#formPagos #tipo_pago_id2').on('change',function(){
   $('#formPagos #efectivo1').val("");
   $('#formPagos #cambio').val("");
});

//CALCULAR LA CANTIDAD DE DINERO DE CAMBIO
$('#formPagos #efectivo').on('keyup',function(){
	var importe = parseFloat($('#formPagos #importe').val());
	var efectivo1 = 0;
	var efectivo2 = 0;
	
	if($('#formPagos #efectivo').val() != ""){
		efectivo1 = parseFloat($('#formPagos #efectivo').val());
	}
	
	if($('#formPagos #efectivo1').val() != ""){
		efectivo2 = parseFloat($('#formPagos #efectivo1').val());
	}
	var efectivo = efectivo1 + efectivo2;
	
	if(efectivo != "" ){
		if(efectivo >= importe){
			$('#formPagos #cambio').val(efectivo - importe);
			$('#formPagos #m_pendiente').val(0.0);
		}else{
			$('#formPagos #m_pendiente').val(parseFloat(importe - efectivo).toFixed(2));
		}		
	}else{
		$('#formPagos #m_pendiente').val(0.0);
	}			
});

$('#formPagos #efectivo1').on('keyup',function(){
	var importe = parseFloat($('#formPagos #importe').val());
	var efectivo1 = 0;
	var efectivo2 = 0;
	
	if($('#formPagos #efectivo').val() != ""){
		efectivo1 = parseFloat($('#formPagos #efectivo').val());
	}
	
	if($('#formPagos #efectivo1').val() != ""){
		efectivo2 = parseFloat($('#formPagos #efectivo1').val());
	}
	var efectivo = efectivo1 + efectivo2;
			
	if(efectivo != ""){
		if(efectivo >= importe){
			$('#formPagos #cambio').val(parseFloat(efectivo - importe).toFixed(2));
			$('#formPagos #m_pendiente').val(0.0);
		}else{
			$('#formPagos #m_pendiente').val(parseFloat(importe - efectivo).toFixed(2));
		}		
	}else{
		$('#formPagos #m_pendiente').val(0.0);
	}			
});
//FIN MODAL REGSITRAR PAGO FACTURACIÓN CLIENTES
//FIN INVOICE BILL

/*
###################################################################################################################################################################################################################
###################################################################################################################################################################################################################
###################################################################################################################################################################################################################
*/	
//INICIO PURCHARSE BILL
//INICIO BUSQUEDA PROVEEDORES EN COMPRAS
$('#purchase-form #buscar_proveedores_compras').on('click', function(e){
	e.preventDefault();
	listar_proveedores_compras_buscar();
	 $('#modal_buscar_proveedores_compras').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});		 
});

var listar_proveedores_compras_buscar = function(){
	var table_proveedores_compras_buscar = $("#DatatableProveedoresBusquedaProveedores").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableProveedores.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"proveedor"},
			{"data":"rtn"},
			{"data":"telefono"},
			{"data":"correo"}				
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_proveedores_compras_buscar.search('').draw();
	$('#buscar').focus();
	
	view_proveedores_busqueda_compras_dataTable("#DatatableProveedoresBusquedaProveedores tbody", table_proveedores_compras_buscar);
}

var view_proveedores_busqueda_compras_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#purchase-form #proveedores_id').val(data.proveedores_id);
		$('#purchase-form #proveedor').val(data.proveedor);
		$('#modal_buscar_proveedores_compras').modal('hide');
	});
}
//FIN BUSQUEDA PROVEEDORES EN COMPRAS

//INICIO BUSQUEDA COLABORADORES EN COMPRAS
$('#purchase-form #buscar_colaboradores_compras').on('click', function(e){
	e.preventDefault();
	listar_colaboradores_buscar_compras();
	 $('#modal_buscar_colaboradores_facturacion').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});		 
});

function getColaboradorCompras(){
	var url = '<?php echo SERVERURL;?>core/editarUsarioSistema.php';

	$.ajax({
		type:'POST',
		url:url,
		success: function(valores){
			var datos = eval(valores);
			$('#purchase-form #colaborador_id').val(datos[0]);
			$('#purchase-form #colaborador').val(datos[1]);
			$('#purchase-form #facturaPurchase').focus();
			return false;
		}
	});
}

var listar_colaboradores_buscar_compras = function(){
	var table_colaboradores_buscar_compras = $("#DatatableColaboradoresBusquedaFactura").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableColaboradores.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"colaborador"},
			{"data":"identidad"},
			{"data":"telefono"}			
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_colaboradores_buscar_compras.search('').draw();
	$('#buscar').focus();
	
	view_colaboradores_busqueda_compras_dataTable("#DatatableColaboradoresBusquedaFactura tbody", table_colaboradores_buscar_compras);
}

var view_colaboradores_busqueda_compras_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();
		$('#purchase-form #colaborador_id').val(data.colaborador_id);
		$('#purchase-form #colaborador').val(data.colaborador);
		$('#modal_buscar_colaboradores_facturacion').modal('hide');
	});
}
//FIN BUSQUEDA COLABORADORES EN COMPRAS


//INICIO BUSQUEDA PRODUCTOS COMPRAS
$(document).ready(function(){
    $("#purchase-form #purchaseItem").on('click', '.buscar_productos_purchase', function(e) {
		  e.preventDefault();
		  listar_productos_compras_buscar();
		  var row_index = $(this).closest("tr").index();
		  var col_index = $(this).closest("td").index();
		  
		  $('#formulario_busqueda_productos_facturacion #row').val(row_index);
		  $('#formulario_busqueda_productos_facturacion #col').val(col_index);		  
		  $('#modal_buscar_productos_facturacion').modal({
			show:true,
			keyboard: false,
			backdrop:'static'
		  });
	});
});

var listar_productos_compras_buscar = function(){
	var table_productos_compras_buscar = $("#DatatableProductosBusquedaFactura").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL;?>core/llenarDataTableProductosCompras.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"nombre"},
			{"data":"cantidad"},
			{"data":"medida"},
			{"data":"categoria"},
			{"data":"precio_venta"},
			{"data":"almacen"}			
		],
		"pageLength": 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_productos_compras_buscar.search('').draw();
	$('#buscar').focus();
	
	view_productos_busqueda_compras_dataTable("#DatatableProductosBusquedaFactura tbody", table_productos_compras_buscar);
}

var view_productos_busqueda_compras_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		if($("#purchase-form #facturaPurchase").val() != "" && $("#purchase-form #proveedores_id").val() != "" && $("#purchase-form #proveedor").val() != "" && $("#purchase-form #colaborador_id").val() != "" && $("#purchase-form #colaborador").val() != ""){	
			var data = table.row( $(this).parents("tr") ).data();
			var row = $('#formulario_busqueda_productos_facturacion #row').val();
			
			$('#purchase-form #purchaseItem #productos_idPurchase_'+ row).val(data.productos_id);
			$('#purchase-form #purchaseItem #productNamePurchase_'+ row).val(data.nombre);
			$('#purchase-form #purchaseItem #quantityPurchase_'+ row).val(1);
			$('#purchase-form #purchaseItem #quantityPurchase_'+ row).focus();
			$('#purchase-form #purchaseItem #pricePurchase_'+ row).val(data.precio_compra);
			$('#purchase-form #purchaseItem #discountPurchase_'+ row).val(0);
			$('#purchase-form #purchaseItem #isvPurchase_'+ row).val(data.isv_compra);
			
			var isv = 0;
			var isv_total = 0;
			var porcentaje_isv = 0;
			var porcentaje_calculo = 0;
			var isv_neto = 0;
		
			if(data.isv_compra == 1){
				porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
				if($('#purchase-form #taxAmountPurchase').val() == "" || $('#purchase-form #taxAmountPurchase').val() == 0){
					porcentaje_calculo = (parseFloat(data.precio_compra) * porcentaje_isv).toFixed(2);			
					isv_neto = porcentaje_calculo;
					$('#purchase-form #taxAmountPurchase').val(porcentaje_calculo);
					$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row).val(porcentaje_calculo);
				}else{				
					isv_total = parseFloat($('#purchase-form #taxAmountPurchase').val());
					porcentaje_calculo = (parseFloat(data.precio_compra) * porcentaje_isv).toFixed(2);
					isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
					$('#purchase-form #taxAmountPurchase').val(isv_neto);	
					$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row).val(porcentaje_calculo);
				}
			}		
			
			calculateTotalCompras();
			addRowCompras();
			$('#modal_buscar_productos_facturacion').modal('hide');
		}else{
			swal({
				title: "Error", 
				text: "Lo sentimos no se puede seleccionar un producto, por favor antes de continuar, verifique que los siguientes campos: proveedores, usuario y número de factura no se encuentren vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger"
			});				
		}
	});
}
//FIN BUSQUEDA PRODUCTOS COMPRAS

$(document).ready(function(){
    $("#purchase-form #purchaseItem").on('blur', '.buscar_cantidad_purchase', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		var impuesto_compra = parseFloat($('#purchase-form #purchaseItem #isvPurchase_'+ row_index).val());
		var cantidad = parseFloat($('#purchase-form #purchaseItem #quantityPurchase_'+ row_index).val());
		var precio = parseFloat($('#purchase-form #purchaseItem #pricePurchase_'+ row_index).val());
		var total = parseFloat($('#purchase-form #purchaseItem #totalPurchase_'+ row_index).val());

		var isv = 0;
		var isv_total = 0;
		var porcentaje_isv = 0;
		var porcentaje_calculo = 0;
		var isv_neto = 0;
		
		if(impuesto_compra == 1){
			porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
			if(total == "" || total == 0){
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);			
				isv_neto = parseFloat(porcentaje_calculo).toFixed(2);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}else{	
				isv_total = parseFloat($('#purchase-form #taxAmountPurchase').val());
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);
				isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}
		}

		calculateTotalCompras();
	});
});

$(document).ready(function(){
    $("#purchase-form #purchaseItem").on('keyup', '.buscar_cantidad_purchase', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		var impuesto_compra = parseFloat($('#purchase-form #purchaseItem #isvPurchase_'+ row_index).val());
		var cantidad = parseFloat($('#purchase-form #purchaseItem #quantityPurchase_'+ row_index).val());
		var precio = parseFloat($('#purchase-form #purchaseItem #pricePurchase_'+ row_index).val());
		var total = parseFloat($('#purchase-form #purchaseItem #totalPurchase_'+ row_index).val());

		var isv = 0;
		var isv_total = 0;
		var porcentaje_isv = 0;
		var porcentaje_calculo = 0;
		var isv_neto = 0;
		
		if(impuesto_compra == 1){
			porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
			if(total == "" || total == 0){
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);			
				isv_neto = parseFloat(porcentaje_calculo).toFixed(2);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}else{	
				isv_total = parseFloat($('#purchase-form #taxAmountPurchase').val());
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);
				isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}
		}

		calculateTotalCompras();
	});
});

$(document).ready(function(){
    $("#purchase-form #purchaseItem").on('blur', '.buscar_price_purchase', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		var impuesto_compra = parseFloat($('#purchase-form #purchaseItem #isvPurchase_'+ row_index).val());
		var cantidad = parseFloat($('#purchase-form #purchaseItem #quantityPurchase_'+ row_index).val());
		var precio = parseFloat($('#purchase-form #purchaseItem #pricePurchase_'+ row_index).val());
		var total = parseFloat($('#purchase-form #purchaseItem #totalPurchase_'+ row_index).val());

		var isv = 0;
		var isv_total = 0;
		var porcentaje_isv = 0;
		var porcentaje_calculo = 0;
		var isv_neto = 0;
		
		if(impuesto_compra == 1){
			porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
			if(total == "" || total == 0){
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);			
				isv_neto = parseFloat(porcentaje_calculo).toFixed(2);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}else{	
				isv_total = parseFloat($('#purchase-form #taxAmountPurchase').val());
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);
				isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}
		}

		calculateTotalCompras();
	});
});

$(document).ready(function(){
    $("#purchase-form #purchaseItem").on('keyup', '.buscar_price_purchase', function() {
		var row_index = $(this).closest("tr").index();
		var col_index = $(this).closest("td").index();

		var impuesto_compra = parseFloat($('#purchase-form #purchaseItem #isvPurchase_'+ row_index).val());
		var cantidad = parseFloat($('#purchase-form #purchaseItem #quantityPurchase_'+ row_index).val());
		var precio = parseFloat($('#purchase-form #purchaseItem #pricePurchase_'+ row_index).val());
		var total = parseFloat($('#purchase-form #purchaseItem #totalPurchase_'+ row_index).val());

		var isv = 0;
		var isv_total = 0;
		var porcentaje_isv = 0;
		var porcentaje_calculo = 0;
		var isv_neto = 0;
		
		if(impuesto_compra == 1){
			porcentaje_isv = parseFloat(getPorcentajeISV() / 100);
			if(total == "" || total == 0){
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);			
				isv_neto = parseFloat(porcentaje_calculo).toFixed(2);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}else{	
				isv_total = parseFloat($('#purchase-form #taxAmountPurchase').val());
				porcentaje_calculo = (parseFloat(precio) * parseFloat(cantidad) * porcentaje_isv).toFixed(2);
				isv_neto = parseFloat(isv_total) + parseFloat(porcentaje_calculo);
				$('#purchase-form #purchaseItem #valor_isvPurchase_'+ row_index).val(porcentaje_calculo);
			}
		}

		calculateTotalCompras();
	});
});

function limpiarTablaCompras(){
	$("#purchase-form #purchaseItem > tbody").empty();//limpia solo los registros del body
	var count = 0;
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRowPurchase" type="checkbox"></td>';
	htmlRows += '<td><div class="input-group mb-3"><input type="hidden" name="isvPurchase[]" id="isvPurchase_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="valor_isvPurchase[]" id="valor_isvPurchase_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><input type="hidden" name="productos_idPurchase[]" id="productos_idPurchase_'+count+'" class="form-control" autocomplete="off"><input type="text" name="productNamePurchase[]" id="productNamePurchase_'+count+'" class="form-control" autocomplete="off"><div class="input-group-append"><span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos_purchase"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span></div></div></td>';	
	htmlRows += '<td><input type="number" name="quantityPurchase[]" id="quantityPurchase_'+count+'" class="buscar_cantidad_purchase form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="pricePurchase[]" id="pricePurchase_'+count+'" placeholder="Precio" class="buscar_price_purchase form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="discountPurchase[]" id="discountPurchase_'+count+'" class="form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="totalPurchase[]" id="totalPurchase_'+count+'" class="form-control total" readonly autocomplete="off"></td>';       
	htmlRows += '</tr>';
	$('#purchaseItem').append(htmlRows);	
}

function addRowCompras(){
	var count = $(".itemRowPurchase").length;
	var htmlRows = '';
	htmlRows += '<tr>';
	htmlRows += '<td><input class="itemRowPurchase" type="checkbox"></td>';
	htmlRows += '<td><div class="input-group mb-3"><input type="hidden" name="isvPurchase[]" id="isvPurchase_'+count+'" class="form-control" placeholder="Producto ISV" autocomplete="off"><input type="hidden" name="valor_isvPurchase[]" id="valor_isvPurchase_'+count+'" class="form-control" placeholder="Valor ISV" autocomplete="off"><input type="hidden" name="productos_idPurchase[]" id="productos_idPurchase_'+count+'" class="form-control" autocomplete="off"><input type="text" name="productNamePurchase[]" id="productNamePurchase_'+count+'" class="form-control" autocomplete="off"><div class="input-group-append"><span data-toggle="tooltip" data-placement="top" title="Búsqueda de Productos"><a data-toggle="modal" href="#" class="btn btn-outline-success form-control buscar_productos_purchase"><div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i></a></span></div></div></td>';	
	htmlRows += '<td><input type="number" name="quantityPurchase[]" id="quantityPurchase_'+count+'" class="buscar_cantidad_purchase form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="pricePurchase[]" id="pricePurchase_'+count+'" placeholder="Precio" class="buscar_price_purchase form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="discountPurchase[]" id="discountPurchase_'+count+'" class="form-control" autocomplete="off"></td>';
	htmlRows += '<td><input type="number" name="totalPurchase[]" id="totalPurchase_'+count+'" class="form-control total" readonly autocomplete="off"></td>';       
	htmlRows += '</tr>';
	$('#purchaseItem').append(htmlRows);
}

$(document).ready(function(){
	$(document).on('click', '#checkAllPurchase', function() {          	
		$(".itemRowPurchase").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRowPurchase', function() {  	
		if ($('.itemRowPurchase:checked').length == $('.Purchase').length) {
			$('#checkAllPurchase').prop('checked', true);
		} else {
			$('#checkAllPurchase').prop('checked', false);
		}
	});  
	var count = $(".itemRowPurchase").length;
	$(document).on('click', '#addRowsPurchase', function() { 
		if($("#purchase-form #proveedor").val() != ""){
			addRowCompras();
		}else{
			swal({
				title: "Error", 
				text: "Lo sentimos no puede agregar más filas, debe seleccionar un usuario antes de poder continuar",
				type: "error", 
				confirmButtonClass: "btn-danger"
			});				
		}
	}); 
	$(document).on('click', '#removeRowsPurchase', function(){
		if ($('.itemRowPurchase ').is(':checked') ){
			$(".itemRowPurchase:checked").each(function() {
				$(this).closest('tr').remove();
				count--;
			});
			$('#checkAllPurchase').prop('checked', false);
			calculateTotalCompras();						
		}else{
			swal({
				title: "Error", 
				text: "Lo sentimos debe seleccionar un fila antes de intentar eliminarla",
				type: "error", 
				confirmButtonClass: "btn-danger"
			});				
		}
	});		
	$(document).on('blur', "[id^=quantityPurchase_]", function(){
		calculateTotalCompras();
	});	
	$(document).on('keyup', "[id^=quantityPurchase_]", function(){
		calculateTotalCompras();
	});	
	$(document).on('blur', "[id^=pricePurchase_]", function(){
		calculateTotalCompras();
	});	
	$(document).on('keyup', "[id^=pricePurchase_]", function(){
		calculateTotalCompras();
	});		
	$(document).on('blur', "[id^=discountPurchase_]", function(){
		calculateTotalCompras();
	});	
	$(document).on('keyup', "[id^=discountPurchase_]", function(){
		calculateTotalCompras();
	});		
	$(document).on('blur', "#taxRatePurchase", function(){		
		calculateTotalCompras();
	});	
	$(document).on('blur', "#amountPaidPurchase", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertaxPurchase').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDuePurchase').val(totalAftertax);
		} else {
			$('#amountDuePurchase').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoicePurchase', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});

function calculateTotalCompras(){
	var totalAmount = 0; 
	var totalDiscount = 0;
	var totalISV = 0;
	$("[id^='pricePurchase_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("pricePurchase_",'');
		var price = $('#pricePurchase_'+id).val();
		var isv_calculo = $('#valor_isvPurchase_'+id).val();
		var discount = $('#discountPurchase_'+id).val();
		var quantity  = $('#quantityPurchase_'+id).val();
		if(!discount){
			discount = 0;
		}
		if(!quantity) {
			quantity = 1;
		}
		
		if(!isv_calculo){
			isv_calculo = 0;
		}
		
		var total = price*quantity;
		$('#totalPurchase_'+id).val(parseFloat(total));
		totalAmount += total;
		totalISV += parseFloat(isv_calculo);
		totalDiscount += parseFloat(discount);
	});	
	$('#subTotalPurchase').val(parseFloat(totalAmount).toFixed(2));
	$('#taxDescuentoPurchase').val(parseFloat(totalDiscount).toFixed(2));	
	var taxRate = $("#taxRatePurchase").val();
	var subTotal = $('#subTotalPurchase').val();	
	if(subTotal) {
		$('#taxAmountPurchase').val(parseFloat(totalISV).toFixed(2));
		subTotal = (parseFloat(subTotal)+parseFloat($('#taxAmountPurchase').val()))-parseFloat(totalDiscount);
		$('#totalAftertaxPurchase').val(parseFloat(subTotal).toFixed(2));		
		var amountPaid = $('#amountPaidPurchase').val();
		var totalAftertax = $('#totalAftertaxPurchase').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDuePurchase').val(totalAftertax);
		} else {		
			$('#amountDuePurchase').val(subTotal);
		}
	}
}

//INICIO MODAL REGSITRAR PAGO COMPRAS CLIENTES
function pagoCompras(compras_id){
	var url = '<?php echo SERVERURL;?>core/editarPagoCompras.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'compras_id='+compras_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formPagosPurchase')[0].reset();
			$('#formPagosPurchase #proceso_pagosPurchase').val("Registrar");
			$('#formPagosPurchase #compras_idPurchase').val(compras_id);
			$('#formPagosPurchase #proveedorPurchase').val(datos[0]);
			$('#formPagosPurchase #fechaPurchase').val(datos[1]);;
			$('#formPagosPurchase #importePurchase').val(datos[2]);
			
			$('#modal_pagosPurchase').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});	
			
			$('#formPagosPurchase').attr({ 'data-form': 'save' }); 
			$('#formPagosPurchase').attr({ 'action': '<?php echo SERVERURL;?>ajax/addPagoComprasAjax.php' });
			
			return false;
		}
	});
}

$('#formPagosPurchase #tipo_pago_idPurchase').on('change',function(){
   $('#formPagosPurchase #efectivoPurchase').val("");
   $('#formPagosPurchase #cambioPurchase').val("");
});

$('#formPagosPurchase #tipo_pago_idPurchase2').on('change',function(){
   $('#formPagosPurchase #efectivoPurchase1').val("");
   $('#formPagosPurchase #cambioPurchase').val("");
});

//CALCULAR LA CANTIDAD DE DINERO DE CAMBIO
$('#formPagosPurchase #efectivoPurchase').on('keyup',function(){
	var importe = parseFloat($('#formPagosPurchase #importePurchase').val());
	var efectivo1 = 0;
	var efectivo2 = 0;
	
	if($('#formPagosPurchase #efectivoPurchase').val() != ""){
		efectivo1 = parseFloat($('#formPagosPurchase #efectivoPurchase').val());
	}
	
	if($('#formPagosPurchase #efectivoPurchase1').val() != ""){
		efectivo2 = parseFloat($('#formPagosPurchase #efectivoPurchase1').val());
	}
	var efectivo = efectivo1 + efectivo2;
	
	if(efectivo != "" ){
		if(efectivo >= importe){
			$('#formPagosPurchase #cambioPurchase').val(efectivo - importe);
			$('#formPagosPurchase #m_pendientePurchase').val(0.0);
		}else{
			$('#formPagosPurchase #m_pendientePurchase').val(parseFloat(importe - efectivo).toFixed(2));
		}		
	}else{
		$('#formPagosPurchase #m_pendientePurchase').val(0.0);
	}			
});

$('#formPagosPurchase #efectivoPurchase1').on('keyup',function(){
	var importe = parseFloat($('#formPagosPurchase #importePurchase').val());
	var efectivo1 = 0;
	var efectivo2 = 0;
	
	if($('#formPagosPurchase #efectivoPurchase').val() != ""){
		efectivo1 = parseFloat($('#formPagosPurchase #efectivoPurchase').val());
	}
	
	if($('#formPagosPurchase #efectivoPurchase1').val() != ""){
		efectivo2 = parseFloat($('#formPagosPurchase #efectivoPurchase1').val());
	}
	var efectivo = efectivo1 + efectivo2;
			
	if(efectivo != ""){
		if(efectivo >= importe){
			$('#formPagosPurchase #cambioPurchase').val(parseFloat(efectivo - importe).toFixed(2));
			$('#formPagosPurchase #m_pendientePurchase').val(0.0);
		}else{
			$('#formPagosPurchase #m_pendientePurchase').val(parseFloat(importe - efectivo).toFixed(2));
		}		
	}else{
		$('#formPagosPurchase #m_pendientePurchase').val(0.0);
	}			
});
//FIN MODAL REGSITRAR PAGO COMPRAS CLIENTES
//FIN PURCHARSE BILL
/*
##############################################################################################################################################################
##############################################################################################################################################################
##############################################################################################################################################################
*/
function getPorcentajeISV(){
    var url = '<?php echo SERVERURL;?>core/getISV.php';
	
	var isv;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){	
		  var datos = eval(data);
          isv = datos[0];			  		  		  			  
		}
	});
	return isv;	
}
/*
##############################################################################################################################################################
##############################################################################################################################################################
##############################################################################################################################################################
*/
//REFRESCAR LA SESION CADA CIERTO TIEMPO PARA QUE NO EXPIRE
document.addEventListener("DOMContentLoaded", function(){
    // Invocamos cada 5 segundos ;)
    const milisegundos = 5 *1000;
    setInterval(function(){
        // No esperamos la respuesta de la petición porque no nos importa
        fetch("<?php echo SERVERURL;?>core/refrescarSesion.php");
    },milisegundos);
});

//CAMBIAR CONTRASEÑA
$('#cambiar_contraseña_usuarios_sistema').on('click',function(e){
	e.preventDefault();
	$('#ModalContraseña').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});
});

//MODIFICAR PERFIL USUARIO SISTEMA
$('#modificar_perfil_usuario_sistema').on('click',function(e){
	e.preventDefault();
	var url = '<?php echo SERVERURL;?>core/editarColaboradoresUsuario.php';

	$.ajax({
		type:'POST',
		url:url,
		success: function(registro){
			var valores = eval(registro);
			$('#formColaboradores').attr({ 'data-form': 'update' }); 
			$('#formColaboradores').attr({ 'action': '<?php echo SERVERURL;?>ajax/modificarColaboradorAjax.php' }); 
			$('#formColaboradores')[0].reset();
			$('#reg_colaborador').hide();
			$('#edi_colaborador').show();
			$('#delete_colaborador').hide();		
			$('#formColaboradores #nombre_colaborador').val(valores[0]);
			$('#formColaboradores #apellido_colaborador').val(valores[1]);
			$('#formColaboradores #identidad_colaborador').val(valores[2]);
			$('#formColaboradores #telefono_colaborador').val(valores[3]);
			$('#formColaboradores #puesto_colaborador').val(valores[4]);
			
			if(valores[5] == 1){
				$('#formColaboradores #colaboradores_activo').prop('checked', true);
			}else{
				$('#formColaboradores #colaboradores_activo').prop('checked', false);					
			}					
			
			//HABILITAR OBJETOS
			$('#formColaboradores #nombre_colaborador').attr('readonly', false);
			$('#formColaboradores #apellido_colaborador').attr('readonly', false);
			$('#formColaboradores #identidad_colaborador').attr('readonly', false);
			$('#formColaboradores #telefono_colaborador').attr('readonly', false);
			$('#formColaboradores #puesto_colaborador').attr('disabled', false);
			$('#formColaboradores #estado_colaborador').attr('disabled', false);
			$('#formColaboradores #colaboradores_activo').attr('disabled', false);				
			
			$('#formColaboradores #proceso_colaboradores').val("Editar");	 				
			$('#modal_registrar_colaboradores').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});	
		}
	});
});

/*
$(window).unload(function () {
   $.ajax({
     type: 'GET',
     async: false,
     url: '<?php echo SERVERURL;?>core/editBitacora.php'
   });
});*/
</script>