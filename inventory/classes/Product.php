<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/Format.php');
class Product {
    //put your code here
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database(); //obj create for database class
        $this->fm = new Format();   //obj create for format class
      
    }
    
    public function addProduct($catId,$brId,$product_name,$price,$qty,$date){
      $catId     = $this->fm->validation($catId);    // validation
      $brId     = $this->fm->validation($brId);    // validation
      $product_name     = $this->fm->validation($product_name);    // validation
      $price     = $this->fm->validation($price);    // validation
      $qty     = $this->fm->validation($qty);    // validation
      $date     = $this->fm->validation($date);    // validation
      
      $catId     = mysqli_real_escape_string($this->db->link, $catId);
      $brId     = mysqli_real_escape_string($this->db->link, $brId);
      $product_name     = mysqli_real_escape_string($this->db->link, $product_name);
      $price     = mysqli_real_escape_string($this->db->link, $price);
      $qty     = mysqli_real_escape_string($this->db->link, $qty);
      $date     = mysqli_real_escape_string($this->db->link, $date);
      
      $status =1;
      $query = "SELECT * FROM product WHERE product_name = '$product_name' LIMIT 1";
        $checkPd = $this->db->select($query);
        if($checkPd){
             return "Product_Exist";

        }else{
      $query = "INSERT INTO product(cId,bId,product_name,product_price,product_stock,date,status) VALUES('$catId','$brId','$product_name','$price','$qty','$date','$status')";
          $result = $this->db->insert($query);
            if($result){
                return "Product_Added";
            }else{
                return 0;
            }      
        }
    }
     
    public function getAllProduct(){
           $query = "SELECT p.*,c.category_name,b.brand_name
                     FROM product as p,category as c,brand as b
                     WHERE p.cId = c.catId AND p.bId = b.bId
                     ORDER BY p.pId DESC";
        $result = $this->db->select($query);
        return $result; 
    }
    
   
    
    public function deleteProduct($delpr) {
        $delpr = $this->fm->validation($delpr); /// validation

        $delpr = mysqli_real_escape_string($this->db->link, $delpr);
        
        $query = "DELETE FROM product WHERE pId='$delpr'";
        $result = $this->db->delete($query);
         if ($result) {
             return "Product_Deleted";
            //$msg = "<span style = 'color:green;font-weight:bold'>Brand deleted successfully!!</span>";
            //return $msg;
            }else{
                return 0;
            //$msg = "<span style = 'color:red;font-weight:bold'>Something Wrong! not deleted</span>";
            //return $msg;
          }
    }
    
    public function getProduct($pId){
       $query = "SELECT * FROM product WHERE pId = '$pId'";
       $result = $this->db->select($query)->fetch_assoc(); // single array
       return $result; 
    }
    
    public function updateProduct($pId,$cId,$bId,$product_name,$product_price,$product_qty,$date,$status){
       $pId = $this->fm->validation($pId); /// validation
       $cId = $this->fm->validation($cId); /// validation
       $bId = $this->fm->validation($bId); /// validation
       $product_name = $this->fm->validation($product_name); /// validation
       $product_price = $this->fm->validation($product_price); /// validation
       $product_qty = $this->fm->validation($product_qty); /// validation
       $date = $this->fm->validation($date); /// validation
       $status = $this->fm->validation($status); /// validation

       
       $pId = mysqli_real_escape_string($this->db->link, $pId);
       $cId = mysqli_real_escape_string($this->db->link, $cId);
       $bId = mysqli_real_escape_string($this->db->link, $bId);
       $product_name = mysqli_real_escape_string($this->db->link, $product_name);
       $product_price = mysqli_real_escape_string($this->db->link, $product_price);
       $product_qty = mysqli_real_escape_string($this->db->link, $product_qty);
       $date = mysqli_real_escape_string($this->db->link, $date);
       $status = mysqli_real_escape_string($this->db->link, $status);

      
        $query = "UPDATE product
                  SET
                  cId = '$cId',
                  bId = '$bId',
                  product_name = '$product_name',
                  product_price = '$product_price',
                  product_stock = '$product_qty',
                  date = '$date',
                  status = '$status'    
                  WHERE pId = '$pId'";    

     $pdupdate = $this->db->update($query);
         if($pdupdate){
             return "Product_Updated";
        }else{
            return 0;
        }

    }
    
    // used in order page 
    public function getAllActiveProduct() {
        $query = "SELECT * FROM product WHERE product_stock>0 AND status=1 ORDER BY pId DESC";
        $result = $this->db->select($query);
        return $result; 
    }
    
   public function storeOrderInvoice($order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$ar_pro_id,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){
     /*
      
      $order_date = $this->fm->validation($order_date); /// validation
      $cust_name = $this->fm->validation($cust_name); /// validation
      $ar_tqty = $this->fm->validation($ar_tqty); /// validation
      $ar_qty = $this->fm->validation($order_date); /// validation
      $ar_price = $this->fm->validation($ar_price); /// validation
      $ar_pro_name = $this->fm->validation($ar_pro_name); /// validation
      $sub_total = $this->fm->validation($sub_total); /// validation
      $gst = $this->fm->validation($gst); /// validation
      $discount = $this->fm->validation($discount); /// validation
      $net_total = $this->fm->validation($net_total); /// validation
      $paid = $this->fm->validation($paid); /// validation
      $due = $this->fm->validation($due); /// validation
      $payment_type = $this->fm->validation($payment_type); /// validation
      
      $order_date = mysqli_real_escape_string($this->db->link, $order_date);
      $cust_name = mysqli_real_escape_string($this->db->link, $cust_name);
      $ar_tqty = mysqli_real_escape_string($this->db->link, $ar_tqty);
      $ar_qty = mysqli_real_escape_string($this->db->link, $ar_qty);
      $ar_price = mysqli_real_escape_string($this->db->link, $ar_price);
      $ar_pro_name = mysqli_real_escape_string($this->db->link, $ar_pro_name);
      $sub_total = mysqli_real_escape_string($this->db->link, $sub_total);
      $gst = mysqli_real_escape_string($this->db->link, $gst);
      $discount = mysqli_real_escape_string($this->db->link, $discount);
      $net_total = mysqli_real_escape_string($this->db->link, $net_total);
      $paid = mysqli_real_escape_string($this->db->link, $paid);
      $due = mysqli_real_escape_string($this->db->link, $due);
      $payment_type = mysqli_real_escape_string($this->db->link, $payment_type);
      $payment_type = mysqli_real_escape_string($this->db->link, $order_date);

      */
       
       if($cust_name==""||$paid==""||$payment_type==""){
           return "missing";
       }else{       
        $key    = substr(md5(uniqid(rand(0,9), true)),4,4);
        // used to find total qty purchased by a user
        $total_qty_product = 0;          
          for($k=0;$k<count($ar_qty);$k++){
            $total_qty_product = $total_qty_product+$ar_qty[$k];
            }
        // used to find total items purchased by a user
        $total_items = 0;          
          for($j=0;$j<count($ar_qty);$j++){
            $total_items = $total_items+$ar_qty[$j];
            }   
            
        $query  = "INSERT INTO `invoice`(`ck_key`,`cust_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`,`total_qty`,`total_item`) VALUES ('$key','$cust_name','$order_date','$sub_total','$gst','$discount','$net_total','$paid','$due','$payment_type','$total_qty_product','$total_items')";
        $result = $this->db->insert($query); 
           
        $getInvoice = "SELECT * FROM invoice WHERE ck_key='$key'";
        $row = $this->db->select($getInvoice)->fetch_assoc();
      
        $invoice_no = $row['invoice_no'];
        //$invoice_no = $mysqli->insert_id;
      
         if($invoice_no!=null){
          for($i=0;$i<count($ar_price);$i++){
              // here we find the remaining quantity after giving customer
              $remain_qty = $ar_tqty[$i]-$ar_qty[$i];  
              
              /*      if($remain_qty<0){
                        return "not_avail";
                    }else{ */
                        $query ="UPDATE `product` 
                                 SET 
                                `product_stock`='$remain_qty'
                                 WHERE product_name='$ar_pro_name[$i]'";
                        $quantityUpdt = $this->db->update($query);
                        

                         
                        
                        // if product stock is zero,than status will be 1 
                        
                        if($remain_qty==0){
                            $squery ="UPDATE `product` 
                                     SET 
                                    `status`= '0'
                                     WHERE product_name='$ar_pro_name[$i]'";
                            $statusUpdt = $this->db->update($squery);                        
                           }                        
                 /*   } */

                        
             // first insert
             $i_status = 1;
             
             $innerquery = "INSERT INTO `invoice_details`(`invoice_no`,`pId`, `product_name`, `price`, `qty`,`total_qty`,`i_status`) VALUES ('$invoice_no','$ar_pro_id[$i]','$ar_pro_name[$i]','$ar_price[$i]','$ar_qty[$i]','$ar_tqty[$i]','$i_status')"; 
             $result = $this->db->insert($innerquery);
             // then update the total quantity
             // both query execute at the same time
             $query_invoice ="UPDATE `invoice_details` 
                              SET 
                             `total_qty`='$remain_qty'
                              WHERE product_name='$ar_pro_name[$i]'";
          $quantityUpdtInvoice = $this->db->update($query_invoice);
          }
          return $invoice_no; 
        }
     }
   }
   
   
   public function getAllOrders() {
        $query = "SELECT * FROM invoice";
        $result = $this->db->select($query);
        return $result; 
   }
   // for low products used in dashboard
   public function getProductStocks(){
        $query = "SELECT * FROM product WHERE product_stock<=3 AND status=1";
        $result = $this->db->select($query);
        return $result; 
   }
   
   // fetch invoice of all customers 
   
   public function getCustomerOrderDetails(){
        $query = "SELECT * FROM invoice ORDER BY invoice_no DESC";
        $result = $this->db->select($query);
        return $result;  
   }
   
   // fetch invoice of each customer by their ID
   
   public function getOrder($invoice_no){
      
       $query = "SELECT * FROM invoice WHERE invoice_no = '$invoice_no'";
       $result = $this->db->select($query)->fetch_assoc();
       return $result; 
    
   }
   
   // fetch invoice details of each customer
   
   public function getInvoiceDetails($invoice_no){
       $query = "SELECT * FROM invoice_details WHERE invoice_no = '$invoice_no'";
       $result = $this->db->select($query);
       return $result;        
   }
   
   
   public function UpdateOrderInvoice($invoice,$order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$ar_pro_id,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){    
       if($cust_name==""||$paid==""||$payment_type==""){
           return "missing";
       }else{        
          $getInvoice = "SELECT * FROM invoice WHERE invoice_no='$invoice'";
          $row = $this->db->select($getInvoice)->fetch_assoc();
      
          $total_qty_product = 0;         
            for($k=0;$k<count($ar_qty);$k++){
               $total_qty_product = $total_qty_product+$ar_qty[$k];
            }            
        $query = "UPDATE invoice 
                 SET
                 order_date= '$order_date',
                 sub_total = '$sub_total',
                 gst       = '$gst',
                 discount  = '$discount',
                 net_total = '$net_total',
                 paid      = '$paid',
                 due       = '$due',
              payment_type = '$payment_type',
                 total_qty = '$total_qty_product' 
                     
                 WHERE invoice_no = '$invoice'";
        
        $result = $this->db->update($query);
        
                   
        $getInvoice = "SELECT * FROM invoice WHERE invoice_no='$invoice'";
        $row = $this->db->select($getInvoice)->fetch_assoc();
      
        $invoice_no = $row['invoice_no'];
       
         if($invoice_no==$invoice){
          for($i=0;$i<count($ar_price);$i++){
             
              // here we find the remaining quantity after giving customer
              $remain_qty = $ar_tqty[$i]-$ar_qty[$i];  
             
                $query ="UPDATE `product` 
                         SET 
                        `product_stock`='$remain_qty'
                         WHERE product_name='$ar_pro_name[$i]'";
                $quantityUpdt = $this->db->update($query);

                // if product stock is zero,than status will be 1 

                if($remain_qty==0){
                    $squery ="UPDATE `product` 
                             SET 
                            `status`= '0'
                             WHERE product_name='$ar_pro_name[$i]'";
                    $statusUpdt = $this->db->update($squery);                        
                 }
                 
                // fetch individual qty's from each customer 
                
                 $getQty = "SELECT * FROM invoice_details WHERE invoice_no='$invoice' AND qty='$ar_qty[$i]'";
                $rows = $this->db->select($getQty);
                    if($rows){
                         while($val = $rows->fetch_assoc()){
                                     $qty = $val['qty'];
                         }
                    }
                    
                 // check if user entry input qty is more than previous input qty   
                 // then it will update, otherwise not
                    
                 if($ar_qty[$i]>$qty){    
                 $updtquantity ="UPDATE `invoice_details` 
                                 SET
                                 qty   = '$ar_qty[$i]',
                              total_qty= '$remain_qty'                               
                              WHERE invoice_no = '$invoice' AND pId = '$ar_pro_id[$i]'"; 
                 $Updtqty = $this->db->update($updtquantity); 
                 }                 
          }
          return $invoice_no; 
        }
      
    }   
  }  
}
