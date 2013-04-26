<?php
	
	$retURL = 'location: ../index.php?view=webpages';
	
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	if(!isset($_GET['pid'])) 
	{ 
		$errorMSG = urlencode("You didn't select any page or you directly browsed to restricted page.");
		$retURL .= '&errorMSG=' . $errorMSG;
		header($retURL);
	}
	
	if(!empty($_GET['pid']))
	{
		$query = "UPDATE webpages SET scroll=1 WHERE PID={$_GET['pid']}";
		mysql_query($query,$conn);
		mysql_close($conn);
		$successMSG = urlencode("ScrollBar was successfully added.");
		$retURL .= '&successMSG=' . $successMSG;
		header($retURL);
	}
	else {
		if(isset($conn))
			mysql_close($conn);
		
		header($retURL);
	}
?>