<?php
session_start(); 
$_SESSION = array();
unset($_SESSION['alogin']);
session_destroy(); // destroy session
echo "<script>alert('Logout Successfully'); </script>";
// header("location:../user/user_login.php"); 
echo "<script type='text/javascript'> document.location = '../user/user_login.php'; </script>";
?>