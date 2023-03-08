<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $classVegetable = new vegetable();
    $classCategory = new category();

?>
<div class="modal fade bd-example-modal-lg" id="update_vegetable_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Update Vegetable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <form method="POST" enctype="multipart/form-data" id="update_vegetable_form">
                <div class="modal-body">
                        <div class="form-row">
                             <div class="form-group col-md-3">
                                <label>Vegetable ID:</label>
                                <input type="number" class="form-control" id="update_vegetable_id" name="VegetableID" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Name:</label>
                                <input type="text" class="form-control" id="update_vegetable_name" name="VegetableName">
                            </div>
                            <div class="form-group col-md-5 ml-auto">
                                <label>Category:</label>
                                <select class="form-control" id="update_category_id" name="CategoryID">
                                    <option></option>
                                <?php
                                    $result = $classCategory->getAll();
                                    foreach ($result as $CatName) {
                                        echo '<option value="'.$CatName['CategoryID'].'">'.$CatName['CategoryName'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Unit:</label>
                                <select class="form-control" id="update_vegetable_unit" name="Unit">
                                    <option></option>
                                    <option value="kg">Kg</option>
                                    <option value="bunch">Bunch</option>
                                    <option value="per fruit">Per Fruit</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Amount">Amount:</label>
                                <input type="number" class="form-control" id="update_vegetable_amount" id="Amount" name="Amount">
                                <p id="message_amount"></p>
                            </div>
                            <div class="form-group col-md-5 ml-auto">   
                                <label>Price:</label>
                                <input type="number" class="form-control" id="update_vegetable_price" name="Price">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Image:</label>
                                <input type="file" class="form-control-file" id="update_vegetable_image" name="UploadFile">
                                <input type="hidden" class="form-control-file" id="old_vegetable_image" name="OldVegetableImage">
                            </div>
                            <div class="form-group col-md-5 ml-auto">
                                <label>Status:</label>
                                <select class="form-control" id="update_status_vegetable" name="VegetableStatus">
                                    <option value="Stocking">Stocking</option>
                                    <option value="Sold out">Sold out</option>
                                </select>
                            </div>
                        </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_vegetable" name="Update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script>
    $('#update_vegetable').click(function(e) {
       if ($('#update_vegetable_amount').val() >=0 ){
       } else {
           $('#message_amount').css({"font-weight": "bold","color": "red"});
           $('#message_amount').text('Amount invalid'); 
           e.preventDefault();
       }
    })
</script>