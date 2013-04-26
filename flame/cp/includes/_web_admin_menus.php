<?php require_once('securityCheck.php'); ?>
<div class="dToolBar">
	<div <?php echo isset($_GET['menu_id']) ? 'style="width: 150px;"' : '';?>id="tools">
		<ul>
			<?php
				if(isset($_GET['menu_id']) && !empty($_GET['menu_id']))
				{
			?>
					<li>
						<a href="#" id="add_hook_box">
							<span class="newPageIcon"></span>
							Hook
						</a>
					</li>
			<?php
				}
			?>
			<li>
				<a href="index.php?view=addMenu">
					<span class="newPageIcon"></span>
					New
				</a>
			</li>
			<li>
				<a href="<?php echo isset($_GET['menu_id']) ? 'index.php?view=menus' : 'index.php'?>">
					<span class="cancelIcon"></span>
					Close
				</a>
			</li>
		</ul>
	</div>
	<img src="images/menu_icon_dash.png" alt="Add New Menus" title="Add New Menu" />
	<h2>Menu Manager:</h2>
</div>
<?php
	if(isset($_GET['menu_id']) && !empty($_GET['menu_id']))
	{
		$menu_id = (int) $_GET['menu_id'];
		$check = "SELECT * FROM menu WHERE menu_id={$menu_id}";
		$check = mysql_query($check, $conn);
		if(mysql_num_rows($check) > 0)
		{
			/*display the hooking system for this menu, we will set only flag here*/
			$hooking = true; /*flag variable*/
		}
	}
	
	if(isset($hooking))
	{
		/*hooking system to be displayed here*/
		$menuD = mysql_fetch_assoc($check);
?>		
		<div id="viewElement" style="min-height: 200px;">
			<fieldset id="fixedPages">
				<legend class="panelTitle">Add Hooks to: <span class="redText"><?php echo $menuD['menu_title']; ?></span></legend>
				<div id="add_hook_form_container">
					<div id="form_hide_option"> - Hide This Form</div>
					<div id="add_q_form">
						<form method="post" action="processors/addHook.php" >
							<input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>" />
							<table style="width: 50%;">
								<tr>
									<td>Select a Page:</td>
									<td>
										<select name="pid">

										<?php
											$pagesQ = "SELECT PID, pName 
																FROM webpages
																WHERE PID NOT IN (SELECT PID FROM navigation WHERE menu_id={$menu_id})";
											
											$pagesR = mysql_query($pagesQ, $conn);
											while($pages = mysql_fetch_assoc($pagesR))
											{
												echo '<option value="' . $pages['PID'] . '">' . $pages['pName'] . '</option>';
											}
										?>
										</select>
									</td>
								</tr>
								<tr><td colspan="2" align="center"><input style=" margin-left: 100px; height: 25px; width: 120px;" type="submit" name="add_hook_submit" value="Hook this Page" /></td></tr>
							</table>
						</form>
					</div>
				</div>
				
				<?php
					$query = "SELECT *
									FROM navigation WHERE menu_id={$menu_id}";
					
					$navigationR = mysql_query($query, $conn);
							
					/*check for menus*/
					if(mysql_num_rows($navigationR) <= 0)
					{
						echo '<div class="infoMSG"><h3 class="successMSG">No Pages have been hooked to this menu</h3></div>';
					}
					else
					{
				?>
						<table>
							<thead>
								<tr>
									<th class="fifty_px_wide">Sr.#</th>
									<th>Page Name</th>
									<th class="fifty_px_wide">Trash</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$rN = 0;
									$srno = 1;
									while($navigation = mysql_fetch_assoc($navigationR))
									{
										
										$pageNameQ = "SELECT pName FROM webpages WHERE PID={$navigation['PID']}";
										$pageNameR = mysql_query($pageNameQ, $conn);
										
										$pageName = mysql_fetch_assoc($pageNameR);
										
										if($rN%2 == 0)
											$classN = "r_even";
										else
											$classN = "r_odd";
										
										echo '<tr class="' . $classN .'">
													<td>' . $srno ++ . '</td>
													<td class="rPTitle">' . $pageName['pName'] . '</td>
													<td><a onclick="if(confirm(\'This action cannot be done.\\nDo You want to proceed?\')) return true; else return false;" href="processors/unhook_a_page.php?menu_id='. $navigation['menu_id'] . '&pid=' . $navigation['PID'] . '"><img src="images/trash_icon_25.png" title="Unhook this page" alt="Delete" /></a></a></td>
												</tr>';
										$rN ++;
									}
								?>
							</tbody>
						</table>
				
				<?php
					} /*end of else statement*/
				?>
			</fieldset>
		</div>
<?php
	} /*end of hooking system*/
?>

<div id="viewElement">
	<fieldset id="fixedPages">
		<legend class="panelTitle">Menus</legend>
		<?php
			$query = "SELECT *
							FROM menu";
			
			$menuR = mysql_query($query, $conn);
					
			/*check for menus*/
			if(mysql_num_rows($menuR) <= 0)
			{
				echo '<div class="infoMSG"><h3 class="successMSG">No Menu has been created by you</h3></div>';
			}
			else
			{
		?>
				<table>
					<thead>
						<tr>
							<th class="fifty_px_wide">Sr.#</th>
							<th>Title</th>
							<th class="fifty_px_wide">Hooks</th>
							<th class="fifty_px_wide">Edit</th>
							<th class="fifty_px_wide">Trash</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$rN = 0;
							$srno = 1;
							while($menu = mysql_fetch_assoc($menuR))
							{
								$totalHooks = "SELECT count(*) as total FROM navigation WHERE menu_id={$menu['menu_id']}";
								$totalHooks = mysql_query($totalHooks, $conn);
								$totalHooks = mysql_fetch_assoc($totalHooks);
								$TH = (int)$totalHooks['total'];
								
								if($TH == 0)
									$trashLink = '<a onclick="if(confirm(\'This action cannot be done.\\nDo You want to proceed?\')) return true; else return false;" href="processors/trash_a_menu.php?menu_id='. $menu['menu_id'] . '"><img src="images/trash_icon_25.png" title="Delete This Menu" alt="Delete" /></a>';
								else
									$trashLink = '<img src="images/inactive_trash_icon.png" title="This Menu cannot be deleted because there are hooks to this menu" alt="" />';
								
								if($rN%2 == 0)
									$classN = "r_even";
								else
									$classN = "r_odd";
								
								echo '<tr class="' . $classN .'">
											<td>' . $srno ++ . '</td>
											<td class="rPTitle"><a href="index.php?view=menus&menu_id=' . $menu['menu_id'] . '">' . $menu['menu_title'] . '</a></td>
											<td><a class="' . ($TH == 0 ? 'redAnchor' : 'greenAnchor') . '" href="index.php?view=menus&menu_id=' . $menu['menu_id'] . '">' . $TH . '</a></td>
											<td><a href="index.php?view=editMenu&menu_id=' . $menu['menu_id'] . '"><img src="images/edit_icon_32.png" title="Edit Menu" alt="Edit Menu" /></a></td>
											<td>' . $trashLink . '</a></td>
										</tr>';
								$rN ++;
							}
						?>
					</tbody>
				</table>
		<?php
			} /*end of else statement*/
		?>
	</fieldset>
</div>