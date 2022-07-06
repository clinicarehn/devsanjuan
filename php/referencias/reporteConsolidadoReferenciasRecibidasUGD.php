<?php 
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$referencia = $_GET['referencia'];
$años = $_GET['años'];
$servicio = $_GET['servicio'];	

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

$fecha_inicial = date("Y-m-d", strtotime($años."-01-01"));
$fecha_final = date("Y-m-d", strtotime($años."-12-31"));

if($servicio != 0){
	$consultar_servicio = "SELECT nombre 
	   FROM servicios 
	   WHERE servicio_id = '$servicio'";
	$result = $mysqli->query($consultar_servicio);
	$consultar_servicio1 = $result->fetch_assoc();
	$nombre_servicio = $consultar_servicio1['nombre'];
	
	$where = "WHERE rr.servicio_id = '$servicio' AND rr.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
}else{
	$nombre_servicio = "";
	$where = "WHERE rr.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
}

$mes=nombremes(date("m", strtotime($fecha_inicial)));
$mes1=nombremes(date("m", strtotime($fecha_final)));
$año=date("Y", strtotime($fecha_inicial));
$año2=date("Y", strtotime($fecha_final));

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT COUNT(a.ata_id) AS 'n_atenciones', COUNT(rr.referenciar_id) AS 'n_referencias', COUNT(rr.referenciar_id) as 'n_respuestas'
    FROM ata AS a
    LEFT JOIN referencia_recibida AS rr
    ON a.ata_id = rr.ata_id
    ".$where;

$result = $mysqli->query($registro);
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Referencias Enviadas"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 12
    )
));
 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('font' => array( //fuente
      'arial' => true,
	  'bold' => true,
      'size' => 11
    ),	
	'alignment' => array( //alineacion
      'wrap' => true,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'bfbfbf')
    ),
	'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$texto = new PHPExcel_Style(); //nuevo estilo
$texto->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
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
 
$other = new PHPExcel_Style(); //nuevo estilo
$other->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
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
$objPHPExcel->getActiveSheet()->setTitle("Referencias Enviadas"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('B6'); //INMOVILIZA PANELES
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

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/sesal_logo.png'); //ruta
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('F1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(160); //altura
$objDrawing->setWidth(138); //anchura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
 
$fila=1;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A3:F3");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $empresa_nombre);
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:F$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:F$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A4:F4");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Consolidado Anual de Referencias y Respuestas Según Atenciones Brindadas $nombre_servicio");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:F$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:F$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A5:F5");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:F$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:F$fila");

