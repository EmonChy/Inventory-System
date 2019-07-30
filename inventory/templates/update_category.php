<!-- Modal -->
<div class="modal fade" id="update_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_cat_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="hidden" name="catId" id="catId"/>
                        <input type="text" name="updt_cat" class="form-control" id="updt_cat">
                        <small id="catupdt_error" class="form-text text-muted"></small>
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