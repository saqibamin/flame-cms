<?php require_once('securityCheck.php'); ?>
<?php
	/*check for menu_id in get*/
	if(isset($_GET['menu_id']) && !empty($_GET['menu_id']))
	{
		$menu_id = (int) $_GET['menu_id'];
		$menuQ = "SELECT menu_title FROM menu WHERE menu_id={$menu_id}";
		$menuR = mysql_query($menuQ, $conn);
		if(mysql_num_rows($menuR) > 0)
		{
			$edit = true; /*just a flag variable*/
			$menu = mysql_fetch_assoc($menuR);
		}
	}
	
	if(!isset($edit))
	{
		if(isset($conn))
			mysql_close($conn);
			
		die("You cannot change values in the URL");
	}
?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="#" onClick="submitEditMenuForm();">
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
	<img src="images/menu_icon_dash.png" alt="Update Menu" title="Update Menu" />
	<h2>Menu Manager: Update Menu</h2>
</div>
<div id="viewElement">
	<form name="amf" method="post" action="processors/editmenu.php" onsubmit="return validatemenu(amf)">
		<input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>" />
		<table id="addMenuFrm">	
			<tr>
				<td>Name of the Menu:<strong class="req">&nbsp; *</strong></td>
				<td><input type="text" value="<?php echo $menu['menu_title']; ?>" name="menu_name" /> </td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" style="height: 25px; top: 10px; left: 5px; float: none;" value="Update Menu" class="blue_btn" name="editMenu"/></td>
			</tr>
		</table>
	</form>
</div>