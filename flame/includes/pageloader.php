<?php
	/*this page is really the BRAIN of our WEBSITE's PUBLIC SECTION*/
	
	/*database connection information, with database selected*/
	require_once('db_config_connect.php');
	
	/*the page loading functions are in this file, we must import it as it will call those functions to generate the pages*/
	require_once('loaders.php'); 
	
	/*some general functions are stored in this file, they can be useful in many cases*/
	require_once('cp/includes/generic_functions.php');
	
	$siteTitle = get_site_title();
	$siteKW = get_site_keywords();
	$siteDesc = get_site_description();
	
	/*
	 * The code below sets the values for displaying a webpage
	 * Specifically two variables are set
	 * $content variable stores the content
	 * which is to be displayed in the content section of the webpage
	 * 
	 * $title variable stores the Title of the webpage
	 */
	
	/*
	 * HOW TO OVERRIDE DEFAULT BEHAVIOR
	 * TO DISPLAY CUSTOM PAGES?
	 * 
	 * An example is shown below, you can also do so, 
	 * but don't forget to use 'else if ' statement to 
	 * complete the if-else ladder, we do hope that you
	 * understand this terminology
	 */
	
	
	/*
	 * The following lines show how you can add custom code for
	 * some pages and load the whole page without even consulting
	 * database for grabbing general information
	 * 
	 * The overriding done below is for loading contact us form page
	 */
	if(isset($_GET['pid']) && $_GET['pid'] == 'contact')
	{
		/*
		 * These lines generate a random id for the captcha
		 * to display a random capcha
		 */
		$maxID = "SELECT max(id) as M FROM captcha";
		$maxID = mysql_query($maxID, $conn);
		$maxID = mysql_fetch_assoc($maxID);
		$maxID = $maxID['M'];
		
		$randID = rand(1, $maxID);
		
		/* Set the custom content variable for this page */
		$content = '
			<form onsubmit="return validateContactForm(cntFrm);" name="cntFrm" action="processors/processContact.php" method="post">
				<table id="formLayout">
					<tr>
						<td>Your E-Mail Address: <b style="color: #ff2222;">*<b></td>
						<td><input type="text" onfocus="addBorders(uemail);" onblur="removeBorders(uemail);" name="uemail" maxlength="100" /></td>
					</tr>
					<tr>
						<td>Subject: <b style="color: #ff2222;">*<b></td>
						<td><input type="text" onfocus="addBorders(msgSub);" onblur="removeBorders(msgSub);" name="msgSub" class="inputField" maxlength="100" /></td>
					</tr>
					<tr style="height: 20px;"></tr>
					<tr>
						<td style="vertical-align: top;">Message: <b style="color: #ff2222;">*<b></td>
						<td><textarea name="message" onfocus="addBorders(message);" onblur="removeBorders(message);" rows="10"></textarea></td>
					</tr>
					<tr>
						<td>Prove You are Human:</td>
						<td>
							<img style="margin-top: 5px; margin-bottom: 5px;" src="includes/generate_captcha.php?cid=' . $randID . '" alt="Captcha"/><br />
							<input type="hidden" name="cid" value="' . $randID . '"/>
							<input type="text" onfocus="addBorders(captcha);" onblur="removeBorders(captcha);" name="captcha" value="" />
							<div id="captchavalidation" style="display: none;"></div>
						</td>
					</tr>
					<tr>	
						<td colspan="2"><input type="submit" name="contactSubmit" value="Send Message" /></td>
					<tr>
				</table>
				<script language="javascript" src="js/contactValidator.js" type="text/javascript"></script>
			</form>';
			
		$title = "Write to Us";
	}
	else
	{
		/*grab the id of the page*/
		if(isset($_GET['pid']) && !empty($_GET['pid']))
			$pid = (int) $_GET['pid'];
		else
			$pid = 1;
			
		$data = get_page_data($pid);
		
		$content = $data['content'];
		$title = $data['title'];
	}
	
	$pid = isset($pid) ? $pid : 0;
	
	/*get navigations*/
	$mainNav = get_list_of_pages_in_menu('main_menu', $pid);
	$leftNav = get_list_of_pages_in_menu('left_menu', $pid);
	
	/*close the database connection*/
	mysql_close($conn);
	
?>