<?php
$pdf = $_FILES['pdf']['temp_name'];
 
if(isset($pdf)){
	$location = "/pdf";
	move_uploaded_file($pdf, $location.'random-name.pdf'))
}
?>