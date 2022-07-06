<script>
/****************************************************************************************************************************************************************/
//INICIO CONTROLES DE ACCION
$(document).ready(function() {
	//LLAMADA A LAS FUNCIONES
	funciones();
	
    //INICIO PAGINATION (PARA LAS BUSQUEDAS SEGUN SELECCIONES)
	$('#form_main #bs_regis').on('keyup',function(){
	  pagination(1);
	});

	$('#form_main #fecha_b').on('change',function(){
	  pagination(1);
	});

	$('#form_main #fecha_f').on('change',function(){
	  pagination(1);
	});	  

	$('#form_main #profesional').on('change',function(){
	  pagination(1);
	});
	
	$('#form_main #estado').on('change',function(){
	  pagination(1);
	});	
	//FIN PAGINATION (PARA LAS BUSQUEDAS SEGUN SELECCIONES)
});
//FIN CONTROLES DE ACCION
/****************************************************************************************************************************************************************/

/***************************************************************************************************************************************************************************/
//INICIO FUNCIONES

//INICIO OBTENER COLABORADOR CONSULTA
function getColaboradorConsulta(){
    var url = '<?php echo SERVERURL; ?>php/facturacion/getMedicoConsulta.php';
	var colaborador_id;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){	
		  var datos = eval(data);
          colaborador_id = datos[0];			  		  		  			  
		}
	});
	return colaborador_id;
}
//FIN OBTENER COLABORADOR CONSULTA

function pay(facturas_id){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6){	
		$('#formulario_facturacion')[0].reset();	
		$("#formulario_facturacion #invoiceItem > tbody").empty();//limpia solo los registros del body
		var url = '<?php echo SERVERURL; ?>php/facturacion/editarFactura.php';
			$.ajax({
			type:'POST',
			url:url,
			data:'facturas_id='+facturas_id,
			success: function(valores){
				var datos = eval(valores);
				$('#formulario_facturacion #facturas_id').val(facturas_id);
				$('#formulario_facturacion #pacientes_id').val(datos[0]);
				$('#formulario_facturacion #cliente_nombre').val(datos[1]);
				$('#formulario_facturacion #fecha').val(datos[2]);
				$('#formulario_facturacion #colaborador_id').val(datos[3]);
				$('#formulario_facturacion #colaborador_nombre').val(datos[4]);
				$('#formulario_facturacion #servicio_id').val(datos[5]);
				$('#formulario_facturacion #notes').val(datos[6]);
				
				$('#formulario_facturacion #fecha').attr("readonly", true);
				$('#formulario_facturacion #validar').attr("disabled", false);
				$('#formulario_facturacion #addRows').attr("disabled", false);
				$('#formulario_facturacion #removeRows').attr("disabled", false);
				$('#formulario_facturacion #validar').show();
				$('#formulario_facturacion #editar').hide();
				$('#formulario_facturacion #eliminar').hide();						
			
				$('#main_facturacion').hide();	
				$('#label_acciones_factura').html("Factura");
				$('#facturacion').show();
				
				$('#formulario_facturacion').attr({ 'data-form': 'save' }); 
				$('#formulario_facturacion').attr({ 'action': '<?php echo SERVERURL; ?>php/facturacion/addFacturaporUsuario.php' }); 				
				
				return false;
			}
		});
		
		var url = '<?php echo SERVERURL; ?>php/facturacion/editarFacturaDetalles.php';
		var isv_valor = 0.0;
		
		$.ajax({
			type:'POST',
			url:url,
			data:'facturas_id='+facturas_id,
			success:function(data){
				var datos = eval(data);						
				for(var fila=0; fila < datos.length; fila++){					
					var productoID = datos[fila]["productos_id"];
					var productName = datos[fila]["producto"];
					var quantity = datos[fila]["cantidad"];
					var price = datos[fila]["precio"];
					var discount = datos[fila]["descuento"];
					var isv = datos[fila]["isv_valor"];
					var producto_isv = datos[fila]["producto_isv"];
					isv_valor = parseFloat(isv_valor) + parseFloat(datos[fila]["isv_valor"]);
					llenarTablaFactura(fila);
					$('#formulario_facturacion #invoiceItem #productoID_'+ fila).val(productoID);
					$('#formulario_facturacion #invoiceItem #productName_'+ fila).val(productName);
					$('#formulario_facturacion #invoiceItem #quantity_'+ fila).val(quantity);
					$('#formulario_facturacion #invoiceItem #price_'+ fila).val(price);		
					$('#formulario_facturacion #invoiceItem #discount_'+ fila).val(discount);
					$('#formulario_facturacion #invoiceItem #valor_isv_'+ fila).val(isv);
					$('#formulario_facturacion #invoiceItem #isv_'+ fila).val(data.producto_isv);
				}
				$('#formulario_facturacion #taxAmount').val(isv_valor);
				calculateTotal();
			}			
		});
		return false;
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});						 
	}	
  
	//MOSTRAMOS EL FORMULARIO PARA EL METODO DE PAGO	
}
//FIN FUNCION COBRAR

