<?php
    session_start();
    if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager") {
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php') ; 
        $classVgt = new vegetable();
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $result = $classVgt->getByID($id);
            foreach ($result as $vegetable) {
                if ($vegetable['Hidden'] == "no") {
                    $classVgt->HiddenVgt($id,"yes");
                    echo "Hidden Successfully !";
                }
                else {
                    $classVgt->HiddenVgt($id,"no");
                    echo "Unhidden Successfully !";
                }
            }
        } 
    } else header('Location: '.$server_root.'/vegetablestore/system/index.php');
?> 