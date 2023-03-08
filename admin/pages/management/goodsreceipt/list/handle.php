<content>
<?php
    if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager") {
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/goodsreceipt.php');
?>

<div class="container-fluid">
    <div class="form-inline mb-3 pt-4">
        <h3><span class="text-primary" style="font-weight: bold">Goods Receipt List</span></h3>
        <!-- Button trigger modal -->
        <button class="btn btn-primary ml-auto" class="form-control" style="position:relative;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add Goods Receipt</button>
    </div>
        <!-- Modal -->
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/goodsreceipt/list/operation/add.php') ?>

    <table class="table table-hover table-bordered" id="goods_receipt_list" style="text-align:center">
        <thead>
            <tr class="table-active">
                <th>Details</th>
                <th>Goods Receipt ID</th>
                <th>Staff</th>
                <th>Supplier</th>
                <th>Goods Receipt Date</th>
                <th>Total</th>
                <th>Note</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $classGoodsReceipt = new goodsreceipt();
            $result = $classGoodsReceipt->getAll();
            foreach ($result as $GoodsReceipt) {
        ?>
            <tr>
                <td>
                    <a href="./operation/details/index.php?id=<?php echo $GoodsReceipt['GoodsReceiptID'] ?>"><i class="fas fa-info-circle"></i> </a>
                </td>
                <td><?php echo $GoodsReceipt['GoodsReceiptID'] ?></td>
                <td><?php echo $GoodsReceipt['StaffName'] ?></td>
                <td><?php echo $GoodsReceipt['SupplierName'] ?></td>
                <td><?php echo $GoodsReceipt['GoodsReceiptDate'] ?></td>
                <td><?php echo number_format($GoodsReceipt['Total']).' VND'?></td>
                <td><?php echo $GoodsReceipt['Note'] ?></td>
                <td>
                    <a href="" class="update" id="<?php echo $GoodsReceipt['GoodsReceiptID'] ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" onclick="deleteReceipt('<?php echo $GoodsReceipt['GoodsReceiptID'] ?>')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <!-- Update GoodsReceipt Modal -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/goodsreceipt/list/operation/update/index.php') ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.update', function(e) {    
            e.preventDefault();
            var GoodsReceiptID = $(this).attr("id");
            $.ajax({
                url: './operation/update/handle.php',
                method: 'POST',
                data: {GoodsReceiptID: GoodsReceiptID},
                dataType: 'json',
                success: function(data) {
                    var test = '';
                    $('#update_staff').val(data.StaffName);
                    $('#update_supplier').val(data.SupplierID);
                    $('#update_goods_receipt_date').val(data.GoodsReceiptDate);
                    $('#update_total_goods_receipt_details').val(data.Total);
                    $('#update_goods_receipt_id').val(data.GoodsReceiptID);
                    $('#update_note').val(data.Note);
                    $('#update_goods_receipt').modal('show');
                }
            });
        });
   

        $(document).on('click', '#add', function() {    
            var newRow = `<tr>
                            <td>
                                <select class="form-control" id="vegetable" name="Vegetable[]">
                                <?php   
                                    $result = $classVegetable->getAll();
                                        echo '<option></option>';
                                    foreach ($result as $Vegetable) {
                                        echo '<option value="'.$Vegetable['VegetableID'].'">'.$Vegetable['VegetableID'].'&ensp;-&ensp;'.$Vegetable['VegetableName'].'</option>';
                                    }
                                ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="unit" name="Unit[]">
                                    <option value=""></option>
                                    <option value="kg">Kg</option>
                                    <option value="per fruit">Per fruit</option>
                                    <option value="bunch">Bunch</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" id="quantity" name="Quantity[]">
                            </td>
                            <td>
                                <input type="number" class="form-control" id="goods_receipt_price" name="GoodsReceiptPrice[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="total_detail_line" name="TotalDetailLine[]" readonly>
                                <input type="hidden" class="form-control" id="total_detail_line_real" name="TotalDetailLineReal[]">
                            </td>
                            <td>
                                <a href="#" id="remove">
                                    <i class="fa fa-trash pt-2"></i>
                                </a>
                            </td>
                        </tr>`;
            $('#item_detail tbody').append(newRow); 
        });


        /*
        function sumDetail($lineNow) {
            var quantity = $lineNow.find('#quantity').val();
            var price    = $lineNow.find('#receipt_price').val();
            quantity     = (quantity === '' ? 0 : parseInt(quantity));
            price        = (price    === '' ? 0 : parseFloat(price));
            var total_detail_line     = quantity * price;
            $lineNow.find('#total_detail').val(total_detail_line);
        }
        */

        function TotalGoodsReceiptDetails() {
            var total_goods_receipt_detail = 0; 
            $('#item_detail tbody tr').each(function() {
                var quantity        = $(this).find('#quantity').val();
                var price           = $(this).find('#goods_receipt_price').val();
                quantity            = (quantity === '' ? 0 : parseFloat(quantity));
                price               = (price === '' ? 0 : parseFloat(price));
                total_detail_line   = quantity * price;
                $(this).find('#total_detail_line').val(total_detail_line.toLocaleString('en'));
                $(this).find('#total_detail_line_real').val(total_detail_line);
                total_goods_receipt_detail += total_detail_line;
                $('#item_goods_receipt tbody tr').each(function() {
                    $(this).find('#total_goods_receipt_details').val(total_goods_receipt_detail.toLocaleString('en'));
                    $(this).find('#total_goods_receipt_details_real').val(total_goods_receipt_detail);

                });
            });           
        
        }
        
        $(document).on('change', '#goods_receipt_price, #quantity', function() {
            var myRow = $(this).parent().parent();
            //sumDetail(myRow);
            TotalGoodsReceiptDetails();
        });

        $(document).on('click', '#remove', function() {
            var myRow = $(this).parent().parent();
            myRow.remove();
        });
 
        $('#insert_form').on('submit', function(e) {
            e.preventDefault();
            var message = '';

            $("#supplier").each(function() {
                if ($(this).val() == '') {
                    message += "<p>Require Selecting Supplier</p>";
                    return false;
                }
            });

            $("#goods_receipt_date").each(function() {
                if ($(this).val() == '') {
                    message += "<p>Require Selecting Goods Receipt Date</p>";
                    return false;
                }
            });

            $("#vegetable[name='Vegetable[]']").each(function() {
                if ($(this).val() == '') {
                    message += "<p>Require Selecting Vegetable</p>";
                    return false;
                }   
            });

            $("#unit[name='Unit[]']").each(function() {
                if ($(this).val() == '') {
                    message += "<p>Require Selecting Unit</p>";
                    return false;
                }
            });

            $("#quantity[name='Quantity[]']").each(function() {
                if ($(this).val() == '') {
                    message += "<p>Require Entering Quantity</p>";
                }
            });

            $("#goods_receipt_price[name='ReceiptPrice[]']").each(function() {
                if ($(this).val() == '') {
                    message += "<p>Require Entering Goods Receipt Price</p>";
                }
            });

           
            var form_data = $(this).serialize();
            if (message == '') {
                $.ajax({
                    url: "./operation/handle_add.php",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    success: function(data) {   
                        var goods_receipt_list = '';
                        goods_receipt_list = '<tr>';
                        goods_receipt_list += '<td><a href="./operation/details/index.php?id='+data.GoodsReceiptID+'"><i class="fas fa-info-circle"></i></a>';
                        goods_receipt_list += '<td>'+data.GoodsReceiptID+'</td>';
                        goods_receipt_list += '<td>'+data.StaffName+'</td>';
                        goods_receipt_list += '<td>'+data.SupplierName+'</td>';
                        goods_receipt_list += '<td>'+data.GoodsReceiptDate+'</td>';
                        goods_receipt_list += '<td>'+data.Total+' VND</td>';
                        goods_receipt_list += '<td>'+data.Note+'</td>';
                        goods_receipt_list += '<td>';
                        goods_receipt_list += '<a href="" class="update" id="'+data.GoodsReceiptID+'" ><i class="fas fa-edit"></i></a>';
                        goods_receipt_list += '<a href="" onclick="deleteReceipt('+data.GoodsReceiptID+')"><i class="fas fa-trash"></i></a>';
                        goods_receipt_list += '</td>';
                        goods_receipt_list += '</tr>';
                        $('#goods_receipt_list tbody').prepend(goods_receipt_list);
                        $('#item_detail').find("tr:gt(0)").remove();
                        $('#supplier').val(''); 
                        $('#goods_receipt_date').val('');
                        $('#total_goods_receipt_details').val('');
                        $('#message').html('<div class="alert alert-success">The Receipt has been Saved</div>');
                    }   
                });
            } else {
                $('#message').html('<div class="alert alert-danger">'+message+'</div>');
            }
        });

        /*
        $(document).on('click', '#close', function() {
            location.reload();
        });
        
        $('#exampleModal').on("hidden.bs.modal", function() {
            location.reload();
        })
        */
    }); 
</script>

<script type="text/javascript">
    function deleteReceipt(id) {
        event.preventDefault();
		console.log(id)
        option = confirm('Do you want to Delete Goods Receipt ?')
		if(!option) {
			return;
		}
	}
</script>


<?php 
  } else {
      $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore/system/index.php';
      echo "<script>window.location = '$server_root'</script>";
  }
?>