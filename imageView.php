<?php
    include_once("../config.php");
    if(isset($_GET['id'])) {
        $sql = "SELECT photo FROM adherents WHERE id=" .$_GET['id'];
		$result = mysqli_query($mysqli, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($mysqli));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["mime"]);
        echo $row["photo"];
	}
	mysqli_close($mysqli);
?>