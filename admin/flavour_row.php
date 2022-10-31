<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['flavour_id'])){
		$id = $_POST['flavour_id'];
		

		$stmt = "SELECT * FROM flavour WHERE flavour_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		echo '
			 <label for="edit_name">Flavour Name</label>
             <input type="text" class="form-control" value="'.$row["flavour_name"].'" name="cat_name" >
			 <input type="hidden" class="catid" value="'.$row["flavour_id"].'" name="cat_id">
		';
	}
?>