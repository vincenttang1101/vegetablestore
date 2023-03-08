<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/staff.php');
    if (isset($_POST['StaffID'])) {
        $StaffID = $_POST['StaffID'];
        $classStaff = new staff();
        $result_staff = $classStaff->getByID($StaffID);
        foreach ($result_staff as $Staff) {
            echo json_encode($Staff);
        }
    }
?>