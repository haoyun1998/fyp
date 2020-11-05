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
	<link rel="stylesheet" type="text/css" href="../css/phone.css">
	<link rel="stylesheet" type="text/css" href="../css/shopping_cart.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php");
	?>

	<div class="content2">
		<h1>Shopping Cart</h1>

<?php
$customerId = $_SESSION['id'];
$sql = "SELECT product.productName, product.brand, product.unitPrice, product.productImage, shopping_cart.quantity FROM product LEFT JOIN shopping_cart ON product.productId = shopping_cart.productId WHERE shopping_cart.customerId=:customerId AND paymentStatus=0";
$query = $dbh -> prepare($sql);
$query -> bindParam(":customerId", $customerId, PDO::PARAM_INT);
$query -> execute() or die();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if($query -> rowcount() > 0){
	foreach($results as $result){

?>
		<div class="item">
			<div class="phone-img">
				(<?php echo $cnt ?>)<img src="../images/<?php echo htmlentities($result->productImage)?>">
			</div>

			<div class="phone-description">
				<h3> <?php echo htmlentities($result->productName)?> </h3>
				<h6>Brand: <?php echo htmlentities($result->brand)?></h6>
				<h6>Price: <?php echo htmlentities($result->unitPrice)?></h6>
				<hr style="margin: 1% 20% 1% 33%;">
				<!-- <p>
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
				</p> -->
				<hr style="margin: 1% 20% 1% 33%;">	
				<div>
					<?php
					if($_SESSION['alogin'] == $_SESSION['compare'] && $_SESSION['alogin'] != ""){
						echo "<button>Delete Product</button>";
					} else {
						echo "You must login in first.";
					} 
					?>
				</div>
			</div>			
		</div>	
<?php
$cnt++;
$totalAmount += (htmlentities($result ->unitPrice) * htmlentities($result ->quantity));
$_SESSION['totalAmount'] = $totalAmount;
	} 
} else if($query -> rowCount() == 0){
?>
	<p style="padding-left: 5%;">Please add something to your shopping cart.</p>
<?php
}
?>

		<!-- <div class="payment">
			<script src="https://www.paypal.com/sdk/js?client-id=AQ6-JBTZ_11HcAkd-MGGGq_VUw4SS0xbUixBl5ofL9ZAljY-tgMKMCHfN49nD0HS-owwdDc73lqoyGu1"></script>
			<script>paypal.Buttons().render('body');</script>
		</div> -->

		<div id="smart-button-container">
      		<div style="text-align: center;">
        		<div id="paypal-button-container"></div>
      		</div>
    	</div>
		<script src="https://www.paypal.com/sdk/js?client-id=AYrVqgT6pIhPhLtlyCayLqLkPx0e8WzcRrjQxoJKRse3_x37WFZMr2cG4oqanLacQt-Ym8-9iUXQG5D5" data-sdk-integration-source="button-factory"></script>
		<script>
		    function initPayPalButton() {
		        paypal.Buttons({
			        style: {
			          shape: 'rect',
			          color: 'gold',
			          layout: 'vertical',
			          label: 'paypal',
			    },

		        createOrder: function(data, actions) {
		          return actions.order.create({
		            purchase_units: [{"amount":{"currency_code":"USD","value": <?php echo $totalAmount?>}}]
		          });
		        },

		        onApprove: function(data, actions) {
		          return actions.order.capture().then(function(details) {
		            alert('Transaction completed by ' + details.payer.name.given_name + '!');

		            

		            document.location = '../function/script_orders.php';
		          });
		        },

		        onError: function(err) {
		          console.log(err);
		        }
		      }).render('#paypal-button-container');
		    }
		    initPayPalButton();
		</script>
	</div>

	<?php
	include("../includes/footer.php")
	?>
</body>
</html>