$fila=4;
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Mes');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->mergeCells("A4:A5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'N° Atenciones Brindadas (Nuevas y Subsiguientes)');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30); 
$objPHPExcel->getActiveSheet()->mergeCells("B4:B5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Referencias Recibidas');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(42); 
$objPHPExcel->getActiveSheet()->mergeCells("C4:D4"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Respuestas Enviadas');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(42); 
$objPHPExcel->getActiveSheet()->mergeCells("E4:F4"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:F$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:F$fila")->getFont()->setBold(true); //negrita

$fila=5; 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(21);
$objPHPExcel->getActiveSheet()->mergeCells("C5:C5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '%');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(21);
$objPHPExcel->getActiveSheet()->mergeCells("D5:D5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'N°');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(21);
$objPHPExcel->getActiveSheet()->mergeCells("E5:E5"); //unir celdas

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '%');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(21);
$objPHPExcel->getActiveSheet()->mergeCells("F5:F5"); //unir celdas

$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:F$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:F$fila")->getFont()->setBold(true); //negrita
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	$mes = 01;
	while($mes <= 12){	
        $last_day = getUltimoDiaMes($año,$mes);	

        $fecha_inicial = date("Y-m-d", strtotime($año."-$mes-01"));
        $fecha_final = date("Y-m-d", strtotime($año."-$mes-$last_day"));		
		
		//INICIO CONSULTAR CANTIDAD DE REFERENCIAS
        if($servicio != 0){
	       $where = "WHERE rr.servicio_id = '$servicio' AND rr.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
        }else{
	       $where = "WHERE rr.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
        }
   
        $registro = "SELECT COUNT(a.ata_id) AS 'n_atenciones', COUNT(rr.referenciar_id) AS 'n_referencias', COUNT(rr.referenciar_id) as 'n_respuestas' 
            FROM ata AS a 
            LEFT JOIN referencia_recibida AS rr
            ON a.ata_id = rr.ata_id 
            ".$where;
	   $result_registro = $mysqli->query($registro);
       //FIN CONSULTAR CANTIDAD DE REFERENCIAS
			
		//INICIO CONSULTAR CANTIDAD DE REFERENCIAS
        if($servicio != 0){
	       $where_ata = "WHERE a.servicio_id = '$servicio' AND a.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
        }else{
	       $where_ata = "WHERE a.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";
        }
   
        $registro_ata = "SELECT COUNT(a.ata_id) AS 'n_atenciones'
            FROM ata AS a
            ".$where_ata;
		$result_registro_ata = $mysqli->query($registro_ata);
       //FIN CONSULTAR CANTIDAD DE REFERENCIAS	 
	   
       //INICIO CONSULTAR RESPUESTAS RECIBIDAS	     	   	   	   
   
       //CONSULTAMOS LA CANTIDAD DE REGISTROS PARA PODER LLENAR LOS MESEES EN LA CASILLA MES DEL EXCEL
       while($registro2 = $result_registro->fetch_assoc()){
		  $fila+=1;
		  $nombre_mes = nombremes($mes);
	      $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $nombre_mes);
		  		 	 
		  //CONSULTAMOS LA CANTIDAD DE ATENCIONES PARA LLENAR EL EXCEL
		  while($registro_ata2 = $result_registro_ata->fetch_assoc()){
			  $n_atenciones_ata = $registro_ata2['n_atenciones'];
			  //LLENAMOS EL EXCEL CON EL NUMERO DE ATENCIONES
			  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $n_atenciones_ata);  
		  }
		  
		  $n_referencias = $registro2['n_referencias'];
		  //LLENAMOS EL EXCEL CON EL NUMERO DE REFERENCIAS QUE SE HAN ENVIADO
          $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $n_referencias);
		  
		  //CALCULAMOS EL PORCENTAJE DE REFERENCIAS ENVIADAS SEGUN LA CANTIDAD DE ATENCIONES	
		  //EVALUAMOS QUE LOS VALORES DEVUELTOS EN LA CANTIDAD DE ATENCIONES NO SEAN IGUAL A CERO PARA PODER OBTENER LOS PORCENTAJES DE REFERENCIAS
		  if($n_atenciones_ata != 0){
			 $porcentaje_referencias = ($n_referencias / $n_atenciones_ata) * 100; 
		  }else{
			  $porcentaje_referencias = 0;
		  }
		     		  
		  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", number_format($porcentaje_referencias,2));
		  $n_respuestas = $registro2['n_referencias'];
		  //LLENAMOS EL EXCEL CON EL NUMERO DE ATENCIONES
		  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $n_respuestas);  		  

		  //CALCULAMOS EL PORCENTAJE DE RESPUESTAS RECIBIDAS SEGUN EL NUMERO DE REFERENCIAS ENVIADAS	
		  //EVALUAMOS QUE LOS VALORES DEVUELTOS EN LA CANTIDAD DE REFERENCIAS NO SEAN IGUAL A CERO PARA PODER OBTENER LOS PORCENTAJE DE RESPUESTAS
		  if($n_referencias != 0){
			  $porcentaje_respuestas = ($n_respuestas / $n_referencias) * 100;
		  }else{
			  $porcentaje_respuestas = 0;
		  }
		  
		  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", number_format($porcentaje_respuestas,2));		  
	   }	   
	   $mes++;	   	   	  
       //Establecer estilo
       $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:F$fila");	
	   $valor++;
   }	
}

$fila+=5; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "HSJD_".strtoupper($mes)."_$año");
$fila+=1; 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Nombre y Firma del Responsable __________________________________________________________________________________"); 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setDifferentOddEven(false);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P / &N');

$objPHPExcel->removeSheetByIndex(
    $objPHPExcel->getIndex(
        $objPHPExcel->getSheetByName('Worksheet')
    )
);
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Consolidado de Referencias Recibidas UGD '.$nombre_servicio.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$result_registro->free();//LIMPIAR RESULTADO
$result_registro_ata->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>