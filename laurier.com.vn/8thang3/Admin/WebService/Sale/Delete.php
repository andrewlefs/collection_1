<?php
	include_once("../../../Config/config.php");
	include_once("../../../Config/connect.php");
	include_once("../../../Library/Sale.php");
	
	if($_POST)
	{
		$Sale = new Sale($DB,"../../../");
		$sale_id = $_POST["sale_id"];
		$Sale->DeleteSale($sale_id);
	}
?>