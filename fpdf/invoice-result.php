<?php
require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'GEMUL APPLIANCES.CO',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'[Street Address]',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'[City, Country, ZIP]',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$_POST['date'],0,1);//end of line

$pdf->Cell(130	,5,'Phone [+12345678]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$_POST['id'],0,1);//end of line

$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,'Customer ID',0,0);
$pdf->Cell(34	,5,$_POST['custId'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$_POST['name'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$_POST['company'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$_POST['address'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$_POST['phone'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Description',1,0);
$pdf->Cell(25	,5,'Taxable',1,0);
$pdf->Cell(34	,5,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130	,5,$_POST['item1name'],1,0);
$pdf->Cell(25	,5,$_POST['item1tax'],1,0);
$pdf->Cell(34	,5,$_POST['item1amount'],1,1,'R');//end of line

$pdf->Cell(130	,5,$_POST['item2name'],1,0);
$pdf->Cell(25	,5,$_POST['item2tax'],1,0);
$pdf->Cell(34	,5,$_POST['item2amount'],1,1,'R');//end of line

$pdf->Cell(130	,5,$_POST['item3name'],1,0);
$pdf->Cell(25	,5,$_POST['item3tax'],1,0);
$pdf->Cell(34	,5,$_POST['item3amount'],1,1,'R');//end of line

//summary
$subtotal=$_POST['item1amount']+$_POST['item2amount']+$_POST['item3amount'];
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,$subtotal,1,1,'R');//end of line

$tax=$_POST['item1tax']+$_POST['item2tax']+$_POST['item3tax'];
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Taxable',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,$tax,1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Tax Rate',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,'10%',1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Due',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,$subtotal+$tax,1,1,'R');//end of line





















$pdf->Output();
?>
