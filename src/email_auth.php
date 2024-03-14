<?php
	session_start();
	
	include("connection.php");
	include("functions.php");
	
	$infotext = "";
	
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		// something was posted
		$user_id = $_GET['user_id'];
		
		$set_auth_query = "update `users` set `is_authenticated` = '1' where `users`.`user_id` = '$user_id';";
		$auth_result = mysqli_query($con, $set_auth_query);
		
		if(auth_result) {
			$infotext = "Your Account has been authenticated successfully";
		} else $infotext = "Error in authenticating account";
		
	} else $infotext = "Error in recieving User ID";

?>

<!DOCTYPE html>
<html>
	<body>

		<h1><?php echo $infotext?></h1>
		<a href="login.php">Log in</a>

	</body>
</html>
