<?php
@session_start();
include_once("../lib/config.php");
include_once('../classes/orm/adodb5/adodb.inc.php');
include_once('../classes/orm/general/general.php');
createSave();
function createSave(){
	$g=new general();
	$_POST["member_id"]=$_SESSION["user"]["UserID"]?$_SESSION["user"]["UserID"]:0;
	$_POST["item_date"]=date("Y-m-d H:i:s");
	$id=$g->executeInsert("item_select",$_POST,"");
	if($id>0 && $_POST["member_id"]>0){
		echo "YES";
	}
	else{
		echo "NO";
	}
}
?>