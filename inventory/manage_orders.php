<?php 
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once("classes/Product.php");
    $pr = new Product();
    $details =$pr->getCustomerOrderDetails();     
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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">       
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"/></script>
     
        <script src="js/order.js"></script>

     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card" style="background-color: whitesmoke;">
                         <h3 class="text-center" style="font-family: cursive">Order Records</h3>

                         <div class="card-body">

            <table class="table table-striped table-bordered table-condensed table-hover text-center" id="example">

             <thead>
                 <tr class="badge-info text-center">
                     <td><b>SL#</b></td>
                     <td><b>Order</b></td>
                     <td><b>Customer</b></td>
                     <td><b>Total Products</b></td>
                     <td><b>Total Quantity</b></td>
                     <td><b>Payment Status</b></td>                    
                     <td><b>Payment Type</b></td>
                     <td><b>Action</b></td>
                 </tr>
             </thead>
             <tbody>
                 <?php
                 if($details){
                     $i=0;
                     while ($result = $details->fetch_assoc()){   
                       $i++;
                 ?>
                   <tr>
                       <td><?php echo $i;?></td>
                       <td><?php echo $result['order_date'];?></td>
                       <td><?php echo $result['cust_name'];?></td>
                       <td><?php echo $result['total_item'];?></td>
                       <td><?php echo $result['total_qty'];?></td>
                       <td>
                           <?php if($result['due']==0){ ?>
                           <span class="badge badge-success">Full Payment</span>
                           <?php }else{?>
                           <span class="badge badge-warning">Due</span>
                           <?php }?>
                       </td>

                       <td><span class="badge badge-light"><?php echo $result['payment_type'];?></span></td>
                       <td>
                           <a href="#" class="btn btn-outline-dark btn-sm"><i class="fa fa-print">&nbsp;</i>Print</a>
                           <a href="update_orders.php?invoice_no=<?php echo $result['invoice_no'];?>" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit">&nbsp;</i>Edit</a>
                        
                       </td>
                   </tr>
                 <?php }}?>
             </tbody>
             <tfoot>
                 <tr class="badge-info text-center">
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>   
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                 </tr>
             </tfoot>
         </table>  
                         </div>
                     </div>      
                 </div>
             </div>            
         </div>
          <script>
           $(document).ready(function(){
                 $('#example').DataTable();
           });
          </script>
             
     </body>
</html>
<?php }?>



