<!-- Modal -->
<div class="modal fade" id="update_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_prd_form" onsubmit="return false" autocomplete="off">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="prId" id="prId" value=""/>
                            <label>Date</label>
                            <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d");?>" readonly="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="updt_pr" id="updt_pr" placeholder="Enter product name" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="select_cat" name="select_cat" required="">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select class="form-control" id="select_brand" name="select_brand" required="">
                            
                        </select>                    
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter price" required="">              
                    </div>
                     <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="product_qty" id="product_qty" placeholder="Enter quantity" required="">              
                    </div>
                   <div class="form-group">
                       
                        <label>Status</label>
                        <select class="form-control" id="updt_stat" name="updt_stat">
					      	<option value="">~~SELECT~~</option>
					      	<option value="1">Available</option>
					      	<option value="0">Not Available</option>
					      </select>
<!--                        <input type="number" class="form-control" name="updt_stat" id="updt_stat"  required="">              -->
                   <small id="updt_stat_error" class="form-text text-muted"></small>
 
                   </div>
                  
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>