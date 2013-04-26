<?php 
	/* simple inclusion of the followning file will
	 * prevent the direct asccess to 
	 * the files here in this directory
	 * This file internally checks for a security
	 * flag set by the master page
	 */
	require_once('securityCheck.php'); 
?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="#" onClick="submitAddPageForm();">
					<span class="saveIcon"></span>
					Save
				</a>
			</li>
			<li>
				<a href="index.php">
					<span class="cancelIcon"></span>
					Close
				</a>
			</li>
		</ul>
	</div>
	<img src="images/new_web_page.png" alt="Add New Web Page" title="Add New Web Page" />
	<h2>Web Page Manager: Add New Web Page</h2>
</div>
<div id="viewElement">
	<form name="apf" method="post" action="processors/addpage.php" onsubmit="return validatepage(apf)" enctype="multipart/form-data">
		<ul id="webPageForm">
			<li>
				<label for="ptitle">Page Title:<strong class="req">&nbsp; *</strong></label>
				<input type="text" name="ptitle" maxlength="100" class="title_page" />
			</li>
			<li>
				<label for="linktitle">Link Title: <strong class="req">&nbsp; *</strong></label>
				<input type="text" maxlength="20" name="linktitle" />
			</li>
		</ul>
		
		<label for="addpage">Content:</label><input type="submit" value="Add Page" class="blue_btn" name="addpage"/>
		<br />
		
		<textarea class="ckeditor" name="editor1"></textarea>
		<br />
		
	</form>
</div>