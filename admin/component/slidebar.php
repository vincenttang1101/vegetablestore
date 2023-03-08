    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fas fa-user-circle img-circle elevation-2" style="font-size: 36px; color: black" alt="User Image"></i>
        </div>
        <div class="info">
          <a href="<?php echo $server_root ?>/admin/pages/account/profile.php" class="d-block"><?php echo $_SESSION['StaffName'] ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a id="click_dashboard" href="" class="nav-link">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
        </li>
          
          <li class="nav-item">
              <a id="click_category" href="<?php echo $server_root ?>/admin/pages/management/category/list/index.php" class="nav-link">
                <i class="fa fa-list-alt nav-icon"></i>
                <p>
                  Category
                </p>
              </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo $server_root ?>/admin/pages/management/vegetable/list/index.php" class="nav-link">
              <i class="fa fa-barcode nav-icon"></i>             
              <p>
                Vegetable
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo $server_root ?>/admin/pages/management/order/list/index.php" class="nav-link">
              <i class="fa fa-shopping-cart nav-icon"></i>              
              <p>
                Order
              </p>
            </a>
          </li>

          <?php if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager") {?>
          <li class="nav-item">
            <a href="<?php echo $server_root ?>/admin/pages/management/supplier/list/index.php" class="nav-link">
              <i class="fa fa-university nav-icon"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
          <?php } ?>

          <?php if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager") {?>
          <li class="nav-item">
            <a href="<?php echo $server_root ?>/admin/pages/management/goodsreceipt/list/index.php" class="nav-link">
              <i class="fas fa-receipt nav-icon"></i>
              <p>
                Goods Receipt
              </p>
            </a>
          </li>
          <?php } ?>
   
          <?php if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager")  { ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <?php } ?>

          <?php if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager")  { ?>
          <li class="nav-item">
            <a href="<?php echo $server_root ?>/admin/pages/management/staff/list/index.php" class="nav-link">
              <i class="fa fa-users nav-icon"></i>
              <p>
                Staff
              </p>
            </a>
          </li>
          <?php } ?>

          <?php if ($_SESSION['Role'] == "Admin" || $_SESSION['Role'] == "Manager") {?>
          <li class="nav-item">
            <a href="<?php echo $server_root ?>/admin/pages/management/statistic/index.php" class="nav-link">
              <i class="fas fa-chart-bar nav-icon"></i>
              <p>
                Statistic
              </p>
            </a>
          </li>
          <?php } ?>
          
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p>
                Account
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $server_root ?>/admin/pages/account/profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $server_root ?>/system/logout.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
