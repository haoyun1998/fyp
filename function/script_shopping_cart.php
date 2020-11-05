<?php
if(isset($_POST['submit'])){
	$customerId = $_POST['customerId'];
	$productId = $_POST['productId'];


	$sql2 = "SELECT * FROM shopping_cart WHERE customerId=:customerId AND paymentStatus=0 AND productId=:productId";
	$query = $dbh -> prepare($sql2);
	$query -> bindParam("customerId", $customerId, PDO::PARAM_INT);
	$query -> bindParam("productId", $productId, PDO::PARAM_INT);
	$query -> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0) {
		foreach($results as $result){
			$shoppingCartId = htmlentities($result->shoppingCartId);
			$quantity = htmlentities($result->quantity);
			$quantity = $quantity + 1;

			$sql3 = "UPDATE shopping_cart SET quantity=:quantity WHERE customerId=:customerId AND shoppingCartId=:shoppingCartId";
			$query = $dbh->prepare($sql3);
			$query -> bindParam("quantity", $quantity, PDO::PARAM_INT);
			$query -> bindParam("customerId", $customerId, PDO::PARAM_INT);
			$query -> bindParam("shoppingCartId", $shoppingCartId, PDO::PARAM_INT);
			$query -> execute();
			echo "<script>alert('Successful')</script>";
			echo "<script type='text/javascript'>document.location='shopping_cart.php'</script>";
			} 
				
	} else {
		$sql = "INSERT INTO shopping_cart(customerId, productId, quantity) VALUES (:customerId, :productId, 1)";
			$query = $dbh -> prepare($sql);
			$query -> bindParam("customerId", $customerId, PDO::PARAM_INT);
			$query -> bindParam("productId", $productId, PDO::PARAM_INT);
			$query -> execute();
			echo "<script>alert('Successful')</script>";
			echo "<script type='text/javascript'>document.location='shopping_cart.php'</script>";
		}
		
	
}

?>

