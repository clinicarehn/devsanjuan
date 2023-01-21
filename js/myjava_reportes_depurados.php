<script>
$(document).ready(function() {
	  $('#nuevo-registro-fallecidos').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 16){
		  $('#formulario_agregar_fallecidos')[0].reset();		
     	  $('#formulario_agregar_fallecidos #pro').val('Registro');
		  $('#reg_fallecidos').show();
		  $('#edi_fallecidos').hide();
		  $('#formulario_agregar_fallecidos #expediente1').hide();
		  $('#formulario_agregar_fallecidos #expediente').show();
		  $('#formulario_agregar_fallecidos #expediente').attr('readonly', false);
		  $('#agregar_fallecidos').modal({
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
         }
	   });
	   
	  $('#nuevo-registro-pasivos').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		  $('#formulario_agregar_pasivos')[0].reset();		
     	  $('#formulario_agregar_pasivos #pro').val('Registro');
		  $('#reg_pasivos').show();
		  $('#edi_pasivos').hide();
		  $('#formulario_agregar_pasivos #expediente1').hide();
		  $('#formulario_agregar_pasivos #expediente').show();
		  $('#formulario_agregar_pasivos #expediente').attr('readonly', false);	
		  $('#agregar_pasivos').modal({
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
         }
	   });	   

   getReporte();
   getReporteBusqueda();
   getProfesionalPasivos();
   getServicioPasivos();
   getServicioFallecidos();
   getProfesionalFallecidos();
   pagination_depurados(1);
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_pasivos").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_pasivos #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_fallecidos").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_fallecidos #expediente').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_agregar_fallecidos #expediente').on('blur', function(){
	 if($('#formulario_agregar_fallecidos #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/reportes_depurados/buscar_expediente_fallecidos.php';
        var expediente = $('#formulario_agregar_fallecidos #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0]==='error_encontrar'){
					swal({
						title: "Error", 
						text: "Se ha presentado un error con el expediente de este registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_fallecidos").attr('disabled', true);
					$('#formulario_agregar_fallecidos #pro').val('Registro');
					return false;
			  }else if (array[0]==='error'){
					swal({
						title: "Error", 
						text: "Error al procesar su solicitud",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_fallecidos").attr('disabled', true);
					$('#formulario_agregar_fallecidos #pro').val('Registro');
					return false;
			  }else if (array[0]==='bien'){
                 $('#formulario_agregar_fallecidos #nombre').val(array[1]);			 
                 $('#formulario_agregar_fallecidos #servicio').val(array[2]);
                 $('#formulario_agregar_fallecidos #medico_general').val(array[3]);
                 $('#formulario_agregar_fallecidos #diagnostico').val(array[4]);
				 $('#formulario_agregar_fallecidos #fecha_cita').val(array[5]);
				 $('#formulario_agregar_fallecidos #motivo').focus();
                 $("#reg_fallecidos").attr('disabled', false);	
                 $('#formulario_agregar_fallecidos #pro').val('Registro');
			  }else{
					swal({
						title: "Error", 
						text: "Error al intentar procesar su solicitud, por favor intentelo nuevamente mas tarde",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});		  
					$('#formulario_agregar_fallecidos #expediente').focus();
					$("#reg_fallecidos").attr('disabled', true);
					$('#formulario_agregar_fallecidos #pro').val('Registro');				  
			  }	 	  			  
		  }
	  });
	  return false;		
	 }else{
		$('#formulario_agregar_fallecidos #pro').val('Registro');
        $("#reg_fallecidos").attr('disabled', true);		
	 }
	});
});

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_agregar_pasivos #expediente').on('blur', function(){
	 if($('#formulario_agregar_pasivos #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/reportes_depurados/buscar_expediente.php';
        var expediente = $('#formulario_agregar_pasivos #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);
			  if (array[0]=="error"){
					swal({
						title: "Error", 
						text: "Se ha presentado un error con el expediente de este registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});		  
					$('#formulario_agregar_pasivos #expediente').focus();
					$("#reg_pasivos").attr('disabled', true);
					$('#formulario_agregar_pasivos #pro').val('Registro');
					return false;
			  }else if (array[0]=="error_encontrar"){
					swal({
						title: "Error", 
						text: "Lo sentimos no se ha encontrado este registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});	  
					$('#formulario_agregar_pasivos #expediente').focus();
					$("#reg_pasivos").attr('disabled', true);
					$('#formulario_agregar_pasivos #pro').val('Registro');
					return false;
			  }else if (array[0]=="bien"){
			     $('#formulario_agregar_pasivos #identidad').val(array[1]);
				 $('#formulario_agregar_pasivos #fecha_cita').val(array[5]);
                 $('#formulario_agregar_pasivos #nombre').val(array[1]);			 
                 $('#formulario_agregar_pasivos #servicio').val(array[2]);
                 $('#formulario_agregar_pasivos #medico_general').val(array[6]);
                 $('#formulario_agregar_pasivos #diagnostico').val(array[4]);
				 $('#formulario_agregar_pasivos #motivo').focus();
                 $("#reg_pasivos").attr('disabled', false);
                 $('#formulario_agregar_pasivos #pro').val('Registro');				 
			  }else{
					swal({
						title: "Error", 
						text: "Error al intentar procesar su solicitud, por favor intentelo nuevamente mas tarde",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});		  
					$('#formulario_agregar_pasivos #expediente').focus();
					$("#reg_pasivos").attr('disabled', true);
					$('#formulario_agregar_pasivos #pro').val('Registro');				  
			  }	  			  
		  }
	  });
	  return false;		
	 }else{
        $("#reg_pasivos").attr('disabled', true);	
        $('#formulario_agregar_pasivos #pro').val('Registro');		
	 }
	});
});

