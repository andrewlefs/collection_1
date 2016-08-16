<?php
//table
$sTable = 'info';

//url
$sModule = $aUrl[0];
$iId = $aUrl[3];

//title
$sList = "Từ khóa tìm kiếm";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' từ khóa tìm kiếm';

//include

	include "edit.php";