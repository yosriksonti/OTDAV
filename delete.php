<?php
define('QUADODO_IN_SYSTEM', true);
require_once('check.php');
require_once('includes/header.php');
include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'GET')
{

		 $result = mysqli_query($mysqli, "Delete FROM adherants where Matricule=".$_GET['id']);
        if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }
         header ("location:users.php");
	}
?>