<?php require_once('securityCheck.php'); ?>
<?php
	if(isset($_GET['msgID']) && !empty($_GET['msgID']))
	{
		$msgID = (int) $_GET['msgID'];
		
		$msgQ  = "SELECT * FROM contactus WHERE contactID={$msgID}";
		$msgR = mysql_query($msgQ, $conn);
		
		if(mysql_num_rows($msgR) > 0)
		{
			$specificMsg = true; /*set a flag variable*/
			$msgData = mysql_fetch_assoc($msgR);
		}
	}
?>
<div class="dToolBar">
	<div id="tools">
		<ul>
			<?php 
				if(isset($specificMsg))
				{
					
					echo '<li>
							<a onclick="if(confirm(\'Are you Sure?\')) return true; else return false;" href="processors/delete_message.php?msgID=' . $msgData['contactID'] . '">
								<span class="cancelIcon"></span>
								Delete
							</a>
						</li>';
				}
			?>
			<li>
				<a href="index.php<?php echo isset($specificMsg) ? '?view=messages' : ''; ?>">
					<span class="cancelIcon"></span>
					Close
				</a>
			</li>
			
		</ul>
	</div>
	<img src="images/messages_icon_dash.png" alt="Contact Us Messages" title="Contact Us Messages" />
	<h2>Contact Us Messages:<?php if(isset($specificMsg)) echo ' Reply Page';?></h2>
</div>
<?php

	if(isset($specificMsg))
	{
		/*display reply system*/
?>		
	<div id="viewElement">
	<fieldset class="detailedOrder">
		<legend class="panelTitle">Write your reply below</legend>
		
		<form onsubmit="return validateRepForm(this);" action="processors/sendReply.php" method="post">
			<input type="hidden" name="msgID" value="<?php echo $msgID; ?>" />
			<input type="hidden" name="email" value="<?php echo $msgData['msgFrom']; ?>" />
			<table>
				<tr>
					<th>To: <span style="margin-left: 60px; padding-bottom: 4px;"><?php echo $msgData['msgFrom']; ?></span></th>
				</tr>
				<tr>
					<th>Subject: <span style="margin-left: 23px; padding-bottom: 4px;"><input style="margin-left: 60px; width: 400px;" type="text" name="subject" value="Thanks for writing to us" maxlength="150" /></span></th>
				</tr>
				<tr>
					<th>Message: </th>
				</tr>
				<tr>
					<td style="font-style: oblique; padding: 20px;"><?php echo $msgData['msgBody']; ?></td>
				</tr>
				<tr>
					<th>Your Reply:</th>
				</tr>
				<tr>	
					<th>
						<textarea rows="15" name="message" cols="60"></textarea>
					</th>
				</tr>
				<tr><th><input type="submit" name="verifyPayment" value="Send" /></th></tr>
			</table>
			<script language="javascript">
				function validateRepForm(rf)
				{
					if(rf.subject.value == '' || rf.subject.value.length < 10)
					{
						alert("Invalid subject of the message");
						rf.subject.focus();
						return false;
					}
					
					return true;
				}
			</script>
		</form>
	</div>

<?php		
	} /*end of if statement*/
	else
	{

	$messagesQ = "SELECT * FROM contactus WHERE replied=0";
	
	$messagesR = mysql_query($messagesQ, $conn);
?>
<div id="viewElement">
	<fieldset class="prizesPage">
		<legend class="panelTitle">Following Messages have been sent through Contact Us Messages</legend>
		<table>
			<thead>
				<tr>
					<th>Sr#</th>
					<th>User E-Mail</th>
					<th class="eighty_px_wide">View</th>
					<th class="eighty_px_wide">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$rno = 0;
					while($message = mysql_fetch_assoc($messagesR))
					{
						if($rno % 2 == 0)
							$r_class = "r_even";
						else
							$r_class = "r_odd";
						
						$rno++;
						
						echo '<tr class="' . $r_class . '">';
						echo '<td>' . $rno . '</td>';
						echo '<td>' . $message['msgFrom'] . '</td>';
						echo '<td><a href="index.php?view=messages&msgID=' . $message['contactID'] . '"><img src="images/eye.png" alt="View Detail" /></a></td>';
						echo '<td><a onclick="if(confirm(\'Are you Sure?\')) return true; else return false;" href="processors/delete_message.php?msgID=' . $message['contactID'] . '"><img src="images/trash_icon_25.png" title="Delete This Page" alt="Delete" /></a></td>';
						echo '</tr>';
					}
				?>
			
			</tbody>
		</table>
	</fieldset>
</div>
<?php
	} /*end of normal page*/
?>