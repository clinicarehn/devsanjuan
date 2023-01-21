<script>
$(document).ready(function() {
	setInterval('pagination(1)',8000);	
});

$(document).ready(function() {
	  $('#form_main #asignar_camas').on('click',function(){
	   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		$('#reg_camas').show();
		$('#edit_camas').hide();		 	 
	    $('#formulario_agregar_camas')[0].reset();
        limpiar();
		$('#formulario_agregar_camas #pro').val('Registro');	
		$('#formulario_agregar_camas #mensaje').removeClass('error');
		$('#formulario_agregar_camas #mensaje').removeClass('bien');
		$('#formulario_agregar_camas #mensaje').html("");	
        $("#formulario_agregar_camas #expediente").attr('readonly', false);
        //$("#reg_camas").attr('disabled', true);
        $('#formulario_agregar_camas #grupo').show();	
	     $('#agregar_camas').modal({
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
        }	
	   });
	   
	$('#form_main #sala').on('change',function(){     	    
		pagination(1);
    });		
	
    $('#form_main #estado').on('change',function(){
		  pagination(1);
    });
	
	$('#form_main #bs-regis').on('keyup',function(){
	   pagination(1);
    });
	
    $('#form_main  #fecha_b').on('change',function(){
		  pagination(1);
    });	

    $('#form_main  #fecha_f').on('change',function(){
		  pagination(1);
    });

    $('#form_main  #unidad').on('change',function(){
		  pagination(1);
    });	

  pagination(1);
  getSalaFormMain();
  getEstadoFormMain();
  getUnidad();
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_camas").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_camas #expediente').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$('#reg_camas').on('click', function(e){
	 if ($('#formulario_agregar_camas #expediente').val() == ""  && $('#formulario_agregar_camas #sala').val() == "" && $('#formulario_agregar_camas #cama').val() == ""){
		 $('#formulario_agregar_camas')[0].reset();		
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
		e.preventDefault();
		asignarCamas();
	 } 		 
});

function getEstadoFormMain(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getEstadoCamas.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #estado').html("");
			$('#form_main #estado').html(data);
			$('#form_main #estado').selectpicker('refresh');
		}			
     });		
}

function pagination(partida){
	var url = '';
	var dato = $('#form_main #bs-regis').val();
	var sala = $('#form_main #sala').val();
	var unidad;
	var estado = $('#form_main #estado').val();
	var fecha = $('#form_main #fecha_b').val();
	var fechaf = $('#form_main #fecha_f').val();
	
	if($('#form_main #unidad').val() == "" || $('#form_main #unidad').val() == null){
		unidad = 2;
	}else{
		unidad = $('#form_main #unidad').val();
	}
	
	if(estado == null || estado == ""){
		estado = 1;
	}
	
	if( estado == 1){
		url = '<?php echo SERVERURL; ?>php/hospitalizacion/paginar.php';
	}else{
		url = '<?php echo SERVERURL; ?>php/hospitalizacion/paginarDisponibles.php';
	}
		
	if(sala == null){
	   sala = "";	
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&sala='+sala+'&dato='+dato+'&fecha='+fecha+'&fechaf='+fechaf+'&estado='+estado+'&unidad='+unidad,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function reporteEXCEL(){
	var url = '';
	var dato = $('#form_main #bs-regis').val();
	var sala = $('#form_main #sala').val();
	var estado = $('#form_main #estado').val();
	var fecha = $('#form_main #fecha_b').val();
	var fechaf = $('#form_main #fecha_f').val();
	
	if(estado == null || estado == ""){
		estado = 1;//CONSULTA HISTORIAL DE USUARIOS (ASIGNACIÓN DE CAMAS)
	}
	
	if(sala == null){
	   sala = "";	
	}	
	
	if( estado == 1){
		url = '<?php echo SERVERURL; ?>php/hospitalizacion/reporteAsignacionCamas.php?dato='+dato+'&sala='+sala+'&estado='+estado+'&fecha='+fecha+'&fechaf='+fechaf;
	}else{
		swal({
			title: "Error", 
			text: "No existe un reporte para esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
	}
			
	window.open(url);    	
}

function asignarCamas(){
	var fecha = $('#form_main #fecha_b').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/asignarCama.php';
	
  if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	   
		return false;	   
  }else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_camas').serialize(),
		  success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_camas')[0].reset();
			   $('#formulario_agregar_camas #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			    pagination(1);
			    limpiar();			   
			    return false;
			}else if(registro == 2){	
				swal({
					title: "Error", 
					text: "El registro no fue almacenado",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}else if(registro == 4){	
				swal({
					title: "Error", 
					text: "Error al procesar su solicitud, debido a que hay registros en blanco, por favor corregir",
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
}

function getSalaFormMain(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/sala.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #sala').html("");
			$('#form_main #sala').html(data);
			$('#form_main #sala').selectpicker('refresh');
		}			
     });		
}

function getSala(sexo){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getSala.php';		
	$.ajax({
        type: "POST",
        url: url,
		data:'sexo='+sexo,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_camas #sala').html("");
			$('#formulario_agregar_camas #sala').html(data);
			$('#formulario_agregar_camas #sala').selectpicker('refresh');
		}			
     });		
}

function getUnidad(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getUnidad_camas.php';		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #unidad').html("");
			$('#form_main #unidad').html(data);
			$('#form_main #unidad').selectpicker('refresh');
		}			
     });		
}

