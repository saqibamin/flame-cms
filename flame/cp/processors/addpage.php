<?php
	if(!isset($_POST['addpage'])) 
		header('location: ../index.php?errorMSG=Direct+Access+is+not+allowed+at+that+page');
	session_start();
	require_once('../../includes/db_config_connect.php');
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	
	if(!isset($_POST['ptitle']) || empty($_POST['ptitle'])
		|| !isset($_POST['linktitle']) || empty($_POST['linktitle']))
		{
			/*redirect to addPage view*/
			redirect_to('../index.php?view=addPage&errorMSG=' . urlencode("Form Validation Failed, Please Enable JavaScript!"));
		}
	
	/*data validation successfull, proceed with insertion*/
	
	/*prepare data for insertion*/
	$pTitle = mysql_real_escape_string(trim($_POST['ptitle']));
	$pLTitle = mysql_real_escape_string(trim($_POST['linktitle']));
	$pContent = mysql_real_escape_string(trim($_POST['editor1']));
	
	$query = "INSERT INTO webpages(pName, Title, Content)
				VALUES('{$pLTitle}', '{$pTitle}', '{$pContent}')";
	if(mysql_query($query, $conn)) 
	{
		$redirect = '../index.php?successMSG=' . urlencode('Page was saved successfully.'); 
	}
	else 
	{
		$redirect ='../index.php?errorMSG='. urlencode('Database Error. Page was not saved.'); 
	}
	
	/*
	everything done successfully, so close the connection to the database
	and redirect to the admin-webpages page with appropriate message
	*/
	if(isset($conn))
		mysql_close($conn);
	
	redirect_to($redirect);
?>