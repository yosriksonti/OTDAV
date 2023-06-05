<?php 
include_once("../config.php");
$id=$_POST['text1'];;
$result = mysqli_query($mysqli, "UPDATE adherents SET imprime=imprime +1 WHERE id=$id");
?> 