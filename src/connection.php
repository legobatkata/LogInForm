<?php
	$db_host = "localhost";
	$db_user = "mbtutu_ivailo";
	$db_pass = "ivailoTCHe";
	$db_name = "mbtutu_ivailo";
	
	if(!$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name)){
		die("failed to connect to database");
	}

?>