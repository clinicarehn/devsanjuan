<?php
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['nombre_colaborador']) && isset($_POST['apellido_colaborador']) && isset($_POST['identidad_colaborador']) && isset($_POST['telefono_colaborador']) && isset($_POST['puesto_colaborador']) && isset($_POST['colaboradores_activo'])){
		require_once "../controladores/colaboradorControlador.php";
		$insColaborador = new colaboradorControlador();

		echo $insColaborador->agregar_colaborador_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}