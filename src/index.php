<?php
	session_start();
	
	include("connection.php");
	include("functions.php");
	
	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
	<body>

		<h1>This is THE index page.</h1>
		<p>Hello, <?php echo $user_data['user_name'];?> If you are here then you have successfully logged in!</p>
		<?php 
			if ($user_data['is_administrator'])
				echo '<a href="crud.php">You are logged in as an administrator, click here to see the CRUD page.</a><br><br>';
 		?>
		<a href="logout.php">Log out</a>

	</body>
</html>
