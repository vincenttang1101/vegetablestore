<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/customer.php');
    if (isset($_POST['provinces_id'])) {
        $option_province = $_POST['provinces_id'];
        echo $option_province;
        $classCustomer = new customer();
        $result_customer = $classCustomer->getDistrictOfProvince($option_province);
        if (is_array($result_customer)) {
            echo '<option value="District">District</option>';
            foreach ($result_customer as $province) {
                echo '<option value ="'.$province['districts_id'].'">'.$province['districts_name'].'</option>';
            }
        }
    }
?>