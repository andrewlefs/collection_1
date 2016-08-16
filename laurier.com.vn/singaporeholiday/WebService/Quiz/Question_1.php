<?php
	session_start();
	if($_POST){
		$_SESSION['answear_1'] = $_POST["answear_1"];
	}
?>