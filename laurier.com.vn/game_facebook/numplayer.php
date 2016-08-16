<?php
	include_once("../lib/config.php");
	include_once('../classes/orm/adodb5/adodb.inc.php');
	include_once('../classes/orm/general/general.php');
	$g=new general();
	$sql="SELECT COUNT( DISTINCT facebook_email) AS total FROM facebook_game";
	$numplay=$g->getSQL($sql,0);
	if(sizeof($numplay)>0){
		foreach($numplay as $k=>$i)
		{
			echo $i['total'];
		}
	}
?>