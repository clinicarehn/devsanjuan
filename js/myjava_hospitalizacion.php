<script>
$(document).ready(function() {
	setInterval('pagination(1)',8000);	
	setInterval('evaluarRegistrosPendientes()',1800000); //CADA MEDIA HORA
});

$(document).ready()
  $(function(){
	$('#form_main #sala').on('change',function(){     	    
		pagination(1);
    });		
	
	$('#form_main #bs-regis').on('keyup',function(){
	   pagination(1);
    });

    $('#form_main #estado').on('change',function(){
		  pagination(1);
    });	
	
    $('#form_main #fecha_b').on('change',function(){
		  pagination(1);
    });	
	
    $('#form_main #fecha_f').on('change',function(){
		  pagination(1);
    });		

    pagination(1);
    getSalaFormMain();
	getPatologia1();
	getPatologia2();
	getPatologia3();
	getServicio();
	getServicioTransito();
	getNivel();
	getEstadoFormMain();
	getEstadoAtencionFormMain();
	getRespuestaFormulario();
	//evaluarRegistrosPendientes();
	getEnfermedadad();
	getMotivoTraslado();
	getMotivoTrasladoOtros();
	getTipoAtención();
	getVia();
	getMedicamentos();
	 getProgramarCita();
});

$('#form_ausencia #Si').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8){
		e.preventDefault();
		if($('#form_ausencia #motivo_ausencia').val() != ""){
			eliminarRegistro(); 
		}else{
			swal({
				title: "Error", 
				text: "El comentario no puede quedar en blanco",
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

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#buscarHistorial").on('shown.bs.modal', function(){
        $(this).find('#form-buscarhistorial #bs-regis-historial').focus();
    });
});

$(document).ready(function(){
    $("#agregar_hospitalizacion").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_hospitalizacion #expediente').focus();
    });
});

$(document).ready(function(){
    $("#agregar_ata_familiares").on('shown.bs.modal', function(){
        $(this).find('#formulario_ata_familiares #expediente').focus();
    });
});

$(document).ready(function(){
    $("#eliminar").on('shown.bs.modal', function(){
        $(this).find('#form_ausencia #motivo_ausencia').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$('#formulario_agregar_hospitalizacion #clean').on('click', function(e){
   e.preventDefault();
   clean();
});

function getEstadoAtencionFormMain(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getEstadoAtencion.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #estado_atencion').html("");
			$('#form_main #estado_atencion').html(data);
		}			
     });		
}
function getEstadoFormMain(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getEstado.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #estado').html("");
			$('#form_main #estado').html(data);
		}			
     });		
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
		}			
     });		
}

function clean1(){
  getPatologia1();
  getPatologia2();
  getPatologia3();
  getMotivoTraslado();
  getMotivoTrasladoOtros();
  getVia();
  getMedicamentos();  
}

