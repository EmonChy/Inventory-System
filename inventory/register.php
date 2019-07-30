<?php
include_once ("classes/User.php");
$user = new User();
if($_SERVER["REQUEST_METHOD"]== 'POST' && isset($_POST['user_register'])){
    
    $insertUser = $user->createUserAccount($_POST);
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
        
       <!-- <script type="text/javascript" src="js/main.js"></script> -->
     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
        <div class="container">
            <div class="card mx-auto" style="width: 30rem;">
                <div class="card-header text-center font-weight-bolder">Register</div>
                <div class="card-body">
                    <?php
                     if(isset($insertUser)){?>
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                     <?php echo $insertUser;?>             
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                     <?php }?>
                    <form id="register_form" action="" autocomplete="off" method="post">
                         <div class="form-group">
                            <label for="uname">Full Name</label>
                            <input type="text" name="uName" id="uname" class="form-control"  placeholder="Enter name" required="">
                            <small id="u_error" class="form-text text-muted"></small>

                         </div>
                        <div class="form-group">
                            <label for="uEmail">Email address</label>
                            <input type="email" name="uEmail" id="uEmail" class="form-control" placeholder="Enter email" required="">
                            <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="password1">Password</label>
                            <input type="password" name="password1" id="password1" class="form-control" placeholder="Password" required="">
                            <small id="p1_error" class="form-text text-muted"></small>

                        </div>
                         <div class="form-group">
                            <label for="password2">Re-enter password</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Password" required="">
                            <small id="p2_error" class="form-text text-muted"></small>

                         </div>
                        <div class="form-group">
                            <label for="uType">Usertype</label>
                            <select name="uType" class="form-control" id="uType" required="">
                                <option value="">Choose User Type</option>
                                <option value="Admin">Admin</option>
                                <option value="Other">Other</option>
                            </select>
                        <small id="t_error" class="form-text text-muted"></small>
  
                        </div>
                        <button type="submit" name="user_register" class="btn btn-primary"><i class="fa fa-user">&nbsp;</i>Register</button>
                        <span><a href="index.php">Login</a></span>
                    </form>
                </div>
                <div class="card-footer text-muted">
                  
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript">
    $(document).ready(function(){        
    $("#register_form").on("submit",function(){
        var status = false;
        var name  = $("#uname");
        var email = $("#uEmail");
        var pass1 = $("#password1");
        var pass2 = $("#password2");
        var type  = $("#uType");
      
        var e_patt = new RegExp(/^[A-Za_z0-9_-]+(\.[A-Za-z0-9_-]*@[a_z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
        
        if(name.val()=="" || name.val().length<4){
            name.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 4 char</span>");
            status = false;
        }else{
            name.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
        }    
    });
   });
     </script>
</html>
