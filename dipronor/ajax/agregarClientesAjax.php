<?php	
	$peticionAjax = true;
	require_once "../core/configGenerales.php";
	
	if(isset($_POST['nombre_clientes']) && isset($_POST['apellido_clientes']) && isset($_POST['identidad_clientes']) && isset($_POST['fecha_clientes']) && isset($_POST['departamento_cliente']) && isset($_POST['municipio_cliente']) && isset($_POST['dirección_clientes']) && isset($_POST['telefono_clientes']) && isset($_POST['correo_clientes'])){
		require_once "../controladores/clientesControlador.php";
		$insClientes = new clientesControlador();
		
		echo $insClientes->agregar_clientes_controlador();
	}else{
		session_start();
		session_destroy();
		echo '<script>window.location.href="'.SERVERURL.'login/"</script>';
	}