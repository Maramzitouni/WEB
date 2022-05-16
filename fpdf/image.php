<?php
require('fpdf17/fpdf.php');

class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('logo-small.png',10,10,10);
		
		$this->Cell(100,10,'Student Scoring Report',0,1);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
	}
	function Footer(){
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->AddPage();

//Image( file name , x position , y position , width [optional] , height [optional] )
$pdf->Image('watermark.png',10,10,189);

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
$pdf->Cell(70,5,'',0,0);   //dummy cell to align next cell, should be invisible
$pdf->Cell(25,5,'q1',1,0); 
$pdf->Cell(25,5,'q2',1,0); 
$pdf->Cell(25,5,'q3',1,0); 
$pdf->Cell(25,5,'q4',1,1); 

$pdf->SetFont('Arial','',11);
//data rows
for($i=1;$i<=20;$i++){
	$pdf->Cell(20,5,$i,'LR',0,'R');
	$pdf->Cell(50,5,'Student '.$i,'LR',0);
	$pdf->Cell(25,5,rand(70,100),'LR',0);
	$pdf->Cell(25,5,rand(70,100),'LR',0);
	$pdf->Cell(25,5,rand(70,100),'LR',0);
	$pdf->Cell(25,5,rand(70,100),'LR',0);
	$pdf->Cell(20,5,'Passed','LR',1);
}
	$pdf->Cell(190,5,'','T',1);




$pdf->AddPage();
$pdf->AddPage();
$pdf->AddPage();















$pdf->Output();
?>
