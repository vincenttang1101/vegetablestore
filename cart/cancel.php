<!DOCTYPE html>
<?php 
	session_start();
	include_once('../class/order.php');
	$id = addslashes($_GET['id']);
    $order = new order();
    $result = $order->cancel("Cancelled",$id);
    echo "<script>alert('Your order has been successfully cancelled !')
		   window.location ='../customer/user/index.php'</script>";	
?>
