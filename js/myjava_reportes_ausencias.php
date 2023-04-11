<script>
$(document).ready(function() {
   getServicio();
   getReporte();
   getColaborador_usuario();
});

$(document).ready(function() {
  $('#buscarRegistros').on('click', function(e){
	 e.preventDefault();
     pagination_ausencias(1);
  });
});

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #servicio').html("");
			$('#form_main #servicio').html(data);
			$('#form_main #servicio').selectpicker('refresh');
		}			
     });	
}

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getReporte.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #reporte').html("");
			$('#form_main #reporte').html(data);	
			$('#form_main #reporte').selectpicker('refresh');			
        }
     });		
}

function pagination_ausencias(partida){
	var servicio = '';
	var unidad = '';
	var profesional = '';
	var reporte = '';
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs-regis').val();
	var colaborador_usuario = "";

	if($('#form_main #reporte').val() == "" || $('#form_main #reporte').val() == null){
		reporte = "";
	}else{
		reporte = $('#form_main #reporte').val();
	}
	
	if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = "";
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if($('#form_main #unidad').val() == "" || $('#form_main #unidad').val() == null){
		unidad = "";
	}else{
		unidad = $('#form_main #unidad').val();
	}
	
	if($('#form_main #profesional').val() == "" || $('#form_main #profesional').val() == null){
		profesional = "";
	}else{
		profesional = $('#form_main #profesional').val();
	}
	
	if($('#form_main #colaborador_usuario').val() == "" || $('#form_main #colaborador_usuario').val() == null){
		colaborador_usuario = "";
	}else{
		colaborador_usuario = $('#form_main #colaborador_usuario').val();
	}
	
	if(servicio == "" || servicio == null){
		servicio = 1;
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if(reporte == "" || reporte == null){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}
		
	if(reporte == 0){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_pendientes.php';	
	}else if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_asistencia.php';	
	}else if(reporte == 2){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_ausencias.php';	
	}else if(reporte == 3){
        url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_extemporaneos.php';
	}else if(reporte == 4){
        url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_preclinica.php';
	}else if(reporte == 5){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_postclinica.php';
	}else if(reporte == 6){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_reprogramacion.php';
	}else if(reporte == 7){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_creacion.php';
	}else if(reporte == 8){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_asegurados.php';
	}else if(reporte == 9){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_suicidios.php';
	}else if(reporte == 10){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_cronicos.php';
	}else if(reporte == 11){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_usuarios.php';
	}else if(reporte == 12){
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/paginar_sobrecupos.php';
	}

	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&dato='+dato+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario,		
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
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);			
		},
		complete:function(){
			swal.close();		
		}	
	});
	return false;	
}

function reporteEXCEL(){
 if( $('#form_main #servicio').val()!=""){
	var servicio;
	var unidad;
	var profesional = $('#form_main #profesional').val();
	var reporte;
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var colaborador_usuario = $('#form_main #colaborador_usuario').val();

	if(colaborador_usuario == "" || colaborador_usuario == null){
		colaborador_usuario = "";
	}else{
		colaborador_usuario = $('#form_main #colaborador_usuario').val();
	}	
	
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
	
	if($('#form_main #reporte').val() == "" || $('#form_main #reporte').val() == null){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}
	
	if(reporte == 0){//Pendientes
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reportePendientes.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte;
	}else if(reporte == 1){//Atendidios
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteAsistencia.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte;
	}else if(reporte == 2){//Ausencias
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteAusencias.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;         
	}else if(reporte == 3){//Extemporaneos
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteExtemporaneo.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 4){//4: Pendientes en Preclínica
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reportePreclinica.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 5){//5: Pendientes en Potclinica
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reportePostclinica.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 6){//6: Reprogramaciones
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteReprogramaciones.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 7){//7: Fecha de Creación de la Cita
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteCreacion.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 8){//8: Asegurados
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteAsegurados.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 9){//9: Intentos Suicidas
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteSuicidos.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 10){//10: Usuarios Cronicos
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteCronicos.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 11){//11: Usuarios Creados
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteUsuarios.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}else if(reporte == 12){//12 Sobre Cupo
		url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteSobreCupo.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&reporte='+reporte+'&colaborador_usuario='+colaborador_usuario;
	}
	    
	window.open(url);
  }else{
	  swal({
			title: "Error", 
			text: "El Servicio no puede quedar en Blanco",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
	  }); 	  
  }
}

