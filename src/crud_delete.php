<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$search_user_id = $_GET['user_id'];
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$search_user_id = $_POST['to_delete_id'];
		if($_POST['btn_apply']) {
			$delete_query = "delete from `users` where `users`.`user_id` = '$search_user_id'";
			$result = mysqli_query($con, $delete_query);	
		}
		header("Location: crud.php");
		die;
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/login_styles.css">
		<title>Edit Entry</title>
	</head>

	<body>


		<form method="POST">
			<label>Are you sure you wish to delete the user with id <?php echo $search_user_id?></label><br>
			<input type="hidden" name="to_delete_id" value=<?php echo $search_user_id?>></input>
			<input type="submit" name="btn_cancel" value="cancel"> </input>
			<input type="submit" name="btn_apply" value="apply"> </input><br>
		</form>
		
		<script src="js/login_scripts.js"></script>

	</body>
</html>