$(document).ready(function() {
	  $('#formulario_agregar_camas #sala').on('change', function(){
		var sala = $('#formulario_agregar_camas #sala').val();
        var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getCamas.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'sala='+sala,
            success: function(data){
				$('#formulario_agregar_camas #cama').html(data);
				$('#formulario_agregar_camas #cama').selectpicker('refresh');				
            }
         });
		 
      });					
});

function clean(){
    $('#agrega-registros').html("");
	$('#pagination').html("");
	$('#form_main #sala').html("");
    getSalaFormMain();
	getEstadoFormMain();
	pagination(1);
}

function limpiar(){
	$('#formulario_agregar_camas #cama').html("");
	$('#formulario_agregar_camas #sala').html("");	
}

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_agregar_camas #expediente').on('blur', function(){
	 if($('#formulario_agregar_camas #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/hospitalizacion/buscar_expediente_camas.php';
        var expediente = $('#formulario_agregar_camas #expediente').val();
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
			     $('#formulario_agregar_camas #identidad').val(array[0]);
                 $('#formulario_agregar_camas #nombre').val(array[1]);					 
				 $('#formulario_agregar_camas #expediente').focus();
				 $('#formulario_agregar_camas #sala').html("");
				 $("#reg_camas").attr('disabled', true);
				 return false;
			  }else if (array[0] == "Actualizar"){	
				swal({
					title: "Error", 
					text: "Debe actualizar la información del usuario antes de proceder",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				 
			    $('#formulario_agregar_camas #identidad').val(array[0]);
                $('#formulario_agregar_camas #nombre').val(array[1]);					 
				$('#formulario_agregar_camas #expediente').focus();
				$('#formulario_agregar_camas #sala').html("");
				$("#reg_camas").attr('disabled', true);
				return false;
			  }else{
			     $('#formulario_agregar_camas #identidad').val(array[0]);
                 $('#formulario_agregar_camas #nombre').val(array[1]);	
				 $('#formulario_agregar_camas #mensaje').removeClass('error');
				 $('#formulario_agregar_camas #mensaje').html("");
				 getSala(array[2]);		 
                 $("#reg_camas").attr('disabled', false);				 
			  }		  			  
		  }
	  });
	  return false;		
	 }else{ 
		$('#formulario_agregar_camas')[0].reset();	
        $("#reg_camas").attr('disabled', true);		
	 }
	});
});

