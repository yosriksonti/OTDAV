<?php
error_reporting(E_ERROR | E_PARSE);
/*** *** *** *** *** ***
* @package   Quadodo Login Script
* @file      database_info.php
* @author    Douglas Rennehan
* @generated June 23rd, 2019
* @link      http://www.quadodo.net
*** *** *** *** *** ***
* Comments are always before the code they are commenting
*** *** *** *** *** ***/
if (!defined('QUADODO_IN_SYSTEM')) {
exit;
}

define('SYSTEM_INSTALLED', true);
$database_prefix = 'ad_';
$database_type = 'MySQLi';
$database_server_name = 'localhost';
$database_username = 'root';
$database_password = '';
$database_name = 'yoyo';
$database_port = 3306;

/**
 * Use persistent connections?
 * Change to true if you have a high load
 * on your server, but it's not really needed.
 */
$database_persistent = false;
?>