//INICIO FUNCION PARA OBTENER LAS FUNCIONES
function funciones(){
    pagination(1);
	getColaborador();
	getEstado();
	getPacientes();
	
	getServicio();
	getBanco();
	listar_pacientes_buscar();
	listar_colaboradores_buscar();
	listar_servicios_factura_buscar();
	listar_productos_facturas_buscar();
	getTipoPago();
}
//FIN FUNCION PARA OBTENER LAS FUNCIONES

//INICIO PAGINACION DE REGISTROS
function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/facturacion/paginar.php';
    var fechai = $('#form_main #fecha_b').val();
	var fechaf = $('#form_main #fecha_f').val();
	var dato = '';
	var profesional = '';
	var estado = '';
	
    if($('#form_main #profesional').val() == "" || $('#form_main #profesional').val() == null){
		profesional = '';
	}else{
		profesional = $('#form_main #profesional').val();
	}
	
    if($('#form_main #estado').val() == "" || $('#form_main #estado').val() == null){
		estado = 1;
	}else{
		estado = $('#form_main #estado').val();
	}	
	
	if($('#form_main #bs_regis').val() == "" || $('#form_main #bs_regis').val() == null){
		dato = '';
	}else{
		dato = $('#form_main #bs_regis').val();
	}

	$.ajax({
		type:'POST',
		url:url,
		async: true,
		data:'partida='+partida+'&fechai='+fechai+'&fechaf='+fechaf+'&dato='+dato+'&profesional='+profesional+'&estado='+estado,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}
//FIN PAGINACION DE REGISTROS

//INICIO FUNCION PARA OBTENER LOS PACIENTES
function getPacientes(){
    var url = '<?php echo SERVERURL; ?>php/facturacion/getPacientes.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formularioFactura #paciente').html("");
			$('#formularioFactura #paciente').html(data);	
        }
     });		
}
//FIN FUNCION PARA OBTENER LOS PACIENTES

function getColaboradorConsulta(){	
	var url = '<?php echo SERVERURL; ?>php/facturacion/getMedicoConsulta.php';
	var colaborador_id = '';
	$.ajax({
		type:'POST',
		url:url,
		async: false,
		success: function(valores){
			var datos = eval(valores);
			colaborador_id = datos[0];
		}
	});
	return colaborador_id;
}
//FIN FUNCION PARA OBTENER LOS COLABORADORES	

//INICIO FUNCION PARA OBTENER LOS TIPOS DE PAGO DISPONIBLES
function getTipoPago(){
    var url = '<?php echo SERVERURL; ?>php/atencion_pacientes/getTipoPago.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_pagos #tipo_pago_id').html("");
			$('#formulario_pagos #tipo_pago_id').html(data);		    
			
			$('#formulario_pagos #tipo_pago_id1').html("");
			$('#formulario_pagos #tipo_pago_id1').html(data);			
        }
     });		
}
//FIN FUNCION PARA OBTENER LOS TIPOS DE PAGO DISPONIBLES

//INICIO FUNCION PARA OBTENER LOS BANCOS DISPONIBLES	
function getEstado(){
    var url = '<?php echo SERVERURL; ?>php/facturacion/getEstado.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #estado').html("");
			$('#form_main #estado').html(data);		
        }
     });		
}
//FIN FUNCION PARA OBTENER LOS BANCOS DISPONIBLES

