<?php
//table
$sTable = 'news';
$sCatTable = 'news_category';
$sSubcatTable = 'news_subcategory';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách tin tức";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' tin tức';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";