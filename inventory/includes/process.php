<?php
include_once("../classes/Category.php");
include_once("../classes/Brand.php");
include_once("../classes/Product.php");

$cat = new Category();
$br = new Brand();
$pr = new Product();

if(isset($_POST['category_name'])){

    $category_name = $_POST['category_name'];
    $result = $cat->addCategory($category_name);
    echo $result;
    exit();
}
if(isset($_POST['brand_name'])){
    
    $brand_name = $_POST['brand_name'];
    //$catId = $_POST['select_cat'];

    $result = $br->addBrand($brand_name);
    echo $result;
    exit();    
}

if(isset($_POST['getCategory'])){
   $result = $cat->getAllCategory();
   foreach($result as $row) {
       echo "<option value='" .$row["catId"]."'>".$row["category_name"]."</option>";
   }
   exit();

}


if(isset($_POST['getBrand'])){
   $result = $br->getAllBrand();
   foreach($result as $row) {
       echo "<option value='" .$row["bId"]."'>".$row["brand_name"]."</option>";
   }
   exit();
}

if(isset($_POST['added_date']) AND isset($_POST['product_name'])){
    $date = $_POST['added_date'];
    $product_name = $_POST['product_name'];
    $catId = $_POST['select_cat'];
    $brId = $_POST['select_brand'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_qty'];
    $result = $pr->addProduct($catId,$brId,$product_name,$price,$qty,$date);
    echo $result;
    exit();
    
}
//-------- request receive from manage.js for displaying all categories---------

/*
if(isset($_POST['manageCategory'])){
  $categories = $cat->getAllCategory();
    if($categories){
             $i = 0;
             while ($result = $categories->fetch_assoc()) {
             $i++;?>
             <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['category_name']; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" onclick="return confirm('Are you sure to delete')" did="<?php echo $result['catId']; ?>" class="btn btn-danger btn-sm del_cat"><i class="fa fa-trash">&nbsp;</i>Delete</a> 
                    <a href="#" data-toggle="modal" data-target="#update_category" eid="<?php echo $result['catId']; ?>" class="btn btn-info btn-sm edit_cat"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
                </td>                                      
            </tr>

<?php
        }
    }
 }
 */

if(isset($_POST['deleteCategory']) AND isset($_POST['id'])){
    $deleteCat = $_POST['id'];

    $delCategory = $cat->deleteCategory($deleteCat);
    echo $delCategory;
    exit();    

 }
 
 
 
if(isset($_POST['updateCategory']) AND isset($_POST['id'])){
    $catId = $_POST['id'];
    
    $result = $cat->getCategory($catId);
    echo json_encode($result);
    exit();
    
}
// update record after getting data

if(isset($_POST['updt_cat'])){
    $catId = $_POST['catId'];
    $category_name = $_POST['updt_cat'];
    $result = $cat->updtCategory($category_name,$catId);
    echo $result;
    exit();
}
//-------- request receive from manage.js for displaying all brands---------
/*
if(isset($_POST['manageBrand'])){
    $brands = $br->getAllBrand();
       if($brands){
             $i = 0;
             while ($result = $brands->fetch_assoc()) {
             $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a onclick="return confirm('Are you sure to delete')" href="?delbr=<?php echo $result['bId']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a> 
                    <a href="#" data-toggle="modal" data-target="#update_brand" eid="<?php echo $result['bId']; ?>" class="btn btn-info btn-sm edit_br"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
                </td>                                      
            </tr>

<?php
        }
    }
 }*/

if(isset($_POST['deleteBrand']) AND isset($_POST['id'])){
    $deleteBr = $_POST['id'];
    $delBrand = $br->deleteBrand($deleteBr);    
    echo $delBrand;
    exit();    
 }

if(isset($_POST['updateBrand']) AND isset($_POST['id'])){
    $bId = $_POST['id'];
    
    $result = $br->getBrand($bId);
    echo json_encode($result);
    exit();
    
}
// update record after getting data

if(isset($_POST['updt_br'])){
    $bId = $_POST['brId'];
    $brand_name = $_POST['updt_br'];
    $result = $br->updtBrand($brand_name,$bId);
    echo $result;
    exit();
}
if(isset($_POST['deleteProduct']) AND isset($_POST['id'])){
    $delete = $_POST['id'];
    $delPro = $pr->deleteProduct($delete);    
    echo $delPro;
    exit();    

 }

if(isset($_POST['updateProduct']) AND isset($_POST['id'])){
    $pId = $_POST['id'];
    
    $result = $pr->getProduct($pId);
    echo json_encode($result);
    exit();
    
}
// update record after getting data
if(isset($_POST['updt_pr'])){
   $pId = $_POST['prId'];
   $cId = $_POST['select_cat'];
   $bId = $_POST['select_brand'];
   $product_name = $_POST['updt_pr'];
   $product_price = $_POST['product_price'];
   $product_qty = $_POST['product_qty'];
   $date = $_POST['added_date'];
   $status =$_POST['updt_stat'];
   $result = $pr->updateProduct($pId,$cId,$bId,$product_name,$product_price,$product_qty,$date,$status);
   echo $result;
   exit();
}

//------Order Processing--------------
if(isset($_POST['getNewOrderForm'])){
   $result = $pr->getAllActiveProduct();
   ?>
   <tr>
      
       <td><b class="number">1</b></td>
        <td><select name="pId[]" class="form-control form-control-sm pId" required="">
                <option>Choose Product</option>      
            <?php
                   if($result){
                    $i = 0;
                    while($rows = $result->fetch_assoc()){
                    $i++;
                    ?>
            <option value="<?php echo $rows['pId'];?>"><?php echo $rows['product_name'];?></option>
                   <?php }}?>
        </select></td>
        <td><input type="text" name="tqty[]" readonly="" class="form-control form-control-sm tqty" required=""/></td>    
        <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required=""/></td>    
        <td><input type="text" name="price[]" readonly="" class="form-control form-control-sm price" required=""/>   
            <span><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name"/></span></td>    
       
        <td>Rs.<span class="amt">0</span></td>
  </tr> 
   <?php 
   exit();
}

// Get price and quantity of one item
if(isset($_POST['getPriceAndQty']) AND isset($_POST['id'])){
    $pId = $_POST['id'];
    
    $result = $pr->getProduct($pId);
    echo json_encode($result);
    exit();
}
    
// Request from order.js for order information

if(isset($_POST['order_date']) AND isset($_POST['cust_name'])){
   $order_date   = $_POST['order_date'];
   $cust_name    = $_POST['cust_name'];
   
   //Now getting Array from order from
   
   $ar_tqty      = $_POST['tqty'];
   $ar_qty       = $_POST['qty'];
   $ar_price     = $_POST['price'];
   $ar_pro_name  = $_POST['pro_name'];
   
   $sub_total    = $_POST['sub_total'];
   $gst          = $_POST['gst'];
   $discount     = $_POST['discount'];
   $net_total    = $_POST['net_total'];
   $paid         = $_POST['paid'];
   $due          = $_POST['due'];
   $payment_type = $_POST['payment_type'];
   
   $result = $pr->storeOrderInvoice($order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type); 
   echo $result;
   exit();
   
}