<script>
$(document).ready(function() {
   getServicio();
   getReporte();
   pagination_transito(1);
});

$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){	
     pagination_transito(1);
  });
});

$(document).ready(function() {
  $('#form_main #reporte').on('change', function(){	
     pagination_transito(1);
  });
});

$(document).ready(function() {
  $('#form_main #fecha_i').on('change', function(){	
     pagination_transito(1);
  });
});

$(document).ready(function() {
  $('#form_main #fecha_f').on('change', function(){	
     pagination_transito(1);
  });
});

$(document).ready(function() {
  $('#form_main #bs-regis').on('keyup', function(){	
     pagination_transito(1);
  });
});

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reportes_transito/getServicio.php';		
		
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

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_transito/getReporte.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #reporte').html("");
			$('#form_main #reporte').html(data);				
        }
     });		
}

function pagination_transito(partida){
	var servicio;
	var reporte;
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var dato = $('#form_main #bs-regis').val();
	
	if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = 1;
	}else{
		servicio = $('#form_main #servicio').val();
	}
	
	if($('#form_main #reporte').val() == "" || $('#form_main #reporte').val() == null){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}
	
	if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_transito/paginar_transito_enviada.php';		
	}else{
		url = '<?php echo SERVERURL; ?>php/reportes_transito/paginar_transito_recibida.php';
	}

	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&dato='+dato,			
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);			
		}
	});
	return false;	
}

function limpiar(){
    $('#agrega-registros').html("");
	$('#pagination').html("");
    getServicio();
	getReporte();
	pagination_transito(1);
}

function reporteEXCEL(){
  if($('#form_main #servicio').val()!=""){
	var servicio = $('#form_main #servicio').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	
	if(reporte == ""){
		reporte = 1;
	}else{
		reporte = $('#form_main #reporte').val();
	}
	
	if(reporte == 1){
		url = '<?php echo SERVERURL; ?>php/reportes_transito/reporteTransitoenviada.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}else{
		url = '<?php echo SERVERURL; ?>php/reportes_transito/reporteTransitorecibidas.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio;
	}
	    
	window.open(url);
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

function modal_eliminarTransitoRecibida(transito_id, expediente){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar el usuario " + consultarNombre(expediente) + "?",
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
			eliminarTransitoRecibida(transito_id);
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

function modal_eliminarTransitoEnviada(transito_id, expediente){
   if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){   
		swal({
			title: "¿Estas seguro?",
			text: "¿Desea eliminar el usuario " + consultarNombre(expediente) + "?",
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
			eliminarTransitoEnviada(transito_id);
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

function eliminarTransitoRecibida(id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/reportes_transito/eliminarTransitoRecibida.php';
	
	var fecha = getFechaRegistroTransitoRecibida(id);
	
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
	  data:'id='+id,
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
			pagination_transito(1);
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

function eliminarTransitoEnviada(id){
  if (getUsuarioSistema() == 1 || getUsuarioSistema() == 6 || getUsuarioSistema() == 7 || getUsuarioSistema() == 10 || getUsuarioSistema() == 16){	
	var url = '<?php echo SERVERURL; ?>php/reportes_transito/eliminarTransitoEnviada.php';
		
	var fecha = getFechaRegistroTransitoEnviada(id);
	
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
	  data:'id='+id,
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
			pagination_transito(1);
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
			text: "No se puede agregar/modificar registros fuera de este periodo",
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

function getFechaRegistroTransitoRecibida(transito_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_transito/getFechaTransitoRecibida.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'transito_id='+transito_id,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;
}

function getFechaRegistroTransitoEnviada(transito_id){
    var url = '<?php echo SERVERURL; ?>php/reportes_transito/getFechaTransitoEnviada.php';
	var fecha;
	$.ajax({
	    type:'POST',
		url:url,
		data:'transito_id='+transito_id,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;	
}

function consultarNombre(id){	
    var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/getNombre.php';
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

$('#form_main #reporte_excel').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
</script>