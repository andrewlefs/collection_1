<?php
//table
$sTable = 'comment';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];
//title
$sList = "Danh sách bình luận";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' bình luận';

//include
if (!$aUrl[1])	
{	
	include "list.php";
}
else
{

include "edit.php";	
}
?>