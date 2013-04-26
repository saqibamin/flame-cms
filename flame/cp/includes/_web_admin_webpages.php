<?php require_once('securityCheck.php'); ?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="index.php?view=addPage">
					<span class="newPageIcon"></span>
					New
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
	<img src="images/webpages.png" alt="Manage Web Pages" title="Manage Web Pages" />
	<h2>Web Page Manager</h2>
</div>
<div id="viewElement">
	<fieldset id="fixedPages">
		<legend class="panelTitle">Following are the WebPages in your website:</legend>
		<?php
			$query = "SELECT *
							FROM webpages";
		?>
		<br /><br />
		<table>
			<thead>
				<tr>
					<th>Sr.#</th>
					<th>Title</th>
					<th class="fifty_px_wide">ID</th>
					<th class="eighty_px_wide">ScrollBar</th>
					<th class="fifty_px_wide">Delete</th>
					<th class="fifty_px_wide">Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$fixedPR = mysql_query($query, $conn);
					$rN = 0;
					while($page = mysql_fetch_assoc($fixedPR))
					{
						if($rN%2 == 0)
							$classN = "r_even";
						else
							$classN = "r_odd";
						
						if($page['scroll'] == 0 )
						{
							$scrollClass = 'scrollOFF';
							$scrollTitle = "Turn On ScrollBar";
							$scrollAddress = 'processors/scrollbarshow.php?pid=' . $page['PID'];
						}
						else
						{
							$scrollClass = 'scrollON';
							$scrollTitle = "Turn Off ScrollBar";
							$scrollAddress = 'processors/scrollbarhide.php?cur=top&pid=' . $page['PID'];
						}
							
						echo '<tr class="' . $classN .'">
									<td class="fifty_px_wide">' . ($rN + 1) . '</td>
									<td class="rPTitle"><a href="index.php?view=editPage&pid=' . $page['PID'] . '">' . $page['Title'] . '</a></td>
									<td>' . $page['PID'] . '</td>
									<td><a href="' . $scrollAddress . '" class="' . $scrollClass . '" title="' . $scrollTitle . '"></a></td>
									<td><a onClick="if(confirm(\'Do You really want to delete this page?\')) return true; else return false;"  href="processors/trash_a_webpage.php?pid='. $page['PID'] . '"><img src="images/trash_icon_25.png" title="Delete This Page" alt="Delete" /></a></td>
									<td><a href="index.php?view=editPage&pid=' . $page['PID'] . '"><img src="images/edit_icon_32.png" title="Edit Page" alt="Edit Page" /></a></td>
								</tr>';
						$rN ++;
					}
				?>
			</tbody>
		</table>
	</fieldset>
</div>