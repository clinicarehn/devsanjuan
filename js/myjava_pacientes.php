<script>
/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_expediente_manual").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_expediente_manual #expediente_usuario_manual').focus();
		$("#formulario_agregar_expediente_manual #sexo_manual").css("pointer-events","none");
		formulario_agregar_expediente_manual
    });
});

$(document).ready(function(){
    $("#agregar_expediente_manual").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_expediente_manual #expediente_usuario_manual').focus();
    });
});

$(document).ready(function(){
    $("#registrar").on('shown.bs.modal', function(){
        $(this).find('#formulario #lastname').focus();
    });
});

$(document).ready(function(){
    $("#registrar_profesionales").on('shown.bs.modal', function(){
        $(this).find('#formulario_profesionales #profesionales_buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_busqueda_departamentos").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_departamentos #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_busqueda_municipios").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_municipios #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_busqueda_religion").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_religion #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_busqueda_pacientes").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_pacientes #buscar').focus();
    });
});

$(document).ready(function(){
    $("#modal_busqueda_profesion").on('shown.bs.modal', function(){
        $(this).find('#formulario_busqueda_profesion #buscar').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$(document).ready(pagination(1));
  $(function(){
	  $('#nuevo-registro').on('click',function(){
		  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		  $('#formulario')[0].reset();
		  valores();
		  $('#fecha_re').attr('readonly', false);
		  $("#formulario #label_expediente").hide();
		  $('#formulario #grupo_nombre_usuario').hide();
		  $("#formulario #expediente").hide();
		  $("#formulario #label_edad").hide();
		  $("#formulario #edad").hide();
		  $('#tipo').val('1').change(); 
		  $('#formulario #tipo').selectpicker('refresh');
	      $('#formulario #validate').html('');		  
		  $('#formulario #mensaje').html("");		  
		  $('#reg').show();
		  $('#formulario #identidad').attr('readonly', false);
		  $('#formulario .nav-tabs li:eq(0) a').tab('show');	
     	  $('#formulario #pro').val('Registro');
		  $('#edi').hide();
		  $('#reg').show();
		  $('#registrar').modal({
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
					allowEscapeKey : false,
					allowOutsideClick: false
			  });			   
	          return false;	  
           }  
	 });
	 
	 $('#form_main #profesion').on('click',function(){
		 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		    $('#formulario_profesionales')[0].reset();	
			paginationPorfesionales(1);		  			
		    $('#registrar_profesionales').modal({
			    show:true,
				keyboard: false,
			    backdrop:'static'
		    });
			return false;
		}else{
			  swal({
					title: 'Acceso Denegado', 
					text: 'No tiene permisos para ejecutar esta acción',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
			  });			
	        return false;	  
          }
	   });		 
	
	$('#form_main #bs-regis').on('keyup',function(){
		pagination(1);
   	    return false;
    });	
	
	$('#formulario_profesionales #profesionales_buscar').on('keyup',function(){
		paginationPorfesionales(1);
   	    return false;
    });	

	$('#formulario_agregar_expediente_manual #identidad_ususario_manual').on('keyup',function(){
		busquedaUsuarioManualIdentidad();
   	    return false;
    });	

	$('#formulario_agregar_expediente_manual #expediente_usuario_manual').on('keyup',function(){
		busquedaUsuarioManualExpediente();
   	    return false;
    });		
});

$(document).ready(function(){
    valores(); 
});

function valores(){
    getStatus();
	getDepartamento();
	getEstadoCivil(); 
	getRaza(); 
	getReligion(); 
	getProfesion(); 
	getPais(); 
	getEscolaridad(); 
	getSexo(); 
	getTipo();  
	getTipoPacientes();
}

$('#reg_profesionales').on('click', function(e){
	 e.preventDefault();
	 agregarProfesional();  
});

//AGREGAR REGISTROS
$('#reg').on('click', function(e){
	e.preventDefault();
   if ($('#formulario #telefono1').val()!="" && $('#formulario #departamento').val()!="" && $('#formulario #municipio').val()!="" && $('#formulario #localidad').val()!="" && $('#formulario #pais').val()!="" && $('#formulario #estado_civil').val()!="" && $('#formulario #raza').val()!="" && $('#formulario #religion').val()!="" && $('#formulario #profesion').val()!="" && $('#formulario #escolaridad').val()!="" && $('#formulario #lugar_nacimiento').val()!="" && $('#formulario #responsable').val()!="" && $('#formulario #parentesco').val()!="" && $('#formulario #sexo').val()!=""){		 
	  agregaRegistro();	   
   }else{
	  swal({
			title: 'Error', 
			text: 'Se han encontrado registros en blanco por favor corregir, verifique los registros que tienen un asterisco en color rojo, no deben quedar vacíos',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
	  });
	  return false;
   }	   
});

$('#convertir_manual').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	     convertirExpedientetoTemporal(); 
	 }else{
		swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
			
		});
		return false;
	}
});

$('#reg_manual').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	     registrarExpedienteManual(); 
	 }else{
		swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
		});
		return false;		  
	}
	
});

//EDITAR REGISTROS
$('#edi').on('click', function(e){ // delete event clicked // We don't want this to act as a link so cancel the link action
if ($('#formulario #telefono1').val()!="" && $('#formulario #departamento').val()!="" && $('#formulario #municipio').val()!="" && $('#formulario #localidad').val()!="" && $('#formulario #pais').val()!="" && $('#formulario #estado_civil').val()!="" && $('#formulario #raza').val()!="" && $('#formulario #religion').val()!="" && $('#formulario #profesion').val()!="" && $('#formulario #escolaridad').val()!="" && $('#formulario #lugar_nacimiento').val()!="" && $('#formulario #responsable').val()!="" && $('#formulario #parentesco').val()!="" && $('#formulario #sexo').val()!=""){
    e.preventDefault();		 
	agregaRegistroEdicion(); 
  }else{
		swal({
			title: 'Error', 
			text: 'Se han encontrado registros en blanco por favor corregir, verifique los registros que tienen un asterisco en color rojo, no deben quedar vacíos',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
		});			
		$('#formulario .nav-tabs li:eq(0) a').tab('show');	
        return false;		
  }
});

