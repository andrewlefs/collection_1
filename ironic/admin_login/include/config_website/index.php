<?php
//table
$sTable = 'config_website';
$bNameUnsigned = true;

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách config";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' config';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";