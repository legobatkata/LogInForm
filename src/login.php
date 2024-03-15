<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$user_name = $_POST['usernameField'];
		$user_pass = $_POST['passwordField'];
		
		if(!empty($user_name) && !empty($user_pass)){
			// get user data
			$query = "select * from `users` where `user_name` = '$user_name' or `user_email` = '$user_name'";
			$result = mysqli_query($con, $query);
			
			// check if password matches
			if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
				if($user_data['user_pass'] === $user_pass){
					
					if($user_data['is_authenticated']){
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					} else echo $acc_not_auth_errtext = "account is not authenticated yet, please check your email!";
					
				} else echo $wrong_user_errtext = "wrong username or password!";
				
			} else echo $database_errtext = "error, could not read from database!";
			
		} else echo $invalid_data_errtext = "please enter a valid username and password!";
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_signup_styles.css">
		<title>Log In</title>
	</head>

	<body>


		<form method="POST">
			<div class="loginDiv">

				<div class="wrapper">
					<p class="fieldText">user:</p>
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
			
			<div class = "bottomMessage" <?php if(!$acc_not_auth_errtext && !$wrong_user_errtext && !$database_errtext && !$invalid_data_errtext) echo "hidden";?>>
				<p class = "bottomErrorText"><?php echo $acc_not_auth_errtext;?></a>
				<p class = "bottomErrorText"><?php echo $wrong_user_errtext;?></a>
				<p class = "bottomErrorText"><?php echo $database_errtext;?></a>
				<p class = "bottomErrorText"><?php echo $invalid_data_errtext;?></a>
			</div>
			
		</form>
		
		<script src="js/login_scripts.js"></script>

	</body>
</html>