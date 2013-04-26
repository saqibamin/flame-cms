<?php
	if(!isset($_GET['userid']) || empty($_GET['userid'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$user_id = mysql_real_escape_string($_GET['userid']);
	
	$query = "DELETE FROM admins WHERE UID='{$user_id}'";
	
	if(mysql_query($query, $conn))
	{ 
		$redirect = 'location: ../index.php?view=users&successMSG=' . urlencode('User with id <em>' . $user_id . '</em> was successfully Removed.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=users&errorMSG='. urlencode('Database Error. User was not deleted. Please try back later.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
		
	header($redirect);
?>