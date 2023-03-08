<!DOCTYPE html>
<?php 
session_start();
require_once("../class/order.php");
?>
<html>
<head>
	<title>History</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
<div class ="container">
        <div class ="row">
            <div class ="col-md-2"></div>
            <div class ="col-md-10">
                <div class ="panel-body">
                    <table class="table table-hover" style="text-align: center">
                    <h2>History</h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                                $cusID = $_SESSION['yourID'];
                                $index = 1;
                                $order = new order();
                                $result = $order->getAllOrderByCusID($cusID);
                                if(is_array($result) || is_object($result)){
                                foreach($result as $key => $value):    
                                    
                            ?>
                            
                                <tr>
                                    <td><?php echo $index++?></td>
                                    <td><?php echo $value['OrderDate']; ?></td>
                                    <td><?php echo number_format($value['Total']).' VND' ?></td>
                                    <td>
                                        <?php 
                                            if ($value['Status'] == "Unprocessed") {
                                                echo '<span class="badge badge-warning" style="color: white; font-size: 15px">Unprocessed</span>';
                                            } else if ($value['Status'] == "Confirmed") {
                                                echo '<span class="badge badge-primary" style="color: white; font-size: 15px">Confirmed</span>';
                                            } else if ($value['Status'] == "Shipping") {
                                                echo '<span class="badge badge-info" style="color: white; font-size: 15px">Shipping</span>';
                                            } else if ($value['Status'] == "Shipped") {
                                                echo '<span class="badge badge-info" style="color: white; font-size: 15px">Shipped</span>';
                                            } else echo '<h5><span class="badge badge-danger" style="color: white; font-size: 15px">Cancelled</span></h5>';
                                            

                                        ?>
                                    </td>
                                    <td>
                                        <a href="detail.php?id=<?php echo $value['OrderID']?>"><i class="fas fa-info-circle" style="font-size: 17px"></i></a>
                                        <a href="status.php?id=<?php echo $value['OrderID']?>"><i class="fas fa-shipping-fast" style="font-size: 17px"></i></a>
                                    </td>
                            <?php endforeach;} ?>
</div>
</body>
</html>