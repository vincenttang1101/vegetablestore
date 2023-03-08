<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/goodsreceipt.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
    $classGoodsReceipt = new goodsreceipt();
    $classSupplier = new supplier();
    $classSupplier = new vegetable();
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
                        <label class="col-sm-4 col-form-label">GoodsReceiptID</label>
                        <div class="col-sm-8">
                            <input type="form" class="form-control" id="update_goods_receipt_id" name="GoodsReceiptID" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Vegetable</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="update_vegetable">
                                <?php 
                                $classVegetable = new vegetable();
                                $result_vgt = $classVegetable->executeResult("SELECT * FROM `vegetable`");
                                foreach ($result_vgt as $vegetable) {
                                    echo '<option value="'.$vegetable['VegetableID'].'">'.$vegetable['VegetableID'].' - '.$vegetable['VegetableName'].'</option>';
                                }
                                ?>
                            </select>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="Unit" id="update_unit">
                                <option value="kg">Kg</option>
                                <option value="per fruit">Per fruit</option>
                                <option value="bunch">Bunch</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Quantity</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="update_quantity" name="Quantity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="update_price" name="Price">
                        </div>
                    </div>
                  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_goods_receipt_submit" name="Update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

