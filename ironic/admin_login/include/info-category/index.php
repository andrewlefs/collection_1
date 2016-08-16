<?php
//table
$sTable = 'info_category';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách thể loại thông tin";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' thể loại thông tin';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";