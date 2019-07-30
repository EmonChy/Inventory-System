<!-- Modal -->
<div class="modal fade" id="update_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_br_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input type="hidden" name="brId" id="brId"/>
                        <input type="text" name="updt_br" class="form-control" id="updt_br">
                        <small id="brupdt_error" class="form-text text-muted"></small>
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