<content>
<?php
    if (isset($_SESSION['StaffName'])) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
        $classOdr = new order();
?>
<div class ="container-fluid">
    <div class="form-inline mb-3 pt-4">
        <h3><span class="text-primary" style="font-weight: bold">Order List</span></h3>
    </div>
    <div class="form-inline mb-2">
        <form method="POST" id="filter_order_form">
            <div class="form-group row col-md-15">
                <label class="col-form-label mx-sm-2">Filter by:</label>
                <select class="form-control mx-sm-2" name="FilterOrderStatus">
                    <option value="">Status</option>
                    <option value="*">All</option>
                    <option value="Unprocessed">Unprocessed</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Shipping">Shipping</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <select class="form-control mx-sm-2" name="FilterDateTypes">
                    <option value="">Date Types</option>
                    <option value="Order Date">Order Date</option>
                    <option value="Ship Date">Ship Date</option>
                </select>
                <input type="Date" name="FromDate" class="form-control mx-sm-2">
                <label>To</label>
                <input type="Date" name="ToDate" class="form-control mx-sm-2">
                <button class="btn btn-primary btn mx-sm-2"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>
    </div>
    
    <span id="message"></span>

    <div id="order_table">
        <table class="table table-hover table-bordered" style="text-align: center">
            <thead>
                <tr>
                    <th>Details</th>
                    <th style="width: 7%">Order ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th style="width:9%">Order Date</th>
                    <th style="width: 8%">Ship Date</th>
                    <th>Ship Place</th>
                    <th>Payments</th>
                    <th>Total</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th style="width: 7%"></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $result = $classOdr->getAll();
                if(is_array($result) || is_object($result)){
                foreach($result as $order):     
            ?>
                <tr>
                    <td>
                        <a href="./operation/details/orderDetails.php?id=<?php echo $order['OrderID'] ?>"><i class="fas fa-info-circle"></i></a>                           
                    </td>
                    <td><?php echo $order['OrderID'] ?></td>
                    <td><?php echo $order['Fullname'] ?></td>
                    <td><?php echo $order['Phone'] ?></td>
                    <td><?php echo $order['OrderDate'] ?></td>
                    <td><?php echo $order['ShipDate'] ?></td>
                    <td><?php echo $order['ShipPlace'] ?></td>
                    <td>
                    <?php 
                        if ($order['Payments'] == "PayPal") {
                            $checkPay = "fab fa-cc-paypal";
                        } else $checkPay = "fas fa-money-bill-wave";
                    ?>
                        <i class="<?php echo $checkPay?>"></i>
                    </td>
                    <td><?php echo number_format($order['Total']).' VND'?></td>
                    <td><?php echo $order['Note'] ?></td>
                    <td> 
                        <a href="" class="update_status_a" id="<?php echo $order['OrderID'] ?>">
                        <?php
                            if ($order['Status'] == "Unprocessed") {
                                $classStatus = "badge badge-warning";
                            } else if ($order['Status'] == "Confirmed") {
                                $classStatus = "badge badge-primary";
                            } else if ($order['Status'] == "Shipping") {
                                $classStatus = "badge badge-info";
                            } else  if ($order['Status'] == "Shipped") {
                                $classStatus = "badge badge-success";
                            } else $classStatus = "badge badge-danger";
                        ?>
                            <span style="color:white; font-size:15px;" class="<?php echo $classStatus ?>" ><?php echo $order['Status'] ?></span>
                        </a>
                    </td>
                    <td>
                        <?php if ($order['Status'] != "Cancelled") { ?>
                        <a href="" class="update_order_a" id="<?php echo $order['OrderID'] ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php } ?>
                        <a href="" class="print_order_a" onclick="PrintMe('<?php echo $order['OrderID'] ?>')" id="<?php echo $order['OrderID'] ?>">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="" class="delete_order_a" id="<?php echo $order['OrderID'] ?>">
                            <i class="fas fa-trash"></i>
                        </a>

                    </td>
                </tr>
                <div id="<?php echo $order['OrderID'] ?>" style="display: none">    
                    <h4>Receipt</h4>
                        <?php echo 'Order ID: ' . $order['OrderID'].'<br>'?>
                        <?php echo 'Full Name: ' . $order['Fullname'].'<br>' ?>
                        <?php echo 'Phone: ' . $order['Phone'].'<br>' ?>
                        <?php echo 'Ship Place: ' . $order['ShipPlace'].'<br>' ?>
                        <?php echo 'Order Date: ' . $order['OrderDate'].'<br>' ?>
                        <?php echo 'Ship Date: ' . $order['ShipDate'].'<br>' ?>
                        <?php echo 'Payments: ' . $order['Payments'].'<br>' ?>
                        <?php echo 'Total: '. number_format($order['Total']).' VND<br>' ?>
                    <h4>Order Details</h4>
                        <?php 
                            $result_orderdetails = $classOdr->getOrderDetails($order['OrderID']);
                            foreach ($result_orderdetails as $orderdetails) {
                                echo '&nbsp Vegetable ID: '.$orderdetails['VegetableID'];
                                echo '&nbsp Vegetable Name: '.$orderdetails['VegetableName'];
                                echo '&nbsp Unit: '.$orderdetails['Unit'].'';
                                echo '&nbsp Quantity: '.$orderdetails['Quantity'];  
                                echo '&nbsp Price: '.$orderdetails['Price'].'';
                                echo '&nbsp Subtotal: '.number_format($orderdetails['Subtotal']).' VND <br>';
                            }
                        ?>
                </div>
            <?php 
            
             endforeach; }  
                
            ?>
            </tbody>
        </table>   
    </div>
  <!-- Modal Update -->
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/order/list/operation/update/index.php') ?>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.update_order_a', function(e) {
            e.preventDefault();
            var OrderID = $(this).attr('id');
            $.ajax({
            url : './operation/update/data.php',
            method: 'POST',
            data: {OrderID: OrderID},
            dataType: 'json',
            success: function(data) {
                $('#update_order_id').val(data.OrderID);
                $('#update_customer_id').val(data.CustomerID);
                $('#update_order_customer').val(data.CustomerID+'   -   '+data.Fullname);
                $('#update_order_phone').val(data.Phone);
                $('#update_order_orderdate').val(data.OrderDate);
                $('#update_order_shipdate').val(data.ShipDate);
                $('#update_order_shipplace').val(data.ShipPlace);
                $('#update_order_payment').val(data.Payments);
                $('#update_order_total').val(data.Total).toLocaleString();
                $('#update_order_status').val(data.Status);
                $('#update_order_note').val(data.Note);
                $('#update_order_modal').appendTo('body').modal('show');
            }
            });
        });

        $('#update_order_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/update/handle.php',
                method: 'POST',
                data: $('#update_order_form').serialize(),   
                success: function(data) {
                    $('#update_order_form')[0].reset();
                    $('#update_order_modal').modal("hide");
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#order_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Order has been unsuccessfully updated</div>") {
                        $('#message').html(data);
                    } else $('#order_table').html(data);
                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#success").slideUp('2000');
                    });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });
        });

        $(document).on('click', '.print_order_a', function(e) {
            e.preventDefault();
            var OrderID = $(this).attr("id");
            PrintMe(OrderID);
        });
        function PrintMe(id) {
            var disp_setting="toolbar=yes,location=no,";
            disp_setting+="directories=yes,menubar=yes,";
            disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25";
            var content_vlue = document.getElementById(id).innerHTML;
            var docprint=window.open("","",disp_setting);
            docprint.document.open();
            docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
            docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
            docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
            docprint.document.write('<style type="text/css">body{ margin: 0px;');
            docprint.document.write('font-family:verdana,Arial;color:#000;');
            docprint.document.write('border-style: solid;}');
            docprint.document.write('a{color:#000;text-decoration:none;};</style>');
            docprint.document.write('</head><body onLoad="self.print()"><center>');
            docprint.document.write(content_vlue);
            docprint.document.write('</center></body></html>');
            docprint.document.close();
            docprint.focus();
        }

        $(document).on('click', '.delete_order_a', function(e) {
            e.preventDefault();
            option = confirm('Do you want to delete Order ?');
            if(!option) {
			  return;
		    }
            var OrderID = $(this).attr("id");
            $.ajax({
                url: './operation/delete/index.php',
                method: 'POST',
                data: {OrderID: OrderID},
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#order_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Order has been unsuccessfully deleted</div>") {
                        $('#message').html(data);
                    } else {
                        $('#order_table').html(data);
                    }
                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                            $("alert-#success").slideUp('2000');
                    });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });
        });

        $(document).on('click', '.update_status_a', function(e) {
            e.preventDefault();
            option = confirm('Do you want to update status Order ?');
            if(!option) {
                return;
            }
            var OrderID = $(this).attr("id");
            $.ajax({
                url: './operation/status/index.php',
                method: 'POST',
                data: {OrderID: OrderID},
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#order_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Order has been unsuccessfully updated</div>") {
                        $('#message').html(data);
                    } else {
                        $('#order_table').html(data);
                    }
                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#success").slideUp('2000');
                    });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });
            
        });

        $('#filter_order_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/filter/index.php',
                method: 'POST',
                data: $('#filter_order_form').serialize(),
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>You haven't selected the condition to filter</div>") {
                        $('#message').html(data);
                    }   else if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#order_table').html(data);
                    } else  {
                        $('#alert-danger').remove();
                        $('#order_table').html(data);
                    }
          
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });
        });
    });

</script>

<?php 
  } else {
      $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore/system/index.php';
      echo "<script>window.location = '$server_root'</script>";
  }
?>
</content>