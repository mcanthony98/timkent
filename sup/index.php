<?php 
header('Access-Control-Allow-Origin: *');
if(isset($_POST['text'])){
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'timkents_sup');
	define('DB_PASSWORD', 'qwertyuiop123456');
	define('DB_DATABASE', 'timkents_supuu');
	date_default_timezone_set("Africa/Nairobi");
	$date = date("Y-m-d H:i:s");

	$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	//verify connection
		if ($conn->connect_error){
			die("Connection Failed: <br />" .$conn->connect_error);
		}
 
	$text = $_POST['text'];

	$qry = "INSERT INTO text (text, datetime) VALUES ('$text', '$date')";
	$conn->query($qry);

	echo "good";

}
$dateT = date("Y-m-d");
if($dateT == "2023-03-08"){
	header ("Location: iwd.html");
	exit();
}
?>
<script>
let url = "https://type.fit/api/quotes";
fetch(url)
.then(function (response) {
	return response.json();
})
.then(function (data) {
	let a = Math.floor(Math.random() * 1600);
    let nextthought = document.getElementById("nextthought");
    nextthought.addEventListener("click", function () {
    var count = a++;
 
     displaythought(count, data);
   });
	displaythought(a, data);
});

function displaythought(index, data) {
let thought = document.getElementById("thought");

if (data[index].author == null) {
	data[index].author = "unknown";
}

let htmlthought = `<div class="alert alert-outline-primary">
			${data[index].text}<br>
			<span style="color:#00ffc5;">
				${data[index].author}
			</span>
		</div>`;
thought.innerHTML = htmlthought;
}

</script>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta
	name="viewport"
	content="width=device-width,
			initial-scale=1,
			shrink-to-fit=no"/>

	<!-- Bootstrap CSS -->
	<link
	rel="stylesheet"
	href=
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
	integrity=
"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
	crossorigin="anonymous"/>
	<link href=
"https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap"
	rel="stylesheet"/>

	<title>My Quotes</title>
	<style>
	body {
		font-family: "Chelsea Market", cursive;
	}
	</style>
</head>

<body style="background-color: pink; color: white">
	<div class="container">
	<div class="jumbotron text-center mt-4 bg-dark" >
		<h1 class="display-4" style="color:palevioletred;">Hello Babyy!</h1>
		<p class="lead" style="color: lightblue;">Here's Something From Daddy...</p>

		<hr class="my-4" />
		<div id="thought"></div>
		<div class="row">
		
        <button
			class="btn btn-outline-success btn-lg col-12 btn-block"
			role="button"
			id="nextthought">
			Ask Daddy For a New Quote
		</button>
		
		</div>
		<div class="container mt-3">
	
		</div>
	</div>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src=
"https://code.jquery.com/jquery-3.5.1.slim.min.js"
			integrity=
"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous">
	</script>
	<script src=
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
			integrity=
"sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
			crossorigin="anonymous">
	</script>
	
</body>
</html>
