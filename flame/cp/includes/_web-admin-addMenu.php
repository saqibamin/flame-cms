<?php require_once('securityCheck.php'); ?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="#" onClick="submitAddMenuForm();">
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
	<img src="images/menu_icon_dash.png" alt="Add New Menu" title="Add New Menu" />
	<h2>Menu Manager: Add New Menu</h2>
</div>
<div id="viewElement">
	<form name="amf" method="post" action="processors/addmenu.php" onsubmit="return validatemenu(amf)">
		<table id="addMenuFrm">	
			<tr>
				<td>Name of the Menu:<strong class="req">&nbsp; *</strong></td>
				<td><input type="text" name="menu_name" /> </td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" style="height: 25px; top: 10px; left: 5px; float: none;" value="Add Menu" class="blue_btn" name="addMenu"/></td>
			</tr>
		</table>
	</form>
</div>