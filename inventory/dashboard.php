<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once ("classes/Product.php");
    $pr = new Product();
    $products = $pr->getAllProduct();
    
    $orders = $pr->getAllOrders();
    
    $stocks = $pr->getProductStocks();
    
    $totalRevenue = $pr->getAllOrders();// used for revenue
    
    
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
                        <a href="setting.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Settings</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="jumbotron" style="width: 100%;height: 100%">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card bg-info mb-3">
                                <p class="card-header">
                                    <a href="manage_products.php" style="text-decoration:none;color:white;">
                                        Total Products<span class="badge badge-light float-right">
                                        <?php
                                        if($products){
                                        echo mysqli_num_rows($products);
                                        }else{ echo 0;}?></span>				   
                                    </a>                                 
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4"> 
                          <div class="card bg-success mb-3">
                                <p class="card-header">
                                    <a href="manage_orders.php" style="text-decoration:none;color:white;">
                                        Total Orders<span class="badge badge-light float-right">
                                        <?php
                                        if($orders){
                                        echo mysqli_num_rows($orders);
                                        }else{ echo 0;}?>  
                                        </span>				   
                                    </a>                                 
                                </p>
                            </div>  
                            
                        </div>
                        <div class="col-sm-4">
                             <div class="card bg-danger mb-3">
                                <p class="card-header">
                                    <a href="manage_products.php" style="text-decoration:none;color:white;">
                                        Low Stock<span class="badge badge-light float-right">
                                        <?php 
                                        if($stocks){
                                        echo mysqli_num_rows($stocks);
                                        }else{ echo 0;}?>   
                                        </span>				   
                                    </a>                                 
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-sm-4">
                          <iframe src="http://free.timeanddate.com/clock/i6u7be96/n73/szw160/szh160/cf100/hnce1ead6" frameborder="0" width="160" height="160"></iframe>
  
                        </div>
                        <div class="col-sm-4">
                  
                            
                        <div class="card text-white bg-dark mb-3">
                                <div class="card-header text-center">Total Revenue</div>
                                <div class="card-body text-center ">
                                    <h5><?php
                                    if($totalRevenue){
                                       $total=0;
                                        while($result = $totalRevenue->fetch_assoc()){
                                            $total = $total+$result['paid'];
                                        }
                                         
                                    echo 'RS'.' '.$total;}else{echo 'RS'.' '.'0';} ?></h5>
                                </div>
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Orders</h5>
                                    <p class="card-text">Here you can make invoices and create orders and manage</p>
                                    <a href="new_orders.php" class="btn btn-sm btn-outline-primary">New</a>
                                    <a href="manage_orders.php" class="btn btn-sm btn-outline-secondary">Manage</a>

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
                            <p class="card-text">Here you can manage your categories and add new categories</p>
                            <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-outline-primary">Add</a>
                            <a href="manage_categories.php" class="btn btn-outline-success">Manage</a>
                        </div>
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Brands</h5>
                            <p class="card-text">Here you can manage your brands and add new brands</p>
                            <a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-outline-primary">Add</a>
                            <a href="manage_brands.php" class="btn btn-outline-success">Manage</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p class="card-text">Here you can manage your products and add new products</p>
                            <a href="#" data-toggle="modal" data-target="#form_product" class="btn btn-outline-primary">Add</a>
                            <a href="manage_products.php" class="btn btn-outline-success">Manage</a>
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

