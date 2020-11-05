<?php
session_start();
// error_reporting(0);

include("../includes/config.php");

$customerId = $_SESSION['id'];
$totalAmount = $_SESSION['totalAmount'];
$sql2 = "INSERT INTO orders(customerId, totalAmount) VALUES (:customerId, $totalAmount)";
$query = $dbh->prepare($sql2);
$query->bindParam('customerId',$customerId,PDO::PARAM_STR);
$query -> execute() or die();


$sql3 = "SELECT MAX(orderId) AS lastId FROM orders";
$query = $dbh -> prepare($sql3);
$query -> execute() or die();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
	foreach($results as $result){
		$orderId = htmlentities($result->lastId);
	}
}


$sql = "SELECT * FROM shopping_cart WHERE customerId=:customerId AND paymentStatus=0";
$query = $dbh->prepare($sql);
$query->bindParam('customerId',$customerId,PDO::PARAM_STR);
$query -> execute() or die();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
	foreach($results as $result){

	$productId = htmlentities($result->productId);
	$quantity = htmlentities($result->quantity);

	$sql4 = "INSERT INTO order_details(orderId, productId, quantity) VALUES ($orderId, $productId ,$quantity)";
	$query = $dbh->prepare($sql4);
	$query -> execute() or die();

	}
}

$sql5 = "UPDATE shopping_cart SET paymentStatus = 1 WHERE customerId=$customerId AND paymentStatus=0";
$query = $dbh -> prepare($sql5);
$query -> execute() or die();

echo "<script type='text/javascript'> document.location = '../user/payment_successful.php'; </script>";
?>