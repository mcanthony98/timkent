<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['img_id'])){
		$id = $_POST['img_id'];
		

		$stmt = "SELECT * FROM prod_img WHERE img_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		echo '
        <img class="elevation2 img-fluid" src="../products/'.$row['image'].'">
		';
	}
?>