function clean(){
    getSalaFormMain();
	getServicio();
	getServicioTransito();
	getNivel();
	getEstadoFormMain();
	getEstadoAtencionFormMain();
	getEnfermedadad();
    getMotivoTraslado();
	getMotivoTrasladoOtros();
    getTipoAtención();
	getVia();
	getMedicamentos();	
	$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');
    $('#formulario_agregar_hospitalizacion #centro').html("");
	$('#formulario_agregar_hospitalizacion #centroi').html("");
    $('#formulario_agregar_hospitalizacion #centro_e').html("");
	$('#formulario_agregar_hospitalizacion #centroi_e').html("");	
	$('#formulario_agregar_hospitalizacion #transito_unidad_recibida').html("");
	$('#formulario_agregar_hospitalizacion #transito_unidad_enviada').html("");
	$('#formulario_agregar_hospitalizacion #ihss').html("");	
	$('#formulario_agregar_hospitalizacion #transito_motivo_recibida').val("");
	$('#formulario_agregar_hospitalizacion #transito_motivo_enviada').val("");
	$('#formulario_agregar_hospitalizacion #clinico').val("");
	$('#formulario_agregar_hospitalizacion #motivo').val("");
	$('#formulario_agregar_hospitalizacion #diagnostico_clinico').val("");
	$('#formulario_agregar_hospitalizacion #motivo_e').val("");
    $("#formulario_agregar_hospitalizacion #transito_motivo_recibida").attr('readonly', true);
    $("#formulario_agregar_hospitalizacion #transito_motivo_enviada").attr('readonly', true);
	$("#formulario_agregar_hospitalizacion #clinico").attr('readonly', true);
    $("#formulario_agregar_hospitalizacion #motivo").attr('readonly', true);
	$("#formulario_agregar_hospitalizacion #diagnostico_clinico").attr('readonly', true);
	$("#formulario_agregar_hospitalizacion #motivo_e").attr('readonly', true);
	$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
	$("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
	$('#formulario_agregar_hospitalizacion #alta_exigida').prop('checked', false); //DESELECCIONA UN CHECK BOX
	$('#formulario_agregar_hospitalizacion #alta_medica').prop('checked', false); //DESELECCIONA UN CHECK BOX
    $('#formulario_agregar_hospitalizacion #diagnostico_ultimo').prop('checked', false); //DESELECCIONA UN CHECK BOX	
	$('#formulario_agregar_hospitalizacion #ihss').html("");
	$('#formulario_agregar_hospitalizacion #ihss1').html("");
	$('#formulario_agregar_hospitalizacion #transito_profesional_recibida').html("");
	$('#formulario_agregar_hospitalizacion #transito_profesional_enviada').html("");
	//RECETA
	$('#formulario_agregar_hospitalizacion #frecuencia1').val("");
	$('#formulario_agregar_hospitalizacion #cantidad1').val("");
	$('#formulario_agregar_hospitalizacion #recomendaciones1').val("");
	
	$('#formulario_agregar_hospitalizacion #frecuencia2').val("");
	$('#formulario_agregar_hospitalizacion #cantidad2').val("");
	$('#formulario_agregar_hospitalizacion #recomendaciones2').val("");

	$('#formulario_agregar_hospitalizacion #frecuencia3').val("");
	$('#formulario_agregar_hospitalizacion #cantidad3').val("");
	$('#formulario_agregar_hospitalizacion #recomendaciones3').val("");

	$('#formulario_agregar_hospitalizacion #frecuencia4').val("");
	$('#formulario_agregar_hospitalizacion #cantidad4').val("");
	$('#formulario_agregar_hospitalizacion #recomendaciones4').val("");

	$('#formulario_agregar_hospitalizacion #frecuencia5').val("");
	$('#formulario_agregar_hospitalizacion #cantidad5').val("");
	$('#formulario_agregar_hospitalizacion #recomendaciones5').val("");	
	getRespuestaFormulario();
}

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/paginar_hospitalizacion.php';
	var dato = $('#form_main #bs-regis').val();
	var sala = "";
	var estado = "";
	var fechai = $('#form_main #fecha_b').val();
	var fechaf = $('#form_main #fecha_f').val();
			
	if($('#form_main #estado').val() == "" || $('#form_main #estado').val() == null){
		estado = "";
	}else{		
		estado = $('#form_main #estado').val();
	}
		
	if($('#form_main #sala').val() == "" || $('#form_main #sala').val() == null){
	   sala = "";	
	}else{
		sala = $('#form_main #sala').val();
	}
					
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&sala='+sala+'&dato='+dato+'&fechai='+fechai+'&fechaf='+fechaf+'&estado='+estado,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function editarRegistro(hosp_id,servicio,historial,estado){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8){
	var estado_cama = getEstadoCama(hosp_id);
		
    if(estado_cama == 0){
	    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/editar.php';
	    var expedientes;
	
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+hosp_id+'&servicio='+servicio+'&historial='+historial,
		success: function(valores){
				var datos = eval(valores);	
				clean();
                $('#formulario_agregar_hospitalizacion #expediente1').show();
				$('#formulario_agregar_hospitalizacion #expediente').hide();
				$('#formulario_agregar_hospitalizacion')[0].reset();
				$('#formulario_agregar_hospitalizacion #reg').show();
				$('#formulario_agregar_hospitalizacion #pro').val('Registro por usuario');
				$('#formulario_agregar_hospitalizacion #id-registro').val(hosp_id);				
				$('#formulario_agregar_hospitalizacion #historial_id').val(historial);
                $('#formulario_agregar_hospitalizacion #servicio').val(servicio);				
				$('#formulario_agregar_hospitalizacion #nombre').val(datos[0]);
				$('#formulario_agregar_hospitalizacion #expediente1').val(datos[1]);
				$('#formulario_agregar_hospitalizacion #paciente').val(datos[2]);
				$('#formulario_agregar_hospitalizacion #cama_id').val(datos[3]);
				$('#formulario_agregar_hospitalizacion #puesto_id').val(datos[4]);
				$('#formulario_agregar_hospitalizacion #patologia1').val(datos[5]);	
				$('#formulario_agregar_hospitalizacion #patologia2').val(datos[6]);
				$('#formulario_agregar_hospitalizacion #patologia3').val(datos[7]);
				$('#formulario_agregar_hospitalizacion #enfermedad').val(datos[8]);				
                $("#formulario_agregar_hospitalizacion #transito_motivo_recibida").attr('readonly', true);
                $("#formulario_agregar_hospitalizacion #transito_motivo_enviada").attr('readonly', true);
				$("#formulario_agregar_hospitalizacion #clinico").attr('readonly', true);
				$("#formulario_agregar_hospitalizacion #motivo").attr('readonly', true);
				$("#formulario_agregar_hospitalizacion #diagnostico_clinico").attr('readonly', true);
				$("#formulario_agregar_hospitalizacion #motivo_e").attr('readonly', true);
				$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');
				$("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
				$('#formulario_agregar_hospitalizacion #alta_exigida').prop('checked', false); //DESELECCIONA UN CHECK BOX
				$('#formulario_agregar_hospitalizacion #alta_medica').prop('checked', false); //DESELECCIONA UN CHECK BOX
				$('#formulario_agregar_hospitalizacion #diagnostico_ultimo').prop('checked', false); //DESELECCIONA UN CHECK BOX	
				$('#formulario_agregar_hospitalizacion #edi').hide();
		        $('#formulario_agregar_hospitalizacion #reg').show();
				$('#formulario_agregar_hospitalizacion #fecha').val(datos[9]);
		        $('#formulario_agregar_hospitalizacion #servicio_grupo_label').hide();
			    $('#formulario_agregar_hospitalizacion #servicio_grupo').hide();
				$("#formulario_agregar_hospitalizacion #expediente").attr('readonly', true);
				$("#formulario_agregar_hospitalizacion #paciente").attr('readonly', false);
				$('#formulario_agregar_hospitalizacion #ihss').val(2);
				
                $('#formulario_agregar_hospitalizacion #suicida_label').html("¿Conducta Suicida?");				
                $('#formulario_agregar_hospitalizacion #label_suicida_si').html('Sí');	
                $('#formulario_agregar_hospitalizacion #label_suicida_no').html('No');	
			    $('#formulario_agregar_hospitalizacion #suicida_si').show();	
                $('#formulario_agregar_hospitalizacion #suicida_no').show();				
				
			    //EVALUAR SI ES MEDICO PARA MOSTRAR RECETA
			    if(getPuesto() == 2 || getPuesto() == 10){	
				    //ALTA MEDICA
                    $('#formulario_agregar_hospitalizacion #label_altamedica').html('Alta Médica');	
                    $('#formulario_agregar_hospitalizacion #label_altaexigida').html('Alta Exigida');
                    $('#formulario_agregar_hospitalizacion #alta_medica').show();	
                    $('#formulario_agregar_hospitalizacion #alta_exigida').show();						
				    //ACTUALIZAR DIAGNOSTICO
                    $('#formulario_agregar_hospitalizacion #label_actualizar_diagnostico').html('¿Actualizar Diagnostico?');
                    $('#formulario_agregar_hospitalizacion #diagnostico_ultimo').show();						
				    //RECETA
                    $('#formulario_agregar_hospitalizacion #receta_label').html("¿Crear Receta?");				
                    $('#formulario_agregar_hospitalizacion #label_receta_si').html('Sí');	
                    $('#formulario_agregar_hospitalizacion #label_receta_no').html('No');						
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas").html("Recetas");
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas").html("");	
                    $('#formulario_agregar_hospitalizacion #receta_si').show();	
                    $('#formulario_agregar_hospitalizacion #receta_no').show();	
				    //USUARIO CRONICO
			        $('#formulario_agregar_hospitalizacion #cronico_label').html("¿Crónico?");
                    $('#formulario_agregar_hospitalizacion #label_cronico_si').html('Sí');	
                    $('#formulario_agregar_hospitalizacion #label_cronico_no').html('No');	
				    $('#formulario_agregar_hospitalizacion #cronico_si').show();
				    $('#formulario_agregar_hospitalizacion #cronico_no').show();	
                    $('#formulario_agregar_hospitalizacion #cronico_si').show();
					$('#formulario_agregar_hospitalizacion #cronico_no').show();					
			    }else{	
				    //ALTA MEDICA
                    $('#formulario_agregar_hospitalizacion #label_altamedica').html('');	
                    $('#formulario_agregar_hospitalizacion #label_altaexigida').html('');
                    $('#formulario_agregar_hospitalizacion #alta_medica').hide();	
                    $('#formulario_agregar_hospitalizacion #alta_exigida').hide();
                    $('#formulario_agregar_hospitalizacion #label_actualizar_diagnostico').hide();					
				    //ACTUALIZAR DIAGNOSTICO
                    $('#formulario_agregar_hospitalizacion #label_actualizar_diagnostico').html('¿Actualizar Diagnostico?');
                    $('#formulario_agregar_hospitalizacion #diagnostico_ultimo').hide();	
                    //RECTA					
                    $('#formulario_agregar_hospitalizacion #receta_label1').html("");				
                    $('#formulario_agregar_hospitalizacion #label_receta_si1').html('');	
                    $('#formulario_agregar_hospitalizacion #label_receta_no1').html('');						
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas1").html("");
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas1").html("");
                    $('#formulario_agregar_hospitalizacion #receta_si').hide();
					$('#formulario_agregar_hospitalizacion #receta_no').hide();						
                    //USUARIO CRONICO					
			        $('#formulario_agregar_hospitalizacion #cronico_label').hide();
                    $('#formulario_agregar_hospitalizacion #label_cronico_si').html('');	
                    $('#formulario_agregar_hospitalizacion #label_cronico_no').html('');	
				    $('#formulario_agregar_hospitalizacion #cronico_no').hide();
                    $('#formulario_agregar_hospitalizacion #cronico_si').hide();
					$('#formulario_agregar_hospitalizacion #cronico_no').hide();					
			    }	  
			  
			    getRespuestaFormulario();
				
				$('#agregar_hospitalizacion').modal({
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
			text: "Este usuario se encuentra en Alta-Ocupado(a)",
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

function getEstadoCama(hosp_id){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getEstadoCama.php';
	var dato;
	var dataString = 'hosp_id='+hosp_id;
	
	$.ajax({
	    type:'POST',
		url:url,
		data: dataString,
		async: false,
		success:function(data){	
          dato = data;			  		  		  			  
		}
	});
	return dato;	
}

function getUsuarioSistema(){
    var url = '<?php echo SERVERURL; ?>php/sesion/sistema_tipo_usuario.php';
	var usuario;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){	
          usuario = data;			  		  		  			  
		}
	});
	return usuario;
}

function getPatologia1(){
  var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_hospitalizacion #patologia1').html("");
				$('#formulario_agregar_hospitalizacion #patologia1').html(data);
		}	
   });
   return false;		
}

