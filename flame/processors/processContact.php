<?php
	if(!isset($_POST['contactSubmit']))
	{
		header("location: ../index.php?msg=You+can+not+direcly+access+that+page");
		die();
	}
	
	if(!isset($_POST['uemail']) || empty($_POST['uemail']) || !filter_var($_POST['uemail'], FILTER_VALIDATE_EMAIL))
	{
		header("location: ../index.php?pid=contact&msg=Email+address+was+not+provided");
		die();
	}
	if(!isset($_POST['msgSub']) || empty($_POST['msgSub']) || strlen($_POST['msgSub']) < 5)
	{
		header("location: ../index.php?pid=contact&msg=Message+subject+was+not+provided");
		die();
	}
	if(!isset($_POST['message']) || empty($_POST['message']) || strlen($_POST['message']) < 10)
	{
		header("location: ../index.php?pid=contact&msg=Message+box+was+empty");
		die();
	}
	
	if(!isset($_POST['cid']) || empty($_POST['cid']) || !isset($_POST['captcha']) || empty($_POST['captcha']))
	{
		header("location: ../index.php?pid=contact&msg=Security+code+was+not+provided");
		die();
	}

	/*connect to the database*/
	require_once('../includes/db_config_connect.php'); 
	
	
	$cid = (int) $_POST['cid'];
	$value = mysql_real_escape_string(trim($_POST['captcha']));
	
	$check = mysql_query("SELECT * FROM captcha WHERE id={$cid} AND value='{$value}'", $conn);
	if(mysql_num_rows($check) <= 0)
	{
		mysql_close($conn);
		header("location: ../index.php?pid=contact&msg=Security+code+was+invalid");
		die();
	}
	
	/*grab and prepare the data for database storage*/
	$sender = mysql_real_escape_string(trim($_POST['uemail']));
	$sub = mysql_real_escape_string(trim($_POST['msgSub']));
	$message = mysql_real_escape_string(strip_tags(trim($_POST['message'])));
	$dateTime = date('Y-m-d H:i:s' , time());
	
	
	$insertQ = "INSERT INTO 
					contactus(msgFrom, msgSubj, msgBody, msgDate)
					VALUES('{$sender}', '{$sub}', '{$message}', '{$dateTime}')";
					
	if(!mysql_query($insertQ, $conn))
	{
		$msg = urlencode("<span style=\"color: #aa2222;\">Something went wrong while submitting your message</span>");
	}
	else
	{
		$msg = urlencode("Your message has been received, we will reply you soon");
	}
	
	/*close the connection*/
	if(isset($conn))
		mysql_close($conn);
	
	/*redirect the user*/
	$loc = "location: ../index.php?pid=contact&msg=" . $msg;
	header($loc);
	die("If you are not redirected to home. Please <a href=\"../index.php\">click here</a>");
?>