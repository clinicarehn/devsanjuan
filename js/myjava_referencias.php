<script>
$(document).ready()
  $(function(){
	  $('#form_main #centros_mainform').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		    limpiarCentros();
		    $('#formulario_centros .nav-tabs li:eq(0) a').tab('show');
		    $('#formulario_centros')[0].reset();	
     	    $('#formulario_centros #pro').val('Registro');
            $('#formulario_centros #mensaje').removeClass('error');			
			$('#formulario_centros #mensaje').removeClass('alerta');
			$('#formulario_centros #mensaje').removeClass('bien');
			$('#formulario_centros #mensaje').html('');
		    $('#reg_centros').show();			
		    $('#registrar_centros').modal({
			    show:true,
				keyboard: false,
			    backdrop:'static'
		    });
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });	

	  $('#form_main #referencias_enviadas').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    formReferenciasEnviadas();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });	   
	   
	  $('#form_main #referencias_recibidas').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    formReferenciasRecibidas();
		 }else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });

	  $('#form_main #reporte_referencias').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    reporteEXCEL();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });
	   
	  $('#form_main #reporte_patologias').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    reporteEXCELPatologia();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });

	  $('#form_main #reporte_procedencias').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    reporteProcedencias();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });

	  $('#form_main #reporte_centros').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    reporteCentros();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });

	  $('#form_main #reporte_registro_referencias').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    reporteEXCEL_UGD();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });

	  $('#form_main #reporte_consolidado_referencias').on('click',function(e){
		 e.preventDefault();
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    modal_consolidadoReferencias();
		}else{
			swal({
				title: "Acceso Denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					
	        return false;	  
          }
	   });
}); 	
	   
/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#registrar_centros").on('shown.bs.modal', function(){
        $(this).find('#formulario_centros #centros_buscar').focus();
    });
});

$(document).ready(function(){
    $("#agregar_referencias_recibidas").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_referencias_recibidas #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_referencias_enviadas").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_referencias_enviadas #expediente').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
	
function formReferenciasRecibidas(){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	$('#formulario_agregar_referencias_recibidas')[0].reset();	
	getNivel();
	getServicioReferenciasRecibidas();	 
	getPatologia1ReferenciasRecibidas();
    getNivel();	
	$('#formulario_agregar_referencias_recibidas #pro').val("Registro");
	
	$('#agregar_referencias_recibidas').modal({
	    show:true,
		keyboard: false,
        backdrop:'static'
    });	
	$("#reg_rr").attr('disabled', true);	
 }else{
		$('#bs-regis').val("");	
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});				
		return false;	  
  }
}

function formReferenciasEnviadas(){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){		
	$('#formulario_agregar_referencias_enviadas')[0].reset();
	getNivelAgregarReferenciasEnviadas();
	getServicioReferenciasEnviadas();
	getPatologia1ReferenciasEnviadas();
	getPatologia2ReferenciasEnviadas();
	getPatologia3ReferenciasEnviadas();
    getMotivoTraslado();
	getMotivoTrasladoOtros();
	$('#formulario_agregar_referencias_enviadas #pro').val("Registro");	
	
	$('#agregar_referencias_enviadas').modal({
	    show:true,
		keyboard: false,
        backdrop:'static'
    });	
    $("#reg_re").attr('disabled', true);	
 }else{
	   $('#bs-regis').val("");	
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});				
	   return false;	  
  }
}

$(document).ready(function() {
    getConfirmacion_rr_no();
	motivoTraslado();
	motivoTrasladoOtros();
});

$(document).ready(function() {
  $('#form_main #fecha_i').on('change', function(){
	  evaluar();
  });	
}); 

$(document).ready(function() {
  $('#form_main #fecha_f').on('change', function(){
	  evaluar(); 
  });	
});

$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){
	  evaluar(); 
  });	
}); 


$(document).ready(function() {
  $('#form_main #referencias').on('change', function(){
	  evaluar(); 
  });	
}); 

$('#bs-regis').on('keyup',function(){
	 evaluar();
});

function getServicioFormMain(){
    var url = '<?php echo SERVERURL; ?>php/referencias/servicios_main.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #servicio').html("");
			$('#form_main #servicio').html(data);	
			$('#form_main #servicio').selectpicker('refresh');	
		}			
     });		
}

function getServicioFormMainUGD(){
    var url = '<?php echo SERVERURL; ?>php/referencias/servicios_main.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){				
		    $('#formulario_modal_consolidado_referencias #servicio_ref_ugd').html("");
			$('#formulario_modal_consolidado_referencias #servicio_ref_ugd').html(data);
			$('#formulario_modal_consolidado_referencias #servicio_ref_ugd').selectpicker('refresh');		
		}			
     });		
}

function evaluar(){
	var referencia = "";
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}
	
	if(referencia == 1){
		pagination_referencias_enviadas(1);
	}else{
		pagination_referencias_recibidas(1);
	}	
}	
  
$(document).ready(function() {
	 //FROMULARIO AGREAR CENTROS
	 getNivel();
	 getReporteR();
     getServicioFormMain();	 
	 pagination_centros(1);
	 getAnos();
	 /*********************************/
	 //FORM EDITAR REFERENCIAS ENVIADAS
	 getNivelEditarReferenciasEnviadas();
	 getPatologia1EdicionReferenciasEnviadas1();
	 getPatologia1EdicionReferenciasEnviadas2();
	 getPatologia1EdicionReferenciasEnviadas3();	 
	 /*********************************/		 
	 //FORM EDITAR REFERENCIAS RECIBIDAS
	 getNivelEditarReferenciasRecibidas();
	 getPatologia1EdicionReferenciasRecibidas();
	 /*********************************/	 
	 //FORM AGREGAR REFERENCIAS ENVIADAS
	 getNivelAgregarReferenciasEnviadas()
	 getServicioReferenciasEnviadas();
	 getPatologia1ReferenciasEnviadas();
	 getPatologia2ReferenciasEnviadas();
	 getPatologia3ReferenciasEnviadas();
     getMotivoTraslado();
	 getMotivoTrasladoOtros();
	 /*********************************/		 
	 //FORM AGREGAR REFERENCIAS RECIBIDAS
	 getNivelAgregarReferenciasRecibidas();
	 getServicioReferenciasRecibidas();	 
	 getPatologia1ReferenciasRecibidas();
	 /*********************************/
	 getDepartamento();
	 
	$('#formulario_centros #centros_buscar').on('keyup',function(){
		 pagination_centros(1);
    });
	
    evaluar();
});

$(document).ready(function() {
	$('#form_main #referencias').on('change', function(){
		if($('#form_main #referencias').val() == 1){
		   pagination_referencias_enviadas(1);
	   }else{
		   pagination_referencias_recibidas(1);
	   }		 				
    });					
});

function pagination_centros(partida){
	var url = '<?php echo SERVERURL; ?>php/referencias/paginar_centros.php';
	var dato = $('#formulario_centros #centros_buscar').val();
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato,
		success:function(data){
			var array = eval(data);
			$('#formulario_centros #agrega_registros_centros').html(array[0]);
			$('#formulario_centros #pagination_centros').html(array[1]);
		}
	});
	return false;
}

function pagination_referencias_recibidas(partida){
	var url = '<?php echo SERVERURL; ?>php/referencias/paginar_referencias_recibidas.php';
	var dato = $('#form_main #bs-regis').val();
	var fecha_i = $('#form_main #fecha_i').val();
	var fecha_f = $('#form_main #fecha_f').val();

	var servicio = "";
	
	if( $('#form_main #servicio').val() == null){
		servicio = 0;
	}else if( $('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato+'&fecha_i='+fecha_i+'&fecha_f='+fecha_f+'&servicio='+servicio,	
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function pagination_referencias_enviadas(partida){
	var url = '<?php echo SERVERURL; ?>php/referencias/paginar_referencias_enviadas.php';
	var dato = $('#form_main #bs-regis').val();
	var fecha_i = $('#form_main #fecha_i').val();
	var fecha_f = $('#form_main #fecha_f').val();
	var servicio = "";
	
	if( $('#form_main #servicio').val() == null){
		servicio = 0;
	}else if( $('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}	
				
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato+'&fecha_i='+fecha_i+'&fecha_f='+fecha_f+'&servicio='+servicio,		
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function eliminarRegistro(id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/referencias/eliminar.php';
	
	$.ajax({
      type:'POST',
	  url:url,
	  data:'id='+id+'&fecha='+fecha,
	  success: function(registro){
		 if(registro == 1){
			$('#formulario_centros #mensaje').removeClass('error');
			swal({
				title: "Success", 
				text: "Registro eliminado correctamente",
				type: "success",
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});	
			getNivel();		
			$('#formulario_centros #centros_centro').html("");			
			pagination_centros(1); 
		 }else if(registro == 2){
			swal({
				title: "Error", 
				text: "No se puede eliminar el registro",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});						   			   			
			pagination_centros(1); 
		 }else if(registro == 3){
			var totalRR = countCentroRR(id);
			var totalRE = countCentroRE(id);
			var mensajeRR = ""; 
			var mensajeRE = "";
			
			if(totalRR != 0){
				mensajeRR = "Referencias Recibidas: " + totalRR + ".";
			}
			
			if(totalRE != 0){
				mensajeRE = "Referencias Enviadas: " + totalRE + ".";
			}			
			
			swal({
				title: "Error", 
				text: "Este registro tiene datos almacenados. " + mensajeRR + " " + mensajeRE + "",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});						   			   
			getNivel();		
			$('#formulario_centros #centros_centro').html("");			
			pagination_centros(1); 
		 }else{
			swal({
				title: "Error", 
				text: "Error intentar eliminar el registro",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				   			   
			getNivel();
			$('#formulario_centros #centros_centro').html("");
		 }
		 
		 return false;
  	  }
	});
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});						   			   
	getNivel();
	$('#formulario_centros #centros_centro').html("");
  }
}

function countCentroRR(centro_id){
    var url = '<?php echo SERVERURL; ?>php/referencias/getCountCentroRR.php';
	var resp;
	
	$.ajax({
	    type:'POST',
		data:'centro_id='+centro_id,
		url:url,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp	;	
}

function countCentroRE(centro_id){
    var url = '<?php echo SERVERURL; ?>php/referencias/getCountCentroRE.php';
	var resp;
	
	$.ajax({
	    type:'POST',
		data:'centro_id='+centro_id,
		url:url,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp	;	
}	
//FORMULARIO CENTROS
function getNivel(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_centros #centros_nivel').html("");
			$('#formulario_centros #centros_nivel').html(data);	
			$('#formulario_centros #centros_nivel').selectpicker('refresh');

		    $('#formulario_centros #centros_centro').html("");			
        }
     });		
}

$(document).ready(function() {
	$('#formulario_centros #centros_nivel').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
       		
		var nivel = $('#formulario_centros #centros_nivel').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_centros #centros_centro').html("");
			  $('#formulario_centros #centros_centro').html(data);
			  $('#formulario_centros #centros_centro').selectpicker('refresh');		  
		  }
	  });
	  return false;			 				
    });					
});

/*************************************************************************************************************/
//ACCIONES EN LOS BOTONES DE LOS FORMULARIOS
//FORMULARIO CENTROS
$('#reg_centros').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		 if ($('#formulario_centros #centros_nombre').val() == ""){				
			swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   	         
		 }else{		
			agregarCentros();
		 } 
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			   	         
	}	 
});

