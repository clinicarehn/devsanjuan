<script>	
$(document).ready(function() {
	$('.btn-exit-system').on('click', function(e){
		e.preventDefault();
		var token = $(this).attr('href');

		swal({
		  title: "¿Esta seguro?",
		  text: "Salir del sistema",
		  type: "info",
		  showCancelButton: true,
		  confirmButtonText: "¡Si, deseo salir del sistema!",
		  closeOnConfirm: false,
		  showLoaderOnConfirm: true
		}, function () {
		setTimeout(function () {
			salir(token);
		}, 2000);
		});
	
	});
});	

function salir(token){
	$.ajax({
		url: '<?php echo SERVERURL;?>ajax/loginAjax.php?token='+token,
		success: function(data){
			if(data=="true"){
				window.location.href = "<?php echo SERVERURL;?>login/";
			}else{
				swal({
					title: 'Ocurrio un error inesperado', 
					text: 'Por favor intenta de nuevo', 
					type: 'error', 
					confirmButtonClass: 'btn-danger'
				});
			}
		}
	});	
}
</script>