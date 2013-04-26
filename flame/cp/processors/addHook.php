<?php
	if(!isset($_POST['addMenu'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	require_once('../../includes/db_config_connect.php');
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$pid = (int) $_POST['pid'];
	$menu_id = (int) $_POST['menu_id'];
	
	$query = "INSERT INTO navigation(PID, menu_id)
					VALUES({$pid}, {$menu_id})";
	
	if(mysql_query($query, $conn))
	{ 
		$redirect = 'location: ../index.php?view=menus&menu_id=' . $menu_id . '&successMSG=' . urlencode('Hook was successfully added.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=menus&errorMSG='. urlencode('Database Error. Hook was not added.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	header($redirect);
?>