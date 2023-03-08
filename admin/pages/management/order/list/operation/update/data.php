<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
    if (isset($_POST['OrderID'])) {
        $OrderID = $_POST['OrderID'];
        $classOrder = new order();
        $result_order = $classOrder->getByID($OrderID);
        foreach ($result_order as $Order) {
            echo json_encode($Order);
        }
    }
?>