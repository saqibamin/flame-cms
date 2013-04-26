<?php
?>
<!doctype html>
<html>
	<head>
		<title>Login to view Admin Panel - Flame CMS</title>
		<link type="text/css" rel="stylesheet" href="css/style.css" />
		<script src="js/jquery.js" language="javascript" type="text/javascript"></script>
	</head>
	<body>
		<div	id="container" style="min-height: 500px;">
			<div id="topbar">
				<h1>Admin Panel - Flame CMS</h1>
			</div>
			<div class="strip"></div>
			<div id="loginform">
				<div id="lock"></div>
				<p>Use a valid User ID and Password combination to get access to the admin panel.</p>
				<form method="post" onsubmit="return validateLoginForm(this);" action="processlogin.php">
					<?php if(isset($_GET['logout'])) echo "<img style=\"margin-right: 5px; padding-top: 2px;\"  src=\"images/green_tick.png\" width=\"14px\" height=\"14px\" title=\"\" alt=\"\" /><em class=\"greenText\">You Successfully Logged Out. <br /></em>";?>
			<?php if(isset($_GET['sessionerror'])) echo "<img style=\"margin-right: 5px;\" src=\"images/red_cross.png\" width=\"14px\" height=\"14px\" title=\"\" alt=\"\" /><em class=\"redText\">Your Session Expired or You didn't Log in.<br /></em>";?>
			<?php if(isset($_GET['aerror'])) echo "<img style=\"margin-right: 5px; padding-top: 2px;\"  src=\"images/red_cross.png\" width=\"14px\" height=\"14px\" title=\"\" alt=\"\" /><em class=\"redText\">Invalid User ID or Password</em><br />"; ?>
			<?php
				echo (isset($_GET['errorMsg']) && !empty($_GET['errorMsg'])) ? '<span style="color:#aa2222; font-weight: bold;">' . urldecode($_GET['errorMsg'])  . '</span>' : '';
				echo (isset($_GET['successMsg']) && !empty($_GET['successMsg'])) ? '<span style="color:#22aa22; font-weight: bold;">' . urldecode($_GET['successMsg']) . '</span>': '';
			?>
					<table>
						<tr>
						<td width="50%">User ID:</td><td><input type="text" maxlength="50" name="uid" /></td>
						</tr>
						<tr>
						<td>Password: </td><td><input type="password" maxlength="50" name="upass" /></td>
						</tr>
						<tr>
						<td colspan="2" align="right"><a href="#" id="recoverBtn">Recover?</a>&nbsp; &nbsp;<input type="submit" value="Log In" name="log_in_submit" /></td>
						</tr>
					</table>
				</form>
			</div>
			
			<div id="recoverform" style="width: 500px; padding-bottom: 40px; display: none;">
				<div id="lock"></div>
				<p>To recover your password please provide your e-mail address:</p>
				<form method="post" onsubmit="return validateRecoverPass(this);" action="processors/recoverPassword.php">
					<table>
						<tr>
						<td width="50%">E-mail Address:</td><td><input type="text" maxlength="100" name="uemail" /></td>
						</tr>
						<tr>
						<td colspan="2" align="right"><a href="#" id="loginBtn">Log in</a>&nbsp; &nbsp;<input type="submit" value="Recover" name="recover_submit" /></td>
						</tr>
					</table>
				</form>
			</div>
			
		</div>
		<div id="admin-footer">
			<div class="strip"></div>
			<span>All Rights Reserved &copy; 2012-13</span>
		</div>
		<script language="javascript">
			$(document).ready(function() {
				$("#recoverBtn").click(function() {
					$("#loginform").slideUp(300, function() {
						$("#recoverform").fadeIn(100);
					});
					
					$("#loginBtn").click(function() {
						$("#recoverform").slideUp(300, function() {
							$("#loginform").fadeIn(100);
						});
					});
				});
			});
			
			function validateLoginForm(lf)
			{
				if(lf.uid.value == '')
				{
					alert("User Name cannot be empty");
					lf.uid.focus();
					return false;
				}
				
				if(lf.uid.value.length < 3)
				{
					alert("User Name is not valid");
					lf.uid.focus();
					return false;
				}
				
				if(lf.upass.value == '')
				{
					alert("Password cannot be empty");
					lf.upass.focus();
					return false;
				}
				
				if(lf.upass.value.length < 2)
				{
					alert("Invalid password");
					lf.upass.focus();
					return false;
				}
				
				return true;
			}
			
			function validateEmail(email) 
			{ 
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			}
			
			function validateRecoverPass(rf)
			{
				if(rf.uemail.value == '')
				{
					alert("E-Mail Address is empty");
					rf.uemail.focus();
					return false;
				}
				
				if(!validateEmail(rf.uemail.value))
				{
					alert("Please enter a valid email address");
					rf.uemail.focus();
					return false;
				}
				
				return true;
				
			}
		</script>
	</body>
</html>
