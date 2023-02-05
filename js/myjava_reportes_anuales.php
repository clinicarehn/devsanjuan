<script>
$(document).ready(function() {
	getServicio();
	getReporte();
	getMes();
	getAño();
    $('#agrega-registros').html("<table class='table table-striped table-condensed table-hover'><td colspan='6' style='color:#C7030D'>Debe seleccionar un tipo de búsqueda, para poder mostrarle resultados.</td></table>");
	$('#pagination').html("");
});

$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){
	   pagination_reporte();
  });
});

$(document).ready(function() {
  $('#form_main #mes').on('change', function(){
	   pagination_reporte();
  });
});

$(document).ready(function() {
  $('#form_main #año').on('change', function(){
	   pagination_reporte();
  });
});

$(document).ready(function() {
  $('#form_main #reporte').on('change', function(){
	   pagination_reporte();
  });
});

function limpiar(){
    $('#agrega-registros').html("<table class='table table-striped table-condensed table-hover'><td colspan='6' style='color:#C7030D'>Debe seleccionar un tipo de búsqueda, para poder mostrarle resultados.</td></table>")
	$('#pagination').html("");		
	getServicio();
	getReporte();
	getMes();
	getAño();
}

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_anuales/getReporte.php';		
		
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

function getMes(){
    var url = '<?php echo SERVERURL; ?>php/reportes_anuales/getMes.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #mes').html("");
			$('#form_main #mes').html(data);
			$('#form_main #mes').selectpicker('refresh');
        }
     });		
}

function getAño(){
    var url = '<?php echo SERVERURL; ?>php/reportes_anuales/getAño.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){
		    $('#form_main #año').html("");
			$('#form_main #año').html(data);
			$('#form_main #año').selectpicker('refresh');			
        }
     });		
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reportes_anuales/getServicio.php';		
		
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
    var url = '<?php echo SERVERURL; ?>php/reportes_anuales/getReporte.php';		
		
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

//INICIO PAGINATION
function pagination_detallado(partida){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == 0){
		mes = 0;
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	

    if(mes == ""){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_servicios_anual.php';
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_servicios_por_mes.php';
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&año='+año+'&mes='+mes,
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

function pagination_consolidado(partida){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == 0){
		mes = 0;
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	

    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_consolidado_anual.php';
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_consolidado_por_mes.php';
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&año='+año+'&mes='+mes,
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

function pagination_enfermedades(partida){
	var url = '';
	var servicio = '';
	var año = '';
	var mes = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == 0){
		mes = 0;
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_enfermedades_anual.php';
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_enfermedades_por_mes.php';
	}
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&año='+año+'&mes='+mes,
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

function pagination_sm03(partida){
	var url = '';
	var servicio = '';
	var año = '';
	var mes = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == 0){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_sm03_anual.php';
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_sm03_por_mes.php';
	}
		
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&año='+año+'&mes='+mes,
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

function pagination_causa_reprogramcion(partida){
	var url = '';
	var servicio = '';
	var año = '';
	var mes = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == "" || $('#form_main #mes').val() == null){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_causa_reprogramacion_anual.php';
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/paginar_causa_reprogramacion_por_mes.php';
	}
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&año='+año+'&mes='+mes,
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
//FIN PAGINATION

//INICIO REPORTES
function reporte_detallado_excel(){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == "" || $('#form_main #mes').val() == null){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	

    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_servicios_anual.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_servicios_por_mes.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}
	
    window.open(url);	
}

function reporte_consolidado_excel(){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == "" || $('#form_main #mes').val() == null){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_consolidado_anual.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_consolidado_por_mes.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}
	
    window.open(url);		
}

function reporte_enfermedades_excel(){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == "" || $('#form_main #mes').val() == null){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_enfermedades_anual.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_enfermedades_por_mes.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}
	
    window.open(url);		
}

function reporte_sm03_excel(){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == "" || $('#form_main #mes').val() == null){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_sm03_anual.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_sm03_por_mes.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}
	
    window.open(url);		
}

function reporte_causa_reprogramacion_excel(){
	var servicio = '';
	var año = '';
	var mes = '';
	var url = '';
	var fecha = new Date();
    var ano = fecha.getFullYear();
	
    if($('#form_main #servicio').val() == "" || $('#form_main #servicio').val() == null){
		servicio = '';
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
    if($('#form_main #mes').val() == "" || $('#form_main #mes').val() == null){
		mes = '';
	}else{
		mes = $('#form_main #mes').val();
	}	
	
    if($('#form_main #año').val() == "" || $('#form_main #año').val() == null){
		año = ano;
	}else{
		año = $('#form_main #año').val();
	}	
	
    if(mes == 0){
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_causa_reprogramacion_anual.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}else{
		 url = '<?php echo SERVERURL; ?>php/reportes_anuales/reporte_causa_reprogramacion_por_mes.php?servicio='+servicio+'&año='+año+'&mes='+mes;
	}
	
    window.open(url);		
}
//FIN REPORTES

function pagination_reporte(){
   if($('#form_main #reporte').val() == "" || $('#form_main #reporte').val() == null){
	  reporte = '1';
   }else{ 
     reporte = $('#form_main #reporte').val();
   }	

   if(reporte == 1){
	  pagination_detallado(1);
   }else if(reporte == 2){
	  pagination_consolidado(1);	
   }else if(reporte == 3){
	   pagination_enfermedades(1);
   }else if(reporte == 4){
	   pagination_sm03(1);
   }else if(reporte == 5){
	   pagination_causa_reprogramcion(1);
   }		
}

function reporte_excel(){
   if($('#form_main #reporte').val() == "" || $('#form_main #reporte').val() == null){
	  reporte = '1';
   }else{ 
     reporte = $('#form_main #reporte').val();
   }	

   if(reporte == 1){
	  reporte_detallado_excel();
   }else if(reporte == 2){
	  reporte_consolidado_excel();	
   }else if(reporte == 3){
	   reporte_enfermedades_excel();
   }else if(reporte == 4){
       reporte_sm03_excel();
   }else if(reporte == 5){
	   reporte_causa_reprogramacion_excel();
   }			
}


$('#form_main #reporte_excel').on('click', function(e){
    e.preventDefault();
    reporte_excel();
});

$('#form_main #limpiar').on('click', function(e){
    e.preventDefault();
    limpiar();
});
</script>