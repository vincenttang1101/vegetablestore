<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $classVegetable = new vegetable();
    $classCategory = new category();

?>
<div class="modal fade bd-example-modal-lg" id="update_order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Update Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <form method="POST" id="update_order_form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Order ID:</label>
                            <input type="numer" class="form-control" id="update_order_id" name="OrderID" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Customer:</label>
                            <input type="text" class="form-control" id="update_order_customer" name="Customer" readonly>
                        </div>
                        <div class="form-group col-md-5 ml-auto">
                            <label>Phone:</label>
                            <input type="text" class="form-control" id="update_order_phone" name="Phone" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Order Date:</label>
                            <input type="text" class="form-control" id="update_order_orderdate" name="OrderDate" readonly>
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label>Ship Date:</label>
                            <input type="date" class="form-control" id="update_order_shipdate" name="ShipDate">
                        </div>
                        <input type="hidden" class="form-control" id="update_vegetable_id" name="VegetableID">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Ship Place:</label>
                            <input type="text" class="form-control" id="update_order_shipplace" name="ShipPlace">
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label>Payments:</label>
                            <select class="form-control" id="update_order_payment" name="Payment">
                                <option value="PayPal">PayPal</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Total:</label>
                            <input type="text" class="form-control" id="update_order_total" name="Total" readonly>
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label>Status:</label>
                            <select class="form-control" id="update_order_status" name="Status">
                                <option value="Unprocessed">Unprocessed</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Shipping">Shipping</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Note:</label>
                            <textarea class="form-control" id="update_order_note" name="Note" rows="2"></textarea>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="update_customer_id" name="CustomerID" readonly>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_vegetable" name="Update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
