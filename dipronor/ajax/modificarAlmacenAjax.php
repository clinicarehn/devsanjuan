<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['almacen_id']) && isset($_POST['almacen_almacen'])){
		require_once "../controladores/almacenControlador.php";
		$insModificar = new almacenControlador();
		
		echo $insModificar->edit_almacen_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}