//FORMULARIO REFERENCIAS RECIBIDAS
$('#edit_referencias_ref_recibida').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		 if ($('#formulario_edicion_referencias_recibidas #motivo').val() == "" ){
			 $('#formulario_edicion_referencias_recibidas')[0].reset();				
			swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   
			return false;
		 }else{		
			modificarReferenciasRecibidas();		
		 }  
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	;			   	         
		return false;
	}
});

$('#reg_rr').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		 if ($('#formulario_agregar_referencias_recibidas #expediente').val() == "" && $('#formulario_agregar_referencias_recibidas #motivo').val() == "" && $('#formulario_agregar_referencias_recibidas #recibidade').val() == "" && $('#formulario_agregar_referencias_recibidas #patologia1').val() == ""){
			$('#formulario_agregar_referencias_recibidas')[0].reset();			
			swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   
			return false;
		 }else{		
			agregarReferenciasRecibidas();		
		 }  
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});				   	         
		return false;	
	}	 
});


//CONSOLIDADO DE REFERENCIAS
$('#reg_consolidado_ref_ugd').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		 if ($('#formulario_modal_consolidado_referencias #consolidado_ref_ugd').val() == ""  && $('#formulario_modal_consolidado_referencias #año_ref_ugd').val() == "" ){
			$('#formulario_modal_consolidado_referencias')[0].reset();
			swal({
				title: "Error", 
				text: "No se pueden descargar el reporte, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   
			return false;
		 }else{		
			reporteConsolidadoEXCEL_UGD();		
		 }  
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			   	         
		return false;
	}
});
//FORMULARIO REFERENCIAS ENVIADAS
$('#edit_referencias_ref_enviadas').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		 if ($('#formulario_edicion_referencias_enviadas #motivo_enviada').val() == "" ){
			$('#formulario_edicion_referencias_enviadas')[0].reset();
			swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				   
			return false;
		 }else{		
			modificarReferenciasEnviadas();		
		 } 
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});					   	         
		return false;	
	}		 
});

$('#reg_re').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		 if ($('#formulario_agregar_referencias_enviadas #expediente').val() == "" && $('#formulario_agregar_referencias_recibidas #motivo').val() == "" && $('#formulario_agregar_referencias_recibidas #enviadaa').val() == "" && $('#formulario_agregar_referencias_recibidas #patologia1').val() == ""){
			 $('#formulario_agregar_referencias_enviadas')[0].reset();	
			swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   
			return false;
		 }else{		
			agregarReferenciasEnviadas();		
		 } 
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		
		return false;	
	}	 
});

function limpiarCentros(){
    getDepartamento();
	getNivel();
}

function limpiarReferenciasRecibidas(){				   			   
	getNivel();
	$('#formulario_agregar_referencias_recibidas #centro').html("");
    $('#formulario_agregar_referencias_recibidas #recibidade').html("");	
	$('#formulario_agregar_referencias_recibidas #unidad').html("");
	$('#formulario_agregar_referencias_recibidas #medico_general').html("");
    $('#formulario_agregar_referencias_recibidas #motivo_enviada').val("");		
	getServicioReferenciasRecibidas();	 
	getPatologia1ReferenciasRecibidas();
    getNivelAgregarReferenciasRecibidas();
	getMotivoTraslado();
	getMotivoTrasladoOtros();
	$('#formulario_agregar_referencias_recibidas #pro').val('Registro');
    $("#reg_rr").attr('disabled', true);	
}
	
function limpiarReferenciasEnviadas(){
	$('#formulario_agregar_referencias_enviadas #centro').html("");
    $('#formulario_agregar_referencias_enviadas #enviadaa').html("");	
	$('#formulario_agregar_referencias_enviadas #unidad').html("");	
	$('#formulario_agregar_referencias_enviadas #medico_general').html("");	
    $('#formulario_agregar_referencias_enviadas #diagnostico').val("");
    $('#formulario_agregar_referencias_enviadas #motivo').val("");		
	getNivelAgregarReferenciasEnviadas();
	getServicioReferenciasEnviadas();
	getPatologia1ReferenciasEnviadas();
	getPatologia2ReferenciasEnviadas();
	getPatologia3ReferenciasEnviadas();
	getMotivoTraslado();
	getMotivoTrasladoOtros();
    $('#formulario_agregar_referencias_enviadas #pro').val('Registro');
    $("#reg_re").attr('disabled', true);
}

function agregarCentros(){
	var url = '<?php echo SERVERURL; ?>php/referencias/agregarCentros.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_centros').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_centros')[0].reset();
				$('#formulario_centros #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});		
				limpiarCentros();
				$('#formulario_centros #centros_centro').html("");
				pagination_centros(1); 
				return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				limpiarCentros();
				$('#formulario_centros #centros_centro').html("");
				$('#formulario_centros #centros_nombre').val("");			   
			   return false;
			}else{							   
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				limpiarCentros();
				$('#formulario_centros #centros_centro').html("");
				return false;
			}
		}
	});	
}

function agregarReferenciasRecibidas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/agregarReferenciasRecibidas.php';
	
  var fecha = $('#formulario_agregar_referencias_recibidas #fecha').val();	
  var hoy = new Date();
  fecha_actual = convertDate(hoy);	
  
   if ( fecha <= fecha_actual){
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_referencias_recibidas').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_referencias_recibidas')[0].reset();
				$('#formulario_agregar_referencias_recibidas #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				limpiarReferenciasRecibidas();
				pagination_referencias_recibidas(1);
				return false;
			}else if(registro == 2){	
				limpiarReferenciasRecibidas();
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			  
				return false;
			}else if(registro == 3){							   
				limpiarReferenciasRecibidas();
				swal({
					title: "Error", 
					text: "No se puede guardar la referencia, no existen atenciones del usuario para esta fecha",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   			   
				return false;
			}else if(registro == 4){							   
				limpiarReferenciasRecibidas();
				swal({
					title: "Error", 
					text: "Error no se puedo almacenar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;
			}else if(registro == 5){							   
				limpiarReferenciasRecibidas();
				swal({
					title: "Error", 
					text: "Error, hay registros en blanco, no se puede proceder",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}else{							   
				limpiarReferenciasRecibidas();
				swal({
					title: "Error", 
					text: "Error al completar su solicitud",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}
		}
	});	
  }else{
	swal({
		title: "Error", 
		text: "No se puede agregar/modificar registros fuera de esta fecha",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});
	return false;	  
  }
}

function agregarReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/agregarReferenciasEnviadas.php';

  var fecha = $('#formulario_agregar_referencias_enviadas #fecha').val();	
  var hoy = new Date();
  fecha_actual = convertDate(hoy);	
  
   if ( fecha <= fecha_actual){	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_referencias_enviadas').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_referencias_enviadas')[0].reset();			   
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false					
				});
				limpiarReferenciasEnviadas(); 
				$('#formulario_agregar_referencias_enviadas #pro').val('Registro');
				pagination_referencias_enviadas(1);
				return false;
			}else if(registro == 2){			
				limpiarReferenciasEnviadas(); 
				swal({
					title: "Error", 
					text: "No se puede guardar la referencia, no existen atenciones del usuario para esta fecha",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	   
				return false;
			}else if(registro == 3){							   
				limpiarReferenciasEnviadas(); 	
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}else if(registro == 3){							   
				limpiarReferenciasEnviadas(); 
				swal({
					title: "Error", 
					text: "Error, hay registros en blanco, no se puede proceder",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;
			}else{							   
				limpiarReferenciasEnviadas();
				swal({
					title: "Error", 
					text: "Error al completar su solicitud",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}
		}
	});	
  }else{
	swal({
		title: "Error", 
		text: "No se puede agregar/modificar registros fuera de esta fecha",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});
	return false;	  
  }	
}

function modificarReferenciasRecibidas(){
	var url = '<?php echo SERVERURL; ?>php/referencias/modificarReferenciasRecibidas.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_edicion_referencias_recibidas').serialize(),
		success: function(registro){
			if (registro == 1){			   
				$('#formulario_edicion_referencias_recibidas #pro').val('Edición');
				swal({
					title: "Success", 
					text: "Registro modificado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});					
				getNivel();
				$('#formulario_edicion_referencias_recibidas #centros_centro').html("");
				pagination_referencias_recibidas(1);
				return false;
			}else{			
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   
				getNivel();
				$('#formulario_edicion_referencias_recibidas #centros_centro').html("");
				return false;
			}
		}
	});	
}

