<?php
include_once("../classes/Category.php");
include_once("../classes/Brand.php");
include_once("../classes/Product.php");

$cat = new Category();
$br = new Brand();
$pr = new Product();

// Request from order_manage.js for order information update

if(isset($_POST['invoice_no'])){
   $invoice      = $_POST['invoice_no'];  
   $order_date   = $_POST['order_date'];
   $cust_name    = $_POST['cust_name'];
   
   //Now getting Array from order from
   
   $ar_tqty      = $_POST['tqty'];
   $ar_qty       = $_POST['qty'];
   $ar_price     = $_POST['price'];
   $ar_pro_name  = $_POST['pro_name'];
   $ar_pro_id    = $_POST['proId'];
   
   
   $sub_total    = $_POST['sub_total'];
   $gst          = $_POST['gst'];
   $discount     = $_POST['discount'];
   $net_total    = $_POST['net_total'];
   $paid         = $_POST['paid'];
   $due          = $_POST['due'];
   $payment_type = $_POST['payment_type'];
   
   $result = $pr->UpdateOrderInvoice($invoice,$order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$ar_pro_id,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type); 
   echo $result;
   exit();
}