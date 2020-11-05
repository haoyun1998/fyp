<?php
session_start();
error_reporting(0);

include("../includes/config.php");
include("../function/script_user_login.php");
include("../function/script_contact_us.php");

if(strlen($_SESSION['alogin'])==""){
	header("Location: user_login.php");
} 
// else if($_SESSION['alogin']) != ($_SESSION['compare']) {
// 	header("Location: user_login.php");
// }

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/user_login.css">
	<link rel="stylesheet" type="text/css" href="../css/contact_us.css">
</head>
<body>
	<?php
	include("../includes/top_bar.php")
	?>

	<div class="contact">
	  <form method="post">
	    <label for="fname">First Name</label>
	    <input type="text" id="fname" name="firstname" placeholder="Your first name.." required>

	    <label for="lname">Last Name</label>
	    <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>

	    <label for="lname">Email</label>
	    <input type="text" id="email" name="email" placeholder="We will reply to this email.." required>

	    <label for="country">Remark</label>
	    <textarea name="remark" rows="10" placeholder="Remark..." required></textarea>

	    <label>**Check the feedback in your email!!</label>
	  
	    <input type="submit" name="Csubmit" value="Submit">
	  </form>
	</div>

	<?php
	include("../includes/footer.php")
	?>

</body>
</html>