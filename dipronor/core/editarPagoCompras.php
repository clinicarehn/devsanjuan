<?php
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();

	$compras_id = $_POST['compras_id'];

	//CONSULTAR DATOS DEL METODO DE PAGO
	$result = $insMainModel->getDatosCompras($compras_id); 
     
	$cliente = "";
	$fecha_compra = "";
	$importe = 0;

	//OBTENEMOS LOS VALORES DEL REGISTRO
	if($result->num_rows>0){
		$consulta_registro = $result->fetch_assoc(); 
		$cliente = $consulta_registro['proveedor'];
		$fecha_compra = $consulta_registro['fecha_compra'];	
	}

	$result_factura = $insMainModel->getDetalleProductosCompras($compras_id);

	while($registro2 = $result_factura->fetch_assoc()){
		$cantidad = $registro2['cantidad'];
		$precio = $registro2['precio'];
		$descuento = $registro2['descuento'];
		$isv_valor = $registro2['isv_valor'];
		$importe += (($cantidad * $precio) - $descuento) + $isv_valor;
	}	

	$datos = array(
		 0 => $cliente, 
		 1 => $fecha_compra, 
		 2 => $importe,	 
	);	
	echo json_encode($datos);
?>