function getPatologia2(){
  var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_hospitalizacion #patologia2').html("");
				$('#formulario_agregar_hospitalizacion #patologia2').html(data);
		}	
   });
   return false;		
}

function getPatologia3(){
  var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_hospitalizacion #patologia3').html("");
				$('#formulario_agregar_hospitalizacion #patologia3').html(data);
		}	
   });
   return false;		
}

function getServicioTransito(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/servicios_transito.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_hospitalizacion #transito_servicio_recibida').html("");
			$('#formulario_agregar_hospitalizacion #transito_servicio_recibida').html(data);
		    $('#formulario_agregar_hospitalizacion #transito_servicio_enviada').html("");
			$('#formulario_agregar_hospitalizacion #transito_servicio_enviada').html(data);		
        }
     });		
}

$(document).ready(function() {
	  $('#formulario_agregar_hospitalizacion #transito_servicio_recibida').on('change', function(){
		var servicio_id = $('#formulario_agregar_hospitalizacion #transito_servicio_recibida').val();
        var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_agregar_hospitalizacion #transito_unidad_recibida').html("");
				$('#formulario_agregar_hospitalizacion #transito_unidad_recibida').html(data);
			
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#formulario_agregar_hospitalizacion #transito_servicio_enviada').on('change', function(){
		var servicio_id = $('#formulario_agregar_hospitalizacion #transito_servicio_enviada').val();
        var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_agregar_hospitalizacion #transito_unidad_enviada').html("");
				$('#formulario_agregar_hospitalizacion #transito_unidad_enviada').html(data);				
            }
         });
		 
      });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #transito_unidad_recibida').on('change', function(){
		$("#formulario_agregar_hospitalizacion #transito_motivo_recibida").attr('readonly', false);
		$("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
        $("#formulario_agregar_hospitalizacion #transito_motivo_recibida").focus();			
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #transito_unidad_enviada').on('change', function(){
		$("#formulario_agregar_hospitalizacion #transito_motivo_enviada").attr('readonly', false);
		$("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
        $("#formulario_agregar_hospitalizacion #transito_motivo_enviada").focus();			
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #patologia1').on('change', function(){
		$("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
        $("#formulario_agregar_hospitalizacion #observaciones").focus();			
    });					
});

function getNivel(){
    var url = '<?php echo SERVERURL; ?>php/referencias/getNivel.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_hospitalizacion #nivel').html("");
			$('#formulario_agregar_hospitalizacion #nivel').html(data);
		    $('#formulario_agregar_hospitalizacion #nivel_e').html("");
			$('#formulario_agregar_hospitalizacion #nivel_e').html(data);		
        }
     });		
}

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #nivel').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
       		
		var nivel = $('#formulario_agregar_hospitalizacion #nivel').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_agregar_hospitalizacion #centro').html("");
			  $('#formulario_agregar_hospitalizacion #centro').html(data);		  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #centro').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       		
		var nivel = $('#formulario_agregar_hospitalizacion #nivel').val();
		var centro = $('#formulario_agregar_hospitalizacion #centro').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_agregar_hospitalizacion #centroi').html("");
			  $('#formulario_agregar_hospitalizacion #centroi').html(data);	
              $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
              $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #nivel_e').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentro.php';
       		
		var nivel = $('#formulario_agregar_hospitalizacion #nivel_e').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel,
		   success:function(data){
		      $('#formulario_agregar_hospitalizacion #centro_e').html("");
			  $('#formulario_agregar_hospitalizacion #centro_e').html(data);			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #centro_e').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getCentroNombre.php';
       		
		var nivel = $('#formulario_agregar_hospitalizacion #nivel_e').val();
		var centro = $('#formulario_agregar_hospitalizacion #centro_e').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'nivel='+nivel+'&centro='+centro,
		   success:function(data){
		      $('#formulario_agregar_hospitalizacion #centroi_e').html("");
			  $('#formulario_agregar_hospitalizacion #centroi_e').html(data);
              $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
              $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #motivo').on('change', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi").val()!="" && $("#formulario_agregar_hospitalizacion #motivo").val()!="" && $("#formulario_agregar_hospitalizacion #nivel").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);			
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);	
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #motivo_e').on('change', function(){
	    if($("#formulario_agregar_hospitalizacion #nivel").val()!="" && $("#formulario_agregar_hospitalizacion #centro").val()!="" && $("#formulario_agregar_hospitalizacion #centroi").val()!="" && $("#formulario_agregar_hospitalizacion #motivo").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);	
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #diagnostico_clinico').on('blur', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi_e").val()!="" && $("#formulario_agregar_hospitalizacion #nivel_e").val()!="" && $("#formulario_agregar_hospitalizacion #diagnostico_clinico").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);	
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);			
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);	
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #centroi').on('keypress', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi").val()!="" && $("#formulario_agregar_hospitalizacion #motivo").val()!="" && $("#formulario_agregar_hospitalizacion #nivel").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);	
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);			
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);	
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #motivo_traslado').on('change', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi").val()!="" && $("#formulario_agregar_hospitalizacion #motivo_traslado").val()!="" && $("#formulario_agregar_hospitalizacion #nivel").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);	
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #diagnostico_clinico').on('keypress', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi_e").val()!="" && $("#formulario_agregar_hospitalizacion #nivel_e").val()!="" && $("#formulario_agregar_hospitalizacion #diagnostico_clinico").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);			
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #centroi_e').on('keypress', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi_e").val()!="" && $("#formulario_agregar_hospitalizacion #motivo_e").val()!="" && $("#formulario_agregar_hospitalizacion #nivel_e").val()!="" && $("#formulario_agregar_hospitalizacion #diagnostico_clinico").val()!="" && $("#formulario_agregar_hospitalizacion #motivo_traslado").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
            $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);			
		}  
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #motivo_e1').on('change', function(){
	    if($("#formulario_agregar_hospitalizacion #centroi_e").val()!="" && $("#formulario_agregar_hospitalizacion #nivel_e").val()!="" && $("#formulario_agregar_hospitalizacion #motivo_traslado").val()!=""){
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);	
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		}else{
			$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);	
			$("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		}   
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #centroi').on('change', function(){
	   $("#formulario_agregar_hospitalizacion #motivo").attr('readonly', false); 
       $("#formulario_agregar_hospitalizacion #clinico").attr('readonly', false); 	   
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #centroi_e').on('change', function(){
	   $("#formulario_agregar_hospitalizacion #diagnostico_clinico").attr('readonly', false); 
       $("#formulario_agregar_hospitalizacion #motivo_e").attr('readonly', false); 	   
    });					
});

