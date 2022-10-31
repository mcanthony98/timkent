<?php
    session_start();
	require "../includes/connect.php";
	date_default_timezone_set("Africa/Nairobi");
    $date = date("m/d/Y g:iA");

	if (isset($_POST["login"])){
		$email = mysqli_real_escape_string($pdo, $_POST["email"]);
		$password = mysqli_real_escape_string($pdo, $_POST["password"]);
		$enc_password=md5($password);
		
		$loginqry = "SELECT * FROM users WHERE email='$email' AND password='$enc_password'";
		$loginres = $pdo->query($loginqry);

		if (isset($_POST["return"])){
			$ret = "?return=".$_POST["return"];
		}else{
			$ret = "";
		}
		
		if($loginres->num_rows < 1){
			$_SESSION["error"] = "Invalid email or Password";
			header ("Location: ../login.php$ret");
			exit ();
		}else{
			$loginrow = $loginres->fetch_assoc();
			$_SESSION["name"] = $loginrow["firstname"] ." ". $loginrow["lastname"];
			$_SESSION["email"] = $email;
			$type = $loginrow["type"];
			if($type == 1){
				$user_id = $loginrow["user_id"];
				$_SESSION["uid"] = $user_id;
				$ccode = $_COOKIE['cart'];
				$cartqry = "UPDATE cart SET user_id='$user_id' WHERE browser_id='$ccode'";
				$cartres = $pdo->query($cartqry);
				
				if (isset($_POST["return"])){
					header ("Location: ../".$_POST["return"]);
				}else{
					header ("Location: ../index.php");
				}
				exit ();
			}else{
				$_SESSION["adminid"] = $loginrow["user_id"];
				header ("Location: ../admin/index.php");
				exit ();
			}
		}
	}elseif (isset($_POST["register"])){
		$fname = mysqli_real_escape_string($pdo, $_POST["fname"]);
		$lname = mysqli_real_escape_string($pdo, $_POST["lname"]);
		$email = mysqli_real_escape_string($pdo, $_POST["email"]);
		$password = mysqli_real_escape_string($pdo, $_POST["password"]);
		$enc_password=md5($password);

		if (isset($_POST["return"])){
			$ret = "?return=".$_POST["return"];
		}else{
			$ret = "";
		}
		$chqry = "SELECT * FROM users WHERE email='$email'";
		$chkres = $pdo->query($chqry);

		if($chkres->num_rows > 0){
			$_SESSION['error'] = "Email already exists. Please Sign In.";
		}else{
			$qry = "INSERT INTO users(firstname, lastname, email, password, date_created) VALUES ('$fname', '$lname', '$email', '$enc_password', '$date')";
			$res = $pdo->query($qry);
			if($res === TRUE){
				$user_id = $conn->insert_id;
				$_SESSION['uid'] = $user_id;
				$_SESSION['name'] = $fname . " " . $lname;
				$_SESSION['email'] = $email;
				
				$ccode = $_COOKIE['cart'];
				$cartqry = "UPDATE cart SET user_id='$user_id' WHERE browser_id='$ccode'";
				$cartres = $pdo->query($cartqry);

				if (isset($_POST["return"])){
					header ("Location: ../".$_POST["return"]);
				}else{
					header ("Location: ../index.php");
				}
				exit ();


			}else{
				$_SESSION['error'] = "An Error Occured! Please Try Again.";
			}
		}
		header ("Location: ../login.php$ret");
		exit ();
	}
?>