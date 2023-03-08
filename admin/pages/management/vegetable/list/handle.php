<content>
<?php 
    if (isset($_SESSION['StaffName'])) {
        $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore'; 
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
?>

<div class ="container-fluid">
    <div class="form-inline mb-3 pt-4">
        <h3><span class="text-primary" style="font-weight: bold">Vegetable List</span></h3>
        <!-- Button trigger modal -->
        <button class="btn btn-primary ml-auto" class="form-control" id="add_button_modal" style="position:relative;" data-toggle="modal"><i class="fas fa-plus"></i> Add Vegetable</button>
    </div>
    <!-- Modal Add -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/vegetable/list/operation/add/index.php') ?>
    <div class="form-inline mb-2">
        <div class="form-group">
            <label class="col-form-label">Filter by:</label>
            <form method="POST" id="filter_vegetable_form">
                <select class="form-control mx-sm-2" id="filter_vegetable_status" name="FilterVegetableStatus">
                    <option value="">Status</option>
                    <option value="*">All</option>
                    <option value="Stocking">Stocking</option>
                    <option value="Sold out">Sold out</option>
                    <option value="yes">Hidden</option>
                    <option value="no">Unhidden</option>
                </select>
                <button class="btn btn-primary" id="filter_button" type="submit"><i class="fas fa-filter"></i> Filter</button>
            </form>
        </div>
    </div>

    <span id="message"></span>
    <div id="vegetable_table">
        <table class="table table-hover table-bordered" style="text-align: center">
            <thead>
                <tr class="table-active">
                    <th>Vegetable ID</th>
                    <th>Vegetable Name</th>
                    <th>Category</th>
                    <th>Picture</th>
                    <th>Amount</th>
                    <th>Unit</th>
                    <th>Selling Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="vegetable_list_tbody">
            <?php 
                $classVgt = new vegetable();
                $result = $classVgt->getAll();  
                if (is_array($result) || is_object($result)) {
                    foreach($result as $vegetable) {
            ?>
                    <tr>
                        <td><?php echo $vegetable['VegetableID']?></td>
                        <td><?php echo $vegetable['VegetableName']; ?></td>
                        <td><?php echo $vegetable['CategoryName']?></td>
                        <td><img src ="<?php echo  $server_root.'/'.$vegetable['Image'] ?>" alt = "" width ="150px" class="img-fluid"></td>
                        <td><?php echo $vegetable['Amount']; ?></td>
                        <td><?php echo $vegetable['Unit']; ?></td>
                        <td><?php echo number_format($vegetable['Price']).' VND' ?></td>
                        <td>
                            <?php 
                            if ($vegetable['Amount'] == "0") {
                                $classVgt->setStatus("Sold out",$vegetable['VegetableID']);
                            } else $classVgt->setStatus("Stocking",$vegetable['VegetableID']);
                            echo $vegetable['Status']; 
                            ?>
                        </td>
                        <td>
                            <a href="" class="update_vegetable_a" id="<?php echo $vegetable['VegetableID'] ?>">
                                <i class="fas fa-edit"></i>
                            </a>   
                            <a href="" class="hidden_vegetable_a" id="<?php echo $vegetable['VegetableID'] ?>">
                            <?php
                                if ($vegetable['Hidden'] == "yes") { 
                                    $stt = "fas fa-eye-slash";
                                } else $stt ="fas fa-eye";
                            ?>
                                <i class="<?php echo $stt ?>"></i>
                            </a>
                            <a href="" class="delete_vegetable_a" id="<?php echo $vegetable['VegetableID'] ?>">
                                <i class="fas fa-trash"></i>
                            </a>                                       
                        </td>
                    </tr>
        <?php  } } ?>
            </tbody>
        </table>
    </div>
     <!-- Modal Update -->
     <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/vegetable/list/operation/update/index.php') ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#add_button_modal', function() { 
            $('#add_vegetable_modal').appendTo('body').modal("show");
        });

        $('#add_vegetable_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/add/handle.php',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    $('#add_vegetable_form')[0].reset();
                    $('#add_vegetable_modal').modal("hide");
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#vegetable_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Vegetable has been unsuccessfully added</div>") {
                        $('#message').html(data);
                    } else $('#vegetable_table').html(data);

                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#success").slideUp('2000');
                        });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });
        });

        $(document).on('click', '.update_vegetable_a', function(e) {
            e.preventDefault();
            var VegetableID = $(this).attr('id');  
            $.ajax({
                url: './operation/update/data.php',
                method: 'POST',
                data: {VegetableID: VegetableID},
                dataType: 'json',
                success: function(data) {
                    $('#update_vegetable_id').val(data.VegetableID);
                    $('#update_vegetable_name').val(data.VegetableName);
                    $('#update_category_id').val(data.CategoryID);
                    $('#update_vegetable_unit').val(data.Unit);
                    $('#update_vegetable_amount').val(data.Amount);
                    $('#update_vegetable_price').val(data.Price);
                    $('#old_vegetable_image').val(data.Image);
                    $('#update_status_vegetable').val(data.Status);
                    $('#update_vegetable_modal').appendTo('body').modal('show');
                }
            });
        });

        $('#update_vegetable_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/update/handle.php',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    $('#update_vegetable_form')[0].reset();
                    $('#update_vegetable_modal').modal("hide");
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#vegetable_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Vegetable has been unsuccessfully updated</div>") {
                        $('#message').html(data);
                    } else $('#vegetable_table').html(data);

                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#success").slideUp('2000');
                    });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });

        });

        $(document).on('click', '.hidden_vegetable_a', function(e) {
            e.preventDefault();
            option = confirm('Do you want to hidden Vegetable ?')
            if(!option) {
                return;
            }
            var VegetableID = $(this).attr("id");
            $.ajax({
                url: './operation/hidden/index.php',
                method: 'POST',
                data: {VegetableID: VegetableID},
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#vegetable_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Vegetable has been unsuccessfully hiddened</div>") {
                        $('#message').html(data);
                    } else $('#vegetable_table').html(data);
             
                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                            $("alert-#success").slideUp('2000');
                    });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });  
        });
        

        $(document).on('click', '.delete_vegetable_a', function(e) {
            e.preventDefault();
            option = confirm('Do you want to delete Vegetable ?')
            if(!option) {
                return;
            }
            var VegetableID = $(this).attr("id");
            $.ajax({
                url: './operation/delete/index.php',
                method: 'POST',
                data: {VegetableID: VegetableID},
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#vegetable_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Vegetable has been unsuccessfully deleted</div>") {
                        $('#message').html(data);
                    } else {
                        $('#vegetable_table').html(data);
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

        $('#search_vegetable_name').keyup(function() {
            var keywords = $('#search_vegetable_name').val();
            $.ajax({  
                url: './operation/search/index.php',
                method: 'POST',
                data: {keywords: keywords},
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#vegetable_table').html(data);
                    } else {
                        $('#vegetable_table').html(data);
                    }
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });  
        });

        $('#filter_vegetable_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/filter/index.php',
                method: 'POST',
                data: $('#filter_vegetable_form').serialize(),
                success: function(data) {
                    if (data == "<div class='alert alert-danger' id='alert-danger'>You haven't selected a status to filter</div>") {
                        $('#message').html(data);
                    }
                    else if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#vegetable_table').html(data);
                    } else  {
                        $('#vegetable_table').html(data);
                        $('#alert-danger').remove();
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
