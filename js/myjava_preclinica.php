<script>
	$(document).ready(function() {
	  $('#form_main #nuevo-registro').on('click',function(){
	   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	    $('#reg_preclinica').show();
	    $('#reg_preclinica_edicion').hide();	
		$('#edit_preclinica').hide();			
	    $('#formulario_agregar_preclinica')[0].reset();	
		$('#formulario_agregar_preclinica #pro').val('Registro');	
        $("#formulario_agregar_preclinica #expediente").attr('readonly', false);
        $("#reg_preclinica").attr('disabled', true);
		$('#formulario_agregar_preclinica #visita').prop('checked', false); //DESELECCIONA UN CHECK BOX
        $('#formulario_agregar_preclinica #grupo').show();	
		$('#formulario_agregar_preclinica #group_alta').show();
		$('#formulario_agregar_preclinica #grupo_profesional_consulta').hide();
		$('#formulario_agregar_preclinica #visita').show();
					
        limpiarFormulario();		
	     $('#agregar_preclinica').modal({
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
				confirmButtonClass: 'btn-danger',
				allowEscapeKey: false,
				allowOutsideClick: false
			});	
			return false;
       }	
	});	
	   
    //BUSQUEDA	
	$('#form_main #servicio').on('change',function(){	
	     pagination(1);
    });	
	
	$('#form_main #colaborador').on('change',function(){     	    
		pagination(1);
    });		
	
	$('#form_main #bs-regis').on('keyup',function(){
	   pagination(1);
    });

    $('#form_main #fecha_i').on('change',function(){
	   pagination(1);
    });	
	
    $('#form_main #fecha_f').on('change',function(){
	   pagination(1);
    });		

    limpiarFormulario();
});

$('#form_ausencia #Si').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		e.preventDefault();
		if($('#form_ausencia #motivo_ausencia').val() != ""){
			eliminarRegistro(); 
		}else{
			swal({
				title: "Error", 
				text: "El comentario no puede quedar en blancoo",
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
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});		
		return false;
	}	 
});

$(document).ready(function(){
    pagination(1);
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_preclinica").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_preclinica #expediente').focus();
    });
});

$(document).ready(function(){
    $("#eliminar").on('shown.bs.modal', function(){
        $(this).find('#form_ausencia #motivo_ausencia').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$(document).ready(function(e) {
    pagination(1);		 					
	limpiarFormularioMain();
	evaluarRegistrosPendientes();
});

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_agregar_preclinica #expediente').on('blur', function(){
	 if($('#formulario_agregar_preclinica #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/preclinica/buscar_expediente.php';
        var expediente = $('#formulario_agregar_preclinica #expediente').val();
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
					$("#reg_preclinica").attr('disabled', true);
					return false;
			  }else if (array[0] == "Error1"){	  
					swal({
						title: "Error", 
						text: "Este es un usuario temporal, no se puede agregar la preclínica, o simplemente el usuario no existe",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_preclinica").attr('disabled', true)				  
					return false;
			  }else if (array[0] == "Familiar"){	  
					swal({
						title: "Error", 
						text: "Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_preclinica").attr('disabled', true);				  
					return false;
			  }else if (array[0] == "NoActivo"){	  
					swal({
						title: "Error", 
						text: "Este usuario no se encuentra activo, por favor validar con el área de Admisión o Archivo Clínico antes de continuar",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#reg_preclinica").attr('disabled', true);				  
					return false;
			  }else{
				 $('#formulario_agregar_preclinica #pro').val('Registro');
			     $('#formulario_agregar_preclinica #identidad').val(array[0]);
                 $('#formulario_agregar_preclinica #nombre').val(array[1]);			  			 	
                 $("#reg_preclinica").attr('disabled', true);				  
			  }		  			  
		  }
	  });
	  return false;		
	 }else{ 
		$('#formulario_agregar_preclinica')[0].reset();	
        $("#reg_preclinica").attr('disabled', true);
        $('#formulario_agregar_preclinica #pro').val('Registro');		
	 }
	});
});

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/preclinica/paginar.php';
	var dato = '';
	var servicio = '';
	var unidad = '';
	var fechai = $('#form_main #fecha_i').val();
	var fechaf = $('#form_main #fecha_f').val();	
	var colaborador = '';
	
	if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = 1;
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if($('#form_main #unidad').val() == "" || $('#form_main #unidad').val() == null){
		unidad = "";
	}else{
		unidad = $('#form_main #unidad').val();
	}
	
	if($('#form_main #colaborador').val() == "" || $('#form_main #colaborador').val() == null){
		colaborador = '';
	}else{
		colaborador = $('#form_main #colaborador').val();
	}
	
	if($('#form_main #bs-regis').val() == "" || $('#form_main #bs-regis').val() == null){
		dato = '';
	}else{
		dato = $('#form_main #bs-regis').val();
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&dato='+dato+'&unidad='+unidad+'&fechai='+fechai+'&fechaf='+fechaf+'&colaborador='+colaborador,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

//FORMULARIO PRINCIPAL
function getServicioFormMain(){
    var url = '<?php echo SERVERURL; ?>php/preclinica/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #servicio').html("");
			$('#form_main #servicio').html(data);
		}			
     });		
}

