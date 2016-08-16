<?php
	include_once("../../Library/config.php");
	include_once("../../Library/connect.php");
	include_once("../../Classes/Question.php");
	if($_POST)
	{
		$id  = $_POST['id'];
		$cls_Question = new Question($DB,"../../");
		$cls_Question->Delete_Question($id);
	}
?>