<?php
require_once '../config/config.php';
require_once '../library/classCMS.php';

//error
error_reporting(0);

//initialize class
$cms = new CMS;

$aParam['name__char'] = $_GET['name'];
$aParam['description__char'] = $_GET['desc'];
$aParam['newsId__char'] = $_GET['id'];
$aParam['publish__int'] = 0;
$aParam['updateCMS__datetime'] = date("d-m-Y H:i:s");

$cms->edit('', $aParam, 'comment_gallery');
?>
Bình luận của bạn đang được xét duyệt. Cám ơn bạn!