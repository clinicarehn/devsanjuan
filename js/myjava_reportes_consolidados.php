<script>
$(document).ready(function() {
   getServicio();
   getUnidad();
   getReporte();
});

$(document).ready(function() {
  $('#form_main #servicio').on('change', function(){	
     pagination(1);
  });
});

$(document).ready(function() {
  $('#form_main #unidad').on('change', function(){	
      pagination(1);
  });
});

$(document).ready(function() {
  $('#form_main #reporte').on('change', function(){	
      pagination(1);
  });
});

$(document).ready(function() {	
  $('#fecha_i').on('change', function(){
      pagination(1);
  });
});

$(document).ready(function() {	
  $('#fecha_f').on('change', function(){
      pagination(1);
  });
});
  
function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reportes_consolidados/getServicio.php';		
		
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

function getUnidad(){
    var url = '<?php echo SERVERURL; ?>php/reportes_consolidados/getUnidad.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_main #unidad').html("");
			$('#form_main #unidad').html(data);
			$('#form_main #unidad').selectpicker('refresh');
		}			
     });	
}

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/reportes_consolidados/getReporte.php';		
		
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

function pagination(partida){
    if($('#form_main #servicio').val() == ""){
		servicio = "";
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();	
	var flag = false;
	var url = '';
	
    if(reporte == ''){
	    url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_ata_unidades.php';
		flag = true;
    }else if(reporte == 'ata'){
	    url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_ata_unidades.php';
		flag = true;
    }else if(reporte == 'at2rd'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_at2rd_unidades.php';
		flag = false;
	}else if(reporte == 'at2rm'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_at2rm_unidades.php';
		flag = false;
	}else if(reporte == 'sm03'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_sm03_unidades.php';
		flag = false;
	}else if(reporte == 'procedencia'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_procedencia_unidades.php';
		flag = false;
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad,
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
		   if(flag==true){
			   var array = eval(data);
			   $('#agrega-registros').html(array[0]);
			   $('#pagination').html(array[1]);
   		   }else{
               $('#agrega-registros').html(data);
			   $('#pagination').html("");					   
		   }			
		},
		complete:function(){
            swal.close();			
		}
	});
	return false;		
}

function reporteEXCEL(){
    if($('#form_main #servicio').val() == ""){
		servicio = "";
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();	
	var url = '';
	
    if(reporte == ''){
	    url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_ata_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
    }else if(reporte == 'ata'){
	    url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_ata_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
    }else if(reporte == 'at2rd'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_at2rd_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
	}else if(reporte == 'at2rm'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_at2rm_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
	}else if(reporte == 'sm03'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_sm03_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
	}else if(reporte == 'procedencia'){
		url = '<?php echo SERVERURL; ?>php/reportes_consolidados/buscar_procedencia_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad;
	}	
    
	window.open(url);	
}

function limpiar(){
	$('#unidad').html("");
	$('#medico_general').html("");
    $('#agrega-registros').html("");
	$('#pagination').html("");		
    getServicio();
	getUnidad();
	getReporte();
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