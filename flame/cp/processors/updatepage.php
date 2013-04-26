<?php
	if(!isset($_POST['updatepage'])) 
		header('location: ../index.php?view=webpages&errorMSG=Direct+Access+is+not+allowed+at+that+page.');
	
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	/*validate form data*/
	if(!isset($_POST['ptitle']) || empty($_POST['ptitle'])
		|| !isset($_POST['linktitle']) || empty($_POST['linktitle']))
			{
				/*redirect to addPage view*/
				redirect_to('../index.php?view=webpages&errorMSG=' . urlencode("Form Validation Failed, Please Enable JavaScript!"));
			}
	
	$pTitle = mysql_real_escape_string(trim($_POST['ptitle']));
	$pLTitle = mysql_real_escape_string(trim($_POST['linktitle']));
	$pContent = mysql_real_escape_string(trim($_POST['editor1']));
	$PID = mysql_real_escape_string(trim($_POST['pid']));
	
	$query = "UPDATE webpages ";
	$query .= "SET pName='{$pLTitle}', Title='{$pTitle}', Content='{$pContent}' ";
	$query .= "WHERE PID={$PID}";
	
	if(mysql_query($query, $conn)) 
	{
		$redirect = '../index.php?view=webpages&successMSG=' . urlencode('Page was changed successfully.'); 
	}
	else 
	{ 
		$redirect ='../index.php?view=webpages&errorMSG='. urlencode('Database Error. Page was not changed.'); 
	}
	/*
	everything done successfully, so close the connection to the database
	and redirect to the admin-webpages page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	
	redirect_to($redirect);
?>