$(document).ready(function() {
	  $('#form_main #servicio').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/preclinica/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#form_main #unidad').html("");
				$('#form_main #unidad').html(data);				
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#form_main #unidad').on('change', function(){
		var servicio = $('#form_main #servicio').val();
		var puesto_id = $('#form_main #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/preclinica/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio+'&puesto_id='+puesto_id,
            success: function(data){
				$('#form_main #colaborador').html("");
				$('#form_main #colaborador').html(data);			
            }
         });
		 
      });					
});

//METODOS
//Limpiar formulario
function limpiarFormularioMain(){	
	getServicioFormMain();
}

function limpiarFormulario(){
	getServicio();	
}

//Consultar Servicio
function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/preclinica/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_preclinica #servicio').html("");
			$('#formulario_agregar_preclinica #servicio').html(data);				
        }
     });		
}

//Llenar unidad al seleccionar el servicio
$(document).ready(function() {
	  $('#formulario_agregar_preclinica #servicio').on('change', function(){
		var servicio_id = $('#formulario_agregar_preclinica #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/preclinica/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_agregar_preclinica #unidad').html(data);					
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#formulario_agregar_preclinica #unidad').on('change', function(){
		var servicio_id = $('#formulario_agregar_preclinica #servicio').val();
		var puesto_id = $('#formulario_agregar_preclinica #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/preclinica/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
				$('#formulario_agregar_preclinica #medico').html(data);				 				
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#formulario_agregar_preclinica #medico').on('change', function(){
		   if($('#formulario_agregar_preclinica #medico').val()){
			   $("#reg_preclinica").attr('disabled', false);
		   }
      });					
});		  
//Llenar el profesional al seleccionar la unidad

/*************************************************/
//FORMULARIOS
function editarRegistro(agenda_id, expediente){
 if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
  if(expediente != 0){	
	var url = '<?php echo SERVERURL; ?>php/preclinica/editar.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+agenda_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formulario_agregar_preclinica')[0].reset();
			$('#reg_preclinica').hide();
			$('#reg_preclinica_edicion').show();	
			$('#edit_preclinica').hide();	
			$('#formulario_agregar_preclinica #grupo').hide();
			$('#formulario_agregar_preclinica #grupo_profesional_consulta').show();				
			$('#formulario_agregar_preclinica #pro').val('Registro');
			$('#formulario_agregar_preclinica #nombre').val(datos[0]);
            $('#formulario_agregar_preclinica #identidad').val(datos[1]);
            $('#formulario_agregar_preclinica #expediente').val(datos[2]);
			$('#formulario_agregar_preclinica #profesional_consulta').val(datos[3]);
			$('#formulario_agregar_preclinica #fecha').val(datos[4]);
			$("#formulario_agregar_preclinica #expediente").attr('readonly', true);		
			$('#formulario_agregar_preclinica #id-registro').val(agenda_id);
			$('#formulario_agregar_preclinica #visita').hide();
		    $('#formulario_agregar_preclinica #group_alta').hide();
			$('#formulario_agregar_preclinica #visita').html('');
			
	     	$('#agregar_preclinica').modal({
				show:true,
				keyboard: false,
				backdrop:'static'
			});
			return false;
		}
	});	
  }else{
	swal({
		title: "Error", 
		text: "Este es un expediente temporal, no se puede almacenar",
		type: "error", 
		confirmButtonClass: 'btn-danger',
		allowEscapeKey: false,
		allowOutsideClick: false
	});			 
  }
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

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

$('#reg_preclinica').on('click', function(e){
	 if ($('#formulario_agregar_preclinica #expediente').val() == "" || $('#formulario_agregar_preclinica #observaciones').val() == ""){				
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
		agregarPreclinica();		
	 } 		 
});

$('#reg_preclinica_edicion').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_preclinica #expediente').val() == ""){			
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
		agregarPreclinicaporUsuario();		
	 }  
});