function clean(){
	getDepartamento();
	getEstadoCivil(); 
	getRaza(); 
	getReligion(); 
	getProfesion(); 
	getPais();
	getEscolaridad();
	getSexo();
	getTipo();
	getTipoPacientes();
    $('#formulario #municipio').html("");
}

function agregaRegistro(){	
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var hoy = new Date();
    fecha_actual = convertDate(hoy);
	var url = '<?php echo SERVERURL; ?>php/pacientes/agregar.php';
	
	if ($('#formulario #fecha').val() == fecha_actual || $('#formulario #fecha').val() > fecha_actual){
			swal({
				title: 'Error', 
				text: 'Debe seleccionar una fecha de nacimiento válida',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey : false,
				allowOutsideClick: false
			});
			return false;
	}else{
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario').serialize(),
		  success: function(registro){
			if(registro == 1){
			    $('#formulario')[0].reset();
  			    $('#formulario #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false					
				});	
			    pagination(1);
				clean();
				$('#formulario .nav-tabs li:eq(0) a').tab('show');					
			    return false;					
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "No se pudo almacenar el registro, ya existe en la base de datos",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});		
				$('#formulario .nav-tabs li:eq(0) a').tab('show');	
                return false;				
			}else if(registro == 3){
				swal({
					title: 'Error', 
					text: 'Existen campos vacíos no se puedo completar el registro',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});		
				$('#formulario .nav-tabs li:eq(0) a').tab('show');	
                return false;				
			}else if(registro == 4){
				swal({
					title: 'Error', 
					text: 'Este número de Identidad ya existe, por favor corregir',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});		
				$('#formulario .nav-tabs li:eq(0) a').tab('show');	
                return false;				
			}else if(registro == 5){
				swal({
					title: 'Error', 
					text: 'Edad no permitida por favor corregir, la edad debe ser mayor o igual a 4 años y menor o igual que 120 años, por favor corregir',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});			
				$('#formulario .nav-tabs li:eq(0) a').tab('show');	
                return false;				
			}else{
				swal({
					title: 'Error', 
					text: 'Error al procesar su solicitud, por favor intentelo de nuevo',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});			
				$('#formulario .nav-tabs li:eq(0) a').tab('show');					
			}
		  }
	   });
	  return false;		
	}
 }else{
	swal({
		title: 'Acceso Denegado', 
		text: 'No tiene permisos para ejecutar esta acción',
		type: 'error', 
		confirmButtonClass: 'btn-danger',
		allowEscapeKey : false,
		allowOutsideClick: false
	});		 			
	return false;	  
  }	
}

