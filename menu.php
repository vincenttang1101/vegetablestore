<?php
  $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
  function total_item($cart) {
      $total = 0;
      foreach ($cart as $value) {
        $total += $value['Quantity'];
      }
      if ($total == 0) {
        return false;
      } return $total;
    
  }
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];?>
<!-- Navbar -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark" id="mainNav">
  <!-- Brand -->
  <div class="container col-sm-4">
    <a class="navbar-brand" href="#">Shop Online</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $server_root ?>/vegetable/index.php">Vegetable</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $server_root ?>/cart/index.php">Cart&nbsp;<?php 
                                                                                      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) 
                                                                                        echo '('.total_item($cart).')';
                                                                                   ?></a>
        </li>
      <?php 
      $bare_url = '"http://"' .$_SERVER['SERVER_NAME'].'"/market/"';
      if(!isset($_SESSION['yourID'])){
        echo '<a class="nav-link" href ="'.$server_root.'/customer/register.php">Register</a> 
              <a class="nav-link" href ="'.$server_root.'/customer/login.php">Login</a>';
      } else {
          echo '<a href="'.$server_root.'/customer/user/index.php" class ="btn btn-info">'.$_SESSION['Fullname'].'</a>';
      }
      ?>
      </ul>
    </div>
  </div>
</nav>