function agregarPreclinica(){
if($('#formulario_agregar_preclinica #servicio').val() != "" && $('#formulario_agregar_preclinica #unidad').val() != "" && $('#formulario_agregar_preclinica #medico').val() != ""){	
	var fecha = $('#formulario_agregar_preclinica #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/preclinica/agregarPreclinica.php';
	
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
		  data:$('#formulario_agregar_preclinica').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_preclinica')[0].reset();
				$('#formulario_agregar_preclinica #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#agregar_preclinica').modal('hide');
				limpiarFormulario();
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
                limpiarFormulario();
			   return false;
			}else if(registro == 3){
				swal({
					title: "Error", 
					text: "El registro no fue almacenado",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});						
                limpiarFormulario();
			   return false;
			}else if(registro == 4){							   
				swal({
					title: "Error", 
					text: "No se puede almacenar la preclínica, por favor validar con el área de Admisión antes de continuar, puede ser que exista una ausencia marcada para este usuario o el usuario se encuentra en su lista pendiente de Preclínica, por favor valide su registros de Preclínica",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
                limpiarFormulario();
			   return false;
			}else if (registro == 5){
				swal({
					title: "Error", 
					text: "No se puede agendar este usuario ya que es un Adulto",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				  			 
				return false;				  
			}else if (registro == 6){
				swal({
					title: "Error", 
					text: "No se puede agendar este usuario ya que es un Niño",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				  			  
				return false;				  
			}else if (registro == 7){
				swal({
					title: "Error", 
					text: "Lo sentimos este registro ya cuenta con atención pendiente para este servicio, por favor revisar las citas para este usuario. Para mas detalles contacte al departamento de Admisión",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				  			  
				 return false;				  
			}else if(registro == 8){
				swal({
					title: "Error", 
					text: "Lo sentimos este usuario ya tiene marcada una ausencia no se puede reprogramar esta cita para este día, por favor elimine la ausencia antes de continuar",
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
                limpiarFormulario();			   
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
 }else{;
		swal({
			title: "Error", 
			text: "Hay registros en blanco favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
	   return false;
 }
}
  
function agregarPreclinicaporUsuario(){
	var fecha = $('#formulario_agregar_preclinica #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/preclinica/agregarPreclinicaporUsuario.php';
	
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
		  data:$('#formulario_agregar_preclinica').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_preclinica')[0].reset();
				$('#formulario_agregar_preclinica #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				$('#agregar_preclinica').modal('hide');
				limpiarFormulario();
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
                limpiarFormulario();
			   return false;
			}else if(registro == 3){
				swal({
					title: "Error", 
					text: "El registro no fue almacenado",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
                limpiarFormulario();
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
                limpiarFormulario();			   
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
 
function nosePresntoRegistro(id, pacientes_id, fecha){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	 	
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
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: 'btn-danger',
			allowEscapeKey: false,
			allowOutsideClick: false
		});						 
   }
}

function eliminarRegistro(id,comentario, fecha){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/usuario_no_presento.php';
	var fecha = $('#form_main #fecha_i').val();	
	
    if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
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
		  data:'id='+id+'&fecha='+fecha+'&comentario='+comentario,
		  success: function(registro){
			  if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro removido correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});					
		        $('#medico_general').focus();
                pagination(1);				
			  }else if(registro == 3){
					swal({
						title: "Error", 
						text: "Este registro ya tiene almacenada una ausencia",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});			
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
						text: "Error al mover el registro",
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
			text: "Lo sentimos, no se permite marcar ausencia mayores a la fecha actual",
			type: "error", 
			confirmButtonClass: 'btn-danger',
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
	setInterval('pagination(1)',22000); //CADA 8 SEGUNDOS
	
	//SI EL USUARIO ES DE ENFERMERÍA SE EVALUAN LOS REGISTROS PENDIENTES Y SE ENVIAN POR CORREO
	if (getUsuarioSistema() == 8 ||  getUsuarioSistema() == 9 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		setInterval('evaluarRegistrosPendientes()',1800000); //CADA MEDIA HORA	
	}	
});

function getMes(fecha){
    var url = '<?php echo SERVERURL; ?>php/preclinica/getMes.php';
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

function evaluarRegistrosPendientes(){
    var url = '<?php echo SERVERURL; ?>php/preclinica/evaluarPendientes.php';
	var string = '';
	
	$.ajax({
	    type:'POST',
		data:'fecha='+fecha,
		url:url,
		success: function(valores){	
		   var datos = eval(valores);

		   if(datos[0]>0){
			   
			  if(datos[0] == 1 || datos[0] == 0){
				  string = 'Registro pendiente';
			  }else{
				  string = 'Registros pendientes';
			  }
			  			  
			  swal({
					title: 'Advertencia', 
					text: "Se le recuerda que tiene " + datos[0] + " " + string + " de hacer su Preclínica en este mes de " + datos[1] + ". Debe revisar sus registros pendientes para todos los servicios.", 
					type: 'warning', 
					confirmButtonClass: 'btn-warning',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });			  
		   }
           		  		  		  			  
		}
	});	
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

$(document).ready(function() {
	if (getUsuarioSistema() == 8 ||  getUsuarioSistema() == 9 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		evaluarRegistrosPendientesEmailPreclinica(); //AL INGRESAR AL SISTEMA ENVIARA UN CORREO CON LA CANTIDAD DE REGISTROS PENDIENTES		
	}
});

function evaluarRegistrosPendientesEmailPreclinica(){
    var url = '<?php echo SERVERURL; ?>php/mail/evaluarPendientes_preclinica.php';
	
	$.ajax({
	    type:'POST',
		url:url,
		success: function(valores){	
           		  		  		  			  
		}
	});	
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