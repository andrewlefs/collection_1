<?php
//table
$sTable = 'poll';
$sCatTable = 'poll_category';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách câu trả lời";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' câu trả lời';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";