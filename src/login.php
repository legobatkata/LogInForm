<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// something was posted
		$user_name = $_POST['usernameField'];
		$user_pass = $_POST['passwordField'];
		
		if(!empty($user_name) && !empty($user_pass)){
			// read from databse
			$user_id = generate_user_id();
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);
			
			if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
				if($user_data['user_pass'] === $user_pass){
					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: index.php");
					die;
				}
			} else {
				echo "wrong username or password!";
			}
		} else {
			echo "please enter a valid username and password!";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_styles.css">
		<title>Log In</title>
	</head>

	<body>


		<form method="POST">
			<div class="loginDiv">

				<div class="wrapper">
					<p class="fieldText">username:</p>
					<input class="fieldInput" name="usernameField"></input>
				</div>
				
				<div class = wrapper>
					<p class="fieldText">password:</p>
					<input class="fieldInput" name="passwordField" type="password"></input>
				</div>

				<div class = wrapper>
					<input class="confirmButton" type="submit" value="Log In">
				</div>

				<div class = wrapper>
					<a class="changePageLink" href="signup.php">Create new account</a>
				</div>

			</div>
		</form>
		
		<script src="js/login_scripts.js"></script>

	</body>
</html>