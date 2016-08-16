<?php
	include_once("../../Library/config.php");
	include_once("../../Library/connect.php");
	include_once("../../Classes/adodb5/adodb.inc.php");
	include_once("../../Classes/general/general.php");
	
	if($_POST['page'])
	{
		$order;
		if($sort_field == -1)
			$order = NULL;
		else
			$order = " ORDER BY ".$sort_field." ".$sort_option;
			
		$page = $_POST['page'];
		$page -= 1;
		$per_page = $_POST['page_size'];
		$start = $page * $per_page;
		
		$general = new general();
		
		$sql = "SELECT * from Question ".$order." LIMIT $start, $per_page";

		return $general->getSQLJSON($sql);
	}
?>