<script>
$(document).ready(function() {
	  $('#form_main #nuevo-registro').on('click',function(e){
		e.preventDefault();
		if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9){
		 limpiarFormulario();
		 $('#reg_postclinica').show();
		 $('#reg_postclinica_edicion').hide();
		 $('#edit_posclinica').hide();		 	 
	     $('#formulario_agregar_postclinica')[0].reset();	
		 $('#formulario_agregar_postclinica #pro').val('Registro');
         $('#formulario_agregar_postclinica #grupo').show();
		 $('#formulario_agregar_postclinica #fecha').val($('#form_main #fecha_i').val());
         $('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
		 $("#formulario_agregar_postclinica #expediente").attr('readonly', false);
         $("#reg_postclinica").attr('disabled', true);	
		 $('#formulario_agregar_postclinica #grupo_profesional_consulta').hide();		 
		 
	     $('#agregar_postclinica').modal({
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
				allowEscapeKey : false,
				allowOutsideClick: false
			});								 
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
});

/*INICIO DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/
$(document).ready(function(){
    $("#agregar_postclinica").on('shown.bs.modal', function(){
        $(this).find('#formulario_agregar_postclinica #expediente').focus();
    });
});
/*FIN DE FUNCIONES PARA ESTABLECER EL FOCUS PARA LAS VENTANAS MODALES*/

$(document).ready(function(e) {
    pagination(1);		 					
	limpiarFormularioMain();
	evaluarRegistrosPendientes();
	getMedicamentos();
	getVia();
});

function limpiarFormularioMain(){
	getServicioFormMain();
	getPatologia();
}

function limpiarFormulario(){
	getPatologia();
	getServicioForm();
	getMedicamentos();
	getVia();	
}

/*VERIFICAR LA EXISTENCIA DEL USUARIO (PACIENTE)*/
$(document).ready(function(e) {
    $('#formulario_agregar_postclinica #expediente').on('blur', function(){
	 if($('#formulario_agregar_postclinica #expediente').val()!=""){
		var url = '<?php echo SERVERURL; ?>php/postclinica/buscar_expediente.php';
        var expediente = $('#formulario_agregar_postclinica #expediente').val();
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
					$('#formulario_agregar_postclinica #pro').val('Registro');
					$("#reg_postclinica").attr('disabled', true);
					return false;
			  }else if (array[0] == "Error1"){
					swal({
						title: "Error", 
						text: "Registro no encontrado",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey : false,
						allowOutsideClick: false
					});	
					$('#formulario_agregar_postclinica #pro').val('Registro');
					$("#reg_postclinica").attr('disabled', true);
				 return false;
			  }else if (array[0] == "Familiar"){
					swal({
						title: "Error", 
						text: "Este usuario es un familiar, solo se permite buscar usuarios, por favor verificar con el departamento de Admisión, para más detalles",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey : false,
						allowOutsideClick: false
					});		  
					$('#formulario_agregar_postclinica #expediente').focus();
					$('#formulario_agregar_postclinica #pro').val('Registro');
					$("#reg_postclinica").attr('disabled', true);
					return false;
			  }else{
   			     $('#formulario_agregar_postclinica #identidad').val(array[0]);
                 $('#formulario_agregar_postclinica #nombre').val(array[1]);	
                 $('#formulario_agregar_postclinica #pro').val('Registro');				 
                 $("#reg_postclinica").attr('disabled', true);				 
			  }		  			  
		  }
	  });
	  return false;		
	 }else{ 
		$('#formulario_agregar_postclinica')[0].reset();	
		$('#formulario_agregar_postclinica #pro').val('Registro');
        $("#reg_postclinica").attr('disabled', true);		
	 }
	});
});

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/postclinica/paginar.php';
	var dato = $('#form_main #bs-regis').val();
	var servicio = '';
	var unidad = '';
	var colaborador = '';
	var fechai = $('#form_main #fecha_i').val();
	var fechaf = $('#form_main #fecha_f').val();
	
	if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if($('#form_main #unidad').val() == "" || $('#form_main #unidad').val() == null){
		unidad = '';
	}else{
		unidad = $('#form_main #unidad').val();
	}
	
	if($('#form_main #colaborador').val() == "" || $('#form_main #colaborador').val() == null){
		colaborador = '';
	}else{
		colaborador = $('#form_main #colaborador').val();
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

function getServicioForm(){
    var url = '<?php echo SERVERURL; ?>php/postclinica/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_postclinica #servicio').html("");
			$('#formulario_agregar_postclinica #servicio').html(data);
		}			
     });		
}

