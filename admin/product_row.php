<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['desc_id'])){
		$id = $_POST['desc_id'];
		

		$stmt = "SELECT * FROM product WHERE product_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		echo '
		<h3>'.$row["name"].'</h3>
		<p>
		'.$row["description"].'
		</p>';
	}
?>