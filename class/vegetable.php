<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/connection.php');
    class vegetable extends DBConnection{
        public function __construct(){
            parent::connect(); // gọi phương thức kết nối từ lớp DBConnection
        }

        // Phương thức lấy tất cả sản phẩm vegetable
        public function getAll(){
            $sql = "SELECT `VegetableID`, vegetable.CategoryID, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`, vegetable.Hidden, `Status`,
                            category.CategoryID, `CategoryName`, `Description`
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    ORDER BY `VegetableID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        public function countAll(){
            $sql = "SELECT COUNT(*) 
                    FROM `vegetable`";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức lấy tất cả sản phẩm thuộc 1 danh mục (category)
        public function getListByCateID($cateid){
            $sql = "select * from vegetable where CategoryID = $cateid";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

    
        // Phương thức ẩn 1 sản phẩm
        public function HiddenVegetable($id,$status){
            $sql = "UPDATE `vegetable`
                    SET `Hidden` = '$status'
                    WHERE `VegetableID` = '$id'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức lấy chi tiết sản phẩm theo khoá chính
        public function getByID($vegetableID){
            $sql = "SELECT `VegetableID`, vegetable.CategoryID, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`, vegetable.Hidden, `Status`,
                            category.CategoryID, `CategoryName`, `Description`
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    WHERE `VegetableID` = '$vegetableID'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức xoá 1 sản phẩm
        public function deleteByID($vegetableID){
            $sql = "DELETE FROM `vegetable`
                    WHERE `VegetableID` = '$vegetableID'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức lấy tất cả sản phẩm thuộc nhiều danh mục
        public function getListByCateIDs($cateids){
            $s= implode(',', $cateids);
            $sql = "select * from vegetable where CategoryID in ($s)";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức tìm kiếm tên sản phẩm
        public function searchVegetableName($name){
            $sql = "SELECT *
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    WHERE `VegetableName` LIKE '%$name%' ";
  
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        public function searchVgtName($name){
            $sql = "SELECT COUNT(*)
                    AS `total_vegetable`
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    WHERE `VegetableName` LIKE '%$name%' ";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức lọc trạng thái sản phẩm
        public function filterStatusHidden($status){
            $sql = "SELECT `VegetableID`, vegetable.CategoryID, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`, vegetable.Hidden, `Status`,
                            category.CategoryID, `CategoryName`, `Description`
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    WHERE vegetable.Hidden = '$status'
                    ORDER BY `VegetableID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        
        public function setStatus($Status,$VegetableID) {
            $sql = "UPDATE `vegetable`
                    SET `Status` = '$Status'
                    WHERE `VegetableID` = '$VegetableID'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

         // Phương thức lọc trạng thái
         public function filterStatusVegetable($status){
            $sql = "SELECT `VegetableID`, vegetable.CategoryID, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`, vegetable.Hidden, `Status`,
                            category.CategoryID, `CategoryName`, `Description`
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    WHERE `Status` = '$status'
                    ORDER BY `VegetableID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức tìm kiếm sản phẩm theo trạng thái
        public function searchStatus($stt){
            $sql = "SELECT *
                    FROM `vegetable`
                    INNER JOIN `category`
                    ON vegetable.CategoryID = category.CategoryID
                    WHERE `Hidden` = '$stt' ";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức thêm sản phẩm
        public function addVegetable($vege){
                    
            $cateid = $vege[0];
            $vegename = $vege[1];
            $unit = $vege[2];
            $amount = $vege[3];
            $image = $vege[4];
            $price = $vege[5];
            
            // Câu truy vấn thêm
            $sql = "INSERT INTO `vegetable`(`CategoryID`, `VegetableName`, `Unit`, `Amount`, `Image` , `Price`, `Hidden`) 
                                VALUES('$cateid', '$vegename', '$unit', '$amount', '$image', '$price', 'no')";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        
        // Phương thức cập nhập sản phẩm
        public function updateVegetable($vege){
            $vegeid = $vege[0];
            $cateid = $vege[1];
            $vegename = $vege[2];
            $unit = $vege[3];
            $amount = $vege[4];
            $image = $vege[5];
            $price = $vege[6];
            $status = $vege[7];
            $sql = "UPDATE `vegetable`
                    SET `VegetableName` = '$vegename',
                        `CategoryID`    = '$cateid',
                        `Unit`          = '$unit',
                        `Amount`        = '$amount',
                        `Image`         = '$image',
                        `Price`         = '$price',
                        `Status`        = '$status'
                    WHERE `VegetableID` = '$vegeid'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        public function bestSelling($from,$to) {
            $sql ="SELECT vegetable.VegetableID, `CategoryName`, `VegetableName`, `Amount`, orderdetails.Unit, orderdetails.Price, `Image` , SUM(orderdetails.Quantity) AS `Quantity`, STR_TO_DATE(`OrderDate`,'%Y-%m-%d') AS `OrderDate`
                   FROM (((`orderdetails`
                   INNER JOIN `vegetable` ON vegetable.VegetableID = orderdetails.VegetableID)
                   INNER JOIN `order` ON order.OrderID = orderdetails.OrderID)
                   INNER JOIN `category` ON category.CategoryID = vegetable.CategoryID)
                   WHERE `OrderDate`  BETWEEN '$from' AND  DATE_ADD('$to', INTERVAL +1 DAY)
                   GROUP BY orderdetails.VegetableID, STR_TO_DATE(`OrderDate`, '%Y-%m-%d')
                   ORDER BY STR_TO_DATE(`OrderDate`, '%Y-%m-%d') DESC, SUM(orderdetails.Quantity) DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }   
        }

    }
?>