<?php 
	/* simple inclusion of the followning file will
	 * prevent the direct asccess to 
	 * the files here in this directory
	 * This file internally checks for a security
	 * flag set by the master page
	 */
	require_once('securityCheck.php'); 
?>
<div id="adminDash">
	<?php
		/*
		 * To add more icons just insert the following code
		 * to the iconWrapper div
		 */
	 
		/*  <div class="icon">
				<a href="?view=addPage" title="Add a WebPage">
					<img src="images/new_web_page.png" alt="" />
					<span>Add Web Page</span>
				</a>
			</div>
		 */
	?>
	<fieldset id="webadmin">
		<legend class="panelTitle">Select a Particular Task</legend>
		<div class="iconWrapper">
			<div class="icon">
				<a href="?view=addPage" title="Add a WebPage">
					<img src="images/new_web_page.png" alt="" />
					<span>Add Web Page</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=webpages" title="Manage Web Pages">
					<img src="images/webpages.png" alt="" />
					<span>Manage Web Pages</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=menus" title="Manage Menus">
					<img src="images/menu_icon_dash.png" alt="" />
					<span>Menus</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=trashManager" title="Manage Trash">
					<img src="images/large_trash_icon.png" alt="" />
					<span>Trash</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=siteConf" title="Website Settings">
					<img src="images/web_configuration_icon.png" alt="" />
					<span>Website Settings</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=messages" title="Reply to User Queries">
					<img src="images/messages_icon_dash.png" alt="User's Messages" />
					<span>User's Messages</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=changePassword" title="Change Your Password">
					<img src="images/password_icon_dash.png" alt="Change Password" />
					<span>Change Password</span>
				</a>
			</div>
			<div class="icon">
				<a href="?view=users" title="Add/Remove Users">
					<img src="images/user_icon_dash.png" alt="Manage Users" />
					<span>Users</span>
				</a>
			</div>
		</div>
	</fieldset>
</div>