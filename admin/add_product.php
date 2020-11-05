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
    $productName = $_POST['productName'];
    $categoriesId = $_POST['categories'];
    $brand = $_POST['brand'];
    $description1 = $_POST['description1'];
    $description2 = $_POST['description2'];
    $description3 = $_POST['description3'];
    $description4 = $_POST['description4'];
    $description5 = $_POST['description5'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image='';
    if(($_FILES['image']['name']!="")){
        // where the file is going to be stored
        $target_dir = "../images/";
        $file = $_FILES['image']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['image']['tmp_name'];
        $path_filename_ext=$target_dir.$filename.".".$ext;

        //check if file already exists
        $increment='';
        while(file_exists($path_filename_ext)){
            $increment++;
            $path_filename_ext = $target_dir.$filename."(".$increment.")".".".$ext;
        }

        move_uploaded_file($temp_name, $path_filename_ext);

        if($increment!=''){
            $image=$filename."(".$increment.")".".".$ext;
        }
        else{
            $image=$filename.$increment.".".$ext;
        }
    }

    $sql = "INSERT INTO product(categoriesId, productName, brand, description1, description2, description3, description4, description5, productImage, unitPrice, stockQuantity) VALUES (:categoriesId, :productName, :brand, :description1, :description2, :description3, :description4, :description5, :image, :price, :quantity)";
    $query = $dbh -> prepare($sql);
    $query -> bindParam(':categoriesId', $categoriesId, PDO::PARAM_INT);
    $query -> bindParam(':productName', $productName, PDO::PARAM_STR);
    $query -> bindParam(':brand', $brand, PDO::PARAM_STR);
    $query -> bindParam(':description1', $description1, PDO::PARAM_STR);
    $query -> bindParam(':description2', $description2, PDO::PARAM_STR);
    $query -> bindParam(':description3', $description3, PDO::PARAM_STR);
    $query -> bindParam(':description4', $description4, PDO::PARAM_STR);
    $query -> bindParam(':description5', $description5, PDO::PARAM_STR);
    $query -> bindParam(':image', $image, PDO::PARAM_STR);
    $query -> bindParam(':price', $price, PDO::PARAM_STR);
    $query -> bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query -> execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId){
        $msg = "Result info added successfully";
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
        <title>Admin | Add Product</title>
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
                                    <h2 class="title">Add Product</h2>
                                
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
                                                <form class="form-horizontal" method="post" enctype="multipart/form-data" style="margin-left: -5%; margin-right: 5%;">
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Product Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="productName" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Categories</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control stid" name="categories" style="margin-bottom: 0.8%;">
                                                                <option selected="selected" hidden="">None</option>
                                                                <option value="1">Phone</option>
                                                                <option value="2">Charger</option>
                                                                <option value="3">Earphone</option>
                                                                <option value="0">Others</option>
                                                            </select>
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Brand</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="brand" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Description 1</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description1" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Description 2</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description2" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Description 3</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description3" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Description 4</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description4" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Description 5</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description5" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Product Image</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="image" class="form-control stid" style="margin-bottom: 0.8%;">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Price</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="price" class="form-control stid">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">Quantity</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="quantity" class="form-control stid">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Product</button>
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
