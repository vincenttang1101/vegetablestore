<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/order.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/carbon/autoload.php');
    $classOrder = new order();
    use Carbon\Carbon;
    use Carbon\CarbonInterVal;
    $now = Carbon::now('Asia/Ho_Chi_Minh');
?>

<content>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container-fluid">
  <div class="form-inline mb-3 pt-4">
    <h3><span class="text-primary" style="font-weight: bold">Statistical Conditions</span></h3>
  </div>
  <div class="form-inline mb-2">
    <div class="form-group">
      <label class="col-form-label">Select by:</label>
        <form method="POST" action="./condition/handle.php">
          <select class="form-control mx-sm-2" name="FilterStatistic">
              <option value="sales">Sales</option>
              <option value="best-selling">Best selling vegetables</option>
              <option value="inventory">Inventory vegetables</option>
          </select>
          <button class="btn btn-primary" id="filter" type="submit"><i class="fas fa-filter"></i> Filter</button>
        </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</content>
