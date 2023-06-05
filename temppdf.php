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
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    $dps_namefr = mysqli_real_escape_string($mysqli, $_POST['namefr']);
    $dps_rs = mysqli_real_escape_string($mysqli, $_POST['rs']);
    $dps_cin = mysqli_real_escape_string($mysqli, $_POST['cin']);
    $dps_email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $dps_tel = mysqli_real_escape_string($mysqli, $_POST['mobile']);
    $dps_ne = mysqli_real_escape_string($mysqli, $_POST['ne']);
    $dps_de = mysqli_real_escape_string($mysqli, $_POST['de']);
    $dps_le = mysqli_real_escape_string($mysqli, $_POST['le']);
    $dps_adress = mysqli_real_escape_string($mysqli, $_POST['adresse']);    
    $dps_fax = mysqli_real_escape_string($mysqli, $_POST['fax']);
    $aut_name = mysqli_real_escape_string($mysqli, $_POST['aut_name']);
    $ovr_titre = mysqli_real_escape_string($mysqli, $_POST['titre']);
    $ovr_desc = mysqli_real_escape_string($mysqli, $_POST['desc']);
    $ovr_num = mysqli_real_escape_string($mysqli, $_POST['num']);
    $ovr_supp = mysqli_real_escape_string($mysqli, $_POST['supp']);
    //Create DP_ID //
    $num=1;
    $result=mysqli_query($mysqli,"select * from depot where date_sys=STR_TO_DATE('".date("Y-d-m")."', '%Y-%d-%m')");
    foreach($result as $row ){
    $num++;
    }
    $ID="";
    $ID=$num."-".date("dmY")."-".$ovr_num;
    
    $result = mysqli_query($mysqli, "INSERT INTO deposant VALUES('$dps_cin','$dps_namefr','$dps_rs','$dps_ne','$dps_le','$dps_de','$dps_adress','$dps_tel','$dps_fax','$dps_email')");
    $result = mysqli_query($mysqli, "INSERT INTO depot VALUES('$ID','$dps_cin','$aut_name','$ovr_titre','$ovr_desc','$ovr_num','$ovr_supp','0',STR_TO_DATE('".date("Y-d-m")."', '%Y-%d-%m'))");
    /*---------------------------------------*/


     

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

$pdf->Text(20,158,$ovr_supp);  //SUPPORT

//DATE
$pdf->Text(206,283,date("Y-d-m"));  //SUPPORT
//QUITANCE
$pdf->Text(340,280,' ');  //SUPPORT
$pdf->Output('tmp/depot/depot-'.$ID.'.pdf','F');
 /*------------------------------------*/
 echo '<script language="javascript">';
echo 'alert("Success!");';
echo '</script>';
if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }
        

}
return true;
?>