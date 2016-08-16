<?php
//table
$sTable = 'images';
$ssTable = 'user_normal';
$sscTable = 'comment_gallery';
$sscTable_j = 'images_gallery';
//url
$sModule = $aUrl[0];
$iId = $aUrl[2];
//title
$sList = "Danh sách đăng ảnh";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' bình luận';

//include
if ($aUrl[2])	
{	
 include "comment.php";
}elseif ($aUrl[1])	
{
	include "edit.php";	
 
}else
{
 include "list.php";
}
?>