<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// something was posted
		$user_email = $_POST['emailField'];
		$user_name = $_POST['usernameField'];
		$user_pass = $_POST['passwordField'];
		
		if(!empty($user_name) && !empty($user_pass)){
			
			// save user data to database
			$register_query = "insert into users (user_email, user_name, user_pass) values ('$user_email', '$user_name', '$user_pass')";
			mysqli_query($con, $register_query);
			
			// get the user id from the database
			$getid_query = "select * from users where user_email = '$user_email'";
			$result = mysqli_query($con, $getid_query);
			
			if($result && mysqli_num_rows($result) > 0){
				$result_data = mysqli_fetch_assoc($result);
				send_auth_email($user_email, $result_data['user_id']);
			} else echo "error while sending email";
			
			
			header("Location: login.php");
			die;
		} else {
			echo "please enter a valid username and password";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_styles.css">
		<title>Sign Up</title>
	</head>

	<body>


		<form method="POST">

			<div class="loginDiv">

				<div class="wrapper">
					<p class="fieldText">email:</p>
					<input class="fieldInput" name="emailField" type="text"></input>
				</div>

				<div class="wrapper">
					<p class="fieldText">username:</p>
					<input class="fieldInput" name="usernameField" type="text"></input>
				</div>
				
				<div class = wrapper>
					<p class="fieldText">password:</p>
					<input class="fieldInput" name="passwordField" type="password"></input>
				</div>

				<div class = wrapper>
					<input class="confirmButton" type="submit" value="Sign Up">
				</div>

				<div class = wrapper>
					<a class="changePageLink" href="login.php">Already have an account? Log In</a>
				</div>

			</div>
		</form>
		
		<script src="js/login_scripts.js"></script>

	</body>
</html>