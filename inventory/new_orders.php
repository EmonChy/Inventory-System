<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
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
        
        <script src="js/order.js"></script>
     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
         <div class="container" style="">
             <diV class="row">
                 <div class="col-md-10 mx-auto">
                     <div class="card" style="box-shadow: 0 0 25px 0 lightgray">
                             <div class="card-header">
                                 <h4>New Orders</h4>
                             </div>
                             <div class="card-body">
                                 <form id="get_ordered_data" onsubmit="return false" autocomplete="off">
                                         <div class="form-group row">
                                             <label class="col-sm-3" align="right">Order Date</label>
                                             <div class="col-sm-6">
                                                 <input type="text" id="order_date" name="order_date" readonly="" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" required=""/>
                                             </div>
                                         </div>
                                         <div class="form-group row">
                                             <label class="col-sm-3" align="right">Customer Name*</label>
                                             <div class="col-sm-6">
                                                 <input type="text" id="cust_name" name="cust_name" class="form-control form-control-sm" required=""/>
                                             </div>
                                         </div>
                                     <div class="card" style="box-shadow: 0 0 15px 0 lightgray">
                                         <div class="card-body">
                                             <h4>Make a Order list</h4>
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
                                                 <tbody id="invoice_item">
                                                    <!-- <tr>
                                                         <td><b id="number">1</b></td>
                                                         <td><select name="pid[]" class="form-control form-control-sm" required="">
                                                                 <option>Washing Machine</option>
                                                             </select></td>
                                                             <td><input type="text" name="tqty[]" readonly="" class="form-control form-control-sm"/></td>    
                                                             <td><input type="text" name="qty[]" class="form-control form-control-sm" required=""/></td>    
                                                             <td><input type="text" name="price[]" readonly="" class="form-control form-control-sm"/></td>    
                                                             <td>Rs.1540</td>
                                                     </tr>-->  
                                                 </tbody>
                                             </table><!-- Table Ends-->
                                             <center style="padding-top: 10px">
                                                 <button id="add" style="width: 150px;" class="btn btn-success"><i class="fa fa-plus">&nbsp;</i>Add</button>
                                                 <button id="remove" style="width: 150px;" class="btn btn-danger"><i class="fa fa-crosshairs">&nbsp;</i>Remove</button>
                                             
                                             </center>
                                         </div><!-- Card Body Ends-->

                                         
                                     </div><!-- Inner Card Ends-->
                                     <br><br>
                                        <div class="form-group row">
                                            <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="sub_total" id="sub_total" readonly="" class="form-control form-control-sm" required=""/>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="gst" id="gst" readonly="" class="form-control form-control-sm" required=""/>
                                             </div>
                                        </div>
                                     <div class="form-group row">
                                            <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="discount" id="discount" class="form-control form-control-sm"/>
                                             </div>
                                        </div> 
                                     <div class="form-group row">
                                            <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="net_total" id="net_total" readonly="" class="form-control form-control-sm" required=""/>
                                             </div>
                                      </div> 
                                      <div class="form-group row">
                                            <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="paid" id="paid" class="form-control form-control-sm" required=""/>
                                             </div>
                                      </div> 
                                      <div class="form-group row">
                                            <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                                             <div class="col-sm-6">
                                                 <input type="text" name="due" id="due" readonly="" class="form-control form-control-sm" required=""/>
                                             </div>
                                      </div> 
                                       <div class="form-group row">
                                            <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                                             <div class="col-sm-6">
                                                 <select name="payment_type" id="payment_type" class="form-control form-control-sm" required="">
                                                                 <option value="">Choose Type</option>
                                                                 <option value="Cash">Cash</option>
                                                                 <option value="Card">Card</option>
                                                                 <option value="Draft">Draft</option>
                                                                 <option value="Cheque">Cheque</option>
                                                 </select>   
                                             </div>
                                        </div>
                                     <center>
                                        <input type="submit" id="order_form" width="150px" class="btn btn-info" value="Order"/>
                                        <input type="submit" id="print_invoice" width="150px" class="btn btn-success d-none" value="Print Invoice" />
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

