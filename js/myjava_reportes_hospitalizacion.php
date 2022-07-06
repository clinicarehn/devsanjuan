<script>
$(document).ready(function() {     
	$('#form_main #servicio').on('change',function(){     	    
		pagination(1);
    });	

	$('#form_main #unidad').on('change',function(){     	    
		pagination(1);
    });	

	$('#form_main #profesional').on('change',function(){     	    
		pagination(1);
    });	

	$('#form_main #fecha_i').on('change',function(){     	    
		pagination(1);
    });

    $('#form_main #fecha_f').on('change',function(){
		  pagination(1);
    });	
	
	$('#form_main #bs-regis').on('keyup',function(){
	   pagination(1);
    });
	
	$('#form_main #estado').on('change',function(){
	   pagination(1);
    });	
	
	servicio();
	getEstado();
    pagination(1);
});

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/paginar.php';
	var dato = $('#form_main #bs-regis').val();
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var profesional = $('#form_main #profesional').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var estado = $('#form_main #estado').val();
	
	if(servicio == null || servicio == ""){
		servicio = 3;
	}
	
	if(estado == null || estado == ""){
	   estado = 1;	
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&dato='+dato+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&desde='+desde+'&hasta='+hasta+'&estado='+estado,	
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function servicio(){
  var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/servicios.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#form_main #servicio').html("");
		    $('#form_main #servicio').html(data);		
		}
 });
 return false;	
}

function getEstado(){
  var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/getEstado.php';
  $.ajax({
 	 type:'POST',
	 url:url,
		success: function(data){
			$('#form_main #estado').html("");
		    $('#form_main #estado').html(data);
		}
 });
 return false;	
}

$(document).ready(function() {
	  $('#form_main #servicio').on('change', function(){
		var servicio_id = $('#servicio').val();
        var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/getUnidad.php';		
		
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
		var servicio_id = $('#form_main #servicio').val();
		var puesto_id = $('#form_main #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id+'&puesto_id='+puesto_id,
            success: function(data){
			    $('#form_main #profesional').html("");
			    $('#form_main #profesional').html(data);				
            }
         });
		 
      });					
});

function modal_eliminar(hosp_id, expediente){
  if (getUsuarioSistema() == 1){
	$('#hosp_id').val(hosp_id);
	$('#expediente').val(expediente);
	mensajeEliminar("Remover","¿Desea eliminar el usuario <b>" + consultarNombre(expediente) + "</b>?");
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
}

function eliminarRegistro(){
  var hosp_id = $('#hosp_id').val();	
  var expediente = $('#expediente').val();
  var fecha = getFecha(hosp_id);

  var hoy = new Date();
  fecha_actual = convertDate(hoy);

	var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/eliminar.php';

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
		data:'hosp_id='+hosp_id+'&expediente='+expediente,
		success: function(registro){
			if(registro == 1){
				swal({
					title: "Error", 
					text: "No se puede eliminar el registro, ya ha tenido más de dos atenciones",
					type: "error", 
					confirmButtonClass: "btn-danger",
					allowEscapeKey: false,
					allowOutsideClick: false
				});			   
	           return false;				
			}else if(registro == 2){			   
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
			}else if(registro == 3){
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

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}

function getFecha(hosp_id){
    var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/getFecha.php';
	var fecha;
	$.ajax({
	    type:'POST',
		data:'hosp_id='+hosp_id,
		url:url,
		async: false,
		success:function(data){	
          fecha = data;			  		  		  			  
		}
	});
	return fecha;	
}

function limpiar(){	
    $('#agrega-registros').html("");
	$('#pagination').html("");		
	servicio();
	getEstado();
    pagination(1);
}

function reporteEXCEL(){
	var dato = $('#form_main #bs-regis').val();
	var servicio = $('#form_main #servicio').val();
	var unidad = $('#form_main #unidad').val();
	var profesional = $('#form_main #profesional').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var estado = $('#form_main #estado').val();	
	
	if(servicio == null || servicio == ""){
		servicio = 3;
	}
	
	if(estado == null || estado == ""){
	   estado = 1;	
	}
	    
	var url = '<?php echo SERVERURL; ?>php/reporte_hospitalizacion/reporteHospitalizacion.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&profesional='+profesional+'&estado='+estado+'&dato='+dato;		

	window.open(url);
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

$('#form_main #reporte').on('click', function(e){
    e.preventDefault();
    reporteEXCEL();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
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