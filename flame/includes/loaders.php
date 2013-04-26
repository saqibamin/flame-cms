<?php
	/**
	*	This functions return a list of pages which are encapsulated in a 
	*	a ul tag and anchors are also added
	*	@param $menuName Name of the Menu whose pages are to be returned
	*	@param $crPid Id of the current page being executed, current class will be added to this page
	*	@return string List of pages with anchored links in an unordered list
	*/
	function get_list_of_pages_in_menu($menuName, $crPid = 0) 
	{
		/*imprt the connection handle to the database server*/
		global $conn;
		
		/*query for grabbing PIDs of the pages in the menu $menuName*/
		$query = "SELECT N.PID ";
		$query .= "FROM navigation N, menu M ";
		$query .= "WHERE N.menu_id=M.menu_id AND M.menu_title='{$menuName}'";
		
		$pids = mysql_query($query, $conn);
		
		/*this variable will contain the end HTML code, data will be added to it in the while loop*/
		$content = '';
		
		/*grab the pName of each of the webpage returned by the above query*/
		while($pid = mysql_fetch_assoc($pids))
		{
			$pid = $pid['PID'];
			
			/*grab the page name for the current page*/
			$getpNameQ = "SELECT pName FROM webpages WHERE PID={$pid}";
			
			$getpNameR = mysql_query($getpNameQ, $conn);
			
			$pName = mysql_fetch_assoc($getpNameR);
			
			/*add a list item to the $content, with anchor tag pointing to index.php with pid equal to the
			page id of current web page*/
			$content .= '<li><a href="index.php?pid=' . $pid . '" ' . ($pid == $crPid ? 'class="current"' : '') . '>' . $pName['pName'] . '</a></li>';
		}
		
		return $content;
	}
	
	/**
	*	This function returns the content of a web page, alongwith title and scrolling status
	*	@param $pid the id of the webpage whose data is to be found
	*	@return array an array of records for the webpage whose data is to be grabbed
	*/
	function get_page_data($pid)
	{
		/*import database connection handle*/
		global $conn;
		
		/*grab the data for the page*/
		$query = "SELECT Title,Content,scroll ";
		$query .= "FROM webpages ";
		$query .= "WHERE PID={$pid}";
		
		$pageresource = mysql_query($query, $conn);
		
		$pagecontent = mysql_fetch_assoc($pageresource);
		
		/*store the data for this page in an associative array*/
		$data = array(
							'title' => $pagecontent['Title'],
							'content' => $pagecontent['Content'],
							'scroll' => $pagecontent['scroll']
							); /*end of array*/
		
		return $data;
	}
	
	/**
	*	This function returns the keywords found in the database
	*	@return string comma separated string of keywords, ready to be used in meta section
	*/
	function get_site_keywords()
	{
		global $conn;
		
		$siteKWQ = "SELECT infoData FROM misc_info WHERE infoName='siteKeywords' LIMIT 1";
		$siteKWR = mysql_query($siteKWQ, $conn);
		$siteKWD = mysql_fetch_assoc($siteKWR);
		
		return array_shift($siteKWD);
	}
	
	/**
	*	This function returns the website description found in the database
	*	@return string description of the website, ready to be used in meta section
	*/
	function get_site_description()
	{
		global $conn;
		
		$siteDescQ = "SELECT infoData FROM misc_info WHERE infoName='siteDescription' LIMIT 1";
		$siteDescR = mysql_query($siteDescQ, $conn);
		$siteDescD = mysql_fetch_assoc($siteDescR);
		
		return htmlspecialchars(array_shift($siteDescD));
	}
?>