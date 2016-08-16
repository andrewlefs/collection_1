<?php
	include_once("../../Library/config.php");
	include_once("../../Library/connect.php");
	include_once("../../Classes/adodb5/adodb.inc.php");
	include_once("../../Classes/general/general.php");
	
	if($_POST['page'])
	{
		$general = new general();
		
		$sql = "SELECT COUNT(*) as Count from question";
		return $general->getSQLJSON($sql);
	}
?>