function agregarHospitalizacionPorUsuario(){
	var fecha = $('#form_main #fecha_b').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/agregarHospitalizacionporUsuario.php';
	
   if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');		
		return false;	   
   }else{	
	if ( fecha <=  fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_hospitalizacion').serialize(),
		  success: function(registro){
			if (registro == 1){
			   $('#formulario_agregar_hospitalizacion')[0].reset();
			   $('#formulario_agregar_hospitalizacion #pro').val('Registro');
			   clean();	
			   clean1();
				swal({
					title: 'Success', 
					text: 'Registro almacenado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
			   pagination(1);			   		  
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
					text: "No se puedo procesar esta solicitud. Por favor intentelo de nuevo más tarde",
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
        $('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');				
		return false;
	}
   }
}

function agregarHospitalizacion(){
	var fecha = $('#form_main #fecha_b').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/agregarHospitalizacion.php';
	
   if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
		$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');		
		return false;	   
   }else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_hospitalizacion').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_hospitalizacion')[0].reset();
				clean();	
				$('#formulario_agregar_hospitalizacion #pro').val('Registro');
				swal({
					title: 'Success', 
					text: 'Registro almacenado correctamente',
					type: 'success',
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				pagination(1);			   		 
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
					text: "No se puedo procesar esta solicitud, por favor intentelo de nuevo más tarde",
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
   
function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function limpiar(){		
	$('#bs-regis').val|("");
    $('#agrega-registros').html("");
	$('#pagination').html("");		
    getSalaFormMain();
	pagination(1);
} 


$('#formulario_agregar_hospitalizacion #reg').on('click', function(e){
	 if ($('#formulario_agregar_hospitalizacion #patologia1').val() == "" || $('#formulario_agregar_hospitalizacion #paciente').val() == "" ){
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
		if($("#formulario_agregar_hospitalizacion #receta_si").is(':checked')) {  			
            if($('#formulario_agregar_hospitalizacion #medicamento1').val() != "" && $('#formulario_agregar_hospitalizacion #via1').val() != "" && $('#formulario_agregar_hospitalizacion #frecuencia1').val() != "" && $('#formulario_agregar_hospitalizacion #cantidad1').val() != ""){
				 e.preventDefault();
				 agregarHospitalizacionPorUsuario();				
			}else{
					swal({
						title: "Error", 
						text: "Los campos de la receta estan vacíos, por favor corregir. Debe por lo menos rellenar la primera fila para los medicamentos",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});			
					return false;				
			}
        }else{
		   e.preventDefault();
		   agregarHospitalizacionPorUsuario();			
		}	
	 } 		 
});

$('#formulario_agregar_hospitalizacion #edi').on('click', function(e){
	 if ($('#formulario_agregar_hospitalizacion #patologia1').val() == "" || $('#formulario_agregar_hospitalizacion #servicio_consulta').val() == "" || 
	     $('#formulario_agregar_hospitalizacion #paciente').val() == "" ){
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
		if($("#formulario_agregar_hospitalizacion #receta_si").is(':checked')) { 			
            if($('#formulario_agregar_hospitalizacion #medicamento1').val() != "" && $('#formulario_agregar_hospitalizacion #via1').val() != "" && $('#formulario_agregar_hospitalizacion #frecuencia1').val() != "" && $('#formulario_agregar_hospitalizacion #cantidad1').val() != ""){
				 e.preventDefault();
				 agregarHospitalizacion();
			}else{
					swal({
						title: "Error", 
						text: "Los campos de la receta estan vacíos, por favor corregir. Debe por lo menos rellenar la primera fila para los medicamentos",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});					 
					return false;				
			}		 				
	    }else{
				 e.preventDefault();
				 agregarHospitalizacion();			
		} 
	 }	 
});

function nosePresntoRegistro(hosp_id,expediente,servicio_id, estado, pacientes_id){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8){

	var estado_cama = 0;
	
	if ($('#form_main #estado').val() == ""){
		estado_cama = estado;
	}else{
		estado_cama = $('#form_main #estado').val();
	}
	
	  var nombre_usuario = consultarNombre(pacientes_id);
      var expediente_usuario = consultarExpediente(pacientes_id);
      var dato;

      if(expediente_usuario == 0){
          dato = nombre_usuario;
      }else{
	      dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
      }		
	
  if(estado_cama == 0){
	swal({
		title: "Error", 
		text: "La cama se encuentra ocupada, no se puede ejecutar esta acción",
		type: "error", 
		confirmButtonClass: "btn-danger",
		allowEscapeKey: false,
		allowOutsideClick: false
	});		 
  }else{
		$('#form_ausencia #dato').val(id);
		$('#form_ausencia #motivo_ausencia').val("");
	  
		$('#eliminar #hosp_id').val(hosp_id);
		$('#eliminar #expediente').val(expediente);
		$('#eliminar #servicio_id').val(servicio_id);

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
			eliminarRegistro(id,inputValue);
			swal.close();
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

//ELIMINA EL REGISTRO DE LA LISTA SOLO CUANDO UN USAURIO FALTO A SU CITA
function eliminarRegistro(id, comentario){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/usuario_no_presento.php';	
	var hosp_id = $('#eliminar #hosp_id').val();
	var expediente = $('#eliminar #expediente').val();
	var servicio_id = $('#eliminar #servicio_id').val();
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
		$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');		
		return false;	   
   }else{		
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'fecha='+fecha+'&hosp_id='+hosp_id+'&expediente='+expediente+'&servicio_id='+servicio_id+'&comentario='+comentario,
		  success: function(registro){
		    if(registro==1){
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
			}else if(registro==3){	
				swal({
					title: "Error", 
					text: "Este registro ya tiene almacenada una ausencia",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});
				return false;
			}else{
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

function getServicio(){
  var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getServicios.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_hospitalizacion #servicio_consulta').html("");
				$('#formulario_agregar_hospitalizacion #servicio_consulta').html(data);
				
				$('#formulario_ata_familiares #servicio').html("");
				$('#formulario_ata_familiares #servicio').html(data);				
		}	
   });
   return false;		
}

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #servicio_consulta').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/atas/buscar_usuario_ata.php';
        var expediente = $('#formulario_agregar_hospitalizacion #expediente').val();
        var servicio = $('#formulario_agregar_hospitalizacion #servicio_consulta').val();	
        var fecha = $('#formulario_agregar_hospitalizacion #fecha').val();	
	
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente+'&servicio='+servicio,
		   success:function(data){
			  var array = eval(data);
			  $('#formulario_agregar_hospitalizacion #paciente').val(array[0]); 

		     if (array[0] == 'N'){
					swal({
						title: "Error", 
						text: "Este es un usuario nuevo, tiene referencia, favor llenarla antes de guardar el registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					}); 
					$("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		     }else if (array[0] == 'S'){
			     $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
	         }else if (array[0] == 'Familiar'){
					swal({
						title: "Error", 
						text: "Este es un usuario Familiar, por favor corregir",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});				 
					$("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
	         }else{
		         $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		         $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		     }			  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
 	$('#nuevo-registro').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8){
		  if(getPuesto() == 2 || getPuesto() == 4){
			  clean();
			  $('#formulario_agregar_hospitalizacion #expediente1').hide();
			  $('#formulario_agregar_hospitalizacion #expediente').show();
			  $('#formulario_agregar_hospitalizacion')[0].reset();	
     	      $('#formulario_agregar_hospitalizacion #pro').val('Registro');		  
		      $('#formulario_agregar_hospitalizacion #edi').show();
		      $('#formulario_agregar_hospitalizacion #reg').hide();		  	  
		      $('#formulario_agregar_hospitalizacion #servicio_grupo_label').show();
			  $('#formulario_agregar_hospitalizacion #servicio_grupo').show();
		      $("#formulario_agregar_hospitalizacion #expediente").attr('readonly', false);
		      $("#formulario_agregar_hospitalizacion #paciente").attr('readonly', true);
		      $('#formulario_agregar_hospitalizacion #alta_exigida').prop('checked', false); //DESELECCIONA UN CHECK BOX
		      $('#formulario_agregar_hospitalizacion #alta_medica').prop('checked', false); //DESELECCIONA UN CHECK BOX	
              $('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');	
			  $('#formulario_agregar_hospitalizacion #fecha').val($('#form_main #fecha_b').val());				  
			  $('#formulario_agregar_hospitalizacion #ihss').val(2);		

              $('#formulario_agregar_hospitalizacion #suicida_label').html("¿Conducta Suicida?");				
              $('#formulario_agregar_hospitalizacion #label_suicida_si').html('Sí');	
              $('#formulario_agregar_hospitalizacion #label_suicida_no').html('No');	
			  $('#formulario_agregar_hospitalizacion #suicida_si').show();	
              $('#formulario_agregar_hospitalizacion #suicida_no').show();			  
              getRespuestaFormulario();			  
			  
			  //EVALUAR SI ES MEDICO PARA MOSTRAR RECETA
			  if(getPuesto() == 2 || getPuesto() == 10){	
				    //ALTA MEDICA
                    $('#formulario_agregar_hospitalizacion #label_altamedica').html('');	
                    $('#formulario_agregar_hospitalizacion #label_altaexigida').html('');
                    $('#formulario_agregar_hospitalizacion #alta_medica').hide();	
                    $('#formulario_agregar_hospitalizacion #alta_exigida').hide();						
				    //ACTUALIZAR DIAGNOSTICO
                    $('#formulario_agregar_hospitalizacion #label_actualizar_diagnostico').html('');
                    $('#formulario_agregar_hospitalizacion #diagnostico_ultimo').hide();						
				    //RECETA
                    $('#formulario_agregar_hospitalizacion #receta_label').html("¿Crear Receta?");				
                    $('#formulario_agregar_hospitalizacion #label_receta_si').html('Sí');	
                    $('#formulario_agregar_hospitalizacion #label_receta_no').html('No');						
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas").html("Recetas");
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas").html("");	
                    $('#formulario_agregar_hospitalizacion #receta_si').show();	
                    $('#formulario_agregar_hospitalizacion #receta_no').show();	
				    //USUARIO CRONICO
			        $('#formulario_agregar_hospitalizacion #cronico_label').html("¿Crónico?");
                    $('#formulario_agregar_hospitalizacion #label_cronico_si').html('Sí');	
                    $('#formulario_agregar_hospitalizacion #label_cronico_no').html('No');	
				    $('#formulario_agregar_hospitalizacion #cronico_si').show();
				    $('#formulario_agregar_hospitalizacion #cronico_no').show();						
			  }else{	
				    //ALTA MEDICA
                    $('#formulario_agregar_hospitalizacion #label_altamedica').html('');	
                    $('#formulario_agregar_hospitalizacion #label_altaexigida').html('');
                    $('#formulario_agregar_hospitalizacion #alta_medica').hide();	
                    $('#formulario_agregar_hospitalizacion #alta_exigida').hide();						
				    //ACTUALIZAR DIAGNOSTICO
                    $('#formulario_agregar_hospitalizacion #label_actualizar_diagnostico').html('¿Actualizar Diagnostico?');
                    $('#formulario_agregar_hospitalizacion #diagnostico_ultimo').show();	
                    //RECTA					
                    $('#formulario_agregar_hospitalizacion #receta_label1').html("");				
                    $('#formulario_agregar_hospitalizacion #label_receta_si1').html('');	
                    $('#formulario_agregar_hospitalizacion #label_receta_no1').html('');						
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas1").html("");
			        $("#formulario_agregar_hospitalizacion #label_titulo_recetas1").html("");	
                    $('#formulario_agregar_hospitalizacion #receta_si1').hide();	
                    $('#formulario_agregar_hospitalizacion #receta_no1').hide();
                    //USUARIO CRONICO					
			        $('#formulario_agregar_hospitalizacion #cronico_label').hide();
                    $('#formulario_agregar_hospitalizacion #label_cronico_si').html('');	
                    $('#formulario_agregar_hospitalizacion #label_cronico_no').html('');	
				    $('#formulario_agregar_hospitalizacion #cronico_no').hide();						
			  }	  
				
		      $('#agregar_hospitalizacion').modal({
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
});

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_agregar_hospitalizacion #expediente').on('blur', function(){
	 if($('#formulario_agregar_hospitalizacion #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/hospitalizacion/buscar_expediente.php';
        var expediente = $('#formulario_agregar_hospitalizacion #expediente').val();
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
					getPatologia1();
					getPatologia2();
					getPatologia3();
					getServicio();
					getServicioTransito();
					getNivel();
					$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
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
					getPatologia1();
					getPatologia2();
					getPatologia3();
					getServicio();
					getServicioTransito();
					getNivel();
					$("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
					return false;
			  }else{
			     $('#formulario_agregar_hospitalizacion #nombre').val(array[0]);
	             getPatologia1();
	             getPatologia2();
	             getPatologia3();
	             getServicio();
	             getServicioTransito();
	             getNivel();
                 $('#formulario_agregar_hospitalizacion #localidad').val(array[3]);	 
	             $('#formulario_agregar_hospitalizacion #ihss').html("");	
	             $('#formulario_agregar_hospitalizacion #ihss1').html("");					 
	             getRespuestaFormulario();				 
			  }		  			  
		  }
	  });
	  return false;		
	 }else{
		$('#formulario_agregar_hospitalizacion')[0].reset();	
		$('#formulario_agregar_hospitalizacion #pro').val('Registro');
        $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);		
	 }
	});
});

function pagination_busqueda_historial(partida){
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/buscar_historial.php';
    var dato = $('#form-buscarhistorial #bs-regis-historial').val();
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato,
		success:function(data){
			var array = eval(data);
			$('#form-buscarhistorial #agrega-registros_historial').html(array[0]);
			$('#form-buscarhistorial #pagination_historial').html(array[1]);
		}
	});
	return false;
}

$(document).ready(function() {
	$('#form-buscarhistorial #bs-regis-historial').on('keyup',function(){      
	    pagination_busqueda_historial(1);
		$("#edi").attr('disabled', false);
   	    return false;
    });	
});

$('#historial').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8 ){
		e.preventDefault();
		 $('#form-buscarhistorial')[0].reset();
		 pagination_busqueda_historial(1);	 
		 $('#buscarHistorial').modal({
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

function modalTransferir(hosp_id,estado, expediente, pacientes_id){
if(getPuesto() == 2 || getPuesto() == 4){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8){
	   
	  var estado_cama = 0;
	
	  if ($('#form_main #estado').val() == ""){
		  estado_cama = estado;
	  }else{
		 estado_cama = $('#form_main #estado').val();
	 }
	
	  var nombre_usuario = consultarNombre(pacientes_id);
      var expediente_usuario = consultarExpediente(pacientes_id);
      var dato;

      if(expediente_usuario == 0){
          dato = nombre_usuario;
      }else{
	      dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
      }	
	
      if(estado_cama == 3){
		swal({
			title: "Error", 
			text: "Esta cama se encuentra en Alta-Ocupado(a), no se puede transferir el usuario. " + dato + "",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		 
	  }else{
		 $('#transferir #hosp_id').val(hosp_id);
		 $('#transferir #myModalLabel').html("¿Desea enviar este usuario <b>" + dato + "</b> a Psicología?");
	
	     $('#transferir').modal({
		    show:true,
			keyboard: false,
		    backdrop:'static'
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
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});					 
   }   
}

function modalAlta(hosp_id, estado, expediente, pacientes_id){
if(getPuesto() == 2 || getPuesto() == 4){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8){	
   
	var estado_cama = 0;
	
	if ($('#form_main #estado').val() == ""){
		estado_cama = estado;
	}else{
		estado_cama = $('#form_main #estado').val();
	}	var estado_cama = 0;
	
	if ($('#form_main #estado').val() == ""){
		estado_cama = estado;
	}else{
		estado_cama = $('#form_main #estado').val();
	}
	
	  var nombre_usuario = consultarNombre(pacientes_id);
      var expediente_usuario = consultarExpediente(pacientes_id);
      var dato;

      if(expediente_usuario == 0){
          dato = nombre_usuario;
      }else{
	      dato = nombre_usuario + " (Expediente: " + expediente_usuario + ")";
      }		
	
     if(estado_cama == 3){
		$('#modal_alta #hosp_id').val(hosp_id);
		$('#modal_alta #myModalLabel').html("El usuario <b>" + dato + "</b> abandono el tratamiento?");
	
	    $('#modal_alta').modal({
		   show:true,
		   keyboard: false,
		   backdrop:'static'
	    });
	 }else{
		swal({
			title: "Error", 
			text: "Este usuario se encuentra hospitalizado, no se puede realizar esta acción",
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
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});						 
   }   
}

function transferir(){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/transferir.php';
	var hosp_id = $('#transferir #hosp_id').val();

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
		$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');		
		return false;	   
   }else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'fecha='+fecha+'&hosp_id='+hosp_id,
		  success: function(registro){
		    if(registro==1){	
				swal({
					title: "Success", 
					text: "Registro enviado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});			
			    pagination(1);
			   return false;
			}else if(registro==3){
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

function altaAbandono(){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/agregarAltaAbandono.php';
	var hosp_id = $('#modal_alta #hosp_id').val();

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
		$('#formulario_agregar_hospitalizacion .nav-tabs li:eq(0) a').tab('show');		
		return false;	   
   }else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'fecha='+fecha+'&hosp_id='+hosp_id,
		  success: function(registro){
		    if(registro==1){
				swal({
					title: "Success", 
					text: "Registro dado de alta correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});			   
			   pagination(1);
			  return false;
			}else if(registro==3){	
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

function getPuesto(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getPuesto.php';
	var puesto;
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){	
          puesto = data;			  		  		  			  
		}
	});
	return puesto;
}

//FUNCION PARA LOS ASEGURADOS DEL IHSS
function getRespuestaFormulario(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getRespuesta.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_hospitalizacion #ihss').html("");
			$('#formulario_agregar_hospitalizacion #ihss').html(data);	
		    $('#formulario_agregar_hospitalizacion #ihss1').html("");
			$('#formulario_agregar_hospitalizacion #ihss1').html(data);					
		}			
     });		
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

function evaluarRegistrosPendientes(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/evaluarPendientes.php';
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
					text: "Se le recuerda que tiene " + datos[0] + " " + string + " de subir al ATA de Hospitalización en este mes de" + datos[1] + ". Debe revisar sus registros pendientes para todos los servicios", 
					type: 'warning', 
					confirmButtonClass: 'btn-warning',
					allowEscapeKey: false,
					allowOutsideClick: false
			  });			  
		   }
           		  		  		  			  
		}
	});	
}

function evaluarRegistrosPendientesEmail(){
    var url = '<?php echo SERVERURL; ?>php/mail/evaluarPendientes.php';
	
	$.ajax({
	    type:'POST',
		url:url,
		success: function(valores){	
           		  		  		  			  
		}
	});	
}

function getEnfermedadad(){
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getEnfermedad.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_hospitalizacion #enfermedad').html("");
			$('#formulario_agregar_hospitalizacion #enfermedad').html(data);
		    $('#formulario_agregar_hospitalizacion #enfermedad').html("");
			$('#formulario_agregar_hospitalizacion #enfermedad').html(data);		
		}			
     });		
}

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #alta_medica').on('click', function(){
		$('#formulario_agregar_hospitalizacion #diagnostico_ultimo').prop('checked', true); //DESELECCIONA UN CHECK BOX				
    });					
});

