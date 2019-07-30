<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once ("classes/Category.php");
    $cat = new Category();
    $categories = $cat->getAllCategory();
    
if(isset($_GET['delcat'])){
    // category delete from category tbl
    $delcat = $_GET['delcat'];
    $delCategory = $cat->deleteCategory($delcat);    
    // refresh the page,
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";    
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
                         <h3 class="text-center" style="font-family: cursive">All Categories</h3>

                         <div class="card-body">
                             <?php
                             /* as we use page refresh,dont need the msg
                             if(isset($delCategory)){
                                 echo $delCategory;
                             } */
                             ?>
            <table class="table table-striped table-bordered table-condensed table-hover text-center" id="example">

             <thead>
                 <tr class="btn-danger text-center">
                     <td><b>SL#</b></td>
                     <td><b>Category</b></td>
                     <td><b>Status</b></td>
                     <td><b>Action</b></td>
                 </tr>
             </thead>
             <tbody>
             <?php
             if($categories){
             $i = 0;
             while ($result = $categories->fetch_assoc()) {
             $i++;
             ?>
                 <tr id="get_cat">
                <td><?php echo $i;?></td>
                <td><?php echo $result['category_name']; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $result['catId']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a> 
                    <a href="#" data-toggle="modal" data-target="#update_category" eid="<?php echo $result['catId']; ?>" class="btn btn-info btn-sm edit_cat"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
                </td>                                      
            </tr>
             <?php }} ?>
             </tbody>
             <tfoot>
                 <tr class="btn-danger text-center">
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
         <?php include_once("templates/update_category.php")?>
     <script>
         $(document).ready(function(){
                 $('#example').DataTable();
           });
     </script>             
     </body>
</html>
<?php }?>

