<?php
//table
$sTable = 'products_cat_category';
$sCatTable = 'products_category';

//url
$sModule = $aUrl[0];
$iId = $aUrl[3];

//title
$sList = "Danh sách loại sản phẩm";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' loại sản phẩm';

//include
if (!$aUrl[2])
	include "list.php";
else
	include "edit.php";