$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #alta_exigida').on('click', function(){
		$('# #diagnostico_ultimo').prop('checked', true); //DESELECCIONA UN CHECK BOX				
    });					
});

function getMotivoTraslado(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTraslado.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_hospitalizacion #motivo').html("");
			$('#formulario_agregar_hospitalizacion #motivo').html(data);	

		    $('#formulario_agregar_hospitalizacion #motivo_traslado').html("");
			$('#formulario_agregar_hospitalizacion #motivo_traslado').html(data);			
		}			
     });		
}

function getMotivoTrasladoOtros(){
    var url = '<?php echo SERVERURL; ?>php/atas/getMotivoTrasladoOtros.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_hospitalizacion #motivo_e').html("");
			$('#formulario_agregar_hospitalizacion #motivo_e').html(data);
		    $('#formulario_agregar_hospitalizacion #motivo_e1').html("");
			$('#formulario_agregar_hospitalizacion #motivo_e1').html(data);			
		}			
     });		
}

//TRANSITO RECIBIDAS
$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #transito_unidad_recibida').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';
       	
        var servicio = $('#formulario_agregar_hospitalizacion #transito_servicio_recibida').val();		
		var puesto_id = $('#formulario_agregar_hospitalizacion #transito_unidad_recibida').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'puesto_id='+puesto_id+'&servicio='+servicio,
		   success:function(data){
		      $('#formulario_agregar_hospitalizacion #transito_profesional_recibida').html("");
			  $('#formulario_agregar_hospitalizacion #transito_profesional_recibida').html(data);
		  }
	  });
	  return false;			 				
    });					
});