function reporteDiarioEXCEL(){
 if( $('#form_main #servicio').val()!=""){
   if( $('#form_main #reporte').val() != ""){
     if($('#form_main #reporte').val() == 4 || $('#form_main #reporte').val() == 5 || $('#form_main #reporte').val() == 7 || $('#form_main #reporte').val() == 8 || $('#form_main #reporte').val() == 9 || $('#form_main #reporte').val() == 10){	 
		swal({
			title: "Error",
			text: "No exite un reporte para esta Opción",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
		});			
	 }else{
	    var servicio = $('#form_main #servicio').val();
	    var unidad = $('#form_main #unidad').val();
	    var profesional = $('#form_main #profesional').val();
	    var reporte = $('#form_main #reporte').val();
	    var desde = $('#form_main #fecha_i').val();
	    var hasta = $('#form_main #fecha_f').val();
	    var colaborador_usuario = $('#form_main #colaborador_usuario').val();
  
	    if(colaborador_usuario == "" || colaborador_usuario == null){
		   colaborador_usuario = "";
	    }else{
		   colaborador_usuario = $('#form_main #colaborador_usuario').val();
	    }	
		
	    if(servicio == "" || servicio == null){
		    servicio = 1;
	    }else{
		    reporte = $('#form_main #reporte').val();
	    }
	
	    if(reporte == "" || reporte == null){
		    reporte = 1;
	    }else{
		    reporte = $('#form_main #reporte').val();
	    }
	
	    if(reporte == 0){//Pendientes
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioPendientes.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
	    }else if(reporte == 1){//Atendidos
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioAsistencia.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
	    }else if(reporte == 2){//Ausencias
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioAusencias.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador_usuario='+profesional;					          
	    }else if(reporte == 3){//Extemporaneos
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioExtemporaneos.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador_usuario='+profesional;
	    }else if(reporte == 6){//Reprogramaciones
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiariorReprogramaciones.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador_usuario='+profesional;
	    }else if(reporte == 11){//Reporte de Usuarios
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioUsuarios.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador_usuario='+profesional;
	    }else if(reporte == 8){//Reporte de Usuarios Asegurados
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioAegurados.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador_usuario='+profesional;
	    }else if(reporte == 12){//Reporte de Sobre Cupo
		    url = '<?php echo SERVERURL; ?>php/reportes_ausencias/reporteDiarioSobreCupo.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador_usuario='+profesional;
	    }
	    
	    window.open(url);
	 }
   }else{
	  swal({
			title: "Error", 
			text: "Debe por lo menos seleccionar un tipo de Reporte",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
	  }); 		
   }
  }else{
	  swal({
			title: "Error", 
			text: "Debe seleccionar por lo menos un Servicio para generar la Búsqueda",
			type: "error", 
			confirmButtonClass: "btn-danger",
			allowEscapeKey: false,
			allowOutsideClick: false
	  }); 	  
  }
}

$(document).ready(function() {
	$('#form_main #servicio').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getUnidad.php';
       		
		var servicio = $('#form_main #servicio').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'servicio='+servicio,
		   success:function(data){
		      $('#form_main #unidad').html("");
			  $('#form_main #unidad').html(data);
			  $('#form_main #unidad').selectpicker('refresh');		  
		  }
	  });
	  return false;			 				
    });					
});

$(document).ready(function() {
	$('#form_main #unidad').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getMedico.php';
       		
		var servicio = $('#form_main #servicio').val();
		var puesto_id = $('#form_main #unidad').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'servicio='+servicio+'&puesto_id='+puesto_id,
		   success:function(data){
		      $('#form_main #profesional').html("");
			  $('#form_main #profesional').html(data);
			  $('#form_main #profesional').selectpicker('refresh');	  
		  }
	  });
	  return false;			 				
    });					
});

function limpiar(){	
    $('#agrega-registros').html("");
	$('#pagination').html("");		
    getServicio();
    getReporte();
	getColaborador_usuario();
    pagination_ausencias(1);
}

