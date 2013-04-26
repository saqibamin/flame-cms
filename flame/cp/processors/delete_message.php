<?php
	if(!isset($_GET['msgID']) || !isset($_GET['msgID'])) 
	{	header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page'); die(); }
	
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$msgID = (int) $_GET['msgID'];
	
	$query = "DELETE FROM contactus WHERE contactID={$msgID}";
	
	if(mysql_query($query, $conn))
	{ 
		$redirect = 'location: ../index.php?view=messages&successMSG=' . urlencode('Message was successfully deleted.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=messages&errorMSG='. urlencode('Database Error. Message was not deleted. Please try back later.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	
	header($redirect);
?>