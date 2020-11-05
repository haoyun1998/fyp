<?php
session_start();
error_reporting(0);
include('../includes/config.php');

if(strlen($_SESSION['Alogin'])=="") {   
    header("Location: admin_login.php"); 
}

if (isset($_GET['id'])) {

$id=$_GET['id'];
$sql = "DELETE FROM product WHERE productId = :id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query-> execute() or die();

echo "<script>alert('Delete Successfully')</script>";
echo "<script type='text/javascript'>document.location='manage_product.php'</script>";
}

?>