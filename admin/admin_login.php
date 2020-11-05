<?php
session_start();
error_reporting(0);

include("../includes/config.php");
include("admin_function/script_admin_login.php");


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="admin_css/admin_login.css">
</head>
<body>

  <div class="content">
    <h3>Smart Phone System(Admin)</h3>

    <div class="form">
      <form method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="Your username.." required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Your password.." required>
      
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>
  </div>

</body>
</html>