$(document).ready(function() {
  $('#form_main #status').on('change', function(){	
     pagination_depurados(1);
  });
});

$(document).ready(function() {
  $('#form_main #reporte').on('change', function(){	
     pagination_depurados(1);
  });
});


$(document).ready(function() {
  $('#form_main #fecha_i').on('change', function(){	
     pagination_depurados(1);
  });
});

$(document).ready(function() {
  $('#form_main #fecha_f').on('change', function(){	
     pagination_depurados(1);
  });
});

$(document).ready(function() {
  $('#form_main #bs-regis').on('keyup', function(){	
     pagination_depurados(1);
  });
});

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/getReporte.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #status').html("");
			$('#form_main #status').html(data);
			$('#form_main #status').selectpicker('refresh');			
        }
     });		
}

function getReporteBusqueda(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/getReporteBusqueda.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #reporte').html("");
			$('#form_main #reporte').html(data);
			$('#form_main #reporte').selectpicker('refresh');			
        }
     });		
}

function getServicioFallecidos(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_fallecidos #servicio').html("");
			$('#formulario_agregar_fallecidos #servicio').html(data);
			$('#formulario_agregar_fallecidos #servicio').selectpicker('refresh');				
        }
     });		
}

function getProfesionalFallecidos(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/getMedico.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_fallecidos #medico_general').html("");
			$('#formulario_agregar_fallecidos #medico_general').html(data);
			$('#formulario_agregar_fallecidos #medico_general').selectpicker('refresh');

		    $('#formulario_agregar_fallecidos #medico_general1').html("");
			$('#formulario_agregar_fallecidos #medico_general1').html(data);
			$('#formulario_agregar_fallecidos #medico_general1').selectpicker('refresh');			
        }
     });		
}

function getServicioPasivos(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_pasivos #servicio').html("");
			$('#formulario_agregar_pasivos #servicio').html(data);	
			$('#formulario_agregar_pasivos #servicio').selectpicker('refresh');		
        }
     });		
}

function getProfesionalPasivos(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/getMedico.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_pasivos #medico_general').html("");
			$('#formulario_agregar_pasivos #medico_general').html(data);
			$('#formulario_agregar_pasivos #medico_general').selectpicker('refresh');

		    $('#formulario_agregar_pasivos #medico_general1').html("");
			$('#formulario_agregar_pasivos #medico_general1').html(data);
			$('#formulario_agregar_pasivos #medico_general1').selectpicker('refresh');		
        }
     });		
}

function pagination_depurados(partida){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs-regis').val();
	var estado = "";
	var reporte = "";

    if($('#form_main #reporte').val() == null || $('#form_main #reporte').val() == ""){
		reporte = "";
	}else{
		reoprte = reporte = $('#form_main #reporte').val();
	}	
	
	if ($('#form_main #status').val() == null || $('#form_main #status').val() == ""){
		estado = 4;
	}else{
		estado = $('#form_main #status').val();
	}

    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/paginar.php';	

	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&status='+estado+'&dato='+dato+'&reporte='+reporte,		
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);			
		}
	});
	return false;	
}

