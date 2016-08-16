<?php
//table
$sTable = 'images';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách hình ảnh";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' hình ảnh';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";