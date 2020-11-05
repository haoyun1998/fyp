<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['Alogin'])=="")
    {   
    header("Location: admin_panel.php"); 
    }
    else{
if(isset($_POST['submit'])){
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customer(customerName, phoneNumber, address, username, password) VALUES (:customerName, :phoneNumber, :address, :username , :password)";
    $query = $dbh -> prepare($sql);
    $query -> bindParam(':customerName', $customerName, PDO::PARAM_STR);
    $query -> bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
    $query -> bindParam(':address', $address, PDO::PARAM_STR);
    $query -> bindParam(':username', $username, PDO::PARAM_STR);
    $query -> bindParam(':password', $password, PDO::PARAM_STR);
    $query -> execute() or die();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId){
        $msg = "Customer info added successfully";
    } else{
        $error="Something went wrong. Please try again";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Add Customer</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script>
function getStudent(val) {
    $.ajax({
    type: "POST",
    url: "get_student.php",
    data:'classid='+val,
    success: function(data){
        $("#studentid").html(data);
        
    }
    });
$.ajax({
        type: "POST",
        url: "get_student.php",
        data:'classid1='+val,
        success: function(data){
            $("#subject").html(data);
            
        }
        });
}
    </script>
<script>

function getresult(val,clid) 
{   
    
var clid=$(".clid").val();
var val=$(".stid").val();;
var abh=clid+'$'+val;
//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student.php",
        data:'studclass='+abh,
        success: function(data){
            $("#reslt").html(data);
            
        }
        });
}
</script>


    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('include/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('include/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Add Customer</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid" style="margin-top: 10px">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post" style="margin-left: -5%; margin-right: 5%;">
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Customer Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="customerName" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Phone Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="phoneNumber" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Username</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="username" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="password" class="form-control stid">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Customer</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
