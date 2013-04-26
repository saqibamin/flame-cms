<?php require_once('securityCheck.php'); ?>
<div id="subheader">
	<ul>
		<li>
			<a href="index.php?view=webpages">Web Pages</a>
			<ul>
				<li><a href="index.php?view=addPage">Add a WebPage</a></li>
				<li><a href="index.php?view=webpages">Show All</a></li>
				<li><a href="index.php?view=trashManager">Trash</a></li>
				<li><a href="index.php?view=siteConf">Site Settings</a></li>
			</ul>
		</li>
		<li>
			<a href="index.php?view=menus">Menus</a>
			<ul>
				<li><a href="index.php?view=addMenu">Add a Menu</a></li>
			</ul>
		</li>
		<li>
			<a href="index.php?view=trashManager">Trash</a>
		</li>
		<li>
			<a href="index.php?view=siteConf">Site Settings</a>
		</li>
		<li>
			<a href="index.php?view=messages">Contact Messages</a>
		</li>
		<li>
			<a href="index.php?view=users">Users</a>
			<ul>
				<li><a href="index.php?view=addUser">Add a User</a></li>
			</ul>
		</li>
	</ul>
	<div id="log_out">
		<a href="../index.php" title="Visit Public Website"><span style="position: relative; top: -3px; margin-left: 2px;">Visit Site</span></a>&nbsp;
		<a href="index.php?view=changePassword" title="Change Your Password"><span style="position: relative; top: -3px; margin-left: 2px;">Change Password</span></a>&nbsp;
		<a href="logout.php" title="Log Out"><img src="images/logout.png" title="" alt="Log Out" width="20px" height="20px" style="position: relative; top: 2px;" /><span style="position: relative; top: -3px; margin-left: 2px;">Log Out</span></a>
	</div>
</div>