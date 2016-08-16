<?php
//table
$sTable = 'products';
$sCatTable = 'products_category';
$sSubcatTable = 'products_subcategory';$ssSubcatTable = 'products_sub_subcategory';
$sssSubcatTable = 'products_cat_category';

$simTable = 'images_products';
//url
$sModule = $aUrl[0];
$iId = $aUrl[2];

$iIds = (is_numeric($aUrl[3]))?$aUrl[3]:"";
//title
$sList = "Danh sách sản phẩm";
$sEdit = ($iId)?'Cập nhật':'Thêm';
$sEdit .= ' sản phẩm';

//include
if($aUrl[1]=="add_images"){
	if($aUrl[3]){
		include "add_images.php";
	}else{
		include "list_images.php";
	}
	
}elseif($aUrl[1]){
	include "edit.php";
}else{
	
	include "list.php";
}