function agregaRegistroEdicion(){	
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var hoy = new Date();
    fecha_actual = convertDate(hoy);
	var url = '<?php echo SERVERURL; ?>php/pacientes/agregar_edicion.php';
	
	if ($('#formulario #fecha').val() == fecha_actual || $('#formulario #fecha').val() > fecha_actual){
		swal({
			title: 'Error', 
			text: 'Debe seleccionar una fecha de nacimiento válida',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
		});			
		return false;
	}else{
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario').serialize(),
		  success: function(registro){
			if (registro == 1){
  			    $('#formulario #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro editado correctamente',
					type: 'success', 
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
			    pagination(1);
                return false;
			 }else if (registro == 2){
				swal({
					title: 'Error', 
					text: 'No se pudo almacenar el registro, ya existe en la base de datos',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                return false;				
			 }else if (registro == 3){
				swal({
					title: 'Error', 
					text: 'Existen campos vacíos no se puedo completar el registro',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                return false;				
			 }else if (registro == 4){
				swal({
					title: 'Error', 
					text: 'Edad no permitida por favor corregir, la edad debe ser mayor o igual a 4 años y menor o igual que 100 años, por favor corregir',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                return false;				
			 }else{
				swal({
					title: 'Error', 
					text: 'Error al procesar su solicitud, por favor intentelo de nuevo',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
                return false;				
			 }			 
		  }
	   });
	  return false;		
	}
 }else{
	swal({
		title: 'Acceso Denegado', 
		text: 'No tiene permisos para ejecutar esta acción',
		type: 'error', 
		confirmButtonClass: 'btn-danger',
		allowEscapeKey : false,
		allowOutsideClick: false
	});				
	return false;	  
  }	
}

function agregarProfesional(){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	

	var url = '<?php echo SERVERURL; ?>php/pacientes/agregar_profesional.php';
	
	$.ajax({
	    type:'POST',
	    url:url,
		data:$('#formulario_profesionales').serialize(),
		success: function(registro){
		   if(registro==1){
				swal({
					title: 'Success', 
					text: 'Registro almacenado correctamente',
					type: 'success',
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
			    paginationPorfesionales(1);
				return false;
		   }else if(registro==2){
				swal({
					title: 'Error', 
					text: 'No se pudo guardar el registro, por favor verifique la información',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }else if(registro==3){
				swal({
					title: 'Error', 
					text: 'Existen campos vacíos no se puede procesar su solicitud. Intentelo de nuevo',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }else if(registro==4){
				swal({
					title: 'Error', 
					text: 'Este registro ya existe, por favor corrigalo, e intente de nuevo',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
			    return false;
		   }else{
				swal({
					title: 'Error', 
					text: 'Error al procesar su solicitud. Intentelo de nuevo más tarde',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
			    return false;
		   }
		 }
	});
	return false;		
  }else{
	swal({
		title: 'Acceso Denegado', 
		text: 'No tiene permisos para ejecutar esta acción',
		type: 'error', 
		confirmButtonClass: 'btn-danger',
		allowEscapeKey : false,
		allowOutsideClick: false
	});			
	return false;	  
  }		
}

function eliminarProfesinal(id){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	

	var url = '<?php echo SERVERURL; ?>php/pacientes/eliminar_profesional.php';
	
	$.ajax({
	    type:'POST',
	    url:url,
		data:'id='+id,
		success: function(registro){
		   if(registro==1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success",
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
			    paginationPorfesionales(1);
				return false;
		   }else if (registro==2){
				swal({
					title: "Error", 
					text: "No se puede eliminar el registro, por favor verifique la información",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }else if (registro==3){
				swal({
					title: 'Error', 
					text: 'No se puede eliminar el registro, se han almacenado registros en los usuarios',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }else{
				swal({
					title: 'Error', 
					text: 'Error al completar su solicitud',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }
		 }
	});
	return false;		
  }else{
	swal({
		title: "Acceso Denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey : false,
		allowOutsideClick: false
	});			
	return false;	  
  }		
}

function modal_eliminar(id){
  if (consultarExpediente(id) != 0 && (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16)){
    var nombre_usuario = consultarNombre(id);
    var expediente_usuario = consultarExpediente(id);
    var dato;

    if(expediente_usuario == 0){
		dato = nombre_usuario;
	}else{
		dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
	}
	
	swal({
		title: "¿Estas seguro?",
		text: "¿Desea eliminar este registro: " + dato + "?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-warning",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Sí, eliminar el registro!",
		closeOnConfirm: false,
		allowEscapeKey : false,
		allowOutsideClick: false
	},
	function(){
		eliminarRegistro(id);
	});
  }else if (consultarExpediente(id) == 0 && (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16)){
    var nombre_usuario = consultarNombre(id);
    var expediente_usuario = consultarExpediente(id);
    var dato;

    if(expediente_usuario == 0){
		dato = nombre_usuario;
	}else{
		dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
	}
	
	swal({
		title: "¿Estas seguro?",
		text: "¿Desea eliminar este registro: " + dato + "?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-warning",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Sí, eliminar el registro!",
		closeOnConfirm: false,
		allowEscapeKey : false,
		allowOutsideClick: false
	},
	function(){
		eliminarRegistro(id);
	});
  }else{
	  swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
	  });				
	 return false;	  
  }
}

//SÍ
$(document).ready(function() {
	$('#formulario_agregar_expediente_manual #respuestasi').on('click', function(){
        $("#convertir_manual").show();
		$("#reg_manual").hide();
    });					
});

//NO
$(document).ready(function() {
	$('#formulario_agregar_expediente_manual #respuestano').on('click', function(){
		$("#convertir_manual").hide();
		$("#reg_manual").show();		
    });					
});

function registrarExpedienteManual(){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/pacientes/agregarExpedienteManual.php';
	
	$.ajax({
	    type:'POST',
	    url:url,
		data:$('#formulario_agregar_expediente_manual').serialize(),
		success: function(registro){
		   if(registro==1){
				$('#formulario_agregar_expediente_manual')[0].reset();
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
				pagination(1);
				return false;
		   }else if(registro==2){
				swal({
					title: "Error", 
					text: "No se pudo guardar el registro, por favor verifique la información",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }else if(registro==3){
				swal({
					title: 'Error', 
					text: 'Error al ejecutar esta acción',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
			    return false;			   
		   }else{
				swal({
					title: 'Error', 
					text: 'Error al guardar el registro',
					type: 'error', 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
				return false;
		   }
		}
	   });
	  return false;		
  }else{
	  swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
	  });			
	 return false;	  
  }		
}

function modal_agregar_expediente_manual(id, expediente){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	  if(consultarDepartamento(id) != 0 && consultarMunicipio(id) != 0 && consultarPais(id) != 0 && consultarEstadoCivil(id) != 0 && consultarRaza(id) != 0 && consultarReligion(id) != 0 && consultarProfesion(id) != 0 && consultarEscolaridad(id) != 0 && consultarLugarNacimiento(id) != 0 && consultarParentesco(id) != 0 && consultarResponsable(id) != 0){
	      $('#formulario_agregar_expediente_manual')[0].reset();
	      var url = '<?php echo SERVERURL; ?>php/pacientes/buscarUsuario.php';
		    $.ajax({
		    type:'POST',
		    url:url,
		    data:'id='+id,
		    success: function(valores){
				var datos = eval(valores);
                $("#convertir_manual").hide();
		        $("#reg_manual").show();
		
				if(expediente == 0){
					$("#formulario_agregar_expediente_manual #temporal").hide();
				}else{
					$("#formulario_agregar_expediente_manual #temporal").show();						
				}
				$("#formulario_agregar_expediente_manual #id-registro").val(id);
				$("#formulario_agregar_expediente_manual #expediente").val(expediente);
				$("#formulario_agregar_expediente_manual #name_manual").val(datos[0]);
			    $("#formulario_agregar_expediente_manual #identidad_manual").val(datos[1]);
			    $('#formulario_agregar_expediente_manual #sexo_manual').val(datos[2]);
				$("#formulario_agregar_expediente_manual #fecha_manual").val(datos[3]);
			    $("#formulario_agregar_expediente_manual #edad_manual").val(datos[6]);
				$("#formulario_agregar_expediente_manual #expediente_manual").val(datos[5]);
				$("#formulario_agregar_expediente_manual #edad_manual").show();
				$('#formulario_agregar_expediente_manual #pro').val('Registrar');				
				$('#agregar_expediente_manual').modal({
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
			text: "Por favor comuníquese con el departamento de Admisión para actualizarle los datos al usuario, antes de poder editar el Expediente o la Identidad",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
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
			allowEscapeKey : false,
			allowOutsideClick: false
	  });	
   }
 }

function modal_agregar_expediente(pacientes_id, expediente){
    var nombre_usuario = consultarNombre(pacientes_id);
    var expediente_usuario = consultarExpediente(pacientes_id);
    var dato;

    if(expediente_usuario == 0){
		dato = nombre_usuario;
	}else{
		dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
	}
	
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	  if(consultarDepartamento(pacientes_id) != 0 && consultarMunicipio(pacientes_id) != 0 && consultarPais(pacientes_id) != 0 && consultarEstadoCivil(pacientes_id) != 0 && consultarRaza(pacientes_id) != 0 && consultarReligion(pacientes_id) != 0 && consultarProfesion(pacientes_id) != 0 && consultarEscolaridad(pacientes_id) != 0 && consultarLugarNacimiento(pacientes_id) != 0 && consultarParentesco(pacientes_id) != 0 && consultarResponsable(pacientes_id) != 0){
	     if (expediente == "" || expediente == 0){	
				swal({
					title: "¿Esta seguro?",
					text: "Se asignara un número de expediente a este usuario: " + dato,
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-warning",
					confirmButtonText: "¡Sí, Asígnalo!",
					closeOnConfirm: false,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				},
				function(){					
					asignarExpedienteaRegistro(pacientes_id);
				});					 
	     }else{
			  swal({
					title: "Error", 
					text: "Este usuario: " + dato + " ya tiene un expediente asignado",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
			  });
	    }
	 }else{
			swal({
				title: "Error", 
				text: "Por favor, actualice los datos del usuario antes de continuar",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey : false,
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
			allowEscapeKey : false,
			allowOutsideClick: false
	  });					
	  return false;	  
    }
}

//CONSULTAR INFORMACION DEL USUARIO
function consultarDepartamento(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarDepartamento.php';
	var departamento;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          departamento = data;			  		  		  			  
		}
	});
	return departamento;	
}

function consultarMunicipio(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarMunicipio.php';
	var municipio;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          municipio = data;			  		  		  			  
		}
	});
	return municipio;	
}

function consultarPais(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarPais.php';
	var pais;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          pais = data;			  		  		  			  
		}
	});
	return pais;	
}

function consultarEstadoCivil(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarEstadoCivil.php';
	var estado_civil;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          estado_civil = data;			  		  		  			  
		}
	});
	return estado_civil;	
}

function consultarRaza(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarRaza.php';
	var raza;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          raza = data;			  		  		  			  
		}
	});
	return raza;	
}

function consultarReligion(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarReligion.php';
	var religion;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          religion = data;			  		  		  			  
		}
	});
	return religion;	
}

function consultarProfesion(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarProfesion.php';
	var profesion;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          profesion = data;			  		  		  			  
		}
	});
	return profesion;	
}

function consultarEscolaridad(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarEscolaridad.php';
	var escolaridad;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          escolaridad = data;			  		  		  			  
		}
	});
	return escolaridad;	
}

