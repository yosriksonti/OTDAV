<?php

require_once('check.php');
require_once('includes/header.php');
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
    $lng=mysqli_real_escape_string($mysqli, $_POST['lng']);
    if(empty($dps_ne) || !isset($dps_ne))
    {
        $dps_ne="NULL";
    }
    if(empty($dps_le) || !isset($dps_le))
    {
        $dps_le="NULL";
    }
    if(empty($dps_de) || !isset($dps_de))
    {
        $dps_de="NULL";
    }
    if(empty($dps_fax) || !isset($fax))
    {
        $dps_fax="NULL";
    }
    $cnt=$_POST['cnt'];
    if($dps_ne=="")
        $dps_ne="-1";
    if($dps_fax=="")
        $dps_fax="-1";
    if($dps_de=="")
        $dps_de="0000-00-00";
    

    //Create DP_ID //
    $num=1;
    $result=mysqli_query($mysqli,"select * from depot ");
    foreach($result as $row ){
    $num++;
    }
    $ID="";
    $ID=$num."-".$ovr_num."-".date("dmY");
    
    if($cnt=="0")
    $result = mysqli_query($mysqli, "INSERT INTO deposant VALUES('$dps_cin','$dps_namefr','$dps_rs','$dps_ne','$dps_le','$dps_de','$dps_adress','$dps_tel','$dps_fax','$dps_email')");
    else
    $result = mysqli_query($mysqli, "UPDATE deposant SET nomPrenom='$dps_namefr', raison_sociale='$dps_rs', num_registre='$dps_ne', lieu_registre='$dps_le',date_registre='$dps_de',adresse='$dps_adress', num_tel='$dps_tel',num_fax='$dps_fax',email='$dps_email' WHERE cin='$dps_cin'");
    $result = mysqli_query($mysqli, "INSERT INTO depot VALUES('$ID','$dps_cin','$aut_name','$ovr_titre','$ovr_desc','$ovr_num','0','$lng',STR_TO_DATE('".date("Y-d-m")."', '%Y-%d-%m'))");
    header('Location: support.php?ID='.$ID."&RN=0");
}
    /*---------------------------------------*/
    ?>