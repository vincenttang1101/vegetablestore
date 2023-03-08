<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/market/class/vegetable.php');
    if (isset($_POST['id'])) {
        $id = $_POST['id'];   
        $classvgt = new vegetable();
        $sql = "delete from `vegetable` where `VegetableID` = '$id'";
        $result = $classvgt->execute($sql);
        if ($result) {
            echo 'Delete Successfull';
        } else echo 'Delete Failure';
    }
?>