<content>
<?php
    if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager") {
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/supplier.php');
        
?>

<div class ="container-fluid">
    <div class="form-inline mb-3 pt-4">
        <h3><span class="text-primary" style="font-weight: bold">Supplier List</span></h3>
        <!-- Button trigger modal -->
        <button class="btn btn-primary ml-auto" class="form-control" id="add_button_modal" style="position:relative;" data-toggle="modal"><i class="fas fa-plus"></i> Add Supplier</button>
    </div>
    <!-- Modal Add -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/supplier/list/operation/add/index.php') ?>
    <span id="message"></span>
    <div id="supplier_table">
        <table class="table table-hover table-bordered" style="text-align: center">
            <thead>
                <tr class="table-active">
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="supplier_list_tbody">
            <?php 
                $classSup = new supplier();
                $result = $classSup->getAll();
                
                foreach ($result as $supplier):
            ?>
                <tr>
                    <td><?php echo $supplier['SupplierID'] ?></td>
                    <td><?php echo $supplier['SupplierName'] ?></td>
                    <td><?php echo $supplier['Phone']?></td>
                    <td><?php echo $supplier['Email'] ?></td>
                    <td><?php echo $supplier['Address'] ?></td>
                    <td>
                        <a href=""  class="update_supplier_a" id="<?php echo $supplier['SupplierID'] ?>">
                            <i class="fas fa-edit"></i>
                        </a>   
                        <a href="" class="delete_supplier_a" id="<?php echo $supplier['SupplierID'] ?>">
                            <i class="fas fa-trash"></i>
                        </a>                                       
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- Modal Update -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/supplier/list/operation/update/index.php') ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#add_button_modal', function(e) { 
            $('#add_supplier_modal').appendTo('body').modal("show");
        });

        $('#add_supplier_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/add/handle.php',
                method: 'POST',
                data: $('#add_supplier_form').serialize(),   
                success: function(data) {
                    $('#add_supplier_form')[0].reset();
                    $('#add_supplier_modal').modal("hide");
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#supplier_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Supplier has been unsuccessfully added</div>") {
                        $('#message').html(data);
                    } else $('#supplier_table').html(data);

                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#success").slideUp('2000');
                    });
                    $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#danger").slideUp('2000');
                    });
                }
            });
        });

        $(document).on('click', '.update_supplier_a', function(e) {
            e.preventDefault();
            var SupplierID = $(this).attr('id');  
            $.ajax({
                url: './operation/update/data.php',
                method: 'POST',
                data: {SupplierID: SupplierID},
                dataType: 'json',
                success: function(data) {
                    $('#update_supplier_id').val(data.SupplierID);
                    $('#update_supplier_name').val(data.SupplierName);
                    $('#update_supplier_email').val(data.Email);
                    $('#update_supplier_phone').val(data.Phone);
                    $('#update_supplier_address').val(data.Address);
                    $('#update_supplier_modal').appendTo('body').modal('show');
                }    
            });
        });
        
        $('#update_supplier_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: './operation/update/handle.php',
                method: 'POST',
                data: $('#update_supplier_form').serialize(),   
                success: function(data) {
                    $('#update_supplier_form')[0].reset();
                    $('#update_supplier_modal').modal("hide");
                    if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                        $('#supplier_table').html(data);
                    } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Supplier has been unsuccessfully updated</div>") {
                        $('#message').html(data);
                    } else $('#supplier_table').html(data);

                    $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
                        $("alert-#success").slideUp('2000');
                    });
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