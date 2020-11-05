<?php

if(isset($_POST['Csubmit'])){
	$customerId = $_SESSION['id'];
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$remark = $_POST['remark'];

	$sql = "INSERT INTO contact_us(customerId, firstName, lastName, email, remark) values (:customerId, :firstName, :lastName, :email, :remark)";
	$query = $dbh -> prepare($sql);
	$query -> bindParam(":customerId", $customerId, PDO::PARAM_STR);
	$query -> bindParam(":firstName", $firstName, PDO::PARAM_STR);
	$query -> bindParam(":lastName", $lastName, PDO::PARAM_STR);
	$query -> bindParam(":email", $email, PDO::PARAM_STR);
	$query -> bindParam(":remark", $remark, PDO::PARAM_STR);
	$query -> execute() or die();
	echo "<script>alert('Successful')</script>";
}

?>