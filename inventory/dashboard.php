<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inventory System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <script src="js/main.js"></script>
     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
         <div class="container" style="background-color: activecaption">
             <br>
            <div class="row">
            <div class="col-md-4">
                <div class="card mx-auto">
                    <img src="images/user.png" style="width: 60%" class="card-img-top mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Profile Info</h5>
                        <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION['uName'];?></p>
                        <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION['uType'];?></p>
                        <p class="card-text"><i class="fa fa-clock-o">&nbsp;</i>Last Login : <?php echo $_SESSION['last_login']; ?></p>
                        <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="jumbotron" style="width: 100%;height: 100%">
                    <h1>Welcome Admin</h1>
                    <div class="row">
                        <div class="col-sm-6">
                          <iframe src="http://free.timeanddate.com/clock/i6u7be96/n73/szw160/szh160/cf100/hnce1ead6" frameborder="0" width="160" height="160"></iframe>
  
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">New Orders</h5>
                                    <p class="card-text">Here you can make invoices and create new orders</p>
                                    <a href="new_orders.php" class="btn btn-primary">New Orders</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <p class="card-text">Here you can manage your categories and you add new parent and sub categories</p>
                            <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
                            <a href="manage_categories.php" class="btn btn-success">Manage</a>
                        </div>
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Brands</h5>
                            <p class="card-text">Here you can manage your brands and new brands</p>
                            <a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-primary">Add</a>
                            <a href="manage_brands.php" class="btn btn-success">Manage</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p class="card-text">Here you can manage your products and new products</p>
                            <a href="#" data-toggle="modal" data-target="#form_product" class="btn btn-primary">Add</a>
                            <a href="manage_products.php" class="btn btn-success">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
         <?php
         // form_category
         include_once ("templates/category.php");?>
         <?php
         // form_brand
         include_once ("templates/brand.php");?>
         <?php
         // form_product
         include_once ("templates/product.php");?>
    </body>
</html>
<?php }?>

