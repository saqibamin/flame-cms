<?php
/*check for the form button*/
if(!isset($_POST['log_in_submit'])) 
	die('You directly came to this page. <br /><a href="index.php">Click Here to go to Log in Page</a>');

if(isset($_POST['uid']) && isset($_POST['upass']))
{
	session_start();
	
	/*import the configuration, along with database connection*/
	require_once('../includes/db_config_connect.php');
	
	/*prevention from sql injection*/
	$user_id = mysql_real_escape_string(trim($_POST['uid']));
	
	/*super encrypted password*/
	$user_pass = crypt(sha1(md5(mysql_real_escape_string(trim($_POST['upass'])))), $ENC_SALT); 
	
	/*prepare the query*/
	$query = "SELECT uType ";
	$query .= "FROM admins ";
	$query .= " WHERE UID='{$user_id}' AND UPass='{$user_pass}'";

	if($uTypeR = mysql_query($query, $conn))
	{
		if($uType = mysql_fetch_assoc($uTypeR))
		{
			/*close the database connection*/
			mysql_close($conn);
			/*Authentication was successful*/
			
			/*store user's information in the session*/
			$_SESSION['uid'] = $user_id;
			
			/*this value will dictate access to different sections of CMS,
			 *reserved for extension purposes
			 */
			$_SESSION['uType'] = $uType['uType']; 
			
			/*redirect to master page*/
			header('location: index.php'); 
			die(); /*halt execution*/
		}
		else 
		{
			/*close the database connection*/
			mysql_close($conn);
			header('location: login.php?aerror=1');/*invalid access*/ 
			die(); /*halt execution*/
		}
		
	}
	else
	{
		mysql_close($conn); 
		header('location: index.php?aerror=1');/*invalid access*/
		die(); /*halt execution*/
	}
}
else 
{ 
	/*form validation failed*/
	header('location: index.php?aerror=1');
	die(); /*halt execution*/
}
?>