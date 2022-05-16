<?php
require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','',12);

//Cell(width , height , text , border , end line , [align] )

//normal row height=5.

$pdf->Cell(20,10,'ID',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(50,10,'Name',1,0); //vertically merged cell
$pdf->Cell(100,5,'Score',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(20,10,'Passing',1,0); //vertically merged cell
$pdf->Cell(0,5,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible 

//second line(row)
$pdf->Cell(70,5,'',0,0); //dummy cell to align next cell, should be invisible
$pdf->Cell(25,5,'q1',1,0);
$pdf->Cell(25,5,'q2',1,0);
$pdf->Cell(25,5,'q3',1,0);
$pdf->Cell(25,5,'q4',1,1);

//data rows
$pdf->Cell(20,5,'',1,0);
$pdf->Cell(50,5,'',1,0);
$pdf->Cell(25,5,'',1,0);
$pdf->Cell(25,5,'',1,0);
$pdf->Cell(25,5,'',1,0);
$pdf->Cell(25,5,'',1,0);
$pdf->Cell(20,5,'',1,0);
//....



$pdf->Output();
?>
