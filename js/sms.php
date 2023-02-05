<script>
//INICIO MODULO AGENDA
$(document).ready(function(){
    $("#enviar_sms").on('shown.bs.modal', function(){
        $(this).find('#formulario_enviar_sms #text').focus();
    });
});

$(document).ready(function() {	
	$('#form_agenda_main #send_sms').on('click', function(e){	 
		e.preventDefault();
		getReporte();
		getServicioSMS();
		$('#enviar_sms_varios').modal({
			show:true,
			keyboard: false,
			backdrop:'static'
		});
   });	
});

$(document).ready(function() {
	  $('#formulario_enviar_sms_varios #tipo_reporte').on('change', function(){
		var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
		if(reporte_tipo == 1){
			$("#formulario_enviar_sms_varios #text").attr('disabled', true);
			$("#formulario_enviar_sms_varios #text").val("No es necesario que escriba un mensaje aquí, este se envía de forma automática cuando presione sobre enviar");
			$('#formulario_enviar_sms_varios #nombre_usuario').css("cursor", "text");
			$('#formulario_enviar_sms_varios #nombre_apellido').css("cursor", "text");
			$('#formulario_enviar_sms_varios #dia_nombre').css("cursor", "text");
			$('#formulario_enviar_sms_varios #dia').css("cursor", "text");			
			$('#formulario_enviar_sms_varios #mes').css("cursor", "text");
			$('#formulario_enviar_sms_varios #año').css("cursor", "text");			
		}else if(reporte_tipo == 2){
			$("#formulario_enviar_sms_varios #text").attr('disabled', true); 
			$("#formulario_enviar_sms_varios #text").val("No es necesario que escriba un mensaje aquí, este se envía de forma automática cuando presione sobre enviar");	
			$('#formulario_enviar_sms_varios #nombre_usuario').css("cursor", "text");
			$('#formulario_enviar_sms_varios #nombre_apellido').css("cursor", "text");
			$('#formulario_enviar_sms_varios #dia_nombre').css("cursor", "text");
			$('#formulario_enviar_sms_varios #dia').css("cursor", "text");			
			$('#formulario_enviar_sms_varios #mes').css("cursor", "text");
			$('#formulario_enviar_sms_varios #año').css("cursor", "text");			
		}else{
			$("#formulario_enviar_sms_varios #text").attr('disabled', false);
			$('#formulario_enviar_sms_varios #nombre_usuario').css("cursor", "pointer");
			$('#formulario_enviar_sms_varios #nombre_apellido').css("cursor", "pointer");
			$('#formulario_enviar_sms_varios #dia_nombre').css("cursor", "pointer");
			$('#formulario_enviar_sms_varios #dia').css("cursor", "pointer");			
			$('#formulario_enviar_sms_varios #mes').css("cursor", "pointer");
			$('#formulario_enviar_sms_varios #año').css("cursor", "pointer");			
			$("#formulario_enviar_sms_varios #text").val("");
			$("#formulario_enviar_sms_varios #text").focus();
		}
      });					
});

