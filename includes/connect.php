<?php

define('DB_SERVER', 'srv497.hstgr.io');
define('DB_USERNAME', 'u640333703_timkents');
define('DB_PASSWORD', '!uoTZbOxkY3s');
define('DB_DATABASE', 'u640333703_timkents');

$pdo = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

//verify connection
	 if ($pdo->connect_error){
		 die("Connection Failed: <br />" .$pdo->connect_error);
	  }
 
//$pdo="";
?>