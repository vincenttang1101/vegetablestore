<?php 	
    session_start();
    unset($_SESSION['yourID']);
    header('Location: ../index.php');
    exit();
?>