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

    
    
    $ID=$_GET['ID'];
    

    $result = mysqli_query($mysqli, "UPDATE depot SET etat=3 WHERE numero='".$ID."'");
     header('Location: depot.php?ID='.$ID);
    
    /*---------------------------------------*/



        


?>
