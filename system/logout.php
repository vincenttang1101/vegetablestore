<?php
    session_start();
    unset($_SESSION['StaffID']);
    unset($_SESSION['Role']);
    unset($_SESSION['StaffName']);
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'];
    header('Location: '.$server_root.'/vegetablestore/system/index.php');
    exit();
?>