<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		// something was posted
		$action_type = $_GET['action_type'];
		echo $action_type . " of " . $_GET['user_id'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_styles.css">
		<title>Edit Entry</title>
	</head>

	<body>


		<form method="POST">
			
		</form>
		
		<script src="js/login_scripts.js"></script>

	</body>
</html>