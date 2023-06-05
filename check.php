<?php

define('QUADODO_IN_SYSTEM', true);
require_once('includes/header.php');
if ($qls->user_info['username'] == '')
{
 
  header ("location: page-login.php");    
} 
?>