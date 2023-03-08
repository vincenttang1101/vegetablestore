<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $classVegetable = new vegetable();
    $classCategory = new category();
?>

<div class="modal fade" id="update_staff_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Update Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="update_staff_form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Staff ID:</label>
                            <input type="number" class="form-control" id="update_staff_id" name="StaffID" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Username:</label>
                            <input type="text" class="form-control" id="update_staff_username" name="Username">
                        </div>
                        <div class="form-group col-md-5 ml-auto">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="update_staff_password" name="Password">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="update_staff_name" name="StaffName">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Role:</label>
                            <select class="form-control" id="update_staff_role" name="Role">    
                                <option value="Member">Member</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 ml-auto">
                            <label>Status:</label>
                            <select class="form-control" id="update_staff_status" name="Status">    
                                <option value="Active">Active</option>
                                <option value="Lock">Lock</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Phone:</label>
                            <input type="text" class="form-control" id="update_staff_phone" name="Phone">
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="update_staff_email" name="Email">
                        </div>
                    </div>
                    <div class="form-row">
                         <div class="form-group col-sm-12">
                            <label>Address:</label>
                            <textarea class="form-control" id="update_staff_address" name="Address" rows="2"></textarea>
                        </div>
                    </div>
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_staff" name="Update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
