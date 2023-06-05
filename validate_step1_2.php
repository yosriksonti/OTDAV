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
    $lng="";
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
            $qt_date_c=$raw['date_c'];
            $qt_date_e=$raw['date_e'];
            $lng=$row['Lng'];
        }
    
 
      echo $lng;

$pdf = new Fpdi();


$pageCount = $pdf->setSourceFile('pdf/demande'.$lng.'.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('P');
$pdf->useImportedPage($pageId, 0, 0, 297,420,true);
$pdf->SetFont('Arial','',16);


if($lng=="FR"){

// depot
$pdf->Text(230,77,date('Y-m-d')); //Datein
$pdf->Text(148,229,$qt_namefr); //nomprenom

$pdf->Text(47,241,$dp_date); //Date_dp

$pdf->Text(130,241,$dpid); //nbr_dp

$pdf->Text(90,276,$dp_titre); //Titre_ov

$pdf->Text(115,253,$dp_desc); //Desc 

$pdf->Text(170,266,$dp_auteur); //Auteur

$pos=70;
$result=mysqli_query($mysqli,"select * from support where id_depot='$dpid'");
    foreach($result as $row3 ){

$pdf->Text($pos,290,$row3['Designation']);
$pdf->Text($pos+strlen($row3['Designation'])*3+3,290,$row3['Qty']);
$pos+=5+strlen($row3['Designation'])*3+3;
}
$pdf->Text(85,289,$dp_support); //Support

$pdf->Text(125,300,$qt_date_c);  //DU
$pdf->Text(175,300,$qt_date_e); //A
$pdf->Output('tmp/certificat/certificat-'.$dpid.'.pdf','F');
header('Location: validate_step2.php?ID='.$dpid);
}

else if($lng=="AR"){
	// depot
    /*
$pdf->Text(195,72,date('Y-m-d')); //Datein
$pdf->Text(165,203,$qt_namefr); //nomprenom

$pdf->Text(55,204,$dp_date); //Date_dp

$pdf->Text(160,211,$dpid); //nbr_dp

$pdf->Text(180,220,$dp_titre); //Titre_ov

$pdf->Text(165,240,$dp_desc); //Desc 

$pdf->Text(80,250,$dp_auteur); //Auteur

$pos=265;
$result=mysqli_query($mysqli,"select * from support where id_depot='$dpid'");
    foreach($result as $row3 ){

$pdf->Text(50,$pos,$row3['Designation']);
$pdf->Text(50+strlen($row3['Designation'])*3+3,$pos,$row3['Qty']);
$pos+=5;
}
$pdf->Text(85,289,$dp_support); //Support

$pdf->Text(115,287,$qt_date_c);  //DU
$pdf->Text(55,287,$qt_date_e); //A*/

$homepage = file_get_contents('./pdf/demandeAR.jpeg');
$ty= base64_encode($homepage);
echo "
<script type='text/javascript'>


var pdf=jsPDF('l','px',[450,450]);
var img='data:image/jpeg;base64,'+'$ty';
pdf.addImage(img, 'JPEG', 0, 0,450,450);


var ctx=document.getElementById('myCanvas').getContext('2d');
var canvas = document.getElementById('myCanvas');
ctx.font='16px Arial';

ctx.fillText('".date('Y-m-d')."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',285,67);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$qt_namefr."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',250,206);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_date."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',80,206);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dpid."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',250,216);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_titre."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',290,226);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_desc."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',290,246);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$dp_auteur."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',110,256);";
$pos=100;

$result=mysqli_query($mysqli,"select * from support where id_depot='$dpid'");
    foreach($result as $row3 ){
        echo"
ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('|".$row3['Qty']."  ".$row3['Designation']."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',".$pos.",276);";
$pos=$pos-(20+100/strlen($row3['Designation']));
}


echo"
ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$qt_date_e."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',80,296);

ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$qt_date_c."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',170,296);
ctx.clearRect(0,0,canvas.width,canvas.height);










pdf.save('certificat-".$dpid.".pdf');
window.location.href = 'validate_step3.php?ID=".$dpid."';
</script>";
}

    
  
}
?>
