<?php
@session_start();
include_once("config.php");
include_once('htinmotion/orm/adodb5/adodb.inc.php');
include_once('htinmotion/orm/general/general.php');
if($_SESSION['adpass']=="ropho1642276279"){
	updateTemp();
}
else{
	echo "OK";
}
function updateTemp(){
	$g=new general();
	$id=$g->executeUpdate("lucky_circle",$_POST,"where id=1");
	echo "OK";
}
?>