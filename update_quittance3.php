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
if ($qls->user_info['group_id'] != '4' && $qls->user_info['group_id'] != '1') {
    header('Location: index.php');
}
include_once("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
   

    
    $dpid=mysqli_real_escape_string($mysqli, $_POST['dpid']);
    $qt_namefr=mysqli_real_escape_string($mysqli, $_POST['nameFr']);
    $qt_sumL = mysqli_real_escape_string($mysqli, $_POST['sumL']);    
    $qt_mode = mysqli_real_escape_string($mysqli, $_POST['mode']);
    $qt_sum = mysqli_real_escape_string($mysqli, $_POST['sum']);
    $qt_titre = mysqli_real_escape_string($mysqli, $_POST['titre']);
    $qt_genre = "Genre ".mysqli_real_escape_string($mysqli, $_POST['genre']);
        $qt_date_c=date('Y-m-d');
        $dateOneYearAdded = strtotime(date("Y-m-d", strtotime($qt_date_c)) . " +1 year");
        
        $qt_date_e=date('Y-m-d', $dateOneYearAdded);
        $num=1;
        $result=mysqli_query($mysqli,"select * from quitance");
        foreach($result as $row ){
        $num++;
        }
        $ID="";
        $ID=$num;
        $result = mysqli_query($mysqli, "INSERT INTO quitance VALUES('$ID','$qt_namefr','$qt_sum','$qt_sumL','$qt_mode','$qt_titre','$qt_genre','$qt_date_c','$qt_date_e','$dpid',1)");
        if($result) $result = mysqli_query($mysqli, "UPDATE depot set etat='4' WHERE numero='".$dpid."'");
        $lng="";
        $res = mysqli_query($mysqli, "SELECT * FROM depot where numero='$dpid'");
        foreach($res as $raw)
        {
        
            $lng=$raw['Lng'];
            
        }
        /*---------------------------------------*/
        if($lng=="FR"){
        $pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('pdf/quittance.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('P');
$pdf->useImportedPage($pageId, 0, 0, 420,297,true);
$pdf->SetFont('Arial','',18);




$pdf->Text(200,30,$ID); //n_quit
$pdf->Text(160,39,$qt_namefr); //nomprenom

$pdf->Text(200,52,$qt_sum); //montant

$pdf->Text(160,65,$qt_sumL); //montant/lettres

$pdf->Text(160,78,$qt_mode); //Mode pay

$pdf->Text(160,87,$qt_titre); //Titre 

$pdf->Text(160,100,$qt_supp); //Support

$pdf->Text(160,110,$qt_genre); //genre
$pdf->Text(140,130,"Du :".$qt_date_c);  //DU
$pdf->Text(200,130,"A :".$qt_date_e); //A

$pdf->Text(100,153,date('d-m-Y')); //A

$pdf->Text(300,153,"Tunis"); //A


// depot



$pdf->Output('tmp/quittance/quittance-'.$dpid.'.pdf','F');


 /*------------------------------------*/
        
        
        
       echo '<script language="javascript">';
echo 'alert("Success!");
document.location.href = "prvw_qt.php?ID='.$dpid.'";';
echo '</script>';
        if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }
}
else if($lng=="AR"){

 /*

 $pdf->Text(200,30,$ID); //n_quit
$pdf->Text(160,39,$qt_namefr); //nomprenom

$pdf->Text(200,52,$qt_sum); //montant

$pdf->Text(160,65,$qt_sumL); //montant/lettres

$pdf->Text(160,78,$qt_mode); //Mode pay

$pdf->Text(160,87,$qt_titre); //Titre 

$pdf->Text(160,100,$qt_supp); //Support

$pdf->Text(160,110,$qt_genre); //genre
$pdf->Text(140,130,"Du :".$qt_date_c);  //DU
$pdf->Text(200,130,"A :".$qt_date_e); //A

$pdf->Text(100,153,date('d-m-Y')); //A

$pdf->Text(300,153,"Tunis"); //A

*/
$homepage = file_get_contents('./pdf/quittance.jpeg');
$ty= base64_encode($homepage);

echo "
<script type='text/javascript'>


var pdf=jsPDF('l','px',[450,450]);
var img='data:image/jpeg;base64,'+'$ty';
pdf.addImage(img, 'JPEG', 0, 0,450,450);


var ctx=document.getElementById('myCanvas').getContext('2d');
var canvas = document.getElementById('myCanvas');
ctx.font='12px Arial';

ctx.fillText('".date('d-m-Y')."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',100,221);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('Tunis',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',300,221);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$ID."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',210,30);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_namefr."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',150,48);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_sum."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',210,66);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_sumL."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',165,88);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_mode."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',150,101);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_titre."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',150,121);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_genre."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',150,153);


ctx.clearRect(0,0,canvas.width,canvas.height);

ctx.fillText('".$qt_date_c."/".$qt_date_e."',10,20);
var imgData=canvas.toDataURL('image/png',1.0);
pdf.addImage(imgData,'PNG',150,172);


ctx.clearRect(0,0,canvas.width,canvas.height);


pdf.save('quittance-".$ID."-renouvellement.pdf');
window.location.href = 'renew_upload1.php?ID=".$dpid."';
</script>";
}

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('tmp/depot/depot-'.$dpid.'-renouvellement.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('P');
$pdf->useImportedPage($pageId, 0, 0, 420,297,true);
$pdf->SetFont('Arial','',18);

// depot
$pdf->Text(345,285,$ID); //A


$pdf->Output('tmp/depot/depot-'.$dpid.'-renouvellement.pdf','F');
 /*------------------------------------*/
        
        
        
        echo'<script>alert("Success");</script>';
      header('Location: renew_validate1.php?ID='.$dpid);
        if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }
}




?>
