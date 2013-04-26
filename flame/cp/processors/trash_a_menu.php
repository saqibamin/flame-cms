<?php
	
	$retURL = 'location: ../index.php?view=menus';
	
	session_start();
	
	require_once('../../includes/db_config_connect.php');
	
	require_once('../includes/generic_functions.php');

	if(!auth_user()) /*Ensure that an admin is logged in*/
	{
		redirect_to('../index.php?errorMSG=Sorry+you+dont+have+proper+priviliges+for+this+operation');
	}
	
	if(!isset($_GET['menu_id'])) 
	{ 
		$errorMSG = urlencode("You didn't select any Menu or you directly browsed to restricted page.");
		$retURL .= '&errorMSG=' . $errorMSG;
		mysql_close($conn);
		header($retURL);
	}
	
	if(!empty($_GET['menu_id']))
	{
		$menu_id = (int) $_GET['menu_id'];
		
		/*to maintain referential integrity we must first check that there are no hooks to this menu*/
		$integrityQ = "SELECT count(PID) FROM navigation WHERE menu_id={$menu_id}";
		$integrityR = mysql_query($integrityQ, $conn);
		$integrityD = mysql_fetch_assoc($integrityR);
		
		$integrity = array_shift($integrityD);
		
		if($integrity == 0)
		{
			/*proceed with deletion of the menu*/
			$delQ = "DELETE FROM menu WHERE menu_id={$menu_id}";
			mysql_query($delQ, $conn);
			
			$retURL .= '&successMSG=' . urlencode("Menu was successfully deleted from database");
		}
		else
		{
			/*integrity of the data will be compromised, don't delete the menu*/
			$retURL .= '&errorMSG=' . urlencode("Menu cannot be deleted because there are hooks onto it");
		}
		
	}
	else {
		$retURL .= '&errorMSG=' . urlencode("Your request was invalid, probably due to invalid values in the URL");
	}
	
	if(isset($conn))
		mysql_close($conn);
	
	header($retURL);
?>