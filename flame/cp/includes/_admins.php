<?php require_once('securityCheck.php'); ?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<li>
				<a href="index.php?view=addUser">
					<span class="newPageIcon"></span>
					Add
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
	<img src="images/user_icon_dash.png" alt="Users" title="Manage Users" />
	<h2>Manage Users:</h2>
</div>
<?php
	/*check which type of query should be written for this page*/
	if(!auth_user('super'))
	{
		/*this user cannot add new users, because he is not an admin*/
		echo '<h2>Sorry You don\'t have proper priviliges to add new users.</h2>';
	}
	else
	{
		$usersQ = "SELECT * FROM admins WHERE UID != '{$_SESSION['uid']}'";
	
	$usersR = mysql_query($usersQ, $conn);
?>
<div id="viewElement">
	<fieldset class="prizesPage">
		<legend class="panelTitle">Following are the users having adminsitrative priviliges</legend>
		<table>
			<thead>
				<tr>
					<th>Sr#</th>
					<th>User E-Mail</th>
					<th>User Type</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$rno = 0;
					while($user = mysql_fetch_assoc($usersR))
					{
						if($rno % 2 == 0)
							$r_class = "r_even";
						else
							$r_class = "r_odd";
						
						$rno++;
						
						echo '<tr class="' . $r_class . '">';
						echo '<td>' . $rno . '</td>';
						echo '<td>' . $user['Uemail'] . '</td>';
						echo '<td><em>' . $user['uType'] . '</em></td>';
						echo '<td><a onclick="if(confirm(\'This action cannot be done.\\nDo You want to proceed?\')) return true; else return false;" href="processors/trash_a_user.php?userid='. $user['UID'] . '"><img src="images/trash_icon_25.png" title="Delete This User" alt="Delete" /></a></td>';
						echo '</tr>';
					}
				?>
			
			</tbody>
		</table>
	</fieldset>
</div>
<?php
	}
?>