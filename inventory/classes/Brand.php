<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/Format.php');

class Brand {
    //put your code here
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database(); //obj create for database class
        $this->fm = new Format();   //obj create for format class
      
    }
        public function addBrand($brand_name) {
            
        $brand_name     = $this->fm->validation($brand_name);    // validation
       // $catId     = $this->fm->validation($catId);    // validation

        $brand_name     = mysqli_real_escape_string($this->db->link, $brand_name);
       // $catId     = mysqli_real_escape_string($this->db->link, $catId);

        $status = 1;
        
        $query = "SELECT * FROM brand WHERE brand_name = '$brand_name' LIMIT 1";
        $checkBrand = $this->db->select($query);
        if($checkBrand){
             return "Brand_Exist";

        }else{             
          $query = "INSERT INTO brand(brand_name,status) VALUES('$brand_name','$status')";
          $result = $this->db->insert($query);
            if($result){
                return "Brand_Added";
            }else{
                return 0;
            }
        }
    }
    
    public function getAllBrand(){
           /*$query = "SELECT b.*,c.category_name
                     FROM brand as b,category as c
                     WHERE b.catId = c.catId
                     ORDER BY b.bId DESC";*/
        $query = "SELECT * FROM brand ORDER BY bId DESC";
        $result = $this->db->select($query);
        return $result; 
    }
    
        public function deleteBrand($delbr) {
        $delbr = $this->fm->validation($delbr); /// validation

        $delbr = mysqli_real_escape_string($this->db->link, $delbr);
        $query = "DELETE FROM brand WHERE bId = '$delbr'";
        $deletedata = $this->db->delete($query);
        if ($deletedata) {
            $msg = "<span style = 'color:green;font-weight:bold'>Brand deleted successfully!!</span>";
            return $msg;
            }else{
            $msg = "<span style = 'color:red;font-weight:bold'>Something Wrong! not deleted</span>";
            return $msg;
          }
    }
    
    public function getBrand($bId){
       $query = "SELECT * FROM brand WHERE bId = '$bId'";
       $result = $this->db->select($query)->fetch_assoc();
       return $result; 
    }
    
    public function updtBrand($brand_name,$bId){
        $brand_name = $this->fm->validation($brand_name);

        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);

           $query = "UPDATE brand SET brand_name = '$brand_name' WHERE bId = '$bId'";
                   
           $brupdate = $this->db->update($query);
           if($brupdate){
              
               //$msg = "<span class='success'>Category updated successfully</span>";
               return "updated";
           }else{
               return 0;
               //$msg = "<span class = 'error'>Update failed</span>";
               //return $msg;
           }
           
    }
}
