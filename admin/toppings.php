<?php include "includes/head.php";?>
<?php include "includes/sessions.php";?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =7;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add-Ons</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-fuchsia" href="index.php">I-Bake</a></li>
              <li class="breadcrumb-item active">Add-ons</li>
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
              <div class="card-header">
				<div class="row">
			     <div class="col-6">
				 
                </div>
				<div class="col-6 float-right">
				 <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#modal-add">
                  <i class="fa fa-plus"></i> New
                </button>
				</div>
              </div>
             </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Add-On</th>
                    <th>Price</th>
                    <th>Operation</th>
                  </tr>
                  </thead>
                  <tbody>
				   <?php
					$tqry = "SELECT * FROM topping";
					$tres = $pdo->query($tqry);
					if($tres->num_rows == 0){
						
					}else{
					while($trow = $tres->fetch_assoc()){
				  ?>
                  <tr>
                    <td><?php echo $trow["topping_name"];?></td>
                    <td>Ksh <?php echo $trow["price"];?></td>
                    <td>
					<button type="button" class="btn btn-xs btn-info view_data"  id="<?php echo $trow["topping_id"]; ?>" data-toggle="modal" data-target="#modal-edit">
					  <i class="fas fa-pencil-alt"></i> Edit
					</button>
					<a href="../processes/addons.php?delete=<?php echo $trow["topping_id"];?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
					</td>
                  </tr>
					<?php } }?>
				  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

<!-- MODALS -->

<div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Add-On</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="../processes/addons.php" method="POST">
				  <div class="form-group">
                    <label for="exampleInputEmail1">Add-On Name</label>
                    <input type="text" class="form-control input-warning" name="addon" id="exampleInputEmail1" placeholder="Enter Add-On">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail2">Price</label>
                    <input type="number" class="form-control input-warning" name="price" id="exampleInputEmail2" placeholder="Enter Add-on Price">
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Add Add-On" name="add-addon" class="btn btn-warning">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  
	  <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Add-On</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<form action="../processes/addons.php" method="POST">
            <div class="modal-body" id="cat_details">
			
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Save Changes" name="edit-addon" class="btn btn-warning">
			  </form>
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
      $('.view_data').click(function(){  
           var t_id = $(this).attr("id");  
           $.ajax({  
                url:"topping_row.php",  
                method:"POST",  
                data:{t_id:t_id},  
                success:function(data){  
                     $('#cat_details').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
</body>
</html>
