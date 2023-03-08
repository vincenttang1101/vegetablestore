<?php 
session_start();
if (isset($_SESSION['yourID'])) {
    require_once("../../class/order.php");
    require_once("../../class/customer.php");
    require_once("../../menu.php");
    $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore/'; 
    $classCus = new customer();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Account Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container light-style flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
        Account Manager
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-history">History</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
            <a class="list-group-item list-group-item-action" href="../logout.php">Logout</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">
            <form id="submit_form" method="POST" action="../operation/handle_update_information.php" enctype="multipart/form-data">

              <div class="card-body media align-items-center">
                <?php 
                    $avatar = $classCus->getByID($_SESSION['yourID']);
                    foreach ($avatar as $avatar) {}
                    if (!empty($avatar['Avatar'])) {
                        $image_a = $server_root.'customer/user/'.$avatar['Avatar'];
                    } else $image_a = "https://bootdey.com/img/Content/avatar/avatar1.png";
                ?>
                <img src="<?php echo $image_a; ?>" alt="" class="d-block ui-w-80">
                <div class="media-body ml-4">
                  <label class="btn btn-outline-primary">
                    Upload new photo
                    <input type="file" id="image" name="image" accept=".jpg, .png" class="account-settings-fileinput">
                  </label> &nbsp;
                  <button type="reset" class="btn btn-default md-btn-flat">Reset</button>

                  <div class="text-light small mt-1" id="message">Allowed JPG, PNG. Max size of 9MB</div>
                </div>
              </div>
              <hr class="border-light m-0">

              <div class="card-body">
                <?php
                $result_cus = $classCus->getByID($_SESSION['yourID']);
                foreach ($result_cus as $Cus) {}
                ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Username:</label>
                            <input type="text" class="form-control mb-1" id="Username" name="Username" value="<?= $Cus['Username'] ?>" readonly>
                        </div>

                        <div class="form-group col-md-6 ml-auto">
                            <label class="form-label">Fullname:</label>
                            <input type="text" class="form-control mb-1" id="Fullname" name="Fullname" value="<?= $Cus['Fullname'] ?>">
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Phone:</label>
                            <input type="text" class="form-control mb-1" id="Phone" name="Phone" value="<?= $Cus['Phone'] ?>">
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control mb-1" id="Email" name="Email" value="<?= $Cus['Email'] ?>">
                        </div>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-11">
                        <label>Address:</label>
                        <input type="text" class="form-control mb-1" id="Address" name="Address" value="<?php echo $Cus['apartment_number'].', '.$Cus['street'].', '.$Cus['wards_name'].', '.$Cus['districts_name'].', '.$Cus['provinces_name'] ?>" readonly> 
                    </div>
                    <div class="form-group col-md-1">
                        <a href="#" id="edit_address"><i class='far fa-edit' style='font-size:24px; margin-top: 37px;'></i></a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="apartment_number" id="apartment_number" placeholder="Apartment number">
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" name="street" id="street" placeholder="Street">
                    </div>

                </div>
                <div class="form-row"> 
                    <div class="form-group col-md-4">
                        <select name="provinces" id="provinces" class="form-control mb-1">
                            <option value="Province">Province</option>  
                            <?php 
                                $Cus_FullAd_pro = $classCus->executeResult("SELECT * FROM `provinces`");
                                foreach ($Cus_FullAd_pro as $address_full) {
                                    echo '<option value="'.$address_full['provinces_id'].'">'.$address_full['provinces_name'].'</option>';
                                }
                            
                            ?>
                        </select>    
                    </div>
                    <div class="form-group col-md-4">
                        <select name="districts" id="districts" class="form-control mb-1">
                             <option value="District">District</option>  
                        </select>    
                    </div>

                    <div class="form-group col-md-4">

                        <select name="wards" id="wards" class="form-control mb-1">
                            <option value="Ward">Ward</option>  
                        </select>    

                    </div>
                </div>
                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary" id="update_information" name="Add">Update</button>
                </div>
            </form>
            </div>
            </div>






            <div class="tab-pane fade" id="account-history">
                <div class="card-body pb-2">
                    <table class="table table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                            $cusID = $_SESSION['yourID'];
                            $order = new order();
                            $result = $order->getAllOrderByCusID($cusID);
                            if(is_array($result) || is_object($result)){
                                foreach($result as $key => $value):    
                            ?>
                            <tr>
                                <td><?php echo $value['OrderID'] ?></td>
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
                                    <a href="../../cart/receipt.php?id=<?php echo $value['OrderID']?>"><i class="fas fa-info-circle" style="font-size: 17px"></i></a>
                                    <a href="../../cart/status.php?id=<?php echo $value['OrderID']?>"><i class="fas fa-shipping-fast" style="font-size: 17px"></i></a>
                                </td>
                                <?php endforeach;} ?>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
            <div class="tab-pane fade" id="account-change-password">
              <div class="card-body pb-2">
                <div class="form-group">
                  <label class="form-label">Current password</label>
                  <input type="password" class="form-control">
                </div>
                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control">
                </div>
                <div class="form-group">
                  <label class="form-label">Repeat new password</label>
                  <input type="password" class="form-control">
                  <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary" id="add_staff" name="Add">Update</button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<style type="text/css">
body{
    background: #f5f5f5;
    margin-bottom: 0;
}

.ui-w-80 {
    width: 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24,28,33,0.1);
    background: rgba(0,0,0,0);
    color: #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #26B4FF;
    background: transparent;
    color: #26B4FF;
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0,0,0,0);
    background: #3B5998;
    color: #fff;
}

.btn-instagram {
    border-color: rgba(0,0,0,0);
    background: #000;
    color: #fff;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position: absolute;
    visibility: hidden;
    width: 1px;
    height: 1px;
    opacity: 0;
}
.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}



</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $('#image').bind('change', function() {
        var fileExtension = ['jpg', 'png'];
        
        if (this.files[0].size > 9000000 || $.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert('Invalid Image');
            $(this).val('');
        } else $('#message').text(this.files[0].name);

    });

    $(document).ready(function() {
        $('#provinces').hide();
        $('#districts').hide();
        $('#wards').hide();
        $('#street').hide();
        $('#apartment_number').hide();


        $('#edit_address').on('click', function () {
            $('#provinces').toggle();
            $('#districts').toggle();
            $('#wards').toggle();
            $('#street').toggle();
            $('#apartment_number').toggle();
            
                
        })

    
        
        $('#provinces').on('change', function() {
            var provinces_id = $(this).val();   
            $.ajax({
                method: "POST",
                url : "../operation/handle_province.php",
                data: {provinces_id: provinces_id},
                dataType: "html",
                success: function(data) {
                    $('#districts').html(data);
                }
            })
        })


        $('#districts').on('change', function() {
            $(this).off
            var districts_id = $(this).val();   
            $.ajax({
                method: "POST",
                url : "../operation/handle_district.php",
                data: {districts_id: districts_id},
                dataType: "html",
                success: function(data) {
                    $('#wards').html(data);
                }
            })
        })

    })
</script>
</script>
</body>
</html>
<?php } ?>