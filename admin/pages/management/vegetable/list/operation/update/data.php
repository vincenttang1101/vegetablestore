<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    if (isset($_POST['VegetableID'])) {
        $VegetableID = $_POST['VegetableID'];
        $classVegetable = new vegetable();
        $result_vegetable =$classVegetable->getByID($VegetableID);
        foreach ($result_vegetable as $Vegetable) {
            echo json_encode($Vegetable);
        }
        
    }
?>