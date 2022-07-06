<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['colaborador_id'])){
		require_once "../controladores/colaboradorControlador.php";
		$insColaborador = new colaboradorControlador();
		
		echo $insColaborador->delete_colaborador_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}