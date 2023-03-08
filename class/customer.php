<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/connection.php');
    class customer extends DBConnection{
        public function __construct(){
            parent::connect();
        }
       
        public function getAll() {
            $sql = "SELECT * 
                    FROM (((`customer` 
                    INNER JOIN `provinces` ON customer.provinces_id = provinces.provinces_id)
                    INNER JOIN `districts` ON customer.districts_id = districts.districts_id)
                    INNER JOIN `wards` ON customer.wards_id = wards.wards_id)
                    GROUP BY customer.CustomerID";

            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        public function getDistrictOfProvince($option_province){
            $sql = "SELECT `districts_id`, `districts_name`
                    FROM `provinces` 
                    INNER JOIN `districts` 
                    ON provinces.provinces_id = districts.provinces_id 
                    WHERE provinces.provinces_id = '$option_province'"; 
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }

        public function getWardOfDistrict($option_district){
            $sql = "SELECT `wards_id`, `wards_name`
                    FROM `wards` 
                    INNER JOIN `districts` 
                    ON wards.districts_id = districts.districts_id 
                    WHERE districts.districts_id = '$option_district'"; 
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức lấy thông tin khách hàng theo ID
        public function getByID($cusid){
            $sql = "SELECT * 
                    FROM (((`customer` 
                    INNER JOIN `provinces` ON customer.provinces_id = provinces.provinces_id)
                    INNER JOIN `districts` ON customer.districts_id = districts.districts_id)
                    INNER JOIN `wards` ON customer.wards_id = wards.wards_id)
                    WHERE `CustomerID` = '$cusid'";
            $result = $this->executeResult($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        
        public function updateByID ($cusid) {
            $sql ="UPDATE `customer`
                   SET `FullName` = '$cusid[0]',
                       `Phone`    = '$cusid[1]',
                       `Email`    = '$cusid[2]',
                       `apartment_number` = '$cusid[3]',
                       `street`           = '$cusid[4]',
                       `provinces_id` = '$cusid[5]',
                       `districts_id` = '$cusid[6]',
                       `wards_id`    = '$cusid[7]'
                    WHERE `CustomerID` = '$cusid[8]'";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        // Phương thức thêm mới thông tin khách hàng
        public function add_cus($cus){
            $full_name = $cus[0];
            $email = $cus[1];
            $username = $cus[2];
            $password = md5($cus[3]);
            $phone = $cus[4];
            $apartment_number = $cus[5];
            $street = $cus[6];
            $provinces = $cus[7];
            $districts = $cus[8];
            $wards = $cus[9];
            $sql = "INSERT INTO customer(Fullname, Email, Username, Password, Phone, apartment_number, street, provinces_id, districts_id, wards_id)
                    VALUES('$full_name', '$email', '$username', '$password', '$phone', '$apartment_number', '$street', '$provinces', '$districts', '$wards')";
            $result = $this->execute($sql);
            if($result == false){
                return false;
            } else {
                return $result;
            }
        }
        
    }