//TRANSITO ENVIADAS
$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #transito_unidad_enviada').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/referencias/getMedico.php';
       	
        var servicio = $('#formulario_agregar_hospitalizacion #transito_servicio_enviada').val();		
		var puesto_id = $('#formulario_agregar_hospitalizacion #transito_unidad_enviada').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'puesto_id='+puesto_id+'&servicio='+servicio,
		   success:function(data){
		      $('#formulario_agregar_hospitalizacion #transito_profesional_enviada').html("");
			  $('#formulario_agregar_hospitalizacion #transito_profesional_enviada').html(data);				  
		  }
	  });
	  return false;			 				
    });					
});

//INICIO TRABAJO SOCIAL
function getTipoAtención(){
    var url = '<?php echo SERVERURL; ?>php/atas/getTipoAtencion.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_hospitalizacion #tipo_atencion_enviadas').html("");
			$('#formulario_agregar_hospitalizacion #tipo_atencion_enviadas').html(data);			
		}			
     });		
}

//EVALUA SI SE SELECCIONA EL RADIO BOTON DE RECETAS EL EL FORMULARIO
//formulario_agregar_hospitalizacion
//SÍ
$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #receta_si').on('click', function(){
		$("#formulario_agregar_hospitalizacion #label_titulo_recetas").html("Recetas");	
        $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);		
    });					
});

