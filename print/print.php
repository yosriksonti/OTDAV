<?php 
	$homepage = file_get_contents('./background2.png');
	 $homepage2 = file_get_contents('./cadre2.png');
	 $homepage4 = file_get_contents('./signature.png');
	 $ty= base64_encode($homepage);
	 $ty2= base64_encode($homepage2);
	 $ty3= base64_encode($photo);
	 $ty4= base64_encode($homepage4);
	 echo "<script type='text/javascript'>","printPDF('$ty','$ty2','$ty3','$ty4');","</script>";
?> 