<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
    $classVegetable = new vegetable();
    $classCategory = new category();

?>
<div class="modal fade bd-example-modal-lg" id="add_vegetable_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold">Add Vegetable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <form method="POST" enctype="multipart/form-data" id="add_vegetable_form">
                <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Vegetable Name:</label>
                                <input type="text" class="form-control" id="add_vegetable_name" name="VegetableName">
                            </div>
                            <div class="form-group col-md-5 ml-auto">
                                <label>Category:</label>
                                <select class="form-control" id="add_category_id" name="CategoryID">
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
                                <select class="form-control" id="add_vegetable_unit" name="Unit">
                                    <option></option>
                                    <option value="kg">Kg</option>
                                    <option value="bunch">Bunch</option>
                                    <option value="per fruit">Per Fruit</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Amount">Amount:</label>
                                <input type="number" class="form-control" id="add_vegetable_amount" name="Amount">
                            </div>
                            <div class="form-group col-md-5 ml-auto">   
                                <label>Price:</label>
                                <input type="number" class="form-control" id="add_vegetable_price" name="Price">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label>Image:</label>
                                <input type="file" class="form-control-file" id="add_vegetable_uploadfile" name="UploadFile">
                            </div>
                        </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add_vegetable" name="Add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
