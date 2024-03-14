<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	// if a user without admin privileges enters, return them to the index page.
	if(!$user_data['is_administrator']){
		header("Location: index.php");
		die;
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	
		if($_POST['btn_apply']) {
			$new_user_id = $_POST['new_user_id'];
			$new_user_email = $_POST['new_user_email'];
			$new_user_name = $_POST['new_user_name'];
			$new_user_pass = $_POST['new_user_pass'];
			$new_date = $_POST['new_date'];
			$new_is_authenticated = $_POST['new_is_authenticated'];
			$new_is_administrator = $_POST['new_is_administrator'];
			
			$create_query = 
			"insert into `users`(`user_id`, `user_email`, `user_name`, `user_pass`, `date`, `is_authenticated`, `is_administrator`) 
			values ('$new_user_id', '$new_user_email', '$new_user_name', '$new_user_pass', '$new_date', '$new_is_authenticated', '$new_is_administrator')";
			
			$result = mysqli_query($con, $create_query);
		}
		header("Location: crud.php");
		die;
		
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
			<label>new id:</label><br>
			<input name="new_user_id"> </input><br>
			<label>new email:</label><br>
			<input name="new_user_email"> </input><br>
			<label>new username:</label><br>
			<input name="new_user_name"> </input><br>
			<label>new password:</label><br>
			<input name="new_user_pass"> </input><br>
			<label>new date:</label><br>
			<input name="new_date"> </input><br>
			<label>new is_auth:</label><br>
			<input name="new_is_authenticated"> </input><br>
			<label>new is_admin:</label><br>
			<input name="new_is_administrator"> </input><br>
			<br>
			<input type="submit" name="btn_cancel" value="cancel"> </input>
			<input type="submit" name="btn_apply" value="apply"> </input><br>
		</form>
		
		<script src="js/login_scripts.js"></script>

	</body>
</html>