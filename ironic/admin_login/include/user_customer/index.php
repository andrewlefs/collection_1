<?php
//table
$sTable = 'user_normal_product';
$spTable = 'products';
$stTable = 'tuvantieudung';
//url
$sModule = $aUrl[0];
$iId = $aUrl[2];
//title
$sList = "Danh sách account user";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' tùy chọn';

//include
if($aUrl[1])	
{
	include "edit.php";	
 
}else
{
 include "list.php";
}
?>