function reporteEXCEL(){
 if($('#form_main #status').val()!=""){
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs-regis').val();
	var estado = $('#form_main #status').val();	
	var reporte = "";

    if($('#form_main #reporte').val() == null || $('#form_main #reporte').val() == ""){
		reporte = "";
	}else{
		reoprte = reporte = $('#form_main #reporte').val();
	}	
	
	if (estado == "" ){
		estado = 1;
	}else{
		estado = $('#form_main #status').val();
	}
	
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/reporteDepurados.php?desde='+desde+'&hasta='+hasta+'&estado='+estado+'&dato='+dato+'&reporte='+reporte;		
		
	window.open(url);	
}else{
	swal({
		title: "Error", 
		text: "Debe seleccionar por lo menos una opción de búsqueda",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});  
  }		
}

function ejecutarDepuracion(){
  if(getMes() == 06 || getMes() == 11){
		var url = '<?php echo SERVERURL; ?>php/reportes_depurados/paginar.php';	
		
    	$.ajax({
		   type:'POST',
		   url:url,	
           async: false,		   
		   success:function(data){
			  pagination_depurados(1);		
		   }
	    });
	    return false;			
	}else{	   	
		swal({
			title: "Error", 
			text: "No se puede ejecutar esta acción, fuera de periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});  
	}
}

function getMes(){
    var url = '<?php echo SERVERURL; ?>php/reportes_depurados/getMes.php';	
	var mes;	
	$.ajax({
		type:'POST',
		url:url,
        async: false,
		success:function(data){
           mes = data;
		}
	});	
	return mes;
}

$('#form_main #ejecutar').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 ejecutarDepuracion();		
});

function limpiarFallecidos(){
   getServicioFallecidos();
   getProfesionalFallecidos();	
   $('#formulario_agregar_fallecidos #pro').val('Registro'); 
}

function limpiarPasivos(){
   getProfesionalPasivos();
   getServicioPasivos();	
   $('#formulario_agregar_pasivos #pro').val('Registro');     
}

