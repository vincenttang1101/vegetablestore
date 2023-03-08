<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
    $classSupplier = new supplier();
    if (isset($_POST['Vegetable'])) {
        $connect = new PDO("mysql:host=localhost;dbname=vegetablestore", "root", "");
        $query1 = "INSERT INTO `goodsreceipt`(`StaffID`, `SupplierID`, `GoodsReceiptDate`, `Total`, `Note`) 
                                      VALUES (:StaffID, :SupplierID, :GoodsReceiptDate, :Total, :Note)";
        $data1 = array(
            ':StaffID'             => $_SESSION['StaffID'],
            ':SupplierID'          => $_POST['Supplier'],
            ':GoodsReceiptDate'    => $_POST['GoodsReceiptDate'],
            ':Total'               => $_POST['TotalGoodsReceiptDetailsReal'],
            ':Note'                => $_POST['Note']
        );            

        $statement1 = $connect->prepare($query1);
        if ($statement1->execute($data1)) {
            $GoodsReceiptID = $connect->lastInsertId();

            // Convert dữ liệu tương thích với Receipt List (không ảnh hưởng đến DB)
            $result = $classSupplier->getByID($_POST['Supplier']);
            foreach ($result as $Supplier) {}
            $temp = array(
                'GoodsReceiptID'        => $GoodsReceiptID,
                'StaffName'             => $_SESSION['StaffName'],
                'SupplierName'          => $Supplier['SupplierName'],
                'GoodsReceiptDate'      => $_POST['GoodsReceiptDate'],
                'Total'                 => $_POST['TotalGoodsReceiptDetails'],
                'Note'                  => $_POST['Note']
            );
            echo json_encode($temp);
        }
        $GoodsReceiptID = $connect->lastInsertId();

        $query2 = "INSERT INTO `goodsreceiptdetails`(`GoodsReceiptID`,`VegetableID`, `Unit`, `Quantity`, `Price`, `Subtotal`)
                                            VALUES (:GoodsReceiptID, :VegetableID, :Unit, :Quantity, :Price, :Subtotal)";
        for ($count = 0; $count < count($_POST['Vegetable']); $count++) {
            $statement2 = $connect->prepare($query2);
            $result2 = $statement2->execute(
                $data2 = array(
                    ':GoodsReceiptID'     => $GoodsReceiptID,
                    ':VegetableID'        => $_POST['Vegetable'][$count],
                    ':Unit'               => $_POST['Unit'][$count],
                    ':Quantity'           => $_POST['Quantity'][$count],
                    ':Price'              => $_POST['GoodsReceiptPrice'][$count],
                    ':Subtotal'           => $_POST['TotalDetailLineReal'][$count]
                )
            );

        }
        
    }

?>