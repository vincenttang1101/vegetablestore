<content>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
?>

<div class="container-fluid">
    <h3><span class="text-primary" style="font-weight: bold">Order List</span></h3>
    <table class="table table-hover table-bordered" style="text-align: center">
        <thead>
            <tr class="table-active">
                <th>Vegetable Name</th>
                <th>Picture</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $classOdr = new Order();
            $total_quantity = 0;
            $total_price    = 0;
            if (isset($_GET['id'])){
                $orderID = $_GET['id'];
                $result = $classOdr->getOrderDetails($orderID);  
            foreach ($result as $order):
                $total_quantity += $order['Quantity'];
                $total_price += $order['Price'];
        ?>
            <tr>
                <td><?php echo $order['VegetableName'] ?></td>
                <td><img src="<?php echo $server_root.'/'.$order['Image'] ?>" alt = "" width ="150px" class="img-fluid"></td>
                <td><?php echo $order['Unit'] ?></td>
                <td><?php echo $order['Quantity'] ?></td>
                <td><?php echo number_format($order['Price']).' VND' ?></td>
                <td><?php echo number_format($order['Subtotal']).' VND' ?></td>
            </tr>
        <?php endforeach; }  ?>
            <tr>
                <td></td>
                <td style="font-weight: bold">Total</td>
                <td></td>
                <td><?php echo $total_quantity ?></td>
                <td></td>
                <td><?php echo number_format($total_price).' VND' ?></td>
            <tr>
        </tbody>
    </table>
</div>


</content>
