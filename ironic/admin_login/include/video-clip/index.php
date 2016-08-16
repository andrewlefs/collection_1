<?php
//table
$sTable = 'video_clip';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách video clip";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' video clip';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";