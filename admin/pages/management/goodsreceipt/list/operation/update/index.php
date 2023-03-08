<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/goodsreceipt.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
    $classGoodsReceipt = new goodsreceipt();
    $classSupplier = new supplier();
    if (isset($_POST['GoodsReceiptID']) && isset($_POST['Update'])) {
        $GoodsReceiptID             = $_POST['GoodsReceiptID'];
        $Supplier                   = $_POST['Supplier'];
        $GoodsReceiptDate           = $_POST['GoodsReceiptDate'];
        $Total                      = $_POST['TotalGoodsReceiptDetails'];
        $Note                       = $_POST['Note'];
        $GoodsReceipt               = array($GoodsReceiptID, $Supplier, $GoodsReceiptDate, $Total, $Note);
        $result_update_goodsreceipt = $classGoodsReceipt->updateGoodsReceipt($GoodsReceipt);
    }
?>

<div class="modal fade" id="update_goods_receipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Update Goods Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="update_form">
                <div class="modal-body" id="update_goods_receipt_body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Staff</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="update_staff" name="Staff" readonly>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Supplier</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="update_supplier" name="Supplier">
                            <?php 
                                $result_supplier = $classSupplier->getAll();
                                foreach ($result_supplier as $Supplier) {
                                    echo '<option value="'.$Supplier['SupplierID'].'">'.$Supplier['SupplierID'].' - '.$Supplier['SupplierName'].'</option>';
                                }
                            ?>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Goods Receipt Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="update_goods_receipt_date" name="GoodsReceiptDate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="update_total_goods_receipt_details" name="TotalGoodsReceiptDetails">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Note</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="update_note" name="Note" rows="3"></textarea>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="update_goods_receipt_id" name="GoodsReceiptID">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_goods_receipt_submit" name="Update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

