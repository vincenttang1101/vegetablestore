<!DOCTYPE html>
<?php 
	session_start();
	include_once('../class/order.php');
	$id = addslashes($_GET['id']);
    $order = new order();
    $result = $order->getOrderDetails($id);
?>
<html>
<head>
	<title>Detail</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../css/style.css">

 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class ="container">
        <div class ="row">
            <div class ="col-md-2"></div>
            <div class ="col-md-10">
                <div class ="panel-body">
                    <table class="table table-hover" style="text-align: center">
                    <h2></h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $index = 1;
                                $amount = 0;
                                $total = 0;
                                $order = new order();
                                foreach($result as $key => $value):
                                    $amount += $value['Quantity'];  
                                    $total += $value['Price']*$value['Quantity'];  
                            ?>
                                <tr>
                                    <td><?php echo $index++?></td>
                                    <td><?php echo $value['VegetableName']; ?></td>
                                    <td><?php echo $value['Unit'] ?></td>
                                    <td><img src="../<?php echo $value['Image']; ?>"alt = "" width ="150px"/></td>
                                    <td><?php echo $value['Quantity']?></td>
                                    <td><?php echo number_format($value['Price']) ?></td>
                                    <td><?php echo number_format($value['Subtotal']).' VND' ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="font-weight: bold">Total:</td>
                                <td></td>
                                <td><?php echo number_format($amount); ?></td>
                                <td></td>
                                <td><?php echo number_format($total).' VND' ?></td>
                            </tr>
                            </tbody>
                     </table>

</div>
	
</body>
</html>