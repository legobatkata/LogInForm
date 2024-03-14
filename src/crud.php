<?php
	session_start();
	
	include("connection.php");
	include("functions.php");
	
	$user_data = check_login($con);
	
	// if a user without admin privileges enters, return them to the index page.
	if(!$user_data['is_administrator']){
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
		$result .="<td><a href=\"crud_action.php?action_type=edit&user_id=" . $row_info['id'] . ";\">edit</a></td>";
		$result .= "<td><a href=\"crud_action.php?action_type=delete&user_id=" . $row_info['id'] . ";\">delete</a></td>";
		$result .= "</tr> ";

		return $result;
	}
	
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Admin</title>
	</head>
	
	<body>
		<h1>This be the admin CRUD page</h1>
	</body>
	<?php
	
		// show table of users
		if($all_users_result && mysqli_num_rows($all_users_result) > 0){
			
			echo "<table>";
			echo "<th>id</th>";
			echo "<th>user_id</th>";
			echo "<th>user_name</th>";
			echo "<th>user_pass</th>";
			echo "<th>date</th>";
			echo "<th>is_auth</th>";
			echo "<th>is_admin</th>";
			
			while($row = mysqli_fetch_assoc($all_users_result)){   
				echo createTableRow($row);
			}
			echo "</table>";
			
			echo "<a href=\"crud_action.php?action_type=create\">create new entry</a>";
				
		} else echo "there was a problem while loading the table";
		
	
	?>
	

</html>