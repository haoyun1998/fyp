<?php
session_start();
error_reporting(0);

include("../includes/config.php");
include("../function/script_user_login.php");
include("pdf_gen.php");

if(strlen($_SESSION['alogin'])==""){
	header("Location: user_login.php");
} 
// else if($_SESSION['alogin']) != ($_SESSION['compare']) {
// 	header("Location: user_login.php");
// }

// $sql = "SELECT MAX(orderId) AS lastId FROM orders";
// $query = $dbh -> prepare($sql);
// $query -> execute() or die();
// $results=$query->fetchAll(PDO::FETCH_OBJ);
// if($query->rowCount() > 0){
// 	foreach($results as $result){
// 		$orderId = htmlentities($result->lastId);
// 	}
// }

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../admin/css/font-awesome.min.css" media="screen" >
	<link rel="stylesheet" type="text/css" href="../css/user_login.css">
	<link rel="stylesheet" type="text/css" href="../css/payment_successful.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php")
	?>

	<form method="post" action="pdf_gen.php">
		<div class="content">
			<h1><i class="fa fa-check-square"></i></h1>
			<span>Payment Successful!!</span><br>
			<span>Print the receipt here~</span><br>
			<input type="submit" name="submit" value="Print">
		</div>
	</form>

	<?php
	include("../includes/footer.php")
	?>

</body>
</html>