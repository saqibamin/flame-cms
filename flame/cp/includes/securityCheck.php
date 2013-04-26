<?php
	/*******************************************************************************************
	** this seemingly simple statement dictates the most crucial security aspect   	**
	** of the whole admin panel,																		   		**
	** every page which is included through admin panel must include this page      **
	** at the very top, and this page will ensure that there are no direct accesses      **
	** made to that included page and all the calls are legal because					    **
	** application's admin panel sets this flag variable and it would be available only **
	** if the call is made through the application														**
	*******************************************************************************************/
	if(!isset($secFlag))
		die("You cannot directly access this page");
?>