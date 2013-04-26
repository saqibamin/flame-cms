<?php
	if(!isset($_POST['changePass'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	require_once('../../includes/db_config_connect.php');
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$user_pass = $_POST['new_pass'];
	
	
	$passHash = crypt(sha1(md5(mysql_real_escape_string(trim($user_pass)))), $ENC_SALT); 
	
	$query = "UPDATE admins SET UPass='{$passHash}' WHERE UID='{$_SESSION['uid']}'";
	
	if(mysql_query($query, $conn))
	{ 
		$emailQ = "SELECT Uemail FROM admins WHERE UID='{$_SESSION['uid']}'";
		$emailR = mysql_query($emailQ, $conn);
		
		$email = mysql_fetch_assoc($emailR);
		
		$email = $email['Uemail'];
		
		/*inform the user about his registration by emailing him*/
		$to  =  $email;
		/* subject*/
		$subject = "Password changed successfully";
		/* message*/
		$message = "Hi, <br />
							Password was changed successfully in Flame-CMS.
							Here are your login details:
							<br /><br />
							New Password: <b>{$user_pass}</b>
							<br /><br />
							Please don't reply to this email.
							<br />
							Thanks!";
							
		/* To send HTML mail, the Content-type header must be set*/
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		/* Additional headers*/
		$headers .= 'To:' . $to . '<' . $to . '>' . "\r\n";
		$headers .= 'From: Server at Flame CMS <servers@flame-cms.com>' . "\r\n";

		/* Mail it*/
		if(!mail($to, $subject, $message, $headers))
			$mailError = true;
		
		$redirect = 'location: ../index.php?successMSG=' . urlencode('Password was changed successfully.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?errorMSG='. urlencode('Database Error. Password was not changed.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
		
	header($redirect);
?>