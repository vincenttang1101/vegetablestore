<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/connection.php');
    class order extends DBConnection{
        public function __construct(){
            parent::connect(); // gọi phương thức kết nối từ lớp DBConfig
        }

        // Phương thức lấy tất cả thông tin hoá đơn của 1 khách hàng
        public function getByID($OrderID){
            $sql = "SELECT `OrderID`, `OrderDate`, `ShipDate`, `ShipPlace`, `Payments`, `Total`, `Note`, order.Status, customer.CustomerID, `Email`, `Fullname`, `Phone`
                    FROM `order`
                    INNER JOIN `customer`
                    ON order.CustomerID = customer.CustomerID
                    WHERE `OrderID` = '$OrderID'";  
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức cập nhật lại đơn hàng
        public function updateOrder($Order){
            $OrderID    = $Order[0];
            $ShipDate   = $Order[1];
            $Payments    = $Order[2];
            $Note       = $Order[3];
            $Status     = $Order[4];
            $ShipPlace = $Order[5];
            if ($Status == "Cancelled") {
                $sql = "UPDATE `order`
                        SET `ShipDate`  = '$ShipDate',
                            `Payments`  = '$Payments',
                            `Note`      = '$Note',
                            `Status`    = 'Cancelled',
                            `ShipPlace` = '$ShipPlace'
                        WHERE `OrderID` = '$OrderID'";
                $result = $this->execute($sql);
                $sql1 = "UPDATE `vegetable`
                         INNER JOIN `orderdetails`
                         ON vegetable.VegetableID = orderdetails.VegetableID
                         SET vegetable.Amount = vegetable.Amount + orderdetails.Quantity
                         WHERE `OrderID` = '$OrderID'";
                $result1 = $this->execute($sql1);        
            } else {
                $sql = "UPDATE `order`
                        SET `ShipDate`  = '$ShipDate',
                            `Payments`  = '$Payments',
                            `Note`      = '$Note',
                            `Status`    = '$Status',
                            `ShipPlace` = '$ShipPlace'
                        WHERE `OrderID` = '$OrderID'";
                $result = $this->execute($sql);
            }
            if($result){
                return $result;
            } else {
                return false;
            }  
        }

        // Phương thức lấy tất cả thông tin hoá đơn về ngày giao hàng
        public function getShipDate($begin,$end){
            $sql = "SELECT `OrderID`, `OrderDate`, `ShipDate`, `ShipPlace`, `Payments`, `Total`, `Note`, order.Status, customer.CustomerID, `Email`, `Fullname`, `ShipPlace`, `Phone`
                    FROM `order`
                    INNER JOIN `customer`
                    ON order.CustomerID = customer.CustomerID
                    WHERE `ShipDate` BETWEEN '$begin' AND '$end'
                    ORDER BY `OrderID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

    // Phương thức lấy tất cả thông tin hoá đơn về ngày đặt hàng
    public function getOrderDate($begin,$end){
        $sql = "SELECT `OrderID`, `OrderDate`, `ShipDate`, `ShipPlace`, `Payments`, `Total`, `Note`, order.Status, customer.CustomerID, `Email`, `Fullname`, `ShipPlace`, `Phone`
                FROM `order`
                INNER JOIN `customer`
                ON order.CustomerID = customer.CustomerID
                WHERE `OrderDate`  BETWEEN '$begin' AND  DATE_ADD('$end', INTERVAL +1 DAY)               
                ORDER BY `OrderID` DESC";
        $result = $this->executeResult($sql);
        if($result == false){   
            return false;
        } else {
            return $result;
        }
    }
    
        
        // Phương thức lấy thông tin trạng thái của đơn hàng
        public function getStatusOrder($Status){
            $sql = "SELECT `OrderID`, `OrderDate`, `ShipDate`, `ShipPlace`, `Payments`, `Total`, `Note`, order.Status, customer.CustomerID, `Email`, `Fullname`, `ShipPlace`, `Phone`
                    FROM `order`
                    INNER JOIN `customer`
                    ON order.CustomerID = customer.CustomerID
                    WHERE order.Status = '$Status'
                    ORDER BY `OrderID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
    
        
        // Phương thức lấy tất cả thông tin hoá đơn của tất cả khách hàng
        public function getAll(){
            $sql = "SELECT `OrderID`, `OrderDate`, `ShipDate`, `ShipPlace`, `Payments`, `Total`, `Note`, order.Status, customer.CustomerID, `Email`, `Fullname`, `ShipPlace`, `Phone`
                    FROM `order`
                    INNER JOIN `customer`
                    ON order.CustomerID = customer.CustomerID
                    ORDER BY `OrderID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức lấy tất cả thông tin chi tiết hoá đơn theo OrderID
        public function getOrderDetails($orderid){
            $sql = "SELECT *
                    FROM `orderdetails` 
                    INNER JOIN `vegetable`
                    ON orderdetails.VegetableID = vegetable.VegetableID
                    WHERE `OrderID` = '$orderid'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức lấy tất cả thông tin chi tiết hoá đơn theo CusID
        public function getAllOrderByCusID($CusID){
            $sql = "SELECT *
                    FROM `order` 
                    WHERE `CustomerID` = '$CusID'
                    ORDER BY `OrderID` DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }


        // Phương thức hủy đơn hàng
        public function cancel($stt,$orderid){
            $sql1 = "UPDATE `vegetable`
                     INNER JOIN `orderdetails`
                     ON vegetable.VegetableID = orderdetails.VegetableID
                     SET vegetable.Amount = vegetable.Amount + orderdetails.Quantity
                     WHERE `OrderID` = '$orderid'";
            $result = $this->execute($sql1);
            $sql2 = "UPDATE `order`
                     SET `Status` = '$stt'
                     WHERE `OrderID` = '$orderid'";
            $result2 = $this->execute($sql2);
        }

        // Phương thức cập nhập trạng thái đơn hàng
        public function setStatus($stt,$orderid){
            $sql = "UPDATE `order`
                    SET `Status` = '$stt'
                    WHERE `OrderID` = '$orderid'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức xoá 1 đơn hàng
        public function deleteByID($orderid){
            $sql = "DELETE FROM `order`
                    WHERE `OrderID` = '$orderid'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        // Phương thức tự đông thêm OrderID theo khoá chính
        public function execute_lastid($sql){
            $result = $this->connection->query($sql);
            if ($result == true){
                $last_id = $this->connection->insert_id;
                return $last_id;
            } else {
                echo $this->connection->error;
            }
        }
        // Phương thức thêm mới thông tin hoá đơn, chi tiết hoá đơn
        public function addOrder($order,$detail){
            $sql = "INSERT INTO `order`(`CustomerID`,`OrderDate`,`Total`,`ShipDate`,`Note`,`Payments`,`ShipPlace`) VALUES ('$order[0]', '$order[1]', $order[2], '$order[3]', '$order[4]', '$order[5]', '$order[6]')";
            $last_id = $this->execute_lastid($sql);
            //echo "<pre>";
            //var_dump($_SESSION['cart']);
            foreach ($detail as $key => $value) {
                $vegetableid = $value['VegetableID'];
                $amount = $value['Amount']; 
                $quantity = $value['Quantity']; 
                $unit = $value['Unit']; 
                $price= $value['Price'];
                $subtotal = $value['Subtotal'];
                $sql1 = "UPDATE `vegetable` SET `Amount` = $amount - $quantity WHERE `VegetableID` = '$vegetableid'";
                $result1 = $this->execute($sql1);
                $sql2 = "INSERT INTO `orderdetails`(`OrderID`, `VegetableID`, `Quantity`, `Unit`, `Price`, `Subtotal`) VALUES ('$last_id', '$vegetableid', '$quantity', '$unit', '$price', '$subtotal')"; 
                $result2 = $this->execute($sql2);
            }
           
        }

        // Phương thức tính tổng số lượng sản phẩm đã được bán
        public function SumProduct(){
            $sql = "SELECT SUM(`Quantity`) AS 'Sum Quantity'
                    FROM `orderdetails`  
                    INNER JOIN `order`
                    ON order.OrderID = orderdetails.OrderID 
                    WHERE order.Status = 'Confirmed' AND order.Status = 'Shipping' OR order.Status = 'Shipped'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }   

         // Phương thức tính tổng số lượng sản phẩm đã được bán
        public function RevenueByMileStone($from,$to){
            $sql = "SELECT COUNT(DISTINCT orderdetails.OrderID) AS `TotalOrder`, STR_TO_DATE(`OrderDate`,'%Y-%m-%d') AS `OrderDate`, `ShipDate`, SUM(DISTINCT `Total`) AS `Revenue`, order.Status
                    FROM ((`order`
                    INNER JOIN `orderdetails` ON order.OrderID   = orderdetails.OrderID)
                    INNER JOIN `customer` ON customer.CustomerID =  order.CustomerID)
                    WHERE `OrderDate`  BETWEEN '$from' AND  DATE_ADD('$to', INTERVAL +1 DAY) AND order.Status = 'Shipped'
                    GROUP BY STR_TO_DATE(`OrderDate`, '%Y-%m-%d')
                    ORDER BY STR_TO_DATE(`OrderDate`, '%Y-%m-%d') DESC";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }   

    }
     
?>
