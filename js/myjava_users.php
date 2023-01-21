<script>
$('#reg_usaurios_sistema').on('click', function(e){
	 e.preventDefault();
	 if ($('#formulario #colaborador').val() != "" && $('#formulario #empresa').val() != "" && $('#formulario #username').val() != "" && $('#formulario #email').val() != "" && $('#formulario #tipo').val() != "" && $('#formulario #estatus').val() != ""){		   		 
		 agregaRegistro();		
	 }else{		
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

$('#edit_usaurios_sistema').on('click', function(e){
	 e.preventDefault();
	 if ($('#formulario_editar #empresa1').val() != "" && $('#formulario_editar #email1').val() != "" && $('#formulario_editar #tipo1').val() != "" && $('#formulario_editar #estatus1').val()){		   		 
		 agregaRegistroEdicion();		
	 }else{		
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

$(document).ready(pagination(1));
 $(function(){
	  $('#nuevo-registro').on('click',function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	      clean();
		  $('#formulario')[0].reset();
     	  $('#pro').val('Registro');
		  $('#grupo_atas_localidades').hide();
		  $('#reg_usaurios_sistema').show();
		  $('#registrar').modal({
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
	
	   $('#main_form #bs-regis').on('keyup',function(){
		  pagination(1);
       });
	   
	   $('#main_form #status').on('change',function(){
		  pagination(1);
       });	   
	   clean();
});

function clean(){
	getColaborador();
	getStatus();
	getEmpresa();
	getTipo();
	getEstatus();
}
/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#registrar").on('shown.bs.modal', function(){
        $(this).find('#formulario #username').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

function modificarContra(id){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea resetear la contraseña al usuario: " + consultarNombre(id) + "?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "¡Sí, resetear la contraseña!",
			closeOnConfirm: false,
			allowEscapeKey: false,
			allowOutsideClick: false
		},
		function(){
			resetearContra(id);
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

function resetearContra(id){	
	var url = '<?php echo SERVERURL; ?>php/users/resetear.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){		
			if(registro == 1){
				pagination(1);		   	
				swal({
					title: "Success", 
					text: "Registro reseteada Correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});				   
				return false;					
			}else{
			   pagination(1);
				swal({
					title: 'Error', 
					text: 'Error al resetear la contraseña',
					type: 'error', 
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

function agregaRegistro(){
  if ($('#estatus').val() !="" && $('#colaborador').val() !="" && $('#empresa').val() !="" && $('#tipo').val() !=""){
	var url = '<?php echo SERVERURL; ?>php/users/agregar.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
		   if(registro == 1){
				$('#formulario')[0].reset();
				$('#pro').val('Registro');
				$('#pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				$('#formulario #colaborador').html("");
				$('#formulario #estatus').html("");	
				$('#formulario #empresa').html("");
				$('#formulario #tipo').html("");
				pagination(1);
				getColaborador();
				getStatus();
				getEmpresa();
				getTipo();
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
		   }
		}
	});
	return false;
  }else{
		swal({
			title: "Error", 
			text: "No puede dejar valores en blanco",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	  
		return false;
  }
}

function getColaborador(){
	var url = '<?php echo SERVERURL; ?>php/users/getColaborador.php';
	
	$.ajax({
		type:'POST',
		url:url,		
		success: function(data){
			$('#formulario #colaborador').html("");
			$('#formulario #colaborador').html(data);
			$('#formulario #colaborador').selectpicker('refresh');

			$('#formulario_editar #colaborador1').html("");
			$('#formulario_editar #colaborador1').html(data);
			$('#formulario_editar #colaborador1').selectpicker('refresh');			
		}
	});
	return false;	
}

function getStatus(){
	var url = '<?php echo SERVERURL; ?>php/users/getStatus.php';
	
	$.ajax({
		type:'POST',
		url:url,		
		success: function(data){
			$('#formulario #estatus').html("");
			$('#formulario #estatus').html(data);
			$('#formulario #estatus').selectpicker('refresh');

			$('#formulario_editar #estatus1').html("");
			$('#formulario_editar #estatus1').html(data);
			$('#formulario_editar #estatus1').selectpicker('refresh');		
		}
	});
	return false;	
}

function getEmpresa(){
	var url = '<?php echo SERVERURL; ?>php/selects/empresa.php';
	
	$.ajax({
		type:'POST',
		url:url,		
		success: function(data){
			$('#formulario #empresa').html("");
			$('#formulario #empresa').html(data);
			$('#formulario #empresa').selectpicker('refresh');

			$('#formulario_editar #empresa1').html("");
			$('#formulario_editar #empresa1').html(data);
			$('#formulario_editar #empresa1').selectpicker('refresh');				
		}
	});
	return false;	
}

function agregaRegistroEdicion(){
  if ($('#estatus1').val() !="" && $('#colaborador1').val() !="" && $('#empresa1').val() !="" && $('#tipo1').val() !=""){	
	var url = '<?php echo SERVERURL; ?>php/users/agregar_edicion.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario_editar').serialize(),
		success: function(registro){
			if(registro == 1){
				$('#pro1').val('Edicion');
				swal({
					title: "Success", 
					text: "Registro modificado correctamente",
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
					text: "Error en editar el registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination(1);
				return false;
			}else{
				swal({
					title: "Error", 
					text: "Se ha producido un error, intentelo de nuevo más tarde",
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
  }else{
		swal({
			title: "Error", 
			text: "No puede dejar valores en blanco",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	  
		return false;
  }	  
}

function pagination(partida){
	var dato = $('#main_form #bs-regis').val();
	var status_valor = "";
	
	if($('#main_form #status').val() == "" || $('#main_form #status').val() == null){
		status_valor = 1;
	}else{
		status_valor = $('#main_form #status').val();
	}
	
	var url = '<?php echo SERVERURL; ?>php/users/paginar.php';
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato+'&status_valor='+status_valor,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function modal_eliminar(id){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar el usuario " + consultarNombre(id) + "",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "¡Sí, eliminar el usuario!",
			cancelButtonText: "Cancelar",		  
			closeOnConfirm: false,
			allowEscapeKey: false,
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
			allowEscapeKey: false,
			allowOutsideClick: false
		});				 
	}		
}

function eliminarRegistro(id){
	var url = '<?php echo SERVERURL; ?>php/users/eliminar.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
		   if(registro == 1){
				pagination(1);
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
				swal({
					title: "Error", 
					text: "Error al eliminar este usuario",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			 
			 return false;			   
		   }else if(registro == 3){	
				swal({
					title: "Error", 
					text: "No se puede realizar esta operación con su propio usuario",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			 
			 return false;			   
		   }else{
				$('#bs-regis').val("");	
				swal({
					title: "Error", 
					text: "No se puede eliminar el registro",
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

function editarRegistro(id){	
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	$('#formulario_editar')[0].reset();
	var url = '<?php echo SERVERURL; ?>php/users/editar.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){			    
				var datos = eval(valores);
				$('#edit_usaurios_sistema').show();
				$('#formulario_editar #pro1').val('Edicion');
				$('#formulario_editar #id-registro1').val(id);
			    $('#formulario_editar #colaborador1').val(datos[0]);							
				$('#formulario_editar #email1').val(datos[3]);
				$('#formulario_editar #empresa1').val(datos[4]);
				$('#formulario_editar #empresa1').selectpicker('refresh');

			    $('#formulario_editar #tipo1').val(datos[5]);	
				$('#formulario_editar #tipo1').selectpicker('refresh');

				$('#formulario_editar #estatus1').val(datos[6]);
				$('#formulario_editar #estatus1').selectpicker('refresh');

		        $("#formulario_editar #colaborador1").attr('disabled', true);			
	            $('#registrar_editar').modal({
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
		title: "Acceso denegado", 
		text: "No tiene permisos para ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});		
}	
}

function reporteEXCEL(){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
       var dato = $('#bs-regis').val();
	   var status_valor = "";
	
	   if($('#main_form #status').val() == "" || $('#main_form #status').val() == null){
		  status_valor = 1;
	   }else{
		  status_valor = $('#main_form #status').val();
	   }
	   
	   var url = '<?php echo SERVERURL; ?>php/users/buscar_usuarios_excel.php?dato='+dato+'&status_valor='+status_valor;
       window.open(url);
   }else{
		swal({
			title: "Acceso denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});							 
   }	
}

function getTipo(){
    var url = '<?php echo SERVERURL; ?>php/users/getTipo.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario #tipo').html("");
			$('#formulario #tipo').html(data);
			$('#formulario #tipo').selectpicker('refresh');

		    $('#formulario_editar #tipo1').html("");
			$('#formulario_editar #tipo1').html(data);	
			$('#formulario_editar #tipo1').selectpicker('refresh');	
		}			
     });		
}

function getEstatus(){
    var url = '<?php echo SERVERURL; ?>php/users/getStatus.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#main_form #status').html("");
			$('#main_form #status').html(data);
			$('#main_form #status').selectpicker('refresh');		
		}			
     });		
}

function consultarNombre(id){	
    var url = '<?php echo SERVERURL; ?>php/users/getNombre.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'id='+id,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp;		
}


var tiempo;
function ini() {
  tiempo = setTimeout('location="<?php echo SERVERURL; ?>php/signin_out/signinout.php"',14400000); // 4 horas
}

function parar() {
  clearTimeout(tiempo);
  tiempo = setTimeout('location="<?php echo SERVERURL; ?>php/signin_out/signinout.php"',14400000); // 4 horas
}

$('#main_form #reporte').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
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