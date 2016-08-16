<?php
include_once("../lib/config.php");
include_once('../classes/orm/adodb5/adodb.inc.php');
include_once('../classes/orm/general/general.php');
if($_GET['act']=='loadViewComment'){
	$limit = $_GET['limit'];
	$page = $_GET['page'];
	$g=new general();
	$sql="SELECT *,(select `Name` FROM user WHERE user.UserID=cms_comment.member_id) as username,(select `avatar` FROM user WHERE user.UserID=cms_comment.member_id) as avatar  FROM cms_comment WHERE Cmm_Active=1 and Cmm_TTuc_Id=".$_GET['Id']." order by Cmm_Id desc LIMIT ".$page.",".$limit;
	return $g->getSQLJSON($sql);
}
?>