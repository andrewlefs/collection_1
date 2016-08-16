<?php
//table
$sTable = 'products_sub_subcategory';
$sCatTable = 'products_subcategory';

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