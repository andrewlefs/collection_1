<?php 	
require_once '../config/config.php';	
require_once '../library/classCMS.php';		
//error	ư
error_reporting(0);		
//initialize class	
$cms = new CMS;		
//get system config	
$aConfig = $cms->getSystemConfig();		
//pagination	
$iPageSize = 5;	$iPageNum = $_GET['pageNum'];		
//url	
	
	$get_id = mysql_real_escape_string($_GET['id']);	
	$get_id = (is_numeric($get_id) && $get_id>0)?$get_id:"";	
	
	$get_value = mysql_real_escape_string($_GET['value']);	
	$_POST['type__int'] = (is_numeric($get_value) && $get_value>0)?$get_value:"";	
	$get = "";
	if(!empty($get_id)){
		$cms->edit($get_id, $_POST, "images");
		$get = 1;
	}
	echo $get;
	

?>					