function modificarReferenciasEnviadas(){
	var url = '<?php echo SERVERURL; ?>php/referencias/modificarReferenciasEnviadas.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_edicion_referencias_enviadas').serialize(),
		success: function(registro){
			if (registro == 1){			   
			   $('#formulario_edicion_referencias_enviadas #pro_enviada').val('Edición');
				swal({
					title: "Success", 
					text: "Registro modificado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				getNivel();
				$('#formulario_edicion_referencias_enviadas #centros_centro_enviada').html("");
				pagination_referencias_enviadas(1);
				return false;
			}else{	
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   			   
				getNivel();
				$('#formulario_edicion_referencias_enviadas #centros_centro_enviada').html("");
				return false;
			}
		}
	});		
}

function editarReferenciasRecibidas(referenciar_id,ata_id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/referencias/editarReferenciasRecibidas.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+referenciar_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formulario_edicion_referencias_recibidas #pro').val('Edición');
			$('#formulario_edicion_referencias_recibidas #referencia_id').val(referenciar_id);
			$('#formulario_edicion_referencias_recibidas #ata_id').val(ata_id);
			$('#formulario_edicion_referencias_recibidas #expediente').val(datos[0]);
			$('#formulario_edicion_referencias_recibidas #identidad').val(datos[1]);
			$('#formulario_edicion_referencias_recibidas #nombre').val(datos[2]);
			$('#formulario_edicion_referencias_recibidas #motivo').val(datos[3]);			
			$('#formulario_edicion_referencias_recibidas #centros_nivel').val(datos[4]); 
	        getCentroEditarReferenciasRecibidas(datos[4], datos[5], datos[6]);
			$('#formulario_edicion_referencias_recibidas #patologia').val(datos[7]);
			$('#formulario_edicion_referencias_recibidas #motivo1').val(datos[8]);
			$('#formulario_edicion_referencias_recibidas #motivo_otro1').val(datos[9]); 			
			$('#formulario_edicion_referencias_recibidas #recibidade').html("");		
			$('#editar_referencias_recibidas').modal({
			  show:true,
			  keyboard: false,
			  backdrop:'static'
			});
			return false;
		}
	});	
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});				 
 }	
}

function editarReferenciasEnviadas(referenciar_id,ata_id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/referencias/editarReferenciasEnviadas.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+referenciar_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formulario_edicion_referencias_enviadas #pro_enviada').val('Edición');
			$('#formulario_edicion_referencias_enviadas #referencia_id_enviada').val(referenciar_id);
			$('#formulario_edicion_referencias_enviadas #ata_id_enviada').val(ata_id);
			$('#formulario_edicion_referencias_enviadas #expediente_enviada').val(datos[0]);
			$('#formulario_edicion_referencias_enviadas #identidad_enviada').val(datos[1]);
			$('#formulario_edicion_referencias_enviadas #nombre_enviada').val(datos[2]);
			$('#formulario_edicion_referencias_enviadas #motivo_enviada').val(datos[3]);			
			$('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').val(datos[4]);
	        getCentroEditarReferenciasEnviadas(datos[4],datos[5],datos[6]);	
			$('#formulario_edicion_referencias_enviadas #diagnostico_enviada').val(datos[7]);
			$('#formulario_edicion_referencias_enviadas #patologia1').val(datos[8]);
			$('#formulario_edicion_referencias_enviadas #patologia2').val(datos[9]);
			$('#formulario_edicion_referencias_enviadas #patologia3').val(datos[10]);
			$('#formulario_edicion_referencias_enviadas #motivo').val(datos[11]);
			$('#formulario_edicion_referencias_enviadas #motivo_otro').val(datos[12]);			
			$('#formulario_edicion_referencias_enviadas #enviadaa').html("");			
			$('#editar_referencias_enviadas').modal({
			  show:true,
			  keyboard: false,
			  backdrop:'static'
			});
			return false;
		}
	});	
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});					 
 }
}

function showDatosReferenciasEnviadas(id){
	var url = '<?php echo SERVERURL; ?>php/referencias/getInformacionReferenciasEnviadas.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'ata_id='+id,
		success:function(data){
			if(data == 1){	
				swal({
					title: "Error", 
					text: "Por Favor intentar mas tarde",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});									
			}else{
  	           $('#mensaje_show').modal({
	             show:true,
				 keyboard: false,
	             backdrop:'static'  
     	       });	
               $('#mensaje_mensaje_show').html(data);
	           $('#mensaje_mensaje_show #bad').hide();
	           $('#mensaje_mensaje_show #okay').show();				
			}
		}
	});	
}

function showDatosReferenciasRecibidas(id){
	var url = '<?php echo SERVERURL; ?>php/referencias/getInformacionReferenciasRecibidas.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'ata_id='+id,
		success:function(data){
			if(data == 1){	
				swal({
					title: "Error", 
					text: "Por Favor intentar mas tarde",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				pagination_referencias_enviadas(1);			   
			}else{
  	           $('#mensaje_show').modal({
	             show:true,
				 keyboard: false,
	             backdrop:'static'  
     	       });	
               $('#mensaje_mensaje_show').html(data);
	           $('#mensaje_mensaje_show #bad').hide();
	           $('#mensaje_mensaje_show #okay').show();				
			}
		}
	});	
}

function modal_agregar_respuesta(ata_id){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
      $('#agregar_respuesta #dato').val(ata_id);	 
	  $('#agregar_respuesta').modal({
	     show:true,
		 keyboard: false,
	     backdrop:'static'  
      }); 
	  return false;
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});			
	return false;	  
  }
}

//CONFIRMACION DE RESPUESTA ENVIADA
//CUANDO SE ENVIAN RESPUESTA Y SE AGREGA INFORMACIÓN SOBRE LO RECIBIDO
function modal_agregar_confirmacion_referencia_recibida(referencia_id, colaborador_id, servicio_id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/referencias/getRegistrosReferencia.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'referencia_id='+referencia_id,
		success: function(valores){
			var datos = eval(valores);
			cleanConfirmacion();
			$('#formulario_agregar_info_respuesta_enviada')[0].reset();
            $('#formulario_agregar_info_respuesta_enviada #pro_info_respuesta').val("Registo");
			$('#formulario_agregar_info_respuesta_enviada #referencia_info_respuesta').val(referencia_id);
			$('#formulario_agregar_info_respuesta_enviada #colaborador_id_info_respuesta').val(colaborador_id);
			$('#formulario_agregar_info_respuesta_enviada #servicio_id_info_respuesta').val(servicio_id);
            $('#formulario_agregar_info_respuesta_enviada #expediente_info_respuesta').val(datos[0]);
            $('#formulario_agregar_info_respuesta_enviada #identidad_info_respuesta').val(datos[1]);
            $('#formulario_agregar_info_respuesta_enviada #nombre_info_respuesta').val(datos[2]);			
			$('#formulario_agregar_info_respuesta_enviada #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			$('#formulario_agregar_info_respuesta_enviada #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX				   
			$('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta').hide();
			$('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta1').show();				
			getConfirmacion_rr_no();
       	    $('#formulario_agregar_info_respuesta_enviada #mensaje_info_respuesta').removeClass('bien');
            $('#formulario_agregar_info_respuesta_enviada #mensaje_info_respuesta').removeClass('error');
            $('#formulario_agregar_info_respuesta_enviada #mensaje_info_respuesta').removeClass('alerta');
	        $('#formulario_agregar_info_respuesta_enviada #mensaje_info_respuesta').html('');
	
	        $('#agregar_info_confirmacion_enviada').modal({
	          show:true,
			  keyboard: false,
	          backdrop:'static'  
            }); 
			return false;
		}
	});	
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});					 
 }	
}

