<?php
session_start(); 
$_SESSION = array();
unset($_SESSION['Alogin']);
session_destroy(); // destroy session
header("location:../admin_login.php"); 
?>