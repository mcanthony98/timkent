<?php include "includes/head.php";?>
<?php include "includes/sessions.php";?>
<?php 
if (!isset($_GET["product"])){
	header('location products.php');
	exit();
}else{
	$p_id = $_GET["product"];
	$stmt = "SELECT * FROM product WHERE product_id = '$p_id'";
	$res = $pdo->query($stmt);
	$row = $res->fetch_assoc();
  $cat = $row['category_id'];
	
}
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =4;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-info" href="index.php">Timkent</a></li>
              <li class="breadcrumb-item"><a class="text-info" href="products.php">Products</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
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
	
	    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="modal-content">
            <div class="modal-body">
			<div class="row">
				<div class="offset-8 col-4">
					<?php if($row["status"] == 0){?>
					<form method="POST" action="../processes/productprocesses.php">
					<div class="form-group float-right">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" checked OnInput = "this.form.submit();" class="custom-control-input" id="customSwitch3">
					  <input type="hidden" value="<?php echo $p_id;?>" name="status-edit0"   required>
                      <label class="custom-control-label" for="customSwitch3">Product is Active!</label>
                    </div>
                  </div>
				  </form>
					<?php }elseif($row["status"] == 1){ ?>
					<form method="POST" action="../processes/productprocesses.php">
					<div class="form-group float-right">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" OnInput = "this.form.submit();" class="custom-control-input" id="customSwitch3">
					  <input type="hidden" value="<?php echo $p_id;?>" name="status-edit1"   required>
                      <label class="custom-control-label" for="customSwitch3">Product is Disabled!</label>
                    </div>
                  </div>
				  </form>
					<?php } ?>
				</div>
			</div>
			<hr>
				<form action="../processes/productprocesses.php" method="POST" >
				<div class="row">
				  <div class="col-6">
				  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" value="<?php echo $row["name"];?>" name="name" id="exampleInputEmail1" required>
                  </div>
                  </div>
                  <div class="col-6">
					<label>Price</label>
                    <div class="input-group form-group">
					  <div class="input-group-prepend">
						<span class="input-group-text">Ksh</span>
					  </div>
					  <input type="number" value="<?php echo $row["price"];?>" name="price" class="form-control" required>
					  <div class="input-group-append">
						<span class="input-group-text">.00</span>
					  </div>
					</div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="cat" class="form-control" required>
						  <?php
							$catqry = "SELECT * FROM category";
								$cat_res = $pdo->query($catqry);
								if($cat_res->num_rows == 0){
									echo '<option value="0">No Categories Availables</option>';
								}else{
								if($cat == 0){
									echo '<option value="0">No Category Chosen</option>';
								}else{	
								$cqry = "SELECT * FROM category WHERE category_id='$cat'";
								$cres = $pdo->query($cqry);
								$crow = $cres->fetch_assoc();
									echo '<option value="'.$cat.'">'.$crow["category_name"].'</option>';
								}
								while($carow = $cat_res->fetch_assoc()){
						  ?>
                          <option value="<?php echo $carow["category_id"];?>"><?php echo $carow["category_name"];?></option>
								<?php } } ?>
						  <option value="0">None</option>
                        </select>
                      </div>
                  </div>
				  <div class="col-6">
          <div class="form-group">
                    <label for="exampleInputEmail12">Quantity in Stock</label>
                    <input type="number" class="form-control" value="<?php echo $row["quantity"];?>" name="qty" id="exampleInputEmail12" required>
                  </div>
                  </div>
				  <div class="col-12">
					<label>Description</label>
                    <textarea class="form-control" name="desc" rows="8" required ><?php echo $row["description"];?></textarea>
                  </div>
				  <input type="hidden" value="<?php echo $p_id;?>" name="pid"  required>
                </div>  
            </div>
            <div class="modal-footer justify-content-between">
			  <a href="product_more.php?product=<?php echo $p_id;?>" class="btn btn-default"> << Back to Product</a>
              <input type="submit" value="Save Changes" name="edit-product" class="btn btn-info">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    <?php include "includes/footer.php";?>
  <!-- ./Main Footer -->
</div>
<!-- ./wrapper -->

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
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
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
</body>
</html>
