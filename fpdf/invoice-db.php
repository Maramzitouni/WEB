<?php
session_start();
require('fpdf17/fpdf.php');
$con=mysqli_connect('loyaltimaram.mysql.db','loyaltimaram','52499801mZ');
mysqli_select_db($con,'loyaltimaram');

// Return current date from the remote server
$date = date('d-m-y h:i:s');

$price=$_GET['price'];
$product=$_GET['product'];
/*$query=mysqli_query($con,"select * from invoice
	inner join clients using(clientID)
	where
	invoiceID = '".$_GET['invoiceID']."'");
$invoice=mysqli_fetch_array($query); */


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'LoyaltyCard',0,0);
$pdf->Cell(59	,5,'Facture',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Paris 75007',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'   France',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$date,0,1);//end of line

$pdf->Cell(130	,5,'Phone 06356041',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,'invoiceID',0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Client ID',0,0);
$pdf->Cell(34	,5,$_SESSION['user_id'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Facture de',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$_SESSION['full_name'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'company',0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'address',0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'phone',0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Description',1,0);
$pdf->Cell(25	,5,'Tax',1,0);
$pdf->Cell(34	,5,'Total',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
/*$query=mysqli_query($con,"select * from item where invoiceID = '".$invoice['invoiceID']."'");
$tax=0;
$amount=0;
while($item=mysqli_fetch_array($query)){
	$pdf->Cell(130	,5,$item['itemName'],1,0);
	$pdf->Cell(25	,5,number_format($item['tax']),1,0);
	$pdf->Cell(34	,5,number_format($item['amount']),1,1,'R');//end of line
	$tax+=$item['tax'];
	$amount+=$item['amount'];
} */

$tax=30;
//summary
$pdf->Cell(130	,5,$product,0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(4	,5,'eu',1,0);
$pdf->Cell(30	,5,number_format($price-$tax),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Taxable',0,0);
$pdf->Cell(4	,5,'e',1,0);
$pdf->Cell(30	,5,number_format($tax),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Tax Rate',0,0);
$pdf->Cell(4	,5,'e',1,0);
$pdf->Cell(30	,5,'10%',1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Due',0,0);
$pdf->Cell(4	,5,'e',1,0);
$pdf->Cell(30	,5,number_format($price),1,1,'R');//end of line


$pdf->Output();
$id=$_SESSION['user_id'];

$filename="factures/tests1.pdf";
$pdf->Output($filename,'F');




// email stuff (change data below)
$to = "zitouni.maram20@gmail.com";
$from = "loyaltycard@contact.com";
$subject = "Merci pour votre commande !";
$message = "<p>Veuillez trouver votre facture en pièce jointe</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename1 = "facture.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "Bonjour, Merci pour votre achat !".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename1."\"".$eol;
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
mail($to, $subject, $body, $headers);






















?>
