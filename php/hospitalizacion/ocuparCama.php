<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

date_default_timezone_set('America/Tegucigalpa');

$historial_id = $_POST['historial_id'];
$fecha = $_POST['fecha'];
$cama_id = $_POST['cama_id'];
$color = "#DF0101"; //COLOR ROJO INDICA CAMA OCUPADA
$usuario = $_SESSION['colaborador_id'];
$fecha_registro = date("Y-m-d H:i:s");

//CONSULTAR EXPEDIENTE DE USUARIO
$consulta = "SELECT expediente 
   FROM hospitalizacion 
   WHERE historial_id = '$historial_id'";
$result = $mysqli->query($consulta);
$consulta2 = $result->fetch_assoc();
$expediente = $consulta2['expediente'];

//CONSULTAR VALORES EN LA ENTIDAD PACIENTES
$consulta_pacientes = "SELECT pacientes_id
   FROM pacientes
   WHERE expediente = '$expediente'";
$result = $mysqli->query($consulta_pacientes);
$consulta_pacientes2 = $result->fetch_assoc();
$pacientes_id = $consulta_pacientes2['pacientes_id']; 

//CONSULTAMOS EL ID DE LA ENTIDAD HOSPITALIZACION
$consulta_hosp = "SELECT hosp_id, estado, servicio_id, alta
    FROM hospitalizacion
	WHERE historial_id = '$historial_id'";
$result = $mysqli->query($consulta_hosp);
$consulta_hosp2 = $result->fetch_assoc();
$hosp_id = $consulta_hosp2['hosp_id'];
$estado = $consulta_hosp2['estado'];
$servicio_id = $consulta_hosp2['servicio_id'];
$alta = $consulta_hosp2['alta'];

if($hosp_id != ""){
	if(($estado == 0 || $estado == 3) && $alta == 0){
        //ACTUALIZAMOS EL ESTADO DE LA CAMA EN EL AREA DE HOSPITALIZACION
        $update = "UPDATE hospitalizacion SET estado = '0' 
            WHERE expediente = '$expediente' AND fecha = '$fecha'";
        $query = $mysqli->query($update);	
		
       //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
       $historial_numero = historial();
       $estado = "Actualizar";
       $observacion = "Se ha actualizado el estado de la atención usuario en ocupada";
       $modulo = "Hospitalizacion";
       $insert = "INSERT INTO historial 
              VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','0','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
       $mysqli->query($insert);
       /*****************************************************/		   
		
  
        if($query){
	       //CAMBIAMOS EL ESTADO DE LA CAMA Y EL COLOR EN EL HSITORIAL DE CAMAS
	       $update = "UPDATE historial_camas SET estado = '1', color = '$color' 
	           WHERE expediente = '$expediente' AND fecha = '$fecha'";
	       $mysqli->query($update);

           //INGRESAR REGISTROS EN LA ENTIDAD HISTORIAL
           $historial_numero = historial();
           $estado = "Actualizar";
           $observacion = "Se ha cambiado el estado de la cama para este usuario en ocupada";
           $modulo = "Hospitalizacion";
           $insert = "INSERT INTO historial 
                 VALUES('$historial_numero','$pacientes_id','$expediente','$modulo','$historial_id','0','$servicio_id','$fecha','$estado','$observacion','$usuario','$fecha_registro')";	 
           $mysqli->query($insert);
           /*****************************************************/			   
	       echo 1;//STATUS CAMBIADO CORRECTAMENTE
       }else{
	       echo 2;//ERROR AL CAMBIAR EL ESTATUS
       }		
	}else{
		echo 3;//EL REGISTRO YA HA SIDO ATENDIDO
	}
}else{
	echo 4;//ERROR EL REGISTRO NO EXISTE
}

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>