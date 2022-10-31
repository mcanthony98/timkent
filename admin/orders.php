<?php include "includes/head.php";?>
<?php include "includes/sessions.php";?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =2;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-info" href="index.php">Timkent</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	
	 <?php 
			if(isset($_SESSION["error"])){
				echo '
				<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <i class="icon fas fa-ban"></i>
                  '.$_SESSION["error"].'
                </div>
				';
				unset ($_SESSION["error"]);
			}if(isset($_SESSION["success"])){
				echo '
				<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-check"></i> 
				  '.$_SESSION["success"].'
                </div>
				';
				unset ($_SESSION["success"]);
			}
			?>
	
	
    <div class="card card-fuchsia card-outline card-outline-tabs d-none">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">All Orders</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pending</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Completed</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Cancelled</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
					<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date Ordered</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php 
					$ord = "SELECT * FROM orders ORDER BY order_id DESC";
					$ores = $pdo->query($ord);
					if($ores->num_rows == 0){
						echo '
						<tr>
						<td class="text-center" colspan=9>No orders to display!</td>
						<tr/>';
					}else{
						while($orow = $ores->fetch_assoc()){
							$stmt = 'SELECT * FROM product WHERE product_id ='.$orow["product_id"].'';
							$res = $pdo->query($stmt);
							$row = $res->fetch_assoc();
							
							$tqry = 'SELECT * FROM topping WHERE topping_id ='.$orow["topping_id"].'';
							$tres = $pdo->query($tqry);
							$trow = $tres->fetch_assoc();
							
							if($orow["status"] == 0){
								$status = '<span class="badge badge-info">Pending</span>';
							}elseif($orow["status"] == 1){
								$status = '<span class="badge badge-success">Complete</span>';
							}elseif($orow["status"] == 2){
								$status = '<span class="badge badge-danger">Cancelled</span>';
							}
				  ?>
                  <tr>
                    <td><?php echo $orow["order_id"];?></td>
                    <td><?php echo $orow["order_code"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $orow["quantity"];?> kg</td>
                    <td><?php echo $status;?></td>
                    <td><?php  echo date('M d, Y', strtotime($orow["date_ordered"]));?></td><td>
					<a href="#" class="btn btn-xs btn-primary view_ord" id="<?php echo $orow["order_id"];?>" data-toggle="modal" data-target="#modal-ord"><i class="fa fa-search"></i> View</a>
					<a href="../processes/orderprocesses.php?complete=<?php echo $orow["order_id"];?>" class="btn btn-xs btn-success"><i class="fas fa-check-circle"></i> Complete</a>
					<a href="../processes/orderprocesses.php?cancel=<?php echo $orow["order_id"];?>" onClick="return confirm('Are you sure you want to cancel order?');" class="btn btn-xs btn-danger"><i class="fa fa-times-circle"></i> Cancel</a>
					</td>
                  </tr>
					<?php }}?>
                 </tbody>
                </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date Ordered</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php 
					$ord = "SELECT * FROM orders WHERE status=0 ORDER BY order_id DESC";
					$ores = $pdo->query($ord);
					if($ores->num_rows == 0){
						echo '
						<tr>
						<td class="text-center" colspan=9>No orders to display!</td>
						<tr/>';
					}else{
						while($orow = $ores->fetch_assoc()){
							$stmt = 'SELECT * FROM product WHERE product_id ='.$orow["product_id"].'';
							$res = $pdo->query($stmt);
							$row = $res->fetch_assoc();
							
							$tqry = 'SELECT * FROM topping WHERE topping_id ='.$orow["topping_id"].'';
							$tres = $pdo->query($tqry);
							$trow = $tres->fetch_assoc();
							
							if($orow["status"] == 0){
								$status = '<span class="badge badge-info">Pending</span>';
							}elseif($orow["status"] == 1){
								$status = '<span class="badge badge-success">Complete</span>';
							}elseif($orow["status"] == 2){
								$status = '<span class="badge badge-danger">Cancelled</span>';
							}
				  ?>
                  <tr>
                    <td><?php echo $orow["order_id"];?></td>
                    <td><?php echo $orow["order_code"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $orow["quantity"];?> kg</td>
                    <td><?php echo $status;?></td>
                    <td><?php  echo date('M d, Y', strtotime($orow["date_ordered"]));?></td><td>
					<a href="#" class="btn btn-xs btn-primary view_ord" id="<?php echo $orow["order_id"];?>" data-toggle="modal" data-target="#modal-ord"><i class="fa fa-search"></i> View</a>
					<a href="../processes/orderprocesses.php?complete=<?php echo $orow["order_id"];?>" class="btn btn-xs btn-success"><i class="fas fa-check-circle"></i> Complete</a>
					<a href="../processes/orderprocesses.php?cancel=<?php echo $orow["order_id"];?>" onClick="return confirm('Are you sure you want to cancel order?');" class="btn btn-xs btn-danger"><i class="fa fa-times-circle"></i> Cancel</a>
					</td>
                  </tr>
					<?php }}?>
                 </tbody>
                </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date Ordered</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php 
					$ord = "SELECT * FROM orders WHERE status=1 ORDER BY order_id DESC";
					$ores = $pdo->query($ord);
					if($ores->num_rows == 0){
						echo '
						<tr>
						<td class="text-center" colspan=9>No orders to display!</td>
						<tr/>';
					}else{
						while($orow = $ores->fetch_assoc()){
							$stmt = 'SELECT * FROM product WHERE product_id ='.$orow["product_id"].'';
							$res = $pdo->query($stmt);
							$row = $res->fetch_assoc();
							
							$tqry = 'SELECT * FROM topping WHERE topping_id ='.$orow["topping_id"].'';
							$tres = $pdo->query($tqry);
							$trow = $tres->fetch_assoc();
							
							if($orow["status"] == 0){
								$status = '<span class="badge badge-info">Pending</span>';
							}elseif($orow["status"] == 1){
								$status = '<span class="badge badge-success">Complete</span>';
							}elseif($orow["status"] == 2){
								$status = '<span class="badge badge-danger">Cancelled</span>';
							}
				  ?>
                  <tr>
                    <td><?php echo $orow["order_id"];?></td>
                    <td><?php echo $orow["order_code"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $orow["quantity"];?> kg</td>
                    <td><?php echo $status;?></td>
                    <td><?php  echo date('M d, Y', strtotime($orow["date_ordered"]));?></td><td>
					<a href="#" class="btn btn-xs btn-primary view_ord" id="<?php echo $orow["order_id"];?>" data-toggle="modal" data-target="#modal-ord"><i class="fa fa-search"></i> View</a>
					<a href="../processes/orderprocesses.php?complete=<?php echo $orow["order_id"];?>" class="btn btn-xs btn-success"><i class="fas fa-check-circle"></i> Complete</a>
					<a href="../processes/orderprocesses.php?cancel=<?php echo $orow["order_id"];?>" onClick="return confirm('Are you sure you want to cancel order?');" class="btn btn-xs btn-danger"><i class="fa fa-times-circle"></i> Cancel</a>
					</td>
                  </tr>
					<?php }}?>
                 </tbody>
                </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                     <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date Ordered</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php 
					$ord = "SELECT * FROM orders WHERE status=2 ORDER BY order_id DESC";
					$ores = $pdo->query($ord);
					if($ores->num_rows == 0){
						echo '
						<tr>
						<td class="text-center" colspan=9>No orders to display!</td>
						<tr/>';
					}else{
						while($orow = $ores->fetch_assoc()){
							$stmt = 'SELECT * FROM product WHERE product_id ='.$orow["product_id"].'';
							$res = $pdo->query($stmt);
							$row = $res->fetch_assoc();
							
							$tqry = 'SELECT * FROM topping WHERE topping_id ='.$orow["topping_id"].'';
							$tres = $pdo->query($tqry);
							$trow = $tres->fetch_assoc();
							
							if($orow["status"] == 0){
								$status = '<span class="badge badge-info">Pending</span>';
							}elseif($orow["status"] == 1){
								$status = '<span class="badge badge-success">Complete</span>';
							}elseif($orow["status"] == 2){
								$status = '<span class="badge badge-danger">Cancelled</span>';
							}
				  ?>
                  <tr>
                    <td><?php echo $orow["order_id"];?></td>
                    <td><?php echo $orow["order_code"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $orow["quantity"];?> kg</td>
                    <td><?php echo $status;?></td>
                    <td><?php  echo date('M d, Y', strtotime($orow["date_ordered"]));?></td><td>
					<a href="#" class="btn btn-xs btn-primary view_ord" id="<?php echo $orow["order_id"];?>" data-toggle="modal" data-target="#modal-ord"><i class="fa fa-search"></i> View</a>
					<a href="../processes/orderprocesses.php?complete=<?php echo $orow["order_id"];?>" class="btn btn-xs btn-success"><i class="fas fa-check-circle"></i> Complete</a>
					<a href="../processes/orderprocesses.php?cancel=<?php echo $orow["order_id"];?>" onClick="return confirm('Are you sure you want to cancel order?');" class="btn btn-xs btn-danger"><i class="fa fa-times-circle"></i> Cancel</a>
					</td>
                  </tr>
					<?php }}?>
                 </tbody>
                </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <?php include "includes/footer.php";?>
  <!-- ./Main Footer -->
</div>
<!-- ./wrapper -->

<!-- MODALS -->

<div class="modal fade" id="modal-ord">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Order Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="odetails">
				
				
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>  
 $(document).ready(function(){  
      $('.view_ord').click(function(){  
           var ord_id = $(this).attr("id");  
           $.ajax({  
                url:"order_row.php",  
                method:"POST",  
                data:{ord_id:ord_id},  
                success:function(data){  
                     $('#odetails').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
</body>
</html>
