<?php
require_once '../config/config.php';
require_once '../library/classCMS.php';
session_start();
//error
error_reporting(0);

//initialize class
$cms = new CMS;
if(isset($_SESSION['nameLogin']) && !empty($_SESSION['nameLogin'])){
$aParam['id_user__int'] = (isset($_SESSION['normal']) && !empty($_SESSION['normal']))?$_SESSION['normal']:"";
}
$aParam['name__char'] = $_GET['name'];
$aParam['description__char'] = $_GET['desc'];
$aParam['newsId__char'] = $_GET['id'];
$aParam['publish__int'] = 0;
$aParam['updateCMS__datetime'] = date("d-m-Y H:i:s");

$cms->edit('', $aParam, 'comment');
?>
Bình luận của bạn đang được xét duyệt. Cám ơn bạn!