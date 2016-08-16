<?php
	@session_start();
	if($_POST["txt_pass"]!=""){
		$_SESSION['adpass'] = $_POST["txt_pass"];
		echo $_SESSION['adpass'];
	}
	else{
		$_SESSION['adpass'] = "error";
		echo $_SESSION['adpass'];
	}
?>