//INICIO FUNCION PARA OBTENER LOS BANCOS DISPONIBLES	
function getBanco(){
    var url = '<?php echo SERVERURL; ?>php/facturacion/getBanco.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_pagos #banco_id').html("");
			$('#formulario_pagos #banco_id').html(data);

		    $('#formulario_pagos #banco_id1').html("");
			$('#formulario_pagos #banco_id1').html(data);			
        }
     });		
}
//FIN FUNCION PARA OBTENER LOS BANCOS DISPONIBLES

//INICIO FUNCION PARA OBTENER LOS PROFESIONALES
function getColaborador(){
    var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';		
		
	$.ajax({
        type: "POST",
        url: url,
        success: function(data){	
		    $('#form_main #profesional').html("");
			$('#form_main #profesional').html(data);		
		}			
     });	
}	
//FIN FUNCION PARA OBTENER LOS PROFESIONALES

//INICIO ENVIAR FACTURA POR CORREO ELECTRONICO
function mailBill(facturas_id){
	swal({
		title: "¿Estas seguro?",
		text: "¿Desea enviar este numero de factura: # " + getNumeroFactura(facturas_id) + "?",
		type: "info",
		showCancelButton: true,
		confirmButtonClass: "btn-primary",
		confirmButtonText: "¡Sí, enviar la factura!",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		allowEscapeKey: false,
		allowOutsideClick: false
	},
	function(){
		sendMail(facturas_id);
	});				
}
//FIN ENVIAR FACTURA POR CORREO ELECTRONICO

//INICIO IMPRIMIR FACTURACION
function printBill(facturas_id){
	var url = '<?php echo SERVERURL; ?>php/facturacion/generaFactura.php?facturas_id='+facturas_id;
    window.open(url);
}
//FIN IMPRIMIR FACTURACION

function sendMail(facturas_id){
	var url = '<?php echo SERVERURL; ?>php/facturacion/correo_facturas.php';
	var bill = '';
	
	$.ajax({
	   type:'POST',
	   url:url,
	   async: false,
	   data:'facturas_id='+facturas_id,	   
	   success:function(data){
	      bill = data;
	      if(bill == 1){
				swal({
					title: "Success", 
					text: "La factura ha sido enviada por correo satisfactoriamente",
					type: "success",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
		  }
	  }
	});
	return bill;	
}

function getNumeroFactura(facturas_id){
	var url = '<?php echo SERVERURL; ?>php/facturacion/getNoFactura.php';
	var noFactura = '';
	
	$.ajax({
	   type:'POST',
	   url:url,
	   async: false,
	   data:'facturas_id='+facturas_id,	   
	   success:function(data){
			var datos = eval(data);	   
			noFactura = datos[0];
	  }
	});
	return noFactura;	
}

function getNumeroNombrePaciente(facturas_id){
	var url = '<?php echo SERVERURL; ?>php/facturacion/getNombrePaciente.php';
	var noFactura = '';
	
	$.ajax({
	   type:'POST',
	   url:url,
	   async: false,
	   data:'facturas_id='+facturas_id,	   
	   success:function(data){
			var datos = eval(data);	   
			noFactura = datos[0];
	  }
	});
	return noFactura;	
}
//FIN ENVIAR FACTURA POR CORREO ELECTRONICO
//FIN FUNCIONES

/*
###########################################################################################################################################################
###########################################################################################################################################################
###########################################################################################################################################################
*/
/*															INICIO FACTURACIÓN				   															 */
//INICIOS FORMULARIOS
$('#acciones_atras').on('click', function(e){
	 e.preventDefault();
	 if($('#formulario_facturacion #cliente_nombre').val() != "" || $('#formulario_facturacion #colaborador_nombre').val() != ""){
		swal({
			title: "Tiene datos en la factura",
			text: "¿Esta seguro que desea volver, recuerde que tiene información en la factura la perderá?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "¡Si, deseo volver!",
			closeOnConfirm: false,
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(){
			$('#main_facturacion').show();
			$('#label_acciones_factura').html("");
			$('#facturacion').hide();
			$('#acciones_atras').addClass("breadcrumb-item active");
			$('#acciones_factura').removeClass("active");
			$('#formulario_facturacion')[0].reset();
			swal.close();
		});		 			 	
	 }else{	 
		 $('#main_facturacion').show();
		 $('#label_acciones_factura').html("");
		 $('#facturacion').hide();
		 $('#acciones_atras').addClass("breadcrumb-item active");
		 $('#acciones_factura').removeClass("active");	 
	 }
});

$('#form_main #factura').on('click', function(e){
	e.preventDefault();
	formFactura();
});

function modal_pagos(){
	$('#modal_pagos').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});		
}

function formFactura(){
	 $('#formulario_facturacion')[0].reset();
	 $('#main_facturacion').hide();	
	 $('#facturacion').show();	
	 $('#label_acciones_volver').html("Facturación");
	 $('#acciones_atras').removeClass("active");
	 $('#acciones_factura').addClass("active");
	 $('#label_acciones_factura').html("Factura");
	 $('#formulario_facturacion #fecha').attr('disabled', false);
	 $('#formulario_facturacion').attr({ 'data-form': 'save' }); 
	 $('#formulario_facturacion').attr({ 'action': '<?php echo SERVERURL; ?>php/facturacion/addFactura.php' }); 	 
	 limpiarTabla();
}

$(document).ready(function() {
	$('#label_acciones_volver').html("Facturación");
	$('#acciones_atras').addClass("active");
	$('#label_acciones_factura').html("");	
});	
//FIN BUSQUEDA PACIENTES

//INICIO BUSQUEDA COLABORADORES
$('#formulario_facturacion #buscar_colaboradores').on('click', function(e){
	e.preventDefault();
	listar_colaboradores_buscar();
	$('#modal_busqueda_colaboradores').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});		 
});

