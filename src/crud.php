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
	
	$all_users_query = "SELECT * FROM users";
	$all_users_result = mysqli_query($con, $all_users_query);
	
	function createRowEntry($entry_info){
		return "<td>" . htmlspecialchars($entry_info) . "</td>";		
	}
	
	function createTableRow($row_info){
		$result = "<tr>";
		foreach ($row_info as $entry){
			$result .= createRowEntry($entry);
		}
		$result .="<td><a href=\"crud_edit.php?user_id=" . $row_info['user_id'] . ";\">edit</a></td>";
		$result .= "<td><a href=\"crud_delete.php?user_id=" . $row_info['user_id'] . ";\">delete</a></td>";
		$result .= "</tr> ";

		return $result;
	}
	
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" href="../css/crud_styles.css">
	</head>
	
	<body>
		
		<div class="borderDiv">
		
			<h1 class="titleText">This is the admin CRUD page</h1>
			<?php
				// show table of users
				if($all_users_result && mysqli_num_rows($all_users_result) > 0){
					
					echo "<table class=\"usersTable\">";
					echo "<th>user_id</th>";
					echo "<th>user_email</th>";
					echo "<th>user_name</th>";
					echo "<th>user_pass</th>";
					echo "<th>date</th>";
					echo "<th>is_auth</th>";
					echo "<th>is_admin</th>";
					
					while($row = mysqli_fetch_assoc($all_users_result)){   
						echo createTableRow($row);
					}
					echo "<tr><td colspan=\"9\"> <div clas=\"wrapper\"><a class=\"createEntryLink\" href=\"crud_create.php\">create new entry</a></div></td></tr>";
					
					echo "</table>";
					
						
				} else echo "there was a problem while loading the table";
			?>
			<br>
			<a class="returnLink" href="index.php">Return to index page.</a>
			
		</div>
	
	</body>
	
</html>