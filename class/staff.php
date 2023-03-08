<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/connection.php');

class staff extends DBConnection
{
    public function __construct()
    {
        parent::connect(); // gọi phương thức kết nối từ lớp DBConnection
    }

    // Phương thức lấy tất cả thông tin
    public function getAll()
    {
        $sql = "SELECT * 
                    FROM `staff`
                    ORDER BY `StaffID` DESC";
        $result = $this->executeResult($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

    // Phương thức lấy 1 thông tin nhân viên
    public function getByID($id)
    {
        $sql = "SELECT * 
                    FROM `staff`
                    WHERE `StaffID` = '$id'";
        $result = $this->executeResult($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

    // Phương thức xoá 1 nhân viên
    public function deleteByID($id)
    {
        $sql = "DELETE 
                    FROM `staff`
                    WHERE `StaffID` = '$id'";
        $result = $this->execute($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

    // Phương thức tạo thông tin 1 nhân viên
    public function addStaff($Staff)
    {
        $Username = $Staff[0];
        $Password = md5($Staff[1]);
        $StaffName = $Staff[2];
        $Email = $Staff[3];
        $Phone = $Staff[4];
        $Address = $Staff[5];
        $Role = $Staff[6];
        $sql = "INSERT INTO `staff` (`Username`, `Password`, `StaffName`, `Email`, `Phone`, `Address`, `Role`)
                    VALUES ('$Username', '$Password', '$StaffName', '$Email', '$Phone', '$Address', '$Role')";
        $result = $this->execute($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

    // Phương thức cập nhập thông tin 1 nhân viên
    public function updateStaff($Staff)
    {
        $StaffID = $Staff[0];
        $Username = $Staff[1];
        $Password = md5($Staff[2]);
        $StaffName = $Staff[3];
        $Email = $Staff[4];
        $Phone = $Staff[5];
        $Address = $Staff[6];
        $Role = $Staff[7];
        $Status = $Staff[8];
        $sql = "UPDATE `staff`
                    SET `Username`  = '$Username',
                        `Password`  = '$Password',
                        `StaffName` = '$StaffName',
                        `Email`     = '$Email',
                        `Phone`     = '$Phone',
                        `Address`   = '$Address',
                        `Role`      = '$Role',
                        `Status`    = '$Status'
                    WHERE `StaffID` = '$StaffID'";
        $result = $this->execute($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

    // Phương thức lấy thông tin username của 1 Staff
    public function getByUser($Username)
    {
        $sql = "SELECT * 
                    FROM `staff`
                    WHERE `Username` = '$Username'";
        $result = $this->executeResult($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

    // Phương thức set tình trạng của 1 Staff
    public function setStatus($id, $stt)
    {
        $sql = "UPDATE `staff`
                    SET `Status` = '$stt'
                    WHERE `StaffID` = '$id'";
        $result = $this->execute($sql);
        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }
}
