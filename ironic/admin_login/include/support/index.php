<?php
//table
$sTable = 'support';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách hỗ trợ";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' hỗ trợ';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";