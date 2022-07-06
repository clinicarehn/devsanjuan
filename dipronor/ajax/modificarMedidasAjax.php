<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['medida_id']) && isset($_POST['medidas_medidas']) && isset($_POST['descripcion_medidas'])){
		require_once "../controladores/medidasControlador.php";
		$insModificar = new medidasControlador();
		
		echo $insModificar->edit_medidas_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}