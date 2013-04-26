<?php
	if(!isset($_POST['recover_submit']))
	{
		header('location: ../login.php?errorMsg=You+cannot+directly+access+this+page');
		die();
	}
	
	if(!isset($_POST['uemail']) || empty($_POST['uemail']))
	{
		header('location: ../login.php?errorMsg=You+must+enable+javascript+in+your+web+browser+for+proper+functioning+of+this+page');
		die();
	}
	
	if(!filter_var($_POST['uemail'], FILTER_VALIDATE_EMAIL))
	{
		header('location: ../login.php?errorMsg=Invalid+email+address');
		die();
	}
	
	/*connect to the database*/
	require_once('../../includes/db_config_connect.php');
	
	$email = mysql_real_escape_string(trim($_POST['uemail']));
	
	$checkEmail = "SELECT *
							FROM admins
							WHERE Uemail='{$email}'";
	
	$checkEmail = mysql_query($checkEmail, $conn);
	
	if(mysql_num_rows($checkEmail) > 0)
	{
		$userData = mysql_fetch_assoc($checkEmail);
		
		function r_word()
		{
			$arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 1, 2, 3, 4, 5, 6, 7, 8, 9);
			
			$w = '';
			$length = count($arr) - 1;
			for($counter = 0; $counter <= 5; $counter++ )
			{
				$i = rand(0, $length);
				
				$w .= $arr[$i];
			}
			
			return $w;
		}
		
		$randomPassword = r_word();
		
		$user_pass = crypt(sha1(md5(mysql_real_escape_string($randomPassword))), $ENC_SALT); 
		
		/*change password*/
		$updateQuery = "UPDATE admins SET UPass='{$user_pass}' WHERE UID='{$userData['UID']}'";
		
		mysql_query($updateQuery, $conn);
	}
	else
	{
		/*invalid user email, redirect the user to homepage with appropriate message*/
		mysql_close($conn);
		header('location: ../login.php?errorMsg=User+email+does+not+exist+in+database.');
		die();
	}
	
	$to  =  $email;
	/* subject*/
	$subject = "Recover your password";
	/* message*/
	$message = "Hi, <br />
						You or someone else pretending to be you have asked to recover your password, <br />
						Here are your login details:
						<br /><br />
						User ID: <b>{$userData['UID']}</b><br />
						Your Password has been reset to: <b>{$randomPassword}</b>
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
		
	if(isset($conn))
		mysql_close($conn);
	
	$ret = "location: ../login.php?successMsg=" . urlencode("New Password is: " . $randomPassword);
	
	/* $ret = "location: ../login.php?successMsg=" . urlencode("Password has been sent to your email, Please check your email"); */
	
	header($ret);
	die(); /*end of script*/
?>