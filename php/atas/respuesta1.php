<?php
session_start();   
include('../funtions.php');
require('../../fpdf/fpdf.php');
	
//CONEXION A DB
$mysqli = connect_mysqli(); 

class PDF extends FPDF{
   // Cabecera de página
   function Header(){
      // Logo
      $this->Image('../../img/logo.png',10,8,60);
      // Arial bold 15
      $this->SetFont('Arial','B',15);
      // Movernos a la derecha
      $this->Cell(80);
      // Título
      $this->Cell(30,10,'Secretaria de Salud',0,0,'C');
      // Salto de línea
      $this->Ln(20);
   }
    
   // Pie de página
   function Footer(){
      // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Número de página
      $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }
}

//CONSULTAR EN BASE DE DATOS
$query = "SELECT * 
   FROM users
   WHERE estatus = 1";
$result = $mysqli->query($query);
/*********************************/	

$pdf = new PDF();
$pdf->AliasNBPages();//Para que pueda asignar los numeros de páginas
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->Cell(20,10, utf8_decode('Usuario'),1,0,'C',0);
$pdf->Cell(70,10, utf8_decode('Email'),1,0,'C',0);
$pdf->Cell(50,10, utf8_decode('Fecha Registro'),1,1,'C',0);
	
while($registro2 = $result->fetch_assoc()){
	$pdf->Cell(20,10, $registro2['username'],1,0,'C',0);
	$pdf->Cell(70,10, $registro2['email'],1,0,'C',0);
	$pdf->Cell(50,10, $registro2['fecha_registro'],1,1,'C',0);
}

$pdf->Output();
?>