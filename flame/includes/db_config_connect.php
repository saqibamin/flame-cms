<?php
	/*************************************
		Flame-CMS
		VERSION: 1.0 BETA
		The configuration file
		BY: Saqib Amin
				and
			Aamir Ali
	*************************************/
	
	
	/*
		this file contains complete configuration information for the CMS
		Everything here is well-commented to make clarifications
		Don't change anything until and unless you know what you are doing.
	*/
	
	/*
		following variable stores the name of the MySQL DB server, 
		typically it would be localhost
	*/
	$DB_SERVER = 'localhost';
	
	/*
		Write the name of the database which you created for this 
		particular instance of the CMS
	*/
	$DB_NAME = 'flame_cms';
	
	/*
		User of the database , on a local server it would be root and you
		won't have to change it on local system
		
		But if you are on a remote server then change it to your respective
		user name assigned to you by your hosting company
	*/
	$DB_USER = 'root';
	
	/*
		The password for the database user selected above.
		Passwords are case-sensitive so make sure that you
		type in the password correct.
		
		On a local development machine typically it would be empty
		unless you have changed it manually
	*/
	$DB_PASS = '';
	
	
	/*
		For storing user names and passwords the CMS uses 
		strong hashing procedures and it can be made even more stronger 
		by writing a random string of characters below
	*/
	$ENC_SALT = 'simple';

	/*
		absolute address of your website,
		this variable is reserved for future versions of this CMS.
		and it would be used for making Search Engine Friendly URLs
	*/
	
	$ABS_PATH = ''; /*will be used in future versions*/
	
	$CONFIGURED = true; /*this is flag variable, don't change it*/

	/*
	 	Following line connects to the database
	 */
	$conn = mysql_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("Database connection error, It might be due to the invalid values in the config.php file");
	
	/*
	 	Select the Database at the Database Server	
	 */
	mysql_select_db($DB_NAME, $conn) or die("DATABASE ERROR: Incorrect Database Name");
	
	/****End of the script****/
?>