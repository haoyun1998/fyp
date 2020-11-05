<?php
session_start();
error_reporting(0);
include('../includes/config.php');

$id = $_GET['id'];

if(strlen($_SESSION['Alogin'])=="")
    {   
    header("Location: admin_login.php"); 
    }
    else{
if(isset($_POST['update']))
{
$productName = $_POST['productName'];
$brand = $_POST['brand'];
$description1 = $_POST['description1'];
$description2 = $_POST['description2'];
$description3 = $_POST['description3'];
$description4 = $_POST['description4'];
$description5 = $_POST['description5'];
$image = $_POST['image_url'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if($_FILES['image']['name'] != ""){
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

$sql="UPDATE product SET productName=:productName, brand=:brand, description1=:description1, description2=:description2, description3=:description3, description4=:description4, description5=:description5, productImage=:image, unitPrice=:price, stockQuantity=:quantity WHERE productId=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':productName',$productName,PDO::PARAM_STR);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->bindParam(':description1',$description1,PDO::PARAM_STR);
$query->bindParam(':description2',$description2,PDO::PARAM_STR);
$query->bindParam(':description3',$description3,PDO::PARAM_STR);
$query->bindParam(':description4',$description4,PDO::PARAM_STR);
$query->bindParam(':description5',$description5,PDO::PARAM_STR);
$query->bindParam(':image',$image,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$msg="Subject Info updated successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Update Product Information</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
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
                                    <h2 class="title">Update Product Information</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                
                        </div>
                        <div class="container-fluid" style="margin-top: 10px">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                
                                            </div>
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
                                                <form class="form-horizontal" method="post" enctype="multipart/form-data">

<?php
$sql = "SELECT * from product where productId=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute() or die();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                               
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Product Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="productName" value="<?php echo htmlentities($result->productName);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Brand</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="brand" value="<?php echo htmlentities($result->brand);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Description 1</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description1" value="<?php echo htmlentities($result->description1);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Description 2</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description2" value="<?php echo htmlentities($result->description2);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Description 3</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description3" value="<?php echo htmlentities($result->description3);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Description 4</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="description4" value="<?php echo htmlentities($result->description4);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Description 5</label>
                                                        <div class="col-sm-10"> 
                                                            <input type="text" name="description5" value="<?php echo htmlentities($result->description5);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Product Image</label>
                                                        <div class="col-sm-10">
                                                            <img src="../images/<?php echo htmlentities($result->productImage) ?>" style='height: 200px; width: 200px;'>
                                                            <div style="text-decoration: underline;">Upload New Image</div>
                                                            <input type="file" name="image">
                                                            <input type="hidden" name="image_url" value="<?php echo htmlentities($result->productImage) ?>" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Price</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="price" value="<?php echo htmlentities($result->unitPrice);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Quantity</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="quantity" value="<?php echo htmlentities($result->stockQuantity);?>" class="form-control" id="default" required="required">
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Status</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="status">
                                                                <?php
                                                                if($result->status == 1){?>
                                                                    <option value="0">Available</option>
                                                                    <option value="1" selected>Maintenance</option>
                                                                <?php
                                                                }else{?>
                                                                    <option value="0" selected>Available</option>
                                                                    <option value="1">Maintenance</option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                    <?php }} ?>

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
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
