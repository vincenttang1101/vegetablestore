<content>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/goodsreceipt.php');
?>

<div class="container-fluid">
    <h3><span class="text-primary" style="font-weight: bold">Goods Receipt Details</span></h3>
    <table class="table table-hover" style="text-align: center">
        <thead>
            <tr>
                <th>Vegetable Name</th>
                <th>Picture</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $classGR = new goodsreceipt();
            if (isset($_GET['id'])){
                $GoodsReceiptID = $_GET['id'];
                $result = $classGR->getByID($GoodsReceiptID);
                $total_quantity = 0;
            foreach ($result as $GoodsReceipt):
                $total_quantity += $GoodsReceipt['Quantity'];
        ?>
            <tr>
                <td><?php echo $GoodsReceipt['VegetableName'] ?></td>
                <td><img src="<?php echo $server_root.'/'.$GoodsReceipt['Image'] ?>" alt = "" width ="150px" class="img-fluid"></td>
                <td><?php echo $GoodsReceipt['Unit'] ?></td>
                <td><?php echo $GoodsReceipt['Quantity'] ?></td>
                <td><?php echo number_format($GoodsReceipt['Price'])?></td>
                <td><?php echo number_format($GoodsReceipt['Subtotal']).' VND' ?></td>
                <td>
                    <a href="" class="update" name="GoodsReceiptID" id="<?php echo $GoodsReceipt['GoodsReceiptID'] ?>">
                        <i class="fas fa-edit"></i> 
                    </a>
                    <a href="" onclick="deleteReceipt('<?php echo $GoodsReceipt['GoodsReceiptID'] ?>')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; }  ?>
            <tr>
                <td></td>
                <td style="font-weight: bold">Total</td>
                <td></td>
                <td><?php echo $total_quantity ?></td>
                <td></td>
                <td><?php echo number_format($GoodsReceipt['Total']).' VND' ?></td>
            <tr>
        </tbody>
    </table>
</div>


</content>
