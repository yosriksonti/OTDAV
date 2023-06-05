<?php
define('QUADODO_IN_SYSTEM', true);
require_once('check.php');
require_once('includes/header.php');
include_once("config.php");
if(isset($_POST['ID']))
$result = mysqli_query($mysqli, "UPDATE depot SET etat='-1' WHERE numero='".$_POST['ID']."'");
    
    echo '<script language="javascript">';
    echo 'alert("Success!");
    document.location.href = "index.php";';
    echo '</script>';
?>
