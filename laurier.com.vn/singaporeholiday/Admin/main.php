<?php
	include_once("../Classes/Question.php");
	$cls_Question = new Question($DB,"../");
	$page = "";
	switch($_CAT){
		case "upload_question":
			$page = "Modules/Upload/UploadQuestion.php";
			break;
		
		case "edit_question":
			$page = "Modules/Upload/UploadQuestion.php";
			break;
			
		case "list_question":
			$page = "Modules/Upload/ListQuestion.php";
			break;
	}
	if($page){
		include_once($page);
	}
?>