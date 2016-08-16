<?php
//table
$sTable = 'system_web';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách thông tin";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' thông tin';

//include

	include "edit.php";