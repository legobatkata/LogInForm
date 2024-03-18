<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	
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
	
	// second function to send emails
	function sendАuthЕmail($reciever_email_addr, $receiver_user_id){
		$message = '
				<html>
					<body>
						<p>click <a href="https://ivailo.mbtutu.com/email_auth.php?user_id=' . $receiver_user_id . '">here</a> to authenticate your account</p>
					</body>
				</html>';
		
		$mail = new PHPMailer;
		$mail->isSMTP(); 
		$mail->SMTPDebug = 0; 
		$mail->Host = "_"; 
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls'; 
		$mail->SMTPAuth = true;
		$mail->Username = "_";
		$mail->Password = "_";
		$mail->setFrom("ivailo@mbtutu.com", "Ivailo Mbtutu");
		$mail->addAddress($reciever_email_addr, "user");
		$mail->Subject = 'Log In Authentication';
		$mail->msgHTML($message);
		$mail->AltBody = 'HTML messaging not supported';
		

		if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}	
	}
	
?>