<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['almacen_id']) && isset($_POST['almacen_almacen'])){
		require_once "../controladores/almacenControlador.php";
		$insEliminar = new almacenControlador();
		
		echo $insEliminar->delete_almacen_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}