<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	
	$result = $insMainModel->getISV();
	
	$isv = "";
	
	if($result->num_rows>0){
		$consulta2 = $result->fetch_assoc();
		$isv = $consulta2['nombre'];
	}

	$datos = array(
		0 => $isv,
	);	

	echo json_encode($datos);
	