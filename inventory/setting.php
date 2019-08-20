<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once ("classes/User.php");
    $user = new User();
    $id = $_SESSION['userlogin']; // id of individual user
    $getUserData = $user->userData($id);
    
    if(isset($_POST['updt_profile'])){
     $uName = $_POST['uName'];   
     $updateUser = $user->userUpdate($uName,$id); /// belong to the user class
     
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
           <diV class="row">
                 <div class="col-md-10 mx-auto">
                     <div class="card" style="box-shadow: 0 0 25px 0 lightgray">
                             <div class="card-header">
                                 <h4>Setting</h4>
                             </div>
                             <div class="card-body">
                                 <h6>Change UserName</h6><hr>
                                
                                 <form autocomplete="off" action="" method="post">                                         
                                      <?php
                                      if($getUserData){
                                          while($result=$getUserData->fetch_assoc()){
                                      ?>
                                         <div class="form-group row">                                             
                                             <label class="col-sm-3" align="right">User Name</label>
                                             <div class="col-sm-6">
                                                 <input type="text" id="uName" name="uName" class="form-control form-control-sm" value="<?php echo $result['uName'];?>"/>
                                             </div>
                                         </div>
                                     <div class="form-group row">
                                         <label class="col-sm-3"></label>                                         
                                         <div class="col-sm-6">
                                             <button type="submit" name="updt_profile" class="btn btn-success btn-sm"><i class="fa fa-check">&nbsp;</i>Save Changes</button>
                                         </div>
                                     </div>
                                      <?php }}?>
                                        <br><br>
                                 </form>
                                 
                               <!----  next execution begin --->
                                <?php
                                $getUserData = $user->userData($id);
                                $updatedPass = "";
                                if(isset($_POST['save'])){
                                $oldpass = $_POST['o_pass'];
                                $newpass = $_POST['n_pass'];
                                $confirmpass = $_POST['c_pass'];
                                if($val = $getUserData->fetch_assoc()){
                                    $userPassword = $val['uPassword'];        
                                }    
                                $old_password = md5($oldpass); // old pass, when user input
                                // match existing pass and user input pass
                                if($userPassword==$old_password){
                                    if($newpass==$confirmpass){
                                    $new_password = md5($newpass); // store new pass in db
                                    $updatedPass .= $user->changePassword($id,$new_password); // belong to the AdminLogin class        
                                    }else{
                                    $updatedPass .= "<span style='color:red;font-weight:bold'>Your New & Confirm password not matched</span>";
                                    }        
                                    }else{
                                    $updatedPass .= "<span style='color:red;font-weight:bold'>Your Old password not matched</span>";
                                    }        
                                }
                             ?>  
                                 
                                 <h6>Change Password</h6><hr>
                                             <?php
                                                if(isset($updatedPass)){
                                                    echo $updatedPass;
                                                }
                                                ?>
                                 <form autocomplete="off" action="" method="post">
                                        <div class="form-group row">
                                            <label for="o_pass" class="col-sm-3 col-form-label" align="right">Old Password</label>
                                             <div class="col-sm-6">
                                                 <input type="password" name="o_pass" id="o_pass" class="form-control form-control-sm" placeholder="Enter Old Password" required=""/>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="n_pass" class="col-sm-3 col-form-label" align="right">New Password</label>
                                             <div class="col-sm-6">
                                                 <input type="password" name="n_pass" id="n_pass" class="form-control form-control-sm" placeholder="Enter New Password" required=""/>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="c_pass" class="col-sm-3 col-form-label" align="right">Confirm Password</label>
                                             <div class="col-sm-6">
                                                 <input type="password" name="c_pass" id="c_pass" class="form-control form-control-sm" placeholder="Enter Confirm Password" required=""/>
                                             </div>
                                        </div>
                                       <div class="form-group row">
                                         <label class="col-sm-3"></label>                                         
                                         <div class="col-sm-6">
                                             <button type="submit" name="save" class="btn btn-primary btn-sm"><i class="fa fa-check">&nbsp;</i>Confirm</button>
                                          </div>
                                       </div>
                                 </form>
                             </div>
                         </div>
                 </div> 
             </diV>            
        </div>

    </body>
</html>
<?php }?>



