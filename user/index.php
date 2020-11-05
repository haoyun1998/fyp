<?php
session_start();
error_reporting(0);

include("../includes/config.php");

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
	<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php")
	?>

	<div>
		<h1 class="title">Categories</h1>
		<div style="display: flex; flex-wrap: wrap; justify-content: center;">

<?php
$sql = "SELECT * FROM categories WHERE categoriesId != 0";
$query = $dbh -> prepare($sql);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0){
	foreach($results as $result){
?>
			<div class="card">
  				<img src="../images/<?php echo htmlentities($result->categoriesImage) ?>" alt="Denim Jeans" style="width:100%; height: 200px">
  				<h1> <?php echo htmlentities($result->categoriesName) ?> </h1>
  				<p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
  				<p><a href="<?php echo htmlentities($result->categoriesName)?>.php" style="text-decoration: none; color: white;"><button>View More</button></a></p>
			</div>
<?php 
	}
}
?>

<?php
$sql = "SELECT * FROM categories WHERE categoriesId = 0";
$query = $dbh -> prepare($sql);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0){
	foreach($results as $result){
?>
			<div class="card">
  				<img src="../images/<?php echo htmlentities($result->categoriesImage) ?>" alt="Denim Jeans" style="width:100%; height: 200px">
  				<h1> <?php echo htmlentities($result->categoriesName) ?> </h1>
  				<p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
  				<p><a href="<?php echo htmlentities($result->categoriesName)?>.php" style="text-decoration: none; color: white;"><button>View More</button></a></p>
			</div>
<?php 
	}
}
?>
	</div>

	<?php
	include("../includes/footer.php")
	?>

</body>
</html>