//NO
$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #receta_no').on('click', function(){
		$("#formulario_agregar_hospitalizacion #label_titulo_recetas").html("");
		$("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
    });	
});	

function getVia(){
    var url = '<?php echo SERVERURL; ?>php/atas/getVia.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_hospitalizacion #via1').html("");
			$('#formulario_agregar_hospitalizacion #via1').html(data);

		    $('#formulario_agregar_hospitalizacion #via2').html("");
			$('#formulario_agregar_hospitalizacion #via2').html(data);

		    $('#formulario_agregar_hospitalizacion #via3').html("");
			$('#formulario_agregar_hospitalizacion #via3').html(data);

		    $('#formulario_agregar_hospitalizacion #via4').html("");
			$('#formulario_agregar_hospitalizacion #via4').html(data);

		    $('#formulario_agregar_hospitalizacion #via5').html("");
			$('#formulario_agregar_hospitalizacion #via5').html(data);	
		}			
     });		
}

function getMedicamentos(){
    var url = '<?php echo SERVERURL; ?>php/postclinica/getMedicamentos.php';
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#formulario_agregar_hospitalizacion #medicamento1').html("");
			$('#formulario_agregar_hospitalizacion #medicamento1').html(data);

		    $('#formulario_agregar_hospitalizacion #medicamento2').html("");
			$('#formulario_agregar_hospitalizacion #medicamento2').html(data);

		    $('#formulario_agregar_hospitalizacion #medicamento3').html("");
			$('#formulario_agregar_hospitalizacion #medicamento3').html(data);

		    $('#formulario_agregar_hospitalizacion #medicamento4').html("");
			$('#formulario_agregar_hospitalizacion #medicamento4').html(data);

		    $('#formulario_agregar_hospitalizacion #medicamento5').html("");
			$('#formulario_agregar_hospitalizacion #medicamento5').html(data);	
		}			
     });		
}

//EVALUAMOS QUE SE HAN INGRESADO VALORES EN LA PRIMERA FILA DE LA RECETA
$(document).ready(function() {
	$('#formulario_agregar_hospitalizacion #medicamento1').on('change', function(){
		 if($('#formulario_agregar_hospitalizacion #medicamento1') == "" && $('#formulario_agregar_hospitalizacion #via1') == "" && $('#formulario_agregar_hospitalizacion #frecuencia1') == "" && $('#formulario_agregar_hospitalizacion #cantidad1') == ""){
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		    $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
		 }else{
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		 }		
    });	

	$('#formulario_agregar_hospitalizacion #via1').on('change', function(){
		 if($('#formulario_agregar_hospitalizacion #via1') == "" && $('#formulario_agregar_hospitalizacion #medicamento1') == "" && $('#formulario_agregar_hospitalizacion #frecuencia1') == "" && $('#formulario_agregar_hospitalizacion #cantidad1') == ""){
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
		 }else{
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		 }		
    });	

	$('#formulario_agregar_hospitalizacion #frecuencia1').on('blur', function(){
		 if($('#formulario_agregar_hospitalizacion #frecuencia1') == "" && $('#formulario_agregar_hospitalizacion #medicamento1') == "" && $('#formulario_agregar_hospitalizacion #via1') == "" && $('#formulario_agregar_hospitalizacion #cantidad1') == ""){
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
		 }else{
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		 }		
    });	

	$('#formulario_agregar_hospitalizacion #cantidad1').on('blur', function(){
		 if($('#formulario_agregar_hospitalizacion #cantidad1') == "" && $('#formulario_agregar_hospitalizacion #medicamento1') == "" && $('#formulario_agregar_hospitalizacion #via1') == "" && $('#formulario_agregar_hospitalizacion #frecuencia1') == ""){
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
		 }else{
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		 }		
    });	

	$('#formulario_agregar_hospitalizacion #recomendaciones1').on('blur', function(){
		 if($('#formulario_agregar_hospitalizacion #medicamento1') == "" && $('#formulario_agregar_hospitalizacion #via1') == "" && $('#formulario_agregar_hospitalizacion #frecuencia1') == "" && $('#formulario_agregar_hospitalizacion #cantidad1') == ""){
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', true);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', true);
		 }else{
		   $("#formulario_agregar_hospitalizacion #edi").attr('disabled', false);
		   $("#formulario_agregar_hospitalizacion #reg").attr('disabled', false);
		 }		
    });		
});

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

//INICIO ATA FAMILIARES
function funciones(){
   $('#formulario_ata_familiares')[0].reset();
   $('#formulario_ata_familiares #pro').val("Registro");	
   getServicio();	
}

function consultarServicioAtencionesFamiliares(){	
    var url = '<?php echo SERVERURL; ?>php/hospitalizacion/getServicioAtencionesFamiliares.php';
	var resp;
		
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		success:function(data){	
          resp = data;			  		  		  			  
		}
	});
	return resp;		
}

