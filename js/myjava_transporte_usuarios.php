<script>
$(document).ready(pagination(1))
  clean();
  
  $(function(){
	  $('#nuevo_transporte').on('click',function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 12 || getUsuarioSistema() == 16){
		      $('#formulario_transporte')[0].reset();	
		      $('#formulario_transporte #pro').val('Registro');
			  $('#reg_vehiculos_transporte').show();
			  $('#edit_vehiculos_transporte').hide();
		      $('#registrar_transporte').modal({
			     show:true,
				 keyboard: false,
			     backdrop:'static'
		      });	 
		  }else{
				swal({
					title: 'Acceso Denegado', 
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});						 
         }
	   });
	   
	  $('#nuevo_combustible').on('click',function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 12 || getUsuarioSistema() == 16){
		      $('#formulario_combustible')[0].reset();
              getTanqueTotal();			  
		      $('#formulario_combustible #pro').val('Registro');
			  $('#reg_combustible_transporte').show();
			  $('#edit_combustible_transporte').hide();
		      $('#registrar_combustible').modal({
			     show:true,
				 keyboard: false,
			     backdrop:'static'
		      });	 
		  }else{
				swal({
					title: 'Acceso Denegado', 
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});						 
         }
	   });	   
	
	   $('#main_form #bs_regis').on('keyup',function(){
		  pagination(1);
       });

      $('#main_form #fecha_i').on('change',function(){
		  pagination(1);
      });
	  
      $('#main_form #fecha_f').on('change',function(){
		  pagination(1);
      });
	  
      $('#main_form #tipo').on('change',function(){
		  pagination(1);
      });
	  
      $('#main_form #vehiculo_main').on('change',function(){
		  pagination(1);
      });			  
}); 

function clean(){
	getTipo();
    getTransportista();
    getVehiculo();
	getTanqueTotal();	
}

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#registrar_transporte").on('shown.bs.modal', function(){
        $(this).find('#formulario_transporte #motivo').focus();
    });
});

$(document).ready(function(){
    $("#registrar_combustible").on('shown.bs.modal', function(){
        $(this).find('#formulario_combustible #tanque_inicio').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

function pagination(partida){
	var url = '';
	var vehiculo_id = "";
    var fechai = $('#main_form #fecha_i').val();
	var fechaf = $('#main_form #fecha_f').val();
	var dato = $('#main_form #bs_regis').val();
	var tipo = "";
	
	if($('#main_form #vehiculo_main').val() == null || $('#main_form #vehiculo_main').val() == ""){
		vehiculo_id = 1;
	}else{
		vehiculo_id = $('#main_form #vehiculo_main').val();
	}
	
	if($('#main_form #tipo').val() == null || $('#main_form #tipo').val() == ""){
		tipo = 1;
	}else{
		tipo = $('#main_form #tipo').val();
	}

	if(tipo == 1){
		url = '<?php echo SERVERURL; ?>php/transporte/paginar.php';
	}else{
		url = '<?php echo SERVERURL; ?>php/transporte/paginar_combustible.php';
	}
	
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&fechai='+fechai+'&fechaf='+fechaf+'&dato='+dato+'&vehiculo_id='+vehiculo_id,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;	
}

function reporteEXCELTransporte(){	
	var vehiculo_id = "";
    var fechai = $('#main_form #fecha_i').val();
	var fechaf = $('#main_form #fecha_f').val();
	var dato = $('#main_form #bs_regis').val();
	
	if($('#main_form #vehiculo_main').val() == null || $('#main_form #vehiculo_main').val() == ""){
		vehiculo_id = 1;
	}else{
		vehiculo_id = $('#main_form #vehiculo_main').val();
	}
	
	url = '<?php echo SERVERURL; ?>php/transporte/reporteTransporte.php?fechai='+fechai+'&fechaf='+fechaf+'&dato='+dato+'&vehiculo_id='+vehiculo_id;
	    
	window.open(url);			
}

function reporteEXCELCombustible(){	
	var vehiculo_id = "";
    var fechai = $('#main_form #fecha_i').val();
	var fechaf = $('#main_form #fecha_f').val();
	
	if($('#main_form #vehiculo_main').val() == null || $('#main_form #vehiculo_main').val() == ""){
		vehiculo_id = 1;
	}else{
		vehiculo_id = $('#main_form #vehiculo_main').val();
	}
	
	url = '<?php echo SERVERURL; ?>php/transporte/reporteCombustible.php?fechai='+fechai+'&fechaf='+fechaf+'&vehiculo_id='+vehiculo_id;
	    
	window.open(url);			
}

function getTransportista(){
  var url = '<?php echo SERVERURL; ?>php/transporte/getTransportista.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_transporte #transportista').html("");
				$('#formulario_transporte #transportista').html(data);
				$('#formulario_transporte #transportista').selectpicker('refresh');

				$('#formulario_combustible #transportista_combustible').html("");
				$('#formulario_combustible #transportista_combustible').html(data);
				$('#formulario_combustible #transportista_combustible').selectpicker('refresh');			
		}	
   });
   return false;		
}

