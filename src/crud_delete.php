<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	$current_user_data = check_login($con);
	// if a user without admin privileges enters, return them to the index page.
	if(!$current_user_data['is_administrator']){
		header("Location: index.php");
		die;
	}
	
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
		<link rel="stylesheet" href="../css/crud_styles.css">
		<title>Delete Entry</title>
	</head>

	<body>

		<div class="borderDivSmall">
			<form method="POST">
				<br>
				<div class="wrapper">
					<label>Are you sure you wish to delete the user with id <?php echo $search_user_id?></label>
					<input class= "titleText" type="hidden" name="to_delete_id" value=<?php echo $search_user_id?>></input>
				</div>
				
				<div class="wrapper">
					<input class="actionButton" type="submit" name="btn_cancel" value="cancel"> </input>
					<input class="actionButton" type="submit" name="btn_apply" value="apply"> </input>
				</div>
			</form>
		</div>

	</body>
</html>