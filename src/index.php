<?php
	session_start();
	
	include("connection.php");
	include("functions.php");
	
	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/index_styles.css">
		<title>Main Page</title>
	</head>

	<body>

		<div class="borderDiv">
			
			<h1 class="titleText">This is THE index page.</h1>
			<p class="greetingText">Hello, <strong><?php echo $user_data['user_name'];?></strong> If you are here then you have successfully logged in!</p>
			<?php 
				if ($user_data['is_administrator']) 
					echo '<a class="linkText" href="crud.php">You are logged in as an administrator, click here to see the CRUD page.</a><br><br>';
			?>
			<a class="linkText" href="logout.php">Log out</a>
			
		</div>

		

	</body>
</html>
