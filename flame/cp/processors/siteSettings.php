<?php

	$retURL = 'location: ../index.php';
	
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	if(!isset($_POST['settingsSubmit']))	
	{
		$errorMSG = urlencode("You can not directly access that page.");
		$retURL .= '?errorMSG=' . $errorMSG;
	}
	else
	{
		
		$siteTitle = mysql_real_escape_string(trim($_POST['siteTitle']));
		$siteDesc = mysql_real_escape_string(trim($_POST['siteDesc']));
		$metaKeywords = mysql_real_escape_string(trim($_POST['siteKeywords']));
		
		$query = "UPDATE misc_info
						SET infoData='{$siteTitle}'
						WHERE infoName='siteTitle'";
		mysql_query($query, $conn);
	
		$query2 = "UPDATE misc_info
						SET infoData='{$siteDesc}'
						WHERE infoName='siteDescription'";
		mysql_query($query2, $conn);
		
		$query3 = "UPDATE misc_info
						SET infoData='{$metaKeywords}'
						WHERE infoName='siteKeywords'";
		mysql_query($query3, $conn);
		
		$successMSG = urlencode("Site Information was successfully updated");
		$retURL .="?successMSG=" . $successMSG;
	}
	if(isset($conn))
		mysql_close($conn);
	/*redirect the user to home page, with relevant message*/
	header($retURL);
?>