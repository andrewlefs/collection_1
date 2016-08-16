<?php
//table
$sTable = 'system_config';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Cấu hình hệ thống";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' cấu hình hệ thống';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";