//BOTON ENVIAR FORMULARIO AGREGAR INFO DE RESPUESTA (REFERENCIAS RECIBIDAS)
$('#reg_info_respuesta').on('click', function(e){
	e.preventDefault();
    if($('#formulario_agregar_info_respuesta_enviada #observacion_info_respuesta').val() != "" && $('#formulario_agregar_info_respuesta_enviada #expediente_info_respuesta').val() != "" && ($('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta').val() != "" || $('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta1').val() != "") ){
		agregaRespuesta_confirmacion_recibida();	
		return false;
	}else{
		swal({
			title: "Error", 
			text: "Hay registros en blanco. Por favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;
	}
});

//BOTON ENVIAR FORMULARIO AGREGAR RESPUESTA (REFERENCIAS ENVIADAS)
$('#formulario_agregar_respuesta_referencia_enviada #reg_info_respuesta').on('click', function(e){	
	e.preventDefault();
    if($('#formulario_agregar_respuesta_referencia_enviada #observacion_info_respuesta').val() != "" && $('#formulario_agregar_respuesta_referencia_enviada #expediente_info_respuesta').val() != ""){		
		agregaRespuestaRecibida();	
		return false;
	}else{
		swal({
			title: "Error", 
			text: "Hay registros en blanco. Por favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		
		return false;
	}
});

function cleanConfirmacion(){
	$('#formulario_agregar_info_respuesta_enviada #correo_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_enviada #observacion_info_respuesta').val("");
	getConfirmacion_rr_no();
}

function cleanRespuestaRecibida(){
	$('#formulario_agregar_info_respuesta_enviada #correo_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_enviada #observacion_info_respuesta').val("");
}

function cleanRespuestaEnviada(){
	$('#formulario_agregar_respuesta_referencia_enviada #correo_info_respuesta').val("");
	$('#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta').val("");
	$('#formulario_agregar_respuesta_referencia_enviada #observacion_info_respuesta').val("");
	$('#formulario_agregar_respuesta_referencia_enviada #validate').html("");
	$('#formulario_agregar_respuesta_referencia_enviada #validate').removeClass("error");
	$('#formulario_agregar_respuesta_referencia_enviada #validate').removeClass("bien");
	$('#formulario_agregar_respuesta_referencia_enviada #validate').removeClass("alerta");
}

function agregaRespuesta_confirmacion_recibida(){
	var url = '<?php echo SERVERURL; ?>php/referencias/agregarConfirmacionReferenciaRecibida.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_info_respuesta_enviada').serialize(),
		success: function(registro){
			if (registro == 1){
				$('formulario_agregar_info_respuesta_enviada #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				$('#formulario_agregar_info_respuesta_enviada #pro_info_respuesta').val('Registro');
				$('#formulario_agregar_info_respuesta_enviada #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
				$('#formulario_agregar_info_respuesta_enviada #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX				   
				$('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta').hide();
				$('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta1').show();
				cleanConfirmacion();
				return false;
			}else if(registro == 2){	
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanConfirmacion();
				return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Error al intentar almacenar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanConfirmacion();
				return false;
			}else{		
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});						   			   
				cleanConfirmacion();
				return false;
			}
		}
	});	
}

//AGREGAR RESPUESTA RECIBIDA
function agregaRespuestaRecibida(){
	var url = '<?php echo SERVERURL; ?>php/referencias/agregarRespuestaReferenciaRecibida.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_respuesta_referencia_enviada').serialize(),
		success: function(registro){
			if (registro == 1){
				$('formulario_agregar_respuesta_referencia_enviada #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				$('#formulario_agregar_respuesta_referencia_enviada #pro_info_respuesta').val('Registro');
				$('#formulario_agregar_respuesta_referencia_enviada #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
				$('#formulario_agregar_respuesta_referencia_enviada #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX				   
				$('#formulario_agregar_respuesta_referencia_enviada #grupo_confirmacion_respuesta').hide();
				$('#formulario_agregar_respuesta_referencia_enviada #grupo_confirmacion_respuesta1').show();
				cleanRespuestaEnviada();
				pagination_referencias_enviadas(1)
				return false;
			}else if(registro == 2){	
				swal({
					title: "Error", 
					text: "Error al intentar almacenar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanRespuestaEnviada();
				return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Hay registros en blanco. Por favor corregir",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});						   			   		   
			   cleanRespuestaEnviada();
			   return false;
			}else if(registro == 4){	
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanRespuestaEnviada();
				return false;
			}else{		
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   
				cleanRespuestaEnviada();
				return false;
			}
		}
	});	
}

/*CONFIRMACION DE RESPUESTA A REFERENCIA ENVIADA*/
//CUANDO SE RECIBEN RESPUESTAS Y SE ENVIAN CONFIRMACIÓN DE RECIBIDO
function modal_agregar_confirmacion_referencia_enviada(referencia_id, colaborador_id, servicio_id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/referencias/getRegistrosReferenciaEnviada.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'referencia_id='+referencia_id,
		success: function(valores){
			var datos = eval(valores);
			cleanConfirmacion_referencia_recibida();
			getConfirmacion_rr_no();
			//$('#formulario_agregar_info_respuesta_recibida')[0].reset();
            $('#formulario_agregar_info_respuesta_recibida #pro_info_respuesta').val("Registo");
			$('#formulario_agregar_info_respuesta_recibida #referencia_info_respuesta').val(referencia_id);
			$('#formulario_agregar_info_respuesta_recibida #colaborador_id_info_respuesta').val(colaborador_id);
			$('#formulario_agregar_info_respuesta_recibida #servicio_id_info_respuesta').val(servicio_id);
            $('#formulario_agregar_info_respuesta_recibida #expediente_info_respuesta').val(datos[0]);
            $('#formulario_agregar_info_respuesta_recibida #identidad_info_respuesta').val(datos[1]);
            $('#formulario_agregar_info_respuesta_recibida #nombre_info_respuesta').val(datos[2]);
			$('#formulario_agregar_info_respuesta_recibida #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX
			$('#formulario_agregar_info_respuesta_recibida #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX					   
			$('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida').hide();
			$('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida1').show();
	
	        $('#agregar_info_confirmacion_recibida').modal({
	          show:true,
			  keyboard: false,
	          backdrop:'static'  
            }); 
			return false;
		}
	});	
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});					 
 }	
}

//AGREGAR RESPUESTA A REFERENCIA ENVIADA
function modal_agregar_respuesta_referencia_enviada(referencia_id, colaborador_id, servicio_id, pacientes_id){
if(getEstatusRespuestaRecibida(referencia_id) == 'No'){	
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/referencias/getRegistrosReferenciaEnviada.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'referencia_id='+referencia_id,
		success: function(valores){
			var datos = eval(valores);
			cleanConfirmacion_referencia_recibida();
			getConfirmacion_rr_no();
			$('#formulario_agregar_respuesta_referencia_enviada')[0].reset();
            $('#formulario_agregar_respuesta_referencia_enviada #pro_info_respuesta').val("Registo");
			$('#formulario_agregar_respuesta_referencia_enviada #referencia_info_respuesta').val(referencia_id);
			$('#formulario_agregar_respuesta_referencia_enviada #colaborador_id_info_respuesta').val(colaborador_id);
			$('#formulario_agregar_respuesta_referencia_enviada #servicio_id_info_respuesta').val(servicio_id);
            $('#formulario_agregar_respuesta_referencia_enviada #expediente_info_respuesta').val(datos[0]);
            $('#formulario_agregar_respuesta_referencia_enviada #identidad_info_respuesta').val(datos[1]);
            $('#formulario_agregar_respuesta_referencia_enviada #nombre_info_respuesta').val(datos[2]);
			$('#formulario_agregar_respuesta_referencia_enviada #fecha_info_respuesta').val(datos[4]);
			$('#formulario_agregar_respuesta_referencia_enviada #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX
			$('#formulario_agregar_respuesta_referencia_enviada #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX					   				
       	    $('#formulario_agregar_respuesta_referencia_enviada #mensaje_info_respuesta').removeClass('bien');
            $('#formulario_agregar_respuesta_referencia_enviada #mensaje_info_respuesta').removeClass('error');
            $('#formulario_agregar_respuesta_referencia_enviada #mensaje_info_respuesta').removeClass('alerta');
	        $('#formulario_agregar_respuesta_referencia_enviada #mensaje_info_respuesta').html('');
	
	        $('#agregar_info_respuesta_referencia_enviada').modal({
	          show:true,
			  keyboard: false,
	          backdrop:'static'  
            }); 
			return false;
		}
	});	
    }else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
    }	
  }else{
		var nombre_usuario = consultarNombre(pacientes_id);
		var expediente_usuario = consultarExpediente(pacientes_id);
		var dato;

		if(expediente_usuario == 0){
		   dato = nombre_usuario;
		}else{
		  dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
		}	  
	  
		swal({
			title: "Error", 
			text: "Esta referencia del usuario " + dato + " ya tiene una respuesta",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		  		 
  }
}


//BOTON ENVIAR FORMULARIO AGREGAR INFO DE RESPUESTA ENVIADA (REFERENCIAS ENVIADAS)
$('#reg_confirmacion_recibida').on('click', function(e){
    e.preventDefault();
	if($('#formulario_agregar_info_respuesta_recibida #observacion_info_respuesta').val() != "" && $('#formulario_agregar_info_respuesta_recibida #expediente_info_respuesta').val() != "" && ($('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida').val() || $('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida1').val())){	   
	   agregaConfirmacion_referencia_enviada();	
	   return false;
	}else{
		swal({
			title: "Error", 
			text: "Hay registros en blanco. Por favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		
		return false;
	}   
});

function cleanConfirmacion_referencia_recibida(){
	$('#formulario_agregar_info_respuesta_recibida #correo_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_recibida #telefono_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_recibida #observacion_info_respuesta').val("");
	$('#formulario_agregar_info_respuesta_recibida #validate').html("");
	$('#formulario_agregar_info_respuesta_recibida #validate').removeClass("error");
	$('#formulario_agregar_info_respuesta_recibida #validate').removeClass("bien");
	$('#formulario_agregar_info_respuesta_recibida #validate').removeClass("alerta");
	getConfirmacion_rr_no();
}

function agregaConfirmacion_referencia_enviada(){
	var url = '<?php echo SERVERURL; ?>php/referencias/agregarConfirmacionReferenciaEnviada.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_info_respuesta_recibida').serialize(),
		success: function(registro){
			if (registro == 1){				
				$('formulario_agregar_info_respuesta_recibida #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#formulario_agregar_info_respuesta_recibida #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX
				$('#formulario_agregar_info_respuesta_recibida #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX					   
				$('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida').hide();
				$('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida1').show();
				$('#formulario_agregar_info_respuesta_recibida #correo_info_respuesta').val("");			   
				getConfirmacion_rr_no();		
				cleanConfirmacion_referencia_recibida();
				pagination_referencias_enviadas(1);
				return false;
			}else if(registro == 2){	
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanConfirmacion_referencia_recibida();
				return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Error al intentar almacenar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanConfirmacion_referencia_recibida();
				return false;
			}else if(registro == 4){	
				swal({
					title: "Error", 
					text: "Hay registros en blanco, por favor corregir",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   		   
				cleanConfirmacion_referencia_recibida();
				return false;
			}else{		
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					   			   
				cleanConfirmacion_referencia_recibida();
				return false;
			}
		}
	});	
}

//RESPUESTA A LA CONFIRMACIÓN DEL USUARIO RESPUESTA ENVIADA
//****************************************************************************************************************************
//SI
$(document).ready(function() {
	$('#formulario_agregar_info_respuesta_enviada #si_info_respuesta').on('click', function(){
         $('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta').show();
		 $('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta1').hide();
         getConfirmacion_rr_si();				 
    });					
});

//NO
$(document).ready(function() {
	$('#formulario_agregar_info_respuesta_enviada #no_info_respuesta').on('click', function(){
         $('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta').hide();
		 $('#formulario_agregar_info_respuesta_enviada #grupo_confirmacion_respuesta1').show();
         getConfirmacion_rr_no();			 
    });					
});
//****************************************************************************************************************************

//RESPUESTA A LA CONFIRMACIÓN DEL USUARIO RESPUESTA RECIBIDA
//****************************************************************************************************************************
//SI
$(document).ready(function() {
	$('#formulario_agregar_info_respuesta_recibida #si_info_respuesta').on('click', function(){
         $('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida').show();
		 $('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida1').hide();
         getConfirmacion_rr_si();				 
    });					
});

//NO
$(document).ready(function() {
	$('#formulario_agregar_info_respuesta_recibida #no_info_respuesta').on('click', function(){
         $('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida').hide();
		 $('#formulario_agregar_info_respuesta_recibida #grupo_confirmacion_respuesta_recibida1').show();
         getConfirmacion_rr_no();			 
    });					
});
//****************************************************************************************************************************

//REFERENCIA RECIBIDA
function getNivelEditarReferenciasRecibidas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_edicion_referencias_recibidas #centros_nivel').html("");
			$('#formulario_edicion_referencias_recibidas #centros_nivel').html(data);	
			$('#formulario_centros #centros_centro').selectpicker('refresh');		
        }
     });		
}