function agregarFallecidos(){
	  var url = '<?php echo SERVERURL; ?>php/reportes_depurados/agregarFallecidos.php';
	   fecha = $('#formulario_agregar_fallecidos #fecha').val();
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_fallecidos').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_fallecidos')[0].reset();
				$('#formulario_agregar_fallecidos #pro').val('Registro');
				$('#formulario_agregar_fallecidos #mensaje').removeClass('error');
				swal({
					title: "Success", 
					text: "Registro completado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				pagination_depurados(1);
				$('#formulario_agregar_fallecidos #fecha').val(fecha);
				limpiarFallecidos();
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
			   limpiarFallecidos();
			   return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "El registro no fue almacenado, existen valores en blanco",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
                limpiarFallecidos();
			   return false;
			}else if(registro == 4){
				swal({
					title: "Error", 
					text: "Este registro ya existe, no se puedeo almacenar mas de una vez",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;
			}else if(registro == 5){
				swal({
					title: "Error", 
					text: "Error, la fecha de cita no puede ser cero",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		
			   return false;
			}else if(registro == 6){
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
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
               limpiarFallecidos();			   
			   return false;
			}			 
		  }
	   });
}

function modificarFallecidos(){
	  var url = '<?php echo SERVERURL; ?>php/reportes_depurados/modificarFallecidos.php';
	  fecha = $('#formulario_agregar_fallecidos #fecha').val();
	  
	  $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_fallecidos').serialize(),
		  success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_fallecidos #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro editado con éxito",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination_depurados(1);
				$('#formulario_agregar_fallecidos #fecha').val(fecha);
				return false;
			}else if(registro == 2){	
			   swal({
					title: "Error", 
					text: "Este registro no se puede editar",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;
			}else if(registro == 3){	
			   swal({
					title: "Error", 
					text: "Error, la fecha de cita no puede ser cero",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				return false;
			}else if(registro == 4){	
			   swal({
					title: "Error", 
					text: "El registro no fue editado, existen valores en blanco",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
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
				return false;
			}			 
		  }
	   });
}
  
function agregarPasivos(){
	  var url = '<?php echo SERVERURL; ?>php/reportes_depurados/agregarPasivos.php';
	  fecha = $('#formulario_agregar_pasivos #fecha').val();
	  
	  $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_pasivos').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_pasivos')[0].reset();
				$('#formulario_agregar_pasivos #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro completado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination_depurados(1);
				$('#formulario_agregar_pasivos #fecha').val(fecha);
				limpiarPasivos();
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
				limpiarPasivos();
				return false;
			}else if(registro == 3){
			   swal({
					title: "Error", 
					text: "El registro no fue almacenado, existen valores en blanco",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				limpiarPasivos();
				return false;
			}else if(registro == 4){	
			   swal({
					title: "Error", 
					text: "Este registro ya existe, no se puedeo almacenar mas de una vez",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;
			}else if(registro == 5){	
			   swal({
					title: "Error", 
					text: "Error, la fecha de cita no puede ser cero",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;
			}else if(registro == 5){	
			   swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
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
				limpiarPasivos();			   
			   return false;
			}			 
		  }
	   });
}

function modificarPasivos(){
	  var url = '<?php echo SERVERURL; ?>php/reportes_depurados/modificarPasivos.php';
	  fecha = $('#formulario_agregar_pasivos #fecha').val();
	  
	  $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_pasivos').serialize(),
		  success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_pasivos #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro editado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false 
				});
			   pagination_depurados(1);
			   $('#formulario_agregar_pasivos #fecha').val(fecha);
			   return false;
			}else if(registro == 2){	
			   swal({
					title: "Error", 
					text: "Este registro no se puede editar",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;
			}else if(registro == 3){	
			   swal({
					title: "Error", 
					text: "Error, la fecha de cita no puede ser cero",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;
			}else if(registro == 4){	
			   swal({
					title: "Error", 
					text: "El registro no fue editado, existen valores en blanco",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
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
			   return false;
			}			 
		  }
	   });
}
  
$('#reg_fallecidos').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_fallecidos #expediente').val() == "" || $('#formulario_agregar_fallecidos #servicio').val() == "" || $('#formulario_agregar_fallecidos #medico_general').val() == "" || $('#formulario_agregar_fallecidos #motivo').val() == "" || $('#formulario_agregar_fallecidos #diagnostico').val() == ""){				
		   swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			 
	 }else{
		e.preventDefault();
		agregarFallecidos();
	 }  
});

$('#edi_fallecidos').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_fallecidos #expediente1').val() == "" || $('#formulario_agregar_fallecidos #servicio').val() == "" || $('#formulario_agregar_fallecidos #medico_general').val() == "" || $('#formulario_agregar_fallecidos #motivo').val() == "" || $('#formulario_agregar_fallecidos #diagnostico').val() == ""){				
		   swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   	         
	 }else{
		e.preventDefault();
		modificarFallecidos();
	 }  
});

$('#reg_pasivos').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_pasivos #expediente').val() == "" || $('#formulario_agregar_pasivos #servicio').val() == "" || $('#formulario_agregar_pasivos #motivo').val() == "" || $('#formulario_agregar_pasivos #diagnostico').val() == ""){				
		   swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   	         
	 }else{
		e.preventDefault();
		agregarPasivos();
	 }  
});

$('#edi_pasivos').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_pasivos #expediente1').val() == "" || $('#formulario_agregar_pasivos #servicio').val() == "" || $('#formulario_agregar_pasivos #motivo').val() == "" || $('#formulario_agregar_pasivos #diagnostico').val() == ""){				
		   swal({
				title: "Error", 
				text: "No se pueden enviar los datos, los campos estan vacíos",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   	         
	 }else{
		e.preventDefault();
		modificarPasivos();
	 }  
});

function limpiar(){
    getReporte();
    getReporteBusqueda();
    $('#agrega-registros').html("");
	$('#pagination').html("");		
}

/*
$(document).ready(function() {
	setInterval('pagination_depurados(1)',6000);	
});*/

$('#form_main #reportes_depurados').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
});

