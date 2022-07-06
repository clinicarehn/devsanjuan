<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	
	$result = $insMainModel->getUsuarios();
	
	$arreglo = array();
	
	while($data = $result->fetch_assoc()){				
		$arreglo["data"][] = $data;		
	}
	
	echo json_encode($arreglo);