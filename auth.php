<?php
session_start();
$adminLogin = $_POST['adminLogin'];
$adminPassword = $_POST['adminPassword'];

if ($adminLogin == 'admin' && $adminPassword == 'admin') {
  $_SESSION['admin'] = 1;
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = '';
  header("Location: http://$host$uri/$extra");
} else {
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'admin.php';
  header("Location: http://$host$uri/$extra");
}


?>