var listar_colaboradores_buscar = function(){
	var table_colaboradores_buscar = $("#dataTableColaboradores").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/facturacion/getColaboradoresTabla.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"colaborador"},
			{"data":"identidad"},
			{"data":"puesto"}			
		],
		"pageLength" : 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_colaboradores_buscar.search('').draw();
	$('#buscar').focus();
	
	view_colaboradores_busqueda_dataTable("#dataTableColaboradores tbody", table_colaboradores_buscar);
}

var view_colaboradores_busqueda_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();		  
		$('#formulario_facturacion #colaborador_id').val(data.colaborador_id);
		$('#formulario_facturacion #colaborador_nombre').val(data.colaborador);
		$('#modal_busqueda_colaboradores').modal('hide');
	});
}

function pago(facturas_id){
	var url = '<?php echo SERVERURL; ?>php/facturacion/editarPago.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'facturas_id='+facturas_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formulario_pagos')[0].reset();
			$('#formulario_pagos #pro').val("Registrar");
			$('#formulario_pagos #facturas_id').val(facturas_id);
			$('#formulario_pagos #cliente').val(datos[0]);
			$('#formulario_pagos #fecha').val(datos[1]);;
			$('#formulario_pagos #importe').val(datos[2]);
			
			$('#modal_pagos').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});	
			
			$('#formulario_pagos').attr({ 'data-form': 'save' }); 
			$('#formulario_pagos').attr({ 'action': '<?php echo SERVERURL; ?>php/facturacion/addPago.php' }); 				
			
			return false;
		}
	});
}
//FIN BUSQUEDA COLABORADORES

$('#formulario_pagos #tipo_pago_id').on('change',function(){
   $('#formulario_pagos #efectivo').val("");
   $('#formulario_pagos #cambio').val("");
});

$('#formulario_pagos #tipo_pago_id2').on('change',function(){
   $('#formulario_pagos #efectivo1').val("");
   $('#formulario_pagos #cambio').val("");
});

$(document).ready(function() {
	$('#formulario_pagos #pago2').hide();
});	

