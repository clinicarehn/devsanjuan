<script>
$(document).ready(function() {
    getServicio();
    pagination(1);
});

//BUSQUEDA	
$('#form_reporte_agenda #servicio').on('change',function(){	
        pagination(1);
});	

$('#form_reporte_agenda #unidad').on('change',function(){     	    
    pagination(1);
});		

$('#form_reporte_agenda #profesional').on('change',function(){     	    
    pagination(1);
});		

$('#form_reporte_agenda #fecha_i').on('change',function(){
    pagination(1);
});	

$('#form_reporte_agenda #fecha_f').on('change',function(){
    pagination(1);
});	

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/reporte_agenda/paginar.php';
	var dato = '';
	var servicio = '';
	var unidad = '';
	var fechai = $('#form_reporte_agenda #fecha_i').val();
	var fechaf = $('#form_reporte_agenda #fecha_f').val();	
	var profesional = '';
	
	if($('#form_reporte_agenda #servicio').val() == "" || $('#form_reporte_agenda #servicio').val() == null){
		servicio = 1;
	}else{
		servicio = $('#form_reporte_agenda #servicio').val();
	}
	
	if($('#form_reporte_agenda #unidad').val() == "" || $('#form_reporte_agenda #unidad').val() == null){
		unidad = "";
	}else{
		unidad = $('#form_reporte_agenda #unidad').val();
	}
	
	if($('#form_reporte_agenda #profesional').val() == "" || $('#form_reporte_agenda #profesional').val() == null){
		profesional = '';
	}else{
		profesional = $('#form_reporte_agenda #profesional').val();
	}
	
	if($('#form_reporte_agenda #bs-regis').val() == "" || $('#form_reporte_agenda #bs-regis').val() == null){
		dato = '';
	}else{
		dato = $('#form_reporte_agenda #bs-regis').val();
	}
	
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&servicio='+servicio+'&dato='+dato+'&unidad='+unidad+'&fechai='+fechai+'&fechaf='+fechaf+'&profesional='+profesional,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}	

function getServicio(){
    var url = '<?php echo SERVERURL; ?>php/reporte_agenda/servicios.php';		
		
	$.ajax({
        type: "POST",
        url: url,
	    async: true,
        success: function(data){	
		    $('#form_reporte_agenda #servicio').html("");
			$('#form_reporte_agenda #servicio').html(data);
		}			
     });		
}

$(document).ready(function() {
	  $('#form_reporte_agenda #servicio').on('change', function(){
		var servicio_id = $('#form_reporte_agenda #servicio').val();
        var url = '<?php echo SERVERURL; ?>php/reporte_agenda/getUnidad.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio_id,
            success: function(data){
				$('#form_reporte_agenda #unidad').html("");
				$('#form_reporte_agenda #unidad').html(data);				
            }
         });
		 
      });					
});

$(document).ready(function() {
	  $('#form_reporte_agenda #unidad').on('change', function(){
		var servicio = $('#form_reporte_agenda #servicio').val();
		var puesto_id = $('#form_reporte_agenda #unidad').val();
        var url = '<?php echo SERVERURL; ?>php/reporte_agenda/getMedico.php';		
		
		$.ajax({
            type: "POST",
            url: url,
			async: true,
            data:'servicio='+servicio+'&puesto_id='+puesto_id,
            success: function(data){
				$('#form_reporte_agenda #profesional').html("");
				$('#form_reporte_agenda #profesional').html(data);			
            }
         });
		 
      });					
});
</script>