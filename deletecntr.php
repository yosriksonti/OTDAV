<?php
define('QUADODO_IN_SYSTEM', true);
require_once('check.php');
require_once('includes/header.php');
include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'GET')
{

		echo $_GET['mat'];
		$result = mysqli_query($mysqli, "Delete FROM br_contribution where ID_BR=".$_GET['id']." AND  MAT_AD=".$_GET['mat']);
        if(!$result){
            echo("Error description: " . mysqli_error($mysqli));
        }
        header ("location:breuves.php");
	}
?>