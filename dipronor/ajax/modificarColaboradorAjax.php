<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['colaborador_id']) && isset($_POST['puesto_colaborador']) && isset($_POST['nombre_colaborador']) && isset($_POST['apellido_colaborador']) && isset($_POST['colaboradores_activo']) && isset($_POST['telefono_colaborador'])){
		require_once "../controladores/colaboradorControlador.php";
		$insColaborador = new colaboradorControlador();
		
		echo $insColaborador->editar_colaborador_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}