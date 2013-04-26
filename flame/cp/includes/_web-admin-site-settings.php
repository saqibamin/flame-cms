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
	<img src="images/web_configuration_icon.png" alt="Claimed Prizes" title="Claimed Prizes" />
	<h2>Website Settings</h2>
</div>
<?php
	$siteTitleQ = "SELECT * FROM misc_info WHERE infoName='siteTitle'";
	$siteTitleR = mysql_query($siteTitleQ, $conn);
	$siteTitle = mysql_fetch_assoc($siteTitleR);
	
	$siteDescQ = "SELECT * FROM misc_info WHERE infoName='siteDescription'";
	$siteDescR = mysql_query($siteDescQ, $conn);
	$siteDesc = mysql_fetch_assoc($siteDescR);
	
	$siteKWQ = "SELECT * FROM misc_info WHERE infoName='siteKeywords'";
	$siteKWR = mysql_query($siteKWQ, $conn);
	$siteKW = mysql_fetch_assoc($siteKWR);
?>
<div id="viewElement">
	<fieldset class="siteSettings">
		<legend class="panelTitle">Website Settings</legend>
		<form name="sitesettingsform" action="processors/siteSettings.php" method="post" onsubmit="return siteSettingsFormValidate(sitesettingsform);">
			<table>
				<tr>
					<td>Site Title: </td>
					<td><input type="text" maxlength="150" name="siteTitle" value="<?php echo $siteTitle['infoData']; ?>" /></td>
				</tr>
				<tr>
					<td valign="top">Meta Description: </td>
					<td><textarea rows="10" cols="30" name="siteDesc"><?php echo $siteDesc['infoData']; ?></textarea></td>
				</tr>
				<tr>
					<td valign="top">Meta Keywords:</td>
					<td><textarea rows="10" cols="30" name="siteKeywords"><?php echo $siteKW['infoData']; ?></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="settingsSubmit" value="Save" /></td>
				</tr>
			</table>
		</form>
	</fieldset>
</div>