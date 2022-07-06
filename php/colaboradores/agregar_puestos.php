<?php
session_start();   
include('../funtions.php');
	
date_default_timezone_set('America/Tegucigalpa');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$nombre = cleanStringStrtolower($_POST['puestosn']);
$fecha_registro = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");
$usuario = $_SESSION['colaborador_id'];

//OBTENER CORRELATIVO
$correlativo= "SELECT MAX(puesto_id) AS max, COUNT(puesto_id) AS count 
   FROM puesto_colaboradores";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;

//CONSULTAMOS QUE EL REGISTRO EXISTA
$consulta = "SELECT puesto_id 
      FROM puesto_colaboradores 
	  WHERE nombre = '$nombre'";
$result = $mysqli->query($consulta);	  
$consulta2 = $result->fetch_assoc();
$consulta_nombre = $consulta2['puesto_id'];
	
//VERIFICAMOS EL PROCESO

if($consulta_nombre == ""){
    if($proceso== 'Registro'){
		$insert = "INSERT INTO puesto_colaboradores 
		   VALUES('$numero', '$nombre')";
		$query = $mysqli->query($insert);
		
        //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado_historial = "Agregar";
       $observacion_historial = "Se ha agregado un nuevo puesto: $nombre";
       $modulo = "Puestos";
       $insert = "INSERT INTO historial 
            VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado_historial','$observacion_historial','$usuario','$fecha_registro')";	
       $mysqli->query($insert);	   
       /********************************************/			
		
		if($query){
			echo 1;//REGISTRO ALMACENADO CORRECTAMENTE.
		}else{
			echo 2;//ERROR EN ALMACENAR EL REGISTRO
		}
	}	
}else{
	echo 3;//ESTE REGISTRO YA EXISTE NO SE PUEDE ALMACENAR
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>