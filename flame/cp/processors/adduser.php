<?php
	if(!isset($_POST['addUser'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	require_once('../../includes/db_config_connect.php');
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$user_id = mysql_real_escape_string(trim($_POST['user_id']));
	$user_email = mysql_real_escape_string(trim($_POST['user_email']));
	$user_pass = trim($_POST['user_pass']);
	$userType = $_POST['uType'];
	
	
	$passHash = crypt(sha1(md5(mysql_real_escape_string(trim($user_pass)))), $ENC_SALT); 
	
	$query = "INSERT INTO admins (UID, UPass, Uemail, uType)
					VALUES('{$user_id}', '{$passHash}', '{$user_email}', '{$userType}')";
					
	
	if(mysql_query($query, $conn))
	{ 
		/*inform the user about his registration by emailing him*/
		$to  =  $user_email;
		/* subject*/
		$subject = "Registration as a user in Flame CMS";
		/* message*/
		$message = "Hi, <br />
							You were added to the database of users by our admin.<br />
							Here are your login details:
							<br /><br />
							User ID: <b>{$user_id}</b><br />
							Your Password: <b>{$user_pass}</b>
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
		
		$redirect = 'location: ../index.php?view=users&successMSG=' . urlencode('User was successfully added.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=users&errorMSG='. urlencode('Database Error. User was not added. The user name or email might already be registered.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
		
	header($redirect);
?>