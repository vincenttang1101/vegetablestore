<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/connection.php');

    class goodsreceipt extends DBConnection{
        public function __construct(){
            parent::connect(); // gọi phương thức kết nối từ lớp DBConnection
        }

        // Phương thức lấy tất cả thông tin của phiếu nhập
        public function getAll(){
            $sql = "SELECT * 
                    FROM ((`goodsreceipt`
                    INNER JOIN `staff` ON goodsreceipt.StaffID = staff.StaffID)
                    INNER JOIN `supplier` ON goodsreceipt.SupplierID = supplier.SupplierID)
                    ORDER BY `GoodsReceiptID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
 
        // Phương thức cập nhập lại phiếu nhập
        public function updateGoodsReceipt($GoodsReceipt) {
            $sql = "UPDATE `goodsreceipt`
                    SET `SupplierID`        = '$GoodsReceipt[1]', 
                        `GoodsReceiptDate`  = '$GoodsReceipt[2]',
                        `Total`             = '$GoodsReceipt[3]',
                        `Note`              = '$GoodsReceipt[4]'
                    WHERE `GoodsReceiptID`  = '$GoodsReceipt[0]'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức lấy tất cả thông tin của phiếu nhập theo ID
        public function getByID($GoodsReceiptID){
            $sql = "SELECT * 
                    FROM ((`goodsreceipt`
                    INNER JOIN `staff` ON goodsreceipt.StaffID = staff.StaffID))
                    WHERE goodsreceipt.GoodsReceiptID = '$GoodsReceiptID'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức thêm mới thông tin phiếu nhập, chi tiết phiếu nhập
        public function addGoodsReceipt($goodsreceipt,$details) {

            $sql1 = "INSERT INTO `goodsreceipt`(`StaffID`, `SupplierID`, `GoodsReceiptDate`, `Total`, `Note`)
                                    VALUES('$goodsreceipt[0]', '$goodsreceipt[1]', '$goodsreceipt[2]', '$goodsreceipt[3]', '$goodsreceipt[4]')";
            $last_id = $this->execute_lastid($sql1);
            foreach ($details as $GoodsReceiptDetails) {
                $VegetableID   = $GoodsReceiptDetails['VegetableID'];
                $Unit          = $GoodsReceiptDetails['Unit'];
                $Quantity      = $GoodsReceiptDetails['Quantity'];
                $Price         = $GoodsReceiptDetails['Price'];
                $Total         = $GoodsReceiptDetails['Total'];
                $sql2 = "INSERT INTO `goodsreceiptdetails`(`GoodsReceiptID`, `VegetableID`, `Unit`, `Quantity`, `Price`, `Total`)
                                                   VALUES ('$last_id', '$VegetableID', '$Unit', '$Quantity', '$Price', '$Total')";
                $receipt_detail = $this->execute($sql2);
                
            }          
        }
        
    }
?>