function getCentroEditarReferenciasRecibidas(nivel, centro, recibidade){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';		

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel,
        success: function(data){
		    $('#formulario_edicion_referencias_recibidas #centro').html("");
			$('#formulario_edicion_referencias_recibidas #centro').html(data);
			$('#formulario_edicion_referencias_recibidas #centro').selectpicker('refresh');		
			$('#formulario_edicion_referencias_recibidas #centro').val(centro);
			$('#formulario_edicion_referencias_recibidas #centro').selectpicker('refresh');
            getCentroEditarReferenciasRecibidasRecibidade(nivel, centro, recibidade);			
        }
     });		
}

function getCentroEditarReferenciasRecibidasRecibidade(nivel, centro, recibidade){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';		

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel+'&centro='+centro,
        success: function(data){
		    $('#formulario_edicion_referencias_recibidas #recibidade').html("");
			$('#formulario_edicion_referencias_recibidas #recibidade').html(data);
			$('#formulario_edicion_referencias_recibidas #recibidade').selectpicker('refresh');		
			$('#formulario_edicion_referencias_recibidas #recibidade').val(recibidade);	
			$('#formulario_edicion_referencias_recibidas #recibidade').selectpicker('refresh');	
        }
     });		
}

$(document).ready(function() {
	$('#formulario_edicion_referencias_recibidas #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       	
        var nivel = $('#formulario_edicion_referencias_recibidas #centros_nivel').val();		
		var centro = $('#formulario_edicion_referencias_recibidas #centro').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_edicion_referencias_recibidas #recibidade').html("");
			  $('#formulario_edicion_referencias_recibidas #recibidade').html(data);	
			  $('#formulario_edicion_referencias_recibidas #recibidade').selectpicker('refresh');		  
		  }
	  });
	  return false;			 				
    });					
});

//REFERENCIA ENVIADA
function getNivelEditarReferenciasEnviadas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').html("");
			$('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').html(data);
			$('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').selectpicker('refresh');				
        }
     });		
}

function getPatologia1EdicionReferenciasEnviadas1(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_edicion_referencias_enviadas #patologia1').html("");
				$('#formulario_edicion_referencias_enviadas #patologia1').html(data);
				$('#formulario_edicion_referencias_enviadas #patologia1').selectpicker('refresh');
		}	
   });
   return false;	
}

function getPatologia1EdicionReferenciasEnviadas2(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_edicion_referencias_enviadas #patologia2').html("");
				$('#formulario_edicion_referencias_enviadas #patologia2').html(data);
				$('#formulario_edicion_referencias_enviadas #patologia1').selectpicker('refresh');
		}	
   });
   return false;	
}

function getPatologia1EdicionReferenciasEnviadas3(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_edicion_referencias_enviadas #patologia3').html("");
				$('#formulario_edicion_referencias_enviadas #patologia3').html(data);
				$('#formulario_edicion_referencias_enviadas #patologia3').selectpicker('refresh');
		}	
   });
   return false;	
}

function getCentroEditarReferenciasEnviadas(nivel, centro, recibidade){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';		

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel,
        success: function(data){
		    $('#formulario_edicion_referencias_enviadas #centro_enviada').html("");
			$('#formulario_edicion_referencias_enviadas #centro_enviada').html(data);
			$('#formulario_edicion_referencias_enviadas #centro_enviada').selectpicker('refresh');		
			$('#formulario_edicion_referencias_enviadas #centro_enviada').val(centro);
			$('#formulario_edicion_referencias_enviadas #centro_enviada').selectpicker('refresh');
            getCentroEditarReferenciasRecibidasEnviadaa(nivel, centro, recibidade);			
        }
     });		
}

function getCentroEditarReferenciasRecibidasEnviadaa(nivel, centro, recibidade){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';		

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel+'&centro='+centro,
        success: function(data){
		    $('#formulario_edicion_referencias_enviadas #enviadaa').html("");
			$('#formulario_edicion_referencias_enviadas #enviadaa').html(data);
			$('#formulario_edicion_referencias_enviadas #enviadaa').selectpicker('refresh');		
			$('#formulario_edicion_referencias_enviadas #enviadaa').val(recibidade);
			$('#formulario_edicion_referencias_enviadas #enviadaa').selectpicker('refresh');				
        }
     });		
}

$(document).ready(function() {
	$('#formulario_edicion_referencias_enviadas #centro_enviada').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       	
        var nivel = $('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').val();		
		var centro = $('#formulario_edicion_referencias_enviadas #centro_enviada').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_edicion_referencias_enviadas #enviadaa').html("");
			  $('#formulario_edicion_referencias_enviadas #enviadaa').html(data);	
			  $('#formulario_edicion_referencias_enviadas #enviadaa').selectpicker('refresh');		  
		  }
	  });
	  return false;			 				
    });					
});


//FROMULARIO AGREGAR REFERENCIAS RECIBIDAS
function getNivelAgregarReferenciasRecibidas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_recibidas #centros_nivel').html("");
			$('#formulario_agregar_referencias_recibidas #centros_nivel').html(data);
			$('#formulario_agregar_referencias_recibidas #centros_nivel').selectpicker('refresh');				
        }
     });		
}

function getCentroAgregarReferenciasRecibidas(){   
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
   var nivel = $('#formulario_agregar_referencias_recibidas #centros_nivel').val();   
   
	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel,
		async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_recibidas #centro').html("");
			$('#formulario_agregar_referencias_recibidas #centro').html(data);
			$('#formulario_agregar_referencias_recibidas #centro').selectpicker('refresh');
        }
     });		
}

$(document).ready(function() {
	$('#formulario_agregar_referencias_recibidas #centros_nivel').on('change', function(){
		getCentroAgregarReferenciasRecibidas();
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_referencias_recibidas #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       	
        var nivel = $('#formulario_agregar_referencias_recibidas #centros_nivel').val();		
		var centro = $('#formulario_agregar_referencias_recibidas #centro').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_agregar_referencias_recibidas #recibidade').html("");
			  $('#formulario_agregar_referencias_recibidas #recibidade').html(data);	
			  $('#formulario_agregar_referencias_recibidas #recibidade').selectpicker('refresh');			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	  $('#formulario_agregar_referencias_recibidas #unidad').on('change', function(){
		var servicio_id = $('#formulario_agregar_referencias_recibidas #servicio').val();
		var puesto_id = $('#formulario_agregar_referencias_recibidas #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
				$('#formulario_agregar_referencias_recibidas #medico_general').html(data);
				$('#formulario_agregar_referencias_recibidas #medico_general').selectpicker('refresh');			
            }
         });
		 
      });					
});