$(document).ready(function() {
	$('#frecuencia1').on('blur', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);	
			$("#edit_posclinica").attr('disabled', false);	
		}else{
			$("#reg_postclinica").attr('disabled', true);	
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#medicamento1').on('blur', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);	
			$("#edit_posclinica").attr('disabled', false);	
		}else{
			$("#reg_postclinica").attr('disabled', true);	
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#dosis1').on('blur', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);	
			$("#edit_posclinica").attr('disabled', false);	
		}else{
			$("#reg_postclinica").attr('disabled', true);	
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#via1').on('blur', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);	
			$("#edit_posclinica").attr('disabled', false);	
		}else{
			$("#reg_postclinica").attr('disabled', true);	
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#recomendaciones1').on('blur', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);	
			$("#edit_posclinica").attr('disabled', false);	
		}else{
			$("#reg_postclinica").attr('disabled', true);	
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#frecuencia1').on('keypress', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);
            $("#edit_posclinica").attr('disabled', false);			
		}else{
			$("#reg_postclinica").attr('disabled', true);
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#medicamento1').on('keypress', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);
            $("#edit_posclinica").attr('disabled', false);			
		}else{
			$("#reg_postclinica").attr('disabled', true);
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#dosis1').on('keypress', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);
            $("#edit_posclinica").attr('disabled', false);			
		}else{
			$("#reg_postclinica").attr('disabled', true);
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#via1').on('keypress', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);
            $("#edit_posclinica").attr('disabled', false);			
		}else{
			$("#reg_postclinica").attr('disabled', true);
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	$('#recomendaciones1').on('keypress', function(){
	    if($("#formulario_agregar_postclinica #medicamento1").val()!="" && $("#formulario_agregar_postclinica #dosis1").val()!="" && $("#formulario_agregar_postclinica #via1").val()!=""){
		    $("#reg_postclinica").attr('disabled', false);
            $("#edit_posclinica").attr('disabled', false);			
		}else{
			$("#reg_postclinica").attr('disabled', true);
			$("#edit_posclinica").attr('disabled', true);
		}  
    });					
});

$(document).ready(function() {
	  $('#formulario_agregar_postclinica #servicio').on('change', function(){
		var servicio_id = $('#formulario_agregar_postclinica #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/postclinica/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#formulario_agregar_postclinica #unidad').html("");
				$('#formulario_agregar_postclinica #unidad').html(data);			
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#formulario_agregar_postclinica #unidad').on('change', function(){
		var servicio = $('#formulario_agregar_postclinica #servicio').val();
		var puesto_id = $('#formulario_agregar_postclinica #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/postclinica/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio+'&puesto_id='+puesto_id,
            success: function(data){
				$('#formulario_agregar_postclinica #colaborador').html("");
				$('#formulario_agregar_postclinica #colaborador').html(data);				
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#form_main #servicio').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/postclinica/getUnidad.php';		
		
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
        var url = '<?php echo SERVERURL; ?>php/postclinica/getMedico.php';		
		
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

/*************************************************/
//FORMULARIOS
function editarRegistro(agenda_id, expediente){
if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9){	
  if(expediente != 0){	
	var url = '<?php echo SERVERURL; ?>php/preclinica/editar.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+agenda_id,
		success: function(valores){
			var datos = eval(valores);
			$('#formulario_agregar_postclinica')[0].reset();
			limpiarFormulario();
			$('#reg_postclinica').hide();
			$('#reg_postclinica_edicion').show();
			$('#edit_posclinica').hide();
			$('#formulario_agregar_postclinica #grupo').hide();
		    $('#formulario_agregar_postclinica #grupo_profesional_consulta').show();			
		    $('#formulario_agregar_postclinica #mensaje').removeClass('error');
		    $('#formulario_agregar_postclinica #mensaje').removeClass('bien');
		    $('#formulario_agregar_postclinica #mensaje').html("");					
			$('#formulario_agregar_postclinica #pro').val('Registro');
			$('#formulario_agregar_postclinica #nombre').val(datos[0]);
            $('#formulario_agregar_postclinica #identidad').val(datos[1]);
            $('#formulario_agregar_postclinica #expediente').val(datos[2]);
			$('#formulario_agregar_postclinica #profesional_consulta').val(datos[3]);
			$('#formulario_agregar_postclinica #fecha').val(datos[4]);
			$("#formulario_agregar_postclinica #expediente").attr('readonly', true);	
            $("#edit_posclinica").attr('disabled', true);			
			$('#formulario_agregar_postclinica #id-registro').val(agenda_id);
			$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
		    $('#formulario_agregar_postclinica #mensaje').removeClass('alerta');
		    $('#formulario_agregar_postclinica #mensaje').removeClass('bien');
		    $('#formulario_agregar_postclinica #mensaje').removeClass('error');
		    $('#formulario_agregar_postclinica #mensaje').html('');
		 
	     	$('#agregar_postclinica').modal({
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
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});			
  }
}else{
	$('#mensaje').modal({
	    show:true,
		keyboard: false,
		backdrop:'static'
	});
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

function getPatologia(){
  var url = '<?php echo SERVERURL; ?>php/postclinica/getPatologia.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
				$('#formulario_agregar_postclinica #patologia1').html("");
				$('#formulario_agregar_postclinica #patologia1').html(data);
		}	
   });
   return false;		
}

$('#reg_postclinica').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_postclinica #expediente').val() == "" ){
		 $('#formulario_agregar_postclinica')[0].reset();	
		swal({
			title: "Error", 
			text: "No se pueden enviar los datos, los campos estan vacíos",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});		   
		return false;
	 }else{
		e.preventDefault();
		agregarPostclinica();		
	 }  
});

$('#reg_postclinica_edicion').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 if ($('#formulario_agregar_postclinica #expediente').val() == "" ){
		 $('#formulario_agregar_postclinica')[0].reset();				
		swal({
			title: "Error", 
			text: "No se pueden enviar los datos, los campos estan vacíos",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});				   
		return false;
	 }else{
		e.preventDefault();
		agregarPostclinicaporUsuario();		
	 }  
});

