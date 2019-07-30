<!-- Modal -->
<div class="modal fade" id="form_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="brand_form" onsubmit="return false">
              <div class="form-group">
                  <label for="category_name">Brand Name</label>
                  <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="Enter brand">
               <small id="brand_error" class="form-text text-muted"></small>
              
              </div>
              <!--
            <div class="form-group">
                 <label>Category</label>
                 <select class="form-control" id="select_cat" name="select_cat" required="">
                 </select>
             </div> -->
             <br>
              <button type="submit" class="btn btn-primary">Add</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>