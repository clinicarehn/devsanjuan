<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['puesto'])){
		require_once "../controladores/puestosControlador.php";
		$insPuestos = new puestosControlador();
		
		echo $insPuestos->agregar_puestos_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}