<content>
<?php 
  if (isset($_SESSION['StaffName'])) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php'); 
    $classCat = new category();
?>

<div class ="container-fluid">
  <div class="form-inline mb-3 pt-4">
    <h3><span class="text-primary" style="font-weight: bold">Category List</span></h3>
    <!-- Button trigger modal -->
    <button class="btn btn-primary ml-auto" class="form-control" id="add_button_modal" style="position:relative;" data-toggle="modal"><i class="fas fa-plus"></i> Add Category</button>
  </div>
  <!-- Modal Add -->
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/category/list/operation/add/index.php') ?>
  <div class="form-inline mb-2">
    <div class="form-group">
      <label class="col-form-label">Filter by:</label>
      <form method="POST" id="filter_category_form">
        <select class="form-control mx-sm-2" id="filter_category_status" name="FilterCategoryStatus">
          <option value="">Status</option>
          <option value="*">All</option>
          <option value="yes">Hidden</option>
          <option value="no">No Hidden</option>
        </select>
        <button class="btn btn-primary" id="filter" type="submit"><i class="fas fa-filter"></i> Filter</button>
      </form>
    </div>
  </div>

  <span id="message"></span>
  <div id="category_table">
    <table class="table table-hover table-bordered" style="text-align: center">
      <thead>
        <tr class="table-active">
          <th>Details</th>
          <th>CategoryID</th>
          <th>Name</th>
          <th>Description</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="category_list_tbody">
      <?php
        $result = $classCat->getAll();
        foreach ($result as $category) {  
      ?>
        <tr>
          <td>
            <a href="./operation/details/categoryDetails.php?id=<?php echo $category['CategoryID'] ?>"><i class="fas fa-info-circle"></i></a>                           
          </td>
          <td><?php echo $category['CategoryID'] ?></td>
          <td><?php echo $category['CategoryName'] ?></td>  
          <td><?php echo $category['Description'] ?></td>
          <td>
            <a href="" class="update_category_a" id="<?php echo $category['CategoryID'] ?>">
              <i class="fas fa-edit"></i>
            </a>
            <a href="" class="hidden_category_a" id="<?php echo $category['CategoryID'] ?>">
            <?php
            $check = $classCat->getByID($category['CategoryID']);
              foreach ($check as $checked){
                if ($checked['Hidden'] == "yes") { 
                  $stt = "fas fa-eye-slash";
                } else $stt = "fas fa-eye";
              }
            ?>
              <i class="<?php echo $stt ?>" id="status"></i>
            </a>
            <a href="" class="delete_category_a" id="<?php echo $category['CategoryID'] ?>">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
      <?php  } ?>
      </tbody>

    </table>
  </div>
    <!-- Modal Update -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/admin/pages/management/category/list/operation/update/index.php') ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script type="text/javascript">
  $(document).ready(function() {
    /*
    load_data();  
    function load_data(page)  {  
      $.ajax({  
        url: "./operation/pagination/index.php",  
        method:"POST",  
        data:{page:page},  
        success:function(data){  
          $('#category_table').html(data);  
        }  
      });
    }  
    
    $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
    */

    $('#filter_category_form').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: './operation/filter/index.php',
        method: 'POST',
        data: $('#filter_category_form').serialize(),
        success: function(data) {
          if (data == "<div class='alert alert-danger' id='alert-danger'>You haven't selected a status to filter</div>") {
            $('#message').html(data);
          } else if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
            $('#category_table').html(data);
          } else  {
            $('#alert-danger').remove();
            $('#category_table').html(data);
          }
          
          $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
            $("alert-#danger").slideUp('2000');
          });
        }
      });
    });

    $(document).on('click', '.update_category_a', function(e) {
      e.preventDefault();
      var CategoryID = $(this).attr('id');  
      $.ajax({
        url: './operation/update/data.php',
        method: 'POST',
        data: {CategoryID: CategoryID},
        dataType: 'json',
        success: function(data) {
          $('#update_category_id').val(data.CategoryID);
          $('#update_category_name').val(data.CategoryName);
          $('#update_description').val(data.Description);
          $('#update_category_modal').appendTo('body').modal('show');
        }
      });
    });


    $('#update_category_form').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: './operation/update/handle.php',
        method: 'POST',
        data: $('#update_category_form').serialize(),   
        success: function(data) {
          $('#update_category_form')[0].reset();
          $('#update_category_modal').modal("hide");
          if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
            $('#category_table').html(data);
          } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully updated</div>") {
              $('#message').html(data);
          } else $('#category_table').html(data);

          $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
            $("alert-#success").slideUp('2000');
          });
          $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
            $("alert-#danger").slideUp('2000');
          });
        }
      });
    });

    $(document).on('click', '#add_button_modal', function(e) { 
      $('#add_category_modal').appendTo('body').modal("show");
    });

    $('#add_category_form').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: './operation/add/handle.php',
        method: 'POST',
        data: $('#add_category_form').serialize(),   
        success: function(data) {
          $('#add_category_form')[0].reset();
          $('#add_category_modal').modal("hide");
          if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
            $('#category_table').html(data);
          } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully added</div>") {
              $('#message').html(data);
          } else $('#category_table').html(data);

          $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
            $("alert-#success").slideUp('2000');
          });
          $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
            $("alert-#danger").slideUp('2000');
          });
        }
      });
    });

    $(document).on('click', '.hidden_category_a', function(e) {
      e.preventDefault();
      option = confirm('Do you want to hidden Category ?');
		  if(!option) {
			  return;
		  }
      var Category_ID = $(this).attr("id");
      $.ajax({
        url: './operation/hidden/index.php',
        method: 'POST',
        data: {CategoryID: Category_ID},
        success: function(data) {
          if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
            $('#category_table').html(data);
          } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully hiddened</div>") {
            $('#message').html(data);
          } else  $('#category_table').html(data);

          $("#alert-success").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
              $("alert-#success").slideUp('2000');
          });
          $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
            $("alert-#danger").slideUp('2000');
          });
        }
			});
		});

    $(document).on('click', '.delete_category_a', function(e) {
      e.preventDefault();
      option = confirm('Do you want to delete Category ?')
		  if(!option) {
			  return;
		  }
      var CategoryID = $(this).attr("id");
      $.ajax({
        url: './operation/delete/index.php',
        method: 'POST',
        data: {CategoryID: CategoryID},
        success: function(data) {
          if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
            $('#category_table').html(data);
          } else if (data == "<div class='alert alert-danger' id='alert-danger'>The Category has been unsuccessfully deleted</div>") {
            $('#message').html(data);
          } else {
            $('#category_table').html(data);
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

    $('#search_category_name').keyup(function() {
      var keywords = $('#search_category_name').val();
      $.ajax({  
        url: './operation/search/index.php',
        method: 'POST',
        data: {keywords: keywords},
        success: function(data) {
          if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
            $('#category_table').html(data);
          } else {
            $('#category_table').html(data);
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
