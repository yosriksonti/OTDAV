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
if ($qls->user_info['group_id'] != '3' && $qls->user_info['group_id'] != '1') {
    header('Location: index.php');
}
include_once("config.php");
$ID="";
	$ID=$_GET['ID'];
	$dps_namefr = "";
    $dps_rs = "";
    $dps_cin = "";
    $dps_email = "";
    $dps_tel = "";
    $dps_ne = "";
    $dps_de = "";
    $dps_le = "";
    $dps_adress ="";  
    $dps_fax = "";
    $aut_name = "";
    $ovr_titre = "";
    $ovr_desc = "";
    $ovr_num = "";
    $Lng="";
 	$result=mysqli_query($mysqli,"select * from depot where numero='$ID'");
    foreach($result as $row ){   
    $dps_cin = $row['id_deposant'];
    $aut_name = $row['Auteur'];
    $ovr_titre = $row['titre_ouvre'];
    $ovr_desc = $row['description'];
    $ovr_num = $row['genre'];
    $Lng=$row['Lng'];
	}

	$result=mysqli_query($mysqli,"select * from deposant where cin='$dps_cin'");
    foreach($result as $row2 ){   
    $dps_namefr = $row2['nomPrenom'];
    $dps_rs = $row2['raison_sociale'];
    $dps_email = $row2['email'];
    $dps_tel = $row2['num_tel'];
    $dps_ne = $row2['num_registre'];
    $dps_de = $row2['date_registre'];
    $dps_le = $row2['lieu_registre'];
    $dps_adress =$row2['adresse'];  
    $dps_fax = $row2['num_fax'];
	}

    /*---------------------------------------*/


echo $dps_namefr;     
if($Lng=="FR"){
$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('pdf/depot.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('L');
$pdf->useImportedPage($pageId, 0, 0, 420,297,true);
$pdf->SetFont('Arial','',14);

// depot
$pdf->Text(200,23,$ID); //n_depot
$pdf->Text(250,50,$dps_namefr); //nomprenom
$pdf->Text(250,59,$dps_cin ); //cin
$pdf->Text(250,69,$dps_rs); //raison
$pdf->Text(240,88,$dps_ne ); //Num
$pdf->Text(300,88,$dps_le); //Lieu 
$pdf->Text(360,88,$dps_de); //date
$pdf->Text(240,105,$dps_adress); //adresse
$pdf->Text(250,115,$dps_tel);  //TEL
$pdf->Text(250,125,$dps_fax); //FAX
$pdf->Text(250,135,$dps_email); //EMAIL


//Auteur

$pdf->Text(20,52,$aut_name); //Nom auteur

//Oeuvre

$pdf->Text(20,85,$ovr_titre); //NOM

$pdf->Text(20,109,$ovr_desc); //DESC


$pdf->Text(95,145,$ovr_num); //Genre

$pos=20;
$result=mysqli_query($mysqli,"select * from support where id_depot='$ID'");
    foreach($result as $row3 ){   

$pdf->Text($pos,158,$row3['Designation']);
$pdf->Text($pos,162,$row3['Qty']); 
$pos+=15;
} //SUPPORT

//DATE
$pdf->Text(206,283,date("Y-d-m"));  //SUPPORT
//QUITANCE
$pdf->Text(340,280,' ');  //SUPPORT
if($_GET["RN"]==1){
$pdf->Output('tmp/depot/depot-'.$ID.'-renouvellement.pdf','F');
}
else if($_GET["RN"]==0){
$pdf->Output('tmp/depot/depot-'.$ID.'.pdf','F');
}
 /*------------------------------------*/
 echo '<script language="javascript">';
echo 'alert("Success!");';
echo '</script>';
if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }
header('Location: pdf_depot.php?ID='.$ID.'&RN=0');
}
else if($Lng=="AR")
{

    $homepage = file_get_contents('./pdf/depot.jpeg');
$ty= base64_encode($homepage);

echo "
<script type='text/javascript'>


var pdf=jsPDF('l','px',[450,450]);
var img='data:image/jpeg;base64,'+'$ty';
pdf.addImage(img, 'JPEG', 0, 0,450,450);


var ctx=document.getElementById('myCanvas').getContext('2d');
var canvas = document.getElementById('myCanvas');
ctx.font='12px Arial'

ctx.fillText('".$ID."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',215,25);


ctx.clearRect(0,0,canvas.width,canvas.height)

ctx.fillText('".$dps_namefr."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',300,65);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_cin."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',300,79);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_rs."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',300,93);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_ne."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',250,124);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_le."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',305,124);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_de."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',365,124);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_adress."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',280,138);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_tel."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',280,166);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_fax."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',280,180);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$dps_email."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',280,196);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$aut_name."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',100,67);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$ovr_titre."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',70,108);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$ovr_desc."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',30,164);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$ovr_num."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',100,209);

ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".date('d-m-Y')."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',215,419);

ctx.clearRect(0,0,canvas.width,canvas.height);


";
$pos=219;

$result=mysqli_query($mysqli,"select * from support where id_depot='$ID'");
    foreach($result as $row3 ){
        echo"
ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.fillText('".$row3['Designation']."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',25,".$pos.");
ctx.clearRect(0,0,canvas.width,canvas.height);";
$pos+=10;
}


echo";

ctx.fillText('',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',100,220);


ctx.clearRect(0,0,canvas.width,canvas.height);

pdf.save('depot-".$ID.".pdf');
window.location.href = 'new_upload.php?ID=".$ID."';
</script>";

}
        


?>

