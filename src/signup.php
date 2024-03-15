<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$user_email = $_POST['emailField'];
		$user_name = $_POST['usernameField'];
		$user_pass = $_POST['passwordField'];
		
		if($user_name && $user_email && $user_pass){
			if(!userOrEmailExistsInDb($con, $user_name, $user_email)){
				// user doesnt exist, continue as normal
				
				// save user data to database
				$register_query = "insert into users (user_email, user_name, user_pass) values ('$user_email', '$user_name', '$user_pass')";
				mysqli_query($con, $register_query);
				
				// get the user id from the database
				$getid_query = "select * from users where user_email = '$user_email'";
				$result = mysqli_query($con, $getid_query);
				
				if($result && mysqli_num_rows($result) > 0){
					$result_data = mysqli_fetch_assoc($result);
					sendАuthЕmail($user_email, $result_data['user_id']);
				} else echo "error while sending email";
				
				
				header("Location: login.php");
				die;
			} else {
				// alert the user that name/mail is taken
				$taken_usr_errtext = "Username or email is already taken";
			}
		} else $invalid_usr_errtext = "Please enter valid information";			

	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_signup_styles.css">
		<title>Sign Up</title>
	</head>

	<body>


		<form method="POST">

			<div class="loginDiv">

				<div class="wrapper">
					<p class="fieldText">email:</p>
					<input class="fieldInput" id="emailField" name="emailField" type="text"></input>
				</div>
				<p class="warnText" id="invalidEmailText">Email is not valid!</p>
				<p class="warnText" id="tooLongEmailText">Email is too long!</p>

				<div class="wrapper">
					<p class="fieldText">username:</p>
					<input class="fieldInput" id="usernameField" name="usernameField" type="text"></input>
				</div>
				<p class="warnText" id="invalidUsernameText">Username is not valid!</p>
				<p class="warnText" id="tooLongUsernameText">Username is too long!</p>
				<p class="warnText" id="tooShortUsernameText">Username is too short!</p>
				
				<div class = wrapper>
					<p class="fieldText">password:</p>
					<input class="fieldInput" id="passwordField" name="passwordField" type="password"></input>
				</div>
				<p class="warnText" id="passStrengthText">Password strength is: </p>
				<p class="warnText" id="tooLongPasswordText">Password is too long!</p>
				<p class="warnText" id="tooShortPasswordText">Password is too short!</p>

				<div class = wrapper>
					<input class="confirmButton" id="submitButton" value="Sign Up" type="submit" disabled>
				</div>

				<div class = wrapper>
					<a class="changePageLink" href="login.php">Already have an account? Log In</a>
				</div>
				
				

			</div>
			
			<div class = "bottomMessage" <?php if(!$taken_usr_errtext && !$invalid_usr_errtext) echo "hidden";?>>
				<p class = "bottomErrorText"><?php echo $taken_usr_errtext;?></a>
				<p class = "bottomErrorText"><?php echo $invalid_usr_errtext;?></a>
			</div>
			
		</form>
		
		<script src="js/signup_scripts.js"></script>

	</body>
</html>