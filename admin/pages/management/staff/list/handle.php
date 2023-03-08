<content>
    <?php
    if ($_SESSION['Role'] == "Admin") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/class/staff.php');
    ?>

        <div class="container-fluid">
            <div class="form-inline mb-3 pt-4">
                <h3><span class="text-primary" style="font-weight: bold">Staff List</span></h3>
                <!-- Button trigger modal -->
                <button class="btn btn-primary ml-auto" class="form-control" id="add_button_modal" style="position:relative;" data-toggle="modal"><i class="fas fa-plus"></i> Add Staff</button>
            </div>
            <!-- Modal Add -->
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/admin/pages/management/staff/list/operation/add/index.php') ?>
            <span id="message"></span>
            <div id="staff_table">
                <table class="table table-hover table-bordered" style="text-align:center">
                    <thead>
                        <tr class="table-active">
                            <th style="width: 7%">Staff ID</th>
                            <th>Username</th>
                            <th style="width: 9%">Staff Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody id="staff_list_tbody">
                        <?php
                        $classStaff = new staff();
                        $result = $classStaff->getAll();
                        foreach ($result as $staff) :
                        ?>
                            <tr>
                                <td><?php echo $staff['StaffID'] ?></td>
                                <td><?php echo $staff['Username'] ?></td>
                                <td><?php echo $staff['StaffName'] ?></td>
                                <td><?php echo $staff['Email'] ?></td>
                                <td><?php echo $staff['Phone'] ?></td>
                                <td><?php echo $staff['Address'] ?></td>
                                <td><?php echo $staff['Role'] ?></td>
                                <td>
                                    <a href="" class="check_status_staff" id="<?php echo $staff['StaffID'] ?>">
                                        <?php
                                        if ($staff['Role'] != "Admin") {
                                            if ($staff['Status'] == "Active") {
                                                $stt = "fas fa-toggle-on";
                                            } else $stt = "fas fa-toggle-off";
                                        ?>
                                            <i style="font-size: 25px; color: #0040ff;" class="<?php echo $stt ?> "></i>
                                        <?php } ?>
                                </td>
                                <td>
                                    <?php
                                    if ($staff['Role'] != "Admin") {
                                    ?>
                                        <a href="" class="update_staff_a" id="<?php echo $staff['StaffID'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="" class="delete_staff_a" id="<?php echo $staff['StaffID'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal Update -->
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/admin/pages/management/staff/list/operation/update/index.php') ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '#add_button_modal', function(e) {
                    $('#add_staff_modal').appendTo('body').modal("show");
                });

                $('#add_staff_form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: './operation/add/handle.php',
                        method: 'POST',
                        data: $('#add_staff_form').serialize(),
                        success: function(data) {
                            $('#add_staff_form')[0].reset();
                            $('#add_staff_modal').modal("hide");
                            if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                                $('#staff_table').html(data);
                            } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Staff has been unsuccessfully added</div>") {
                                $('#message').html(data);
                            } else $('#staff_table').html(data);

                            $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function() {
                                $("alert-#success").slideUp('2000');
                            });
                            $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function() {
                                $("alert-#danger").slideUp('2000');
                            });

                        }
                    });
                });

                $(document).on('click', '.update_staff_a', function(e) {
                    e.preventDefault();
                    var StaffID = $(this).attr('id');
                    $.ajax({
                        url: './operation/update/data.php',
                        method: 'POST',
                        data: {
                            StaffID: StaffID
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#update_staff_id').val(data.StaffID);
                            $('#update_staff_username').val(data.Username);
                            $('#update_staff_password').val(data.Password);
                            $('#update_staff_name').val(data.StaffName);
                            $('#update_staff_role').val(data.Role);
                            $('#update_staff_status').val(data.Status);
                            $('#update_staff_phone').val(data.Phone);
                            $('#update_staff_email').val(data.Email);
                            $('#update_staff_address').val(data.Address);
                            $('#update_staff_modal').appendTo('body').modal('show');
                        }
                    })
                });

                $('#update_staff_form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: './operation/update/handle.php',
                        method: 'POST',
                        data: $('#update_staff_form').serialize(),
                        success: function(data) {
                            $('#update_staff_form')[0].reset();
                            $('#update_staff_modal').modal('hide');
                            if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
                                $('#staff_table').html(data);
                            } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Staff has been unsuccessfully updated</div>") {
                                $('#message').html(data);
                            } else $('#staff_table').html(data);

                            $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function() {
                                $("alert-#success").slideUp('2000');
                            });
                            $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function() {
                                $("alert-#danger").slideUp('2000');
                            });
                        }
                    })
                })
            });
        </script>

    <?php
    } else {
        $server_root = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/vegetablestore/system/index.php';
        echo "<script>window.location = '$server_root'</script>";
    }
    ?>
</content>