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
	<img src="images/password_icon_dash.png" alt="Change Password" title="Change Your Password" />
	<h2>Password Manager:</h2>
</div>
<div id="viewElement">
	<form name="cpf" method="post" action="processors/changePass.php" onsubmit="return validateCP(cpf)">
		<table id="addMenuFrm">	
			<tr>
				<td>Enter New Password:<strong class="req">&nbsp; *</strong></td>
				<td><input type="password" maxlength="20" name="new_pass" /> </td>
			</tr>
			<tr>
				<td>Confirm New Password:<strong class="req">&nbsp; *</strong></td>
				<td><input type="password" maxlength="20" name="c_new_pass" /> </td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" style="height: 25px; top: 10px; left: 5px; float: none;" value="Change" class="blue_btn" name="changePass"/></td>
			</tr>
		</table>
	</form>
</div>