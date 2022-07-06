<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['almacen_almacen']) && isset($_POST['ubicacion_almacen'])){
		require_once "../controladores/almacenControlador.php";
		$insAgregar = new almacenControlador();
		
		echo $insAgregar->agregar_almacen_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}