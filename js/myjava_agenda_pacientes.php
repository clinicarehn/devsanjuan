<script>
$(document).ready(function() {
   getServicio();
   getAtencion();
   getStatusRepro();
   getHoraNueva();
   getConfirmacion_si();
   getConfirmacion_no();
   pagination(1);
   cleanTriage();
});

$(document).ready(function() {
  $('#form_agenda_main #servicio').on('change', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_agenda_main #unidad').on('change', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_agenda_main #medico_general').on('change', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_agenda_main #fecha').on('change', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_agenda_main #fechaf').on('change', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_agenda_main #bs-regis').on('keyup', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_agenda_main #atencion').on('change', function(){
     pagination(1);
  });
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#eliminar").on('shown.bs.modal', function(){
        $(this).find('#form_ausencia #motivo_ausencia').focus();
    });
});

$(document).ready(function(){
    $("#eliminar_cita").on('shown.bs.modal', function(){
        $(this).find('#form-eliminarcita #comentario').focus();
    });
});

/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$('#form_agenda_main #reporte').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	e.preventDefault();
	if($('#form_agenda_main #servicio').val() != ""){
	   reporteEXCEL();
	}else{
		swal({
			title: "Error", 
			text: "Error al exportar, debe seleccionar el servicio",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
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

$('#form_agenda_main #Reporte_Agenda').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	e.preventDefault();
	if($('#form_agenda_main #servicio').val() != ""){
	   reporteEXCELReporte();
	}else{
		swal({
			title: "Error", 
			text: "Error al exportar, debe seleccionar el servicio",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;
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

$('#form_agenda_main #agenda_usuarios').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	e.preventDefault();
	if($('#form_agenda_main #servicio').val() != ""){
	   	reporteExcelAgenda();
	}else{
		swal({
			title: "Error", 
			text: "Error al exportar, debe seleccionar el servicio",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;
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

$('#descargar_triage').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	e.preventDefault();
	if($('#formulario_triage_reporte #servicio_triage').val() != ""){
	   	reporteAgendaTriage();
	}else{
		swal({
			title: "Error", 
			text: "Debe seleccionar un servicio antes de continuar",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
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

$('#form_agenda_main #agenda_triage').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	cleanReporteTriage();
	$('#agregar_triage_reporte').modal({
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

$('#form_agenda_main #reporte_sms').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
   if($('#form_agenda_main #servicio').val() != ""){
	   e.preventDefault();
	   reporteSMS();
   }else{
		swal({
			title: "Error", 
			text: "Debe seleccionar un servicio antes de continuar",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
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

$('#form_agenda_main #reporte_smsDiasAntes').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
   if($('#form_agenda_main #servicio').val() != ""){
	   e.preventDefault();
	   reporteSMSDiasAntes();
   }else{
		swal({
			title: "Error", 
			text: "Debe seleccionar un servicio antes de continuar",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
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

$('#form_agenda_main #confirmacion_agenda').on('click', function(e){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	e.preventDefault();
	if($('#form_agenda_main #servicio').val() != ""){
	   reporteConfirmacionAgenda();
	}else{
		swal({
			title: "Error", 
			text: "Error al exportar, debe seleccionar el servicio",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
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

$('#edi').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
  if ($('#formulario #hora_nueva').val()!="" && $('#formulario #observacion').val()!="" && $('#formulario #status_repro').val()!=""){
     e.preventDefault();
     agregaRegistro();	  	
  }
});

$('#edi1').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	if ($('#formulario #comentario').val()!= ""){
	    e.preventDefault();
	    agregaRegistroComentario(); 
	}else{
		swal({
			title: "Error", 
			text: "El comentario no puede estar vacío",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		$('#comentario').focus();
		return false;
	}
});

$('#form_ausencia #Si').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	e.preventDefault();
	if($('#form_ausencia #motivo_ausencia').val() != ""){
		eliminarRegistro(); 
	}else{
		swal({
			title: "Error", 
			text: "El comentario no puede estar vacío",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;
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

$('#reg_triage').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();
	if($('#formulario_triage #comentario_triage').val() != ""){
		agregarTriage();
	}else{
		swal({
			title: "Error", 
			text: "El comentario no puede estar vacío",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
	}
});

$('#edit_triage').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
  e.preventDefault();
  if($('#formulario_triage #comentario_triage').val() != ""){     
     modificarTriage();	  	
  }else{
		swal({
			title: "Error", 
			text: "El comentario no puede estar vacío",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;
  }	    
});

function clean(){
	getHoraNueva();
	getStatusRepro();
}

function agregaRegistro(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/agregar.php';
		
    var fecha = $('#formulario #fecha_n').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);	
	var agenda_id = $('#formulario #agenda_id').val();
	var pacientes_id = $('#formulario #pacientes_id_registro').val();
	var colaborador_id = $('#formulario #id-registro').val();
	var servicio_id = getServicio_id(agenda_id);
		
	$.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario').serialize(),
		  success: function(registro){
			  if(registro == 1){
					swal({
						title: "Error", 
						text: "El médico ya tiene ocupada esa hora, por favor corregir",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				    return false; 
			  }else if(registro == "Nula"){
					swal({
						title: "Error", 
						text: "No se puede agendar un usuario en esta hora",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
		            $('#formulario #hora').focus();
				    return false; 
			  }else if (registro == 'NulaN'){
					swal({
						title: "Error", 
						text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
                    $('#formulario #hora').focus();					
					return false;
		      }else if (registro == 'NulaS'){
					swal({
						title: "Error", 
						text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});					 					
			    	return false;	
		      }else if (registro == 'NulaP'){
					swal({
						title: "Error", 
						text: "No se puede agendar este usuario en esta hora",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				    return false;	
			  }else if (registro == 'NulaSError'){
					swal({
						title: "Error", 
						text: "No se puede agendar este usuario en esta hora",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});						 					
				    return false;	
			  }else if (registro == 'NuevosExcede'){
					swal({
						title: "Error", 
						text: "No se puede agendar mas usuarios nuevos ya llego al límite",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});						 					
					return false;	
			  }else if (registro == 'SubsiguienteExcede'){
					swal({
						title: "Error", 
						text: "No se puede agendar mas usuarios subsiguientes ya llego al límite",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});							 					
					return false;	
			  }else if (registro == 'Vacio'){
					swal({
						title: "Error", 
						text: "El profesional no tiene asignada una jornada laboral o simplemente no tiene un servicio asignado, no se le puede agendar usuarios",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				 					
					return false;	
			  }else if (registro == 'Mayora5anos'){
					swal({
						title: "Error", 
						text: "Lo sentimos, este usuario tiene más  de 5 años que no viene a su cita, debe agendarlo como un usuario nuevo, cualquier consulta por favor avocarse con el departamento de Archivo Clínico",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});												
					return false;	
			  }else if(registro == 2){
					swal({
						title: "Success", 
						text: "Edición completada con éxito",
						type: "success", 
						timer: 3000,
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$('#registrar').modal('hide');
			        pagination(1);		
                    clean();				 
				    reportePDF(getNewAgendaID(pacientes_id,colaborador_id,servicio_id,fecha));
				    sendEmailReprogramación(getNewAgendaID(pacientes_id,colaborador_id,servicio_id,fecha));
			        return false; 
			  }else if(registro == 3){
					swal({
						title: "Error", 
						text: "Error al procesar su solicitud",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 4){
					swal({
						title: "Error", 
						text: "Este usuario ya tiene realizada su preclínica, no se puede realizar ningún cambio",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 5){
					swal({
						title: "Error", 
						text: "Este usuario ya tiene cita para esa fecha, por favor corregir",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 6){
					swal({
						title: "Error", 
						text: "No se permite agendar un fin de semana",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 7){
					swal({
						title: "Error", 
						text: "Este usuario ya tiene realizada su preclínica, no se puede realizar ningún cambio",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 8){
					swal({
						title: "Error", 
						text: "Lo sentimos, este usuario ya ha fallecido, para mayor información comuniquese al departamento de Archivo Clínico",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 9){
					swal({
						title: "Error", 
						text: "Este es un usuario pasivo, por favor abocarse con el departamento de Archivo Clínico para cambiar el estatus del mismo y poder continuar con la reprogramación de la cita",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
			       return false; 
			  }else if(registro == 10){
					swal({
						title: "Error", 
						text: "Lo sentimos este usuario ya tiene marcada una ausencia no se puede reprogramar esta cita para este día, por favor elimine la ausencia antes de continuar",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				
					return false;
			   }else if(registro == 11){
					swal({
						title: "Error", 
						text: "El profesional tiene esta hora ocupada en otro servicio, por favor validar antes de continuar",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				
					return false;
			   }else{
					swal({
						title: "Error", 
						text: "Lo sentimos no se puede procesar su solicitd, por favor intentelo de nuevo más tarde",
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

function agregaRegistroComentario(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/agregar_comentario.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
            if ($('#formulario #pro').val() == 'Edicion'){
			  if(registro == 1){
					swal({
						title: "Error", 
						text: "El médico ya tiene ocupada esa hora, por favor corregir",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				   return false; 
			  }else{
					swal({
						title: "Success", 
						text: "El comentario se ha agregado exitosamente",
						type: "success", 
						timer: 3000,
						allowEscapeKey: false,
						allowOutsideClick: false
					});	
					$('#registrar').modal('hide');
                    pagination(1);					   			  
			        return false; 
			  }
			}
		}
	});
	return false;	
}

function agregarTriage(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/agregarTriage.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_triage').serialize(),
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
				$('#agregar_triage_reporte').modal('hide');
				cleanTriage();
				$("#reg_triage").attr('disabled', true);	
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
                pagination(1);					   			  
			    return false; 
			}
		}
	});
	return false;	
}

function modificarTriage(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/modificarTriage.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_triage').serialize(),
		success: function(registro){
		    if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro Editado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#agregar_triage_reporte').modal('hide');
				$("#reg_triage").attr('disabled', true);	
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
                pagination(1);					   			  
			    return false; 
			}
		}
	});
	return false;	
}

function getNombre(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getNombre.php';
	var agenda_id;
	
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'agenda_id='+agenda_id,
		success:function(data){	
          agenda_id = data;			  		  		  			  
		}
	});		
	return agenda_id;
}

function getExpediente(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getExpediente.php';
	var expediente;
	
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'agenda_id='+agenda_id,
		success:function(data){	
           expediente = data;			  		  		  			  
		}
	});	
	return expediente;
}

function getPacientes_id(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getPacientes_id.php';
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'agenda_id='+agenda_id,
		success:function(data){	
          $('#form-eliminarcita #pacientes_id').val(data);			  		  		  			  
		}
	});	
	
}

function modal_eliminar(id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	 
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar la cita para este usuario: " + getNombre(id) + " con número de expediente " + getExpediente(id) + "?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eiminar la cita!",
			closeOnConfirm: false,
			inputPlaceholder: "Comentario",
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(inputValue){
		  if (inputValue === false) return false;
		  if (inputValue === "") {
			swal.showInputError("Necesitas escribir algo");
			return false
		  }	
		  eliminarCita(id,inputValue);
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

function eliminarCita(id,comentario){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/eliminar.php';
	
    var fecha = $('#form_agenda_main #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

   if(getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){//SOLO SI EL USUARIO ES ADMINISTRADOR PUEDE ELIMINAR LOS REGISTROS
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'id='+id+'&comentario='+comentario,
		   success: function(registro){
		      if(registro ==1){
			     $('#form-eliminarcita')[0].reset();			  
				swal({
					title: "Success", 
					text: "Se ha eliminado la cita",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				$('#eliminar_cita').modal('hide');
                pagination(1);			  
			    return false;			  			  
		      }else if(registro ==2){
				swal({
					title: "Error", 
					text: "No se puedo eliminar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				return false;
		      }else if(registro ==3){
				swal({
					title: "Error", 
					text: "No se puedo eliminar el registro ya se realizo la preclínica para este usuario",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
		      }else if(registro ==4){
				swal({
					title: "Error", 
					text: "Lo sentimos, no se puede eliminar esta cita, debido a que sobrepasa el tiempo permitido, por favor proceda a reprogramar la cita, para poder continuar",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    return false;
		      }else{
				swal({
					title: "Error", 
					text: "Error al procesar la solicitud",
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
   }else{
      if ( fecha >= fecha_actual){		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'id='+id+'&comentario='+comentario,
		   success: function(registro){
		      if(registro ==1){
			    $('#form-eliminarcita')[0].reset();			  
				swal({
					title: "Success", 
					text: "Se ha eliminado la cita",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				$('#eliminar_cita').modal('hide');
                pagination(1);			  
			    return false;			  			  
		      }else if(registro ==2){
				swal({
					title: "Error", 
					text: "No se puedo eliminar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
		      }else if(registro ==3){
				swal({
					title: "Error", 
					text: "No se puedo eliminar el registro ya se realizo la preclínica para este usuario",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
		      }else if(registro ==4){
				swal({
					title: "Error", 
					text: "Lo sentimos, no se puede eliminar esta cita, debido a que sobrepasa el tiempo permitido, por favor proceda a reprogramar la cita, para poder continuar",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
		      }else{
				swal({
					title: "Error", 
					text: "Error al procesar la solicitud",
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

$(document).ready(function(e) {
  $('#formulario #hora_nueva').on('change', function(){	
		var url = '<?php echo SERVERURL; ?>php/citas/getHora.php';
		var fecha = $('#formulario #fecha_n').val();
		var hora = $('#formulario #hora_nueva').val();
		var agenda_id = $('#formulario #agenda_id').val();
		var colaborador_id = $('#form_agenda_main #medico_general').val();
		var hoy = new Date();
		fecha_actual = convertDate(hoy);

		var fecha = $('#formulario #fecha_n').val() + " " + $('#formulario #hora_nueva').val();
		var nombre_colaborador = $('#form_agenda_main #medico_general option:selected').html();
		
		if (getBloqueoFecha(fecha, $('#form_agenda_main #medico_general').val(), $('#form_agenda_main #servicio').val()) == 1){
			if(fecha<fecha_actual){
				swal({
					title: "Error", 
					text: "No se puede reprogramar en esta fecha",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$("#edi").attr('disabled', true);
			}else{	
			  $.ajax({
				type:'POST',
				url:url,
				async: true,
				data:'fecha='+fecha+'&agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&hora='+hora,
				success:function(data){	
					 if (data == 'NulaN'){
						swal({
							title: "Error", 
							text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});		   
						$('#edi').attr('disabled', true);
					   return false;
					 }else if (data == 'NulaS'){
						swal({
							title: "Error", 
							text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});					
						$('#edi').attr('disabled', true);
						return false;
					 }else if (data == 'Nula'){
						swal({
							title: "Error", 
							text: "No se puede agendar este usuario en esta hora",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});			
						$('#edi').attr('disabled', true);				
						return false;
					 }else if (data == 'NulaP'){
						swal({
							title: "Error", 
							text: "No se puede agendar este usuario en esta hora",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});
						$('#edi').attr('disabled', true);
						return false;
					 }else if (data == 2){
						swal({
							title: "Error", 
							text: "El médico ya tiene la hora ocupada",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});
						$('#edi').attr('disabled', true);
						return false;
					 }else if (data == 3){
						swal({
							title: "Error", 
							text: "Usuario ya tiene cita agendada ese día",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});				
						$('#edi').attr('disabled', true);
						return false;
					 }else{
						 $('#hora_citaeditend').val(data);
						 $('#edi').attr('disabled', false);
						 return false;				  		  		  		  			  
					 }
				}
			  });
			  return false;
			 }			 
		}else{
			swal({
				title: "Error",
				text: "La hora se encuentra bloqueada para el medico . " + nombre_colaborador + " con el comentario: " +
				getComentarioBloqueoHora(fecha, $('#form_agenda_main #medico_general').val(), $('#form_agenda_main #servicio').val()) + "",
				type: "error",
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			$('#edi').attr('disabled', true);
			return false;
		}	
    });
});

function getFechaAusencias(fecha, colaborador_id){
    var url = '<?php echo SERVERURL; ?>php/citas/getFechaAusencias.php';
	var valor = "";
	$.ajax({
	    type:'POST',
		url:url,
		data:'fecha='+fecha+'&colaborador_id='+colaborador_id,
		async: false,
		success:function(data){	
          valor = data;			  		  		  			  
		}
	});
	return valor;
}

$(document).ready(function(e) {
  $('#formulario #fecha_n').on('change', function(){
		var fecha = $('#formulario #fecha_n').val() + " " + $('#formulario #hora_nueva').val();
		var nombre_colaborador = $('#form_agenda_main #medico_general option:selected').html();
		
		if (getBloqueoFecha(fecha, $('#form_agenda_main #medico_general').val(), $('#form_agenda_main #servicio').val()) == 1){		
			if(getFechaAusencias($('#fecha_n').val(), $('#formulario #id-registro').val()) == 2){
				$("#formulario #hora_nueva").attr('disabled', false);
				$("#formulario #status_repro").attr('disabled', false);
				
				 if(consultarFecha($('#formulario #fecha_n').val()) == 6 || consultarFecha($('#formulario#fecha_n').val()) == 0){
					swal({
						title: "Error", 
						text: "No se permite agendar un fin de semana",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				
					$("#edi").attr('disabled', true);		
				 }else{	 
					 $("#edi").attr('disabled', false);		 
					 var url = '<?php echo SERVERURL; ?>php/citas/getHora.php';
					 var fecha = $('#fecha_n').val();
					 var hora = $('#hora_nueva').val();
					 var agenda_id = $('#agenda_id').val();
					 var colaborador_id = $('#medico_general').val();
			
					var hoy = new Date();
					fecha_actual = convertDate(hoy);
			
					if(fecha<fecha_actual){
						swal({
							title: "Error", 
							text: "No se puede reprogramar en esta fecha",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey: false,
							allowOutsideClick: false
						});
						$("#edi").attr('disabled', true);
					}else{
					 $.ajax({
					   type:'POST',
					   url:url,
					   async: true,
					   data:'fecha='+fecha+'&agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&hora='+hora,
					   success:function(data){	
						   if (data == 'NulaN'){
								swal({
									title: "Error", 
									text: "No se puede agendar este usuario en esta hora ya que es un usuario nuevo",
									type: "error", 
									confirmButtonClass: "btn-danger",
									allowEscapeKey: false,
									allowOutsideClick: false
								});					
								$("#edi").attr('disabled', true);
								return false;
						   }else if (data == 'NulaS'){
								swal({
									title: "Error", 
									text: "No se puede agendar este usuario en esta hora ya que es un usuario subsiguiente",
									type: "error", 
									confirmButtonClass: "btn-danger",
									allowEscapeKey: false,
									allowOutsideClick: false
								});								
								$("#edi").attr('disabled', true);
								return false;
						   }else if (data == 'Nula'){
								swal({
									title: "Error", 
									text: "No se puede agendar este usuario en esta hora",
									type: "error", 
									confirmButtonClass: "btn-danger",
									allowEscapeKey: false,
									allowOutsideClick: false
								});						
								$("#edi").attr('disabled', true);
								return false;
						   }else if (data == 'NulaP'){
								swal({
									title: "Error", 
									text: "No se puede agendar este usuario en esta hora",
									type: "error", 
									confirmButtonClass: "btn-danger",
									allowEscapeKey: false,
									allowOutsideClick: false
								});							
								$("#edi").attr('disabled', true);
								return false;
						   }else if (data == 2){
								swal({
									title: "Error", 
									text: "El médico ya tiene la hora ocupada",
									type: "error", 
									confirmButtonClass: "btn-danger",
									allowEscapeKey: false,
									allowOutsideClick: false
								});							
								$("#edi").attr('disabled', true);
								return false;
						   }else if (data == 3){
								swal({
									title: "Error", 
									text: "Usuario ya tiene cita agendada ese día",
									type: "error", 
									confirmButtonClass: "btn-danger",
									allowEscapeKey: false,
									allowOutsideClick: false
								});						
								$("#edi").attr('disabled', true);
								return false;
						   }else{					
							  $('#hora_citaeditend').val(data);
							  $("#edi").attr('disabled', false);
							  return false;				  		  		  		  			  
							}
					  }
					});
					return false;
				  }
				}		
			}else{
				swal({
					title: "Error", 
					text: "El médico se encuentra ausente, no se le puede agendar una cita. " + getComentarioAusencia($('#fecha_n').val(), $('#formulario #id-registro').val()) + "",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});							
				$("#edi").attr('disabled', true);
				$("#formulario #hora_nueva").attr('disabled', true);
				$("#formulario #status_repro").attr('disabled', true);		
			}	
		}else{
			swal({
				title: "Error",
				text: "La hora se encuentra bloqueada para el medico . " + nombre_colaborador + " con el comentario: " +
				getComentarioBloqueoHora(fecha, $('#form_agenda_main #medico_general').val(), $('#form_agenda_main #servicio').val()) + "",
				type: "error",
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
			$('#edi').attr('disabled', true);
			return false;
		}	
  });
});

function editarRegistro(agenda_id, colaborador_id, pacientes_id, servicio_id){ 
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
   var atencion;
   
   if($('#form_agenda_main #atencion').val() == ""){
	  atencion = 0;
   }else{
	  atencion = $('#form_agenda_main #atencion').val();
   }
     
   if(atencion==2 || atencion==0){
	   $('#formulario')[0].reset();
	   var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/editar.php';
	   var fecha = $('#form_agenda_main #fecha').val();
	
		$.ajax({
		   type:'POST',
		   url:url,
		   data:'agenda_id='+agenda_id+'&fecha='+fecha+'&colaborador_id='+colaborador_id,
		   success: function(valores){
				var datos = eval(valores);
				getHoraNueva();
				getStatusRepro();
				$('#formulario #reg').hide();
				$('#edi').show();
				$('#formulario #pro').val('Edicion');
				$('#formulario #pacientes_id_registro').val(pacientes_id);
				$('#formulario #servicio_registro').val(servicio_id);
				$('#formulario #id-registro').val(datos[0]);
				$('#formulario #expediente').val(datos[1]);			
				$('#formulario #nombre').val(datos[2]);
				$('#formulario #fecha_a').val(datos[3]);
				$('#formulario #agenda_id').val(datos[4]);
				$('#formulario #observacion').val(datos[7]);
                $('#formulario #comentario').val(datos[5]);				
				$('#formulario #fecha_n').val(datos[6]);
				$('#formulario #status_repro').val(datos[9]);
				$('#formulario #profesional').val(datos[10]);				
				$('#formulario #cant_reprogramaciones').html('Reprogramaciones: ' + datos[8]);
				caracteresComentarioAgendaCitas();
				caracteresObservacionAgendaCitas();

				$("#edi1").attr('disabled', true);
				if(atencion==2){
					$("#edi").attr('disabled', false);
				}else{
					$("#edi").attr('disabled', true);
				}					
				
				$('#registrar').modal({
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
		title: "Error", 
		text: "No se puede reprogramar esta cita",
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

function reporteEXCEL(){
    var id = $('#form_agenda_main #medico_general').val();	
	var fecha = $('#form_agenda_main #fecha').val();
	var fechaf = $('#form_agenda_main #fechaf').val();
	var unidad = $('#form_agenda_main #unidad').val();
	var servicio = $('#form_agenda_main #servicio').val();
	var medico_general = $('#form_agenda_main #medico_general').val();
	
	if ($('#atencion').val() == ""){
	   atencion = 0;	
	}else{
	   atencion = $('#atencion').val();
	}	
	
	var dato = $('#bs-regis').val();
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/buscar_agenda_usuarios_excel.php?dato='+dato+'&fecha='+fecha+'&fechaf='+fechaf+'&id='+id+'&servicio='+servicio+'&unidad='+unidad+'&medico_general='+medico_general+'&atencion='+atencion;
    window.open(url);		 
}

function reporteConfirmacionAgenda(){	
	var fecha = $('#form_agenda_main #fecha').val();
	var fechaf = $('#form_agenda_main #fechaf').val();
	var servicio = $('#form_agenda_main #servicio').val();	
	var unidad = $('#form_agenda_main #unidad').val();
	var medico_general = $('#form_agenda_main #medico_general').val();
	var dato = $('#bs-regis').val();

	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/reporteConfirmacionAgenda.php?dato='+dato+'&fecha='+fecha+'&fechaf='+fechaf+'&id='+id+'&servicio='+servicio+'&unidad='+unidad+'&medico_general='+medico_general;
    window.open(url);		
}

function reporteEXCELReporte(){
    var id = $('#form_agenda_main #medico_general').val();	
	var fecha = $('#form_agenda_main #fecha').val();
	var fechaf = $('#form_agenda_main #fechaf').val();
	var unidad = $('#form_agenda_main #unidad').val();
	var servicio = $('#form_agenda_main #servicio').val();
	var medico_general = $('#form_agenda_main #medico_general').val();
	
	if ($('#form_agenda_main #atencion').val() == ""){
	   atencion = 0;	
	}else{
	   atencion = $('#form_agenda_main #atencion').val();
	}	
	
	var dato = $('#form_agenda_main #bs-regis').val();
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/buscar_agenda_usuarios_excel_reporte.php?dato='+dato+'&fecha='+fecha+'&fechaf='+fechaf+'&id='+id+'&servicio='+servicio+'&unidad='+unidad+'&medico_general='+medico_general+'&atencion='+atencion;
    window.open(url);		 
}

function reporteEXCELReporte(){
    var id = $('#form_agenda_main #medico_general').val();	
	var fecha = $('#form_agenda_main #fecha').val();
	var fechaf = $('#form_agenda_main #fechaf').val();
	var unidad = $('#form_agenda_main #unidad').val();
	var servicio = $('#form_agenda_main #servicio').val();
	var medico_general = $('#form_agenda_main #medico_general').val();
	
	if ($('#form_agenda_main #atencion').val() == ""){
	   atencion = 0;	
	}else{
	   atencion = $('#form_agenda_main #atencion').val();
	}	
	
	var dato = $('#form_agenda_main #bs-regis').val();
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/buscar_agenda_usuarios_excel_reporte.php?dato='+dato+'&fecha='+fecha+'&fechaf='+fechaf+'&id='+id+'&servicio='+servicio+'&unidad='+unidad+'&medico_general='+medico_general+'&atencion='+atencion;
    window.open(url);		 
}

function reporteExcelAgenda(){
	var fecha = $('#form_agenda_main #fecha').val();
	var servicio_id = $('#form_agenda_main #servicio').val();
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/reporteAgendaUsuarios.php?fecha='+fecha+'&servicio_id='+servicio_id;
	
    window.open(url);		 
}

function reporteSMS(){
	var fecha = $('#form_agenda_main #fecha').val();
	var servicio = $('#form_agenda_main #servicio').val();
	
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/sms.php?fecha='+fecha+'&servicio='+servicio;
	
    window.open(url);		 
}

function reporteSMSDiasAntes(){
	var fecha = $('#form_agenda_main #fecha').val();
	var servicio = $('#form_agenda_main #servicio').val();
	
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/sms_diasantes.php?fecha='+fecha+'&servicio='+servicio;
	
    window.open(url);		 
}

function reporteAgendaTriage(){
	var servicio = $('#formulario_triage_reporte #servicio_triage').val();
	var fecha = $('#formulario_triage_reporte #fecha_b').val();
	var fechaf = $('#formulario_triage_reporte #fecha_f').val();	
	var reporte = '';
	var url = '';
	
	if($('#formulario_triage_reporte #reporte_triage').val() == ""){
		reporte = 1;
	}else{
		reporte = $('#formulario_triage_reporte #reporte_triage').val();
	}

    if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/agenda_pacientes/reporteTriageAgenda.php?servicio='+servicio+'&fechai='+fecha+'&fechaf='+fechaf;
		window.open(url);
	}else{
		url = '<?php echo SERVERURL; ?>php/agenda_pacientes/reporteTriage.php?servicio='+servicio+'&fechai='+fecha+'&fechaf='+fechaf;
		window.open(url);
	} 
}

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/paginar.php';
	var fecha = $('#form_agenda_main #fecha').val();
	var fechaf = $('#form_agenda_main #fechaf').val();
	var servicio;
	var unidad;
	var medico_general;
	var dato = '';
	var atencion;
	
	
	if ($('#form_agenda_main #atencion').val() == "" || $('#form_agenda_main #atencion').val() == null){
	  atencion = 0;	
	}else{
	  atencion = $('#form_agenda_main #atencion').val();
	}
	
	if ($('#form_agenda_main #unidad').val() == "" || $('#form_agenda_main #unidad').val() == null){
	  unidad = 0;	
	}else{
	  unidad = $('#form_agenda_main #unidad').val();
	}	
	
	if ($('#form_agenda_main #servicio').val() == "" || $('#form_agenda_main #servicio').val() == null){
	  servicio = 1;	
	}else{
	  servicio = $('#form_agenda_main #servicio').val();
	}	
	
	if ($('#form_agenda_main #medico_general').val() == "" || $('#form_agenda_main #medico_general').val() == null){
	  medico_general = 0;	
	}else{
	  medico_general = $('#form_agenda_main #medico_general').val();
	}		
	
	if($('#form_agenda_main #bs-regis').val() == "" || $('#form_agenda_main #bs-regis').val() == null){
		dato = '';
	}else{
	    dato = $('#form_agenda_main #bs-regis').val();	
	}
	
	$.ajax({
		type:'POST',
		url:url,
		async: false,
		data:'partida='+partida+'&fecha='+fecha+'&fechaf='+fechaf+'&dato='+dato+'&servicio='+servicio+'&unidad='+unidad+'&medico_general='+medico_general+'&atencion='+atencion,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

$(document).ready(function() {
	  $('#formulario_enviar_sms_varios #servicio').on('change', function(){
		var servicio_id = $('#formulario_enviar_sms_varios #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_enviar_sms_varios #unidad').html("");
				$('#formulario_enviar_sms_varios #unidad').html(data);			
            }
         });		 
      });					
});

$(document).ready(function() {
	  $('#formulario_enviar_sms_varios #unidad').on('change', function(){
		var servicio_id = $('#formulario_enviar_sms_varios #servicio').val();
		var puesto_id = $('#formulario_enviar_sms_varios #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
				$('#formulario_enviar_sms_varios #medico').html("");
				$('#formulario_enviar_sms_varios #medico').html(data);				
            }
         });		 
      });					
});

//CONSULTA EN LA CARPETA CITAS
$(document).ready(function() {
	  $('#form_agenda_main #servicio').on('change', function(){
		var servicio_id = $('#form_agenda_main #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#form_agenda_main #unidad').html(data);			
            }
         });		 
      });					
});

$(document).ready(function() {
	  $('#form_agenda_main #unidad').on('change', function(){
		var servicio_id = $('#form_agenda_main #servicio').val();
		var puesto_id = $('#form_agenda_main #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/citas/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
				$('#form_agenda_main #medico_general').html(data);				
            }
         });		 
      });					
});

function getServicio_id(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getServicio_id.php';
	var servicio_id;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'agenda_id='+agenda_id,
		success:function(valores){	
          servicio_id = valores;	  
		}
	});
	return servicio_id;		
}

function getNewAgendaID(pacientes_id,colaborador_id,servicio_id,fecha){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getNewAgendaId.php';
	var new_agenda_id;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'pacientes_id='+pacientes_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id+'&fecha='+fecha,
		success:function(valores){	
          new_agenda_id = valores;	  
		}
	});
	return new_agenda_id;		
}

function reportePDF(agenda_id){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	    window.open('<?php echo SERVERURL; ?>php/citas/tickets.php?agenda_id='+agenda_id);
	}else{
	    $('#form_agenda_main #bs-regis').val("");	
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
	$("#edi1").attr('disabled', true);		
	  $('#formulario #checkeliminar').on('click', function(){
		  if($('#formulario #checkeliminar:checked').val() == 1){
			  $("#edi1").attr('disabled', false);  
		  }else{
			  $("#edi1").attr('disabled', true); 
		  }			 
      });	  
});

function nosePresentoRegistro(id, pacientes_id, fecha){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){		
    if($('#form_agenda_main #atencion').val() == 0){ 		  
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
			text: "¿Desea remover este usuario: " + dato + " que no se presento a su cita?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, remover este registro!",
			closeOnConfirm: false,
			inputPlaceholder: "Comentario",
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(inputValue){
		  if (inputValue === false) return false;
		  if (inputValue === "") {
			swal.showInputError("Necesitas escribir algo");
			return false
		  }	
			eliminarRegistro(id,inputValue, fecha);
		});			
	   }else{	
			swal({
				title: "Error", 
				text: "Error al ejecutar esta acción, el usuario debe estar en estatus pendiente",
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

function eliminarRegistro(id, comentario, fecha){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/usuario_no_presento.php';
	var fecha = $('#form_agenda_main #fecha').val();	
	
	var atencion = $('#form_agenda_main #atencion').val();
	
	if(atencion == "" || atencion == null){
		atencion == 0
	}else{
		atencion = $('#form_agenda_main #atencion').val();
	}
	
	/*if (fecha > fecha_actual){
		swal({
			title: 'Error', 
			text: 'Lo sentimos, no se permite marcar ausencia mayores a la fecha actual',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
	   return false;
	}else{*/
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'id='+id+'&fecha='+fecha+'&comentario='+comentario,
		  success: function(registro){
			  if(registro == 1){
				swal({
					title: "Success", 
					text: "La ausencia ha sido agregada con éxito",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				pagination(1);
				return false; 
			  }else if(registro == 2){	
				swal({
					title: "Error", 
					text: "Error al remover este registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false; 
			  }else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Este registro ya tiene almacenada una ausencia",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		  
				return false; 
			  }else if(registro == 4){
				swal({
					title: "Error", 
					text: "Este usuario ya ha sido precliniado, no puede marcarle una ausencia",
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
	//}
}

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getMes(fecha){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getMes.php';
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

function limpiar(){		
    $('#form_agenda_main #agrega-registros').html("");
	$('#form_agenda_main #pagination').html("");		
    getServicio();
    getAtencion();
    pagination(1);
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_agenda_main #servicio').html("");
			$('#form_agenda_main #servicio').html(data);

		    $('#formulario_triage_reporte #servicio_triage').html("");
			$('#formulario_triage_reporte #servicio_triage').html(data);	
		}			
     });	
}

function getAtencion(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getReporte.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_agenda_main #atencion').html("");
			$('#form_agenda_main #atencion').html(data);
		}			
     });	
}

function getStatusRepro(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getStatusID.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #status_repro').html("");
			$('#formulario #status_repro').html(data);
		}			
     });	
}

function getHoraNueva(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getHoraNueva.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #hora_nueva').html("");
			$('#formulario #hora_nueva').html(data);
		}			
     });	
}

$(document).ready(function() {
	setInterval('pagination(1)',220000);	
});

function sendEmailReprogramación(agenda_id){
    var url = '<?php echo SERVERURL; ?>php/mail/correo_reprogramaciones.php';
	
	$.ajax({
	    type:'POST',
		url:url,
		data:'agenda_id='+agenda_id,
		success: function(valores){	
           		  		  		  			  
		}
	});	
}

/****************************************************************************************************************/
//CONFIRMACION EN AGENDA

//INICIO MODAL CONFIRMACIÓN
function modal_agregar_confirmacion(agenda_id, colaborador_id, servicio_id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/editConfirmacion.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id,
		success: function(valores){
			var datos = eval(valores);
			cleanConfirmacion();
			$('#formulario_agregar_confirmacion')[0].reset();
            $('#formulario_agregar_confirmacion #pro_confirmacion').val("Registo");
			$('#formulario_agregar_confirmacion #agenda_id_confirmacion').val(datos[0]);
			$('#formulario_agregar_confirmacion #colaborador_id_confirmacion').val(datos[1]);
			$('#formulario_agregar_confirmacion #servicio_id_confirmacion').val(datos[2]);
			$('#formulario_agregar_confirmacion #fecha_confirmacion').val(datos[3]);
            $('#formulario_agregar_confirmacion #expediente_confirmacion').val(datos[4]);
            $('#formulario_agregar_confirmacion #nombre_confirmacion').val(datos[5]);			
            $('#formulario_agregar_confirmacion #identidad_confirmacion').val(datos[6]);
			$('#formulario_agregar_confirmacion #correo_confirmacion').val(datos[7]);
			$('#formulario_agregar_confirmacion #telefono_confirmacion').val(datos[8]);
			$('#formulario_agregar_confirmacion #observacion_confirmacion').val(datos[9]);
			$('#formulario_agregar_confirmacion #hora_confirmacion').val(datos[12]);
			caracteresObservacionAgendaConfirmacion()
            $('#reg_confirmacion').show();
			$('#edit_confirmacion').hide();
			
            if(datos[10] == 1){
			    $('#formulario_agregar_confirmacion #si_respuesta_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX
			    $('#formulario_agregar_confirmacion #no_respuesta_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
                $('#formulario_agregar_confirmacion #grupo_confirmacion').show();
		        $('#formulario_agregar_confirmacion #grupo_confirmacion1').hide();				
				getConfirmacion_si();
				$('#formulario_agregar_confirmacion #confirmo_si').val(datos[11]);
			}else{
			    $('#formulario_agregar_confirmacion #si_respuesta_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
			    $('#formulario_agregar_confirmacion #no_respuesta_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX		
                $('#formulario_agregar_confirmacion #grupo_confirmacion').hide();
		        $('#formulario_agregar_confirmacion #grupo_confirmacion1').show();					
				getConfirmacion_no();
				$('#formulario_agregar_confirmacion #confirmo_no').val(datos[11]);
			}
	
			$('#formulario_agregar_confirmacion #actualizar_datos_si').prop('checked', false); //DESELECCIONA UN CHECK BOX
			$('#formulario_agregar_confirmacion #actualizar_datos_no').prop('checked', true); //DESELECCIONA UN CHECK BOX

			$('#formulario_agregar_confirmacion #editar_si_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
			$('#formulario_agregar_confirmacion #editar_no_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX			
				
	        $('#agregar_confirmacion').modal({
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

function modal_triage(agenda_id, colaborador_id, servicio_id, pacientes_id, expediente){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	   if(consultarAtencionTriage(agenda_id, colaborador_id, servicio_id, expediente, pacientes_id) == 2){//EL REGISTRO NO EXISTE
			//if(consultaTipoUsuario(pacientes_id,colaborador_id,servicio_id,expediente) == 'S'){
				var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/editConfirmacion.php';
			
				$.ajax({
					type:'POST',
					url:url,
					data:'agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id,
					success: function(valores){
						var datos = eval(valores);
						cleanTriage();
						$('#formulario_triage')[0].reset();
						$('#formulario_triage #pro_triage').val("Registo");
						$('#formulario_triage #tipo_usuario').val(consultaTipoUsuario(pacientes_id,colaborador_id,servicio_id,expediente));
						$('#formulario_triage #agenda_id_triage').val(datos[0]);
						$('#formulario_triage #colaborador_id_triage').val(datos[1]);
						$('#formulario_triage #servicio_id_triage').val(datos[2]);
						$('#formulario_triage #fecha_triage').val(datos[3]);
						$('#formulario_triage #expediente_triage').val(datos[4]);
						$('#formulario_triage #nombre_triage').val(datos[5]);			
						$('#formulario_triage #identidad_triage').val(datos[6]);
						$('#formulario_triage #pacientes_id').val(pacientes_id);
						$('#reg_triage').show();						
						$('#formulario_triage #mensaje_confirmacion').removeClass('bien');
						$('#formulario_triage #mensaje_inmensaje_confirmacionfo_respuesta').removeClass('error');
						$('#formulario_triage #mensaje_confirmacion').removeClass('alerta');
						$('#formulario_triage #mensaje_confirmacion').html('');
						$('#reg_triage').show();
						$('#edit_triage').hide();
						$("#reg_triage").attr('disabled', false);
						caracteresComentarioAgendaTriage();
				
						$('#agregar_triage').modal({
						  show:true,
						  keyboard: false,
						  backdrop:'static'  
						}); 
						return false;
					}
				});		
				/*}else{
					swal({
						title: "Error", 
						text: "Solo se permite realizar el triage a los usuarios subsiguientes",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
				}*/			
	   }else{
			swal({
				title: "¿Estas seguro?",
				text: "¿Desea Editar los datos para este registro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "¡Si, editar los datos para este registro!",
				closeOnConfirm: false,
				allowEscapeKey: false,
				allowOutsideClick: false
			},
			function(){
				swal.close();
				editarTriage(agenda_id, colaborador_id, servicio_id, expediente, pacientes_id);
			});
		    $('#formulario_triage #agenda_id_triage').val(agenda_id);
		    $('#formulario_triage #colaborador_id_triage').val(colaborador_id);
		    $('#formulario_triage #servicio_id_triage').val(servicio_id);
		    $('#formulario_triage #expediente_triage').val(expediente);
		    $('#formulario_triage #pacientes_id').val(pacientes_id);
	 }			
	}else{
		swal({
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger"
		});	
	}
}

function editarTriage(agenda_id, colaborador_id, servicio_id, expediente, pacientes_id){
	  var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/editarTriage.php';
	  $.ajax({
		type:'POST',
		url:url,
		data:'agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id+'&expediente='+expediente+'&pacientes_id='+pacientes_id,
		success: function(valores){
			var datos = eval(valores);			
			$('#formulario_triage')[0].reset();
			$('#formulario_triage #pro_triage').val("Registo");
			$('#formulario_triage #tipo_usuario').val(consultaTipoUsuario(pacientes_id,colaborador_id,servicio_id,expediente));
			$('#formulario_triage #agenda_id_triage').val(datos[0]);
			$('#formulario_triage #colaborador_id_triage').val(datos[1]);
			$('#formulario_triage #servicio_id_triage').val(datos[2]);
			$('#formulario_triage #fecha_triage').val(datos[3]);
			$('#formulario_triage #expediente_triage').val(datos[4]);
			$('#formulario_triage #nombre_triage').val(datos[5]);			
			$('#formulario_triage #identidad_triage').val(datos[6]);
			$('#formulario_triage #atencion_triage').val(datos[12]);
					
			if(datos[19] == 1){
				$('#formulario_triage #si_triage').prop('checked', true); //DESELECCIONA UN CHECK BOX
				$('#formulario_triage #no_triage').prop('checked', false); //DESELECCIONA UN CHECK BOX
			}else{
				$('#formulario_triage #si_triage').prop('checked', false); //DESELECCIONA UN CHECK BOX
				$('#formulario_triage #no_triage').prop('checked', true); //DESELECCIONA UN CHECK BOX
			}
			
			if(datos[13] == 1){
				$('#formulario_triage #si_asistira_triage').prop('checked', true); //DESELECCIONA UN CHECK BOX
				$('#formulario_triage #no_asistira_triage').prop('checked', false); //DESELECCIONA UN CHECK BOX
			}else{
				$('#formulario_triage #si_asistira_triage').prop('checked', false); //DESELECCIONA UN CHECK BOX
				$('#formulario_triage #no_asistira_triage').prop('checked', true); //DESELECCIONA UN CHECK BOX
			}
			
			$('#formulario_triage #observacion_triage').val(datos[14]);

			$('#formulario_triage #informacion_triage').val(datos[15]);


			$('#formulario_triage #tipo_triage').val(datos[16]);
			
				
			$('#formulario_triage #comentario_triage').val(datos[17]);
            $('#formulario_triage #triage_id').val(datos[18]);			
			$('#formulario_triage #pacientes_id').val(pacientes_id);
			$('#reg_triage').show();						
			$('#reg_triage').hide();
			$('#edit_triage').show();
			$("#reg_triage").attr('disabled', false);	
						
			$('#agregar_triage').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});
			return false;
		 }
	 });
}

function consultarAtencionTriage(agenda_id, colaborador_id, servicio_id, exepediente, pacientes_id){	
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/consultarAtencionTriage.php';
	var atencion;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id+'&expediente='+exepediente+'&pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          atencion = data;			  		  		  			  
		}
	});
	return atencion;		
}

function modal_agregar_confirmacionAusencia(agenda_id, colaborador_id, servicio_id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/editConfirmacionAusencias.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'agenda_id='+agenda_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id,
		success: function(valores){
			var datos = eval(valores);
			cleanConfirmacion();
			$('#formulario_agregar_confirmacion_ausencias')[0].reset();
            $('#formulario_agregar_confirmacion_ausencias #pro_confirmacion').val("Registo");
			$('#formulario_agregar_confirmacion_ausencias #agenda_id_confirmacion').val(datos[0]);
			$('#formulario_agregar_confirmacion_ausencias #colaborador_id_confirmacion').val(datos[1]);
			$('#formulario_agregar_confirmacion_ausencias #servicio_id_confirmacion').val(datos[2]);
			$('#formulario_agregar_confirmacion_ausencias #fecha_confirmacion').val(datos[3]);
            $('#formulario_agregar_confirmacion_ausencias #expediente_confirmacion').val(datos[4]);
            $('#formulario_agregar_confirmacion_ausencias #nombre_confirmacion').val(datos[5]);			
            $('#formulario_agregar_confirmacion_ausencias #identidad_confirmacion').val(datos[6]);
			$('#formulario_agregar_confirmacion_ausencias #correo_confirmacion').val(datos[7]);
			$('#formulario_agregar_confirmacion_ausencias #telefono_confirmacion').val(datos[8]);
			$('#formulario_agregar_confirmacion_ausencias #observacion_confirmacion').val(datos[9]);
            $('#formulario_agregar_confirmacion_ausencias #reg_confirmacion').show();
			$('#formulario_agregar_confirmacion_ausencias #edit_confirmacion').hide();
			
            if(datos[10] == 1){
			    $('#formulario_agregar_confirmacion_ausencias #si_respuesta_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX
			    $('#formulario_agregar_confirmacion_ausencias #no_respuesta_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
                $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion').show();
		        $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion1').hide();				
				getConfirmacion_si();
				$('#formulario_agregar_confirmacion_ausencias #confirmo_si').val(datos[11]);
			}else{
			    $('#formulario_agregar_confirmacion_ausencias #si_respuesta_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
			    $('#formulario_agregar_confirmacion_ausencias #no_respuesta_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX		
                $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion').hide();
		        $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion1').show();					
				getConfirmacion_no();
				$('#formulario_agregar_confirmacion_ausencias #confirmo_no').val(datos[11]);
			}
	
	        $('#agregar_confirmacion_ausencias').modal({
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
//FIN MODAL CONFIRMACIÓN 

function getConfirmacion_si(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getConfirmacion_rr_si.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_confirmacion #confirmo_si').html("");
			$('#formulario_agregar_confirmacion #confirmo_si').html(data);
			$('#formulario_agregar_confirmacion #confirmo_no').html("");
			
		    $('#formulario_agregar_confirmacion_ausencias #confirmo_si').html("");
			$('#formulario_agregar_confirmacion_ausencias #confirmo_si').html(data);	
			$('#formulario_agregar_confirmacion_ausencias #confirmo_no').html("");				
		}			
     });		
}

function getConfirmacion_no(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getConfirmacion_rr_no.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		
		    $('#formulario_agregar_confirmacion #confirmo_no').html("");
			$('#formulario_agregar_confirmacion #confirmo_no').html(data);
			$('#formulario_agregar_confirmacion #confirmo_si').html("");
			
		    $('#formulario_agregar_confirmacion_ausencias #confirmo_no').html("");
			$('#formulario_agregar_confirmacion_ausencias #confirmo_no').html(data);	
			$('#formulario_agregar_confirmacion_ausencias #confirmo_si').html("");			
		}			
     });		
}

//RESPUESTA A LA CONFIRMACIÓN DEL USUARIO RESPUESTA ENVIADA
//****************************************************************************************************************************
//SI
$(document).ready(function() {
	$('#formulario_agregar_confirmacion #si_respuesta_confirmacion').on('click', function(){
         $('#formulario_agregar_confirmacion #grupo_confirmacion').show();
		 $('#formulario_agregar_confirmacion #grupo_confirmacion1').hide();
         getConfirmacion_si();				 
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_confirmacion_ausencias #si_respuesta_confirmacion').on('click', function(){
         $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion').show();
		 $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion1').hide();
         getConfirmacion_si();				 
    });					
});

//NO
$(document).ready(function() {
	$('#formulario_agregar_confirmacion #no_respuesta_confirmacion').on('click', function(){
         $('#formulario_agregar_confirmacion #grupo_confirmacion').hide();
		 $('#formulario_agregar_confirmacion #grupo_confirmacion1').show();
         getConfirmacion_no();			 
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_confirmacion_ausencias #no_respuesta_confirmacion').on('click', function(){
         $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion').hide();
		 $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion1').show();
         getConfirmacion_no();			 
    });					
});
//****************************************************************************************************************************

function cleanConfirmacion(){
	$('#formulario_agregar_confirmacion #correo_confirmacion').val("");
	$('#formulario_agregar_confirmacion #telefono_confirmacion').val("");
	$('#formulario_agregar_confirmacion #observacion_confirmacion').val("");
	
	$('#formulario_agregar_confirmacion_ausencias #correo_confirmacion').val("");
	$('#formulario_agregar_confirmacion_ausencias #telefono_confirmacion').val("");
	$('#formulario_agregar_confirmacion_ausencias #observacion_confirmacion').val("");	
}

//INICIO ACCIONES FORMULARIO CONFIRMACION
$('#reg_confirmacion').on('click', function(e){	
    if($('#formulario_agregar_confirmacion #observacion_confirmacion').val() != "" && $('#formulario_agregar_confirmacion #expediente_confirmacion').val() != "" && ($('#formulario_agregar_confirmacion #si_respuesta_confirmacion').val() != "" || $('#formulario_agregar_confirmacion #no_respuesta_confirmacion').val() != "") ){
		e.preventDefault();
		
		if($('#formulario_agregar_confirmacion #confirmo_si').val() != "" || $('#formulario_agregar_confirmacion #confirmo_no').val() != ""){
			agregaRespuestaConfirmacion();	
			return false;
		}else{
			swal({
				title: "Error", 
				text: "No seleccionó ningún valor en el area de confirmación",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		    return false;
		}
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
//FIN ACCIONES FORMULARIO CONFIRMACION

$('#edit_confirmacion').on('click', function(e){	
    if($('#formulario_agregar_confirmacion #observacion_confirmacion').val() != "" && $('#formulario_agregar_confirmacion #expediente_confirmacion').val() != "" && ($('#formulario_agregar_confirmacion #si_respuesta_confirmacion').val() != "" || $('#formulario_agregar_confirmacion #no_respuesta_confirmacion').val() != "") ){
		e.preventDefault();
					
		if($('#formulario_agregar_confirmacion #confirmo_si').val() != "" || $('#formulario_agregar_confirmacion #confirmo_no').val() != ""){
			editarRespuestaConfirmacion();	
			return false;
		}else{
			swal({
				title: "Error", 
				text: "No seleccionó ningún valor en el area de confirmación",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		    return false;
		}
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
//INICIO ACCIONES FORMULARIO CONFIRMACION

//INICIO ACCIONES FORMULARIO CONFIRMACION AUSENCIAS
$('#formulario_agregar_confirmacion_ausencias #reg_confirmacion').on('click', function(e){	
    if($('#formulario_agregar_confirmacion_ausencias #observacion_confirmacion').val() != "" && $('#formulario_agregar_confirmacion_ausencias #expediente_confirmacion').val() != "" && ($('#formulario_agregar_confirmacion_ausencias #si_respuesta_confirmacion').val() != "" || $('#formulario_agregar_confirmacion_ausencias #no_respuesta_confirmacion').val() != "") ){
		e.preventDefault();
		
		if($('#formulario_agregar_confirmacion_ausencias #confirmo_si').val() != "" || $('#formulario_agregar_confirmacion_ausencias #confirmo_no').val() != ""){
			agregaRespuestaConfirmacionAusencias();	
			return false;
		}else{
			swal({
				title: "Error", 
				text: "No seleccionó ningún valor en el area de confirmación",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		    return false;
		}
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

$('#formulario_agregar_confirmacion_ausencias #edit_confirmacion').on('click', function(e){	
    if($('#formulario_agregar_confirmacion_ausencias #observacion_confirmacion').val() != "" && $('#formulario_agregar_confirmacion_ausencias #expediente_confirmacion').val() != "" && ($('#formulario_agregar_confirmacion_ausencias #si_respuesta_confirmacion').val() != "" || $('#formulario_agregar_confirmacion_ausencias #no_respuesta_confirmacion').val() != "") ){
		e.preventDefault();
					
		if($('#formulario_agregar_confirmacion_ausencias #confirmo_si').val() != "" || $('#formulario_agregar_confirmacion_ausencias #confirmo_no').val() != ""){
			editarRespuestaConfirmacionaUusencias();	
			return false;
		}else{
			swal({
				title: "Error", 
				text: "No seleccionó ningún valor en el area de confirmación",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		    return false;
		}
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
//INICIO ACCIONES FORMULARIO CONFIRMACION AUSENCIAS

//INICIO AGREGAR CONFIRMACION
function agregaRespuestaConfirmacion(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/agregarConfirmacion.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_confirmacion').serialize(),
		success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_confirmacion #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});		
			    $('#formulario_agregar_confirmacion #pro_info_respuesta').val('Registro');
			    $('#formulario_agregar_confirmacion #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #editar_no_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #editar_si_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #actualizar_datos_no').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #actualizar_datos_si').prop('checked', false); //DESELECCIONA UN CHECK BOX				   
                getConfirmacion_no();			   
			    $('#formulario_agregar_confirmacion #grupo_confirmacion').hide();
			    $('#formulario_agregar_confirmacion #grupo_confirmacion1').show();
                cleanConfirmacion();
			    pagination(1);
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
			   return false;
			}else if(registro == 4){	
				swal({
					title: "Error", 
					text: "Error al intentar almacenar el registro, hay campos vacíos",
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
//FIN AGREGAR CONFIRMACION

//INICIO AGREGAR CONFIRMACION AUSENCIAS
function agregaRespuestaConfirmacionAusencias(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/agregarConfirmacionAusencias.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_confirmacion_ausencias').serialize(),
		success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_confirmacion_ausencias #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			    $('#formulario_agregar_confirmacion_ausencias #pro_info_respuesta').val('Registro');
			    $('#formulario_agregar_confirmacion_ausencias #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #editar_no_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #editar_si_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #actualizar_datos_no').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #actualizar_datos_si').prop('checked', false); //DESELECCIONA UN CHECK BOX				   
                getConfirmacion_no();			   
			    $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion').hide();
			    $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion1').show();
                cleanConfirmacion();
			    pagination(1);
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
				return false;
			}else if(registro == 4){	
				swal({
					title: "Error", 
					text: "Error al intentar almacenar el registro, hay campos vacíos",
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
//FIN AGREGAR CONFIRMACION AUSENCIAS

//EDITAR GUARDAR OPICONES
//****************************************************************************************************************************
//SI
$(document).ready(function() {
	$('#formulario_agregar_confirmacion #editar_si_confirmacion').on('click', function(){
         $('#reg_confirmacion').hide();
		 $('#edit_confirmacion').show();			 
    });					
});

//NO
$(document).ready(function() {
	$('#formulario_agregar_confirmacion #editar_no_confirmacion').on('click', function(){
         $('#reg_confirmacion').show();
		 $('#edit_confirmacion').hide();		 
    });					
});
//****************************************************************************************************************************

//INICIO EDITAR RESPUESTA CONFIRMACION
function editarRespuestaConfirmacion(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/modificarConfirmacion.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_confirmacion').serialize(),
		success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_confirmacion #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Edición completada correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    $('#formulario_agregar_confirmacion #pro_info_respuesta').val('Registro');
			    $('#formulario_agregar_confirmacion #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #editar_no_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #editar_si_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
			    $('#formulario_agregar_confirmacion #actualizar_datos_si').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion #actualizar_datos_no').prop('checked', false); //DESELECCIONA UN CHECK BOX			   
			    $('#formulario_agregar_confirmacion #grupo_confirmacion').hide();
			    $('#formulario_agregar_confirmacion #grupo_confirmacion1').show();
                $('#reg_confirmacion').show();
			    $('#edit_confirmacion').hide();			   
			    pagination(1);
			    return false;
			}else if(registro == 2){	
				swal({
					title: "Error", 
					text: "Error al editar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Este registro no se puede editar, debido a que no hay datos almacenados",
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
//FIN EDITAR RESPUESTA CONFIRMACION

//INICIO EDITAR RESPUESTA CONFIRMACION AUSENCIAS
function editarRespuestaConfirmacionaUusencias(){
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/modificarConfirmacionAusencias.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_agregar_confirmacion').serialize(),
		success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_confirmacion_ausencias #pro_info_respuesta').val('Registro');
				swal({
					title: "Success", 
					text: "Registro editado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			    $('#formulario_agregar_confirmacion_ausencias #pro_info_respuesta').val('Registro');
			    $('#formulario_agregar_confirmacion_ausencias #no_info_respuesta').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #si_info_respuesta').prop('checked', false); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #editar_no_confirmacion').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #editar_si_confirmacion').prop('checked', false); //DESELECCIONA UN CHECK BOX
			    $('#formulario_agregar_confirmacion_ausencias #actualizar_datos_si').prop('checked', true); //DESELECCIONA UN CHECK BOX	
			    $('#formulario_agregar_confirmacion_ausencias #actualizar_datos_no').prop('checked', false); //DESELECCIONA UN CHECK BOX			   
			    $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion').hide();
			    $('#formulario_agregar_confirmacion_ausencias #grupo_confirmacion1').show();
                $('#formulario_agregar_confirmacion_ausencias #reg_confirmacion').show();
			    $('#formulario_agregar_confirmacion_ausencias #edit_confirmacion').hide();			   
			    pagination(1);
			    return false;
			}else if(registro == 2){	
				swal({
					title: "Error", 
					text: "Error al editar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;
			}else if(registro == 3){	
				swal({
					title: "Error", 
					text: "Este registro no se puede editar, debido a que no hay datos almacenados",
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
//FIN EDITAR RESPUESTA CONFIRMACION AUSENCIAS

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

function consultarFecha(fecha){	
    var url = '<?php echo SERVERURL; ?>php/citas/consultarFecha.php';
	var fecha;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'fecha='+fecha,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;		
}

function consultaTipoUsuario(pacientes_id, colaborador_id, servicio_id, expediente){	
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getTipoUsuario.php';
	var tipo;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id+'&colaborador_id='+colaborador_id+'&servicio_id='+servicio_id+'&expediente='+expediente,
		async: false,
		success:function(data){	
          tipo = data;			  		  		  			  
		}
	});
	return tipo;		
}

function getAtencionTriage(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getAtencionTriage.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_triage #atencion_triage').html("");
			$('#formulario_triage #atencion_triage').html(data);				
		}			
     });		
}

function getObservacionTriage(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getObservacionTriage.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_triage #observacion_triage').html("");
			$('#formulario_triage #observacion_triage').html(data);					
		}			
     });		
}

function getInformacionTriage(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getInformacionTriage.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_triage #informacion_triage').html("");
			$('#formulario_triage #informacion_triage').html(data);
		}			
     });		
}

function getTipoAtencionTriage(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getTipoAtencionTriage.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_triage #tipo_triage').html("");
			$('#formulario_triage #tipo_triage').html(data);					
		}			
     });		
}	

function getReporteTriage(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getReporteTriage.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_triage_reporte #reporte_triage').html("");
			$('#formulario_triage_reporte #reporte_triage').html(data);				
		}			
     });		
}

function cleanReporteTriage(){
	getReporteTriage();
	getServicio();
}

$(document).ready(function() {
	$('#formulario_triage #observacion_triage').on('change', function(){
	    var valor = $('#formulario_triage #observacion_triage').val();
		
		if(valor == 1 || valor == 2){
			$('#formulario_triage #si_asistira_triage').prop('checked', false); 
			$('#formulario_triage #no_asistira_triage').prop('checked', true);
		}else{
			$('#formulario_triage #si_asistira_triage').prop('checked', true); 
			$('#formulario_triage #no_asistira_triage').prop('checked', false);			
		}
    });					
});	

function cleanTriage(){
	getAtencionTriage();
	getObservacionTriage();
	getInformacionTriage();
	getTipoAtencionTriage();
	$('#formulario_triage #comentario_triage').val('');
}

$('#form_agenda_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});

$('#formulario #buscar_estado_reprogramacion').on('click', function(e){
	listar_estado_reprogramacion_buscar();
	 $('#modal_busqueda_estado_reprogramacion').modal({
		show:true,
		keyboard: false,
		backdrop:'static'
	});	 
});

var listar_estado_reprogramacion_buscar = function(){
	var table_estado_reprogramacion_buscar = $("#dataTableEstadoReprogramacion").DataTable({		
		"destroy":true,	
		"ajax":{
			"method":"POST",
			"url":"<?php echo SERVERURL; ?>php/agenda_pacientes/getEstadoReprogramacionTable.php"
		},
		"columns":[
			{"defaultContent":"<button class='view btn btn-primary'><span class='fas fa-copy'></span></button>"},
			{"data":"descripcion"}		
		],
		"pageLength" : 5,
        "lengthMenu": lengthMenu,
		"stateSave": true,
		"bDestroy": true,
		"language": idioma_español,	
	});	 
	table_estado_reprogramacion_buscar.search('').draw();
	$('#buscar').focus();
	
	view_estado_reprogramacion_busqueda_dataTable("#dataTableEstadoReprogramacion tbody", table_estado_reprogramacion_buscar);
}

var view_estado_reprogramacion_busqueda_dataTable = function(tbody, table){
	$(tbody).off("click", "button.view");		
	$(tbody).on("click", "button.view", function(e){
		e.preventDefault();
		var data = table.row( $(this).parents("tr") ).data();		  
		$('#formulario #status_repro').val(data.status_id);
		$('#modal_busqueda_estado_reprogramacion').modal('hide');
	});
}

$('#formulario_agregar_confirmacion #observacion_confirmacion').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formulario_agregar_confirmacion #charNum_agenda_observacion').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresObservacionAgendaConfirmacion(){
	var max_chars = 250;
	var chars = $('#formulario_agregar_confirmacion #observacion_confirmacion').val().length;
	var diff = max_chars - chars;
	
	$('#formulario_agregar_confirmacion #charNum_agenda_observacion').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#formulario #observacion').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formulario #charNum_cita_observacion').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresObservacionAgendaCitas(){
	var max_chars = 250;
	var chars = $('#formulario #observacion').val().length;
	var diff = max_chars - chars;
	
	$('#formulario #charNum_cita_observacion').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}

$('#formulario #comentario').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formulario #charNum_cita_comentarion').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresComentarioAgendaCitas(){
	var max_chars = 250;
	var chars = $('#formulario #comentario').val().length;
	var diff = max_chars - chars;
	
	$('#formulario #charNum_cita_comentarion').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}



$('#formulario_triage #comentario_triage').keyup(function() {
	var max_chars = 250;
	var chars = $(this).val().length;
	var diff = max_chars - chars;
	
	$('#formulario_triage #charNum_triage').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
});

function caracteresComentarioAgendaTriage(){
	var max_chars = 250;
	var chars = $('#formulario_triage #comentario_triage').val().length;
	var diff = max_chars - chars;
	
	$('#formulario_triage #charNum_triage').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}
</script>