function consultarLugarNacimiento(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarLugarNacimiento.php';
	var lugar_nacimiento;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          lugar_nacimiento = data;			  		  		  			  
		}
	});
	return lugar_nacimiento;	
}

function consultarResponsable(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarResponsable.php';
	var responsable;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          responsable = data;			  		  		  			  
		}
	});
	return responsable;	
}

function consultarParentesco(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/consultarParentesco.php';
	var parentesco;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          parentesco = data;			  		  		  			  
		}
	});
	return parentesco;	
}
//FIN CONSULTAR INFORMACION DEL USUARIO

function showExpediente(id){
	var url = '<?php echo SERVERURL; ?>php/pacientes/getExpediente.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'pacientes_id='+id,
		success:function(data){
			if(data == 1){	
				swal({
					title: "Error", 
					text: "Por favor intentelo de nuevo más tarde",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});										
			}else{
  	           $('#mensaje_show').modal({
	             show:true,
				 keyboard: false,
	             backdrop:'static'  
     	       });	
               $('#mensaje_mensaje_show').html(data);
	           $('#bad').hide();
	           $('#okay').show();				
			}
		}
	});	
}

function modal_transferirUsuario(pacientes_id, expediente){
  var nombre_usuario = consultarNombre(pacientes_id);
  var expediente_usuario = consultarExpediente(pacientes_id);
  var dato;
  
  if(consultarDepartamento(pacientes_id) != 0 && consultarMunicipio(pacientes_id) != 0 && consultarPais(pacientes_id) != 0 && consultarEstadoCivil(pacientes_id) != 0 && consultarRaza(pacientes_id) != 0 && consultarReligion(pacientes_id) != 0 && consultarProfesion(pacientes_id) != 0 && consultarEscolaridad(pacientes_id) != 0 && consultarLugarNacimiento(pacientes_id) != 0 && consultarParentesco(pacientes_id) != 0 && consultarResponsable(pacientes_id) != 0){
     if(expediente_usuario == 0){
        dato = nombre_usuario;
     }else{
	    dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
     }
	   
     if (getUsuarioSistema() == 1 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
         var valor = "";
  	     var title = "";
	     var flag = false;
	
         if($('#estado').val() != 3){
             if($('#estado').val() == "" || $('#estado').val() == 1){
	            valor = 2;
	            title = "Pasivo";
                    if(expediente == 0 || expediente ==""){	
						swal({
							title: "Error", 
							text: "Este usuario: " + dato + ", es temporal no puede ser enviado a pasivo/activo",
							type: "error", 
							confirmButtonClass: "btn-danger",
							allowEscapeKey : false,
							allowOutsideClick: false
						});										
								
						flag = false;
						return false;
                    }else{
			            flag = true;
		            }		
	         }else{
                if(expediente == 0 || expediente ==""){	              
					swal({
						title: "Error", 
						text: "Este usuario: " + dato + ", es temporal no puede ser enviado a pasivo/activo",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey : false,
						allowOutsideClick: false
					});			
		            flag = false;
	                return false;
                }else{
			       flag = true;
		        }			
	            valor = 1;
	            title = "Activo";
	        }
        }else{
			swal({
				title: "Error", 
				text: "No se puede transferir este usuario: " + dato + " ya falleció",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey : false,
				allowOutsideClick: false
			});								
	        return false;	 
	    }
	
	    if (flag == true){
			swal({
				title: "¿Esta seguro?",
				text: "Se transferira este usuario: " + dato + ", a " + title + "",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "¡Sí, Deseo transferirlo!",
				closeOnConfirm: false,
				allowEscapeKey : false,
				allowOutsideClick: false
			},
			function(){					
				transferirExpedienteaRegistro(pacientes_id, title);
			}); 		
	    }
     }
     else{	
		  swal({
				title: 'Acceso Denegado', 
				text: 'No tiene permisos para ejecutar esta acción',
				type: 'error', 
				confirmButtonClass: 'btn-danger',
				allowEscapeKey : false,
				allowOutsideClick: false
		  });				
	     return false;	  
    }	   
  }else{
		swal({
			title: "Error", 
			text: "Por favor comuníquese con el departamento de Admisión para actualizarle los datos al usuario, antes de poder editar el Expediente o la Identidad",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});		  		
	  return false;	  
  }
}
	
