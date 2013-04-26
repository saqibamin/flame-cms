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
		mysql_close($conn);
		header($retURL);
	}
	
	if(!empty($_GET['pid']))
	{
		$pid = mysql_real_escape_string($_GET['pid']);
		
		$query = "SELECT * FROM webpages WHERE PID={$pid}";
		$pR = mysql_query($query,$conn);
		$pD = mysql_fetch_assoc($pR);
		
		$iQuery = "INSERT INTO trash_webpages(PID, pName, Title, Content, scroll)
						VALUES({$pD['PID']}, '{$pD['pName']}',  '{$pD['Title']}', '{$pD['Content']}', {$pD['scroll']})";
		
		mysql_query($iQuery, $conn);					
		
		$dQuery = "DELETE FROM webpages WHERE PID={$pid}";
		
		mysql_query($dQuery, $conn);
		
		mysql_close($conn);
		
		$undoLink = ' <a class="greenText" href="processors/untrash_a_webpage.php?pid='. $pid .'">Undo</a>';
		$successMSG = urlencode('Page was successfully deleted.' . $undoLink);
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