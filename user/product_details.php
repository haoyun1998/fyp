<?php
session_start();
error_reporting(0);

include("../includes/config.php");
include("../function/script_user_login.php");	
include("../function/script_shopping_cart.php");

if(strlen($_SESSION['alogin'])==""){
	header("Location: user_login.php");
} 

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/user_login.css">
	<link rel="stylesheet" type="text/css" href="../css/phone.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php");
	?>

	

	<div class="content">
		<h1>Phone</h1>
		<div>

<?php
$customerId = $_SESSION["id"];
$productId = $_GET["productId"];

$sql = "SELECT * FROM product WHERE productId=:productId";
$query = $dbh->prepare($sql);
$query->bindParam(":productId", $productId, PDO::PARAM_INT);
$query->execute() or die();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0){
	foreach($results as $result){
?>

		<form method="POST">		
			<div class="item">
				<div class="phone-img">
					<img src="../images/<?php echo htmlentities($result->productImage)?>">
				</div>

				<div class="phone-description">
					<span>New</span>
					<h3> <?php echo htmlentities($result->productName)?> </h3>
					<h6>Brand: <?php echo htmlentities($result->brand)?></h6>
					<h6>Price: <?php echo htmlentities($result->unitPrice)?></h6>
					<hr style="margin: 1% 20% 1% 33%;">
					<p>
					<?php if(strlen(htmlentities($result->description1)) != ""){
						?> - <?php echo htmlentities($result->description1);
						} ?><br>
					<?php if(strlen(htmlentities($result->description2)) != ""){
						?> - <?php echo htmlentities($result->description2);
						} ?><br>
					<?php if(strlen(htmlentities($result->description3)) != ""){
						?> - <?php echo htmlentities($result->description3);
						} ?><br>
					<?php if(strlen(htmlentities($result->description4)) != ""){
						?> - <?php echo htmlentities($result->description4);
						} ?><br>
					<?php if(strlen(htmlentities($result->description5)) != ""){
						?> - <?php echo htmlentities($result->description5);
						} ?>
					</p>
					<hr style="margin: 1% 20% 1% 33%;">	
					<div>
						<input type="hidden" name="productId" value="<?php echo htmlentities($result->productId)?>">
						<input type="hidden" name="customerId" value="<?php echo $customerId?>">
					</div>
					<div>
						<?php
						if($_SESSION['alogin'] == $_SESSION['compare'] && $_SESSION['alogin'] != ""){
						?>
							<input type="submit" name="submit" value="Add to Shopping Cart">
						<?php
						} else {
							echo "You must login in first.";
						} 
						?>
					</div>
				</div>
			</div>	
		</form>

<?php
	}
}
?>					
		</div>

	</div>

	<?php
	include("../includes/footer.php")
	?>
</body>
</html>