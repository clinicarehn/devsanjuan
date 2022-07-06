<?php	
	$peticionAjax = true;
	require_once "configGenerales.php";
	require_once "mainModel.php";
	
	$insMainModel = new mainModel();
	
	$categoria_producto_id = $_POST['categoria_producto_id'];
	$result = $insMainModel->getProductoCategoria($categoria_producto_id);
	
	if($result->num_rows>0){
		echo '<option value="">Seleccione</option>';
		while($consulta2 = $result->fetch_assoc()){
			 echo '<option value="'.$consulta2['productos_id'].'">'.$consulta2['nombre'].'</option>';
		}
	}
	