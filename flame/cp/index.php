<?php
	/*import generic functions, don't delete this line*/
	require_once('includes/generic_functions.php');
	
	session_start(); /*start the session*/
	
	/*authenticate the login of the user*/
	if(!auth_user()) /*just to check whether user is logged in or not*/
	{
		/*user authentication failed, redirect to login page*/
		redirect_to('login.php?sessionerror=true');
	}
?>

<!doctype html> <?php /*html 5 document type declaration*/?>
<?php
	
	/*set security flag*/
	$secFlag = TRUE;
	
	/*import database connection information*/
	require_once('../includes/db_config_connect.php');

?>
<html>
	<head>
		<title>Admin Panel | <?php echo get_site_title(); ?></title>
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		<?php
			
			/*
			 * The code below dynamically adds javascript snippets
			 *  to make the webpage light-weight so that it loads
			 *  faster over slower internet connections too.
			 *  
			 *  If you ever have to do similar stuff,
			 *  just add an if statement and check for your particular
			 *  'view' nad its value, but do so in the body of this first
			 *  if statement
			 */
			if(isset($_GET['view']) && !empty($_GET['view']))
			{
				if($_GET['view'] == 'messages' && isset($_GET['msgID']))
				{
					echo '<script src="js/tiny_mce/tiny_mce.js" type="text/javascript" language="javascript"></script>';
					echo '<script src="js/tinyMCEcaller.js" type="text/javascript" language="javascript"></script>';
					echo '<script src="js/validateConfirmBox.js" type="text/javascript" language="javascript"></script>';
				}
				
				if($_GET['view'] == 'menus' && isset($_GET['menu_id']))
				{
					echo '<script src="js/jquery.js" type="text/javascript" language="javascript"></script>';
					echo '<script src="js/addHookBtn.js" type="text/javascript" language="javascript"></script>';
				}
				
				if($_GET['view'] == 'addUser')
				{
					echo '<script src="js/adduservalidate.js" type="text/javascript" language="javascript"></script>';
				}
				
				if($_GET['view'] == 'changePassword')
				{
					echo '<script src="js/changepasswordvalidate.js" type="text/javascript" language="javascript"></script>';
				}
				
				/*
				 *	 Load webpage form validators
				 *
				 */	
				if($_GET['view'] == 'addPage' || $_GET['view'] == 'editPage')
				{
					echo '<script src="js/jquery.js" type="text/javascript" language="javascript"></script>
							<script src="js/addpagevalidate.js" type="text/javascript" language="javascript"></script>
							<script src="ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script>
							<script src="js/editPageFormSubmit.js" type="text/javascript" langauage="javascript"></script>
							<script src="js/addPageFormSubmit.js" type="text/javascript" langauage="javascript"></script>';
				}
				
				if($_GET['view'] == 'addMenu' || $_GET['view'] == 'editMenu')
				{
					echo '<script src="js/jquery.js" type="text/javascript" language="javascript"></script>
							<script src="js/addmenuvalidate.js" type="text/javascript" language="javascript"></script>
							<script src="js/editMenuFormSubmit.js" type="text/javascript" langauage="javascript"></script>
							<script src="js/addMenuFormSubmit.js" type="text/javascript" langauage="javascript"></script>';
				}
			}
		?>
	</head>
	<body>
		<div	id="container">
			<?php require_once('includes/admin-header.php');?>
			<?php require_once('includes/admin-subheader.php'); ?>
			
			<?php
			 /*
			  * Now we will generate the dash
			  */
			 ?>
			
			<?php
				/*
				 * Check for operation success message argument
				 */
				if(isset($_GET['successMSG']) && !empty($_GET['successMSG']))
				{
					$msg = urldecode($_GET['successMSG']);
					echo '<div class="dSuccessMSGBar">
								<h3 class="successMSG">' . $msg .'</h3>
							</div>';
				}
			?>
			<?php
				/*
				 * Check for operation not successfull message argument
				 */
				if(isset($_GET['errorMSG']) && !empty($_GET['errorMSG']))
				{
					$msg = urldecode($_GET['errorMSG']);
					echo '<div class="dErrorMSGBar">
								<h3 class="errorMSG">' . $msg .'</h3>
							</div>';
				}
			?>
			<?php
				/*
				 * This section loads a view, depending on 
				 * the value passed in the 'view' argument
				 * in the GET arguments in the URL
				 * 
				 * If you have added your own views to the applicaton
				 * you just need to add a separate case statement
				 * below while checking for the value of
				 * your custom 'view'
				 * 
				 * Dont forget to include break statement, after modification
				 */
				if(isset($_GET['view']) && !empty($_GET['view']))
				{
					switch($_GET['view'])
					{
						case 'addPage':	/* display the add new page view */
							require_once('includes/_web-admin-addPage.php');
							break;
							
						case 'webpages':/* display the webpages view */
							require_once('includes/_web_admin_webpages.php');
							break;
							
						case 'menus':/* display the Menus view */
							require_once('includes/_web_admin_menus.php');
							break;
							
						case 'addMenu':	/* display the add new page view */
							require_once('includes/_web-admin-addMenu.php');
							break;
							
						case 'editMenu':	/* display the add new page view */
							require_once('includes/_web-admin-editMenu.php');
							break;
							
						case 'editPage': /*display the edit page view*/
							require_once('includes/_web-admin-editPage.php');
							break;
							
						case 'trashManager': /*display the Trash Manager View*/
							require_once('includes/_web-admin-trashManager.php');
							break;
							
						case 'siteConf': 	/*display the Site Settings View*/
							require_once('includes/_web-admin-site-settings.php');
							break;
							
						case 'messages': /*display the Sales Reports View*/
							require_once('includes/_admin-messages.php');
							break;
								
						/*********** Users Handling Tasks*************/

						case 'users': /*display the Users View*/
							require_once('includes/_admins.php');
							break;

						case 'addUser': /*display the Add users View*/
							require_once('includes/_add-user.php');
							break;
							
						case 'changePassword': /*display the Users View*/
							require_once('includes/_change_password.php');
							break;

						/*********** Load the default view *************/
							
						default:				/* display admin Dash */
							require_once('includes/admin-dash.php');
					}
				}
				else
				{
					/* No view is selected, display the admin Dash*/
					require_once('includes/admin-dash.php');
				}
			?>
		</div>
		<?php
			/*Import the footer section*/
			require_once('includes/admin-footer.php');
		?>
	</body>
</html>
<?php
	/******** Close the Database Connection***********/
	if(isset($conn))
		mysql_close($conn);
?>