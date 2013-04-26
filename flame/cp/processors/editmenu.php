<?php
	if(!isset($_POST['editMenu'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	$menuName = mysql_real_escape_string(trim($_POST['menu_name']));
	$menu_id = (int) $_POST['menu_id'];
	
	$query = "UPDATE menu
						SET
					menu_title='{$menuName}'
					WHERE menu_id={$menu_id}";
	
	if(mysql_query($query, $conn))
	{ 
		$redirect = 'location: ../index.php?view=menus&menu_id=' . $menu_id . '&successMSG=' . urlencode('Menu name was changed successfully.'); 
	}
	else 
	{ 
		$redirect = 'location: ../index.php?view=menus&menu_id=' . $menu_id . '&errorMSG='. urlencode('Database Error. Menu was not updated.'); 
	}

	/*
	everything done successfully, so close the connection to the database
	and redirect to the corresponding page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	header($redirect);
?>