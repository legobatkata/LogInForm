<?php
	$db_host = "_";
	$db_user = "_";
	$db_pass = "_";
	$db_name = "_";
	
	if(!$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name)){
		die("failed to connect to database");
	}

?>