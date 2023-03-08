<div class="container">
  <!--Section: Content-->
  <section class="text-center">
    <!-- Section heading -->
    <h3 class="font-weight-bold mb-4">New Product</h3>

    <div class="row responsive">
      <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
        $classVgt = new vegetable();
        $sql = "SELECT * 
                FROM `vegetable` 
                ORDER BY `VegetableID` DESC LIMIT 12";
        $result = $classVgt->executeResult($sql);
        foreach($result as $product1){
          $product1['VegetableName'];
          $product1['Image'];
          $product1['Price'];
        
      ?>
      <!--Grid column-->
      <div class="col-md-auto mb-auto">
        <!--Card-->
        <div class="card">
          <!--Card image-->
          <div class="view overlay">
            <span style="font-size: 15px" class="badge badge-primary  float-right">New</span>
            <img src="<?php echo $product1['Image']?>" style ="height:150px; width:60%; margin:70px" alt="">
            <a>
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
            </a>
          </div>
          <!--/.Card image-->

          <!--Card content-->
          <div class="card-body">
            <!--Title-->
            <h5 class="card-title"><?php echo $product1['VegetableName']?> </h5>
            <!--Text-->
            <p class="mb-0 text-muted"><?php echo number_format($product1['Price']).' VND' ?></p>
       		</div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->
      </div>
      <?php  }?>
      
     

  </div>
    <h3 class="font-weight-bold mb-4">Selling Product</h3>
    
    <div class="row responsive">
      <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/vegetable.php');
        $classVgt = new vegetable();
        $sql = "SELECT `VegetableID`, SUM(`Quantity`) 
                FROM `orderdetails` 
                GROUP BY `VegetableID`
                ORDER BY SUM(`Quantity`) DESC LIMIT 12";
        $result = $classVgt->executeResult($sql);
        foreach($result as $product){
          $product['VegetableID'];
        $result1 = $classVgt->getByID($product['VegetableID']);
        if(is_array($result1) || is_object($result1)){
          foreach($result1 as $product1){
      ?>
      <!--Grid column-->
      <div class="col-md-auto mb-auto">
        <!--Card-->
        <div class="card">
          <!--Card image-->
          <div class="view overlay">
            <span style="font-size: 15px" class="badge badge-primary  float-right">Best Seller</span>
            <img src="<?php echo $product1['Image']?>" style ="height:150px; width:60%; margin:70px" alt="">
            <a>
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
            </a>
          </div>
          <!--/.Card image-->

          <!--Card content-->
          <div class="card-body">
            <!--Title-->
            <h5 class="card-title"><?php echo $product1['VegetableName']?> </h5>
            <!--Text-->
            <p class="mb-0 text-muted"><?php echo number_format($product1['Price']).' VND' ?></p>
       		</div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->
      </div>
      <?php }  } }?>
      
     

  </div>
    


  </section>
  <!--Section: Content-->
</div>