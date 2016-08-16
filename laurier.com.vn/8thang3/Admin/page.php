<?php
	include_once("../Library/Sale.php");
	$Sale = new Sale($DB,"../");
	$page = "";
	switch($_PAGE){
		case "list_sale":
			$page = "Modules/Sale/default.php";
			break;
		
		case "add_edit_sale":
			$page = "Modules/Sale/AddEditSale.php";
			break;
	}
	if($page){
		include_once($page);
	}
?>