$(document).ready(function() {
 	$('#nuevo_registro_familiares').on('click',function(){
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9 || getUsuarioSistema() == 3){
		  if(consultarServicioAtencionesFamiliares() != ""){
			  $('#formulario_ata_familiares')[0].reset();	
     	      $('#formulario_ata_familiares #pro').val('Registro');		  		  
              funciones();
		      $('#agregar_ata_familiares').modal({
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
});

$(document).ready(function(e) {
    $('#formulario_ata_familiares #expediente').on('blur', function(){
	 if($('#formulario_ata_familiares #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/hospitalizacion/buscar_expediente_familiares.php';
        var expediente = $('#formulario_ata_familiares #expediente').val();
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
					$("#formulario_ata_familiares #reg").attr('disabled', true);
					return false;
			  }else if (array[0] == "Error_Temporal"){		  
					swal({
						title: "Error", 
						text: "Este usuario normal, solo se permite buscar familiares, por favor verificar con el departamento de Admisión, para más detalles",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#formulario_ata_familiares #reg").attr('disabled', true);
					return false;
			  }else if (array[0] == "Familiar"){		  
					swal({
						title: "Error", 
						text: "Este usuario normal, solo se permite buscar familiares, por favor verificar con el departamento de Admisión, para más detalles",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#formulario_ata_familiares #reg").attr('disabled', true);
				 return false;
			  }else if (array[0] == "Bien"){			     
                 $('#formulario_ata_familiares #nombre').val(array[1]);			  		 
				 $('#formulario_ata_familiares #identidad').val(array[2]);
                 $("#formulario_ata_familiares #reg").attr('disabled', false);
                 $('#formulario_ata_familiares #obs').focus();			 
			  }else{		  
					swal({
						title: "Error", 
						text: "Error, no se puede procesar su consulta, intentenlo nuevamente",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});
					$("#formulario_ata_familiares #reg").attr('disabled', true); 				 
			  }	  			  
		  }
	  });
	  return false;		
	 }else{
		$('#formulario_ata_familiares')[0].reset();
        $('#formulario_ata_familiares #pro').val("Registro");		
        $("#formulario_ata_familiares #reg").attr('disabled', true);				 		
	 }
	});
});

$(document).ready(function() {
	$('#formulario_ata_familiares #servicio').on('change', function(){	
           if($('#formulario_ata_familiares #servicio') != ""){
               $("#formulario_ata_familiares #reg").attr('disabled', false); 			   
		   }else{
			   $("#formulario_ata_familiares #reg").attr('disabled', true); 
		   }		       		 			
    });					
});

$(document).ready(function() {
	$('#formulario_ata_familiares #servicio').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/hospitalizacion/buscar_usuario_ata_familiares.php';
        var expediente = $('#formulario_ata_familiares #expediente').val();
        var servicio = $('#formulario_ata_familiares #servicio').val();	
        var fecha = $('#formulario_ata_familiares #fecha').val();	
	
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'expediente='+expediente+'&servicio='+servicio,
		   success:function(data){
			  var array = eval(data);
			  $('#formulario_ata_familiares #paciente').val(array[0]);
              $("#formulario_ata_familiares #reg").attr('disabled', false);

              if(array[0] == 'Paciente'){
					swal({
						title: "Error", 
						text: "Este es un Usuario normal, no es un Familar, por favor corregir",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey: false,
						allowOutsideClick: false
					});			  
			  }			  
		  }
	  });
	  return false;			 				
    });					
});

$('#formulario_ata_familiares #reg').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_ata_familiares #expediente').val() != "" && $('#formulario_ata_familiares #obs').val() != "" && $('#formulario_ata_familiares #servicio').val() != ""){
		 e.preventDefault();
		 agregaRegistroATAFamiliares();		  
		return false;
	 }else{
		swal({
			title: "Error", 
			text: "No se pueden enviar los datos, los campos estan vacíos",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});		 
		$('#formulario_ata_familiares #pro').val('Registro');
		return false;		 
	 }  	 
});

function agregaRegistroATAFamiliares(){
if($('#formulario_ata_familiares #expediente').val() != "" && $('#formulario_ata_familiares #obs').val() != "" && $('#formulario_ata_familiares #servicio').val() != ""){ 
    var fecha = $('#formulario_ata_familiares #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);

	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/agregar_ata_familiares.php';

    if ($('#formulario_ata_familiares #expediente').val() == "" || $('#formulario_ata_familiares #expediente').val()==0){  
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
		          data:$('#formulario_ata_familiares').serialize(),
		          success: function(registro){
                      if(registro == 1){
							swal({
								title: "Error", 
								text: "Su sesión ha vencido, por favor inicie sesión nuevamente",
								type: "error", 
								confirmButtonClass: "btn-danger",
								allowEscapeKey: false,
								allowOutsideClick: false
							});
						  return false;	
					  }else if(registro == 2){
							$('#formulario_ata_familiares')[0].reset();                            
							swal({
								title: "Success", 
								text: "Registro almacenado correctamente",
								type: "success",
								timer: 3000,
								allowEscapeKey: false,
								allowOutsideClick: false								
							});
							funciones();						  
							return false;							
					  }else if(registro == 3){
							swal({
								title: "Error", 
								text: "Error en almacenar este registro",
								type: "error", 
								confirmButtonClass: "btn-danger",
								allowEscapeKey: false,
								allowOutsideClick: false
							});
					  }else if(registro == 4){
							swal({
								title: "Error", 
								text: "Este usuario ya ha sido almacenado con anterioridad",
								type: "error", 
								confirmButtonClass: "btn-danger",
								allowEscapeKey: false,
								allowOutsideClick: false
							});
					  }else if(registro == 5){
							swal({
								title: "Error", 
								text: "Lo sentimos este usuario no es un Familiar, solo se permiten guardar Familiares",
								type: "error", 
								confirmButtonClass: "btn-danger",
								allowEscapeKey: false,
								allowOutsideClick: false
							});
					  }else{
							swal({
								title: "Error", 
								text: "No se puedo almacenar el registro favor interntar mas tarde",
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
				$('#formulario_ata_familiares')[0].reset();
				return false;
	        }	
		   }			
	      }		  
}else{
		swal({
			title: "Error", 
			text: "No se puede guardar el registro, debe comunicarse el área de admisión, para actualizar los datos del usuario",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});
		return false;
 }
}
/*FIN ATA FAMILIARES*/

function getProgramarCita(){
    var url = '<?php echo SERVERURL; ?>php/atas/getProgramarCita.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){		
		    $('#formulario_agregar_hospitalizacion #programar_cita').html("");
			$('#formulario_agregar_hospitalizacion #programar_cita').html(data);		
		}			
     });		
}

//RECETA MEDICA
function recetaMedica(pacientes_id, agenda_id, expediente){
	if (getUsuarioSistema() == 1 || getUsuarioSistema() == 2 || getUsuarioSistema() == 8 || getUsuarioSistema() == 13 || getUsuarioSistema() == 9 || getUsuarioSistema() == 7){
		if(getPuesto() == 2 || getPuesto() == 10){
			 mensajeMantenimiento("En Desarrollo", "Estamos trabajando para hacer mas placentera la creación de recetas a los usuarios.");
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
			title: "Acceso Denegado", 
			text: "No tiene permisos para ejecutar esta acción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});	
	}
}
</script>