function getPatologia1ReferenciasRecibidas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#formulario_agregar_referencias_recibidas #patologia1').html("");
			$('#formulario_agregar_referencias_recibidas #patologia1').html(data);
			$('#formulario_agregar_referencias_recibidas #patologia1').selectpicker('refresh');
		}	
   });
   return false;		
}

function getPatologia1EdicionReferenciasRecibidas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#editar_referencias_recibidas #patologia').html("");
			$('#editar_referencias_recibidas #patologia').html(data);
			$('#editar_referencias_recibidas #patologia').selectpicker('refresh');
		}	
   });
   return false;		
}

function getServicioReferenciasRecibidas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_referencias_recibidas #servicio').html("");
			$('#formulario_agregar_referencias_recibidas #servicio').html(data);
			$('#formulario_agregar_referencias_recibidas #servicio').selectpicker('refresh');
		}			
     });		
}

$(document).ready(function() {
	  $('#formulario_agregar_referencias_recibidas #servicio').on('change', function(){
		var servicio_id = $('#formulario_agregar_referencias_recibidas #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/referencias/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_agregar_referencias_recibidas #unidad').html(data);	
				$('#formulario_agregar_referencias_recibidas #unidad').selectpicker('refresh');		
            }
         });
		 
      });					
});

$(document).ready(function(e) {
    $('#formulario_agregar_referencias_recibidas #expediente').on('blur', function(){
	 if($('#formulario_agregar_referencias_recibidas #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_agregar_referencias_recibidas #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){		  
					swal({
						title: "Error", 
						text: "Registro no encontrado",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_rr").attr('disabled', true);
					return false;
			  }else if (array[0] == "Error_Temporal"){		  
					swal({
						title: "Error", 
						text: "Este es un usuario Temporal, por favor verificar con el área de Admisión",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_rr").attr('disabled', true);				  
				 return false;
			  }else if (array[0] == "Bien"){
			     $('#formulario_agregar_referencias_recibidas #identidad').val(array[1]);
                 $('#formulario_agregar_referencias_recibidas #nombre').val(array[2]);			  		 
                 $("#reg_rr").attr('disabled', true);

                 limpiarReferenciasRecibidas();
			  }else{		  
					swal({
						title: "Error", 
						text: "Error, no se puede procesar su consulta, intentenlo nuevamente",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_rr").attr('disabled', true);	
				  
			  }	  			  
		  }
	  });
	  return false;		
	 }else{
		$('#formulario_agregar_referencias_recibidas')[0].reset();
	    $('#formulario_agregar_referencias_recibidas #pro').val('Registro');		
        $("#reg_rr").attr('disabled', true);		
	 }
	});
});

//FROMULARIO AGREGAR REFERENCIAS ENVIADAS
function getNivelAgregarReferenciasEnviadas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_enviadas #centros_nivel').html("");
			$('#formulario_agregar_referencias_enviadas #centros_nivel').html(data);
			$('#formulario_agregar_referencias_enviadas #centros_nivel').selectpicker('refresh');					
        }
     });		
}

function getCentroAgregarReferenciasEnviadas(){
   var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
   var nivel = $('#formulario_agregar_referencias_enviadas #centros_nivel').val();   

	$.ajax({
        type: "POST",
        url: url,
	    data:'nivel='+nivel,
        success: function(data){
		    $('#formulario_agregar_referencias_enviadas #centro').html("");
			$('#formulario_agregar_referencias_enviadas #centro').html(data);
			$('#formulario_agregar_referencias_enviadas #centro').selectpicker('refresh');		
        }
     });		
}

$(document).ready(function() {
	$('#formulario_agregar_referencias_enviadas #centros_nivel').on('change', function(){
		getCentroAgregarReferenciasEnviadas();
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_referencias_enviadas #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       	
        var nivel = $('#formulario_agregar_referencias_enviadas #centros_nivel').val();		
		var centro = $('#formulario_agregar_referencias_enviadas #centro').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_agregar_referencias_enviadas #enviadaa').html("");
			  $('#formulario_agregar_referencias_enviadas #enviadaa').html(data);	
			  $('#formulario_agregar_referencias_enviadas #enviadaa').selectpicker('refresh');			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	  $('#formulario_agregar_referencias_enviadas #unidad').on('change', function(){
			getProfesionalReferenciasEnviadas();
      });					
});

function getProfesionalReferenciasEnviadas(){
	var servicio_id = $('#formulario_agregar_referencias_enviadas #servicio').val();
	var puesto_id = $('#formulario_agregar_referencias_enviadas #unidad').val();
	var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';		
	
	$.ajax({
		type: "POST",
		url: url,
		async: true,
		data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
		success: function(data){
			$('#formulario_agregar_referencias_enviadas #medico_general').html(data);
			$('#formulario_agregar_referencias_enviadas #medico_general').selectpicker('refresh');				
		}
	 });
	 return false;	
}

function getServicioReferenciasEnviadas(){
    var url = '<?php echo SERVERURL; ?>php/referencias/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_referencias_enviadas #servicio').html("");
			$('#formulario_agregar_referencias_enviadas #servicio').html(data);
			$('#formulario_agregar_referencias_enviadas #servicio').selectpicker('refresh');
		}			
     });		
}

$(document).ready(function() {
	  $('#formulario_agregar_referencias_enviadas #servicio').on('change', function(){
			getUnidadReferenciasEnviadas()
      });					
});

function getUnidadReferenciasEnviadas(){
	var servicio_id = $('#formulario_agregar_referencias_enviadas #servicio').val();
	var url = '<?php echo SERVERURL; ?>php/referencias/getUnidad.php';		
	
	$.ajax({
		type: "POST",
		url: url,
		async: true,
		data:'servicio='+servicio_id,
		success: function(data){
			$('#formulario_agregar_referencias_enviadas #unidad').html(data);
			$('#formulario_agregar_referencias_enviadas #unidad').selectpicker('refresh');				
		}
	 });
	 return false;	
}

function getPatologia1ReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_referencias_enviadas #patologia1').html("");
				$('#formulario_agregar_referencias_enviadas #patologia1').html(data);
				$('#formulario_agregar_referencias_enviadas #patologia1').selectpicker('refresh');
		}	
   });
   return false;		
}

function getPatologia2ReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_referencias_enviadas #patologia2').html("");
				$('#formulario_agregar_referencias_enviadas #patologia2').html(data);
				$('#formulario_agregar_referencias_enviadas #patologia2').selectpicker('refresh');
		}	
   });
   return false;		
}

function getPatologia3ReferenciasEnviadas(){
  var url = '<?php echo SERVERURL; ?>php/referencias/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_referencias_enviadas #patologia3').html("");
				$('#formulario_agregar_referencias_enviadas #patologia3').html(data);
				$('#formulario_agregar_referencias_enviadas #patologia3').selectpicker('refresh');
		}	
   });
   return false;		
}

$(document).ready(function(e) {
    $('#formulario_agregar_referencias_enviadas #expediente').on('blur', function(){
	 if($('#formulario_agregar_referencias_enviadas #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/referencias/buscar_expediente.php';
        var expediente = $('#formulario_agregar_referencias_enviadas #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0] == "Error"){		  
					swal({
						title: "Error", 
						text: "Registro no encontrado",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});	
					$("#reg_re").attr('disabled', true);
					return false;
			  }else if (array[0] == "Error_Temporal"){		  
					swal({
						title: "Error", 
						text: "Este es un usuario Temporal, por favor verificar con el área de Admisión",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});	
					$("#reg_re").attr('disabled', true);			  
					return false;
			  }else if (array[0] == "Bien"){
			      $('#formulario_agregar_referencias_enviadas #identidad').val(array[1]);
                  $('#formulario_agregar_referencias_enviadas #nombre').val(array[2]);			  		 
                  $("#reg_re").attr('disabled', false);
                  limpiarReferenciasEnviadas();
			  }else{	
					swal({
						title: "Error", 
						text: "Error, no se puede procesar su consulta, intentenlo nuevamente",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});					  
					$("#reg_re").attr('disabled', true);				  
			  }	  			  
		  }
	  });
	  return false;		
	 }else{
		$('#formulario_agregar_referencias_enviadas')[0].reset();
	    $('#formulario_agregar_referencias_enviadas #pro').val('Registro');		
        $("#reg_re").attr('disabled', true);			
	 }
	});
});

//INICIO REPORTES
function reporteEXCEL(){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var servicio = "";
	var consolidado = $('#form_main #consolidado').val();
    var url = '';	
	
	if( $('#form_main #servicio').val() == null){
		servicio = 0;
	}else if( $('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
	var referencia = "";
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}
	
	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteReferenciasEnviadas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&consolidado='+consolidado;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteReferenciasRecibidas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&consolidado='+consolidado;
	}		

	window.open(url);    	
}

function reporteEXCELPatologia(){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var servicio = "";
	var consolidado = $('#form_main #consolidado').val();
    var url = '';	
	
	if( $('#form_main #servicio').val() == null){
		servicio = 0;
	}else if( $('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
	var referencia = "";
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}

	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteSM03RE.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&consolidado='+consolidado;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteSM03RR.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&consolidado='+consolidado;
	}		

	window.open(url);    	
}

