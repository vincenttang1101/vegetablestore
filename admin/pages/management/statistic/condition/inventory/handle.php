<content>
<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class ="container-fluid">
  <div class="form-inline mb-3 pt-4">
      <h3><span class="text-primary" style="font-weight: bold">Inventory Statistics</span></h3>
  </div>
  <div class="form-inline mb-2">
    <label class="col-form-label mr-2">Types of Statistics:</label>
    <select class="form-control mx-sm-2" id="types_statistics">
      <option value="List">List</option>
      <option value="Chart">Chart</option>
    </select>
  </div>
  <span id="message"></span>
  <div id="vegetable_table">
    <table class="table table-hover" style="text-align: center">
      <thead>
        <tr>
          <th>Vegetable ID</th>
          <th>Vegetable Name</th>
          <th>Picture</th>
          <th>Inventory Quantity</th>
          <th>Inventory Price</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $classVgt = new vegetable();
        $result_vgt = $classVgt->executeResult("SELECT * FROM `vegetable` WHERE `Amount` > 0");
        $total_quantity = 0; $total_price = 0;
        foreach ($result_vgt as $Vegetable) {
          $total_quantity += $Vegetable['Amount'];
          $total_price += $Vegetable['Price'];
        ?>
      <tr>
        <td><?php echo $Vegetable['VegetableID'] ?></td>
        <td><?php echo $Vegetable['VegetableName'] ?></td>
        <td><img src ="<?php echo  $server_root.'/'.$Vegetable['Image'] ?>" alt = "" width ="150px" class="img-fluid"></td>
        <td><?php echo $Vegetable['Amount'] ?></td>
        <Td><?php echo number_format($Vegetable['Price']).' VND' ?></td>
      </tr>
        <?php } ?>
      <tr>
        <td></td>
        <td></td>
        <td><label>Total:</label></td>                
        <td><?php echo $total_quantity ?></td>
        <td><?php echo number_format($total_price).' VND' ?></td>
      </tr>
      </tbody>
    </table>
  </div>
  <div id="chart" style="height: 250px;"></div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  
  $('#types_statistics').on('change', function (e) {
    e.preventDefault();
    if ($('#types_statistics option:selected').val() == "Chart") {
      $.ajax({
        url: './statistic.php',
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          var char = new Morris.Bar({
            element: 'chart',
            xkey: 'VegetableName',
            ykeys: ['Quantity','Price'],
            labels: ['Inventory Quantity', 'Inventory Price'],
          });
          char.setData(data);
          $('#vegetable_table').html('');
        }
      });
    }
   
  });

 
 
});


</script>
</content>