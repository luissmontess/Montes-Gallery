<?php
require '../config.php';
session_start();
session_destroy();
$_SESSION = array();
header('location: ' . RUTA . 'login.php');
die();

?>