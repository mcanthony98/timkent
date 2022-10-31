<?php include "includes/head.php";?>
<?php include "includes/sessions.php";?>
<?php 
if (!isset($_GET["product"])){
	header('location: products.php');
	exit();
}else{
	$p_id = $_GET["product"];
	$stmt = "SELECT * FROM product WHERE product_id = '$p_id'";
	$res = $pdo->query($stmt);
	$row = $res->fetch_assoc();
	$cat = $row["category_id"];
	
	$cqry = "SELECT * FROM category WHERE category_id='$cat'";
	$cres = $pdo->query($cqry);
	$crow = $cres->fetch_assoc(); 
		
  $imgqry = "SELECT * FROM prod_img WHERE product_id='$p_id' ORDER BY type ASC";
  $imgres = $pdo->query($imgqry);

  $topimgqry = "SELECT * FROM prod_img WHERE product_id='$p_id' ORDER BY type ASC LIMIT 1";
  $topimgres = $pdo->query($topimgqry);
  if($topimgres->num_rows < 1){
    $topimg = "placeholder.png";
  }else{
    $topimgrow = $topimgres->fetch_assoc();
    $topimg = $topimgrow['image'];
  }
  
 
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
            <h1 class="m-0 text-dark">Product Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-info" href="index.php">Timkent</a></li>
              <li class="breadcrumb-item"><a class="text-info" href="products.php">Products</a></li>
              <li class="breadcrumb-item active">Product Details</li>
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
            
            <div class="card">
              <div class="card-body">
                <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-default">
                <div class="widget-user-image">
                  <img class="elevation2" src="../products/<?php echo $topimg;?>" style="max-width:100px;max-height:100px;" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username" style="text-transform:capitalize;"><?php echo $row["name"];?></h3>
                <div class="float-right">
                  <a href="product_edit.php?product=<?php echo $p_id;?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                  <a href="#" onclick="del()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Delete</a>
                </div>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                      Product Name <span class="float-right"><?php echo $row["name"];?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                      Price <span class="float-right">Ksh <?php echo $row["price"];?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                      Category <span class="float-right"><?php echo $crow["category_name"];?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                      Quantity Remaining <span class="float-right"><?php echo $row["quantity"];?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                      Status <span class="float-right"><?php if($row["status"] == 0){ echo '<span class="badge bg-success">Active</span>'; }else{ echo '<span class="badge bg-danger">Disabled</span>'; }?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                      Date Created <span class="float-right"><?php echo date('M d, Y', strtotime($row["date_created"]));?></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
			<h6>Description</h6>
			<p>
				<textarea class="form-control" readonly rows="10"><?php echo $row["description"];?></textarea>
			<p>
			
              </div>
              <!-- /.card-body -->  
            </div>
            <!-- /.card -->


            <div class="card">
              <div class="card-header">
                <h4>Product Images</h4>
              </div>
              <div class="card-body" id="images">
                <div class="row">
                  <?php while($imgrow = $imgres->fetch_assoc()){?>
                  <div class="col-sm-3 mb-2">
                    <a href="#" class="img_selection" id="<?php echo $imgrow['img_id'];?>" data-toggle="modal" data-target="#modal-img">
                      <img class="elevation2 img-fluid " src="../products/<?php echo $imgrow['image'];?>"  alt="Not Found">
                    </a>
                  </div>
                  <?php } ?>

                  <div class="col-sm-3 mb-2 rounded">
                    <form action="../processes/productprocesses.php" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                      <div class="profile-btn text-center">
                        <div class="btn  btn-light text-primary mb-2 btn-file">
                          <img class="elevation2 img-fluid " src="../products/addimg.jpg" alt="User Avatar" >
                            <input type="file" name="photos" oninput="this.form.submit();">
                        </div>
                      </div>
                      <input type="hidden" value="<?php echo $p_id;?>" name="prod_id_img">
                    </form>  
                  </div>
                  
              </div>
            </div>
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



<div class="modal fade" id="modal-img">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
            <h6 class="modal-title">Product Image</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center" id="pic">
              <img class="elevation2 img-fluid" src="../products/placeholder.png">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" onclick="imgFunc(0)" class="btn btn-info" >Make Default</button>
              <button type="button" onclick="imgFunc(1)" class="btn btn-danger" >Delete</button>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    var clkimg; 
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

<script> 
 $(document).ready(function(){  
      $('.img_selection').click(function(){  
           var img_id = $(this).attr("id");  
           clkimg = img_id;
           $.ajax({  
                url:"image_row.php",  
                method:"POST",  
                data:{img_id:img_id},  
                success:function(data){  
                     $('#pic').html(data);  
                }  
           });  
      });  
 });  
 </script>
 <script>
  function del(){
      swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this product !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        location.replace("../processes/productprocesses.php?delete=<?php echo $p_id;?>");
      } else {
        swal("Your product is safe! Deletion Cancelled!");
      }
    });
  }
 </script> 
 
 <script>
  function imgFunc(f){
    if(f==0){
      location.replace("../processes/productprocesses.php?pid=<?php echo $p_id;?>&def="+clkimg);
    }
    if(f==1){
      location.replace("../processes/productprocesses.php?pid=<?php echo $p_id;?>&imgdel="+clkimg)
    }
  }
 </script> 
 
</body>
</html>
