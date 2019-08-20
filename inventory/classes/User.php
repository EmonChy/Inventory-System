<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/Format.php');


// User class for account creation and login purpose
class User{
    //put your code here
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database(); //obj create for database class
        $this->fm = new Format();   //obj create for format class
      
    }
    
    public function createUserAccount($data){
        $uName     = $this->fm->validation($data['uName']);    // validation
        $uEmail    = $this->fm->validation($data['uEmail']);   // validation
        $uPassword = $this->fm->validation($data['password1']);// validation
        $uconfirmPassword = $this->fm->validation($data['password2']);// validation
        $uType     = $this->fm->validation($data['uType']);    // validation
        
        $uName     = mysqli_real_escape_string($this->db->link, $data['uName']);
        $uEmail    = mysqli_real_escape_string($this->db->link, $data['uEmail']);
        $uPassword = mysqli_real_escape_string($this->db->link, $data['password1']);
        $uconfirmPassword = mysqli_real_escape_string($this->db->link, $data['password2']);
        $uType     = mysqli_real_escape_string($this->db->link, $uType);
        
        // email check,same email exist or not       
        $mailquery = "SELECT * FROM users WHERE uEmail = '$uEmail' LIMIT 1";
        $checkMail = $this->db->select($mailquery);
       
       
        if(!preg_match("/^[a-zA-Z ]*$/",$uName)){
            
            $msg = "<span style = 'color:red;font-weight:bold'>Only letters and white space allowed</span>";
            return $msg; 
        }
                
        else if(!filter_var($uEmail, FILTER_VALIDATE_EMAIL)){
                 $msg = "<span style = 'color:red;font-weight:bold'>Invalid Email Format</span>";
                 return $msg; 
                 
        }
        else if($checkMail){
               $msg = "<span style = 'color:red;font-weight:bold'>Email Already Exist!!</span>";
               return $msg;
        
        }
              
        // email check,same email exist or not                    
          
        
        else if($uPassword!=$uconfirmPassword){
         
            $msg = "<span style = 'color:red;font-weight:bold'>Password not matched!!</span>";
            return $msg;
        }else{
            $password = md5($uconfirmPassword);              
            date_default_timezone_set('Asia/Dhaka');
            $register_date = date('y-m-d');
            $last_login = date('y-m-d').' '.date('h:i:sa');
            $status=1;
            $query = "INSERT INTO users(uName,uEmail,uPassword,uType,register_date,last_login,status) VALUES('$uName','$uEmail','$password','$uType','$register_date','$last_login','$status')";
            $InsertUser = $this->db->insert($query);
            if($InsertUser) {
                $msg = "<span style='color:green;font-weight:bold'>You are registered Now you can login</span>";
                return $msg;
            }else {
                $msg = "<span style='color:red;font-weight:bold'>User registration is failed</span>";
                return $msg;
            }
        }        
    }
    
    public function userlogin($data) {
        $uEmail    = $this->fm->validation($data['uEmail']);   // validation
        $uPassword = $this->fm->validation($data['password']);// validation
        
        $uEmail    = mysqli_real_escape_string($this->db->link, $data['uEmail']);
        $uPassword = mysqli_real_escape_string($this->db->link, $data['password']);
        $password = md5($uPassword);
        
        $query = "SELECT * FROM users WHERE uEmail = '$uEmail' OR uPassword = '$password'";
        $checkUser = $this->db->select($query);
        if($checkUser){
        $mailquery = "SELECT * FROM users WHERE uEmail = '$uEmail'";
        $checkMail = $this->db->select($mailquery);
        if($checkMail){
             $passquery = "SELECT * FROM users WHERE uPassword = '$password'";
             $result = $this->db->select($passquery);
             
             if($result){
                 $value = $result->fetch_assoc();
                 $uId = $value['uId'];
                 $_SESSION['userlogin']=TRUE;
                 
                 $_SESSION['uId']        = $value['uId'];
                 $_SESSION['uName']      = $value['uName'];
                 $_SESSION['uType']      = $value['uType'];
                 $_SESSION['last_login'] = $value['last_login'];
                 $_SESSION['uPassword']  = $value['uPassword'];
                 
                 date_default_timezone_set('Asia/Dhaka');
                 $last_login = date('y-m-d').' '.date('h:i:sa');

                 $query = "UPDATE users
                          SET    
                          last_login    = '$last_login'
                              
                          WHERE uId  = '$uId'";

                 $loginUpdate = $this->db->update($query);
                 header('Location: dashboard.php');
                 
                 }else{
                   $msg = "<span style = 'color:red;font-weight:bold'>Password not matched!!</span>";
                   return $msg;
                  }
            
             }else{
             $msg = "<span style = 'color:red;font-weight:bold'>Email not matched!!</span>";
             return $msg;
            }
        }else{
           $msg = "<span style = 'color:red;font-weight:bold'>Sorry,You are not registered!!</span>";
           return $msg; 
    }
    
    }
    
    public function userData($id){
        $query = "SELECT * FROM users WHERE uId = '$id'";
        $result = $this->db->select($query);
        return $result;        
    }
    
    public function userUpdate($uName,$id){
      $uName = $this->fm->validation($uName); /// validation
      
      $uName = mysqli_real_escape_string($this->db->link, $uName);
       
      if(empty($uName)){
            $msg = "<span style='color:red;font-weight:bold'>Fields must not be empty</span>";
            return $msg;
      }else{
             $query = "UPDATE users
                       SET    
                       uName   = '$uName'

                       WHERE uId  = '$id'";

            $userupdate = $this->db->update($query);
            if ($userupdate) {
                header("Location: setting.php");
                //$msg = "<span style='color:green;font-weight:bold'>User Updated successfully</span>";
                //return $msg;
            } else {
                echo "<script>alert(Something Wrong)</script>";
                //$msg = "<span style='color:red;font-weight:bold'>Update has been failed</span>";
                //return $msg;
            }
        }

    }
    
    public function changePassword($id,$new_password){
        $id      = $this->fm->validation($id);
        $new_password = $this->fm->validation($new_password);
        

        $id      = mysqli_real_escape_string($this->db->link, $id);
        $new_password = mysqli_real_escape_string($this->db->link, $new_password);
        
        if(empty($new_password)){
            $msg = "<span style='color:red;font-weight:bold'>Password must not be empty</span>";
            return $msg;
        }else{
               $query = "UPDATE users
                         SET    
                         uPassword  = '$new_password' 
                         WHERE uId  = '$id'";

            $passwordupdate = $this->db->update($query);
                       
            if ($passwordupdate) {
                //header("Location: setting.php");
                $msg = "<span style='color:green;font-weight:bold'>Password Updated successfully</span>";
                return $msg;
            } else {
                $msg = "<span style='color:red;font-weight:bold'>Password update is failed</span>";
                return $msg;
            }            
        }
    }
    
}
