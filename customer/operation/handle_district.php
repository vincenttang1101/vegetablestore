<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/customer.php');
    if (isset($_POST['districts_id'])) {
        $option_district = $_POST['districts_id'];
        $classCustomer = new customer();
        $result_customer = $classCustomer->getWardOfDistrict($option_district);
        if (is_array($result_customer)) {
            echo '<option value="Ward">Ward</option>';
            foreach ($result_customer as $district) {
                echo '<option value ="'.$district['wards_id'].'">'.$district['wards_name'].'</option>';
            }
        }
    }
?>