function eliminarRegistro(id){	
	var url = '<?php echo SERVERURL; ?>php/pacientes/eliminar.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			if(registro == 1){
			   pagination(1)
				swal({
					title: "Success", 
					text: "Contraseña eliminado Correctamente",
					type: "success",
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});			   
			    return false;				
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "No se puede eliminar este registro ya que cuenta con información almacenada",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
	            return false;				
			}else{
				swal({
					title: "Error", 
					text: "Error al completar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});									
	            return false;				
			}
  		}
	}); 
	return false;
}

function asignarExpedienteaRegistro(pacientes_id){
	var url = '<?php echo SERVERURL; ?>php/pacientes/agregar_expediente.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		success: function(registro){
			showExpediente(pacientes_id);
			pagination(1);
			swal.close();			
			return false;
		}
	});
	return false;
}

function transferirExpedienteaRegistro(pacientes_id, estado){
	var url = '<?php echo SERVERURL; ?>php/pacientes/agregar_archivo.php';
		
	$.ajax({
		type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id+'&estado='+estado,
		success: function(registro){
			if(registro == 1){
				pagination(1);
				swal({
					title: "Success", 
					text: "Registro transferido correctamente",
					type: "success", 
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});				
		        return false;
			}else{
				swal({
					title: "Error", 
					text: "Error al transferir este registro",
					type: "error", 
					confirmButtonClass: 'btn-danger',
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});		
		        return false;				
			}
		}
	});
	return false;
}

function editarRegistro(id){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	if($('#estado').val() != 3){
	    var url = '<?php echo SERVERURL; ?>php/pacientes/editar.php';
		   $.ajax({
		   type:'POST',
		   url:url,
		   data:'id='+id,
		   success: function(valores){
				var datos = eval(valores);
			    $('#formulario .nav-tabs li:eq(0) a').tab('show');	
				$("#formulario #label_expediente").show();
				$("#formulario #expediente").show();
				$("#formulario #label_edad").show();
				$("#formulario #edad").show();
				$('#reg').hide();
				$('#edi').show();
				$('#formulario #pro').val('Edición');
				$('#formulario #id-registro').val(id);
				$('#formulario #name').val(datos[0]);				
				$('#formulario #lastname').val(datos[1]);
				$('#formulario #identidad').val(datos[2]);
				$('#formulario #sexo').val(datos[3]);
				$('#formulario #sexo').selectpicker('refresh');
				$('#formulario #fecha').val(datos[4]);
				$('#formulario #telefono1').val(datos[5]);
				$('#formulario #telefono2').val(datos[6]);
				$('#formulario #departamento').val(datos[7]);
				$('#formulario #departamento').selectpicker('refresh');	
				getMunicipioEditar(datos[7], datos[8]);
				$('#estado').selectpicker('refresh');					
				$('#formulario #localidad').val(datos[9]);
				$('#formulario #responsable').val(datos[10]);
				$('#formulario #parentesco').val(datos[11]);
				$('#formulario #telefonoresp').val(datos[12]);
				$('#formulario #telefonoresp1').val(datos[13]);			
                $('#formulario #fecha_re').val(datos[14]);
				$('#formulario #expediente').val(datos[15]);
				$('#formulario #edad').val(datos[16]);				
				$('#formulario #pais').val(datos[18]);
				$('#formulario #departamento').selectpicker('refresh');	
				$('#formulario #estado_civil').val(datos[19]);
				$('#formulario #estado_civil').selectpicker('refresh');	
				$('#formulario #raza').val(datos[20]);
				$('#formulario #raza').selectpicker('refresh');	
				$('#formulario #religion').val(datos[21]);
				$('#formulario #religion').selectpicker('refresh');	
				$('#formulario #profesion').val(datos[22]);
				$('#formulario #profesion').selectpicker('refresh');	
				$('#formulario #escolaridad').val(datos[25]);			
				$('#formulario #escolaridad').selectpicker('refresh');		
				$('#formulario #lugar_nacimiento').val(datos[23]);
				$('#formulario #correo').val(datos[24]);
				$('#formulario #grupo_nombre_usuario').show();
                $('#formulario #nombre_usuario').val(datos[26]);
                $('#formulario #tipo').val(datos[27]);	
				$('#formulario #tipo').selectpicker('refresh');			
				$('#formulario #identidad').attr('readonly', true);
				$('#formulario #fecha_re').attr('readonly', true);				
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
	var nombre_usuario = consultarNombre(id);
	var expediente_usuario = consultarExpediente(id);
	var dato;

	if(expediente_usuario == 0){
		dato = nombre_usuario;
	}else{
		dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
	}
			
	swal({
		title: "Error", 
		text: "No se puede realizar esta acción, el usuario: " + dato + " ya falleció, por favor comuníquese con el departamento de Archivo para más información",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey : false,
		allowOutsideClick: false
	});		
	return false;		  
  }
}else{
	swal({
		title: 'Acceso Denegado', 
		text: 'No tiene permisos para ejecutar esta acción',
		type: 'error', 
		confirmButtonClass: 'btn-danger',
		allowEscapeKey : false,
		allowOutsideClick: false
	});				 
}	
}

function reporteEXCEL(){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var estado = "";
	
	if ($('#estado').val() == ""){
		estado = 1;
	}else{
		estado = $('#estado').val();
	}
	
    var dato = $('#bs-regis').val();
	var url = '<?php echo SERVERURL; ?>php/pacientes/buscar_usuarios_excel.php?dato='+dato+'&estado='+estado;
    window.open(url);
}else{
	  swal({
			title: 'Acceso Denegado', 
			text: 'No tiene permisos para ejecutar esta acción',
			type: 'error', 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey : false,
			allowOutsideClick: false
	  });				
	  return false;	  
  }	
}

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/pacientes/paginar.php';
	var estado = "";
	var paciente = "";
	var dato = $('#form_main #bs-regis').val();
	
	if ($('#form_main #estado').val() == "" || $('#form_main #estado').val() == null){
		estado = 1;
	}else{
		estado = $('#form_main #estado').val();
	}
	
	if ($('#form_main #tipo').val() == "" || $('#form_main #tipo').val() == null){
		paciente = 1;
	}else{
		paciente = $('#form_main #tipo').val();
	}	
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&estado='+estado+'&dato='+dato+'&paciente='+paciente,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}


function paginationPorfesionales(partida){
	var url = '<?php echo SERVERURL; ?>php/pacientes/paginarProfesionales.php';
	var profesional = $('#formulario_profesionales #profesionales_buscar').val();
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&profesional='+profesional,
		success:function(data){
			var array = eval(data);
			$('#agrega_registros_profesionales').html(array[0]);
			$('#pagination_profesionales').html(array[1]);
		}
	});
	return false;
}

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getEdadUsuario(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getEdad.php';
	var edad;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){	
          edad = data;			  		  		  			  
		}
	});
	return edad;	
}

