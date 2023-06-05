<?php 

require_once "config.php";
require_once('check.php');
require_once('includes/header.php');

if (isset($_POST['auth'])){
	$query1= mysqli_query($mysqli,"SELECT * FROM `quitance` WHERE  DATE_ADD(SYSDATE(), INTERVAL 30 DAY) > date_e ORDER BY date_e ASC  ");
    $i=1;
	foreach($query1 as $row){
		$query2= mysqli_query($mysqli,"SELECT * FROM `depot` WHERE  numero='".$row['id_depot']."'");
        foreach($query2 as $rw){
        	$query3= mysqli_query($mysqli,"SELECT * FROM `deposant` WHERE  cin='".$rw['id_deposant']."'");
            foreach($query3 as $r){
            	mail($r['email'],"Alert","Votre Depot est Expiré");
            	echo $r['email'];
            	$i++; 
            }
        }
	}

}