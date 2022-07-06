<?php
include('../funtions.php');
session_start(); 	
//CONEXION A DB
$mysqli = connect_mysqli(); 
date_default_timezone_set('America/Tegucigalpa');
 
include "../../PHPExcel/Classes/PHPExcel.php";

$id = $_GET['id'];
$fecha = $_GET['fecha'];
$fechaf = $_GET['fechaf'];
$servicio = $_GET['servicio'];
$unidad = $_GET['unidad'];
$atencion = $_GET['atencion'];
$mes = nombremes(date("m", strtotime($fecha)));
$dia = date("d", strtotime($fecha));
$año = date("Y", strtotime($fecha));

$mes1 = nombremes(date("m", strtotime($fechaf)));
$dia1 = date("d", strtotime($fechaf));
$año1 = date("Y", strtotime($fechaf));

$atencion_nombre = "";
$status = "";

//OBTENER NOMBRE DE EMPRESA
$usuario = $_SESSION['colaborador_id'];	

$query_empresa = "SELECT e.nombre AS 'empresa'
FROM users AS u
INNER JOIN empresa AS e
ON u.empresa_id = e.empresa_id
WHERE u.colaborador_id = '$usuario'";
$result_empresa = $mysqli->query($query_empresa) or die($mysqli->error);;
$consulta_empresa = $result_empresa->fetch_assoc();

$empresa_nombre = '';

if($result_empresa->num_rows>0){
   $empresa_nombre = $consulta_empresa['empresa'];	
}

if($atencion == 0){
   $atencion_nombre = "Pendientes.";
}

if($atencion == 1){
   $atencion_nombre = "Atendidos.";
}

if($atencion == 2){
   $atencion_nombre = "Ausentes.";
}

if($atencion == 3){
   $atencion_nombre = "Agenda.";
}

if($status == 0){//PENDIENTES
	$in = "IN(0)";
}else if($status == 1){//ATENDIDOS
	$in = "IN(1)";		
}else if($status == 2){//AUSENCIAS
	$in = "IN(2)";		
}else if($status == 3){//ELIMINADOS
	$in = "IN(3)";		
}else if($status == 4){//SEGUIMIENTO
	$in = "IN(4)";		
}else if($status == 5){//AGENDA
	$in = "IN(0,1,2)";		
}

if($atencion == 3){
	$where = "WHERE c.puesto_id IN(1,2,10) AND a.status $in AND CAST(a.fecha_cita AS DATE) BETWEEN '$fecha' AND '$fechaf' AND hora <> '00:00'";
}else{
	$where = "WHERE c.puesto_id IN(1,2,10) AND a.status $in AND CAST(a.fecha_cita AS DATE) BETWEEN '$fecha' AND '$fechaf'";
}

$registro = "SELECT COUNT(c.colaborador_id) AS 'conteo', c.puesto_id AS 'puesto_id', c.colaborador_id AS 'colaborador_id', CONCAT(c.nombre,' ',c.apellido) 'colaborador', s.nombre AS 'servicio', conf_agenda.confirmo AS 'confirmo_resp', conf_agenda.observacion AS 'confirmo_observacion' 
   FROM servicios_puestos AS sp
   INNER JOIN colaboradores AS c
   ON sp.colaborador_id = c.colaborador_id
   INNER JOIN puesto_colaboradores AS pc
   ON c.puesto_id = pc.puesto_id
   INNER JOIN users AS u
   ON sp.colaborador_id = u.colaborador_id
   INNER JOIN agenda AS a
   ON c.colaborador_id = a.colaborador_id
   INNER JOIN servicios AS s
   ON sp.servicio_id = s.servicio_id
   LEFT JOIN confirmacion_agenda AS conf_agenda
   ON a.agenda_id = conf_agenda.agenda_id   
   ".$where."
   GROUP BY c.colaborador_id
   ORDER BY s.servicio_id, c.puesto_id DESC";	
$result = $mysqli->query($registro) or die($mysqli->error);   


$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("AGENDA DIARIA USUARIOS"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 13
    )
));

$subtitulo1 = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo1->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true
    )
));

 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$subtitulo1 = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo1->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
      'size' => 12
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));

$subtitulo2 = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo2->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
      'size' => 12,
	  'bold' => true,
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));

$totales = new PHPExcel_Style(); //nuevo estilo
$totales->applyFromArray(
  array('font' => array( //fuente
      'bold' => true,
      'size' => 12
    ),
	'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$texto = new PHPExcel_Style(); //nuevo estilo
$texto->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$style = new PHPExcel_Style(); //nuevo estilo
$style->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => false,
      'size' => 10
    )
));
 
