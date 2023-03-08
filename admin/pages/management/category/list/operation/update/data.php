<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    if (isset($_POST['CategoryID'])) {
        $CategoryID = $_POST['CategoryID'];
        $classCategory = new category();
        $result_category = $classCategory->getByID($CategoryID);
        foreach ($result_category as $Category) {
            echo json_encode($Category);
        }
        
    }
?>