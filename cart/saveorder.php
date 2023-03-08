<?php 
	session_start();
//var_dump($_SESSION['count_quantity']);
//echo "<pre>";
//var_dump($_SESSION['cart']);

	require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/carbon/autoload.php');
	use Carbon\Carbon;
	use Carbon\CarbonInterVal;
	if(!isset($_SESSION['cart'])) {
		echo "<script>alert('You have no history of order !')
		window.location ='../index.php'</script>";
	} else {
		$OrderDate = Carbon::now('Asia/Ho_Chi_Minh');
		$ShipDate = Carbon::now('Asia/Ho_Chi_Minh')->addDays(2);
			$order = array($_SESSION['yourID'],$OrderDate, $_POST['total_to_pay'], $ShipDate, $_POST['Note'], $_POST['Payments'], $_POST['Address']);
			$detail = $_SESSION['cart'];	
			$classOrder = new order();
			$result = $classOrder->addOrder($order,$detail);
			$getInsert = $classOrder->executeResult("SELECT * FROM `order` WHERE `OrderID` =(SELECT MAX(OrderID) FROM `order`)");
			foreach ($getInsert as $get_insert) {}
				echo "<script>alert('Your order will be saved in history !')
				window.location ='receipt.php?id=".$get_insert['OrderID']."'</script>";
				unset($_SESSION['cart']);	
	}
?>	
