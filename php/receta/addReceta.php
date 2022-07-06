<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$pacientes_id = $_POST['pacientes_id'];
$servicio_id = $_POST['servicio_receta'];
$fecha = $_POST['fecha'];
$observaciones = cleanStringStrtolower($_POST['observaciones']);
$usuario = $_SESSION['colaborador_id'];
$colaborador_id = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
$estado = 1;//ACTIVO

$consultar_expediente = "SELECT expediente
      FROM pacientes 
	  WHERE pacientes_id = '$pacientes_id'";
$result = $mysqli->query($consultar_expediente);	  
$consultar_expediente2 = $result->fetch_assoc();
$expediente = $consultar_expediente2['expediente'];

//OBTENEMOS EL TAMAÑO DE LA TABLA
if(isset($_POST['productName'])){
	if($_POST['productCode'][0] != "" && $_POST['product'][0] != "" && $_POST['concentracion'][0] != "" && $_POST['unidad'][0] != "" && $_POST['via'][0] != ""){
		$tamano_tabla = count($_POST['productName']);
	}else{
		$tamano_tabla = 0;
	}
}else{
	$tamano_tabla = 0;
}

if($tamano_tabla > 0){
	//INSERTAMOS LOS DATOS EN LA ENTIDAD RECETA
	$receta_id = correlativo("receta_id","receta");
	$insert = "INSERT INTO receta 
		VALUES('$receta_id','$pacientes_id','$fecha','$colaborador_id','$servicio_id','$observaciones','$usuario','$estado','$fecha_registro')";
	$query = $mysqli->query($insert);

	if($query){		
		//ALMACENAMOS EL DETALLE DE LA RECETA EN LA ENTIDAD RECETA_DETALLE
		for ($i = 0; $i < count( $_POST['productName']); $i++) {
				$receta_detalle_id = correlativo("receta_detalle_id","receta_detalle");
				$productCode = $_POST['productCode'][$i];
				$productName = $_POST['product'][$i];
				$concentracion = $_POST['concentracion'][$i];
				$unidad = $_POST['unidad'][$i];
				$via = $_POST['via'][$i];
				
				if($_POST['quanty'][$i] == "" || $_POST['quanty'][$i] == 0){
					$quanty = "";
				}else{
					$quanty = $_POST['quanty'][$i];
				}

				$manana = $_POST['manana'][$i];	
				$mediodia = $_POST['mediodia'][$i];	
				$tarde = $_POST['tarde'][$i];	
				$noche = $_POST['noche'][$i];			
				$productos_id = "";
				
			if($productCode != "" && $productName != "" && $concentracion != "" && $unidad != "" && $via != "" && $quanty != ""){
				//CONSULTAMOS SI EL PRODUCTO ESTA ALMACENADO
				$estado_producto = 1;//Activo
				
				$query_producto = "SELECT productos_id
					FROM productos 
					WHERE product_template_id = '$productCode'";
				$result_producto = $mysqli->query($query_producto);	
							
				if($result_producto->num_rows > 0){
					$consultar_productos = $result_producto->fetch_assoc();
					$productos_id = $consultar_productos['productos_id'];
				}else{					
					$productos_id = correlativo("productos_id","productos");
					$insert_producto = "INSERT INTO productos 
						VALUES('$productos_id','$productCode','$productName','$concentracion','$unidad','$estado_producto')";
					$mysqli->query($insert_producto);				
				}
				
				$insert_detalle = "INSERT INTO receta_detalle 
					VALUES('$receta_detalle_id','$receta_id','$productos_id','$via','$quanty','$manana','$mediodia','$tarde','$noche')";
				$mysqli->query($insert_detalle);	
			}
		}

		//AGREGAMOS LA COLA DE ESTE PACIENTE 
		$colas_id = correlativo('colas_id', 'colas');
		$cola_numero = correlativo_diario($servicio_id);
		$horai = date("H:m:s");
		$horaf = 'Sin registro';
		
		$admision = 1;//1. Visible 2. Oculto
		$farmacia = 2; //1. Visible 2. Oculto
		
		//CONSULTAMOS EL CAMPO programar_cita_id EN LA ENTIDAD programar_cita
		$query_programar = "SELECT programar_cita_id
			FROM programar_cita
			WHERE pacientes_id = '$pacientes_id' AND fecha_cita = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
		$result_programar = $mysqli->query($query_programar);
		
		$programar_cita_id = "";
		
		if($result_programar->num_rows>0){
			$consulta_programar = $result_programar->fetch_assoc();
			$programar_cita_id = $consulta_programar['programar_cita_id'];
		}
		
		//CONSULTAMOS EL CAMPO transito_id EN LA ENTIDAD transito_enviada
		$query_transito = "SELECT transito_id	
			FROM transito_enviada
			WHERE expediente = '$expediente' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
		$result_transito = $mysqli->query($query_transito);
		
		$transito_id = "";
		
		if($result_transito->num_rows>0){
			$consulta_transito = $result_transito->fetch_assoc();
			$transito_id = $consulta_transito['transito_id'];
		}
		
		$insert = "INSERT INTO colas 
			VALUES('$colas_id','$cola_numero','$pacientes_id','$fecha','$horai','$horaf','$colaborador_id','$servicio_id','$receta_id','$programar_cita_id','$transito_id','$admision','$farmacia','$fecha_registro')";
		$mysqli->query($insert);	
		
		$datos = array(
			0 => "Almacenado", 
			1 => "Registro Almacenado Correctamente", 
			2 => "success",
			3 => "btn-primary",
			4 => "formulario_receta_medica",
			5 => "Registro",
			6 => "RecetaMedica",
			7 => ""
		);
	}else{//NO SE PUEDO ALMACENAR ESTE REGISTRO
		$datos = array(
			0 => "Error", 
			1 => "No se puedo almacenar este registro, los datos son incorrectos por favor corregir", 
			2 => "error",
			3 => "btn-danger",
			4 => "",
			5 => "",			
		);
	}	
}else{
	$datos = array(
		0 => "Error", 
		1 => "No se puede almacenar este regsitro, los datos son incorrectos por favor corregir, verifique si hay registros en blanco los datos del detalle de la receta no pueden quedar vacíos", 
		2 => "error",
		3 => "btn-danger",
		4 => "",
		5 => "",			
	);	
}

echo json_encode($datos);
?>