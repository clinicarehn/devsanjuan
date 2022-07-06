<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	session_start(['name'=>'SD']);
	
	$insMainModel = new mainModel();
	
	$colaboradores_id = $_SESSION['colaborador_id_sd'];
	$result = $insMainModel->getColaboradoresEdit($colaboradores_id);
	$valores2 = $result->fetch_assoc();
	
	$datos = array(
		0 => $valores2['nombre'], 
		1 => $valores2['apellido'],
		2 => $valores2['identidad'],
		3 => $valores2['telefono'],						
		4 => $valores2['puestos_id'], 					
		5 => $valores2['estado'],					
	);
	echo json_encode($datos);