<?php
session_start();   
include('../funtions.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 
$postreSQL = connect_postgreSQL(); 

//ajuntar la libreria excel
include "../../PHPExcel/Classes/PHPExcel.php";
date_default_timezone_set('America/Tegucigalpa');

$fechai = '2021-03-21';
$fechaf = '2021-03-31';

$diai = date("d", strtotime($fechai));
$mesi = date("m", strtotime($fechai));
$añoi = date("Y", strtotime($fechai));

$diaf = date("d", strtotime($fechaf));
$mesf = date("m", strtotime($fechaf));
$añof = date("Y", strtotime($fechaf));

$centro = '160'; //CODIGO DE CENTRO
$servicio = '01'; //CODIGO DE SERVICIO 
/*
  01 AMBILATORIO, 02 PROCEDIMIENTO, 03 REHABILITACION, 04 HOSPITALIZACION, 05 CENTRO QUIRURGICO, 
  06 FARMACIA, 07 LABORATORIO, 08 IMAGENES, 09 TECAR, 10 EMERGENCIA
*/

$nombre_archivo = $añoi.$mesi.$diai.'_'.$añof.$mesf.$diaf.'_'.$centro.$servicio;

/*$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$servicio = $_GET['servicio'];
$unidad = $_GET['unidad'];
$profesional = $_GET['profesional'];
$colaborador_usuario = $_GET['colaborador_usuario'];

$mes=nombremes(date("m", strtotime($desde)));
$mes1=nombremes(date("m", strtotime($hasta)));
$año=date("Y", strtotime($desde));
$año2=date("Y", strtotime($hasta));

//INICIO CONSULTA DE FECHAS PARA EVALUAR EL PRIEMR DIA DEL AÑO PARA ENERO Y EL ULTIMO DIA DEL AÑO PARA DICIEMBRE
$año_actual = date("Y", strtotime($desde));
$mes_actual = date("m", strtotime($desde));
$dia = date("d", mktime(0,0,0, $mes_actual+1, 0, $año_actual));

$dia1 = date('d', mktime(0,0,0, $mes_actual, 1, $año_actual)); //PRIMER DIA DEL MES
$dia2 = date('d', mktime(0,0,0, $mes_actual, $dia, $año_actual)); // ULTIMO DIA DEL MES

$fecha_inicial = date("Y-m-d", strtotime($año_actual."-".$mes_actual."-".$dia1));
$fecha_final = date("Y-m-d", strtotime($año_actual."-".$mes_actual."-".$dia2));
//FIN CONSULTA DE FECHAS PARA EVALUAR EL PRIEMR DIA DEL AÑO PARA ENERO Y EL ULTIMO DIA DEL AÑO PARA DICIEMBRE

//OBTENER NOMBRE SERVICIO
$consulta_servicio = "SELECT nombre 
     FROM servicios 
	 WHERE servicio_id = '$servicio'";
$result = $mysqli->query($consulta_servicio) or die($mysqli->error);
$consulta_servicio1 = $result->fetch_assoc();
$servicio_name = $consulta_servicio1['nombre'];

$colaborador_name = "";
$atencion = "";

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
if($servicio != "" && $unidad == "" && $profesional == "" && $colaborador_usuario == ""){
    $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio'";		
}else if ($servicio != "" && $unidad != "" && $profesional == "" && $colaborador_usuario == ""){
    $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad'";				
}else if ($servicio != "" && $unidad != "" && $profesional != "" && $colaborador_usuario == ""){
    $where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.colaborador_id = '$profesional'";
}else{
	//OBTENERR NOMBRE COLABORADOR/USUARIO DEL SISTEMA
    $consulta_colaborador_nombre = "SELECT CONCAT(apellido,' ',nombre) AS 'usuario' 
	     FROM colaboradores 
	     WHERE colaborador_id = '$colaborador_usuario'";
	$result = $mysqli->query($consulta_colaborador_nombre);
    $consulta_colaborador_nombre2 = $result->fetch_assoc();
    $colaborador_name = $consulta_colaborador_nombre2['usuario'];
	
	$atencion = " Realizado por: ".$colaborador_name;
	
	$where = "WHERE a.fecha BETWEEN '$desde' AND '$hasta' AND a.servicio_id = '$servicio' AND c.puesto_id = '$unidad' AND a.usuario = '$colaborador_usuario'";
}*/
	
$registro = "SELECT p.expediente AS 'expediente', CONCAT('AMBULATORIO') AS 'lina_negocio', UCASE(pc.nombre) AS 'servicio', CONCAT('Prioridad I') AS 'procedimiento', DATE_FORMAT(a.fecha, '%d/%m/%Y') AS 'fecha_atencion', a.fecha AS 'fecha_factura', REPLACE(c.identidad,'-', '') AS 'dni_medico', CONCAT(UCASE(c.nombre), ' ', UCASE(c.apellido)) AS 'especialista', REPLACE(p.identidad,'-', '') AS 'dni_paciente',  CONCAT(UCASE(p.nombre), ' ', UCASE(p.apellido)) AS 'paciente', CONVERT(a.años, SIGNED INTEGER) AS 'edad', (CASE WHEN p.sexo = 'M' THEN 'F' ELSE 'M' END) AS 'sexo',  CONCAT('PARTICULAR') AS 'tipo_paciente', CONCAT('PARTICULAR') AS 'descripcion_tipo_paciente', REPLACE(REPLACE(pato1.patologia_id, '.', ''),'-G40','') AS 'CIE10_1', REPLACE(REPLACE(COALESCE(pato2.patologia_id, ''), '.', ''),'-G40','') AS 'CIE10_2', REPLACE(REPLACE(COALESCE(pato3.patologia_id, ''), '.', ''),'-G40','') AS 'CIE10_3',  CONCAT('') AS 'CIE10_4', (CASE WHEN a.paciente = 'N' THEN 'Nuevo' ELSE 'Continuidad' END) AS 'N_C_ESTABLECIMIENTO', (CASE WHEN a.paciente = 'N' THEN 'Nuevo' ELSE 'Continuidad' END) AS 'N_C_SERVICIO', CONVERT(CONCAT('50.00'), SIGNED INTEGER) AS 'venta', CONVERT(CONCAT('1'), SIGNED INTEGER) AS 'dias_hosp'
FROM ata AS a
INNER JOIN pacientes AS p
ON a.expediente = p.expediente
INNER JOIN colaboradores AS c
ON a.colaborador_id = c.colaborador_id
INNER JOIN puesto_colaboradores AS pc
ON c.puesto_id = pc.puesto_id
INNER JOIN patologia AS pato1
ON a.patologia_id = pato1.id
LEFT JOIN patologia AS pato2
ON a.patologia_id1 = pato2.id
LEFT JOIN patologia AS pato3
ON a.patologia_id2 = pato3.id
WHERE a.fecha BETWEEN '$fechai' AND '$fechaf' AND a.servicio_id IN(1,6)
ORDER BY a.fecha";
$result = $mysqli->query($registro) or die($mysqli->error);	  

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("ING. EDWIN VELASQUEZ"); //autor
$objPHPExcel->getProperties()->setTitle("Hoja1"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Hoja1"); //establecer titulo de hoja
 
//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 
//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->freezePane('A2'); //INMOVILIZA PANELES 
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
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'LINEA DE NEGOCIOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'SERVICIO');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'DETALLE DEL SERVICIO/PROCEDIMIENTO');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'FECHA ATENCION');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18); 
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'DNI MEDICO');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'ESPECIALISTA');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'DNI PACIENTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'PACIENTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'EDAD');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'SEXO');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'TIPO DE PACIENTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'DESCRIPCION TIPO PACIENTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(17);
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'DIAGNOSTICO 1 CIE 10');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'DIAGNOSTICO 2');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'DIAGNOSTICO 3');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'DIAGNOSTICO 4');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'N_C ESTABLECIMIENTO');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'N_C SERVICIO');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'VALOR VENTA SIN IMPUESTOS');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'CANTIDAD/DIAS HOSP');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'ORDEN DE ATENCION / PREFACTURA / ACTO MEDICO');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:U$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:U$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido
$valor = 1;
if($result->num_rows>0){
	while($registro2 = $result->fetch_assoc()){
	   //CONSULTAMOS EL ID DEL CLIENTE EN ODOO
	   $expediente = $registro2['expediente'];
	   $fecha_factura = $registro2['fecha_factura'];
	   
	   $query_odoo_cliente = "SELECT id 
			FROM res_partner 
			WHERE ref = '$expediente'";
	   $resultado_busqueda_cliente = pg_query($postreSQL, $query_odoo_cliente); 
	   $resultado_busqueda_cliente_array = pg_fetch_array($resultado_busqueda_cliente);
	   $partner_id = $resultado_busqueda_cliente_array['id'];
	   
	   //OBTENEMOS EL VALOR TOTAL DEL PAGO DE LA FACTURA Y EL NUMERO DE LA FACTURA
	   $query_odoo_factura = "SELECT move_name, amount_total 
			FROM account_invoice 
			WHERE partner_id = '$partner_id' AND date_due = '$fecha_factura'";
	   $resultado_busqueda_factura = pg_query($postreSQL, $query_odoo_factura); 
	   $resultado_busqueda_factura_array = pg_fetch_array($resultado_busqueda_factura);
	   $valor = $resultado_busqueda_factura_array['amount_total'];
	   $number = $resultado_busqueda_factura_array['move_name'];
	   
	   $fila+=1;
	          
	   $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $registro2['lina_negocio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $registro2['servicio']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $registro2['procedimiento']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $registro2['fecha_atencion']);
	   $objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", $registro2['dni_medico'], PHPExcel_Cell_DataType::TYPE_STRING);
	   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $registro2['especialista']);
	   $objPHPExcel->getActiveSheet()->setCellValueExplicit("G$fila", $registro2['dni_paciente'], PHPExcel_Cell_DataType::TYPE_STRING);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $registro2['paciente']);
       $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $registro2['edad']);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $registro2['sexo']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $registro2['tipo_paciente']);
       $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $registro2['descripcion_tipo_paciente']);	   
	   $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $registro2['CIE10_1']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $registro2['CIE10_2']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $registro2['CIE10_3']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $registro2['CIE10_4']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $registro2['N_C_ESTABLECIMIENTO']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $registro2['N_C_SERVICIO']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $valor);	 
	   $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $registro2['dias_hosp']);
	   $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $number);//Este será el número de factura 
	   $valor++;
   }	
}
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
header('Content-Disposition: attachment; filename="'.$nombre_archivo.'.xls"');
header("Pragma: no-cache"); 
header("Expires: 0");  
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');

$result->free();//LIMPIAR RESULTADO
$mysqli->close();//CERRAR CONEXIÓN
?>