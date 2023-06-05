<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<canvas id="myCanvas"></canvas>
<?php 
define('QUADODO_IN_SYSTEM', true);

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require('fpdf/fpdf.php');
require('fpdi/src/autoload.php');


require_once('check.php');
require_once('includes/header.php');
if ($qls->user_info['group_id'] != '5' && $qls->user_info['group_id'] != '1') {
    header('Location: index.php');
}
include_once("config.php");

if(isset($_GET['ID']))
{
    $dpid=$_GET['ID'];
    $qt_namefr=" ";
    $dp_date=" ";
    $dp_titre=" ";
    $dp_desc=" ";
    $dp_auteur=" ";
    $dp_support=" ";
    $qt_date_c=" ";
    $qt_date_e=" ";
    $Lng="";
    $cin="";
    $dp = mysqli_query($mysqli, "SELECT * FROM depot WHERE numero='".$dpid."'");
    $qt = mysqli_query($mysqli, "SELECT * FROM quitance WHERE id_depot='".$dpid."'");
    
    foreach($dp as $row)
        foreach($qt as $raw)
        {
            $qt_namefr=$raw['personne'];
            $dp_date=$row['date_sys'];
            $dp_titre=$row['titre_ouvre'];
            $dp_desc=$row['description'];
            $dp_auteur=$row['Auteur'];
            $dp_support=$row['support'];
            $qt_date_c=$raw['date_c'];
            $qt_date_e=$raw['date_e'];
            $Lng=$row['Lng'];
            $cin=$row['id_deposant'];
        }
        $dps_email="";
        $dps_adress="";
        $dps_tel="";
        $dps = mysqli_query($mysqli, "SELECT * FROM deposant WHERE cin=".$cin."");
        foreach($dps as $riw)
        {
            $dps_email=$riw['email'];
            $dps_adress=$riw['adresse'];
            $dps_tel=$riw['num_tel'];
        }
        if(strlen($cin)==7)
            $cin="0".$cin;
    
 
     
$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('pdf/redemande'.$Lng.'.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('P');
$pdf->useImportedPage($pageId, 0, 0, 297,420,true);
$pdf->SetFont('Arial','',16);

if($Lng=="FR"){

// depot
$pdf->Text(230,71,date('Y-m-d')); //Datein
$pdf->Text(168,229,$qt_namefr); //nomprenom

$pdf->Text(45,241,date('Y-m-d'));
$pdf->Text(215,241,$dp_date); //Date_dp

$pdf->Text(70,253,$dpid); //nbr_dp

$pdf->Text(95,276,$dp_titre); //Titre_ov


$pdf->Text(145,265,$dp_auteur); //Auteur

$pos=70;
$result=mysqli_query($mysqli,"select * from support where id_depot='$dpid'");
    foreach($result as $row3 ){

$pdf->Text($pos,290,$row3['Designation']);
$pdf->Text($pos+strlen($row3['Designation'])*3+3,290,$row3['Qty']);
$pos+=5+strlen($row3['Designation'])*3+3;
}
$pdf->Text(85,289,$dp_support); //Support

$pdf->Text(205,300,$qt_date_e); //A

$pdf->Output('tmp/certificat/certificat-'.$dpid.'-renouvellement.pdf','F');
header('Location: renew_validate2.php?ID='.$dpid);
}

else if($Lng=="AR"){
   /* // depot
$pdf->Text(40,73,date('Y-m-d')); //Datein
$pdf->Text(135,178,$qt_namefr); //nomprenom

$pdf->Text(205,192,$cin); //Date_dp

$pdf->Text(235,219,": ".$dpid); //nbr_dp

$pdf->Text(215,219,$dp_titre); //Titre_ov

$pdf->Text(200,232,$dp_desc); //Desc 

$pdf->Text(230,245,$dp_auteur); //Auteur

$pdf->Text(140,306,$dps_adress); //Desc 

$pdf->Text(140,345,$dps_tel); //Desc 

$pdf->Text(140,358,$dps_email); //Desc */

$homepage = file_get_contents('./pdf/redemandeAR.jpeg');
$ty= base64_encode($homepage);
echo "
<script type='text/javascript'>


var pdf=jsPDF('l','px',[450,450]);
var img='data:image/jpeg;base64,'+'$ty';
pdf.addImage(img, 'JPEG', 0, 0,450,450);


var ctx=document.getElementById('myCanvas').getContext('2d');
var canvas = document.getElementById('myCanvas');
ctx.font='18px Arial';

ctx.fillText('".date('Y-m-d')."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',60,68);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$qt_namefr."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',250,179);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$cin."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',320,195);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText(': ".$dpid."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',340,224);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_titre."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',290,224);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_desc."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',250,237);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_auteur."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',300,280);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dps_adress."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',210,318);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dps_tel."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',210,358);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dps_email."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',190,372);

ctx.clearRect(0,0,canvas.width,canvas.height);




pdf.save('renouvellement-".$dpid.".pdf');
window.location.href = 'renew_upload2.php?ID=".$dpid."';

</script>";

}

    
  
}
?>