<script>
function pagination(partida){
	var url = '<?php echo SERVERURL; ?>php/hospitalizacion/paginar_hospitalizacion_resumen.php';
		
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
		}
	});
	return false;
}

$(document).ready(function() {
	setInterval('pagination(1)',1000);	
});
</script>