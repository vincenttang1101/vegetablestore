<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $classVegetable = new vegetable();
    $classCategory = new category();
?>

<div class="modal fade" id="add_staff_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="add_staff_form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Username:</label>
                            <input type="text" class="form-control" id="add_staff_username" name="Username">
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="add_staff_password" name="Password">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="add_staff_name" name="StaffName">
                        </div>
                        <div class="form-group col-sm-6 ml-auto">
                            <label>Role:</label>
                            <select class="form-control" id="add_staff_role" name="Role">    
                                <option value="Member">Member</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Phone:</label>
                            <input type="text" class="form-control" id="add_staff_phone" name="Phone">
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="add_staff_email" name="Email">
                        </div>
                    </div>
                    <div class="form-row">
                         <div class="form-group col-sm-12">
                            <label>Address:</label>
                            <textarea class="form-control" id="add_staff_address" name="Address" rows="2"></textarea>
                        </div>
                    </div>
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add_staff" name="Add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
