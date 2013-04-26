<?php require_once('securityCheck.php'); ?>

<?php
	$retURL = 'location: ../index.php?view=webpages';
	
	
	if(!isset($_GET['pid'])) 
	{ 
		mysql_close($conn);
		
		die("You cannot directly access this page. Hit Back button in Your Web Browser");
	}
	
	if(!empty($_GET['pid']))
	{
		$query = "SELECT * FROM webpages WHERE PID={$_GET['pid']} LIMIT 1";
		$editPR = mysql_query($query,$conn);
		if(!($editPD = mysql_fetch_assoc($editPR)))
		{
			mysql_close($conn);
			
			die("SECURITY ERROR: You tried to modify the values in the URL");
		}
	}
?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="#" onClick="submitEditPageForm();">
					<span class="saveIcon"></span>
					Save
				</a>
			</li>
			<li>
				<a href="index.php?view=webpages">
					<span class="cancelIcon"></span>
					Close
				</a>
			</li>
		</ul>
	</div>
	<img src="images/new_web_page.png" alt="Edit a Web Page" title="Edit a Web Page" />
	<h2>Web Page Manager: Edit Web Page</h2>
</div>
<div id="viewElement">
	<form name="apf" method="post" action="processors/updatepage.php" onsubmit="return validatepage(apf)" enctype="multipart/form-data">
		<ul id="webPageForm">
			<li>
				<label for="ptitle">Page Title:<strong class="req">&nbsp; *</strong></label>
				<input type="text" name="ptitle" maxlength="100" class="title_page" value="<?php echo $editPD['Title'] ?>" />
			</li>
			<li>
				<label for="linktitle">Link Title: <strong class="req">&nbsp; *</strong></label>
				<input type="text" maxlength="20" name="linktitle" value="<?php echo $editPD['pName']; ?>" />
			</li>
		</ul>
			<label for="addpage">Content:</label><input type="submit" class="blue_btn" value="Update Page" name="updatepage"/>
		<br />
		<textarea class="ckeditor" name="editor1"><?php echo $editPD['Content']; ?></textarea>
		<br />
		<input type="hidden" name="pid" value="<?php echo $editPD['PID']; ?>" />
	</form>
</div>