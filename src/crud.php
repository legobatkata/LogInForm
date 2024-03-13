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
	
	function createRowEntry($entry_col, $entry_info){
		return "<td>" . 
		"<input form=\"edit_form\" type=\"hidden\" name=\"row_" . htmlspecialchars($entry_col) . "\" value=". htmlspecialchars($entry_info) . "></input>" . 
		"<input form=\"delete_form\" type=\"hidden\" name=\"row_" . htmlspecialchars($entry_col) . "\" value=". htmlspecialchars($entry_info) . "></input>" .
		htmlspecialchars($entry_info) . "</td>";		
	}
	
	function createTableRow($row_info){
		$result = "<tr>";
		
		$result .= createRowEntry("id", $row_info['id']);
		$result .= createRowEntry("user_id", $row_info['user_id']);
		$result .= createRowEntry("user_name", $row_info['user_name']);
		$result .= createRowEntry("user_pass", $row_info['user_pass']);
		$result .= createRowEntry("date", $row_info['date']);
		$result .= createRowEntry("is_authenticated", $row_info['is_authenticated']);
		$result .= createRowEntry("is_administrator", $row_info['is_administrator']);
		
		$result .= "<td><input type=\"submit\" form=\"edit_form\" value=\"edit\"></input></td>" .
				     "<td><input type=\"submit\" form=\"delete_form\" value=\"delete\"></input></td>" . 
					 "<tr>";
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
	
		if($all_users_result && mysqli_num_rows($all_users_result) > 0){
			
			echo "<form method= \"POST\" id=\"edit_form\" action=\"crud_action.php\"></form>";
			echo "<input form = \"edit_form\" type=\"hidden\" name=\"action_type\" value=\"action_edit\"> </input>";
			
			echo "<form method= \"POST\" id=\"delete_form\" action=\"crud_action.php\"></form>";
			echo "<input form = \"delete_form\" type=\"hidden\" name=\"action_type\" value=\"action_delete\"> </input>";
			
			echo "<form method= \"POST\" id=\"create_form\" action=\"crud_action.php\"></form>";
			echo "<input form = \"create_form\" type=\"hidden\" name=\"action_type\" value=\"action_create\"> </input>";
			
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
			
		
			// loop through all the results
			/*while($row = mysqli_fetch_assoc($all_users_result)){   
				echo "<tr><td>" . htmlspecialchars($row['id']) . 
				     "</td><td>" . htmlspecialchars($row['user_id']) .
				     "</td><td>" . "<input form=\"edit_form\" type=\"hidden\" name=\"row_user_name\" value=". htmlspecialchars($row['user_name']) . "></input>" . htmlspecialchars($row['user_name']) .
				     "</td><td>" . htmlspecialchars($row['user_pass']) .
				     "</td><td>" . htmlspecialchars($row['date']) .
				     "</td><td>" . htmlspecialchars($row['is_authenticated']) .
					 "</td><td>" . htmlspecialchars($row['is_administrator']) . "</td>" .
				     "<td><input type=\"submit\" form=\"edit_form\" value=\"edit\"></input></td>" .
				     "<td><input type=\"submit\" form=\"delete_form\" value=\"delete\"></input></td><tr>";
			}*/
			
		
			echo "</table>";
			
			echo "<input form = \"create_form\" type=\"submit\" value=\"create new entry\"> </input>";
				
		} else echo "there was a problem while loading the table";
		
	
	?>
	

</html>