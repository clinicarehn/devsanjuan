<script>
$(document).ready(function() {
	getServicio();
	setInterval('pagination(1)',8000);	
});

$(document).ready(function() {
	  $('#form_main #nuevo_registro').on('click',function(){
	   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		$('#reg_quejas').show();
		$('#edt_quejas').hide();		 	 
	    $('#formulario_quejas')[0].reset();
        limpiar();
		$('#formulario_quejas #pro').val('Registro');
        $("#formulario_quejas #expediente").attr('readonly', false);
 	
	     $('#agregar_queja').modal({
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
	   
	$('#form_main #servicio').on('change',function(){     	    
		pagination(1);
    });		
	
    $('#form_main #reporte').on('change',function(){
		  pagination(1);
    });
	
	$('#form_main #bs_regis').on('keyup',function(){
	   pagination(1);
    });
	
    $('#form_main  #fecha_b').on('change',function(){
		  pagination(1);
    });	

    $('#form_main  #fecha_f').on('change',function(){
		  pagination(1);
    });

  pagination(1);
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#eliminar_queja").on('shown.bs.modal', function(){
        $(this).find('#form_eliminar_queja #Comentario').focus();
    });
});

$(document).ready(function(){
    $("#agregar_queja").on('shown.bs.modal', function(){
        $(this).find('#formulario_quejas #expediente').focus();
    });
});

$(document).ready(function(){
    $("#seguimiento_queja").on('shown.bs.modal', function(){
        $(this).find('#form_seguimiento_queja #seguimiento').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #servicio').html("");
			$('#form_main #servicio').html(data);

		    $('#formulario_quejas #servicio').html("");
			$('#formulario_quejas #servicio').html(data);			
        }
     });		
}


$('#formulario_quejas #queja').keyup(function() {
	    var max_chars = 255;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formulario_quejas #charNum_queja').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

$('#formulario_quejas #queja1').keyup(function() {
	    var max_chars = 255;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formulario_quejas #charNum_queja1').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

$('#form_seguimiento_queja #seguimiento').keyup(function() {
	    var max_chars = 255;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#form_seguimiento_queja #charNum_seguimiento').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

$(document).ready(function(e) {
    $('#formulario_quejas #expediente').on('blur', function(){
	 if($('#formulario_quejas #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/buscar_expediente.php';
        var expediente = $('#formulario_quejas #expediente').val();
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente,
		   success:function(data){
			  var array = eval(data);		  
			  $('#formulario_quejas #nombre').val(array[0]);
              $('#formulario_quejas #identidad').val(array[1]);					 
			  return false;	  			  
		  }
	  });
	  return false;		
	 }
	});
});

$(document).ready(function(e) {
   $('#formulario_quejas #otros').click(function (){
		if ( $('#formulario_quejas #otros').is(':checked') ) {
			 $("#formulario_quejas #otro_detalle").show();
		}else{
			 $("#formulario_quejas #otro_detalle").hide();
		}
   });
});

$('#reg_quejas').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
    e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 10){		
        if($('#formulario_quejas #expediente').val() != "" && $('#formulario_quejas #servicio').val() != "" && $('#formulario_quejas #queja').val() != ""){			
			agregarQueja();	
		}else{			
			swal({
				title: "Error", 
				text: "Hay registros en blanco, por favor corregir",
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
});

$('#form_seguimiento_queja #reg').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
    e.preventDefault();
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		if($('#form_seguimiento_queja #seguimiento').val() != ""){
			agregarQuejaSeguimiento();
		}else{
			swal({
				title: "Error", 
				text: "Hay registros en blanco, por favor corregir",
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
});
	  
function agregarQueja(){
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/agregarQueja.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_quejas').serialize(),
		success: function(registro){
		    if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination(1);
				return false; 
			}if(registro == 2){
					swal({
						title: "Error", 
						text: "Error al almacenar este registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false; 
			}if(registro == 3){
					swal({
						title: "Error", 
						text: "Este registro ya existe",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false; 
			}else{
					swal({
						title: "Error", 
						text: "Error, no se puedo almacenar el registro",
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

function agregarQuejaSeguimiento(){
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/agregarQuejaSegumiento.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#form_seguimiento_queja').serialize(),
		success: function(registro){
		    if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination(1);
				return false; 
			}if(registro == 2){
					swal({
						title: "Error", 
						text: "Error al almacenar este registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false; 
			}if(registro == 3){
					swal({
						title: "Error", 
						text: "Este registro ya existe",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					return false; 
			}else{
					swal({
						title: "Error", 
						text: "Error, no se puedo almacenar el registro",
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

function showSeguimiento(queja_id){
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/showSeguimiento.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'queja_id='+queja_id,
		success: function(registro){
		   $('#mensaje_show').modal({
			   show:true,
			   keyboard: false,
			   backdrop:'static',
		   });
		   $('#mensaje_show #queja_id').val(queja_id);
		   $('#mensaje_show #mensaje_mensaje_show').html(registro);
		   return false; 
		}
	});
	return false;	
}

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/paginar.php';
	var dato = $('#form_main #bs_regis').val();
	var servicio = '';
	var desde = $('#form_main #fecha_b').val();
	var hasta = $('#form_main #fecha_f').val();
	
	if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = 1;
	}else{
		servicio = $('#form_main #servicio').val();
	}
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&dato='+dato+'&desde='+desde+'&hasta='+hasta,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function agregarSeguimiento(queja_id){
	mensajeMantenimiento("En Desarrollo","Estamos trabajando en esta opción, la misma se encuentra en desarrollo hasta nuevo aviso estará disponbile");
}

function reporteEXCEL(){
	var url = '';
	var dato = $('#form_main #bs-regis').val();
	var servicio = $('#form_main #servicio').val();
	var fecha = $('#form_main #fecha_b').val();
	var fechaf = $('#form_main #fecha_f').val();
		
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/reporte.php?servicio='+servicio+'&fecha='+fecha+'&fechaf='+fechaf;
			
	window.open(url);    	
}

function modal_seguimiento(queja_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	   $('#seguimiento_queja').modal({
		  show:true,
		  keyboard: false,
		  backdrop:'static',
	   });
	   $('#form_seguimiento_queja')[0].reset();
	   $('#form_seguimiento_queja #queja_id').val(queja_id);
	   $('#form_seguimiento_queja #pacientes_id').val(pacientes_id);
	   getNombreSegmimiento(queja_id);
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

function modal_eliminar(queja_id,pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	   $('#eliminar_queja').modal({
		  show:true,
		  keyboard: false,
		  backdrop:'static',
	   });
	   $('#form_eliminar_queja')[0].reset();
	   $('#form_eliminar_queja #queja_id').val(queja_id);
	   $('#form_eliminar_queja #pacientes_id').val(pacientes_id);
	   getNombre(queja_id);
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

function getNombreSegmimiento(queja_id){
    var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/getNombre.php';
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'queja_id='+queja_id,
		success:function(data){	
          $('#form_seguimiento_queja #usuario').val(data);			  		  		  			  
		}
	});	
	
}

function getNombre(queja_id){
    var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/getNombre.php';
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'queja_id='+queja_id,
		success:function(data){	
          $('#form_eliminar_queja #usuario').val(data);			  		  		  			  
		}
	});	
	
}

$('#eliminar').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#form_eliminar_queja #comentario').val() != ""){
		e.preventDefault();
		eliminarRegistro(); 
		return false;
	 }
});

$('#delete_queja').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	eliminarRegistroSeguimiento(); 
	return false;
});

function eliminarRegistro(){
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/eliminar.php';
	
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#form_eliminar_queja').serialize(),
		  success: function(registro){
			  if(registro == 1){
					swal({
						title: "Success", 
						text: "Registro almacenado correctamente",
						type: "success", 
						timer: 3000,
						allowEscapeKey: false,
						allowOutsideClick: false
					});	
					$('#form_eliminar_queja')[0].reset();
					pagination(1);
					return false; 
			  }else if(registro == 2){	
					swal({
						title: "Error", 
						text: "Error al remover esta queja",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});		  
			    return false;  
			  }else if(registro == 3){	
					swal({
						title: "Error", 
						text: "No se puede eliminar esta queja ya que cuenta con un seguimiento almacenado",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});			  
			    return false;  
			  }else{	
					swal({
						title: "Error", 
						text: "Error al ejecutar esta acción",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				 
			  }
  		  }
	   });
	   return false;		
}

function eliminarRegistroSeguimiento(){
	var url = '<?php echo SERVERURL; ?>php/quejas_sugerencias/eliminarSeguimiento.php';
	queja_id = $('#mensaje_show #queja_id').val();
	
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'queja_id='+queja_id,
		  success: function(registro){
			  if(registro == 1){
					swal({
						title: "Error", 
						text: "La queja de seguimiento ha sido eliminada correctamente",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#mensaje_show #mensaje_mensaje_show').html("<td colspan='13' style='color:#C7030D'>No se encontraron resultados</td>");
			     return false; 
			  }else if(registro == 2){	
					swal({
						title: "Error", 
						text: "Error al remover esta queja",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});			  
			    return false;  
			  }else{	
					swal({
						title: "Error", 
						text: "Error al ejecutar esta acción",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				 
			  }
  		  }
	   });
	   return false;		
}

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

$('#formulario_quejas #buscar_servicios_quejas').on('click', function(e){
	listar_servicios_buscar();
	 $('#modal_busqueda_servicios').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	 
});

var listar_servicios_buscar = function(){
	var table_servicios_buscar = $("#dataTableServicios").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/quejas_sugerencias/getServiciosTable.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"nombre"}		
		],
		"pageLength" : 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_servicios_buscar.search('').draw();
	$('#buscar').focus();
	
	view_servicios_busqueda_dataTable("#dataTableServicios tbody", table_servicios_buscar);
}

var view_servicios_busqueda_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();		  
		$('#formulario_quejas #servicio').val(data.servicio_id);
		$('#modal_busqueda_servicios').modal('hide');
	});
}
</script>