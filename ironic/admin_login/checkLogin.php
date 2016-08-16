<?php
session_start();
if(!($_SESSION['iLoginUser'])){
	//$_SESSION['back'] = $_SERVER['REQUEST_URI'];	
	header('location: login.php');
}
?>