function getMes(fecha){
    var url = '<?php echo SERVERURL; ?>php/atas/getMes.php';
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

function camaOcupada(historial_id, estado, cama_id, expediente, alta){
var fecha = $('#form_main #fecha_b').val();	
var hoy = new Date();
fecha_actual = convertDate(hoy);	

if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
    if(alta == 0){
       if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			  
	    return false;	   
   }else{
      if(fecha <= fecha_actual){
         if(estado == 1){
			swal({
				title: "Error", 
				text: "No se puede ejecutar esta acción, esta cama ya tiene el estado de Ocupada",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});	  
         }else{
			 
	         $('#cama_ocupada #historial_id').val(historial_id);
             $('#cama_ocupada #cama_id').val(cama_id);	
			swal({
			  title: "¿Esta seguro?",
			  text: "¿Desea ocupar esta cama. Para el siguiente usuario: " + expediente + "?",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-warning",
			  confirmButtonText: "¡Si, deseo establecer la cama!",
			  closeOnConfirm: false,
			  showLoaderOnConfirm: true
			}, function () {
				ocuparCama();
			});	  
         }
     }else{
		swal({
			title: "Error", 
			text: "No se puede ejecutar esta acción fuera de esta fecha",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
     }
  }
}else{
	swal({
		title: "Error", 
		text: "Lo sentimos, esta acción no se puede realizar, este usuario ya se dio de alta",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});
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
}

function camaAltaOcupada(historial_id, estado, cama_id, expediente, alta){
var fecha = $('#form_main #fecha_b').val();	
var hoy = new Date();
fecha_actual = convertDate(hoy);	

if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
  if(alta == 0){
   if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	   return false;	   
   }else{	
      if(fecha <= fecha_actual){
         if(estado == 1){
	        $('#cama_alta_ocupada #historial_id').val(historial_id);
            $('#cama_alta_ocupada #cama_id').val(cama_id);	
			swal({
				title: "¿Esta seguro?",
				text: "¿Desea asignar esta cama en Alta-Ocupada. Para el siguiente usuario: " + expediente + "?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "¡Si, deseo asignar el estado",
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
				allowEscapeKey: false,
				allowOutsideClick: false
			}, function () {
				altaOcupada();
			});	  
        }else{
			swal({
				title: "Error", 
				text: "No se puede ejecutar esta acción, esta cama ya tiene el estado de Alta-Ocupada",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			}); 
        }
     }else{
			swal({
				title: "Error", 
				text: "No se puede ejecutar esta acción, esta cama ya tiene el estado de Alta-Ocupada",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
     }
  }
 }else{
	swal({
		title: "Error", 
		text: "Lo sentimos, esta acción no se puede realizar, este usuario ya se dio de alta",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});
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
}

function ocuparCama(){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/ocuparCama.php';
	var historial_id = $('#cama_ocupada #historial_id').val();
	var cama_id = $('#cama_ocupada #cama_id').val();
	var fecha = $('#form_main #fecha_b').val();		
	
  if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	  
		return false;	   
  }else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'historial_id='+historial_id+'&fecha='+fecha+'&cama_id='+cama_id,
		  success: function(registro){
			if(registro == 1){
			    pagination(1);
				swal({
					title: "Sucess", 
					text: "Se ha cambiado el estado de la cama",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#registrar').modal('hide');
				return false;				
			}else if(registro == 2){
			    pagination(1);
				swal({
					title: "Error", 
					text: "No se puedo procesar su solicitud, por favor intentelo de nuevo mas tarde",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	  			   	  
				return false;				
			}else if(registro == 3){
			    pagination(1);
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción, debido a que el usuario ya ha sido atendido anteriormente",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});  
			  return false;				
			 }else if(registro == 4){
			    pagination(1);
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción, el registro no existe, por favor comunciarse con el area de admisión",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				}); 			   
				return false;				
			 }else{
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			
			}  
  		  }
	   });
	   return false;		
	}else{
		swal({
			title: "Error", 
			text: "No se puede ejecutar esta acción fuera de esta fecha",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	}
  }
}

function altaOcupada(){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/altaOcupada.php';
	var historial_id = $('#cama_alta_ocupada #historial_id').val();
	var cama_id = $('#cama_alta_ocupada #cama_id').val();
	var fecha = $('#form_main #fecha_b').val();		
	
  if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	  
		return false;	   
  }else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'historial_id='+historial_id+'&fecha='+fecha+'&cama_id='+cama_id,
		  success: function(registro){
			if(registro == 1){
			    pagination(1);
				swal({
					title: "Advertencia", 
					text: "Se ha cambiado el estado de la cama correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#registrar').modal('hide');
			    return false;				
			}else if(registro == 2){
			    pagination(1);
				swal({
					title: "Error", 
					text: "No se puedo procesar su solicitud, por favor intentelo de nuevo mas tarde",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   		  
				return false;				
			}else if(registro == 3){
			    pagination(1);
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción, debido a que el usuario ya ha sido atendido anteriormente",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					 	  
			   return false;				
			 }else if(registro == 4){
			    pagination(1);
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción, el registro no existe, por favor comunciarse con el area de admisión",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	  
			   return false;				
			 }else{
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			
			}  
  		  }
	   });
	   return false;		
	}else{
		swal({
			title: "Error", 
			text: "No se puede ejecutar esta acción fuera de esta fecha",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	}
  }
}

function modal_eliminar(historial_id, cama_id, expediente, alta){
  var fecha = $('#form_main #fecha_b').val();	
  var hoy = new Date();
  fecha_actual = convertDate(hoy);
  
  if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;	   
  }else{
   if ( fecha <= fecha_actual){	
     if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		if(alta == 0){
           $('#eliminar #historial_id').val(historial_id);
           $('#eliminar #cama_id').val(cama_id);
           $('#eliminar #expediente').val(expediente);	
		   $('#eliminar #myModalLabel').html();
		   	swal({
				title: "¿Esta seguro?",
				text: "¿Desea eliminar este registro <b>" + expediente + "</b>?",
				type: "info",
				showCancelButton: true,
				confirmButtonText: "¡Si, deseo eliminar el registro!",
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
				allowEscapeKey: false,
				allowOutsideClick: false
			}, function () {
				eliminarRegistro();
			});
		}else{
			swal({
				title: "Error", 
				text: "No se puede ejecutar esta acción, esta cama ya tiene el estado de Ocupada",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			
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
   }else{
		swal({
			title: "Error", 
			text: "No se puede ejecutar esta acción fuera de esta fecha",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
   }
  }   
}

function eliminarRegistro(){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/eliminarUsuario.php';
	var historial_id = $('#eliminar #historial_id').val();
	var cama_id = $('#eliminar #cama_id').val();
    var expediente = $('#eliminar #expediente').val();		
	var fecha = $('#form_main #fecha_b').val();
	
  if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger"
		});	
	    return false;	   
  }else{	
	if(fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'fecha='+fecha+'&cama_id='+cama_id+'&historial_id='+historial_id,
		  success: function(registro){
			  if(registro == 1){
			     pagination(1);
				 swal({
					title: "Success", 
					text: "El expediente " + expediente + " ha sido removido de la lista correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				 });
				 $('#registrar').modal('hide');
			     return false;				  
			  }else if(registro == 2){
				swal({
					title: "Error", 
					text: "No se puede eliminar este registro, tiene información almacenada",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			  }else{
				swal({
					title: "Error", 
					text: "No se puede ejecutar esta acción, se ha presentado un error",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		  
			  }
  		  }
	   });
	   return false;		
	}else{
		swal({
			title: "Error", 
			text: "No se puede ejecutar esta acción fuera de esta fecha",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	}
  }
}

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

$(document).ready(function() {
	setInterval('pagination(1)',8000);	
});

function mantenimiento(){
	  mensajeMantenimiento("En Desarrollo", "Estamos trabajando para que su experiencia sea más placentera, esta opción pronto estará disponible");
}

$('#form_main #reporte').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    clean();
});

$('#form_main #crear_camas').on('click', function(e){
    e.preventDefault();
    mantenimiento();
});

$('#form_main #crear_salas').on('click', function(e){
    e.preventDefault();
    mantenimiento();
});

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
</script>