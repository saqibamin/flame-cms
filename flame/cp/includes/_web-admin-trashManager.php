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
	<img src="images/large_trash_icon.png" alt="Manage Trash" title="Manage Trash" />
	<h2>Trash Manager</h2>
</div>
<?php
		$msg = "Click an item to undelete it.";
		echo '<div class="infoMSG">
					<h3 class="successMSG">' . $msg .'</h3>
				</div>';
?>
<div id="viewElement">
	<fieldset id="webPagesTrash">
		<legend class="panelTitle">List of Item is Trash:</legend>
			<?php
				$trashQ = "SELECT * FROM trash_webpages";
				$trashR = mysql_query($trashQ, $conn);
				
				$total = mysql_num_rows($trashR);
				while($tPage = mysql_fetch_assoc($trashR))
				{
					echo '<div class="icon">
								<a href="processors/untrash_a_webpage.php?pid=' . $tPage['PID'] . '&returnView=trashManager" title="">
									<img src="images/web_page_trashed_dash_icon.png" alt="" title="" />
									<span style="font-weight: bold;">' . $tPage['pName'] . '</span>
								</a>
							</div>';
				}
				if($total <= 0)
					echo '<p class="greenText" style="margin-left: 20px; font-size: 18px;">There are no Items in Trash</p>';
			?>
			
	</fieldset>
	
</div>