<?php
	/*This seemingly simple file will perform the action of logging out an ADMIN
	by destroying his session and unsetting $_GLOBALS in which one of members is $_SESSION*/
	session_start();
	session_destroy();
	unset($_GLOBALS);
	header('location: login.php?logout=1');
	die(); /*halt execution*/
?>