<?php
//table
$sTable = 'khuyenmai';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách dịch vụ";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' Dịch vụ';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";