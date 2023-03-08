<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/connection.php');
    class category extends DBConnection{
        public function __construct(){
            parent::connect(); // gọi phương thức kết nối từ lớp DBConnection
        }

        // Phương thức lấy tất cả danh mục
        public function getAll(){
            $sql = "SELECT *
                    FROM `category`
                    ORDER BY `CategoryID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        
        // Phương thức lấy tất cả danh mục
        public function countVgtOfCategory($CategoryID){
            $sql = "SELECT COUNT(*) 
                    FROM `category`
                    INNER JOIN `vegetable`
                    ON category.CategoryID = vegetable.CategoryID
                    WHERE category.CategoryID = '$CategoryID'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        

        // Phương thức thêm mới 1 danh mục
        public function addCategory($cate){
            $name = $cate[0];
            $description = $cate[1];
            $sql = "INSERT INTO `category`(`CategoryName`, `Description`) 
                                    VALUES('$name','$description')";
            $result = $this->execute_lastid($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức lọc danh mục
        public function filterStatus($Status){
            $sql = "SELECT * 
                    FROM `category` 
                    WHERE `Hidden` = '$Status'
                    ORDER BY `CategoryID` DESC";
             $result = $this->executeResult($sql);
             if($result == false){
                 return false;
             } else {
                 return $result;
             }
        }

        // Phương thức cập nhập 1 danh mục
        public function updateCategory($cate){
            $categoryid = $cate[0];
            $categoryname = $cate[1];
            $description = $cate[2];
            $sql = "UPDATE `category`
                    SET     `CategoryName`         = '$categoryname',
                            `Description`          = '$description'
                    WHERE   `CategoryID`           = '$categoryid'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức lấy tất cả thông tin của 1 danh mục
        public function getByID($id){
            $sql = "SELECT *
                    FROM `category`
                    WHERE CategoryID = '$id'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức lấy tất cả thông tin của tất cả sp thuộc 1 danh mục
        public function getAllVegetableByID($id){
            $sql = "SELECT *
                    FROM `category`
                    INNER JOIN `vegetable`
                    ON category.CategoryID = vegetable.CategoryID
                    WHERE category.CategoryID = '$id' ";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức xoá tất cả thông tin của 1 danh mục
        public function deleteByID($id){
            $sql = "DELETE FROM `category`
                    WHERE `CategoryID` = '$id' ";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức ẩn 1 danh mục
        public function HiddenCategory($id,$stt){
            $update_category              = "UPDATE `category`
                                             SET `Hidden`              = '$stt'
                                             WHERE `CategoryID`        = '$id'";
            $result = $this->execute($update_category);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức lấy tất cả thông tin theo tên danh mục
        public function searchByName($name){
                $sql = "SELECT *
                        FROM `category`
                        WHERE `CategoryName` like '%$name%'
                        ORDER BY `CategoryID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

    }
?>