//INICIO REPORTES UGD
function reporteEXCEL_UGD(){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var servicio = "";
    var url = '';	
	var referencia = "";
	
	if( $('#form_main #servicio').val() == null){
		servicio = 0;
	}else if( $('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}		
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}
	
	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteReferenciasEnviadasUGD.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteReferenciasRecibidasUGD.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}		

	window.open(url);    	
}

function reporteConsolidadoEXCEL_UGD(){
	var referencia = "";
	var años = "";
	var servicio = "";
	
	if($('#formulario_modal_consolidado_referencias #consolidado_ref_ugd').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#formulario_modal_consolidado_referencias #consolidado_ref_ugd').val();
	}	
	
	if($('#formulario_modal_consolidado_referencias #año_ref_ugd').val() == ""){
		años = "";		
	}else{
		años = $('#formulario_modal_consolidado_referencias #año_ref_ugd').val();
	}

	if( $('#formulario_modal_consolidado_referencias #servicio_ref_ugd').val() == null){
		servicio = 0;
	}else if( $('#formulario_modal_consolidado_referencias #servicio_ref_ugd').val() == 0){
		servicio = $('#formulario_modal_consolidado_referencias #servicio_ref_ugd').val();
	}else{
		servicio = $('#formulario_modal_consolidado_referencias #servicio_ref_ugd').val();
	}	
	

	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteConsolidadoReferenciasEnviadasUGD.php?referencia='+referencia+'&años='+años+'&servicio='+servicio;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteConsolidadoReferenciasRecibidasUGD.php?referencia='+referencia+'&años='+años+'&servicio='+servicio;
	}		

	window.open(url);
}


function reporteMensualMotivosEXCEL_UGD(){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var servicio = "";
    var url = '';	
	var referencia = "";
	
	if( $('#form_main #servicio').val() == null){
		servicio = 0;
	}else if( $('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}		
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}
	
	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteMensualMotivosReferenciasUGD.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteReferenciasRecibidasUGD.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}		

	window.open(url);  	
}
//FIN REPORTES UGd

//FIN REPORTES

function reporteProcedencias(){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var servicio = "";
	var referencia = "";
	
	if($('#form_main #servicio').val() == null){
		servicio = 0;
	}else if($('#form_main #servicio').val() == 0){
		servicio = $('#form_main #servicio').val();
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}
	
	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteProcedenciasReferenciasEnviadas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteProcedenciasReferenciasRecibidas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}	

	window.open(url);    	
}

function reporteCentros(){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var servicio = $('#form_main #servicio').val();
	
	var referencia = "";
	
	if($('#form_main #referencias').val() == ""){
		referencia = 1;		
	}else{
		referencia = $('#form_main #referencias').val();
	}
	
	if(referencia == 1){
		url = '<?php echo SERVERURL; ?>php/referencias/reporteCentrosReferenciasEnviadas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}else{
		url = '<?php echo SERVERURL; ?>php/referencias/reporteCentrosReferenciasRecibidas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}	

	window.open(url);    	
}

function modal_eliminarRecibidas(ata_id, expediente, referenciar_id, pacientes_id){	
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		var nombre_usuario = consultarNombre(pacientes_id);
		var expediente_usuario = consultarExpediente(pacientes_id);
		var dato;

		if(expediente_usuario == 0){
		  dato = nombre_usuario;
		}else{
		  dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
		}
	  
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar la referencia recibida del usuario: " + dato + "?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar la referencia!",
			closeOnConfirm: false,
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(){
			eliminarReferenciaRecibida(ata_id,expediente,referenciar_id);
		});		   
   }else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});						 
	}	
}

function modal_eliminarEnviadas(ata_id,expediente, referenciar_id, pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){   
		var nombre_usuario = consultarNombre(pacientes_id);
		var expediente_usuario = consultarExpediente(pacientes_id);
		var dato;

		if(expediente_usuario == 0){
		  dato = nombre_usuario;
		}else{
		  dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
		}
	  	
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar la referencia enviada del usuario: " + dato + "?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar la referencia!",
			closeOnConfirm: false,
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(){
			eliminarReferenciaEnviada(ata_id,expediente,referenciar_id);
		});	   	   
   }else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
	}	
}

function eliminarReferenciaRecibida(ata_id,expediente,referenciar_id){
	var url = '<?php echo SERVERURL; ?>php/referencias/eliminarReferenciasRecibidas.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'ata_id='+ata_id+'&expediente='+expediente+'&referencia='+referenciar_id,
		success: function(registro){
			if(registro == 1){
			   pagination_referencias_recibidas(1);
			   $('#bs-regis').val("");	
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			    return false;				
			}else if(registro == 2){
			   pagination_referencias_recibidas(1);
			   $('#form_main #bs-regis').val("");
				swal({
					title: "Error", 
					text: "Error al eliminar este registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		
			    return false;				
			}else{
				pagination_referencias_recibidas(1);
				$('#form_main #bs-regis').val("");		
				swal({
					title: "Error", 
					text: "No se puede procesar su solicitud",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
			    return false;				
			}
  		}
	}); 
	return false;	
}

function eliminarReferenciaEnviada(ata_id,expediente,referenciar_id){
	var url = '<?php echo SERVERURL; ?>php/referencias/eliminarReferenciasEnviadas.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'ata_id='+ata_id+'&expediente='+expediente+'&referencia='+referenciar_id,
		success: function(registro){
			pagination_referencias_enviadas(1);
			$('#bs-regis').val("");		
			swal({
				title: "Success", 
				text: "Registro Eliminado correctamente",
				type: "success", 
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});				
			return false;
  		}
	}); 
	return false;	
}

function getReporteR(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getReporteR.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #referencias').html("");
			$('#form_main #referencias').html(data);
			$('#form_main #referencias').selectpicker('refresh');				
		}			
     });		
}

function getReporteR_UGD(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getReporteR.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#modal_consolidado_referencias #consolidado_ref_ugd').html("");
			$('#modal_consolidado_referencias #consolidado_ref_ugd').html(data);
			$('#modal_consolidado_referencias #consolidado_ref_ugd').selectpicker('refresh');		
		}			
     });		
}

function limpiar(){
	getReporteR();
    getServicioFormMain();
    $('#agrega-registros').html("");
	$('#pagination').html("");		
}

$(document).ready(function() {
   $('#agregar_referencias_recibidas #medico_general').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		}else{
			swal({
				title: "Error", 
				text: "Hay registros en blanco, favor corregir",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});	
		}
		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_recibidas #centros_nivel').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		} 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_recibidas #centro').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		} 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_recibidas #recibidade').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		} 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_recibidas #patologia1').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		} 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_recibidas #servicio').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		} 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_recibidas #unidad').on('change', function(){
        if($('#agregar_referencias_recibidas #centros_nivel').val()!="" && $('#agregar_referencias_recibidas #centro').val()!="" && $('#agregar_referencias_recibidas #recibidade').val()!="" && $('#agregar_referencias_recibidas #patologia1').val()!="" && $('#agregar_referencias_recibidas #servicio').val()!="" && $('#agregar_referencias_recibidas #unidad').val()!="" && $('#agregar_referencias_recibidas #medico_general').val()!="" ){
			 $("#reg_rr").attr('disabled', false);				 
		} 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #medico_general').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" ){
			$("#reg_re").attr('disabled', false);				 
		}else{
			swal({
				title: "Error", 
				text: "Hay registros en blanco, favor corregir",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				
		}
		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #centros_nivel').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" ){
			$("#reg_re").attr('disabled', false);				 
		}		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #centro').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" ){
			$("#reg_re").attr('disabled', false);				 
		}		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #enviadaa').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" && $('#agregar_referencias_enviadas #motivo_traslado').val()!=""){
			$("#reg_re").attr('disabled', false);				 
		}		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #patologia1').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" && $('#agregar_referencias_enviadas #motivo_traslado').val()!=""){
			$("#reg_re").attr('disabled', false);				 
		}		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #servicio').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" && $('#agregar_referencias_enviadas #motivo_traslado').val()!=""){
			$("#reg_re").attr('disabled', false);				 
		}		 
   });					
});

$(document).ready(function() {
   $('#agregar_referencias_enviadas #unidad').on('change', function(){
        if($('#agregar_referencias_enviadas #centros_nivel').val()!="" && $('#agregar_referencias_enviadas #centro').val()!="" && $('#agregar_referencias_enviadas #enviadaa').val()!="" && $('#agregar_referencias_enviadas #patologia1').val()!="" && $('#agregar_referencias_enviadas #servicio').val()!="" && $('#agregar_referencias_enviadas #unidad').val()!="" && $('#agregar_referencias_enviadas #medico_general').val()!="" && $('#agregar_referencias_enviadas #motivo_traslado').val()!=""){
			$("#reg_re").attr('disabled', false);				 
		}		 
   });					
});

