<?php
//table
$sTable = 'products';
$jTable = 'images_products';
//url
$sModule = $aUrl[0];
$id = $aUrl[1];
$iId = $aUrl[2];
$get_id = $aUrl[3];
//title
$sList = "Danh sách hình ảnh";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' hình ảnh';

//include
if (!$aUrl[2])
	include "list.php";
else
	include "edit.php";