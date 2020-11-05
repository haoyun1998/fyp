<?php
session_start();
error_reporting(0);

include("../includes/config.php");
include("../function/script_user_login.php");	

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/user_login.css">
	<link rel="stylesheet" type="text/css" href="../css/earphone.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php");
	?>

	<div class="content2">
		<h1>Filter</h1>
		<form>
		    <label>Brand</label>
		    <select name="brand">
		    	<option selected="selected" value="" hidden="">None</option>
		      	<option value="apple">Apple</option>
		      	<option value="samsung">Samsung</option>
		      	<option value="huawei">Huawei</option>
		      	<option value="oppo">Oppo</option>
		      	<option value="betron">Betron</option>
		    </select>
		    <br>

		    <label>Price</label>
		    <select name="price">
		    	<option selected="selected" value="" hidden="">None</option>
		      	<option value="1"><10</option>
		      	<option value="2">10-20</option>
		      	<option value="3">20-30</option>
		      	<option value="4">30<</option>
		    </select>
		    <br>
		  
		    <button>Search</button>
		</form>
	</div>

	<div class="content">
		<h1>Earphone</h1>
		<div>

<?php
$var1 = $_GET['brand'];
$var2 = $_GET['price'];

if ($var2 == 1) {
	$price1 = 0;
	$price2 = 10;
} else if ($var2 == 2) {
	$price1 = 10;
	$price2 = 20;
} else if ($var2 == 3) {
	$price1 = 20;
	$price2 = 30;
} else {
	$price1 = 30;
	$price2 = 100000000;
}

if ($var1 == '' && $var2 == '') {
	$sql = "SELECT * FROM product WHERE categoriesId=3";
	$query = $dbh -> prepare($sql);
} else if ($var1 != '' && $var2 != '') {
	$sql = "SELECT * FROM product WHERE categoriesId=3 AND brand=:var1 AND unitPrice >= :price1 AND unitPrice <= :price2";
	$query = $dbh -> prepare($sql);
	$query -> bindParam(":var1", $var1, PDO::PARAM_STR);
	$query -> bindParam(":price1", $price1, PDO::PARAM_INT);
	$query -> bindParam(":price2", $price2, PDO::PARAM_INT);
} else if ($var1 != '') {
	$sql = "SELECT * FROM product WHERE categoriesId=3 AND brand=:var1";
	$query = $dbh -> prepare($sql);
	$query -> bindParam(":var1", $var1, PDO::PARAM_STR);
} else {
	$sql = "SELECT * FROM product WHERE categoriesId=3 AND unitPrice >= :price1 AND unitPrice <= :price2";
	$query = $dbh -> prepare($sql);
	$query -> bindParam(":price1", $price1, PDO::PARAM_INT);
	$query -> bindParam(":price2", $price2, PDO::PARAM_INT);
}


$query -> execute() or die();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0){
	foreach($results as $result){
?>

			<div class="item">
				<div class="phone-img">
					<img src="../images/<?php echo htmlentities($result->productImage)?>">
				</div>

				<div class="phone-description">
					<span>New</span>
					<h3><?php echo htmlentities($result->productName)?></h3>
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
						<?php
						if($_SESSION['alogin'] == $_SESSION['compare'] && $_SESSION['alogin'] != ""){
						?>
							<a href="product_details.php?productId=<?php echo htmlentities($result->productId)?>" style="text-decoration: none; color: black;"><button>Buy</button></a>
						<?php
						} else {
							echo "You must login in first.";
						} 
						?>
					</div>
				</div>
			</div>	

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