<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require('fpdf/fpdf.php');
require('fpdi/src/autoload.php');

     

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('pdf/demande.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('P');
$pdf->useImportedPage($pageId, 0, 0, 297,420,true);
$pdf->SetFont('Arial','',18);

// depot
$pdf->Text(30,50,'IDNUMBER '); //n_depot
$pdf->Text(250,195,'Visit '); //nomprenom

$pdf->Text(150,195,'Soltani '); //cin

$pdf->Text(97,195,'Reason '); //raison

$pdf->Text(230,208,'Mode '); //Num

$pdf->Text(81,220,'Titre '); //Lieu 

$pdf->Text(182,235,'Support '); //date

$pdf->Text(190,249,'Genre '); //adresse

$pdf->Text(196,262,'12/09 ');  //TEL
$pdf->Text(150,262,'13/09 '); //FAX
/*$pdf->Text(250,138,'Reason '); //EMAIL


//Auteur

$pdf->Text(20,54,'Reason '); //Nom auteur

//Oeuvre

$pdf->Text(20,87,'Reason '); //NOM

$pdf->Text(20,107,'Reason '); //DESC


$pdf->Text(95,145,'Reason '); //Genre

$pdf->Text(20,158,'Reason ');  //SUPPORT

//DATE
$pdf->Text(200,278,'Reason ');  //SUPPORT

//QUITANCE
$pdf->Text(340,280,'Reason ');  //SUPPORT
*/
$pdf->Output();
?>
