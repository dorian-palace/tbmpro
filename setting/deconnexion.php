<?php 

error_reporting(0);
ini_set('display_errors', 0);


session_start(); 
$_SESSION = array();
header("Location: ../index.php");
session_destroy();
