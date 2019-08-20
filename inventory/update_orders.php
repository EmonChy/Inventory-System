<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once ("classes/Product.php");
    $pr = new Product();
    if(isset($_REQUEST['invoice_no'])){
        $invoice_no = $_REQUEST['invoice_no'];
        $invoice_details = $pr->getInvoiceDetails($invoice_no);      
        $fetchdata = $pr->getOrder($invoice_no);
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
        <script src="js/order_manage.js"></script>
     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
         <div class="container" style="">
             <diV class="row">
                 <div class="col-md-10 mx-auto">
                     <div class="card" style="box-shadow: 0 0 25px 0 lightgray">
                             <div class="card-header">
                                 <h4>Update Orders</h4>
                             </div>
                             <div class="card-body">

                                 <form id="get_ordered_update_data" onsubmit="return false" autocomplete="off">
                                      <input type="hidden" name="invoice_no" id="invoice_no" value="<?php echo $fetchdata['invoice_no'];?>"/>

                                         <div class="form-group row">

                                             <label class="col-sm-3" align="right">Order Date</label>
                                             <div class="col-sm-6">
                                                 <input type="text" id="order_date" name="order_date" readonly="" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" required=""/>
                                             </div>
                                         </div>
                                         <div class="form-group row">
                                             <label class="col-sm-3" align="right">Customer Name*</label>
                                             <div class="col-sm-6">
                                                 <input type="text" id="cust_name" name="cust_name" readonly="" class="form-control form-control-sm" value="<?php echo $fetchdata['cust_name'];?>"/>
                                             </div>
                                         </div>
                                     <div class="card" style="box-shadow: 0 0 15px 0 lightgray">
                                         <div class="card-body">
                                             <h4>Update Order list</h4>
                                             <table align="center" style="width: 800px">
                                                 <thead>
                                                     <tr style="text-align: center">
                                                         <th>#</th>
                                                         <th>Item Name</th>
                                                         <th>Total Quantity</th>                                                         
                                                         <th>Quantity</th>
                                                         <th>Price</th>
                                                         <th>Total</th>                                            
                                                     </tr>
                                                 </thead>
                                                 <tbody id="invoice_item_updt">                                                     
                                                     <?php                        
                                                      if($invoice_details){
                                                       $i =0;
                                                       while($getdata = $invoice_details->fetch_assoc()){   
                                                       $i++;
                                                       $result = $pr->getAllActiveProduct();   
                                                     ?>
                                                    <tr>      
                                                        <td><b class=""><?php echo $i;?></b></td>
                                                        <td><select name="pId[]" class="form-control form-control-sm pId" disabled="">
                                                             <?php
                                                                    if($result){                                             
                                                                     while($rows = $result->fetch_assoc()){                                                                                               
                                                                     ?>
                                                             <option value="<?php echo $rows['pId'];?>"<?php if($rows['pId']==$getdata['pId']){echo 'selected';}?>><?php echo $rows['product_name'];?></option>
                                                                    <?php }}?>
                                                            </select></td>                                                         
                                                       <td>
                                                             <span><input type="hidden" name="proId[]" class="form-control form-control-sm proId" value="<?php echo $getdata['pId'];?>"/></span>
                                                             <input type="text" name="tqty[]" readonly="" class="form-control form-control-sm tqty" value="<?php echo $getdata['total_qty'];?>"/>
                                                       </td>
                                                         <td><input type="text" name="qty[]" class="form-control form-control-sm qty" value="<?php echo $getdata['qty'];?>" required=""/></td>    
                                                         <td><input type="text" name="price[]" readonly="" class="form-control form-control-sm price" value="<?php echo $getdata['price'];?>"/>   
                                                         <span><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name" value="<?php echo $getdata['product_name'];?>"/></span></td>    
                                                         <td>Rs.<span class="amt"><?php echo $getdata['qty']*$getdata['price'];?></span></td>
                                                    </tr>
                                                      <?php }}
                                                      ?> 
                                                     
                                                 </tbody>
                                             </table><!-- Table Ends-->
                                         </div><!-- Card Body Ends-->                                         
                                     </div><!-- Inner Card Ends-->
                                     <br><br>
                                        <div class="form-group row">
                                            <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="sub_total" id="sub_total" readonly="" class="form-control form-control-sm" value="<?php echo $fetchdata['sub_total']?>" required=""/>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="gst" id="gst" readonly="" class="form-control form-control-sm" value="<?php echo $fetchdata['gst']?>" required=""/>
                                             </div>
                                        </div>
                                     <div class="form-group row">
                                            <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="discount" id="discount"  class="form-control form-control-sm" value="<?php echo $fetchdata['discount']?>"/>
                                             </div>
                                        </div> 
                                     <div class="form-group row">
                                            <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="net_total" id="net_total" readonly="" class="form-control form-control-sm" value="<?php echo $fetchdata['net_total']?>" required=""/>
                                             </div>
                                      </div> 
                                      <div class="form-group row">
                                            <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="paid" id="paid"  class="form-control form-control-sm" value="<?php echo $fetchdata['paid']?>" required=""/>
                                             </div>
                                      </div> 
                                      <div class="form-group row">
                                            <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="due" id="due" readonly="" class="form-control form-control-sm" value="<?php echo $fetchdata['due']?>" required=""/>
                                             </div>
                                      </div> 
                                       <div class="form-group row">
                                            <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                                             <div class="col-sm-6">
                                                 <select name="payment_type" id="payment_type" class="form-control form-control-sm" required="">
                                                                    <option value="">~~SELECT~~</option>
                                                                <option value="Cash" <?php if($fetchdata['payment_type']=="Cash") {
                                                                        echo "selected";
                                                                } ?> >Cash</option>
                                                                <option value="Card" <?php if($fetchdata['payment_type']=="Card") {
                                                                        echo "selected";
                                                                } ?>>Card</option>
                                                                <option value="Draft" <?php if($fetchdata['payment_type']=="Draft") {
                                                                        echo "selected";
                                                                } ?>>Draft</option>
                                                                <option value="Cheque" <?php if($fetchdata['payment_type']=="Cheque") {
                                                                        echo "selected";
                                                                } ?>>Cheque</option>
				   
                                                 </select>   
                                             </div>
                                        </div>
                                     <center>
                                        <input type="submit" id="order_form_update" class="btn btn-info" value="Order"/>
                                        <input type="submit" id="print_invoice" class="btn btn-success d-none" value="Print Invoice" />
                                     </center>
                                 </form>
                             </div>
                         </div>
                 </div> 
             </diV>
         </div>

    </body>
</html>
<?php }?>

