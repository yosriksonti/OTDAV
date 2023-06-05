<?php

require_once('check.php');
require_once('includes/header.php');

if(isset($_POST['email'])){
    $email=$_POST['email'];
    mail($email,"Alert","Votre Depot est Expiré");
    echo $email;
    //header('Location: index.php');
}
else
{
    header('Location: index.php');
}