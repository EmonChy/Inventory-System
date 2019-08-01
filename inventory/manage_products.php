<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once ("classes/Product.php");
    $pr = new Product();
    $products = $pr->getAllProduct();
/*    
if(isset($_GET['delpr'])){
    // brand delete from brand tbl
    $delpr = $_GET['delpr'];
    $delPro = $pr->deleteProduct($delpr);    
    // refresh the page,
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";    
}
 * 
 */

    
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
     
        <script src="js/manage.js"></script>

     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card" style="background-color: whitesmoke;">
                         <h3 class="text-center" style="font-family: cursive">Products Records</h3>

                         <div class="card-body">
                             <?php
                             /* as we use page refresh,dont need the msg
                             if(isset($delCategory)){
                                 echo $delCategory;
                             } */
                             ?>
            <table class="table table-striped table-bordered table-condensed table-hover text-center" id="example">

             <thead>
                 <tr class="badge-info text-center">
                     <td><b>SL#</b></td>
                     <td><b>Product</b></td>

                     <td><b>Category</b></td>
                     <td><b>Brand</b></td>
                     <td><b>Price</b></td>
                     <td><b>Stock</b></td>  
                     <td><b>Date</b></td>

              <!--  <td><b>Category</b></td>     -->                 
                     <td><b>Status</b></td>
                     <td><b>Action</b></td>
                 </tr>
             </thead>
             <tbody>
             <?php
             if($products){
             $i = 0;
             while ($result = $products->fetch_assoc()) {
             $i++;
             ?>
            <tr class="delete_pro<?php echo $result['pId']; ?>">
                <td><?php echo $i;?></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['category_name']; ?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><?php echo $result['product_price']; ?></td>
                <td><?php echo $result['product_stock']; ?></td>
                <td><?php echo $result['date']; ?></td>
                
                <td>
                    <?php if($result['status']==0) {?>
                    <a href="#" class="badge badge-danger">Non available</a>
                    <?php }else{ ?>
                    <a href="#" class="badge badge-success">Available</a> 
                    <?php } ?>
                </td>
                <td>
<!--                    <a href="#" class="btn btn-danger" id="<?php echo $result['pId']; ?>">Delete</a>-->

                    <a href="#" did="<?php echo $result['pId']; ?>" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash">&nbsp;</i>Delete</a>
                    <a href="#" data-toggle="modal" data-target="#update_product" eid="<?php echo $result['pId']; ?>" class="btn btn-outline-warning btn-sm edit_pr"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
                </td>                                      
            </tr>
             <?php }} ?>
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
                     <td></td>
                 </tr>
             </tfoot>
         </table>  
                         </div>
                     </div>      
                 </div>
             </div>            
         </div>
      <script type="text/javascript">
    // delete product      
     $(document).ready(function() {
      $('.btn-outline-danger').click(function() {
      var did = $(this).attr("did");    
      if(confirm("Are you sure you want to delete this Product?")){
          $.ajax({
              url: "includes/process.php",
              method: "POST",
              data: {deleteProduct:1,id:did},                    
              cache: false,
              success: function(html) {
              $(".delete_pro" + did).fadeOut('slow');
                  }    
               })
            }else{
            return false;
            }
        })
     })
         </script>
         
         <?php include_once("templates/update_product.php")?>
          <script>
           $(document).ready(function(){
                 $('#example').DataTable();
           });
          </script>
             
     </body>
</html>
<?php }?>