$(document).ready(function() {
	  $('#form_main #estado').on('change', function(){
          pagination(1);		 
      });					
});

$(document).ready(function() {
	  $('#form_main #tipo').on('change', function(){
          pagination(1);		 
      });					
});

function getStatus(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getStatus.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#estado').html("");
			$('#estado').html(data);
			$('#estado').selectpicker('refresh');
			$("#estado").val(1);
		  	$('#estado').selectpicker('refresh');			
		}			
     });		
}

function getSexo(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getSexo.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_expediente_manual #sexo_manual').html("");
			$('#formulario_agregar_expediente_manual #sexo_manual').html(data);
			$('#formulario_agregar_expediente_manual #sexo_manual').selectpicker('refresh');
		    $('#formulario #sexo').html("");
			$('#formulario #sexo').html(data);
			$('#formulario #sexo').selectpicker('refresh');		
		}			
     });		
}

function limpiar(){
	$('#form_main #bs-regis').val("");			
    $('#agrega-registros').html("");
	$('#pagination').html("");
    $('#form_main #tipo').html("");	
    pagination(1);
	getStatus();
	getTipo();
	getTipoPacientes();
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

function getIdentidad(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getIdentidad.php';
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

function getDepartamento(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getDepartamento.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #departamento').html("");
			$('#formulario #departamento').html(data);
			$('#formulario #departamento').selectpicker('refresh');	
		}			
     });		
}

$(document).ready(function() {
	$('#formulario #departamento').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/pacientes/getMunicipio.php';
       		
		var departamento_id = $('#formulario #departamento').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'departamento_id='+departamento_id,
		   success:function(data){
		      $('#formulario #municipio').html("");
			  $('#formulario #municipio').html(data);
			  $('#formulario #municipio').selectpicker('refresh');		  
		  }
	  });
	  return false;			 				
    });					
});

function getEstadoCivil(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getEstadoCivil.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #estado_civil').html("");
			$('#formulario #estado_civil').html(data);
			$('#formulario #estado_civil').selectpicker('refresh');
		}			
     });		
}

function getRaza(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getRaza.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #raza').html("");
			$('#formulario #raza').html(data);
			$('#formulario #raza').selectpicker('refresh');
		}			
     });		
}

function getReligion(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getReligion.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #religion').html("");
			$('#formulario #religion').html(data);
			$('#formulario #religion').selectpicker('refresh');
		}			
     });		
}

function getProfesion(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getProfesion.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #profesion').html("");
			$('#formulario #profesion').html(data);
			$('#formulario #profesion').selectpicker('refresh');
		}			
     });		
}

function getPais(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getPais.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #pais').html("");
			$('#formulario #pais').html(data);
			$('#formulario #pais').selectpicker('refresh');
			$("#formulario #pais").val(1);
		  	$('#formulario #pais').selectpicker('refresh');			
		}			
     });		
}

function getEscolaridad(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getEscolaridad.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #escolaridad').html("");
			$('#formulario #escolaridad').html(data);
			$('#formulario #escolaridad').selectpicker('refresh');
		}			
     });		
}

function getMunicipioEditar(departamento_id, municipio_id){
	var url = '<?php echo SERVERURL; ?>php/pacientes/getMunicipio.php';
		
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'departamento_id='+departamento_id,
	   success:function(data){
	      $('#formulario #municipio').html("");
		  $('#formulario #municipio').html(data);
		  $('#formulario #municipio').selectpicker('refresh');
		  $('#formulario #municipio').val(municipio_id);
		  $('#formulario #municipio').selectpicker('refresh');	  
	  }
	});
	return false;		
}

