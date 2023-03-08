<?php

    if (isset($_POST['GoodsReceiptID'])) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/goodsreceipt.php');
        $GoodsReceiptID = $_POST['GoodsReceiptID'];
        $classGoodsReceipt = new goodsreceipt();
        $result_goodsreceipt = $classGoodsReceipt->getByID($GoodsReceiptID);
        foreach ($result_goodsreceipt as $GoodsReceipt) {
            echo json_encode($GoodsReceipt);
        }
    }
?>