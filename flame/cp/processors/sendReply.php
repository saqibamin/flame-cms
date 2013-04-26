<?php
	/*check for the button of the form*/
	if(!isset($_POST['editMenu'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	
	/*start the session*/
	session_start();
	
	/*import the configuration*/
	require_once('../../includes/db_config_connect.php');
	
	/*import the generic functions library*/
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		/*authentication failed, redirect the user to home page*/
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	/*prepare the data*/
	$email = trim($_POST['email']);
	$subject = trim($_POST['subject']);
	
	$msgID = (int) $_POST['msgID'];
	
	/*set the subject of the reply email*/
	$msgSubject = 'Re:' . $subject;
	
	/*grab the message from the form*/
	$repMsg = trim($_POST['message']);

	/*prepare and send the email to user*/

	$to  =  $email;
	/* subject*/
	$subject = $subject;
	/* message*/
	$message = $_POST['repMsg'];

	/* To send HTML mail, the Content-type header must be set*/
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	/* Additional headers*/
	$headers .= 'To:' . $to . '<' . $to . '>' . "\r\n";
	$headers .= 'From: Customer Care Department - Sarhadis <crm@sarhadis.com>' . "\r\n";

	/* Send the email now (Mail server should be present)*/
	if(!mail($to, $subject, $message, $headers))
		$mailError = true;
	
	/*update database*/
	$updateQuery = "UPDATE contactus SET replied=1 WHERE contactID={$msgID}";
	
	mysql_query($updateQuery, $conn);
	
	$redirect = "location: ../index.php?view=messages&successMSG=" . urlencode("Your message has been sent to user on his email address");
	
	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	
	header($redirect);
?>