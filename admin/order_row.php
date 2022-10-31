<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['ord_id'])){
		$id = $_POST['ord_id'];
		

		$ord = "SELECT * FROM orders WHERE order_id = '$id'";
		$ores = $pdo->query($ord);
		$orow = $ores->fetch_assoc();
		
		$stmt = 'SELECT * FROM product WHERE product_id ='.$orow["product_id"].'';
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		$tqry = 'SELECT * FROM topping WHERE topping_id ='.$orow["topping_id"].'';
		$tres = $pdo->query($tqry);
		$trow = $tres->fetch_assoc();
		
		$uqry = 'SELECT * FROM users WHERE user_id ='.$orow["user_id"].'';
		$ures = $pdo->query($uqry);
		$urow = $ures->fetch_assoc();
		
		$output = '
			<h5>Product</h5>
				<div class="row">
					<div class="col-md-2">
					<img src="../products/'.$row["image"].'" style="max-width:100px;max-height:100px">
					</div>
					<div class="col-md">
					<h4 style="padding-top:40px" class="text-fuchsa">'.$row["name"].'</h4>
					<h6 style="padding-to:70px" class="text-fuchsi">Ksh '.$row["price"].'</h6>
					</div>
				</div>
				<hr>
				<h5>Order Info</h5>
				<dl class="row">
				  <dt class="col-sm-2">Order</dt>
                  <dd class="col-sm-10">'.$orow["order_code"].'</dd>
				  <dt class="col-sm-2">ID</dt>
                  <dd class="col-sm-10">'.$orow["order_id"].'</dd>
                  <dt class="col-sm-2">Quantity</dt>
                  <dd class="col-sm-10">'.$orow["quantity"].' kg</dd>
                  <dt class="col-sm-2">Add-ons</dt>
                  <dd class="col-sm-10">'.$trow["topping_name"].'</dd>
                  <dt class="col-sm-2">Cake Text</dt>
                  <dd class="col-sm-10">'.$orow["text"].'</dd>
				  <dt class="col-sm-2">Delivery To</dt>
                  <dd class="col-sm-10">'.$orow["delivery_address"].'</dd>
                  <dt class="col-sm-2">Ordered</dt>
                  <dd class="col-sm-10">'.date('M d, Y', strtotime($orow["date_ordered"])).'</dd>
                </dl>
				<hr>
				<h5>Customer</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
					</thead>
					<tbody>
						<td>'.$urow["firstname"]. ' ' . $urow["lastname"].'</td>
						<td>'.$urow["email"].'</td>
						<td>'.$urow["phone"].'</td>
					</tbody>
				</table>
				
				
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="../processes/orderprocesses.php?complete='.$orow["order_id"].'"  class="btn btn-success">Complete Order</a>
              <a href="../processes/orderprocesses.php?cancel='.$orow["order_id"].'"  class="btn btn-danger" onClick="return confirm(\'Are you sure you want to cancel this order?\');">Cancel Order</a>
            </div>
		';
		
		echo $output;
	}
	elseif(isset($_POST['ord_code'])){
		$id = $_POST['ord_code'];
		
		$ord = "SELECT * FROM orders WHERE order_code = '$id'";
		$ores = $pdo->query($ord);
	
		$output = '
			<h5>'.$id.'</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<th>Order ID</th>
						<th colspan=2>Items</th>
						<th>Quantity</th>
						<th>Topping</th>
						<th>SubTotal</th>
					</thead>
					<tbody>
					';
		$total = 0;			
		while($orow = $ores->fetch_assoc()){	
			$stmt = 'SELECT * FROM product WHERE product_id ='.$orow["product_id"].'';
			$res = $pdo->query($stmt);
			$row = $res->fetch_assoc();
				
			$tqry = 'SELECT * FROM topping WHERE topping_id ='.$orow["topping_id"].'';
			$tres = $pdo->query($tqry);
			$trow = $tres->fetch_assoc();
				
			$subtotal = ($row["price"] * $orow["quantity"]) + $trow["price"];
			$total += $subtotal;
					
		$output .='			
						<tr>
						<td>'.$orow["order_id"].'</td>
						<td><img src="../products/'.$row["image"].'" style="max-height:75px;max-width:75px;"></td>
						<td>'.$row["name"].'</td>
						<td>'.$orow["quantity"].' kg</td>
						<td>'.$trow["topping_name"].'</td>
						<td>Ksh '.$subtotal.'</td>
						</tr>
						';
		}
		$output .='	
				<tr>
					<th colspan=5 class="text-right">Total</th>
					<th>Ksh '.$total.'</th>
				</tr>	
				</tbody>
				</table>
		';
	
		echo $output;
	}
?>