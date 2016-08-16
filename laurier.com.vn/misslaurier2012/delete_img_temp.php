<?php
@session_start();
include_once("config.php");
include_once('htinmotion/orm/adodb5/adodb.inc.php');
include_once('htinmotion/orm/general/general.php');
deleteTemp($_SESSION["user"]["UserID"]);
function deleteTemp($UserID){
	$g=new general();
	$g->executeSQL("delete from temp_image where UserID=".$UserID);
	echo "OK";
}
?>