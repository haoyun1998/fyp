<?php
// if (isset($_SESSION['alogin']) && $_SESSION['alogin'] != '') {
// 	$_SESSION['alogin'] = '';
// }

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT username, password, adminId FROM admin WHERE username=:username AND password=:password";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':username', $username, PDO::PARAM_STR);
	$query -> bindParam(':password', $password, PDO::PARAM_STR);
	$query -> execute() or die();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if ($query->rowcount() > 0) {
		$_SESSION['Alogin']=$_POST['username'];
		$_SESSION['compare']=$_POST['username'];
		foreach ($results as $result) {
			$_SESSION['id'] = htmlentities($result->adminId);
		}
		echo "<script>alert('Welcome back');</script>";
		echo "<script type='text/javascript'> document.location = 'admin_dashboard.php'; </script>";
	} else {
		echo "<script>alert('Invalid Details'); </script>";
	}
}
?>