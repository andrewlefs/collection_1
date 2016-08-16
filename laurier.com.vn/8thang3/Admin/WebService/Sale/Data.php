<?php
	include_once("../../../Config/config.php");
	include_once("../../../Config/connect.php");
	include_once("../../../Library/adodb5/adodb.inc.php");
	include_once("../../../Library/general/general.php");
	
	if($_POST['page'])
	{
		$page = $_POST['page'];
		
		$page -= 1;
		$per_page = $_POST['page_size'];
		$start = $page * $per_page;
		
		$general = new general();
		$sql = "SELECT * from sale ORDER BY sale_id DESC LIMIT $start, $per_page";
		
		return $general->getSQLJSON($sql);
	}
?>