//CALCULAR LA CANTIDAD DE DINERO DE CAMBIO
$('#formulario_pagos #efectivo').on('keyup',function(){
	var importe = parseFloat($('#formulario_pagos #importe').val());
	var efectivo1 = 0;
	var efectivo2 = 0;
	
	if($('#formulario_pagos #efectivo').val() != ""){
		efectivo1 = parseFloat($('#formulario_pagos #efectivo').val());
	}
	
	if($('#formulario_pagos #efectivo1').val() != ""){
		efectivo2 = parseFloat($('#formulario_pagos #efectivo1').val());
	}
	var efectivo = efectivo1 + efectivo2;
	
	if(efectivo != "" ){
		if(efectivo >= importe){
			$('#formulario_pagos #cambio').val(efectivo - importe);
			$('#formulario_pagos #m_pendiente').val(0.0);
		}else{
			$('#formulario_pagos #m_pendiente').val(parseFloat(importe - efectivo).toFixed(2));
		}		
	}else{
		$('#formulario_pagos #m_pendiente').val(0.0);
	}			
});

$('#formulario_pagos #efectivo1').on('keyup',function(){
	var importe = parseFloat($('#formulario_pagos #importe').val());
	var efectivo1 = 0;
	var efectivo2 = 0;
	
	if($('#formulario_pagos #efectivo').val() != ""){
		efectivo1 = parseFloat($('#formulario_pagos #efectivo').val());
	}
	
	if($('#formulario_pagos #efectivo1').val() != ""){
		efectivo2 = parseFloat($('#formulario_pagos #efectivo1').val());
	}
	var efectivo = efectivo1 + efectivo2;
			
	if(efectivo != ""){
		if(efectivo >= importe){
			$('#formulario_pagos #cambio').val(parseFloat(efectivo - importe).toFixed(2));
			$('#formulario_pagos #m_pendiente').val(0.0);
		}else{
			$('#formulario_pagos #m_pendiente').val(parseFloat(importe - efectivo).toFixed(2));
		}		
	}else{
		$('#formulario_pagos #m_pendiente').val(0.0);
	}			
});

//INCIO ELIMINAR FACTURA BORRADOR
function deleteBill(facturas_id){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3){
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar la factura para el paciente: " + getNumeroNombrePaciente(facturas_id) + "?",
			type: "info",
			showCancelButton: true,
			confirmButtonClass: "btn-primary",
			confirmButtonText: "¡Sí, Eliminar la!",
			cancelButtonText: "Cancelar",
			closeOnConfirm: false,
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(){
			eliminarFacturaBorrador(facturas_id);
		});			
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});						 
	}				
}

function eliminarFacturaBorrador(facturas_id){	
	var url = '<?php echo SERVERURL; ?>php/facturacion/eliminar.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'facturas_id='+facturas_id,
		success: function(registro){
			if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				pagination(1);
			   return false;				
			}else if(registro == 2){
				swal({
					title: "Error al eliminar el registro, por favor intentelo de nuevo o verifique que no tenga información almacenada", 
					text: "No tiene permisos para ejecutar esta acción",
					type: "error", 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			    return false;				
			}else{
				swal({
					title: "No se puede procesar su solicitud, por favor intentelo de nuevo mas tarde", 
					text: "No tiene permisos para ejecutar esta acción",
					type: "error", 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			    return false;				
			}
  		}
	}); 
	return false;
}

function volver(){
	$('#main_facturacion').show();
	$('#label_acciones_factura').html("");
	$('#facturacion').hide();
	$('#acciones_atras').addClass("breadcrumb-item active");
	$('#acciones_factura').removeClass("active");		
}

function cierreCaja(){
	$('#formularioCierreCaja #pro').val("Cierre de Caja");
	
	$('#modalCierreCaja').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	
	
	$('#formularioCierreCaja').attr({ 'data-form': 'save' }); 
	$('#formularioCierreCaja').attr({ 'action': '<?php echo SERVERURL; ?>php/facturacion/addPago.php' }); 	
}

$('#form_main #cierre').on('click', function(e){
	e.preventDefault();
	cierreCaja();
});

$('#generarCierreCaja').on('click', function(e){
	e.preventDefault();
	var fecha = $('#formularioCierreCaja #fechaCierreCaja').val();
	var url = '<?php echo SERVERURL; ?>php/facturacion/generaCierreCaja.php?fecha='+fecha;
    window.open(url);
	$('#modalCierreCaja').modal('hide');
});
//FIN ELIMINAR FACTURA BORRADOR
/*														 	FIN FACTURACIÓN				   															 	*/
/*
###########################################################################################################################################################
###########################################################################################################################################################
###########################################################################################################################################################
*/
</script>