<?php
	if(!isset($_GET['pid']) || !isset($_GET['menu_id'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$pid = (int) $_GET['pid'];
	$menu_id = (int) $_GET['menu_id'];
	
	$query = "DELETE FROM navigation WHERE PID={$pid} AND menu_id={$menu_id}";
	
	if(mysql_query($query, $conn))
	{ 
		$redirect = 'location: ../index.php?view=menus&menu_id=' . $menu_id . '&successMSG=' . urlencode('Page was successfully unhooked.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=menus&errorMSG='. urlencode('Database Error. Page was not unhooked. Please try back later.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	header($redirect);
?>