function modal_eliminarPendientes(agenda_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
        var pacientes_id = getPacientes_id(agenda_id);
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
			text: "¿Desea eliminar la cita al usuario: " + dato + "?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar el registro!",
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
		  eliminarPendientes(agenda_id,inputValue);
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

function modal_eliminarAusencias(ausencia_id, pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
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
			text: "¿Desea eliminar la ausencia para el usuario: " + dato + "?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar el registro!",
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
		  eliminarAusencia(ausencia_id,inputValue);
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

function modal_eliminarAsistencia(ata_id, expediente){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
        var pacientes_id = getPacientes_idconExpediente(expediente);
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
			text: "¿Desea eliminar la atención para el usuario: " + dato + "?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar el registro!",
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
		  eliminarAsistencia(ata_id,inputValue);
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
	   
function modal_eliminarExtemporaneos(extem_id, pacientes_id){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
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
			text: "¿Desea eliminar al usuario: " + dato + ", que esta almacenado como extemporaneo>?",
			type: "input",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Sí, eliminar el registro!",
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
		  eliminarExtemporaneos(extem_id,inputValue);
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

function eliminarPendientes(agenda_id, comentario){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/eliminarPendientes.php';
		
	var fecha = getFechaRegistroAusencia(id);
	
    var hoy = new Date();
    fecha_actual = convertDate(hoy);		
	
   if ( fecha <= fecha_actual){   
	$.ajax({
      type:'POST',
	  url:url,
	  data:'agenda_id='+agenda_id+'&comentario='+comentario,
	  success: function(registro){
		 if(registro == 1){
			swal({
				title: "Success", 
				text: "Registro eliminado correctamente",
				type: "success",
				timer: 3000,
				allowEscapeKey: false,
				allowOutsideClick: false
			});				 
			pagination_ausencias(1);
		 }else if(registro == 2){
			  swal({
					title: "Error", 
					text: "Error al Eliminar el Registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
			  }); 			 
		 }else{
			  swal({
					title: "Error",
					text: "No se puede eliminar este registro ya que cuenta con información almacenada en la preclínica",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
			  });  			 
		 }		 
		 return false;
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

function eliminarAsistencia(id, comentario){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/eliminarAsistencia.php';
		
	var fecha = getFechaRegistroAsistencia(id);

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
	  data:'id='+id+'&comentario='+comentario,
	  success: function(registro){
		 if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});				 
			 pagination_ausencias(1); 
		 }else if(registro == 2){
			  swal({
					title: "Error",
					text: "No se puedo eliminar este registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
			  });  			 
			 pagination_ausencias(1); 
		 }else if(registro == 3){
			  swal({
					title: "Error",
					text: "No se puede eliminar este registro, cuenta con preclinica almacenada",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
			  });			 			 
			  pagination_ausencias(1); 
		 }else{
			  swal({
					title: "Error",
					text: "Error al Eliminar el Registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
			  });			 
		 }			 
		 return false;
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

function eliminarAusencia(id, comentario){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/eliminarAusencia.php';
		
	var fecha = getFechaRegistroAusencia(id);
	
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
	  data:'id='+id+'&comentario='+comentario,
	  success: function(registro){
		 if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success",
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				pagination_ausencias(1);
		 }else{
			  swal({
					title: "Error",
					text: "Error al Eliminar el Registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
			  });			 
		 }		 
		 return false;
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

function eliminarExtemporaneos(id, comentario){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 3 || getUsuarioSistema() == 4 || getUsuarioSistema() == 5 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 8 || getUsuarioSistema() == 10|| getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/eliminarExtemporaneos.php';
		
	var fecha = getFechaRegistroExtemporaneos(id);
	
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
	  data:'id='+id+'&comentario='+comentario,
	  success: function(registro){
		 if(registro == 1){
				swal({
					title: "Success", 
					text: "Registro eliminado correctamente",
					type: "success", 
					timer: 3000,
					allowEscapeKey: false,
					allowOutsideClick: false
				});	
				pagination_ausencias(1);
		 }else if(registro == 3){
				swal({
					title: "Error",
					text: "No se puede eliminar este registro, existe información en la atención del usuario",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		 			 
			 
			 pagination_ausencias(1);
		 }else{
				swal({
					title: "Error",
					text: "Error al Eliminar el Registro",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});		 			 
		 }		 
		 return false;
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

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}


function getFechaRegistroAsistencia(ata_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getFechaAsistencia.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'ata_id='+ata_id,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;
}

function getFechaRegistroAusencia(ausencia_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getFechaAusencia.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'ausencia_id='+ausencia_id,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;	
}

function getFechaRegistroExtemporaneos(extem_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getFechaExtemporaneos.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'extem_id='+extem_id,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;	
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

$('#exportar').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 reporteEXCEL();		 
});

$('#reporte_diario').on('click', function(e){ // add event submit We don't want this to act as a link so cancel the link action
	 e.preventDefault();
	 reporteDiarioEXCEL();		 
});

function getColaborador_usuario(){
    var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getColaborador_usuario.php';
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		     $('#form_main #colaborador_usuario').html("");
			 $('#form_main #colaborador_usuario').html(data);
			 $('#form_main #colaborador_usuario').selectpicker('refresh');
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

function getPacientes_id(agenda_id){
	var pacientes_id;
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getPacientes_id.php';
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'agenda_id='+agenda_id,
		success:function(data){	
          pacientes_id = data;			  		  		  			  
		}
	});	
	
	return pacientes_id;
}

function getPacientes_idconExpediente(expediente){
	var pacientes_id;
    var url = '<?php echo SERVERURL; ?>php/agenda_pacientes/getPacientes_idconExpediente.php';
	$.ajax({
	    type:'POST',
		url:url,
		async: false,
		data:'expediente='+expediente,
		success:function(data){	
          pacientes_id = data;			  		  		  			  
		}
	});	
	
	return pacientes_id;
}

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});

/***********************************************************************************************************************************************************/
function showDetailsATA(ata_id){
	var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/showDetailsAtencion.php';		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'ata_id='+ata_id,
		success: function(registro){
		   $('#informacion #mensaje_informacion').html(registro);
		   $('#informacion #myModalLabel').html('Detalles ATA');
		   $('#informacion').modal({
			   show:true,
			   keyboard: false,
			   backdrop:'static',
		   });
		   return false; 
		}
	});
	return false;	
}

function showDetails(ausencia_id){
	var url = '<?php echo SERVERURL; ?>php/reportes_ausencias/getDetailsAusencias.php';

	$.ajax({
		type:'POST',
		url:url,
		data:'ausencia_id='+ausencia_id,
		success:function(data){
		   $('#mensaje_show_ausencias').modal({
		      show:true,
			  keyboard: false,
		      backdrop:'static'
		   });
		
		   var array = eval(data);
		   $('#agrega_registros_show_ausencias').html(array[0]);
		   $('#pagination_show_ausencias').html(array[1]);	
		}
	});	
}
/***********************************************************************************************************************************************************/
	
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