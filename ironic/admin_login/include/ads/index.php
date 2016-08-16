<?php
//table
$sTable = 'ads';
$bNameUnsigned = true;

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách quảng cáo";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' quảng cáo';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";