<?php
$host = "ap-cdbr-azure-southeast-b.cloudapp.net";
$user = "b193c8483ad3e7";
$pass = "27e85c63";
$database = "smartpark";
$koneksi = mysql_connect($host,$user,$pass);
mysql_select_db($database) or die ("Connection failed".mysql_error());
error_reporting(E_ALL^(E_NOTICE | E_WARNING));	
?>