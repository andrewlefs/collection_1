<?php
	@session_start(); 
	if(session_is_registered('logged'))
	{
		unset($_SESSION['logged']);
		unset($_SESSION['role']);
		session_unset();
		session_destroy();
		header( "Location: ../cms_admin/login.php" );
	}
	else
	{
		header( "Location: ../cms_admin/login.php" );
	}
?>