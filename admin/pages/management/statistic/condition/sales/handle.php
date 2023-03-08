<content>
<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
?>
<div class ="container-fluid">
  <div class="form-inline mb-3 pt-4">
      <h3><span class="text-primary" style="font-weight: bold">Sales Statistics</span></h3>
  </div>
  <div class="form-inline mb-2">
      <form method="POST" id="filter_date_form">
          <div class="form-group row col-md-15">
              <label class="col-form-label mx-sm-2">Filter by:</label>
              <select class="form-control mx-sm-2" id="filter_date" name="Milestone">
                  <option value="">Milestone</option>
                  <option value="7 days">The past 7 days</option> 
                  <option value="28 days">The past 28 days</option>
                  <option value="90 days">The past 90 days</option>
                  <option value="365 days">The past 365 days</option>
              </select>
              <input type="Date" name="FromDate" class="form-control mx-sm-2">
              <label>To</label>
              <input type="Date" name="ToDate" class="form-control mx-sm-2">
              <button class="btn btn-primary btn mx-sm-2"><i class="fas fa-filter"></i> Filter</button>
          </div>
      </form>
       <div class="form-group row col md-15 mt-4">
          <label class="col-form-label mr-2">Types of Statistics:</label>
          <select class="form-control mx-sm-2" id="types_statistics">
            <option value="List">List</option>
            <option value="Chart">Chart</option>
          </select>
      </div>
  </div>
  <span id="message"></span>
  <div id="order_table">
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('#types_statistics').on('change', function (e) {
    e.preventDefault();
    if ($('#types_statistics option:selected').val() == "Chart") {
      window.location.assign("http://localhost/vegetablestore/admin/pages/management/statistic/condition/sales/operation/convert/index.php");
    } 
  });
  $('#filter_date_form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: './operation/filter/index.php',
      method: 'POST',
      data: $('#filter_date_form').serialize(),
      success: function(data) {
        if (data == "<div class='alert alert-danger' id='alert-danger'>Please check the filter condition again</div>") {
          $('#message').html(data);
        } else if (data == "<div class='alert alert-danger' id='alert-danger'>No result found</div>") {
          $('#order_table').html(data);
        } else {
          $('#alert-danger').remove();
          $('#order_table').html(data);
        }
        $("#alert-danger").delay(4000).fadeTo("slow", 0.5).slideUp('slow', function(){
          $("#alert-danger").slideUp('2000');
        });
      }
    });
  });
});

</script>
</content>