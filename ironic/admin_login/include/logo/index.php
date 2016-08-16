<?php
//table
$sTable = 'logo';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách logo";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' logo';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";