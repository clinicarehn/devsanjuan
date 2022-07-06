<?php
session_start();
include('../funtions.php');

//CONEXION A DB
$mysqli = connect_mysqli();

$receta_id = $_POST['receta_id'];
$observaciones = cleanStringStrtolower($_POST['observaciones']);

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
  //EDITAMOS LA OBSERVACION DE LA RECETA
  $update_receta = "UPDATE receta
    SET
      observaciones = '$observaciones'
    WHERE receta_id = '$receta_id'";
  $query = $mysqli->query($update_receta);

  if($query){
    //EDITAMOS LOS DETALLES DE LA RECETA ELECTRONICA
    for ($i = 0; $i < count( $_POST['productName']); $i++) {
      $productCode = $_POST['productCode'][$i];
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

      //ATUALIZAMOS LOS DETALLES DE LA RECETA
      $update = "UPDATE receta_detalle
        SET
          via = '$via',
          cantidad = '$quanty',
          manana = '$manana',
          mediodia = '$mediodia',
          tarde = '$tarde',
          noche = '$noche'
      WHERE receta_id = '$receta_id' AND productos_id = '$productCode'";
      $mysqli->query($update);
    }

    $datos = array(
      0 => "Editado",
      1 => "Registro Editado Correctamente",
      2 => "success",
      3 => "btn-primary",
      4 => "formulario_receta_medica",
      5 => "Registro",
      6 => "ReporteRecetaMedica",
    );
  }else{
    $datos = array(
  		0 => "Error",
  		1 => "No se puede procesar su solicitud",
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
