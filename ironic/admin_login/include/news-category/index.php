<?php
//table
$sTable = 'news_category';

//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

//title
$sList = "Danh sách thể loại tin tức";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' thể loại tin tức';

//include
if (!$aUrl[1])
	include "list.php";
else
	include "edit.php";