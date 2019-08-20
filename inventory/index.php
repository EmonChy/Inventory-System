<?php
session_start();
if(isset($_SESSION['userlogin'])){
    header('location:dashboard.php');
}else{
include_once ("classes/User.php");
$user = new User();
if($_SERVER["REQUEST_METHOD"]== 'POST' && isset($_POST['user_login'])){
    
    $loginUser = $user->userlogin($_POST);
}

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
        <div class="container">
            <div class="card mx-auto" style="width: 22rem;">
                <img src="images/login.png" style="width: 60%" class="card-img-top mx-auto" alt="...">
                <div class="card-body">
                    <?php if(isset($loginUser)){ ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?php echo $loginUser; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php }?>                     
                    <form action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="uEmail" id="email"  placeholder="Enter email" required="">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                        </div>
                        <button type="submit" name="user_login" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
                        <span><a href="register.php">Register</a></span>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="#">Forget Password?</a>
                </div>
            </div>
        </div>
    </body>
</html>
<?php }?>
