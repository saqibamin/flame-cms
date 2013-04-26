<?php
	
	if(!isset($_GET['cid']) || empty($_GET['cid']) || !isset($_GET['value']) || empty($_GET['value']))
	{
		echo 'invalid';
		die();
	}
	
	/*database connection information*/
	require_once('../includes/db_config_connect.php'); 
	
	$cid = (int) $_GET['cid'];
	$value = mysql_real_escape_string(trim($_GET['value']));
	
	$check = mysql_query("SELECT * FROM captcha WHERE id={$cid} AND value='{$value}'", $conn);
	if(mysql_num_rows($check) > 0)
	{
		echo 'valid';
	}
	else
	{
		echo 'invalid';
	}
	if(isset($conn))
		mysql_close($conn);
?>