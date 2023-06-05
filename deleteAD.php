<?php
define('QUADODO_IN_SYSTEM', true);
require_once('check.php');
require_once('includes/header.php');
include_once("config.php");
?>
<?php
if(isset($_GET['id']))
{
	$query1= mysqli_query($mysqli,"delete FROM `ad_users` where id=".$_GET['id']);
}
else
echo "erreur: ID invalid";
?>