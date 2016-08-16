<?php
include_once("../config.php");
include_once('../htinmotion/orm/adodb5/adodb.inc.php');
include_once('../htinmotion/orm/general/general.php');
if($_GET["type"]=="store_log" && isset($_POST["UserID"]) && isset($_POST["album_id"]))
{
	storeLog();
}
function storeLog(){
	$g=new general();
	$uploadify=$g->executeInsert("uploadify_log",$_POST,"");
	echo "<status state='1'><![CDATA[Store log success.]]></status>";
	return;
}

?>