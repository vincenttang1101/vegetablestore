<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
    $classVegetable = new vegetable();
    $classSupplier = new supplier();
?>

<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Add Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="insert_form">
                <div class="modal-body">
                <span id="message"></span>
                    <div class="container-fluid">
                        <div class="form-group row">
                            <table class="table table-hover table-bordered" id="item_goods_receipt" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Goods Receipt Date</th>
                                        <th>Total</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="supplier" name="Supplier">
                                            <?php 
                                                $result = $classSupplier->getAll();
                                                    echo '<option></option>';
                                                foreach ($result as $Supplier) {
                                                    echo '<option value="'.$Supplier['SupplierID'].'">'.$Supplier['SupplierID'].'&ensp;-&ensp;'.$Supplier['SupplierName'].'</option>';
                                                } 
                                            ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="goods_receipt_date" name="GoodsReceiptDate">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="total_goods_receipt_details" name="TotalGoodsReceiptDetails" readonly>
                                            <input type="hidden" class="form-control" id="total_goods_receipt_details_real" name="TotalGoodsReceiptDetailsReal">
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="note" name="Note" rows="1"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row"> 
                            <table class="table table-hover table-bordered" id="item_detail" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>Vegetable</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>        
                                </thead>          
                                <tbody>

                                </tbody>           
                            </table>
                        </div>
                        <div class="form-row"> 
                            <button type="button" class="btn btn-primary offset-md-10" id="add" name="Add" style="width: 17%"><i class="fas fa-plus"></i> Add Receipt Details</button>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save" name="Save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
