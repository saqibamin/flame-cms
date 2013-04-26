<?php require_once('securityCheck.php'); ?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="index.php">
					<span class="cancelIcon"></span>
					Close
				</a>
			</li>
		</ul>
	</div>
	<img src="images/user_icon_dash.png" alt="Add New User" title="Add New User" />
	<h2>Users Manager: Add a New User</h2>
</div>
<div id="viewElement">
	<form name="auf" method="post" action="processors/adduser.php" onsubmit="return validateuserform(auf)">
		<table id="addMenuFrm">	
			<tr>
				<td>User ID:<strong class="req">&nbsp; *</strong></td>
				<td><input type="text" name="user_id" maxlength="50" /> </td>
			</tr>
			<tr>
				<td>User-Email:<strong class="req">&nbsp; *</strong></td>
				<td><input type="text" name="user_email" maxlength="100" /> </td>
			</tr>
			<tr>
				<td>User Password:<strong class="req">&nbsp; *</strong></td>
				<td><input type="password" maxlength="20" name="user_pass" /> </td>
			</tr>
			<tr>
				<td>Admin Type:<strong class="req">&nbsp; *</strong></td>
				<td>
					<select name="uType">
						<option value="dataentryoperator">Data Entry Operator</option>
						<option value="salesmanager">Sales Manager</option>
						<option value="salesmanager">Sales Manager</option>
						<option value="webpagemanager" selected>Web Manager</option>
						<option value="super">Super User</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" style="height: 25px; top: 10px; left: 5px; float: none;" value="Add User" class="blue_btn" name="addUser"/></td>
			</tr>
		</table>
	</form>
</div>