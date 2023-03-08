<content>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/goodsreceipt.php');
    
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/goodsreceipt/list/operation/details/modal.php') ?>

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
                    <a href="" class="update_goods_receipt_a" id="<?php echo $GoodsReceipt['GoodsReceiptID'] ?>">
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '.update_goods_receipt_a', function(e) {    
        e.preventDefault();
        $('#update_goods_receipt').modal('show');
    });
});
</script>
</content>
