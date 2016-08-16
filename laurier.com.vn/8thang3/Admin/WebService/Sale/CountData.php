<?php
	include_once("../../../Config/config.php");
	include_once("../../../Config/connect.php");
	include_once("../../../Library/adodb5/adodb.inc.php");
	include_once("../../../Library/general/general.php");
	
	if($_POST)
	{
		$general = new general();
		$sql = "SELECT Count(*) as Count from sale";
		
		return $general->getSQLJSON($sql);
	}
?>