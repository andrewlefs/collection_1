<?php
//table
$sTable = 'images_gallery';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách loại sản phẩm Gallery";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' loại sản phẩm';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";