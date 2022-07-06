<script>
$(document).ready(function() {     
    $('#form_main #fecha_i').on('change',function(){
		  pagination(1);
    });	
	
    $('#form_main #fecha_f').on('change',function(){
		  pagination(1);
    });		

    pagination(1);
});

function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/reporte_ocupacion_diaria.php';
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida+'&desde='+desde+'&hasta='+hasta,
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
        },success:function(data){
			$('#agrega-registros').html(data);
		},
		complete:function(){
            swal.close();			
		}
	});
	return false;
}

function reporteEXCEL(){	
	var desde = $('#form_main #fecha_i').val();
	var hasta = $('#form_main #fecha_f').val();
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/reporte_ocupacion_diaria_excel.php?desde='+desde+'&hasta='+hasta;
	    
	window.open(url);			
}

function limpiar(){
	pagination(1);
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