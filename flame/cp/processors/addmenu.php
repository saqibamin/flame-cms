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
	
	$menuName = mysql_real_escape_string(trim($_POST['menu_name']));
	
	$query = "INSERT INTO menu(menu_title)
					VALUES('{$menuName}')";
	
	if(mysql_query($query, $conn))
	{ 
		$menu_id = mysql_insert_id();
		$redirect = 'location: ../index.php?view=menus&menu_id=' . $menu_id . '&successMSG=' . urlencode('Menu was saved successfully.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=menus&errorMSG='. urlencode('Database Error. Menu was not saved.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	header($redirect);
?>