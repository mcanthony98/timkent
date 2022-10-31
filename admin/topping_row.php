<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['t_id'])){
		$id = $_POST['t_id'];
		

		$stmt = "SELECT * FROM topping WHERE topping_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		echo '
			 <div class="form-group" >
			 <label for="edit_name">Add-On Name</label>
             <input type="text" class="form-control" value="'.$row["topping_name"].'" name="name" >
			 </div>
			 <div class="form-group" >
			 <label for="price">Add-On Price</label>
             <input type="number" class="form-control" value="'.$row["price"].'" name="price" >
			 </div>
			 <input type="hidden" class="catid" value="'.$row["topping_id"].'" name="id">
		';
	}
?>