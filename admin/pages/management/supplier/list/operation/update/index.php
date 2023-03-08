<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $classVegetable = new vegetable();
    $classCategory = new category();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="modal fade bd-example-modal-lg" id="update_supplier_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Update Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="update_supplier_form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Supplier ID:</label>
                            <input type="numbber" class="form-control" id="update_supplier_id" name="SupplierID" readonly>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Supplier Name:</label>
                            <input type="text" class="form-control" id="update_supplier_name" name="SupplierName">
                        </div>             
                    </div>

                    <div class="form-row">
                         <div class="form-group col-md-3">
                            <label>Phone:</label>
                            <input type="number" class="form-control" id="update_supplier_phone" name="Phone">
                        </div>
                        <div class="form-group col-md-5">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="update_supplier_email" name="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address:</label>
                            <textarea class="form-control" id="update_supplier_address" name="Address" rows="3"></textarea>
                        </div>
                    </div>

                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_supplier" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
