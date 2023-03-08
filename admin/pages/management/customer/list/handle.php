<content>
    <?php
    if ($_SESSION['Role'] == "Admin") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/class/customer.php');
    ?>

        <div class="container-fluid">
            <div class="form-inline mb-3 pt-4">
                <h3><span class="text-primary" style="font-weight: bold">Customer List</span></h3>
                <!-- Button trigger modal -->
            </div>
            <!-- Modal Add -->
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vegetablestore/admin/pages/management/staff/list/operation/add/index.php') ?>
            <span id="message"></span>
            <div id="staff_table">
                <table class="table table-hover table-bordered" style="text-align:center">
                    <thead>
                        <tr class="table-active">
                            <th style="width: 10%">Customer ID</th>
                            <th>Username</th>
                            <th style="width: 9%">Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $classCus = new customer();
                        $result = $classCus->getAll();
                        foreach ($result as $Cus) :
                        ?>
                            <tr>
                                <td><?php echo $Cus['CustomerID'] ?></td>
                                <td><?php echo $Cus['Username'] ?></td>
                                <td><?php echo $Cus['Fullname'] ?></td>
                                <td><?php echo $Cus['Email'] ?></td>
                                <td><?php echo $Cus['Phone'] ?></td>
                                <td><?php echo $Cus['apartment_number'] . ', ' . $Cus['street'] . ', ' . $Cus['wards_name'] . ', ' . $Cus['districts_name'] . ', ' . $Cus['provinces_name']; ?></td>
                                <td>
                                    <a href="" class="check_status_staff" id="<?php echo $Cus['CustomerID'] ?>">
                                        <?php
                                        if ($Cus['Status'] == "Active") {
                                            $stt = "fas fa-toggle-on";
                                        } else $stt = "fas fa-toggle-off";
                                        ?>
                                        <i style="font-size: 25px; color: #0040ff;" class="<?php echo $stt ?> "></i>
                                </td>
                                <td>
                                    <a href="" class="update_customer_a" id="<?php echo $Cus['CustomerID'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="delete_customer_a" id="<?php echo $Cus['CustomerID'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <?php
    } else {
        $server_root = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/vegetablestore/system/index.php';
        echo "<script>window.location = '$server_root'</script>";
    }
    ?>
</content>