$('#form_main #centros_limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
  
function editar(id){
	var estado = $('#form_main #status').val();
	
	if (estado == "" ){
		estado = 4;
	}else{
		estado = $('#form_main #status').val();
	}
		
	if(estado == 4 || estado == 2){
		editarRegistroPasivos(id);
	}else if(estado == 3){
		editarRegistroFallecidos(id);
	}else{
	   swal({
			title: "Error", 
			text: "No se puede realizar la edición para estos registros",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	   
	}
}

function editarRegistroPasivos(id){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	 var url = '<?php echo SERVERURL; ?>php/reportes_depurados/editarPasivos.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
			var datos = eval(valores);
			$("#formulario_agregar_pasivos #edad").show();
			$('#reg_pasivos').hide();
			$('#edi_pasivos').show();
			$('#formulario_agregar_pasivos #expediente1').show();
			$('#formulario_agregar_pasivos #expediente').hide();
			$('#formulario_agregar_pasivos #pro').val('Edicion');
			$('#formulario_agregar_pasivos #id-registro').val(id);
			$('#formulario_agregar_pasivos #expediente1').val(datos[0]);	
            $('#formulario_agregar_pasivos #fecha').val(datos[1]);			
			$('#formulario_agregar_pasivos #fecha_cita').val(datos[2]);
			$('#formulario_agregar_pasivos #nombre').val(datos[3]);
            $('#formulario_agregar_pasivos #nombre').val(datos[3]);			
			$('#formulario_agregar_pasivos #servicio').val(datos[4]);
			$('#formulario_agregar_pasivos #medico_general').val(datos[5]);	
			$('#formulario_agregar_pasivos #medico_general1').val(datos[6]);
			$('#formulario_agregar_pasivos #diagnostico').val(datos[7]);
			$('#formulario_agregar_pasivos #motivo').val(datos[8]);
			$('#formulario_agregar_pasivos #fecha').focus();	
			$('#formulario_agregar_pasivos #expediente1').attr('readonly', true);				
			$('#agregar_pasivos').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});
			return false;
		}
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
 }	
}

function editarRegistroFallecidos(id){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	 var url = '<?php echo SERVERURL; ?>php/reportes_depurados/editarFallecidos.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
			var datos = eval(valores);
			$("#formulario_agregar_fallecidos #edad").show();
			$('#reg_fallecidos').hide();
			$('#edi_fallecidos').show();
			$('#formulario_agregar_fallecidos #expediente1').show();
			$('#formulario_agregar_fallecidos #expediente').hide();
			$('#formulario_agregar_fallecidos #pro').val('Edicion');
			$('#formulario_agregar_fallecidos #id-registro').val(id);
			$('#formulario_agregar_fallecidos #expediente1').val(datos[0]);	
            $('#formulario_agregar_fallecidos #fecha').val(datos[1]);			
			$('#formulario_agregar_fallecidos #fecha_cita').val(datos[2]);
			$('#formulario_agregar_fallecidos #nombre').val(datos[3]);
            $('#formulario_agregar_fallecidos #nombre').val(datos[3]);			
			$('#formulario_agregar_fallecidos #servicio').val(datos[4]);
			$('#formulario_agregar_fallecidos #medico_general').val(datos[5]);
			$('#formulario_agregar_fallecidos #medico_general1').val(datos[6]);
			$('#formulario_agregar_fallecidos #diagnostico').val(datos[7]);
			$('#formulario_agregar_fallecidos #motivo').val(datos[8]);		
			$('#formulario_agregar_fallecidos #fecha').focus();		
			$('#formulario_agregar_fallecidos #expediente1').attr('readonly', true);				
			$('#agregar_fallecidos').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});
			return false;
		}
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
 }	
}

//VENTANAS EMERGENTES
function mensajeMantenimiento(titulo,mensaje){
	imagen = "<img src='../img/construccion.png' width='100%' height='50%'>";
	
	$('#mensaje').modal({
	    show:true,
		keyboard: false,
	    backdrop:'static'
	});
	$('#mensaje #mensaje_mensaje').html("<span class='fas fa-toolbox'> " + titulo + "</span><br/><hr><center>"  + imagen 
	    + "</center><br/> " + mensaje);
	$('#mensaje #bad').hide();
	$('#mensaje #okay').show();	
}

$(document).ready(function(){
	$(document).on('click', '#checkAllDepurados', function() {          	
		$(".itemRowDepurados").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRowDepurados', function() {  	
		if ($('.itemRowDepurados:checked').length == $('.itemRowDepurados').length) {
			$('#checkAllDepurados').prop('checked', true);
		} else {
			$('#checkAllDepurados').prop('checked', false);
		}
	});  
	var count = $(".itemRowDepurados").length;	
});
</script>