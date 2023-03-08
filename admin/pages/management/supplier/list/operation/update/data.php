<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
    if (isset($_POST['SupplierID'])) {
        $SupplierID = $_POST['SupplierID'];
        $classSupplier = new supplier();
        $result_supplier = $classSupplier->getByID($SupplierID);
        foreach ($result_supplier as $Supplier) {
            echo json_encode($Supplier);
        }
        
    }
?>