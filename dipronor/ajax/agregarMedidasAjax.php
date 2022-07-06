<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['medidas_medidas']) && isset($_POST['descripcion_medidas'])){
		require_once "../controladores/medidasControlador.php";
		$insPuestos = new medidasControlador();
		
		echo $insPuestos->agregar_medidas_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}