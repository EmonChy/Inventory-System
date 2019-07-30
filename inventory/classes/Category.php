<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/Format.php');

class Category {
   
    //put your code here
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database(); //obj create for database class
        $this->fm = new Format();   //obj create for format class
      
    }
    
    public function addCategory($category_name) {
        $category_name     = $this->fm->validation($category_name);    // validation
        $category_name     = mysqli_real_escape_string($this->db->link, $category_name);
        $status = 1;
        $query = "SELECT * FROM category WHERE category_name = '$category_name' LIMIT 1";
        $checkCat = $this->db->select($query);
        if($checkCat){
             return "Category_Exist";
         }else{             
          $query = "INSERT INTO category(category_name,status) VALUES('$category_name','$status')";
          $result = $this->db->insert($query);
            if($result){
               return "Category_Added";
            }else{
                return 0;
               }
         }
    }
    // get all category records 
    public function getAllCategory(){
        $query = "SELECT * FROM category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;      
    }
    public function deleteCategory($delcat) {
        $delcat = $this->fm->validation($delcat); /// validation

        $delcat = mysqli_real_escape_string($this->db->link, $delcat);
        $query = "DELETE FROM category WHERE catId = '$delcat'";
        $deletedata = $this->db->delete($query);
        if ($deletedata){
            return "Category_Deleted";
            }else{
                return 0;
          }
    }
    
    public function getCategory($catId) {
       $query = "SELECT * FROM category WHERE catId = '$catId'";
       $result = $this->db->select($query)->fetch_assoc();
       
       return $result; 
    }
    
    public function updtCategory($category_name,$catId){
        $category_name = $this->fm->validation($category_name);

        $category_name = mysqli_real_escape_string($this->db->link, $category_name);

           $query = "UPDATE category SET category_name = '$category_name' WHERE catId = '$catId'";
                   
           $catupdate = $this->db->update($query);
           if($catupdate){
              
               //$msg = "<span class='success'>Category updated successfully</span>";
               return "updated";
           }else{
               return 0;
               //$msg = "<span class = 'error'>Update failed</span>";
               //return $msg;
           }
           
        
    }
}
