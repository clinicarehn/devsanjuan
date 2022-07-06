<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
date_default_timezone_set('America/Tegucigalpa');
//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
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

$servicio_name = "";

if($servicio !=0){
	//OBTENER NOMBRE SERVICIO
	$consulta_servicio = "SELECT nombre 
		FROM servicios 
		WHERE servicio_id = '$servicio'";
	$result = $mysqli->query($consulta_servicio);
	$consulta_servicio1 = $result->fetch_assoc();
	$servicio_name = "Servicio ".$consulta_servicio1['nombre'];	
}

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

//CONSULTA NIVELES
$consulta_niveles = "SELECT * 
    FROM niveles_centros";
$result_niveles = $mysqli->query($consulta_niveles);	
 
$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("CENTROS" ); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 13
    )
));

$titulo1 = new PHPExcel_Style(); //nuevo estilo
$titulo1->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false
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

$bordes1 = new PHPExcel_Style(); //nuevo estilo
 
$bordes1->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
	'alignment' => array( //alineacion
      'wrap' => true
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 13
    )
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("CENTROS"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('A6'); //INMOVILIZA PANELES
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
$objDrawing->setHeight(60); //Alto
$objDrawing->setWidth(170); //Ancho
$objDrawing->setCoordinates('D1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: establecer margenes
 
//incluir imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../../img/logo.png'); //ruta
$objDrawing->setHeight(40); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);

$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($empresa_nombre));
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "CONTROL DE CENTROS POR NIVELES");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "REFERENCIAS RECIBIDAS Y RESPUESTAS ENVIADAS");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "Desde: $mes $año Hasta: $mes1 $año2");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:D$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'CENTRO');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NIVEL');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);  
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'GRUPO');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:D$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:D$fila")->getFont()->setBold(true); //negrita

//rellenar con contenido
$total_centros = 0;
//MUESTRA EL DETALLE DE CADA UNO DE LOS CENTROS
if($result_niveles->num_rows>0){
	//CESAMO
	if($result_niveles->num_rows>0){
		while($registro_niveles1 = $result_niveles->fetch_assoc()){
		   $nivel_id = $registro_niveles1['niveles_centros_id'];
		   
		   //CONSULTAR LOS GRUPOS PARA CADA NIVEL
		   $consulta_grupos_nivel = "SELECT *
		      FROM niveles_grupos
			  WHERE niveles_centros_id = '$nivel_id'";
		   $result_grupos_nivel = $mysqli->query($consulta_grupos_nivel);
		   
		   if($result_grupos_nivel->num_rows>0){
			   while($registro_grupos_nivel1 = $result_grupos_nivel->fetch_assoc()){
				   $grupo_niveles_grupo_id  = $registro_grupos_nivel1['niveles_grupo_id'];
				   
					if($servicio !=0){
						$where = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta' AND ch.centro_id = '$grupo_niveles_grupo_id' AND rc.servicio_id = '$servicio'";						
					}else{
						$where = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta' AND ch.centro_id = '$grupo_niveles_grupo_id'";
					}
				   
				   //CONSULTAMOS LA CANTIDAD DE CENTROS SEGUN EL GRUPO
				   $consulta_centros = "SELECT ch.centro_nombre AS 'centro', COUNT(rc.referenciar_id ) AS 'total', ng.nombre AS 'centro_grupo', nc.nombre AS 'nivel'
						FROM referencia_recibida AS rc
						INNER JOIN centros_hospitalarios AS ch
						ON rc.unidad_envia = ch.centros_id
						INNER JOIN niveles_grupos AS ng
						ON rc.centro = ng.niveles_grupo_id
						INNER JOIN niveles_centros AS nc
						ON rc.nivel = nc.niveles_centros_id
						".$where."
						GROUP BY ch.centro_nombre
						ORDER BY nc.nombre";
				  $result_centros = $mysqli->query($consulta_centros);
				  						
				   if($result_centros->num_rows>0){
					   while($registro_centros1 = $result_centros->fetch_assoc()){
						   $fila+=1;
						   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro_centros1['centro']);
						   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_centros1['total']);
						   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro_centros1['nivel']);
						   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro_centros1['centro_grupo']);
						   $total_centros = $total_centros + $registro_centros1['total'];
						   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:D$fila");
					   }
				   }  
			   }	
		   }	   
     }	
   }	
}

