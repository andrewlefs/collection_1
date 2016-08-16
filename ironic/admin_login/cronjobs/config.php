<?php
	$path="/home/phunu/domains/phunuchungminh.com/public_html/";

	include($path."include/db.conf.php");
	require_once($path.'libraries/adodb/adodb.inc.php');
	//connect database
	$conn = &ADONewConnection(DBTYPE);
	$conn ->PConnect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
	$conn ->Execute("set names 'utf8'");
	$GLOBALS['conn']=$conn;
	include($path."administrator/include/function.php");
	
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set("display_errors", 1);
?>