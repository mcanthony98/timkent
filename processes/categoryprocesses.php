<?php
	 session_start();
    require "../includes/connect.php";
	
	if(isset($_POST["add-category"])){
		$cat = mysqli_real_escape_string($pdo, $_POST["cat"]);
		
		$cat_insert = "INSERT INTO category(category_name) VALUES ('$cat')";
		
		if ($pdo->query($cat_insert)===TRUE){
			  
			  $_SESSION["success"] = "New Category Created Sucessfully.";
			  header('location: ../admin/categories.php');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/categories.php');
		  }
		
	}
	elseif(isset($_GET["delete"])){
		$cat_id = $_GET["delete"];
		
		$dltqry = "DELETE FROM category WHERE category_id = '$cat_id'";
		
		if ($pdo->query($dltqry)===TRUE){
			  
			  $_SESSION["success"] = "Category Deleted Sucessfully.";
			  header('location: ../admin/categories.php');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/categories.php');
		  }
		
		
	}elseif(isset($_POST["edit-category"])){
		$cat_id = mysqli_real_escape_string($pdo, $_POST["cat_id"]);
		$cat_name = mysqli_real_escape_string($pdo, $_POST["cat_name"]);
		
		$updqry = "UPDATE category SET category_name='$cat_name' WHERE category_id = '$cat_id'";
		
		if ($pdo->query($updqry)===TRUE){
			  
			  $_SESSION["success"] = "Category Updated Sucessfully.";
			  header('location: ../admin/categories.php');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/categories.php');
		  }
	}
?>