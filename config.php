<?php 

$db_host = 'localhost';
$db_user = 'oda123_yumechizu';
$db_password = 'yumechizu-root1';
$db_name = 'oda123_yumechizu';

$mysqli = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$mysqli->query("SET NAMES 'UTF-8'");

?>