$('#sms_send_varios').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
  if ($('#formulario_enviar_sms_varios #servicio').val() =="" || $('#formulario_enviar_sms_varios #servicio').val() ==null){
	swal({
		title: "Error", 
		text: "El servicio no puede quedar vacío, por favor corregir",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});	
	return false; 
  }else{	  
	  if ($('#formulario_enviar_sms_varios #tipo_reporte').val()!=""){
		e.preventDefault();
		
		var fecha = $('#formulario_enviar_sms_varios #fecha').val();		
		var servicio = $('#formulario_enviar_sms_varios #servicio').val();
		var text_ = String($('#formulario_enviar_sms_varios #text').val());
		var unidad = "";
		var medico = "";
		
		if($('#formulario_enviar_sms_varios #unidad').val() == "" || $('#formulario_enviar_sms_varios #unidad').val() == null){
			unidad = "";
		}else{
			unidad = $('#formulario_enviar_sms_varios #unidad').val();
		}
		
		if($('#formulario_enviar_sms_varios #medico').val() == "" || $('#formulario_enviar_sms_varios #medico').val() == null){
			medico = "";
		}else{
			medico = $('#formulario_enviar_sms_varios #medico').val();
		}		
		
		if ($('#formulario_enviar_sms_varios #tipo_reporte').val() == "" || $('#formulario_enviar_sms_varios #tipo_reporte').val() == null){
		  tipo_reporte = 1;	
		}else{
		  tipo_reporte = $('#formulario_enviar_sms_varios #tipo_reporte').val();
		}
		
		if(tipo_reporte == 1){
			swal({
				title: "¿Esta seguro?",
				text: "¿Desea enviar los SMS de forma masiva?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "¡Sí, deseo enviar los SMS!",
				closeOnConfirm: false,
				allowEscapeKey: false,
				allowOutsideClick: false
			},
			function(){
				swal({
					title: "Servicio no disponible", 
					text: "El servicio no se encuentra disponible",
					type: "warning", 
					confirmButtonClass: "btn-warning",
					allowEscapeKey: false,
					allowOutsideClick: false
				});							
			    //sendMultipleSMSUnDiaAntes(fecha, servicio, unidad, medico);
			});			
		}else if(tipo_reporte == 2){
			swal({
				title: "¿Esta seguro?",
				text: "¿Desea enviar los SMS de forma masiva?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "¡Sí, deseo enviar los SMS!",
				closeOnConfirm: false,
				allowEscapeKey: false,
				allowOutsideClick: false
			},
			function(){
				swal({
					title: "Servicio no disponible", 
					text: "El servicio no se encuentra disponible",
					type: "warning", 
					confirmButtonClass: "btn-warning",
					allowEscapeKey: false,
					allowOutsideClick: false
				});					
			  //sendMultipleSMSDiasDespues(fecha, servicio, unidad, medico);
			});			
		}else{
			if($('#formulario_enviar_sms_varios #text').val() != ""){				
				swal({
					title: "¿Esta seguro?",
					text: "¿Desea enviar los SMS de forma masiva?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-warning",
					confirmButtonText: "¡Sí, deseo enviar los SMS!",
					closeOnConfirm: false,
					allowEscapeKey: false,
					allowOutsideClick: false
				},
				function(){
					swal({
						title: "Servicio no disponible", 
						text: "El servicio no se encuentra disponible",
						type: "warning", 
						confirmButtonClass: "btn-warning",
						allowEscapeKey: false,
						allowOutsideClick: false
					});										
				   //sendMultipleSMS(fecha, servicio, unidad, medico, text_ );
				});			
			}else{
				swal({
					title: "Error", 
					text: "El mensaje no puede quedar en vacío, por favor corregir",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				return false;				
			}
		}	 
	  }else{
		swal({
			title: "Error", 
			text: "El tipo de reporte no puede estar vacío, por favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		return false;
	  }
  }
});

function consultarFecha(fecha){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getFecha.php';
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

$('#sms_send').on('click', function(e){
	if($('#formulario_enviar_sms #text').val() != ""){
	   	e.preventDefault();
        //sendSMS();	
		swal({
			title: "Servicio no disponible", 
			text: "El servicio no se encuentra disponible",
			type: "warning", 
			confirmButtonClass: "btn-warning",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			
	}else{
		swal({
			title: "Error", 
			text: "Lo sentimos el mensaje no puede quedar en blanco",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		$('#formulario_enviar_sms #text').focus();
		return false;
	}
});

$('#sms_clean').on('click', function(e){
	e.preventDefault();
    clean();
});

$('#sms_clean_varios').on('click', function(e){
	e.preventDefault();
    cleanVarios();
});

function getTelefono(pacientes_id){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getTelefono.php';
	var telefono;
	$.ajax({
	    type:'POST',
		url:url,
		data:'pacientes_id='+pacientes_id,
		async: false,
		success:function(data){	
          telefono = data;			  		  		  			  
		}
	});
	return telefono;	
}

function sendOneSMS(pacientes_id, agenda_id){	   
    if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){
	     $('#formulario_enviar_sms #to').val(getTelefono(pacientes_id));
         $('#formulario_enviar_sms #pacientes_id').val(pacientes_id);
         $('#formulario_enviar_sms #agenda_id').val(agenda_id);
   
         $('#enviar_sms').modal({
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
}

$('#formulario_enviar_sms #text').keyup(function() {
	    var max_chars = 160;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#charNum').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

$('#formulario_enviar_sms_varios #text').keyup(function() {
	    var max_chars = 148;
        var chars = $(this).val().length;
        var diff = max_chars - chars;
		
		$('#charNumSMS').html(diff + ' Caracteres'); 
		
		if(diff == 0){
			return false;
		}
});

//MENSAJE ENVIADO DE FORMA AUTOMATICA SEGUN LOS VALORES DE LA CITA DEL USUARIO
//INICIO FUNCION QUE PERMITE REALIZAR EL ENVIO DE SMS A LOS USUARIOS DE UN DIA ANTES DE LA FECHA CONSULTADA
function sendMultipleSMSUnDiaAntes(fecha, servicio, unidad, medico){
    var url = '<?php echo SERVERURL; ?>php/sms/sendMultipleSMSUnDiaAntes.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'fecha='+fecha+'&servicio='+servicio+'&unidad='+unidad+'&medico='+medico,
		beforeSend: function(){
			swal({
				title: "",
				text: "Por favor espere...",
				imageUrl: '../img/gif-load.gif',
				closeOnConfirm: false,
				showConfirmButton: false,
				imageSize: '150x150',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
        },
		success:function(data){	
          if(data == 1){
			swal({
				title: "Enviado", 
				text: "Mensaje Enviado correctamente",
				type: "success",
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});				 
		  }else if(data == 2){
			swal({
				title: "Error", 
				text: "Verifique su conexión a Internet",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				  
		  }else if(data == 3){
			swal({
				title: "Error", 
				text: "No existen SMS que enviar, por favor seleccione un Servicio o verifique la información",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				   
		  }else if(data == 4){
			swal({
				title: "Error", 
				text: "Lo sentimos ya había enviado los SMS para esta fecha",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				  
		  }else if(data == 5){
			swal({
				title: "Error", 
				text: "Lo sentimos no hay suficiente balance para enviar los SMS",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				   
		  }else{
			swal({
				title: "Error", 
				text: "Lo sentimos no se puede procesar su solicitud, por favor intentelo de nuevo más tarde",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		  }  		  		  			  
		},complete:function(){			
		}
	});
	return resp;	
}
//FIN FUNCION QUE PERMITE REALIZAR EL ENVIO DE SMS A LOS USUARIOS DE UN DIA ANTES DE LA FECHA CONSULTADA

//FUNCION QUE PERMITE REALIZAR EL ENVIO DE SMS A LOS USUARIOS CONSULTADOS DE MAS DE UN DIA CALENDARIO
function sendMultipleSMSDiasDespues(fecha, servicio, unidad, medico){
    var url = '<?php echo SERVERURL; ?>php/sms/sendMultipleSMSDiasDespues.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'fecha='+fecha+'&servicio='+servicio+'&unidad='+unidad+'&medico='+medico,
		beforeSend: function(){
			swal({
				title: "",
				text: "Por favor espere...",
				imageUrl: '../img/gif-load.gif',
				closeOnConfirm: false,
				showConfirmButton: false,
				imageSize: '150x150',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
        },
		success:function(data){	
          if(data == 1){
			swal({
				title: "Enviado", 
				text: "Mensaje Enviado correctamente",
				type: "success", 
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});	  
		  }else if(data == 2){
			swal({
				title: "Error", 
				text: "Verifique su conexión a Internet",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			   
		  }else if(data == 3){
			swal({
				title: "Error", 
				text: "No existen SMS que enviar, por favor seleccione un Servicio o verifique la información",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					   
		  }else if(data == 4){
			swal({
				title: "Error", 
				text: "Lo sentimos ya había enviado los SMS para esta fecha",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					    
		  }else if(data == 5){
			swal({
				title: "Error", 
				text: "VLo sentimos no hay suficiente balance para enviar los SMS",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});					  
		  }else{
			swal({
				title: "Error", 
				text: "Lo sentimos no se puede procesar su solicitud, por favor intentelo de nuevo más tarde",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		  }	 	  		  		  			  
		},complete:function(){		
		}
	});
	return resp;	
}
//FIN FUNCION QUE PERMITE REALIZAR EL ENVIO DE SMS A LOS USUARIOS CONSULTADOS DE MAS DE UN DIA CALENDARIO

//INICIO FUNCION QUE PERMITE REALIZAR EL ENVIO DE MULTIPLES SMS
function sendMultipleSMS(fecha, servicio, unidad, medico, text_ ){	
    var url = '<?php echo SERVERURL; ?>php/sms/sendMultipleSMS.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		data:'fecha='+fecha+'&servicio='+servicio+'&unidad='+unidad+'&medico='+medico+'&text_='+text_,
		beforeSend: function(){
			swal({
				title: "",
				text: "Por favor espere...",
				imageUrl: '../img/gif-load.gif',
				closeOnConfirm: false,
				showConfirmButton: false,
				imageSize: '150x150',
				allowEscapeKey: false,
				allowOutsideClick: false
			});
        },
		success:function(data){	
          if(data == 1){
			swal({
				title: "Enviado", 
				text: "Mensaje Enviado correctamente",
				type: "success",
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});				 
		  }else if(data == 2){
			swal({
				title: "Error", 
				text: "Verifique su conexión a Internet",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				  
		  }else if(data == 3){
			swal({
				title: "Error", 
				text: "No existen SMS que enviar, por favor seleccione un Servicio o verifique la información",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				   
		  }else if(data == 4){
			swal({
				title: "Error", 
				text: "Lo sentimos ya había enviado los SMS para esta fecha",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				  
		  }else if(data == 5){
			swal({
				title: "Error", 
				text: "Lo sentimos no hay suficiente balance para enviar los SMS",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				   
		  }else{
			swal({
				title: "Error", 
				text: "Lo sentimos no se puede procesar su solicitud, por favor intentelo de nuevo más tarde",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});
		  }  		  		  			  
		},complete:function(){		
		}
	});
	return resp;	
}
//FIN FUNCION QUE PERMITE REALIZAR EL ENVIO DE MULTIPLES SMS

//INICIO MENSAJE ENVIADO SEGUN FORMULARIO DE ENVIO DE SMS
function sendSMS(){
    var url = '<?php echo SERVERURL; ?>php/sms/sendSMS.php';
 	
	$.ajax({
	    type:'POST',
		url:url,
		data:$('#formulario_enviar_sms').serialize(),
		success:function(data){	
          if(data == 1){
			swal({
				title: "Enviado", 
				text: "Mensaje Enviado correctamente",
				type: "success",
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});	  
		  }else if(data == 2){
			swal({
				title: "Error", 
				text: "Verifique su conexión a Internet",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			 
		  }else if(data == 3){
			swal({
				title: "Error", 
				text: "Lo sentimos ya había enviado este SMS para esta registro",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			 
		  }else if(data == 4){
			swal({
				title: "Error", 
				text: "Lo sentimos no hay suficiente balance para enviar los SMS",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});			 
		  }else{
			swal({
				title: "Error", 
				text: "El Mensaje no se pudo enviar, por favor verifique la información",
				type: "error", 
				confirmButtonClass: "btn-danger",
				allowEscapeKey: false,
				allowOutsideClick: false
			});				  
		  }  		  		  			  
		}
	});	
}
//FIN MENSAJE ENVIADO SEGUN FORMULARIO DE ENVIO DE SMS

$('#formulario_enviar_sms_varios #nombre_usuario').on('click', function(e){
	var text = $('#formulario_enviar_sms_varios #text').val();
	var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
	
	if(reporte_tipo == 3){
		$('#formulario_enviar_sms_varios #text').val(text + " @nombre_usuario");
		$('#formulario_enviar_sms_varios #text').focus();
	}
});

$('#formulario_enviar_sms_varios #nombre_apellido').on('click', function(e){
	var text = $('#formulario_enviar_sms_varios #text').val();
	var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
	
	if(reporte_tipo == 3){	
		$('#formulario_enviar_sms_varios #text').val(text + " @nombre_apellido");
		$('#formulario_enviar_sms_varios #text').focus();		
	}
});

$('#formulario_enviar_sms_varios #dia_nombre').on('click', function(e){
	var text = $('#formulario_enviar_sms_varios #text').val();
	var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
	
	if(reporte_tipo == 3){	
		$('#formulario_enviar_sms_varios #text').val(text + " @dia_nombre");
		$('#formulario_enviar_sms_varios #text').focus();		
	}
});

$('#formulario_enviar_sms_varios #dia').on('click', function(e){
	var text = $('#formulario_enviar_sms_varios #text').val();
	var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
	
	if(reporte_tipo == 3){	
		$('#formulario_enviar_sms_varios #text').val(text + " @dia");
		$('#formulario_enviar_sms_varios #text').focus();		
	}	
});

$('#formulario_enviar_sms_varios #mes').on('click', function(e){
	var text = $('#formulario_enviar_sms_varios #text').val();
	var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
	
	if(reporte_tipo == 3){	
		$('#formulario_enviar_sms_varios #text').val(text + " @mes");
		$('#formulario_enviar_sms_varios #text').focus();		
	}	
});

$('#formulario_enviar_sms_varios #año').on('click', function(e){
	var text = $('#formulario_enviar_sms_varios #text').val();
	var reporte_tipo = $('#formulario_enviar_sms_varios #tipo_reporte').val();
	
	if(reporte_tipo == 3){	
		$('#formulario_enviar_sms_varios #text').val(text + " @año");
		$('#formulario_enviar_sms_varios #text').focus();		
	}	
});

function clean(){
	$('#formulario_enviar_sms')[0].reset()
	$('#formulario_enviar_sms #text').val('');
	$('#formulario_enviar_sms #text').focus();		
}

function cleanVarios(){
	$('#formulario_enviar_sms_varios')[0].reset();
	getReporte();
	getServicioSMS();	
}

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/sms/getReporte.php';
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_enviar_sms_varios #tipo_reporte').html("");
			$('#formulario_enviar_sms_varios #tipo_reporte').html(data);					
		}			
     });		
}

function getServicioSMS(){
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_enviar_sms_varios #servicio').html("");
			$('#formulario_enviar_sms_varios #servicio').html(data);			
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