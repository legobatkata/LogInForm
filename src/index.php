<?php
	session_start();
	
	include("php/connection.php");
	include("php/functions.php");
	
	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
	<body>

		<h1>This is THE index page.</h1>
		<p>If you are here then you have successfully logged in!</p>
		<a href="php/logout.php">Log out</a>

	</body>
</html>
