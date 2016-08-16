<?php
include_once("lib/config.php");
include_once("lib/support.php");
include_once("classes/ExportExcel.php");
include_once("classes/Excel_XML.php");
$dataTitle = array(
	array('ID', 'Họ & Tên','Địa Chỉ','Điện Thoại','CMND','Mã Số')
);
$cls = new ExportExcel($DB);
$objs = $cls->listExportData3();
$xls = new Excel_XML('UTF-8', false, 'Dữ Liệu Giải Ba');
$xls->addArray ( $dataTitle );
$xls->addArray ( $objs );
$xls->generateXML ("Data-Export-Giai-3");
?>