<?php
	
	if(isset($_GET['returnView']) && !empty($_GET['returnView']))
		$retURL = 'location: ../index.php?view=trashManager';
	else
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
		mysql_close($conn);
		header($retURL);
	}
	
	if(!empty($_GET['pid']))
	{
		$pid = mysql_real_escape_string($_GET['pid']);
		
		$sQ = "SELECT * FROM trash_webpages WHERE PID={$pid}";
		$pR = mysql_query($sQ,$conn);
		
		$pD = mysql_fetch_assoc($pR);
		
		$iQuery = "INSERT INTO webpages(PID, pName, Title, Content, scroll)
						VALUES({$pD['PID']}, '{$pD['pName']}', '{$pD['Title']}', '{$pD['Content']}', {$pD['scroll']})";
		
		mysql_query($iQuery, $conn);					
		
		$dQuery = "DELETE FROM trash_webpages WHERE PID={$pid}";
		
		mysql_query($dQuery, $conn);
		
		mysql_close($conn);
		
		$undoLink = ' <a href="processors/trash_a_webpage.php?pid='. $pid .'" class="redText">Undo</a> (Be Cautious!)';
		$successMSG = urlencode('Page was successfully restored.' . $undoLink);
		
		$retURL .= '&successMSG=' . $successMSG;
		
		header($retURL);
	}
	else
	{
		if(isset($conn))
			mysql_close($conn);
		
		header($retURL);
	}
?>