<script>
$(document).ready(function() {
	getServicio();	
    getReporte();	
	pagination(1);

	$('#form_main #reporte').on('change',function(){
		 pagination(1);
    });
	
	$('#form_main #fecha_i').on('change',function(){
		 pagination(1);
    });

	$('#form_main #fecha_f').on('change',function(){
		 pagination(1);
    });
	
	$('#form_main #servicio').on('change',function(){
		 pagination(1);
    });	
	
	$('#form_main #unidad').on('change',function(){
		 pagination(1);
    });	

	$('#form_main #medico_general').on('change',function(){
		 pagination(1);
    });		
});


function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/ata_familiares/buscar_ata_familiares_unidades.php';
    var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var unidad = $('#form_main #unidad').val();
	var servicio = $('#form_main #servicio').val();
	var colaborador = $('#form_main #medico_general').val();
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&colaborador='+colaborador+'&unidad='+unidad,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/ata_familiares/servicios.php';		
		
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

$(document).ready(function() {
	  $('#form_main #servicio').on('change', function(){
		var servicio_id = $('#form_main #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/ata_familiares/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#form_main #unidad').html(data);
			    $('#form_main #unidad').html(data);		
            }
         });
		 
      });					
});

$(document).ready(function() {
	$('#form_main #unidad').on('change', function(){
		var url = '<?php echo SERVERURL; ?>php/ata_familiares/getMedico.php';
       	
        var servicio = $('#form_main #servicio').val();		
		var puesto_id = $('#form_main #unidad').val();
		
	    $.ajax({
		   type:'POST',
		   url:url,
		   data:'puesto_id='+puesto_id+'&servicio='+servicio,
		   success:function(data){
		      $('#form_main #medico_general').html("");
			  $('#form_main #medico_general').html(data);				  
		  }
	  });
	  return false;			 				
    });					
});

function getReporte(){
    var url = '<?php echo SERVERURL; ?>php/ata_familiares/getReporte.php';		
		
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

function reporteEXCEL(){
    if($('#form_main #servicio').val() == ""){
		servicio = "1,6";
	}else{
		servicio = $('#form_main #servicio').val();
	}	
	var unidad = $('#form_main #unidad').val();
	var reporte = $('#form_main #reporte').val();
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
    var colaborador = $('#form_main #medico_general').val();	
	var url = '';
	
    if(reporte == ''){
	    url = '<?php echo SERVERURL; ?>php/ata_familiares/buscar_ata_familiares_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;
    }else if(reporte == 'ata'){
	    url = '<?php echo SERVERURL; ?>php/ata_familiares/buscar_ata_familiares_unidades_excel.php?desde='+desde+'&hasta='+hasta+'&servicio='+servicio+'&unidad='+unidad+'&colaborador='+colaborador;
    }	
    
	window.open(url);	
}

function limpiar(){
	$('#form_main #unidad').html("");
	$('#form_main #medico_general').html("");
    $('#form_main #agrega-registros').html("");
	$('#form_main #pagination').html("");
    getServicio();
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