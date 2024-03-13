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
				<button class="loginButton">Log in</button>
			</div>

			<div class = wrapper>
				<a class="changePageLink" href="signup.php">Click here if you wish to create an account instead</a>
			</div>

		</div>
		
		<script src="../login_scripts.js"></script>

	</body>
</html>