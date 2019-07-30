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
    
}