function getTipo(){
  var url = '<?php echo SERVERURL; ?>php/transporte/getReporte.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#main_form #tipo').html("");
				$('#main_form #tipo').html(data);
				$('#main_form #tipo').selectpicker('refresh');					
		}	
   });
   return false;		
}

function getVehiculo(){
  var url = '<?php echo SERVERURL; ?>php/transporte/getVehiculo.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_transporte #vehiculo_t').html("");
				$('#formulario_transporte #vehiculo_t').html(data);
				$('#formulario_transporte #vehiculo_t').selectpicker('refresh');
				
				$('#formulario_combustible #vehiculo').html("");
				$('#formulario_combustible #vehiculo').html(data);
				$('#formulario_combustible #vehiculo').selectpicker('refresh');

				$('#main_form #vehiculo_main').html("");
				$('#main_form #vehiculo_main').html(data);
				$('#main_form #vehiculo_main').selectpicker('refresh');				
		}	
   });
   return false;		
}


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
	return resp;	
}

$('#reg_vehiculos_transporte').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_transporte #motivo').val() != "" && $('#formulario_transporte #km_inicial').val() != "" && $('#formulario_transporte #km_final').val() != "" && $('#formulario_transporte #transportista').val() != ""){
		 e.preventDefault();
		 agregarControlTransportista();		  
		return false;
	 }else{
			swal({
				title: 'Error', 
				text: 'No se pueden enviar los datos, los campos estan vacíos, por favor revise la pestalla de Familiares antes de continuar',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			$('#formulario_transporte #pro').val('Registro');
			return false;		 
	 }  	 
});

$('#edit_vehiculos_transporte').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_transporte #motivo').val() != "" && $('#formulario_transporte #km_inicial').val() != "" && $('#formulario_transporte #km_final').val() != "" && $('#formulario_transporte #transportista').val() != ""){
		 e.preventDefault();
		 modificarControlTransportista();		  
		return false;
	 }else{
			swal({
				title: 'Error', 
				text: 'No se pueden enviar los datos, los campos estan vacíos, por favor revise la pestalla de Familiares antes de continuar',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});		 
			$('#formulario_transporte #pro').val('Registro');
         return false;		 
	 }  	 
});

$('#reg_combustible_transporte').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_combustible #tanque_inicio').val() != "" && $('#formulario_combustible #tanque_final').val() != "" && $('#formulario_combustible #cantidad_litros').val() != "" && $('#formulario_combustible #valor_compra').val() != ""){
		 e.preventDefault();
		 agregarCombustible();		  
		return false;
	 }else{
			swal({
				title: 'Error', 
				text: 'No se pueden enviar los datos, los campos estan vacíos, por favor revise la pestalla de Familiares antes de continuar',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});			 
			$('#formulario_combustible #pro').val('Registro');
			return false;		 
	 }  	 
});

