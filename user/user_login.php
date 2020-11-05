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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/user_login.css"> 
	<!-- chatbot -->
	<!-- <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
	<link href="../includes/chatbot/style.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
	<!-- chatbot -->
</head>
<body>
	<?php
	include("../includes/top_bar.php");
	include("../includes/chatbot/chatbot.php");
	?>

	<div class="border">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  		<ol class="carousel-indicators">
	    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  		</ol>
	  		<div class="carousel-inner">
	    		<div class="carousel-item active">
	      			<img class="d-block w-100" src="../images/image01.jpg" alt="First slide">
	   			</div>
	   		 	<div class="carousel-item">
	      			<img class="d-block w-100" src="../images/image03.jpg" alt="Second slide">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="../images/image04.jpg" alt="Third slide">
	    		</div>
	  		</div>
	  		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    		<span class="sr-only">Previous</span>
	  		</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			</a>
		</div>

		<div class="suggestion">
			<div>
				<div class="phone-img-left">
					<img src="../images/image02.jpg">
				</div>

				<div class="phone-description-right">
					<span>New</span>
					<h3>iPhone SE</h3>
					<h2>Lots to love.<br> Less to spend.</h2>
					<h6>Starting at RM 1,999</h6>
					<button>Buy</button><br>
					<a href="">Learn more ></a>
				</div>
			</div>	

			<div>
				<div class="phone-img-right">
					<img src="../images/image05.jpg">
				</div>

				<div class="phone-description-left">
					<span>New</span>
					<h3>HuaWei Nova 7I</h3>
					<h2>Just the right<br>amount<br>of everything.</h2>
					<h6>Starting at RM 1,099</h6>
					<button>Buy</button><br>
					<a href="">Learn more ></a>
				</div>
			</div>	

			<div style="padding-bottom: 2%">
				<div class="phone-img-left">
					<img src="../images/image02.jpg">
				</div>

				<div class="phone-description-right">
					<span>New</span>
					<h3>Samsung Galaxy A51</h3>
					<h2>Pro Camera.<br>Pro display.<br>Pro performance.</h2>
					<h6>Starting at RM 1,299</h6>
					<button>Buy</button><br>
					<a href="">Learn more ></a>
				</div>
			</div>
		</div>

	</div>
	
	<?php
	include("../includes/footer.php");
	?>
</body>

	<script src="https://use.fontawesome.com/70d4dba811.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="../bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

	<script>
		// Get the modal
		var modal = document.getElementById('login');
		var modal2 = document.getElementById('bot');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    } else if (event.target == modal2) {
		      	modal2.style.display = "none";
		    }
		}
	</script>

</html>