function busquedaUsuarioManualIdentidad(){
	var url = '<?php echo SERVERURL; ?>php/pacientes/consultarIdentidad.php';
       		
	var identidad = $('#formulario_agregar_expediente_manual #identidad_ususario_manual').val();
	
   $.ajax({
	  type:'POST',
	  url:url,
	  data:'identidad='+identidad,
	  success:function(data){
		 if(data == 1){	
			swal({
				title: "Error", 
				text: "Este numero de Identidad ya existe, por favor corriga el numero e intente nuevamente",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey : false,
				allowOutsideClick: false
			});					 
			 $("#reg_manual").attr('disabled', true);
			 return false;
		 }else{		  
			 $("#reg_manual").attr('disabled', false); 
		}	  
	}
   });			
}

function busquedaUsuarioManualExpediente(){
	var url = '<?php echo SERVERURL; ?>php/pacientes/consultarExpediente.php';
       		
	var expediente = $('#formulario_agregar_expediente_manual #expediente_usuario_manual').val();
	
   $.ajax({
	  type:'POST',
	  url:url,
	  data:'expediente='+expediente,
	  success:function(data){
		 if(data == 1){
			swal({
				title: "Error", 
				text: "Este numero de Expediente ya existe, por favor corriga el numero e intente nuevamente",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey : false,
				allowOutsideClick: false
			});				  
			$("#reg").attr('disabled', true);
			return false;
		 }else{ 			  
			$("#reg").attr('disabled', false); 
		}	  
	  }
   });		
}

function convertirExpedientetoTemporal(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/pacientes/convertirExpedienteTemporal.php';		
    var pacientes_id = $('#formulario_agregar_expediente_manual #id-registro').val();	
	
	$.ajax({
        type: "POST",
        url: url,
	    data:'pacientes_id='+pacientes_id,		
	    async: true,
        success: function(data){	
            if(data == 1){
				swal({
					title: "Usuario convertido", 
					text: "El usuario se ha convertido a temporal",
					type: "success", 
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
			    $('#formulario_agregar_expediente_manual #expediente_manual').val('TEMP');
			    $('#formulario_agregar_expediente_manual #temporal').hide();
			    $('#convertir_manual').hide();
			    $('#reg').show();
                pagination(1);			   
	            return false;				
			}else{
				swal({
					title: "Error", 
					text: "No se puede procesar su solicitud",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});
                return false;			   
			}
		}			
     });	
}

function getTipo(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getTipo.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #tipo').html("");
			$('#form_main #tipo').html(data);
			$('#form_main #tipo').selectpicker('refresh');	
			$("#form_main #tipo").val(1);
		  	$('#form_main #tipo').selectpicker('refresh');						
		}			
     });		
}

function getTipoPacientes(){
    var url = '<?php echo SERVERURL; ?>php/pacientes/getTipoPaciente.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario #tipo').html("");
			$('#formulario #tipo').html(data);
			$('#formulario #tipo').selectpicker('refresh');	
			$("#formulario #tipo").val(1);
		  	$('#formulario #tipo').selectpicker('refresh');			
		}			
     });		
}

$('#form_main #reporte').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});

$(document).ready(function(){
  $('#formulario #telefono1').on('blur', function(e){
      if($("#formulario #telefono1").val().length != 8) {
		$("#formulario #telefono1").css("border-color", "red");	
        $("#formulario #telefono1").focus();		
		$("#reg").attr('disabled', true);
		$("#edi").attr('disabled', true);
        return false;
      }else{
		$("#formulario #telefono1").css("border-color", "none");	
		$("#reg").attr('disabled', false);
		$("#edi").attr('disabled', false);		  
	  }
  });
});

$(document).ready(function(){
  $('#formulario #telefono2').on('blur', function(e){
	  if($("#formulario #telefono2").val() != ""){
		   if($("#formulario #telefono2").val().length != 8) {
		      $("#formulario #telefono2").css("border-color", "red");	
              $("#formulario #telefono2").focus();		
		      $("reg").attr('disabled', true);
		      $("#edi").attr('disabled', true);
              return false;
           }else{
		      $("#formulario #telefono2").css("border-color", "none");	
		      $("#reg").attr('disabled', false);
		      $("#edi").attr('disabled', false);		  
	       }
	  }else{
		  $("#formulario #telefono2").css("border-color", "none");
		  $("#reg").attr('disabled', false);
		  $("#edi").attr('disabled', false);
	  }
  });
});

$(document).ready(function(){
  $('#formulario #telefonoresp').on('blur', function(e){
	  if($("#formulario #telefonoresp").val() != ""){
		   if($("#formulario #telefonoresp").val().length != 8) {
		      $("#formulario #telefonoresp").css("border-color", "red");	
              $("#formulario #telefonoresp").focus();		
		      $("#reg").attr('disabled', true);
		      $("#edi").attr('disabled', true);
              return false;
           }else{
		      $("#formulario #telefonoresp").css("border-color", "none");	
		      $("#reg").attr('disabled', false);
		      $("#edi").attr('disabled', false);		  
	       }
	  }else{
		  $("#reg").attr('disabled', false);
		  $("#edi").attr('disabled', false);
		  $("#formulario #telefonoresp").css("border-color", "none");
	  }
  });
});

$(document).ready(function(){
  $('#formulario #telefonoresp1').on('blur', function(e){
	  if($("#formulario #telefonoresp1").val() != ""){
		   if($("#formulario #telefonoresp1").val().length != 8) {
		      $("#formulario #telefonoresp1").css("border-color", "red");	
              $("#formulario #telefonoresp1").focus();		
		      $("#reg").attr('disabled', true);
		      $("#edi").attr('disabled', true);
              return false;
           }else{
		      $("#formulario #telefonoresp1").css("border-color", "none");	
		      $("#reg").attr('disabled', false);
		      $("#edi").attr('disabled', false);		  
	       }
	  }else{
		  	$("#formulario #telefonoresp1").css("border-color", "none");	
		    $("#reg").attr('disabled', false);
		    $("#edi").attr('disabled', false);
	  }
  });
});