//EDITAR REFERENCIAS ENVIADAS
$(document).ready(function() {
	$('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
       		
		var nivel = $('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_edicion_referencias_enviadas #centro_enviada').html("");
			  $('#formulario_edicion_referencias_enviadas #centro_enviada').html(data);
			  $('#formulario_edicion_referencias_enviadas #centro_enviada').selectpicker('refresh');
              $("#reg_re").attr('disabled', true);			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#formulario_edicion_referencias_enviadas #centro_enviada').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       		
		var nivel = $('#formulario_edicion_referencias_enviadas #centros_nivel_enviada').val();
		var centro_id = $('#formulario_edicion_referencias_enviadas #centro_enviada').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro_id,
		   success:function(data){
		      $('#formulario_edicion_referencias_enviadas #enviadaa').html("");
			  $('#formulario_edicion_referencias_enviadas #enviadaa').html(data);
			  $('#formulario_edicion_referencias_enviadas #enviadaa').selectpicker('refresh');
			  $("#reg_re").attr('disabled', true);		  
		  }
	  });
	  return false;			 				
    });					
});

//EDITAR REFERENCIAS RECIBIDAS
$(document).ready(function() {
	$('#formulario_edicion_referencias_recibidas #centros_nivel').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
       		
		var nivel = $('#formulario_edicion_referencias_recibidas #centros_nivel').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_edicion_referencias_recibidas #centro').html("");
			  $('#formulario_edicion_referencias_recibidas #centro').html(data);	
			  $('#formulario_edicion_referencias_recibidas #centro').selectpicker('refresh');
              $("#reg_re").attr('disabled', true);			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#formulario_edicion_referencias_recibidas #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       		
		var nivel = $('#formulario_edicion_referencias_recibidas #centros_nivel').val();
		var centro_id = $('#formulario_edicion_referencias_recibidas #centro').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro_id,
		   success:function(data){
		      $('#formulario_edicion_referencias_recibidas #recibidade').html("");
			  $('#formulario_edicion_referencias_recibidas #recibidade').html(data);
			  $('#formulario_edicion_referencias_recibidas #recibidade').selectpicker('refresh');	
              $("#reg_re").attr('disabled', true);				  
		  }
	  });
	  return false;			 				
    });					
});

function getMes(fecha){
    var url = '<?php echo SERVERURL; ?>php/referencias/getMes.php';
	var resp;
	
	$.ajax({
	    type:'POST',
		data:'fecha='+fecha,
		url:url,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp	;	
}

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getMotivoTraslado(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTraslado.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_referencias_recibidas #motivo').html("");
			$('#formulario_agregar_referencias_recibidas #motivo').html(data);
			$('#formulario_agregar_referencias_recibidas #motivo').selectpicker('refresh');

		    $('#formulario_agregar_referencias_enviadas #motivo_traslado').html("");
			$('#formulario_agregar_referencias_enviadas #motivo_traslado').html(data);	
			$('#formulario_agregar_referencias_enviadas #motivo_traslado').selectpicker('refresh');		
		}			
     });		
}

function getMotivoTrasladoOtros(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTrasladoOtros.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_referencias_recibidas #motivo1').html("");
			$('#formulario_agregar_referencias_recibidas #motivo1').html(data);
			$('#formulario_agregar_referencias_recibidas #motivo1').selectpicker('refresh');
			
		    $('#formulario_agregar_referencias_enviadas #motivo').html("");
			$('#formulario_agregar_referencias_enviadas #motivo').html(data);
			$('#formulario_agregar_referencias_enviadas #motivo').selectpicker('refresh');	
		}			
     });		
}

function getConfirmacion_rr_si(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getConfirmacion_rr_si.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
            //RESPUESTA ENVIADA			
		    $('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta').html("");
			$('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta').html(data);
			$('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta').selectpicker('refresh');
			$('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta1').html("");	
            //RESPUESTA RECIBIDA			
		    $('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida').html("");
			$('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida').html(data);
			$('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida').selectpicker('refresh');
			$('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida1').html("");
		}			
     });		
}

function getConfirmacion_rr_no(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getConfirmacion_rr_no.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
            //RESPESTA ENVIDADA			
		    $('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta1').html("");
			$('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta1').html(data);
			$('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta1').selectpicker('refresh');	
			$('#formulario_agregar_info_respuesta_enviada #confirmo_respuesta').html("");			
			//RESPUESTA RECIBIDA
		    $('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida1').html("");
			$('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida1').html(data);
			$('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida1').selectpicker('refresh');
			$('#formulario_agregar_info_respuesta_recibida #confirmo_respuesta_recibida').html("");
		}			
     });		
}

function getEstatusRespuestaRecibida(referenciar_id){
    var url = '<?php echo SERVERURL; ?>php/referencias/getEstatusRespuestaRecibida.php';
	var respuesta;
	$.ajax({
	    type:'POST',
		url:url,
		data:'referenciar_id='+referenciar_id,
		async: false,
		success:function(data){	
          respuesta = data;			  		  		  			  
		}
	});
	return respuesta;	
}

function motivoTraslado(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTraslado.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_edicion_referencias_recibidas #motivo1').html("");
			$('#formulario_edicion_referencias_recibidas #motivo1').html(data);
			$('#formulario_edicion_referencias_recibidas #motivo1').selectpicker('refresh');

		    $('#formulario_edicion_referencias_enviadas #motivo').html("");
			$('#formulario_edicion_referencias_enviadas #motivo').html(data);
			$('#formulario_edicion_referencias_enviadas #motivo').selectpicker('refresh');	
		}			
     });		
}

function motivoTrasladoOtros(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTrasladoOtros.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_edicion_referencias_recibidas #motivo_otro1').html("");
			$('#formulario_edicion_referencias_recibidas #motivo_otro1').html(data);
			$('#formulario_edicion_referencias_recibidas #motivo_otro1').selectpicker('refresh');

		    $('#formulario_edicion_referencias_enviadas #motivo_otro').html("");
			$('#formulario_edicion_referencias_enviadas #motivo_otro').html(data);
			$('#formulario_edicion_referencias_enviadas #motivo_otro').selectpicker('refresh');		
		}			
     });		
}

function getAnos(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getAnos.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){			
		    $('#formulario_modal_consolidado_referencias #año_ref_ugd').html("");
			$('#formulario_modal_consolidado_referencias #año_ref_ugd').html(data);
			$('#formulario_modal_consolidado_referencias #año_ref_ugd').selectpicker('refresh');
		}			
     });		
}

function modal_consolidadoReferencias(){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	   $('#modal_consolidado_referencias').modal({
		  show:true,
		  keyboard: false,
		  backdrop:'static',
	   });	
	   getReporteR_UGD()
	   getAnos();
	   getServicioFormMainUGD()
       $('#formulario_modal_consolidado_referencias #pro').val('Búsqueda');	   
   }else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
	}	
}

function consultarNombre(pacientes_id){	
    var url = '<?php echo SERVERURL; ?>php/pacientes/getNombre.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp;	
}

function consultarExpediente(pacientes_id){	
    var url = '<?php echo SERVERURL; ?>php/pacientes/getExpedienteInformacion.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp;		
}

$(document).ready(function(){
  $('#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta').on('blur', function(e){
	  if($("#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta").val() != ""){
		   if($("#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta").val().length != 8) {
		      $("#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta").css("border-color", "red");	
              $("#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta").focus();		
		      $("#formulario_agregar_respuesta_referencia_enviada #reg_info_respuesta").attr('disabled', true);

              return false;
           }else{
		      $("#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta").css("border-color", "none");	
		      $("#formulario_agregar_respuesta_referencia_enviada #reg_info_respuesta").attr('disabled', false);		  
	       }
	  }else{
		  	$("#formulario_agregar_respuesta_referencia_enviada #telefono_info_respuesta").css("border-color", "none");	
		    $("#formulario_agregar_respuesta_referencia_enviada #reg_info_respuesta").attr('disabled', false);
	  }
  });
});

$(document).ready(function(){
  $('#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta').on('blur', function(e){
	  if($("#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta").val() != ""){
		   if($("#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta").val().length != 8) {
		      $("#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta").css("border-color", "red");	
              $("#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta").focus();		
		      $("#reg_info_respuesta").attr('disabled', true);

              return false;
           }else{
		      $("#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta").css("border-color", "none");	
		      $("#reg_info_respuesta").attr('disabled', false);		  
	       }
	  }else{
		  	$("#formulario_agregar_info_respuesta_enviada #telefono_info_respuesta").css("border-color", "none");	
		    $("#reg_info_respuesta").attr('disabled', false);
	  }
  });
});

function getDepartamento(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getDepartamento.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_centros #departamento_referencias').html("");
			$('#formulario_centros #departamento_referencias').html(data);
			$('#formulario_centros #departamento_referencias').selectpicker('refresh');
			
		    $('#formulario_centros #red_centro').html("");
			$('#formulario_centros #red_centro').html(data);
			$('#formulario_centros #red_centro').selectpicker('refresh');		
			
		    $('#formulario_centros #municipio_referencias').html("");			
		}			
     });		
}

$(document).ready(function() {
	$('#formulario_centros #departamento_referencias').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getMunicipio.php';
       		
		var departamento_id = $('#formulario_centros #departamento_referencias').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'departamento_id='+departamento_id,
		   success:function(data){
		      $('#formulario_centros #municipio_referencias').html("");
			  $('#formulario_centros #municipio_referencias').html(data);
			  $('#formulario_centros #municipio_referencias').selectpicker('refresh');

		      $('#formulario_centros #red_centro').html("");
			  $('#formulario_centros #red_centro').html(data);
			  $('#formulario_centros #red_centro').selectpicker('refresh');			  
		  }
	  });
	  return false;			 				
    });					
});  
</script>