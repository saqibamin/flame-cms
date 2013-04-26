<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once('includes/pageloader.php'); /*Load the Brain*/?> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title><?php echo $title . ' | ' . $siteTitle; ?></title>
		<meta name="keywords" content="<?php echo $siteKW; ?>" />
		<meta name="description" content="<?php echo $siteDesc; ?>" />
		
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<img class="logo" src="images/flame.png" alt="<?php echo $siteTitle;?>" /> <h1>
				<?php echo $siteTitle; ?></h1>
			</div>
			<div id="mainNavigation">
				<ul id="nav">
					<?php echo $mainNav; ?>
					<li><a href="index.php?pid=contact" <?php echo isset($_GET['pid']) && $_GET['pid'] == 'contact' ? 'class="current"' : ''; ?>>Contact</a></li>
				</ul>
			</div>
			<div id="leftSidebar">
				<ul id="leftNav">
					<?php echo $leftNav; ?>
					<li><a class="bottom-right-round  <?php echo isset($_GET['pid']) && $_GET['pid'] == 'contact' ? 'current' : ''; ?>" href="index.php?pid=contact">Contact</a></li>
				</ul>
				<a id="downloadLink" href="downloads/flame-cms-1.0-beta.zip" title="Download Flame CMS"></a>
			</div>
			<div id="content">
				<h1 class="title"><?php echo $title; ?></h1>
				
				<?php
					if(isset($_GET['msg']) && !empty($_GET['msg']))
					{
				?>
					<span class="infoMSG"><?php echo urldecode($_GET['msg']); ?></span>
				<?php
					}
				?>
				
				<?php echo $content; ?>
			</div>
			<div id="footer">
				
			</div>
		</div>
	</body>
</html>