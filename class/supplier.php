<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/connection.php');

    class supplier extends DBConnection{
        public function __construct(){
            parent::connect(); // gọi phương thức kết nối từ lớp DBConnection
        }

        // Phương thức lấy tất cả thông tin nhà cung cấp
        public function getAll(){
            $sql = "SELECT * 
                    FROM `supplier`
                    ORDER BY `SupplierID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        
        // Phương thức lấy 1 thông tin của 1 nhà cung cấp
        public function getByID($id){
            $sql = "SELECT * 
                    FROM `supplier`
                    WHERE `SupplierID` = '$id' ";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức xoá 1 nhà cung cấp
        public function deleteByID($id){
            $sql = "DELETE FROM `supplier`
                    WHERE `SupplierID` = '$id' ";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức thêm 1 nhà cung cấp
        public function updateSupplier($supplier){
            $SupplierID   = $supplier[0];
            $SupplierName = $supplier[1];
            $Phone        = $supplier[2];
            $Email        = $supplier[3];
            $Address      = $supplier[4];
            $sql = "UPDATE `supplier`
                    SET `SupplierName` = '$SupplierName',
                        `Phone`        = '$Phone',
                        `Email`        = '$Email',
                        `Address`      = '$Address'
                    WHERE `SupplierID` = $SupplierID";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức thêm 1 nhà cung cấp
         public function addSupplier($Supplier) {
            $SupplierName = $Supplier[0];
            $Email = $Supplier[1];
            $Phone = $Supplier[2];
            $Address = $Supplier[3];
            $sql = "INSERT INTO `supplier` (`SupplierName`, `Email`, `Phone`, `Address`)
                    VALUES ('$SupplierName', '$Email', '$Phone', '$Address')";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }


    }
?>