$('#formulario_agregar_postclinica #addRows').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();		
});

$('#formulario_agregar_postclinica #removeRows').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	e.preventDefault();		
});

function agregarPostclinica(){
if($('#formulario_agregar_postclinica #patologia1').val() != "" && $('#formulario_agregar_postclinica #hora').val() != "" && $('#formulario_agregar_postclinica #servicio').val() != "" && $('#formulario_agregar_postclinica #unidad').val() != "" && $('#formulario_agregar_postclinica #colaborador').val() != ""){	
	var fecha = $('#formulario_agregar_postclinica #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/postclinica/agregarPostclinica.php';
    if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});
		return false;		
	}else{
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_postclinica').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_postclinica')[0].reset();
				$('#formulario_agregar_postclinica #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success", 
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
				limpiarFormulario();
				pagination(1);
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
				return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                limpiarFormulario();
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
			   return false;
			}else if(registro == 3){
				swal({
					title: "Error", 
					text: "El registro no fue almacenado",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});		
                limpiarFormulario();
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
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
                limpiarFormulario();			   
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
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
			allowEscapeKey : false,
			allowOutsideClick: false
		});
		return false;
	 }
    }
   }else{
		swal({
			title: "Error", 
			text: "Hay registros en blanco favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});	   
		$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
		return false;	
   }	 
}
  
function agregarPostclinicaporUsuario(){
if($('#formulario_agregar_postclinica #patologia1').val() != "" && $('#formulario_agregar_postclinica #hora').val() != ""){		
	var fecha = $('#formulario_agregar_postclinica #fecha').val();	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/postclinica/agregarPostclinicaporUsuario.php';
	
    if(getMes(fecha)==2){
		swal({
			title: "Error", 
			text: "No se puede agregar/modificar registros fuera de este periodo",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});
		return false;	
	}else{	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:$('#formulario_agregar_postclinica').serialize(),
		  success: function(registro){
			if (registro == 1){
				$('#formulario_agregar_postclinica')[0].reset();
				$('#formulario_agregar_postclinica #pro').val('Registro');
				swal({
					title: "Success", 
					text: "Registro almacenado correctamente",
					type: "success",
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
				limpiarFormulario();
				pagination(1);
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
				return false;
			}else if(registro == 2){
				swal({
					title: "Error", 
					text: "Este registro ya existe",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                limpiarFormulario();
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
			   return false;
			}else if(registro == 3){
				swal({
					title: "Error", 
					text: "El registro no fue almacenado",
					type: "error", 
					confirmButtonClass: "btn-danger",
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                limpiarFormulario();
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
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
                limpiarFormulario();			   
				$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
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
				    allowEscapeKey : false,
				    allowOutsideClick: false
		});
		return false;
	 }	
	}
   }else{				   			   
		swal({
			title: "Error", 
			text: "Hay registros en blanco favor corregir",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey : false,
			allowOutsideClick: false
		});	   
		$('#formulario_agregar_postclinica .nav-tabs li:eq(0) a').tab('show');	
		return false;	
   }	 
}
  
function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function nosePresntoRegistro(id, pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 8 || getUsuarioSistema() == 9){	 
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
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-warning",
		  confirmButtonText: "¡Sí, remover este registro!",
		  closeOnConfirm: false
		},
		function(){
			eliminarRegistro(id);
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
   }
}

function eliminarRegistro(id){
    var hoy = new Date();
    fecha_actual = convertDate(hoy);
	
	var url = '<?php echo SERVERURL; ?>php/postclinica/usuario_no_presento.php';
	var fecha = $('#form_main #fecha_i').val();	
	
	if ( fecha <= fecha_actual){
	   $.ajax({
		  type:'POST',
		  url:url,
		  data:'id='+id+'&fecha='+fecha,
		  success: function(registro){
			  if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro removido correctamente",
					type: "success",
					timer: 3000,
				    allowEscapeKey : false,
				    allowOutsideClick: false
				});	
                pagination(1);				
			  }else{
					swal({
						title: "Error", 
						text: "Error al remover el registro",
						type: "error", 
						confirmButtonClass: "btn-danger",
						allowEscapeKey : false,
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
			allowEscapeKey : false,
			allowOutsideClick: false
		});
	}
}

$(document).ready(function() {
	setInterval('pagination(1)',8000); //CADA 6 SEGUNDOS
	
	//SI EL USUARIO ES DE ENFERMERÍA SE EVALUAN LOS REGISTROS PENDIENTES Y SE ENVIAN POR CORREO
	if (getUsuarioSistema() == 8 ||  getUsuarioSistema() == 9){
		    setInterval('evaluarRegistrosPendientes()',1800000); //CADA MEDIA HORA
	}	
});

function getMes(fecha){
    var url = '<?php echo SERVERURL; ?>php/postclinica/getMes.php';
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
    var url = '<?php echo SERVERURL; ?>php/postclinica/evaluarPendientes.php';
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
					text: "Se le recuerda que tiene " + datos[0] + " " + string + " de hacer su Postclínica en este mes de " + datos[1] + ". Debe revisar sus registros pendientes para todos los servicios", 
					type: 'warning', 
					confirmButtonClass: 'btn-warning',
				    allowEscapeKey : false,
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
	evaluarRegistrosPendientesEmailPostclinica(); //AL INGRESAR AL SISTEMA ENVIARA UN CORREO CON LA CANTIDAD DE REGISTROS PENDIENTES
});

function evaluarRegistrosPendientesEmailPostclinica(){
    var url = '<?php echo SERVERURL; ?>php/mail/evaluarPendientes_postclinica.php';
	
	$.ajax({
	    type:'POST',
		url:url,
		success: function(valores){	
           		  		  		  			  
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
		    $('#formulario_agregar_postclinica #medicamento1').html("");
			$('#formulario_agregar_postclinica #medicamento1').html(data);

		    $('#formulario_agregar_postclinica #medicamento2').html("");
			$('#formulario_agregar_postclinica #medicamento2').html(data);

		    $('#formulario_agregar_postclinica #medicamento3').html("");
			$('#formulario_agregar_postclinica #medicamento3').html(data);

		    $('#formulario_agregar_postclinica #medicamento4').html("");
			$('#formulario_agregar_postclinica #medicamento4').html(data);

		    $('#formulario_agregar_postclinica #medicamento5').html("");
			$('#formulario_agregar_postclinica #medicamento5').html(data);			
		}			
     });		
}


function getVia(){
    var url = '<?php echo SERVERURL; ?>php/atas/getVia.php';
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#formulario_agregar_postclinica #via1').html("");
			$('#formulario_agregar_postclinica #via1').html(data);

		    $('#formulario_agregar_postclinica #via2').html("");
			$('#formulario_agregar_postclinica #via2').html(data);

		    $('#formulario_agregar_postclinica #via3').html("");
			$('#formulario_agregar_postclinica #via3').html(data);

		    $('#formulario_agregar_postclinica #via4').html("");
			$('#formulario_agregar_postclinica #via4').html(data);

		    $('#formulario_agregar_postclinica #via5').html("");
			$('#formulario_agregar_postclinica #via5').html(data);			
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
	$('#bad').hide();
	$('#okay').show();	
}
</script>