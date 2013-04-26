<?php
	/**
	* This functions check whether a particular type of user is logged in or not
	* @author Saqib Amin
	* @param string $type type of the user to be authenticated
	* @return bool Returns true when the user has been authenticated otherwise returns false
	*/
	function auth_user($type = 'general')
	{
		if($type != 'general' && isset($_SESSION['uid']))
			switch($type)
			{
				case 'webpagemanager': 
						if($_SESSION['uType'] == 'webpagemanager' || $_SESSION['uType'] == 'super')
							return true;
						else
							return false;
						break;
				
				case 'dataentryoperator': 
						if($_SESSION['uType'] == 'dataentryoperator' || $_SESSION['uType'] == 'super')
							return true;
						else
							return false;
						break;
				
				case 'salesmanager': 
						if($_SESSION['uType'] == 'salesmanager' || $_SESSION['uType'] == 'super')
							return true;
						else
							return false;
						break;
				case 'super':
						if($_SESSION['uType'] == 'super')
							return true;
						else
							return false;
							
				default: return false;
			}
		
		if(isset($_SESSION['uid'])) {
			return true;
		}
		
		return false;
	}
	
	/**
	* This functions redirects the user to specified location
	* by using PHP's header function, and immediately halts the further execution
	* @author Saqib Amin
	* @param string $url address where you have to redirect-to
	*/
	function redirect_to($url = 'index.php')
	{
		$redirect = 'location: ' . $url;
		header($redirect);
		
		die(); /*halt the execution*/
	}
	
	/**
	* This functions returns the title of the website as set in the database
	* Uses global variable $conn
	* @author Saqib Amin
	* @return string Title of the website as stored in database
	*/
	function get_site_title()
	{
		global $conn;
		
		$siteTitle = "SELECT infoData FROM misc_info WHERE infoName='siteTitle' LIMIT 1";
		
		$siteTitle = mysql_query($siteTitle, $conn);
		$siteTitle = mysql_fetch_assoc($siteTitle);
		
		return array_shift($siteTitle);
	}
	
	/**
	* this function takes the number of the month as argument and return the name of the month (three characters long)
	*
	* @author Saqib Amin
	* @param $monthNumber number of the month whose name is to be calculated
	* @return string a three letter representation of the month whose number is passed as argument
	*/
	function getMonthName($monthNumber = 1)
	{
		switch($monthNumber)
		{
			case 1: return 'Jan';
			case 2: return 'Feb';
			case 3: return 'Mar';
			case 4: return 'Apr';
			case 5: return 'May';
			case 6: return 'Jun';
			case 7: return 'Jul';
			case 8: return 'Aug';
			case 9: return 'Sep';
			case 10: return 'Oct';
			case 11: return 'Nov';
			case 12: return 'Dec';
			
			default: return 'Jan';
		}
	}
	
	/**
	*	This function returns mysql date [datetime] string into a pretty date, in format: Day-MonthName-Year
	*	@param $sqlData The date [datetime] string which is to be converted into pretty format
	*	@param $time It is a boolean flag, true indicates that the datestring passed contains time component too
	*	@return string Date in pretty format
	*/
	function mysql_to_dmy($sqlDate, $time = false)
	{
		$parts = $sqlDate;
		
		if($time)
		{
			$parts = explode(' ', $sqlDate);
			$parts = $parts[0];
		}
	
		$parts = explode('-', $parts);
		
		$dmy = $parts[2] . '-' . getMonthName($parts[1]) . '-' . $parts[0];
		
		return $dmy;
	}
?>