<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$proceso = $_POST['pro'];
$id = $_POST['id-registro'];
$centros_nivel = $_POST['centros_nivel'];
$centros_grupo = $_POST['centros_centro'];
$depatamento = $_POST['departamento_referencias'];
$municipio = $_POST['red_centro'];
$re = $_POST['red_centro'];
$centros_nombre = cleanStringStrtolower($_POST['centros_nombre']);
$colaborador_id = $_SESSION['colaborador_id'];
$usuario = $_SESSION['colaborador_id'];
$fecha = date("Y-m-d");
$fecha_registro = date("Y-m-d H:i:s");
$visible = 1;

//OBTENER CORRELATIVO
$correlativo = "SELECT MAX(centros_id) AS max, COUNT(centros_id) AS count 
    FROM centros_hospitalarios";
$result = $mysqli->query($correlativo);
$correlativo2 = $result->fetch_assoc();

$numero = $correlativo2['max'];
$cantidad = $correlativo2['count'];

if ( $cantidad == 0 )
	$numero = 1;
else
    $numero = $numero + 1;	
	
//VERIFICAMOS EL PROCESO

if ($proceso = 'Registro'){
   //CONSULTAR Registro
   $consultar_registro = "SELECT centros_id 
       FROM centros_hospitalarios 
	   WHERE centro_nombre = '$centros_nombre'";
   $result = $mysqli->query($consultar_registro);

   if($result->num_rows>0){
	   echo 2; //REGISTRO YA EXISTE
   }else{
	   $insert = "INSERT INTO centros_hospitalarios 
	       VALUES('$numero', '$centros_nivel', '$centros_grupo', '$centros_nombre', '$fecha_registro', '$re', '$centros_nivel','$centros_grupo', '$depatamento', '$municipio', '$visible', '$usuario')";
	   $mysqli->query($insert);
	   	   
	   //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL 
       $historial_numero = historial();
       $estado = "Agregar";
       $observacion = "Se ha agregado un nuevo Centro Hospitalario el cual tiene como nombre: $centros_nombre";
       $modulo = "Centros Hospitalarios";
       $insert = "INSERT INTO historial 
            VALUES('$historial_numero','0','0','$modulo','$numero','0','0','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/		   
       echo 1;//REGISTRO ALMACENADO CORRECTAMENTE
   }  
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>