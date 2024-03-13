<?php


?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_styles.css">
		<title>Log In</title>
	</head>

	<body>

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
				<button class="confirmButton">Sign Up</button>
			</div>

			<div class = wrapper>
				<a class="changePageLink" href="login.php">Already have an account? Click here to Log In instead</a>
			</div>

		</div>
		
		<script src="../login_scripts.js"></script>

	</body>
</html>