$other = new PHPExcel_Style(); //nuevo estilo
$other->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    ),'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));
 
$bordes = new PHPExcel_Style(); //nuevo estilo
 
$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
	'alignment' => array( //alineacion
      'wrap' => true
    ),
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("AGENDA DIARIA USUARIOS"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
//establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//fin: establecer impresion a pagina completa
 
//establecer margenes
$margin = 0.5 / 2.54; // 0.5 centimetros
$marginBottom = 1.2 / 2.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(60); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

//incluir la imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('O1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 6);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:O$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:O$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REPORTE AGENDA DE USUARIOS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:O$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:O$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "USUARIOS ".strtoupper($atencion_nombre)." ".strtoupper($mes)." $dia, $año Hasta ".strtoupper($mes1)." $dia1, $año1");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:O$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:O$fila");

$fila+=1;
$valor = 1;

if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   $fila+=1;
	   
	   if($registro2['puesto_id'] == 1){
		  $dato = "LIC";
	   }else if($registro2['puesto_id'] == 10){
		  $dato = "LIC";
	   }else{
		  $dato = utf8_decode("DR(A)");
	   }
		
       $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $dato.". ".$registro2['colaborador'].' ('.$registro2['servicio'].')');	
	   $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "A$fila:M$fila");
       $objPHPExcel->getActiveSheet()->mergeCells("A$fila:M$fila"); //unir celdas	   
	   
	   $colaborador_id = $registro2['colaborador_id'];
	   
	   if($atencion == 3){
		   $where = "WHERE c.colaborador_id = '$colaborador_id' AND CAST(a.fecha_cita AS DATE) BETWEEN '$fecha' AND '$fechaf' AND a.hora <> '00:00'";
	   }else{
		   $where = "WHERE c.colaborador_id = '$colaborador_id' AND CAST(a.fecha_cita AS DATE) BETWEEN '$fecha' AND '$fechaf'";		   
	   }
	   
	   $registro_agenda = "SELECT a.pacientes_id AS 'pacientes_id', c.puesto_id AS 'puesto_id', a.servicio_id AS 'servicio_id', 
	       a.expediente AS 'expediente', p.nombre AS 'nombre', p.apellido AS 'apellido', a.hora AS 'hora', DATE_FORMAT(CAST(a.fecha_cita AS DATE), '%d/%m/%Y') AS 'fecha', 
		   a.observacion AS 'observacion',  a.color AS 'color', p.identidad AS 'identidad', p.telefono AS 'telefono', p.telefono1 AS 'telefono1', 
		   p.telefonoresp AS 'telefonoresp',p.telefonoresp1 AS 'telefonoresp1', a.comentario as 'comentario', conf_agenda.confirmo AS 'confirmo_resp', 
		   conf_agenda.observacion AS 'confirmo_observacion' 
           FROM agenda AS a 
           INNER JOIN pacientes AS p 
           ON a.pacientes_id = p.pacientes_id 
           INNER JOIN colaboradores AS c 
           ON a.colaborador_id = c.colaborador_id
	       INNER JOIN puesto_colaboradores AS pc
	       ON c.puesto_id = pc.puesto_id
           LEFT JOIN confirmacion_agenda AS conf_agenda
           ON a.agenda_id = conf_agenda.agenda_id   		   
           ".$where."
           ORDER BY a.fecha_cita, a.pacientes_id ASC";
	   $result_agenda = $mysqli->query($registro_agenda) or die($mysqli->error);
		   
	   if($result_agenda->num_rows>0){
		   $fila+=1;			   
           $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'No.');
           $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  		   
           $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Identidad');
           $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
           $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Expediente');
           $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
           $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nombre');
           $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
           $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Apellido');
           $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
           $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Fecha Cita');
           $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12); 
           $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Hora');
           $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8); 
           $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Teléfono1');
           $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12); 
           $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Teléfono2');
           $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12); 
           $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Teléfono3');
           $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
           $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Teléfono4');
           $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
           $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Observación');
           $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
           $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Comentario');
           $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
           $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Confirmo');
           $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
           $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Observación');
           $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);		   
           $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:O$fila"); //establecer estilo
           $objPHPExcel->getActiveSheet()->getStyle("A$fila:O$fila")->getFont()->setBold(true); //negrita
		   
		   while($registro2 = $result_agenda->fetch_assoc()){			    			   
			   $fila+=1;
	           if ($registro2['expediente'] == 0){
		          $expediente = "TEMP"; 
	           }else{
		          $expediente = $registro2['expediente'];
	           }
			   
			   $pacientes_id = $registro2['pacientes_id'];
			   $puesto_id = $registro2['puesto_id'];
			   $servicio_id = $registro2['servicio_id'];
			   $profesional_nombre = "";
			   
			   if($puesto_id == 2){
			      $consulta_profesional = "SELECT a.agenda_id, CONCAT(c.nombre,' ',c.apellido) AS 'colaborador'
                       FROM agenda AS a
                       INNER JOIN colaboradores AS c
                       ON a.colaborador_id = c.colaborador_id
					   INNER JOIN pacientes AS p 
                       ON a.pacientes_id = p.pacientes_id
                       WHERE a.pacientes_id = '$pacientes_id' AND CAST(a.fecha_cita AS DATE) = '$fecha' AND c.puesto_id = 1 AND a.servicio_id = '$servicio_id'";
				  $result_profesional = $mysqli->query($consulta_profesional) or die($mysqli->error);
					   
			      $otro_profesional = $result_profesional->fetch_assoc();
				  $profesional_nombre_psicologo = $otro_profesional['colaborador'];
			   }else{
				  $profesional_nombre_psicologo = "";
			   }
			   
			   if($puesto_id == 1){
			      $consulta_profesional = "SELECT a.agenda_id, CONCAT(c.nombre,' ',c.apellido) AS 'colaborador' 
                       FROM agenda AS a
                       INNER JOIN colaboradores AS c
                       ON a.colaborador_id = c.colaborador_id
                       WHERE a.pacientes_id = '$pacientes_id' AND CAST(a.fecha_cita AS DATE) = '$fecha' AND c.puesto_id = 2 AND a.servicio_id = '$servicio_id'";
				  $result_profesional = $mysqli->query($consulta_profesional) or die($mysqli->error);
					   
			      $otro_profesional = $result_profesional->fetch_assoc();
				  $profesional_nombre_psiquiatra = $otro_profesional['colaborador'];
			   }else{
				  $profesional_nombre_psiquiatra = "";
			   }			   
                		
               $color = $registro2['color'];		
               $estatus = "";
			   
			   if($color == '#008000'){
				   $estatus = '(pv)';
			   }
			   
               if ($registro2['telefono']=="" || $registro2['telefono']==0)
		          $telefono = "";
	           else
		          $telefono = $registro2['telefono'];
	  
              if ($registro2['telefono1']=="")
		         $telefono1 = "";
	          else
		         $telefono1 = $registro2['telefono1'];	  
	  
	  
               if ($registro2['telefonoresp']=="" || $registro2['telefonoresp']==0)
		           $telefonoresponsable = "";
	           else
	               $telefonoresponsable = $registro2['telefonoresp'];
	 
               if ($registro2['telefonoresp1']=="" || $registro2['telefonoresp1']==0)
		         $telefonoresponsable1 = "";
	           else
	             $telefonoresponsable1 = $registro2['telefonoresp1'];	
	 
	           $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $valor);
    		   
	           if( strlen($registro2['identidad'])<10 ){
		         $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", 'No porta identidad', PHPExcel_Cell_DataType::TYPE_STRING);		   
	           }else{
		         $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", $registro2['identidad'], PHPExcel_Cell_DataType::TYPE_STRING);
	           }
		   
	           if($registro2['confirmo_resp'] == 1){
		          $resp = "Sí";
	           }else if($registro2['confirmo_resp'] == 2){
		          $resp = "No";
	           }else{
				  $resp = ""; 
			   }
			   
               $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $expediente);
               $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['nombre']);
               $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $registro2['apellido']." ".$estatus);
               $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['fecha']);		   
               $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $registro2['hora']);
               $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $telefono);
               $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $telefono1);
		       $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $telefonoresponsable);
               $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $telefonoresponsable1);
               $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['observacion']);
               $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['comentario']);
               $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $resp);
               $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['confirmo_observacion']);			   
               $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:O$fila");
			   $valor++;
		   }
           $fila+=1;
           $valor = 1;		   
	   }  	   
   }	
}

$objPHPExcel->removeSheetByIndex(
  $objPHPExcel->getIndex(
      $objPHPExcel->getSheetByName('Worksheet')
  )
);
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setDifferentOddEven(false);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P / &N'); 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="REPORTE AGENDA DIARIA DE USUARIOS '.strtoupper($mes).' '.$dia.', '.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$result_agenda->free();//LIMPIAR RESULTADO
$result_profesional->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>