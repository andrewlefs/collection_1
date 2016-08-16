<?php
session_start();
//$_SESSION['logged']='1';
if (!isset($_SESSION['logged']))
{
	header("Location: login.php");
	exit;
}
?>