<?php
	require('config.php');
	$today = date("Ymd");
	mkdir($path."media/".$today, 0777);
?>