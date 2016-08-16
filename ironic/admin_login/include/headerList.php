<?php
//tu khoa
if (isset($_POST['keyWord'])==true){
	$sKeyWord = $_POST['keyWord'];
	$sKeyWord = $cms->changeTitle($sKeyWord);
}else
	$sKeyWord='';

//order
if ($_POST['order'])
	$sOrder= $_POST['order'];
else
	$sOrder='id';

//ordir
if ($_POST['ordir'])
	$sOrdir= $_POST['ordir'];
else
	$sOrdir='ASC';

//change ordir
$sOrdirChange= $cms->changeOrdir($sOrdir);

//arrow
if ($sOrdir == 'ASC')
	$sArrow = '&uarr;';
else
	$sArrow = '&darr;';

//pagination
$iPageSize = $aConfig['page_size_admin'];
$iPageNum = 1;
if ($_POST['pageNum'])
	$iPageNum = $_POST['pageNum'];

//#
$i= ($iPageNum-1)*$iPageSize + 1;