/*INICIO AUTO COMPLETAR*/
/*INICIO SUGGESTION NOMBRE*/
$(document).ready(function() {
   $('#formulario #name').on('keyup', function() {
	   if($('#formulario #name').val() != ""){
		     var key = $(this).val();		
             var dataString = 'key='+key;
		     var url = '<?php echo SERVERURL; ?>php/pacientes/autocompletarNombre.php';
	
	        $.ajax({
               type: "POST",
               url: url,
               data: dataString,
               success: function(data) {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#formulario #suggestions_name').fadeIn(1000).html(data);
                  //Al hacer click en algua de las sugerencias
                  $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#formulario #name').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#formulario #suggestions_name').fadeOut(1000);
                        return false;
                 });
              }
           });   
	   }else{
		   $('#formulario#suggestions_name').fadeIn(1000).html("");
		   $('#formulario #suggestions_name').fadeOut(1000);
	   }
     });		
});

//OCULTAR EL SUGGESTION
$(document).ready(function() {
   $('#formulario #name').on('blur', function() {
	   $('#formulario #suggestions_name').fadeOut(1000);
   });		
});  

$(document).ready(function() {
   $('#formulario #name').on('click', function() {
	   if($('#formulario #name').val() != ""){
		     var key = $(this).val();		
             var dataString = 'key='+key;
		     var url = '<?php echo SERVERURL; ?>php/pacientes/autocompletarNombre.php';
	
	        $.ajax({
               type: "POST",
               url: url,
               data: dataString,
               success: function(data) {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#formulario #suggestions_name').fadeIn(1000).html(data);
                  //Al hacer click en algua de las sugerencias
                  $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#formulario #name').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#formulario #suggestions_name').fadeOut(1000);
                        return false;
                 });
              }
           });   
	   }else{
		   $('#formulario#suggestions_name').fadeIn(1000).html("");
		   $('#formulario #suggestions_name').fadeOut(1000);
	   }
     });		
}); 
/*FIN SUGGESTION NOMBRE*/

/*INICIO SUGGESTION APELLIDO*/
$(document).ready(function() {
   $('#formulario #lastname').on('keyup', function() {
	   if($('#formulario #lastname').val() != ""){
		     var key = $(this).val();		
             var dataString = 'key='+key;
		     var url = '<?php echo SERVERURL; ?>php/pacientes/autocompletarNombre.php';
	
	        $.ajax({
               type: "POST",
               url: url,
               data: dataString,
               success: function(data) {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#formulario #suggestions_apellido').fadeIn(1000).html(data);
                  //Al hacer click en algua de las sugerencias
                  $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#formulario #lastname').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#formulario #suggestions_apellido').fadeOut(1000);
                        return false;
                 });
              }
           });   
	   }else{
		   $('#formulario#suggestions_apellido').fadeIn(1000).html("");
		   $('#formulario #suggestions_apellido').fadeOut(1000);
	   }
     });		
});

//OCULTAR EL SUGGESTION
$(document).ready(function() {
   $('#formulario #lastname').on('blur', function() {
	   $('#formulario #suggestions_apellido').fadeOut(1000);
   });		
});  

$(document).ready(function() {
   $('#formulario #lastname').on('cli', function() {
	   if($('#formulario #lastname').val() != ""){
		     var key = $(this).val();		
             var dataString = 'key='+key;
		     var url = '<?php echo SERVERURL; ?>php/pacientes/autocompletarNombre.php';
	
	        $.ajax({
               type: "POST",
               url: url,
               data: dataString,
               success: function(data) {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#formulario #suggestions_apellido').fadeIn(1000).html(data);
                  //Al hacer click en algua de las sugerencias
                  $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#formulario #lastname').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#formulario #suggestions_apellido').fadeOut(1000);
                        return false;
                 });
              }
           });   
	   }else{
		   $('#formulario#suggestions_apellido').fadeIn(1000).html("");
		   $('#formulario #suggestions_apellido').fadeOut(1000);
	   }
     });		
});
/*FIN SUGGESTION APELLIDO*/
/*FIN AUTO COMPLETAR*/

function detallesUsuario(pacientes_id){
	var url = '<?php echo SERVERURL; ?>php/pacientes/getdetallesUsuario.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		success:function(data){
			if(data == 1){	
				swal({
					title: "Error", 
					text: "Por favor intentelo de nuevo más tarde",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});							
			}else{
  	           $('#mensaje_show').modal({
	             show:true,
				 keyboard: false,
	             backdrop:'static'  
     	       });	
               $('#mensaje_mensaje_show').html(data);
	           $('#bad').hide();
	           $('#okay').show();				
			}
		}
	});	
}

function getMunicipio(){
	var url = '<?php echo SERVERURL; ?>php/pacientes/getMunicipio.php';
		
	var departamento_id = $('#formulario #departamento').val();
	
	$.ajax({
	   type:'POST',
	   url:url,
	   data:'departamento_id='+departamento_id,
	   success:function(data){
		  $('#formulario #municipio').html("");
		  $('#formulario #municipio').html(data);  
		  $('#formulario #municipio').selectpicker('refresh');
	  }
  });	
}

$('#formulario #localidad').keyup(function() {
	    var max_chars = 250;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#formulario #charNum_pacientes_localidad').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

function caracteresLocalidad(){
	var max_chars = 250;
	var chars = $('#formulario #localidad').val().length;
	var diff = max_chars - chars;
	
	$('#formulario #charNum_pacientes_localidad').html(diff + ' Caracteres'); 
	
	if(diff == 0){
		return false;
	}
}
</script>