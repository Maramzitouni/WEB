<?php
require('fpdf17/fpdf.php');

$pdf = new FPDF('P','mm','A4');

//add new freescript font
$pdf->AddFont('Freescript','','FREESCPT.php');

//add new jokerman font
$pdf->AddFont('Jokerman','','JOKERMAN.php');

//add alien league (regular)
$pdf->AddFont('Alien League','','alienleagueii.php');

//add alien league italic
$pdf->AddFont('Alien League','I','alienleagueiiital.php');

$pdf->AddPage();

//freescript font
$pdf->SetFont('Freescript','',36);
$pdf->Cell(190,20,'Freescript Font',0,1,'C');

//jokerman font
$pdf->SetFont('Jokerman','',36);
$pdf->Cell(190,20,'Jokerman Font',0,1,'C');

//alien league regular font
$pdf->SetFont('Alien League','',36);
$pdf->Cell(190,20,'Alien League Regular Font',0,1,'C');

//alien league italic font
$pdf->SetFont('Alien League','I',36);
$pdf->Cell(190,20,'Alien League Italic Font',0,1,'C');

$pdf->Output();
