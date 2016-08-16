<?php
//table
$sTable = 'poll_category';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách câu hỏi";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' câu hỏi';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";