<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$pacientes_id = $_POST['pacientes_id'];
$agenda_id = $_POST['agenda_id'];
$fecha = $_POST['fecha'];
$observaciones = cleanStringStrtolower($_POST['observaciones']);
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");
$estado = 1;//ACTIVO

//CONSULTAMOS LOS DATOS DE LA AGENDA
$query_agenda = "SELECT colaborador_id, servicio_id
	FROM agenda
	WHERE agenda_id = '$agenda_id'";
$result_agenda = $mysqli->query($query_agenda);

$colaborador_id = "";
$servicio_id = "";

if($result_agenda->num_rows > 0){
	$consultar_agenda = $result_agenda->fetch_assoc();
	$colaborador_id = $consultar_agenda['colaborador_id'];
	$servicio_id = $consultar_agenda['servicio_id'];
}

//VALIDAMOS SI EXISTE LA RECETA ANTES DE ALMACENARLA
$query_receta = "SELECT receta_id
	FROM receta
	WHERE pacientes_id = '$pacientes_id' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";

$result_rececta_consulta = $mysqli->query($query_receta);

if($result_rececta_consulta->num_rows == 0){
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
			//CONSULTAMOS LOS DATOS EN LA ENTIDAD COLA
			$query_cola = "SELECT colas_id
				FROM colas
				WHERE pacientes_id = '$pacientes_id' AND fecha = '$fecha' AND colaborador_id = '$colaborador_id' AND servicio_id = '$servicio_id'";
			$result_cola = $mysqli->query($query_cola);

			if($result_cola->num_rows>0){
				$consulta = $result_cola->fetch_assoc();
				$colas_id = $consulta['colas_id'];

				//ACTUALIZAMOS LA ENTIDAD cola
				$update_cola = "UPDATE colas
					SET
						receta_id = '$receta_id'
					WHERE colas_id = '$colas_id'";
				$mysqli->query($update_cola);
			}

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
					$estado_producto = 1;//Activo
					
					//CONSULTAMOS SI EL PRODUCTO ESTA ALMACENADO
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
							VALUES('$productos_id','$productCode','$productName','$concentracion','$unidad', '$estado_producto')";
						$mysqli->query($insert_producto);
					}

					$insert_detalle = "INSERT INTO receta_detalle
						VALUES('$receta_detalle_id','$receta_id','$productos_id','$via','$quanty','$manana','$mediodia','$tarde','$noche')";
					$mysqli->query($insert_detalle);
				}
			}

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
			1 => "Lo sentimos hay datos en blanco, no se puede almacenar este registro, verifique la vía que no debe quedar en vacía, o los datos del detalle de la receta no pueden quedar vacíos, por favor corregir", 
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
		6 => "",
		7 => "",
	);
}

echo json_encode($datos);
?>
