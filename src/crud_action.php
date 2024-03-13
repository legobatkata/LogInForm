<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// something was posted
		$action_type = $_POST['action_type'];
		echo $action_type . " of " . $_POST['row_user_name'];
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