$('#edit_combustible_transporte').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_combustible #tanque_inicio').val() != "" && $('#formulario_combustible #cantidad_litros').val() != "" && $('#formulario_combustible #valor_compra').val() != "" && $('#formulario_combustible #tanque_final').val() != ""){
		 e.preventDefault();
		 modificarControlCombustible();	  
		return false;
	 }else{
		swal({
			title: 'Error', 
			text: 'No se pueden enviar los datos, los campos estan vacíos, por favor revise la pestalla de Familiares antes de continuar',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});			 
        $('#formulario_combustible #pro').val('Registro');
        return false;		 
	 }  	 
});

	
//INICIO AGREGAR REGISTROS
function agregarControlTransportista(){
	var url = '<?php echo SERVERURL; ?>php/transporte/agregar_transportista.php';
	
   	var fecha = $('#formulario_transporte #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
   if(getMes(fecha)==2){
		swal({
			title: 'Error', 
			text: 'No se puede agregar/modificar registros fuera de este periodo',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;	
   }else{
    if ( fecha <= fecha_actual){    
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_transporte').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_transporte')[0].reset();
				$('#formulario_transporte #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro almacenado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				$('#formulario_transporte #motivo').focus();
				clean();
				pagination(1);
				return false;
			}else if(registro == 2){	
				swal({
					title: 'Error', 
					text: 'Error al almacenar este registro, por favor corregir',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});		   			   				   
			   return false;
			}else if(registro == 2){
				swal({
					title: 'Error', 
					text: 'Su sesión a vencido, por favor inicie sesión nuevamente',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});			   
			   return false;
			}
			else{
				swal({
					title: 'Error', 
					text: 'Error al completar el registro',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;
			}
		}
	});	
   }else{
		swal({
			title: 'Error', 
			text: 'No se puede agregar/modificar registros fuera de esta fecha',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	  return false;	 
   }
  }
}

function agregarCombustible(){
	var url = '<?php echo SERVERURL; ?>php/transporte/agregar_combustible.php';
	
   	var fecha = $('#formulario_combustible #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
   if(getMes(fecha)==2){
		swal({
			title: 'Error', 
			text: 'No se puede agregar/modificar registros fuera de esta fecha',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	return false;	
   }else{	
    if ( fecha <= fecha_actual){    
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_combustible').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_combustible')[0].reset();
				$('#formulario_combustible #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro almacenado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				pagination(1);
				clean();
				return false;
			}else if(registro == 2){
				swal({
					title: 'Error', 
					text: 'Error al almacenar este registro, por favor corregir',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
					allowEscapeKey: false,
					allowOutsideClick: false
				});		   			   				   
			   return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Su sesión a vencido, por favor inicie sesión nuevamente",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});								   
			   return false;
			}
			else{	
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
//FIN AGREGAR REGISTROS

//INICIO MODIFICAR REGISTROS
function modificarControlTransportista(){
	var url = '<?php echo SERVERURL; ?>php/transporte/modificar_transportista.php';
	
   	var fecha = $('#formulario_transporte #fecha').val();	
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
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_transporte').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_transporte #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro almacenado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				clean();
				pagination(1);
				return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Error al almacenar este registro, por favor corregir",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		   			   				   
			   return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Su sesión a vencido, por favor inicie sesión nuevamente",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			   
			   return false;
			}
			else{
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

function modificarControlCombustible(){
	var url = '<?php echo SERVERURL; ?>php/transporte/modificar_combustible.php';
	
   	var fecha = $('#formulario_combustible #fecha').val();	
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
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_combustible').serialize(),
		success: function(registro){
			if (registro == 1){
			   $('#formulario_combustible #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro modificado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   clean();
			   pagination(1);
			   return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Error al almacenar este registro, por favor corregir",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		   			   				   
			   return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Su sesión a vencido, por favor inicie sesión nuevamente",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			   
			   return false;
			}
			else{	
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
//FIN MODIFICAR REGISTROS

//INICIO ELIMINAR REGISTROS
function eliminarControlTransportista(id){
	var url = '<?php echo SERVERURL; ?>php/transporte/eliminar_transporte.php';
	
   	var fecha = getFechaTransporte(id);	
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
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			if (registro == 1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				clean();
				pagination(1);
				return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Error no se puede elimianr el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "No se puede eliminar este registro ya que hay información almacenada, recuerde que solo el ultimo registro almacenado puede eliminarse",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				return false;
			}
			else{
				swal({
					title: "Error", 
					text: "Error al completar esta acción",
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

function eliminarControlCombustible(id){
	var url = '<?php echo SERVERURL; ?>php/transporte/eliminar_combustible.php';
	
   	var fecha = getFechaCombustible(id);	
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
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			if (registro == 1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
			   clean();
			   pagination(1);
			   return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Error no se puede elimianr el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
			   return false;
			}else if(registro == 3){
				swal({
					title: "Error", 
					text: "No se puede eliminar este registro ya que hay información almacenada, recuerde que solo el ultimo registro almacenado puede eliminarse",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
			   return false;
			}
			else{
				swal({
					title: "Error", 
					text: "Error al completar esta acción",
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
//FIN ELIMINAR REGISTROS

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getTanqueTotal(){
    var url = '<?php echo SERVERURL; ?>php/transporte/getTanque.php';
	var vehiculo_id = $('#formulario_combustible #vehiculo').val();
	var resp;
	
	$.ajax({
	    type:'POST',
		url:url,
		data:'vehiculo_id='+vehiculo_id,
		async: false,
		success:function(data){
		  var datos = eval(data);		
          $('#formulario_combustible #tanque_inicio').val(datos[0]);			  		  		  			  
		}
	});
}

$(document).ready(function(e) {
    $('#formulario_combustible #cantidad_litros').on('blur', function(){
		 $('#formulario_combustible #tanque_final').val( parseFloat($('#formulario_combustible #tanque_inicio').val()) + parseFloat($('#formulario_combustible #cantidad_litros').val()));
	});
});	

$(document).ready(function() {
	$('#formulario_combustible #vehiculo').on('change', function(){	
	     getTanqueTotal();
		 $('#formulario_combustible #tanque_inicio').focus();
	});
});	

function editarRegistroTransporte(id){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 12 || getUsuarioSistema() == 16){	
	$('#formulario_transporte')[0].reset();		
	var url = '<?php echo SERVERURL; ?>php/transporte/editar.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg_vehiculos_transporte').hide();
				$('#edit_vehiculos_transporte').show();
				$('#formulario_transporte #pro').val('Edicion');
				$('#formulario_transporte #id-registro').val(id);
				$('#formulario_transporte #motivo').val(datos[0]);	
				$('#formulario_transporte #adulto_h').val(datos[1]);
                $('#formulario_transporte #adulto_m').val(datos[2]);
                $('#formulario_transporte #niño').val(datos[3]);
                $('#formulario_transporte #hora_inicial').val(datos[4]);
                $('#formulario_transporte #hora_final').val(datos[5]);	
                $('#formulario_transporte #km_inicial').val(datos[6]);
                $('#formulario_transporte #km_final').val(datos[7]);
                $('#formulario_transporte #transportista').val(datos[8]);
				$('#formulario_transporte #transportista').selectpicker('refresh');

                $('#formulario_transporte #vehiculo_t').val(datos[9]);
				$('#formulario_transporte #vehiculo_t').selectpicker('refresh');

				$('#formulario_transporte #fecha').val(datos[10]);
				$('#reg_vehiculos_transporte').hide();
				$('#edit_vehiculos_transporte').show();				
                
                //DESHABILITAR CONTROLES
                $("#formulario_transporte #fecha").attr('disabled', true);				
				$('#registrar_transporte').modal({
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
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
  }		
}

function editarRegistroCombustible(id){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 12 || getUsuarioSistema() == 16){	
	$('#formulario_combustible')[0].reset();		
	var url = '<?php echo SERVERURL; ?>php/transporte/editar_combustible.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg_combustible_transporte').hide();
				$('#edit_combustible_transporte').show();
				$('#formulario_combustible #pro').val('Edicion');
				$('#formulario_combustible #id-registro').val(id);
				$('#formulario_combustible #fecha').val(datos[0]);	
				$('#formulario_combustible #tanque_inicio').val(datos[1]);
                $('#formulario_combustible #cantidad_litros').val(datos[2]);
                $('#formulario_combustible #valor_compra').val(datos[3]);
                $('#formulario_combustible #tanque_final').val(datos[4]);
                $('#formulario_combustible #transportista_combustible').val(datos[5]);
                $('#formulario_combustible #vehiculo').val(datos[6]);
                
                //DESHABILITAR CONTROLES
                $("#formulario_combustible #fecha").attr('disabled', true);				
				$('#registrar_combustible').modal({
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
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
  }		
}

//INICIO MODAL ELIMINAR REGISTROS
function modal_eliminar(id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 12 || getUsuarioSistema() == 16){
	swal({
		title: "¿Estas seguro?",
		text: "¿Desea eliminar este registro?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-warning",
		cancelButtonText: "Cancelar",	  
		confirmButtonText: "¡Sí, eliminar el registro!",
		closeOnConfirm: false,
		allowEscapeKey: false,
		allowOutsideClick: false
	},
	function(){
		eliminarControlTransportista(id);
	});	
  }else{
		swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
   }	
}

function modal_eliminar_combustible(id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 12 || getUsuarioSistema() == 16){	
	swal({
		title: "¿Estas seguro?",
		text: "¿Desea eliminar este registro?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-warning",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Sí, eliminar el registro!",
		closeOnConfirm: false,
		allowEscapeKey: false,
		allowOutsideClick: false
	},
	function(){
		eliminarControlCombustible(id);
	});	
  }else{
		swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
  }	
}
//FIN MODAL ELIMINAR REGISTROS


//CONSULTAS
//CONSULTAR FECHA TRANSPOTES
function getFechaTransporte(id){
    var url = '<?php echo SERVERURL; ?>php/transporte/getFechaTransporte.php';
	
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'id='+id,
		async: false,
		success:function(data){	
		  var datos = eval(data);
          fecha = datos[0];			  		  		  			  
		}
	});
	return fecha;
}

//CONSULTAR FECHA COMBUSTIBLE
function getFechaCombustible(id){
    var url = '<?php echo SERVERURL; ?>php/transporte/getFechaCombustible.php';
	
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'id='+id,
		async: false,
		success:function(data){	
		  var datos = eval(data);
          fecha = datos[0];			  		  		  			  
		}
	});
	return fecha;
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
</script>