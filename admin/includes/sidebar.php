<?php 
$sord = "SELECT * FROM orders WHERE status=0";
$sores = $pdo->query($sord);
if($sores->num_rows == 0){
	$pendingnum = "";
}else{
	$pendingnum = $sores->num_rows;
}
?>
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link text-center">
      <!--<img src="img/logosm.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <span style="font-family:algerian" class="brand-text font-weight-heavey text-info">Timkent</span>
      <br>
      <span style="font-family:algerian" class="font-weight-heavey text-secondary">ADMIN PANEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			   <li class="nav-header">GENERAL</li>
          <li class="nav-item ">
            <a href="index.php" class="nav-link <?php if ($sdpg==1){ echo "active";}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="orders.php" class="nav-link <?php if ($sdpg==2){ echo "active";}?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Orders
				<span class="badge badge-success right"><?php echo $pendingnum;?></span>
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="customers.php" class="nav-link <?php if ($sdpg==3){ echo "active";}?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          <li class="nav-header">MANAGE</li>
          <li class="nav-item">
            <a href="products.php" class="nav-link <?php if ($sdpg==4){ echo "active";}?>">
              <i class="nav-icon fa fa-store"></i>
              <p>
                Products
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="categories.php" class="nav-link <?php if ($sdpg==5){ echo "active";}?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="transactions.php" class="nav-link <?php if ($sdpg==9){ echo "active";}?>">
              <i class="nav-icon fa fa-barcode"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>
         </ul> 
		 
		 <!--<div class="info-box bg-info">
              <div class="info-box-content">
                <p>Shop Active: 18 days remaining</p>
              </div>
             </div>-->
			 
      </nav>
      <!-- /.sidebar-menu -->
    </div>
 </aside>