<?php
	
	function check_login($con){
		if(isset($_SESSION['user_id'])){
			
			$user_id = $_SESSION['user_id'];
			$query = "select * from users where user_id = '$user_id'";
			$result = mysqli_query($con, $query);
			
			if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
			
		}
		
		// if _SESSION isnt set, redirect to login
		header("Location: login.php");
		die;
	}
	
	// returns a bool depending on whether username or email is already in database
	function userOrEmailExistsInDb($con, $user_name, $user_email){
		$query = "select `user_name`, `user_email` from `users` where `user_name` = '$user_name' or `user_email` = '$user_email';";
		$result = mysqli_query($con, $query);
		return ($result && mysqli_num_rows($result) > 0);
	}
	
	// function that sends an email with an authentication link
	function send_auth_email($receiver_email_addr, $receiver_user_id){
		$subject = 'User Authentication';
		$message = '
				<html>
					<body>
						<p>click <a href="https://ivailo.mbtutu.com/email_auth.php?user_id=' . $receiver_user_id . '">here</a> to authenticate your account</p>
					</body>
				</html>';
		$headers = 
				'From: ivailo@mbtutu.com'. "\r\n" .
                'Reply-To: ivailo@mbtutu.com' . "\r\n" .
				'Content-type: text/html; charset=utf-8' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    mail($receiver_email_addr, $subject, $message, $headers);
	}
	
	
?>