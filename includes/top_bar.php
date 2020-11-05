<div class="navbarme">
		<div class="logo">Smart Phone</div>

<?php
if($_SESSION['alogin'] == ''){
?>
		<a href="user_login.php">Home</a>
  		<div class="dropdown1">
    		<button class="dropbtn">Categories 
      			<!-- <i class="fa fa-caret-down"></i> -->
    		</button>
		    <div class="dropdown-content">
		      <a href="phone.php">Phone</a>
		      <a href="charger.php">Charger</a>
		      <a href="earphone.php">Earphone</a>
		      <a href="others.php">Others</a>
		    </div>
	  	</div> 
	  	<a href="product_trend.php">Product Trend</a>
	  	<a href="#" onclick="document.getElementById('login').style.display='block'" style="float: right">Login</a>
<?php
} else { 
?>
		<a href="user_login.php">Home</a>
  		<div class="dropdown1">
    		<button class="dropbtn">Categories 
      			<!-- <i class="fa fa-caret-down"></i> -->
    		</button>
		    <div class="dropdown-content">
		      <a href="phone.php">Phone</a>
		      <a href="charger.php">Charger</a>
		      <a href="earphone.php">Earphone</a>
		      <a href="others.php">Others</a>
		    </div>
	  	</div> 
	  	<a href="contact_us.php">Contact Us</a>
	  	<a href="#">Delivery Status</a>
	  	<a href="product_trend.php">Product Trend</a>
	  	<a href="../includes/user_logout.php" style="float: right">Logout</a>
	  	<a href="shopping_cart.php" style="float: right;"><img style="width: 22px;" src="../images/image18.png"> / Shopping Cart</a>  	

<?php
}
?>

	  	<div id="login" class="modal">
		  	<form class="modal-content animate" method="post">
			    <div class="imgcontainer">
			      	<span onclick="document.getElementById('login').style.display='none'" class="close">&times;</span>		      
			    </div>

			    <div class="container">
				    <label><b>Username</b></label>
				    <input type="text" placeholder="Enter Username" name="Lusername" required value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} ?>">

				    <label><b>Password</b></label>
				    <input type="password" placeholder="Enter Password" name="Lpassword" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>" required>
				        
				    <button type="submit" name="Lsubmit" class="loginbtn">Login</button>
				    <label>
				    	<input type="checkbox" checked="checked" name="remember"> Remember me
				    </label>
			    </div>

			    <div class="container" style="margin-bottom: 1%">
			      <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
			    </div>
		  	</form>
		</div>	

</div>
