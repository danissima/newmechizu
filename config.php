<?php 

$db_host = 'newmechizu';
$db_user = 'root';
$db_password = '';
$db_name = 'yume_chizu';

$mysqli = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$mysqli->query("SET NAMES 'UTF-8'");

?>