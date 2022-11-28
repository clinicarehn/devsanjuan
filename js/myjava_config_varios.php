<script>
$(document).ready(pagination(1));getConsulta();
 $(function(){
	  $('#form_main #nuevo_registro').on('click',function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
		  $('#formulario_registros')[0].reset();
     	  $('#formulario_registros #pro').val('Registro');
		  $('#formulario_registros #nombre_registro').val('');
		  $('#editar_confiraciones_varios').hide();
		  $('#reg_configuraciones_varios').show();
   	      $('#formulario_registros #mensaje').html('');				
		  $('#formulario_registros #mensaje').removeClass('error');		  
		  $('#formulario_registros #mensaje').removeClass('bien');
		  $('#formulario_registros #mensaje').removeClass('alerta');		  
		  getConsulta();
		  $('#registrar').modal({
			  show:true,
			  keyboard: false,
			  backdrop:'static'
		  });
		  return false;
		}else{
			swal({
				title: "Acceso denegado", 
				text: "No tiene permisos para ejecutar esta acción",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});	
			return false;
           }
	   });
	   
                      			   
	   $('#form_main #bs_regis').on('keyup',function(){
		  pagination(1);
   	      return false;
   });	
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#registrar").on('shown.bs.modal', function(){
        $(this).find('#formulario_registros #nombre').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

function getConsulta(){
    var url = '<?php echo SERVERURL; ?>php/config_varios/getConsulta.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#form_main #consulta').html("");
			$('#form_main #consulta').html(data);

		    $('#formulario_registros #consulta_registro').html("");
			$('#formulario_registros #consulta_registro').html(data);				
		}			
     });		
}

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/config_varios/paginar.php';
	var dato = $('#form_main #bs_regis').val();
	var entidad;
	
	if( $('#form_main #consulta').val() == "" || $('#form_main #consulta').val() == null){
		entidad = "enfermedades";
	}else{
		entidad = $('#form_main #consulta').val();
	}
	
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&entidad='+entidad+'&dato='+dato,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function agregar(){
	var url = '<?php echo SERVERURL; ?>php/config_varios/agregar.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_registros').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_registros #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro completado con éxito",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination(1);
				return false;
			}else if (registro == 2){
				$('#formulario_registros #mensaje').html('');				
				swal({
					title: "Error", 
					text: "Error al guardar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			
			}else if (registro == 3){
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		   
			}else{
				swal({
					title: "Error", 
					text: "Error al procesar su solicitud",
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

function modificar(){
	var url = '<?php echo SERVERURL; ?>php/config_varios/modificar.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_registros').serialize(),
		success: function(registro){
			if (registro == 1){
				$('#formulario_registros #pro').val('Edición');
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
			}else if (registro == 2){
				swal({
					title: "Error", 
					text: "Error al modificar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   				
			}else{
				swal({
					title: "Error", 
					text: "Error al procesar su solicitud",
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

function editarRegistro(id,entidad){
	$('#formulario_registros')[0].reset();		
	var url = '<?php echo SERVERURL; ?>php/config_varios/editar.php';
		
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&entidad='+entidad,
		success: function(valores){
				var datos = eval(valores);
				$('#reg_configuraciones_varios').hide();
				$('#editar_confiraciones_varios').show();
				$('#formulario_registros #pro').val('Edicion');
				$('#formulario_registros #id_registro').val(id);
                $('#formulario_registros #consulta_registro').val(datos[0]);
				$('#formulario_registros #nombre_registro').val(datos[1]);				
				
				$('#registrar').modal({
					show:true,
					keyboard: false,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;	
}

function modal_eliminar(id,entidad){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	   
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea remover este registro: " + consultarNombre(id) + "?",
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
			eliminarRegistro(id,entidad);
		});	   
   }else{
		swal({
			title: "Acceso Denegado", 
			text: "Lo siento usted no esta asignado en el área de Hospitalización",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			
	}	
}

function eliminarRegistro(id,entidad){
	var url = '<?php echo SERVERURL; ?>php/config_varios/eliminar.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'entidad='+entidad+'&id='+id,
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
			   pagination(1);
			   return false;
			}else if (registro == 2){
				swal({
					title: "Error", 
					text: "Error al intentar eliminar el registro, por favor intente de nuevo",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
			   return false;			
			}else if (registro == 3){
				swal({
					title: "Error", 
					text: "Error al intentar eliminar el registro, cuenta con información almacenada",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   return false;			
			}else{
				swal({
					title: "Error", 
					text: "Error procesar su solicitud",
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

$(document).ready(function() {
	$('#form_main #consulta').on('change', function(){
          pagination(1);
    });					
});


//BOTONES DE ACCION
$('#reg_configuraciones_varios').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_registros #nombre_registro').val() != "" && $('#formulario_registros #consulta_registro').val() != ""){
		e.preventDefault();
		agregar();			   
		return false;
	 }else{
		$('#formulario_registros #pro').val('Registro');	
		swal({
			title: "Error", 
			text: "No se pueden enviar los datos, los campos estan vacíos",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;	   
	 }  
});

$('#editar_confiraciones_varios').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_registros #nombre_registro').val() != "" && $('#formulario_registros #consulta_registro').val() != ""){
		e.preventDefault();
		modificar();			   
		return false;
	 }else{
		$('#formulario_registros #pro').val('Edición');		
		swal({
			title: "Error", 
			text: "No se pueden enviar los datos, los campos estan vacíos",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			
		return false;	   
	 }  
});


function consultarNombre(id){	
    var url = '<?php echo SERVERURL; ?>php/config_varios/getNombre.php';
	var entidad = '';
	if($('#form_main #consulta').val() == "" || $('#form_main #consulta').val() == null){
		entidad = 'motivo_traslado';
	}else{
		entidad = $('#form_main #consulta').val();
	}
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'entidad='+entidad+'&id='+id,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp;		
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