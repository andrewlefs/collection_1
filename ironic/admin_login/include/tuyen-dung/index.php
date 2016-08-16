<?php
//table
$sTable = 'info';
$sCatTable = 'info_category';
//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách thông tin";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' thông tin';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";