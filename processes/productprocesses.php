<?php
	 session_start();
    require "../includes/connect.php";
	
	if(isset($_POST["add-product"])){
		$name = mysqli_real_escape_string($pdo, $_POST["name"]);
		$price = mysqli_real_escape_string($pdo, $_POST["price"]);
		$cat = mysqli_real_escape_string($pdo, $_POST["cat"]);
		$qty = mysqli_real_escape_string($pdo, $_POST["qty"]);
		$desc = mysqli_real_escape_string($pdo, $_POST["desc"]);
		$slug = str_replace(' ', '+', strtolower($name));
		
		date_default_timezone_set("Africa/Nairobi");
	    $ddate = date("Y_m_d_H_i_s");	
		$thisdate = date("Y-m-d H:i:s");
		
		
		
			 $status = 0;
			 $products_insert = "INSERT INTO product(name, slug, description, price, category_id, quantity,status, date_created) VALUES ('$name', '$slug', '$desc', '$price', '$cat', '$qty', '$status', '$thisdate')";
			 if ($pdo->query($products_insert)===TRUE){
				$pid = $pdo->insert_id;
				$msg="Item added successfully";
				$_SESSION["success"] = $msg;
				header('location: ../admin/product_more.php?product='.$pid);
				
			 }else{
				 $err= "Unable to upload Item. <br/>" . $pdo->error;
		         $_SESSION["error"] = $err;
				 header('location: ../admin/products.php');
			 }
		
			
	}elseif(isset($_POST['prod_id_img'])){
		$pid = mysqli_real_escape_string($pdo, $_POST["prod_id_img"]);
		$image = $_FILES['photos']['tmp_name'];
		$imgContent = addslashes(file_get_contents($image));
		
		date_default_timezone_set("Africa/Nairobi");
		$ddate = date("Y_m_d_H_i_s");	
		$thisdate = date("Y-m-d H:i:s");
		
		$file_name = $_FILES["photos"]["name"];
		$_FILES["photos"]["type"];
		$tmp_file = $_FILES["photos"]["tmp_name"];
		
		$destination = "../products/" . $file_name;
		
		move_uploaded_file($tmp_file, $destination);
		$new = $ddate.$file_name;
		$new_name = rename('../products/'.$file_name , '../products/'.$new);
		
		if($new_name === TRUE){
			$chkqry = "SELECT * FROM prod_img WHERE product_id='$pid' AND type=0";
			$chkres = $pdo->query($chkqry);
			if($chkres->num_rows == 0){
				$type = 0;
			}else{
				$type = 1;
			}

			$insqry = "INSERT INTO prod_img (image, type, product_id) VALUES ('$new', '$type', '$pid')";
			$pdo->query($insqry);
		}
		header('location: ../admin/product_more.php?product='.$pid.'#images');

	}elseif(isset($_POST['imagesingle'])){
		$id = $_POST['imagesingle'];

		$res = $pdo->query("SELECT * FROM prod_img WHERE img_id='$id'");
		$row = $res->fetch_assoc();

		echo json_encode($row);

	}
	
		
	elseif(isset($_GET["delete"])){
		$id = $_GET["delete"];
		
		$dltqry = "DELETE FROM product WHERE product_id = '$id'";
		
		if ($pdo->query($dltqry)===TRUE){
			  
			  $_SESSION["success"] = "Product Deleted Sucessfully.";
			  header('location: ../admin/products.php');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/products.php');
		  }
		
		
	}elseif(isset($_POST["edit-product"])){
		$id = mysqli_real_escape_string($pdo, $_POST["pid"]);
		$name = mysqli_real_escape_string($pdo, $_POST["name"]);
		$price = mysqli_real_escape_string($pdo, $_POST["price"]);
		$qty = mysqli_real_escape_string($pdo, $_POST["qty"]);
		$cat = mysqli_real_escape_string($pdo, $_POST["cat"]);
		$desc = mysqli_real_escape_string($pdo, $_POST["desc"]);
		$slug = str_replace(' ', '+', strtolower($name));
		
		$updqry = "UPDATE product SET name='$name', price='$price', slug='$slug', quantity='$qty', category_id='$cat', description='$desc' WHERE product_id = '$id'";
		
		if ($pdo->query($updqry)===TRUE){
			  
			  $_SESSION["success"] = "Product Details Updated Sucessfully.";
			  header('location: ../admin/product_edit.php?product='.$id.'');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/product_edit.php?product='.$id.'');
		  }
		  exit();
	}
	
	if(isset($_POST["image-id-edit"])){
		$id = mysqli_real_escape_string($pdo, $_POST["image-id-edit"]);
		$image = $_FILES['photos']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
				
		date_default_timezone_set("Africa/Nairobi");
	    $ddate = date("Y_m_d_H_i_s");	
		$thisdate = date("Y-m-d H:i:s");
		
		$file_name = $_FILES["photos"]["name"];
	      $_FILES["photos"]["type"];
	      $tmp_file = $_FILES["photos"]["tmp_name"];
		
		   $destination = "../products/" . $file_name;
		
		move_uploaded_file($tmp_file, $destination);
		$new = $ddate.$file_name;
		$new_name = rename('../products/'.$file_name , '../products/'.$new);
		
		if($new_name === TRUE){
			
			  $products_insert = "UPDATE product SET image = '$new' WHERE product_id = '$id'";
			 if ($pdo->query($products_insert)===TRUE){
				
				$msg="Image updated successfully";
				$_SESSION["success"] = $msg;
				
			 }else{
				 $err= "Unable to upload Image. <br/>" . $pdo->error;
		         $_SESSION["error"] = $err;
			 }
		}else{ 
			$err= "An error occured. Please try again. <br/>" . $pdo->error;
		    $_SESSION["error"] = $err;
		}
		
		header('location: ../admin/product_edit.php?product='.$id.'');
		}
		
		elseif(isset($_POST["status-edit0"])){
		$id = mysqli_real_escape_string($pdo, $_POST["status-edit0"]);
		$state = 1;
		
		$updqry = "UPDATE product SET status='$state' WHERE product_id = '$id'";
		
		if ($pdo->query($updqry)===TRUE){
			  
			  $_SESSION["success"] = "Status Updated Sucessfully. Product will not be visible to customers.";
			  header('location: ../admin/product_edit.php?product='.$id.'');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/product_edit.php?product='.$id.'');
		  }
	}
	elseif(isset($_POST["status-edit1"])){
		$id = mysqli_real_escape_string($pdo, $_POST["status-edit1"]);
		$state = 0;
		
		$updqry = "UPDATE product SET status='$state' WHERE product_id = '$id'";
		
		if ($pdo->query($updqry)===TRUE){
			  
			  $_SESSION["success"] = "Status Updated Sucessfully. Product is now visible to customers.";
			  header('location: ../admin/product_edit.php?product='.$id.'');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			  header('location: ../admin/product_edit.php?product='.$id.'');
		  }
	}
	elseif(isset($_GET["imgdel"])){
		$id = $_GET["pid"];
		$img = $_GET["imgdel"];

		$qry = "DELETE FROM prod_img WHERE img_id='$img'";
		if ($pdo->query($qry)===TRUE){
			  
			$_SESSION["success"] = "Image deleted successfully!";
			header('location: ../admin/product_more.php?product='.$id.'');
			
		}else{
			$_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			header('location: ../admin/product_more.php?product='.$id.'');
		}
	
	}
	elseif(isset($_GET["def"])){
		$id = $_GET["pid"];
		$img = $_GET["def"];

		$otherqry = "UPDATE prod_img SET type='1' WHERE product_id='$id'";
		$pdo->query($otherqry);
		
		$qry = "UPDATE prod_img SET type='0' WHERE img_id='$img'";
		if ($pdo->query($qry)===TRUE){
			
			
			$_SESSION["success"] = "Image made to default successfully!";
			header('location: ../admin/product_more.php?product='.$id.'');
			
		}else{
			$_SESSION["error"] = "Error Occured. Please Try Again". $pdo->error;
			header('location: ../admin/product_more.php?product='.$id.'');
		}
	
	}
?>