$fila+=1;

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $total_centros);
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "A$fila:D$fila");

//CONSULTAR TOTAL DE NIVELES NIVELES
$fila+=2;
$total_niveles = 0;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'NIVEL');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:B$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:B$fila")->getFont()->setBold(true); //negrita

if($servicio !=0){
	$where = "WHERE rc.fecha BETWEEN '$desde' AND rc.servicio_id = '$servicio'";	
}else{
	$where = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta'";
}
					
$consulta_total_niveles = "SELECT nc.nombre AS 'nivel', COUNT(rc.nivel) AS 'total'
FROM referencia_recibida AS rc
INNER JOIN niveles_centros nc
ON rc.nivel = nc.niveles_centros_id
".$where."
GROUP BY nc.nombre";
$result_total_niveles = $mysqli->query($consulta_total_niveles);

if($result_total_niveles->num_rows>0){
	while($registro_total_niveles1 = $result_total_niveles->fetch_assoc()){
	   $fila+=1;
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro_total_niveles1['nivel']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_total_niveles1['total']);
	   $total_niveles = $total_niveles + $registro_total_niveles1['total'];
	   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:B$fila");		
	}
}

$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $total_niveles);
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "A$fila:B$fila");


//CONSULTAR TOTAL DE NIVELES Y LOS CLASIFICA POR GRUPOS
//CONSULTAR NIVELES
$fila+=2;
$consulta_niveles_agrupada = "SELECT * 
    FROM niveles_centros";	
$result_niveles_agrupada = $mysqli->query($consulta_niveles_agrupada);

$total_niveles_grupos = 0;

if($result_niveles_agrupada->num_rows>0){
	while($registro_niveles_agrupada1 = $result_niveles_agrupada->fetch_assoc()){
		$fila+=1;
		$nivel_id = $registro_niveles_agrupada1['niveles_centros_id'];
		
		if($servicio !=0){
	        $where_consulta = "WHERE rc.fecha BETWEEN '$desde' AND rc.nivel = '$nivel_id' AND rc.servicio_id = '$servicio'";	
        }else{
	        $where_consulta = "WHERE rc.fecha BETWEEN '$desde' AND '$hasta' AND rc.nivel = '$nivel_id'";
        }

		$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", strtoupper($registro_niveles_agrupada1['nombre']));
		$objPHPExcel->getActiveSheet()->mergeCells("A$fila:B$fila"); //unir celdas
		$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:B$fila");
		$fila+=1;
		$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'GRUPOS');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
		$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TOTAL');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:B$fila"); //establecer estilo
		$objPHPExcel->getActiveSheet()->getStyle("A$fila:B$fila")->getFont()->setBold(true); //negrita
		$consultar_total_grupos = "SELECT ng.nombre AS 'grupo', COUNT(rc.centro) AS 'total'
			FROM referencia_recibida AS rc
			INNER JOIN niveles_grupos ng
			ON rc.centro = ng.niveles_grupo_id
			".$where_consulta."
			GROUP BY rc.centro
			ORDER BY ng.niveles_grupo_id";
		$result_total_grupos = $mysqli->query($consultar_total_grupos);
		
		if($result_total_grupos->num_rows>0){
			while($registro_total_grupos1 = $result_total_grupos->fetch_assoc()){
				$fila+=1;
				$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro_total_grupos1['grupo']);
				$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro_total_grupos1['total']);
				$total_niveles_grupos = $total_niveles_grupos + $registro_total_grupos1['total'];
				$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:B$fila");				
			}	
		}		
	}
}
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $total_niveles_grupos);
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "A$fila:B$fila");	
	
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
header('Content-Disposition: attachment; filename="CONTROL DE CENTROS_RR '.strtoupper($mes).'_'.$año.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0"); 
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result_cesamo->free();//LIMPIAR RESULTADO
$result_privados->free();//LIMPIAR RESULTADO
$result_otros->free();//LIMPIAR RESULTADO
$result_hospitales->free();//LIMPIAR RESULTADO
$result_hospitales_privados->free();//LIMPIAR RESULTADO
$result_hospitales_otros->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>