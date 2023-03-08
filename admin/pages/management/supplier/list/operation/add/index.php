

<div class="modal fade" id="add_supplier_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="add_supplier_form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label>Supplier Name:</label>
                            <input type="text" class="form-control" id="add_supplier_name" name="SupplierName">
                        </div>
                        <div class="form-group col-md-5">
                            <label>Phone:</label>
                            <input type="number" class="form-control" id="add_supplier_phone" name="Phone">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="add_supplier_email" name="Email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Address:</label>
                            <textarea class="form-control" id="add_supplier_address" name="Address" rows="3"></textarea>
                        </div>
                    </div>
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add_supplier" name="Add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
